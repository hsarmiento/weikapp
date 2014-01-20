<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Winner_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

    public function save_winner($iCompetitorId)
    {
    	$aData = array('competitor_id' => $iCompetitorId);
    	$this->db->insert('winners',$aData);
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


