<?php

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

}