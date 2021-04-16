<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	 
	 
	 
	  function dataProfile()
	 {
		$idu=$this->session->userdata("id");
		$this->db->where("id",$idu);
		return $this->db->get("tm_peserta")->row();
		 
	 }
	 
	 
	 
}