<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	
	 function get_open()
	{
		$query=$this->_get_datatables_open();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file()
	{				
		$query = $this->_get_datatables_open();
        return  $this->db->query($query)->num_rows();
	}
	  function dataProfile()
	 {
		$idu=$this->session->userdata("id");
		$this->db->where("id_admin",$idu);
		return $this->db->get("admin")->row();
		 
	 }
	private function _get_datatables_open()
	{
	$idu=$this->session->userdata("id");
	$query="select * from admin  where  level='4' ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			owner LIKE '%".$searchkey."%' or  
			telp LIKE '%".$searchkey."%'  
			) ";
		}

		$column = array('', 'nama','telp'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by upd   DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}	///-----------------------------------ajax//
 
	 
	
	 function hapus_gambar($dok,$file)
	{
		$path="file_upload/".$dok."/".$file;
		if(file_exists($path))
		{
			unlink($path);
		}
	}
	
	function hapus($id)
	{	
		
		$this->db->where("id_admin",$id);
		$this->db->delete("admin");
		
		$file=$this->m_reff->goField("admin","poto","where id_admin='".$id."'");
		$this->hapus_gambar("dp",$file);
		
	  
		$this->db->where("id_admin",$id);
	return	$this->db->delete("tm_pengunjung");
		
	}
	
	function update_peserta()
	{	
		$var=array();
		$var["size"]=""; 
		$var["file"]="";
		$var["validasi"]=false; 
	
		$id=$this->input->post("id_admin");
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
	//	$input=unset($input['file']);
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["poto"]['tmp_name']))
		{
			 $file=$this->upload_file("poto","dp",$idu,$id,$tabel="admin");
			if($file["validasi"]!=false)
			{
				$this->db->set("poto",$file["name"]);
			 	$this->db->set("cuid",$idu);
				$this->db->set("upd",date("Y-m-d H:i:s"));
				$this->db->where("id",$id);
				$this->db->where("id_admin",$idu);
				$this->db->update("admin",$data);
				return $file;
			}else{
			return $file;
			}
		}else{
				$var["validasi"]="true"; 
				$this->db->set("cuid",$idu);
				$this->db->set("upd",date("Y-m-d H:i:s"));
				$this->db->where("id",$id);
				$this->db->where("id_admin",$idu);
				$this->db->update("admin",$data);
				return $var;
		}
		
	}
	function getData($id)
	{
	 
		$this->db->where("id_admin",$id);
	return	$this->db->get("admin")->row();
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
					$namapotoid=$this->m_reff->goField($tabel,"thumbnail","where id='".$id."'");
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
	
 

}
 