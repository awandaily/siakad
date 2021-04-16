<?php

class M_agenda extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
 
 
	function konversiTanggal($tgl)
	{
		// hari bulan tgl tahun
		$konver=explode(" ",$tgl);
		$tgl=$konver[3]."-".$this->tanggal->namaBulan($konver[1])."-".$konver[2];
		return $this->tanggal->hariLengkap($tgl,"/");
	}
	function tglAkhir($tgl,$durasi)
	{
		$konver=explode(", ",$tgl);
		 $tgl=$this->tanggal->addTanggal($durasi,$this->tanggal->eng_($konver[1],"-"));
		//return $tgl=$this->tanggal->ind($tgl,"/");
		return $this->tanggal->hariLengkap__($tgl,"/");
	}
	function createEvent()
	{	$idu=$this->session->userdata("id");
		$form=$this->input->post("f");
		unset($form['tgl_mulai']);
		unset($form['tgl_akhir']);
		
		$tgl_mulai=$this->input->post("f[tgl_mulai]");
		$tgl_akhir=$this->input->post("f[tgl_akhir]");
			$tgl_mulai=explode(",",$tgl_mulai);
			$tgl_akhir=explode(",",$tgl_akhir);
				$tgl_mulai=$this->tanggal->eng_($tgl_mulai[1],"-");
				$tgl_akhir=$this->tanggal->eng_($tgl_akhir[1],"-");
		
		 $this->db->set("tgl_akhir",$tgl_akhir);
		 $this->db->set("tgl_mulai",$tgl_mulai);
		
		$this->db->set("cuid",$idu);
	return	$this->db->insert("tm_kegiatan",$form);
	}
}