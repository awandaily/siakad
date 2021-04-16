<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
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
		 if(!$kelas){ $kelas="121212";}
		 return $return=$this->db->query("select * from data_siswa where id_kelas in(".$kelas.") and id_tahun_keluar is null ")->num_rows();
	 }
}