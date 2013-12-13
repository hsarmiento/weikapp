<?php

class Promos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->layout->setLayout('layout');
        $this->load->model('promo_model');
	}

	public function index($category){

		$this->load->model('category_model');
		$aData = $this->promo_model->get_promos(9,0, $category);
		$aCategories = $this->category_model->get_all_categories();
		$this->layout->view('index', compact("aData","category","aCategories"));
	}

	public function ajax_load($offset,$category){
		$this->layout->setLayout('ajax_layout');
		$aData = $this->promo_model->get_promos(3,$offset, $category);
		echo json_encode(array($aData));
		// $this->layout->view('ajax_load',compact("aData"));
	}
}