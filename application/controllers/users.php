<?php

/**
* This controller loads both the login page and the registration page.
* it contains functions that load recommended feeds on the registration
* page as well as registration validation and registration and login
* control
* 
* @author: Ilya Ratner
*/

class Users extends CI_Controller {
	
		    
    function __construct()
	{
		parent::__construct();
		
		
		// load model
		$this->load->model('register_model');
		$this->load->helper('cookie', 'url');
		
	}
    
    // Index loads Log-In Form View
    function index()
    {
        // Load the View
        $this->load->view('login');
    }
	
	
	/**
	 * Logs a user out and kills the cookie.
	 */
	function logout()
	{
		delete_cookie('rssWeb_UserId');
		redirect('users');
	}
	
	/**
	 * Redirects user to the logout screen after the sign-out button has been pressed.
	 */
	function logged_out()
	{
		$this->load->view('logged-out');
	}
    
    /**
	 * Calls registration functions.
	 * 
	 * @param $error any error messages created during registration.
	 */
    function register($error = null)
    {
        // Load the recommended feeds
        $data['recommended'] = $this->get_recommended();
		
		// load any error message generated during registration
		$data['error'] = $error;
		// this is always false unless there's text in the error message.
		$data['registered'] = FALSE;
		
		// if and empty error is passed in to the function, the registration
		// process successfully completed.
		if($error === '')
		{
			$data['registered'] = TRUE;
		}
        
        $this->load->view('register', $data);
	}
	
	/**
	 * Creates five recommendations by selecting randomly from the database.
	 * The database knows which feeds are set as recommended.
	 */
	function get_recommended()
	{
		// get the recommended feeds from the database
		$feed_result_set = $this->register_model->load_recommended();
		
		// shuffle the returned array
		shuffle($feed_result_set);
		
		// create a new array and push first five shuffled elements onto it
		$feed_names = array();
		for ($i = 0; $i < 5; $i++)
		{
			array_push($feed_names, $feed_result_set[$i]);
		}
		
		// return a random array of recommended feeds.
		return $feed_names;
		
	}
		
	/**
	 * Adds a user after validation.
	 */
	
	function addUser()
	{
		// get the input fields	
		$id =  $this->input->post('usr-id');
		$pswd = $this->input->post('password');
		$pswd_confirm = $this->input->post('password-confirm');
		
		// backup validation after javascript validation.
		$is_valid = $this->valid($id, $pswd, $pswd_confirm);
		
		// if is_valid is blank, fields were valid
		if ($is_valid == '')
		{
			$is_valid = $this->check_no_match($id, $pswd);	
			// if no user with same credentials exists in database continue
			if ($is_valid == '')
			{
				$this->register_model->add_new_user($id, $pswd);
				
				// after adding a user, add any selected feeds
				$this->add_new_user_feeds($id);
			}
		}
		
		$this->register($is_valid);
	}
	
	/**
	 * Adds any selected recommended feeds.
	 * @param $id the user id.
	 */
	function add_new_user_feeds($id)
	{
		$feeds_arr = $this->input->post('feeds');
		$count = count($feeds_arr);
		
		// is_array is important, otherwise 1 is always returned
		// even if the array is empty
		if (is_array($feeds_arr) && $count > 0) {
			
			 $this->register_model->add_rec_feeds($id, $feeds_arr);
		}
	}
	
	/**
	 * Validates form data.
	 * 
	 * @param $id email of user to be added.
	 * @param $pswd password of user to be added.
	 * @param $pswd_confirm password confirmation.
	 */
	function valid($id, $pswd, $pswd_confirm)
	{
		$error_msg = '';
		$valid = TRUE;
		
		// checks if email is valid
		if (!valid_email($id)) {
			 $valid = FALSE;	
			 $error_msg .= "Invalid e-mail. "; 
		}
		
		// checks if a password was entered at all.
		if (empty($pswd)) {
			$valid = FALSE;
			$error_msg .= "Enter a Password.";
		}
		
		// if password was entered, checks to see if the confirm matches
		else {
			if ($pswd !== $pswd_confirm) {
				$valid = FALSE;
				$error_msg .= "Passwords don't match. ";
			}
		}
		
		return $error_msg;
	}
	
	/**
	 * Checks if a user exists.  If one does, puts up an error
	 * message and returns false.  Otherwise returns true.
	 * 
	 * @param $id user id (email)
	 * @param $pswd password.
	 * @return The error message, which may be empty.
	 */
	function check_no_match($id, $pswd)
	{
		$no_match = '';		
		if ($this->register_model->user_exists($id)) {
			
			$no_match = 'User Already Exits.';
		}
		
		return $no_match;				
	}
}

?>