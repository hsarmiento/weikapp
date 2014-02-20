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

	public function index($category = 'favorites', $promo_id = null, $sPublishAction = null){
		$isLogged = is_logged();
		$this->load->model('category_model');
		// $this->load->model('user_preference_model');
		if($category === 'favorites' && $isLogged === true){
			$aData = $this->promo_model->get_favorite_promos(6,0,$this->session->userdata('uid'));
		}elseif($category !== 'favorites'){
			$aData = $this->promo_model->get_promos(6,0, $category);
		}
		$aCategories = $this->category_model->get_all_categories();
		$aPromo = NULL;
		if(isset($promo_id)){
			$aPromo = $this->promo_model->get_info_promo($promo_id);
		}

		$this->layout->css(array(base_url().'public/css/jquery-ui-1.10.3.custom.css'));
		$this->layout->setTitle('Promociones');
		$this->layout->css(array(base_url().'public/css/promos_index.css'));
		$this->layout->view('index', compact("aData","category","aCategories", "isLogged", "aPromo", "sPublishAction"));
	}

	public function ajax_load_scrolling($offset,$category){
		$this->layout->setLayout('ajax_layout');
		$isLogged = is_logged();
		if($category === 'favorites' && $isLogged === true){
			$aData = $this->promo_model->get_favorite_promos(3,$offset,$this->session->userdata('uid'));
		}elseif($category !== 'favorites'){
			$aData = $this->promo_model->get_promos(3,$offset, $category);
		}

		echo json_encode(array($aData));
	}

	public function ajax_load_dialog_promo($category, $promo_id, $sPublishAction = null){	
		$this->load->model('competitor_model');
		$this->load->library('Facebook_utils');		
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
		$aPromo['competitors'] = $this->competitor_model->get_fbusername_by_promoid($promo_id);
		$sLoginUrl = $this->facebook_utils->get_login_url(array('scope' => 'publish_actions','redirect_uri' => base_url().'competitor/participate/'.$promo_id."/".$category));
		$this->layout->view('ajax_load_dialog_promo', compact('aPromo', 'category', 'sPublishAction', 'sLoginUrl'));
	}

	public function add(){
		$this->load->model('plan_model');
		$this->load->model('category_model');
		logged_or_redirect('owners/authenticate', 'owners/profile');
		if($iCompanyId = $this->session->userdata('company_id') != NULL){
			$this->layout->js(array(base_url().'public/js/jquery.validate.min.js'));
			$this->layout->setLayout('business_layout');
			$this->layout->js(array(base_url().'public/js/jquery-ui-timepicker-addon.js'));
			$this->layout->css(array(base_url().'public/css/jquery-ui-1.10.3.custom.css'));
			$aPlan = $this->plan_model->get_fields_by_something('*',array('id' => 1));
			$aCategories = $this->category_model->get_all_categories();
			$aOptionsCategories = array();
			$aOptionsCategories[0] = 'Selecciona';
			foreach ($aCategories as $category) {
				$aOptionsCategories[$category['id']] = $category['name'];
			}
			$this->layout->view('add',compact('aPlan','aOptionsCategories'));
		}
	}

	public function create(){
		logged_or_redirect('owners/authenticate', 'owners/profile');
		if ($this->session->userdata('company_id') != NULL && $this->session->userdata('oid') != NULL){
			$start_datetime = date("Y-m-d H:i:s", strtotime($this->input->post('start_datetime')));
			$end_datetime = date("Y-m-d H:i:s", strtotime($this->input->post('end_datetime')));
			$this->promo_model->initialize($this->session->userdata('company_id'),$this->input->post('title'),$this->input->post('description'),$this->input->post('terms'),$start_datetime, $end_datetime, $this->input->post('number_participants'),$this->input->post('number_winners'),1,1,0);
			$this->promo_model->save();
			$aResult = $this->promo_model->get_row_fields('id,title',array('company_id' => $this->session->userdata('company_id')),'id desc');

			$config['image_library'] = 'imagemagick';
			$this->load->library('image_lib');
			$config['upload_path'] = './public/img/promos_orig/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2048';
			$config['max_width'] = '0';
			$config['max_height'] = '0';
			$config['file_name'] = md5($aResult['id']);
			imagepng(imagecreatefromstring(file_get_contents($_FILES['image']['tmp_name'])), './public/img/promos_orig/'.md5($aResult['id']).'.png');
			
			$this->image_lib->clear();
        	$config= array(
				'source_image' => './public/img/promos_orig/'.md5($aResult['id']).'.png',
	            'new_image' => './public/img/promos_small',
	            'maintain_ratio' => TRUE,
	            'width' => 390,
	            'height' => 200
	        );
	        $this->image_lib->initialize($config);
        	$this->image_lib->resize();

        	$config = array(
				'source_image' => './public/img/promos_orig/'.md5($aResult['id']).'.png',
	            'new_image' => './public/img/promos_big/',
	            'maintain_ratio' => TRUE,
	            'width' => 700,
	            'height' => 420
	        );
	        $this->image_lib->initialize($config);
        	$this->image_lib->resize();
			
		}
	}
}