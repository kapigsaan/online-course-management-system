<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();
    
        $this->load->model(array('M_banner'));
        $this->view_data['system_message'] = $this->_msg();
    }

    public function index()
    {
            
    }
}