<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	private $fb_uid;
	private $names;
	private $last_name;
	private $city;
	private $email;
	private $created_at;

	public function __construct()
    {
        parent::__construct();
    }

    public function initialize($iFbid,$sNames,$sLastName,$sEmail)
    {
    	$this->fb_uid = $iFbid;
		$this->names = $sNames;
		$this->last_name = $sLastName;
		// $this->city = $sCity;
		$this->email = $sEmail;
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
    	$aData = array('fb_uid' => $this->fb_uid, 'names' => $this->names, 'last_name' => $this->last_name,	'email' => $this->email, 'created_at' => $this->created_at);
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
		$this->load->library('Facebook', array('appId' => $this->config->item('appId'), 'secret' => $this->config->item('appSecret')));

		if ($iUserId)
		{
			$sFqlQuery = 'SELECT first_name, last_name, email FROM user WHERE uid = '.$iUserId.';';
			$aOptions = array(
				'method' => 'fql.query',
				'query' => $sFqlQuery,
				'callback' => ''
			);
			$aResult = $this->facebook->api($aOptions);            
			return $aResult;
		}
    }

    public function get_user_name($iUserId)
    {
        $this->db->select('*')
        ->from('users')
        ->where('fb_uid', $iUserId);
        $aQuery = $this->db->get()->row_array();
        return $aQuery['names'];
    }
    
}
