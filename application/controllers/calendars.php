<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendars extends MY_AdminController  
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') == FALSE){
			redirect('obcms-login');
		}elseif ($this->session->userdata('userType') == 'instructor') {
			$this->load->helper('file');
			$this->view_data['system_message'] =$this->_msg();
			$this->load->model('M_calendar','mc');
			$this->load->helper('text');
			$this->load->library('string_manipulation');
		}elseif ($this->session->userdata('userType') == 'admin') {
			$this->load->helper('file');
			$this->view_data['system_message'] =$this->_msg();
			$this->load->model('M_calendar','mc');
			$this->load->helper('text');
			$this->load->library('string_manipulation');
		}elseif ($this->session->userdata('userType') == 'student') {
			redirect('cms_student');
		}
	}

	public function index($class = FALSE, $year = FALSE, $month = FALSE)
	{
		if (!$class) {
			show_404();
		}else{
			if (!$year) {
				$year = date('Y');
			}
			if (!$month) {
				$month = date('m');
			}

			$prefs = array (
				'start_day' => 'sunday',
				'show_next_prev' => true,
				'next_prev_url' => base_url() . 'calendars/index/'.$class
	             );

			$prefs['day_type'] = 'long'; 

			$prefs['template'] = '
				 {table_open}<table class="calendar">{/table_open}

				 {heading_row_start}<tr style = "width: 100%;">{/heading_row_start}

				{heading_previous_cell}<th style = "text-align:center;"><a href="{previous_url}">&lt;&lt; Previous</a></th>{/heading_previous_cell}
				{heading_title_cell}<th colspan="{colspan}" style = "text-align:center;">{heading}</th>{/heading_title_cell}
				{heading_next_cell}<th style = "text-align:center;"><a href="{next_url}">Next &gt;&gt;</a></th>{/heading_next_cell}

				{heading_row_end}</tr>{/heading_row_end}

				    {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
				    {cal_cell_content}<span class="day_listing">{day}</span> {content}&nbsp;{/cal_cell_content}
				    {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span> {content}</div>{/cal_cell_content_today}
				    {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
				    {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
			';

			$this->load->library('calendar', $prefs);
			$datas = $this->mc->get_all_events($year,$month);
			$current_url = 'calendar-of--Events'.$year.'-'.$month;
			$this->view_data['cal'] = $this->calendar->generate_event_calendar($year,$month,$datas,$current_url,FALSE,$class);
			$this->view_data['links'] = $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
			// $this->view_data['legends'] = $this->mc->get_legends();
			

			if($this->input->post('updatecalendar'))
			{
				$post = $this->input->post();
				$event = $this->mc->new_event($post);

				if($event->stat)
				{
					$this->_msg('s',$event->msg,'calendars/index/'.$class.'/'.$year.'/'.$month);
				}else{
					$this->_msg('e',$event->msg,'calendars/index/'.$class.'/'.$year.'/'.$month);
				}
			}
		}
		
	}

	public function editevent($class = FALSE, $event_batch_id = '')
	{

		$year = date('Y');
		$month = date('m');

		$this->load->model('mc');
		$this->view_data['event'] = $event = $this->mc->get_event($event_batch_id);
		$event_end = $this->mc->get_end_of_event($event[0]->end);
		if ($event) {
			$this->view_data['acode']	= $event[0]->event_batch_code;
			$this->view_data['astart']	= date("m/d/Y", strtotime($event[0]->start));
			$this->view_data['aend']	= date("m/d/Y", strtotime($event_end));
			$this->view_data['atitle']	= $event[0]->title;
			$this->view_data['adesc']	= $event[0]->desc;
		} else {
			$this->view_data['event'] = FALSE;
		}
		
		$this->view_data['batch_id'] = $event_batch_id;
		$this->view_data['class'] = $class;


		if($this->input->post('updatecalendar'))
		{
			$eventa = $this->mc->get_event($this->input->post('codec'));
			$events = $this->mc->edit_event($eventa,$this->input->post());
			if($events)
			{
				$this->_msg('s',$events->msg,'calendars/index/'.$class.'/'.$year.'/'.$month);
			}else{
				$this->_msg('e',$events->msg,'calendars/index/'.$class.'/'.$year.'/'.$month);
			}
		}

		if($this->input->post('delete_event')){
			$stat = $this->mc->delete_event($this->input->post('codec'));

			if($stat)
			{
				$this->_msg('s','Successfully Deleted','calendars/index/'.$class.'/'.$year.'/'.$month);
			}else{
				$this->_msg('e','Failed','calendars/index/'.$class.'/'.$year.'/'.$month);
			}
		}
	}
	
}

