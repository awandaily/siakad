<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tk_dashboard extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session("TK");
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
	public function pesan()
	{
		$index = "pesan";
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

	///-----------------------CATATAN PENILIAAN--------------------------///
	function getPesan()
	{
		$list = $this->mdl->get_pesan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$nama = $this->m_reff->goField("data_siswa", "nama", "where id='" . $dataDB->id_siswa . "' ");


			$row = array();

			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<p><span class='size col-pink' style='font-size:11px'>  " . $this->m_reff->nama_guru($dataDB->id_guru) . "</span>
			<br>  " . $dataDB->ket . " <br>
			<span class='size col-teal' style='font-size:11px'><i>" . $this->tanggal->ind(SUBSTR($dataDB->tgl, 0, 10), "-") . "</i></span></p>";

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_pesan(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function simpan_akun()
	{
		$data = $this->mdl->simpan_akun();
		echo json_encode($data);
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

	function update_profile()
	{
		$data = $this->mdl->update_profile();
		echo json_encode($data);
	}
}
