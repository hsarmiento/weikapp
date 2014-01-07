<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->layout->setLayout('layout');
        $this->load->model('promo_model');
        $this->load->model('competitor_model');
	}

	public function index($category, $promo_id = null){
		$isLogged = is_logged();
		$this->load->model('category_model');
		$aData = $this->promo_model->get_promos(9,0, $category);
		$aCategories = $this->category_model->get_all_categories();
		$aPromo = NULL;
		if(isset($promo_id)){
			$aPromo = $this->promo_model->get_info_promo($promo_id);
		}
		$this->layout->css(array(base_url().'public/css/jquery-ui-1.10.3.custom.css'));
		$this->layout->view('index', compact("aData","category","aCategories", "isLogged", "aPromo"));
	}

	public function ajax_load_scrolling($offset,$category){
		$this->layout->setLayout('ajax_layout');
		$aData = $this->promo_model->get_promos(3,$offset, $category);
		echo json_encode(array($aData));
	}

	public function ajax_load_dialog_promo($category, $promo_id){	
		$this->load->model('competitor_model');			
		$this->layout->setLayout('ajax_layout');
		$aPromo = $this->promo_model->get_info_promo($promo_id);
		if(is_logged() === true)
		{			
			$aPromo['joined'] = $this->competitor_model->is_competitor($this->session->userdata('uid'),$promo_id);
		}
		else
		{
			$aPromo['joined'] = false;
		}
		$aPromo['is_logged'] = is_logged();
		$aPromo['count_competitors'] = $this->competitor_model->count_promo_competitors($promo_id);
		$this->layout->view('ajax_load_dialog_promo', compact('aPromo', 'category'));
	}
}