<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Owners extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('owner_model');
        $this->layout->setLayout('layout');
	}

	public function login()
	{
		$this->layout->view('login');
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
			$this->owner_model->initialize($this->input->post('names'),$this->input->post('last_name'),$this->input->post('email'),$this->input->post('password'));
			echo $this->owner_model->save();
		}
	}
}