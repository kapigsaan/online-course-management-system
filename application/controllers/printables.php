<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Printables extends MY_AdminController 
{
    public function __construct()
    {
        parent::__construct();
    	$this->view_data['system_message'] =$this->_msg();
        $this->load->model('M_users','mu');
		$this->load->model('M_students','ms');
		$this->load->model('M_classes','cl');
		$this->load->model('M_content','mc');
    }

    public function print_instructors()
	{
		//this data will be passed on to the view
		$instructors = $this->mc->get_user_where('instructor');
		$data['Head'] = 'Instructors Lists';
		$data['content'] = $instructors;
		$data['classes'] = FAlSE;
		$data['students_class'] = FAlSE;
		$data['mystudent'] = FAlSE;

		//load the view, pass the variable and do not show it but "save" the output into $html variable
		$html = $this->load->view('printables/pdf_output', $data, true); 

		//this the the PDF filename that user will get to download
		$pdfFilePath = "instructors_pdf.pdf";

		//load mPDF library
		$this->load->library('m_pdf');
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		//$pdf->Output($pdfFilePath, "D");

		//browser
  		$pdf->Output();
	}

	public function print_students()
	{
		//this data will be passed on to the view
		$students = $this->mc->get_user_where('student');
		$data['Head'] = 'Students Lists';
		$data['content'] = $students;
		$data['students_class'] = FAlSE;
		$data['classes'] = FAlSE;
		$data['mystudent'] = FAlSE;

		//load the view, pass the variable and do not show it but "save" the output into $html variable
		$html = $this->load->view('printables/pdf_output', $data, true); 

		//this the the PDF filename that user will get to download
		$pdfFilePath = "students_pdf.pdf";

		//load mPDF library
		$this->load->library('m_pdf');
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		//$pdf->Output($pdfFilePath, "D");

		//browser
  		$pdf->Output();
	}

	public function print_subjects()
	{
		//this data will be passed on to the view
		$Classes = $this->cl->get_all_classes_with_insturctor();
		$data['Head'] = 'Classes Lists';
		$data['classes'] = $Classes;
		$data['content'] = FAlSE;
		$data['students_class'] = FAlSE;
		$data['mystudent'] = FAlSE;

		//load the view, pass the variable and do not show it but "save" the output into $html variable
		$html = $this->load->view('printables/pdf_output', $data, true); 

		//this the the PDF filename that user will get to download
		$pdfFilePath = "students_pdf.pdf";

		//load mPDF library
		$this->load->library('m_pdf');
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		//$pdf->Output($pdfFilePath, "D");

		//browser
  		$pdf->Output();
	}

	public function print_student_by_class()
	{
		//this data will be passed on to the view
		$Classes = $this->cl->get_all_classes_with_students();
		$data['Head'] = 'Students By Class';
		$data['students_class'] = $Classes;
		$data['classes'] = FAlSE;
		$data['content'] = FAlSE;
		$data['mystudent'] = FAlSE;

		//load the view, pass the variable and do not show it but "save" the output into $html variable
		$html = $this->load->view('printables/pdf_output', $data, true); 

		//this the the PDF filename that user will get to download
		$pdfFilePath = "students_pdf.pdf";

		//load mPDF library
		$this->load->library('m_pdf');
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		//$pdf->Output($pdfFilePath, "D");

		//browser
  		$pdf->Output();
	}

	public function print_my_student_by_class($class = FAlSE)
	{
		if ($class) {
			//this data will be passed on to the view
			$Classes = $this->cl->print_my_student_by_class($class);
			$classs = $this->cl->get_class($class);
			$data['Head'] = 'Students in '.$classs;
			$data['students_class'] = FAlSE;
			$data['classes'] = FAlSE;
			$data['content'] = FAlSE;
			$data['mystudent'] = $Classes;

			//load the view, pass the variable and do not show it but "save" the output into $html variable
			$html = $this->load->view('printables/pdf_output', $data, true); 

			//this the the PDF filename that user will get to download
			$pdfFilePath = "students_pdf.pdf";

			//load mPDF library
			$this->load->library('m_pdf');
			//actually, you can pass mPDF parameter on this load() function
			$pdf = $this->m_pdf->load();
			//generate the PDF!
			$pdf->WriteHTML($html);
			//offer it to user via browser download! (The PDF won't be saved on your server HDD)
			//$pdf->Output($pdfFilePath, "D");

			//browser
	  		$pdf->Output();
		}else{
			show_404();
		}
		
	}
}