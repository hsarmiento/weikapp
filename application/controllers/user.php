<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('Facebook_utils');
        $this->layout->setLayout('layout');
	}

	public function index()
	{
		$this->layout->view('index');
	}

	public function login()
	{
		$this->layout->setTitle('Login');
		$iUserId = $this->facebook_utils->get_user_fbuid();		
		$aData['login_url'] = null;
		$aData['logout_url'] = null;
		$aData['user'] = null;

		if ($iUserId)
		{
			try
			{
				$aData['logout_url'] = $this->facebook_utils->get_logout_url(array( 'next' => base_url().'user/logout' ));
                if ($this->User_model->exist_fbuid($iUserId) === FALSE)
		        {
		        	$aUserInfo = $this->User_model->get_user_fb_data($iUserId);
		        	$this->User_model->initialize($iUserId,$aUserInfo[0]['first_name'],$aUserInfo[0]['last_name'],$aUserInfo[0]['email']);
		        	$this->User_model->save();
		        }
		        $aData['user'] = $this->User_model->get_uname_by_fbuid($iUserId);		        
		        $this->session->set_userdata(array('uid' => $this->User_model->get_userid_by_fbuid($iUserId), 'fbuid' => $iUserId,'logged_in' => TRUE, 'uname' =>$this->User_model->get_uname_by_fbuid($iUserId)));								
		        error_log(base_url().$this->session->flashdata('urlFrom'));
		        redirect(base_url().$this->session->flashdata('urlFrom'));
            }
            catch (FacebookApiException $e)
            {
                $iUserId = null;
            }
		}
		else
		{
			$this->session->keep_flashdata('urlFrom');
			$aData['login_url'] = $this->facebook_utils->get_login_url(array('scope' => 'email,user_birthday,publish_stream,publish_actions','redirect_uri' => base_url().'user/login'));
			$this->layout->setLayout('ajax_layout');			
			$this->layout->view('login',$aData);			
		}		
	}

	public function logout()
	{
		// Destroy CodeIgniter Session 
		$this->session->sess_destroy();

		// Destroy Facebook Session using Facebook function
		$this->facebook_utils->session_destroy();

		// Maybe even destroy all native sessions as overkill
		session_destroy();
		redirect(base_url());
	}

	public function profile()
	{
		logged_or_redirect('user/login', 'user/profile');

		$iUid = $this->session->userdata('uid');
		$sUname = $this->session->userdata('uname');
		$this->layout->view('profile', compact('iUid', 'sUname'));
	}

}

