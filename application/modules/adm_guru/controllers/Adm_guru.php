<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adm_guru extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("guru", "TK"));
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
	public function gaji()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("gaji");
		} else {
			$data['konten'] = "gaji";
			$this->_template($data);
		}
	}
	function input()
	{
		echo $this->index();
	}
	function getData()
	{
		echo $this->load->view("getData");
	}
	function hitung()
	{
		$pengeluaran = $this->input->get_post("simpanan[]");
		$pemasukan = $this->input->get_post("pemasukan");
		$pemasukan = str_replace(".", "", $pemasukan);
		$potongan = $this->input->get_post("potongan");
		$potongan = str_replace(".", "", $potongan);
		$bayar_pinjaman = $this->input->get_post("bayar_pinjaman");
		$bayar_pinjaman = str_replace(".", "", $bayar_pinjaman);
		$jml = "";
		foreach ($pengeluaran as $val) {
			$val = str_replace(".", "", $val);
			$jml = $val + $jml;
		}
		$pengeluaran = $potongan + $jml + $bayar_pinjaman;
		$hasil = $pemasukan - $pengeluaran;
		$var["nominal"] = number_format($hasil, 0, ",", ".");
		$var["potongan"] = number_format($pengeluaran, 0, ",", ".");
		$var["nominal_asli"] = $hasil;
		$var["potongan_asli"] = $pengeluaran;
		$var["baca"] = $this->umum->terbilang($hasil);
		echo json_encode($var);
	}

	function simpanPenggajian()
	{
		$data = $this->mdl->simpanPenggajian();
		echo json_encode($data);
	}
	function struk()
	{

		$this->load->view('struk');
	}

	function getDataGaji()
	{
		$list = $this->mdl->getDataGaji();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {

			$sts = "<button onclick='rincian(`" . $dataDB->id . "`,`" . $dataDB->periode . "`,`" . $dataDB->id_guru . "`,`" . $dataDB->nama_periode . "`)' class='waves-effect btn-block btn btn-mini bg-teal'>Rincian</button>";



			$row = array();
			//	$row[] = "<span class='size'>".$no++."</span>";	 
			$row[] = "<span class='size'>" . $dataDB->nama_periode . "<br>" . $dataDB->periode . "</span>";

			$row[] = "<span class='size'>Rp " . number_format($dataDB->gaji, 0, ",", ".") . "</span>";


			if ($dataDB->tgl_dibayarkan) {
				$terima = $this->tanggal->ind($dataDB->tgl_dibayarkan, "/");
			} else {
				$terima = " Belum ";
			}
			$row[] = "<span class='size'>" . $terima . "</span>";
			$row[] = "<span class='size'>" . $sts . "</span>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_getDataGaji(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function hapus_gaji()
	{
		echo $this->mdl->hapus_gaji();
	}
	function ubahStatus()
	{
		$id = $this->input->post("id");
		$sts = $this->input->post("sts");
		echo $this->mdl->ubahStatus($id, $sts);
	}
}
