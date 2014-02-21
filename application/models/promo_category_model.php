<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promo_category_model extends CI_Model {

    private $promo_id;
    private $category_id;

    public function __construct()
    {
        parent::__construct();
    }

    public function initialize($iPromoId, $iCategoryId)
    {
        $this->promo_id = $iPromoId;
        $this->category_id = $iCategoryId;
    }

    public function save()
    {
        $aData = array('promo_id' => $this->promo_id, 'category_id' => $this->category_id);
        $this->db->insert('promo_categories',$aData);
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