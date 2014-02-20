<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_pages extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); 
	}

	public function index()
	{
		$this->layout->setLayout('landing_layout');
		$this->layout->css(array(base_url().'public/css/landing.css'));
		$this->layout->view('index');
	}
}