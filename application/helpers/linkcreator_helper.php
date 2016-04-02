<?php
//__link(1,2,3,4,5,6)
if(!function_exists('__link'))
{
	function __link()
	{
		// get CI Instance
		$ci =& get_instance();

		$data = array_map(function($x){
			return intval($x);
		},func_get_args());
		
		return $ci->hs->encrypt($data);
	}
}
//__link_array([1,2,3,4,5,6])
if(!function_exists('__link_array'))
{
	function __link_array($array = '')
	{
		// get CI Instance
		$ci =& get_instance();

		$data = array_map(function($x){
			return intval($x);
		},$array);
		
		return $ci->hs->encrypt($data);
	}
}

if(!function_exists('_secure_link'))
{
	function _secure_link($hash = '')
	{
		$CI =& get_instance();
		$x = $CI->hs->decrypt($hash);
		// return $x;
		if(!empty($x))
		{
			$d['e_id'] = $x[0];
			$d['time'] = $x[1];
			
			if(date('m-d-y',$d['time']) == date('m-d-y') && $e_id !== FALSE)
			{
				return (object)$d;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
}
