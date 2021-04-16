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

	function jadwal_kosong_excel()
	{
		$this->load->view('jadwal_kosong_excel');
	}

	public function jadwal_kosong()
	{

		$index = "jadwal_kosong";
		$hari 		= date('N');

		switch ($hari) {
			case '1':
				$sts_jam = "1";
				break;

			case '5':
				$sts_jam = "2";
				break;

			default:
				$sts_jam = "0";
				break;
		}
		$this->db->where("urut!=", null);
		$this->db->where("sts", $sts_jam);
		$qjam = $this->db->get("tr_jam_ajar")->result();


		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			$data["jam"] = $qjam;
			echo	$this->load->view($index, $data);
		} else {
			$data['konten'] = $index;
			$data['jam'] = $qjam;
			$this->_template($data);
		}
	}

	function getJadwalKosong()
	{
		echo $this->mdl->getJadwalKosong();
	}

	function req_nojadwal()
	{
		$d = $this->db->get("data_pegawai")->result();
		$tahun 		= $this->m_reff->tahun();
		$semester 	= $this->m_reff->semester();


		foreach ($d as $v) {
			$this->db->where("id_tahun", $tahun);
			$this->db->where("id_semester", $semester);
			$this->db->where("id_guru", $v->id);
			$this->db->where("id_hari", "1");
			$cek_hari = $this->db->get("v_jadwal")->num_rows();

			if ($cek_hari == 0) {
				echo $v->nama . "<br>";
			}
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
		$periode = $this->input->get_post("periode");
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

			$row[] = "<span class='size linehover' onclick='edit(`" . $dataDB->id . "`)'>  <a target='_blank' href='" . base_url() . "presensi/down_guru2?periode=" . $periode . "&sts=" . $dataDB->sts_kepegawaian . "&gender=" . $dataDB->jk . "&jabatan=" . $dataDB->id_jabatan . "&idguru=" . $dataDB->id . "' >" . $dataDB->nama_lengkap . "</a> </span>";
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
	function down_guru2()
	{

		ob_start();
		$isi =	$this->load->view("down_guru_pdf");
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "297"), 'en', true, '', array(10, 10, 0, 5));
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('presensi_pegawai.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}

		//$this->load->view("down_guru_pdf");
	}

	function format_siswa()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("format_siswa");
		} else {
			$data['konten'] = "format_siswa";
			$this->_template($data);
		}
	}

	function format_siswa_pdf()
	{

		ob_start();
		$isi =	$this->load->view("format_siswa_pdf");
		$isi = ob_get_clean();
		$kelas = $this->m_reff->goField("v_kelas", "nama", " WHERE id='" . $id . "' ");

		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "330"), 'en', true, '', array(5, 5, 0, 5));
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			ob_end_clean();
			$html2pdf->Output('format_presensi_siswa_' . $kelas . '.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
		//$this->load->view("format_siswa_pdf");
	}
}
