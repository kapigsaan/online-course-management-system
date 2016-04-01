<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_calendar extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("calendar")){
		$this->dbforge->add_field("`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_field("`created_by` bigint(20) unsigned NOT NULL");
		$this->dbforge->add_field("`class_id` bigint(20) unsigned NOT NULL");
      	$this->dbforge->add_field("`title` varchar(255) DEFAULT NULL");
      	$this->dbforge->add_field("`desc` longtext DEFAULT NULL");
      	$this->dbforge->add_field("`event_date` date DEFAULT NULL");
      	$this->dbforge->add_field("`start` date DEFAULT NULL");
      	$this->dbforge->add_field("`end` date DEFAULT NULL");
		$this->dbforge->add_field("`color` varchar(255) DEFAULT NULL");
		$this->dbforge->add_field("`event_batch_code` varchar(255) DEFAULT NULL");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`id`', TRUE);
		$this->dbforge->create_table("calendar");
		}
	}

	public function down(){
		if($this->db->table_exists("calendar")){
			$this->dbforge->drop_table("calendar");
		}
	}
}