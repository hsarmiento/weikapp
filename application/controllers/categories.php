<?php

class Categories extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->layout->setLayout('layout');
        $this->load->model('category_model');
	}

	public function index(){
		$aData = $this->category_model->get_categories(5,1);
		// $aData = array($aData);
		$this->layout->view('index', compact("aData"));
	}

	public function ajax_load($offset){
		$this->layout->setLayout('ajax_layout');
		$aData = $this->category_model->get_categories(1,$offset);
		echo json_encode(array($aData));
		// $this->layout->view('ajax_load',compact("aData"));
	}
}