<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Presensi extends CI_Controller
{



	function __construct()
	{
		parent::__construct();

		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->m_konfig->validasi_global();
		$this->load->view('template/main', $data);
	}
	function setUn()
	{
		$data = $this->mdl->setUn();
		echo json_encode($data);
	}
	function download_format_siswa()
	{
		echo $this->mdl->download_format_siswa();
	}
	function import_data_siswa()
	{
		$data = $this->mdl->import_data_siswa();
		echo json_encode($data);
	}
	public function index()
	{

		$index = "pegawai";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	function pegawai()
	{
		$this->index();
	}
	public function pengaturan()
	{
		$index = "pengaturan";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	public function un()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$index = "un";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	function download_surat()
	{
		ob_start();
		$isi = $this->load->view('kelulusan');
		// return true;
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "310"), 'en', true, '', array(8, 10, 10, 5));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('Surat-kelulusan.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}
	public function info_un()
	{

		$index = "info_un";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	///-----------------------SISWA--------------------------///

	function data_siswa()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			if ($dataDB->sts_un == 1) //if lulus
			{
				$akt = "<span class='  col-green'>LULUS</span>";
			} elseif ($dataDB->sts_un == 2) //if lulus
			{
				$akt = "<span class='  col-pink'>TIDAK LULUS</span>";
			} else {
				$akt = "<span  class='  col-blue-grey'>TIDAK DITAMPILKAN</span> ";
			}


			$row = array();
			$row[] = "<span class='size'    >" . $no . "</span>";
			$row[] = "<span class='size'    >" . $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . "</span>";
			$row[] =  "<a href='javascript:detail(`" . $dataDB->id . "`)'>" . $dataDB->nama . "</a> (" . strtoupper($dataDB->jk) . ")";
			$row[] = "<input style='max-width:100px' type='text' id='ket_un" . $dataDB->id . "' name='ket_un" . $dataDB->id . "' onchange='ket_un(`" . $dataDB->id . "`,`no_un`)' value='" . $dataDB->no_un . "'>";
			$row[] = "<a target='_blank' href='" . base_url() . "informasi_siswa/download_surat?id=" . $dataDB->id . "&api.whatsapp.com'>" . $dataDB->nis . "</a>";
			$row[] = "<b>" . $akt . "</b>";
			$row[] = "<textarea id='ket_un" . $dataDB->id . "' name='ket_un" . $dataDB->id . "' onchange='ket_un(`" . $dataDB->id . "`,`ket_un`)'>" . $dataDB->ket_un . "</textarea>";

			//add html for action

			$data[] = $row;
			$no++;
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





	function data_pendidik()
	{
		$list = $this->mdl->get_data_pendidik();
		$data = array();
		$jml = $this->input->get_post("jml");
		$tgl1 = $this->input->get_post("tgl1");
		$tgl2 = $this->input->get_post("tgl2");
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

			$row[] = "<span class='size linehover' onclick='edit(`" . $dataDB->id . "`)'>  " . $dataDB->nama_lengkap . " </span>";
			$row[] = $this->m_reff->goField("tr_sts_pegawai", "nama", "where id='" . $dataDB->sts_kepegawaian . "'");
			$masuk = 0;
			$alfa = 0;
			for ($i = 0; $i < $jml; $i++) {
				$tgl = $this->tanggal->tambah_tgl($tgl1, $i);
				$hasil = $this->mdl->cekAbsenFinger($dataDB->nip, $tgl);
				if ($hasil == 1) { //ada
					$hasil = '<i class="material-icons col-green">check_circle</i>';
					$masuk++;
				} elseif ($hasil == 2) { //tidak
					$hasil = '<i class="material-icons col-blue-grey">highlight_off</i>';
					$alfa++;
				} elseif ($hasil == 3) { //libur masuk
					$hasil = '<b class="col-green">L</b>';
				} elseif ($hasil == 6) { //   
					$hasil = '<b class="col-pink">S</b>';
				} elseif ($hasil == 7) { //   
					$hasil = '<b class="col-pink">M</b>';
				} else { //libur off
					// $hasil='<i class="material-icons col-pink">event</i>';
					$hasil = '<b class="col-pink">L</b>';
				}

				$row[] = $hasil;
			}
			$row[] = $masuk;
			$row[] = $alfa;

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_pendidik(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getDataPegawai()
	{
		$this->load->view("getDataPegawai");
	}
	function down_guru()
	{
		$this->load->view("down_guru");
	}
}
