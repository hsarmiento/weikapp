<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Winners extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('winner_model');
        $this->layout->setLayout('layout');
	}

	public function select_winners()
	{
		$this->load->helper('array');
		$this->load->model('promo_model');
		$this->load->model('competitor_model');
		$aEndedPromos = $this->promo_model->get_id_ended_promos();
		foreach ($aEndedPromos as $ended_promos) {
			$aPromoCompetitors = $this->competitor_model->get_competitors_by_promoid($ended_promos['id']);
			if(count($aPromoCompetitors) > 0){
				$aWinners = array();
				$iCountWinners = 0;
				while(count($aWinners) < intval($ended_promos['number_winners'])){
					$key = array_rand($aPromoCompetitors);
					if(in_array($key,$aWinners) === false){
						$this->winner_model->initialize($aPromoCompetitors[$key]['id']);
						if($this->winner_model->save_winner() === true){
							$aWinners[] = $key;
							$this->promo_model->update_ended_promo($aPromoCompetitors[$key]['promo_id'], 1);
						}
					}
				}
			}
		}			
	}


	public function show_winners($iPromoId, $sIsNotified = null)
	{
		//mas adelante hay que verificar que este controlador lo habra solamente
		//el dueño de la promo y que el promoid no este vacio para redirigir a otra pagina
		$aWinners = $this->winner_model->get_promo_winners($iPromoId);
		$this->layout->setTitle('Ganadores');
		$this->layout->view('show_winners', compact("aWinners", 'iPromoId', 'sIsNotified'));

	}

	public function notify_winners($iPromoId)
	{
		//mas adelante se debe verificar que el promoid no este vacio para redirigir a otra pagina

		$this->load->model('user_model');
		$this->CI= get_instance();
		$this->load->library('curl');
		$this->load->library('rest');
		$aWinners = $this->winner_model->get_promo_winners($iPromoId);
		foreach ($aWinners as $winner) {
			$fb_uid = $this->user_model->get_fbuid_by_userid($winner['user_id']);
			$config = array('server' => 'https://graph.facebook.com/'.$fb_uid.'/notifications');
			$this->rest->initialize($config);
			$oResponseNotify= $this->rest->post('', array('access_token' => $this->CI->config->item('accessToken'), 'template' => 'john wayne'));
			if(!empty($oResponseNotify->success) && $oResponseNotify->success === true){
				$this->winner_model->initialize(null, date('Y-m-d H:i:s',(time())));
				$this->winner_model->update_notified_at($winner['winner_id']);
			}
		}
		redirect(base_url().'winners/show_winners/'.$iPromoId.'/is_notified');
	}

}