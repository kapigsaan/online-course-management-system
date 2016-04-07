<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_calendar extends CI_Model 
{

	public function get_event($id = FALSE)
	{
		if ($id) {
			$this->db->where('event_batch_code',$id);
			$query = $this->db->get('calendar');
			return $query->num_rows() > 0 ? $query->result() : FALSE;
		}else{
			return FALSE;
		}
	}
	public function get_all_event_for($month,$year)
	{
		$dateasd = $year. '-' . $month;

		$sql = "SELECT *
				FROM calendar
				WHERE event_date
				LIKE ?
				GROUP BY event_batch_code
				ORDER BY start
				";
		$query = $this->db->query($sql,['%'.$dateasd.'%']);

		return $query->num_rows() > 0 ? $query->result() : FALSE;
	}

	public function get_all_events($year,$month,$class=FALSE)
	{
		if($year AND $month)
		{
			if ($class) {
				
				$sql = 'SELECT *,
							   day(event_date) as day_of_event
						FROM calendar
						WHERE month(event_date) = ?
						AND year(event_date) = ? 
						AND class_id = ? ';

				$result = $this->db->query($sql,[$month,$year,$class]);	
				
				if($result->num_rows() >= 1)
				{
					foreach($result->result() as $k => $v)
					{
						$events[$v->day_of_event][]= ['name'=>$v->title,'desc'=>$v->desc,'col'=>$v->color,'ebc'=>$v->event_batch_code];
					}
					return $events;
				}else{
					return array();
				}
			}else{
				
				$sql = 'SELECT *,
							   day(event_date) as day_of_event
						FROM calendar
						WHERE month(event_date) = ?
						AND year(event_date) = ? ';

				$result = $this->db->query($sql,[$month,$year]);	
				
				if($result->num_rows() >= 1)
				{
					foreach($result->result() as $k => $v)
					{
						$events[$v->day_of_event][]= ['name'=>$v->title,'desc'=>$v->desc,'col'=>$v->color,'ebc'=>$v->event_batch_code];
					}
					return $events;
				}else{
					return array();
				}				
			}

		}else{
			return array();
		}

	}

	public function get_end_of_event($date = FALSE)
	{	
		$end = DateTime::createFromFormat('m/d/Y',date("m/d/Y", strtotime($date)));
		$end->modify( '-1 day' );
		$end = $end->format('m/d/Y');
		return $end;
	}

	public function new_event($event_details = '', $class = FALSE, $created_by = FALSE)
	{
		$srt = DateTime::createFromFormat('m/d/Y',$event_details['start']);
		$end = DateTime::createFromFormat('m/d/Y',$event_details['end']);
		//check if date is not false
		if($srt && $end)
		{
			//check if dates are valid dates
			if($this->validateDate($srt->format('m/d/Y'),'m/d/Y') && $this->validateDate($end->format('m/d/Y'),'m/d/Y'))
			{
				//check if start date is lesser than end date
				if($srt->format('U') <= $end->format('U'))
				{
					//adjust day add additional 1 day at the end
					$end->modify( '+1 day' );

					//set the interval to 1 day
					$interval = new DateInterval('P1D');

					//start the dateperiod
					$alldates = new DatePeriod($srt,$interval,$end);	
					
					// vd($alldates);
					$batch_id = bin2hex(openssl_random_pseudo_bytes(2)).time();
					if($alldates == TRUE)
					{
						foreach($alldates as $k => $_date)
						{
							$dates[$k]['created_by'] = $created_by;
							$dates[$k]['class_id'] = $class;
							$dates[$k]['event_date'] = $_date->format('Y-m-d');
							$dates[$k]['title'] = $event_details['title'];
							$dates[$k]['start'] = $srt->format('Y-m-d');
							$dates[$k]['end'] = $end->format('Y-m-d');
							$dates[$k]['desc'] = $event_details['desc'];
							$dates[$k]['color'] = $event_details['optradio'];
							$dates[$k]['event_batch_code'] = $batch_id;
							$dates[$k]['created_at'] = NOW;
						}

						return $this->_insert_event($dates);

					}else{
						return FALSE;
					}

				}else{
					// pd('Start Date Cannot be Greater than End');
					return (object)['stat'=>false,'msg'=>'Start Date Cannot be Greater than End'];		
				}
			}else{
				// pd('wrong date');
				return (object)['stat'=>false,'msg'=>'You have a wrong date'];		
			}	
		}else
		{
			// pd('invalid dates');
			return (object)['stat'=>false,'msg'=>'Invalid Dates'];
		}
	}

	private function _insert_event($data)
	{
		// pd($data);
		$this->db->insert_batch('calendar',$data);
		$TRUE = ['stat'=>true,'msg'=>'Successfully Set New Event'];
		$FALSE = ['stat'=>false,'msg'=>'Unable to save Event'];
		return $this->db->affected_rows() >=1 ? (object)$TRUE : (object)$FALSE;
	}

	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

	public function delete_event($id = FALSE)
	{
		if ($id) {
			$this->db->where('event_batch_code', $id);
			$this->db->delete('calendar');
			return $this->db->affected_rows() >=1 ? TRUE : FALSE;
		} else {
			FALSE;
		}
		
	}

	function edit_event($old_data,$new_data)
	{
		if($old_data && $new_data)
		{
			if($old_data[0]->event_batch_code == $new_data['codec'])
			{

				// pd($old_data);

				$srt = DateTime::createFromFormat('m/d/Y',$new_data['start']);
				$end = DateTime::createFromFormat('m/d/Y',$new_data['end']);
				if($this->delete_event($old_data[0]->event_batch_code))
				{
					//check if dates are valid dates
					if($this->validateDate($srt->format('m/d/Y'),'m/d/Y') && $this->validateDate($end->format('m/d/Y'),'m/d/Y'))
					{
						//check if start date is lesser than end date
						if($srt->format('U') <= $end->format('U'))
						{
							//adjust day add additional 1 day at the end
							$end->modify( '+1 day' );

							//set the interval to 1 day
							$interval = new DateInterval('P1D');

							//start the dateperiod
							$alldates = new DatePeriod($srt,$interval,$end);	
												

							if($alldates == TRUE)
							{
								//create uniqe batch id to easily identify an event
								$batch_id = bin2hex(openssl_random_pseudo_bytes(2)).time();
								foreach($alldates as $k => $_date)
								{
									$dates[$k]['event_date'] = $_date->format('Y-m-d');
									$dates[$k]['title'] = $new_data['title'];
									$dates[$k]['start'] = $srt->format('Y-m-d');
									$dates[$k]['end'] = $end->format('Y-m-d');
									$dates[$k]['desc'] = $new_data['desc'];
									$dates[$k]['color'] = $new_data['optradio'];
									$dates[$k]['event_batch_code'] = $batch_id;
									$dates[$k]['created_at'] = NOW;
									
								}
								return $this->_insert_event($dates);

							}else{
								return FALSE;
							}

						}else{
							// pd('Start Date Cannot be Greater than End');
							return (object)['stat'=>false,'msg'=>'Start Date Cannot be Greater than End'];		
						}
					}else{
						// pd('wrong date');
						return (object)['stat'=>false,'msg'=>'You have a wrong date'];		
					}	


				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

}