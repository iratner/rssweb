<?php

/**
 * 
 * A model to describe a single RSS feed. This model
 * also handles the logic to persist messages in the
 * archive so they can be shown to users for 90 days. 
 * 
 * @author John Pendexter
 *
 */
class Rss_Feed_Model extends CI_Model {
	
	
	function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Return a single feed using the feed_id number. 
     * 
     * 
     * @param $id The feed_id number. 
     */
    function get_feed_by_id($id)
    {
    	$sql = "select * from rss_feed where feed_id=" . $id . ';';
        $query = $this->db->query($sql);
        $result = $query->result();
         
        return $result;
    }
    
    /**
     * Function to add any new feeds to the archive. 
     * 
     * @param $items The items to iterate over and check if they are in the archive. 
     * 	If they are not already in the archive, add them. 
     * @param $feed_id The feed_id to add the new items to. 
     *  
     */
    function add_feeds_to_archive($items, $feed_id)
    {
    	foreach ($items as $item)
    	{
    		if (!$this->is_message_in_archive($item, $feed_id))
    		{
	    		$sql = "insert into rss_message (feed_id, message_title, message_detail, message_link, feed_title)
							values(?, ?, ?, ?, ?);";
				$query = $this->db->query($sql, array($feed_id, $item->get_title(),
						 $item->get_description(), $item->get_link(), $item->get_feed()->get_title()));
    		}
    	}
    }
    
    
    /**
     * Check to see if a message has already been added to the database. 
     * 
     * @param $item The item to check for existance in the database. 
     * @param $feed_id The feed_id that contains the ite. 
     */
    function is_message_in_archive($item, $feed_id)
    {
    	$sql = 	"select * from rss_message where feed_id=" . $feed_id .
    		 	" and message_link like '" . $item->get_link() . "';";
    	$query = $this->db->query($sql);
    	
    	$result = $query->result();
    	
    	return ($result != null);
    }
 
    
    /**
     * This function pulls a single feed from the archive
     * so that its information can be displayed in the view.   
     * 
     * 
     * @param $feed_id The id of the feed of the message being selected
     */
    function get_read_message($feed_id)
    {
    	$sql = "select * from rss_message where feed_id=" . $feed_id . 
    	" and create_date >= date_sub(current_date, interval 90 day)" . 
    	"order by create_date desc;";
    	
    	$query = $this->db->query($sql);
    	$result = $query->result();
    	
    	return $result;
    }
    
    
    /**
     * Return all the feeds for a user based on their
     * user id. 
     * 
     * @param user_id The id of the user that has subscribed
     * to the feeds being requested. 
     */
    function get_all_feeds($user_id)
    {
    	$sql = 	"select * from rss_feed inner join " .
    			"subscription on rss_feed.feed_id = subscription.feed_id " .
    			"and subscription.user_id=" . $user_id . ";";
        $query = $this->db->query($sql);
        $result = $query->result();
         
        return $result;
    }
    
    /**
     * This is a helper method for the _parse_single_feed()
     * method in the RSS reader controller class. This method simply 
     * takes a feed_id and returns the feed url for the corresponding
     * feed_id. 
     * 
     * This is done because the new SimplePie object that will be built
     * to parse all of the entries for a single feed takes the parent
     * feed url as a parameter. 
     * 
     * @param $feed_id The feed id. 
     */
    function get_single_feed_url($feed_id)
    {
    	$sql = "select feed_url from rss_feed where feed_id=" . $feed_id . ";";
    	$query = $this->db->query($sql);
        
        return $query->row(0)->feed_url;
    }
    
    /**
     * This function is to get the first feed id
     * that the user is subscribed to. This will allow
     * the reader to populate accordingly. 
     * 
     * @param $user_id The user_id of the logged in user. 
     */
    function get_first_feed_id($user_id)
    {
    	$sql =  "select rss_feed.feed_id from rss_feed inner join subscription on rss_feed.feed_id = subscription.feed_id " . 
    			"where subscription.user_id=" . $user_id .  " limit 1;";
    	$query = $this->db->query($sql);
    	
    	return $query->row(0)->feed_id;
    }
    
    
    /**
     * Adds a new feed to the database if it does not
     * already exist in the database. 
     * 
     * @param $feed_url The main url of the feed. 
     */
    function add_new_feed($feed_url) 
    {
    	//first setup the parser
  		$feed = new SimplePie();
		$feed->set_feed_url($feed_url);	
		$feed->set_cache_location('application/cache');
		$feed->enable_cache(true);
		$feed->init();
		$feed->handle_content_type();
		
		//if the feed is not already in the database, add it
		if (!$this->is_feed_in_db($feed->get_permalink()))
		{
			$feed_name = $feed->get_title();
			$link = $feed->get_permalink();
			$feed_title = $feed_name;
			$feed_desc = $feed->get_description();	
			
			
			$sql = "insert into rss_feed (feed_name, feed_url, link, title, description)
						values(?, ?, ?, ?, ?);";
			$query = $this->db->query($sql, array($feed_name, $feed_url, $link, $feed_title, $feed_desc));
			
		}
    }
    
    
    /**
     * This is a utility function to check for
     * existance of an RSS feed in the database before
     * adding it as a new feed. 
     * 
	 *
     * @param $feed_name The name of the feed to search for. 
     */
    function is_feed_in_db($feed_link)
    {
		$sql = 'select * from rss_feed where link = ?;';
        $query = $this->db->query($sql, array($feed_link));
        $result = $query->result();
    	
    	return ($result != null);
    	
    }
	
}
?>