<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_messages extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("messages")){
		$this->dbforge->add_field("`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_field("`subject` varchar(255) DEFAULT NULL");
		$this->dbforge->add_field("`from` bigint(20) unsigned NOT NULL");
    	$this->dbforge->add_field("`to` bigint(20) unsigned NOT NULL");
    	$this->dbforge->add_field("`message` longtext DEFAULT NULL");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`id`', TRUE);
		$this->dbforge->create_table("messages");
		}
	}

	public function down(){
		if($this->db->table_exists("messages")){
			$this->dbforge->drop_table("messages");
		}
	}
}