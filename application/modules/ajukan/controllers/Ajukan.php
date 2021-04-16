<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajukan extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("peserta"));
		$this->load->model("Model", "mdl");
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
	function update()
	{
		$idu = $this->session->userdata("id");
		$this->db->where("id", $idu);
		$this->db->set("sts", 1);
		echo	$this->db->update("tm_peserta");
	}
}
