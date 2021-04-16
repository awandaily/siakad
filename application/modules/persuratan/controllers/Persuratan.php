	<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Persuratan extends CI_Controller
	{


		function __construct()
		{
			parent::__construct();
			$this->m_konfig->validasi_session(array("admin"));
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
				// 	echo "<script> window.location.href='pendidik';</script>";
				echo	$this->load->view("index");
			} else {
				$data['konten'] = "index";
				$this->_template($data);
			}
		}

		public function getForm()
		{

			$final_form = "
			<form onsubmit='' method='GET' action='" . base_url() . "persuratan/preview?id=" . $_POST['id'] . "&print=false'>
				<input type='hidden' name='id' value='" . $_POST['id'] . "'>
				<input type='hidden' name='print' value='true'>
				" . $this->mdl->getForm() . "
				<div class='col-md-12'>
					<button class='btn-block aves-effect btn bg-teal' style='width: 100%;' type='submit'>
	                    <i class='material-icons'>print</i> PRINT
	                </button>
                </div>
			</form>
			<div class='col-md-12'>
				<hr>
				<iframe src='" . base_url() . "persuratan/preview?id=" . $_POST['id'] . "&print=false' style='width:100%;height:900px;'></iframe>
			</div>
		";

			echo $final_form;
		}

		public function getSiswa()
		{
			$d = $this->mdl->getSiswa();

			$op = "
			<select class='form-control show-tick' id='idsiswa' data-live-search='true' name='id_siswa' required>
				<option value=''>== PILIH SISIWA ==</option>
		";
			foreach ($d as $v) {
				$op .= "<option value='" . $v->id . "'>" . $v->nama . "</option>";
			}
			$op .= "</select>";

			echo $op;
		}

		public function getPegawai()
		{
			$d = $this->mdl->getPegawai();

			$op = "
			<select class='form-control show-tick' id='idpegawai' data-live-search='true' name='id_pegawai' required>
				<option value=''>== PILIH PEGAWAI ==</option>
		";
			foreach ($d as $v) {
				$op .= "<option value='" . $v->id . "'>" . $v->nama . "</option>";
			}
			$op .= "</select>";

			echo $op;
		}

		public function print_surat()
		{

			$this->db->order_by("nama_surat", "ASC");
			$d = $this->db->get("tm_persuratan")->result();
			$data['dt'] = $d;

			$ajax = $this->input->get_post("ajax");
			if ($ajax == "yes") {
				// 	echo "<script> window.location.href='pendidik';</script>";
				echo	$this->load->view("print_surat", $data);
			} else {
				$data['konten'] = "print_surat";
				$this->_template($data);
			}
		}
		public function rak()
		{

			$ajax = $this->input->get_post("ajax");
			if ($ajax == "yes") {
				// 	echo "<script> window.location.href='pendidik';</script>";
				echo	$this->load->view("rak");
			} else {
				$data['konten'] = "rak";
				$this->_template($data);
			}
		}
		function form()
		{
			echo $this->load->view("form");
		}

		function save()
		{
			echo $this->mdl->save();
		}

		function delete()
		{
			echo $this->mdl->delete();
		}

		function preview()
		{

			ob_start();
			$isi = $this->load->view('preview');
			// return true;
			$isi = ob_get_clean();
			require_once('static/html2pdf/html2pdf.class.php');
			try {
				$html2pdf = new HTML2PDF('P', array("210", "310"), 'en', true, '', array(8, 10, 10, 5));
				// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
				// $html2pdf->pdf->IncludeJS("print(true);");
				$html2pdf->setDefaultFont("times", "BI");
				$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
				ob_end_clean();
				$html2pdf->Output('Surat.pdf');
			} catch (HTML2PDF_exception $e) {
				echo $e;
			}

			//$this->load->view('preview');
		}

		function data()
		{
			$list = $this->mdl->get_data();
			$data = array();
			$no = $_POST['start'];
			$no = $no + 1;
			foreach ($list as $dataDB) {

				$btn = "
				<div class='btn-groups' role='groups'>
					<a target='_blank' class='btn bg-teal waves-effect waves-light' href='" . base_url() . "persuratan/preview?id=" . $dataDB->id . "&print=false'>PREVIEW</a>
                    <button type='button' onclick='edit(" . $dataDB->id . ", `" . $dataDB->nama_surat . "`)' class='btn bg-teal waves-effect waves-light'>EDIT</button>
                    <button type='button' onclick='hapus(" . $dataDB->id . ", `" . $dataDB->nama_surat . "`)' class='btn bg-teal waves-effect waves-light'>DELETE</button>
                </div>
			";


				$row = array();
				$row[] = "<span class='size linehover'><center>" . $no++ . "</center></span>";
				$row[] = "<span class='size' >  " . $dataDB->nama_surat . " </span>";
				$row[] = "<span class='size' ><center>" . $btn . "</center></span>";


				//add html for action

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



		function idu()
		{
			return $this->session->userdata("id");
		}

		function hapus_pendidik()
		{
			echo $this->mdl_pendidik->hapus_pendidik();
		}
	}
