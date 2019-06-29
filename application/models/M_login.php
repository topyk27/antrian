<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class M_login extends CI_Model
{
	
	private $_table = "user";
	public $id;
	public $username;
	public $password;
	public $ruang_sidang;
	public $role;

	public function rules()
	{
		return[
		['field' => 'username',
		'label' => 'Username',
		'rules' => 'required'],

		['field' => 'password',
		'label' => 'Password',
		'rules' => 'required'],
		];
	}

	public function login()
	{
		
		// return $this->db->get_where($this->_table, $where);
		$post = $this->input->post();
		$this->username = $post['username'];
		$this->password = $post['password'];
		$where = [
		'username' => $this->username,
		'password' => md5($this->password)
		];
		// $taek = "taek";
		// var_dump($taek);
		return $this->db->get_where($this->_table, $where)->row();
	}

	public function isLogin()
	{
		if(!$this->session->userdata('id'))
		{
			redirect('/');
		}
	}

	public function isAdmin()
	{
		if($this->session->role=="admin")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

 ?>