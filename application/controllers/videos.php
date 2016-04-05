<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Videos extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
    $this->load->model('M_yvideos','myv');
		
		$this->view_data['system_message'] = $this->_msg();
	}

	public function index()
	{
    $this->view_data['yvideo'] = $latest = $this->myv->get_yv();
    if($latest):
    $this->view_data['yvideos'] = $this->myv->get_yv_except($latest->id);
    else:
    $this->view_data['yvideos'] = FALSE;
    endif;
	}
  
  public function show($id)
	{
    $this->view_data['yvideo'] = $this->myv->get_yv($id);
    $this->view_data['yvideos'] = $this->myv->get_yv_except($id);
	}
}
