<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	function id_siswa() //untuk ortu
	{
		$data=$this->db->query("select id_siswa from data_ortu where id='".$this->session->userdata("id")."' ")->row();
		return isset($data->id_siswa)?($data->id_siswa):"";
	}	
	function id_kelas() //untuk ortu
	{
		$data=$this->db->query("select id_kelas from data_siswa where id='".$this->id_siswa()."' ")->row();
		return isset($data->id_kelas)?($data->id_kelas):"";
	}		
	 
	 function getJamAwal($ha,$id)
	 {
		 if($ha==1)
		 {
			 $sts="1";
		 }else{ $sts="0"; }
		 
		 $this->db->where("urut",$id);
		 $this->db->where("sts",$sts);
		$data=$this->db->get("tr_jam_ajar")->row();
		$return=isset($data->jam_mulai)?($data->jam_mulai):"";
		return substr($return,0,5);
	 }
	 function getJamAkhir($ha,$id)
	 {
		if($ha==1)
		 {
			 $sts="1";
		 }else{ $sts="0"; }
		 $this->db->where("id",$id);
		 $this->db->where("sts",$sts);
		$data=$this->db->get("tr_jam_ajar")->row();
		$return=isset($data->jam_akhir)?($data->jam_akhir):"";
		return substr($return,0,5);
	 }
	 function getIdJadwal($urut,$id_kelas,$ha)
	 {
			$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		 $return=$this->db->query("select id from v_jadwal where jam like '%,".$urut.",%' and id_kelas='".$id_kelas."' and id_hari='".$ha."' and id_semester='".$sms."' and id_tahun='".$tahun."' ")->row();
	 return isset($return->id)?($return->id):"";
	 }
	 function getStsHadir($id_sts)
	 {
		 $this->db->where("id",$id_sts);
		$data=$this->db->get("tr_sts_kehadiran")->row();
		return isset($data->nama)?($data->nama):"";
	 }
	 function persentaseHadir()
	 {
		 	 $sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
		 $jmlData=$this->db->query("select * from tm_absen_siswa where id_siswa='".$this->id_siswa()."' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 $jmlHadir=$this->db->query("select * from tm_absen_siswa where id_siswa='".$this->id_siswa()."' and id_sts='1' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 $return=($jmlHadir/$jmlData)*100;
		return number_format($return,0)." % ";
	 }
	 function catatan($jenis)
	 {
		 	 $sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
		 $jmlData=$this->db->query("select * from tm_catatan where id_siswa='".$this->id_siswa()."' AND id_jenis='".$jenis."' and teruskan like '%2%' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 
		return number_format($jmlData,0);
	 }
	 function jmlKehadiran($sts)
	 {		 $sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		 $jmlData=$this->db->query("select * from tm_absen_siswa where id_siswa='".$this->id_siswa()."' AND id_sts='".$sts."' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 
		return number_format($jmlData,0);
	 }
}