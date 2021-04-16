<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aka extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session("siswa");
		$this->load->model("model", "mdl");
		$this->load->model("model_materi", "mdl_materi");
		$this->load->model("model_nilai", "mdl_nilai");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function jadwal()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}
	public function materi()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("materi");
		} else {
			$data['konten'] = "materi";
			$this->_template($data);
		}
	}

	public function nilai()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("nilai");
		} else {
			$data['konten'] = "nilai";
			$this->_template($data);
		}
	}


	function data_materi()
	{
		$list = $this->mdl_materi->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////


			$tombol = '<a class="btn waves-effect bg-teal" href="' . base_url() . "file_upload/dok/" . $dataDB->file . '" download>
			<div class="demo-icon-container"><i class="material-icons">file_download</i> <span class="icon-name"  >download</span></div></a> ';


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = $tombol;
			$row[] = "<span class='size'>  " . $this->tanggal->dateTime($dataDB->_ctime, "/") . " </b> </span>";

			$row[] = "<span class='size'>  " . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $dataDB->id_mapel . "'") . "</span>";
			$row[] = "<span class='size'>  " . $dataDB->nama . " </span>";

			$row[] = "<span class='size'> " . $dataDB->ket . "   </span>";


			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_materi->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function data_nilai()
	{
		$list = $this->mdl_nilai->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$namakelas = $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'");



			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";


			$row[] = "<span class='size'>  " . $this->m_reff->goField("tr_tahun_ajaran", "nama", "where id='" . $dataDB->id_tahun . "'") . " </b> </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("tr_semester", "nama", "where id='" . $dataDB->id_semester . "'") . " </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("tr_kategory_nilai", "nama", "where id='" . $dataDB->id_kategory_nilai . "'") . "</span>";

			$row[] = "<span class='size'>  " . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $dataDB->id_mapel . "'") . "</span>";
			$row[] = "<span class='size'>  " . str_replace(".0", "", $dataDB->nilai) . "</span>";
			$row[] = "<span class='size'>  " . $dataDB->nama_nilai . "</span>";




			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_nilai->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
}
