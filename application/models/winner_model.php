<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Winner_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

    public function save_winner($iCompetitorId)
    {
    	$aData = array('competitor_id' => $iCompetitorId);
    	$this->db->insert('winners',$aData);
    	if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
        	return false;
        }
    }

    public function get_promo_winners($iPromoId)
    {
        $this->db->select('t3.id as user_id, t3.names as names, t3.last_name as last_name, t3.fb_uid as fb_uid, t1.notified as notified')
        ->from('winners as t1')
        ->join('competitors as t2', 't1.competitor_id = t2.id')
        ->join('users as t3', 't2.user_id = t3.id')
        ->where('t2.promo_id', $iPromoId);
        return $this->db->get()->result_array();
    }
}


