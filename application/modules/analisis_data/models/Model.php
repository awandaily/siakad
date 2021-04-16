<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	 
	function getIdkelas($tk,$id_jurusan,$rombel)
	{
		$this->db->where("id_jurusan",$id_jurusan);
		$this->db->where("id_tk",$tk);
		$this->db->where("nama",$rombel);
		$return=$this->db->get("tm_kelas")->row();
		return isset($return->id)?($return->id):"xx";
	}
	function jmlSiswa($jk,$idkelas)
	{
	 
		if($jk)
		{
			$this->db->where("jk",$jk);
		}
	 
		
		if($idkelas)
		{
		$this->db->where("id_kelas",$idkelas);
		} 
			$this->db->where("id_tahun_keluar",null);
		 
		 $this->db->where("aktifasi",1);
		return $return=$this->db->get("data_siswa")->num_rows();
	}
	
	
	function jmlSiswaGroup($jk,$tingkat,$id_jurusan,$pindah=null)
	{	
		$filter="";$fil="";$c="";
		if($jk)
		{
				$filter.=" AND jk='".$jk."'";
		}
		if($pindah)
		{		$tahun=$this->m_reff->tahun();
				$filter.=" AND id_sts_data IN (".$pindah.") and id_tahun_keluar='".$tahun."' ";
		}else{
			$filter.=" AND aktifasi='1' and id_tahun_keluar is   null";
		}
	 	if($tingkat)
		{
				$fil.=" AND id_tk='".$tingkat."'";
				$c=1;
		}
		if($id_jurusan)
		{	$c=1;
				$fil.=" AND id_jurusan='".$id_jurusan."'";
		}
	 
		if($c){
		$filter.=" AND id_kelas IN (select id from tm_kelas where 1=1 $fil   ) ";
		}
		
		 
	 
		 
		return $return=$this->db->query("select * from data_siswa where 1=1 ".$filter." ")->num_rows();
	}
}