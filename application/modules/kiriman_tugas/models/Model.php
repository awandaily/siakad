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
        date_default_timezone_set("Asia/Jakarta");
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	function dataMapel()
	{
		$data=$this->db->select("DISTINCT(id_mapel) as id_mapel");
		return $this->db->get("v_jadwal")->result();
	}
	
	 	function dataKelasAjar()
	{
		$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		$data=$this->db->select("DISTINCT(id_kelas) as id_kelas,nama_kelas");
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
				 		  
		$id_kelas=$this->input->post("id_kelas");
		$id_mapel=$this->input->post("id_mapel");
		$filter="";
		
	 
		if($id_kelas)
		{
			$filter.="AND kelas LIKE '%,".$id_kelas.",%' ";
		}
		if($id_mapel)
		{
		    //$mapel=$this->m_reff->getMapelSerupa($id_mapel);
			$filter.="AND id_mapel = '".$id_mapel."' ";
		}
		
		$id_guru=$this->idu();
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from ".$this->tbl." WHERE DATE(_ctime) = '".date("Y-m-d")."' $filter ";
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
	
		 function get_data_pengumuman()
	{
		$query=$this->_get_data_pengumuman();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_pengumuman()
	{
				 		  
		$id_kelas=$this->input->post("id_kelas");
	 
		$filter="";
		
	 
		if($id_kelas)
		{
			$filter.="AND kelas LIKE '%,".$id_kelas.",%' ";
		}
	 
		
		$id_guru=$this->idu();
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from data_pengumuman where id_guru=".$id_guru." $filter ";
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
	public function countPengumuman()
	{				
		$query = $this->_get_data_pengumuman();
        return  $this->db->query($query)->num_rows();
	}	
	public function count()
	{				
		$query = $this->_get_data();
        return  $this->db->query($query)->num_rows();
	}
	function insert_pengumuman()
	{
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
		$this->db->set('id_guru',$this->idu());
		$this->db->set("kelas",",".$kelas);
		$this->db->set("expired",$tgl);
		$this->db->set($form);
	 
		$notug=$this->m_reff->next_nomor('data_pengumuman');
		$path="file_upload/pengumuman";
		if(!file_exists($path)){
		    mkdir($path, 0777, true);
		}
		 
		
		
			if(isset($_FILES["file"]['tmp_name']))
			{
        		$do=$this->m_reff->upload_file("file","pengumuman",$nama_file_awal="info",$type_file_yg_diizinkan="JPG,JPEG,PNG,XLSX,DOCX,PDF,pptx,ZIP,zip,rar,RAR",$sizeFile="3000000",$before_file=null);
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
	return	$this->db->insert("data_pengumuman");
	}
	function insert()
	{	
		$form=$this->input->post("f");
		$hari=$this->input->post("hari");
		$t=$this->input->post("id_kelas"); 
		$id_mapel=$this->input->post("id_mapel");
		$c="";
		foreach($t as $val)
		{	 
			$c.=$val.",";
		}
		$tgl=$this->tanggal->tambahTgl(null,$hari);
		$kelas=$c;
		$this->db->set('id_guru',$this->idu());
		$this->db->set("kelas",",".$kelas);
		$this->db->set("expired",$tgl);
		$this->db->set($form);
		$this->db->set("id_mapel",$id_mapel);
		$notug=$this->m_reff->next_nomor('data_tugas');
		$path="file_upload/tugas";
		if(!file_exists($path)){
		    mkdir($path, 0777, true);
		}
			$path="file_upload/tugas/".$notug;
		if(!file_exists($path)){
		    mkdir($path, 0777, true);
		}
		
		
			if(isset($_FILES["file"]['tmp_name']))
			{
        		$do=$this->m_reff->upload_file("file","tugas/$notug",$nama_file_awal="tugas",$type_file_yg_diizinkan="JPG,JPEG,PNG,XLSX,DOCX,PDF,pptx,ZIP,zip,rar,RAR",$sizeFile="3000000",$before_file=null);
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
	return	$this->db->insert("data_tugas");
		
	}
	function update()
	{   $id=$this->input->post("id");
			$form=$this->input->post("f");
		$hari=$this->input->post("hari");
		$t=$this->input->post("id_kelas"); 
		$id_mapel=$this->input->post("id_mapel");
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
	//	$this->db->set("id_mapel",$id_mapel);
		$notug=$id;
	 
		 
		
			if(isset($_FILES["file"]['tmp_name']))
			{
			    
			$namafile=$this->m_reff->goField("data_tugas","file","where id='".$notug."'");
            		 
        		$do=$this->m_reff->upload_file("file","tugas/$notug",$nama_file_awal="tugas",$type_file_yg_diizinkan="JPG,JPEG,PNG,XLSX,DOCX,PDF,pptx",$sizeFile="3000000",$before_file=$namafile);
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
	return	$this->db->update("data_tugas");
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
			    
			$namafile=$this->m_reff->goField("data_pengumuman","file","where id='".$notug."'");
            		 
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
	return	$this->db->update("data_pengumuman");
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
	function hapus_pengumuman($id)
	{
	         $nama=$this->m_reff->goField("data_pengumuman","file","where id='".$id."'");
	        $filename="file_upload/pengumuman/".$nama; 
		 	if(file_exists($filename)){
		 	    unlink($filename);
		 	}
		 	 
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id",$id);
return		  $this->db->delete("data_pengumuman");
		  
	}
	function setNilai($idtugas,$idsiswa,$nilai)
	{   $nilai=str_replace(",",".",$nilai);
	    $cek=$this->cekTugasSiswa($idtugas,$idsiswa);
	    if(isset($cek->id)){
	        $this->db->where("id_tugas",$idtugas);
	         $this->db->where("id_siswa",$idsiswa);
	         $this->db->set("nilai",$nilai);
	      return   $this->db->update("data_tugas_siswa");
	    }else{
	           $this->db->set("id_tugas",$idtugas);
	         $this->db->set("id_siswa",$idsiswa);
	         $this->db->set("nilai",$nilai);
	      return   $this->db->insert("data_tugas_siswa");
	    }
	   
	}
	function sinkron_nilai()
	{   	$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		$id_tugas=$this->input->post("idtugas");
		$id_kelas=$this->input->post("idkelas");
    	$id_kikd=$this->input->post("id_kikd");
    	$id_mapel=$this->input->post("idmapel");
        $nama_nilai=$this->input->post("nama_nilai");
        $id_guru=$this->idu();
        $code=date("dmYHis");
                 $this->db->order_by("nama","ASC");
                $this->db->where("aktifasi",1);
                $this->db->where("id_kelas",$id_kelas);
                $dt=$this->db->get("data_siswa")->result();
                foreach($dt as $val)
                {
                    
                 
                        $ds=$this->mdl->cekTugasSiswa($id_tugas,$val->id);
                        $getNilai=isset($ds->nilai)?($ds->nilai):"";
                	                         $array=array(
                							 "id_kategory_nilai"=>1,
                							  "id_kelas"=>$id_kelas,
                							 "id_kikd"=>$id_kikd,
                							 "id_mapel"=>$id_mapel,
                							 "id_siswa"=>$val->id,
                							 "nama_nilai"=>$nama_nilai,
                							 "id_guru"=>$id_guru,
                							 "id_semester"=>$sms,
                							 "id_tahun"=>$tahun,
                							  "nilai"=>$getNilai,
                		    				  "_cid"=>$id_guru,
                		    				  "code"=>$code
                							 );
                		if($getNilai){					 
                		$this->db->insert("data_nilai",$array);	
                		}
                }
                $kelasin=$this->m_reff->goField("data_tugas","kelas_sin","where id='".$id_tugas."'").",".$id_kelas.",";
                $kelasin=str_replace(",,",",",$kelasin);
                $this->db->where("id",$id_tugas);
                $this->db->set("kelas_sin",$kelasin);
          return      $this->db->update("data_tugas");
	}
	
}