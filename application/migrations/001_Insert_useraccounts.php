<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_useraccounts extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("useraccounts")){
			$this->dbforge->add_field("`acid` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
			$this->dbforge->add_field("`custid` bigint(20) unsigned NOT NULL");
			$this->dbforge->add_field("`username` varchar(255) DEFAULT NULL COMMENT 'Group Name'");
			$this->dbforge->add_field("`password` varchar(255) DEFAULT NULL COMMENT 'Group Name'");
			$this->dbforge->add_field("`type`set('admin','student', 'instructor') NOT NULL DEFAULT 'student'");
			$this->dbforge->add_field("`userStatus` set('active','inactive','deleted') NOT NULL DEFAULT 'inactive'");
			$this->dbforge->add_field("`f_name` varchar(255) DEFAULT NULL");
			$this->dbforge->add_field("`m_name` varchar(255) DEFAULT NULL");
			$this->dbforge->add_field("`l_name` varchar(255) DEFAULT NULL");
			$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
			$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
			$this->dbforge->add_key('`acid`', TRUE);
			$this->dbforge->create_table("useraccounts");
		}
	}

	public function down(){
		if($this->db->table_exists("useraccounts")){
			$this->dbforge->drop_table("useraccounts");
		}
	}
}