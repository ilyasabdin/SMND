<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
class Testunit extends CI_Controller  
{ 

  function __construct()  
  {  
   parent::__construct();  
   $this->load->library("unit_test");
   $this->load->model('agenda_model');
 }  

 }

	private function pengujian_agenda($judul, $pembahasan, $tempat, $tanggal, $id_pemimpin, $catatan, $create_at, $update_at, $materi)
	{
		return array ($judul, $pembahasan, $tempat, $tanggal, $id_pemimpin, $catatan, $create_at, $update_at, $materi);		
	}
	private function pengujian_notula($id_agenda, $catatan, $image, $materi, $create_at, $update_at)
	{
		return array ($id_agenda, $catatan, $image, $materi, $create_at, $update_at);		
	}

	public function  test_input_agenda_jalur_1(){
 	$test = $this->pengujian_agenda('Rapat Rpl','test','Ruang a 1','2019-12-12 12:00:00','3','test','2019-12-12 12:00:00','2019-12-12 12:00:00','test.pdf');
 	$expected_result = array('Rapat Rpl','test','Ruang a 1','2019-12-12 12:00:00','3','test','2019-12-12 12:00:00','2019-12-12 12:00:00','test.pdf');
 	$test_name = "test tambah agenda";
 	$save = $this->agenda_model->input_agenda($test);
 	echo $this->unit->run($test,$expected_result,$test_name, $save);
 	}
	
	public function  test_input_agenda_jalur_2(){
 	$test = $this->pengujian_agenda('','test','Ruang a 1','2019-12-12 12:00:00','3','test','2019-12-12 12:00:00','2019-12-12 12:00:00','test.pdf');
 	$expected_result = array('Rapat Rpl','test','Ruang a 1','2019-12-12 12:00:00','3','test','2019-12-12 12:00:00','2019-12-12 12:00:00','test.pdf');
 	$test_name = "test tambah agenda";
 	echo $this->unit->run($test,$expected_result,$test_name);
 	}
	
	public function  test_save_jalur_1(){
 	$test = $this->pengujian_notula('22', 'image_1576075992.jpeg', 'test', 'test.pdf', '2019-12-12 12:00:00', '2019-12-12 12:00:00');
 	$expected_result = array('22', 'image_1576075992.jpeg', 'test', 'test.pdf', '2019-12-12 12:00:00', '2019-12-12 12:00:00');
 	$test_name = "test tambah notula";
 	echo $this->unit->run($test,$expected_result,$test_name);
 	}

 	

}?> 
<!-- scrum == bottom up -->