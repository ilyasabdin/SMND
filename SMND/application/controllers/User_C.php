<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_C extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('status_model');
			is_logged_in();
		}

	public function index()
	{	
		$data ['title'] = 'Halaman User';
		$data ['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		$data['notif'] = $this->status_model->getNotif();
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/Sidebar',$data);
		$this->load->view('templates/Topbar',$data);
		$this->load->view('User/User',$data);
		$this->load->view('templates/footer');

	}
	public function delete_user($id)
	{
		$this->agenda_model->delete_user($id);
		if ($this->db->affected_rows() >0) {
			echo "<script> alert('User Berhasil Dihapus')</script>";
			}
			echo "<script> window.location='".site_url('User_C/Listuser')."';</script>"; 
	}

}
