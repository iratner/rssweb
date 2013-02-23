<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Site Welcome & Login Controller.
*
* @author = Patrick Shepp
*/

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 */
	public function index()
	{
	   // Check for Cookie and Route Accodingly.
	   if (!$this->input->cookie('rssWeb_UserId'))
	   {
	       $this->load->view('login');
	   }
       else
       {
            redirect('reader');
       }
	}
	
	/**
	* Checks the Database for a Valid Login with the Credentials Applied.
	*
	*/
	public function processLogin()
	{
	   $this->load->model('login_model');
	   $email = $this->input->post('login');
	   $password = $this->input->post('password');
	   $remember = ($this->input->post('remember') == 'T') ? TRUE : FALSE;
	   
	   $valid = $this->login_model->checkLogin($email, $password, $remember);
	   
	   if ($valid == TRUE)
	   {
	       if ($this->login_model->has_feeds($email))
		   {
		   		redirect('reader');
		   }
			else {
				redirect('subscriptions');
				
			}
	   }
	   
	   $data['error'] = "Incorrect Login";
	   $this->load->view('login', $data);
	   
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */