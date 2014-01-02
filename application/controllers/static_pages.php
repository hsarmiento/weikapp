<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_pages extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->layout->setLayout('layout');
	}

	public function index()
	{
		$this->layout->view('index');
	}
}