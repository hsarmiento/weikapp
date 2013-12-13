<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->config('facebook_config');
		$this->load->library('Facebook', array('appId' => $this->config->item('appId'), 'secret' => $this->config->item('appSecret')));
		$this->load->library('session');
        $this->layout->setLayout('layout');
	}

	// public function index()
	// {
	// 	$this->layout->view('index');
	// }

	public function index()
	{
		$iUserId = $this->facebook->getUser();
		$aData['fb_profile'] = null;
		$aData['login_url'] = null;
		$aData['logout_url'] = null;
		$aData['user'] = null;

		if ($iUserId)
		{
			try
			{
                $aData['logout_url'] = $this->facebook->getLogoutUrl(array( 'next' => base_url().'user/logout' ));
                $aData['fb_profile'] = $this->facebook->api('/me');
                if ($this->User_model->exist_fbuid($iUserId) === false)
		        {
		        	$aUserInfo = $this->User_model->get_user_fb_data($iUserId);
		        	$this->User_model->initialize($iUserId,$aUserInfo[0]['first_name'],$aUserInfo[0]['last_name'],$aUserInfo[0]['email']);
		        	$this->User_model->save();
		        }
		        $aData['user'] = $this->User_model->get_user_name($iUserId);
            }
            catch (FacebookApiException $e)
            {
                $iUserId = null;
            }
		}
		else
		{
			$aData['login_url'] = $this->facebook->getLoginUrl(array('scope' => 'email,user_birthday,publish_stream,publish_actions','redirect_uri' => base_url().'user/index'));			
			
		}
		$this->layout->view('index',$aData);

	}

	public function logout()
	{
		// Destroy CodeIgniter Session 
		$this->session->sess_destroy();

		// Destroy Facebook Session using Facebook function
		$this->facebook->destroySession();

		// Maybe even destroy all native sessions as overkill
		session_destroy();
		redirect(base_url().'user/index');
	}
}

