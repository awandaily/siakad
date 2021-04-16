<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile_anak extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session("ORTU");
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{
		$data["data"] = $this->db->query("select * from v_siswa where id='" . $this->m_reff->id_siswa() . "'")->row();
		$index = "index";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index, $data);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}

	function cekAbsen()
	{
		$this->load->view("cekAbsenDetail");
	}
}
