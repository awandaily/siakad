<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_pendidik extends CI_Controller
{


	var $tbl = "v_pegawai";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("model", "mdl");
		$this->load->model("model_absen", "mdl_absen");
		$this->load->model("model_pendidik", "mdl_pendidik");
		$this->load->model("model_siswa", "mdl_siswa");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{

		$this->pendidik();
	}
	public function rpp()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {

			echo	$this->load->view("rpp");
		} else {
			$data['konten'] = "rpp";
			$this->_template($data);
		}
	}




	public function pendidik()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			// 	echo "<script> window.location.href='pendidik';</script>";
			echo	$this->load->view("pendidik");
		} else {
			$data['konten'] = "pendidik";
			$this->_template($data);
		}
	}

	function penjadwalan()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {

			echo	$this->load->view("penjadwalan");
		} else {
			$data['konten'] = "penjadwalan";
			$this->_template($data);
		}
	}

	function getKelasJadwal()
	{
		$data["id_kelas"] = $this->input->post("kelas");
		$data["id_hari"] = $this->input->post("hari");
		if ($this->input->post("kelas")) {
			echo $this->load->view("getKelas", $data);
		} else {
			echo $this->load->view("getJadwal", $data);
		}
	}

	function jml_jam_masuk($idguru)
	{
		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$r = $this->db->query("SELECT sum(jml_jam_valid) as jml from tm_absen_guru where id_guru='" . $idguru . "' and id_tahun='" . $tahun . "' and id_semester='" . $sms . "'  ")->row();
		return isset($r->jml) ? ($r->jml) : "";
	}
	function jml_tidak_masuk($idguru)
	{
		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$r = $this->db->query("SELECT sum(jml_jam_blok) as jml from tm_absen_guru where id_guru='" . $idguru . "' and id_tahun='" . $tahun . "' and id_semester='" . $sms . "'  ")->row();
		return isset($r->jml) ? ($r->jml) : "";
	}
	function jml_kelas_mengajar($idguru)
	{
		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$r = $this->db->query("SELECT* from tm_mapel_ajar where id_guru='" . $idguru . "' and id_tahun='" . $tahun . "' and id_semester='" . $sms . "'   ")->num_rows();
		return $r;
	}

	function data()
	{
		$list = $this->mdl_pendidik->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$jml_jam_masuk = $dataDB->jam_valid;
			$jml_tidak_masuk = $dataDB->jam_blok;
			$jml_kelas_mengajar = $this->jml_kelas_mengajar($dataDB->id);




			$row = array();
			$row[] = "<span class='size linehover'  >" . $no++ . "</span>";


			$row[] = "<a href='javascript:void(0)' class='size linehover'  onclick='detail(`" . $dataDB->id . "`,`" . $dataDB->nama_lengkap . "`)' >  " . $dataDB->nama_lengkap . " </a>";
			$row[] = "<span class='size' >  " . strtoupper($dataDB->jk) . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->jabatan . " </span>";
			$row[] = "<span class='size' >  " . $this->tanggal->ind($dataDB->tmt, "/") . " </span>";

			$row[] = "<span class='size' >  " . $dataDB->pangkat . " </span>";

			$row[] = "<span class='size' >  " . $dataDB->nip . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->nuptk . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->hp . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->email . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->alamat . " </span>";
			$row[] = "<span class='size' >  " . $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . " </span>";
			$row[] = "<span class='size' >  " . $this->mdl_pendidik->getDataMapel($dataDB->id_mapel) . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->tempat_lahir . " </span>";
			$row[] = "<span class='size' >  " . $this->tanggal->ind($dataDB->tgl_lahir, "/") . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->ijazah . " </span>";
			$row[] = "<span class='size' >  " . $dataDB->sts_pegawai . " </span>";
			$row[] = $jml_jam_masuk;
			$row[] = "<a href='javascript:void(0)' class='size' onclick='tdk_masuk(`" . $dataDB->id . "`,`" . $dataDB->nama_lengkap . "`)'><b>  " . $jml_tidak_masuk . "</b></a>";
			$row[] = "<a href='javascript:void(0)' class='size' onclick='kelas(`" . $dataDB->id . "`,`" . $dataDB->nama_lengkap . "`)'><b>  " . $jml_kelas_mengajar . "</b></a>";
			$row[] = "<a href='javascript:void(0)' class='size' onclick='kelas(`" . $dataDB->id . "`,`" . $dataDB->nama_lengkap . "`)'><b>  " . $jmlJamKeseluruhan = $this->m_guru->totalJamMengajar($dataDB->id) . "</b></a>";



			// $jmlJamValid=$this->m_guru->jmlJamValid($dataDB->id);

			$persentase = $this->m_reff->persentase($jml_jam_masuk, $jmlJamKeseluruhan);



			$row[] = "<a href='javascript:void(0)' class='size' onclick='persentase(`" . $dataDB->id . "`,`" . $dataDB->nama_lengkap . "`)'><b>  " . $persentase . " %</b></a>";

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

	function setRPP()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("sts", $this->input->post("val"));
		echo	 $this->db->update("tm_mapel_ajar");
	}

	function data_rpp()
	{
		$list = $this->mdl_pendidik->get_data_rpp();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$dataray = "";
			$dataray[0] = "Belum dicek";
			$dataray[1] = "RPP Valid";
			$dataray[2] = "RPP Tidak Valid";
			$ray = $dataray;
			$tandai = form_dropdown("tandai" . $dataDB->id . "", $ray, $dataDB->sts, "class='form-control' onchange='rpp(`" . $dataDB->id . "`)' ");

			if ($dataDB->sts == 1) {
				$bg = "bg-teal";
			} elseif ($dataDB->sts == 2) {
				$bg = "bg-red";
			} else {
				$bg = "bg-blue-grey";
			}

			$dbq = $this->db->query("select rpp from v_mapel_ajar where id_guru='" . $dataDB->id_guru . "' and id_mapel='" . $dataDB->id_mapel . "' and id_tk='" . $dataDB->id_tk . "' and rpp is not null  order by id desc ")->row();

			if (isset($dbq->rpp)) {
				$nama_rpp = "<a class='btn btn-block waves-effect " . $bg . "' href='" . base_url() . "file_upload/guru/" .
					$this->m_reff->goField("data_pegawai", "nip", "where id='" . $dataDB->id_guru . "'") . "/" . $dbq->rpp . "' targt='_blank' download>Download </a>";
				//$nama_rpp=$nama_rpp.$tandai;
			} else {
				$nama_rpp = "<i>belum upload</i>";
				$tandai = "";
			}
			$row = array();

			$row[] = "<span class='size linehover'  >" . $no++ . "</span>";
			$row[] = "<span class='size linehover'  > " . $nama_rpp;
			$row[] = "<span class='size linehover'  > " . $tandai;

			$row[] = "<span class='size linehover'  >" . $dataDB->mapel . "</span>";
			$row[] = "<span class='size linehover'  >" . $dataDB->nama_tingkat . "</span>";
			$row[] = "<span class='size linehover'  >" . $this->m_reff->nama_guru($dataDB->id_guru) . "</span>";




			// $jmlJamValid=$this->m_guru->jmlJamValid($dataDB->id);

			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_pendidik->count_rpp(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}





	//-------------------------------------------------END SISWA------------------------------------//
	function idu()
	{
		return $this->session->userdata("id");
	}
	function detail_pendidik()
	{
		$id = $this->input->post("id");
		$this->db->where("id", $id);
		$data["data"] = $this->db->get($this->tbl)->row();
		echo $this->load->view("detail_pendidik", $data);
	}
	function hapus_pendidik()
	{
		echo $this->mdl_pendidik->hapus_pendidik();
	}
	function hapus_siswa()
	{
		echo $this->mdl_siswa->hapus_siswa();
	}
	function aktifasi_pendidik()
	{
		echo $this->mdl_pendidik->aktifasi_pendidik();
	}

	function getKelas()
	{
		$idtk = $this->input->post("id");
		$idjurusan = $this->input->post("jur");
		$value = $this->input->post("val");

		$this->db->where("id_tk", $idtk);
		$this->db->where("id_jurusan", $idjurusan);
		$sts = $this->db->get("tm_kelas")->result();
		$ray = "";
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $val->nama;
		}
		echo form_dropdown("f[id_kelas]", $ray, $value, 'required class="form-control col-md-12 show-tick" ');
		echo "<script>$('select').selectpicker();</script>";
	}

	function cekKelas()
	{
		echo $this->load->view("cekKelas");
	}
	function cekTidakMasuk()
	{
		echo $this->load->view("cekTidakMasuk");
	}
	function persentase()
	{
		echo $this->load->view("persentase");
	}
}
