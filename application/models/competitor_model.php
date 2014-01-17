<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Competitor_model extends CI_Model
{
    private $user_id;
    private $promo_id;
    private $status;
    private $created_at;

	public function __construct()
    {
        parent::__construct();
    }

    public function initialize($iUserId,$iPromoId)
    {
    	$this->user_id = $iUserId;
        $this->promo_id = $iPromoId;
        $this->status = 0;
        $this->created_at = date('Y-m-d H:i:s',(time())+(10800));
    }

    public function is_competitor($iUserId,$iPromoId)
    {
    	$query = $this->db->get_where('competitors',array('user_id' => $iUserId, 'promo_id' => $iPromoId));
    	if ($query->num_rows() > 0)
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function save()
    {
        $aData = array('user_id' => $this->user_id, 'promo_id' => $this->promo_id, 'status' => $this->status, 'created_at' => $this->created_at);
        $this->db->insert('competitors',$aData);
        if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function count_promo_competitors($promo_id)
    {
        $this->db->select('*')
        ->from('competitors')
        ->where('promo_id',$promo_id);
        return $this->db->count_all_results();
    }

    public function user_promos_competitor($iUserId)
    {
        #get promotions user that participate
        $query = $this->db->query("SELECT t1.created_at as participate_created_at, t2.id as promo_id, t2.title as promo_title, t2.end_datetime as promo_end_datetime, t3.id as winner_id from competitors as t1 join promos as t2 on t1.promo_id = t2.id left join winners as t3 on t1.id = t3.competitor_id where t1.user_id = $iUserId order by t1.created_at desc;");
        return $query->result_array();
    }

    public function promo_users_competitor($iPromoId)
    {
        #get users promos that participate
        $this->db->select('*')
        ->from('competitors')
        ->where('promo_id', $iPromoId);
        return $this->db->get()->result_array();
    }

}