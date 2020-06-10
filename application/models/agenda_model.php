<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class agenda_model extends CI_Model {

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		parent::__construct();
	}


	public function get($id = null)
	{
		$this->db->from('agenda');
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_judul($id = null)
	{
		$this->db->from('agenda');
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function delete_agenda($id)
	{

		$this->db->where('id', $id);
		$this->db->delete('agenda');

	}
	/*
	 * Proses pembuatan agenda
	 */
	private function parsefromrequest($post){
		$params = [];
		$params['judul'] = $post['judul'];
		$params['pembahasan'] = $post['pembahasan'];
		$params['tempat'] = $post['tempat'];
		$params['tanggal'] = $post['tanggal'];
		$params['id_pemimpin'] = $post['pemimpin'];
		$params['catatan'] = $post['catatan'];
		$params['create_at'] = date('Y-m-d H:i:s');
		$params['update_at'] = date('Y-m-d H:i:s');
		$params['materi'] = $post['materi'];
		return $params;
	}
	public function totalAgenda()
	{
		$query = $this->db->get('agenda');
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}

	}
	//masih salah
	public function totalAgendaTanpaNotula()
	{
		$t = $this->db->get('agenda');
		if($t->num_rows()>0)
		{
			return $t->num_rows();
		}
		else
		{
			return 0;
		}}

	private function simpan_peserta($id_agenda, $list_peserta, $is_update = false){
		if ($is_update){
			$this->db->where('id_agenda', $id_agenda);
			$this->db->delete('agenda');
		}
		foreach ($list_peserta as $id) {
			$par['id_peserta'] = $id;
			$par['id_agenda'] = $id_agenda;
			$this->db->insert('list_peserta', $par);
		}
	}
	private function notifikasi_admin($agenda){
		$data = [
			'aksi'=> 'create',
			'target'=> 'agenda',
			'id_select'=>$agenda['id'],
			'aksi_selanjutnya' => site_url('Report_C/Detail_agenda/' . $agenda['id']),
			'create_at' => date('Y-m-d H:i:s'),
			'judul'=>$this->session->userdata['nama'].' membuat agenda baru',
			'pesan'=>'Judul agenda : '.$agenda['judul'],
			/*
			 * Id user sebagai ketua atau yang melakukan aksi
			 */
			'id_user'=>3,
			/*
			 * Id admin otomatis 1
			 */
			'id_target'=>1,
		];
		$this->db->insert('status',$data);
	}
	public function input_agenda($post, $id_ketua)
	{
		$this->db->insert('agenda', $this->parsefromrequest($post));
		$agenda= $this->getLastId();
		$list_peserta= $post['peserta'];
		$this->simpan_peserta($agenda['id'], $list_peserta);
		$this->notifikasi_admin($agenda);
		return $agenda;
	}

	function getLastId()
	{
		$this->db->order_by('id', 'DESC')
			->limit (1);

		$query = $this->db->get('agenda');


		return $query->row_array();
	}
	public function getAgendaById($id)
	{
		$this->db->select('agenda.*, user.nama as pemimpin')
			->from('agenda')
			->join('user','agenda.id_pemimpin = user.id')
			->where('agenda.id ='.$id);

		$query = $this->db->get();
		return $query->result();
	}
	public function getPemimpinById($id)
	{
		$this->db->select('user.nama as pemimpin')
			->from('agenda')
			->join('user','agenda.id_pemimpin = user.id')
			->where('agenda.id ='.$id);

		$query = $this->db->get()->result();
		return $query;
	}
	public function getPesertaByAgenda($id)
	{
		$this->db->select('user.nama as peserta, user.id')
			->from('user')
			->join('list_peserta','list_peserta.id_peserta = user.id')
			->join('agenda','agenda.id = list_peserta.id_agenda')
			->where('agenda.id ='.$id);

		$query = $this->db->get();
		return $query->result();
	}
	public function Detail_data($id)
	{
		$this->db->select('*')
			->from('agenda')
			->where('agenda.id', $id);

		$query = $this->db->get()->result();
		return $query;
	}
	public function getAgenda($id)
	{
		$this->db->select('*')
			->from('agenda')
			->where('id', $id);

		$query = $this->db->get();
		return $query->result();
	}
	public function getHistoryAgenda($id)
	{
		$this->db->select('*')
			->from('agenda')
			->where('id', $id);

		$query = $this->db->get();
		return $query->result();
	}
	public function getDetailAgenda($id)
	{
		$this->db->select('*')
			->from('agenda')
			->where('id', $id);

		$query = $this->db->get();
		return $query->result();
	}

	function update_agenda($agenda , $id, $data){

		foreach ($data as $column=>$value){
			if (isset($agenda[$column])){
				$this->db->set($column, $value);
				$this->db->where('id',$id);
				$this->db->update('agenda');
			}
		}
		if (isset($data['peserta'])){
			$this->db->where('id_agenda', $id);
			$this->db->delete('agenda');
			$id_peserta= $data['peserta'];
			$par['id_agenda'] = $id;
			foreach ($id_peserta as $_id) {
				$par['id_peserta'] = $_id;
				$this->db->insert('list_peserta', $par);
			}
		}
	}
	function setujui_agenda($id_agenda, $tempat){
		$agenda = $this->getAgendaById($id_agenda)[0];
		if ($agenda->tempat!==$tempat){
			$this->notifikasi_ketua($id_agenda, $tempat);
		}
		$this->db->set('status',1);
		$this->db->set('tempat',$tempat);
		$this->db->where('id',$id_agenda);
		$this->db->update('agenda');
		$this->hapus_notifikasiAdmin($this->getAgendaById($id_agenda)[0]->id_pemimpin);
		$this->sentEmail($id_agenda, false);
		$this->sent_calendar_evt($id_agenda);
	}
	function sent_calendar_evt($idagenda){
		$initTable = function (array $select) use ($idagenda){
			$this->db->select($select);
			$this->db->from('user');
			$this->db->join('list_peserta', 'user.id = list_peserta.id_peserta');
			$this->db->where('id_agenda',$idagenda);
		};
		$initTable(['user.id','calendar_token']);
		$list_peserta = $this->db->get()->result();
		$agenda = $this->getAgendaById($idagenda)[0];
		$initTable(['email']);
		$attandance = $this->db->get()->result_array();
		foreach ($list_peserta as $peserta){
			if ($peserta->calendar_token) {
			$calendar = new NotulaCalendar\NotulaCalendar($peserta->id);
			$calendar->create_event(
				$agenda->judul,$agenda->pembahasan,$agenda->tempat, $agenda->tanggal,$attandance
			);	
			}
		}
	}
	function sentEmail($idagenda, $withnotulen = true){
		$this->db->select('user.email');
		$this->db->from('user');
		$this->db->join('list_peserta', 'user.id = list_peserta.id_peserta');
		$this->db->where('id_agenda',$idagenda);
		$list_peserta = $this->db->get()->result();
		$agenda = $this->getAgendaById($idagenda)[0];
		$notula = null;
		if ($withnotulen) {
					$this->db->from('notula');
		$this->db->where('id_agenda',$idagenda);
			$notula = $this->db->get()->result_array()[0];
		}

		foreach ($list_peserta as $peserta){
			try {
				$this->email->initialize();
				$this->email->from('jonlenonn182@gmail.com');
				$this->email->to($peserta->email);
				
				if ($notula) {
				foreach (json_decode($notula['image']) as $file){
					$this->email->attach($file);
				}	
				}
				$this->email->subject($notula? 'Hasil notulensi rapat' : 'Rapat reminder');
				$this->email->attach('./uploads/agenda/'. $agenda->materi);

				$body = '';
				foreach ([
					         'Judul'=>$agenda->judul,
					         'Pembahanasan'=>$agenda->pembahasan,
					         'Tempat'=>$agenda->tempat,
					         'Tanggal'=>$agenda->tanggal
				         ] as $title=> $_body){
					$body .=  "<p><strong>$title</strong> : $_body </p>";
				}
				if ($notula) {
				$body.= $notula['catatan'];
				}
				$this->email->message($body);
				$this->email->send();
			}catch (Exception $e){
				continue;
			}
		}
	}
	function Convert($delta) {
		$delta_obj = '';
		if (is_string($delta))
			$delta_obj = json_decode($delta);
		elseif (is_object($delta))
			$delta_obj = $delta;

		if (!isset($delta_obj) || !isset($delta_obj -> ops))
			throw new \Exception('Can\'t convert invalid Quill Delta to plaintext!');

		$plaintext = '';
		foreach($delta_obj -> ops as $op) {
			if (isset($op -> insert)) {
				if (is_string($op -> insert))
					$plaintext .= $op -> insert;
				else
					$plaintext .= ' ';
			}
		}
		return $plaintext;
	}
	function setujui_notula($id_agenda){
		$this->db->set('is_finish',1);
		$this->db->where('id',$id_agenda);
		$this->db->update('agenda');
		$this->hapus_notifikasiKetua($this->getAgendaById($id_agenda)[0]->id_pemimpin);
		$this->sentEmail($id_agenda);
	}


	/*
	 * Notifikasi
	 */
	private function notifikasi_ketua($id_agenda, $tempat){
		$agenda = $this->getAgendaById($id_agenda)[0];
		$data = [
			'aksi'=> 'update',
			'target'=> 'agenda',
			'id_select'=> $agenda->id,
			'aksi_selanjutnya' => site_url('Report_C/Detail_agenda/' . $agenda->id). '?agenda_id',
			'create_at' => date('Y-m-d H:i:s'),
			'judul'=>$this->session->userdata['nama']   .' menggati tempat rapat '. $agenda->judul,
			'pesan'=>'Tempat rapat baru : '.$tempat,
			/*
			 * Id role sebagai admin atau yang melakukan aksi
			 */
			'id_user'=>1,
			/*
			 * Id role sebagai ketua atau yang menerima notif
			 */
			'id_target'=>3,
		];
		$this->db->insert('status',$data);
	}



	private function hapus_notifikasiAdmin($id_pemimpin){
		$where = [
			'aksi'=>'create',
			'target'=>'agenda',
			'id_target'=>1,
		];
		$this->db->delete('status', $where);
	}
	private function hapus_notifikasiKetua($id_pemimpin){
		$where = [
			'aksi'=>'create',
			'target'=>'notula',
			'id_target'=>3,
		];
		$this->db->delete('status', $where);
	}
	public function AgendaTanpaNotula($id=null)
	{

		$this->db->from('agenda')
			->where('agenda.is_finish',0);
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;

	}
	public function HistoryAgenda($id=null)
	{

		// $this->db->from('agenda')
		// 		->join('list_peserta','agenda.id = list_peserta.id_agenda')
		// 		->join('user','user.id = list_peserta.id_peserta');
		// if ($id != null) {
		// 	$this->db->where('id', $id)
		// 			 ->where('user.nama', $this->session->userdata['nama']);
		// }
		// $query = $this->db->get();
		// return $query;
		$this->db->get_where('notula', ['id'=>$id]);
		$this->db->join('agenda','notula.id_agenda = agenda.id');
		$this->db->join('list_peserta','agenda.id = list_peserta.id_agenda');
		$this->db->join('user','user.id = list_peserta.id_peserta');
		$this->db->where('user.nama', $this->session->userdata['nama']);
		$this->db->select(['agenda.*','notula.id as id_notula','notula.catatan as catatan_notula','image','notula.materi']);
		$query = $this->db->get('notula')->result_object();
		return $query;
	}
}

?>