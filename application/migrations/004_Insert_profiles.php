<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Insert_profiles extends CI_Migration {

	public function up(){
		if(!$this->db->table_exists("profiles")){
    $this->dbforge->add_field("`name` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`address` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`tel` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`fax` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`globe` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`smart` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`sun` varchar(255) DEFAULT NULL");
    $this->dbforge->add_field("`website` varchar(255) DEFAULT NULL");
		$this->dbforge->create_table("profiles");
		}
	}

	public function down(){
		if($this->db->table_exists("profiles")){
			$this->dbforge->drop_table("profiles");
		}
	}
}