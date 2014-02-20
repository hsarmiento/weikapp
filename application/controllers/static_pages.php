<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_pages extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); 
	}

	public function index()
	{
		if($this->session->userdata('uid') != NULL){
			redirect(base_url().'promos/index');
		}
		if($this->session->userdata('oid') != NULL){
			redirect(base_url().'owners/profile');
		}
		$this->layout->setLayout('landing_layout');
		$this->layout->css(array(base_url().'public/css/landing.css'));
		$this->layout->view('index');
	}
}