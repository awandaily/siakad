<?php

class Model extends CI_Model  {
    
	var $tbl="tm_catatan";
 
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	
	 
	function dataKelas()
	{
		$data=$this->db->select("DISTINCT(id_kelas) as id_kelas");
		$this->db->order_by("id_kelas","asc");
		return $this->db->get($this->tbl_jadwal)->result();
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
				 		  
		$id_kelas=$this->input->post("id_kelas");
		$id_jenis=$this->input->post("id_jenis");
		$ke_bp=$this->input->post("ke_bp");
		$id_siswa=$this->input->post("id_siswa");
		  
		$filter="";
		if($ke_bp)
		{
			if($ke_bp==4)
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
		
		$id_guru=$this->idu();
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from ".$this->tbl." where id_guru=".$id_guru." and id_tahun='".$tahun."' and id_semester='".$sms."'  $filter ";
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
				 		  
		$id_quota=$this->input->post("id_mitra");
        $pkl=$this->db->query("select * from tr_mitra_quota where id='".$id_quota."' ")->row();	  
        
        $id_mitra=isset($pkl->id_mitra)?($pkl->id_mitra):"";
        $tgl_otw=isset($pkl->tgl_berangkat)?($pkl->tgl_berangkat):"";
        $lama=isset($pkl->lama)?($pkl->lama):"";
        
	  
	  
		$id_guru=$this->idu();
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from v_pkl where id_quota=".$id_quota."      ";
			 

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by id_siswa asc";
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
	
	
	
	
	
	
	function insert()
	{ 
	    $sts=$this->input->get_post("sts");
    if($sts=="otw"){
        $set1="sts_berangkat";
        $set2="foto_berangkat";
    }elseif($sts=="plg"){
        $set1="sts_pulang";
        $set2="foto_pulang";
    }elseif($sts=="m1"){
        $set1="sts_m1";
        $set2="foto_m1";
    }elseif($sts=="m2"){
        $set1="sts_m2";
        $set2="foto_m2";
    }elseif($sts=="m3"){
        $set1="sts_m3";
        $set2="foto_m3";
    }elseif($sts=="m4"){
        $set1="sts_m4";
        $set2="foto_m4";
    }elseif($sts=="m5"){
        $set1="sts_m5";
        $set2="foto_m5";
    }elseif($sts=="m6"){
        $set1="sts_m6";
        $set2="foto_m6";
    }
    
    
    
		$config['upload_path']      = './file_upload/pkl/';
        $config['allowed_types']    = 'JPG|PNG|GIF|JPEG|jpeg|png|jpg|gif';
        $config["overwrite"]        = TRUE;
        $config['encrypt_name'] 	= TRUE;

        $this->load->library('upload', $config);

        $s1=$this->upload->do_upload('bukti');
        $g1 =$this->upload->data();
 

        if($s1){
        	$this->db->set($set2,$g1["file_name"]);
        }
        else{
        	//$this->set("file_bukti", "");
        }
    
	 
	    $id_pembimbing=$this->input->get_post("id_pembimbing");
	    $tgl_berangkat=$this->input->get_post("tgl_berangkat");
	    $id_mitra=$this->input->get_post("id_mitra");
	    $tgl_pelaksanaan=$this->input->get_post("tgl_pelaksanaan");
	    $tgl_pelaksanaan=$this->tanggal->eng_($tgl_pelaksanaan,"-");
		
		 $id=$this->input->get_post("id");
         $data=$this->db->query("select * from tr_mitra_quota where id='".$id."' ")->row();
	 	 $foto=isset($data->$set2)?($data->$set2):"x";
	 	 if(!$foto){ $foto="x";}
	 	 if(file_exists("file_upload/pkl/".$foto)){
	 	     unlink("file_upload/pkl/".$foto);
	 	 }
		
		$this->db->set($set1,$tgl_pelaksanaan);
		//$this->db->where("id_pembimbing",$id_pembimbing);
	//	$this->db->where("tgl_berangkat",$tgl_berangkat);
	//	$this->db->where("id_mitra",$id_mitra);
	$this->db->where("id",$id);
	 	$this->db->update("tr_mitra_quota");
 
		return true;
		
	}
 
 
}