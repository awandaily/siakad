<?php

class Model_siswa extends CI_Model  {
    
 
	 
	var $tbl="data_siswa";
	var $tbl_log="data_siswa";
	 
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	
	/*===================================*/
	function get_data()
	{
		$query=$this->_get_data();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data()
	{
						  
				 		  
		$cari=$this->input->post("searching");
		$id_kelas=$this->input->post("id_kelas");
		$gender=$this->input->post("gender");
		$aktifasi=$this->input->post("aktifasi");
		$id_agama=$this->input->post("id_agama");
		$id_tahun_masuk=$this->input->post("id_tahun_masuk");
		$id_status_ibu=$this->input->post("id_status_ibu");
		$id_status_ayah=$this->input->post("id_status_ayah");
		$id_penghasilan=$this->input->post("id_penghasilan");
		$id_pekerjaan_ibu=$this->input->post("id_pekerjaan_ibu");
		$id_pekerjaan_ayah=$this->input->post("id_pekerjaan_ayah");
	 	$id_stsdata=$this->input->post("id_stsdata");
	 
		 
		$filter="";
		$group=$this->input->post("group");
		if($group)
		{
			$tahun=$this->m_reff->tahun();
			$sms=$this->m_reff->semester();
			$kode=$this->mdl->kode();
					$this->db->where("kode",$kode);
					$this->db->where("id_tahun",$tahun);
					$this->db->where("id_semester",$sms);
					$this->db->where("id_group",$group);
					$this->db->where("id_eskul",$this->mdl->ids());
					$datag=$this->db->get("eskul_anggota")->row();
			$hasil=isset($datag->j_siswa)?($datag->j_siswa):"";
			if(strlen($hasil)>10)
			{
				$koma="";
				$hasil=json_decode($hasil,TRUE);
				foreach($hasil as $sil=>$sol)
				{
					$koma.=$sil.",";
				}
				$koma=substr($koma,0,-1);
				$filter.=" AND id IN (".$koma.") ";
			}
			
			
		}
		
		if($id_stsdata)
		{
			$filter.=" AND id_sts_data='".$id_stsdata."' ";
		}else{
			//$filter.=" AND aktifasi=1 and id_tahun_keluar is null";
				if($aktifasi)
				{
				$filter.="AND aktifasi='".$aktifasi."'  and id_tahun_keluar is null";
				} 
		}
		 
		 
		if($cari)
		{
			$filter.=" AND (
				nama LIKE '%".$cari."%'  or
				nis LIKE '%".$cari."%'  or
				 
				alamat LIKE '%".$cari."%'  or
				hp LIKE '%".$cari."%'  
				) ";
		}
		 
		
		 
		/*if($id_kelas)
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
			
		} */
		 
		if($id_kelas)
		{
			$filter.=" AND id_kelas='".$id_kelas."' ";
		} 
		
		if($gender)
		{
			$filter.=" AND jk='".$gender."' ";
		} 
		
	 	$tahun=$this->m_reff->tahun();
 
        $filter.=" AND id_sts_data in (1,4) ";
		$query="select * from ".$this->tbl." where 1=1 $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				nis LIKE '%".$searchkey."%'  or
				nama_ayah LIKE '%".$searchkey."%'  or
				nama_ibu LIKE '%".$searchkey."%'  or
				alamat LIKE '%".$searchkey."%'  or
				hp LIKE '%".$searchkey."%'  
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
		$query.=" order by  nama ASC";
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
	 
	 /*===================================*//*===================================*/
	function data_migrasi()
	{
		$query=$this->_data_migrasi();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _data_migrasi()
	{
						  
				 		  
		$cari=$this->input->post("searching");
		$id_kelas=$this->input->post("id_kelas");
		$gender=$this->input->post("gender");
		$aktifasi=$this->input->post("aktifasi");
		$id_agama=$this->input->post("id_agama");
		$id_tahun_masuk=$this->input->post("id_tahun_masuk");
		$id_status_ibu=$this->input->post("id_status_ibu");
		$id_status_ayah=$this->input->post("id_status_ayah");
		$id_penghasilan=$this->input->post("id_penghasilan");
		$id_pekerjaan_ibu=$this->input->post("id_pekerjaan_ibu");
		$id_pekerjaan_ayah=$this->input->post("id_pekerjaan_ayah");
 		 
		$filter="";
		
		
	 
		
		if($cari)
		{
			$filter.=" AND (
				nama LIKE '%".$cari."%'  or
				nis LIKE '%".$cari."%'  or
				 
				) ";
		}
		if($id_pekerjaan_ayah)
		{
			$filter.="AND id_pekerjaan_ayah='".$id_pekerjaan_ayah."' ";
		}
		if($id_pekerjaan_ibu)
		{
			$filter.="AND id_pekerjaan_ibu='".$id_pekerjaan_ibu."' ";
		}
		if($id_penghasilan)
		{
			$filter.="AND id_penghasilan='".$id_penghasilan."' ";
		}
		if($id_status_ayah)
		{
			$filter.="AND id_status_ayah='".$id_status_ayah."' ";
		} 
		if($id_status_ayah)
		{
			$filter.="AND id_status_ayah='".$id_status_ayah."' ";
		} 
		if($id_status_ibu)
		{
			$filter.="AND id_status_ibu='".$id_status_ibu."' ";
		} 
		if($id_tahun_masuk)
		{
			$filter.="AND id_tahun_masuk='".$id_tahun_masuk."' ";
		} 
		if($id_agama)
		{
			$filter.="AND id_agama='".$id_agama."' ";
		} 
		if($aktifasi)
		{
			$filter.="AND aktifasi='".$aktifasi."' ";
		} 
		 
		if($id_kelas)
		{	 
			 
			$filter="AND id_kelas = '".$id_kelas."' ";
	 
			
		} 
		 
		if($gender)
		{
			$filter.="AND jk='".$gender."' ";
		} 
		
		 
		$query="select * from ".$this->tbl." where 1=1 $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				nis LIKE '%".$searchkey."%'  
				 
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
		$query.=" order by id_tk,id_jurusan,nama_kelas,nama ASC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
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
	
	
	
	 
}