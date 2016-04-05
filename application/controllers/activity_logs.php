<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity_logs extends MY_AdminController 
{
  protected $custodian;
   
  public function __construct()
	{
		parent::__construct();
    
		if($this->session->userdata('logged_in') == FALSE):
			redirect();
		else:
      $this->custodian = $this->session->userdata['username']; //variable for username
			$this->view_data['system_message'] =$this->_msg();
		endif;
	}
  
  public function index()
  {
    $this->load->helper('file');

    $dir = "system_logs"; // Directory where files are stored
    $this->view_data['map'] = get_filenames($dir);
  }
}