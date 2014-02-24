<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscriptions extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('subscription_model');
		$this->layout->setLayout('business_layout');
	}

	public function edit()
	{
		logged_or_redirect('owners/authenticate', 'subscriptions/edit');
		$this->load->model('plan_model');
		// get all the plans
		$aPlans = $this->plan_model->get_fields_by_something('*',array('id >' => 0));
		// get the subscription
		$aSubscription = $this->subscription_model->get_fields_by_something('plan_id',array('company_id' => $this->session->userdata('company_id')));
		$this->layout->css(array(base_url().'public/css/owners.css'));
		$this->layout->view('edit', compact('aPlans','aSubscription'));
	}

	public function update()
	{
		logged_or_redirect('owners/authenticate', 'owners/profile');
		$this->subscription_model->initialize($this->input->post('select_plan_radio'),$this->session->userdata('company_id'));
		$this->subscription_model->update();
		redirect(base_url().'owners/profile');
	}
}
