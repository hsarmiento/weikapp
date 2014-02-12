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

    public function get_plan_by_company_id($iCompanyId)
    {
        $aRow = $this->db->query('SELECT t1.plan_id,t1.company_id,t2.id,t2.name FROM subscriptions AS t1 JOIN plans AS t2 ON t1.plan_id = t2.id AND t1.company_id = '.$iCompanyId.';')
        ->row_array();
        return $aRow;
    }

    public function get_fields_by_something($sFields,$aWhere)
    {
        $this->db->select($sFields)
        ->from('subscriptions')
        ->where($aWhere);
        $aResult = $this->db->get()->result_array();
        return $aResult;
    }

    public function update()
    {
        $data = array(
                'plan_id' => $this->plan_id,
                'updated_at' => date('Y-m-d H:i:s',(time()))
            );
        $this->db->where('company_id', $this->company_id);
        $this->db->update('subscriptions',$data);
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