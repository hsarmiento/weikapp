<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Owner_model extends CI_Model
{
    private $fb_uid;
	private $names;
	private $last_name;
	private $email;
	private $password;
    private $hash;
    private $created_at;
    private $activated_at;

	public function __construct()
    {
        parent::__construct();
    }

    public function initialize($sNames,$sLastName,$sEmail,$sPassword = NULL,$sHash = NULL,$iFbuid = NULL)
    {
        $this->fb_uid = $iFbuid;
    	$this->names = $sNames;
		$this->last_name = $sLastName;
		$this->email = $sEmail;
		$this->password = $sPassword;
        $this->hash = $sHash;
        $this->created_at = date('Y-m-d H:i:s',(time()));
        $this->activated_at = date('Y-m-d H:i:s',(time()));
    }

    public function save()
    {
    	$aData = array('names' => $this->names, 'last_name' => $this->last_name, 'email' => $this->email, 'password' => md5($this->password), 'hash' => $this->hash, 'created_at' => $this->created_at);
    	$this->db->insert('owners',$aData);
    	if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
        	return false;
        }
    }

    public function save_from_facebook()
    {
        $aData = array('names' => $this->names, 'last_name' => $this->last_name, 'email' => $this->email, 'fb_uid' => $this->fb_uid, 'created_at' => $this->created_at, 'activated_at' => $this->activated_at);
        $this->db->insert('owners',$aData);
        if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function validate_email($sEmail,$sHash)
    {
        $aWhere = array('email' => $sEmail, 'hash' => $sHash, 'activated_at' => 'NULL');
        $this->db->select('email,hash,activated_at')
        ->from('owners')
        ->where($aWhere);
        $this->db->get();
        return $this->db->count_all_results();
    }

    public function get_password_by_email($sPassword)
    {
        $this->db->select('password')
        ->from('owners')
        ->where('email', $sPassword);
        $aResult = $this->db->get()->row_array();
        return $aResult;
    }

    public function get_id_by_email($sEmail)
    {
        $this->db->select('id')
        ->from('owners')
        ->where('email', $sEmail);
        $aResult = $this->db->get()->row_array();
        return $aResult;
    }

    public function get_names_by_id($iOwnerId)
    {
        $this->db->select('names')
        ->from('owners')
        ->where('id', $iOwnerId);
        $aResult = $this->db->get()->row_array();
        return $aResult;
    }

    public function exist_fbuid($iFbuid)
    {
        $query = $this->db->get_where('owners',array('fb_uid' => $iFbuid));
        if ($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_user_fb_data($iFbuid)
    {
        $this->config->load('facebook_config');

        if ($iFbuid)
        {
            $sFqlQuery = 'SELECT first_name, last_name, email FROM user WHERE uid = '.$iFbuid.';';
            $aOptions = array(
                'method' => 'fql.query',
                'query' => $sFqlQuery,
                'callback' => ''
            );
            $aResult = $this->facebook_utils->execute_fql_query($aOptions);
            return $aResult;
        }
    }

    public function get_userid_by_fbuid($iFbuid)
    {
        $this->db->select('id')
        ->from('owners')
        ->where('fb_uid',$iFbuid);
        $aQuery = $this->db->get()->row_array();
        return $aQuery['id'];
    }
}