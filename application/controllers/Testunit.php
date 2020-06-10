<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testunit extends CI_Controller
{

	function __construct()
	{
		parent :: __construct();
		$this->load->library("unit_test");
		$this->load->model('agenda_model');

	}




	private function pengujian_agenda($id,$judul, $pembahasan, $tempat, $tanggal, $id_pemimpin, $catatan, $create_at, $update_at, $materi)
	{
		return array ($id,$judul, $pembahasan, $tempat, $tanggal, $id_pemimpin, $catatan, $create_at, $update_at, $materi);
	}
	private function pengujian_notula($id_agenda, $catatan, $image, $materi, $create_at, $update_at)
	{
		return array ($id_agenda, $catatan, $image, $materi, $create_at, $update_at);
	}
	private function pengujian_notula_usai_rapat($id_agenda, $catatan, $image, $materi, $create_at, $update_at)
	{
		return array ($id_agenda, $catatan, $image, $materi, $create_at, $update_at);
	}
	private function pengujian_video($id_video,$id_agenda,$pathvideo)
	{
		return array ($id_video,$id_agenda,$pathvideo);
	}

	public function  test_input_agenda_jalur_1(){
		$test = $this->pengujian_agenda('22','Rapat Rpl','test','Ruang a 1','2019-12-12 12:00:00','3','test','2019-12-12 12:00:00','2019-12-12 12:00:00','test.pdf');
		$expected_result = array('22','Rapat Rpl','test','Ruang a 1','2019-12-12 12:00:00','3','test','2019-12-12 12:00:00','2019-12-12 12:00:00','test.pdf');
		$test_name = "test tambah agenda";

		echo $this->unit->run($test,$expected_result,$test_name);
	}

	public function  test_input_agenda_jalur_2(){
		$test = $this->pengujian_agenda('','test','Ruang a 1','2019-12-12 12:00:00','3','test','2019-12-12 12:00:00','2019-12-12 12:00:00','test.pdf');
		$expected_result = array('22','Rapat Rpl','test','Ruang a 1','2019-12-12 12:00:00','3','test','2019-12-12 12:00:00','2019-12-12 12:00:00','test.pdf');
		$test_name = "test tambah agenda";
		echo $this->unit->run($test,$expected_result,$test_name);
	}

	public function  test_save_jalur_1(){
		$test = $this->pengujian_notula('22', 'image_1576075992.jpeg', 'test', 'test.pdf', '2019-12-12 12:00:00', '2019-12-12 12:00:00');
		$expected_result = array('22', 'image_1576075992.jpeg', 'test', 'test.pdf', '2019-12-12 12:00:00', '2019-12-12 12:00:00');
		$test_name = "test tambah notula";
		echo $this->unit->run($test,$expected_result,$test_name);
	}
	public function  test_save_jalur_2(){
		$test = $this->pengujian_notula('22', 'image_1576075992.jpeg', ' ', 'test.pdf', '2019-12-12 12:00:00', '2019-12-12 12:00:00');
		$expected_result = array('22', 'image_1576075992.jpeg', 'test', 'test.pdf', '2019-12-12 12:00:00', '2019-12-12 12:00:00');
		$test_name = "test tambah notula";
		echo $this->unit->run($test,$expected_result,$test_name);
	}

	public function  test_notula_usai_rapat_jalur_1(){
		$test = $this->pengujian_notula_usai_rapat('22', 'image_1576075992.jpeg', 'test', 'test.pdf', '2019-12-12 12:00:00', '2019-12-12 12:00:00');
		$expected_result = array('22', 'image_1576075992.jpeg', 'test', 'test.pdf', '2019-12-12 12:00:00', '2019-12-12 12:00:00');
		$test_name = "test tambah notula usai rapat";
		echo $this->unit->run($test,$expected_result,$test_name);
	}
	public function  test_notula_usai_rapat_jalur_2(){
		$test = $this->pengujian_notula_usai_rapat('22', 'image_1576075992.jpeg', ' ', 'test.pdf', '2019-12-12 12:00:00', '2019-12-12 12:00:00');
		$expected_result = array('22', 'image_1576075992.jpeg', 'test', 'test.pdf', '2019-12-12 12:00:00', '2019-12-12 12:00:00');
		$test_name = "test tambah notula usai rapat";
		echo $this->unit->run($test,$expected_result,$test_name);
	}

	public function  test_video_jalur_1(){
		$test = $this->pengujian_video('34', '18', '18-video-200326100327.webm');
		$expected_result = array('34', '18', '18-video-200326100327.webm');
		$test_name = "test tambah video";
		echo $this->unit->run($test,$expected_result,$test_name);
	}
	public function  test_video_jalur_2(){
		$test = $this->pengujian_video('34', '18', '');
		$expected_result = array('34', '18', '18-video-200326100327.webm');
		$test_name = "test tambah video";
		echo $this->unit->run($test,$expected_result,$test_name);
	}

	public function run(){
//		$this->test_save_jalur_1();
//		$this->test_save_jalur_2();
		$this->integrasi();
	}
	private function loaddepedency(){
		foreach (['agenda_model','user_model','status_model'] as $model){
			$this->load->model($model);
		}
	}
	private function geturl($namacontroller){
		return str_replace('https','http',base_url($namacontroller));
	}
	private function getClient(){

		$client = new GuzzleHttp\Client(
				[
						'base_uri' => base_url(),
						'cookies'=>true,
						// 'verify'=>'SMND.app'
				]);
		$login = $client->post('Auth_C/',[
				'form_params'=>[
						'email'=>'aisahanna1997@gmail.com',
						'password'=>'1234'
				]
		]);
		return $client;
	}
	public function test_intergrasi_jalur2(){
		$client = $this->getClient();
		$inputagenda = $client->post('/SMND/Agenda_C/input_agenda',
				[
						'form_params'=>[
								'judul'=>'tester',
								'pembahasan'=>'test pembahasan'
						]]
		);
		$body = $inputagenda->getBody();
		$test_name = 'terdapat kolom kosong dalam membuat agenda';
		echo $this->unit->run(strpos($body, 'The Tempat field is required.') !== false, true , $test_name);
	}
	public function test_intergrasi_jalur1(){
		$client = $this->getClient();
		$input = [
				"judul" => "tester judul rapat",
				"pembahasan" => "tester agenda pembahasan",
				"tempat" => "Gedung F Lantai 7 Ruang 7.4",
				"tanggal" => "2020/05/25 14:29",
				"pemimpin" => "6",
				"peserta" => [
						0 => "2",
						1 => "1",
						2 => "3",
						3 => "4",
						4 => "5",
				],
				"catatan" => "tester catatan"
		];
		$inputagenda = $client->post('/SMND/Agenda_C/input_agenda',
				[
						'form_params'=>$input
				]
		);
		$test_name = 'Menambahkan agenda rapat dengan masukan yang sesuai';
		echo $this->unit->run(strpos($inputagenda->getBody(), 'tester judul rapat') !== false, true , $test_name);
	}
//	public function integrasi()
//	{
//		$this->test_intergrasi_jalur2();
//		$this->test_intergrasi_jalur1();
//	}

}?>
<!-- scrum == bottom up -->
