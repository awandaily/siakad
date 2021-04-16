<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kbm extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("model", "mdl");
		$this->load->model("m_sms", "sms");
		date_default_timezone_set('Asia/Jakarta');
	}
	function insert_tugas()
	{
		$echo = $this->mdl->insert_tugas();
		echo json_encode($echo);
	}
	function getSumber()
	{
		$sumber = $this->input->post("id");
		$idguru = $this->mdl->idu();
		$idmapel = $this->input->post("idMapel");
		$idjadwal = $this->input->post("idJadwal");
		$idkelas = $this->input->post("idkelas");
		$idhari = $this->input->post("idhari");
		$data["idmapel"] = $idmapel;
		$data["idkelas"] = $idkelas;
		$data["idguru"] = $idguru;
		$data["idjadwal"] = $idjadwal;
		if ($sumber == 1) {

			$pengaturanAbsen = $this->m_reff->pengaturan(21);
			if ($pengaturanAbsen == "ya") {
				$ids = $this->m_reff->goField("data_pegawai", "nip", "where id='" . $this->mdl->idu() . "' ");
				$cekfinger = $this->mdl->cekfinger($ids);
				if (!$cekfinger) {
					echo "<div class='card'><br><center><i>Anda belum melakukan absen fingerprint</i></center></div>";
					return false;
				}
			}
		}
		if ($sumber == 2) {
			$this->load->view('kirim_tugas', $data);
		}
		if ($sumber == 3) {
			$this->load->view('form_izin', $data);
		}
	}
	function insert_izin()
	{
		echo $this->mdl->insert_izin();
	}
	function addSumber()
	{
		$id = $this->input->post("id");
		$idguru = $this->mdl->idu();
		$idmapel = $this->input->post("idMapel");
		$idjadwal = $this->input->post("idJadwal");
		$idkelas = $this->input->post("idKelas");
		$jam = $this->input->post("jam");
		$izin = $this->input->post("izin");

		echo $this->mdl->addSumber($id, $idguru, $idmapel, $idjadwal, $idkelas, $jam, $izin);
	}
	function addSumberNotRealtime()
	{

		$idguru = $this->mdl->idu();
		$idmapel = $this->input->post("idMapel");
		$idjadwal = $this->input->post("idJadwal");
		$idkelas = $this->input->post("idKelas");
		$jam = $this->input->post("jam");

		$data["idGuru"] = $idguru;
		$data["id_mapel"] = $idmapel;
		$data["id_jadwal"] = $idjadwal;
		$data["id_kelas"] = $idkelas;
		$data["jam"] = $jam;
		$data["data_jam"] = $jam;

		echo   $this->load->view("opsi_realtime", $data);
		// echo $this->mdl->addSumberNotRealtime($id,$idguru,$idmapel,$idjadwal,$idkelas,$jam,$izin);
	}
	function _template($data)
	{
		$this->load->view('template/main', $data);
	}
	function awalmula()
	{
		$idguru = $this->mdl->idu();
		$idmapel = $this->input->post("idMapel");
		$idjadwal = $this->input->post("idJadwal");
		$idkelas = $this->input->post("idKelas");
		$jam = $this->input->post("jam");
		$data_jam = $this->input->post("data_jam");
		$data["data_jam"] = $data_jam;
		$data["id_guru"] = $idguru;
		$data["id_mapel"] = $idmapel;
		$data["id_jadwal"] = $idjadwal;
		$data["id_kelas"] = $idkelas;
		$data["jam"] = $jam;
		$data["data_jam"] = $jam;

		$index = "input_agenda";


		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index, $data);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	public function index()
	{
		$set = $this->m_reff->pengaturan(22);
		if ($set == "ya") {
			$index = "index";
		} elseif ($set == "costume") {
			$index = "costume";
		} else {
			$index = "realtime";
		}


		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	public function rekap()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("rekap");
		} else {
			$data['konten'] = "rekap";
			$this->_template($data);
		}
	}

	function getMenuKbm()
	{

		$id_materi = $this->input->post("id_materi");
		$id_kelas = $this->input->post("idkelas");
		$id_jadwal = $this->input->post("id_jadwal");
		//	$catt=$this->m_reff->goField("tm_absen_guru","cpembelajaran","where id_jadwal='".$id_jadwal."' and SUBSTR(tgl,1,10)='".date("Y-m-d")."' ");


		echo "<center>
	

		  <button class='btn bg-teal btn-block col-md-6 col-xs-12   sadow font-bold' onclick='absenSiswaReady(`" . $id_kelas . "`,`" . $id_jadwal . "`)'> <i class='material-icons'>accessibility</i> Absen Siswa</button> 
 
		  <button class='btn bg-purple btn-block col-md-6 col-xs-12   sadow font-bold' onclick='getBahanAjar(`" . $id_jadwal . "`)'> <i class='material-icons'>book</i> Materi</button> 
	
	   
	 
		  </center>";

		$db = $this->db->get_where("tm_bahan_ajar", array("id_materi" => $id_materi))->result();
		if ($db) {
			echo " <div class='col-md-12'>&nbsp;</div>	<div align='center' class='col-md-12'  > ";
			foreach ($db as $val) {
				echo "<span class=' col-md-4' >
			<a class=' font-underline waves-effect '  href='" . $val->file . "' target='new'>   " . $val->nama . "</a></span>";
			}
			echo "</div>";
		}
		//	echo " <div class='col-md-12'>&nbsp;</div>	
		//	<div class='col-md-12 hide '  ><textarea placeholder='Pembahasan...' name='catatan' class='form-control' onclick='tulis()'  >".$catt."</textarea> 
		//	<center><button class='btn waves-effect bg-teal' style='margin-top:10px' onclick='catt()'>SIMPAN</button></center>
		//	</div>";


	}
	function insertCatatan()
	{
		echo $this->mdl->insertCatatan();
	}
	function siswaMasuk()
	{
		$id_jadwal = $this->input->post("idjadwal");
		echo $this->mdl->siswaMasuk();
		$idkelas = $this->m_reff->goField("tm_penjadwalan", "id_kelas", "where id='" . $id_jadwal . "' ");
		$this->mdl->update_ketidakhadiran($idkelas);
	}
	function getDataSiswa()
	{
		$this->load->view("getDataSiswa");
	}
	function hapus_kbm()
	{
		echo $this->mdl->hapus_kbm();
	}
	function absen_siswa()
	{
		$this->load->view("absen_siswa");
	}
	function guruMasuk()
	{
		echo $this->mdl->guruMasuk();
	}
	function edit_rekap()
	{
		$id = $this->input->post("id");
		$this->db->where("id", $id);
		$dt = $this->db->get("tm_absen_guru")->row();

		$this->db->where("id_tahun", $dt->id_tahun);
		$this->db->where("id_semester", $dt->id_semester);
		$this->db->where("id_kelas", $dt->id_kelas);
		$this->db->where("id_guru", $dt->id_guru);
		$this->db->where("id_mapel", $dt->id_mapel);
		//$this->db->where("id", $dt->id_kikd);
		//$this->db->where("kd3_no", $dt->kode_kd);
		$kikd = $this->db->get("v_kikd")->result();




		$dtkikd = $this->db->query("SELECT * FROM `v_kikd` WHERE `id_tahun` = '" . $dt->id_tahun . "' AND `id_semester` = '" . $dt->id_semester . "' AND `id_guru` = '" . $dt->id_guru . "' 
		AND `id_mapel` = '" . $dt->id_mapel . "' AND `id_kelas` = '" . $dt->id_kelas . "' AND `kd3_kb` >0 ORDER BY CAST(SUBSTR(kd3_no  , 3  , 5) AS SIGNED INTEGER) ASC");
		if (!$dtkikd->num_rows()) {
			$id_guru = $dt->id_guru;
			$this->m_reff->isi_kikd($dt->id_tahun, $dt->id_semester, $dt->id_kelas, $dt->id_mapel, $id_guru);
		}







		$data["data"] = $dt;
		$data["kikd"] = $kikd;
		echo $this->load->view("edit_rekap", $data);
	}
	function update_rekap()
	{
		$data = $this->mdl->update_rekap();
		echo json_encode($data);
	}
	function getRekap()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$date = date("Y-m-d");
		foreach ($list as $dataDB) {

			if (substr($dataDB->tgl, 0, 10) != $date) {
				$disable = "disabled";
			} else {
				$disable = "";
			}
			////
			$nama = $this->m_reff->goField("data_siswa", "nama", "where id='" . $dataDB->id . "' ");
			$hapus = '       
                                    <button type="button" ' . $disable . ' class="btn btn-default btn-circle waves-effect waves-circle waves-float" onclick="hapus(`' . $dataDB->id . '`)" title="Delete">
                                        <i class="material-icons">delete_forever</i> 
                                    </button>
                                    <button type="button" ' . $disable . ' class="btn btn-default btn-circle waves-effect waves-circle waves-float" onclick="edit(`' . $dataDB->id . '`)" title="Edit">
                                        <i class="material-icons">border_color</i> 
                                    </button>
                                    ';
			$tombol = '       
                                    <button type="button" ' . $disable . ' class="btn bg-teal waves-effect" onclick="absen_siswa_rekap(`' . $dataDB->id_kelas . '`,`' . $dataDB->id_jadwal . '`,`' . substr($dataDB->tgl, 0, 10) . '`,`' . $dataDB->id_mapel . '`)">
                                        Absen Siswa 
                                    </button>
                                    ';
			$vv = $this->db->get_where("v_materi", array("id" => $dataDB->id_materi))->row();
			$kd3_no = isset($vv->kd3_no) ? ($vv->kd3_no) : "";
			$kd3_desc = isset($vv->kd3_desc) ? ($vv->kd3_desc) : "";
			$kd4_no = isset($vv->kd4_no) ? ($vv->kd4_no) : "";
			$kd4_desc = isset($vv->kd4_desc) ? ($vv->kd4_desc) : "";

			if ($dataDB->sumber == 2) {
				$ket = "<i class='col-pink'>Kirim Tugas</i>";
			} elseif ($dataDB->sumber == 3) {
				$ket = "<i class='col-pink'>Izin : $dataDB->izin </i>";
			} else {
				$ket = $dataDB->cpembelajaran;
			}

			$row = array();
			$row[] = $hapus;
			$row[] = $tombol;
			///$row[] = "<span class='size'>".$no++."</span>";	
			$row[] = "<span class='size'>  " . $this->tanggal->hariLengkap(substr($dataDB->tgl, 0, 10), "/") . " </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . " </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $dataDB->id_mapel . "'") . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->kode_kd . "</span>";
			//	$row[] = "<span class='size'>  ".$this->m_reff->goField("tm_materi","materi","where id='".$dataDB->id_materi."'")." </span>";
			$row[] = "<span class='size'>  " . $ket . " </span>";

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
	function getHistory()
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();

		$idjadwal = $this->input->post("id_jadwal");
		$jam = $this->m_reff->goField("v_jadwal", "jam", "where id='" . $idjadwal . "'");
		$id_kelas = $this->input->post("id_kelas");
		$id_mapel = $this->input->post("id_mapel");
		//	$this->db->where("jam",$jam);
		$this->db->where("id_guru", $this->mdl->idu());
		$this->db->where("id_semester", $sms);
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_kelas", $id_kelas);
		$this->db->where("id_mapel", $id_mapel);
		$this->db->order_by("tgl", "DESC");
		$this->db->limit("1");
		$this->db->where("SUBSTR(tgl,1,10)!=", date('Y-m-d'));
		//	 $this->db->where("id_materi!=","");
		$datax = $this->db->get("tm_absen_guru")->row();
		if ($datax) {
			$data = $this->db->query("select * from tm_kikd where id='" . $datax->id_kikd . "'")->row();
			$materi = isset($data->materi) ? ($data->materi) : "";
			$kd3_no = isset($data->kd3_no) ? ($data->kd3_no) : "";
			$kd3_desc = isset($data->kd3_desc) ? ($data->kd3_desc) : "";
			$kd4_no = isset($data->kd4_no) ? ($data->kd4_no) : "";
			$kd4_desc = isset($data->kd4_desc) ? ($data->kd4_desc) : "";
			$kikd = $kd3_no . " - " . $kd3_desc . "<br>" . $kd4_no . " - " . $kd4_desc;
			$getAlfa4 = $this->mdl->getSiswaAlfa($idjadwal, $datax->tgl, 4);
			$getAlfa5 = $this->mdl->getSiswaAlfa($idjadwal, $datax->tgl, 5);
			$getAlfa2 = $this->mdl->getSiswaAlfa($idjadwal, $datax->tgl, 2);
			$getAlfa3 = $this->mdl->getSiswaAlfa($idjadwal, $datax->tgl, 3);
			echo "<table class='entry' width='100%'><tr>";
			echo "<td>Hari</td><td>:</td><td>" . $this->tanggal->hariLengkap(substr($datax->tgl, 0, 10), "/") . "</td></tr>";
			echo "<tr><td>KIKD</td><td>:</td><td>" . $kikd . "</td></tr>";
			//	echo "<tr><td>Materi</td><td>:</td><td>".$materi."</td></tr>";
			echo "<tr><td>Pembahasan</td><td>:</td><td>" . $datax->cpembelajaran . "</td></tr>";
			echo "<tr><td>  Alfa</td><td>:</td><td>" . $getAlfa4 . "</td></tr>";
			echo "<tr><td>  Bolos</td><td>:</td><td>" . $getAlfa5 . "</td></tr>";
			echo "<tr><td>  Sakit</td><td>:</td><td>" . $getAlfa2 . "</td></tr>";
			echo "<tr><td>  izin</td><td>:</td><td>" . $getAlfa3 . "</td></tr>";
			echo "</tr></table>";
		} else {
			echo "<b><center>Pembelajaran baru dimulai belum ada history</center></b>";
		}
	}

	function getBahanAjar()
	{
		$id_mapel = $this->input->post("id_mapel");
		$data = $this->db->query("SELECT * from tm_bahan_ajar where id_mapel='" . $id_mapel . "' and id_guru='" . $this->idu() . "' ")->result();
		$i = 1;
		echo "<table class='entry' width='100%'><tr><td>NO</td><td>FILE MATERI</td><td>DOWNLOAD</td></tr>";
		foreach ($data as $val) {
			echo "<tr>";
			echo "<td>" . $i++ . "</td><td>" . $val->nama . "</td><td><a href='" . base_url() . $val->file . "?download=true' download class='btn bg-teal btn-mini'>DOWNLOAD </a></td></tr>";
		}
		echo "</table>";
	}



	function _getDataKikd($idkikd)
	{
		$db = $this->db->query("select code from tm_kikd where id='" . $idkikd . "' ")->row();
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->where("id_guru", $this->idu());
		$this->db->where("id_semester", $sms);
		$this->db->where("id_tahun", $tahun);
		$this->db->where("code", $db->code);
		return	$this->db->get("tm_kikd")->result();
	}
	function insertMateriBaru()
	{
		return false;
		$code = $this->idu() . substr(str_shuffle("abcdefghijklmnop123456789"), 0, 8);
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		//	$post=$this->input->post("f");
		$idkikd = $this->input->get_post("id_kikd");
		$id_materi = $this->input->get_post("id_materi"); //untuk edit
		$materi = $this->input->post("materi");
		$id_jadwal = $this->input->post("id_jadwal");
		$cekHariNow = $this->db->query("select * from tm_absen_guru where id_jadwal='" . $id_jadwal . "' and substr(tgl,1,10)='" . date('Y-m-d') . "' ")->row();
		if (isset($cekHariNow->id)) {
			$cek = $this->db->query("select * from tm_materi where id_guru='" . $this->idu() . "' and id_kikd='" . $idkikd . "' and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' and LOWER(materi)='" . trim(strtolower($materi)) . "' order by id desc")->row();
			if (isset($cek->id)) {
				$idm = $cek->id;
			} else {
				if (!$id_materi) {
					$datax = $this->_getDataKikd($idkikd);
					foreach ($datax as $val) {
						$this->db->set("id_guru", $this->idu());
						$this->db->set("_cid", $this->idu());
						$this->db->set("id_semester", $sms);
						$this->db->set("id_tahun", $tahun);
						$this->db->set("id_kikd", $val->id);
						$this->db->set("materi", trim($materi));
						$this->db->set("code", $code);
						$this->db->insert("tm_materi");
					}
				} else {
					$code = $this->m_reff->goField("tm_materi", "code", "where id='" . $id_materi . "'");
					$datax = $this->_getDataKikd($idkikd);
					foreach ($datax as $val) {
						$this->db->where("id_guru", $this->idu());
						$this->db->where("_cid", $this->idu());
						$this->db->where("id_semester", $sms);
						$this->db->where("id_tahun", $tahun);
						$this->db->where("id_kikd", $val->id);
						$this->db->set("materi", trim($materi));
						$this->db->where("code", $code);
						$this->db->update("tm_materi");
					}
				}
				$cek = $this->db->query("select * from tm_materi where id_guru='" . $this->idu() . "' and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' and code='" . $code . "' and id_kikd='" . $idkikd . "' order by id desc ")->row();
				$idm = isset($cek->id) ? ($cek->id) : "";
			}

			$this->db->query("UPDATE tm_absen_guru set cpembelajaran='" . $materi . "', id_materi='" . $idm . "' where id='" . $cekHariNow->id . "' ");
			echo $idm;
			return false;
		};


		$cek = $this->db->query("select * from tm_materi where id_guru='" . $this->idu() . "' and id_kikd='" . $idkikd . "' and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' and LOWER(materi)='" . trim(strtolower($materi)) . "' order by id desc")->row();
		if (isset($cek->id)) {
			echo $cek->id;
			return false;
		}

		$datax = $this->_getDataKikd($idkikd);
		foreach ($datax as $val) {
			$this->db->set("id_guru", $this->idu());
			$this->db->set("_cid", $this->idu());
			$this->db->set("id_semester", $sms);
			$this->db->set("id_tahun", $tahun);
			$this->db->set("id_kikd", $val->id);
			$this->db->set("materi", trim($materi));
			$this->db->set("code", $code);
			$this->db->insert("tm_materi");
		}
		$cek = $this->db->query("select * from tm_materi where id_guru='" . $this->idu() . "' and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' and code='" . $code . "' and id_kikd='" . $idkikd . "' order by id desc ")->row();
		echo isset($cek->id) ? ($cek->id) : "";
	}
	function getMateriNow()
	{

		$idmapel = $this->input->post("idmapel");
		$idkelas = $this->input->post("idkelas");
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$id_kikd = $this->input->post("id_kikd");
		$id_materi = $this->input->post("id_materi");
		$id_mapel = $this->input->post("id_mapel");
		$id_kelas = $this->input->post("id_kelas");

		$id_jadwal = $this->input->post("id_jadwal");


		$cek = $this->db->query("select * from tm_absen_guru where id_jadwal='" . $id_jadwal . "' and substr(tgl,1,10)='" . date('Y-m-d') . "' ")->row();
		if (isset($cek->id)) {
			$var["id"] = $cek->id_materi;
			$var["materi"] = $cek->cpembelajaran;
			echo json_encode($var);
		} else {
			$cek = $this->db->query("select * from tm_materi where id_guru='" . $this->idu() . "'
		    	and id_kikd='" . $id_kikd . "' and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' order by id desc")->row();
			if (isset($cek->id)) {
				$var["id"] = $cek->id;
				$var["materi"] = $cek->materi;
				echo json_encode($var);
			}
		}
	}
	function getDropdownMateri()
	{
		$kikd = $this->input->post("kikd");
		$idmapel = $this->input->post("idmapel");
		$idkelas = $this->input->post("idkelas");
		$dataMateri = $this->mdl->getMateri($idkelas, $idmapel, $kikd);

		$vis = $this->db->query("select * from tm_absen_guru where id_kelas='" . $idkelas . "'
		and id_mapel='" . $idmapel . "' and id_guru='" . $this->mdl->idu() . "' and substr(tgl,1,10)='" . date('Y-m-d') . "'")->row();
		$value = isset($vis->id_materi) ? ($vis->id_materi) : "";
		//	if(!$value){
		$dataray[] = "=== Pilih Materi ===";
		//	};
		foreach ($dataMateri as $val) {
			$dataray[$val->id] = $val->materi;
		}
		$dataray["create"] = "+ Input Materi Baru";
		$ray = $dataray;

		//	 $var["menu"]="<textarea name='id_materi' class='form-control  clasmo'  onchange='ready()'></textarea>";
		$var["menu"] = form_dropdown("id_materi", $ray, $value, "class='form-control  clasmo'  onchange='ready()' ");
		$var["status"] = $value;
		echo json_encode($var);
	}
	function idu()
	{
		return $this->mdl->idu();
	}
	function cekMateri()
	{
		echo 1;
		return true;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();

		$kikd = $this->input->post("kikd");
		$idmapel = $this->input->post("idmapel");
		$idkelas = $this->input->post("idkelas");
		$database = $this->db->query("SELECT id FROM v_kikd WHERE id_guru='" . $this->mdl->idu() . "'  AND id_kelas='" . $idkelas . "' AND id_tahun='" . $tahun . "' AND id_semester='" . $sms . "' 
		AND id_mapel='" . $idmapel . "' AND id!='" . $kikd . "' ORDER BY kd3_no ASC LIMIT 1")->row();

		$kikd_sebelumnya = isset($database->id) ? ($database->id) : "";
		if ($kikd_sebelumnya > $kikd) {
			echo 1;
			return true;
		}

		if (!$kikd_sebelumnya) {
			echo 1;
			return true;
		}
		$this->db->where("id_kikd", $kikd_sebelumnya);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_guru", $this->idu());
		echo $this->db->get("data_nilai")->num_rows();
	}

	function kirim_catatan()
	{
		echo $this->mdl->kirim_catatan();
	}
}
