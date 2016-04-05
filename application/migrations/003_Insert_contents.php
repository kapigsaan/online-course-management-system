<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_contents extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("contents")){
		$this->dbforge->add_field("`content_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
    $this->dbforge->add_field("`parent_id` bigint(20) DEFAULT NULL");
    $this->dbforge->add_field("`level` set('topnav','firsttop','features','news','about','staff','green','pages','pages2','pages3','activities','services','classes','program','support','footer', 'contents','blog','products','events','clients') NOT NULL");
    $this->dbforge->add_field("`caption` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`category` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`foreword` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`linkto` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`target` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`content` longtext DEFAULT NULL");
    $this->dbforge->add_field("`btnorder` bigint(20) NOT NULL DEFAULT '0'");
    $this->dbforge->add_field("`imagefile` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`imagecaption` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`imagelink` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`imagealign` set('right','left','center') DEFAULT 'left'");
    $this->dbforge->add_field("`video` longtext DEFAULT NULL");
		$this->dbforge->add_field("`created_at` datetime DEFAULT NULL");
		$this->dbforge->add_field("`updated_at` datetime DEFAULT NULL");
		$this->dbforge->add_key('`content_id`', TRUE);
		$this->dbforge->create_table("contents");
		}
	}

	public function down(){
		if($this->db->table_exists("contents")){
			$this->dbforge->drop_table("contents");
		}
	}
}