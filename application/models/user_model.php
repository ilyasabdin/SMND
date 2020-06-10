<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model {

	function simpan($data)
	{
		$data = array(
			'nama'=>$nama,
			'email'=>$email,
			'password'=>$password1,
			'role_id'=>$role_id,
			'is_active' => $is_active,
			'date_created' => $date_created

		);
		$query= $this->db->insert('user',$data);
		$result = $this->db->affected_rows();
		return $result;

	}
	public function get($id = null)
	{
		$this->db->select('role.role as role, user.*')
			->from('role')
			->join('user', 'user.role_id = role.id');

		$query = $this->db->get();
		return $query;
	}
	public function getrole_id()
	{
		$query = "SELECT `user`.*, `role`.`role` 
					FROM `user` JOIN `role`
					ON `user`.`id` = `role`.`id
				";
		return $this->db->query($query)->result();
	}
	function fetch_peserta()
	{
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get('user');
		return $query->result();
	}
	public function getEmailByID($id)
	{
		$this->db->select('email')->where('id', $id);
		$query = $this->db->get('user');
		return $query->row_array();

	}
	public function delete_user($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user');
	}
	public function updateToken(string  $id,string  $token){
		$this->db->where('id',$id);
		$this->db->set(['calendar_token'=> $token]);
		$this->db->update('user');
	}
	public function notifikasi_agenda(array $agenda){

	}
}
