<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
class Authlink{
	
		private $CI;
		private $token_return;
		private $random_word = 'The Big Brown Fox Jumped Over The Lazy Dog savy';
		
		public function __construct()
		{
			$this->CI =& get_instance();
		}

		private function authlink_creator()
		{
			return	sha1(md5(rand(1000,9999).sha1(md5(rand(1000,9999))))).sha1(sha1(rand(1000,9999).md5(sha1(rand(1000,9999)))));
		}
		
		private function salt_creator($data_to_salt)
		{
			return sha1(sha1($data_to_salt).sha1(md5($data_to_salt.'asdfHhHgJHGjfdhgdsjftJHsd87f6&U%^*^%')).'asdfKJH7687^HdhfnjhgU&^Hu7hdfshnkJHNK');
		}
		
		private function substr_creator($data)
		{
			return $this->salt_creator(substr($data,intval(strlen($data)/ 2)));
		}
		
		public function generate_authlink()
		{
			if($this->CI->session->userdata('authlink') == FALSE)
			{
				$authlink = substr(base64_encode($this->authlink_creator().$this->salt_creator($this->random_word.rand(100000,999999))),0,10);
				$this->CI->session->set_userdata('authlink',$authlink);
				return substr(base64_encode(md5($this->random_word.rand(100000,999999))),0,10).$authlink;
			}else{
				return substr(base64_encode(md5($this->random_word.rand(100000,999999))),0,10).$this->CI->session->userdata('authlink');
			}
		}
		
		public function verify_authlink($auth_from_link)
		{	
			return $this->substr_creator($this->CI->session->userdata('authlink')) == $this->substr_creator(substr($auth_from_link,10)) ? TRUE : FALSE;	
		}
		
		public function clear_authlink()
		{
			$this->CI->session->set_userdata('authlink','');
		}
		
		public function hash_make($x)
		{
			$hash_salt = str_pad(md5(date('h',time())),'8','---');
			foreach(range(0,7) as $num)
			{
				$data = sha1(sha1($num.$hash_salt .md5($hash_salt .$num.$this->random_word)).sha1($this->random_word.$hash_salt ).md5($x));
			}
			return $data.'.aspx';
		}
		
		/*
			@param string input to hash
			@param hashed string from link
		*/
		public function check_hash_make($i,$a)
		{
			return $this->hash_make($i) == $a ? TRUE : FALSE;
		}
		
		public function enrollment_hash_make($x)
		{
			foreach(range(0,7) as $num)
			{
				$data = sha1(sha1($num.md5($num.$this->random_word)).sha1($this->random_word).md5($x)).'.aspx';
			}
			return $data;
		}
		
}