<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ketua_C extends CI_Controller {

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
//		$notulaCalendar = new NotulaCalendar\NotulaCalendar($id);
		$data ['title'] = 'Halaman Ketua';
		$data ['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		$data['notif'] = $this->status_model->getNotif();
		$data['total'] = $this->agenda_model->totalAgenda();
		$data['totaln'] = $this->notula_model->totalNotula();
		$data['notulaterbaru'] = $this->notula_model->getNotulaTerbaru();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/Sidebar',$data);
		$this->load->view('templates/Topbar',$data);
		$this->load->view('Ketua/Ketua',$data);
		$this->load->view('templates/footer');
	}

}
