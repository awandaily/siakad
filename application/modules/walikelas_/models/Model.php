<?php

class Model extends CI_Model  {
    
	var $tbl="tm_jadwal_mengajar";
 	function __construct()
    {
        parent::__construct();
    }
	function id_kelas()
	{
		return $this->m_reff->goField("tm_kelas","id","where id_wali='".$this->idu()."'");
	}
	public function idu()
	{
		return $this->session->userdata("id");
	}
	function statusHariIni()
	{
		$this->db->order_by("id","desc");
		$this->db->where("SUBSTR(tgl,1,10)",date('Y-m-d'));
		return $this->db->get("tm_catatan")->result();
	}
	function tanggapan($id)
	{
		$this->db->where("id_catatan",$id);
		return $this->db->get("tm_tanggapan")->result();
	}
	function dataSiswa($id)
	{
		$this->db->where("id",$id);
		return $this->db->get("data_siswa")->row();
	}
	function dataKelas($id)
	{
		$this->db->where("id",$id);
		return $this->db->get("v_kelas")->row();
	}
	function insert_tanggapan()
	{	

			$id = $this->input->post("id");
			$post=$this->input->post("f");
			$post=$this->security->xss_clean($post);
			$this->db->set("id_wk", $this->idu());
			$this->db->where("id",$id);
			return $this->db->update("tm_catatan",$post);
		
		/*
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		return $this->db->insert("tm_tanggapan",$post);*/
	}	
 	function get_data_absenPerhari()
	{
		$query=$this->_get_data_absenPerhari();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_absenPerhari()
	{
				 		   
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		 if($this->m_reff->tahun_sts()=="true"){
    	$query="select * , (absen2+absen3+absen4+absen5+absen6) AS jml from data_siswa  where id_kelas='".$this->id_kelas()."' and id_sts_data in (1,4)  "; 
	     }else{
	         $tahun_kini=$this->m_reff->tahun();
	          $getIdSiswa=$this->m_reff->goField("tm_catatan_walikelas","id_siswa","where _cid='".$this->mdl->idu()."' and id_tahun='".$tahun_kini."'   limit 1");
	        $idkelas=$this->m_reff->getHisKelas($getIdSiswa);  
	                         	   
	                         	   
	 ///     $idkelas=$this->input->post("id_kelas");
	        $id_tk=$this->m_reff->goField("tm_kelas","id_tk","where id='".$idkelas."' "); 
	                $tahun=$this->m_reff->tahun(); 
                
    	$query="select *, (absen2+absen3+absen4+absen5+absen6) AS jml from data_siswa where  id_tahun_$id_tk=$tahun and id_kelas_$id_tk=$idkelas ";         
	      	
	     }
	     
		
		
		
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by jml   DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_perhari()
	{				
		$query = $this->_get_data_absenPerhari();
        return  $this->db->query($query)->num_rows();
	}

	 function get_data_perhari_all()
	{
		$query=$this->_get_data_perhari_all();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_perhari_all()
	{
				 		   
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 $idkelas = $_POST["id_kelas"];  
		 $query="select * , (absen2+absen3+absen4+absen5+absen6) AS jml from data_siswa  where id_kelas='".$idkelas."' and id_sts_data in (1,4)  ";
	     
		
		
		
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by jml   DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_perhari_all()
	{				
		$query = $this->_get_data_perhari_all();
        return  $this->db->query($query)->num_rows();
	}

	function update_tanggapan()
	{	$id=$this->input->post("id");
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->where("id",$id);
		return $this->db->update("tm_tanggapan",$post);
	}
	function hapus_bpbk()
	{
		$this->db->where("id",$this->input->post("id"));
		return $this->db->delete("tm_tanggapan");
	}
	 function get_data()
	{
		$query=$this->_get_data();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data()
	{
				 		  
		$id_kelas=$this->id_kelas();
	  
	 	$filter="";
	 	//$filter.="AND teruskan like '%1%' ";
		$filter.="AND id_kelas='".$id_kelas."' ";
	 
	 
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from tm_catatan where id_tahun='".$tahun."' and id_semester='".$sms."'  $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				  
				ket LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by id   DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count()
	{				
		$query = $this->_get_data();
        return  $this->db->query($query)->num_rows();
	}
	
	
	
	 function get_data_absen()
	{
		$query=$this->_get_data_absen();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_absen()
	{
				 		  
		 
	 	$filter="";
	    
	 
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * , (absen2+absen3+absen4+absen5+absen6) AS jml from data_siswa  where id_kelas='".$this->id_kelas()."'  $filter   ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by jml   DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_abs()
	{				
		$query = $this->_get_data_absen();
        return  $this->db->query($query)->num_rows();
	}
	
	 function kehadiran($id_siswa,$sts,$bln)
	{	 
		return $this->db->query("select * from tm_absen_siswa where  SUBSTR(tgl,1,7)='".$bln."'
		and     absen".$sts." like '%,".$id_siswa.",%'
		")->num_rows();
	}
	
	function jmlSiswa($tk)
	{	
		$data=$this->m_reff->data_id_kelas($tk);
		return $this->db->query("select * from data_siswa where id_kelas in (".$data.") and aktifasi like '%1%' ")->num_rows();
	}
	
	function jmlSiswaFinger($tk)
	{
		$data=$this->m_reff->data_nis_siswa($tk);
		return $this->db->query("select * from tm_log_kehadiran where noid in (".$data.") and SUBSTR(tgl,1,10)='".date('Y-m-d')."' group by noid")->num_rows(); 
	}
	function siswa_tidak_hadir() // hari ini berdasarkan finger
	{
		 $dataNoid=$this->db->query("select * from tm_absen_siswa where SUBSTR(tgl,1,10)='".date('Y-m-d')."' and id_jadwal in (select id from tm_penjadwalan where id_kelas='".$this->id_kelas()."')")->result();
		 $isi="";
		 foreach($dataNoid as $val)
		 {
			 if($val->absen2==",")
			 {
				 $absen2="";
			 }else{
				 $absen2=$val->absen2;
			 }
			  if($val->absen3==",")
			 {
				 $absen3="";
			 }else{
				 $absen3=$val->absen3;
			 }
			  if($val->absen4==",")
			 {
				 $absen4="";
			 }else{
				 $absen4=$val->absen4;
			 }
			  if($val->absen5==",")
			 {
				 $absen5="";
			 }else{
				 $absen5=$val->absen5;
			 }
			  if($val->absen6==",")
			 {
				 $absen6="";
			 }else{
				 $absen6=$val->absen6;
			 }
			 
			 $isi.=$absen2.$absen3.$absen4.$absen5.$absen6;
		 }
		 $isi=str_replace(",,",",",$isi);
		  
		 if(!$isi){
		 $isi="'4545434535'";
		 }
		 $isi=str_replace(",,",",",$isi);
		 $isi=SUBSTR($isi,1);
		 $isi=SUBSTR($isi,0,-1);
		return $this->db->query("SELECT * from data_siswa where id IN (".$isi.") and aktifasi='1' and id_kelas='".$this->id_kelas()."'   order by id_kelas asc limit 100");
	}
	function cekStatusHadirFinger($idsiswa)
	{
		$data=$this->db->query("select * from tm_absen_siswa where
		(absen1 like '%,".$idsiswa.",%' or absen2 like '%,".$idsiswa.",%' or absen3 like
		'%,".$idsiswa.",%' or absen4 like '%,".$idsiswa.",%' or absen5 like '%,".$idsiswa.",%' or absen6 like '%,".$idsiswa.",%' ) ")->num_rows();
		if($data)
		{
			return "Tidak Scand";
		}else{
			return "Tidak Hadir";
		}
	}
	function cekStatusHadirAbsen($idsiswa)
	{
		$data=$this->db->query("select * from tm_absen_siswa where absen2 like '%,".$idsiswa.",%' ")->num_rows();
		if($data)
		{
			return "Sakit";
		} 
		
		$data=$this->db->query("select * from tm_absen_siswa where absen3 like '%,".$idsiswa.",%' ")->num_rows();
		if($data)
		{
			return "Izin";
		} 
		$data=$this->db->query("select * from tm_absen_siswa where absen4 like '%,".$idsiswa.",%' ")->num_rows();
		if($data)
		{
			return "Alfa";
		} 
		$data=$this->db->query("select * from tm_absen_siswa where absen5 like '%,".$idsiswa.",%' ")->num_rows();
		if($data)
		{
			return "Dispen";
		} 
		$data=$this->db->query("select * from tm_absen_siswa where absen6 like '%,".$idsiswa.",%' ")->num_rows();
		if($data)
		{
			return "<span class='col-red'><b>Bolos</b></span>";
		} 
		return "Belum diabsen";
	}
}