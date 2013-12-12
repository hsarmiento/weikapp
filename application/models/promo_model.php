<?php

class Promo_model extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }


    public function get_promos($limit, $offset)
    {
        $query = $this->db->query('select t1.* from promos as t1 where t1.start_datetime <= now() and t1.end_datetime > now() order by start_datetime desc limit '.$offset.','.$limit );
        return $query->result_array();     
    }

}