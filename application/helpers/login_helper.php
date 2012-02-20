<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('verifyLoggedIn'))
{
	function verifyLoggedIn($sTargetUrl = '')
	{
		$CI =& get_instance();
		
		if($CI->session->userdata('userid')<=0)
		{
			if($sTargetUrl != '') $CI->session->set_userdata('TargetUrl', $sTargetUrl);
			redirect('api/login', 'location');
		}
	}
	
	if ( ! function_exists('checkPermission'))
	{
		function checkPermission($iTypid)
		{
			$CI = &get_instance();
			
			if($CI->session->userdata('typeid') == $iTypid || $CI->session->userdata('typeid') == 3)
			{
				
			}
			else
			{
				redirect('api/viewnews', 'location');
			}
		}
		
	}
}



/* End of file login_helper.php */
/* Location: ./system/helpers/url_helper.php */