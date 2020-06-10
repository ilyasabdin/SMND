<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumentasi_video_C extends CI_Controller {
		
		function __construct(){
				parent :: __construct();
				$this->load->model('notula_model');
				$this->load->model('agenda_model');
				$this->load->model('user_model');
				$this->load->model('status_model');
		}
		
		public function index()
		{
				$data['agenda'] = $this->notula_model->fetch_judul();
				$data ['title'] = 'Record Video';
				$data ['user'] = $this->db->get_where('user', ['email' =>
					 $this->session->userdata('email')])->row_array();
				$data['row'] = $this->agenda_model->get();
				$data['notif'] = $this->status_model->getNotif();
				$data['peserta'] = $this->user_model->fetch_peserta();
				
				$this->load->view('templates/header',$data);
				$this->load->view('templates/Sidebar',$data);
				$this->load->view('templates/Topbar',$data);
				$this->load->view('Notula/dokumen_video', $data);
				$this->load->view('templates/footervideo');
		}
		private function do_upload($id){
				$config['upload_path'] = './uploads/video/';
				$config['allowed_types'] = 'webm';
				$config['file_name'] = $id.'-video-'.date('ymdhms').'.webm';
				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->upload->data();
				if ($this->upload->do_upload('video')){
						return $this->upload->data('file_name');
				}else{
						dd($this->upload->display_errors());
				}
				return false;
		}
		public function store($id){
				$check = $this->notula_model->video_exists($id);
				if (!$check){
						$data = [
							 'id_agenda'=>$id,
							 'pathvideo'=>$this->do_upload($id)
						];
						$this->notula_model->savevideo($data);
						echo json_encode(['status'=>'saved','link'=>site_url('Notula_C/manageVideo'),'message'=>'Video berhasil di upload']);
						exit();
				}
				echo json_encode(['status'=>false,'link'=>site_url('Notula_C/manageVideo'),'message'=>'Agenda telah memiliki video']);
		}
		public function delete($id){
				$this->notula_model->delete_video($id);
				return redirect(site_url('Notula_C/manageVideo'));
		}
}
?>