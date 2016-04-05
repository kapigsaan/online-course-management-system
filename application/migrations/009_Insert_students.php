<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_students extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("students")){
		$this->dbforge->add_field("`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_field("`class_id` bigint(20) unsigned NOT NULL");
		$this->dbforge->add_field("`acc_id` bigint(20) unsigned NOT NULL");
    	$this->dbforge->add_field("`f_name` varchar(255) DEFAULT NULL");
    	$this->dbforge->add_field("`m_name` varchar(255) DEFAULT NULL");
    	$this->dbforge->add_field("`l_name` varchar(255) DEFAULT NULL");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`id`', TRUE);
		$this->dbforge->create_table("students");
		}
	}

	public function down(){
		if($this->db->table_exists("students")){
			$this->dbforge->drop_table("students");
		}
	}
}