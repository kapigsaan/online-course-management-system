<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gitongi Extends CI_Controller
{
	public function __construct()
	{	
		parent::__construct();
		$this->_migrate_password = 'booda1214';
	}
	
	public function index()
	{	
		$message = "";
		$cmd_msg = "";
		echo $style = "<style>html{
						padding:0;margin:0;background: #b5bdc8; /* Old browsers */
						background: -moz-linear-gradient(top,  #b5bdc8 0%, #828c95 36%, #28343b 100%); /* FF3.6+ */
						background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b5bdc8), color-stop(36%,#828c95), color-stop(100%,#28343b)); /* Chrome,Safari4+ */
						background: -webkit-linear-gradient(top,  #b5bdc8 0%,#828c95 36%,#28343b 100%); /* Chrome10+,Safari5.1+ */
						background: -o-linear-gradient(top,  #b5bdc8 0%,#828c95 36%,#28343b 100%); /* Opera 11.10+ */
						background: -ms-linear-gradient(top,  #b5bdc8 0%,#828c95 36%,#28343b 100%); /* IE10+ */
						background: linear-gradient(to bottom,  #b5bdc8 0%,#828c95 36%,#28343b 100%); /* W3C */
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b5bdc8', endColorstr='#28343b',GradientType=0 ); /* IE6-9 */
						}
						</style>";
		if($this->session->flashdata('message'))
		{
			$message = $this->session->flashdata('message');
		}
		if($this->session->flashdata('cmd_message'))
		{
			$cmd_msg = $this->session->flashdata('cmd_message');
		}
			
		if($this->input->post('update_system'))
		{
			if($this->input->post('ddjf_ffd') == $this->session->userdata('asdfasdfasdf'))
			{
				$pass = htmlentities(strip_tags($this->input->post('migrate_pass')));
				$number = intval(htmlentities(strip_tags($this->input->post('migrate_num'))));

				set_time_limit(0);
				ob_end_clean();
				
				function execPrint($command) {
					  $cmd_message = ""					;
				    $result = array();
				    exec($command, $result);
				    foreach ($result as $line) {
				        $cmd_message .= ($line . "<br/>");
				    }
				    return $cmd_message;
				}
				
				if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				    $msg = execPrint("git pull origin master 2>&1"); // windows
				} else {
				    $msg = execPrint("git pull origin master");
				}
				
				$this->session->set_flashdata('cmd_message',$msg);
				redirect(current_url());

			}else{
				$message = '<span style="display:block;background:#f00;color:#fff;padding:2px 5px;font-weight:bold;border:3px solid #000;text-align:center;">Authorization Not Accepted.</span>';
				$this->session->set_flashdata('message',$message);
				redirect(current_url());
			}
		}else{
			$token = sha1(date('y-m-d').rand(9,1000));
			$this->session->set_userdata('asdfasdfasdf','');
			$this->session->set_userdata('asdfasdfasdf',$token);
		}
		
		$form = $cmd_msg;
		$form .='<div style="width:200px;margin:5% auto;text-align:center;background:#c0c0c0;border:1px solid #000;padding:2%;">';
		$form .='<p style="font-weight:bold;"><i>Update System.</i><p>'.$message;
		$form .= '<form action="" Method="POST" autocomplete="off" accept-charset="utf-8">';
		$form .= '<input type="password" name="migrate_pass" placeholder="password" maxlength="25" style="background:rgba(125,140,157,0.8);color:#000;" required>';
		$form .= '<br>';
		$form .= '<input type="hidden" name="ddjf_ffd" value="'.$token.'">';
		$form .= '<input type="hidden" name="clear" value="'.md5(date('h:i:s')).'">';
		$form .= '<input type="hidden" name="location" value="'.sha1(date('h:i:s')).'">';
		$form .= '<input type="submit"  style="background:#60875A;padding:3px 4px;font-weight:bold;border:2px solid #344831;border-radius:3px;color:#fff;" name="update_system" value="Update System">';
		$form .= '</form>';
		$form .= '</div>';
	
		echo $form;
	}
}