<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Analisis_data extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function lnd_test()
	{
		$this->load->view("lnd");
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

	function download_mutasi_siswa()
	{
		$this->load->view("excel_mutasi_siswa");
	}

	function perjurusan()
	{
		return $this->index();
	}
	function kompetensi()
	{
		$index = "kompetensi";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	function pdf_kompetensi()
	{

		ob_start();
		$isi = $this->load->view('pdf_kompetensi');
		//	return false;
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "330"), 'en', true, '', array(20, 10, 15, 10));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('Analisis Data Siswa Perjurusan.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}
	function pdf_perjurusan()
	{

		ob_start();
		$isi = $this->load->view('pdf_perjurusan');
		//	return false;
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "330"), 'en', true, '', array(20, 10, 15, 10));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('Analisis Data Siswa Perjurusan.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}
}
