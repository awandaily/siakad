<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eskul_absensi extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->input->get_post("ideskul");
		if ($id) {
			$this->session->set_userdata("ids", $id);
		}
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{
		$level = $this->session->userdata("level");

		$index = "index";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	public function absen($id)
	{
		$level = $this->session->userdata("level");

		$index = "absen";

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	function alfain()
	{
		$idg = $this->input->get_post("idg");
		$ids = $this->input->get_post("ids");
		echo $this->mdl->alfain($idg, $ids);
	}
	function hadirkan()
	{
		$idg = $this->input->get_post("idg");
		$ids = $this->input->get_post("ids");
		echo $this->mdl->hadirkan($idg, $ids);
	}
}
