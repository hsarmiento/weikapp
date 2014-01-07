<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Competitor extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();        
        $this->load->model('competitor_model');
	}

	public function participate($iPromoId, $sCategory)
	{
		logged_or_redirect('user/login', 'competitor/participate/'.$iPromoId."/".$sCategory);
		
		if ($this->competitor_model->is_competitor($this->session->userdata('uid'),$iPromoId) === false && isset($iPromoId) === true)
		{
			$this->competitor_model->initialize($this->session->userdata('uid'),$iPromoId);
			$this->competitor_model->save();
		}

		redirect(base_url().'promos/index/'.$sCategory.'/'.$iPromoId);
	}
}