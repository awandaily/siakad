<?php

class Model extends CI_Model  {
    
			var $tbl="data_cbt";
	var $tbl_jadwal="v_jadwal";
	var $k_nilai="tr_kategory_nilai";
	function __construct()
    {
        parent::__construct();
    }
	function dataMapel()
	{
		$data=$this->db->select("DISTINCT(id_mapel) as id_mapel");
		return $this->db->get($this->tbl_jadwal)->result();
	}
	function dataStatusKepegawaian()
	{
		return $this->db->get("tr_sts_pegawai")->result();
	}
	function jmlSiswa($tk)
	{
		 $data=$this->db->query("SELECT * from v_kelas where id_tk='".$tk."' ")->result();
		 $os="";
		 foreach($data as $val)
		 {
			 $os.=$val->id.",";
		 }
		 $kelas=substr($os,0,-1);
		 return $return=$this->db->query("select * from data_siswa where id_kelas in(".$kelas.") and id_tahun_keluar is null ")->num_rows();
	}
	 function jmlSiswaTotal()
	{
		  
		 return $return=$this->db->query("select * from data_siswa where id_tahun_keluar is null ")->num_rows();
	}
	 function jmlJurusan($j)
	 {
		 $data=$this->db->query("SELECT * from v_kelas where id_jurusan='".$j."' ")->result();
		 $os="";
		 foreach($data as $val)
		 {
			 $os.=$val->id.",";
		 }
		 $kelas=substr($os,0,-1);
		 return $return=$this->db->query("select * from data_siswa where id_kelas in(".$kelas.") and id_tahun_keluar is null ")->num_rows();
	 }
}