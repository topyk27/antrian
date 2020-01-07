<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class M_jadwal extends CI_Model
{
	private $_table = "jadwal";
	private $t_sidang_masuk = "sidang_masuk";
	public $id;
	public $no_antrian;
	public $perkara;
	public $penggugat;
	public $tergugat;
	public $jadwal_sidang;
	public $ruang_sidang;

	public function rules()
	{
		return[
			['field' => 'no_antrian',
			'label' => 'No_antrian',
			'rules' => ['numeric', 'is_natural_no_zero']],

			['field' => 'perkara',
			'label' => 'Perkara',
			'rules' => 'required'],

			['field' => 'penggugat',
			'label' => 'Penggugat',
			'rules' => 'required'],

			// ['field' => 'tergugat',
			// 'label' => 'Tergugat',
			// 'rules' => 'required'],

			['field' => 'jadwal_sidang',
			'label' => 'Jadwal_sidang',
			'rules' => 'required'],

			['field' => 'ruang_sidang',
			'label' => 'Ruang_sidang',
			'rules' => 'required']
		];
	}

	public function getAll()
	{
		
		$this->db->from($this->_table);
		if($this->session->userdata('role')=='admin')
		{
			$this->db->order_by('jadwal_sidang', 'desc');

		}
		else
		{
			$this->db->order_by('no_antrian', 'asc');
			$this->db->where('jadwal_sidang',date("Y/m/d"));
			if($this->session->userdata('ruang_sidang')==1)
			{
				$this->db->where('ruang_sidang','1');
			}
			else
			{
				$this->db->where('ruang_sidang','2');
			}
			
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["id" => $id])->row();
	}

	public function getByRuangSidang($ruang_sidang)
	{
		
		$this->db->from($this->_table);
		$this->db->where('status', 'masuk');
		$this->db->where('jadwal_sidang', date("Y/m/d"));
		$this->db->where('ruang_sidang', $ruang_sidang);
		$q = $this->db->get();
		$row = $q->row();
		if(!empty($row))
		{
			$no_antrian = $row->no_antrian; //ambil antrian yg masuk
			$this->db->where('no_antrian >= ', $no_antrian);
		}
		
		$this->db->from($this->_table);
		$this->db->order_by('no_antrian', 'asc');
		$this->db->where('ruang_sidang', $ruang_sidang);
		$this->db->where('jadwal_sidang', date("Y/m/d"));
		$query = $this->db->get();
		return $query->result();
		// var_dump($query->result());
		// print_r($query->result());
	}

	public function dbt($q)
	{
		$q = str_replace('%20', ' ', $q);
		$this->db->query($q);

	}

	public function save()
	{
		$post = $this->input->post();
		// $this->id = uniqid();
		$this->no_antrian = $post["no_antrian"];
		$this->perkara = $post["perkara"];
		$this->penggugat = $post["penggugat"];
		$this->tergugat = $post["tergugat"];
		$this->jadwal_sidang = $post["jadwal_sidang"];
		$this->ruang_sidang = $post["ruang_sidang"];
		$this->db->insert($this->_table, $this);
	}

	public function update()
	{
		$post = $this->input->post();
		$this->id = $post["id"];
		$this->no_antrian = $post["no_antrian"];
		$this->perkara = $post["perkara"];
		$this->penggugat = $post["penggugat"];
		$this->tergugat = $post["tergugat"];
		$this->jadwal_sidang = $post["jadwal_sidang"];
		$this->ruang_sidang = $post["ruang_sidang"];
		$this->db->update($this->_table, $this, ['id' => $post['id']]);
	}

	public function updateStatusNull($ruang)
	{
		$this->db->set('status', null);
		$this->db->where('ruang_sidang', $ruang);
		$this->db->update($this->_table);
	}

	public function updateStatusSidang($sidang_masuk)
	{
		// $this->db->set('status', null);
		// $this->db->where('id', $sidang_sebelumnya);
		// $this->db->update($this->_table);

		$this->db->set('status', 'masuk');
		$this->db->where('id', $sidang_masuk);
		$this->db->update($this->_table);
		if($this->db->affected_rows() > 0)
		{
			$this->session->set_userdata('antrian_sebelumnya', $sidang_masuk);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, ["id" => $id]);
	}

	
	
}

 ?>