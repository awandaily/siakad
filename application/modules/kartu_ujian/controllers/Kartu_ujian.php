<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kartu_ujian extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("ORTU", "SISWA"));
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}



	///-----------------------CATATAN PENILIAAN--------------------------///


	//-------------------------------------------------END SISWA------------------------------------//
	function idu()
	{
		return $this->session->userdata("id");
	}
}
