<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Companies extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->layout->setLayout('layout');
        // $this->load->model('category_model');
	}

	public function index()
	{
		$this->layout->view('index');
	}
}