<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_inquiry extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("inquiry")){
    $this->dbforge->add_field("`inquiry_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");
    $this->dbforge->add_field("`name` varchar(255) NOT NULL");
    $this->dbforge->add_field("`email` varchar(255) NOT NULL");
    $this->dbforge->add_field("`contact_number` varchar(255) NOT NULL");
    $this->dbforge->add_field("`subject` varchar(255) NOT NULL");
    $this->dbforge->add_field("`message` varchar(255) NOT NULL");
    $this->dbforge->add_field("`inquired_at` datetime NOT NULL");
    $this->dbforge->add_field("`new` varchar(255) NOT NULL DEFAULT 'yes'");
    $this->dbforge->add_key('`inquiry_id`', TRUE);
		$this->dbforge->create_table("inquiry");
		}
	}

	public function down(){
		if($this->db->table_exists("inquiry")){
			$this->dbforge->drop_table("inquiry");
		}
	}
}