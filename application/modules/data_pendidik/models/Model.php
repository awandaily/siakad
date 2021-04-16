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
	function cekKehadiranGuru_new($idkelas,$idmapel,$idguru, $tgl)
	{
		$this->db->where("id_kelas",$idkelas);
		$this->db->where("SUBSTR(tgl,1,10)", $tgl);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru",$idguru);
		return $db=$this->db->get("tm_absen_guru")->row();
	}
	function cekInval($idmapel,$idguru, $tgl,$jam)
	{
	    $this->db->where("jam like '%,".$jam.",%' ");
	//	$this->db->where("id_kelas",$idkelas);
		$this->db->where("SUBSTR(tgl,1,10)", $tgl);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru_sebelumnya",$idguru);
		return $db=$this->db->get("tm_inval")->row();
	}
	function poto_guru($id)
	{
	   	$data=$this->db->get_where("data_pegawai",array("id"=>$id))->row();
		if($data)
		{			 
					$filename="file_upload/dp/".$data->poto;
					if ($data->poto) {
						if(file_exists($filename)){
						return base_url().$filename;
						}else{
							if($data->jk=="l")
						{
							return base_url()."plug/img/cowok.png";
						}else{
							return base_url()."plug/img/cewek.png";
						}
							
						}
					}else{
						if($data->jk=="l")
						{
							return base_url()."plug/img/cowok.png";
						}else{
							return base_url()."plug/img/cewek.png";
						}
					}						
					
		}else{
			return base_url()."plug/img/logo.png";
		}
	}
		function cekKehadiranGuru_($id_jadwal,$id_guru, $tgl)
	{
		$this->db->where("SUBSTR(tgl,1,10)", $tgl);
		$this->db->where("id_jadwal",$id_jadwal);
		$this->db->where("id_guru",$id_guru);
		return $db=$this->db->get("tm_absen_guru")->row();
	}
		function cekDiliburkan_new($idkelas,$idmapel,$idguru, $tgl)
	{
		$this->db->where("id_kelas",$idkelas);
		$this->db->where("SUBSTR(tgl,1,10)", $tgl);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru",$idguru);
		return $db=$this->db->get("tm_diliburkan")->row();
	}
	function cekIzinHarian($idguru, $tgl)
	{
	   
		return  $this->db->query("select * from tm_guru_izin where id_guru='".$idguru."' and  CAST('".$tgl."' AS DATE)  BETWEEN `start` and `end`")->row();  
	}
	function cekDiliburkan_($id_jadwal,$id_guru, $tgl)
	{
		$this->db->where("SUBSTR(tgl,1,10)", $tgl);
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
	
	function jmlKelasMengajar($idguru,$all=null)
	{  
	    if($all==null){
    	    $tahun=$this->m_reff->tahun();
        	$sms=$this->m_reff->semester();
        	$this->db->where("id_tahun",$tahun);
    	    $this->db->where("id_semester",$sms);
	    }
	    $this->db->where("id_guru",$idguru);
	   
	   return $this->db->get("v_jadwal")->num_rows();
	}
	
	function totalPertemuan($idguru,$all=null)
	{   
	    if($all==null){
    	    $tahun=$this->m_reff->tahun();
        	$sms=$this->m_reff->semester();
        	$this->db->where("id_tahun",$tahun);
    	    $this->db->where("id_semester",$sms);
	    }
	    $this->db->where("id_guru",$idguru); 
	    $this->db->where("sumber",1);
	   return $this->db->get("tm_absen_guru")->num_rows();
	}

    function totalPertemuanIzin($idguru,$all=null)
	{   
	    if($all==null){
    	    $tahun=$this->m_reff->tahun();
        	$sms=$this->m_reff->semester();
        	$this->db->where("id_tahun",$tahun);
    	    $this->db->where("id_semester",$sms);
	    }
	    
	    $this->db->where("id_guru",$idguru); 
	    $this->db->where("jam_blok","");
	     $this->db->where("sumber",3);
	     $this->db->where("izin!=","PKL");
	   return $this->db->get("tm_absen_guru")->num_rows();
	}
	function totalPertemuanTidakMasuk($idguru,$all=null)
	{       $tahun=$this->m_reff->tahun();
        	$sms=$this->m_reff->semester();
	     if($all==null){
    	    
        	$this->db->where("id_tahun",$tahun);
    	    $this->db->where("id_semester",$sms);
    	     $this->db->where("sumber",4);
    	      $this->db->where("id_guru",$idguru); 
    	    $this->db->where("1=1 or (LENGTH(jam)=LENGTH(jam_blok) and id_guru=$idguru and id_tahun=$tahun and id_semester=$sms)");
	    }else{
	          $this->db->where("id_guru",$idguru); 
	    $this->db->where("sumber",4);
	   	    $this->db->where("1=1 or (LENGTH(jam)=LENGTH(jam_blok) and id_guru=$idguru )");
	    }
	    
	   
	      
	   return $this->db->get("tm_absen_guru")->num_rows();
	}
}