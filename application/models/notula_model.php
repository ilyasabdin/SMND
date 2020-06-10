 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notula_model extends CI_Model {
		
		
		public function get($id = null)
		{
				$this->db->get_where('notula', ['id'=>$id]);
				$this->db->join('agenda','notula.id_agenda = agenda.id');
				$this->db->select(['agenda.*','notula.id as id_notula','notula.catatan as catatan_notula','image','notula.materi']);
				$query = $this->db->get('notula')->result_object();
//        dd($query);
				return $query;
		}
		public function getvideo($id = null)
		{
//				$this->db->from('video');
				$this->db->
				select(['id_video','agenda.id as id_agenda','agenda.judul','video.pathvideo as path','agenda.is_finish'])
					 ->from('video')
					 ->join('agenda','agenda.id = id_agenda');
				if ($id != null) {
						$this->db->where('id_video', $id);
				}
				$query = $this->db->get();
				return $query;
		}
		public function Detail_data($id)
		{
				$this->db->join('agenda','notula.id_agenda = agenda.id');
				$this->db->join('user','agenda.id_pemimpin = user.id');
				$query = $this->db->select(['agenda.*',
					 'user.nama as pemimpin',
					 'notula.id as id_notula',
					 'notula.catatan as catatan_notula',
					 'image','notula.materi'])->where('notula.id',$id);
				return $query->get('notula')->row_object();
		}
		public function fetch_judul()
		{
				$this->db->order_by('tanggal','asc');
				$this->db->where(['agenda.is_finish'=>'0']);
				$this->db->where(['agenda.status'=>'1']);
				$query= $this->db->get('agenda');
				return $query->result();
		}
		public function delete_notula($id_notula, $id_agenda)
		{
				$this->db->set('id_notula',NULL);
				$this->db->where('id', $id_agenda);
				$this->db->update('agenda');
				$this->db->where('id', $id_notula);
				$this->db->delete('notula');
		}
		private function getAgendaById($id_agenda){
				$this->db->select('*')
					 ->from('agenda')
					 ->where('id', $id_agenda);
				
				$query = $this->db->get();
				return $query->result()[0];
		}
		private function notifikasi_ketua($id_agenda, $notula){
				$agenda = $this->getAgendaById($id_agenda);
				$data = [
					 'aksi'=> 'create',
					 'target'=> 'notula',
					 'aksi_selanjutnya' => site_url('Report_C/Detail_notula/' . $notula->id),
					 'create_at' => date('Y-m-d H:i:s'),
					 'judul'=>$this->session->userdata['nama']   .' membuat notula rapat '. $agenda->judul,
					 'pesan'=>'Judul agenda : '.$agenda->judul,
						/*
						 * Id user sebagai sekertaris atau yang melakukan aksi
						 */
					 'id_user'=>$this->session->userdata['id'],
						/*
						 */
					 'id_target'=>3,
				];
				$this->db->insert('status',$data);
		}
		public function input_notula($data, $id_agenda, $pesertas)
		{
				$pesertas = explode(',',$pesertas[0]);
				foreach ($pesertas as $peserta){
						$where = ['id_agenda'=>$id_agenda, 'id_peserta'=>$peserta];
						$this->db->where($where);
						$this->db->set('kehadiran',1);
						$this->db->update('list_peserta');
				}
				$this->db->insert('notula', $data);
				$notula = $this->getLastInserted();
				$this->notifikasi_ketua($id_agenda,$notula);
				return $this->db->affected_rows() === 1;
		}
		function getLastNotula()
		{
				$this->db->order_by('id', 'DESC')
					 ->limit (1);
				
				$query = $this->db->get('notula');
				
				return $query->row_array();
		}
		public function getPemimpinById($id)
		{
				$this->db->select('user.nama as pemimpin')
					 ->from('agenda')
					 ->join('user','agenda.id_pemimpin = user.id')
					 ->join('notula','agenda.id = notula.id_agenda')
					 ->where('notula.id ='.$id);
				
				$query = $this->db->get();
				return $query->result();
		}
		public function getPesertaByNotula($id_notula)
		{
				
				$this->db->select('user.nama as peserta, user.id,list_peserta.kehadiran')
					 ->from('user')
					 ->join('list_peserta','list_peserta.id_peserta = user.id')
					 ->join('agenda','agenda.id = list_peserta.id_agenda')
					 ->join('notula','agenda.id = notula.id_agenda')
					 ->where('notula.id ='.$id_notula);
				
				$query = $this->db->get();
				return $query->result();
		}
		function tampil_video($table,$where){
				return $this->db->get_where($table,$where);
		}
		public function cetak($id)
		{
				$this->db->select('agenda.*, notula.*, notula.catatan as catatan_notula')
					 ->from('notula')
					 ->join('agenda', 'agenda.id_notula = notula.id')
					 ->where('notula.id', $id);
				
				$query = $this->db->get()->result();
				return $query;
		}
		function getLastInserted()
		{
				$query = $query = $this->db->select('*')->order_by('id','desc')->limit(1)->get('notula')->row();
				return $query;
		}
		function updateNotula($data, $agendaID){
				$data['catatan'] = $data['catatan_notula'];
				unset($data['catatan_notula']);
				$this->db->set($data);
				$this->db->where('id_agenda', $agendaID);
				$this->db->update('notula');
		}
		function savevideo($data){
				$this->db->insert('video',$data);
				$this->notifikasi_video($data['id_agenda']);
		}
		public function notifikasi_video($id_agenda, $aksi = 'create'){
				$agenda = $this->getAgendaById($id_agenda);
				$data = [
					 'aksi'=> $aksi,
					 'target'=> 'video',
					 'aksi_selanjutnya' => site_url('Notula_C/manageVideo'),
					 'create_at' => date('Y-m-d H:i:s'),
					 'judul'=>$this->session->userdata['nama']. ' ' . ($aksi === 'create' ? ' membuat': 'menghapus') .'  video rapat '. $agenda->judul,
					 'pesan'=>'Video agenda : '.$agenda->judul,
						/*
						 * Id user sebagai sekertaris atau yang melakukan aksi
						 */
					 'id_user'=>$this->session->userdata['id'],
						/*
						 */
					 'id_target'=>3,
				];
				$this->db->insert('status',$data);
				if ($this->session->userdata['id']!= 1){
						$data['id_target'] = 1;
						$this->db->insert('status',$data);
				}
		}
		public function video_exists($id_agenda){
				$check = $this->db->get_where('video',['id_agenda'=>$id_agenda],1);
				return $check->row_object();
		}
		public function delete_video($id_video){
				$video = $this->notula_model->getvideo($id_video)->row_object();
				$this->notifikasi_video($video->id_agenda, 'delete');
				$this->db->where('id_video',$id_video);
				$this->db->delete('video');
				unlink('uploads/video/'. $video->path);
		}
		public function totalNotula()
		{
			$query = $this->db->get('notula');
			 if($query->num_rows()>0)
			    {
			      return $query->num_rows();
			    }
			    else
			    {
			return 0; 
			}	
		
		}
		function getNotulaTerbaru($id=null)
		{
			// $this->db->select('*')->from('notula')->join('agenda','agenda.id = notula.id_agenda')->order_by('notula.id','desc')->limit(1);
			 
			// $query = $this->db->get();
			// return $query->result();
			$this->db->get_where('notula', ['id'=>$id]);
				$this->db->join('agenda','notula.id_agenda = agenda.id');

				$this->db->select(['agenda.*','notula.id as id_notula','notula.catatan as catatan_notula','image','notula.materi']);
				$this->db->order_by('notula.id','desc')->limit(1);
				$query = $this->db->get('notula')->result_object();
				return $query;
		}
		
		
}
?>