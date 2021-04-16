<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	 
	 
	 
	  function dataProfile()
	 {
		$idu=$this->session->userdata("id");
		$this->db->where("id",$idu);
		return $this->db->get("tm_peserta")->row();
		 
	 }
	 
	 
	
	
	function update()
	{
	 $var=array();
	$var["size"]=""; 
	$var["file"]="";
	$var["password"]="";
	$var["validasi"]=false; 
	
	 
	 $id=$this->input->post("id");
	 $idu=$this->session->userdata("id");
	 
	 if(!$id) {		$id=$idu;	 }
	 
		$pro=$this->dataProfile();
		$data=$this->input->post("f");
		$data=$this->security->xss_clean($data);
		$tgl_lahir=$this->security->xss_clean($this->input->get_post("tgl_lahir"));
		$tgl_lahir=$this->tanggal->eng_($tgl_lahir,"-");
		$this->db->set("tgl_lahir",$tgl_lahir);
		 $var["validasi"]=true; 
		 $this->db->where("id",$id);
		 $this->db->update("tm_peserta",$data);		
		 return $var;
	}
	
	
	
	
	
	
	
	
	
	
	
	function upload_file($form,$dok,$idu,$idt,$idp)
	{		
		  
		$nama=date("YmdHis")."_".$idu."_";
		  $lokasi_file = $_FILES[$form]['tmp_name'];
		  $tipe_file   = $_FILES[$form]['type'];
		  $nama_file   = $_FILES[$form]['name'];
		   $size  	   = $_FILES[$form]['size'];
			$nama_file=str_replace(" ","_",$nama_file);
			// $jenis="jpg";
			$nama=$this->m_reff->goField("tm_upload","nama","where id='".$idt."'")."_".date("YmdHis")."".$nama_file;//str_replace("/","",$nama."_".$nama_file);
			$nama=str_replace(" ","_",$nama);
			 $target_path = "file_upload/".$dok."/".sprintf("%06s",$idu)."/".$nama;
			   
			if (!empty($lokasi_file)) {
			move_uploaded_file($lokasi_file,$target_path);
				 
					$namapotoid=$this->m_reff->goField("tm_data_upload","nama_file","where id_persyaratan='".$idp."' and id_upload='".$idt."' and id_admin='".$idu."' ");
					if(!$namapotoid){ $namapotoid=0;};
					$file_namapotoid="file_upload/".$dok."/".sprintf("%06s",$idu)."/".$namapotoid;
					if(file_exists($file_namapotoid))
					{
						unlink($file_namapotoid);
					}
			$data=$this->db->query("select * from tm_data_upload where id_admin='".$idu."' and id_persyaratan='".$idp."' and id_upload='".$idt."' ")->num_rows();	
			if($data)
			{
				$this->db->where("id_admin",$idu);
				$this->db->where("id_persyaratan",$idp);
				$this->db->where("id_upload",$idt);
				$this->db->set("nama_file",$nama);
				$this->db->set("tgl",date('Y-m-d H:i:s'));
			return	$this->db->update("tm_data_upload");
			}else{
				$this->db->set("id_admin",$idu);
				$this->db->set("id_persyaratan",$idp);
				$this->db->set("id_upload",$idt);
				$this->db->set("nama_file",$nama);
			return	$this->db->insert("tm_data_upload");
			}
			
			 }
			
		 
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
				$this->db->where("id_admin",$id);
				$this->db->insert("admin",$data);		
			
			 
		}
			return $var;
	
	}
	
	 
	
	
	 function cekPassword($id,$user,$pass)
	{
		 
	$this->db->where("id_admin!=",$id);
		$this->db->where("username",$user);
		$this->db->where("password",md5($pass));
	$return=	$this->db->get("admin")->num_rows();
		return ($return);
	}
	
	
	
	
	function get_open_sertifikat()
	{
		$query=$this->_get_datatables_open_sertifikat();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file_sertifikat()
	{				
		$query = $this->_get_datatables_open_sertifikat();
        return  $this->db->query($query)->num_rows();
	}
	private function _get_datatables_open_sertifikat()
	{
	 
	$query="select * from tm_sertifikat    WHERE id_admin='".$this->session->userdata("id")."'    ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			nama LIKE '%".$searchkey."%' or  
			ket LIKE '%".$searchkey."%'  
			) ";
		}

		$column = array('', 'nama','ket'  );
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
	
	}	///-----------------------------------ajax//
 
	
	
	
	function save_sertifikat()
	{	
		$var=array();
		$var["size"]=""; 
		$var["file"]="";
		$var["validasi"]=false; 
	
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
	//	$input=unset($input['file']);
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["file"]['tmp_name']))
		{
		    $dok=sprintf("%06s",$idu);
			$file=$this->upload_file_sert("file",$dok,$idu,"xxx");
			if($file["validasi"]!=false)
			{
				$this->db->set("file",$file["name"]);
				$this->db->set("id_admin",$idu);
				$this->db->set("tgl",date('Y-m-d'));
				$this->db->insert("tm_sertifikat",$data);
				return $file;
			}else{
			return $file;
			}
		}else{
				return $var;
		}
		
	}
	
	
	function upload_file_sert($form,$dok,$idu,$id=null,$tabel="tm_sertifikat")
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
			$nama="Sertifikat_".str_replace("/","",$nama_file);
			 $target_path = "file_upload/peserta/".$dok."/".$nama;
			 
			  $ex=substr($nama_file,-3);
			$extention=str_replace(" ","_",strtoupper($ex));
			
		 $maxsize = 1000000;
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
					$namapotoid=$this->m_reff->goField($tabel,"file","where id='".$id."'");
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
	
	function hapus_sertifikat($id)
	{	    $idu=$this->session->userdata("id");
	         $dok=sprintf("%06s",$idu);
			$file=$this->m_reff->goField("tm_sertifikat","file","where id='".$id."'");
			$this->hapus_gambar($dok,$file);
			$this->db->where("id",$id);
			$this->db->where("id_admin",$this->session->userdata("id"));
	return	$this->db->delete("tm_sertifikat");
		
	}
 
	
	function hapus_gambar($dok,$file)
	{
		$path="file_upload/peserta/".$dok."/".$file;
		if(file_exists($path))
		{
			unlink($path);
		}
	}
	 
}