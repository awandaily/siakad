<?php

class Model extends CI_Model  {
    
	var $tbl="tm_jadwal_mengajar";
	var $data_siswa="data_siswa";
	var $k_nilai="tr_kategory_nilai";
	var $tbl_jadwal="tm_jadwal_mengajar";
	var $thn="tr_tahun_ajaran";
 	function __construct()
    {
        parent::__construct();
    }
	function getRepatTahun()
	{
		$idtahun=$this->profile()->id_tahun_masuk;
		$this->db->where("id>=",$idtahun);
	return	$this->db->get($this->thn)->result();
	}	
	function idu()
	{
		return $this->session->userdata("id");
	}
	function profile()
	{
		$this->db->where("id",$this->idu());
		return $this->db->get($this->data_siswa)->row();
	}
	function jadwalHari()
	{		    
		return $this->db->query("SELECT DISTINCT(id_hari) AS hari FROM ".$this->tbl." where id_kelas=".$this->profile()->id_kelas." order by id_hari asc")->result();
	}
	function dataMapel($hari)
	{
		return $this->db->query("SELECT * FROM ".$this->tbl." where sts='1' and id_kelas=".$this->profile()->id_kelas."  and id_hari='".$hari."' order by jam_masuk asc")->result();
	}
	function dataMapelAjar()
	{
		return $this->db->query("SELECT * FROM ".$this->tbl." where sts='1' and id_kelas=".$this->profile()->id_kelas." group by id_mapel")->result();

	}
	function cekWali()
	{
			   $this->db->where("id_wali",$this->session->userdata("id"));
		return $this->db->get_where("tm_kelas")->num_rows();
	}
	function dataKategoryNilai()
	{
		$cek=$this->cekWali();
		if(!$cek)
		{
			$this->db->where("sts!=",1);
		}
		return $this->db->get($this->k_nilai)->result();
	}
		function dataKelasAjar()
	{
		$data=$this->db->select("DISTINCT(id_kelas) as id_kelas");
		$this->db->where("id_guru",$this->idu());
		$this->db->order_by("id_kelas","asc");
		return $this->db->get($this->tbl_jadwal)->result();
	}
}