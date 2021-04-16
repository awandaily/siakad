<?php

class Model_siswa extends CI_Model  {
    
 
	var $tbl_jadwal="tm_jadwal_mengajar";
	var $tbl="v_siswa";
	var $tbl_log="data_siswa";
	var $tbl_tagihan="tm_tagihan";
	var $tbl_bayar="tm_pembayaran";
	var $tbl_penilaian="v_penilaian";
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	
	/*===================================*/
	function get_data($order=null)
	{
		$query=$this->_get_data($order);
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data($order)
	{
						  
				 		  
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
	
		 
		if($gender)
		{
			$filter.="AND jk='".$gender."' ";
		} 
		 
		 
  if($this->m_reff->tahun_sts()=="true"){
      	if($aktifasi)
		{
			$filter.="AND aktifasi='".$aktifasi."' ";
		} 
		
      	if($id_kelas)
		{	
			 
			$filter.="AND id_kelas='".$id_kelas."' ";
				$query="select * from ".$this->tbl." where aktifasi=1 and id_tahun_keluar is null $filter ";
		} 
  }else{
		   $tahun=$this->m_reff->tahun();
	          $getIdSiswa=$this->m_reff->goField("tm_catatan_walikelas","id_siswa","where _cid='".$this->mdl->idu()."' and id_tahun='".$tahun."'  order by RAND() limit 1");
	        $idkelas=$this->m_reff->getHisKelas($getIdSiswa);   
	        $id_tk=$this->m_reff->goField("tm_kelas","id_tk","where id='".$idkelas."' "); 
	               
		 	if($id_kelas)
		{	
			 
			$filter.="AND   id_tahun_$id_tk=$tahun and id_kelas_$id_tk=$idkelas  ";
		} 
		$query="select * from ".$this->tbl." where 1=1   $filter ";	
		 
  }
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
	
		
		 
	
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
		
		
		if($order==null)
		{
		
			if(isset($_POST['order']))
			{
			$query.=" order by nama   asc";
			} 
			else if(isset($order))
			{
				$order = $order;
				$query.=" order by ".key($order)." ".$order[key($order)] ;
			}
			
		}else{
		$query.=" order by ".$order;
		}
		
		
		return $query;
	}
	
	public function count($order=null)
	{				
		$query = $this->_get_data($order);
        return  $this->db->query($query)->num_rows();
	}
	 
	 /*===================================*/
	 
	 /*===================================*/
	function get_data_non($order=null)
	{
		$query=$this->_get_data_non($order);
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_non($order)
	{
						  
				 		  
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
		if($id_pekerjaan_ayah)
		{
			$filter.=" AND id_pekerjaan_ayah='".$id_pekerjaan_ayah."' ";
		}
		if($id_pekerjaan_ibu)
		{
			$filter.=" AND id_pekerjaan_ibu='".$id_pekerjaan_ibu."' ";
		}
		if($id_penghasilan)
		{
			$filter.=" AND id_penghasilan='".$id_penghasilan."' ";
		}
		if($id_status_ayah)
		{
			$filter.=" AND id_status_ayah='".$id_status_ayah."' ";
		} 
		if($id_status_ayah)
		{
			$filter.=" AND id_status_ayah='".$id_status_ayah."' ";
		} 
		if($id_status_ibu)
		{
			$filter.=" AND id_status_ibu='".$id_status_ibu."' ";
		} 
		if($id_tahun_masuk)
		{
			$filter.=" AND id_tahun_masuk='".$id_tahun_masuk."' ";
		} 
		if($id_agama)
		{
			$filter.=" AND id_agama='".$id_agama."' ";
		} 
		if($aktifasi)
		{
			$filter.=" AND aktifasi='".$aktifasi."' ";
		} 
		 
	
		
		if($gender)
		{
			$filter.=" AND jk='".$gender."' ";
			
		} 
		$filter.=" AND id_agama>1";
		
		 if($this->m_reff->tahun_sts()=="true"){
		     
		     	if($id_kelas)
		{	
			 
			$filter.=" AND id_kelas='".$id_kelas."' ";
		} 
		     
		     
     $query="select * from ".$this->tbl." where aktifasi=1 and id_tahun_keluar is null $filter ";
	     }else{
	        
	        $id_tk=$this->m_reff->goField("tm_kelas","id_tk","where id='".$id_kelas."' "); 
	                $tahun=$this->m_reff->tahun(); 
                
   
    $query="select * from ".$this->tbl." where id_tahun_$id_tk=$tahun and id_kelas_$id_tk=$id_kelas $filter ";
	     }
		
		
		
		 
		
		 
		
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
		
		
		if($order==null)
		{
		
			if(isset($_POST['order']))
			{
			$query.=" order by nama   asc";
			} 
			else if(isset($order))
			{
				$order = $order;
				$query.=" order by ".key($order)." ".$order[key($order)] ;
			}
			
		}else{
		$query.=" order by ".$order;
		}
		
		
		return $query;
	}
	
	public function count_non($order=null)
	{				
		$query = $this->_get_data_non($order);
        return  $this->db->query($query)->num_rows();
	}
	 
	 /*===================================*/
	 
	//==============================================================///
	 
	function getDataMapel($id)
	{
		$data=explode(",",$id); $mapel="";
		foreach($data as $val)
		{
			$mapel.=$this->m_reff->goField("tr_mapel","nama","where id='".$val."' ").",";
		}
		return substr($mapel,0,-1);
	}		
	  
	 //==============================================================///
	  function kehadiranGroup($id_siswa,$sts,$bln)
	{	
	 
		return $this->db->query("select * from tm_absen_siswa where  SUBSTR(tgl,1,7)='".$bln."'
		and     absen".$sts." like '%,".$id_siswa.",%' group by SUBSTR(tgl,1,10) ")->num_rows();
	}
	 function kehadiran($id_siswa,$sts,$bln)
	{	
	 
		return $this->db->query("select * from tm_absen_siswa where  SUBSTR(tgl,1,7)='".$bln."'
		and     absen".$sts." like '%,".$id_siswa.",%'
		")->num_rows();
	}
	 
	 
	  function get_data_catatan()
	{
		$query=$this->_get_data_catatan();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_catatan()
	{
				 		  
		$id_kelas=$this->input->post("id_kelas");
		$id_jenis=$this->input->post("id_jenis");
		$ke_bp=$this->input->post("ke_bp");
		$id_siswa=$this->input->post("id_siswa");
		  
		$filter="";
		if($ke_bp)
		{
			if($ke_bp==3)
			{
				$filter.="AND teruskan='' ";
			}else{
				$filter.="AND teruskan like '%".$ke_bp."%' ";
			}
		}
		
		
		if($id_siswa)
		{
			$filter.="AND id_siswa='".$id_siswa."' ";
		}
		if($id_kelas)
		{
			$filter.="AND id_kelas='".$id_kelas."' ";
		}
		if($id_jenis)
		{
			$filter.="AND id_jenis='".$id_jenis."' ";
		}
		
		 
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from tm_catatan where     id_tahun='".$tahun."' and id_semester='".$sms."'  $filter ";
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
	
	function count_catatan()
	{				
		$query = $this->_get_data_catatan();
        return  $this->db->query($query)->num_rows();
	}
	
	function update_non()
	{	$sms=$this->m_reff->semester(); $tahun=$this->m_reff->tahun();
		$valu=$this->input->post("valu");
		$id_siswa=$this->input->post("id_siswa");
		$jml=$this->input->post("jml");
		$cek=$this->m_reff->goField("data_nilai_nonmuslim","id_siswa","where id_semester='".$sms."' and id_tahun='".$tahun."' and id_siswa='".$id_siswa."' ");
		if($cek)
		{
			$db="update";
			$this->db->set($valu,$jml);
			$this->db->set("id_guru",$this->idu());
			$this->db->where("id_siswa",$id_siswa);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_tahun",$tahun);
			 
		}else{
			$db="insert";
			$this->db->set($valu,$jml);
			$this->db->set("id_siswa",$id_siswa);
			$this->db->set("id_semester",$sms);
			$this->db->set("id_tahun",$tahun); 
			$this->db->set("id_guru",$this->idu());
		}
		
		return $this->db->$db("data_nilai_nonmuslim");
	}
	 
}