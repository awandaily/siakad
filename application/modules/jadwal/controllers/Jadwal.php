<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{

		$mobile = $this->m_reff->mobile();
		if (!$mobile) {
			$cek = $this->mdl->cektahap(1);
			$semester_sts = $this->m_reff->semester_sts();
			$tahun_sts = $this->m_reff->tahun_sts();
			if ($cek == 0 and $semester_sts == true  and $tahun_sts == true) {
				redirect("guru_instal/profile");
			}
			/*	$cek=$this->mdl->cektahap(2);
			if($cek==0)
			{
				redirect("guru_instal/profile");
			}
			$cek=$this->mdl->cektahap(3);
			if($cek==0)
			{
				redirect("guru_instal/profile");
			}
			$cek=$this->mdl->cektahap(4);
			if($cek==0)
			{
				redirect("guru_instal/profile");
			}*/
		}

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}
}
