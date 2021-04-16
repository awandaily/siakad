<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("Model", "mdl");
		$this->load->model("Model_siswa", "mdl_siswa");
		$this->load->model("Model_extra", "mdl_extra");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{

		$level = strtoupper($this->session->userdata("level"));
		if ($level == "ESKUL") {
			$index = "eskul";
		} elseif ($level == "GURU") {
			$index = "guru";
		} elseif ($level == "SISWA") {
			$index = "siswa";
		} elseif ($level == "KEUANGAN" or $level == "KOPERASI") {
			$index = "keuangan";
		} elseif ($level == "TK" or $level == "PIKET") {
			$index = "tk";
		} elseif ($level == "BPBK") {
			$index = "bpbk";
		} else {
			$index = "index";
		}

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	public function data()
	{
		$this->m_konfig->validasi_session(array("panitia", "admin"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("profile_panitia");
		} else {
			$data['konten'] = "profile_panitia";
			$this->_template($data);
		}
	}
	function updatePegawai()
	{

		//$this->m_konfig->log("Data Pegawai","update data akun (pengguna) ",$this->session->userdata("id"));
		$data = $this->mdl->updatePegawai();
		echo json_encode($data);
	}

	function updateSiswa()
	{

		//$this->m_konfig->log("Data Pegawai","update data akun (pengguna) ",$this->session->userdata("id"));
		$data = $this->mdl_siswa->updateSiswa();
		echo json_encode($data);
	}
	function update()
	{
		$this->m_konfig->validasi_global();
		//	$this->m_konfig->logPeserta("tm_peserta","update data akun (peserta) ",$this->session->userdata("id"));
		$data = $this->mdl->update();
		echo json_encode($data);
	}
	function updatePembina()
	{
		$this->m_konfig->validasi_global();
		//	$this->m_konfig->logPeserta("tm_peserta","update data akun (peserta) ",$this->session->userdata("id"));
		$data = $this->mdl->updatePembina();
		echo json_encode($data);
	}
	function insert()
	{
		$this->m_konfig->validasi_session(array("pusat", "admin"));
		$this->m_konfig->log("admin", "update data akun (pengguna) ", $this->session->userdata("id"));
		$data = $this->mdl->insert();
		echo json_encode($data);
	}
}
