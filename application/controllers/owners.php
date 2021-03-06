<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Owners extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('owner_model');
        $this->layout->setLayout('business_layout');
	}

	public function signup()
	{
		$this->layout->js(array(base_url().'public/js/jquery.validate.min.js'));
		$this->layout->css(array(base_url().'public/css/owners_signup.css'));
		$this->layout->view('signup');
	}

	public function create()
	{
		$this->load->library('form_validation');
		$aValidationRules = array(
			array(
				'field' => 'names',
				'label' => 'Nombre',
				'rules' => 'required'
			),
			array(
				'field' => 'last_name',
				'label' => 'Apellidos',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'correo electrónico',
				'rules' => 'callback_repeated_email'
			),
			array(
				'field' => 'password',
				'label' => 'Contraseña',
				'rules' => 'required'
			),
		);
		$this->form_validation->set_rules($aValidationRules);
		$this->form_validation->set_message('required', 'Debe llenar el campo de %s');
		if ($this->form_validation->run() === false)
		{
			$this->layout->view('signup');
		}
		else
		{
			$sHash = md5( rand(0,1000) );
			$this->owner_model->initialize($this->input->post('names'),$this->input->post('last_name'),$this->input->post('email'),$this->input->post('password'),$sHash);
			$this->owner_model->save();

			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				//ingresar mail
				'smtp_user' => '',
				// ingresar password
				'smtp_pass' => '',
				'mailtype'  => 'text', 
		    	'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			$this->email->from('', 'John Wayne');
			$this->email->to($this->input->post('email')); 

			$this->email->subject('[Weikapp] Verificaci&oacute;n de registro');
			$this->email->message('Gracias por registrarse en Weikapp!
Su cuenta ha sido creada, por favor siga el link a continuación para activar su cuenta:

http://www.weikapp.cl/owners/verify/'.$this->input->post('email').'/'.$sHash.'

Atentamente el equipo de Weikapp
			');	

			$this->email->send();

			// echo $this->email->print_debugger();
		}
	}

	public function repeated_email($sEmail)
	{
		if ($this->owner_model->is_email_repeated($sEmail))
		{
			$this->form_validation->set_message('repeated_email', 'Este %s ya está en uso');
			return false;
		}
		else
		{
			return true;
		}
	}

	public function verify($sEmail, $sHash)
	{
		$iResults = $this->owner_model->validate_email($sEmail,$sHash);
		$this->layout->js(array(base_url().'public/js/jquery.validate.min.js'));
		$this->layout->view('verify', compact('iResults'));
	}

	public function authenticate()
	{
		$this->layout->css(array(base_url().'public/css/owners_authenticate.css'));
		$this->layout->js(array(base_url().'public/js/jquery.validate.min.js'));
		$this->layout->view('authenticate');
	}

	public function fblogin()
	{
		$aGet = $this->input->get();
		if (array_key_exists('error', $aGet) && array_key_exists('error_code', $aGet) && array_key_exists('error_reason', $aGet))
		{
			if ($aGet['error_code'] == 200 && $aGet['error_reason'] == 'user_denied')
			{
				redirect(base_url().'companies/index/');
			}
		}
		else
		{
			$iFbuid = $this->facebook_utils->get_user_fbuid();
			try
			{				
				if ($this->facebook_utils->allowed_manage_pages($iFbuid) == true)
				{
					if ($this->owner_model->exist_fbuid($iFbuid) == false)
					{
						// add new owner
						$aResult = $this->owner_model->get_user_fb_data($iFbuid);
						$this->owner_model->initialize($aResult['0']['first_name'],$aResult['0']['last_name'],$aResult['0']['email'],'','',$iFbuid);
						$this->owner_model->save_from_facebook();
						// guardar imagen de facebook
			        	$url = 'http://graph.facebook.com/'.$iFbuid.'/picture';
						$img = './public/img/owners/'.md5($this->owner_model->get_userid_by_fbuid($iFbuid)).'.png';
						imagepng(imagecreatefromstring(file_get_contents($url)), $img);
						$this->load->library('image_lib');
						$config= array(
							'source_image' => $img,
				            'new_image' => $img,
				            // 'maintain_ratio' => TRUE,
				            'width' => 32,
				            'height' => 32
				        );
				        $this->image_lib->initialize($config);
			        	$this->image_lib->resize();
					}
					// check if theres new pages
					$this->load->model('company_model');
					$this->load->model('subscription_model');
					$iOwnerId = $this->owner_model->get_userid_by_fbuid($iFbuid);
					$aResult = $this->company_model->get_all_fbpid_by_ownerid($iOwnerId);
					$aPages = $this->facebook_utils->api_call('/'.$iFbuid.'/accounts');
					if (empty($aPages['data']) === false)
					{
						$aPagesFbpid = array();
						foreach ($aResult as $key)
						{
							array_push($aPagesFbpid, $key['fb_pid']);
						}
						foreach ($aPages['data'] as $key)
						{
							if (!in_array($key['id'], $aPagesFbpid))
							{
								// add new pages
								$aPageInfo = $this->facebook_utils->api_call('/'.$key['id']);
								$this->company_model->initialize($iOwnerId,$key['id'],$key['name'],NULL,$aPageInfo['link']);
								$this->company_model->save();
								$aResult = $this->company_model->get_fields_by_something('id',array('fb_pid' => $key['id']));
								$this->subscription_model->initialize(1,$aResult[0]['id']);
								$this->subscription_model->save();

								// save fanpage image from facebook
								$url = 'http://graph.facebook.com/'.$key['id'].'/picture?width=80&height=80';
								$img = './public/img/companies_orig/'.md5($aResult[0]['id']).'.png';
								imagepng(imagecreatefromstring(file_get_contents($url)), $img);
								// redimensionar imagen y guardar copia
								$this->image_lib->clear();
								$config= array(
									'source_image' => $img,
						            'new_image' => './public/img/companies_small/'.md5($aResult[0]['id']).'.png',						            
						            'width' => 32,
						            'height' => 32
						        );
						        $this->image_lib->initialize($config);
					        	$this->image_lib->resize();
							}						
						}
					}
					// save sessions
					$this->session->set_userdata(array('oid' => $iOwnerId, 'fbuid'=> $iFbuid,'logged_in' => TRUE, 'uname' => $this->owner_model->get_names_by_id($iOwnerId)));
					// redirect to owner profile
					redirect(base_url().'owners/profile');
				}
				else
				{
					redirect($this->facebook_utils->get_login_url(array('scope' => 'manage_pages','redirect_uri' => base_url().'owners/fblogin')));
				}
			}
			catch(Exception $e)
	   		{
	      		error_log($e->getMessage());
	  		}			
		}
	}

	public function login()
	{
		$this->layout->js(array(base_url().'public/js/jquery.validate.min.js'));
		$sEmail = $this->input->post('email');
		if (!isset($sEmail))
		{
			$sEmail = '';
			$this->layout->view('login',compact('sEmail'));
		}
		else
		{
			$aPassword = $this->owner_model->get_password_by_email($this->input->post('email'));
			if ($aPassword['password'] == md5($this->input->post('password'))) 
			{
				$iOwnerId = $this->owner_model->get_id_by_email($this->input->post('email'));
				$this->session->set_userdata(array('oid' => $iOwnerId, 'fbuid'=> NULL, 'logged_in' => TRUE, 'uname' => $this->owner_model->get_names_by_id($iOwnerId)));
				// redirect to profile
				redirect(base_url().'owner/profile');
				
			}
			else
			{
				$sEmail = $this->input->post('email');
				$this->layout->view('login',compact('sEmail'));
			}
		}		
	}

	public function recovery()
	{
		$this->layout->js(array(base_url().'public/js/jquery.validate.min.js'));
		$this->layout->view('recovery');
	}

	public function send()
	{		
		$this->layout->js(array(base_url().'public/js/jquery.validate.min.js'));
		$this->load->library('form_validation');
		$aValidationRules = array(
			array(
				'field' => 'email',
				'label' => 'correo electrónico',
				'rules' => 'callback_exist_email'
			)
		);
		$this->form_validation->set_rules($aValidationRules);
		if ($this->form_validation->run() === false)
		{
			$this->layout->view('recovery');
		}
		else
		{
			// actualiza el hash
			$sHash = md5( rand(0,1000) );
			$this->owner_model->update_field(array('hash' => $sHash),array('email' => $this->input->post('email')));
			// envia el mail
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				//ingresar mail
				'smtp_user' => '',
				// ingresar password
				'smtp_pass' => '',
				'mailtype'  => 'text', 
		    	'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			$this->email->from('', 'John Wayne');
			$this->email->to($this->input->post('email')); 

			$this->email->subject('[Weikapp] Recuperar password');
			$this->email->message('Gracias por volver a Weikapp!
Por favor siga el link a continuación para crear una nueva password:

http://www.weikapp.cl/owners/reset/'.$this->input->post('email').'/'.$sHash.'

Atentamente el equipo de Weikapp
			');	

			$this->email->send();
			// echo $this->email->print_debugger();
			// muestra mensaje
			echo 'Un correo ha sido enviado al email especificado.';
		}
	}

	public function exist_email($sEmail)
	{
		if ($this->owner_model->is_email_repeated($sEmail))
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('exist_email', 'Esa dirección de correo electrónico no tiene asociada una cuenta de usuario. ¿Tienes certeza de haberte registrado?');
			return false;
		}
	}

	public function reset($sEmail,$sHash)
	{
		// validar email
		$iResults = $this->owner_model->validate_email_and_hash($sEmail,$sHash);
		$this->layout->js(array(base_url().'public/js/jquery.validate.min.js'));
		$this->layout->view('reset', compact('iResults','sEmail'));
	}

	public function change()
	{
		// update password
		$this->owner_model->update_field(array('password' => md5($this->input->post('password'))),array('email' => $this->input->post('email')));
		// save sessions
		$aResult = $this->owner_model->get_fields_by_something('id,names',array('email' => $this->input->post('email')));
		$this->session->set_userdata(array('oid' => $aResult['id'],'logged_in' => TRUE, 'uname' => $aResult['names']));
		// redirect to profile
		redirect(base_url().'owner/profile');
	}

	public function logout()
	{
		// Destroy CodeIgniter Session 
		$this->session->sess_destroy();

		// Destroy Facebook Session using Facebook function
		$this->facebook_utils->session_destroy();

		// Maybe even destroy all native sessions as overkill
		session_destroy();
		redirect(base_url().'companies');
	}

	public function profile()
	{
		logged_or_redirect('owners/authenticate', 'owners/profile');
		if ($this->session->userdata('company_id') == NULL)
		{
			$this->load->model('company_model');
			$aCompany = $this->company_model->get_fields_with_limits('id,name,fb_pid',array('owner_id' => $this->session->userdata('oid')),1,0);
			$this->session->set_userdata('company_id', $aCompany[0]['id']);
			$this->session->set_userdata('company_name', $aCompany[0]['name']);
			$this->session->set_userdata('company_fbpid', $aCompany[0]['fb_pid']);
		}
		$this->load->model('subscription_model');
		$aPlan = $this->subscription_model->get_plan_by_company_id($this->session->userdata('company_id'));
		$this->load->model('promo_model');
		$aPromos = $this->promo_model->get_fields_with_limits('id,title',array('company_id' => $this->session->userdata('company_id')),3,0);
		$this->layout->css(array(base_url().'public/css/owners.css'));
		$this->layout->view('profile', compact('aPlan','aPromos'));
	}

	//change business
	public function choose()
	{
		$this->load->model('company_model');
		$aCompanies = $this->company_model->get_fields_by_something('id,name',array('owner_id' => $this->session->userdata('oid')));
		$this->layout->view('choose',compact('aCompanies'));
	}

	public function select($iCompanyId)
	{
		$this->load->model('company_model');
		$aResult = $this->company_model->get_fields_by_something('id,name,fb_pid',array('id' => $iCompanyId));
		$this->session->set_userdata('company_id', $aResult[0]['id']);
		$this->session->set_userdata('company_name', $aResult[0]['name']);
		if ($aResult[0]['fb_pid'] == NULL)
		{
			$this->session->set_userdata('company_fbpid', NULL);
		}
		else
		{
			$this->session->set_userdata('company_fbpid', $aResult[0]['fb_pid']);
		}		
		//redirect to profile
		redirect(base_url().'owners/profile');
	}
}