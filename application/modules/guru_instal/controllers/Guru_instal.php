<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Guru_instal extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("guru", "kepsek"));
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
		$this->session->unset_userdata("tahun_id");
		$this->session->unset_userdata("sms_id");
	}

	function _template($data)
	{
		$this->load->view('temp_instal/main', $data);
	}

	public function index()
	{
		$nip = $this->m_reff->goField("data_pegawai", "nip", "where id='" . $this->mdl->idu() . "' ");
		$path = "file_upload/guru";
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		$path = "file_upload/guru/" . $nip;
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		/*$cek=$this->mdl->cekInstal();
		if($cek)
		{
			redirect("jadwal");
		}*/

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}

	public function pilih_mapel()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("mapel");
		} else {
			$data['konten'] = "mapel";
			$this->_template($data);
		}
	}

	function kelas()
	{
		$tbl = "v_mapel_ajar";
		$list = $this->mdl->get_open($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sts = 0; //$this->mdl->cektahap(1);
		foreach ($list as $dataDB) {
			////
			$ceklis = $dataDB->rpp;
			if ($ceklis) {
				$color = "bg-pink";
				$titlerpp = "Download RPP";
				$aksi = base_url() . 'file_upload/guru/' . $this->mdl->nip() . '/' . $dataDB->rpp;
			} else {
				$color = "bg-blue-grey";
				$titlerpp = "+ Upload RPP";
				$aksi = 'javascript:edit(`' . $dataDB->id . '`,`' . $dataDB->id_kelas . '`,`' . $dataDB->id_mapel . '`,`' . $dataDB->jml_jam . '`,`' . $dataDB->total_jam . '`)';
			}

			$cekmateri = $this->db->get_where("tm_bahan_ajar", array("id_mapel" => $dataDB->id_mapel, "id_guru" => $this->mdl->idu()))->num_rows();
			if ($cekmateri) {
				$color2 = "bg-deep-orange";
			} else {
				$color2 = "bg-blue-grey";
			}


			if ($sts == 0) {
				$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
                                    <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->id_kelas . '`,`' . $dataDB->id_mapel . '`,`' . $dataDB->jml_jam . '`,`' . $dataDB->total_jam . '`)" class="sadow btn bg-teal waves-effect waves-light">EDIT</button>
                                    <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->mapel . '`,`' . $dataDB->id_kelas . '`,`' . $dataDB->id_mapel . '`)" class="sadow btn bg-blue-grey waves-effect waves-light">HAPUS</button>
                                 
                                </div>
                                
                            </div>';
			} else {
				$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
                                    <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->id_kelas . '`,`' . $dataDB->id_mapel . '`,`' . $dataDB->jml_jam . '`,`' . $dataDB->total_jam . '`)" class="sadow btn bg-teal waves-effect waves-light">EDIT</button>
                                      
                                </div>
                                
                            </div>';
			};

			$up = "<span class='size' onclick='addMateri(`" . $dataDB->id_mapel . "`,`" . $dataDB->mapel . "`,`" . $dataDB->kelas . "`)'> 
			<button class='btn btn-sx " . $color2 . " sadow'>+ File Materi</button> </span>";

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $dataDB->kelas . " </span>";
			$row[] = "<span class='size'>" . $dataDB->mapel . " </span>";
			$row[] = "<span class='size'>" . $dataDB->jml_jam . " ===> Target : " . $dataDB->total_jam . " Jam</span>";
			$row[] = '  <a  href="' . $aksi . '" class="btn btn-sx ' . $color . ' sadow">' . $titlerpp . '</a> ';
			$row[] = "<span class='size'>" . $up . " </span>";
			//add html for action
			$row[] =  $tombol;
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
	function insert_kelas()
	{
		$echo = $this->mdl->insert_kelas();
		echo json_encode($echo);
	}
	function hapus_kelas()
	{
		echo $this->mdl->hapus_kelas();
	}
	function hapus_bahan()
	{
		$id = $this->input->post("id");
		$kode = $this->input->post("code");


		$data = $this->db->get_where("tm_bahan_ajar", array("id" => $id))->row();
		$id_materi = $data->id_materi;

		$data = $this->db->get_where("tm_materi", array("id" => $id_materi))->row();
		$id_kikd = $data->id_kikd;

		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->where("id_guru", $this->mdl->idu());
		$this->db->where("id_semester", $sms);
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_kikd", $id_kikd);
		$data = $this->db->get("tm_materi")->result();
		foreach ($data as $val) {
			$e = $this->db->query("select * from tm_bahan_ajar where id_materi='" . $val->id . "' ")->result();
			foreach ($e as $val) {
				echo $this->mdl->hapus_bahan($val->id, $kode);
			}
		}
	}

	function hapus_bahan2()
	{
		$id = $this->input->post("id");
		$kode = $this->input->post("code");


		$data = $this->db->get_where("tm_bahan_ajar", array("id" => $id))->row();
		$id_mapel = $data->id_mapel;
		$e = $this->db->query("select * from tm_bahan_ajar where id_materi='" . $val->id . "' ")->result();
		echo $this->mdl->hapus_bahan2($val->id_mapel, $kode);
	}


	function getMapel($value = null)
	{
		$idk = $this->input->post("idk");
		$id_tk = $this->m_reff->goField("v_kelas", "id_tk", "where id='" . $idk . "' ");
		$idj = $this->m_reff->goField("v_kelas", "id_jurusan", "where id='" . $idk . "' ");
		//$idjurusan=$this->m_reff->goField("v_kelas","id_jurusan","where id='".$idj."' ");


		$this->db->where("k_mapel!=", "ujol");
		$this->db->where("id_tk", $id_tk);
		$this->db->where("id_jurusan", $idj);
		$this->db->order_by("nama", "asc");
		$sts = $this->db->get("tr_mapel")->result();
		$ray = "";
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $val->nama;
		}
		echo form_dropdown("id_mapel", $ray, $value, 'required class="form-control col-md-12 show-tick" data-live-search="true"');
		//	  echo "<script>$('select').selectpicker();</script>";
	}
	function getMapelDisabled($value = null)
	{
		$idk = $this->input->post("idk");
		$id_tk = $this->m_reff->goField("v_kelas", "id_tk", "where id='" . $idk . "' ");
		$idj = $this->m_reff->goField("v_kelas", "id_jurusan", "where id='" . $idk . "' ");
		//$idjurusan=$this->m_reff->goField("v_kelas","id_jurusan","where id='".$idj."' ");


		$this->db->where("k_mapel!=", "ujol");
		$this->db->where("id_tk", $id_tk);
		$this->db->where("id_jurusan", $idj);
		$sts = $this->db->get("tr_mapel")->result();
		$ray = "";
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $val->nama;
		}
		echo form_dropdown("id_mapel", $ray, $value, 'required disabled class="form-control col-md-12 show-tick" data-live-search="true"');
		//	  echo "<script>$('select').selectpicker();</script>";
	}
	function _kikd()
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->set("id_semester", $sms);
		$this->db->set("id_tahun", $tahun);
		$this->db->where("id_guru", $this->mdl->idu());
		$db = $this->db->get("tm_kikd")->result();
		$x = "";
		foreach ($db as $db) {
			$x .= $db->id_mapel_ajar . ",";
		}
		return substr($x, 0, -1);
	}
	function _mapelAjar()
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		return	$this->db->query("SELECT * FROM `tm_mapel_ajar` WHERE   id_tahun='" . $tahun . "' and id_semester='" . $sms . "' and  `id_guru` = '" . $this->mdl->idu() . "'")->result();
	}
	function getMapelAjar($value = null)
	{

		$sts = $this->_mapelAjar();
		$ray = "";
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $this->m_reff->goField("tr_mapel", "nama", "where id='" . $val->id_mapel . "'") . " # " . $this->m_reff->goField("v_kelas", "nama", "where id='" . $val->id_kelas . "'");
		}
		echo form_dropdown("f[id_mapel_ajar]", $ray, $value, 'required class="form-control col-md-12 show-tick" data-live-search="true"');
		echo "<script>$('select').selectpicker();</script>";
	}
	function getKikd()
	{
		$value = $this->input->post("val");
		$sms = $this->m_reff->semester();
		$thn = $this->m_reff->tahun();
		$this->db->where("id_tahun", $thn);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $this->mdl->idu());
		$this->db->where("id_mapel_ajar", $this->input->post("id"));
		$sts = $this->db->get("tm_kikd")->result();
		$ray = "";
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $val->kd3_no . " - " . $val->kd3_desc . " | " . $val->kd4_no . " - " . $val->kd4_desc;
		}
		echo form_dropdown("f[id_kikd]", $ray, $value, 'required class="form-control col-md-12 show-tick" data-live-search="true"');
		echo "<script>$('select').selectpicker();</script>";
	}
	function getKikdDisabled()
	{
		$value = $this->input->post("val");
		$sms = $this->m_reff->semester();
		$thn = $this->m_reff->tahun();
		$this->db->where("id_tahun", $thn);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $this->mdl->idu());
		$this->db->where("id_mapel_ajar", $this->input->post("id"));
		$sts = $this->db->get("tm_kikd")->result();
		$ray = "";
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $val->kd3_no . " - " . $val->kd3_desc . " | " . $val->kd4_no . " - " . $val->kd4_desc;
		}
		echo form_dropdown("f[id_kikd]", $ray, $value, 'disabled required class="form-control col-md-12 show-tick" data-live-search="true"');
		echo "<script>$('select').selectpicker();</script>";
	}
	function tahap2()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("tahap2");
		} else {
			$data['konten'] = "tahap2";
			$this->_template($data);
		}
	}
	function kikd()
	{
		$tbl = "v_kikd";
		$list = $this->mdl->get_open($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sts = 0; //$this->mdl->cektahap(2);
		foreach ($list as $dataDB) {
			////
			if ($sts) {
				$tombol = ' 
                               
              <button title="Edit data" type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->mapel . '`)" 
			  class="btn col-teal bg-white  btn-circle waves-effect waves-circle waves-float">
			     <i class="material-icons">border_color</i></button>
          
                                 
                            </div>';
			} else {
				$tombol = ' 
                               
              <button title="Edit data" type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->mapel . '`)" 
			  class="btn col-teal bg-white  btn-circle waves-effect waves-circle waves-float">
			     <i class="material-icons">border_color</i></button>
           <button title="Hapus data" type="button" onclick="hapus(`' . $dataDB->id_mapel_ajar . '`,`' . $dataDB->mapel . '`,`' . $dataDB->code . '`)" 
		   class="btn col-pink bg-white  btn-circle  waves-effect waves-circle waves-float">
		   <i class="material-icons">delete_forever</i></button>
                                 
                            </div>';
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $tombol . "</span>";
			$row[] = "<span class='size'>" . $dataDB->mapel . " / Kelas :" . $dataDB->nama_tingkat . "</span>";
			$row[] = "<span class='size'>" . $dataDB->kd3_no . " </span>";
			$row[] = "<span class='size'>" . $dataDB->kd3_kb . " </span>";
			$row[] = "<span class='size'>" . $dataDB->kd3_desc . " </span>";
			$row[] = "<span class='size'>" . $dataDB->kd4_no . " </span>";
			$row[] = "<span class='size'>" . $dataDB->kd4_kb . " </span>";
			$row[] = "<span class='size'>" . $dataDB->kd4_desc . " </span>";

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
	function insert_kikd()
	{
		$data = $this->mdl->insert_kikd();
		echo json_encode($data);
	}
	function hapus_kikd()
	{
		echo json_encode($this->mdl->hapus_kikd());
	}
	function addKikd()
	{
		echo $this->load->view("addKikd");
	}
	function addKikd_file()
	{
		echo $this->load->view("addKikd_file");
	}
	/*#-----------------------------------------#*/
	function addMateri()
	{
		echo $this->load->view("addMateri");
	}
	function tahap3()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("tahap3");
		} else {
			$data['konten'] = "tahap3";
			$this->_template($data);
		}
	}
	function pembelajaran()
	{
		$tbl = "v_materi";
		$search = "materi";
		$list = $this->mdl->get_open($tbl, $search);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sts = $this->mdl->cektahap(3);
		foreach ($list as $dataDB) {
			////
			$cek = $this->db->query("select * from tm_bahan_ajar where id_materi='" . $dataDB->id . "'")->num_rows();
			if ($cek) {
				$color = "bg-pink";
			} else {
				$color = "bg-grey";
			}




			$tombol = ' 
                               
              <button title="Edit data" type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->materi . '`)" 
			  class="btn col-teal bg-white btn-circle waves-effect waves-circle waves-float">
			     <i class="material-icons">border_color</i></button>
           <button title="Hapus data" type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->materi . '`,`' . $dataDB->code . '`)" 
		   class="btn col-pink bg-white btn-circle  waves-effect waves-circle waves-float">
		   <i class="material-icons">delete_forever</i></button>
                                 
                            </div>';


			$row = array();

			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = $tombol;
			$row[] = "<span class='size'>" . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $dataDB->id_mapel . "'") . " - Kelas: " . $dataDB->nama_tingkat . "</span>";
			$row[] = "<span class='size'>" . $dataDB->kd3_no . " - " . $dataDB->kd3_desc . " | " . $dataDB->kd4_no . " - " . $dataDB->kd4_desc . " </span>";

			$row[] = "<span class='size'>" . $dataDB->materi . " </span>";
			/*	$row[] = "<span class='size' onclick='addMateri(`".$dataDB->id."`,`".$dataDB->id_kikd."`,`".$dataDB->code."`)'> 
			<button class='btn btn-sx ".$color." sadow'>+ File Materi</button> </span>";
			//add html for action*/

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdl->count_file($tbl, $search),
			"recordsFiltered" => $this->mdl->count_file($tbl, $search),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function insert_pembelajaran()
	{
		echo $this->mdl->insert_kikd();
	}
	function hapus_pembelajaran()
	{
		echo $this->mdl->hapus_pembelajaran();
	}
	function insert_materi()
	{
		echo $this->mdl->insert_materi();
	}
	function input_materi_baru()
	{
		echo $this->mdl->input_materi_baru();
	}
	function update_materi()
	{
		echo $this->mdl->update_materi();
	}
	function insert_materi_ajar()
	{
		$echo = $this->mdl->insert_materi_ajar();
		echo json_encode($echo);
	}
	function insert_materi_ajar2()
	{
		$echo = $this->mdl->insert_materi_ajar2();
		echo json_encode($echo);
	}
	function dataMateri()
	{
		$data["id"] = $this->input->post("id");
		echo	$this->load->view("data_materi", $data);
	}
	function dataMateri2()
	{
		$data["id"] = $this->input->post("id");
		echo	$this->load->view("data_materi2", $data);
	}
	function editkikd()
	{
		$id = $this->input->post("id");
		$data["data"] = $this->db->query("select * from v_kikd where id='" . $id . "'")->row();
		echo	$this->load->view("editKikd", $data);
	}
	function editMateri()
	{
		$id = $this->input->post("id");
		$data["data"] = $this->db->query("select * from v_materi where id='" . $id . "'")->row();
		echo $this->load->view("editMateri", $data);
	}
	function update_kikd()
	{
		echo $this->mdl->update_kikd();
	}
	/*=============================================*/
	function tahap4()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("tahap4");
		} else {
			$data['konten'] = "tahap4";
			$this->_template($data);
		}
	}
	function penjadwalan()
	{
		$tbl = "v_mapel_ajar";
		$list = $this->mdl->get_open($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////

			$cek = $this->mdl->cekIsiJadwal($dataDB->id_guru, $dataDB->id_kelas, $dataDB->id_tahun, $dataDB->id_semester, $dataDB->id_mapel);
			if ($cek) {
				$sts = "bg-pink";
			} else {
				$sts = "bg-blue-grey";
			};
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $dataDB->kelas . " </span>";
			$row[] = "<span class='size'>" . $dataDB->mapel . " </span>";
			$row[] = "<span class='size'>" . $dataDB->jml_jam . " </span>";
			//add html for action
			$row[] = '
			<div class="btn-group-vertical">
                                     <button onclick="jadwal(`' . $dataDB->id . '`,`' . $dataDB->mapel . ' Kelas: ' . $dataDB->kelas . '`)" type="button" class="btn ' . $sts . ' waves-effect">Tentukan Jadwal </button>
                                   
                                </div>';
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
	function getJadual()
	{
		$data["id"] = $this->input->post("id");
		$this->load->view("getJadual", $data);
	}
	function cekJadwal()
	{
		$echo = $this->mdl->cekJadwal();
		echo json_encode($echo);
	}
	function setJadwal()
	{
		$echo = $this->mdl->setJadwal();
		echo json_encode($echo);
	}
	function setDisabled()
	{
		$echo = $this->mdl->setDisabled();
		echo json_encode($echo);
	}

	function tahap_akhir()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo $this->load->view("tahap_akhir");
		} else {
			$data['konten'] = "tahap_akhir";
			$this->_template($data);
		}
	}
	function profile()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo $this->load->view("profile");
		} else {
			$data['konten'] = "profile";
			$this->_template($data);
		}
	}
	function profile_kepsek()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo $this->load->view("profile_kepsek");
		} else {
			$data['konten'] = "profile_kepsek";
			$this->load->view('template/main', $data);
		}
	}
	function simpan_akun()
	{
		$data = $this->mdl->simpan_akun();
		echo json_encode($data);
	}
	function finalin()
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();

		$tbl = "v_mapel_ajar";
		$query = "group by nama_tingkat,mapel,id_tahun,id_semester,id_guru";

		$query = "select * from " . $tbl . "  where  id_guru='" . $this->mdl->idu() . "' and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' $query ";

		$list = $this->db->query($query)->result();
		$ok = true;
		foreach ($list as $dataDB) {
			$cek = $this->mdl->cekIsiJadwal($dataDB->id_guru, $dataDB->id_kelas, $dataDB->id_tahun, $dataDB->id_semester, $dataDB->id_mapel);
			if ($cek == 0) {
				echo "false";
				return false;
			}
		}

		$this->mdl->finalin(1);
		echo "true";
		return true;
	}
	function editMapelAjar()
	{
		echo $this->load->view("editMapelAjar");
	}
	function set_warna_menu($warna)
	{

		$this->db->where("id", $this->session->userdata("id"));
		$this->db->set("warna_menu", $warna);
		echo   $this->db->update("data_pegawai");
	}
	function resset_tampilan()
	{

		$this->db->where("id", $this->session->userdata("id"));
		$this->db->set("mode_latar", 0);
		$this->db->set("warna_menu", null);
		echo   $this->db->update("data_pegawai");
	}
	function update_mapelajar()
	{
		$echo = $this->mdl->update_mapelajar_tahap1();
		echo json_encode($echo);
	}
	function update_data_guru()
	{
		$data = $this->mdl->update_data_guru();
		echo json_encode($data);
	}
	function update_dp()
	{
		$data = $this->mdl->update_dp();
		echo json_encode($data);
	}
	function update_bg()
	{
		$data = $this->mdl->update_bg();
		echo json_encode($data);
	}
	function beres($id)
	{
		echo	$this->mdl->beres($id);
		//	redirect("guru_instal/tahap".($id+1));
	}
	function tahap5()
	{
		echo $this->tahap_akhir();
	}
	function ceknokd()
	{
		$id = $this->input->get_post("id");
		$data = $this->mdl->ceknokd($id);
		echo json_encode($data);
	}
	function import_kikd()
	{
		$data = $this->mdl->import_kikd();
		echo json_encode($data);
	}
	function copas_tahap1()
	{
		$data = $this->mdl->copas_tahap1();
		echo json_encode($data);
	}
	function copas_tahap4()
	{
		$data = $this->mdl->copas_tahap4();
		echo json_encode($data);
	}
}
