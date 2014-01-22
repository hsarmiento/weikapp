<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Owner_model extends CI_Model
{
	private $names;
	private $last_name;
	private $email;
	private $password;

	public function __construct()
    {
        parent::__construct();
    }

    public function initialize($sNames,$sLastName,$sEmail,$sPassword)
    {
    	$this->names = $sNames;
		$this->last_name = $sLastName;
		$this->email = $sEmail;
		$this->password = $sPassword;
    }

    public function save()
    {
    	$aData = array('names' => $this->names, 'last_name' => $this->last_name, 'email' => $this->email, 'password' => md5($this->password));
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
}