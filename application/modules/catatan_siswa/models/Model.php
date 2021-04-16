<?php

class Model extends CI_Model  {
    
	var $tbl="tm_catatan_siswa";
 
 	function __construct()
    {
        parent::__construct();
    }
	public function idu()
	{
		return $this->session->userdata("id");
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
				 		  
		//$id_kelas=$this->input->post("id_kelas");
		//$id_jenis=$this->input->post("id_jenis");
		//$ke_bp=$this->input->post("ke_bp");
		$id_siswa=$this->input->post("id_siswa");
		  
		
		$id_siswa=$this->idu();
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from ".$this->tbl." where id_siswa=".$id_siswa." and id_tahun='".$tahun."' and id_semester='".$sms."'  ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				
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
	function insert_catatan(){	
		$kelas = $this->m_reff->goField("data_siswa","id_kelas","where id='".$this->session->userdata("id")."' ");

		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("id_semester",$sms);
		$this->db->set("id_siswa",$this->session->userdata("id"));
		$this->db->set("id_kelas", $kelas);
	 	$this->db->insert("tm_catatan_siswa",$post);
		
		return true;
		
	}
	function update_catatan()
	{
		$kelas = $this->m_reff->goField("data_siswa","id_kelas","where id='".$this->session->userdata("id")."' ");
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("id_semester",$sms);
		$this->db->set("id_siswa",$this->session->userdata("id"));
		$this->db->set("id_kelas", $kelas);
		$this->db->where("id",$this->input->post("id"));

	return	$this->db->update("tm_catatan_siswa",$post);
	}
	function hapus_catatan($id)
	{
		//$this->db->where("id_guru",$this->idu());
		$this->db->where("id",$id);
		return $this->db->delete("tm_catatan_siswa");
	}
}