<?php

class Model extends CI_Model  {
    
	var $tbl="tr_mitra";
 
 	function __construct()
    {
        parent::__construct();
    }
	public function idu()
	{
	    
		return $this->session->userdata("id");
	}
	
	function ketQuota($id)
	{
	     $tahun=$this->m_reff->tahun();
	     $this->db->where("id_tahun",$tahun);
	    $this->db->where("id_mitra",$id);
	    $this->db->order_by("id","DESC");
	    $data=$this->db->get("tr_mitra_quota")->row();
	    return isset($data->ket)?($data->ket):"";
	}
	function dataKelas()
	{
		$data=$this->db->select("DISTINCT(id_kelas) as id_kelas");
		$this->db->order_by("id_kelas","asc");
		return $this->db->get($this->tbl_jadwal)->result();
	}

	function insert_tanggapan()
	{	
		$id = $this->input->post("id");
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);

		$this->db->set("id_pr", $this->idu());
		$this->db->where("id",$id);
		return $this->db->update("tm_catatan",$post);

	}	

	function get_data_pengaduan()
	{
		$query=$this->_get_data_pengaduan();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}

	function _get_data_pengaduan()
	{
				 		  
		$id_kelas=$this->input->post("id_kelas");
	  
	 	$filter="";
	 	//$filter.="AND teruskan like '%1%' ";
		 
		if($id_kelas)
		{
			$filter.="AND id_kelas='".$id_kelas."' ";
		}
	/*	if($id_jenis)
		{
			$filter.="AND id_jenis='".$id_jenis."' ";
		}*/
		
	 
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		
		$idjabatan = $this->m_reff->goField("data_pegawai", "id_jabatan", "WHERE id='".$this->idu()."' ");
		$idjurusan = $this->m_reff->goField("tr_jurusan", "id", "WHERE id_jabatan='".$idjabatan."' ");
		 
		$query="select tm_catatan.*, tm_kelas.id AS kelas_id, tm_kelas.id_jurusan from tm_catatan, tm_kelas where tm_catatan.id_kelas = tm_kelas.id and tm_catatan.id_tahun='".$tahun."' and tm_catatan.id_semester='".$sms."' and tm_kelas.id_jurusan='".$idjurusan."'  $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				 
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
	
	public function count_pengaduan()
	{				
		$query = $this->_get_data_pengaduan();
        return  $this->db->query($query)->num_rows();
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
		   
		 
		  
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from ".$this->tbl."    ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				lokasi LIKE '%".$searchkey."%'  
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
	
	
	
	
	function get_data_siswa()
	{
		$query=$this->_get_data_siswa();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_siswa()
	{
		 $filter="";   
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$jenis_pkl=$this->input->post("jenis_pkl");
		$cari=$this->input->post("cari");
		$id_kelas=$this->input->post("id_kelas");
		$gender=$this->input->post("gender");
		$mitra=$this->input->post("mitra");
		$status=$this->input->post("status");
		$id_pembimbing=$this->input->post("id_pembimbing");
		
		if($id_pembimbing){
		   	$filter.=" AND id_pembimbing='$id_pembimbing' ";
		}
		
		
		if($status=="1")
		{
			$filter.="AND id_mitra IS NOT NULL ";
		}elseif($status=="2")
		{
			$filter.="AND id_mitra IS NULL ";
		}
		
		if($cari)
		{
			$filter.="AND nama like '%".$cari."%' ";
		}
		
	 
		if($id_kelas)
		{	$dtkls="";
	    
			foreach($id_kelas as $valk)
			{
				$dtkls.=$valk.",";
			}
			$dtkls=substr($dtkls,0,-1);
			if($dtkls){
			$filterz="AND id_kelas in (".$dtkls.") ";
			$filter.=str_replace("(,","(",$filterz);
			}
			 $dtklss;
		 
		}else{
		 $dbs=$this->db->get_where("v_kelas",array("id_tk"=>$jenis_pkl))->result();
			 $dtkls="";
			  foreach($dbs as $vals){
						$dtkls.=$vals->id.",";								   
			  }
			  $dtkls=substr($dtkls,0,-1);
			 
			$filterz="AND id_kelas in (".$dtkls.") ";
			$filter.=str_replace("(,","(",$filterz);
		 		
		}
		
		
		if($gender)
		{
			$filter.="AND jk='".$gender."' ";
		}if($mitra)
		{
			$filter.="AND id_mitra='".$mitra."' ";
		}
		 
		$query="select * from v_pkl where  1=1 ".$filter;
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
		$query.=" order by nama   asc";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_siswa()
	{				
		$query = $this->_get_data_siswa();
        return  $this->db->query($query)->num_rows();
	}
	
	
	
	function get_data_pembimbing()
	{
		$query=$this->_get_data_pembimbing();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_pembimbing()
	{
		 $filter="";   
	 
		$cari=$this->input->post("cari"); 
		$status=$this->input->post("status");
		$id_pembimbing=$this->input->post("id_pembimbing");
		$id_mitra=$this->input->post("id_mitra");
		if($id_pembimbing){
		    	$filter.=" AND id_pembimbing='$id_pembimbing' ";
		}
		
		
	 
		if($cari)
		{
		    	$tgl1=$this->tanggal->range_1($cari);
			$tgl2=$this->tanggal->range_2($cari);
		/*	$filter.="and (
			
			(tgl_berangkat >='$tgl1' and tgl_berangkat<='$tgl2') 
			or (monitoring1 >='$tgl1' and monitoring1<='$tgl2') 
			or (monitoring2 >='$tgl1' and monitoring2<='$tgl2') 
			or (monitoring3 >='$tgl1' and monitoring3<='$tgl2') 
			or (monitoring4 >='$tgl1' and monitoring4<='$tgl2') 
			or (monitoring5 >='$tgl1' and monitoring5<='$tgl2') 
			or (monitoring6 >='$tgl1' and monitoring6<='$tgl2') 
			or (tgl_pulang>='$tgl1' and tgl_pulang<='$tgl2') 
			
			)  ";*/
		}
		
	   
		
	    if($id_mitra)
		{
			$filter.="AND id_mitra='".$id_mitra."' ";
		}
		 
		$query="SELECT * FROM tr_mitra_quota where id_pembimbing is not null and id_pembimbing!='' and id_tahun='".$this->m_reff->tahun_asli()."' ".$filter;
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
			//	$query.=" AND (
			//	tgl_berangkat LIKE '%".$searchkey."%'   
			//	) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" GROUP BY  id_mitra,id_pembimbing,tgl_berangkat   order by tgl_berangkat   asc";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" GROUP BY  id_mitra,id_pembimbing,tgl_berangkat   order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_pembimbing()
	{				
		$query = $this->_get_data_pembimbing();
        return  $this->db->query($query)->num_rows();
	}
	
	
	
	
	function insert_mitra()
	{	
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("id_semester",$sms);
	 	return $this->db->insert($this->tbl,$post);
	}
	function update_mitra()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("id_semester",$sms);
		$this->db->where("id",$this->input->post("id"));
	 	return $this->db->update($this->tbl,$post);
		

	return	$this->db->update("tm_mitra",$post);
	}
	function hapus_mitra($id)
	{
		 
		$this->db->where("id",$id);
		return $this->db->delete("tr_mitra");
	}
	
	 function get_open_bursa()
	{
		$query=$this->_get_open_bursa();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file()
	{				
		$query = $this->_get_open_bursa();
        return  $this->db->query($query)->num_rows();
	}
		 
	function save_bursa()
	{
			$var=array();
		$var["hp"]=true; 
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		$var["nis_duplicate"]=false; 
		 
		$tgl=$this->input->get_post("batas");
		$id=$this->input->get_post("id");
		$aksi_edit=$this->input->get_post("aksi_edit");
		 if(isset($_FILES["file"]['tmp_name']))
		{
			$pullpath="bursa";
			$file=$this->m_reff->upload_file("file",$pullpath,"file","JPG,JPEG,PNG,PDF","3000000");
			
			if($aksi_edit=="true"){
				$nama_file=$this->m_reff->goField("tm_bursa_kerja","file","where id='".$id."' ");
				
				if($file["validasi"]!=false)
				{
					$this->m_reff->hapus_file("file_upload/bursa/".$nama_file);  
					$this->db->set("file",$file["name"]);
					$this->db->set("batas",$this->tanggal->eng_($tgl,"-"));
					$this->db->where("id",$id);
					$this->db->update("tm_bursa_kerja");
				}
				
				}else{
					if($file["validasi"]!=false)
					{
						$this->db->set("file",$file["name"]);
						$this->db->set("batas",$this->tanggal->eng_($tgl,"-"));
						$this->db->insert("tm_bursa_kerja");
					}
				}
			
			
		}else{
						if($aksi_edit=="true"){
							  
								$this->db->set("batas",$this->tanggal->eng_($tgl,"-"));
								$this->db->where("id",$id);
								$this->db->update("tm_bursa_kerja");
							 
						}else{
									$this->db->set("batas",$this->tanggal->eng_($tgl,"-"));
									$this->db->insert("tm_bursa_kerja");
						}
		}
		
			return $var;
	}
	function hapus_bursa()
	{
			$id=$this->input->post("id");
		 
			$this->db->where("id",$id);
			$nama_file=$this->m_reff->goField("tm_bursa_kerja","file","where id='".$id."' ");
		 	$nama_file="file_upload/bursa/".$nama_file;
		$this->m_reff->hapus_file($nama_file); 
		$this->db->where("id",$id);
		return $this->db->delete("tm_bursa_kerja");
	}
	function cekSiswa($id_siswa)
	{
	    $sms=$this->m_reff->semester();
	    $tahun=$this->m_reff->tahun();
	//	$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun); 
		return $this->db->get_where("tm_pkl",array("id_siswa"=>$id_siswa))->num_rows();
	}
	function cekSiswaMitra($id_siswa,$jenis)
	{   $sms=$this->m_reff->semester();
	    $tahun=$this->m_reff->tahun();
	//	$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
	//	$this->db->where("jenis_pkl",$jenis);
		return $this->db->get_where("tm_pkl",array("id_siswa"=>$id_siswa))->num_rows();
	}
	function cekQuotaMitra($id_mitra)
	{   $sms=$this->m_reff->semester();
	    $tahun=$this->m_reff->tahun();
	//	$this->db->where("id_semester",$sms);
    	$this->db->where("id_tahun",$tahun);
		$return=$this->db->get_where("tm_pkl",array("id_mitra"=>$id_mitra,"id_tahun"=>$tahun))->num_rows(); //jml yg sudah dialokasikan
		
		$m=$this->db->query("select sum(quota) as quota from tr_mitra_quota where id_mitra='".$id_mitra."'  and id_tahun='".$tahun."'")->row();
		$quota=isset($m->quota)?($m->quota):0;
		return $quota-$return;
		
	}
		function quotaMitra($id_mitra)
	{   $sms=$this->m_reff->semester();
	    $tahun=$this->m_reff->tahun();
	 		
		$m=$this->db->query("select sum(quota) as quota from tr_mitra_quota where id_mitra='".$id_mitra."'   and id_tahun='".$tahun."'")->row();
		$quota=isset($m->quota)?($m->quota):0;
		return $quota ;
		
	}
	
	
	function setMitra()
	{    	$var["report"]="";
		    $sms=$this->m_reff->semester();
	        $tahun=$this->m_reff->tahun();
			
			
		$id_siswa=$this->input->post("id_siswa");
		$id_mitra=$this->input->post("id_mitra");
		if(!$id_mitra){
		                          $this->db->set("_uid",$this->idu());
						          $this->db->set("_utime",date("Y-m-d H:i:s"));
		    $this->db->set("id_semester",$sms);
		    $this->db->set("id_tahun",$tahun);
			$this->db->set("id_pembimbing",null);
			$this->db->set("id_mitra",null);
			$this->db->set("lama",null);
			$this->db->set("jenis_pkl",null);
			$this->db->where("id_siswa",$id_siswa);
			      $this->db->set("tgl_berangkat",null);
			      $this->db->set("tgl_pulang",null);
			      $this->db->set("monitoring1",null);
			      $this->db->set("monitoring2",null);
		          $this->db->set("monitoring3",null);
			      $this->db->set("monitoring4",null);
			      $this->db->set("monitoring5",null);
			      $this->db->set("monitoring6",null);
			return  $this->db->update("tm_pkl");
		}
		$jenis=$this->input->post("jenis_pkl");
		$lama=$this->input->post("id_jam");
		if(!$lama){ $lama=3;}
		$cekq=$this->cekQuotaMitra($id_mitra,$jenis);
		if(!$id_mitra){ $cekq="111"; $lama=null; }
		
		
		
		
		 $data=$this->db->query("select * from tm_pkl where id_tahun='$tahun'   and id_siswa='$id_siswa'  ")->row();
		 if(isset($data->tgl_berangkat)){
		   /*===================================*/
		   $tgl=$data->tgl_berangkat;
		   $tgl_trim=strtotime($tgl);
		    if($lama==1){
		     
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     
		     $tgl_pulang= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		          $this->db->set("monitoring1",$m_1);  
		          $this->db->set("monitoring2",null);
		          $this->db->set("monitoring3",null);
			      $this->db->set("monitoring4",null);
			      $this->db->set("monitoring5",null);
			      $this->db->set("monitoring6",null);
			      $this->db->set("tgl_pulang",$tgl_pulang);
			         
		 }elseif($lama==2){
		      
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		   
		     $tgl_pulang= date('Y-m-d', strtotime('+2 months', $tgl_trim));
		         $this->db->set("monitoring1",$m_1); 
			        $this->db->set("monitoring2",$m_2);
			         $this->db->set("monitoring3",null);
			           $this->db->set("monitoring4",null);
			            $this->db->set("monitoring5",null);
			         $this->db->set("monitoring6",null);
			          $this->db->set("tgl_pulang",$tgl_pulang);
			         
		 }elseif($lama==3){
		      
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $tgl_pulang= date('Y-m-d', strtotime('+3 months', $tgl_trim));
		         $this->db->set("monitoring1",$m_1); 
			        $this->db->set("monitoring2",$m_2); 
			          $this->db->set("monitoring3",$m_3); 
			           $this->db->set("monitoring4",null);
			            $this->db->set("monitoring5",null);
			         $this->db->set("monitoring6",null);
			          $this->db->set("tgl_pulang",$tgl_pulang);
		 }elseif($lama==4){
		     
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
		     $tgl_pulang= date('Y-m-d', strtotime('+4 months', $tgl_trim));
		     
		             $this->db->set("monitoring1",$m_1); 
			         $this->db->set("monitoring2",$m_2); 
			         $this->db->set("monitoring3",$m_3); 
			         $this->db->set("monitoring4",$m_4);
			         $this->db->set("monitoring5",null);
			         $this->db->set("monitoring6",null);
			          $this->db->set("tgl_pulang",$tgl_pulang);
			          
		 }elseif($lama==5){
		      
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
		      $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
		     $tgl_pulang= date('Y-m-d', strtotime('+5 months', $tgl_trim));
		     
		             $this->db->set("monitoring1",$m_1); 
			         $this->db->set("monitoring2",$m_2); 
			         $this->db->set("monitoring3",$m_3); 
			         $this->db->set("monitoring4",$m_4); 
			         $this->db->set("monitoring5",$m_5); 
			         $this->db->set("monitoring6",null);
			       $this->db->set("tgl_pulang",$tgl_pulang);
			          
		 }else{
		     
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
		     $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
		     $m_6= date('Y-m-d', strtotime('+5 months', $tgl_trim));     
		     $tgl_pulang= date('Y-m-d', strtotime('+'.$lama.' months', $tgl_trim));
		     
		             $this->db->set("monitoring1",$m_1); 
			         $this->db->set("monitoring2",$m_2); 
			         $this->db->set("monitoring3",$m_3); 
			         $this->db->set("monitoring4",$m_4); 
			         $this->db->set("monitoring5",$m_5);
			         $this->db->set("monitoring6",$m_6);
			          $this->db->set("tgl_pulang",$tgl_pulang);
			          
		 }
		   
		   /*====================================*/
		 }
		 
		
		
		
		
		
		
		
		
		
		if($cekq>0){
		   $cek=$this->cekSiswaMitra($id_siswa,$jenis);
	   	   if($cek)
		   {
		                          $this->db->set("_uid",$this->idu());
						          $this->db->set("_utime",date("Y-m-d H:i:s"));
			$this->db->where("id_siswa",$id_siswa);
			$this->db->set("id_mitra",$id_mitra);
			$this->db->set("lama",$lama);
			$this->db->set("jenis_pkl",$jenis);
			  $this->db->update("tm_pkl");
		   }else{
			                      $this->db->set("_cid",$this->idu());
						          $this->db->set("_ctime",date("Y-m-d H:i:s"));
		     $this->db->set("id_semester",$sms);
		    $this->db->set("id_tahun",$tahun);
			$this->db->set("id_siswa",$id_siswa);
			$this->db->set("id_mitra",$id_mitra);
			$this->db->set("lama",$lama);
			$this->db->set("jenis_pkl",$jenis);
			  $this->db->insert("tm_pkl");
		    }
		    
		    
		
		    
		    
		}else{
		$var["report"]="overload";
		}
	
		return $var;
	}
	
	function setPembimbing()
	{
	    	$var["report"]="";
		    $sms=$this->m_reff->semester();
	        $tahun=$this->m_reff->tahun();
			
			$id_siswa=$this->input->post("id_siswa");
			$id_pembimbing=$this->input->post("id_pembimbing");
			$jenis=1;//$this->input->post("jenis_pkl");
			//$lama=3; 
	 		$data=$this->db->query("select * from tr_mitra_quota where id='".$id_pembimbing."' ")->row();
			
			$lama=isset($data->lama_pkl)?($data->lama_pkl):"";
			$tgl=$this->input->post("tgl");
			$tgl=$this->tanggal->eng_($tgl,"-");
	

		   $cek=$this->cekSiswa($id_siswa);
		   		 if($lama==1){
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     
				     	$tgl_pulang= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				         $this->db->set("monitoring1",$m_1);  
				          $this->db->set("monitoring2",null);
				          $this->db->set("monitoring3",null);
					      $this->db->set("monitoring4",null);
					      $this->db->set("monitoring5",null);
					      $this->db->set("monitoring6",null);
					         
				 }elseif($lama==2){
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				   
				     $tgl_pulang= date('Y-m-d', strtotime('+2 months', $tgl_trim));
				         $this->db->set("monitoring1",$m_1); 
					        $this->db->set("monitoring2",$m_2);
					       
				          $this->db->set("monitoring3",null);
					      $this->db->set("monitoring4",null);
					      $this->db->set("monitoring5",null);
					      $this->db->set("monitoring6",null);
					         
				 }elseif($lama==3){
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
				     $tgl_pulang= date('Y-m-d', strtotime('+3 months', $tgl_trim));
				         $this->db->set("monitoring1",$m_1); 
					        $this->db->set("monitoring2",$m_2); 
					          $this->db->set("monitoring3",$m_3); 
					           $this->db->set("monitoring4",null);
					      $this->db->set("monitoring5",null);
					      $this->db->set("monitoring6",null);
				 }elseif($lama==4){
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
				     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
				     $tgl_pulang= date('Y-m-d', strtotime('+4 months', $tgl_trim));
				     
				             $this->db->set("monitoring1",$m_1); 
					         $this->db->set("monitoring2",$m_2); 
					         $this->db->set("monitoring3",$m_3); 
					         $this->db->set("monitoring4",$m_4); 
					          $this->db->set("monitoring5",null);
					      $this->db->set("monitoring6",null);
					          
				 }elseif($lama==5){
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
				     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
				      $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
				     $tgl_pulang= date('Y-m-d', strtotime('+5 months', $tgl_trim));
				     
				             $this->db->set("monitoring1",$m_1); 
					         $this->db->set("monitoring2",$m_2); 
					         $this->db->set("monitoring3",$m_3); 
					         $this->db->set("monitoring4",$m_4); 
					         $this->db->set("monitoring5",$m_5); 
					          $this->db->set("monitoring6",null);
					          
				 }else{
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
				     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
				     $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
				     $m_6= date('Y-m-d', strtotime('+5 months', $tgl_trim));     
				     $tgl_pulang= date('Y-m-d', strtotime('+'.$lama.' months', $tgl_trim));
				     
				             $this->db->set("monitoring1",$m_1); 
					         $this->db->set("monitoring2",$m_2); 
					         $this->db->set("monitoring3",$m_3); 
					         $this->db->set("monitoring4",$m_4); 
					         $this->db->set("monitoring5",$m_5);
					         $this->db->set("monitoring6",$m_6);
					          
				 }
	   	   if($cek)
		   {
               	$this->db->set("_uid",$this->idu());
	          	$this->db->set("_utime",date("Y-m-d H:i:s"));
				$this->db->where("id_siswa",$id_siswa);
				$this->db->set("id_quota",$id_pembimbing); 
			  	$this->db->update("tm_pkl");
		   }else{
			 	$this->db->set("_cid",$this->idu());
	          	$this->db->set("_ctime",date("Y-m-d H:i:s"));
		     	$this->db->set("id_semester",$sms);
		    	$this->db->set("id_tahun",$tahun);
				$this->db->set("id_siswa",$id_siswa);
				$this->db->set("id_quota",$id_pembimbing);
				$this->db->set("jenis_pkl",1);
			  	$this->db->insert("tm_pkl");
		    }
	 
	
		return $var;
	}
	public function setOtw($id)
	{
	     	$var["report"]="";
		 	$sms=$this->m_reff->semester();
	     	$tahun=$this->m_reff->tahun(); 
			$id_siswa=$this->input->post("id_siswa");
			$tgl=$this->input->post("tgl");
			$tgl=$this->tanggal->eng_($tgl,"-");
		//  $var["report"]=$tgl;
	//	return $var;
		 $data=$this->db->query("select * from tr_mitra_quota where id='".$id."' ")->row();
		 if(!isset($data->id)){
		     $var["report"]=false;
		     return $var;
		 }
		 
		 $lama=isset($data->lama_pkl)?($data->lama_pkl):"";
		 if($lama==1){
		     $tgl_trim=strtotime($tgl);
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     
		     	$tgl_pulang= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		         $this->db->set("monitoring1",$m_1);  
		          $this->db->set("monitoring2",null);
		          $this->db->set("monitoring3",null);
			      $this->db->set("monitoring4",null);
			      $this->db->set("monitoring5",null);
			      $this->db->set("monitoring6",null);
			         
		 }elseif($lama==2){
		     $tgl_trim=strtotime($tgl);
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		   
		     $tgl_pulang= date('Y-m-d', strtotime('+2 months', $tgl_trim));
		         $this->db->set("monitoring1",$m_1); 
			        $this->db->set("monitoring2",$m_2);
			       
		          $this->db->set("monitoring3",null);
			      $this->db->set("monitoring4",null);
			      $this->db->set("monitoring5",null);
			      $this->db->set("monitoring6",null);
			         
		 }elseif($lama==3){
		     $tgl_trim=strtotime($tgl);
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $tgl_pulang= date('Y-m-d', strtotime('+3 months', $tgl_trim));
		         $this->db->set("monitoring1",$m_1); 
			        $this->db->set("monitoring2",$m_2); 
			          $this->db->set("monitoring3",$m_3); 
			           $this->db->set("monitoring4",null);
			      $this->db->set("monitoring5",null);
			      $this->db->set("monitoring6",null);
		 }elseif($lama==4){
		     $tgl_trim=strtotime($tgl);
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
		     $tgl_pulang= date('Y-m-d', strtotime('+4 months', $tgl_trim));
		     
		             $this->db->set("monitoring1",$m_1); 
			         $this->db->set("monitoring2",$m_2); 
			         $this->db->set("monitoring3",$m_3); 
			         $this->db->set("monitoring4",$m_4); 
			          $this->db->set("monitoring5",null);
			      $this->db->set("monitoring6",null);
			          
		 }elseif($lama==5){
		     $tgl_trim=strtotime($tgl);
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
		      $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
		     $tgl_pulang= date('Y-m-d', strtotime('+5 months', $tgl_trim));
		     
		             $this->db->set("monitoring1",$m_1); 
			         $this->db->set("monitoring2",$m_2); 
			         $this->db->set("monitoring3",$m_3); 
			         $this->db->set("monitoring4",$m_4); 
			         $this->db->set("monitoring5",$m_5); 
			          $this->db->set("monitoring6",null);
			          
		 }else{
		     $tgl_trim=strtotime($tgl);
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
		     $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
		     $m_6= date('Y-m-d', strtotime('+5 months', $tgl_trim));     
		     $tgl_pulang= date('Y-m-d', strtotime('+'.$lama.' months', $tgl_trim));
		     
		             $this->db->set("monitoring1",$m_1); 
			         $this->db->set("monitoring2",$m_2); 
			         $this->db->set("monitoring3",$m_3); 
			         $this->db->set("monitoring4",$m_4); 
			         $this->db->set("monitoring5",$m_5);
			         $this->db->set("monitoring6",$m_6);
			          
		 }
		 
		  
			    $this->db->where("id_siswa",$id_siswa);
			    $this->db->set("tgl_berangkat",$tgl_otw); 
              	$this->db->set("_uid",$this->idu());
	          	$this->db->set("_utime",date("Y-m-d H:i:s"));
			    $this->db->set("tgl_pulang",$tgl_pulang); 
			    $this->db->update("tm_pkl");
		    
	  $var["report"]=$tgl;
		return $var;
	}
	
	
		function download_format($idkelas)
	{
		
//////start
        $objPHPExcel = new PHPExcel();
//style
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '6CCECB')
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
        );
        $style2 = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccff99')
            )
        );
        $style3 = array(
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccff99')
            )
        );
         $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
        
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setAutoSize(true);
        
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('B')->setAutoSize(true);

//create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'NO ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'KODE SISWA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'KELAS');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'NAMA ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'ALAMAT SISWA ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('F1', 'KODE QUOTA ');
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:F1')->applyFromArray($style);
      
 
// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA SISWA PKL');
		$db=$this->db->query("select * from data_siswa where id_kelas='".$idkelas."' and id_sts_data in (1,4)")->result();
	  	
		$shit = 1;$no=1;
		foreach($db as $val)
		{   $kelas=$this->m_reff->goField("v_kelas","nama","where id='".$idkelas."' ");
		      $shit++;
	         $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $shit . '', $no++);
	          $objPHPExcel->getActiveSheet(0)->setCellValue('B' . $shit . '', $val->id);
	           $objPHPExcel->getActiveSheet(0)->setCellValue('C' . $shit . '', $kelas);
	          $objPHPExcel->getActiveSheet(0)->setCellValue('D' . $shit . '', $val->nama); 
	          $objPHPExcel->getActiveSheet(0)->setCellValue('E' . $shit . '', $val->alamat);
		}
		
		
//<!-------------------------------------------------------------------------------  --->	
       
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'DATA MITRA QUOTA');
        $objPHPExcel->addSheet($myWorkSheet, 1);
  
        $objPHPExcel->getSheet(1)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->getColumnDimension('G')->setAutoSize(true);

        $objPHPExcel->getSheet(1)->setCellValue('A1', 'KODE');
        $objPHPExcel->getSheet(1)->setCellValue('B1', 'NAMA MITRA');
        $objPHPExcel->getSheet(1)->setCellValue('C1', 'ALAMAT MITRA');
        $objPHPExcel->getSheet(1)->setCellValue('D1', 'QUOTA');
        $objPHPExcel->getSheet(1)->setCellValue('E1', 'PEMBIMBING');
        $objPHPExcel->getSheet(1)->setCellValue('F1', 'TGL BERANGKAT');
        $objPHPExcel->getSheet(1)->setCellValue('G1', 'LAMA PKL');
        $objPHPExcel->getSheet(1)->getStyle('A1:G1')->applyFromArray($style);
		

        $qquota = "
        	SELECT
        		tr_mitra_quota.*,
        		tr_mitra.id AS mitra_id,
        		tr_mitra.nama,
        		tr_mitra.lokasi
        	FROM 
        		tr_mitra_quota, 
        		tr_mitra 
        	WHERE 
        		tr_mitra_quota.id_mitra = tr_mitra.id 
        	ORDER BY tr_mitra.nama 
        ";

		$db=$this->db->query($qquota)->result();

		$shit = 1;$no=1;
		foreach($db as $val)
		{    
		    $shit++;
	       	$objPHPExcel->getSheet(1)->setCellValue('A' . $shit . '', $val->id);
	        $objPHPExcel->getSheet(1)->setCellValue('B' . $shit . '', $val->nama);
	        $objPHPExcel->getSheet(1)->setCellValue('C' . $shit . '', $val->lokasi);
	        $objPHPExcel->getSheet(1)->setCellValue('D' . $shit . '', $val->quota);
	        $objPHPExcel->getSheet(1)->setCellValue('E' . $shit . '', $this->m_reff->goField("data_pegawai", "nama", " WHERE id='".$val->id_pembimbing."'"));
	        $objPHPExcel->getSheet(1)->setCellValue('F' . $shit . '', date("d/m/Y", strtotime($val->tgl_berangkat)));
	        $objPHPExcel->getSheet(1)->setCellValue('G' . $shit . '', $val->lama_pkl);

		}
		 
        
