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
	function copas_tahap1()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$cek=$this->db->get("tm_mapel_ajar")->result();
		 if($cek) //jika cek ada
		 {
			 return false;
		 }
		
		if($sms==1)//ganjil
		{
			$tahun=$this->m_reff->tahun();
			$tahun=($tahun-1);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",1);
		}else{ //jika genap 
			$tahun=$this->m_reff->tahun();
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",1);
		}
		
		$this->db->where("id_guru",$this->idu());
		$db=$this->db->get("tm_mapel_ajar")->result();
		foreach($db as $db)
		{
			$data=array(
			"id_mapel"=>$db->id_mapel,
			"id_kelas"=>$db->id_kelas,
			"id_guru"=>$db->id_guru,
			"id_semester"=>$this->m_reff->semester(),
			"id_tahun"=>$this->m_reff->tahun(),
			"jml_jam"=>$db->jml_jam,
			"_cid"=>$this->idu(),
			"rpp"=>$db->rpp,		
			);
			$this->db->insert("tm_mapel_ajar",$data);
		}
		return true;
	}function copas_tahap4()
	{
		$smsbaru=$sms=$this->m_reff->semester();
		$tahunbaru=$tahun=$this->m_reff->tahun();
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$cek=$this->db->get("tm_penjadwalan")->result();
		 if($cek) //jika cek ada
		 {
			 return false;
		 }
		$filter="";
		if($sms==1)//ganjil
		{
			$tahun=$this->m_reff->tahun();
			$tahun=($tahun-1);
			$filter.=" AND id_tahun='".$tahun."'";
			$filter.=" AND id_semester='2'";
		}else{ //jika genap 
			$tahun=$this->m_reff->tahun();
			$filter.=" AND id_tahun='".$tahun."'";
			$filter.=" AND id_semester='1'";
		}
		$filter.=" AND id_mapel IN(select id_mapel from tm_mapel_ajar where id_guru='".$this->idu()."' and id_tahun='".$this->m_reff->tahun()."' and id_semester='".$this->m_reff->semester()."'  )";
		 
		$db=$this->db->query("select * from tm_penjadwalan where id_guru='".$this->idu()."' ".$filter)->result();
		foreach($db as $db)
		{
			 
			$jamin=substr($db->jam,1);
			$jamin=substr($jamin,0,-1);
			$ex=explode(",",$jamin);
			$jim="";
			foreach($ex as $val)
			{
				$jim.=" or jam like '%,".$val.",%' ";
			}
			$jim=substr($jim,3);
			
			$cek=$this->db->query("select * from tm_penjadwalan where id_tahun='".$tahunbaru."'
			and id_semester='".$smsbaru."' and id_kelas='".$db->id_kelas."' and id_hari='".$db->id_hari."'  and  ( ".$jim." )   ")->num_rows();
			if(!$cek)
			{
				$data=array(
				"id_mapel"=>$db->id_mapel,
				"id_kelas"=>$db->id_kelas,
				"id_guru"=>$db->id_guru,
				"id_semester"=>$this->m_reff->semester(),
				"id_tahun"=>$this->m_reff->tahun(),
				"id_hari"=>$db->id_hari,
				"jam"=>$db->jam,
				"_cid"=>$this->idu(),
				);
				$this->db->insert("tm_penjadwalan",$data);
			}
		}
		return true;
	} 
	function jmlKelasAjar()
	{
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_semester",$this->m_reff->semester());
		$this->db->where("id_tahun",$this->m_reff->tahun());
		return $this->db->get("tm_mapel_ajar")->num_rows();
	}function jmlJamMengajar()
	{
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_semester",$this->m_reff->semester());
		$this->db->where("id_tahun",$this->m_reff->tahun());
		$this->db->select("sum(jml_jam) as jml");
		$return= $this->db->get("tm_mapel_ajar")->row();
		return isset($return->jml)?($return->jml):"";
	}
	function sts()
	{
		return $this->m_reff->goField("data_pegawai","sts_isi","where id='".$this->idu()."' ");
	}
	function cektahap($id)
	{
		return 1;//$this->m_reff->goField("data_pegawai","tahap".$id,"where id='".$this->idu()."' ");
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
		$sms=$this->m_reff->semester();
		$thn=$this->m_reff->tahun();
		$this->db->where("id_tahun",$thn);
		$this->db->where("id_semester",$sms);
		$this->db->where("id_guru",$this->idu());
	return	$this->db->get("tm_kikd")->num_rows();
	}
	
	 function get_open($tbl,$search=null)
	{
		$query=$this->_get_datatables_open($tbl,$search);
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file($tbl,$search=null)
	{				
		$query = $this->_get_datatables_open($tbl,$search);
        return  $this->db->query($query)->num_rows();
	}
	  function dataProfile()
	 {
		$idu=$this->session->userdata("id");
		$this->db->where("id_admin",$idu);
		return $this->db->get("admin")->row();
		 
	 }
	private function _get_datatables_open($tbl,$search=null)
	{
		 
		$filter="";
		$mapelajar=$this->input->post("mapelajar");
		if($mapelajar)
		{
			$filter.=" AND id_mapel_ajar='".$mapelajar."' ";
		}
		$kelas=$this->input->post("kelas");
		if($kelas)
		{
			$filter.=" AND id_kelas='".$kelas."' ";
		}
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
	 
	 
	$query="select * from ".$tbl."  where  id_guru='".$this->idu()."' and id_semester='".$sms."' and id_tahun='".$tahun."'  $filter and mapel is not null ";
		 

	//	$column = array('', 'nama'  );
	//	$i=0;
	//	foreach ($column as $item) 
	//	{
	//	$column[$i] = $item;
	//	}
		
		if(isset($_POST['search']['value']) and $search!=null){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			 ".$search." LIKE '%".$searchkey."%'  
			) ";
		}
		 if($tbl=="v_kikd" )
		 {
			$query.="group by nama_tingkat,mapel,id_tahun,id_semester,id_guru,kd3_no";
		 }elseif($tbl=="v_materi")
		 {
			 $query.="group by nama_tingkat,mapel,id_tahun,id_semester,id_guru,kd3_no,materi ORDER BY CAST(SUBSTR(kd3_no,3,5) AS SIGNED INTEGER) ASC";
			 return $query;
		 }
		 
		if($tbl=="v_kikd" )
		 {
			 $query.=" ORDER BY CAST(SUBSTR(kd3_no,3,5) AS SIGNED INTEGER) ASC ";
		 }else{			 
		 
						if(isset($_POST['order']))
						{
						$query.=" order by id asc";
						} 
						else if(isset($order))
						{
							$order = $order;
							$query.=" order by ".key($order)." ".$order[key($order)] ;
						}
		
		 }
		return $query;
	
	}
	function insert_kelas()
	{
		$var=array();
		
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		
		$idkelas=$this->input->post("id_kelas");
		$id_mapel=$this->input->post("id_mapel");
		$jml_jam=$this->input->post("jml_jam");
		$total_jam=$this->input->post("total_jam");
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		
		$this->db->where("id_kelas",$idkelas);
		$this->db->where("id_mapel",$id_mapel);
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_guru",$this->idu());
		$cek=$this->db->get("tm_mapel_ajar")->num_rows();
		if(!$cek)
		{		
			$nip=$this->nip();
			$path1="file_upload/guru/".$nip; //tahun ajaran
			if (!file_exists($path1)) {
				mkdir($path1,0777, true);
			}

			if(isset($_FILES["upload"]['tmp_name']))
			{
				$pullpath="guru/".$nip;
				$file=$this->m_reff->upload_file("upload",$pullpath,"RPP","XLS,XLSX,DOCX,PPT,PPTX,PDF,ZIP,RAR","20000000");
				  
				if($file["validasi"]!=false)
				{
					$files="file_upload/".$pullpath."/".$file["name"];
						
					$var["jadwal_duplicate"]=false;
					$this->db->set("rpp",$file["name"]);
					$this->db->set("id_kelas",$idkelas);
					$this->db->set("id_mapel",$id_mapel);
					$this->db->set("id_semester",$sms);
					$this->db->set("id_tahun",$tahun);
					$this->db->set("jml_jam",$jml_jam);
					$this->db->set("total_jam",$total_jam);
					$this->db->set("id_guru",$this->idu());
					  $this->db->insert("tm_mapel_ajar");
						return	   $this->m_reff->isi_kikd($tahun,$sms,$idkelas,$id_mapel,$this->idu());
					 
				}else{
				
				return $file;
				}
				 
			}else{
			     	$this->db->set("id_kelas",$idkelas);
					$this->db->set("id_mapel",$id_mapel);
					$this->db->set("id_semester",$sms);
					$this->db->set("id_tahun",$tahun);
					$this->db->set("jml_jam",$jml_jam);
					$this->db->set("id_guru",$this->idu());
						$this->db->set("total_jam",$total_jam);
					  $this->db->insert("tm_mapel_ajar"); 
						return	   $this->m_reff->isi_kikd($tahun,$sms,$idkelas,$id_mapel,$this->idu());
			}
			return false;
		
		}else{
			$var["jadwal_duplicate"]=true;
		}
		return $var;
	}		

	function update_mapelajar_tahap1()
	{
			$id=$this->input->post("id");
			$idkelas=$this->input->post("id_kelas");
			$id_mapel=$this->input->post("id_mapel");
			$jml_jam=$this->input->post("jml_jam");
			$total_jam=$this->input->post("total_jam");
			$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
			
			$this->db->where("id_kelas",$idkelas);
			$this->db->where("id_mapel",$id_mapel);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_guru",$this->idu());
			$this->db->where("id!=",$id);
			$cek=$this->db->get("tm_mapel_ajar")->num_rows();
			if(!$cek)
			{		
		
		if(isset($_FILES["upload"]['tmp_name']))
		{
			
			$nip=$this->nip();
			$path1="file_upload/guru/".$nip; 
			if (!file_exists($path1)) {
				mkdir($path1,0777, true);
			}
		
			 
			$pullpath="guru/".$nip;
			$file=$this->m_reff->upload_file("upload",$pullpath,"RPP","XLS,XLSX,DOCX,PPT,PPTX,PDF,ZIP,RAR","20000000");
						
			if($file["validasi"]!=false) //cepi
			{
		 
			$nama_file=$this->m_reff->goField("tm_mapel_ajar","rpp","where id='".$id."' ");
			if(!$nama_file){ $nama_file="xxx";}
			if (file_exists($path1."/".$nama_file)) {
				 $this->m_reff->hapus_file("file_upload/".$pullpath."/".$nama_file);  
			}
			
		 
				$var["jadwal_duplicate"]=false; 
				$this->db->set("rpp",$file["name"]);
			//	$this->db->set("id_kelas",$idkelas);
			//	$this->db->set("id_mapel",$id_mapel);
				$this->db->set("jml_jam",$jml_jam);
					$this->db->set("total_jam",$total_jam);
			//	$this->db->set("id_guru",$this->idu());
				$this->db->where("id",$id);
				return $this->db->update("tm_mapel_ajar");
				 return $this->db->query("DELETE from tm_penjadwalan where id_guru='".$this->idu()."' 
					and id_semester='".$sms."' and id_tahun='".$tahun."' and id_mapel='".$id_mapel."'");
			}else{
			return $file;	
				
			}
			
		}else{
		
			//	$this->db->set("id_kelas",$idkelas);
			//	$this->db->set("id_mapel",$id_mapel);
				$this->db->set("total_jam",$total_jam);
				$this->db->set("jml_jam",$jml_jam);
			//	$this->db->set("id_guru",$this->idu());
				$this->db->where("id",$id);
			return	 $this->db->update("tm_mapel_ajar");
				 return $this->db->query("DELETE from tm_penjadwalan where id_guru='".$this->idu()."' 
					and id_semester='".$sms."' and id_tahun='".$tahun."' and id_mapel='".$id_mapel."'");
		
		}
			
			
			}else{
				$var["jadwal_duplicate"]=true;
			}
			return $var;
	}
	function hapus_kikd_satuan($idkelas,$idmapel)
	{
	    	$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
	    $data=$this->db->query("select id from v_mapel_ajar where id_semester='".$sms."' and id_tahun='".$tahun."' and id_guru='".$this->idu()."' and id_mapel='".$idmapel."' and id_kelas='".$idkelas."' ")->row();
	    $id=isset($data->id)?($data->id):"";
	    
	     $this->db->where("id_guru",$this->idu());
	    $this->db->where("id_mapel_ajar",$id);
	     $this->db->where("id_semester",$sms);
	      $this->db->where("id_tahun",$tahun);
	   return $this->db->delete("tm_kikd");
	    
	    
	}
	function hapus_kelas()
	{
		$id=$this->input->post("id");
		$idkelas=$this->input->post("idkelas");
		$idmapel=$this->input->post("idmapel");
		$this->hapus_kikd_satuan($idkelas,$idmapel);
		$this->hapus_penjadwalan($idkelas,$idmapel);
		$this->db->where("id",$id);
		$this->db->where("id_guru",$this->idu());
		$file=$this->m_reff->goField("tm_mapel_ajar","rpp","where id='".$id."' and id_guru='".$this->idu()."' ");
		$nip=$this->m_reff->goField("data_pegawai","nip","where id='".$this->idu()."' ");
            	if ((file_exists("file_upload/guru/".$nip."/".$file))) { 
            	    unlink("file_upload/guru/".$nip."/".$file);
            	}
            	$databahan=$this->db->query("select * from tm_bahan_ajar where id_guru='".$this->idu()."' and id_mapel='".$idmapel."' and sumber='2' ")->result();
            	foreach($databahan as $bahan)
            	{
            	    if ((file_exists($bahan->file))) { 
            	             unlink($bahan->file);
            	        }
            	}
	return	$this->db->delete("tm_mapel_ajar");
	}
	function hapus_penjadwalan($idkelas,$idmapel)
	{	
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_kelas",$idkelas);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru",$this->idu());
	return	$this->db->delete("tm_penjadwalan");
	}
	function mapelAjar()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_guru",$this->idu());
	return	$this->db->get("tm_mapel_ajar")->result();
	}
	function mapelAjarGroup()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->group_by("mapel,id_tk");
		$this->db->select("nama_tingkat,kelas,mapel,id");
		$this->db->where("id_guru",$this->idu());
	return	$this->db->get("v_mapel_ajar")->result();
	}
	///-----------------------------------ajax//
	function _cekKikd($mapel,$kd3,$kd4)
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("kd3_no",$kd3);
		$this->db->where("kd4_no",$kd4);
		$this->db->where("id_mapel_ajar",$mapel);
	return	$this->db->get("tm_kikd")->num_rows();
	}
	
	function insert_kikd()
	{	
		$code=$this->idu().substr(str_shuffle("abcdefghijklmnop123456789"),0,8);
		$var["duplikat"]=false;$var["nokd3"]=true;$var["nokd4"]=true;
		$mapel=$this->input->post("id_mapel_ajar");
			/*-- cek apakah ada nama mapel yg sama di tingkat yg dipilih meski beda jurusan --*/
			$data=$this->_namaMapel($mapel);
			foreach($data as $val)
			{
				 
						/*--------------------------------------------------------------------------------*/
					$kd3=$this->input->post("f[kd3_no]");
					$kd4=$this->input->post("f[kd4_no]");
					$mapel=$val->id;
					$cek=$this->_cekKikd($mapel,$kd3,$kd4);
					if($cek)
					{
						$var["duplikat"]=true;
						return $var;
					}elseif(strpos($kd3,"3.")===false or strlen($kd3)<3)
					{
						$var["nokd3"]=false;
						return $var;
					}elseif(strpos($kd4,"4.")===false or strlen($kd4)<3)
					{
						$var["nokd4"]=false;
						return $var;
					}else{
							$sms=$this->m_reff->semester();
							$tahun=$this->m_reff->tahun();
							$post=$this->input->post("f");
							$post=$this->security->xss_clean($post);
							$this->db->set("id_guru",$this->idu());
							$this->db->set("_cid",$this->idu());
							$this->db->set("id_semester",$sms);
							$this->db->set("id_tahun",$tahun);
							$this->db->set("id_mapel_ajar",$val->id);
							$this->db->set("code",$code);
							$this->db->insert("tm_kikd",$post);
							
						  $var;
					}
		
			}
			return $var;
	}
	function update_kikd()
	{ 
			$mapel=$this->input->post("id_mapel_ajar");
			// $data=$this->_namaMapel($mapel);
			  $sms=$this->m_reff->semester();
			    $tahun=$this->m_reff->tahun();
		//	foreach($data as $val)
		//	{
				$data=$this->input->post("f");
				$data=$this->security->xss_clean($data);
			//	$this->db->where("id_mapel_ajar",$val->id);
				$this->db->where("code",$this->input->post("code"));
				 $this->db->where("id_guru",$this->idu());
				 $this->db->where("id_semester",$sms);
				 $this->db->where("id_tahun",$tahun);
				$this->db->update("tm_kikd",$data);
		//	}
			return true;
	}
	function _namaMapel($id_mapel_ajar)
	{
		 
		 $sms=$this->m_reff->semester();
		 $tahun=$this->m_reff->tahun();
		 $this->db->where("id_guru",$this->idu());
		 $this->db->where("id_semester",$sms);
		 $this->db->where("id_tahun",$tahun);
		 $this->db->where("id",$id_mapel_ajar);
		 $return=$this->db->get("v_mapel_ajar")->row();
		 $nama_mapel=isset($return->mapel)?($return->mapel):"";
		 $nama_mapel=strtolower($nama_mapel); //nama mapel
		 $tingkat=isset($return->id_tk)?($return->id_tk):""; //id tk
		 /*--------------------------------------------*/
		 $this->db->where("id_guru",$this->idu());
		 $this->db->where("id_semester",$sms);
		 $this->db->where("id_tahun",$tahun);
		 $this->db->where("id_tk",$tingkat);
		 $this->db->where("mapel",$nama_mapel);
	return	 $this->db->get("v_mapel_ajar")->result();
	}
	
	function hapus_kikd()
	{
		$var["hasil"]=true;
		    $mapel=$this->input->post("id");
		    $code=$this->input->post("code");
			 $data=$this->_namaMapel($mapel);
			  $sms=$this->m_reff->semester();
			    $tahun=$this->m_reff->tahun();
				
				$id_kikd=$this->db->query("select id from tm_kikd where tm_kikd.code='".$code."'  AND id_guru='".$this->idu()."' limit 1")->row();	
				$ceklis=$this->db->query("select id from tm_materi where id_kikd='".$id_kikd->id."'")->num_rows();	
				
					if($ceklis)
					{
						$var["hasil"]=false;
						 return $var;
					}
				
			foreach($data as $val)
			{
					$id=$this->m_reff->goField("tm_kikd","id","where id_tahun='".$tahun."' AND id_semester='".$sms."' AND id_guru='".$this->idu()."' 
					AND id_mapel_ajar='".$val->id."' AND kd3_no='".$this->input->post("kd3")."'
					AND kd4_no='".$this->input->post("kd4")."' ");
				
				//	$this->hapus_pembelajaran($id);
					 $this->db->where("id_mapel_ajar",$val->id);
					 $this->db->where("code",$this->input->post("code"));
					 $this->db->where("id_semester",$sms);
				     $this->db->where("id_tahun",$tahun);
					 $this->db->where("id_guru",$this->idu());
					$this->db->delete("tm_kikd");
			}
			 return $var;
	}
	
	function hapus_pembelajaran($id=null)
	{	
		$kode=$this->input->post("code");
		if($id==null)
		{
			$idm=$idmateri=$this->input->post("id");
			$ids="id";
		}else{
			$idmateri=$id;
			$ids="id_kikd";
			$idm=$this->db->query("select id from tm_materi where id_kikd='".$idmateri."' and id_guru='".$this->idu()."' ")->row();
			$idm=isset($idm->id)?($idm->id):"";
		}
		
		$db=$this->db->query("select * from tm_bahan_ajar where id_materi='".$idm."'")->result();
		foreach($db as $db)
		{
			$this->hapus_bahan(null,$db->code);
		}
		  
		
		if($kode)
		{
			$this->db->where("code",$kode);
		}else{
			$this->db->where($ids,$idmateri);
		}
		$this->db->where("id_guru",$this->idu());
		return $this->db->delete("tm_materi");
	}
	
	//*------------------------*/
	
		function _getDataKikd($idkikd)
	{
		    $db=$this->db->query("select code from tm_kikd where id='".$idkikd."' ")->row();
			$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
			$this->db->where("id_guru",$this->idu());
			$this->db->where("id_semester",$sms);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("code",$db->code);
	return	$this->db->get("tm_kikd")->result();
	}
	function insert_materi()
	{	$code=$this->idu().substr(str_shuffle("abcdefghijklmnop123456789"),0,8);
		
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
	//	$post=$this->input->post("f");
		$idkikd=$this->input->post("f[id_kikd]");
		$materi=$this->input->post("f[materi]");
	//	$post=$this->security->xss_clean($post);
		
							$datax=$this->_getDataKikd($idkikd);
							foreach($datax as $val)
							{
								$this->db->set("id_guru",$this->idu());
								$this->db->set("_cid",$this->idu());
								$this->db->set("id_semester",$sms);
								$this->db->set("id_tahun",$tahun);
								$this->db->set("id_kikd",$val->id);
								$this->db->set("materi",$materi);
								$this->db->set("code",$code);
								$this->db->insert("tm_materi");
							}
							return true;
	}function input_materi_baru()
	{	$code=$this->idu().substr(str_shuffle("abcdefghijklmnop123456789"),0,8);
		
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
	//	$post=$this->input->post("f");
		$idkikd=$this->input->get_post("id_kikd_add");
		$materi=$this->input->post("materi");
	//	$post=$this->security->xss_clean($post);
		
							$datax=$this->_getDataKikd($idkikd);
							foreach($datax as $val)
							{
								$this->db->set("id_guru",$this->idu());
								$this->db->set("_cid",$this->idu());
								$this->db->set("id_semester",$sms);
								$this->db->set("id_tahun",$tahun);
								$this->db->set("id_kikd",$val->id);
								$this->db->set("materi",$materi);
								$this->db->set("code",$code);
								$this->db->insert("tm_materi");
							}
							return true;
	}
	function update_materi()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->set("id_guru",$this->idu());
		$this->db->set("_cid",$this->idu());
		$this->db->set("id_semester",$sms);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("_uid",$this->idu());
		$this->db->set("_utime",date("Y-m-d H:i:s"));
		$this->db->where("code",$this->input->post("code"));
	return	$this->db->update("tm_materi",$post);
	}
	function nip()
	{
		return $this->m_reff->goField("data_pegawai","nip","where id='".$this->idu()."'");
	}
	function insert_materi_ajar()
	{
		$var=array();
		
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
	 
		 
		$nip=$this->m_reff->goField("data_pegawai","nip","where id='".$this->idu()."'");
	    
		 
		$idu=$this->session->userdata("id");	
		$idmateri=$this->input->post("idadd");
	 	$code=$this->input->post("code");
		$newcode=$this->idu().substr(str_shuffle("abcdefghijklmnop123456789"),0,8);
		$var["idadd"]=$idmateri;
	
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);

		$aksi_edit=$this->input->post("aksi_edit");
	 
		 
			$insert="insert";
	 
	   $path1="file_upload/guru/".$nip; //tahun ajaran
	   if (!file_exists($path1)) {
		    mkdir($path1,0777, true);
	   }

		   $mapel=$this->input->post("id_mapel_ajar");
		if(isset($_FILES["upload"]['tmp_name']))
		{
			$pullpath="guru/".$nip;
			$file=$this->m_reff->upload_file("upload",$pullpath,$this->input->post("f[nama]"),"JPG,JPEG,PNG,XLSX,DOCX,PPT,MP3,MKV,FLV,PPTX,PDF,ZIP,RAR","20000000");
			
			if($aksi_edit=="true"){
			$nama_file=$this->m_reff->goField("tm_bahan_ajar","file","where id='".$idtable."' ");
			$this->m_reff->hapus_file("file_upload/".$pullpath."/".$nama_file);  }
			
			if($file["validasi"]!=false)
			{
				$files="file_upload/".$pullpath."/".$file["name"];
						
						if($aksi_edit="true"){ $this->db->where("id_materi",$idmateri); }
						
						$sumber=$this->input->post("sumber");
						
							/*-- cek apakah ada nama mapel yg sama di tingkat yg dipilih meski beda jurusan --*/
						    $datax=$this->_getIdKikdByCode($code);
							foreach($datax as $val)
							{			$this->db->set("file",$files);
										$this->db->set("id_materi",$val->id);
										$this->db->set("sumber",$sumber);
										$this->db->set("_cid",$this->idu());
										$this->db->set("code",$newcode);
										$this->db->$insert("tm_bahan_ajar",$data);
						 	}
						 
			} 
				  $file['idadd']=$idmateri;
				return $file;
		 
				
		}else{
			 
						    $datax=$this->_getIdKikdByCode($code);
							foreach($datax as $val)
							{
								$sumber=$this->input->post("sumber");
								$this->db->set("sumber",$sumber);
								$this->db->set("file",$this->input->post("link"));
								$this->db->set("_cid",$this->idu());
								$this->db->set("id_materi",$val->id);
								$this->db->set("code",$newcode);
								$this->db->$insert("tm_bahan_ajar",$data);
							}
							return $var;
		}
	}
	
	
		function insert_materi_ajar2()
	{
		$var=array();
		
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
	     $id_guru=$this->idu();
		 
		$nip=$this->m_reff->goField("data_pegawai","nip","where id='".$this->idu()."'");
	    
		 
		$idu=$this->session->userdata("id");	
		$idmateri=$this->input->post("idadd");
	 	$code=$this->input->post("code");
		$newcode=$this->idu().substr(str_shuffle("abcdefghijklmnop123456789"),0,8);
		$var["idadd"]=$idmateri;
	
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);

		$aksi_edit=$this->input->post("aksi_edit");
	 
		 
			$insert="insert";
	 
	   $path1="file_upload/guru/".$nip; //tahun ajaran
	   if (!file_exists($path1)) {
		    mkdir($path1,0777, true);
	   }

		   $mapel=$this->input->post("id_mapel_ajar");
		if(isset($_FILES["upload"]['tmp_name']))
		{
			$pullpath="guru/".$nip;
			$file=$this->m_reff->upload_file("upload",$pullpath,$this->input->post("f[nama]"),"JPG,JPEG,PNG,XLSX,DOCX,PPT,MP3,MKV,FLV,PPTX,PDF,ZIP,RAR","20000000");
			
			if($aksi_edit=="true"){
			$nama_file=$this->m_reff->goField("tm_bahan_ajar","file","where id='".$idtable."' ");
			$this->m_reff->hapus_file("file_upload/".$pullpath."/".$nama_file);  }
			
			if($file["validasi"]!=false)
			{
				$files="file_upload/".$pullpath."/".$file["name"];
						
						if($aksi_edit="true"){ $this->db->where("id_materi",$idmateri); }
						
						$sumber=$this->input->post("sumber");
						
							/*-- cek apakah ada nama mapel yg sama di tingkat yg dipilih meski beda jurusan --*/
						    			$this->db->set("file",$files);
						    				$this->db->set("id_guru",$id_guru);
										$this->db->set("id_mapel",$idmateri);
										$this->db->set("sumber",$sumber);
										$this->db->set("_cid",$this->idu());
										$this->db->set("code",$newcode);
										$this->db->$insert("tm_bahan_ajar",$data);
						 	 
						 
			} 
				  $file['idadd']=$idmateri;
				return $file;
		 
				
		}else{
			  
								$sumber=$this->input->post("sumber");
								$this->db->set("sumber",$sumber);
								$this->db->set("file",$this->input->post("link"));
								$this->db->set("_cid",$this->idu());
									$this->db->set("id_guru",$id_guru);
								$this->db->set("id_mapel",$idmateri);
								$this->db->set("code",$newcode);
								$this->db->$insert("tm_bahan_ajar",$data);
						 
							return $var;
		}
	}
	function _getIdKikdByCode($code)
	{
			$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		 
	return	$this->db->query("select * from tm_materi where code='".$code."' and id_tahun='".$tahun."' and id_semester='".$sms."' and id_guru='".$this->idu()."' ")->result();
	}
	
	
	function _getIdKikd($idkikd)
	{
			$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
			$this->db->where("id_guru",$this->idu());
			$this->db->where("id_semester",$sms);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_kikd",$idkikd);
	return	$this->db->get("tm_materi")->result();
	}
	
	function _getIdMateri($id)
	{
		$data=$this->db->query("SELECT * FROM tm_materi WHERE id_guru='2' AND id_tahun='2' AND id_semester='2' AND id='2'")->result();
	}
	function hapus_bahan($_id=null,$kode=null)
	{	$id=$this->input->post("id");
		if($_id!=null)
		{
			$id=$_id;
		}			
		 
		
		
		
	
		if($kode!=null)
		{
			$this->db->where("code",$kode);	
			$nama_file=$this->m_reff->goField("tm_bahan_ajar","file","where code='".$kode."' ");
		}elseif($id)
		{
			$this->db->where("id",$id);
			$nama_file=$this->m_reff->goField("tm_bahan_ajar","file","where id='".$id."' ");
		}
	 
		$this->m_reff->hapus_file($nama_file); 
			
		return $this->db->delete("tm_bahan_ajar");
	}
	
	
		function hapus_bahan2($_id=null,$kode=null)
	{	$id=$this->input->post("id");
		if($_id!=null)
		{
			$id=$_id;
		}			
		 
		
		
		
	
		if($kode!=null)
		{
			$this->db->where("code",$kode);	
			$nama_file=$this->m_reff->goField("tm_bahan_ajar","file","where code='".$kode."' ");
		}elseif($id)
		{
			$this->db->where("id",$id);
			$nama_file=$this->m_reff->goField("tm_bahan_ajar","file","where id='".$id."' ");
		}
	 
		$this->m_reff->hapus_file($nama_file); 
			
		return $this->db->delete("tm_bahan_ajar");
	}
	
	
	
	
	function cekJadwal()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$id_mapel=$this->input->post("id_mapel");
		$id_kelas=$this->input->post("id_kelas");
		$id_hari=$this->input->post("id_hari");
		$jam=$this->input->post("jam");
		$f="";$c="";$x=1;
		$f.="id_mapel=".$id_mapel." AND id_kelas=".$id_kelas." AND id_hari=".$id_hari."  AND id_tahun=".$tahun." AND id_semester=".$sms;
		
		$this->db->query("delete from tm_penjadwalan where  id_guru=".$this->idu()." AND ".$f."");
		$f="";
		foreach($jam as $val)
		{	$x++;
			$c.=" jam like '%,".$val.",%' or";
		}
		if($x>1)
		{
			$f.=" AND (".substr($c,0,-2).")";
		}
		
		$fg="id_mapel!=".$id_mapel." AND id_kelas='".$id_kelas."' AND id_hari=".$id_hari."  AND id_tahun=".$tahun." AND id_semester=".$sms." ".$f;
		$q=$this->db->query("select * from tm_penjadwalan where ".$fg." ");
		if($q->num_rows())
		{
			$data=$q->row();
			$guru=$this->m_reff->goField("data_pegawai","nama","where id='".$data->id_guru."'");
			$var["validasi"]=false;
			$var["guru"]=$guru;
			$var["jam"]=substr(substr($data->jam,0,-1),1);
		}else{
			$var["validasi"]=true;
		}
		return $var;
	}
	function setJadwal()
	{	$var["runing"]=true;
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$id_mapel=$this->input->post("id_mapel");
		$id_kelas=$this->input->post("id_kelas");
		$id_hari=$this->input->post("id_hari");
		$jam_select=$this->input->post("jam_select");
		$jam=$this->input->post("jam");
		$jam_all=$this->input->post("jam_all");
		
	//	$cek=$this->db->query("select * from tm_absen_guru where id_semester='".$sms."' and id_tahun='".$tahun."' and id_mapel='".$id_mapel."' and id_guru='".$this->idu()."'")->num_rows();
	//	if($cek)
	//	{
	//			$var["runing"]=false;
	//			return $var;
	//	}
		
		
		
		$c="";
		$lastcek=$this->db->query("select * from tm_penjadwalan where  id_guru!='".$this->idu()."' and id_tahun='".$tahun."' and id_semester='".$sms."' 
		   and id_hari='".$id_hari."' and jam like '%,".$jam_select.",%'  and id_kelas='".$id_kelas."' ")->num_rows();
		
		if($lastcek)
		{
				
				$var["gagal"]=true;
				return $var;
		}else{
			$var["gagal"]=false;
		}
		
		
		
		$cek=$this->db->query("select * from tm_penjadwalan where id_guru='".$this->idu()."' and id_tahun='".$tahun."' and id_semester='".$sms."' 
		and id_mapel='".$id_mapel."' and id_hari='".$id_hari."' and id_kelas='".$id_kelas."' ");
		
		
		foreach($jam as $val)
		{	 
			$c.=$val.",";
		}
		$c=",".$c;
		$data=array(
		"id_tahun"=>$tahun,
		"id_semester"=>$sms,
		"id_kelas"=>$id_kelas,
		"id_mapel"=>$id_mapel,
		"id_hari"=>$id_hari,
		"jam"=>$c,
		"_cid"=>$this->idu(),
		"id_guru"=>$this->idu(),
		);
		
			$cek_total=$this->cek_total_jam($sms,$tahun,$this->idu(),$id_mapel,$id_kelas,$jam_all);
			if($cek_total==false)
			{
				$var["jml_jam"]=false;
				return $var;
			}
		
		if($cek->num_rows())
		{
			$in="update";
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_guru",$guru=$this->idu());
			$this->db->where("id_mapel",$id_mapel);
			$this->db->where("id_hari",$id_hari);
			$this->db->where("id_kelas",$id_kelas);
			
		}else{
			$in="insert";
		}
			$this->db->$in("tm_penjadwalan",$data);
			$this->db->where("jam",",");
			return	$this->db->delete("tm_penjadwalan");
	}
	function cek_total_jam($sms,$tahun,$guru,$id_mapel,$id_kelas,$jam_all)
	{
		/*$db=$this->db->query("SELECT * from tm_penjadwalan where id_guru='".$guru."' 
		and id_semester='".$sms."' and id_tahun='".$tahun."' and id_mapel='".$id_mapel."' and id_kelas='".$id_kelas."'  ")->result();
		$ex="";
		foreach($db as $val)
		{
			$ex.=$val->jam;
		}
		$jam=str_replace(",,",",",$ex);
		$jam=str_replace(",,",",",$jam);
		$jam=explode(",",$jam);*/
		$jam=count($jam_all);
		$jumlah_wajar=$this->db->query("SELECT jml_jam from tm_mapel_ajar where id_guru='".$guru."' and id_semester='".$sms."'
		and id_tahun='".$tahun."' and id_kelas='".$id_kelas."' and id_mapel='".$id_mapel."'  ")->row();
		$jumlah_wajar=$jumlah_wajar->jml_jam;
		if($jam>$jumlah_wajar)
		{
			return false;
		}else{
			return true;
		}
	}
	function cekJadwalAh($id_hari,$jam,$id_kelas,$id_mapel)
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$id_guru=$this->idu();
		 $hak="";$mapel="";$guru="";$kelas="";
		$f=" id_hari=".$id_hari." AND id_guru='".$id_guru."'   AND id_tahun=".$tahun." AND id_semester=".$sms;
		$olangan=$this->db->query("select * from tm_penjadwalan where jam like '%,".$jam.",%' AND ".$f." ");
		
		$f=" id_hari=".$id_hari." AND id_kelas='".$id_kelas."'  AND id_tahun=".$tahun." AND id_semester=".$sms;
		$q=$this->db->query("select * from tm_penjadwalan where jam like '%,".$jam.",%' AND ".$f." ");
		
		$f="id_hari=".$id_hari." AND id_guru='".$id_guru."' AND id_kelas='".$id_kelas."'  AND id_tahun=".$tahun." AND id_semester=".$sms;
		$qself=$this->db->query("select * from tm_penjadwalan where jam like '%,".$jam.",%' AND ".$f." ");
		
		
		
		if($q->num_rows()) //cek keseluruhan 
		{
			$data=$q->row();
			if($data->id_guru==$id_guru)
			{
				$hak="sendiri";	 
				$mapel=$data->id_mapel;
				if($qself->num_rows())
				{	$data=$qself->row();
					if($data->id_mapel==$id_mapel)
					{
						$hak="sendiri";
					}else{
						$hak="lain";
					}
					$guru=$data->id_guru;
					$kelas=$data->id_kelas;
					return $hak."::".$mapel."::".$guru."::".$kelas;
				}
					
			}else{
				$hak="lain"; 
				 $mapel=$data->id_mapel; $guru=$data->id_guru;
					$kelas=$data->id_kelas;
					return $hak."::".$mapel."::".$guru."::".$kelas;
			} 
			
			 
		}elseif($qself->num_rows())
		{
			$data=$qself->row();
			if($data->id_mapel==$id_mapel and $data->id_kelas==$id_kelas)
			{
				$hak="sendiri";
			}else{
				$hak="lain";
			}
			 $mapel=$data->id_mapel;  $guru=$data->id_guru;
					$kelas=$data->id_kelas;
					return $hak."::".$mapel."::".$guru."::".$kelas;
		}elseif($olangan->num_rows()) //cek keseluruhan 
		{
			$data=$olangan->row();
			if($data->id_guru==$id_guru)
			{
				$hak="sendiri";	 
				$mapel=$data->id_mapel;
				if($qself->num_rows())
				{	$data=$qself->row();
					if($data->id_mapel==$id_mapel)
					{
						$hak="sendiri";
					}else{
						$hak="lain";
					}
				}
					$guru=$data->id_guru;
					$kelas=$data->id_kelas;
					return $hak."::".$mapel."::".$guru."::".$kelas;
			}else{
				$hak="lain"; 	 
			} 
		 $mapel=$data->id_mapel;  $guru=$data->id_guru;
		 $kelas=$data->id_kelas;
					return $hak."::".$mapel."::".$guru."::".$kelas;
		} 		
		return $hak."::".$mapel."::".$guru."::".$kelas;	
		 
		
	}
	function cekIsiJadwal($id_guru,$id_kelas,$id_tahun,$id_semester,$id_mapel)
	{
		$this->db->where("id_guru",$id_guru);
		$this->db->where("id_kelas",$id_kelas);
		$this->db->where("id_tahun",$id_tahun);
		$this->db->where("id_semester",$id_semester);
		$this->db->where("id_mapel",$id_mapel);
	return	$this->db->get("tm_penjadwalan")->num_rows();
	}
	function finalin($sts)
	{
			//$this->db->where("id",$this->idu());
			//$this->db->set("sts_isi",$sts);
	return	true;//$this->db->update("data_pegawai");
	}
	function simpan_akun()
	{
		$username=$this->input->post("username");
		$password=$this->input->post("password");
		$md5=md5($password);
		$cek1=$this->db->query("select * from admin where username='".$username."' and password='".$md5."' ")->num_rows();
		$cek2=$this->db->query("select * from data_siswa where username='".$username."' and password='".$md5."' ")->num_rows();
		$cek3=$this->db->query("select * from data_pegawai where username='".$username."' and password='".$md5."' and id!='".$this->idu()."' ")->num_rows();
		$jml=($cek1+$cek2+$cek3);
		if($jml)
		{
			$var["hasil"]="duplikat"; return $var;
		}else{
			$this->db->set("username",$this->security->xss_clean($username));
			$this->db->set("password",$this->security->xss_clean($md5));
			$this->db->set("alias",$this->security->xss_clean("se".$password."en"));
			$this->db->where("id",$this->idu());
			$this->db->update("data_pegawai");
			$var["hasil"]=true;
			return $var;
		}
	}
	
	
	function update_data_guru()
	{
		$var=array();
		$var["hp"]=true; 
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		$var["nip_duplicate"]=false; 
		
		$nip=$this->input->post("nip");
		  
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		
		
		
				
				$tmt=$this->input->post("tmt");
				$tgl=$this->input->post("tgl_lahir");
			 	$hp=$this->input->post("hp");
				$tgl=$this->tanggal->eng_($tgl,"-");
				$tmt=$this->tanggal->eng_($tmt,"-");
				
			  
			 	$this->db->set("_uid",$idu);
			 	$this->db->set("_utime",date("Y-m-d H:i:s"));
			 	
				$this->db->set("hp",$hp);
				$this->db->set("tmt",$tmt);
				 
				$this->db->set("tgl_lahir",$tgl);
				$this->db->set("id_jabatan",3);
				  
				$this->db->where("id",$this->idu());
				$before_file=$this->input->post("before_file");
		if(isset($_FILES["file"]['tmp_name']))
		{
			$file=$this->m_reff->upload_file("file","dp",$idu,"JPG,PNG,JPEG","10000000",$before_file);
			if($file["validasi"]!=false)
			{
						$this->db->set("poto",$file["name"]);
						$this->db->update("data_pegawai",$data);
						return $var;
			}else{
					   $file["hp"]=true; 
				return $file;
			}
				
		} else{
				$this->db->update("data_pegawai",$data);
				return $var;
		}
	}
	
	
	
		function update_dp()
	{
		$var=array();
		$var["hp"]=true; 
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		$var["nip_duplicate"]=false; 
		
		$nip=$this->input->post("nip");
		  
		$idu=$this->session->userdata("id");
		 	  
			
				$before_file=$this->m_reff->goField("data_pegawai","poto","where id='".$this->session->userdata("id")."'" ); 
		if(isset($_FILES["file"]['tmp_name']))
		{
			$file=$this->m_reff->upload_file("file","dp",$idu,"JPG,PNG,JPEG","10000000",$before_file,400);
			if($file["validasi"]!=false)
			{           	$this->db->where("id",$this->idu());
						$this->db->set("poto",$file["name"]);
					//	$this->db->set("mode_latar",1);
						$this->db->update("data_pegawai");
					///		$var["nama"]=$file["name"]; 
						return $var;
			}
				
		}
		return true;
	}
	
	
		function update_bg()
	{
		$var=array();
		$var["hp"]=true; 
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		$var["nip_duplicate"]=false; 
		
		$nip=$this->input->post("nip");
		  
		$idu=$this->session->userdata("id");
		 	  
			
				$before_file=$this->m_reff->goField("data_pegawai","poto_latar","where id='".$this->session->userdata("id")."'" ); 
		if(isset($_FILES["file_ltr"]['tmp_name']))
		{
			$file=$this->m_reff->upload_file("file_ltr","dp",$idu,"JPG,PNG,JPEG","10000000",$before_file,400);
			if($file["validasi"]!=false)
			{           	$this->db->where("id",$this->idu());
				$this->db->set("mode_latar",1);
						$this->db->set("poto_latar",$file["name"]);
						$this->db->update("data_pegawai");
					///		$var["nama"]=$file["name"]; 
						return $var;
			}
				
		}
		return true;
	}
	
	
	function beres($id)
	{
		$this->db->where("id",$this->idu());
		$this->db->set("tahap".$id,"1");
		return $this->db->update("data_pegawai");
	}
	function ceknokd($id)
	{
		$data=$this->db->query("select kd3_no,kd4_no from tm_kikd where id_mapel_ajar='".$id."' order by CAST(substr(kd3_no,3,5) AS SIGNED INTEGER) DESC limit 1")->row();
		if($data)
		{
			$kd3=explode(".",$data->kd3_no);
			$kd3=isset($kd3[1])?($kd3[1]):0;
			if($kd3)
			{
				$kd3=$kd3+1;
			}
			
			$kd4=explode(".",$data->kd4_no);
			$kd4=isset($kd4[1])?($kd4[1]):0;
			if($kd4)
			{
				$kd4=$kd4+1;
			}
			
			
		return	$arr=array("kd3"=>$kd3,"kd4"=>$kd4);
			
		}else{
				return	$arr=array("kd3"=>1,"kd4"=>1);
		}
	}
	
	
	function import_kikd()
	{	
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
					return $this->_import_kikd("file");
				 
			}else{
					return $var;
			}
	}
	function cek_kikd($array1,$array2)
	{
	 
			$this->db->where($array1);
			$a1=$this->db->get("tm_kikd")->num_rows();
		 
			$a2=$this->db->get_where("tm_kikd",$array2)->num_rows();
			return $a1+$a2;
	}
	
	function _import_kikd($file_form)
	{	
			$id_guru=$this->idu();
			$idmapel=$this->security->xss_clean($this->input->get_post("idmapel"));
	 if(!$idmapel)
	 {	  $var["validasi"]=false;
		 return $var;
	 }
			$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		
		
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
						$code=$this->idu().substr(str_shuffle("abcdefghijklmnop123456789"),0,8);
						$kd3_ori=isset($sheet[0])?($sheet[0]):"";
						$kd3_ori=str_replace("3.","",$kd3_ori);
						
						$kd4_ori=isset($sheet[3])?($sheet[3]):"";
						$kd4_ori=str_replace("4.","",$kd4_ori);
							
						$kd3=str_replace("'","",isset($sheet[0])?($sheet[0]):"");
						$kd3=str_replace("`","",$kd3);
						$kd3=str_replace(":",".",$kd3);
						$kd3=str_replace("3.","",$kd3);
						
						
						$kb3=isset($sheet[1])?($sheet[1]):"";
						$des3=isset($sheet[2])?($sheet[2]):"";
						$kd4=str_replace("'","",isset($sheet[3])?($sheet[3]):"");
						$kd4=str_replace("`","",$kd4);
						$kd4=str_replace(":",".",$kd4);
						$kd4=str_replace("4.","",$kd4);
						
						
						$kb4=isset($sheet[4])?($sheet[4]):"";
						$des4=isset($sheet[5])?($sheet[5]):"";
						  
						
							 $array_cek1=array(
							 "kd3_no"=>"3.".$kd3_ori,
							 "id_mapel_ajar"=>$idmapel,
							 "id_guru"=>$id_guru,
							 "id_semester"=>$sms,
							 "id_tahun"=>$tahun,
							 ); $array_cek2=array(
							 "kd4_no"=>"4.".$kd4,
							 "id_mapel_ajar"=>$idmapel,
							 "id_guru"=>$id_guru,
							 "id_semester"=>$sms,
							 "id_tahun"=>$tahun,
							 );
							  
							$cek_nilai=$this->cek_kikd($array_cek1,$array_cek2);
						if($cek_nilai){
							 $var["duplikat"]=false;
							 $gagal++;
							 return $var;
						}else{
							 
							 
						/*	if(strpos($kd3_ori,"'")===false)
							{	 $var["format_kd3_kutif"]=false;
								 $gagal++;
								 return $var;
							}elseif(strpos($kd4_ori,"'")===false)
							{	 $var["format_kd4_kutif"]=false;
								 $gagal++;
								 return $var;
							}else*/
							if(strlen($kd3)<1)
							{	 $var["format_kd3"]=false;
						    	 $var["info"]=$kd3;
								 $gagal++;
								 return $var;
							}elseif(strlen($kd4)<1)
							{	 $var["format_kd4"]=false;
								 $gagal++;
								  return $var;
							}else{
								 
										$data=$this->_namaMapel($idmapel);
				foreach($data as $val)
				{			$idmapel=$val->id;
					
													 $array=array(
													 "code"=>$code,
													 "kd4_desc"=>$des4,
													 "kd4_kb"=>$kb4,
													 "kd4_no"=>"4.".$kd4,
													 "kd3_desc"=>$des3,
													 "kd3_kb"=>$kb3,
													 "kd3_no"=>"3.".$kd3,
													 "id_mapel_ajar"=>$idmapel,
													 "id_guru"=>$id_guru,
													 "id_semester"=>$sms,
													 "id_tahun"=>$tahun,
													  "_cid"=>$id_guru
													 );
													$this->insert_import_kikd($array);
				}
										 
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
			  $var["duplikat"]=true;
		return $var;
	}
	function insert_import_kikd($array)
	{
	 
		return $this->db->insert("tm_kikd",$array);
	}
}



