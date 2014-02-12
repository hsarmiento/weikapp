<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

    public function get_fields_by_something($sFields,$aWhere)
    {
        $this->db->select($sFields)
        ->from('plans')
        ->where($aWhere);
        $aResult = $this->db->get()->result_array();
        return $aResult;
    }
}