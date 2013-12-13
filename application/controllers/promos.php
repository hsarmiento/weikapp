<?php

class Promos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->layout->setLayout('layout');
        $this->load->model('promo_model');
	}

	public function index(){
		$aData = $this->promo_model->get_promos(9,0);
		// $aData = array($aData);
		$this->layout->view('index', compact("aData"));
	}

	public function ajax_load($offset){
		$this->layout->setLayout('ajax_layout');
		$aData = $this->promo_model->get_promos(3,$offset);
		echo json_encode(array($aData));
		// $this->layout->view('ajax_load',compact("aData"));
	}
}