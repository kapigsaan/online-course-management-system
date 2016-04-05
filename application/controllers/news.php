<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->view_data['system_message'] = $this->_msg();
		$this->load->library("pagination");
	}
	public function index()
	{
    $this->view_data['hots'] = $this->mc->get_contents('news',3);
    $this->view_data['new'] = $this->mc->get_news('news');
    // $this->view_data['new1'] = $a = $this->mc->archive('news');
    // vd($a);

    $config = array();

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';


		$config["base_url"] = base_url() . "news/index";
		$config["total_rows"] = $a = $this->mc->record_count('news');
		$config["per_page"] = 6;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->view_data['news'] = $this->mc->get_contents_pages('news',$config["per_page"], $page);
		$this->view_data['links'] = $this->pagination->create_links();

  }
}
