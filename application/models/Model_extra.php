<?php

class Model_extra extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	
	 
	
	function upload_file_image($form,$dok,$idu)
	{		
	$var=array();
	$var["size"]=true;
	$var["file"]=true;
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
			$var["size"]=false; 
		 }elseif($extention!="JPG" AND $extention!="PNG" AND $extention!="GIF" ){
			$var["file"]=false;
		 }else{
			  $this->hapus_poto("admin","poto","id_admin='".$idu."'","dp");
		 	$var["validasi"]=true;
			if (!empty($lokasi_file)) {
			move_uploaded_file($lokasi_file,$target_path);
			 }
			$var["name"]=$nama;
		 }
		 return $var;
	}
	
	
	function goField($tbl,$field,$where)
	{
		$return=$this->db->query("select $field from $tbl where $where ")->row();
		return isset($return->$field)?($return->$field):"";
	}
	
	function hapus_poto($tbl,$field,$where,$dok)
	{
		$file="file_upload/".$dok."/".$this->goField($tbl,$field,$where);
		if (file_exists($file)) {
			unlink($file);
		} 
		return true;
	}
	
	
	

}