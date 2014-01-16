<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }


    public function get_all_categories(){
        $this->db->select('*')
        ->from('categories')
        ->order_by('name asc');
        return $this->db->get()->result_array();
    }
}