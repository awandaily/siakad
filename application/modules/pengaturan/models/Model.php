<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	function save_jam()
	{
	    $field=$this->input->get_post("field");
	    $isi=$this->input->get_post("isi");
	    if(!$isi) {
	        $isi=null;
	    }
	    $id=$this->input->get_post("id");
	    $this->db->where("id",$id);
	    $this->db->set($field,$isi);
	   return  $this->db->update("tr_jam_ajar");
	}
	function save_($idp,$val,$tbl="tm_pengaturan")
	{
		$this->db->set("val",$val);
		$this->db->where("id",$idp);
	return $this->db->update($tbl);
	}
	function get_open($tbl)
	{
		$query=$this->_get_datatables_open($tbl);
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file($tbl)
	{				
		$query = $this->_get_datatables_open($tbl);
        return  $this->db->query($query)->num_rows();
	}
	
	private function _get_datatables_open($tbl)
	{
		$pilihan=$this->input->post("pilihan");
		$filter="";
		if($pilihan)
		{
			$filter.="AND id_persyaratan='".$pilihan."'";
		}
	$idu=$this->session->userdata("id");
	$query="select * from ".$tbl."  where  1='1'   $filter ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			 nama LIKE '%".$searchkey."%'  
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
		$query.=" order by id desc";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}	///-----------------------------------ajax//
	function setTahunAktif($id)
	{
			$this->db->query("update tr_tahun_ajaran set sts='0'");
		$this->db->where("id",$id);
		$this->db->set("sts","1");
	return	$this->db->update("tr_tahun_ajaran");
	}
	function setSmsAktif($id)
	{
			$this->db->query("update tr_semester set sts='0'");
		$this->db->where("id",$id);
		$this->db->set("sts","1");
	return	$this->db->update("tr_semester");
	}
	function idu()
	{
		return $this->session->userdata("id");
	}
	function save_kelulusan()
	{
		$before=$this->m_reff->pengaturan(11);
		$file=$this->m_reff->upload_file("logo","img","kop","PNG,JPG,png,jpeg,jpg","1000000",$before); 
		if($file["validasi"]!=false)
				{
						$files=$file["name"];
						$this->db->where("id",11);
			return		$this->db->update("pengaturan",array("val"=>$files));
				} 
		return false;		
	}
	function save_logo()
	{
		$before=$this->m_reff->tm_pengaturan(10);
		$file=$this->m_reff->upload_file("logo","img","logo","PNG,JPG,png,jpeg,jpg","1000000",$before); 
		if($file["validasi"]!=false)
				{
						$files=$file["name"];
						$this->db->where("id",10);
			return		$this->db->update("tm_pengaturan",array("val"=>$files));
				} 
		return false;		
	}
	function save_poto()
	{
		$before=$this->m_reff->tm_pengaturan(11);
		$file=$this->m_reff->upload_file("logo","img","logo","PNG,JPG,png,jpeg,jpg","1000000",$before); 
		if($file["validasi"]!=false)
				{
						$files=$file["name"];
						$this->db->where("id",11);
			return		$this->db->update("tm_pengaturan",array("val"=>$files));
				} 
		return false;		
	}function save_banner()
	{
		$before=$this->m_reff->tm_pengaturan(12);
		$file=$this->m_reff->upload_file("logo","img","logo","PNG,JPG,png,jpeg,jpg","1000000",$before); 
		if($file["validasi"]!=false)
				{
						$files=$file["name"];
						$this->db->where("id",12);
			return		$this->db->update("tm_pengaturan",array("val"=>$files));
				} 
		return false;		
	}
	function insert()
	{
		$post=$this->input->post("f");
		 if(isset( $_FILES["ttd_kepsek"]['name']))
		 {
				$file=$this->m_reff->upload_file("ttd_kepsek","dok","ttd","PNG,JPG","100000"); 
				if($file["validasi"]!=false)
				{
					$files=$file["name"];
					$this->db->set("ttd_kepsek",$files);
				} 
		 }
		 
		$this->db->set("_cid",$this->idu());
	return	$this->db->insert("tr_tahun_ajaran",$post);
	}	
	function update($tbl)
	{
		$post=$this->input->post("f");
		$this->db->set("_uid",$this->idu());
		$this->db->set("_utime",date('Y-m-d H:i:s'));
		$this->db->where("id",$this->input->post("id_"));
	return	$this->db->update($tbl,$post);
	}
	function update_thn($tbl)
	{
		$post=$this->input->post("f");
		$this->db->set("_uid",$this->idu());
		$this->db->set("_utime",date('Y-m-d H:i:s'));
		 if(isset( $_FILES["ttd_kepsek"]['name']))
		 {
				$file=$this->m_reff->upload_file("ttd_kepsek","dok","ttd","PNG,JPG","100000"); 
				if($file["validasi"]!=false)
				{
					$files=$file["name"];
					$this->db->set("ttd_kepsek",$files);
				} 
		 }
		
		$this->db->where("id",$this->input->post("id_"));
	return	$this->db->update($tbl,$post);
	}
}
 