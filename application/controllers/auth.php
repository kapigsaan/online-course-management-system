<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_AdminController
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') == TRUE AND strtolower($this->uri->segment(2)) !== 'logout')
		{
			redirect('cms_admin');
		}
		$this->layout_view = '_login';
		$this->load->model('M_users');
		$this->load->library(array('form_validation','token'));
		$this->load->helper(array('url','form'));
		$this->token->set_token();
		session_start();
	}
	
	public function index()
	{
		redirect();
	}
	
	private function _captcha()
	{
		$this->load->helper('captcha');
		$system_counted_hash = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		$vals = array(
			'word'	 	 => str_replace('0','', substr(md5(rand(1,100).$system_counted_hash),3,rand(2,5))),
			'img_path'	 => './captcha/',
			'img_url'	 => base_url().'auth/captcha',
			'font_path'	 => './assets/_fonts/4.ttf',
			'img_width'	 => 300,
			'img_height' => 55,
			'expiration' => 7200
			);
		
		$cap = create_captcha($vals);
		$image['word'] = $cap['word'];
		$image['image'] ='<image src="'.base_url().'captcha/'.$cap['time'].'.jpg" class="img-responsive"/>';
		$image['link'] = './captcha/'.$cap['time'].'.jpg';

		return (object)$image;
	}

	public function check_captcha($result)
	{      	
		$the_word = $this->session->userdata('captchaWord');
			
		if(strcasecmp($result, $the_word) == 0) {return TRUE;}
		else{
		$this->form_validation->set_message('check_captcha', 'Captcha did not match');
		return false;}
	}

	/*12-6-12 Login authentication for user*/
	function login()
	{
		$this->view_data['system_message'] = $this->_msg();
		$this->load->helper('file');//load helper file
		delete_files('./captcha');// delete all images in captcha folder
		//$captcha = $this->_captcha(); //generate captcha
		//$this->session->set_flashdata('image_url',$captcha->link); // save path of generated captcha to session
		$this->view_data['form_token'] = $this->token->get_token();//generate form token
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'required|trim|htmlspecialchars|is_unique[useraccounts.username');
		$this->form_validation->set_rules('password', 'password', 'required|trim|htmlspecialchars');
		// $this->form_validation->set_rules('type', 'type', 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('fit', ' ', 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('captcha', "Captcha", 'trim|required|callback_check_captcha');
		//$this->form_validation->set_rules('captcha_text', 'captcha', 'required|trim|htmlspecialchars');

		//$this->view_data['captcha_image'] = $captcha->image;
		$this->view_data['username'] = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

		if($this->input->post('backstage_login'))
		{
			$username = $this->input->post('username');
      		$password = $this->input->post('password');
			//get captcha link from session
			//$captcha_image_link = $this->session->flashdata('image_url');

			// check if XSF or XXS filtering
			if($this->token->validate_token($this->input->post('fit',TRUE)))
			{
				//run form validation
				if($this->form_validation->run() !== FALSE)
				{
					$captcha_word = $this->session->userdata('captchaWord');
					$sent_captcha_text = $this->input->post('captcha');
					if (strcasecmp($captcha_word, $sent_captcha_text) == 0) {
					//hash the word
					//$captcha_word = md5(strtolower($this->session->userdata('word')));
					//$sent_captcha_text = md5(strtolower($this->input->post('captcha_text')));
					
					//if($captcha_word == $sent_captcha_text)
					//{
						if($this->M_users->verify_user($this->input->post()))
						{
							$this->logger('log','User: '.$username.' successfully logged in.');

							$this->token->destroy_token();//destroy token
							$this->session->set_userdata('word',''); //destroy captcha from session
							//unlink($captcha_image_link);//delete captcha image from file
							$this->_msgbootstrap('s','Login successful. Welcome.','cms_admin'); // redirect success
						}else{
							$this->logger('log','User: '.$username.' failed login attempt. Invalid username:'.$username.'/password:'.$password.' combination.');
							$this->token->destroy_token();//destroy token
							$this->session->set_userdata('word','');//destroy captcha from session
							//unlink($captcha_image_link);//delete captcha image from file
							$this->_msgbootstrap('e','Invalid username/password combination.','auth/login/');// redirect failed
						}
					//}else{
					//	$this->logger('log','User: '.$username.' failed login attempt. Wrong captcha code entered.');
					//	$this->token->destroy_token();
					//	$this->session->set_userdata('word','');
					//	unlink($captcha_image_link);
					//	$this->_msgbootstrap('e','Wrong captcha code entered.','auth/login/');
					//}
					}else{
	                	$this->captcha_setting();
					}
				}
			}else{
				$this->logger('log','User: '.$username.' failed login attempt. Token expired.');
				$this->token->destroy_token();
				$this->session->set_userdata('word','');
				unlink($captcha_image_link);
				$this->_msgbootstrap('e','Token Expired.','auth/login/');
			}
		}else{
			$this->captcha_setting();			
		}
	}
	
	function logout()
    {
		$message = $this->_msg();
		
		$userdata = array(
			'userid' => '',
			'username' => '',
			'userType' => '',
			'fname' => '',
			'mname' => '',
			'lname' => '',
			'logged_in' => FALSE
		);
		
		$this->session->set_userdata($userdata);
		$this->session->sess_destroy();
		
		$this->logger('log','User: '.$username.' log out.');
		
		if($message)
		{
			$this->_msg('s',$message,'auth/login/');
		}else{
			$this->_msg('n','You are now logged out.','auth/login/');
		}
    }
	
	public function _msgbootstrap($type = FALSE,$message = FALSE,$redirect = FALSE,$var_name = 'system_message')
	{
		$type = strtolower($type);
		switch($type)
		{
		 	case $type === 'e':
				$template = "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> ".$message."</div>";
			break;
			case $type === 's':
				$template = "<div class='alert-box success'><i class='fa fa-check'></i> ".$message."</div>";
			break;
			case $type === 'n':
				$template = "<div class='alert alert-info'><i class='fa fa-warning'></i> ".$message."</div>";
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

	// For new image on click refresh button.
    public function captcha_refresh(){
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
        $d = $data['word'];
		$this->session->set_userdata('captchaWord', $d) ;
        echo $data['image'];
        
    }
}