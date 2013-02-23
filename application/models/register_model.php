<?php

/**
 * Simple model for adding a new user to the database, and
 * adding any feeds that were selected during registration.
 * 
 * Author: Ilya Ratner
 */

 class Register_Model extends CI_Model {
 	
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Checks if a user already exists in the database.
	 * 
	 * @param $email a parameter to check existence against.
	 * @return false if no user exists and true otherwise.
	 */
	function user_exists($email) {
		
		$sql = 'select * from registered_users where email = ?;';
		$query = $this->db->query($sql, array($email));
		
		if (count($query->result()) == 0)
		{
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * Loads recommendations.
	 * @return a set of all recommended feeds, which are determined by the enabled and recommended
	 * columns.  These feeds are determined by a database administrator, not algorithmically.
	 */
	function load_recommended()
	{
		$sql = 'select feed_name, feed_id from rss_feed where recommended = 1 and enabled = 1;';
		$query = $this->db->query($sql);
		return $query->result();	
	}
	
	/**
	 * Adds a user to the database.
	 * 
	 * @param $id first field.
	 * @param $email the second field.
	 */
	function add_new_user($id, $pswd)
	{
		$sql = 'insert into registered_users (email, password) values (?, ?);';
		$this->db->query($sql, array($id, $pswd));
	}
	
	/**
	 * Adds any selected recommended feeds for the specified user.
	 * 
	 * @param $id the email of the user that was just added.
	 * @param $feeds an array of feed_ids
	 */
	function add_rec_feeds($id, $feeds)
	{
		$sql = 'select user_id from registered_users where email = ?;';
		$query = $this->db->query($sql, array($id));
		$row = $query->row();
		$user = $row->user_id;
		
		// add each fedd in the $feeds array to the subscription table using
		// $id as the user id.
		foreach ($feeds as $feed)
		{
			$sql = 'insert into subscription (user_id, feed_id) values (?, ?);';
			$query = $this->db->query($sql, array($user, $feed));
		}
	}
	
	
 }
?>