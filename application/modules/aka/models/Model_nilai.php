<?php

class Model_nilai extends CI_Model  {
    
	var $tbl="data_nilai";
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
		$id_tahun=$this->input->post("id_tahun");
		$id_mapel=$this->input->post("id_mapel");
		$semester=$this->input->post("semester");
		$k_nilai=$this->input->post("k_nilai");
		 
		$filter="";
		if($id_mapel)
		{
			$filter.="AND id_mapel='".$id_mapel."' ";
		} 
		if($id_tahun)
		{
			$filter.="AND id_tahun='".$id_tahun."' ";
		} 
		if($semester)
		{
			$filter.="AND id_semester='".$semester."' ";
		} if($k_nilai)
		{
			$filter.="AND id_kategory_nilai='".$k_nilai."' ";
		} 
		
		 
		$query="SELECT * FROM ".$this->tbl." where nis='".$this->mdl->profile()->nis."' $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama_nilai LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
	//	$query.=" GROUP BY nama_nilai,id_kelas,id_mapel,id_semester ";
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
	  
	function getNilaiSiswa($attr,$nis)
	{
		$this->db->where($attr);
		$this->db->where("nis",$nis);
		$data=$this->db->get($this->tbl)->row();
		return isset($data->nilai)?($data->nilai):"";
	}
	 
}