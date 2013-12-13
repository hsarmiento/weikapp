<?php

class Category_model extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }


    public function get_categories($limit, $offset)
    {
        $this->db->select('*')
        ->from('categories')
        ->limit($limit,$offset);
        return $this->db->get()->result_array();       
    }

}