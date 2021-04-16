<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kepsek extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("model", "mdl");
		$this->load->model("model_analisis", "mdl_analisis");
		$this->load->model("model_pendidik", "mdl_pendidik");
		$this->load->model("model_siswa", "mdl_siswa");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{

		$index = "admin";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	public function grafik()
	{

		$index = "admin";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	public function staf()
	{

		$index = "staf";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	public function siswa()
	{

		$index = "siswa";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	function data_pendidik()
	{
		$list = $this->mdl_pendidik->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			if ($dataDB->aktifasi == 2) {
				$akt = "NON AKTIF";
				$in = "AKTIFKAN ";
			} else {
				$akt = "AKTIF";
				$in = "NON-AKTIFKAN  ";
			}




			$row = array();
			$row[] = "<span class='size linehover' onclick='edit(`" . $dataDB->id . "`)' >" . $no++ . "</span>";



			$row[] = "<span class='size linehover' onclick='edit(`" . $dataDB->id . "`)'>  <img alt='Photo' class='img-responsive thumbnail' width='80px' src='" . base_url() . "file_upload/dp/" . $dataDB->poto . "'>  </img></span>";

			$row[] = "<span class='size linehover' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->nama_lengkap . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . strtoupper($dataDB->jk) . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->jabatan . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $this->tanggal->ind($dataDB->tmt, "/") . " </span>";

			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->pangkat . " </span>";

			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->nip . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->nuptk . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->hp . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->email . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->alamat . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $this->mdl_pendidik->getDataMapel($dataDB->id_mapel) . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->tempat_lahir . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $this->tanggal->ind($dataDB->tgl_lahir, "/") . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->ijazah . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->sts_pegawai . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)'>  " . $akt . " </span>";




			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_pendidik->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function detail_siswa()
	{
		$data["data"] = $this->db->get_where("v_siswa", array("id" => $this->input->post("id")))->row();
		echo $this->load->view("isi_detail_siswa", $data);
	}
	function data_siswa()
	{
		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			if ($dataDB->aktifasi == 2) {
				$akt = "NON AKTIF";
				$in = "AKTIFKAN ";
			} else {
				$akt = "AKTIF";
				$in = "NON-AKTIFKAN  ";
			}




			$row = array();
			$row[] = "<span class='size'  onclick='detail(`" . $dataDB->id . "`)'  >" . $no++ . "</span>";

			$row[] = "<a href='javascript:void(0)' class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->nama . " </a>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . strtoupper($dataDB->jk) . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->tempat_lahir . ", " . $this->tanggal->ind($dataDB->tgl_lahir, "/") . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->agama . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->nis . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->nisn . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->nik . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->tingkat . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->jurusan . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->nama_kelas . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->tahun_masuk . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->hp . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->email . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->alamat . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->asal_sd . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->tahun_lulus_sd . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->asal_smp . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->tahun_lulus_smp . " </span>";

			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->nama_ayah . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->nama_ibu . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->hp_ayah . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->hp_ibu . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->status_ayah . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->status_ibu . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->id_pekerjaan_ayah . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->id_pekerjaan_ibu . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->alamat_ortu . " </span>";
			//	$row[] = "<span class='size'>  ".$dataDB->anak_ke." </span>";
			//	$row[] = "<span class='size'>  ".$dataDB->jml_saudara." </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->nama_wali . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->hp_wali . " </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->hubungan . " </span>";





			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_siswa->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
}
