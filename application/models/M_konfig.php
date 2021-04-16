<?php

class m_konfig extends CI_Model
{


	function __construct()
	{
		parent::__construct();
	}
	function waktu_lalu($timestamp)
	{
		$selisih = time() - strtotime($timestamp);
		$detik = $selisih;
		$menit = round($selisih / 60);
		$jam = round($selisih / 3600);
		$hari = round($selisih / 86400);
		$minggu = round($selisih / 604800);
		$bulan = round($selisih / 2419200);
		$tahun = round($selisih / 29030400);
		if ($detik <= 60) {
			$waktu = $detik . ' detik yang lalu';
		} else if ($menit <= 60) {
			$waktu = $menit . ' menit yang lalu';
		} else if ($jam <= 24) {
			$waktu = $jam . ' jam yang lalu';
		} else if ($hari <= 7) {
			$waktu = $hari . ' hari yang lalu';
		} else if ($minggu <= 4) {
			$waktu = $minggu . ' minggu yang lalu';
		} else if ($bulan <= 12) {
			$waktu = $bulan . ' bulan yang lalu';
		} else {
			$waktu = $tahun . ' tahun yang lalu';
		}
		return $waktu;
	}
	///////////////////Golongan validasi
	function validasi_global()
	{
		$sesi = $this->session->userdata("level");
		if (!$sesi) {
			redirect("login/logout");
		}
	}
	function validasi_session($id)
	{
		$sesi = $this->session->userdata("level");
		$this->db->where_not_in("nama", $id);
		foreach ($this->getDataLevel() as $data) {
			if (strtolower($sesi) == strtolower($data->nama)) {
				redirect($data->direct);
			}
		}
		if (!$sesi) {
			redirect("login/logout");
		};
	}
	function validasi_login()
	{
		$this->db->order_by("id_level", "ASC");
		$db = $this->db->get("main_level")->result();
		$sesi = $this->session->userdata("level");
		foreach ($db as $data) {
			if ($sesi == $data->nama) {
				redirect($data->direct);
			}
		}
	}
	//-------------------------------------------------------------------------------------//
	function logMasuk($tabel, $aksi, $nama = null)
	{
		if ($nama == null) {
			$admin = $this->getAdminMasuk($id = $this->session->userdata("id"), $tabel);
			$nama = $admin->nama;
		};
		$id = $this->session->userdata("id");
		$this->_hapusLog();
		$data = array(
			"id_admin" => $id,
			"nama_user" => $nama,
			"table_updated" => $tabel,
			"aksi" => $aksi,
			"tgl" => date('Y-m-d H:i:s'),
		);
		return $this->db->insert("main_log", $data);
	}


	function getAdminMasuk($id, $tabel)
	{
		return $this->db->get_where($tabel, array("id" => $id))->row();
	}


	function jmlLog()
	{
		return $this->db->get("main_log")->num_rows();
	}

	private function _hapusLog()
	{
		$jmlLog = $this->jmlLog();
		$batasLog = $this->konfigurasi(7);
		if ($batasLog < $jmlLog) {
			return $this->db->query("DELETE FROM main_log LIMIT 2 ");
		}
	}
	function getAdmin($id)
	{
		$this->load->model("m_profile", "profile");
		$data = $this->profile->dataProfile($id);
		return $data;
	}

	function getOwner($id, $getTable)
	{
		$this->db->where("id", $id);
		$this->db->select("nama as owner");
		return $this->db->get($getTable)->row();
	}
	function log($tabel, $aksi, $getTable = null)
	{
		$idu = $this->session->userdata("id");
		if ($getTable == null) {
			$admin = $this->getAdmin($idu);
		} else {
			$admin = $this->getOwner($idu, $getTable);
		}
		$this->_hapusLog();
		$data = array(
			"id_admin" => $idu,
			"nama_user" => $admin->owner,
			"table_updated" => $tabel,
			"aksi" => $aksi,
			"tgl" => date('Y-m-d H:i:s'),
		);
		return $this->db->insert("main_log", $data);
	}
	function konfigurasi($id)
	{
		$data = $this->db->query("SELECT value FROM main_konfig WHERE id_konfig='$id'")->row();
		return $data->value;
	}
	function dataKonfig($id)
	{
		$data = $this->db->get_where("main_konfig", array("id_konfig" => $id))->row();
		return $data->value;
	}
	function maxMenu()
	{
		$db = $this->db->query("select MAX(id_menu) as max from main_menu")->row();
		return $db->max + 1;
	}

	function getDataLevel()
	{
		$this->db->order_by("id_level", "ASC");
		return $this->db->get("main_level")->result();
	}

