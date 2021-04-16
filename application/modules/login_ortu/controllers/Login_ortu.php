<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_ortu extends CI_Controller {

	

	function __construct()
	{
		parent::__construct();	
			$this->load->model('M_login','mdl');
		date_default_timezone_set('Asia/Jakarta');
	}
	function sescaptcha($captcha)
	{
	$this->session->set_userdata(array("captcha"=>$captcha));
	}
	 function captcha()
	{
	$captcha=substr(str_shuffle("123456789"),0,5); // string yg akan diacak membentuk captcha 0-z dan sebanyak 6 karakter
	$this->sescaptcha($captcha);
	$gambar=ImageCreate(50,25); // ukuran kotak width=60 dan height=20
	$wk=ImageColorAllocate($gambar, 255, 255, 255); // membuat warna kotak -> Navajo White
	$wt=ImageColorAllocate($gambar, 71, 153, 153); // membuat warna tulisan -> Putih
	ImageFilledRectangle($gambar, 190, 776, 50, 120, $wk);
	ImageString($gambar, 10, 1, 3, $captcha, $wt);
	return ImageJPEG($gambar);
	}
	function _template($data)
	{
			$this->load->view('temp_login/main',$data);
	}
	function cek()
	{
	   echo sprintf("%05s", 4341);
	}
	public function index()
	{
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo	$this->load->view("index");
		}else{
			$data['title1']="Pendaftaran";
			$data['title2']="jika sudah buat akun silahkan <a href='".base_url()."daftar/login'>login</a>";
			$data['konten']="index";
			$this->_template($data);
		}
	}
	public function login()
	{
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo	$this->load->view("login");
		}else{
			$data['title1']="Login";
			$data['title2']="Jika belum punya akun silahkan untuk <a href='".base_url()."daftar'>mendaftar</a> terlebih dahulu";
			$data['konten']="login";
			$this->_template($data);
		}
	}
	
	function cekLogin()
	{
	$hasil=$this->mdl->cekLogin();
	echo json_encode($hasil);
	}
	
	public function add_data()
	{
		$data=$this->mdl->add();
		echo json_encode($data);
	}
	
	function ressetaja($id)
	{
	        	$kode=substr(str_shuffle("123456789"),0,5); // string yg akan  
	        	$this->db->where("id",$id);
	        	$this->db->set("password",md5($kode));
	        	$this->db->set("alias","li".$kode."il");
            	$this->db->update("tm_peserta");
            	return $kode;
	    
	}
	
	function resset()
	{
	    $email=$this->input->get_post("uemail");
	    $hp=$this->input->get_post("hp");
	    $this->db->where("email",trim($email));
	    $this->db->where("hp",trim($hp));
	    $cek=$this->db->get("tm_peserta");
	    if($cek->num_rows()==1)
	    {
	        $db=$cek->row();
	        $r=$this->ressetaja($db->id);
	        echo "<center>data akun anda:<br>
	        Username : ".$db->username." <br>
	        Password : ".$r."</center>"; 
	    }else{
	        echo "Email & No.Hp anda tidak cocok! silahkan hubungi CS kami.";
	    }
	     
	}
 public function logout()
	{
		$this->session->sess_destroy();
		redirect("login");
	}
}

