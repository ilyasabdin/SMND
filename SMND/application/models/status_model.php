<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class status_model extends CI_Model {

	public function input_status($data)
	{
		
		$query= $this->db->insert('status',$data);
		$result = $this->db->affected_rows();
		return $result;

	}
	public function getNotif()
	{


	    $notif = $this->db->get_where('status',['id_target'=>$this->session->userdata['role_id']]);
	    return $notif->result_array();
	}
	public function DeleteNotif($id){
			// $this->db->delete('status', array('id' => $id));
		result false;
	}
}
?>