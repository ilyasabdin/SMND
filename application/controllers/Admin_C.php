<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_C extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('user_model');
        $this->load->model('agenda_model');
        $this->load->model('notula_model');
        $this->load->model('status_model');
        $this->load->library('user_agent');
    }

    public function index()
    {
	    $id = $this->session->userdata('id');
	    $notulaCalendar = new NotulaCalendar\NotulaCalendar($id);
	    $data ['title'] = 'Halaman Admin';
	    $data ['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
        $data['notif'] = $this->status_model->getNotif();
        $data['total'] = $this->agenda_model->totalAgenda();
        $data['totaln'] = $this->notula_model->totalNotula();
        $data['notulaterbaru'] = $this->notula_model->getNotulaTerbaru();
        
        $this->load->view('templates/header',$data);
        $this->load->view('templates/Sidebar',$data);
        $this->load->view('templates/Topbar',$data);
        $this->load->view('Admin/Admin',$data);
        $this->load->view('templates/footer');

    }
    public function listUser()
    {
        $this->load->model('user_model');
        $data ['title'] = 'Data User';
        $data ['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
        $data['row'] = $this->user_model->get();
        $data['notif'] = $this->status_model->getNotif();
        //$data['row'] = $this->user_model->getrole_id();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/Sidebar',$data);
        $this->load->view('templates/Topbar',$data);
        $this->load->view('Admin/Listuser',$data);
        $this->load->view('templates/footer');
    }
    public function delete_user($id)
    {
        $this->user_model->delete_user($id);
        if ($this->db->affected_rows() >0) {
            echo "<script> alert('User Berhasil Dihapus')</script>";
        }
        echo "<script> window.location='".site_url('Admin_C/Listuser')."';</script>";
    }
    public function edit($id){
        $data ['title'] = 'Data User';
        $data ['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();
        $data['row'] = $this->db->get_where('user',['id'=>$id]);
        $data['notif'] = $this->status_model->getNotif();
        /*
         * Mencari user yang akan di edit berdasarkan parameter id
         */
        $query = $this->db->get_where('user',['id'=>$id]);
        $userToedit= $query->result_object()[0];
        $this->load->view('templates/header',$data);
        $this->load->view('templates/Sidebar',$data);
        $this->load->view('templates/Topbar',$data);
        $this->load->view('Admin/EditUser',($userToedit));
        $this->load->view('templates/footer');
    }
    public function update($id){
        $query = $this->db->get_where('user',['id'=>$id]);
        $userToedit= $query->result_array()[0];
        $input_data = $this->input->post();
        $dataToUpdate = [];
        foreach ($input_data as $column =>$value){
            if ($userToedit[$column]!= $value){
                $dataToUpdate[$column] = $value;
            }
        }
        if (count($dataToUpdate)){
            $this->db->set($dataToUpdate);
            $this->db->where('id',$id);
            $this->db->update('user');
        }
        $this->session->mark_as_flash(['status'=>'updated']);
        redirect(site_url('Admin_C/listUser'));
    }
    public function DeleteNotif($id){
        if($this->status_model->DeleteNotif($id)){
         echo json_encode(['status'=>true]);
         return "";
        }
      echo json_encode(['status'=>false]);
    }

}