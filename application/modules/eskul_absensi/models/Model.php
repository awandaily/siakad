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
	
	function kode()
	{
	///	return $this->session->userdata("id");
		$dp=$this->m_reff->dataProfilePegawai(); 
		return $dp->nip;//$this->m_reff->goField("tr_ektrakurikuler","kode","where kode='".$dp->nip."'");
	}
	function cekfinger()
	{
		$this->db->where("noid",$this->kode());
		$this->db->where("SUBSTR(tgl,1,10)",date('Y-m-d'));
		return $this->db->get("tm_log_kehadiran")->num_rows();
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
	function cekAbsen($id,$siswa)
	{
			
		$this->db->where("hadir LIKE '%,".$siswa.",%' ");
		$this->db->where("kode",$this->mdl->kode());
		$this->db->where("id_eskul",$this->mdl->ids());
		$this->db->where("tgl",date('Y-m-d'));
		$this->db->where("id_group",$id);
	//	$this->db->where("id_tahun",$this->m_reff->tahun());
	//	$this->db->where("id_semester",$this->m_reff->semester());
		return $this->db->get("eskul_absen")->num_rows();
	}
	function alfakan($id)
	{
		$this->db->where("id_group",$id);
		$this->db->where("id_eskul",$this->mdl->ids());
		$this->db->where("tgl",date('Y-m-d'));
		$get=$this->db->get("eskul_absen")->num_rows();
		if($get){ return false;	}
		
		$this->db->where("kode",$this->mdl->kode());
		$this->db->where("id_eskul",$this->mdl->ids());
		$this->db->where("id_group",$id);
		$this->db->where("id_tahun",$this->m_reff->tahun());
		$this->db->where("id_semester",$this->m_reff->semester());
		$data=$this->db->get("eskul_anggota")->row();
		$data=isset($data->j_siswa)?($data->j_siswa):"";
		if(!$data){  return false;}
				$sip="";
				$data=json_decode($data,TRUE);
				foreach($data as $key=>$val)
			   {
				$sip.=$val['id'].",";
			   }
			   $alfa=",".$sip;
			   
			    $this->db->set("kode",$this->mdl->kode());
				$this->db->set("id_eskul",$this->mdl->ids());
				$this->db->set("id_group",$id);
			   $this->db->set("alfa",$alfa);
			   $this->db->set("tgl",date('Y-m-d'));
			   $this->db->set("id_tahun",$this->m_reff->tahun());
			   $this->db->set("id_semester",$this->m_reff->semester());
			   
	$cek=$this->db->query("select * from eskul_absen where kode='".$this->mdl->kode()."' and id_eskul='".$this->ids()."' and tgl='".date('Y-m-d')."' ")->num_rows();
	if($cek)
	{
			$this->db->set("honor",0);
	}else{
		$get_honor=$this->m_reff->goField("tr_ektrakurikuler","honor","where id='".$this->ids()."' ");
			$this->db->set("honor",$get_honor);
	}
			   
			   
		return	   $this->db->insert("eskul_absen");
	}function hadiroh($id)
	{
		$this->db->where("id_group",$id);
		$this->db->where("id_eskul",$this->mdl->ids());
		$this->db->where("tgl",date('Y-m-d'));
		$get=$this->db->get("eskul_absen")->num_rows();
		if($get){ return false;	}
		
		$this->db->where("kode",$this->mdl->kode());
		$this->db->where("id_eskul",$this->mdl->ids());
		$this->db->where("id_group",$id);
		$this->db->where("id_tahun",$this->m_reff->tahun());
		$this->db->where("id_semester",$this->m_reff->semester());
		$data=$this->db->get("eskul_anggota")->row();
		$data=isset($data->j_siswa)?($data->j_siswa):"";
		if(!$data){  return false;}
				$sip="";
				$data=json_decode($data,TRUE);
				foreach($data as $key=>$val)
			   {
				$sip.=$val['id'].",";
			   }
			   $hadir=",".$sip;
			   
			    $this->db->set("kode",$this->mdl->kode());
				$this->db->set("id_eskul",$this->mdl->ids());
				$this->db->set("id_group",$id);
			   $this->db->set("hadir",$hadir);
			   $this->db->set("tgl",date('Y-m-d'));
			   $this->db->set("id_tahun",$this->m_reff->tahun());
			   $this->db->set("id_semester",$this->m_reff->semester());
			   
	$cek=$this->db->query("select * from eskul_absen where kode='".$this->mdl->kode()."' and id_eskul='".$this->ids()."' and tgl='".date('Y-m-d')."' ")->num_rows();
	if($cek)
	{
			$this->db->set("honor",0);
	}else{
		$get_honor=$this->m_reff->goField("tr_ektrakurikuler","honor","where id='".$this->ids()."' ");
			$this->db->set("honor",$get_honor);
	}
			   
			   
		return	   $this->db->insert("eskul_absen");
	}
	function alfain($group,$id_siswa)
	{
		$this->db->where("id_group",$group);
		$this->db->where("id_eskul",$this->mdl->ids());
		$this->db->where("tgl",date('Y-m-d'));
		$get=$this->db->get("eskul_absen")->row();
		$hadir=$get->hadir;
		$alfa=$get->alfa.",".$id_siswa.",";
		$alfa=str_replace(",,",",",$alfa);
		$hadir=str_replace(",".$id_siswa.",",",",$hadir);
			if($hadir==","){ $hadir=null;}
		$this->db->set("hadir",$hadir);
			if(($alfa)==","){ $alfa=null;}
		$this->db->set("alfa",$alfa);
		$this->db->where("id",$get->id);
		return $this->db->update("eskul_absen"); 
	}
	function hadirkan($group,$id_siswa)
	{
		$this->db->where("id_group",$group);
		$this->db->where("id_eskul",$this->mdl->ids());
		$this->db->where("tgl",date('Y-m-d'));
		$get=$this->db->get("eskul_absen")->row();
		$hadir=$get->hadir.",".$id_siswa.",";
		$hadir=str_replace(",,",",",$hadir);
		$alfa=$get->alfa; 
		$alfa=str_replace(",".$id_siswa.",",",",$alfa);
			if(($hadir)==","){ $hadir=null;}
		$this->db->set("hadir",$hadir);
			if(($alfa)==","){ $alfa=null;}
		$this->db->set("alfa",$alfa);
		$this->db->where("id",$get->id);
		return $this->db->update("eskul_absen"); 
	}
}