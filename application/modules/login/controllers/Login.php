<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'mdl');
		$this->load->model('M_sms', 'sms');
		date_default_timezone_set('Asia/Jakarta');
	}
	function sescaptcha($captcha)
	{
		$this->session->set_userdata(array("captcha" => $captcha));
	}
	function captcha()
	{
		$captcha = substr(str_shuffle("123456789"), 0, 5); // string yg akan diacak membentuk captcha 0-z dan sebanyak 6 karakter
		$this->sescaptcha($captcha);
		$gambar = ImageCreate(50, 25); // ukuran kotak width=60 dan height=20
		$wk = ImageColorAllocate($gambar, 255, 255, 255); // membuat warna kotak -> Navajo White
		$wt = ImageColorAllocate($gambar, 71, 153, 153); // membuat warna tulisan -> Putih
		ImageFilledRectangle($gambar, 190, 776, 50, 120, $wk);
		ImageString($gambar, 10, 1, 3, $captcha, $wt);
		return ImageJPEG($gambar);
	}
	function _template()
	{
		$this->load->view('temp_login/main');
	}
	function cek()
	{
		echo sprintf("%05s", 4341);
	}
	function otomatis()
	{
		$deviceID = $this->input->get("id");
		$hasil = $this->mdl->cekLoginOtomatis($deviceID);
		if ($hasil["validasi"] == true) {
			redirect("login?versi=600");
		} else {
			redirect("login/logout");
		}
	}
	public function index()
	{

		$this->_template();
	}



	function cekLogin()
	{
		$hasil = $this->mdl->cekLogin();
		echo json_encode($hasil);
	}

	public function add_data()
	{
		$data = $this->mdl->add();
		echo json_encode($data);
	}

	function ressetaja($hp, $tbl, $id)
	{
		$kode = substr(str_shuffle("123456789"), 0, 5); // string yg akan  
		$this->db->where("id", $id);
		$data = $this->db->get($tbl)->row();
		$pass = substr($data->alias, 2, 100);
		$pass = substr($pass, 0, -2);
		$pesan = "[SMK BK SUBANG]: Username :" . $data->username . " , Password :" . $pass;
		$modem = "";
		$source = "resset_password";
		return     $this->sms->_kirimSms($hp, $pesan, $modem, $id, $source);
	}

	function resset()
	{

		$hp = $this->input->get_post("hp");
		$hp = trim($hp);
		$hp = substr($hp, 1, 9);

		$cek_siswa = $this->db->query("select * from data_siswa where hp like '%" . $hp . "%' ");
		$cek_ortu = $this->db->query("select * from data_ortu where hp_ibu like '%" . $hp . "%' or hp_ayah like '%" . $hp . "%' ");
		$cek_guru = $this->db->query("select * from data_pegawai where hp like '%" . $hp . "%' ");

		if ($cek_siswa->num_rows() == 1) {
			$db = $cek_siswa->row();
			$r = $this->ressetaja($db->hp, "data_siswa", $db->id);
			echo "<center>Data Akun anda telah kami kirim via SMS ke nomor " . $db->hp . ", mohon periksa Kotak masuk anda.</center>";
		} elseif ($cek_ortu->num_rows() == 1) {
			$db = $cek_ortu->row();
			$r = $this->ressetaja($db->hp_ibu, "data_ortu", $db->id);
			echo "<center>Data Akun anda telah kami kirim via SMS ke nomor " . $db->hp_ibu . ", mohon periksa Kotak masuk anda.</center>";
		} elseif ($cek_guru->num_rows() == 1) {
			$db = $cek_guru->row();
			$r = $this->ressetaja($db->hp, "data_pegawai", $db->id);
			echo "<center>Data Akun anda telah kami kirim via SMS ke nomor " . $db->hp . ", mohon periksa Kotak masuk anda.</center>";
		} else {
			echo "No.Hp anda tidak cocok! silahkan hubungi CS kami.";
		}
	}
	public function logout()
	{
		$this->m_reff->resset_device();
		$this->session->sess_destroy();
		redirect("login");
	}
	public function logout_ortu()
	{
		$this->m_reff->resset_device();
		$this->session->sess_destroy();
		redirect("login_ortu");
	}
}
