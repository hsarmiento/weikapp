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

	public function participate($iPromoId, $sCategory)
	{
		logged_or_redirect('user/login', 'competitor/participate/'.$iPromoId."/".$sCategory);		
		if ($this->competitor_model->is_competitor($this->session->userdata('uid'),$iPromoId) === false && isset($iPromoId) === true)
		{			
			// guarda en la bd
			$this->competitor_model->initialize($this->session->userdata('uid'),$iPromoId);
			$this->competitor_model->save();			
			// comparte en facebook
			$aPost = array(
				'message' => 'Estoy participando en un concurso nítido', 
				'name' => 'weikapp facebook app',
				'caption' => 'caption loco po ahi puee se',
				'link' => 'http://www.backfront.cl',
				'description' => 'pagina corporativa',  
				'picture' => 'http://www.backfront.cl/src_bf/logo_bf.png'
			);			
			$result = $this->facebook->api('/'.$this->session->userdata('fbuid').'/feed/', 'post', $aPost);		
		}		
		redirect(base_url().'promos/index/'.$sCategory.'/'.$iPromoId);
	}
}