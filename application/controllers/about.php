<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class About extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
    
    $this->load->library('string_manipulation');

    $this->view_data['system_message'] = $this->_msg();
    $this->load->helper('text');
	}
  
    public function index()
    {

            $this->view_data['greens'] = $this->mc->get_all_contents('green');
            $this->view_data['staff'] = $this->mc->get_all_contents('staff');
            $this->view_data['insidepage'] = $this->mc->get_caption_level('pages');
            $this->view_data['article'] = $this->mc->get_articles('contents','about');
            $this->view_data['testimonials'] = $this->mt->get_testimonials();
            $this->view_data['pages3'] = $this->mc->get_all_contents('pages3');
            $this->view_data['usefullinks'] = $this->mc->get_all_contents('links');

            $this->view_data['about']  = $this->mc->get_contents('about',1);
            $this->view_data['green']  = $this->mc->get_contents('green',6);

            $this->view_data['clients']  = $this->mc->get_contents('pages',6);

            $this->view_data['partners'] = $this->mc->get_all_contents('classes');
    }
	
}
