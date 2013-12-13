<?php

class Promo_model extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }


    public function get_promos($limit, $offset)
    {
        $this->db->select('*')
        ->from('promos')
        ->limit($limit,$offset);
        return $this->db->get()->result_array();       
    }

}