<?php

class Model_peminjaman extends CI_Model  {
    
 
 
 	function __construct()
    {
        parent::__construct();
        $this->perpus = $this->load->database("perpus",TRUE);
    }

	public function idu()
	{
		return $this->session->userdata("id");
	}
	 
	/*===================================*/
	function getData()
	{
		$query=$this->_getData();
		if(isset($_POST['length'])?($_POST['length']):"" != -1)
		$query.=" limit ". $_POST['start'].",".$_POST['length'];
		return $this->perpus->query($query)->result();
	}
	function _getData()
	{
		 
		$filter="";
		
		$query="select * from data_pinjaman where  1=1 AND id_anggota = '".$this->idu()."'  ".$filter;
			if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				id_anggota LIKE '%".$searchkey."%' or 
				barcode LIKE '%".$searchkey."%'
				) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
	 if($this->input->get_post("urutan")=="baru")
	 {
		$query.=" order by sts ASC,id DESC";
	 }else{
	    $query.=" order by sts ASC,id ASC";
	 }
	 
	 
		return $query;
	}
	
	public function count()
	{				
		$query = $this->_getData();
        return  $this->perpus->query($query)->num_rows();
	}

	
	 
}