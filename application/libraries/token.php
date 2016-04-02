<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class token
{
	private $ci;
	public function __construct()
	{
		$this->ci =& get_instance();
	}
	public function set_token()
	{	
		if($this->get_token() == NULL OR $this->get_token() == FALSE OR $this->get_token() == '')
		{
			$this->ci->session->set_userdata('form_token',$this->random_hash());
		}
	}
	
	public function random_hash()
	{		$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		$string = time().rand(1000,9999).sha1(rand(1000,9999)); 
		$secure = hash('sha256',$string.$salt).sha1($string.$salt).sha1($string);		return substr($secure,rand(5,10),32);	}
	
	public function get_token()
	{
		return $this->ci->session->userdata('form_token');
	}
	
	public function validate_token($token)
	{
		return $this->ci->session->userdata('form_token') == $token ? TRUE : FALSE;
	}

	public function destroy_token()
	{
		$this->ci->session->set_userdata('form_token','');
	}
}