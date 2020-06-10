<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Report_C extends CI_Controller {
		
		
		function __construct(){
			parent :: __construct();
			$this->load->model('notula_model');
			$this->load->model('agenda_model');
			$this->load->model('status_model');
			$this->load->library('pdf_report');
			
			// print_r("sasasa");
		}
		
		public function index()
		{
		
		}
		
		public function Report_notula($id)
		{
			$data['detail'] = $this->notula_model->Detail_data($id);
			$data['detailas'] = $this->notula_model->getPemimpinById($id);
			$this->load->view('Notula/Cetak_notula', $data);
			//print_r($data);
		}
		
		public function Cetak_Absensi($id)
		{
			//$data['data'] = $this->db->get_where('agenda', ['id'=>$id])->row();
			$data['detail'] = $this->agenda_model->getAgendaById($id);
			$data['detailas'] = $this->agenda_model->getPesertaByAgenda($id);
			$this->load->view('Agenda/Cetak_absensi', $data);
		}
		
		public function Putar_video()
		{
			if(isset ($_GET['pathvideo'])) {
				$pathvideo = $_GET['pathvideo'];
			}
			$where = array('pathvideo' => $pathvideo);
			$data['data'] = $this->notula_model->tampil_video('video',$where)->result();
			$this->load->view('Notula/putarvideo', $data);
			//var_dump($data);
		}
		public function Detail_notula($id)
		{
			//$detail = $this->notula_model->Detail_data($id);
			$data['title'] = 'Detail Notula';
			$data ['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
			$data['notif'] = $this->status_model->getNotif();
			$data['detail'] = $this->notula_model->Detail_data($id);
			$data['detailas'] = $this->notula_model->getPemimpinById($id);
			$data['catatan'] = json_decode($data['detail']->catatan_notula);
			
//			dd($data);
			
			
			$this->load->view('templates/header',$data);
			$this->load->view('templates/Sidebar',$data);
			$this->load->view('templates/Topbar',$data);
			$this->load->view('Notula/Detail_notula', $data);
			$this->load->view('templates/footer');
		}
		public function Detail_agenda($id)
		{
			if ( (int) $this->session->userdata['role_id'] === 3){
				$where = [
				  'id_target'=>3,
				  'id_user'=>1,
				  'id_select'=>$id,
				  'target'=>'agenda',
				  'aksi'=>'update'
				];
				$this->db->where($where);
				$this->db->delete('status');
			}
			
			
			//$detail = $this->notula_model->Detail_data($id);
			$data['title'] = 'Detail Agenda';
			
			$data ['user'] = $this->db->get_where('user', ['email' =>
			  $this->session->userdata('email')])->row_array();
			$data['notif'] = $this->status_model->getNotif();
			$data['detail'] = $this->agenda_model->getAgendaById($id);
			$data['detailas'] = $this->agenda_model->getPesertaByAgenda($id);
			$data['id'] = $id;
			// print_r($data);
			// var_dump($data['detail']);
			$this->load->view('templates/header',$data);
			$this->load->view('templates/Sidebar',$data);
			$this->load->view('templates/Topbar',$data);
			$this->load->view('Agenda/Detail_agenda', $data);
			$this->load->view('templates/footer');
		}
		public function test(){
			print_r($this->status_model->getNotifAdmin());
		}
		/*
		 * Download notula pdf
		 */
		final public function get(){
		
		}
		
	}
