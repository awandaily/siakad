<?php

class Model_analisis extends CI_Model  {
    
		
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
		 
		 
		return $return=$this->db->get("data_siswa")->num_rows();
	}
	
	function jmlSiswaGroup($jk,$tingkat,$id_jurusan)
	{
	 
		if($jk)
		{
				$this->db->where("jk",$jk);
		}
	 	if($tingkat)
		{
				$this->db->where("id_tk",$tingkat);
		}
		if($id_jurusan)
		{
				$this->db->where("id_jurusan",$id_jurusan);
		}
	 
		 
			$this->db->where("id_tahun_keluar",null);
	 
		 
		return $return=$this->db->get("v_siswa")->num_rows();
	}
}