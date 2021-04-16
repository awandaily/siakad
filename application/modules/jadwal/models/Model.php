<?php

class Model extends CI_Model  {
    
	var $tbl="tm_jadwal_mengajar";
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	function jadwalHari()
	{		    
		return $this->db->query("SELECT DISTINCT(id_hari) AS hari FROM ".$this->tbl." where id_guru=".$this->idu()." order by id_hari asc")->result();
	}
	function dataMapel($hari)
	{
		return $this->db->query("SELECT * FROM ".$this->tbl." where sts='1' and id_guru=".$this->idu()." and id_hari='".$hari."' order by jam_masuk asc")->result();
	}
	function cekInstal()
	{ 
	$this->db->where("id",$this->idu());
	$return=$this->db->get("data_pegawai")->row();
	return isset($return->sts_isi)?($return->sts_isi):"0";
	}
	function cektahap($id)
	{   $sms=$this->m_reff->semester(); $tahun=$this->m_reff->tahun();
	//	return $this->m_reff->goField("data_pegawai","tahap".$id,"where id='".$this->idu()."' ");
	return $this->db->query("select * from tm_penjadwalan where id_semester='".$sms."' and id_tahun='".$tahun."' and id_guru='".$this->idu()."' ")->num_rows();
	}
}