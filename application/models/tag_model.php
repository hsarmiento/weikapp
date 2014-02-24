<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag_model extends CI_Model {

    private $promo_id;
    private $text;

    public function __construct()
    {
        parent::__construct();
    }

    public function initialize($iPromoId, $sText)
    {
        $this->promo_id = $iPromoId;
        $this->text = $sText;
    }

    public function save()
    {
        $aData = array('promo_id' => $this->promo_id, 'text' => $this->text);
        $this->db->insert('tags',$aData);
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