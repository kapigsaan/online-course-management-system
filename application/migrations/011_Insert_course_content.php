<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_course_content extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("course_content")){
		$this->dbforge->add_field("`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_field("`class_id` bigint(20) unsigned NOT NULL");
		$this->dbforge->add_field("`status` set('active','inactive') NOT NULL DEFAULT 'active'");
    	$this->dbforge->add_field("`caption` varchar(255) DEFAULT NULL");
    	$this->dbforge->add_field("`file` varchar(255) DEFAULT NULL");
    	$this->dbforge->add_field("`file_size` varchar(255) DEFAULT NULL");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`id`', TRUE);
		$this->dbforge->create_table("course_content");
		}
	}

	public function down(){
		if($this->db->table_exists("course_content")){
			$this->dbforge->drop_table("course_content");
		}
	}
}