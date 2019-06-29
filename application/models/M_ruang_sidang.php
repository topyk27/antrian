<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class M_ruang_sidang extends CI_Model
{
	private $_table = "ruang_sidang";
	public $id;
	public $ruang_sidang;

	public function rules()
	{
		return[
		['field' => 'ruang_sidang',
		'label' => 'ruang_sidang',
		'rules' => ['numeric', 'is_natural_no_zero']],
		];
	}

	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}
}

 ?>