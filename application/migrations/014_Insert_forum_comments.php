<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_forum_comments extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("forum_comments")){
		$this->dbforge->add_field("`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
		$this->dbforge->add_field("`comment_by` bigint(20) unsigned NOT NULL");
		$this->dbforge->add_field("`forum_id` bigint(20) unsigned NOT NULL");
    	$this->dbforge->add_field("`comment` longtext DEFAULT NULL");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`id`', TRUE);
		$this->dbforge->create_table("forum_comments");
		}
	}

	public function down(){
		if($this->db->table_exists("forum_comments")){
			$this->dbforge->drop_table("forum_comments");
		}
	}
}