<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Absensi extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session("guru");
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}
	function idu()
	{
		return $this->session->userdata("id");
	}

	function profile()
	{
		$this->db->where("id", $this->idu());
		return	$this->db->get("data_pegawai")->row();
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

		$bulan = $this->input->post("bulan");
		if (!$bulan) {
			$bulan = date("Y-m");
		}
		$data["tahun"] = substr($bulan, 0, 4);
		$data["bulan"] = substr($bulan, 5, 2);
		$data["noid"] = $this->profile()->nip; //nip
		echo	$this->load->view("getDataAbsen", $data);
	}

	function getDataMapel()
	{
		$data["noid"] = $this->input->post("noid");
		$data["tgl"] = $this->input->post("tgl");
		$data["kohar"] = $this->input->post("kohar");
		echo	$this->load->view("getDataMapel", $data);
	}

	function getGrafik()
	{
		$data["tahun"] = $this->input->post("tahun");
		echo	$this->load->view("getGrafik", $data);
	}
}
