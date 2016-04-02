<?php
class MY_AdminController Extends CI_Controller
{

	var $session_user;
	var $disable_browser_cache = FALSE;
	var $other_assets = array();
	
	protected $layout_view = '_admin_layout';
  protected $content_view ='';
  protected $view_data = array();
	protected $page_title = 'Online Based Cource management System';
	
	public function __construct()
	{
		parent::__construct();
		
		// config the encryption key for session
		$this->config->set_item('encryption_key', 'nVjS2&*(34dkgsuIvna12*(Encs$6vGs');
		// initializes no cache function		
		$this->disable_browser_cache($this->disable_browser_cache);

		$this->load->model('M_profile','mp');
		
		if(config_item('profiler') === TRUE){ 
			$this->output->enable_profiler(TRUE);
		}
	}
	
	public function _output($output)
    {
		//elapsed_time and memory_usage to show in views
        $this->view_data['title'] = @$this->page_title;
		if($this->content_view !== FALSE && empty($this->content_view)) $this->content_view = $this->router->class . '/' . $this->router->method;
		
			$yield = file_exists(APPPATH . 'views/' . $this->content_view . EXT) ? $this->load->view($this->content_view, $this->view_data, TRUE) : FALSE ;
		
		if($this->layout_view)
		{	
			echo $this->load->view('layouts/' . $this->layout_view, array('yield' => $yield), TRUE);
			echo $output;
		}
	}
	
	/**
	* function for formatting and redirecting message, using flash message
	* @param string $type e,s,n,p 
	* @param string $message the message you want to be sent 
	* @param string $redirect the url segment i.e controller/method 
	* @param string $var_name uses a different name for flashdata 
	* @return string formatted string with css and html
	*/
	public function _msg($type = FALSE,$message = FALSE,$redirect = FALSE,$var_name = 'system_message')
	{
		$type = strtolower($type);
		switch($type)
		{
		 	case $type === 'e':
				$template = "<span class='word-break' style='color:#FF0000 !important; font-weight:bold !important;'><i class='fa fa-exclamation fa-3x'></i> ".$message."</span>";
			break;
			case $type === 's':
				$template = "<span class='word-break' style='color:#006400 !important; font-weight:bold !important;'><i class='fa fa-check fa-3x'></i> ".$message."</span>";
			break;
			case $type === 'n':
				$template = "<span class='word-break' style='color:#FFA500 !important; font-weight:bold !important;'><i class='fa fa-info fa-3x'></i> ".$message."</span>";
			break;
			case $type === 'p':
				$template = $message;
			break;
			case $type === FALSE;
				$template = $message;
			break;
		}
		
		if($type AND $message AND $redirect)
		{
			$this->session->set_flashdata($var_name,$template);
			redirect($redirect);
		}elseif($type AND $message AND $redirect == FALSE){
			return $template;
		}
		
		if($redirect == FALSE AND $message == FALSE AND $redirect == FALSE)
		{
			return $this->session->flashdata($var_name);
		}
	}
	
	private function disable_browser_cache($x)
	{
		if($x == TRUE)
		{
			header("Last-Modified: " . gmdate( "D, j M Y H:i:s" ) . " GMT"); // Date in the past 
			header("Expires: " . gmdate( "D, j M Y H:i:s", time() ) . " GMT"); // always modified 
			header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
			header("Cache-Control: post-check=0, pre-check=0", FALSE); 
			header("Pragma: no-cache");
		}
	}
	
	protected function _accronymizer($string = FALSE)
	{
		if($string !== FALSE)
		{
			$clean_string = htmlspecialchars(strip_tags($string));
			$number_of_words = str_word_count($clean_string,1);
			
			$accronym = array_map(function($x){
				if(strlen($x) > 1){return $x[0];}
			},$number_of_words);
			return strtoupper(implode('',$accronym));
		}else{
			return NULL;
		}
	}
	
	protected function _check_time($time = '')
	{
		return date('Y-m-d',$time) == date('Y-m-d');
	}

	protected function logger($filename = '',$message,$time = 'H:i:s A')
	{
		$path = './system_logs/';
		$ip = $this->input->ip_address();
		if(file_exists($path))
		{
			$this->load->library('user_agent');
			$this->load->helper('file');

			$browser_data = 'BRWSR:'.$this->agent->browser().'|OS:'.$this->agent->platform();

			$filename = $filename.'_'.date('m_d_Y');
			
			write_file($path.$filename.'.txt', '['.date($time).'|'.$browser_data.'|'.$ip.'] '.$message."\n",'a+');	
		
		}
	}
}