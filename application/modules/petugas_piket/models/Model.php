<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	 function set()
	 {	
				$idguru=$this->input->post("id_guru");
				$hari=$this->input->post("hari");
		  
				$this->db->where("id_hari",$hari);
				$this->db->set("id_guru",$idguru);
			return	$this->db->update("tr_jadwal_piket");
			 
	 }


	function setxxx()
	 {	 $idguru=$this->input->post("id_guru");
		 $this->db->where("tgl",date("Y-m-d"));
		 $d=$this->db->get("tm_petugas_piket")->row();
		if($d){
				$this->db->where("tgl",date("Y-m-d"));
				$this->db->set("id_guru",$idguru);
			return	$this->db->update("tm_petugas_piket");
			}else{
				$this->db->set("tgl",date("Y-m-d"));
				$this->db->set("id_guru",$idguru);
			return	$this->db->insert("tm_petugas_piket");
			}
	 }
}