<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Competitor extends CI_Controller 
{
	public function participate()
	{
		logged_or_redirect('user/login', 'competitor/participate');
		redirect(base_url().'promos/ajax_load_dialog_promo/2');
	}
}