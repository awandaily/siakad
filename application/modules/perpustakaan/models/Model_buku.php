<?php

class Model_buku extends CI_Model  {
    

 	function __construct()
    {
        parent::__construct();
        $this->perpus = $this->load->database("perpus",TRUE);
    }
	function idu()
	{
		return $this->session->userdata("id");
	}

	
	function get_data(){
		$query=$this->_get_data();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->perpus->query($query)->result();
	}
	function _get_data(){
		$filter="";

		if ($_POST["id_kategori"]!="") {
			$filter.=" AND id_kategori='".$_POST["id_kategori"]."' ";
		}


		if ($_POST["nama_buku"]!="") {
			$filter.=" AND ( 
					nama_buku LIKE '%".$_POST["nama_buku"]."%' OR 
					tag LIKE '%".$_POST["nama_buku"]."%' OR 
					sinopsis LIKE '%".$_POST["nama_buku"]."%'
			) ";
		}


		$query="select * from v_buku where 1=1 AND _del='0'  ".$filter;
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
						nama_buku LIKE '%".$searchkey."%'
					) ";
			}

		$column = array('', ''  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by nama_buku ASC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count(){				
		$query = $this->_get_data();
        return  $this->perpus->query($query)->num_rows();
	}
	function dipinjam($kd)
	{
	    $this->perpus->where("barcode",$kd);
	   return $this->perpus->get("data_pinjaman")->num_rows();
	}
	
}