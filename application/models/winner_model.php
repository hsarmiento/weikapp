<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Winner_model extends CI_Model
{

    private $competitor_id;
    private $created_at;
    private $notified_at;
    private $accepted_at;

	public function __construct()
    {
        parent::__construct();
    }

    public function initialize($iCompetitorId, $dNotified_at = '0000-00-00 00:00:00', $dAccepted_at = '0000-00-00 00:00:00')
    {
        $this->competitor_id = $iCompetitorId;
        $this->created_at = date('Y-m-d H:i:s',(time())+(10800));
        $this->notified_at = $dNotified_at;
        $this->accepted_at = $dAccepted_at;
    }


    public function save_winner()
    {
    	$aData = array('competitor_id' => $this->competitor_id);
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
        $this->db->select('t1.id as winner_id, t3.id as user_id, t3.names as names, t3.last_name as last_name, t3.fb_uid as fb_uid, t1.notified_at as notified_at')
        ->from('winners as t1')
        ->join('competitors as t2', 't1.competitor_id = t2.id')
        ->join('users as t3', 't2.user_id = t3.id')
        ->where('t2.promo_id', $iPromoId);
        return $this->db->get()->result_array();
    }

    public function update_notified_at($iWinnerId)
    {
        $data = array('notified_at' => $this->notified_at);
        $this->db->where('id', $iWinnerId);
        $this->db->update('winners',$data);
        if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update_accepted_at($iWinnerId)
    {
        $data = array('accepted_at' => $this->accepted_at);
        $this->db->where('id', $iWinnerId);
        $this->db->update('winners',$data);
        if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_user_data_winner($iWinnerId)
    {
        //  obtener datos de usuario y promo a desplegar en canvas de facebook
        $this->db->select('t1.id as winner_id, t2.promo_id as promo_id, t2.user_id as user_id, t3.names as names, t3.last_name as last_name,t3.fb_uid as fb_uid, t4.title as promo_title')
        ->from('winners as t1')
        ->join('competitors as t2', 't1.competitor_id = t2.id')
        ->join('users as t3', 't2.user_id = t3.id')
        ->join('promos as t4', 't2.promo_id = t4.id')
        ->where('t1.id', $iWinnerId);
        return $this->db->get()->row_array();

    }
}


