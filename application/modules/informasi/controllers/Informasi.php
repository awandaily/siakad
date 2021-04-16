<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Informasi extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("peserta"));
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

	function cetak()
	{

		$reg = $this->input->get("oreg");
		$idu = $this->input->get("idu");
		$db = $this->db->query("Select * from tm_peserta where id='" . $reg . "'")->row();
		if ($db->sts != 2) {
			return false;
		}
		$data['reg'] = $reg;
		if ($db->posisi_peminatan == 1) {
			$data['poto'] = base_url() . "file_upload/peserta/" . $reg . "/" . $this->m_reff->goField("tm_data_upload", "nama_file", "where id_upload=1 and id_admin='" . $idu . "' and id_persyaratan=1");
		} elseif ($db->posisi_peminatan == 2) {
			$data['poto'] = base_url() . "file_upload/peserta/" . $reg . "/" . $this->m_reff->goField("tm_data_upload", "nama_file", "where id_upload=3 and id_admin='" . $idu . "' and id_persyaratan=2");
		} elseif ($db->posisi_peminatan == 3) {
			$data['poto'] = base_url() . "file_upload/peserta/" . $reg . "/" . $this->m_reff->goField("tm_data_upload", "nama_file", "where id_upload=16 and id_admin='" . $idu . "' and id_persyaratan=3");
		}

		$data['nama'] = ucwords($db->nama);
		$data['gender'] = $this->m_reff->goField("tr_jk", "nama", "where id='" . $db->jk . "'");
		$data['tempat_lahir'] = ucwords($db->tempat_lahir);
		$data['tgl_lahir'] = $this->tanggal->ind($db->tgl_lahir, "/");
		$data['peminatan'] = $this->m_reff->goField("admin", "owner", "where id_admin='" . $db->madrasah_peminatan . "'");
		$data['posisi'] = $this->m_reff->goField("tr_kategory", "nama", "where id='" . $db->posisi_peminatan . "'");
		$data['alamat'] = $this->m_reff->goField("kabupaten", "nama", "where  id_prov='" . $db->idprov . "' AND id_kab='" . $db->idkab . "' ") . " - " . $this->m_reff->goField("provinsi", "nama", "where id_prov='" . $db->idprov . "'");
		$data['lokasi_test'] = $this->m_reff->goField("admin", "lokasi_test", "where id_admin='" . $db->madrasah_peminatan . "'");
		$data['tgl_test'] = $this->m_reff->goField("admin", "tgl_test", "where id_admin='" . $db->madrasah_peminatan . "'");
		$data['jam_test'] = $this->m_reff->goField("admin", "jam_test", "where id_admin='" . $db->madrasah_peminatan . "'");

		ob_start();
		//include('file.html');
		$isi = $this->load->view('kartu_test', $data);
		$isi = ob_get_clean();

		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', 'A4', 'en');
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('kartu-test.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
			exit;
		}
	}
}
