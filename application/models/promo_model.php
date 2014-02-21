<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promo_model extends CI_Model {

    private $company_id;
    private $title;
    private $description;
    private $terms;
    private $start_datetime;
    private $end_datetime;
    private $number_participants;
    private $number_winners;
    private $image;
    private $township_id;
    private $ended;


    public function __construct()
    {
        parent::__construct();
    }

    public function initialize($iCompanyId, $sTitle, $sDescription, $sTerms, $dStartDatetime, $dEndDatetime, $iParticipants, $iWinners, $iImage, $iTownShipId, $iEnded = 0)
    {
        $this->company_id = $iCompanyId;
        $this->title = $sTitle;
        $this->description = $sDescription;
        $this->terms = $sTerms;
        $this->start_datetime = $dStartDatetime;
        $this->end_datetime = $dEndDatetime;
        $this->number_participants = $iParticipants;
        $this->number_winners = $iWinners;
        $this->image = $iImage;
        $this->township_id = $iTownShipId;
        $this->ended = $iEnded;
    }

    public function get_promos($limit, $offset,$category)
    {
        $query = $this->db->query('select t3.*,t6.name as company_name, DATEDIFF(t3.end_datetime,CURDATE()) AS remaining_days, HOUR(TIMEDIFF(TIME(t3.end_datetime),CURTIME())) AS remaining_hours from categories as t1 join promo_categories as t2 on t1.id = t2.category_id join promos as t3 on t2.promo_id = t3.id join companies as t6 on t3.company_id = t6.id where t1.name = "'.$category.'" and t3.start_datetime <= now() and t3.end_datetime > now() order by start_datetime desc limit '.$offset.','.$limit);
        return $query->result_array();
    }

    public function get_info_promo($promo_id)
    {
    	$this->db->select('*')
    	->from('promos')
    	->where('id', $promo_id);
    	$aResult = $this->db->get()->row_array();
        return $aResult;
    }

    public function get_favorite_promos($iLimit, $iOffset, $iUserId)
    {
        $query = $this->db->query('select t5.*,t6.name as company_name, DATEDIFF(t5.end_datetime,CURDATE()) AS remaining_days, HOUR(TIMEDIFF(TIME(t5.end_datetime),CURTIME())) from users as t1 join user_preferences as t2 on t1.id = t2.user_id join categories as t3 on t2.category_id = t3.id join promo_categories as t4 on t3.id = t4.category_id join promos as t5 on t4.promo_id = t5.id join companies as t6 on t5.company_id = t6.id where t1.id = '.$iUserId.' order by t5.start_datetime desc limit '.$iOffset.','.$iLimit);
        return $query->result_array(); 
    }

    public function get_newest_promos($iLimit, $iOffset)
    {
        $query = $this->db->query('select t1.*,t2.name as company_name, DATEDIFF(t1.end_datetime,CURDATE()) AS remaining_days, HOUR(TIMEDIFF(TIME(t1.end_datetime),CURTIME())) from promos AS t1 join companies AS t2 ON t1.company_id = t2.id order by start_datetime desc limit '.$iOffset.','.$iLimit);
        return $query->result_array();
    }

    public function get_id_ended_promos()
    {
        $query = $this->db->query('select id,number_winners from promos where ended = 0 and end_datetime <= now() and start_datetime < now();');
        return $query->result_array();
    }

    public function update_ended_promo($iPromoid, $iEnded)
    {
        $aData = array('ended' => $iEnded);
        $this->db->where('id', $iPromoid);
        $this->db->update('promos',$aData);
        if($this->db->affected_rows() == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_fields_with_limits($sFields,$aWhere,$iLimit,$iOffset,$sOrdeBy = 'id asc')
    {
        $this->db->select($sFields)
        ->from('promos')
        ->where($aWhere)
        ->order_by($sOrdeBy) 
        ->limit($iLimit,$iOffset);
        $aResult = $this->db->get()->result_array();
        return $aResult;
    }

    public function get_row_fields($sFields,$aWhere, $sOrdeBy = 'id asc')
    {
        $this->db->select($sFields)
        ->from('promos')
        ->where($aWhere)
        ->order_by($sOrdeBy);
        $aResult = $this->db->get()->row_array();
        return $aResult;
    }

    public function save()
    {
        $aData = array('company_id' => $this->company_id, 'title' => $this->title, 'description' => $this->description, 'terms'=> $this->terms, 'start_datetime' => $this->start_datetime, 'end_datetime' => $this->end_datetime, 'number_participants' => $this->number_participants, 'number_winners' => $this->number_winners, 'image' => $this->image, 'township_id' => $this->township_id,'ended' => $this->ended);
        $this->db->insert('promos',$aData);
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