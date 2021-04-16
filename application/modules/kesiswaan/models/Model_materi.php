<?php

class Model_materi extends CI_Model  {
    
	var $tbl="data_materi";
	var $tbl_jadwal="tm_jadwal_mengajar";
	var $tbl_log="data_pegawai";
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	
	/*===================================*/
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
		if($id_mapel)
		{
			$filter.="AND id_mapel='".$id_mapel."' ";
		} 
		if($id_kelas)
		{
			$filter.="AND id_kelas='".$id_kelas."' ";
		} 
		
		 
		$query="select * from ".$this->tbl." where id_guru='".$this->idu()."'  $filter ";
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
	 
	function kirimMateri()
	{	
		$var=array();
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		 
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["file"]['tmp_name']))
		{
			$file=$this->m_reff->upload_file("file","dok",$idu,"xlsx,docx,pptx,dpf","10000000");
			if($file["validasi"]!=false)
			{
				$this->db->set("id_guru",$idu);
			 	$this->db->set("_cid",$idu);
			 	$this->db->set("file",$file["name"]);
				$this->db->insert($this->tbl,$data);
				$this->m_konfig->log($this->tbl,"Input data materi",$this->tbl_log);///insert log
				//$this->session->unset_userdata("token");
				return $file;
			}else{
			return $file;
			}
		}else{
				return $var;
		}
		
	}
	
	
	function editKirimMateri()
	{	
		$var=array();
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		 
		$id=$this->input->post("id");
		$idu=$this->session->userdata("id");
		$nama_file=$this->m_reff->goField($this->tbl,"file","where id_guru='".$idu."' and id='".$id."' ");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["file"]['tmp_name']))
		{
			$file=$this->m_reff->upload_file("file","dok",$idu,"xlsx,docx,pptx,dpf","10000000");
			if($file["validasi"]!=false)
			{
				$this->m_reff->hapus_file("file_upload/dok/".$nama_file."");
				$this->db->where("id",$id);
				$this->db->where("id_guru",$idu);
			 	$this->db->set("_uid",$idu);
			 	$this->db->set("_utime",date("Y-m-d H:i:s"));
			 	$this->db->set("file",$file["name"]);
				$this->db->update($this->tbl,$data);
				$this->m_konfig->log($this->tbl,"Input data materi",$this->tbl_log);///update log
				//$this->session->unset_userdata("token");
				return $file;
			}else{
				return $file;
			}
		}else{ //jika tidak upload file
			
			 	$this->db->set("_uid",$idu);
			 	$this->db->set("_utime",date("Y-m-d H:i:s"));
				$this->db->where("id",$id);
				$this->db->where("id_guru",$idu);
				$this->db->update($this->tbl,$data);
				$this->m_konfig->log($this->tbl,"Edit data materi",$this->tbl_log);///update log
				 
		}
		
		 return $var;
	}
	function hapus_materi()
	{			
				$id=$this->input->post("id");
				$idu=$this->session->userdata("id");
				
				$nama_file=$this->m_reff->goField($this->tbl,"file","where id_guru='".$idu."' and id='".$id."' ");
				$this->m_reff->hapus_file("file_upload/dok/".$nama_file."");
			
				$this->db->where("id",$id);
				$this->db->where("id_guru",$idu);
				
				$this->db->delete($this->tbl);
		return	$this->m_konfig->log($this->tbl,"Hapus data materi",$this->tbl_log);///update log
	}
	 
}