	function getIdLevel($id) //id_level
	{
		$this->db->where("nama", $id);
		$data = $this->db->get("main_level")->row();
		return $data->id_level;
	}
	function getNamaUG($id)
	{
		$this->db->where("id_level", $id);
		$data = $this->db->get("main_level")->row();
		return strtoupper($data->nama);
	}
	function namaAplikasi()
	{
		$this->db->where("id_pengaturan", "3");
		$data = $this->db->get("pengaturan")->row();
		return isset($data->val) ? ($data->val) : "";
	}
	function headerText()
	{
		$ID = $this->session->userdata("id");
		$this->db->where("ID", $ID);
		$data = $this->db->get("pbk_groups")->row();
		$datax = isset($data->Name) ? ($data->Name) : "0";
		if ($datax) {
			return $data->Name;
		} else {
			return $this->namaAplikasi();
		}
	}
	function kodeAkun()
	{
		$ID = $this->session->userdata("id");
		$this->db->where("ID", $ID);
		$data = $this->db->get("pbk_groups")->row();
		return isset($data->key) ? ($data->key) : "";
	}

	function kodeApi()
	{
		$ID = $this->session->userdata("id");
		$this->db->where("id_admin", $ID);
		$data = $this->db->get("admin")->row();
		return isset($data->key) ? ($data->key) : "";
	}

	function nomorBlokir()
	{
		$ID = $this->session->userdata("id");
		$this->db->where("ID", $ID);
		$data = $this->db->get("pbk_groups")->row();
		return isset($data->blokir) ? ($data->blokir) : "";
	}

	function jmlSMSskrg($id)
	{
		$this->db->where("CreatorID", $id);
		$data = $this->db->get("inbox")->num_rows();
		return $data;
	}

	function smsReg()
	{
		$ID = $this->session->userdata("id");
		$this->db->where("ID", $ID);
		$data = $this->db->get("pbk_groups")->row();
		return $data->sms_reg;
	}

	function no_center()
	{
		$ID = $this->session->userdata("id");
		$this->db->where("ID", $ID);
		$data = $this->db->get("pbk_groups")->row();
		return $data->no_center;
	}
	function batasInbox()
	{
		$this->m_konfig->validasi_session(array("user", "admin"));
		$id = $this->session->userdata("id");
		$this->db->where("ID", $id);
		$data = $this->db->get("pbk_groups")->row();
		echo $data->batas_inbox;
	}
	function batasOutbox()
	{
		$this->m_konfig->validasi_session(array("user", "admin"));
		$id = $this->session->userdata("id");
		$this->db->where("ID", $id);
		$data = $this->db->get("pbk_groups")->row();
		echo $data->batas_outbox;
	}
	function smsUnReg()
	{
		$ID = $this->session->userdata("id");
		$this->db->where("ID", $ID);
		$data = $this->db->get("pbk_groups")->row();
		return $data->sms_unreg;
	}
	function getTitle()
	{
		$ID = $this->session->userdata("id");
		$this->db->where("ID", $ID);
		$this->db->select("title");
		$data = $this->db->get("pbk_groups")->row();
		$title = explode("_:|:_", $data->title);
		$no = 2;
		$kode = "";
		foreach ($title as $title) {
			$kode .= $title . "#";
		}
		echo substr($kode, 0, -1);
	}


	function namaSub($id)
	{
		$this->db->where("id", $id);
		$data = $this->db->get("sub_group")->row();
		return isset($data->nama_sub_group) ? ($data->nama_sub_group) : "";
	}

	//START-CODE ROBI
	function get_provinsi()
	{
		$d = $this->db->get("wil_provinsi")->result();
		return $d;
	}
	function get_kota_ajax()
	{

		$idk = $this->input->post("idk");
		$this->db->where("id_prov", $idk);
		$value = $this->input->post("val");
		$sts = $this->db->get("wil_kabupaten")->result();
		$ray = array();
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id_kab] = $val->nama;
		}
		echo form_dropdown("f[id_kab]", $ray, $value, 'required class="form-control col-md-12 show-tick" data-live-search="true" onchange="get_kecamatan(this.value)" ');
		echo "<script>$('select').selectpicker();</script>";
	}
	function get_kecamatan_ajax()
	{

		$idk = $this->input->post("idk");
		$this->db->where("id_kab", $idk);
		$value = $this->input->post("val");
		$sts = $this->db->get("wil_kecamatan")->result();
		$ray = array();
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id_kec] = $val->nama;
		}
		echo form_dropdown("f[id_kec]", $ray, $value, 'required class="form-control col-md-12 show-tick" data-live-search="true" onchange="get_kelurahan(this.value)" ');
		echo "<script>$('select').selectpicker();</script>";
	}
	function get_kelurahan_ajax()
	{

		$idk = $this->input->post("idk");
		$this->db->where("id_kec", $idk);
		$value = $this->input->post("val");
		$sts = $this->db->get("wil_kelurahan")->result();
		$ray = array();
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id_kel] = $val->nama;
		}
		echo form_dropdown("f[id_kel]", $ray, $value, 'required class="form-control col-md-12 show-tick" data-live-search="true" ');
		echo "<script>$('select').selectpicker();</script>";
	}
	//END-CODE ROBI

}
