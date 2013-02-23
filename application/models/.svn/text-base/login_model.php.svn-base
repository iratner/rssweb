<?php
/**
* This Model Checks Login Credentials and Creates a Cookie for User-Id.
* It also provides user-specific functions related to user information 
* in the database.
*
* @author: Patrick Shepp & Ilya Ratner
*/

class Login_Model extends CI_Model
{
    function __construct()
	{
		parent::__construct();
	}
	
	function checkLogin($email, $password, $remember)
	{
	   // User-Id Cookie Values (only set if login success)
	   $cookie = array(
	       'name'      =>  'rssWeb_UserId',
	       'value'     =>  '-1',
	       'expire'    =>  '10800',
	       // 'domain'    =>  '.rss.franklinpracticum.com',
	       'path'      => '/'
	       // 'prefix'    =>
	       //'secure'    => TRUE
	       );
	   $sql = "SELECT * FROM registered_users WHERE email = ? and password = ?";
	   $result = $this->db->query($sql, array($email, $password));
	   
	   if ($result->num_rows() > 0)
	   {
	       foreach($result->result() as $row)
	       {
	           $cookie['value'] = $row->user_id;
	           $cookie['expire'] = ($remember) ? '604800' : '10800';
	           $this->input->set_cookie($cookie);
	       }
	       return true;
	   }
	   else
	   {
	       return false;
	   }
	}
	
	/**
	 * Gets the email of a user based on the user_id field in
	 * the database.
	 * 
	 * @param $id the user id in the database.
	 */
	
	function get_user_name($id)
	{
		$sql = "select email from registered_users where user_id =?;";
		$query = $this->db->query($sql, array($id));
		return $query->row()->email;
	}
	
	/**
	 * Checks to see if a user has any rss subscriptions.
	 * 
	 * @param $email the email of the user.
	 */
	function has_feeds($email)
	{
		$sql = "select * from subscription where user_id in
 				(select user_id from registered_users where email = ?);";
		$query = $this->db->query($sql, array($email));
		return ($query->num_rows() > 0) ? TRUE : FALSE;
	}
	
	/**
	 * Gets a user's password.
	 * @param $id the user id.
	 */
	function get_password($id) {
		
		$sql = "select password from registered_users where user_id = ?;";
		$query = $this->db->query($sql, array($id));
		return $query->row()->password;
	}
	
	/**
	 * Changes a users password.
	 * 
	 * @param $id a user id.
	 * @param $password a user password.
	 */
	function change_password($id, $password) {
		$sql = "update registered_users set password = ? where user_id = ?;";
		$query = $this->db->query($sql, array($password, $id));
	}
}

?>