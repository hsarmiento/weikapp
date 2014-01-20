<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	private $fb_uid;
	private $names;
	private $last_name;
	private $email;
    private $gender;
    private $fb_username;
	private $created_at;

	public function __construct()
    {
        parent::__construct();
    }

    public function initialize($iFbid,$sNames,$sLastName,$sEmail,$sGender,$sFbUsername)
    {
    	$this->fb_uid = $iFbid;
		$this->names = $sNames;
		$this->last_name = $sLastName;
		$this->email = $sEmail;
        $this->gender = $sGender;
        $this->fb_username = $sFbUsername;
		$this->created_at = date('Y-m-d H:i:s',(time())+(10800));
    }

    public function exist_fbuid($iFbuid)
    {
    	$query = $this->db->get_where('users',array('fb_uid' => $iFbuid));
    	if ($query->num_rows() > 0)
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function save()
    {
    	$aData = array('fb_uid' => $this->fb_uid, 'names' => $this->names, 'last_name' => $this->last_name,	'email' => $this->email, 'gender' => $this->gender, 'fb_username' => $this->fb_username,'created_at' => $this->created_at);
    	$this->db->insert('users',$aData);
    	if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
        	return false;
        }
    }

    public function get_user_fb_data($iUserId)
    {
    	$this->config->load('facebook_config');
		// $this->load->library('Facebook', array('appId' => $this->config->item('appId'), 'secret' => $this->config->item('appSecret')));

		if ($iUserId)
		{
			$sFqlQuery = 'SELECT first_name, last_name, email, sex, username FROM user WHERE uid = '.$iUserId.';';
			$aOptions = array(
				'method' => 'fql.query',
				'query' => $sFqlQuery,
				'callback' => ''
			);
			$aResult = $this->facebook_utils->execute_fql_query($aOptions);
			return $aResult;
		}
    }

    public function get_uname_by_fbuid($iFbuid)
    {
        $this->db->select('*')
        ->from('users')
        ->where('fb_uid', $iFbuid);
        $aQuery = $this->db->get()->row_array();
        return $aQuery['names'];
    }

    public function get_userid_by_fbuid($iFbuid)
    {
        $this->db->select('id')
        ->from('users')
        ->where('fb_uid',$iFbuid);
        $aQuery = $this->db->get()->row_array();
        return $aQuery['id'];
    }

    public function get_user_data_by_id($iUserid)
    {
        $this->db->select('names,last_name,email')
        ->from('users')
        ->where('id',$iUserid);
        $aRow = $this->db->get()->row_array();
        return $aRow;
    }

    public function update_user_data($iUserid)
    {
        $data = array(
                'names' => $this->names,
                'last_name' => $this->last_name,
                'email' => $this->email
            );
        $this->db->where('id', $iUserid);
        $this->db->update('users',$data);
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
