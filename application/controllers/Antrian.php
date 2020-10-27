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

	public function sidang_masuk($ruang,$sidang_masuk)
	{
		$update = $this->m_jadwal->updateStatusNull($ruang);
		$respon = $this->m_jadwal->updateStatusSidang($sidang_masuk);
		echo $respon;

	}

	public function cetak()
	{
		$antrian = $this->input->post('antrian');
		$jadwal = $this->input->post('jadwal');
		$ruang = $this->input->post('ruang');
		$antrian = sprintf("%02d", $antrian); //biar angkanya jadi 01
		$perkara = $this->input->post('perkara');
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		// $ip_printer = "\\\$ipaddress\POS1";

		// fungsi cetak
		// good roll paper 76 x 297 mm
		$var_magin_left = 10;
		try {
			$p = printer_open('\\\192.168.2.110\POS1'); //work ip nya ip printer
			// $p = printer_open('\\\192.168.2.29\POS1'); //work ip nya ip printer
			// $p = printer_open($ip_printer); //work ip nya ip printer
			printer_set_option($p, PRINTER_MODE, "RAW"); // mode disobek (gak ngegulung kertas)

			//then the width
			// printer_set_option( $p,PRINTER_RESOLUTION_Y, 940);
			printer_set_option( $p,PRINTER_RESOLUTION_X, 160);
			printer_start_doc($p);
			printer_start_page($p);

			$font = printer_create_font("Arial", 38, 10, PRINTER_FW_BOLD, false, false, false, 0);
			printer_select_font($p, $font);
			printer_draw_text($p, "Pengadilan Agama Tenggarong",50,0);

			// Header Bon
			$font = printer_create_font("Arial", 38, 10, PRINTER_FW_NORMAL, false, false, false, 0);
			printer_select_font($p, $font);

			$pen = printer_create_pen(PRINTER_PEN_SOLID, 1, "000000");
			printer_select_pen($p, $pen);
			printer_draw_text($p, "No Antrian Sidang", 10, 50);

			$font = printer_create_font("Arial", 98, 37, PRINTER_FW_BOLD, false, false, false, 0);
			printer_select_font($p, $font);
			printer_draw_text($p, "$antrian", 230, 30);

			$font = printer_create_font("Arial", 38, 10, PRINTER_FW_NORMAL, false, false, false, 0);
			printer_select_font($p, $font);

			$pen = printer_create_pen(PRINTER_PEN_SOLID, 1, "000000");
			printer_select_pen($p, $pen);
			printer_draw_text($p, "Ruang Sidang", 10, 130);

			$font = printer_create_font("Arial", 98, 37, PRINTER_FW_BOLD, false, false, false, 0);
			printer_select_font($p, $font);
			printer_draw_text($p, "$ruang", 230, 110);

			$font = printer_create_font("Arial", 20, 15, PRINTER_FW_NORMAL, false, false, false, 0);
			printer_select_font($p, $font);
			printer_draw_text($p, "$perkara",$var_magin_left, 220);

			$font = printer_create_font("Arial", 15, 12, PRINTER_FW_NORMAL, false, false, false, 0);
			printer_select_font($p, $font);
			printer_draw_text($p, "$jadwal",$var_magin_left, 250);
			printer_draw_line($p, $var_magin_left, 270, 400, 270);

			printer_draw_text($p, "Silahkan menunggu No antrian", $var_magin_left, 290);
			printer_draw_text($p, "Anda dipanggil kemudian", 50, 310);
			printer_draw_text($p, "masuk ke ruang sidang $ruang", 50, 330);

			printer_draw_text($p, "  ", $var_magin_left, 340);

			printer_end_page($p);
			printer_end_doc($p);
			printer_close($p);
			$response['success'] = 1;
		} catch (Exception $e) {
			$response['success'] = 0;
		}
		// end good roll paper 76 x 297 mm


		// end fungsi cetak
		
		$response['ip'] = $ipaddress;
		echo json_encode($response);
	}

}

 ?>