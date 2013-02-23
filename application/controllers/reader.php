 <?php
  
/**
* This is the Controller for the RSS Reader and Parser.
* 
* Author: John Pendexter
*/
  
class Reader extends CI_Controller {
     
    function __construct() 
    {
        parent::__construct();
   
        $this->load->library('simplepie');    
    }
     
    
    /**
     * Main entry point for the webpage. This function
     * handles the heavy lifting for displaying the RSS reader
     * information. Based on the parameters for the index, 
     * the function knows what story to display (if a user
     * has clicked on a story) as well as what feed to display
     * on the left pane. 
     * 
     * @param story_id The id of a story for the detail pane, or
     * null if the page is loading for the first time. 
     * @param feed_id the offset point for the feed. 
     */
    public function index($story_id_url, $feed_id_url)
    { 
        // Load Helpers
        $this->load->helper('url');
        $this->load->model('rss_feed_model'); 
        $this->load->model('read_message_model');
		$this->load->model('login_model');    
		
   		// Get the user ID
        $id = $this->_get_userId();		
		
        // If a user isn't logged in, redirect
		if (!$id) { redirect('users/logged_out'); }
		
		// sets email value at top of page.
		$data_array['user_name'] = $this->login_model->get_user_name($id);
		     
         
        // Grab the information from the drop down
        if (!isset($_POST['subscribed_feeds']))
        {          
        	/*
        	 * If the parameter feed_id for the
        	 * index function is empty, the dropdown
        	 * defaults to 1 (the first feed), otherwise
        	 * go to the selected feed. 
        	 */
	        if (empty($feed_id_url))
	        {
	        	$dropdown_id = $this->rss_feed_model->get_first_feed_id($id);
	        }
	        else 
	        {
	        	$dropdown_id = $feed_id_url[0];
	        }
	        
	        // If a message is read, add it to the read_message table
	        // This line must only be called is the post data is not 
	        // set otherwise articles that are not read will be marked as such
        	$this->_add_read_message_to_db($story_id_url, $dropdown_id, $id);
            
        }
        else
        {
            $dropdown_id = $_POST['subscribed_feeds'];
        }
                 
        // Error handing for the drop down - to ensure that
        // the app doesn't crash if the user clicks on "Select a Feed". 
        // The default feed is always the first one the user has subscribed to. 
        if ($dropdown_id == 0)
        {
        	$dropdown_id = 1;
        }
        
        
        // Create an array to hold all user feeds and all feed data
        $data_array['data_array'] = array(
         
                            'all_feeds' => $this->rss_feed_model->get_all_feeds($id),
                            'single_feed' => $this->_parse_single_feed($dropdown_id),
                            'story_position' => $this->_get_story_array_index($story_id_url),
        					'feed_position' => $dropdown_id,
        					'read_messages' => $this->read_message_model->get_read_messages($id)
        );
        
        
        // Load the View
        $this->load->view('rss_reader', $data_array);  
    }
    
     
    /**
     * This is just a helper function that returns
     * the array index of the story that a user clicks on so that 
     * the story detail can be displayed. 
     * 
     * @param $story_array_index The index of the story
     */
    private function _get_story_array_index($story_array_index)
    {
    	// If the user has selected a new feed from the drop down	
    	if (isset($_POST['subscribed_feeds']))
    	{
    		return 0;
    	}
    	else 
    	{
        	return $story_array_index;
    	}
    }
     
    
    /**
     * Remap function so the index can be called
     * with an argument and story details can be
     * dynamically generated. 
     * 
     * @param $feed_detail_num The detail of the feed number
     * @param $feed_id The id of the feed
     */
    public function _remap($feed_detail_num, $feed_id)
    {
        if ($feed_detail_num != null)
        {
            $this->index($feed_detail_num, $feed_id	);
        }
    }
    
    
    /**
     * Helper function to get the user id. 
     */
    private function _get_userId()
    {
    	return $this->input->cookie('rssWeb_UserId');
    }
     
    
    /**
     * 
     * This function creates a new instance of
     * SimplePie and parses a single feed link. 
     * 
     * This is the only spot in the application that 
     * should be doing any parsing - every other 
     * transaction for RSS messages should be done 
     * through the read_messages table. 
     * 
     * @param $feed_url The url of the feed being parsed
     */
    private function _parse_single_feed($feed_id)
    {
        // Get the single feed url
        $url = $this->rss_feed_model->get_single_feed_url($feed_id);
         
        // Create a SimplePie object
        $feed = new SimplePie();
        $feed->set_feed_url($url);       
        $feed->set_cache_location('application/cache');
        $feed->enable_cache(true);
        $feed->init();
        $feed->handle_content_type();
        
        // Add new messages to the rss_message table
        $this->rss_feed_model->add_feeds_to_archive($feed->get_items(0,0), $feed_id);
        
        // Get the message data from the archive for display
        $single_feed_query = $this->rss_feed_model->get_read_message($feed_id);
         
        // Return all of the SimplePie items (RSS entries)
        return $single_feed_query;
    }    
    
    
    /**
     * This function is called every page load. If the user looks 
     * at an article they have not read before, that article information
     * is added to the read_message database. 
     * 
     * 
     * @param $story_position The position of the story in the array. 
     * @param $feed_id The id of the feed of the read story. 
     * @param $user_id The id of the user reading the story. 
     */
    private function _add_read_message_to_db($story_position, $feed_id, $user_id)
    {	
    	
    	// If the story position is the index - the user
    	// is on the default page (when they first arrive); not an article
    	
    	if ($story_position != 'index')
    	{
    		$messages = $this->rss_feed_model->get_read_message($feed_id);
    		
    		// variable to keep track of where in the database we are in relation to
    		// the list in the view. This allows the correct story (message) to be
    		// persisted to the read_message table (archived) 
    		$i = 0;
    		
    		foreach ($messages as $row)
    		{
    			$i++;
    			
    			if ($i == $story_position)
    			{
    				$this->read_message_model->add_read_message($row->message_link,
	        			 $user_id, $feed_id);
    				break;
    			}
    		} //end for
    		
    	} //end if
    }
    
}
  
?>
