<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	function insert()
	{
	    	$tahun=$this->m_reff->tahun();
			$sms=$this->m_reff->semester();
		$ket=$this->input->post("ket");
		$start=$this->input->post("start");
		$start=$this->tanggal->eng_($start,"-");
		$end=$this->input->post("end");
		$end=$this->tanggal->eng_($end,"-");
		$this->db->set("id_tahun",$tahun);
		$this->db->set("id_semester",$sms);
		$this->db->set("nama",$ket);
		$this->db->set("start",$start);
		$this->db->set("end",$end);
		return $this->db->insert("tm_jadwal_libur");
	}
	function add()
	{
			$tahun=$this->m_reff->tahun();
			$sms=$this->m_reff->semester();
		$ket=$this->input->post("ket");
		$start=$this->input->post("start");
		$end=$this->input->post("end");
		$end=$this->tanggal->kurangi_tgl($end,1);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("id_semester",$sms);
		$this->db->set("nama",$ket);
		$this->db->set("start",$start);
		$this->db->set("end",$end);
		return $this->db->insert("tm_jadwal_libur");
	}function update()
	{
			 
		$titile=$this->input->post("title");
		$id=$this->input->post("id"); 
		$this->db->where("id",$id);
		$this->db->set("nama",$titile);
		return $this->db->update("tm_jadwal_libur");
	}function moveEvent()
	{
			 
		$id=$this->input->post("id");
		$start=$this->input->post("start");
		$end=$this->input->post("end");
		$end=$this->tanggal->kurangi_tgl($end,1);
		 
		$this->db->where("id",$id);
		$this->db->set("start",$start);
		$this->db->set("end",$end);
		return $this->db->update("tm_jadwal_libur");
	}
	function hapus()
	{
		$id=$this->input->post("id");
		$this->db->where("id",$id);
		$this->db->delete("tm_jadwal_libur");
	}
}