<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_student_in_class extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("students_in_class")){
		$this->dbforge->add_field("`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_field("`class_id` bigint(20) unsigned NOT NULL");
		$this->dbforge->add_field("`stud_id` bigint(20) unsigned NOT NULL");
    	$this->dbforge->add_field("`code` varchar(255) DEFAULT NULL");
    	$this->dbforge->add_field("`join` set('joined','unjoin') NOT NULL DEFAULT 'unjoin'");
    	$this->dbforge->add_field("`status` set('active','inactive') NOT NULL DEFAULT 'inactive'");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`id`', TRUE);
		$this->dbforge->create_table("students_in_class");
		}
	}

	public function down(){
		if($this->db->table_exists("students_in_class")){
			$this->dbforge->drop_table("students_in_class");
		}
	}
}