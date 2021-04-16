<?php

class Model extends CI_Model  {
    
	var $tbl="data_tugas";
 
 	function __construct()
    {
        parent::__construct();
    }
     function id_kelas() //untuk ortu
	{
		$data=$this->db->query("select id_kelas from data_siswa where id='".$this->idu()."' ")->row();
		return isset($data->id_kelas)?($data->id_kelas):"";
	}
	function idu()
	{
		return $this->session->userdata("id");
	}
 
	
	 	function dataKelasAjar()
	{
		$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		$data=$this->db->select("DISTINCT(id_kelas) as id_kelas");
		$this->db->where("id_guru",$this->idu());
			$this->db->where("id_semester",$sms);
			$this->db->where("id_tahun",$tahun);
		$this->db->order_by("id_kelas","asc");
		return $this->db->get("v_jadwal")->result();
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
				 		  
    	$id_kelas=$this->id_kelas();
		$id_mapel=$this->input->post("id_mapel");
		$filter="";
		
	 
		 
			$filter.="AND kelas LIKE '%,".$id_kelas.",%' ";
	 
		if($id_mapel)
		{
		    $mapel=$this->m_reff->getMapelSerupa($id_mapel);
			$filter.="AND id_mapel IN($mapel) ";
		}
		
		$id_guru=$this->idu();
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from ".$this->tbl." where 1=1 $filter ";
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
	function insert()
	{	
		$id_tugas=$this->input->post("id_tugas");
			$ket=$this->input->post("f[ket]");
		$this->db->set('ket',$ket);
		$this->db->set('id_siswa',$this->idu());
		$this->db->set("id_tugas",$id_tugas);
		 $nama=$this->m_reff->goField("data_siswa","nama","where id='".$this->idu()."' ");
		 
		 
	         $this->db->where("id_siswa",$this->idu());
	         $this->db->where("id_tugas",$id_tugas);
	  $cek= $this->db->get("data_tugas_siswa")->row();
	  
	  
			if(isset($_FILES["file"]['tmp_name']))
			{
        		$do=$this->m_reff->upload_file("file","tugas/$id_tugas",$nama_file_awal=$nama,$type_file_yg_diizinkan="MP4,MP3,JPG,JPEG,PNG,XLSX,DOCX,PDF,pptx",$sizeFile="10000000",$before_file=isset($cek->file)?($cek->file):"");
        		if($do["size"]==false){
        		  //  $max=$do["maxsize"]."MB";
        		      $do["gagal"]=false; $do["info"]="File terlalu besar maksimal 10MB";
        		      return $do;
        		}
        		else if($do["validasi"]==false){
        		     
        		      $do["gagal"]=false; $do["info"]="Tidak dapat mengupload file, coba ganti file ";
        		      return $do;
        		}
        		else if($do["file"]==false){
        		     $type=$do["type_file"];
        		      $do["gagal"]=false; $do["info"]="Gagal!! file yang diizinkan: $type ";
        		      return $do;
        		}else if(isset($do["name"])){
        		    	$this->db->set("file",$do["name"]);
        		}
			}
			if(isset($cek->id)){
			    $this->db->where("id_tugas",$id_tugas);
			      $this->db->where("id_siswa",$this->idu());
                	return	$this->db->update("data_tugas_siswa");
			}
	        else{
	            	return	$this->db->insert("data_tugas_siswa");
	            }
		
	}
 
 
}