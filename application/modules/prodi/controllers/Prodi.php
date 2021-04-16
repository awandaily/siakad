<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prodi extends CI_Controller
{


	var $tbl = "v_pegawai";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("PRODI", "GURU", "KEPSEK", "ADMIN", "PENGAWAS"));
		$this->load->model("model", "mdl");
		$this->load->model("m_sms", "sms");
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

	public function bursa_kerja()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("bursa_kerja");
		} else {
			$data['konten'] = "bursa_kerja";
			$this->_template($data);
		}
	}

	public function pkl1()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("pkl1");
		} else {
			$data['konten'] = "pkl1";
			$this->_template($data);
		}
	}
	public function list_data()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("list");
		} else {
			$data['konten'] = "list";
			$this->_template($data);
		}
	}

	public function list_data_pembimbing()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("list_pembimbing");
		} else {
			$data['konten'] = "list_pembimbing";
			$this->_template($data);
		}
	}

	public function pkl2()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("pkl2");
		} else {
			$data['konten'] = "pkl2";
			$this->_template($data);
		}
	}



	///-----------------------SISWA--------------------------///



	///-----------------------mitra PENILIAAN--------------------------///
	function getData()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$nama = $dataDB->nama;


			$row = array();

			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='size'>  " . $nama . " </span>";
			$row[] = "<span class='size'>  " . $this->mdl->cekQuotaMitra($dataDB->id) . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->lokasi . " </span>";
			$row[] = "<span class='size'>  " . $this->mdl->quotaMitra($dataDB->id) . " </span>";
			$row[] = "<span class='size'>  " . $this->mdl->ketQuota($dataDB->id) . " </span>";


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

	public function pengaduan()
	{


		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("pengaduan");
		} else {
			$data['konten'] = "pengaduan";
			$this->_template($data);
		}
	}

	function getCatatan()
	{

		$list = $this->mdl->get_data_pengaduan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$respon = "";
			$db = $this->db->query("select * from tm_tanggapan where id_catatan='" . $dataDB->id . "'")->result();
			foreach ($db as $db) {
				$respon .= $db->tanggapan . " <a href='javascript:hapus_tanggapan(`" . $db->id . "`)'>&times;</a> <br>";
			}


			$nama = $this->m_reff->goField("data_siswa", "nama", "where id='" . $dataDB->id_siswa . "' ");
			$tombol = "";
			$jabatan = $this->m_reff->goField("admin", "owner", "WHERE id_admin = '" . $this->session->userdata("id") . "' ");




			if ($dataDB->status_wk != "" and $dataDB->tanggapan_wk != "" and $dataDB->status_wk == "Open") {
				if ($dataDB->status_pr == "" and $dataDB->status_pr == "") {
					$tombol .= '
			  			<button title="Tanggapi" type="button" onclick="tanggapi(`' . $dataDB->id . '`,`' . $nama . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			   				<i class="material-icons">mode_edit</i>
			  			</button>
			  		';
				}
			}

			$tombol .= '
		  		<button title="Riwayat Tanggapan" type="button" onclick="log_tanggapi(`' . $dataDB->id . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   			<i class="material-icons">done_all</i>
		  		</button>
		  	';

			$row = array();

			$row[] = "<span class='size'>" . $this->tanggal->ind(substr($dataDB->tgl, 0, 10), "/") . "<br>" .
				$this->m_reff->goField("data_pegawai", "nama", "where id='" . $dataDB->id_guru . "'") . "</span>";
			$row[] = "<a class='size cursor' onclick='detail(`" . $dataDB->id_siswa . "`)' >  " . $nama . " </a><br>
			 " . $this->m_reff->goField("v_siswa", "nama_kelas", "where id='" . $dataDB->id_siswa . "'") . "
			";


			$row[] = "<span class='size'>  " . $dataDB->ket . " </span>";
			$row[] = $tombol;

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_pengaduan(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function insert_tanggapan()
	{
		echo $this->mdl->insert_tanggapan();
	}


	//-------------------------------------------------END SISWA------------------------------------//
	function idu()
	{
		return $this->session->userdata("id");
	}



	function data_siswa()
	{
		$list = $this->mdl->get_data_siswa();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$datamitra = $this->db->get_where("tr_mitra")->result();
		$dataguru = $this->db->get_where("data_pegawai", array("aktifasi" => 1))->result();
		foreach ($list as $dataDB) {
			$jam = $dataDB->lama;


			$tmp = $this->m_reff->goField("tr_mitra", "nama", "where id='" . $dataDB->id_mitra . "'");
			$data_r = array();
			$data_r[] = "-----";
			foreach ($datamitra as $dm) {
				$data_r[$dm->id] = $dm->nama;
			}
			$ray = $data_r;
			$pilih = form_dropdown("id_mitra" . $dataDB->id, $ray, $dataDB->id_mitra, "style='min-width:170px' class='form-control cursor' onchange='set(`" . $dataDB->id . "`)' data-live-search='true' ");
			$pilih = $pilih . "<script>$('select').selectpicker()</script>";

			$tglotw = $this->tanggal->ind($dataDB->tgl_berangkat, "/");
			$keberangkatan = "<input type='text' value='" . $tglotw . "' id='tgl_berangkat$dataDB->id' name='otw" . $dataDB->id . "' style='max-width:95px' onchange='setOtw(`" . $dataDB->id . "`)'> <script>$('#tgl_berangkat$dataDB->id').inputmask('99/99/9999');  </script>";


			$data_r = array();
			$data_r[] = "-----";
			foreach ($dataguru as $dm) {
				$data_r[$dm->id] = $dm->nama;
			}
			$ray = $data_r;
			/*
		 $pembimbing=form_dropdown("id_pembimbing".$dataDB->id,$ray,$dataDB->id_pembimbing,"style='min-width:170px' class='form-control cursor' onchange='setpembimbing(`".$dataDB->id."`)' data-live-search='true' ");
		 $pembimbing=$pembimbing;*/

			if ($dataDB->id_mitra != "") {
				$this->db->where("id_mitra", $dataDB->id_mitra);
				$this->db->where("id_tahun", $tahun);
				$this->db->where("id_semester", $sms);
				$qp = $this->db->get("tr_mitra_quota")->result();

				$sel_pemb = "";
				foreach ($qp as $p) {
					$pem = $this->m_reff->goField("data_pegawai", "nama", " WHERE id='" . $p->id_pembimbing . "'");

					if ($p->id == $dataDB->id_quota) {
						$sel_pemb .= "<option value='" . $p->id . "' selected>" . $pem . " (Q=" . $p->quota . ") (" . date("d/m/Y", strtotime($p->tgl_berangkat)) . ") (" . $p->lama_pkl . " bln)</option>";
						$desk = $pem . " (Q=" . $p->quota . ") (" . date("d/m/Y", strtotime($p->tgl_berangkat)) . ") (" . $p->lama_pkl . " bln)";
					} else {
						$sel_pemb .= "<option value='" . $p->id . "'>" . $pem . " (Q=" . $p->quota . ") (" . date("d/m/Y", strtotime($p->tgl_berangkat)) . ") (" . $p->lama_pkl . " bln)</option>";
						$desk = "";
					}
				}
			} else {
				$sel_pemb = "";
				$desk = "";
			}



			$kls = $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "' ");
			$row = array();
			$row[] =  $no++;

			$row[] =  $dataDB->nama . " (" . strtoupper($dataDB->jk) . ")<br> <span class='col-indigo'>" . $kls . "</span>";
			$row[] = " <span class='hide'>" . $tmp . "</span>" . $pilih;

			//$row[] = "<center><span class='hide'>".$jam."</span><input type='text' style='max-width:70px;text-align:center' name='jam".$dataDB->id."' value='".$jam."' onchange='set(`".$dataDB->id."`)'></center>";
			$row[] =  "<select class='form-control cursor' style='min-width:170px' data-live-search='true' name='id_pembimbing" . $dataDB->id . "' onchange='setpembimbing(`" . $dataDB->id . "`)'>
		    				<option value=''>-----</option>
		    				" . $sel_pemb . "
		    			</select>";
			$row[] =  "<p>" . $desk . "</p>";
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_siswa(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}



	function data_siswa_pkl()
	{
		$list = $this->mdl->get_data_siswa();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();

		foreach ($list as $dataDB) {
			$jam = $dataDB->lama;


			$tmp = $this->m_reff->goField("tr_mitra", "nama", "where id='" . $dataDB->id_mitra . "'");


			$tglotw = $this->tanggal->hariLengkap($dataDB->tgl_berangkat, "/");


			$kls = $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "' ");
			$row = array();
			$row[] =  $no++;

			$row[] =  $dataDB->nama . " (" . strtoupper($dataDB->jk) . ") ";
			$row[] = "<span  >" . $kls . "</span>";
			$row[] = " <span>" . $tmp . "</span>";

			$row[] = "<center><span  >" . $jam . "</span></center>";
			$row[] =  $this->m_reff->goField("v_pegawai", "nama", "where id='" . $dataDB->id_pembimbing . "' ");
			$row[] =  "<center>" . $tglotw . "</center>";
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_siswa(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}




	function data_pembimbing()
	{
		$list = $this->mdl->get_data_pembimbing();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;

		$datamitra = $this->db->get_where("tr_mitra")->result();
		$dataguru = $this->db->get_where("data_pegawai", array("aktifasi" => 1))->result();
		foreach ($list as $dataDB) {
			$jam = $dataDB->lama_pkl;


			$tmp = $this->m_reff->goField("tr_mitra", "nama", "where id='" . $dataDB->id_mitra . "'");


			$tglotw = $this->tanggal->hariLengkap($dataDB->tgl_berangkat, "/");
			if ($tglotw == "Senin, 00/00/0000") {
				$tglotw = "-";
			};
			$tglplg = $this->tanggal->hariLengkap($dataDB->tgl_pulang, "/");
			if ($tglplg == "Senin, 00/00/0000") {
				$tglplg = "-";
			};
			$m1 = $this->tanggal->hariLengkap($dataDB->monitoring1, "/");
			if ($m1 == "Senin, 00/00/0000") {
				$m1 = "-";
			}
			$m2 = $this->tanggal->hariLengkap($dataDB->monitoring2, "/");
			if ($m2 == "Senin, 00/00/0000") {
				$m2 = "-";
			}
			$m3 = $this->tanggal->hariLengkap($dataDB->monitoring3, "/");
			if ($m3 == "Senin, 00/00/0000") {
				$m3 = "-";
			}
			$m4 = $this->tanggal->hariLengkap($dataDB->monitoring4, "/");
			if ($m4 == "Senin, 00/00/0000") {
				$m4 = "-";
			}
			$m5 = $this->tanggal->hariLengkap($dataDB->monitoring5, "/");
			if ($m5 == "Senin, 00/00/0000") {
				$m5 = "-";
			}
			$m6 = $this->tanggal->hariLengkap($dataDB->monitoring6, "/");
			if ($m6 == "Senin, 00/00/0000") {
				$m6 = "-";
			}


			if ($dataDB->sts_m1 != NULL) {
				$m1 = "<a  class='col-deep-orange font-bold' href='javascript:showImg(`" . base_url() . "file_upload/pkl/$dataDB->foto_m1`,`MONITORING 1`,`$m1`)'>✔✔$m1</a>";
			}
			if ($dataDB->sts_m2 != NULL) {
				$m2 = "<a  class='col-deep-orange font-bold' href='javascript:showImg(`" . base_url() . "file_upload/pkl/$dataDB->foto_m2`,`MONITORING 2`,`$m2`)'>✔✔$m2</a>";
			}
			if ($dataDB->sts_m3 != NULL) {
				$m3 = "<a   class='col-deep-orange font-bold' href='javascript:showImg(`" . base_url() . "file_upload/pkl/$dataDB->foto_m3`,`MONITORING 3`,`$m3`)'>✔✔$m3</a>";
			}
			if ($dataDB->sts_m4 != NULL) {
				$m4 = "<a class='col-deep-orange font-bold' href='javascript:showImg(`" . base_url() . "file_upload/pkl/$dataDB->foto_m4`,`MONITORING 4`,`$m4`)'>✔✔$m4</a>";
			}
			if ($dataDB->sts_m5 != NULL) {
				$m5 = "<a  class='col-deep-orange font-bold' href='javascript:showImg(`" . base_url() . "file_upload/pkl/$dataDB->foto_m5`,`MONITORING 5`,`$m5`)'>✔✔$m5</a>";
			}
			if ($dataDB->sts_m6 != NULL) {
				$m6 = "<a  class='col-deep-orange font-bold' href='javascript:showImg(`" . base_url() . "file_upload/pkl/$dataDB->foto_m6`,`MONITORING 6`,`$m6`)'>✔✔$m6</a>";
			}
			if ($dataDB->sts_berangkat != NULL) {
				$tglotw = "<a  class='col-deep-orange font-bold' href='javascript:showImg(`" . base_url() . "file_upload/pkl/$dataDB->foto_berangkat`,`PEMBERANGKATAN`,`$tglotw`)'>✔✔$tglotw</a>";
			}
			if ($dataDB->sts_pulang != NULL) {
				$tglplg = "<a  class='col-deep-orange font-bold' href='javascript:showImg(`" . base_url() . "file_upload/pkl/$dataDB->foto_pulang`,`KEPULANGAN`,`$tglplg`)'>✔✔$tglplg</a>";
			}





			$row = array();
			$row[] =  $no++;
			$row[] =  $this->m_reff->goField("v_pegawai", "nama", "where id='" . $dataDB->id_pembimbing . "' ");
			$row[] = " <span>" . $tmp . "</span>";
			$row[] =  "<center>" . $tglotw . "</center>";
			$row[] =  "<center>" . $m1 . "</center>";
			$row[] =  "<center>" . $m2 . "</center>";
			$row[] =  "<center>" . $m3 . "</center>";
			$row[] =  "<center>" . $m4 . "</center>";
			$row[] =  "<center>" . $m5 . "</center>";
			$row[] =  "<center>" . $m6 . "</center>";
			$row[] =  "<center>" . $tglplg . "</center>";
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_pembimbing(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	function setMitra()
	{
		$data = $this->mdl->setMitra();
		echo json_encode($data);
	}
	function setpembimbing()
	{
		$data = $this->mdl->setpembimbing();
		echo json_encode($data);
	}
	function setOtw()
	{
		$data = $this->mdl->setOtw();
		echo json_encode($data);
	}
	function download_format($id)
	{
		echo $this->mdl->download_format($id);
	}
	function import_data()
	{
		$echo = $this->mdl->import_data();
		echo json_encode($echo);
	}

	public function kalender()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("kalender");
		} else {
			$data['konten'] = "kalender";
			$this->_template($data);
		}
	}
	function jadwal_otw()
	{
		/////////////
		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$type = isset($_POST['type']) ? ($_POST['type']) : "";
		if ($type == 'fetch') {


			$events = array();
			$fetch = $this->db->query("SELECT * FROM tr_mitra_quota  where id_tahun='$tahun' and id_pembimbing IS NOT NULL and id_pembimbing!='' ")->result();

			foreach ($fetch as $fetch) {
				$nama = $this->m_reff->goField("v_pegawai", "nama", "where id='" . $fetch->id_pembimbing . "' ");
				if ($fetch->sts_berangkat) {
					$sts = "✔✔";
				} else {
					$sts = "";
				}
				$e = array();
				$e['id'] = $fetch->id;
				$e['id_mitra'] = $fetch->id_mitra;
				$e['id_pembimbing'] = $fetch->id_pembimbing;
				$e['sts'] = "otw";
				$e['title'] = $sts . $nama; //." | Rp.".number_format($fetch->honor,0,",","."); 
				$e['start'] = $fetch->tgl_berangkat;
				$e['end'] =  $this->tanggal->tambah_tgl($fetch->tgl_berangkat, 1);
				$e['backgroundColor'] = "green";
				$e['color'] = "green";
				//  $allday = ($fetch->allDay == "true") ? true : false;
				$e['allDay'] = "true";

				array_push($events, $e);
			}
			echo json_encode($events);
		}
	}
	function infoKalender()
	{
		$sts = $this->input->get_post("sts");
		if ($sts == "otw") {
			$this->infoBerangkat();
		} elseif ($sts == "plg") {
			$this->infoPulang();
		} else {
			$this->infoMonitoring();
		}
	}
	function infoMonitoring()
	{


		$title = $this->input->get_post("title");
		$guru = str_replace("✔✔", "", $title);
		$tgl = $this->input->get_post("tgl");
		$sts = $this->input->get_post("sts");
		$id_pembimbing = $this->input->get_post("id_pembimbing");
		$id_mitra = $this->input->get_post("id_mitra");
		$m = $sts;
		$sts_m = "sts_m" . str_replace("monitoring", "", $sts);
		$foo = "foto_m" . str_replace("monitoring", "", $sts);

		$dataMitra = $this->db->query("select * from tr_mitra_quota where id_pembimbing='$id_pembimbing' and $sts='$tgl' and id_mitra='$id_mitra' ")->row();

		if ($dataMitra->$sts_m == null) {
			$pelaksanaan = "<label class='label bg-pink'>Belum</label>";
		} else {
			$pelaksanaan = $this->tanggal->hariLengkap($dataMitra->$sts_m, "/");
		}



		$tgl_otw = $dataMitra->tgl_berangkat; //untuk menentukan data xl
		$mitradudi = $this->m_reff->goField("tr_mitra", "nama", "where id='$id_mitra' ");
		$poto = "";
		if ($dataMitra->$foo) {
			$pp = "file_upload/pkl/" . $dataMitra->$foo;
			if (!file_exists($pp)) {
				$file = "-";
			} else {
				$file = "<img class='img-responsive thumbnail' width='190px' src='" . base_url() . "file_upload/pkl/" . $dataMitra->$foo . "'>";
			}
			$poto = "<tr><td colspan='2'> <center>$file</center></td></tr>";
		}


		echo "<table class='entry2' width='100%'><tr><td>
	         Pemibimbing </td><td>$guru[0]</td></tr>
	         <tr>
	         <td>Mitra / DUDI</td><td>$mitradudi</td>
	         </tr>
	          <tr>
	         <td>Jadwal $sts</td><td>" . $this->tanggal->hariLengkap($tgl, "/") . "</td>
	         </tr>
	         <tr>
	         <td>Pelaksanaan</td><td>$pelaksanaan</td>
	         </tr>
	          $poto
	          <tr>
	         <td colspan='2'><center> <a class='btn bg-teal' href='" . base_url() . "prodi/download_data_pkl/$dataMitra->id'>Download Data Siswa PKL</a></center> </td>
	         </tr>
	           
	         </table>";
	}
	function infoPulang()
	{
		$title = $this->input->get_post("title");
		$guru = str_replace("✔✔", "", $title);
		$tgl = $this->input->get_post("tgl");
		$sts = $this->input->get_post("sts");
		$id_pembimbing = $this->input->get_post("id_pembimbing");
		$id_mitra = $this->input->get_post("id_mitra");


		$dataMitra = $this->db->query("select * from v_mitra_pkl where id_pembimbing='$id_pembimbing' and tgl_pulang='$tgl' and id_mitra='$id_mitra' ")->row();

		if ($dataMitra->sts_pulang == null) {
			$pelaksanaan = "<label class='label bg-pink'>Belum</label>";
		} else {
			$pelaksanaan = $this->tanggal->hariLengkap($dataMitra->sts_pulang, "/");
		}



		$tgl_otw = $dataMitra->tgl_berangkat; //untuk menentukan data xl
		$mitradudi = $this->m_reff->goField("tr_mitra", "nama", "where id='$id_mitra' ");
		$poto = "";
		if ($dataMitra->foto_pulang) {
			$pp = "file_upload/pkl/" . $dataMitra->foto_pulang;
			if (!file_exists($pp)) {
				$file = "-";
			} else {
				$file = "<img class='img-responsive thumbnail' width='150px' src='" . base_url() . "file_upload/pkl/$dataMitra->foto_pulang'>";
			}
			$poto = "<tr><td colspan='2'><center> $file </center></td></tr>";
		}


		echo "<table class='entry2' width='100%'><tr><td>
	         Pemibimbing </td><td>$guru[0]</td></tr>
	         <tr>
	         <td>Mitra / DUDI</td><td>$mitradudi</td>
	         </tr>
	          <tr>
	         <td>Jadwal Penjemputan</td><td>" . $this->tanggal->hariLengkap($tgl, "/") . "</td>
	         </tr>
	         <tr>
	         <td>Pelaksanaan</td><td>$pelaksanaan</td>
	         </tr>
	          $poto
	          <tr>
	         <td colspan='2'><center> <a class='btn bg-teal' href='" . base_url() . "prodi/download_data_pkl/$dataMitra->id'>Download Data Siswa PKL</a></center> </td>
	         </tr>
	           
	         </table>";
	}
	function infoBerangkat()
	{
		$title = $this->input->get_post("title");
		$guru = str_replace("✔✔", "", $title);
		$tgl = $this->input->get_post("tgl");
		$sts = $this->input->get_post("sts");
		$id_pembimbing = $this->input->get_post("id_pembimbing");
		$id_mitra = $this->input->get_post("id_mitra");


		$dataMitra = $this->db->query("select * from v_mitra_pkl where id_pembimbing='$id_pembimbing' and tgl_berangkat='$tgl' and id_mitra='$id_mitra' ")->row();

		if ($dataMitra->sts_berangkat == null) {
			$pelaksanaan = "<label class='label bg-pink'>Belum</label>";
		} else {
			$pelaksanaan = $this->tanggal->hariLengkap($dataMitra->sts_berangkat, "/");
		}


		$mitradudi = $this->m_reff->goField("tr_mitra", "nama", "where id='$id_mitra' ");
		$poto = "";
		if ($dataMitra->foto_berangkat) {
			$pp = "file_upload/pkl/" . $dataMitra->foto_berangkat;
			if (!file_exists($pp)) {
				$file = "-";
			} else {
				$file = "<img class='img-responsive thumbnail' width='190px' src='" . base_url() . "file_upload/pkl/$dataMitra->foto_berangkat'>";
			}
			$poto = "<tr><td colspan='2'> <center>$file</center></td></tr>";
		}


		echo "<table class='entry2' width='100%'><tr><td>
	         Pemibimbing </td><td>$guru[0]</td></tr>
	         <tr>
	         <td>Mitra / DUDI</td><td>$mitradudi</td>
	         </tr>
	          <tr>
	         <td>Jadwal Pemberangkatan</td><td>" . $this->tanggal->hariLengkap($tgl, "/") . "</td>
	         </tr>
	         <tr>
	         <td>Pelaksanaan</td><td>$pelaksanaan</td>
	         </tr>
	           $poto
	          <tr>
	         <td colspan='2'><center> <a class='btn bg-teal' href='" . base_url() . "prodi/download_data_pkl/$dataMitra->id'>Download Data Siswa PKL</a></center> </td>
	         </tr>
	          
	         </table>";
	}
	function download_data_pkl($idmitra)
	{
		echo $this->mdl->download_data_pkl($idmitra);
	}


	function jadwal_pulang()
	{
		/////////////
		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$type = isset($_POST['type']) ? ($_POST['type']) : "";
		if ($type == 'fetch') {


			$events = array();
			$fetch = $this->db->query("SELECT * FROM tr_mitra_quota where id_tahun='$tahun' and (id_pembimbing!='' and id_pembimbing IS NOT NULL) ")->result();

			foreach ($fetch as $fetch) {
				$nama = $this->m_reff->goField("v_pegawai", "nama", "where id='" . $fetch->id_pembimbing . "' ");
				if ($fetch->sts_pulang) {
					$sts = "✔✔";
				} else {
					$sts = "";
				}
				$e = array();
				$e['id'] = $fetch->id;
				$e['id_mitra'] = $fetch->id_mitra;
				$e['id_pembimbing'] = $fetch->id_pembimbing;
				$e['sts'] = "plg";
				$e['title'] = $sts . $nama; //." | Rp.".number_format($fetch->honor,0,",","."); 
				$e['start'] = $fetch->tgl_pulang;
				$e['end'] =  $this->tanggal->tambah_tgl($fetch->tgl_pulang, 1);
				$e['backgroundColor'] = "red";
				$e['color'] = "green";
				//  $allday = ($fetch->allDay == "true") ? true : false;
				$e['allDay'] = "true";

				array_push($events, $e);
			}
			echo json_encode($events);
		}
	}



	function jadwalMonitoring($id)
	{
		$m = "monitoring" . $id;
		$stsm = "sts_m" . $id;
		/////////////
		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$type = isset($_POST['type']) ? ($_POST['type']) : "";
		if ($type == 'fetch') {


			$events = array();
			$fetch = $this->db->query("SELECT * FROM tr_mitra_quota  where (id_pembimbing!='' AND id_pembimbing IS NOT NULL ) and id_tahun='$tahun' ")->result();

			foreach ($fetch as $fetch) {
				$nama = $this->m_reff->goField("v_pegawai", "nama", "where id='" . $fetch->id_pembimbing . "' ");
				if ($fetch->$stsm) {
					$sts = "✔✔";
				} else {
					$sts = "";
				}
				$e = array();
				$e['id'] = $fetch->id;
				$e['id_mitra'] = $fetch->id_mitra;
				$e['id_pembimbing'] = $fetch->id_pembimbing;
				$e['sts'] = $m;
				$e['title'] = $sts . $nama; //." | Rp.".number_format($fetch->honor,0,",","."); 
				$e['start'] = $fetch->$m;
				$e['end'] =  $this->tanggal->tambah_tgl($fetch->$m, 1);
				$e['backgroundColor'] = "teal";
				//  $allday = ($fetch->allDay == "true") ? true : false;
				$e['allDay'] = "true";

				array_push($events, $e);
			}
			echo json_encode($events);
		}
	}
}
