<?php

class Model extends CI_Model  {
    
	var $tbl="data_cbt";
	var $tbl_jadwal="v_jadwal";
	var $k_nilai="tr_kategory_nilai";
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	function go_migrasi()
	{
		$var="";
		$id_kelas=$this->input->post("id_kelas");
		//$kelas_lama=$this->input->post("kelas_lama");
		$tahun=$this->m_reff->tahun();
		$siswa=$this->input->post("siswa");
		$count_kelas=$this->db->query("select * from data_siswa where id_kelas='".$id_kelas."' and aktifasi='1' and id_sts_data='1' ")->num_rows();
		$count_siswa=count(explode(",",$siswa));
		$total=$count_kelas+$count_siswa;
		$var["total"]=$total;
		if((int)$total>45)
		{
			$var["hasil"]="false";
			 
		}else{
		
		
		
		$filter="set tgl_migrasi='".date('Y-m-d')."',";
		if($id_kelas!="lulus")
		{
		$filter.="   id_kelas ='".$id_kelas."' ";
		}else{
		$filter.="   aktifasi =2, ";
		$filter.="   id_sts_data =2, ";
		$filter.="   id_tahun_keluar=".$tahun;
		 
		}
		$this->db->query("update data_siswa ".$filter." where  id in (".$siswa.") ");
		
		$this->db->query("UPDATE data_siswa SET id_kelas_1=id_kelas, id_tahun_1='".$tahun."' WHERE id_kelas IN (SELECT id FROM tm_kelas WHERE id_tk='1') and aktifasi='1' and id_sts_data='1' ");
		$this->db->query("UPDATE data_siswa SET id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id_kelas IN (SELECT id FROM tm_kelas WHERE id_tk='2') and aktifasi='1' and id_sts_data='1' ");
		$this->db->query("UPDATE data_siswa SET id_kelas_3=id_kelas, id_tahun_3='".$tahun."' WHERE id_kelas IN (SELECT id FROM tm_kelas WHERE id_tk='3') and aktifasi='1' and id_sts_data='1' ");
		
		 
		
		$var["hasil"]="true";
		}
		return $var;
	}
	
	 
	function dataMapel()
	{
		$data=$this->db->select("DISTINCT(id_mapel) as id_mapel");
		return $this->db->get($this->tbl_jadwal)->result();
	}
	function dataKelas()
	{
		$data=$this->db->select("DISTINCT(id_kelas) as id_kelas");
		$this->db->order_by("id_kelas","asc");
		return $this->db->get($this->tbl_jadwal)->result();
	}
	function cekWali()
	{
			   $this->db->where("id_wali",$this->session->userdata("id"));
		return $this->db->get_where("tm_kelas")->num_rows();
	}
	function dataStatusKepegawaian()
	{
		return $this->db->get("tr_sts_pegawai")->result();
	}
}