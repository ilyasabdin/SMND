<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class status_model extends CI_Model {

	public function input_status($data)
	{
		
		$query= $this->db->insert('status',$data);
		$result = $this->db->affected_rows();
		return $result;

	}
	public function DeleteNotif(int $id){
	 return ($this->db->delete('status', array('id' => $id)));
	}
	public function getNotif()
	{
	    $notif = $this->db->order_by('create_at','desc')->get_where('status',['id_target'=>$this->session->userdata['role_id']]);
	    return $notif->result_array();
//		$this->db->select('status.id as status_id, status.aksi, status.target, status.id_target, status.create_at as status_create')
//	     ->from('status')
//	     ->join('user','status.id_user = user.id')
//	     ->where('status.aksi_selanjutnya', null);
//	     if($this->session->userdata['role_id'] == 1){
//	    	$this->db->where('user.role_id' , 3);
//	     } else if($this->session->userdata['role_id'] == 3){
//	     	$this->db->where('user.role_id' , 4);
//	     } else ($this->session->userdata['role_id'] == 4){
//	     	$this->db->where('user.role_id' , 1)
//	     };
//		$query = $this->db->get();
//		$result = $query->result();
//		$result2 = array();
//
//		foreach($result as $val){
//			$i = 0;
//			$this->db->select('*')
//				->from($val->target)
//				->where('id', $val->id_target);
//			$query2 = $this->db->get();
//			$temp = $query2->row_object();
//
//			array_push($result2, (object) array_merge((array)$val, (array) $temp));
//		}
//
//		return $result2;
	}

	
}
?>