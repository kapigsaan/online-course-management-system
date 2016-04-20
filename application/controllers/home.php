<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();
    
        $this->load->model(array('M_banner'));
        $this->view_data['system_message'] = $this->_msg();
        $this->load->helper('captcha');
    }

    public function index()
    {
            $this->captcha_setting();
    }

    public function captcha_setting(){
        $values = array(
	        'word' => '',
	        'word_length' => 4,
	        'img_path' => './captcha/',
	        'img_url' =>  base_url() .'captcha/',
	        'font_path'  => base_url() . 'system/fonts/4.ttf',
	        'img_width' => '250',
	        'img_height' => 50,
	        'expiration' => 3600,
	        'font_size'	=> 24
        );   
        $data = create_captcha($values);
		// $_SESSION['captchaWord'] = $data['word'];
		$d = $data['word'];
		$this->session->set_userdata('captchaWord', $d) ;
		                 
		// image will store in "$data['image']" index and its send on view page 
		$this->view_data['data'] = $data;
	}  
}