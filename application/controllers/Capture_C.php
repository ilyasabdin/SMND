<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Capture_C extends CI_Controller {
		
		public function __construct()
		{
				parent::__construct();
				$this->load->helper('url');
				$this->load->model('notula_model');
				$this->load->model('agenda_model');
				$this->load->model('user_model');
				$this->load->model('status_model');
								
		}
		public function index()
		{
				
				$data ['title'] = 'Buat Notula';
				$data ['user'] = $this->db->get_where('user', ['email' =>
					 $this->session->userdata('email')])->row_array();
				$data['row'] = $this->agenda_model->get();
				$data['peserta'] = $this->user_model->fetch_peserta();
				$data['agenda'] = $this->notula_model->fetch_judul();
				$data['notif'] = $this->status_model->getNotif();
				
				$this->load->view('templates/header',$data);
				$this->load->view('templates/Sidebar',$data);
				$this->load->view('templates/Topbar',$data);
				$this->load->view('Notula/add_notula', $data);
				$this->load->view('templates/footerwebcam');
				
		}
		private function do_upload($name,$upload_path, $nameprefix,$extension){
				$config['upload_path'] = './'.$upload_path;
				$config['allowed_types'] = '*';
				$config['file_name'] = $nameprefix.'-'.date('ymdhms').'.'.$extension;
				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->upload->data();
				if ($this->upload->do_upload($name)){
						return $this->upload->data('file_name');
				}else{
						dd($this->upload->display_errors());
				}
				return false;
		}
		private function save_pdf($id_agenda){
				return $this->do_upload('materi','uploads/notula/','materi-notula-'.$id_agenda,'pdf');
		}
		private function save_image($id_agenda){
				$paths = [];
				$files = $_FILES;
				foreach ($_FILES['image']['name'] as $i => $file){
						$_FILES['tmp-image']['name'] = $files['image']['name'][$i];
						$_FILES['tmp-image']['type']= $files['image']['type'][$i];
						$_FILES['tmp-image']['tmp_name']= $files['image']['tmp_name'][$i];
						$_FILES['tmp-image']['error']= $files['image']['error'][$i];
						$_FILES['tmp-image']['size']= $files['image']['size'][$i];
						$config['upload_path'] = './uploads/notula/';
						$config['allowed_types'] = '*';
						$config['file_name'] = 'img-notula-'. $id_agenda .'-'. date('ymdhms') .'.jpg';
						$this->load->library('upload');
						$this->upload->initialize($config);
						if ($this->upload->do_upload('tmp-image')){
								$paths [] = $config['upload_path'] . $config['file_name'];
						}else{
								dd($this->upload->display_errors(),'lol');
						}
				}
				return json_encode($paths);
		}
		
		
		public function save()
		{
				$this->load->library('formvalidation');
				$this->formvalidation->set_rules('catatan','Catatan','catatan');
				$this->formvalidation->set_rules('peserta[]','Peserta','required');
				if ($this->formvalidation->run()){
						$id_agenda =  $this->input->post('judul');
						$data = [
							 'id_agenda'=>$id_agenda,
							 'catatan'=>$this->input->post('catatan'),
							 'image'=>$this->save_image($id_agenda),
							 'materi'=>$this->save_pdf($id_agenda),
							 'create_at' => date('Y-m-d H:i:s'),
							 'update_at' => date('Y-m-d H:i:s'),
						];
						$peserta = $this->input->post('peserta');
						$this->notula_model->input_notula($data, $id_agenda, $peserta);
						echo json_encode(['redirect'=>site_url('Notula_C/manageNotula')]);
				}else{
						echo json_encode(
							 ['redirect'=>site_url('Capture_C/save'),
									'errors'=>$this->formvalidation->error_array(),
									'message'=>'Terjadi kesalahan'
							 ]);
				}
		}
		public function getAgendaById()
		{
				$id = $_GET['id'];
				
				$data = $this->agenda_model->getAgendaById($id);
				// print_r($data);
				print_r(json_encode($data));
		}
		public function getPesertaByAgenda()
		{
				$id = $_GET['id'];
				$data = $this->agenda_model->getPesertaByAgenda($id);
				
				print_r(json_encode($data));
		}
}
