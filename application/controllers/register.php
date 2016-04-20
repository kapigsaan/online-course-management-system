<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();
    
        $this->view_data['system_message'] = $this->_msg();
        $this->layout_view = '_register';
        $this->load->model('M_students','mst');
    }

    public function index()
    {

    	if ($this->input->post('Submit')) {
    		
    		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[useraccounts.username]');

				if ($this->form_validation->run() == FALSE){

				}else{
					$data['username'] = $this->input->post('username');
					$data['f_name'] = $this->input->post('fname');
					$data['m_name'] = $this->input->post('mname');
					$data['l_name'] = $this->input->post('lname');
					$data['userType'] = 'student';

					$res = $this->mst->add_student($data);
					if ($res) {
						$this->_msg('s','Successfully Registered <a href = '.site_url('obcms-login').'>Login Now?</a>.','register');
					}else{
						$this->_msg('e','Failed.','register');
					}	
				}

    	}

    }
}