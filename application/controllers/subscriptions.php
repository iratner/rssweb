<?php

/**
* This is the Controller for Managing Account settings.  It controls adding new
* feed subscriptions, removing current subscriptions, displaying and providing the
* ability to add recommended feeds, as well as changing the users password.
* 
* @author: Ilya Ratner
*/

class Subscriptions extends CI_Controller {
		
	// Variable holds error messages
	public $error;
	
	public function __construct()
	{
		parent::__construct();
		
		// Load Helpers
        $this->load->helper(array('url', 'form'));
		$this->load->library('simplepie');
		$this->load->model(array('rss_feed_model', 'manage_model', 'login_model'));
	}
    
	/**
	 * Main function for launching the subscription management page.  
	 * 
	 * @param $has_feeds determines if user is subscribed to any feeds.
	 * @param $valid_pass determines if a valid password was entered during
	 * 			password change attempt.
	 * @param $pass_changed determines if a password was successfully changed.
	 */
    public function index($has_feeds = TRUE, $valid_pass = TRUE, $pass_changed = FALSE)
    {
    	// load all passed in variables and the error message class variable.	
    	$data['pass_changed'] = $pass_changed;
    	$data['valid_pass'] = $valid_pass;
    	$data['invalid_feed'] = $this->error;
		$data['has_feeds'] = $has_feeds;
		
        // if cookie isn't valid here, the system logs out
        $cookie = $this->input->cookie('rssWeb_UserId');
		
		if (!$cookie) { redirect('users/logged_out'); }
		
		// else, user feeds and recommended feeds are loaded 
		else {
			$data['user_name'] = $this->login_model->get_user_name($cookie);
			
	        $data['user_feeds'] = $this->manage_model->get_user_feeds($cookie);
			$data['rec_feeds'] = $this->manage_model->get_recommended_feeds($cookie);      
	        // Load the View
	        $this->load->view('feed_manage', $data);
		}
    }
	
	/**
	 * Determines which page is displayed when the user clicks on the 'Home'
	 * tab.  If there are no subscriptions a user is not able to go to the reader
	 * page ('Home').
	 */
	function go_home()
	{
		$id = $this->input->cookie('rssWeb_UserId');
		// get the user_id from the database using the email
		$email = $this->login_model->get_user_name($id);
		
		// If feeds exist go to reader page.
		if ($this->login_model->has_feeds($email))
		{
			redirect('reader');
		}
		// otherwise stay on subscriptions page
		else {
			$this->index(FALSE);
		}
		
	}
	
	/**
	 * Controls adding a new feed for a logged in user.
	 */
	function add_feed()
	{
		$feed_url = $this->input->post('feed-to-add');
		
		// instantiate SimplePie and parse the feed		
		$feed = new SimplePie();
		$feed->set_feed_url($feed_url);
		$feed->set_cache_location('application/cache');
		$feed->enable_cache(true);
		$feed->init();
		$feed->handle_content_type();
		
		// make sure the feed is valid, if it isn't set error message and
		// reload the page.
		if ($feed->error) {
			$this->error = 'No Such Feed.';	
			$this->index();
		}
		
		// otherwise a new feed subscription is added
		else {			
			// Using the rss_feed_model to add a feed to the database
			// since all the logic is there.
			$this->rss_feed_model->add_new_feed($feed_url);
			$id = $this->input->cookie('rssWeb_UserId');
			
			
			// adds subscription for current user
			$this->manage_model->add_user_feed($feed_url, $id);
			
			redirect('subscriptions');
		}
		
	}
	
	function change_password() {
		
		// get the id
		$id = $this->input->cookie('rssWeb_UserId');
		// Get the input password
		$in_pass = $this->input->post('old_password');
		// Get the actual password user password
		$password = $this->login_model->get_password($id);
		// Get the new password set (backup test)
		$new_pass = $this->input->post('new_password');
		$new_pass_confirm = $this->input->post('confirm_password');
		
		// if actual password and real passwords don't match, set the 
		// appropriate error message
		if ($password != $in_pass) {
			$this->index(TRUE, "Invalid Current Password");
		} 
		// Should never happen, Javascript should catch this next test
		else if ($new_pass != $new_pass_confirm) {
			$this->index(TRUE, "New Passwords Don't Match!");
		}
		else {
			// if everything is okay, change the password
			$this->login_model->change_password($id, $new_pass);
			$this->index(TRUE, TRUE, TRUE);
		}
		
		
		
	}
	/**
	 * Removes a user feed from the user's subscriptions
	 */
	function remove_feed() {
		$id = $this->input->cookie('rssWeb_UserId');
		$feed_id  = $this->input->post('feed_id');
		
		$this->manage_model->remove_feed($id, $feed_id);
		
		redirect('subscriptions');
	}
	
	/**
	 * Adds a feed from the recommended feed section
	 */
	function add_rec_feed() {
		$feed_url = $this->input->post('rec_feed');
		$this->manage_model->add_user_feed($feed_url, $this->input->cookie('rssWeb_UserId'));
		redirect('subscriptions');
	}

}

?>