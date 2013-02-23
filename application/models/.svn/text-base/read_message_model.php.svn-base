<?php
/**
 * 
 * This model represents the read_message table, and any
 * interactions with that table. 
 * 
 * @author John Pendexter
 *
 */
class Read_Message_Model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	 * This function adds a read message to the read_message
	 * table in the database. 
	 * 
	 * @param $msg_id The message id of the individual RSS story. 
	 * 		  This parameter is represented by the url of the individual
	 * 		  RSS story. In SimplePie, this is SimplePie_item->get_link()	
	 * @param $user_id The user id reading the RSS story.
	 * @param $feed_id The feed id of the RSS story. 
	 */
	function add_read_message($msg_id, $user_id, $feed_id)
	{
		if (! $this->is_already_read($msg_id, $user_id, $feed_id) )
		{
			$sql = 	"insert into read_message (msg_id, user_id, feed_id) values " . 
					"(\"" . $msg_id . "\", " . $user_id . ", " . $feed_id . ");";
			$query = $this->db->query($sql);
		}
	}
	
	
	/**
	 * Get the read message information from a user. 
	 * 
	 * @param $user_id The user id. 
	 */
	function get_read_messages($user_id)
	{
		$sql = 	"select * from read_message where user_id=" . $user_id . 
		" and create_date >= date_sub(current_date, interval 90 day);";
		
		$query = $this->db->query($sql);
        $result = $query->result();
        
        $read_array = null;
        
        // Create an array with each of the read message ids as a key
        // This allows for fast lookup of read messages
        foreach ($result as $row)
        {
        	$read_array['\'' . $row->msg_id . '\''] = true;  
        }
        
        return $read_array;
	}
	
	
	/**
	 * This function returns true if the article is already
	 * in the read_message table - if the user has already
	 * read the article. This is to keep the database from 
	 * growing unnecessarily upon multiple reads of the 
	 * same article. 
	 * 
	 * @param $msg_id The individual message id
	 * @param $user_id The user id
	 * @param $feed_id The feed id of the message being checked if it is already read
	 */
	function is_already_read($msg_id, $user_id, $feed_id)
	{
		$sql = 	"select * from read_message where user_id=" . $user_id . " and msg_id like \"" . $msg_id .
				"\" and feed_id=" . $feed_id . ";";
		
		$query = $this->db->query($sql);
        $result = $query->result();
    	
    	return ($result != null);
	}
	
}
?>