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
		$catt = $this->m_reff->goField("tm_absen_guru", "cpembelajaran", "where id_jadwal='" . $id_jadwal . "' and SUBSTR(tgl,1,10)='" . date("Y-m-d") . "' ");


		echo "<center>
	 <div class='col-md-12'>&nbsp;</div>	
	<div class='col-md-12' >
		  <button class='btn bg-pink btn-block   clasmo2 sadow font-bold' onclick='absen(`" . $id_kelas . "`,`" . $id_jadwal . "`)'> <i class='material-icons'>accessibility</i> Absen Siswa</button> 
	</div>
	   
	 
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
		echo " <div class='col-md-12'>&nbsp;</div>	
		<div class='col-md-12 '  ><textarea placeholder='Pembahasan...' name='catatan' class='form-control' onclick='tulis()'  >" . $catt . "</textarea> 
		<center><button class='btn waves-effect bg-teal' style='margin-top:10px' onclick='catt()'>SIMPAN</button></center>
		</div>";
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

	function absen_siswa()
	{
		$this->load->view("absen_siswa");
	}
	function guruMasuk()
	{
		echo $this->mdl->guruMasuk();
	}
	function getRekap()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {


			////
			$nama = $this->m_reff->goField("data_siswa", "nama", "where id='" . $dataDB->id . "' ");
			$tombol = '      
              
                                    <button type="button" class="btn bg-teal waves-effect" onclick="absen_siswa(`' . $dataDB->id_kelas . '`,`' . $dataDB->id_jadwal . '`,`' . substr($dataDB->tgl, 0, 10) . '`,`' . $dataDB->id_mapel . '`)">
                                        Absen Siswa 
                                    </button>
                                    ';
			$vv = $this->db->get_where("v_materi", array("id" => $dataDB->id_materi))->row();
			$kd3_no = isset($vv->kd3_no) ? ($vv->kd3_no) : "";
			$kd3_desc = isset($vv->kd3_desc) ? ($vv->kd3_desc) : "";
			$kd4_no = isset($vv->kd4_no) ? ($vv->kd4_no) : "";
			$kd4_desc = isset($vv->kd4_desc) ? ($vv->kd4_desc) : "";
			$row = array();
			$row[] = $tombol;
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>  " . $this->tanggal->hariLengkap(substr($dataDB->tgl, 0, 10), "/") . " </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . " </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("v_materi", "mapel", "where id='" . $dataDB->id_materi . "'") . " </span>";
			$row[] = "<span class='size'>  " . $kd3_no . " - " . $kd3_desc . " <br> " . $kd4_no . " - " . $kd4_desc . " </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("tm_materi", "materi", "where id='" . $dataDB->id_materi . "'") . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->cpembelajaran . " </span>";

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
		$this->db->where("id_materi!=", "");
		$datax = $this->db->get("tm_absen_guru")->row();
		if ($datax) {
			$data = $this->db->query("select * from v_materi where id='" . $datax->id_materi . "'")->row();
			$materi = isset($data->materi) ? ($data->materi) : "";
			$kd3_no = isset($data->kd3_no) ? ($data->kd3_no) : "";
			$kd3_desc = isset($data->kd3_desc) ? ($data->kd3_desc) : "";
			$kd4_no = isset($data->kd4_no) ? ($data->kd4_no) : "";
			$kd4_desc = isset($data->kd4_desc) ? ($data->kd4_desc) : "";
			$kikd = $kd3_no . " - " . $kd3_desc . "<br>" . $kd4_no . " - " . $kd4_desc;

			echo "<table class='entry' width='100%'><tr>";
			echo "<td>Hari</td><td>:</td><td>" . $this->tanggal->hariLengkap(substr($datax->tgl, 0, 10), "/") . "</td></tr>";
			echo "<tr><td>KIKD</td><td>:</td><td>" . $kikd . "</td></tr>";
			echo "<tr><td>Materi</td><td>:</td><td>" . $materi . "</td></tr>";
			echo "<tr><td>Pembahasan</td><td>:</td><td>" . $datax->cpembelajaran . "</td></tr>";
			echo "</tr></table>";
		} else {
			echo "<b><center>Pembelajaran baru dimulai belum ada history</center></b>";
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
