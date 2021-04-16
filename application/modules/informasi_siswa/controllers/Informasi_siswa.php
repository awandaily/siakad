<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Informasi_siswa extends CI_Controller
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
		$this->m_reff->updateToken();
		$index = "index";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	function im_tgl()
	{
		$d = $this->db->get("bio")->result();
		foreach ($d as $v) {
			$this->db->set("tgl", $v->tgl);
			$this->db->set("tmp", $v->tmp);
			$this->db->where("nis", $v->nis);
			$this->db->update("kelulusan");
		}
	}

	public function kelulusan()
	{
		$index = "kelulusan2";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
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
	public function pts()
	{
		$this->m_konfig->validasi_session(array("admin", "keuangan siswa"));
		$index = "pts";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	function get_siswa()
	{
		$idkelas = $_POST["idkelas"];

		$this->db->order_by("nama", "asc");
		$this->db->where("id_kelas", $idkelas);
		$this->db->where_in("id_sts_data", array("1", "4"));
		$d = $this->db->get("v_siswa")->result();

		$sel = "<select name='idsiswa[]' id='idsiswa' multiple='' class='form-control show-tick' data-live-search='true' data-actions-box='true'>";
		foreach ($d as $v) {
			$sel .= "<option value='" . $v->id . "'>" . $v->nama . "</option>";
		}
		$sel .= "</select>";
		$sel .= "
			<script>
				$('#idsiswa').selectpicker();
			</script>
		";

		echo $sel;
	}

	function pts_format_word()
	{
		$this->load->view("pts_format_word");
	}

	function pts_format()
	{

		ob_start();
		$isi =	$this->load->view("pts_format");
		$isi = ob_get_clean();
		//$kelas = "";
		//$kelas = $this->m_reff->goField("v_kelas", "nama", " WHERE id='".$id."' ");

		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "330"), 'en', true, '', array(5, 0, 5, 0));
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			ob_end_clean();
			$html2pdf->Output('kartu_ujian.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}


		//$this->load->view("pts_format");
	}

	function download_surat()
	{
		ob_start();
		$isi = $this->load->view('kelulusan');
		// return true;
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "297"), 'en', true, '', array(18, 15, 15, 15));
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
			$row[] = '
			<div   style="max-width:22px">
                                <input  onclick="pilih()"  type="checkbox" value="' . $dataDB->id . '" name="datatable[]" id="basic_checkbox_' . $no . '" class="filled-in pilih chk-col-deep-orange""  />
                                <label for="basic_checkbox_' . $no . '"> </label></div>';
			$row[] = "<span class='size'    >" . $no . "</span>";
			$row[] = "<span class='size'    >" . $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . "</span>";
			$row[] =  "<a href='javascript:detail(`" . $dataDB->id . "`)'>" . $dataDB->nama . "</a> (" . strtoupper($dataDB->jk) . ")";
			$row[] = "<input style='max-width:150px' type='text' id='no_un" . $dataDB->id . "' name='no_un" . $dataDB->id . "' onchange='ket_un(`" . $dataDB->id . "`,`no_un`)' value='" . $dataDB->no_un . "'>";
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

	function im_kelulusan()
	{
		$d = $this->db->get("kelulusan_temp")->result();

		foreach ($d as $v) {
			$dt = array(
				"nis"	=> $v->nis,
				"no_peserta"	=> $v->nopes,
				"status"	=> "0"
			);

			$this->db->where("nis", $v->nis);
			$x = $this->db->get("kelulusan")->num_rows();
			if ($x == 0) {
				//$this->db->insert("kelulusan", $dt);
			}
		}
	}

	function im_nilai()
	{
		$d = $this->db->get("kelulusan_temp")->result();

		foreach ($d as $v) {
			//agama
			$this->db->where("id_mapel", "1");
			$this->db->where("nis", $v->nis);
			$c1 = $this->db->get("kelulusan_nilai")->num_rows();
			if ($c1 == 0) {
				$this->db->set("id_mapel", "1");
				$this->db->set("nis", $v->nis);
				$this->db->set("score", $v->pabp);
				$this->db->insert("kelulusan_nilai");
			}

			//ppkn
			$this->db->where("id_mapel", "2");
			$this->db->where("nis", $v->nis);
			$c2 = $this->db->get("kelulusan_nilai")->num_rows();
			if ($c2 == 0) {
				$this->db->set("id_mapel", "2");
				$this->db->set("nis", $v->nis);
				$this->db->set("score", $v->ppkn);
				$this->db->insert("kelulusan_nilai");
			}

			//bindo
			$this->db->where("id_mapel", "3");
			$this->db->where("nis", $v->nis);
			$c3 = $this->db->get("kelulusan_nilai")->num_rows();
			if ($c3 == 0) {
				$this->db->set("id_mapel", "3");
				$this->db->set("nis", $v->nis);
				$this->db->set("score", $v->bindo);
				$this->db->insert("kelulusan_nilai");
			}

			//mat
			$this->db->where("id_mapel", "4");
			$this->db->where("nis", $v->nis);
			$c4 = $this->db->get("kelulusan_nilai")->num_rows();
			if ($c4 == 0) {
				$this->db->set("id_mapel", "4");
				$this->db->set("nis", $v->nis);
				$this->db->set("score", $v->mat);
				$this->db->insert("kelulusan_nilai");
			}

			//bing
			$this->db->where("id_mapel", "5");
			$this->db->where("nis", $v->nis);
			$c5 = $this->db->get("kelulusan_nilai")->num_rows();
			if ($c5 == 0) {
				$this->db->set("id_mapel", "5");
				$this->db->set("nis", $v->nis);
				$this->db->set("score", $v->bing);
				$this->db->insert("kelulusan_nilai");
			}

			//prod
			$this->db->where("id_mapel", "6");
			$this->db->where("nis", $v->nis);
			$c6 = $this->db->get("kelulusan_nilai")->num_rows();
			if ($c6 == 0) {
				$this->db->set("id_mapel", "6");
				$this->db->set("nis", $v->nis);
				$this->db->set("score", $v->prod);
				$this->db->insert("kelulusan_nilai");
			}
		}
	}

	function get_status_kelulusan()
	{
		$nis = $_POST["nis"];

		$this->db->where("nis", $nis);
		$d = $this->db->get("kelulusan")->row_array();

		echo $d["status"];
	}

	function set_status_kelulusan()
	{
		$nis = $_POST["nis"];
		$v = $_POST["v"];

		$this->db->set("status", $v);
		$this->db->where("nis", $nis);
		$this->db->update("kelulusan");

		echo "1";
	}

	function get_nilai_kelulusan()
	{
		$nis = $_POST["nis"];

		$this->db->where("nis", $nis);
		$d = $this->db->get("kelulusan_nilai")->result();

		$html = "";
		$no = 1;
		$total = 0;
		foreach ($d as $v) {
			$html .= "
				<tr>
					<td>" . $no . "</td>
					<td>" . $this->m_reff->goField('kelulusan_mapel', 'nama_mapel', "WHERE id='" . $v->id_mapel . "' ") . "</td>
					<td>
						<input type='text' class='form-control' onchange='set_nilai(`" . $v->id . "`, this.value)' value='" . number_format($v->score, 0, ',', '.') . "'>
					</td>
				</tr>
			";
			$total = $total + $v->score;
			$no++;
		}

		$rata = ($total / 6);
		$html .= "
			<tr>
				<td colspan='2' align='center'>RATA - RATA</td>
				<td>" . number_format($rata, 0, ',', '.') . "</td>
			</tr>
		";

		echo $html;
	}

	function set_nilai_kelulusan()
	{
		$id = $_POST["id"];
		$v = $_POST["v"];

		$this->db->set("score", $v);
		$this->db->where("id", $id);
		$this->db->update("kelulusan_nilai");

		echo "1";
	}

	function setting_kelulusan()
	{
		$v = $_POST["v"];

		$this->db->set("open_kelulusan", $v);
		$this->db->where("kode", "lnd");
		$this->db->update("kelulusan_setting");
		echo "1";
	}

	function print_kelulusan($nis)
	{
		ob_start();
		$data["nis"] = $nis;
		$isi =	$this->load->view("print_kelulusan", $data);
		$isi = ob_get_clean();
		//$kelas = "";
		//$kelas = $this->m_reff->goField("v_kelas", "nama", " WHERE id='".$id."' ");

		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "330"), 'en', true, '', array(5, 0, 5, 0));
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			ob_end_clean();
			$html2pdf->Output('print_kelulusan.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}

	function data_siswa2()
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

			$st_kelulusan = $this->m_reff->goField("kelulusan", "status", "WHERE nis='" . $dataDB->nis . "'");

			switch ($st_kelulusan) {
				case '1':
					$stsna = "LULUS";
					break;
				case '2':
					$stsna = "TIDAK DITAMPILKAN";
					break;
				case '3':
					$stsna = "TIDAK LULUS";
					break;
				case '0':
					$stsna = "BELUM DIISI";
					break;

				default:
					$stsna = "UNDEFINED";
					break;
			}


			$row = array();
			$row[] = "<span class='size'    >" . $no . "</span>";
			$row[] = "<span class='size'    >" . $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . "</span>";
			$row[] =  "<a href='javascript:detail(`" . $dataDB->id . "`)'>" . $dataDB->nama . "</a> (" . strtoupper($dataDB->jk) . ")";
			$row[] = "<span>" . $dataDB->nis . "</span>";
			$row[] = "<center><b>" . $stsna . "</b></center>";
			$row[] = "
				<center>
					<button class='btn btn-warning' onclick='get_status(`" . $dataDB->nis . "`)' data-toggle='modal' data-target='#mdl_status'>EDIT STATUS</button>
					<button class='btn btn-success' onclick='get_nilai(`" . $dataDB->nis . "`)' data-toggle='modal' data-target='#mdl_nilai'>NILAI</button>
					<a target='_blank' class='btn btn-danger' href='" . base_url() . "informasi_siswa/print_kelulusan/" . $dataDB->nis . "'>PRINT</a>
				</center>
			";

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

	function setinfo()
	{
		$this->m_konfig->validasi_global();
		$this->db->set("val", $this->input->post("id"));
		$this->db->where("id", 18);
		echo   $this->db->update("pengaturan");
	}
	function ket_un()
	{
		$this->m_konfig->validasi_global();
		$this->db->set($this->input->post("tbl"), $this->input->post("val"));
		$this->db->where("id", $this->input->post("id"));
		echo  $this->db->update("data_siswa");
	}
}
