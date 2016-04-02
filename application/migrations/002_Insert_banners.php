<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_banners extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("banners")){
		$this->dbforge->add_field("`banner_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
    $this->dbforge->add_field("`type` set('image') NOT NULL DEFAULT 'image'");
    $this->dbforge->add_field("`usebanner` set('yes','no') NOT NULL DEFAULT 'yes'");
		$this->dbforge->add_field("`file` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`caption` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`linkto` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`target` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`content` longtext DEFAULT NULL");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`banner_id`', TRUE);
		$this->dbforge->create_table("banners");
		}
	}

	public function down(){
		if($this->db->table_exists("banners")){
			$this->dbforge->drop_table("banners");
		}
	}
}