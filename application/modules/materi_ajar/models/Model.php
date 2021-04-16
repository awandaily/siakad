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
	 
	 function get_materi()
	{
		$query=$this->_get_materi();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_materi()
	{
				 		  
		$id_mapel=$this->input->post("id_mapel");
		    
		$filter="";
		
		 
		if($id_mapel)
		{
			$db=$this->db->query("select id,id_mapel from v_materi where id_kelas='".$this->id_kelas()."' and id_mapel='".$id_mapel."' ")->result();
			$id_materi="";
			foreach($db as $db)
			{
				$id_materi.=$db->id_mapel.",";
			}
			$id_materi=substr($id_materi,0,-1);
	 
		}else{
			$db=$this->db->query("select * from v_materi where id_kelas='".$this->id_kelas()."' ")->result();
			$id_materi="";
			foreach($db as $db)
			{
				$id_materi.=$db->id_mapel.",";
			}
			$id_materi=substr($id_materi,0,-1);
			 
		}
		 
		if(!$id_materi){ $id_materi=0;}
		 
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from tm_bahan_ajar where id_mapel in(".$id_materi.")   ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				file LIKE '%".$searchkey."%'  or
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
		$query = $this->_get_materi();
        return  $this->db->query($query)->num_rows();
	}
	 function getMapel($idmateri)
	 {
		 $mapel=$this->m_reff->goField("v_materi","id_mapel","where id='".$idmateri."'");
		return $this->m_reff->goField("tr_mapel","nama","where id='".$mapel."'");
	 }
}