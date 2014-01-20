<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promo_model extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }


    public function get_promos($limit, $offset,$category)
    {
        $query = $this->db->query('select * from categories as t1 join promo_categories as t2 on t1.id = t2.category_id join promos as t3 on t2.promo_id = t3.id where t1.name = "'.$category.'" and t3.start_datetime <= now() and t3.end_datetime > now() order by start_datetime desc limit '.$offset.','.$limit);
        return $query->result_array();     
    }

    public function get_info_promo($promo_id)
    {
    	$this->db->select('*')
    	->from('promos')
    	->where('id', $promo_id);
    	$aResult = $this->db->get()->row_array();
        return $aResult;
    }

    public function get_favorite_promos($iLimit, $iOffset, $iUserId)
    {
        $query = $this->db->query('select * from users as t1 join user_preferences as t2 on t1.id = t2.user_id join categories as t3 on t2.category_id = t3.id join promo_categories as t4 on t3.id = t4.category_id join promos as t5 on t4.promo_id = t5.id where t1.id = '.$iUserId.' order by t5.start_datetime desc limit '.$iOffset.','.$iLimit);
        return $query->result_array(); 
    }

    public function get_id_ended_promos()
    {
        $query = $this->db->query('select id,number_winners from promos where ended = 0 and end_datetime <= now() and start_datetime < now();');
        return $query->result_array();
    }

    public function update_ended_promo($iPromoid, $iEnded)
    {
        $aData = array('ended' => $iEnded);
        $this->db->where('id', $iPromoid);
        $this->db->update('promos',$aData);
        if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}