<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gdashboard extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session("guru");
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model("m_plugin");
	}
	function coba()
	{
		$index = "coba";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view($index);
		} else {
			$data['konten'] = $index;
			$this->_template($data);
		}
	}
	function setThn()
	{
		$thn = $this->input->get("thn");
		$this->session->set_userdata("tahun_id", $thn);
		echo $thn;
	}
	function hapus_pesan()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("sts_baca", 1);
		$this->db->set("_utime", date('Y-m-d H:i:s'));
		echo $this->db->update("data_pesan");
	}
	function _template($data)
	{
		$this->load->view('template/main', $data);
	}
	function idu()
	{
		return $this->session->userdata("id");
	}

	function profile()
	{
		$this->db->where("id", $this->idu());
		return	$this->db->get("data_pegawai")->row();
	}
	public function index()
	{
		$mobile = $this->m_reff->mobile();
		$this->m_reff->updateToken();
		if (!$mobile) {
			$cek = $this->mdl->cektahap(1);
			$semester_sts = $this->m_reff->semester_sts();
			$tahun_sts = $this->m_reff->tahun_sts();
			if ($cek == 0 and $semester_sts == true  and $tahun_sts == true) {
				redirect("guru_instal/profile");
			}
			/*		$cek=$this->mdl->cektahap(2);
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

	function getDataAbsen()
	{

		$bulan = $this->input->post("bulan");
		if (!$bulan) {
			$bulan = date("Y-m");
		}
		$data["tahun"] = substr($bulan, 0, 4);
		$data["bulan"] = substr($bulan, 5, 2);
		$data["noid"] = $this->profile()->nip; //nip
		echo	$this->load->view("getDataAbsen", $data);
	}

	function getDataMapel()
	{
		$data["noid"] = $this->input->post("noid");
		$data["tgl"] = $this->input->post("tgl");
		$data["kohar"] = $this->input->post("kohar");
		echo	$this->load->view("getDataMapel", $data);
	}

	function getGrafik()
	{
		$data["tgl"] = $this->input->post("tgl");
		echo	$this->load->view("getGrafik", $data);
	}
	function getAbsen()
	{
		$setinganMasuk = date("Y-m-d") . " " . $this->m_reff->pengaturan(4);
		$tbl = "";

		$nip = $this->mdl->idu();
		$nip = $this->m_reff->goField("data_pegawai", "nip", "where id='" . $nip . "' ");
		$honor = $this->m_reff->honor($this->mdl->idu());
		$data = array();
		$tgl = $this->input->post("tgl");
		$tgl1 = $this->tanggal->range_1($tgl);
		//	$tgl1=$this->tanggal->eng($tgl1,"-");
		$tgl2 = $this->tanggal->range_2($tgl);
		//	$tgl2=$this->tanggal->eng($tgl2,"-");
		$no = 1;
		$selisih = $this->tanggal->selisih($tgl1, $tgl2);

		$jml = 0;
		$jmljamngajar = 0;
		$jmljamBlok = 0;
		$tinval = "";
		for ($i = $selisih; $i >= 0; $i--) {
			$tgl = $this->tanggal->tambah_tgl($tgl1, $i);
			//		$invalHonor=$this->mdl->THonorInval($tgl);
			//		$tinval+=$invalHonor;
			//		 $cekabsen=$this->mdl->cekKehadiran($tgl);
			//		  $diblok=$this->mdl->cekKehadiranBlok($tgl);
			//	  $inval=$this->mdl->cekKehadiranInval($tgl);
			//	  $invalid=$this->mdl->cekKehadiranInvalid($tgl);
			//	  $cekabsenValid=$cekabsen;
			///	 $jmljam=$cekabsen+$diblok+$invalid+$inval;
			///	$jml_honor=($cekabsen*$honor)+$invalHonor;
			//	$alldiblok=$diblok+$invalid;
			//	 if($inval){
			//		 $jaminval="+".$inval." inval";
			//	 }else{	$jaminval="";	}




			$row = array();
			$datang = $this->mdl->absenDatang($tgl, $nip);
			$pulang = $this->mdl->absenPulang($tgl, $nip, $datang);
			$masuk = $tgl . " " . $datang;
			$keluar = $tgl . " " . $pulang;


			$telat = $this->m_reff->telat($setinganMasuk, $masuk);
			//	$row[] = "<span class='cursor hoverline size' onclick='getMapel(`".$tgl."`)' >".$no++."</span>";				 
			$row[] = "<span class='cursor hoverline size' onclick='getMapel(`" . $tgl . "`)' >" . $this->tanggal->hariLengkap($tgl, "/") . " </span>";
			$row[] = "<span class='cursor hoverline size' onclick='getMapel(`" . $tgl . "`)' >" . $datang . "</span>";
			$row[] = "<span class='cursor hoverline size' onclick='getMapel(`" . $tgl . "`)' >" . $pulang . "</span>";
			$row[] = "<span class='cursor hoverline size' onclick='getMapel(`" . $tgl . "`)' > " . $telat . "</span>";

			$row[] = "<span class='cursor hoverline size' onclick='getMapel(`" . $tgl . "`)' >" . $this->m_reff->disekolah($masuk, $keluar) . " </span>";

			//add html for action
			//	 $jml=$cekabsen+$jml;
			//	 $jmljamngajar=$jumlahjam+$jmljamngajar;
			//		 $jmljamBlok=$jmldiblok+$jmljamBlok;

			$data[] = $row;
		}
		//	$row = array();
		//		$row[] = "";							
		///		$row[] = "<b>TOTAL</b>";							
		//		$row[] = "<b>".$jmljamngajar."</b>";							
		//		$row[] = "<b>".$jml."</b>";							
		//		$row[] = "<b>".$jmljamBlok."</b>";							
		//		$row[] = "<b>".number_format((($honor*$jml)+$tinval),0,",",".")."</b>";							

		//	$data[] = $row;



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $jml,
			"recordsFiltered" => $jml,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function setSms()
	{
		$sms = $this->input->get("sms");
		$this->session->set_userdata("sms_id", $sms);
		echo $sms;
	}
}
