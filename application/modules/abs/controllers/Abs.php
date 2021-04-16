<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Abs extends CI_Controller
{



	function __construct()
	{
		parent::__construct();

		$this->load->model("model_absen", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->m_konfig->validasi_session("siswa");
		$this->load->view('template/main', $data);
	}
	function idu()
	{
		return $this->session->userdata("id");
	}

	function profile()
	{
		$this->m_konfig->validasi_session("siswa");
		$this->db->where("id", $this->idu());
		return	$this->db->get("data_siswa")->row();
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

	function getDataAbsen()
	{
		$this->m_konfig->validasi_session("siswa");
		$bulan = $this->input->post("bulan");
		if (!$bulan) {
			$bulan = date("Y-m");
		}
		$data["tahun"] = substr($bulan, 0, 4);
		$data["bulan"] = substr($bulan, 5, 2);
		$data["noid"] = $this->profile()->nis;
		echo	$this->load->view("getDataAbsen", $data);
	}

	function getDataMapel()
	{
		$this->m_konfig->validasi_session("siswa");
		$data["noid"] = $this->input->post("noid");
		$data["tgl"] = $this->input->post("tgl");
		$data["kohar"] = $this->input->post("kohar");
		echo	$this->load->view("getDataMapel", $data);
	}

	function getGrafik()
	{
		$this->m_konfig->validasi_session("siswa");
		$data["tahun"] = $this->input->post("tahun");
		echo	$this->load->view("getGrafik", $data);
	}

	function getDataBulan()
	{
		$this->m_konfig->validasi_global();
		$data["bulan"] =  $this->input->post("bulan");
		$data["tahun"] =  $this->input->post("tahun");
		echo	$this->load->view("getDataBulan", $data);
	}
}
