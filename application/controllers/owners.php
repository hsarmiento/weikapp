<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Owners extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('owner_model');
        $this->layout->setLayout('layout');
	}

	public function signup()
	{
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
				'label' => 'Correo electrónico',
				'rules' => 'required'
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
			$this->layout->view('login');
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

			$this->email->from('sebastian@backfront.cl', 'John Wayne');
			$this->email->to($this->input->post('email')); 

			$this->email->subject('[Weikapp] Verificaci&oacute;n de registro');
			$this->email->message('Gracias por registrarse en Weikapp!
Su cuenta ha sido creada, por favor siga el link a continuación para activar su cuenta:

http://www.weikapp.cl/owners/verify/email/'.$this->input->post('email').'/hash/'.$sHash.'

Atentamente el equipo de Weikapp
			');	

			$this->email->send();

			echo $this->email->print_debugger();
		}
	}

	public function verify($sEmail, $sHash)
	{
		$iResults = $this->owner_model->validate_email($sEmail,$sHash);
		$this->layout->view('verify', compact('iResults'));
	}

	public function authenticate()
	{
		$this->layout->view('authenticate');
	}

	public function fblogin()
	{
		$iFbuid = $this->facebook_utils->get_user_fbuid();
		try
		{
			$aPages = $this->facebook_utils->api_call('/'.$iFbuid.'/accounts');
			$bManagePages = $this->facebook_utils->allowed_manage_pages($iFbuid);
			$this->layout->view('fblogin',compact('aPages','bManagePages'));
		}
		catch(Exception $e)
   		{
      		error_log($e->getMessage());
  		}
	}

	public function login()
	{
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
				$this->session->set_userdata(array('uid' => $iOwnerId,'logged_in' => TRUE, 'uname' => $this->owner_model->get_names_by_id($iOwnerId)));
				// redirect to profile
				
			}
			else
			{
				$sEmail = $this->input->post('email');
				$this->layout->view('login',compact('sEmail'));
			}
		}		
	}
}