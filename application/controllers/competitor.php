<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Competitor extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();        
        $this->load->model('competitor_model');
        $this->load->config('facebook_config');
		$this->load->library('Facebook', array('appId' => $this->config->item('appId'), 'secret' => $this->config->item('appSecret')));
	}

	public function participate($iPromoId)
	{
		logged_or_redirect('user/login', 'competitor/participate/'.$iPromoId);
		
		if ($this->competitor_model->is_competitor($this->session->userdata('uid'),$iPromoId) === false && isset($iPromoId) === true)
		{
			// guarda en la bd
			$this->competitor_model->initialize($this->session->userdata('uid'),$iPromoId);
			$this->competitor_model->save();

			// comparte en facebook
			$aPost = array(
				'message' => 'Estoy participando por maracas', 
				'name' => 'bf facebook app',
				'caption' => 'caption loco po ahi puee se',
				'link' => 'http://www.backfront.cl',
				'description' => 'pagina corporativa',  
				'picture' => 'http://www.backfront.cl/src_bf/logo_bf.png'
			);
			$result = $this->facebook->api('/me/feed/', 'post', $aPost);
		}

		redirect(base_url().'promos/ajax_load_dialog_promo/'.$iPromoId);
	}
}