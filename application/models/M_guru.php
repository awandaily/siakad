<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_guru extends ci_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	function idu()
	{
		return $this->session->userdata("id");
	}
	function totalKelasMengajar($idu)
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $idu);
		return $this->db->get("tm_mapel_ajar")->num_rows();
	}
	function totalJamMengajarPerMinggu($idu)
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $idu);
		$this->db->select("SUM(jml_jam) as jml");
		return $this->db->get("tm_mapel_ajar")->row()->jml;
	}
	function jmlPertemuan()
	{
		return $this->m_reff->goField("tm_pengaturan", "val", "where id='4'");
	}
	/*	function totalJamMengajar($idu)
	{	
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_semester",$sms);
		$this->db->where("id_guru",$idu);
		$this->db->select("SUM(jml_jam) as jml");
		return $this->db->get("tm_mapel_ajar")->row()->jml*$this->jmlPertemuan();
	}*/
	function totalJamMengajar($idu)
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $idu);
		$this->db->select("SUM(total_jam) as jml");
		return $this->db->get("tm_mapel_ajar")->row()->jml; //*$this->jmlPertemuan();
	}
	/*	function totalJamMengajarPerKelasMapel($idu,$id_mapel_ajar)
	{	
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id",$id_mapel_ajar);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_semester",$sms);
		$this->db->where("id_guru",$idu);
		$this->db->select("SUM(jml_jam) as jml");
		return $this->db->get("tm_mapel_ajar")->row()->jml*$this->jmlPertemuan();
	}*/

	function totalJamMengajarPerKelasMapel($idu, $id_mapel_ajar)
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->where("id", $id_mapel_ajar);
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $idu);
		$this->db->select("total_jam as jml");
		return $this->db->get("tm_mapel_ajar")->row()->jml;
	}
	function mapelAjar($idu)
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $idu);
		return $this->db->get("tm_mapel_ajar")->result();
	}
	function jmlPertemuanPerMapelPerKelas($idu, $id_mapel, $id_kelas)
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $idu);
		$this->db->where("id_mapel", $id_mapel);
		$this->db->where("id_kelas", $id_kelas);
		return $this->db->get("tm_absen_guru")->num_rows();
	}
	function jmlJamValid($idu)
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $idu);
		$this->db->select("SUM(jml_jam_valid) as jml");
		$valid1 = $this->db->get("tm_absen_guru")->row()->jml;

		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $idu);
		$this->db->select("SUM(jml_jam) as jml");
		$valid2 = $this->db->get("tm_diliburkan")->row()->jml;

		return $valid1 + $valid2;
	}

	function jmlValidPerMapelPerKelas($idu, $id_mapel, $id_kelas)
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$this->db->where("id_mapel", $id_mapel);
		$this->db->where("id_kelas", $id_kelas);
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $idu);
		$this->db->select("SUM(jml_jam_valid) as jml");
		$valid1 = $this->db->get("tm_absen_guru")->row()->jml;

		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_semester", $sms);
		$this->db->where("id_guru", $idu);
		$this->db->where("id_mapel", $id_mapel);
		$this->db->where("id_kelas", $id_kelas);
		$this->db->select("SUM(jml_jam) as jml");
		$valid2 = $this->db->get("tm_diliburkan")->row()->jml;

		return $valid1 + $valid2;
	}
}
