<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription_model extends CI_Model
{
	private $plan_id;
	private $company_id;
	private $created_at;

	public function __construct()
    {
        parent::__construct();
    }

    public function initialize($iPlanId,$iCompanyId)
    {
    	$this->plan_id = $iPlanId;
		$this->company_id = $iCompanyId;
		$this->created_at = date('Y-m-d H:i:s',(time()));
    }

    public function save()
    {
    	$aData = array('plan_id' => $this->plan_id, 'company_id' => $this->company_id, 'created_at' => $this->created_at);
    	$this->db->insert('subscriptions',$aData);
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