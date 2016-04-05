<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_users extends CI_Model 
{
	
	private $last_insert_id;
	/* 	
		Adds a user on the system
		
		Returns true if add success
		Returns false if add unsuccessful
	*/
	public function add_user($attrib){
		$v = (object) $attrib;
		$hashed_password = $this->hash_password($v->username);
		
		$user_data = array(
				'username' => $v->username,
				'password' => $hashed_password,
				'f_name' => $v->f_name,
				'm_name' => $v->m_name,
				'l_name' => $v->l_name,
				'type' => $v->userType,
				'userStatus' => 'inactive',
				'created_at' => NOW,
		);
		$this->db->insert('useraccounts', $user_data);

		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}

	public function edit_user($attrib, $id = FALSE)
	{
		if ($id) {
			$this->db->where('acid', $id);
			$this->db->update('useraccounts', $attrib);

			return $this->db->affected_rows() > 0 ? TRUE : FALSE;
		}else{
			return FALSE;
		}
	}

	public function delete_user($user_id){
		if ($user_id) {
			$this->db->where('acid', $user_id)->delete('useraccounts');
			return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
		}else{
			return FALSE;
		}
	}
	
	
	/* 	
		 Verifies if an existing user is present in the system and checks their login credentials
		
		Returns false if credentials are invalid or userstatus is not active
		Returns true if credentials are valid
	*/
	public function verify_user($attrib)
	{
		unset($attrib['captcha_text']);
		unset($attrib['form_input_token']);
		unset($attrib['backstage_login']);
		
		$v = (object) $attrib;
		
		$username_filter = $this->db->escape_str($v->username);
		$password_filter = $this->db->escape_str($v->password);
		$type_filter = $this->db->escape_str($v->type);
		
		
		$this->db->where('username', $username_filter);
		$this->db->where('type', $type_filter);
		$query = $this->db->get('useraccounts');

		if($query->num_rows() >= 1 && $query->row()->userStatus == 'active')
		{
			$row = $query->row();
			
			if($this->validate_password($row->password, $password_filter))
			{
				$userdata = array(
					'userid' => $row->acid,
					'username' => $row->username,
					'userType' => $row->type,
					'fname' => $row->f_name,
					'mname' => $row->m_name,
					'lname' => $row->l_name,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($userdata);
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
			
	}
	
	
	/* 	
		-------------------------------------------------------------------
		hash_password
		-------------------------------------------------------------------
	*/
	public function hash_password($password)
    {
        $this->load->helper('passwordcompat');
		return password_hash($password,PASSWORD_BCRYPT);
    }

	/* 	
		-------------------------------------------------------------------
		validate_password
		-------------------------------------------------------------------
	*/
	public function validate_password($hashed_password, $password)
    {
		$this->load->helper('passwordcompat');
        return password_verify($password, $hashed_password);
    }
	
	/*
	@param id
	if parameter is false gets all users from db
	if parameter exists gets specific id from parameter
	*/
	
	
	
	public function get_all_users($id = FALSE)
	{
		if($id == FALSE){
			$query = $this->db->get('users');		
		}else{
			$query = $this->db->where('id',$id)->get('users');	
		}
		return $query->num_rows() > 0 ? $query->result() : FALSE;
	}
	
	/*
	--------------------------------------------------------------------------
	@param id
	@param data = array
	updates user info
	*/	
	
	public function update_user($id,$data)
	{
		$this->db->set($data)->where('id',$id)->update('users');
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
	

	/*
	@param id
	@param newpass
	updates password
	*/	
	
	public function change_pass($newpassword,$id)
	{
		$newpassword = $this->hash_password($newpassword);
		if($this->db->set('hashed_password',$newpassword)->where('id',$id)->update('users')){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	/*
	@param id
	@param old password
	checks password from database and matches from user input
	*/	
	public function verify_password($password,$id)
	{
		$data = $this->db->select('hashed_password')->where('id',$id)->get('users');
		
		$h_pass = $data->num_rows() >=1 ? $data->row()->hashed_password : FALSE;
		
		if($this->validate_password($h_pass,$password)){
			return TRUE;	
		}else{
			return FALSE;
		}
	}

		
	public function destroy($id)
	{
		$this->db->update('status','inactive')->where('id',$id)->update('users');
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
		
	
	public function register_user($user_data, $profile_data)
	{
		$user_data['created_at'] = NOW;
		$user_data['userType'] = 'student';
		$user_data['userStatus'] = 'active';
		$profile_data['created'] = NOW;
		
		$this->db->insert('users', $user_data);
		$last_insert_id = $this->db->insert_id();
		if($this->db->affected_rows() >= 1)
		{
			$profile_data['user_id'] = $last_insert_id;
			$this->db->insert('profiles', $profile_data);
			$this->last_insert_id = $this->db->insert_id();
			if($this->db->affected_rows() >= 1){
				return TRUE;
			}
			else {
				$this->db->where('user_id', $last_insert_id)->delete('users');
				return FALSE;	
			}
		}
		else
			return false;
	}

	public function get_last_insert_id()
	{
		return $this->last_insert_id;
	}
	
	// Function that accepts a string parameter $username and an int $id. Checks if another username with a different id is in the database.
	// If there are others present, FALSE is returned and TRUE otherwise.
	public function check_duplicates($username, $user_id)
	{
		$sql = "SELECT * FROM users WHERE username = ? AND id != ?";
		$query = $this->db->query($sql, array($username, $user_id));
		return $query->num_rows() > 0 ? FALSE : TRUE;
	}
		
	function get_user_data($parameter, $data)
	{
		if($parameter == 'id')
		{
			$sql = "SELECT * FROM users WHERE id = ?";
		}else if ($parameter == 'username')
		{
			$sql = "SELECT * FROM users WHERE username = ?";
		}
		
		$query = $this->db->query($sql, array($data));
		return $query->num_rows() > 0 ? $query->result() : FALSE;
	}

	private function randomString($length = 8) 
	{
		// Select which type of characters you want in your random string
		$salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$rand = '';
		$i = 0;

		while ($i < $length) 
		{ // Loop until you have met the length
			$num = rand() % strlen($salt);
			$tmp = substr($salt, $num, 1);
			$rand = $rand . $tmp;
			$i++;
		}
		return $rand;
	}

	public function change_employee_user_password_by_emp_id($password,$emp_id)
	{
		$user_id = $this->db->select('id')
				 ->where('emp_id',$emp_id)
				 ->where('userStatus','active')
				 ->get('employees');

		if($user_id->num_rows() >=1)
		{
			$id = $user_id->row()->id;
			return $this->change_pass($password['pass'],$id);

		}else{
			return FALSE;
		}
	}
	
}