<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	function ids()
	{
	    return $this->session->userdata("ids");
	//	 $this->session->userdata("id_eskul");
	//	$dp=$this->m_reff->dataProfilePegawai(); 
	//	return $this->m_reff->goField("tr_ektrakurikuler","id","where kode='".$dp->nip."'");
	}
	
	 
	function jmlPertemuan()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_eskul",$this->ids()); 
		$this->db->where("kode",$this->kode()); 
		return $this->db->get("eskul_absen")->num_rows();
	}
	function kode()
	{
	///	return $this->session->userdata("id");
		$dp=$this->m_reff->dataProfilePegawai(); 
		return $dp->nip;//$this->m_reff->goField("tr_ektrakurikuler","kode","where kode='".$dp->nip."'");
	}
	function jmlGroup()
	{ 	 
		$this->db->where("id_eskul",$this->ids()); 
		return $this->db->get("eskul_group")->num_rows(); 
	}function jmlAnggota($id=null)
	{
		 if($id){
			 $this->db->where("id_group",$id); 
		 }
		$this->db->where("id_eskul",$this->ids()); 
		$return=$this->db->get("eskul_anggota")->row(); 
		$dt=isset($return->j_siswa)?($return->j_siswa):"";
		$dt=json_decode($dt,TRUE);
		return count($dt);
		
	}
}