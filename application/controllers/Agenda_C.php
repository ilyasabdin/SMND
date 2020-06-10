<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Agenda_C extends CI_Controller {
	function __construct(){
		parent :: __construct();
		foreach (['agenda_model','user_model','status_model'] as $model){
			$this->load->model($model);
		}
	}
	private function loadview($view_name, $title_name, $data = []){
		$data ['title'] = $title_name;
		$data ['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data ['peserta'] = $this->user_model->fetch_peserta();
		$data ['notif'] = $this->status_model->getNotif();
		$data ['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		if ($this->session->has_userdata('errors')){
			$data['errors'] = $this->session->userdata('errors');
		}
		$this->load->view('templates/header',$data);
		$this->load->view('templates/Sidebar',$data);
		$this->load->view('templates/Topbar',$data);
		$this->load->view($view_name, $data);
		$this->load->view('templates/footeragenda');
	}
	private function do_upload($isupdate = true){
		$config['upload_path']          = './uploads/agenda/';
		$config['allowed_types']        = 'pdf';
		$config['file_name']        = 'materi-'.date('ymdhms').'.pdf';
		$this->load->library('upload');
		$this->upload->initialize($config);
		if ($this->upload->do_upload('materi')){
			return $this->upload->data('file_name');
		}else{
			if ($isupdate){return true;}
			d($this->upload->display_errors());
		}
		return false;
	}
	public function index()
	{
		$this->loadview('Agenda/listagenda','Agenda',
			['row'=>$this->agenda_model->get()]
		);
	}
	public function AgendaTanpaNotula()
	{
		$data ['title'] = 'Notula';
		$data ['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		$data['row'] = $this->agenda_model->AgendaTanpaNotula();
		$data['notif'] = $this->status_model->getNotif();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/Sidebar',$data);
		$this->load->view('templates/Topbar',$data);
		$this->load->view('Agenda/agendaTanpaNotula',$data);
		$this->load->view('templates/footer');
	}
	public function manageAgenda()
	{
		$data ['title'] = 'Agenda';
		$data ['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		$data['row'] = $this->agenda_model->get();
		$data['notif'] = $this->status_model->getNotif();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/Sidebar',$data);
		$this->load->view('templates/Topbar',$data);
		$this->load->view('Agenda/manageAgenda',$data);
		$this->load->view('templates/footer');

	}
	public function add_agenda()
	{
		$this->loadview('Agenda/add_agenda','Buat agenda',
			[
				'peserta'=>$this->user_model->fetch_peserta(),
				'row'=>$this->agenda_model->get(),
			]
		);
	}
	public function delete_agenda($id)
	{
		$this->agenda_model->delete_agenda($id);
		if ( (int) $this->session->userdata['role_id'] === 3){
			$where = [
				'id_target'=>1,
				'id_user'=>3,
				'id_select'=>$id,
				'target'=>'agenda',
				'aksi'=>'create'
			];
			$this->db->where($where);
			$this->db->delete('status');
		}
		if ($this->db->affected_rows() >0) {
			echo "<script> alert('Agenda Berhasil Dihapus')</script>";
		}
		echo "<script> window.location='".base_url('Agenda_C/manageAgenda')."';</script>";
	}
	public function test(){
		print_r($this->status_model->getNotifAdmin());
	}
	function input_agenda()
	{
		$this->formvalidation();
		if ($this->form_validation->run()==false) {
			$this->session->set_flashdata('errors',$this->form_validation->error_array());
			$this->session->set_flashdata('olds',$this->input->post());
			$this->form_validation->error_array();
			return redirect(site_url('Agenda_C/add_agenda'));
		}else{
			$post = $this->input->post(null, TRUE);
			$post['materi'] = $this->do_upload();
			$agenda = $this->agenda_model->input_agenda($post, $this->session->userdata['id']);
			if ($agenda){
				return redirect(
					site_url('Agenda_C/manageAgenda')
				);
			}
		}
	}
	public function edit($id){
		$data= [
			'values'=>(array) $this->agenda_model->Detail_data($id)[0],
			'peserta'=>$this->user_model->fetch_peserta(),
			'id'=>$id
		];
		$this->loadview('Agenda/Edit_agenda', 'Edit Agenda',$data);
	}
	public function update($id){

		$this->formvalidation(true);
		if (!$this->form_validation->run()==false){
			d($this->form_validation->error_array());
			exit();
		}else{
			$agenda = (array) $this->db->get_where('agenda',['id'=>$id])->row();
			$updated_data = [];
			foreach ($this->input->post() as $column=>$value){
				if (isset($agenda[$column])){
					if ($agenda[$column]!==$value ){
						$updated_data[$column] = $value;
					}
				}
			}
			if ($this->input->post('pemimpin') &&$this->input->post('pemimpin') !== $agenda['id_pemimpin']){
				$updated_data['id_pemimpin'] = $this->input->post('pemimpin');
			}
			if (isset($_FILES['materi'])){
				if ($filename = $this->do_upload(true)){
					if (is_string($filename)){
						$updated_data['materi'] = $filename;
					}
				}
			}
			if (count($updated_data)){
				$this->agenda_model->update_agenda($agenda,$id,$updated_data);
			}
			return redirect(
				site_url('Agenda_C/manageAgenda')
			);
		}
	}
	public function accept($id){
		$this->agenda_model->setujui_agenda($id, $this->input->post('tempat'));
		return redirect(site_url('Report_C/Detail_agenda/' . $id));
	}
	private function formvalidation($isupdate = false){
		$validations = [
			[
				'name'=>'judul',
				'rule'=>''.(!$isupdate?'|is_unique[agenda.judul]|alpha_numeric_spaces|max_length[128]':''),
				'message'=>[
					'is_unique' => 'Judul Sudah Digunakan!',
					"alpha_numeric_spaces"=>"Judul tidak sesuai",
					'max_length'=>"Judul terlalu panjang"
				]
			],
			['name'=>'pembahasan','rule'=>"|max_length[256]|alpha_numeric_spaces", "message"=>
			[
				'max_length'=>"Pembahasan terlalu panjang",
				"alpha_numeric_spaces"=>"Judul tidak sesuai",
			]
		],
			['name'=>'tempat'],
			['name'=>'pemimpin'],
			['name'=>'peserta[]'],
//            ['name'=>'materi'],
			['name'=>'catatan'],
			['name'=>'tanggal'],
		];
		foreach ($validations as $validation){
			$this->form_validation->set_rules(
				$validation['name']

				,ucfirst($validation['name'])
				,('required'. (isset($validation['rule'])? $validation['rule'] : ''))
				,isset($validation['message']) ? $validation['message'] : []
			);
		}
	}
}
