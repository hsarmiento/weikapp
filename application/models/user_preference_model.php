<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_preference_model extends CI_Model
{

	public function __construct()
    {
        parent::__construct();
    }

    public function get_user_preferences($iUserId)
    {
        $this->db->select('t2.id as category_id,t2.name as category_name')
        ->from('user_preferences as t1')
        ->join('categories as t2','t1.category_id = t2.id', 'right')
        ->where('t1.user_id', $iUserId)
        ->order_by('name asc');
        return $this->db->get()->result_array();
    }

    public function delete_all_user_preferences($iUserId)
    {
    	$result = $this->db->delete('user_preferences',array('user_id' => $iUserId));
    	return $result;
    }
}