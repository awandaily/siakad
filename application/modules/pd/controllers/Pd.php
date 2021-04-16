<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pd extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session("PIKET");
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}
	function load()
	{
		echo $this->load->view("load");
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
	public function toTglSys($v)
	{
		$tgl = substr($v, 0, 2);
		$bln = substr($v, 3, 2);
		$thn = substr($v, 6, 4);

		return $thn . "-" . $bln . "-" . $tgl;
	}

	public function guru_izin()
	{
		$index = "guru_izin";
		$ajax = $this->input->get_post("ajax");
		$this->db->order_by("nama", "asc");
		$qpeg = $this->db->get("data_pegawai")->result();

		if ($ajax == "yes") {


			$data["pegawai"]	= $qpeg;
			echo	$this->load->view($index, $data);
		} else {
			$data['konten'] = $index;
			$data["pegawai"]	= $qpeg;
			$this->_template($data);
		}
	}
	public function insert_guru_izin()
	{

		$p 		= $this->input->post("f");
		unset($p['id_guru']);
		$guru   = $this->input->post("guru[]");
		$start 	= $this->toTglSys($this->input->post("start"));
		$end 	= $this->toTglSys($this->input->post("end"));

		foreach ($guru as $guru) {

			$this->db->set("end", $end);
			$this->db->set("start", $start);
			$this->db->set("id_guru", $guru);
			$this->db->set("id_petugas", $this->mdl->idu());
			$data = $this->db->insert("tm_guru_izin", $p);
		}

		echo json_encode($data);
	}
	public function kelas()
	{
		$index = "kelas";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	function cekAbsen()
	{
		echo	$this->load->view("cekAbsenDetail");
	}
	function profile()
	{
		$index = "profile";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	function nonaktif()
	{
		$index = "nonaktif";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	function simpan_akun()
	{
		$data = $this->mdl->simpan_akun();
		echo json_encode($data);
	}
	function blok()
	{
		$id_guru = $this->input->post("id_guru");
		$id_kelas = $this->input->post("id_kelas");
		$id_jam = $this->input->post("id_jam");
		$id_jadwal = $this->input->post("id_jadwal");
		$jam_blok = $this->input->post("jam_blok");
		$jam_blok = "," . $jam_blok . ",";
		$this->db->where("id_guru", $id_guru);
		$this->db->where("id_kelas", $id_kelas);

		$tglz = $this->input->post("tgl");
		if (!$tglz) {
			$tglz = date('Y-m-d');
		}

		$this->db->where("id_jadwal", $id_jadwal);
		$this->db->where("SUBSTR(tgl,1,10)", $tglz);

		$data_jam = $this->db->query("select * from tm_absen_guru where id_guru='" . $id_guru . "' and id_kelas='" . $id_kelas . "' 
		and id_jadwal='" . $id_jadwal . "' and SUBSTR(tgl,1,10)='" . $tglz . "'  ")->row();

		$jam_blok_ = isset($data_jam->jam_blok) ? ($data_jam->jam_blok) : "";
		$jam_range = isset($data_jam->jam) ? ($data_jam->jam) : "";
		$jam = $jam_blok_ . $jam_blok;
		$jam = str_replace(",,", ",", $jam);
		$jam = str_replace(",,", ",", $jam);


		$jam_blok = implode(',', array_unique(explode(',', $jam))) . ",";
		$this->db->set("jam_blok", $jam_blok);

		$jml_jam_valid = $this->m_reff->jamValid($jam_range, $jam);
		$this->db->set("jml_jam_valid", $jml_jam_valid);

		$jml_jam_blok = $this->m_reff->jamBlok($jam);
		$this->db->set("jml_jam_blok", $jml_jam_blok);
		//	 $this->db->set("sumber",4);
		echo $this->db->update("tm_absen_guru");
	}
	function blok_inval()
	{
		$id_guru = $this->input->post("id_guru");
		$id_kelas = $this->input->post("id_kelas");
		$id_jam = $this->input->post("id_jam");
		$id_jadwal = $this->input->post("id_jadwal");
		$jam_blok = $this->input->post("jam_blok");
		$jam_blok = "," . $jam_blok . ",";

		$tglz = $this->input->post("tgl");
		if (!$tglz) {
			$tglz = date('Y-m-d');
		}
		$data_jam = $this->db->query("select * from tm_inval where  id_jadwal='" . $id_jadwal . "' and tgl='" . $tglz . "' and jam LIKE '%" . $jam_blok . "%'  ")->row();

		$jam_blok_ = isset($data_jam->jam_invalid) ? ($data_jam->jam_invalid) : "";
		$jam_range = isset($data_jam->jam) ? ($data_jam->jam) : "";
		$jam_valid = isset($data_jam->jam_valid) ? ($data_jam->jam_valid) : "";
		$jam = $jam_blok_ . $jam_blok;
		$jam = str_replace(",,", ",", $jam);
		$jam = str_replace(",,", ",", $jam);
		$this->db->set("jam_invalid", $jam);

		$jml_jam_valid = $this->m_reff->jamValid($jam_range, $jam);
		$this->db->set("jml_jam", $jml_jam_valid);
		$jam_valid = str_replace($jam_blok, ",", $jam_valid);
		$jam_valid = str_replace(",,", ",", $jam_valid);
		$jam_valid = str_replace(",,", ",", $jam_valid);
		if ($jam_valid == ",") {
			$jam_valid = null;
		}

		$jml_jam_blok = count($this->m_reff->clearkomaray($jam));
		$this->db->set("jml_jam_blok", $jml_jam_blok);

		$this->db->set("jam_valid", $jam_valid);

		$this->db->where("id", $data_jam->id);
		echo $this->db->update("tm_inval");
	}

	function unbloking_inval()
	{
		$id_guru = $this->input->post("id_guru");
		$id_kelas = $this->input->post("id_kelas");
		$id_jam = $this->input->post("id_jam");
		$id_jadwal = $this->input->post("id_jadwal");
		$jam_blok = $this->input->post("jam_blok");
		$jam_blok = "," . $jam_blok . ",";

		$tglz = $this->input->post("tgl");
		if (!$tglz) {
			$tglz = date('Y-m-d');
		}
		$data_jam = $this->db->query("select * from tm_inval where  id_jadwal='" . $id_jadwal . "' and tgl='" . $tglz . "' and jam LIKE '%" . $jam_blok . "%' ")->row();

		$jam_blok_ = isset($data_jam->jam_invalid) ? ($data_jam->jam_invalid) : "";
		$jam_range = isset($data_jam->jam) ? ($data_jam->jam) : "";
		$jam_valid = isset($data_jam->jam_valid) ? ($data_jam->jam_valid) : "";
		$jam = str_replace($jam_blok, ",", $jam_blok_);
		$jam = str_replace(",,", ",", $jam);
		$jam = str_replace(",,", ",", $jam);
		if ($jam == ",") {
			$jam = null;
			$jml_jam_blok = "0";
		} else {
			$jml_jam_blok = count($this->m_reff->clearkomaray($jam));
		}
		$this->db->set("jam_invalid", $jam);

		$this->db->set("jml_jam_blok", $jml_jam_blok);


		//$jam_valid=str_replace($jam,",",$jam_valid);
		$jam_valid = $jam_valid . $jam_blok;
		$jam_valid = str_replace(",,", ",", $jam_valid);
		$jam_valid = str_replace(",,", ",", $jam_valid);
		$this->db->set("jam_valid", $jam_valid);

		$jml_jam_valid = count($this->m_reff->clearkomaray($jam_valid));
		$this->db->set("jml_jam", $jml_jam_valid);

		$this->db->where("id", $data_jam->id);
		echo $this->db->update("tm_inval");
	}

	function unblok()
	{
		$id_guru = $this->input->post("id_guru");
		$id_kelas = $this->input->post("id_kelas");
		$id_jam = $this->input->post("id_jam");
		$jam_blok = $this->input->post("jam_blok");
		$id_jadwal = $this->input->post("id_jadwal");

		$tglz = $this->input->post("tgl");

		if (!$tglz) {
			$tglz = date('Y-m-d');
		}
		$jam = "," . $jam_blok . ",";
		$this->db->where("id_guru", $id_guru);
		$this->db->where("id_kelas", $id_kelas);

		$this->db->where("id_jadwal", $id_jadwal);
		$this->db->where("SUBSTR(tgl,1,10)", $tglz);
		$data = $this->db->query("select * from tm_absen_guru where id_guru='" . $id_guru . "' and id_kelas='" . $id_kelas . "' 
		and id_jadwal='" . $id_jadwal . "' and SUBSTR(tgl,1,10)='" . $tglz . "'  ")->row();
		$jam_blok_db = isset($data->jam_blok) ? ($data->jam_blok) : "";
		$jam = str_replace($jam, ",", $jam_blok_db);
		if ($jam == ",") {
			$jam = "";
		}
		$this->db->set("jam_blok", $jam);

		$jam_range = isset($data->jam) ? ($data->jam) : "";
		$jml_jam_valid = $this->m_reff->jamValid($jam_range, $jam);
		$this->db->set("jml_jam_valid", $jml_jam_valid);

		$jml_jam_blok = $this->m_reff->jamBlok($jam);
		$this->db->set("jml_jam_blok", $jml_jam_blok);


		echo $this->db->update("tm_absen_guru");
	}
	function absenkan()
	{
		$tahun = $this->m_reff->tahun();
		$semester = $this->m_reff->semester();
		$id_guru = $this->input->post("id_guru");
		$id_kelas = $this->input->post("id_kelas");
		$mapel = $this->input->post("mapel");
		$id_jam = $this->input->post("id_jam");
		$id_jadwal = $this->input->post("id_jadwal");
		$jam_blok = "," . $this->input->post("jam_blok") . ",";
		$tglz = $this->input->post("tgl");
		if (!$tglz) {
			$tglz = date('Y-m-d');
		}
		$tgl = $tglz . " " . date("H:i:s");
		$hari = date('N', strtotime($tglz));
		$this->db->set("tgl", $tgl);
		$this->db->set("jam", $id_jam);
		//$this->db->set("jam_blok",$id_jam);
		//	$this->db->set("jam_blok",$jam_blok);
		$this->db->set("id_tahun", $tahun);
		$this->db->set("id_mapel", $mapel);
		$this->db->set("id_semester", $semester);
		$this->db->set("id_guru", $id_guru);
		$this->db->set("id_hari", $hari);
		$this->db->set("id_kelas", $id_kelas);
		$this->db->set("id_jadwal", $id_jadwal);
		$this->db->set("sumber", 1);
		$jml_jam_valid = $this->m_reff->jamValid($id_jam, "");
		$this->db->set("jml_jam_valid", $jml_jam_valid);

		//$jml_jam_blok=$this->m_reff->jamBlok($jam);
		//$this->db->set("jml_jam_blok",$jml_jam_blok);


		echo	$this->db->insert("tm_absen_guru");
	}
	function getKelas()
	{
		$data["id_kelas"] = $this->input->post("kelas");
		$data["tgl"] = $this->input->post("tgl");
		echo $this->load->view("getKelas", $data);
	}
	function dataKelas()
	{
		echo $this->load->view("dataKelas");
	}
	///-----------------------CATATAN PENILIAAN--------------------------///
	function getDatakelas()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////

			$row = array();
			$row[] =  '
			 <input type="checkbox" id="md_checkbox_' . $dataDB->id . '"   class="pilih filled-in chk-col-red" onclick="pilcek()"  name="kelas[]"  value="' . $dataDB->id . '" />
                                <label for="md_checkbox_' . $dataDB->id . '">&nbsp;</label> ';


			$row[] = "<span class='size'>" . $dataDB->nama . "</span>";
			$row[] = "<span class='size'> </span>";


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

	function data_guru_izin()
	{
		$list = $this->mdl->get_data_guru_izin();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {

			$row = array();
			$row[] = "<span class='size'><center>" . $no++ . "</center></span>";
			$row[] = "<span class='size'><center>" . date("d/m/Y", strtotime($dataDB->_ctime)) . "</center></span>";
			$row[] = "<span class='size'>" . $nama = $this->m_reff->goField("data_pegawai", "nama", " WHERE id='" . $dataDB->id_guru . "' ") . "</span>";
			$row[] = "<span class='size'><center>" . date("d/m/Y", strtotime($dataDB->start)) . "</center></span>";
			$row[] = "<span class='size'><center>" . date("d/m/Y", strtotime($dataDB->end)) . "</center></span>";
			$row[] = "<span class='size'>" . $dataDB->ket . "</span>";
			$row[] = "<span class='size'><button class='btn waves-effect bg-pink btn-sx' onclick='hapus_izin(`" . $dataDB->id . "`,`" . $nama . "`)'>Hapus</button></span>";


			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_guru_izin(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getDataguru()
	{
		$tgl = $this->input->post("tgl");
		$tanggal = $this->tanggal->eng_($tgl, "-");
		$list = $this->mdl->get_dataguru();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$nip = $this->m_reff->goField("data_pegawai", "nip", "where id='" . $dataDB->id_guru . "'");
			$row = array();
			//		$row[] =  '	 <input   type="checkbox" id="md_checkbox_'.$dataDB->id_guru.'"   class="pilih filled-in chk-col-red" onclick="pilcek()"  name="kelas[]"  value="'.$dataDB->id_guru.'" />  <label for="md_checkbox_'.$dataDB->id_guru.'">&nbsp;</label> ';


			$row[] = "<span class='size'>" . $dataDB->gelar_depan . " " . $dataDB->nama . " " . $dataDB->gelar_belakang . "</span>";
			$row[] = "<span class='size cursor' onclick='fingerkan(`" . $nip . "`)'> " . $this->mdl->cekabsenguru($dataDB->id_guru, $tanggal) . "</span>";


			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_guru(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function setNonAktif()
	{
		$ket = $this->input->get("ket");
		$jamof = $this->input->get("jamof");
		$tgl = $this->input->get("tgl");
		echo $this->mdl->setNonAktif($ket, $jamof, $tgl);
	}
	function batalkan()
	{
		echo $this->mdl->batalkan();
	}
	function fingerkan()
	{
		$noid = $this->input->get("noid");
		$data = array(
			"noid" => $noid,
			"tgl" => date('Y-m-d H:i:s'),
		);
		echo $this->db->insert("tm_log_kehadiran", $data);
	}
	function insertInval()
	{
		echo $this->mdl->insertInval();
	}
	function hapus_izin()
	{
		$id = $this->input->get_post("id");
		echo $this->mdl->hapus_izin($id);
	}
}
