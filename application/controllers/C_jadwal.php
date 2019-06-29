<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_jadwal extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("m_jadwal");
		$this->load->model("m_ruang_sidang");
		$this->load->model("m_login");
		$this->load->library('form_validation');
	}

	public function index()
	{
		
		$this->m_login->isLogin();
		$data["jadwals"] = $this->m_jadwal->getAll();
		$this->load->view("v_home", $data);
		
	}

	public function create()
	{
		$this->m_login->isLogin();
		
		$jadwal = $this->m_jadwal;
		$ruang_sidang = $this->m_ruang_sidang;
		$validation = $this->form_validation;
		$validation->set_rules($jadwal->rules());

		if ($validation->run()) {
			$jadwal->save();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect('c_jadwal');
		}
		$data["ruang_sidangs"] = $ruang_sidang->getAll();

		$this->load->view("jadwal/v_create", $data);
	}

	public function update($id = null)
	{
		if (!isset($id)) {
			redirect('c_jadwal');
		}
		$jadwal = $this->m_jadwal;
		$validation = $this->form_validation;
		$validation->set_rules($jadwal->rules());

		if ($validation->run()) {
			$jadwal->update();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect('c_jadwal');
		}

		$data["jadwal"] = $jadwal->getById($id);
		if (!$data["jadwal"]) {
			// show_404();
			$this->session->set_flashdata('success','Perkara yang anda cari tidak ada');
			redirect('c_jadwal');
		}
		$this->load->view("jadwal/v_edit", $data);

	}

	public function delete($id = null)
	{
		if (!isset($id)) {
			// show_404();
			$this->session->set_flashdata('success','Perkara yang anda cari tidak ada');
			redirect('c_jadwal');
		}

		if ($this->m_jadwal->delete($id)) {
			$this->session->set_flashdata('success','Perkara berhasil dihapus');
			redirect('c_jadwal');
		}
	}
}

 ?>