<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Riwayat_izin extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{

		$index = "index";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	function idu()
	{
		return $this->session->userdata("id");
	}
	public function add()
	{

		echo	 $this->mdl->add();
	}
	public function update()
	{

		echo	 $this->mdl->update();
	}
	public function moveEvent()
	{

		echo	 $this->mdl->moveEvent();
	}
	function process()
	{
		/////////////
		//	$tahun=$this->m_reff->tahun();
		//	$sms=$this->m_reff->semester();
		$type = isset($_POST['type']) ? ($_POST['type']) : "";
		if ($type == 'fetch') {


			$events = array();
			$fetch = $this->db->query("SELECT * FROM tm_guru_izin ")->result();
			$i = 1;
			foreach ($fetch as $fetch) {
				$nama = $this->m_reff->goField("data_pegawai", "nama", "where id='" . $fetch->id_guru . "' ");
				if ($i == 1) {
					$kolor = "blue";
				} elseif ($i == 2) {
					$kolor = "orange";
				} elseif ($i == 3) {
					$kolor = "green";
				} elseif ($i == 4) {
					$kolor = "Teal";
				} elseif ($i == 5) {
					$kolor = "brown";
				} elseif ($i == 6) {
					$kolor = "Gray";
				} elseif ($i == 7) {
					$kolor = "Indigo";
				} elseif ($i == 8) {
					$kolor = "Dark Gray";
				} elseif ($i == 9) {
					$kolor = "#1f3b08";
				} elseif ($i == 10) {
					$kolor = "#db36a4";
				} else {
					$kolor = "#49a5bf";
					$i = 1;
				}
				$i++;
				$e = array();
				$e['id'] = $fetch->id;
				$e['title'] = $nama . " (" . $fetch->ket . ")"; //." | Rp.".number_format($fetch->honor,0,",","."); 
				$e['start'] = $fetch->start;
				$e['end'] =  $fetch->end;
				$e['backgroundColor'] = $kolor;

				//  $allday = ($fetch->allDay == "true") ? true : false;
				$e['allDay'] = "true";

				array_push($events, $e);
			}
			echo json_encode($events);
		}
	}

	function info()
	{
		$id = $this->input->post("id");
		$data = $this->db->get_where("tm_guru_izin", array("id" => $id))->row();
		echo isset($data->ket) ? ($data->ket) : "" . br();
	}
	function hapus()
	{
		echo $this->mdl->hapus();
	}
}
