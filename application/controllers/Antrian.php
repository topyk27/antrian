<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Antrian extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("m_jadwal");
	}

	public function ruang($ruang_sidang)
	{
		// $data["jadwals"] = $this->m_jadwal->getByRuangSidang($ruang_sidang);
		$data["ruang"] = $ruang_sidang;
		$this->load->view('antrian/daftar_antrian', $data);
	}

	public function daftar_sidang($ruang_sidang)
	{
		$data = $this->m_jadwal->getByRuangSidang($ruang_sidang);
		echo json_encode($data);

	}

	public function sidang_masuk($sidang_sebelumnya,$sidang_masuk)
	{
		$respon = $this->m_jadwal->updateStatusSidang($sidang_sebelumnya,$sidang_masuk);
		echo $respon;

	}
}

 ?>