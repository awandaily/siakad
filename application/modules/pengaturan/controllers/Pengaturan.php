<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("pusat", "admin"));
		$this->load->model("Model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}
	public function raport()
	{


		$this->session->unset_userdata("sts_table");
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("raport");
		} else {
			$data['konten'] = "raport";
			$this->_template($data);
		}
	}


	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{
		$this->session->unset_userdata("sts_table");
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}

	public function jam()
	{
		$this->session->unset_userdata("sts_table");
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("jam");
		} else {
			$data['konten'] = "jam";
			$this->_template($data);
		}
	}
	function save_jam()
	{
		echo $this->mdl->save_jam();
	}



	function save_()
	{
		$idp = $this->security->xss_clean($this->input->post("idpengaturan"));
		$val = $this->security->xss_clean($this->input->post("idkonten"));
		$tbl = $this->security->xss_clean($this->input->post("tbl"));
		if (!$tbl) {
			$tbl = "tm_pengaturan";
		}
		$data = $this->mdl->save_($idp, $val, $tbl);
		echo json_encode($data);
	}


	public function tahun()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("tahun");
		} else {
			$data['konten'] = "tahun";
			$this->_template($data);
		}
	}
	public function semester()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("semester");
		} else {
			$data['konten'] = "semester";
			$this->_template($data);
		}
	}
	public function identitas()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("identitas");
		} else {
			$data['konten'] = "identitas";
			$this->_template($data);
		}
	}

	function backuptb()
	{

		$tabel = $this->input->post('tabel');
		$tab = "";
		$nama = "simaster_";
		foreach ($tabel as $table) {
			$tab .= "'" . $table . "',";
		}
		$table = substr($tab, 0, -1);

		$this->load->dbutil();
		$prefs = array(
			'tables'      => $tabel,
			'format'      => 'zip',
			'filename'    => $nama . '.sql',
			'add_drop'      => FALSE,
		);
		$backup = &$this->dbutil->backup($prefs);
		$db_name = $nama .  date("d-m-Y") . '.zip'; //NAMAFILENYA
		$save = 'pathtobkfolder/' . $db_name;
		$this->load->helper('file');
		write_file($save, $backup);
		$this->load->helper('download');
		force_download($db_name, $backup);
	}

	function backuptbcbt()
	{
		$this->db->query("update data_siswa set password_cbt=SUBSTR((CAST(RAND() * 10000 AS UNSIGNED)*23454344),1,6)");
		$add = $this->m_reff->tm_pengaturan(16);
		$nama = "CBT_SIMASTER_";
		$table = array("cbt_blokir", "tm_kelas", "tr_tingkat", "tm_mapel_ajar", "tr_semester", "tr_tahun_ajaran", "tr_mapel", "data_siswa", "tr_kategory_nilai", "tr_jurusan", "admin", "data_pegawai", "main_level", "tr_jabatan");

		$this->load->dbutil();
		$prefs = array(
			'tables'      => $table,
			'format'      => 'zip',
			'filename'    => $nama . date("d-m-Y") . '.sql'
		);
		$backup = &$this->dbutil->backup($prefs, $add);
		$db_name = $nama .  date("d-m-Y") . '.zip'; //NAMAFILENYA
		$save = 'pathtobkfolder/' . $db_name;
		$this->load->helper('file');
		write_file($save, $backup);
		$this->load->helper('download');
		force_download($db_name, $backup);
	}


	public function backup()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			$data['tabel'] = $this->db->query("show tables")->result();
			echo	$this->load->view("backup", $data);
		} else {
			$data['tabel'] = $this->db->query("show tables")->result();
			$data['konten'] = "backup";
			$this->_template($data);
		}
	}
	function data()
	{
		$tbl = $this->uri->segment("3");
		$list = $this->mdl->get_open($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {


			if ($dataDB->sts == 1) {
				$akt = '<input type="radio" value="' . $dataDB->id . '" onclick="setAktif(`' . $dataDB->id . '`)" checked class="filled-in chk-col-pink" id="id' . $dataDB->id . '"  name="akt">
			<label for="id' . $dataDB->id . '">&nbsp;</label>';
			} else {
				$akt = '<input type="radio" value="' . $dataDB->id . '" onclick="setAktif(`' . $dataDB->id . '`)" class="filled-in chk-col-pink "   name="akt" id="id' . $dataDB->id . '"> 	<label for="id' . $dataDB->id . '">&nbsp;</label>';
			}
			$namakep = isset($dataDB->nama_kepsek) ? ($dataDB->nama_kepsek) : "";
			////
			if ($tbl == "tr_tahun_ajaran") {
				$tgl1 = isset($dataDB->tgl_cetak_raport) ? ($dataDB->tgl_cetak_raport) : "-";
				$tgl2 = isset($dataDB->tgl_cetak_raport_gnp) ? ($dataDB->tgl_cetak_raport_gnp) : "-";
				$tgl_penerimaan = isset($dataDB->tgl_penerimaan) ? ($dataDB->tgl_penerimaan) : "-";
				$tgl = "";
			} else {
				$tgl = "";
			}


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			if ($tbl == "tr_tahun_ajaran") {
				$row[] = '<span class="cursor col-blue cursor linhover size" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $tgl1 . '`,`' . $tgl2 . '`,`' . $namakep . '`,`' . $dataDB->tgl_cetak_un . '`,`' . $dataDB->no_surat_un . '`,`' . $tgl_penerimaan . '`)" >' . $dataDB->nama . ' </span>';
			} else {
				$row[] = '<span class="cursor col-blue cursor linhover size" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" >' . $dataDB->nama . ' </span>';
			}
			$row[] = "<span class='size'>" . $akt . " </span>";
			if ($tbl == "tr_tahun_ajaran") {
				$row[] = '<span class="link cursor col-blue"   onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $tgl1 . '`,`' . $tgl2 . '`,`' . $dataDB->nama_kepsek . '`,`' . $dataDB->tgl_cetak_un . '`,`' . $dataDB->no_surat_un . '`,`' . $tgl_penerimaan . '`)">' . $tgl_penerimaan . ' </span>';

				$row[] = '<span class="link cursor col-blue"   onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $tgl1 . '`,`' . $tgl2 . '`,`' . $dataDB->nama_kepsek . '`,`' . $dataDB->tgl_cetak_un . '`,`' . $dataDB->no_surat_un . '`,`' . $tgl_penerimaan . '`)">' . $tgl1 . ' </span>';
				$row[] = '<span class="link cursor col-blue"   onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $tgl1 . '`,`' . $tgl2 . '`,`' . $dataDB->nama_kepsek . '`,`' . $dataDB->tgl_cetak_un . '`,`' . $dataDB->no_surat_un . '`,`' . $tgl_penerimaan . '`)">' . $tgl2 . ' </span>';
				$row[] = '<span class="link cursor col-blue"   onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $tgl1 . '`,`' . $tgl2 . '`,`' . $dataDB->nama_kepsek . '`,`' . $dataDB->tgl_cetak_un . '`,`' . $dataDB->no_surat_un . '`,`' . $tgl_penerimaan . '`)">' . $dataDB->tgl_cetak_un . ' </span>';
				$row[] = '<span class="link cursor col-blue"   onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $tgl1 . '`,`' . $tgl2 . '`,`' . $dataDB->nama_kepsek . '`,`' . $dataDB->tgl_cetak_un . '`,`' . $dataDB->no_surat_un . '`,`' . $tgl_penerimaan . '`)">' . $dataDB->no_surat_un . ' </span>';

				$row[] = '<span class="link cursor col-blue"   onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $tgl1 . '`,`' . $tgl2 . '`,`' . $dataDB->nama_kepsek . '`,`' . $dataDB->tgl_cetak_un . '`,`' . $dataDB->no_surat_un . '`,`' . $tgl_penerimaan . '`)">' . $dataDB->nama_kepsek . ' </span>';
				$row[] = '<span class="link cursor col-blue"   onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $tgl1 . '`,`' . $tgl2 . '`,`' . $dataDB->nama_kepsek . '`,`' . $dataDB->tgl_cetak_un . '`,`' . $dataDB->no_surat_un . '`,`' . $tgl_penerimaan . '`)"><img width="80px" alt="ttd" src="' . base_url() . "/file_upload/dok/" . $dataDB->ttd_kepsek . '">  </span>';
			}
			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdl->count_file($tbl),
			"recordsFiltered" => $this->mdl->count_file($tbl),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function setTahunAktif()
	{
		$id = $this->input->post("id");
		echo $this->mdl->setTahunAktif($id);
	}
	function insert()
	{
		echo $this->mdl->insert();
	}
	function setSmsAktif()
	{
		$id = $this->input->post("id");
		echo $this->mdl->setSmsAktif($id);
	}

	function update($tbl)
	{
		echo $this->mdl->update($tbl);
	}
	function update_thn($tbl)
	{
		echo $this->mdl->update_thn($tbl);
	}
	function save_logo()
	{
		$this->mdl->save_logo();
		redirect("pengaturan/identitas");
	}
	function save_kelulusan()
	{
		$this->mdl->save_kelulusan();
		redirect("informasi_siswa/pengaturan");
	}
	function save_poto()
	{
		$this->mdl->save_poto();
		redirect("pengaturan/identitas");
	}
	function save_banner()
	{
		$this->mdl->save_banner();
		redirect("pengaturan/identitas");
	}
}
