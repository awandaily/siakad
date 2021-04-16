<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	 
	function jmlSimpanan($id=null)
	{
		if($id!=null){
		$this->db->where("kategory",$id);
		}
		$this->db->select("SUM(nominal) as nominal");
		$return=$this->db->get("keu_simpanan")->row();
		$return=isset($return->nominal)?($return->nominal):"0";
		
			if($id!=null){
		$this->db->where("kategory",$id);
		}
		$this->db->select("SUM(nominal) as nominal");
		$data=$this->db->get("keu_tarik_tabungan")->row();
			$return1=isset($data->nominal)?($data->nominal):"0";
			
		return $return-$return1;
			
	}function jmlPinjaman()
	{
		 
		 $data=$this->db->query("select sum(jumlah_pinjaman) as jml from keu_pinjaman")->row();
			$return1=isset($data->jml)?($data->jml):"0";
			
		$data=$this->db->query("select sum(nominal) as jml from keu_bayar_pinjaman")->row();
			$return2=isset($data->jml)?($data->jml):"0";
			return $return1-$return2;
		
	}
}