<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_auth
{
	private $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	// redirects page to specified controller only
	public function secure_page()
	{
		if($usertype !== FALSE )
		{
			if($this->CI->session->userdata('logged_in'))
			{
				$this->CI->disable_browser_cache = TRUE;
				$current_session = $this->CI->session->userdata('userType');
				if(is_array($usertype))
				{
					if(in_array($current_session,$usertype))
					{
						return TRUE;
					}else{
						redirect($current_session);
					}
				}else{
					if($usertype == $current_session OR strtolower($usertype) == 'all')
					{
						return TRUE;
					}else{
						redirect($current_session);
					}
				}
			}
			else
			{
				$this->CI->disable_browser_cache = TRUE;
				$this->CI->_msg('n','Your session has expired. please login again','auth/login/');
			}
		}else{
			if($this->CI->session->userdata('logged_in') == FALSE)
			{
				redirect();
			}else{
			
			}
		}
	}
	
	
	public function secure_welcome_page()
	{
		if($this->CI->session->userdata('logged_in') === TRUE)
		{
			redirect($this->CI->session->userdata('userType'));
		}
	}
	
	public function secure_output_page()
	{
		if($this->CI->session->userdata('logged_in') === FALSE)
		{
			show_404();
		}
	}
	
	
	
}