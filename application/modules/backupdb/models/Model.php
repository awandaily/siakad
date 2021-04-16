<?php

class Model extends CI_Model  {
    
 
 
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	
    public function tampiltabel()
    {
       return $this->db->query("show tables")->result();
    }
	 
	 
	 
	 
}