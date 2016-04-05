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
            // $this->view_data['features'] = $this->mc->get_all_contents('features');
            $this->view_data['features'] = $fe = $this->mc->get_contents('features',4);

            if ($fe) {
                $this->view_data['counter'] = count($fe);
            }

            $this->view_data['banners'] = $this->M_banner->get_set_banners();

            $this->view_data['activities']  = $this->mc->get_contents('activities',10);

            $this->view_data['pages3']  = $this->mc->get_contents('pages3',6);

            $this->view_data['news'] = $this->mc->get_contents('news',3);

            $this->view_data['clients']  = $this->mc->get_contents('pages',6);

            $this->view_data['events'] = $this->mc->get_contents('events',5);

            $this->view_data['about']  = $this->mc->get_contents('about',1);
    }
}