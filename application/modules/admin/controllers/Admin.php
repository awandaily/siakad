<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	

	function __construct()
	{
		parent::__construct();	
		$this->load->model('m_admin','admin');
		$this->load->model('m_profile','profile');
		$this->m_konfig->validasi_session(array("admin"));
	}
	
	function _template($data)
	{
	$this->load->view('template/main',$data);	
	}
	
	public function index()
	{

	$data['dataUser']=$this->m_konfig->getDataLevel();
	$data['konten']="manajemen";
	$data['dataProfil']=$this->admin->dataProfile($this->session->userdata("id"));
	$this->_template($data);
	}
	function controling()
	{
	$data['konten']="controling";
	$data['dataProfil']=$this->admin->dataProfile($this->session->userdata("id"));
	$this->_template($data);
	}
	
	 
}

