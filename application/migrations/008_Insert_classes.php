<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_classes extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("classes")){
		$this->dbforge->add_field("`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_field("`created_by` bigint(20) unsigned NOT NULL");
    	$this->dbforge->add_field("`class` varchar(255) DEFAULT NULL");
    	$this->dbforge->add_field("`code` varchar(255) DEFAULT NULL");
    	$this->dbforge->add_field("`status` set('active','inactive') NOT NULL DEFAULT 'active'");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`id`', TRUE);
		$this->dbforge->create_table("classes");
		}
	}

	public function down(){
		if($this->db->table_exists("classes")){
			$this->dbforge->drop_table("classes");
		}
	}
}