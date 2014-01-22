<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_preferences extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->layout->setLayout('layout');
        $this->load->model('user_preference_model');
	}

}