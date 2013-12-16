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
	function logged_or_redirect($sUrl)
	{		
       	if(is_logged() === FALSE)
		{			
			redirect(base_url().$sUrl);
			return FALSE;
		}
		return TRUE;
	}
}