<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('is_logged'))
{
	function is_logged()
	{
		$CI =& get_instance();
    	$bLoggedIn = $CI->session->userdata('logged_in');    	
       	if(!isset($bLoggedIn) || $bLoggedIn !== TRUE)
		{
			return FALSE;
		}
		return TRUE;
	}
}

if (!function_exists('logged_or_redirect'))
{
	function logged_or_redirect($sUrlTo,$sUrlFrom)
	{		
       	if(is_logged() === FALSE)
		{
			$CI =& get_instance();
			$CI->session->set_flashdata('urlFrom', $sUrlFrom);
			redirect(base_url().$sUrlTo);
			return FALSE;
		}
		return TRUE;
	}
}