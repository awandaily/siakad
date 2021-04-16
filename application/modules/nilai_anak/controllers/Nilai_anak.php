<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Nilai_anak extends CI_Controller
{


	var $tbl = "v_pegawai";
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
	function getNilai()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {

			if ($dataDB->nilai) {
				$nilaiP = "	<span class='size'>Nilai Pengetahuan : <b> " . $this->mdl->getNilaiColor($dataDB->nilai, $dataDB->id_kikd) . " </b></span><br>";
			} else {
				$nilaiP = "";
			}
			if ($dataDB->nilai_ki) {
				$nilaiK = "	<span class='size'> Nilai Keterampilan : <b> " . $this->mdl->getNilaiKiColor($dataDB->nilai_ki, $dataDB->id_kikd) . " </b></span><br>";
			} else {
				$nilaiK = "";
			}

			$row = array();
			$row[] = " <span class='size'>  " . $this->tanggal->ind(substr($dataDB->_ctime, 0, 10), "/") . " -
			<span class='size'>  " . $this->m_reff->goField("tr_kategory_nilai", "nama", "where id='" . $dataDB->id_kategory_nilai . "' ") . " </span> <br>
		
			<span class='size col-teal'>  <b>" . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $dataDB->id_mapel . "' ") . " </b></span> <br>
			" . $nilaiP . $nilaiK . "
			<p style='font-size:12px' class='col-brown'>  " . $dataDB->nama_nilai . " </p>
			
			</span>";



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
