<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_answers extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("answers")){
		$this->dbforge->add_field("`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_field("`caption` varchar(255) DEFAULT NULL");
		$this->dbforge->add_field("`class_id` bigint(20) unsigned NOT NULL");
		$this->dbforge->add_field("`stud_id` bigint(20) unsigned NOT NULL");
		$this->dbforge->add_field("`status` set('activity','homework','quiz') NOT NULL DEFAULT 'activity'");
    	$this->dbforge->add_field("`file` longtext DEFAULT NULL");
    	$this->dbforge->add_field("`file_size` varchar(255) DEFAULT NULL");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`id`', TRUE);
		$this->dbforge->create_table("answers");
		}
	}

	public function down(){
		if($this->db->table_exists("answers")){
			$this->dbforge->drop_table("answers");
		}
	}
}