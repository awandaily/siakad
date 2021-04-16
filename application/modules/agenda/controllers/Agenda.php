<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("user"));
		$this->load->model("M_agenda", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{

		$data['konten'] = "index";
		$this->_template($data);
	}

	function process()
	{
		/////////////
		//	date_default_timezone_set("Asia/Jakarta");
		$type = isset($_POST['type']) ? ($_POST['type']) : "";
		if ($type == 'fetch') {
			$events = array();
			$fetch = $this->db->query("SELECT * FROM tm_kegiatan where id_user='" . $this->session->userdata('id') . "' ")->result();
			foreach ($fetch as $fetch) {
				$e = array();
				$e['idtamu'] = "";
				$e['title'] = "";
				$e['idkamar'] = "";
				$e['start'] = "";
				$e['end'] = "";

				//  $allday = ($fetch->allDay == "true") ? true : false;
				$e['allDay'] = "true";

				array_push($events, $e);
			}
			echo json_encode($events);
		}

		/////////
	}
	function modalCreateEvent()
	{
		$this->load->view("modalCreateEvent");
	}
	function konversiTanggal()
	{
		$tgl = $this->input->get("tgl");
		echo $this->mdl->konversiTanggal($tgl);
	}
	function isiModalCreateEvent()
	{
		echo ""; //$this->load->view("ModalCreateEvent");
	}
	function tglAkhir()
	{
		$tgl = $this->input->get("tgl");
		$durasi = $this->input->get("durasi");
		echo $this->mdl->tglAkhir($tgl, $durasi);
	}
	function createEvent()
	{
		echo $this->mdl->createEvent();
	}
}
