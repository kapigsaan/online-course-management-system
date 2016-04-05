<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cms_databases Extends CI_Controller
{
	private $_migrate_password = '';
	
	
	public function __construct()
	{	
		parent::__construct();
		$this->_migrate_password = 'nalakalang';

		
	}
	
	public function index()
	{	
		$message = "";
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
		if ($this->db->table_exists('migrations'))
		{
			if($this->session->flashdata('message'))
			{
				$message = $this->session->flashdata('message');
			//	exit($message);
			}
			
			
			$this->load->helper('file');
		
			$files = get_filenames('application/migrations') ? count(get_filenames('application/migrations')) : 0;
			
			$qmig = $this->db->get('migrations');
			$mig_v = $qmig->num_rows() >= 1 ? $qmig->row() : 0 ;
			
			if($this->input->post('run_migration'))
			{
				if($this->input->post('ddjf_ffd') == $this->session->userdata('asdfasdfasdf'))
				{
					$pass = htmlentities(strip_tags($this->input->post('migrate_pass')));
					$number = intval(htmlentities(strip_tags($this->input->post('migrate_num'))));

					if($pass == $this->_migrate_password AND is_numeric($number) AND $number > 0)
					{
						set_time_limit(0);
						$this->load->library('migration',array('migration_enabled'=>TRUE));
						$result = $this->migration->version($number);
						if($result)
						{
							$message = '<span style="display:block;background:#4DAD34;color:#000;padding:2px 5px;font-weight:bold;border:3px solid #000;text-align:center;">Migration Was Successfull!</span>';
							$this->session->set_flashdata('message',$message);
							redirect(current_url());
						}else{
							show_error($this->migration->error_string());
						}
					}else
					{
						
						$message = '<span style="display:block;background:#f00;color:#fff;padding:2px 5px;font-weight:bold;border:3px solid #000;text-align:center;">Authorization Not Accepted.</span>';
						$this->session->set_flashdata('message',$message);
						redirect(current_url());
					}
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
			
			$form ='<div style="width:200px;margin:5% auto;text-align:center;background:#c0c0c0;border:1px solid #000;padding:2%;">';
			$form .='<p style="font-weight:bold;"><i>Migration Wizard.</i><p>'.$message;
			$form .='<p>Current <span style="background:#4AA858;padding:2px 3px;font-weight:bold;border:1px solid #306B38;border-radius:3px;color:#fff;">'.$mig_v->version.'</span> - Latest <span style="background:#539FC8;padding:2px 3px;font-weight:bold;border:1px solid #265C79;border-radius:3px;color:#fff;">'.$files.'</span><p>';
			$form .= '<form action="" Method="POST" autocomplete="off" accept-charset="utf-8">';
			$form .= '<input autofocus type="text" name="migrate_num" placeholder="Migration Number" maxlength="3" style="background:rgba(125,140,157,0.8);color:#000;" required>';
			$form .= '<br>';
			$form .= '<input type="password" name="migrate_pass" placeholder="password" maxlength="25" style="background:rgba(125,140,157,0.8);color:#000;" required>';
			$form .= '<br>';
			$form .= '<input type="hidden" name="ddjf_ffd" value="'.$token.'">';
			$form .= '<input type="hidden" name="clear" value="'.md5(date('h:i:s')).'">';
			$form .= '<input type="hidden" name="location" value="'.sha1(date('h:i:s')).'">';
			$form .= '<input type="submit"  style="background:#60875A;padding:3px 4px;font-weight:bold;border:2px solid #344831;border-radius:3px;color:#fff;" name="run_migration" value="Run Migration">';
			$form .= '</form>';
			$form .= '</div>';

			
		}else
		{
		
			if($this->input->post('enable_migration'))
			{
				if($this->input->post('ddjf_ffd') == $this->session->userdata('asdfasdfasdf'))
				{
					$pass = htmlentities(strip_tags($this->input->post('migrate_pass')));
					$number = intval(htmlentities(strip_tags($this->input->post('migrate_num'))));

					if($pass == $this->_migrate_password)
					{
						set_time_limit(0);
						$this->load->library('migration',array('migration_enabled'=>TRUE));
						$result = $this->migration->latest();
						if($result)
						{
							$message = '<span style="display:block;background:#4DAD34;color:#000;padding:2px 5px;font-weight:bold;border:3px solid #000;text-align:center;">Migration Was Successfull</span>';
							$this->session->set_flashdata('message',$message);
							redirect('cms_databases');
						}else{
							show_error($this->migration->error_string());
						}
					}else
					{
						$message = '<span style="display:block;background:#f00;color:#fff;padding:2px 5px;font-weight:bold;border:3px solid #000;text-align:center;">Authorization Not Accepted, We Don\'t Know You</span>';
						$this->session->set_flashdata('message',$message);
						redirect('cms_databases');
					}
				}else{
					$message = '<span style="display:block;background:#f00;color:#fff;padding:2px 5px;font-weight:bold;border:3px solid #000;text-align:center;">Authorization Not Accepted, We Don\'t Know You</span>';
					$this->session->set_flashdata('message',$message);
					redirect('cms_databases');
				}
			
			}else{
				$token = sha1(date('y-m-d').rand(9,1000));
				$this->session->set_userdata('asdfasdfasdf','');
				$this->session->set_userdata('asdfasdfasdf',$token);
			}
			
			$form ='<div style="width:200px;margin:5% auto;text-align:center;background:#c0c0c0;border:1px solid #000;padding:2%;">';
			$form .='<p style="font-weight:bold;"><i>Migration Wizard.</i><p>';
			$form .='<p>Enter Password To enable Migration.<p>';
			$form .= '<form action="" Method="POST" autocomplete="off" accept-charset="utf-8">';
			$form .= '<input type="password" name="migrate_pass" placeholder="password" maxlength="25" style="background:rgba(125,140,157,0.8);color:#000;" required>';
			$form .= '<br>';
			$form .= '<input type="hidden" name="ddjf_ffd" value="'.$token.'">';
			$form .= '<input type="hidden" name="clear" value="'.md5(date('h:i:s')).'">';
			$form .= '<input type="hidden" name="location" value="'.sha1(date('h:i:s')).'">';
			$form .= '<input type="submit" name="enable_migration" value="Enable Migration">';
			$form .= '</form>';
			$form .= '</div>';
		
		}
		
		echo $form;
	}
}