<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller
{


	var $tbl = "v_pegawai";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("admin", "guru"));
		$this->load->model("model", "mdl");
		$this->load->model("model_absen", "mdl_absen");
		$this->load->model("model_pendidik", "mdl_pendidik");
		$this->load->model("model_pegawai", "mdl_pegawai");
		$this->load->model("model_siswa", "mdl_siswa");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->m_konfig->validasi_session(array("admin"));
		$this->load->view('template/main', $data);
	}

	public function index()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}
	public function jurusan()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("jurusan");
		} else {
			$data['konten'] = "jurusan";
			$this->_template($data);
		}
	}
	public function siswa()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			// 	echo "<script> window.location.href='pendidik';</script>";
			echo	$this->load->view("siswa");
		} else {
			$data['konten'] = "siswa";
			$this->_template($data);
		}
	}
	public function list_siswa()
	{
		$this->m_konfig->validasi_session(array("admin", "guru"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			// 	echo "<script> window.location.href='pendidik';</script>";
			echo	$this->load->view("list_siswa");
		} else {
			$data['konten'] = "list_siswa";
			$this->_template($data);
		}
	}
	public function migrasi()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			// 	echo "<script> window.location.href='pendidik';</script>";
			echo	$this->load->view("migrasi");
		} else {
			$data['konten'] = "migrasi";
			$this->_template($data);
		}
	}


	public function pendidik()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			// 	echo "<script> window.location.href='pendidik';</script>";
			echo	$this->load->view("pendidik");
		} else {
			$data['konten'] = "pendidik";
			$this->_template($data);
		}
	}
	public function pegawai()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			// 	echo "<script> window.location.href='pendidik';</script>";
			echo	$this->load->view("pegawai");
		} else {
			$data['konten'] = "pegawai";
			$this->_template($data);
		}
	}

	function data_pegawai()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$list = $this->mdl_pegawai->get_data();
		$data = array();
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

			$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
                                    <button type="button" onclick="edit(`' . $dataDB->id . '`)" class="btn bg-blue-grey waves-effect waves-light">EDIT</button>
                                    <button type="button" onclick="aktifasi(`' . $dataDB->id . '`,`' . $dataDB->aktifasi . '`)" class="btn bg-blue-grey waves-effect waves-light">' . $in . '</button>
                                    <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama_lengkap . '`)" class="btn bg-blue-grey waves-effect waves-light">HAPUS</button>
                                   
                                </div>
                                
                            </div>';



			$row = array();
			$row[] = "<span class='size linehover'  >" . $no++ . "</span>";
			//	$row[] = "<span class='size linehover' >".$this->mdl_pendidik->status_instal($dataDB->id)."</span>";	


			$row[] = "<span class='size linehover' >  <img alt='Photo' class='img-responsive thumbnail' width='80px' src='" . base_url() . "file_upload/dp/" . $dataDB->poto . "'>  </img></span>";

			$row[] = "<span class='size linehover' >  " . $dataDB->nama_lengkap . " </span>";
			$row[] = "<span class='size' >  " . strtoupper($dataDB->jk) . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->jabatan . " </span>";
			$row[] = "<span class='size' >  " . $this->tanggal->ind($dataDB->tmt, "/") . " </span>";

			$row[] = "<span class='size' >  " . $dataDB->pangkat . " </span>";

			$row[] = "<span class='size' >  " . $dataDB->nip . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->nip_asli . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->nuptk . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->hp . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->email . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->alamat . " </span>";
			$row[] = "<span class='size' >  " . $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . " </span>";
			//		$row[] = "<span class='size' >  ".$this->mdl_pendidik->getDataMapel($dataDB->id_mapel)." </span>";
			$row[] = "<span class='size' >  " . $dataDB->tempat_lahir . " </span>";
			$row[] = "<span class='size' >  " . $this->tanggal->ind($dataDB->tgl_lahir, "/") . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->ijazah . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->sts_pegawai . " </span>";
			$row[] = "<span class='size'  >  " . $akt . " </span>";

			$row[] = $tombol;


			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_pegawai->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	function data_pendidik()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$list = $this->mdl_pendidik->get_data();
		$data = array();
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

			$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
                                    <button type="button" onclick="edit(`' . $dataDB->id . '`)" class="btn bg-blue-grey waves-effect waves-light">EDIT</button>
                                    <button type="button" onclick="aktifasi(`' . $dataDB->id . '`,`' . $dataDB->aktifasi . '`)" class="btn bg-blue-grey waves-effect waves-light">' . $in . '</button>
                                    <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama_lengkap . '`)" class="btn bg-blue-grey waves-effect waves-light">HAPUS</button>
                                   
                                </div>
                                
                            </div>';



			$row = array();
			$row[] = "<span class='size linehover'  >" . $no++ . "</span>";
			//	$row[] = "<span class='size linehover' >".$this->mdl_pendidik->status_instal($dataDB->id)."</span>";	


			$row[] = "<span class='size linehover' >  <img alt='Photo' class='img-responsive thumbnail' width='80px' src='" . base_url() . "file_upload/dp/" . $dataDB->poto . "'>  </img></span>";

			$row[] = "<span class='size linehover' >  " . $dataDB->nama_lengkap . " </span>";
			$row[] = "<span class='size' >  " . strtoupper($dataDB->jk) . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->jabatan . " </span>";
			$row[] = "<span class='size' >  " . $this->tanggal->ind($dataDB->tmt, "/") . " </span>";

			$row[] = "<span class='size' >  " . $dataDB->pangkat . " </span>";

			$row[] = "<span class='size' >  " . $dataDB->nip . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->nip_asli . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->nuptk . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->hp . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->email . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->alamat . " </span>";
			$row[] = "<span class='size' >  " . $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . " </span>";
			//		$row[] = "<span class='size' >  ".$this->mdl_pendidik->getDataMapel($dataDB->id_mapel)." </span>";
			$row[] = "<span class='size' >  " . $dataDB->tempat_lahir . " </span>";
			$row[] = "<span class='size' >  " . $this->tanggal->ind($dataDB->tgl_lahir, "/") . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->ijazah . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->sts_pegawai . " </span>";
			$row[] = "<span class='size'  >  " . $akt . " </span>";

			$row[] = $tombol;


			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_pendidik->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function import_data_guru()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$data = $this->mdl_pendidik->import_data_guru();
		echo json_encode($data);
	}
	function update_data_guru()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$data = $this->mdl_pendidik->update_data_guru();
		echo json_encode($data);
	}
	function download_format_guru()
	{
		$this->m_konfig->validasi_session(array("admin"));
		echo $this->mdl_pendidik->download_format_guru();
	}
	function input_data_guru()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$data = $this->mdl_pendidik->input_data_guru();
		echo json_encode($data);
	}

	///-----------------------SISWA--------------------------///

	function data_siswa()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$list = $this->mdl_siswa->get_data();
		$data = array();
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

			$tombol = ' 
                                 
              <button  title="Profile detail"
			  type="button" onclick="detail(`' . $dataDB->id . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     <i class="material-icons">account_circle</i></button>
                             
              <button title="Edit data" type="button" onclick="edit(`' . $dataDB->id . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     <i class="material-icons">border_color</i></button>
           <button title="Hapus data" type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nis . '`,`' . $dataDB->nama . '`)" 
		   class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   <i class="material-icons">delete_forever</i></button>
                                 
                            </div>';



			$row = array();
			$row[] = "<span class='size'  onclick='edit(`" . $dataDB->id . "`)'  >" . $no++ . "</span>";	//0
			//	$row[] = "<span class='size' onclick='edit(`".$dataDB->id."`)' >  ".$dataDB->id." </span>";
			$row[] = $tombol; //1
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->nama . " </span>"; //2
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . strtoupper($dataDB->jk) . " </span>"; //3
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->tempat_lahir . ", " . $this->tanggal->ind($dataDB->tgl_lahir, "/") . " </span>"; //4
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->agama . " </span>"; //5
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->nis . " </span>"; //6
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->nisn . " </span>"; //7
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->nik . " </span>"; //8
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->tingkat . " </span>"; //9
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->jurusan . " </span>"; //10
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->nama_kelas . " </span>"; //11
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->tahun_masuk . " </span>"; //12
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->hp . " </span>"; //13
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->email . " </span>"; //14
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->alamat . " </span>"; //15
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->asal_sd . " </span>"; //16
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->tahun_lulus_sd . " </span>"; //17
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->asal_smp . " </span>"; //18
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->tahun_lulus_smp . " </span>"; //19

			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->nama_ayah . " </span>"; //20
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->nama_ibu . " </span>"; //21
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->hp_ayah . " </span>"; //22
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->hp_ibu . " </span>"; //23
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->status_ayah . " </span>"; //24
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->status_ibu . " </span>"; //25
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->id_pekerjaan_ayah . " </span>"; //26
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->id_pekerjaan_ibu . " </span>"; //27
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->alamat_ortu . " </span>"; //28
			//	$row[] = "<span class='size'>  ".$dataDB->anak_ke." </span>";
			//	$row[] = "<span class='size'>  ".$dataDB->jml_saudara." </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->nama_wali . " </span>"; //29
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->hp_wali . " </span>"; //30
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->hubungan . " </span>"; //31


			$subp1 = substr($dataDB->alias, 2);
			$subp2 = substr($subp1, 0, -2);

			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->username . " </span>"; //32
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $subp2 . " </span>"; //33




			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_siswa->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function data_siswa_view()
	{
		$this->m_konfig->validasi_session(array("admin", "guru"));
		$list = $this->mdl_siswa->get_data();
		$data = array();
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
			$row[] = "<span class='size'  onclick='edit_(`" . $dataDB->id . "`)'  >" . $no++ . "</span>";
			//	$row[] = "<span class='size' onclick='edit_(`".$dataDB->id."`)' >  ".$dataDB->id." </span>";
			$row[] = "<span class='size' onclick='detail(`" . $dataDB->id . "`)' >  " . $dataDB->nama . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . strtoupper($dataDB->jk) . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->tempat_lahir . ", " . $this->tanggal->ind($dataDB->tgl_lahir, "/") . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->agama . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->nis . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->nisn . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->nik . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->tingkat . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->jurusan . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->nama_kelas . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->tahun_masuk . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->hp . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->email . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->alamat . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->asal_sd . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->tahun_lulus_sd . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->asal_smp . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->tahun_lulus_smp . " </span>";

			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->nama_ayah . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->nama_ibu . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->hp_ayah . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->hp_ibu . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->status_ayah . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->status_ibu . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->id_pekerjaan_ayah . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->id_pekerjaan_ibu . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->alamat_ortu . " </span>";
			//	$row[] = "<span class='size'>  ".$dataDB->anak_ke." </span>";
			//	$row[] = "<span class='size'>  ".$dataDB->jml_saudara." </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->nama_wali . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->hp_wali . " </span>";
			$row[] = "<span class='size' onclick='edit_(`" . $dataDB->id . "`)' >  " . $dataDB->hubungan . " </span>";





			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_siswa->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function data_migrasi()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$list = $this->mdl_siswa->data_migrasi();
		$data = array();
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
			$row[] = "<span class='size'  onclick='edit(`" . $dataDB->id . "`)'  >" . $no++ . "</span>";
			$row[] =  '
			 <input type="checkbox" id="md_checkbox_' . $dataDB->id . '"   class="pilih filled-in chk-col-red" onclick="pilcek()"  name="hapus[]"  value="' . $dataDB->id . '" />
              <label for="md_checkbox_' . $dataDB->id . '">&nbsp;</label> ';

			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->nama . " </span>";
			$row[] = "<span class='size' onclick='edit(`" . $dataDB->id . "`)' >  " . $dataDB->nama_kelas . " </span>";




			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_siswa->count_migrasi(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	///-----------------------CATATAN PENILIAAN--------------------------///
	function catatan_penilaian()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$list = $this->mdl_siswa->catatan_penilaian();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////




			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>  " . $this->tanggal->hariLengkap($dataDB->tgl, "/") . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->penilaian . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->ket . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->point . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->tingkat . " </span>";



			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_siswa->count_catatan(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function import_data_siswa()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$data = $this->mdl_siswa->import_data_siswa();
		echo json_encode($data);
	}
	function update_data_siswa()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$data = $this->mdl_siswa->update_data_siswa();
		echo json_encode($data);
	}
	function download_format_siswa()
	{
		$this->m_konfig->validasi_session(array("admin"));
		echo $this->mdl_siswa->download_format_siswa();
	}
	function input_data_siswa()
	{
		$this->m_konfig->validasi_session(array("admin", "guru"));
		$data = $this->mdl_siswa->input_data_siswa();
		echo json_encode($data);
	}
	function detail_siswa()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$data["data"] = $this->db->get_where("v_siswa", array("id" => $this->input->post("id")))->row();
		echo $this->load->view("isi_detail_siswa", $data);
	}
	function edit_data_siswa()
	{
		$this->m_konfig->validasi_session(array("admin", "guru"));
		$id = $this->input->post("id");
		$this->db->where("id", $id);
		$data["data"] = $this->db->get("v_siswa")->row();
		echo $this->load->view("edit_siswa", $data);
	}

	//-------------------------------------------------END SISWA------------------------------------//
	function idu()
	{
		return $this->session->userdata("id");
	}
	function edit_data_guru()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$id = $this->input->post("id");
		$this->db->where("id", $id);
		$data["data"] = $this->db->get($this->tbl)->row();
		echo $this->load->view("edit_pendidik", $data);
	}
	function hapus_pendidik()
	{
		$this->m_konfig->validasi_session(array("admin"));
		echo $this->mdl_pendidik->hapus_pendidik();
	}
	function hapus_siswa()
	{
		$this->m_konfig->validasi_session(array("admin"));
		echo $this->mdl_siswa->hapus_siswa();
	}
	function aktifasi_pendidik()
	{
		$this->m_konfig->validasi_session(array("admin"));
		echo $this->mdl_pendidik->aktifasi_pendidik();
	}

	function getKelas()
	{
		$this->m_konfig->validasi_session(array("admin", "guru"));
		$idtk = $this->input->post("id");
		$idjurusan = $this->input->post("jur");
		$value = $this->input->post("val");

		$this->db->where("id_tk", $idtk);
		$this->db->where("id_jurusan", $idjurusan);
		$sts = $this->db->get("tm_kelas")->result();
		$ray = array();
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $val->nama;
		}
		echo form_dropdown("f[id_kelas]", $ray, $value, 'required class="form-control col-md-12 show-tick" ');
		echo "<script>$('select').selectpicker();</script>";
	}
	function buka_akun()
	{
		$this->m_konfig->validasi_session(array("admin"));
		//$tahun=$this->m_reff->tahun();
		//$sms=$this->m_reff->semester();
		$id = $this->input->post("id");
		/*	$this->db->query("delete from tm_mapel_ajar where id_guru='".$id."' AND id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_materi where id_guru='".$id."' AND id_tahun='".$tahun."' AND id_semester='".$sms."'");
		$this->db->query("delete from tm_kikd where id_guru='".$id."' AND id_tahun='".$tahun."' AND id_semester='".$sms."' ");
		$this->db->query("delete from tm_penjadwalan where id_guru='".$id."'  AND id_tahun='".$tahun."' AND id_semester='".$sms."'");
		$this->db->query("delete from data_nilai where id_guru='".$id."'  AND id_tahun='".$tahun."' AND id_semester='".$sms."'"); */
		$this->db->query("UPDATE data_pegawai set tahap1='0',tahap2='0',tahap3='0',tahap4='0' where id='" . $id . "' ");
		echo true;
	}

	function buka_akun_all()
	{
		$this->m_konfig->validasi_session(array("admin"));
		//  $this->m_reff->hapussemua("file_upload/tugas");
		//  $this->m_reff->hapussemua("file_upload/pengumuman");
		/*   	
	    $tahun=$this->m_reff->tahun();
		$sms=$this->m_reff->semester();
		$id=$this->input->post("id");
		$this->db->query("delete from tm_bahan_ajar");
		$this->db->query("delete from tm_absen_guru where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_absen_siswa where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
 
		$this->db->query("delete from tm_catatan where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_diliburkan where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_catatan_walikelas where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_ekstrakurikuler where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_kh where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_log_kehadiran  ");
		$this->db->query("delete from tm_tanggapan  ");
		$this->db->query("delete from data_nilai where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_materi where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_petugas_piket where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_pkl where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_prestasi where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_sikap where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_tagihan where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_mapel_ajar where  id_tahun='".$tahun."' AND id_semester='".$sms."'  ");
		$this->db->query("delete from tm_materi where  id_tahun='".$tahun."' AND id_semester='".$sms."'");
		$this->db->query("delete from tm_kikd where  id_tahun='".$tahun."' AND id_semester='".$sms."' ");
		$this->db->query("delete from tm_penjadwalan where    id_tahun='".$tahun."' AND id_semester='".$sms."'");
		*/
		$this->db->query("UPDATE data_pegawai set tahap1='0',tahap2='0',tahap3='0',tahap4='0' ");
		echo true;
	}
	function ajax_migrasi()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$id_kelas = $this->input->post("id_kelas");
		$db = $this->db->query("select * from v_kelas where id='" . $id_kelas . "'")->row();
		$this->db->where("id_tk", ($db->id_tk + 1));
		$this->db->where("id_jurusan", $db->id_jurusan);
		$dbkelas = $this->db->get("v_kelas")->result();
		echo '
		    <select class="form-control show-tick" name="kelas_baru">';

		if ($db->id_tk == 3) {
			echo '<option value="lulus">TELAH LULUS</option>';
		} else {
			echo '<option value="">--- Pilih ---</option>';
		}



		foreach ($dbkelas as $val) {
			echo "<option value='" . $val->id . "'>" . $val->nama . "</option>";
		}
		echo '  </select>';
	}

	function go_migrasi()
	{
		$this->m_konfig->validasi_session(array("admin"));
		$echo = $this->mdl->go_migrasi();
		echo json_encode($echo);
	}
}
