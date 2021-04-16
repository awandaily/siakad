<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penggajian extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("keuangan"));
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
	public function cetak_rekap()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("cetak_rekap");
		} else {
			$data['konten'] = "cetak_rekap";
			$this->_template($data);
		}
	}
	public function data_gaji()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("data_gaji");
		} else {
			$data['konten'] = "data_gaji";
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

		$bpjs = $this->input->get_post("bpjs");
		$bpjs = str_replace(".", "", $bpjs);

		$potongan = $this->input->get_post("potongan");
		$potongan = str_replace(".", "", $potongan);
		$bayar_pinjaman = $this->input->get_post("bayar_pinjaman");
		$bayar_pinjaman = str_replace(".", "", $bayar_pinjaman);
		$jml = "";
		foreach ($pengeluaran as $val) {
			$val = str_replace(".", "", $val);
			$jml = $val + $jml;
		}
		$pengeluaran = $potongan + $jml + $bayar_pinjaman + $bpjs;
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
		ob_start();
		$isi = $this->load->view('struk');
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("110", "330"), 'en', true, '', array(2, 2, 6, 3));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('struk.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}
	function cetak_all()
	{
		ob_start();
		$isi = $this->load->view('strukAll');
		//return true;
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "297"), 'en', true, '', array(2, 2, 6, 3));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('struk.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}
	function cetakRekap()
	{
		ob_start();
		$isi = $this->load->view('cetakRekap');

		//return true;
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			//  $html2pdf = new HTML2PDF('P',array("210","297"), 'en', true, '', array(2,2, 6, 3));
			$html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('struk.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}

	function getDataGaji()
	{
		$list = $this->mdl->getDataGaji();
		$data = array();
		$no = $_POST['start'];
		$no = $no;
		foreach ($list as $dataDB) {
			$no++;
			$namaguru = $this->m_reff->goField("data_pegawai", "nama", "where id='" . $dataDB->id_guru . "'");
			$sts = "<button onclick='hapus(`" . $dataDB->id . "`,`" . $dataDB->periode . "`,`" . $dataDB->id_guru . "`,`" . $namaguru . "`)' class='waves-effect btn btn-mini bg-pink'>Hapus</button>";

			$tombol = '<a target="_blank" href="' . base_url() . 'penggajian/struk?periode=' . $dataDB->periode . '&id_guru=' . $dataDB->id_guru . '"  class="btn bg-indigo  
					waves-effect     aria-haspopup="true"	aria-expanded="true">
                   <i class="material-icons">print</i>    
                    </a>';

			$row = array();
			$row[] = '
			<div   style="max-width:22px">
                                <input title="pilih"   onclick="pilcek(`basic_checkbox_' . $no . '`)" type="checkbox" value="' . $dataDB->id_guru . '" name="c[]" id="basic_checkbox_' . $no . '" class="filled-in pilih chk-col-deep-orange"  />
                                <label for="basic_checkbox_' . $no . '"> </label></div>';
			$row[] = "<span class='size'>" . $no . "</span>";
			$row[] = "<span class='size'>" . $dataDB->nama_periode . "</span>";
			$row[] = "<span class='size'>" . $dataDB->periode . "</span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("data_pegawai", "nama", "where id='" . $dataDB->id_guru . "'") . "</span>";

			$row[] = "<span class='size'>" . number_format($dataDB->gaji, 0, ",", ".") . "</span>";
			$row[] = $tombol;

			if ($dataDB->tgl_dibayarkan) {
				$terima = "<a href='javascript:ubah(`" . $dataDB->id . "`,`0`,`" . $namaguru . "`)' class='btn btn-mini cursor col-pink'  >" . $this->tanggal->ind($dataDB->tgl_dibayarkan, "/") . "</a>";
			} else {
				$terima = "<button class='btn btn-mini bg-teal' onclick='ubah(`" . $dataDB->id . "`,`1`,`" . $namaguru . "`)'>Belum</button>";
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
	function hapusAll()
	{
		$id = $this->input->post("val");
		$periode = $this->input->post("periode");
		echo $this->mdl->hapusAll($id, $periode);
	}
	function ubahStatus()
	{
		$id = $this->input->post("id");
		$sts = $this->input->post("sts");
		echo $this->mdl->ubahStatus($id, $sts);
	}
	function ubahStatusAll()
	{
		$val = $this->input->post("val");
		$periode = $this->input->post("periode");
		echo $this->mdl->ubahStatusAll($val, $periode);
	}
}
