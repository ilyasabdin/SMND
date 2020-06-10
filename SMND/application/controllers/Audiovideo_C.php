<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audiovideo_C extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->model('notula_model');
		$this->load->model('agenda_model');
		$this->load->model('status_model');
			
	}
	public function index()
	{
		$data ['title'] = 'Video';
		$data ['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		$data['row'] = $this->notula_model->getvideo();
		$data['notif'] = $this->status_model->getNotif();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/Sidebar',$data);
		$this->load->view('templates/Topbar',$data);
		$this->load->view('Notula/listvideo',$data);
		$this->load->view('templates/footer');
	}
	public function getAgenda()
	{
		$id = $_GET['id'];

		$data = $this->agenda_model->getAgenda($id);
		// print_r($data);
		print_r(json_encode($data));
	}

	

	
}
