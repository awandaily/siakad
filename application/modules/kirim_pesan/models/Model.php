<?php

class Model extends CI_Model  {
    
	var $tbl="data_tugas";
  
	function cekTugasSiswa($id,$idsiswa)
	{
	     $this->db->where("id_siswa",$idsiswa);
	    $this->db->where("id_tugas",$id);
	 return $this->db->get("data_tugas_siswa")->row();
	  
	}
 
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	
	 	function dataGuru()
	{
		 
			$this->db->where("aktifasi",1);
		$this->db->order_by("nama","asc");
		return $this->db->get("v_pegawai")->result();
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
		$id_mapel=$this->input->post("id_mapel");
		$filter="";
		
	 
		if($id_kelas)
		{
			$filter.="AND kelas LIKE '%,".$id_kelas.",%' ";
		}
		if($id_mapel)
		{
		    $mapel=$this->m_reff->getMapelSerupa($id_mapel);
			$filter.="AND id_mapel IN($mapel) ";
		}
		
		$id_guru=$this->idu();
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from ".$this->tbl." where id_guru=".$id_guru." $filter ";
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
	
		 function get_data_pesan()
	{
		$query=$this->_get_data_pesan();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_pesan()
	{
			$filter="";		 		  
	 $level=$this->session->userdata("level");
	 if($level=="GURU"){
	     $filter.=" AND _cid='".$this->idu()."' ";
	 }
	 
	
		 
		 
		$query="select * from data_pesan  where 1=1 ".$filter;
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
		$query.="group by kode order by id   DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.="group by kode order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	public function countPengumuman()
	{				
		$query = $this->_get_data_pesan();
        return  $this->db->query($query)->num_rows();
	}	
	public function count()
	{				
		$query = $this->_get_data();
        return  $this->db->query($query)->num_rows();
	}
	function dataProfile()
	 {
	     $level=$this->session->userdata("level");
	     if($level=="BPBK"){
	         $idu=$this->session->userdata("id");
	         	$this->db->where("id",$idu);
    			$this->db->select("*,nama as owner,hp as telp");
    		return $this->db->get("data_pegawai")->row();
	     }
		$idu=$this->session->userdata("id");
		$this->db->where("id_admin",$idu);
		$return=$this->db->get("admin")->row();
		 if($return){
		     return $return;
		 }else{
		    	$this->db->where("id",$idu);
    			$this->db->select("*,nama as owner,hp as telp");
    		return $this->db->get("data_pegawai")->row();
		 }
	 }
	function insert_pengumuman()
	{   $kode=date("dmyHis");
	    $data=$this->mdl->dataProfile();
	    $pengirim=isset($data->owner)?($data->owner):"-";
	   $judul=$this->input->post("judul");
	   $pesan=$this->input->post("pesan");
	   $guru=$this->input->post("id_guru[]");
		$guru=$this->input->post("id_guru[]");
		foreach($guru as $guru)
		{
		    
		    $aray=array(
		    "id_guru"=>$guru,
		    "judul"=>$judul,
		    "pesan"=>$pesan,  
		    "_cid"=>$this->idu(),
		    "pengirim"=>$pengirim,
		    "kode"=>$kode
		    
		    );
		    $this->db->insert("data_pesan",$aray);
		}
	
	  
	return	true;
	}
 
 
		function update_pengumuman()
	{   $id=$this->input->post("id");
			$form=$this->input->post("f");
		$hari=$this->input->post("hari");
		$t=$this->input->post("id_kelas"); 
	 
		$c="";
		foreach($t as $val)
		{	 
			$c.=$val.",";
		}
		$tgl=$this->tanggal->tambahTgl(null,$hari);
		$kelas=$c;
		$this->db->where("id",$id);
		$this->db->set('id_guru',$this->idu());
		$this->db->set("kelas",",".$kelas);
		$this->db->set("expired",$tgl);
		$this->db->set($form);
 
		$notug=$id;
	 
		 
		
			if(isset($_FILES["file"]['tmp_name']))
			{
			    
			$namafile=$this->m_reff->goField("data_pesan","file","where id='".$notug."'");
            		 
        		$do=$this->m_reff->upload_file("file","pengumuman/$notug",$nama_file_awal="info",$type_file_yg_diizinkan="JPG,JPEG,PNG,XLSX,DOCX,PDF,pptx",$sizeFile="3000000",$before_file=$namafile);
        		if($do["size"]==false){
        		  //  $max=$do["maxsize"]."MB";
        		      $do["gagal"]=false; $do["info"]="File terlalu besar maksimal 3MB";
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
	return	$this->db->update("data_pesan");
	}
	function hapus($id)
	{          
	        $nama=$this->m_reff->goField("data_tugas","file","where id='".$id."'");
	        $filename="file_upload/tugas/".$id."/".$nama; 
		 	if(file_exists($filename)){
		 	    unlink($filename);
		 	}
		 	
		 		$array=array(
		  		    "id_tugas"=>$id,
		    );
		 $this->db->delete("data_tugas_siswa",$array);
		 
		 
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id",$id);
return		  $this->db->delete("data_tugas");
		  
		 
	
	}
	function hapus_pengumuman($kode)
	{
	         
	    	  $this->db->where("kode",$kode); 
    return	  $this->db->delete("data_pesan");
		  
	}
 
}