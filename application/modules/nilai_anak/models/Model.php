<?php

class Model extends CI_Model  {
    
	var $tbl="data_nilai";
 
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	
	 
	 function id_kelas() //untuk ortu
	{
		$data=$this->db->query("select id_kelas from data_siswa where id='".$this->idu()."' ")->row();
		return isset($data->id_kelas)?($data->id_kelas):"";
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
				 		  
		$id_mapel=$this->input->post("id_mapel");
		$semester=$this->input->post("semester");
		    
		$filter=" AND id_semester='".$semester."' ";
	 		
		if($id_mapel)
		{
			$filter.="AND id_mapel='".$id_mapel."' ";
		}
		 
		
		$id_siswa=$this->idu();
		 
		//$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from ".$this->tbl." where id_siswa=".$id_siswa." and id_tahun='".$tahun."'  $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nilai LIKE '%".$searchkey."%'  or
				nama_nilai LIKE '%".$searchkey."%'  
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
	function getNilaiColor($nilai,$kikd)
	{
		
		$min=$this->m_reff->goField("tm_kikd","kd3_kb","where id='".$kikd."'");
		if($min>$nilai)
		{
			return "<span class='col-red'>".$nilai."</span>";
		}else{
			return "<span class='col-indigo'>".$nilai."</span>";
		}
	}function getNilaiKiColor($nilai,$kikd)
	{
		
		$min=$this->m_reff->goField("tm_kikd","kd4_kb","where id='".$kikd."'");
		if($min>$nilai)
		{
			return "<span class='col-red'>".$nilai."</span>";
		}else{
			return "<span class='col-indigo'>".$nilai."</span>";
		}
	}
	 
}