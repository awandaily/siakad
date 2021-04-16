<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	

	function __construct()
	{
		parent::__construct();	
		$this->load->model("Model","mdl");
		date_default_timezone_set('Asia/Jakarta');
	
	}
	 
	function _templatemain($data)
	{
		$this->load->view('blog/tempmain',$data);	
	}
	function _templatepage($data)
	{
		$this->load->view('blog/temppage',$data);	
	}
	 
	public function index()
	{
		//$data['title1']="Pendaftaran";
		//$data['title2']="jika sudah buat akun silahkan <a href='".base_url()."login'>login</a>";
		$data['konten']="blog/page/main";
		$this->_templatemain($data);
	}
	
	public function persyaratan()
	{
		$data['title1']="Persyaratan";
		$data['title2']="Halaman Persyaratan";
		$data['konten']="blog/page/persyaratan";
		$this->_templatepage($data);
	}
	
	public function informasi()
	{
		$data['title1']="Informasi";
		$data['title2']="Halaman informasi";
		$data['konten']="blog/page/informasi";
		$this->_templatepage($data);
	}
	
	public function pengumuman()
	{
		$data['title1']="Pengumuman";
		$data['title2']="Halaman pengumuman";
		$data['konten']="blog/page/pengumuman";
		$this->_templatepage($data);
	}
	
	/*public function quota()
	{
		$data['title1']="Quota Kebutuhan";
		$data['title2']="Kebutuhan Pendidik dan Tenaga Kependidikan";
		$data['konten']="blog/page/quota";
		$this->_templatepage($data);
	}*/
	
	public function juknis()
	{
		$data['title1']="JUKNIS";
		$data['title2']="PETUNJUK TEKNIS";
		$data['konten']="blog/page/juknis";
		$this->_templatepage($data);
	}
	
	public function maps()
	{
		$data['title1']="Maps";
		$data['title2']="Halaman Maps";
		$data['konten']="blog/page/maps";
		$this->_templatepage($data);
	}
	
	public function kontak()
	{
		$data['title1']="Kontak Kami";
		$data['title2']="Halaman Kontak";
		$data['konten']="blog/page/kontak";
		$this->_templatepage($data);
	}
	
	public function kebutuhan_ptk()
	{
		$data['title1']="Kebutuhan Pendidik dan Tenaga Kependidikan MAN Insan Cendekia";
		$data['title2']="Kebutuhan Kepala Madrasah, Guru, dan Pembina Asrama";
		$data['konten']="blog/page/kebutuhan_ptk";
		$this->_templatepage($data);
	}
	
	public function seputar_pertanyaan()
	{
		$data['title1']="Seputar Pertanyaan";
		$data['title2']="Halaman Seputar Pertanyaan";
		$data['konten']="blog/page/seputar_pertanyaan";
		$this->_templatepage($data);
	}
 
}