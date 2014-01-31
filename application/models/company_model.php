<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model
{
	private $owner_id;
	private $fb_pid;
	private $name;
	private $created_at;

	public function __construct()
    {
        parent::__construct();
    }

    public function initialize($iOwnerId,$iFbpid,$sName)
    {
    	$this->owner_id = $iOwnerId;
		$this->fb_pid = $iFbpid;
		$this->name = $sName;
		$this->created_at = date('Y-m-d H:i:s',(time()));
    }

    public function save()
    {
    	$aData = array('owner_id' => $this->owner_id, 'fb_pid' => $this->fb_pid, 'name' => $this->name, 'created_at' => $this->created_at);
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
}
