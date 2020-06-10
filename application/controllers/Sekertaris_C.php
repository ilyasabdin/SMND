<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekertaris_C extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('status_model');
			$this->load->model('agenda_model');
        	$this->load->model('notula_model');
			is_logged_in();
		}

	public function index()
	{	
		$id = $this->session->userdata('id');
		$token = $this->session->userdata('token');
		$notulaCalendar = new NotulaCalendar\NotulaCalendar($id);
		$data ['title'] = 'Halaman Sekertaris';
		$data ['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		$data['notif'] = $this->status_model->getNotif();
        $data['total'] = $this->agenda_model->totalAgenda();
        $data['totalt'] = $this->agenda_model->totalAgendaTanpaNotula();
        $data['totaln'] = $this->notula_model->totalNotula();
        $data['notulaterbaru'] = $this->notula_model->getNotulaTerbaru();
        $data['row'] = $this->agenda_model->get();
        
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/Sidebar',$data);
		$this->load->view('templates/Topbar',$data);
		$this->load->view('Sekertaris/Sekertaris',$data);
		$this->load->view('templates/footer');

	}

}
