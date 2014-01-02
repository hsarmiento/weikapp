<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Competitor_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

    public function initialize()
    {
    	
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

    }

    public function count_promo_competitors($promo_id)
    {
        $this->db->select('*')
        ->from('competitors')
        ->where('promo_id',$promo_id);
        return $this->db->count_all_results();
    }
}