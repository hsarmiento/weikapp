<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Township_model extends CI_Model {

    private $name;
    private $type;

    public function __construct()
    {
        parent::__construct();
    }

    public function initialize($sName, $iType = 1)
    {
        $this->name = $sName;
        $this->type = $iType;
    }

    public function save()
    {
        $aData = array('name' => $this->name, 'type' => $this->type);
        $this->db->insert('townships',$aData);
        if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_townships()
    {
        $this->db->select('*')
        ->from('townships')
        ->order_by('type asc,name asc');
        return $this->db->get()->result_array();
    }

    public function get_township($order_by = 'id asc'){
        $this->db->select('*')
        ->from('townships')
        ->order_by($order_by);
        return $this->db->get()->row_array();
    }

}