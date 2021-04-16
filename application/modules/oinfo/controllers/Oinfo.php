<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Oinfo extends CI_Controller
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
		$index = "index";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	function cekAbsen()
	{
		echo	$this->load->view("cekAbsenDetail");
	}
	function profile()
	{
		$index = "profile";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	function cs()
	{
		$index = "cs";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	function simpan_akun()
	{
		$data = $this->mdl->simpan_akun();
		echo json_encode($data);
	}
	function update_profile()
	{
		$data = $this->mdl->update_profile();
		echo json_encode($data);
	}

	function getGuru()
	{
		$list = $this->mdl->get_data_guru();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='size'>  " . $dataDB->gelar_depan . " " . $dataDB->nama . " " . $dataDB->gelar_belakang . " </span>";


			$row[] = "<span class='size'> <a href='tel:" . $dataDB->hp . "'> " . $dataDB->hp . "</a> </span>";
			$row[] = "<span class='size'>  " . $dataDB->email . " </span>";


			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_guru(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
}
