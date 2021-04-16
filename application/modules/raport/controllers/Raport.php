<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Raport extends CI_Controller
{

	var $tbl_log = "data_siswa";

	var $tbl_jadwal = "v_jadwal";
	var $tbl_mapel = "tr_mapel";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("guru", "tk", "piket", "admin"));
		$this->load->model("model", "mdl");
		$this->load->model("model_siswa", "mdl_siswa");

		date_default_timezone_set('Asia/Jakarta');
		//	$this->session->unset_userdata("tahun_id");
		//	$this->session->unset_userdata("sms_id");

		$tahun_real = $this->m_reff->tahun_asli();
		$tahun_kini = $this->m_reff->tahun();
		if ($tahun_real != $tahun_kini) {
			$id_wali = $this->m_reff->goField("tm_catatan_walikelas", "_cid", "where id_tahun='" . $tahun_kini . "' and _cid='" . $this->mdl->idu() . "' order by RAND()   limit 1");

			if (!$id_wali) {
				echo "<center><h4>Data tidak tersedia dikarenakan anda tidak sebagai wali kelas pada tahun lalu.</h4></center>";
			}
		}
	}

	function edit_data_siswa()
	{
		$id = $this->input->post("id");
		$this->db->where("id", $id);
		$data["data"] = $this->db->get("v_siswa")->row();
		echo $this->load->view("edit_siswa", $data);
	}
	function cekWaliKelas()
	{
		$this->load->view('cekWaliKelas');
	}
	function _template($data)
	{
		$this->load->view('template/main', $data);
	}
	function catatan()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("catatan");
		} else {
			$data['konten'] = "catatan";
			$this->_template($data);
		}
	}
	function catatan_karakter()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("catatan_karakter");
		} else {
			$data['konten'] = "catatan_karakter";
			$this->_template($data);
		}
	}


	function prestasi()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("prestasi");
		} else {
			$data['konten'] = "prestasi";
			$this->_template($data);
		}
	}
	function ektra()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("ektra");
		} else {
			$data['konten'] = "ektra";
			$this->_template($data);
		}
	}
	function input_non()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("input_non");
		} else {
			$data['konten'] = "input_non";
			$this->_template($data);
		}
	}
	function kh()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("kh");
		} else {
			$data['konten'] = "kh";
			$this->_template($data);
		}
	}
	function dpk()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("dpk");
		} else {
			$data['konten'] = "dpk";
			$this->_template($data);
		}
	}
	function pkl()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("pkl");
		} else {
			$data['konten'] = "pkl";
			$this->_template($data);
		}
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
	public function legger()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("legger");
		} else {
			$data['konten'] = "legger";
			$this->_template($data);
		}
	}

	public function format_siswa()
	{
		$this->mdl_siswa->format_siswa();
	}

	public function data_siswa()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("data_siswa");
		} else {
			$data['konten'] = "data_siswa";
			$this->_template($data);
		}
	}

	function import_siswa()
	{
		echo json_encode($this->mdl_siswa->import_data_siswa());
	}



	function getLegger()
	{
		echo	$this->load->view("getLegger");
	}


	function getAbsen()
	{
		echo	$this->load->view("getAbsen");
	}
	function getSikap()
	{
		echo	$this->load->view("getSikap");
	}




	function setNilaiEskul()
	{
		$idsiswa = $this->input->post("idsiswa");
		$nilai = $this->input->post("nilai");
		$sms = $this->input->post("sms");
		echo  $this->mdl->setNilaiEskul($idsiswa, $nilai, $sms);
	}
	function getDataSiswa()
	{
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
			  type="button" onclick="detail(`' . $dataDB->id . '`)" class="bg-teal  btn-circle waves-effect waves-circle waves-float">
			     Detail </button>
           		<button title="Edit data" type="button" onclick="edit(`' . $dataDB->id . '`)" class="bg-blue-grey btn-circle waves-effect waves-circle waves-float">
			     Edit</button>
                                 
                            </div>';
			$sisa = $this->m_reff->goField("v_keu_rekap", "sisa", "WHERE id_siswa='" . $dataDB->id . "'");
			if (!$sisa) {
				$sisa = 0;
			}
			$link = $this->m_reff->poto_siswa($dataDB->id);

			$poto = '<img  alt="' . $dataDB->nama . '" 
										class="img-responsive thumbnail"   style="max-height:120px" 
										src="' . $link . '">';

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = $tombol;
			$row[] = "<span class='size'><center> <b class='col-indigo'>" . $dataDB->nama . "</b></center> $poto </span>";
			$row[] = "<span class='size'>  Rp. " . number_format($sisa, 0, ',', '.') . " </span>";
			$row[] = "<span class='size'>  " . strtoupper($dataDB->jk) . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->tempat_lahir . ", " . $this->tanggal->ind($dataDB->tgl_lahir, "/") . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->agama . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nisn . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nik . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->tingkat . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->jurusan . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nama_kelas . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->tahun_masuk . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->hp . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->email . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->alamat . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->asal_sd . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->tahun_lulus_sd . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->asal_smp . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->tahun_lulus_smp . " </span>";

			$row[] = "<span class='size'>  " . $dataDB->nama_ayah . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nama_ibu . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->hp_ayah . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->hp_ibu . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->status_ayah . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->status_ibu . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->id_pekerjaan_ayah . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->id_pekerjaan_ibu . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->alamat_ortu . " </span>";
			//	$row[] = "<span class='size'>  ".$dataDB->anak_ke." </span>";
			//	$row[] = "<span class='size'>  ".$dataDB->jml_saudara." </span>";
			$row[] = "<span class='size'>  " . $dataDB->nama_wali . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->hp_wali . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->hubungan . " </span>";





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
	function getDataSiswa_prestasi()
	{
		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		foreach ($list as $dataDB) {
			////


			$prestasi = "";
			$data_p = $this->db->query("select * from tm_prestasi where id_semester='" . $sms . "' and id_tahun='" . $tahun . "' and id_siswa='" . $dataDB->id . "'  ")->result();
			foreach ($data_p as $p) {
				$ket = isset($p->ket) ? ($p->ket) : "-";
				if (!$ket) {
					$ket = "-";
				}
				if ($this->m_reff->tahun_sts() == true) {
					$prestasi .= "<p style='border-bottom:black solid 1px'><b>" . $p->nama . "</b><br>" . $ket . " <span class='col-orange pull-right'>
				 <a class='cursor' href='javascript:edit(`" . $p->id . "`,`" . $dataDB->id . "`,`" . $p->nama . "`,`" . $p->ket . "`)'>Edit</a> | <a class='cursor' href='javascript:hapus(`" . $p->id . "`,`" . $p->nama . "`)'>Hapus</a> 
				  </span> <p>";
				} else {
					$prestasi .= "<p style='border-bottom:black solid 1px'><b>" . $p->nama . "</b><br>" . $ket . " <span class='col-orange pull-right'>
				 
				  </span> <p>";
				}
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";

			$row[] = "<span class='size'>  " . $prestasi . " </span>";



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

	function generate_kehadiran()
	{
		echo $this->mdl->generate_kehadiran();
	}

	function getDataSiswa_kh()
	{
		$dataabsen = $this->db->get_where("tr_sts_kehadiran", array("sts_tampil" => 1))->result();
		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		foreach ($list as $dataDB) {
			////


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";

			foreach ($dataabsen as $val) {
				$kh = $this->m_reff->goField("tm_kh", strtolower($val->nama), "where id_semester='" . $sms . "' and id_tahun='" . $tahun . "' and id_siswa='" . $dataDB->id . "' ");
				$row[] = "<span class='size'>  <span class='hide'>" . $kh . "</span> <input type='text' class='form-control' 
				onchange='setNilai(`" . strtolower($val->nama) . "`,`" . $dataDB->id . "`)' 
				name='jml" . strtolower($val->nama) . "_" . $dataDB->id . "' onkeydown='return nomor(this, event)' value='" . $kh . "' >
				</span>";
			}




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

	function getDataSiswa_dpk()
	{

		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		foreach ($list as $dataDB) {
			////


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " </span>";
			///	$row[] = "<span class='size'>  ".$dataDB->nis." </span>";

			$desc = $this->db->query("select * from tm_desc_karakter where id_tahun='" . $tahun . "' and id_semester='" . $sms . "' and id_siswa='" . $dataDB->id . "'  ")->row();
			$desc1 = isset($desc->desc1) ? ($desc->desc1) : "";
			$desc2 = isset($desc->desc2) ? ($desc->desc2) : "";
			$desc3 = isset($desc->desc3) ? ($desc->desc3) : "";
			$desc4 = isset($desc->desc4) ? ($desc->desc4) : "";
			$desc5 = isset($desc->desc5) ? ($desc->desc5) : "";
			$row[] = "<span class='size'>  <span class='hide'>" . $desc1 . "</span> <textarea type='text' class='form-control' 
				onchange='setNilai(`desc1`,`" . $dataDB->id . "`)' 
				name='desc1_$dataDB->id'  >$desc1</textarea>
				</span>";

			$row[] = "<span class='size'>  <span class='hide'>" . $desc2 . "</span> <textarea type='text' class='form-control' 
				onchange='setNilai(`desc2`,`" . $dataDB->id . "`)' 
				name='desc2_$dataDB->id'  >$desc2</textarea>
				</span>";

			$row[] = "<span class='size'>  <span class='hide'>" . $desc3 . "</span> <textarea type='text' class='form-control' 
				onchange='setNilai(`desc3`,`" . $dataDB->id . "`)' 
				name='desc3_$dataDB->id'  >$desc3</textarea>
				</span>";

			$row[] = "<span class='size'>  <span class='hide'>" . $desc4 . "</span> <textarea type='text' class='form-control' 
				onchange='setNilai(`desc4`,`" . $dataDB->id . "`)' 
				name='desc4_$dataDB->id'  >$desc4</textarea>
				</span>";


			$row[] = "<span class='size'>  <span class='hide'>" . $desc5 . "</span> <textarea type='text' class='form-control' 
				onchange='setNilai(`desc5`,`" . $dataDB->id . "`)' 
				name='desc5_$dataDB->id'  >$desc5</textarea>
				</span>";


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

	function getDataSiswa_non()
	{
		$list = $this->mdl_siswa->get_data_non();
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$datanilai = $this->db->get_where("data_nilai_nonmuslim", array(
				"id_siswa" => $dataDB->id,
				"id_semester" => $sms,
				"id_tahun" => $tahun,
			))->row();

			$Ns = isset($datanilai->s) ? ($datanilai->s) : "";
			$Np = isset($datanilai->p) ? ($datanilai->p) : "";
			$Nk = isset($datanilai->k) ? ($datanilai->k) : "";
			$Nkkm = isset($datanilai->kkm) ? ($datanilai->kkm) : "";

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";

			$row[] = "<span class='size'>  <span class='hide'>" . $Nkkm . "</span> <input type='text' class='form-control' 
				onchange='setNilai(`kkm`,`" . $dataDB->id . "`)' 
				name='kkm_" . $dataDB->id . "' onkeydown='return nomor(this, event)' value='" . $Nkkm . "' >
				</span>";

			/*	$row[] = "<span class='size'>  <span class='hide'>".$Ns."</span> <input type='text' class='form-control' 
				onchange='setNilai(`s`,`".$dataDB->id."`)' 
				name='s_".$dataDB->id."' onkeydown='return nomor(this, event)' value='".$Ns."' >
				</span>";*/
			$a = $b = $c = "";
			if ($Ns == "A") {
				$a = "selected";
			} elseif ($Ns == "B") {
				$b = "selected";
			} elseif ($Ns == "C") {
				$c = "selected";
			}
			$row[] = "<span class='size'>  <span class='hide'>" . $Ns . "</span> 
					<select class='form-control' name='s_" . $dataDB->id . "' 	onchange='setNilai(`s`,`" . $dataDB->id . "`)'>
					<option value=''> === pilih ===<option>
					<option $a value='A'> Sangat Baik <option>
					<option $b   value='B'> Baik <option>
					<option $c  value='C'> Cukup <option>
					</select>
					 
				</span>";


			$row[] = "<span class='size'>  <span class='hide'>" . $Np . "</span> <input type='text' class='form-control' 
				onchange='setNilai(`p`,`" . $dataDB->id . "`)' 
				name='p_" . $dataDB->id . "' onkeydown='return nomor(this, event)' value='" . $Np . "' >
				</span>";
			$row[] = "<span class='size'>  <span class='hide'>" . $Nk . "</span> <input type='text' class='form-control' 
				onchange='setNilai(`k`,`" . $dataDB->id . "`)' 
				name='k_" . $dataDB->id . "' onkeydown='return nomor(this, event)' value='" . $Nk . "' >
				</span>";





			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_siswa->count_non(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getDataSiswa_pkl()
	{
		$datamitra = $this->db->get_where("tr_mitra")->result();
		$ray[""] = "---- Pilih ----";
		foreach ($datamitra as $val) {
			$ray[$val->id] = $val->nama;
		}

		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		foreach ($list as $dataDB) {
			////
			$datamitra = $this->db->query("select * from tm_pkl_veto where id_siswa='" . $dataDB->id . "' and id_tahun='" . $tahun . "' and 
		  id_semester='" . $sms . "'  ")->row();
			$lama = isset($datamitra->lama) ? ($datamitra->lama) : "";
			$ket = isset($datamitra->ket) ? ($datamitra->ket) : "";
			$mitra = isset($datamitra->mitra) ? ($datamitra->mitra) : "";
			$lokasi = isset($datamitra->lokasi) ? ($datamitra->lokasi) : "";
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";






			$dataray = $ray;
			//	$row[]=form_dropdown("mitra_".$dataDB->id,$dataray,$id_mitra," class='form-control cursor' onchange='setNilai(`".strtolower($val->nama)."`,`".$dataDB->id."`)'  ");

			$row[] = "<span class='size'>  <span class='hide'>" . $mitra . "</span> <input type='text' class='form-control' 
				onchange='setNilai(`" . $dataDB->id . "`)' 
				name='mitra_" . $dataDB->id . "'   value='" . $mitra . "' >
				</span>";

			$row[] = "<span class='size'>  <span class='hide'>" . $lokasi . "</span> <input type='text' class='form-control' 
				onchange='setNilai(`" . $dataDB->id . "`)' 
				name='lokasi_" . $dataDB->id . "'   value='" . $lokasi . "' >
				</span>";

			$row[] = "<span class='size'>  <span class='hide'>" . $lama . "</span> <input type='text' class='form-control' 
				onchange='setNilai(`" . $dataDB->id . "`)' 
				name='lama_" . $dataDB->id . "' onkeydown='return nomor(this, event)' value='" . $lama . "' >
				</span>";

			$row[] = "<span class='size'>  <span class='hide'>" . $ket . "</span> <input type='text' class='form-control' 
				onchange='setNilai(`" . $dataDB->id . "`)' 
				name='ket_" . $dataDB->id . "'   value='" . $ket . "' >
				</span>";


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

	function getDataSiswa_catatan()
	{
		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		foreach ($list as $dataDB) {
			////

			$ket = $this->m_reff->goField("tm_catatan_walikelas", "ket", "where id_siswa='" . $dataDB->id . "' 
			and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' order by id desc");
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";

			$row[] = "<span class='size'>  <span class='hide'>" . $ket . "</span> <textarea type='text' name='nama" . $dataDB->id . "' class='form-control' 
				onchange='setNilai(`" . $dataDB->id . "`)'>" . $ket . "</textarea>
				</span>";


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
	function getDataSiswa_catatan_k()
	{
		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		foreach ($list as $dataDB) {
			////

			$ket = $this->m_reff->goField("tm_catatan_karakter", "ket", "where id_siswa='" . $dataDB->id . "' 
			and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' order by id desc");
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";

			$row[] = "<span class='size'>  <span class='hide'>" . $ket . "</span> <textarea type='text' name='nama" . $dataDB->id . "' class='form-control' 
				onchange='setNilai(`" . $dataDB->id . "`)'>" . $ket . "</textarea>
				</span>";


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
	function getDataSiswa_cetak()
	{
		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		foreach ($list as $dataDB) {
			////
			$cetak = "";
			$id_kelas_1 = $dataDB->id_kelas_1;
			$id_tahun_1 = $dataDB->id_tahun_1;
			$id_kelas_2 = $dataDB->id_kelas_2;
			$id_tahun_2 = $dataDB->id_tahun_2;
			$id_kelas_3 = $dataDB->id_kelas_3;
			$id_tahun_3 = $dataDB->id_tahun_3;
			if ($id_kelas_1) {
				$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_1 . "' and id_semester='1' ")->num_rows();
				if ($cek) {
					$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
		id=" . $dataDB->id . "&id_kelas=" . $id_kelas_1 . "&id_semester=1&id_tahun=" . $id_tahun_1 . "&id_tk=1&download=true' class='btn bg-light-green waves-effect '> 
		<i class='material-icons'>picture_as_pdf</i>   X - Ganjil</a>";
					$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_1 . "' and id_semester='2' ")->num_rows();
				}
				if ($cek) {
					$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
		id=" . $dataDB->id . "&id_kelas=" . $id_kelas_1 . "&id_semester=2&id_tahun=" . $id_tahun_1 . "&id_tk=1&download=true' class='btn bg-green waves-effect '> 
		<i class='material-icons'>picture_as_pdf</i>   X - Genap</a>";
				}
			}
			if ($id_kelas_2) {
				$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_2 . "' and id_semester='1' ")->num_rows();
				if ($cek) {
					$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
		id=" . $dataDB->id . "&id_kelas=" . $id_kelas_2 . "&id_semester=1&id_tahun=" . $id_tahun_2 . "&id_tk=2&download=true' class='btn bg-light-blue waves-effect '> 
		<i class='material-icons'>picture_as_pdf</i> XI - Ganjil </a>";
					$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_2 . "' and id_semester='2' ")->num_rows();
				}
				if ($cek) {
					$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
			id=" . $dataDB->id . "&id_kelas=" . $id_kelas_2 . "&id_semester=2&id_tahun=" . $id_tahun_2 . "&id_tk=2&download=true' class='btn bg-blue waves-effect '> 
			<i class='material-icons'>picture_as_pdf</i> XI - Genap</a>";
				}
			}
			if ($id_kelas_3) {
				$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_3 . "' and id_semester='1' ")->num_rows();
				if ($cek) {
					$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
		id=" . $dataDB->id . "&id_kelas=" . $id_kelas_3 . "&id_semester=1&id_tahun=" . $id_tahun_3 . "&id_tk=3&download=true' class='btn bg-orange waves-effect '> 
		<i class='material-icons'>picture_as_pdf</i> XII - Ganjil</a>";
				}
				$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_3 . "' and id_semester='2' ")->num_rows();
				if ($cek) {
					$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
			id=" . $dataDB->id . "&id_kelas=" . $id_kelas_3 . "&id_semester=2&id_tahun=" . $id_tahun_3 . "&id_tk=3&download=true' class='btn bg-deep-orange waves-effect '> 
			<i class='material-icons'>picture_as_pdf</i> XII - Genap</a>";
				}
			}


			$ket = $this->m_reff->goField("tm_catatan_walikelas", "ket", "where id_siswa='" . $dataDB->id . "' 
			and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' ");
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " (" . strtoupper($dataDB->jk) . ") </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";

			$row[] = "<span class='size'> " . $cetak . " </span>";


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

	function ranking()
	{



		$tahun_real = $this->m_reff->tahun_asli();
		$tahun_kini = $this->m_reff->tahun();
		if ($tahun_real == $tahun_kini) {
			$idkelas = $this->m_reff->goField("tm_kelas", "id", "where id_wali='" . $this->mdl->idu() . "'");
		} else {

			$getIdSiswa = $this->m_reff->goField("tm_catatan_walikelas", "id_siswa", "where _cid='" . $this->mdl->idu() . "' and id_tahun='" . $tahun_kini . "' order by RAND()  limit 1");
			$idkelas = $this->m_reff->getHisKelas($getIdSiswa);
			if (!isset($idkelas)) {
				echo "<h4>Data tidak tersedia</h4>";
				return false;
			}
		}




		$sms = $this->m_reff->semester();
		//	$idkelas=$this->m_reff->goField("tm_kelas","id","where id_wali='".$this->mdl->idu()."'");
		$tk = $this->m_reff->goField("v_kelas", "nama_tingkat", "where id='" . $idkelas . "'");
		$id_tk = $this->m_reff->goField("tm_kelas", "id_tk", "where id='" . $idkelas . "'");


		if ($this->m_reff->tahun_sts() == "true") {
			$dbsiswa = $this->db->query("select * from data_siswa where id_kelas='" . $idkelas . "' and id_sts_data in (1,4)")->result();
		} else {

			//   $id_tk=$this->m_reff->goField("tm_kelas","id_tk","where id='".$idkelas."' "); 
			$tahun = $this->m_reff->tahun();

			$dbsiswa = $this->db->query("select * from data_siswa where id_tahun_$id_tk=$tahun and id_kelas_$id_tk=$idkelas")->result();
		}





		foreach ($dbsiswa as $val) {
			//$this->mdl->updateNilaiMurni($val->id,$sms,$tk);
			$this->mdl->updateNilaiAkhir($val->id, $sms, $id_tk);
		}
		//$this->mdl->setRankingMurni($idkelas,$tk);
		$this->mdl->setRankingAkhir($idkelas, $id_tk);
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo $this->load->view("ranking");
		} else {
			$data['konten'] = "ranking";
			$this->_template($data);
		}
	}

	function getDataSiswa_ranking()
	{

		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$id_kelas = $this->input->post("id_kelas");
		$tk = $this->m_reff->goField("v_kelas", "nama_tingkat", "where id='" . $id_kelas . "'");
		if ($tk == "X") {
			$order = "rank_x2 ASC";
		} elseif ($tk == "XI") {
			$order = "rank_xi2 ASC";
		} elseif ($tk == "XII") {
			$order = "rank_xii2 ASC";
		}

		$list = $this->mdl_siswa->get_data($order);
		foreach ($list as $dataDB) {
			////

			$ket = $this->m_reff->goField("tm_catatan_walikelas", "ket", "where id_siswa='" . $dataDB->id . "' 
			and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' ");
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";
			if ($tk == "X") {
				$row[] = "<span class='size'>  " . $dataDB->x_2 . " </span>";
				$row[] = "<span class='size'> " . $dataDB->rank_x2 . " </span>";
			} elseif ($tk == "XI") {
				$row[] = "<span class='size'>  " . $dataDB->xi_2 . " </span>";
				$row[] = "<span class='size'> " . $dataDB->rank_xi2 . " </span>";
			} elseif ($tk == "XII") {
				$row[] = "<span class='size'>  " . $dataDB->xii_2 . " </span>";
				$row[] = "<span class='size'> " . $dataDB->rank_xii2 . " </span>";
			}




			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_siswa->count($order),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function detail_siswa()
	{
		$data["data"] = $this->db->get_where("v_siswa", array("id" => $this->input->post("id")))->row();
		echo $this->load->view("isi_detail_siswa", $data);
	}

	function getDataSiswa_ektra()
	{
		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		foreach ($list as $dataDB) {
			////


			$prestasi = "";
			/*
			$data_p=$this->db->query("select * from tm_ekstrakurikuler where id_semester='".$sms."' and id_tahun='".$tahun."' and id_siswa='".$dataDB->id."'  ")->result();
			foreach($data_p as $p)
			{
				$nama=$this->m_reff->goField("tr_ektrakurikuler","nama","where id='".$p->id_ektra."'");
				$ket=isset($p->ket)?($p->ket):"-";
				if(!$ket)
				{
					$ket="-";
				}
			 
              if($this->m_reff->tahun_sts()!="true"){
              	/*
				$prestasi.="<p style='border-bottom:black solid 1px'><b>
				<span class='col-blue'>[".$p->nilai."]</span> - ".$nama."</b><br>".$ket." <span class='col-orange pull-right'> 
				  </span> <p>";
              }else{
              	/*
                  	$prestasi.="<p style='border-bottom:black solid 1px'><b><span class='col-blue'>[".$p->nilai."]</span> - ".$nama."</b><br>".$ket." <span class='col-orange pull-right'>
				 <a class='cursor ' href='javascript:edit(`".$p->id."`,`".$dataDB->id."`,`".$p->id_ektra."`,`".$p->nilai."`,`".$p->ket."`)'>Edit</a> | <a class='cursor col-pink' href='javascript:hapus(`".$p->id."`,`".$nama."`)'>Hapus</a> 
				  </span> <p>";
              }
			}*/

			$tahun = $this->m_reff->tahun();
			$sms   = $this->m_reff->semester();

			$qanggota = $this->db->query("SELECT * FROM eskul_anggota WHERE j_siswa LIKE '%" . $dataDB->id . "%' AND  id_tahun='" . $tahun . "' AND id_semester='" . $sms . "' ");

			$nanggota = $qanggota->num_rows();
			if ($nanggota != 0) {
				$danggota = $qanggota->result();

				$leskul = "";
				foreach ($danggota as $vanggota) {
					$eskul = $this->m_reff->goField("tr_ektrakurikuler", "nama", " WHERE id='" . $vanggota->id_eskul . "' ");

					$nilai_eskul = $this->m_reff->goField("tm_ekstrakurikuler", "nilai", " WHERE id_siswa='" . $dataDB->id . "' AND id_ektra='" . $vanggota->id_eskul . "' AND id_tahun='" . $tahun . "' AND id_semester='" . $sms . "' ");

					$ket_eskul = $this->m_reff->goField("tm_ekstrakurikuler", "ket", " WHERE id_siswa='" . $dataDB->id . "' AND id_ektra='" . $vanggota->id_eskul . "' AND id_tahun='" . $tahun . "' AND id_semester='" . $sms . "' ");

					switch ($nilai_eskul) {
						case 'A':
							$label_nilai = "SANGAT BAIK";
							break;
						case 'B':
							$label_nilai = "BAIK";
							break;
						case 'C':
							$label_nilai = "CUKUP";
							break;
						case 'D':
							$label_nilai = "KURANG";
							break;


						default:
							$label_nilai = "Unknown";
							break;
					}

					$leskul .= "
						<div class='badge bg-teal' style='text-align:left;width:150px;word-wrap: break-word;white-space: normal;'>
							<center><span style='font-size:17px'>" . $eskul . "</span></center><br>
							Nilai : " . $label_nilai . "<br>
							Ket   : " . $ket_eskul . "
						</div>
					";
				}
			} else {
				$leskul = "";
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";

			$row[] = "<span class='size'> " . $leskul . " </span>";



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



	function add_prestasi()
	{
		echo $this->mdl->add_prestasi();
	}

	function edit_prestasi()
	{
		echo $this->mdl->edit_prestasi();
	}

	function hapus_prestasi()
	{
		echo $this->mdl->hapus_prestasi();
	}
	function add_ekstra()
	{
		echo $this->mdl->add_ekstra();
	}

	function edit_ekstra()
	{
		echo $this->mdl->edit_ekstra();
	}

	function hapus_ekstra()
	{
		echo $this->mdl->hapus_ekstra();
	}
	function update_kh()
	{
		echo $this->mdl->update_kh();
	}
	function update_dpk()
	{
		echo $this->mdl->update_dpk();
	}
	function update_non()
	{
		echo $this->mdl_siswa->update_non();
	}
	function update_pkl()
	{
		echo $this->mdl->update_pkl();
	}
	function update_pkl_veto()
	{
		echo $this->mdl->update_pkl_veto();
	}
	function update_catatan()
	{
		echo $this->mdl->update_catatan();
	}
	function update_catatan_k()
	{
		echo $this->mdl->update_catatan_k();
	}
	function cetak()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("cetak");
		} else {
			$data['konten'] = "cetak";
			$this->_template($data);
		}
	}
	function cetak_raport()
	{


		ob_start();
		//	$isi=$this->load->view('raport');
		$isi = $this->load->view('raport_2018');
		// return false;
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			//  $html2pdf = new HTML2PDF('L',array("210","310"), 'en', true, '', array(8,10, 10, 5));
			//$html2pdf = new HTML2PDF('P',array("210","297"), 'en', true, '', array(10,10, 10, 10));
			$html2pdf = new HTML2PDF('P', array("215", "330"), 'en', true, '', array(10, 20, 10, 10));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('Raport.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}

		//$this->load->view('raport_2018');
	}
	function download_legger()
	{
		$id_kelas = $this->input->get("kelas");
		$data["id_kelas"] = $id_kelas;
		ob_start();
		$isi = $this->load->view('cetak_legger', $data);
		return false;
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('L', array("210", "330"), 'en', true, '', array(5, 5, 5, 10));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('Legger.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}

	function getDataNilai()
	{
		$id_mapel_ajar = $this->input->post("id_mapel_ajar");
		$idkelas = $this->input->post("id_kelas");
		$id_mapel = $this->input->post("id_mapel");
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$mapel = $this->db->query("select * from v_mapel_ajar where id_kelas='" . $idkelas . "'
		and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' group by id_mapel");

		$list = $this->mdl->getDataNilai();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$datax = $this->db->get_where("tm_kikd", array("id_tahun" => $this->m_reff->tahun(), "id_semester" => $this->m_reff->semester(), "id_mapel_ajar" => $id_mapel_ajar));
		foreach ($list as $val) {
			$row = array();
			$agama = $val->id_agama;
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $val->nisn . "</span>";
			$row[] = "<span class='size'>" . $val->nama . "</span>";

			$row[] = "<span class='size'>" . strtoupper($val->jk) . "</span>";
			$jumlahMapel = $nilaiSikap = $nilaiKeterampilan = $nilaiPengetahuan = 0;
			foreach ($mapel->result() as $value) {
				if ($value->mapel_global == 2 and $agama > 1) {
					if ($value->k_mapel == "A") {
						$jumlahMapel++;
						$row[] = "<i class='col-indigo' title='non-muslim'><b>" . $ns = $this->mdl->getNsNonMuslim($val->id) . "</b></i>";
						$row[] = "<i class='col-indigo' title='non-muslim'><b>" . $n2 = $this->mdl->getNpNonMuslim($val->id) . "</b></i>";
						$row[] = "<i class='col-indigo' title='non-muslim'><b>" . $n3 = $this->mdl->getNkNonMuslim($val->id) . "</b></i>";
						$nilaiSikap = $ns + $nilaiSikap;
						$nilaiPengetahuan = $n2 + $nilaiPengetahuan;
						$nilaiKeterampilan = $n3 + $nilaiKeterampilan;
					} else {
						$row[] = "<i class='col-pink'>non</i>";
						$row[] = "<i class='col-pink'>non</i>";
						$row[] = "<i class='col-pink'>non</i>";
					}
				} else {

					$jumlahMapel++;
					$n2 = $this->mdl->getNilaiRataPengetahuanLegger($val->id, $value->id_mapel, $sms, $value->id_guru);
					$n3 = $this->mdl->getNilaiRataKeterampilanLegger($val->id, $value->id_mapel, $sms, $value->id_guru); //harusnya ambil max
					$nKBPengetahuan = $this->mdl->getNilaiKBPengetahuan($value->id_mapel, $value->id_guru, $idkelas);
					$nKBKeterampilan = $this->mdl->getNilaiKBKeterampilan($value->id_mapel, $value->id_guru, $idkelas);
					if ($nKBPengetahuan > $n2) {
						$class = "col-pink font-bold";
					} else {
						$class = "";
					}

					if ($nKBKeterampilan > $n3) {
						$class2 = "col-pink font-bold";
					} else {
						$class2 = "";
					}
					$ns = $this->mdl->getNilaiRataSikap($val->id, $value->id_mapel, $sms, $value->id_guru);
					$row[] = "<span class='size'>" . $ns . "</span>";
					$row[] = "<div data-placement='top' data-original-title='jujur' data-toggle='tooltip'
										class='size " . $class . "' title='" . $nKBPengetahuan . "' > " . $n2 . "</div>";
					$row[] = "<span class='size " . $class2 . "' title='" . $nKBKeterampilan . "' >" . $n3 . "</span>";
					$nilaiSikap = 0; //$ns+$nilaiSikap;// kalkulasi tapi ga dipake soalnya udah jadi huruf
					$nilaiPengetahuan = $n2 + $nilaiPengetahuan;
					$nilaiKeterampilan = $n3 + $nilaiKeterampilan;
				}
			}
			$eskul = $this->mdl->getNilaiEskul($val->id, $sms);
			$nilaipeng = $this->mdl->NilaiMinKehadiran($val->id, $sms);
			$jumlah = (($nilaiPengetahuan + $nilaiKeterampilan) / 2);
			$ok = ($jumlah / $jumlahMapel);
			$row[] = "<span class='size'>" .
				//$this->mdl->getNilaiRataRataLegger($val->id,$sms)
				number_format($ok, 2)
				. "</span>";
			$row[] = "<span class='size'>" .
				//$this->mdl->getNilaiAkhirLegger($val->id,$sms)
				number_format(($ok + $eskul) - $nilaipeng, 2)
				. "</span>";
			$row[] = "<span class='size'>" . $eskul . "</span>";
			$row[] = "<span class='size'>" . $this->mdl->getJmlKehadiran($val->id, $sms, 2) . "</span>";
			$row[] = "<span class='size'>" . $this->mdl->getJmlKehadiran($val->id, $sms, 3) . "</span>";
			$row[] = "<span class='size'>" . $this->mdl->getJmlKehadiran($val->id, $sms, 4) . "</span>";
			$row[] = "<span class='size'>" . $nilaipeng . "</span>";




			//	$row[] = "<span class='size'>".$this->mdl->getNilaiRataKi($dataDB->id,$idkelas,$id_mapel,$sms)."</span>";	
			//	$row[] = "<span class='size'>".$this->mdl->getNilaiUT($dataDB->id,$idkelas,$id_mapel,$sms)."</span>";	
			//	$row[] = "<span class='size'>".$this->mdl->getNilaiUA($dataDB->id,$idkelas,$id_mapel,$sms)."</span>";	

			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_getDataNIlai(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function isi_catatan_akademik()
	{
		$tahun_real = $this->m_reff->tahun_asli();
		$tahun_kini = $this->m_reff->tahun();
		if ($tahun_real != $tahun_kini) {
			return false;
		}

		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();

		$idkelas = $this->input->get_post("id_kelas");
		$dt = $this->db->query("select * from data_siswa where id_kelas='" . $idkelas . "' ")->result();
		foreach ($dt as $val) {
			$cek = $this->db->query("select * from tm_catatan_walikelas where id_tahun='$tahun' and id_semester='$sms' and id_siswa='$val->id' ")->num_rows();
			if (!$cek) {
				$this->db->set("id_siswa", $val->id);
				$this->db->set("id_semester", $sms);
				$this->db->set("id_tahun", $tahun);
				$this->db->set("_cid", $this->mdl->idu());
				$this->db->set("ket", "Ananda sudah kompeten dipengetahuan dan keterampilan dengan sampurna.");
				$this->db->insert("tm_catatan_walikelas");
			}
		}
	}
	function isi_catatan_karakter()
	{
		$tahun_real = $this->m_reff->tahun_asli();
		$tahun_kini = $this->m_reff->tahun();
		if ($tahun_real != $tahun_kini) {
			return false;
		}

		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();

		$idkelas = $this->input->get_post("id_kelas");
		$dt = $this->db->query("select * from data_siswa where id_kelas='" . $idkelas . "' ")->result();
		foreach ($dt as $val) {
			$cek = $this->db->query("select * from tm_catatan_karakter where id_tahun='$tahun' and id_semester='$sms' and id_siswa='$val->id' ")->num_rows();
			if (!$cek) {
				$this->db->set("id_siswa", $val->id);
				$this->db->set("id_semester", $sms);
				$this->db->set("id_tahun", $tahun);
				$this->db->set("_cid", $this->mdl->idu());
				$this->db->set("ket", "Ananda menunjukan perkembangan karakter yang baik pada pembelajaran semester ini.");
				$this->db->insert("tm_catatan_karakter");
			}
		}
	}
	function isi_dpk()
	{
		$tahun_real = $this->m_reff->tahun_asli();
		$tahun_kini = $this->m_reff->tahun();
		if ($tahun_real != $tahun_kini) {
			return false;
		}

		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();

		$idkelas = $this->input->get_post("id_kelas");
		$dt = $this->db->query("select * from data_siswa where id_kelas='" . $idkelas . "' ")->result();
		foreach ($dt as $val) {
			$cek = $this->db->query("select * from tm_desc_karakter where id_tahun='$tahun' and id_semester='$sms' and id_siswa='$val->id' ")->num_rows();
			if (!$cek) {
				$this->db->set("id_siswa", $val->id);
				$this->db->set("id_semester", $sms);
				$this->db->set("id_tahun", $tahun);
				$this->db->set("_cid", $this->mdl->idu());
				$this->db->set("desc1", "Ananda menunjukkan sikap integritas dengan baik.");
				$this->db->set("desc2", "Ananda menunjukkan sikap religius dengan baik.");
				$this->db->set("desc3", "Ananda menunjukkan sikap nasionalis dengan baik.");
				$this->db->set("desc5", "Ananda menunjukkan sikap gotong royong dengan baik.");
				$this->db->set("desc4", "Ananda menunjukkan sikap mandiri dengan baik.");
				$this->db->insert("tm_desc_karakter");
			}
		}
	}
}
