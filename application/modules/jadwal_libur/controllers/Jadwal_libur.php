<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_libur extends CI_Controller
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
		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$type = isset($_POST['type']) ? ($_POST['type']) : "";
		if ($type == 'fetch') {
			$status = " AND last_cekout IS NULL ";

			$events = array();
			$fetch = $this->db->query("SELECT * FROM tm_jadwal_libur where id_tahun='" . $tahun . "' and id_semester='" . $sms . "'   ")->result();
			//  $fetch = $this->db->query("SELECT * FROM tm_tamu where id_user='" . $this->session->userdata('idu') . "' $status ")->result();
			foreach ($fetch as $fetch) {
				$e = array();
				$e['id'] = $fetch->id;
				$e['title'] = $fetch->nama;
				$e['start'] = $fetch->start;
				$e['end'] =  $this->tanggal->tambah_tgl($fetch->end, 1);
				$e['backgroundColor'] =  "red";

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
		$title = $this->input->post("title");

		echo "<textarea class='form-control' id='title'>" . $title . "</textarea>";
		echo "<br>";
		echo "<button class='btn bg-pink' onclick='hapus(`" . $id . "`)'>Hapus</button>";
		echo "<button class='btn bg-teal pull-right' onclick='save(`" . $id . "`)'>Simpan</button>";
	}
	function hapus()
	{
		echo $this->mdl->hapus();
	}
	function insert()
	{
		echo $this->mdl->insert();
	}
}
