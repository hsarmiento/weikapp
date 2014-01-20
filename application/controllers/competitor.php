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
		$this->load->model('promo_model');
		if ($this->facebook_utils->allowed_anything($this->session->userdata('fbuid')) === false)
		{
			redirect(base_url().'user/logout');
		}
		if ($this->competitor_model->is_competitor($this->session->userdata('uid'),$iPromoId) === false && isset($iPromoId) === true)
		{
			if ($this->facebook_utils->allowed_publish_actions($this->session->userdata('fbuid')) === true)
			{
				// guarda en la bd
				$this->competitor_model->initialize($this->session->userdata('uid'),$iPromoId);
				$this->competitor_model->save();

				$aPromo = $this->promo_model->get_info_promo($iPromoId);

				// comparte en facebook
				$aPost = array(
					'message' => 'Weikapp!!! ya estoy participando por ...', 
					'name' => $aPromo['title'],
					'caption' => 'weikapp.cl',
					'link' => 'http://www.backfront.cl',
					'description' => '¡No te quedes fuera! '.$aPromo['description'],
					'picture' => 'http://www.backfront.cl/src_bf/logo_bf.png'
				);
				try{
					$post_id = $this->facebook_utils->post_on_user_wall($this->session->userdata('fbuid'), $aPost);
                }
                catch(Exception $e)
                {
                	error_log($e->getMessage());
                }				
			}		
			else
			{
				redirect(base_url().'promos/index/'.$sCategory.'/'.$iPromoId.'/permissions_denied');
			}
		}
		redirect(base_url().'promos/index/'.$sCategory.'/'.$iPromoId);
	}
}