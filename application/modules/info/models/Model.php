<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	function jmlArtikel($sts=null)
	{
		$idu=$this->session->userdata("id");
		if($sts!=null)
		{
		$this->db->where("sts",$sts);
		}
		$this->db->where("id_admin",$idu);
		return $this->db->get("tm_artikel")->num_rows();
	}
	function artikel_lomba()
	{
		$idu=$this->session->userdata("id");
		$this->db->where("sts",3);
		$this->db->where("id_admin",$idu);
		$this->db->where("dilombakan",1);
		$data= $this->db->get("tm_artikel")->row();
		if(isset($data->judul)){
			return "<a href='#' style='color:yellow'>".$data->judul."</i> </a>";
		}else{
			return "Belum ada artikel yang dilombakan";
		}
	}
}