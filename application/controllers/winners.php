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
			$aPromoCompetitors = $this->competitor_model->promo_users_competitor($ended_promos['id']);
			if(count($aPromoCompetitors) > 0){
				$aWinners = array();
				$iCountWinners = 0;
				while(count($aWinners) < intval($ended_promos['number_winners'])){
					$key = array_rand($aPromoCompetitors);
					if(in_array($key,$aWinners) === false){
						if($this->winner_model->save_winner($aPromoCompetitors[$key]['id']) === true){
							$aWinners[] = $key;
							$this->promo_model->update_ended_promo($aPromoCompetitors[$key]['promo_id'], 1);
						}
					}
				}
			}
		}
			
			
	}

}