<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	 
	 
	 
	  function updatePembina()
	 {
		$data=$this->input->post("f");
		$this->db->where("id",$this->session->userdata("id"));
		$pass=$this->input->post("password");
		$passmd=md5($pass);
		$this->db->set("password",$passmd);
		$this->db->set("alias","sa".$pass."ia");
		return $this->db->update("data_pegawai",$data);
		 
	 } function dataProfile()
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
	   function dataProfilePegawai()
	 {
		$idu=$this->session->userdata("id");
		$this->db->where("id",$idu);
		$return=$this->db->get("data_pegawai")->row();
		if($return)
		{
			return $return;
		}else{
			$this->db->where("id_admin",$idu);
			$this->db->select("*,owner as nama,telp as hp");
		return $this->db->get("admin")->row();
		}
		 
	 }
	 
	 
	function updatePegawai()
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
				$file=$this->upload_file("poto","dp",$idu,$id, "data_pegawai");
				if($file["validasi"]!=false)
				{
					
					$this->db->set("poto",$file["name"]);
					
				}
			$var=$file;
			} 
			
				$this->db->where("id",$id);
				$this->db->update("data_pegawai",$data);		
			
			 
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

	$level = $this->session->userdata("level");

	 
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
				//$file=$this->upload_file("poto","dp",$idu,$id);
				if ($level == "ADMIN") {
					$before_file=$this->m_reff->goField("admin","poto","where id_admin='".$id."' ");
				}
				else{
					$before_file=$this->m_reff->goField("data_pegawai","poto","where id='".$idu."' ");
				}
				$file=$this->m_reff->upload_file("poto","dp","dp","JPG,JPEG,PNG,png,jpg,jpeg",$sizeFile="3000000",$before_file);
				if($file["validasi"]!=false)
				{
					
					$this->db->set("poto",$file["name"]);
					
				}
				$var=$file;
			} 
				if ($level == "ADMIN" or $level=="KEUANGAN" or $level=="KEUANGAN SISWA" or $level=="KEUANGAN PEGAWAI") {
					$this->db->where("id_admin",$id);
					$this->db->update("admin",$data);		

				}
				else{
					$this->db->where("id",$idu);
					$this->db->update("data_pegawai",$data);		

				}
			
			 
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
					$level = $this->session->userdata("level");

					if ($level == "ADMIN") {
						$namapotoid=$this->m_reff->goField($tabel,"poto","where id_admin='".$id."'");

					}
					else{
						$namapotoid=$this->m_reff->goField($tabel,"poto","where id='".$id."'");

					}
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
		$return2=	$this->db->get("data_pegawai")->num_rows();
		
		$this->db->where("id!=",$id);
		$this->db->where("username",$user);
		$this->db->where("password",md5($pass));
		$return3=	$this->db->get("data_siswa")->num_rows();
		return ($return1+$return2+$return3);
	}
	
	 
}