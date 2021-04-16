<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Materi_ajar extends CI_Controller
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

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}



	///-----------------------CATATAN PENILIAAN--------------------------///
	function getMateri()
	{
		$list = $this->mdl->get_materi();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "
			<a href='" . $dataDB->file . "?download=true' download>
			<span style='margin-top:7px;position:absolute'>	<i class='material-icons' align='left'>get_app</i></span>
			<div style='margin-left:30px' >
			" . $dataDB->nama . "<br> <span class='col-teal' style='font-size:12px'>" . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $dataDB->id_mapel . "' ") . "</span> </div> </a>";

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	//-------------------------------------------------END SISWA------------------------------------//
	function idu()
	{
		return $this->session->userdata("id");
	}
}
