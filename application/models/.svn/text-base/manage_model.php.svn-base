<?php

/**
 * This model handles most activities for feed managmenet, such as 
 * adding new feeds for a user, or deleting existing feeds, or returning 
 * a set of recommended feeds.
 * 
 * @author Ilya Ratner
 */

 class Manage_Model extends CI_Model {
 	
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Adds a feed for user with id = $id
	 * 
	 * @param $url feed url to add
	 * @param $id the id of the user
	 */
	function add_user_feed($url, $id)
	{
		$sql = 'select feed_id from rss_feed where feed_url = ?;';
		$query = $this->db->query($sql, array($url));
		
		// This if is to assure that empty query results aren't processed.
		if ($query->num_rows() != 0) {
			$feed_id = $query->row()->feed_id;
			
			$sql = 'select * from subscription where user_id = ? and feed_id = ?;';
			$query = $this->db->query($sql, array($id, $feed_id));
			
			// only add a feed if it isn't already subscribed to
			if ($query->num_rows() == 0) {
			
				$sql = 'insert into subscription (user_id, feed_id) values (?, ?);';
				$query = $this->db->query($sql, array($id, $feed_id));
			}
		}
	}
	
	/**
	 * Gets all feeds the user with the given id is subscribed to.
	 * 
	 * @param $id the user id.
	 * @return a result set with all subscribed to feeds.
	 */
	function get_user_feeds($id)
	{
		$sql = 'SELECT title, feed_id, link FROM rss_feed 
					WHERE rss_feed.feed_id IN
						(SELECT feed_id FROM subscription WHERE user_id = ?);';
		$query = $this->db->query($sql, array($id));
		return $query->result();
	}
	
	/**
	 * Gets recommended feeds for the subscriptions controller (Manage Account Page).
	 * The query pulls the five most subscribed to feeds, excluding any feeds the user
	 * is already subscribed to.
	 * @param $id the user id.
	 * @return a result set with 5 recommended feeds feeds.
	 */
	function get_recommended_feeds($id)
	{
		$sql = 'SELECT rss_feed.feed_url, rss_feed.title, COUNT(*) AS cnt
				FROM subscription, rss_feed 
				WHERE rss_feed.feed_id = subscription.feed_id 
				AND subscription.feed_id NOT IN (SELECT subscription.feed_id FROM subscription WHERE user_id = ?)
				GROUP BY subscription.feed_id ORDER BY cnt DESC LIMIT 5;';
		$query = $this->db->query($sql, array($id));
		return $query->result();
	}
	
	/**
	 * Removes a feed from user's subscriptions.
	 * 
	 * @param $cookie the user id
	 * @param $feed_id the feed id
	 */
	function remove_feed($cookie, $feed_id)
	{
		$sql = 'delete from subscription where user_id = ? and feed_id =?;';
		$query = $this->db->query($sql, array($cookie, $feed_id));
	}
 }
?>