<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Login extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("m_login");
		$this->load->library("form_validation");
	}

	public function index(){
		$login = $this->m_login;

		$validation = $this->form_validation;
		$validation->set_rules($login->rules());
		if(!$this->session->userdata('id'))
		{
			if ($validation->run()) {
				$data['user'] = $login->login();
				// var_dump($data['user']);
				
				if(!$data['user']){
					$this->session->set_flashdata('success', 'username atau password salah');

					redirect('login');
				}
				else{
					// var_dump($data['user']);
					// foreach($data['user'] as $data_user){
						$session_data = [
						'id' => $data['user']->id,
						'username' => $data['user']->username,
						'ruang_sidang' => $data['user']->ruang_sidang,
						'role' => $data['user']->role,
						];
					// }
					$this->session->set_userdata($session_data);
					$this->session->set_flashdata('success', 'Selamat datang '.$session_data['username']);
					redirect('c_jadwal');
				}
			}
			$this->load->view("login/v_login");
		}
		else{
			redirect('c_jadwal');
		}
	}

	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/login');
	}

}

 ?>