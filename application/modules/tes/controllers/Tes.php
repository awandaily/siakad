<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tes extends CI_Controller
{



	function __construct()
	{
		parent::__construct();

		//	$this->load->model("model_absen", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		//	$this->m_konfig->validasi_session("siswa");
		$this->load->view('template/main', $data);
	}
	public function index()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			echo $this->_template($data);
		}
	}
}
