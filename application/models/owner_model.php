<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Owner_model extends CI_Model
{
	private $names;
	private $last_name;
	private $email;
	private $password;
    private $hash;

	public function __construct()
    {
        parent::__construct();
    }

    public function initialize($sNames,$sLastName,$sEmail,$sPassword,$sHash)
    {
    	$this->names = $sNames;
		$this->last_name = $sLastName;
		$this->email = $sEmail;
		$this->password = $sPassword;
        $this->hash = $sHash;
    }

    public function save()
    {
    	$aData = array('names' => $this->names, 'last_name' => $this->last_name, 'email' => $this->email, 'password' => md5($this->password), 'hash' => $this->hash);
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
}