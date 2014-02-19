<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Companies extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('company_model');
        $this->layout->setLayout('business_layout');
	}

	public function index()
	{
		$this->layout->view('index');
	}	

	public function add()
	{
		logged_or_redirect('owners/authenticate', 'owners/profile');
		$this->layout->js(array(base_url().'public/js/jquery.validate.min.js'));
		$this->layout->view('add');
	}

	public function create()
	{
		// add new company
		logged_or_redirect('owners/authenticate', 'owners/profile');
		$this->company_model->initialize($this->session->userdata('uid'),null,$this->input->post('name'),$this->input->post('city'));
		$this->company_model->save();
		$aResult = $this->company_model->get_fields_with_limits('id,name',array('owner_id' => $this->session->userdata('uid')),1,0,'id desc');
		// upload image		
		$config['upload_path'] = './public/img/companies/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$config['file_name'] = md5($aResult[0]['id']);
		// print_r($_FILES);
		$this->load->library('upload', $config);
		$this->upload->do_upload('logo');

		$options['image_library'] = 'ImageMagick';
		$options['library_path']='/usr/bin';
		$options['source_image']='./public/img/companies/'.md5($aResult[0]['id']).'.';
		$options['new_image']='./public/img/companies/'.md5($aResult[0]['id']).'.png';
		$this->load->library('image_lib',$config);

		//set new company as default
		$this->session->set_userdata('company_id', $aResult[0]['id']);
		$this->session->set_userdata('company_name', $aResult[0]['name']);
		$this->session->set_userdata('company_fbpid', NULL);
		$this->load->model('subscription_model');
		$this->subscription_model->initialize(1,$aResult[0]['id']);
		$this->subscription_model->save();
		//redirect to profile
		redirect(base_url().'owners/profile');
				
	}
}