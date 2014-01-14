<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Competitor extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();        
        $this->load->model('competitor_model');
        $this->load->library('Facebook_utils');
	}

	public function participate($iPromoId, $sCategory)
	{
		logged_or_redirect('user/login', 'competitor/participate/'.$iPromoId."/".$sCategory);
		if ($this->competitor_model->is_competitor($this->session->userdata('uid'),$iPromoId) === false && isset($iPromoId) === true)
		{			
			// guarda en la bd
			$this->competitor_model->initialize($this->session->userdata('uid'),$iPromoId);
			$this->competitor_model->save();

			if ($this->facebook_utils->allowed_publish_actions($this->session->userdata('fbuid')) === true)
			{
				// comparte en facebook
				// $aPost = array(
				// 	'message' => 'Estoy fronteando', 
				// 	'name' => 'weikapp facebook app',
				// 	'caption' => 'caption loco po ahi puee se',
				// 	'link' => 'http://www.backfront.cl',
				// 	'description' => 'pagina corporativa',
				// 	'picture' => 'http://www.backfront.cl/src_bf/logo_bf.png'
				// );
				// $result = $this->facebook_utils->post_on_user_wall($this->session->userdata('fbuid'), $aPost);
			}		
			else
			{
				echo 'DááMè PèrMííízó Pó PááJááróN máZnáátèdííghó óèzíí';
			}				
		}		
		// redirect(base_url().'promos/index/'.$sCategory.'/'.$iPromoId);
	}
}