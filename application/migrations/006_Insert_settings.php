<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_settings extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("settings")){
    $this->dbforge->add_field("`inq_email` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`fb_url` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`tw_url` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`official_email` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`gplus_url` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`gmap_url` LONGTEXT DEFAULT NULL");
    $this->dbforge->add_field("`enroll_url` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`student_url` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`faculty_url` LONGTEXT DEFAULT NULL");
    $this->dbforge->add_field("`in_url` LONGTEXT DEFAULT NULL");
		$this->dbforge->create_table(settings);
		}
	}

	public function down(){
		if($this->db->table_exists("settings")){
			$this->dbforge->drop_table("settings");
		}
	}
}