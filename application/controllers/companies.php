<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Companies extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->layout->setLayout('business_layout');
	}

	public function index()
	{
		$this->layout->view('index');
	}	

	public function add()
	{
		$this->layout->js(array(base_url().'public/js/jquery.validate.min.js'));
		$this->layout->view('add');
	}

	public function create()
	{
		echo $this->input->post('name');
	}
}