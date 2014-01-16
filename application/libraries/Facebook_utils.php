<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Facebook_utils
{
	private $CI;
	
	public function __construct()
	{
		$this->CI= get_instance();
		$this->CI->load->config('facebook_config');
		$this->CI->load->library('Facebook', array('appId' => $this->CI->config->item('appId'), 'secret' => $this->CI->config->item('appSecret')));
	}

	public function get_user_fbuid()
	{
		return $this->CI->facebook->getUser();
	}

	public function get_login_url($aOptions)
	{
		return $this->CI->facebook->getLoginUrl($aOptions);
	}

	public function get_logout_url($aUrlTo)
	{
		return $this->CI->facebook->getLogoutUrl($aUrlTo);
	}

	public function session_destroy()
	{
		$this->CI->facebook->destroySession();
	}

	public function get_permissions($iFbuid)
	{
		return $this->CI->facebook->api('/'.$iFbuid.'/permissions');
	}

	public function allowed_publish_actions($iFbuid)
	{
		$aPermissions = $this->get_permissions($iFbuid);
		if (array_key_exists('publish_actions', $aPermissions['data']['0']))
		{
			return true;
		}
		return false;
	}

	public function allowed_anything($iFbuid)
	{
		$aPermissions = $this->get_permissions($iFbuid);
		if (count($aPermissions['data']) == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function post_on_user_wall($iFbuid, $aPost)
	{
		return $this->CI->facebook->api('/'.$iFbuid.'/feed/', 'POST', $aPost);
	}
}