//<!-------------------------------------------------------------------------------------->	

  
//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format-upload-siswa-pkl.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
	
	function import_data()
	{
	    $file_form="file";
	    	$var=array();
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		 
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["file"]['tmp_name']))
		{
				
				
				
				$this->load->library("PHPExcel");
		$insert=0;$gagal=0;$edit=0;$validasi_hp=true;$validasi=true;
		$file   = explode('.',$_FILES[$file_form]['name']);
		$length = count($file);
		if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){
         		$tmp    = $_FILES[$file_form]['tmp_name']; 
	 
			    $load = PHPExcel_IOFactory::load($tmp);
                $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
				$i=1;
					 
				foreach ($sheets as $sheet) {
				if ($i > 1) {						
					 
					 	 $id_siswa=$this->m_reff->sheet($sheet,1);
						 $id_quota=$this->m_reff->sheet($sheet,5);
						 /*
						 $lama=$this->m_reff->sheet($sheet,6);
						 $otw=$this->m_reff->sheet($sheet,7);
						 
						 $id_pembimbing=$this->m_reff->sheet($sheet,8);*/ //pembimbing

						 $this->db->where("id", $id_quota);
						 $qt = $this->db->get("tr_mitra_quota")->row_array();

						 $id_mitra 	= $qt["id_mitra"];
						 $otw 		= $qt["tgl_berangkat"];
						 $lama 		= $qt["lama_pkl"];
						 $tgl=$this->tanggal->format($otw);
						 
						$cek=$this->cek_siswa($id_siswa);
						
							$cekMitra=$this->db->query("select * from tr_mitra where id='".$id_mitra."'")->num_rows();
							if(!$cekMitra and $id_mitra){
							    $var["gagal"]=false;
							    $var["info"]="Terdapat KODE MITRA yang tidak terdaftar pada bari ke ".($i-1);
							    return $var;
							}
							/*
							$cekPem=$this->db->query("select * from data_pegawai where id='".$id_pembimbing."'")->num_rows();
							if(!$cekPem and $id_pembimbing){
							    $var["gagal"]=false;
							    $var["info"]="Terdapat KODE PEMBIMBING yang tidak sesuai pada bari ke ".($i-1);
							     return $var;
							}*/
						
						
						
						
						
						
			if(strlen($otw)==10 and $lama){
		   /*===================================*/
		   $tgl_trim=strtotime($tgl);
		    if($lama==1){
		     
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     
		     $tgl_pulang= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		          $this->db->set("monitoring1",$m_1);  
		          $this->db->set("monitoring2",null);
		          $this->db->set("monitoring3",null);
			      $this->db->set("monitoring4",null);
			      $this->db->set("monitoring5",null);
			      $this->db->set("monitoring6",null);
			      $this->db->set("tgl_pulang",$tgl_pulang);
			         
		 }elseif($lama==2){
		      
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		   
		     $tgl_pulang= date('Y-m-d', strtotime('+2 months', $tgl_trim));
		         $this->db->set("monitoring1",$m_1); 
			        $this->db->set("monitoring2",$m_2);
			         $this->db->set("monitoring3",null);
			           $this->db->set("monitoring4",null);
			            $this->db->set("monitoring5",null);
			         $this->db->set("monitoring6",null);
			          $this->db->set("tgl_pulang",$tgl_pulang);
			         
		 }elseif($lama==3){
		      
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $tgl_pulang= date('Y-m-d', strtotime('+3 months', $tgl_trim));
		         $this->db->set("monitoring1",$m_1); 
			        $this->db->set("monitoring2",$m_2); 
			          $this->db->set("monitoring3",$m_3); 
			           $this->db->set("monitoring4",null);
			            $this->db->set("monitoring5",null);
			         $this->db->set("monitoring6",null);
			          $this->db->set("tgl_pulang",$tgl_pulang);
		 }elseif($lama==4){
		     
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
		     $tgl_pulang= date('Y-m-d', strtotime('+4 months', $tgl_trim));
		     
		             $this->db->set("monitoring1",$m_1); 
			         $this->db->set("monitoring2",$m_2); 
			         $this->db->set("monitoring3",$m_3); 
			         $this->db->set("monitoring4",$m_4);
			         $this->db->set("monitoring5",null);
			         $this->db->set("monitoring6",null);
			          $this->db->set("tgl_pulang",$tgl_pulang);
			          
		 }elseif($lama==5){
		      
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
		      $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
		     $tgl_pulang= date('Y-m-d', strtotime('+5 months', $tgl_trim));
		     
		             $this->db->set("monitoring1",$m_1); 
			         $this->db->set("monitoring2",$m_2); 
			         $this->db->set("monitoring3",$m_3); 
			         $this->db->set("monitoring4",$m_4); 
			         $this->db->set("monitoring5",$m_5); 
			         $this->db->set("monitoring6",null);
			       $this->db->set("tgl_pulang",$tgl_pulang);
			          
		 }else{
		     
		     $tgl_otw=$tgl;
		     $m_1=$this->tanggal->tambah_tgl($tgl,7);
		     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
		     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
		     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
		     $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
		     $m_6= date('Y-m-d', strtotime('+5 months', $tgl_trim));     
		     $tgl_pulang= date('Y-m-d', strtotime('+'.$lama.' months', $tgl_trim));
		     
		             $this->db->set("monitoring1",$m_1); 
			         $this->db->set("monitoring2",$m_2); 
			         $this->db->set("monitoring3",$m_3); 
			         $this->db->set("monitoring4",$m_4); 
			         $this->db->set("monitoring5",$m_5);
			         $this->db->set("monitoring6",$m_6);
			          $this->db->set("tgl_pulang",$tgl_pulang);
			          
		 }
		   
		   /*====================================*/
		 }
		 			
						 
						
						if($cek){
						     if($id_mitra){
						     $this->db->set("_uid",$this->idu());
						          $this->db->set("_utime",date("Y-m-d H:i:s"));
						          
						    	$this->db->set("id_quota",$id_quota);
						    $this->db->set("id_mitra",$id_mitra);
						    //$this->db->set("lama",$lama);
						   //  $this->db->set("lama",$lama);
						    
						    //$this->db->set("id_pembimbing",$id_pembimbing);
						    	$this->db->where("id_siswa",$id_siswa);
						      	$this->db->where("id_tahun",$this->m_reff->tahun());
	                      //    $this->db->where("id_semester",$this->m_reff->semester());
								$this->db->update("tm_pkl");
								$edit++;
						     }
						}else{
						    if($id_mitra){
						          $this->db->set("id_tahun",$this->m_reff->tahun());
	                         //     $this->db->set("id_semester",$this->m_reff->semester());
						         $this->db->set("_cid",$this->idu());
						          $this->db->set("_ctime",date("Y-m-d H:i:s"));
						 		$this->db->set("id_quota",$id_quota);
						    	$this->db->set("id_mitra",$id_mitra);
						     	//$this->db->set("lama",$lama);
						    	//$this->db->set("id_pembimbing",$id_pembimbing);
						    	$this->db->set("id_siswa",$id_siswa);
								$this->db->insert("tm_pkl");
								$insert++;
						    }
						}
						
						
						 
				      
				}
				$i++;
                }
               
		}else{
			 $var["file"]=false;
			 $var["type_file"]="xlsx";
		}
			  $var["import_data"]=true;
			  $var["data_insert"]=$insert;
			  $var["data_gagal"]=$gagal;
			  $var["data_edit"]=$edit;
			  $var["hp"]=$validasi_hp;
			  $var["validasi"]=$validasi;
		return $var;
				
				
				 
				
			 
		}else{
				return $var;
		}
	}
	function cek_siswa($id_siswa)
	{           
	          $this->db->where("id_tahun",$this->m_reff->tahun());
	    //       $this->db->where("id_semester",$this->m_reff->semester());
	          $this->db->where("id_siswa",$id_siswa);
	  return  $this->db->get("tm_pkl")->num_rows();
	}
	
	
	
	
	function download_data_pkl($id_quota)
	{
	    
//////start
        $objPHPExcel = new PHPExcel();
//style
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '6CCECB')
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
        );
        $style2 = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccff99')
            )
        );
        $style3 = array(
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccff99')
            )
        );
         $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
    
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', "NO");
         $objPHPExcel->getActiveSheet(0)->setCellValue('B1', "NAMA");
          $objPHPExcel->getActiveSheet(0)->setCellValue('C1', "KELAS");
           $objPHPExcel->getActiveSheet(0)->setCellValue('D1', "ALAMAT SISWA");
            $objPHPExcel->getActiveSheet(0)->setCellValue('E1', "TEMPAT PKL");
            $objPHPExcel->getActiveSheet(0)->setCellValue('F1', "PEMBIMBING");
        
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:F1')->applyFromArray($style);
      
 
// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA SISWA PKL');
		$db=$this->db->query("select * from v_pkl where id_quota='".$id_quota."' ")->result();
	  	
		$shit = 1;$no=1;
		foreach($db as $val)
		{   $kelas=$this->m_reff->goField("v_kelas","nama","where id='".$val->id_kelas."' ");
		    $tempat_pkl=$this->m_reff->goField("tr_mitra","nama","where id='".$val->id_mitra."' ");
		    $pembimbing=$this->m_reff->goField("v_pegawai","nama","where id='".$val->id_pembimbing."' ");
		      $shit++;
	         $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $shit . '', $no++);
	          $objPHPExcel->getActiveSheet(0)->setCellValue('B' . $shit . '', $val->nama);
	           $objPHPExcel->getActiveSheet(0)->setCellValue('C' . $shit . '', $kelas);
	          $objPHPExcel->getActiveSheet(0)->setCellValue('D' . $shit . '', $val->alamat); 
	          $objPHPExcel->getActiveSheet(0)->setCellValue('E' . $shit . '', $tempat_pkl);
	           $objPHPExcel->getActiveSheet(0)->setCellValue('F' . $shit . '', $pembimbing);
		}
		
		
//<!-------------------------------------------------------------------------------  --->	
       
        
//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data-siswa-pkl.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
}