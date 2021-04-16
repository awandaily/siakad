<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	
	 function get_open($tbl, $id_guru, $id_sts, $id_jabatan)
	{
		$query=$this->_get_datatables_open($tbl, $id_guru, $id_sts, $id_jabatan);
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file($tbl, $id_guru, $id_sts, $id_jabatan)
	{				
		$query = $this->_get_datatables_open($tbl, $id_guru, $id_sts, $id_jabatan);
        return  $this->db->query($query)->num_rows();
	}

	 
	private function _get_datatables_open($tbl, $id_guru, $id_sts, $id_jabatan){
		$filter="";
		  
		if ($id_guru!="") {
			$filter.= "AND id = '".$id_guru."' ";
		}
		if ($id_sts!="") {
			$filter.= "AND sts_kepegawaian = '".$id_sts."' ";
		}
		if ($id_jabatan!="") {
			$filter.= "AND id_jabatan = '".$id_jabatan."' ";
		}


		$idu=$this->session->userdata("id");


		$query="select * from ".$tbl." WHERE id!=''  $filter ";
		/*
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			 nama LIKE '%".$searchkey."%'  
			) ";
		}*/

		$column = array('', 'nama_lengkap'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by nama_lengkap asc";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}
	  
	private function _get_datatables_open2($tbl, $id_guru, $id_sts, $id_jabatan){
		$filter="";
		  
		if ($id_guru!="") {
			$idg = $this->m_reff->goField("data_pegawai", "id", "WHERE nip='".$id_guru."' ");
			if ($idg!="") {
				$filter.="AND id_guru='".$idg."'";
			}
			else{
				$filter = "";
			}
			
		}
		 
		$idu=$this->session->userdata("id");

		if ($this->m_reff->jam_aktif()!="") {
			$fjam = "WHERE jam LIKE '%".$this->m_reff->jam_aktif()."%'";
		}
		else{
			$fjam = "WHERE jam LIKE '%-%'";
		}

		

		$query="select * from ".$tbl." $fjam  $filter ";
		/*
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			 nama LIKE '%".$searchkey."%'  
			) ";
		}*/

		$column = array('', 'nama_kelas'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by nama_kelas asc";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}	///-----------------------------------ajax//
 
	  function data_pertemuan()
	{
		$query=$this->_data_pertemuan();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_p()
	{				
		$query = $this->_data_pertemuan();
        return  $this->db->query($query)->num_rows();
	}

	 
	
	  
	private function _data_pertemuan()
	{
		$filter="";
		  $tahun=$this->m_reff->tahun();
		  $sms=$this->m_reff->semester();
			$filter.="AND id_eskul='".$this->ids()."'";
		
	$query="select * from eskul_absen where  kode='".$this->kode()."' and id_semester='".$sms."' and id_tahun='".$tahun."' $filter ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			 tgl LIKE '%".$searchkey."%'  
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
		$query.=" order by tgl desc";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}	///-----------------------------------ajax//
 
	 
	
	 
	function hapus($tbl,$id)
	{	
		 if($tbl=="eskul_group")
		 {
			 	$this->db->where("id_group",$id);
				$this->db->delete("eskul_anggota");
		 }
		$this->db->where("id",$id);
	return	$this->db->delete($tbl);
		
	}
	
	function update($tbl)
	{	
		$var=array();
		$var["size"]="true"; 
		$var["file"]="true";
		$var["validasi"]="true"; 
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
	
				
				$id=$this->input->post("id_");
				$this->db->where("id",$id);
				$this->db->set("id_eskul",$this->ids());
				$this->db->set("kode",$this->kode());
				$this->db->update($tbl,$data);
				return $var;
 
	}
 
	 function insert($tbl)
	{	
		$var=array();
		$var["size"]="true"; 
		$var["file"]="true";
		$var["validasi"]="true"; 
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		$this->db->set("id_eskul",$this->ids());
		$this->db->set("kode",$this->kode());
				$this->db->insert($tbl,$data);
				return $var;
 
	}
	function ids()
	{
		$this->session->userdata("id_eskul");
		$dp=$this->m_reff->dataProfilePegawai(); 
		return $this->m_reff->goField("tr_ektrakurikuler","id","where kode='".$dp->nip."'");
	}
	
	function kode()
	{
	///	return $this->session->userdata("id");
		$dp=$this->m_reff->dataProfilePegawai(); 
		return $dp->nip;//$this->m_reff->goField("tr_ektrakurikuler","kode","where kode='".$dp->nip."'");
	}
	
	
	
	function pilih2($id,$group)
	{	$tahun=$this->m_reff->tahun();
		$sms=$this->m_reff->semester();
		$kode=$this->kode();
			
		//	$this->db->where("id_group",$group);
			$this->db->where("kode",$kode);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
		$this->db->where("id_eskul",$this->ids());
		$data=$this->db->get("eskul_anggota")->row();
		$agt=isset($data->j_siswa)?($data->j_siswa):""; 
		
		$siswa=$this->db->get_where("data_siswa",array("id"=>$id))->row(); 
		if($agt)
		{
			
			//$agt=json_decode($agt,TRUE); 
			if($group)
			{
				$find='"id":"'.$id.'"';
				$datajs=$this->db->query("select j_siswa from eskul_anggota where kode='".$this->kode()."' and
				id_semester='".$sms."' and id_tahun='".$tahun."' and id_eskul='".$this->ids()."' and id_group='".$group."' ")->row();
				if(isset($datajs))
				{
					
					$datajs2=$this->db->query("select * from eskul_anggota where kode='".$this->kode()."' and
					id_semester='".$sms."' and id_tahun='".$tahun."' and id_eskul='".$this->ids()."' and j_siswa LIKE '%".$find."%' ")->row();
					if(isset($datajs2))
					{
						$agt2=json_decode($datajs2->j_siswa,TRUE);	
						unset($agt2[$id]); 	
						$agt2=json_encode($agt2);
								$this->db->set("j_siswa",$agt2);
								$this->db->where("id",$datajs2->id);
								$this->db->update("eskul_anggota");
					}
					
					$agt=json_decode($datajs->j_siswa,TRUE);	
					unset($agt[$id]); 	
					
					$add["id"]=$siswa->id;
					$add["nama"]=$siswa->nama;
					$add["jk"]=$siswa->jk;
					$add["nis"]=$siswa->nis;
					$add["id_kelas"]=$siswa->id_kelas;
					$agt[$siswa->id]=$add; 
					$agt=json_encode($agt);
					$this->db->set("j_siswa",$agt);
					$this->db->where("kode",$kode);
					$this->db->where("id_tahun",$tahun);
					$this->db->where("id_semester",$sms);
					$this->db->where("id_group",$group);
					$this->db->where("id_eskul",$this->ids());
			return		$this->db->update("eskul_anggota");
				}else{ 	
					$find='"id":"'.$id.'"';
					$datajs2=$this->db->query("select * from eskul_anggota where kode='".$this->kode()."' and
					id_semester='".$sms."' and id_tahun='".$tahun."' and id_eskul='".$this->ids()."' and j_siswa LIKE '%".$find."%' ")->row();
					if(isset($datajs2))
					{
						$agt2=json_decode($datajs2->j_siswa,TRUE);	
						unset($agt2[$id]); 	
						$agt2=json_encode($agt2);
								$this->db->set("j_siswa",$agt2);
								$this->db->where("id",$datajs2->id);
								$this->db->update("eskul_anggota");
					} 
				 
					//$agt=json_decode($datajs->j_siswa,TRUE);					
					$add["id"]=$siswa->id;
					$add["nama"]=$siswa->nama;
					$add["jk"]=$siswa->jk;
					$add["nis"]=$siswa->nis;
					$add["id_kelas"]=$siswa->id_kelas;
					$get[$siswa->id]=$add; 
					$agt=json_encode($get);
					$this->db->set("j_siswa",$agt);
					$this->db->set("id_group",$group);
					$this->db->set("kode",$kode);
					$this->db->set("id_tahun",$tahun);
					$this->db->set("id_semester",$sms);
					$this->db->set("id_eskul",$this->ids());
			return		$this->db->insert("eskul_anggota");
				}
				
				
			}else{
				$find='"id":"'.$id.'"';
				$datajs=$this->db->query("select * from eskul_anggota where kode='".$this->kode()."' and
				id_semester='".$sms."' and id_tahun='".$tahun."' and id_eskul='".$this->ids()."' and j_siswa LIKE '%".$find."%' ")->row();
				$agt=isset($datajs->j_siswa)?($datajs->j_siswa):"";
				$idtable=isset($datajs->id)?($datajs->id):"";
				$agt=json_decode($agt,TRUE); 
				unset($agt[$id]); 	
				$agt=json_encode($agt);
					$this->db->set("j_siswa",$agt);
					$this->db->where("id",$idtable);
					 
			return		$this->db->update("eskul_anggota");
			}
			
			
		}else{
			$agt["id"]=$siswa->id;
			$agt["nama"]=$siswa->nama;
			$agt["jk"]=$siswa->jk;
			$agt["nis"]=$siswa->nis;
			$agt["id_kelas"]=$siswa->id_kelas;
			$add[$siswa->id]=$agt;
			$array=json_encode($add);
			
			
			$this->db->set("id_group",$group);
			$this->db->set("kode",$kode);
			$this->db->set("id_tahun",$tahun);
			$this->db->set("id_semester",$sms);
			$this->db->set("id_eskul",$this->ids());
			$this->db->set("j_siswa",$array);
		return	$this->db->insert("eskul_anggota");
		}
		
		
	}
	
	
	
	function pilih($id,$group)
	{	$tahun=$this->m_reff->tahun();
		$sms=$this->m_reff->semester();
		$kode=$this->kode();
			
			$this->db->where("id_group",$group);
			$this->db->where("kode",$kode);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
		$this->db->where("id_eskul",$this->ids());
		$data=$this->db->get("eskul_anggota")->row();
		$agt=isset($data->j_siswa)?($data->j_siswa):"";
		
		$siswa=$this->db->get_where("data_siswa",array("id"=>$id))->row();
			
			
		if($agt)
		{
			
			$agt=json_decode($agt,TRUE); 
			$add["id"]=$siswa->id;
			$add["nama"]=$siswa->nama;
			$add["jk"]=$siswa->jk;
			$add["nis"]=$siswa->nis;
			$add["id_kelas"]=$siswa->id_kelas;
			$agt[$siswa->id]=$add; 
			$array=json_encode($agt);
			
			$this->db->where("id_group",$group);
			$this->db->where("kode",$kode);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_eskul",$this->ids());
			$this->db->set("j_siswa",$array);
		return	$this->db->update("eskul_anggota");
		}else{
			$agt["id"]=$siswa->id;
			$agt["nama"]=$siswa->nama;
			$agt["jk"]=$siswa->jk;
			$agt["nis"]=$siswa->nis;
			$agt["id_kelas"]=$siswa->id_kelas;
			$add[$siswa->id]=$agt;
			$array=json_encode($add);
			
			
			$this->db->set("id_group",$group);
			$this->db->set("kode",$kode);
			$this->db->set("id_tahun",$tahun);
			$this->db->set("id_semester",$sms);
			$this->db->set("id_eskul",$this->ids());
			$this->db->set("j_siswa",$array);
		return	$this->db->insert("eskul_anggota");
		}
		
		
	} 
	
	function unpilih($id,$group)
	{	$tahun=$this->m_reff->tahun();
		$sms=$this->m_reff->semester();
		$kode=$this->kode();
			
			$this->db->where("id_group",$group);
			$this->db->where("kode",$kode);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
		$this->db->where("id_eskul",$this->ids());
		$data=$this->db->get("eskul_anggota")->row();
		$agt=isset($data->j_siswa)?($data->j_siswa):"";
		
			
		if($agt)
		{
			$agt=json_decode($agt,TRUE); 
			unset($agt[$id]);
			$array=json_encode($agt);
			
			$this->db->where("id_group",$group);
			$this->db->where("kode",$kode);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_eskul",$this->ids());
			$this->db->set("j_siswa",$array);
		return	$this->db->update("eskul_anggota");
		} 
		
		
	}
	function cekEskul($id_siswa,$group,$tahun,$sms,$kode)
	{  
			$this->db->where("id_group",$group);
			$this->db->where("kode",$kode);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_eskul",$this->ids());
		$data=$this->db->get("eskul_anggota")->row();
		$data=isset($data->j_siswa)?($data->j_siswa):"";
		
		$find='"id":"'.$id_siswa.'"';
		if(strpos($data,$find)===false){
		return false;
		}return true;
	}
		
		function cekNilai($id_siswa,$tahun,$sms)
	{  
		 
			$this->db->where("id_siswa",$id_siswa);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_ektra",$this->ids());
		return $data=$this->db->get("tm_ekstrakurikuler")->num_rows();
		 
	}
		function getNilaiEskul($id_siswa,$tahun,$sms)
	{  
		 
			$this->db->where("id_siswa",$id_siswa);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_ektra",$this->ids());
		return $data=$this->db->get("tm_ekstrakurikuler")->row();
		 
	}
		
	function inputNilai()
	{  	$tahun=$this->m_reff->tahun();
	  	$sms=$this->m_reff->semester();
		 $id_siswa=$this->input->post("id");
		 $nilai=$this->input->post("nilai");
		 $var=$this->input->post("f");
		 
		 $cek=$this->cekNilai($id_siswa,$tahun,$sms);
		 if($cek){
				 $this->db->where("id_tahun",$tahun);
			  	 $this->db->where("id_semester",$sms);
			  	 $this->db->where("id_siswa",$id_siswa);
			 	 $this->db->set("nilai",$nilai);
			 	 $this->db->set("id_ektra",$this->ids());
				 $this->db->set($var);
		return	 $this->db->update("tm_ekstrakurikuler");
		 }else{
				 $this->db->set("id_tahun",$tahun);
			  	 $this->db->set("id_semester",$sms);
			  	 $this->db->set("id_siswa",$id_siswa);
			 	 $this->db->set("nilai",$nilai);
			 	 $this->db->set("id_ektra",$this->ids());
				 $this->db->set($var);
		return	 $this->db->insert("tm_ekstrakurikuler");
		 }
		 
	}
		
		
	function cekEskulNoGroup($id_siswa,$tahun,$sms,$kode)
	{  		$find='"id":"'.$id_siswa.'"';
		 	$this->db->where("j_siswa LIKE '%".$find."%' ");
			$this->db->where("kode",$kode);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_eskul",$this->ids());
			$data=$this->db->get("eskul_anggota")->row();
	 return isset($data->id_group)?($data->id_group):"";
	 
	}
	 
	function jmlabsen($id_siswa,$tahun,$sms)
	{
			$this->db->where("id_eskul",$this->ids());
			$this->db->where("id_tahun",$tahun);
			$this->db->where("id_semester",$sms);
		$dt=$this->db->get("eskul_absen")->result();
		$alfa=$hadir="0";
		foreach($dt as $val)
		{
			$hadir.=$val->hadir;
			$alfa.=$val->alfa;
		}
		
		if(strpos($alfa,",")!==false){
			 
			 $alfa=str_replace(",,",",",$alfa);
			$alfa=$this->m_reff->clearkomaray($alfa); 
		 
			$alfa=array_count_values($alfa);
			$alfa=isset($alfa[$id_siswa])?($alfa[$id_siswa]):0;
		} 
		
		 if(strpos($hadir,",")!==false){
			 
			// $hadir=substr($hadir, 1);
				$hadir=str_replace(",,",",",$hadir);
				$hadir=$this->m_reff->clearkomaray($hadir); 
			//	 print_r($hadir);
				$hadir=array_count_values($hadir);
				$hadir=isset($hadir[$id_siswa])?($hadir[$id_siswa]):0;
		 }
	
		$var["hadir"]=$hadir;
		$var["alfa"]=$alfa;
		return $var;
		
	}
	 
	 
	 function jmlabsenharian($id)
	{
			$this->db->where("id",$id);
			$val=$this->db->get("eskul_absen")->row();
		 
			$hadir=isset($val->hadir)?($val->hadir):"0";
			$alfa=isset($val->alfa)?($val->alfa):"0";
			 
		 
		
		if(strpos($alfa,",")!==false){
			 
			 $alfa=str_replace(",,",",",$alfa);
			$alfa=$this->m_reff->clearkomaray($alfa); 
			$alfa=count($alfa);
			 
		} 
		
		 if(strpos($hadir,",")!==false){
			 
			 
				$hadir=str_replace(",,",",",$hadir);
					$hadir=$this->m_reff->clearkomaray($hadir); 
				$hadir=count($hadir);
		 
		 }
	
		$var["hadir"]=$hadir;
		$var["alfa"]=$alfa;
		return $var;
		
	}
	 
	 
	 
 
 
}
 