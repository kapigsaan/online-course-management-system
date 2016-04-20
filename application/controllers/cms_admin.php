<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_admin extends MY_AdminController {

	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('logged_in') == FALSE){
			redirect('obcms-login');
		}elseif ($this->session->userdata('userType') == 'admin') {
			$this->view_data['system_message'] =$this->_msg();
			$this->load->model('M_content','mc');
			$this->load->model('M_users','mu');
			$this->load->model('M_students','ms');
			$this->load->model('M_classes','cl');
			$this->load->model('M_forums','mf');
			$this->load->model('M_downloads','md');
			$this->load->model('M_yvideos','myv');
			$layout_view = '_admin_layout';
		}elseif ($this->session->userdata('userType') == 'instructor') {
			redirect('cms_teacher');
		}elseif ($this->session->userdata('userType') == 'student') {
			redirect('cms_student');
		}
	}
	
	public function index()
	{
		//$this->view_data['hits']=$this->mu->get_hits();
		//$this->view_data['visits']=$this->mu->count_hits();
		//$this->view_data['ipadd']=$this->mu->count_visits();
	}

	public function accounts()
	{
		$this->view_data['list']=$this->mc->get_all_accounts();
	}

	public function instructor()
	{
		if ($this->input->post('add-instructorsubmit')) {
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[useraccounts.username]');

			if ($this->form_validation->run() == FALSE){

			}else{
				$data['username'] = $this->input->post('username');
				$data['f_name'] = $this->input->post('fname');
				$data['m_name'] = $this->input->post('mname');
				$data['l_name'] = $this->input->post('lname');
				$data['userType'] = 'instructor';

				$res = $this->mu->add_user($data);

				if ($res) {
					$this->_msg('s','Successfully Added.','cms_admin/instructor');
				}else{
					$this->_msg('e','Failed.','cms_admin/instructor');
				}
			}

		}

		$this->view_data['list']=$this->mc->get_user_where('instructor');
	}

	public function edit_instructor($id = FALSE)
	{
		if ($id) {
			if ($this->input->post('edit-instructorsubmit')) {
				$data['username'] = $this->input->post('username');
				$data['f_name'] = $this->input->post('fname');
				$data['m_name'] = $this->input->post('mname');
				$data['l_name'] = $this->input->post('lname');

				$res = $this->mu->edit_user($data, $id);

				if ($res) {
					$this->_msg('s','Successfully Updated.','cms_admin/instructor');
				}else{
					$this->_msg('e','Failed.','cms_admin/instructor');
				}	
			}

			$this->view_data['list']=$this->mc->get_account($id);

		}else{
			show_404();
		}

	}

	public function delete_instructor($id = FALSE)
	{
		if ($id) {

			$res = $this->mu->delete_user($id);

			if ($res) {
				$this->_msg('s','Successfully Deleted.','cms_admin/instructor');
			}else{
				$this->_msg('e','Failed.','cms_admin/instructor');
			}	

		}else{
			show_404();
		}
	}

	public function student()
	{

		if ($this->input->post('add-studentsubmit')) {
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[useraccounts.username]');

			if ($this->form_validation->run() == FALSE){

			}else{
				$data['username'] = $this->input->post('username');
				$data['f_name'] = $this->input->post('f_name');
				$data['m_name'] = $this->input->post('m_name');
				$data['l_name'] = $this->input->post('l_name');
				$data['userType'] = 'student';

				$res = $this->ms->add_student($data);
				if ($res) {
					$this->_msg('s','Successfully Added Student.','Cms_admin/student/'.$id);
				}else{
					$this->_msg('e','Failed.','Cms_admin/student/'.$id);
				}	
			}
		}

		$this->view_data['list']=$this->ms->get_student_all();
	}

	public function view_student($id = FALSE)
	{
		if ($id) {
			$this->view_data['list'] = $this->mc->get_account($id);

		}else{
			show_404();
		}
	}

	public function edit_student($id = FALSE)
	{
		if ($id) {
			
			if ($this->input->post('edit-studentsubmit')) {
				$account_id = $this->input->post('account_id');
				$data['username'] = $this->input->post('username');
				$data['f_name'] = $this->input->post('f_name');
				$data['m_name'] = $this->input->post('m_name');
				$data['l_name'] = $this->input->post('l_name');
				$data['userType'] = 'student';

				$res = $this->ms->edit_student($data, $id, $account_id);
				if ($res) {
					$this->_msg('s','Successfully Updated Student.','Cms_admin/student/'.$class);
				}else{
					$this->_msg('e','Failed.','Cms_admin/student/'.$class);
				}	
			}

			$this->view_data['list'] = $this->ms->get_student($id);
		}else{
			show_404();
		}
	}

	public function delete_student($id = FALSE, $account_id = FALSE)
	{
		if ($id && $account_id) {
			$res = $this->ms->delete_student($id, $account_id);
			if ($res) {
					$this->_msg('s','Successfully Deleted Student.','Cms_admin/student/'.$class);
				}else{
					$this->_msg('e','Failed.','Cms_admin/student/'.$class);
				}
		}else{
			show_404();
		}
	}

	public function change_status($route = FALSE, $status = FALSE, $id = FALSE)
	{
		if ($id) {
			$res = $this->mc->change_status($status, $id);
			if ($res) {
				if ($status == "inactive") {
					$this->_msg('s','Account Successfully Deactivated.','cms_admin/'.$route);	
				}else{
					$this->_msg('s','Account Successfully Activated.','cms_admin/'.$route);
				}
			}else{
				$this->_msg('e','Failed.','cms_admin/'.$route);
			}				
		}else{
			show_404();
		}
	}

	public function classes()
	{
		$this->view_data['classes'] = $this->cl->get_all_class_with_instructor();		
	}

	public function delete_class($id)
	{
		if ($id) {
			$res = $this->cl->delete_class($id);
			if ($res) {
				$this->_msg('s','Successfully Deleted.','cms_admin/classes');
			}else{
				$this->_msg('e','Failed.','cms_admin/classes');
			}	
		}else{
			show_404();
		}
	}

	public function forums($class = FALSE)
	{
		if ($class) {
			$this->view_data['list'] = $this->mf->get_forums_in($class);
		}else{
			show_404();
		}
	}

	public function view_forum($class = FALSE, $id = FALSE)
	{
		if ($id) {
			if ($this->input->post('submit-comment')) {
				$data['comment'] = $this->input->post('comment');
				$data['forum_id'] = $id;
				$data['comment_by'] = $this->session->userdata('userid');

				$result = $this->mf->add_comment($data);

				if ($result) {
					$this->_msg('s','Comment Submitted.','cms_admin/view_forum/'.$class.'/'.$id);
				}else{
					$this->_msg('e','Failed.','cms_admin/view_forum/'.$class.'/'.$id);
				}
			}

			$this->view_data['class'] = $this->mf->get_forum($id);
			$this->view_data['list'] = $this->mf->get_comments_in($id);
		}else{
			show_404();
		}
	}

	public function students($id = FALSE)
	{
		if ($id) {
			$this->view_data['list'] = $this->ms->get_students_in_class($id);
		}else{
			show_404();
		}
	}

	public function materials($class = FALSE)
	{
		if ($class) {
			$this->view_data['list'] = $this->md->get_syllabus_in($class);
			$this->view_data['course_content'] = $this->md->get_course_content_in($class);
			$this->view_data['course_outline'] = $this->md->get_course_outline_in($class);
			$this->view_data['images'] = $this->md->get_images_in($class);
			$this->view_data['videos'] = $this->myv->get_every_yv($class);
			$this->view_data['class'] = $class;
		}else{
			show_404();
		}
	}

	public function change_password()
	{
		if ($this->input->post('btn-submit-changepass')) {
			$old_pass = $this->input->post('old_pass');
			$password = $this->input->post('password');

			$old = $this->mu->verify_password($old_pass, $this->session->userdata('userid'));
			if ($old) {
				$new = $this->mu->change_pass($password, $this->session->userdata('userid'));
				if ($new) {
					$this->_msg('s','Password Successfully Changed.','cms_admin/index/');
				}else{
					$this->_msg('e','Failed.','cms_admin/index/');
				}
			}else{
				$this->_msg('e','Old Password is Invalid.','cms_admin/change_password');
			}
		}
		$this->view_data['profile'] = $this->mu->get_all_users($this->session->userdata('userid'));

	}
}
