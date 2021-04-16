<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	 
	function t_peserta($minat=null,$idm=null,$jk=null)
	{
		if($minat!=null)
		{
			$this->db->where("posisi_peminatan",$minat);
		}	
		
		if($idm!=null)
		{
			 
			$this->db->where("madrasah_peminatan",$idm);
		}

		if($jk!=null)
		{
			 
			$this->db->where("jk",$jk);
		}			
		 
		return $this->db->get("tm_peserta")->num_rows();
	}
	 function t_peserta_jk($jk)
	{		
		$this->db->where("jk",$jk);
		return $this->db->get("tm_peserta")->num_rows();
	}
	 
}