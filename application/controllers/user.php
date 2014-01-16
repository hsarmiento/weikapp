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
		$urlFrom = null;
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
		        	if ($this->facebook_utils->allowed_publish_actions($iUserId) === true)
		        	{
		        		$aPost = array(
							'message' => 'He comenzado a utilizar weikapp',
							'name' => 'weikapp facebook app',
							'caption' => 'caption loco po ahi puee se',
							'link' => 'http://www.backfront.cl',
							'description' => 'pagina corporativa',
							'picture' => 'http://www.backfront.cl/src_bf/logo_bf.png'
						);
						try{
							$post_id = $this->facebook_utils->post_on_user_wall('me', $aPost);
                   		}
                   		catch(Exception $e)
                   		{
                      		error_log($e->getMessage());
                  		}
		        	}
		        }		        
		        $aData['user'] = $this->User_model->get_uname_by_fbuid($iUserId);		        
		        $this->session->set_userdata(array('uid' => $this->User_model->get_userid_by_fbuid($iUserId), 'fbuid' => $iUserId,'logged_in' => TRUE, 'uname' =>$this->User_model->get_uname_by_fbuid($iUserId)));								
		        $urlFrom = $this->session->flashdata('urlFrom');
		        if(empty($urlFrom)){
		        	redirect(base_url().'promos/index');
		        }
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
			if (isset($_GET['error']) && isset($_GET['error_code']) && isset($_GET['error_reason']))
			{
				if ($_GET['error_code'] == 200 && $_GET['error_reason'] == 'user_denied')
				{
					// echo $this->session->flashdata('urlFrom').'<br>';
					$aUrl = explode('/', $this->session->flashdata('urlFrom'));
					// echo base_url();
					redirect(base_url().'promos/index/'.$aUrl[3].'/'.$aUrl[2]);
				}				
			}
			else
			{
				$aData['login_url'] = $this->facebook_utils->get_login_url(array('scope' => 'email,user_birthday,publish_stream,publish_actions','redirect_uri' => base_url().'user/login'));
				$this->layout->setLayout('ajax_layout');
				$this->layout->view('login',$aData);
			}
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
		$this->load->model('competitor_model');
		$iUid = $this->session->userdata('uid');
		$sUname = $this->session->userdata('uname');
		$aUserPromosCompetitor = $this->competitor_model->user_promos_competitor($iUid);
		$this->layout->css(array(base_url().'public/css/jquery-ui-1.10.3.custom.css'));
		$this->layout->setTitle('Promociones');
		$this->layout->view('profile', compact('iUid', 'sUname', 'aUserPromosCompetitor'));
	}

}

