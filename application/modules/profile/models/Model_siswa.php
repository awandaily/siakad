<?php

class Model_siswa extends CI_Model  {
    
	var $tbl="data_siswa";
	function __construct()
    {
        parent::__construct();
    }
	 
	 
	 
	  function dataProfile()
	 {
		$idu=$this->session->userdata("id");
		$this->db->where("id",$idu);
		return $this->db->get($this->tbl)->row();
		 
	 }
	   function dataProfilePegawai()
	 {
		$idu=$this->session->userdata("id");
		$this->db->where("id",$idu);
		return $this->db->get($this->tbl)->row();
		 
	 }
	 
	 
	function updateSiswa()
	{
	 $var=array();
	$var["size"]=""; 
	$var["file"]="";
	$var["password"]="";
	$var["validasi"]=false; 
	
	 $user=$this->input->post("f[username]");
	 $user=$this->security->xss_clean($user);
	 
	 $pass=$this->input->post("password");
	 $pass=$this->security->xss_clean($pass);
	 
	 $id=$this->input->post("id");
	 $idu=$this->session->userdata("id");
	 
	 if(!$id) {		$id=$idu;	 }
	 
	    $pro=$this->dataProfile();
		$data=$this->input->post("f");
		$data=$this->security->xss_clean($data);
		if($pass)
		{
		  $this->db->set("password",md5($pass));
		 // 	$this->db->set("alias","li".$pass."la");
		} 
		 
		if($this->cekPassword($id,$user,$pass)>0)
		{
			 $var["password"]=false; $var["validasi"]=false; 
		}else
		{
			 $var["validasi"]=true; 
			 if(isset($_FILES["poto"]['tmp_name']))
			{  
				$file=$this->upload_file("poto","dp",$idu,$id);
				if($file["validasi"]!=false)
				{
					
					$this->db->set("poto",$file["name"]);
					
				}
			$var=$file;
			} 
			
				$this->db->where("id",$id);
				$this->db->update($this->tbl,$data);		
			 
		}
			return $var;

	} 
	
	function update()
	{
	 $var=array();
	$var["size"]=""; 
	$var["file"]="";
	$var["password"]="";
	$var["validasi"]=false; 
	
	 $user=$this->input->post("f[username]");
	 $user=$this->security->xss_clean($user);
	 
	 $pass=$this->input->post("password");
	 $pass=$this->security->xss_clean($pass);
	 
	 $id=$this->input->post("id_admin");
	 $idu=$this->session->userdata("id");
	 
	 if(!$id) {		$id=$idu;	 }
	 
	 $pro=$this->mdl->dataProfile();
		$data=$this->input->post("f");
		$data=$this->security->xss_clean($data);
		if($pass)
		{
		  $this->db->set("password",md5($pass));
		  $this->db->set("alias","li".$pass."la");
		} 
		 
		if($this->cekPassword($id,$user,$pass)>0)
		{
			 $var["password"]=false; $var["validasi"]=false; 
		}else
		{
			 $var["validasi"]=true; 
			 if(isset($_FILES["poto"]['tmp_name']))
			{  
				$file=$this->upload_file("poto","dp",$idu,$id);
				if($file["validasi"]!=false)
				{
					
					$this->db->set("poto",$file["name"]);
					
				}
			$var=$file;
			} 

				$this->db->where("id_admin",$id);
				$this->db->update("admin",$data);		
			
			 
		}
			return $var;
	
	}
	function upload_file($form,$dok,$idu,$id=null,$tabel="admin")
	{		
		$var=array();
		$var["size"]=""; 
		$var["file"]="";
		$var["validasi"]=false; 
	
		$nama=date("YmdHis")."_".$idu."_";
		  $lokasi_file = $_FILES[$form]['tmp_name'];
		  $tipe_file   = $_FILES[$form]['type'];
		  $nama_file   = $_FILES[$form]['name'];
		   $size  	   = $_FILES[$form]['size'];
			$nama_file=str_replace(" ","_",$nama_file);
			// $jenis="jpg";
			$nama=str_replace("/","",$nama."_".$nama_file);
			 $target_path = "file_upload/".$dok."/".$nama;
			 
			  $ex=substr($nama_file,-3);
			$extention=str_replace(" ","_",strtoupper($ex));
			
		 $maxsize = 3000000;
		 if($size>=$maxsize)
		 {
			$var["size"]=$size; 
		 }elseif($extention!="JPG" AND $extention!="PNG"){
			$var["file"]=$extention;
		 }else{
		 	$var["validasi"]=true;
			if (!empty($lokasi_file)) {
			move_uploaded_file($lokasi_file,$target_path);
				if($id)
				{
					$namapotoid=$this->m_reff->goField($tabel,"poto","where id_admin='".$id."'");
					$file_namapotoid="file_upload/".$dok."/".$namapotoid."";
					if(file_exists($file_namapotoid))
					{
						unlink($file_namapotoid);
					}
				}
			
			 }
			$var["name"]=$nama;
		 }
		 return $var;
	}
	function insert()
	{
		$var=array();
	$var["size"]=""; 
	$var["file"]="";
	$var["password"]="";
	$var["validasi"]=false; 
	
	 $user=$this->input->post("f[username]");
	 $user=$this->security->xss_clean($user);
	 
	 $pass=$this->input->post("password");
	 $pass=$this->security->xss_clean($pass);
	 
	 $id=$this->session->userdata("id");
	 $pro=$this->mdl->dataProfile();
		$data=$this->input->post("f");
		$data=$this->security->xss_clean($data);
		if($pass)
		{
		  $this->db->set("password",md5($pass));
		   $this->db->set("alias","li".$pass."la");
		} 
		 
		if($this->cekPassword("",$user,$pass)>0)
		{
			 $var["password"]=false; $var["validasi"]=false; 
		}else
		{
			 $var["validasi"]=true; 
			 if(isset($_FILES["poto"]['tmp_name']))
			{  
				$file=$this->mdl_extra->upload_file_image("poto","dp",$id);
				if($file["validasi"]!=false)
				{
					
					$this->db->set("poto",$file["name"]);
					
				}
			$var=$file;
			} 
			//	$this->db->where("id_admin",$id);
				$this->db->insert("admin",$data);		
			
			 
		}
			return $var;
	
	}
	
	 
	
	
	 function cekPassword($id,$user,$pass)
	{
		 
		$this->db->where("id_admin!=",$id);
		$this->db->where("username",$user);
		$this->db->where("password",md5($pass));
		$return1=	$this->db->get("admin")->num_rows();
		
		$this->db->where("id!=",$id);
		$this->db->where("username",$user);
		$this->db->where("password",md5($pass));
		$return2=	$this->db->get($this->tbl)->num_rows();
		
		$this->db->where("id!=",$id);
		$this->db->where("username",$user);
		$this->db->where("password",md5($pass));
		$return3=	$this->db->get("data_siswa")->num_rows();
		return ($return1+$return2+$return3);
	}
	
	 
}