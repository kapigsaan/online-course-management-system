<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Inset_forum_topics extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("forum_topics")){
		$this->dbforge->add_field("`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_field("`created_by` bigint(20) unsigned NOT NULL");
		$this->dbforge->add_field("`class_id` bigint(20) unsigned NOT NULL");
    	$this->dbforge->add_field("`topics` varchar(255) DEFAULT NULL");
    	$this->dbforge->add_field("`forum_desc` longtext DEFAULT NULL");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`id`', TRUE);
		$this->dbforge->create_table("forum_topics");
		}
	}

	public function down(){
		if($this->db->table_exists("forum_topics")){
			$this->dbforge->drop_table("forum_topics");
		}
	}
}