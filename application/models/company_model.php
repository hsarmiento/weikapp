<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model
{
	private $owner_id;
	private $fb_pid;
	private $name;
    private $city;
    private $fanpage_fb;
	private $created_at;

	public function __construct()
    {
        parent::__construct();
    }

    public function initialize($iOwnerId,$iFbpid,$sName,$sCity = NULL, $sFanpage = NULL)
    {
    	$this->owner_id = $iOwnerId;
		$this->fb_pid = $iFbpid;
		$this->name = $sName;
        $this->city = $sCity;
        $this->fanpage_fb = $sFanpage;
		$this->created_at = date('Y-m-d H:i:s',(time()));
    }

    public function save()
    {
    	$aData = array('owner_id' => $this->owner_id, 'fb_pid' => $this->fb_pid, 'name' => $this->name, 'city'=> $this->city, 'fanpage_fb' => $this->fanpage_fb, 'created_at' => $this->created_at);
    	$this->db->insert('companies',$aData);
    	if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
        	return false;
        }
    }

    public function get_all_fbpid_by_ownerid($iOwnerId)
    {
    	$this->db->select('fb_pid')
        ->from('companies')
        ->where('owner_id', $iOwnerId);
        $aResult = $this->db->get()->result_array();
        return $aResult;
    }

    public function get_fields_by_something($sFields,$aWhere)
    {
        $this->db->select($sFields)
        ->from('companies')
        ->where($aWhere);
        $aResult = $this->db->get()->result_array();
        return $aResult;
    }

    public function get_row_by_something($sFields,$aWhere)
    {
        $this->db->select($sFields)
        ->from('companies')
        ->where($aWhere);
        $aResult = $this->db->get()->row_array();
        return $aResult;
    }

    public function get_fields_with_limits($sFields,$aWhere,$iLimit,$iOffset,$sOrdeBy = 'id asc')
    {
        $this->db->select($sFields)
        ->from('companies')
        ->where($aWhere)
        ->order_by($sOrdeBy) 
        ->limit($iLimit,$iOffset);
        $aResult = $this->db->get()->result_array();
        return $aResult;
    }
}
