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
	
	function getkbmnow($id_kelas,$jam,$hari)
	{	$tahun=$this->m_reff->tahun();
		$sms=$this->m_reff->semester();
		return $this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' 
				 and id_tahun='".$tahun."' and id_semester='".$sms."' and id_hari='".$hari."'
			 	and jam like '%,".$jam.",%' ")->row();	
	}
	function cekKehadiranGuru($id_jadwal,$id_guru)
	{
		$this->db->where("SUBSTR(tgl,1,10)",date('Y-m-d'));
		$this->db->where("id_jadwal",$id_jadwal);
		$this->db->where("id_guru",$id_guru);
		return $db=$this->db->get("tm_absen_guru")->row();
	}
	function cekDiliburkan($id_jadwal,$id_guru)
	{
		$this->db->where("SUBSTR(tgl,1,10)",date('Y-m-d'));
		$this->db->where("id_jadwal",$id_jadwal);
		$this->db->where("id_guru",$id_guru);
		return $db=$this->db->get("tm_diliburkan")->num_rows();
	}
	function cekHadir($ha,$id_kelas,$urut,$id_guru,$id_jadwal,$mapel)
	{
		$cek=$this->db->query("select * from tm_absen_guru where id_kelas='".$id_kelas."' and id_hari='".$ha."' 
		and SUBSTR(tgl,1,10)='".date('Y-m-d')."' and id_mapel='".$mapel."' order by id desc limit 1");
		if(!$cek->num_rows())
		{
			$jam=$this->m_reff->goField("v_jadwal","jam","where id='".$id_jadwal."'");
		return	$hadir="  BLUM ABSEN ";
											
		}else{
			$data=$cek->row();
			if(strpos($data->jam_blok,",".$urut.",")===false)
			{
			return	$hadir=" MASUK  ";				 
			}else{
			return $hadir="  DIBLOK  ";
												
			}
		}
	}
	
	
}