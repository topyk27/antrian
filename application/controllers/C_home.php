<?php 

/**
* 
*/
class C_home extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view("v_home");
	}
}

 ?>