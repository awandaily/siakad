<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	
		private function cekCaptcha($cap)
	{
	   $site_key = '6LfB0FQUAAAAABBPln58TZq83wpYk66VHa4xNKL-';  
	  $secret_key = '6LfB0FQUAAAAAKacaSP7Fl-ruBCobH4S9EgsDMNU'; 
       if(isset($cap))
        {
            $api_url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response='.$cap;
            $response = @file_get_contents($api_url);
            $data = json_decode($response, true);

            if($data['success'])
            {
               
                return true;
            }
            else
            {
               return false;
            }
        }
        else
        {
            return false;
        }


	}
	 	function cekLogin()
	{	
	      $var["validasi"]=false;
	      $var["direct"]=false;
	      $var["captca"]=true;
	      $var["upass"]=true;
	  
		$cekcap=$this->cekCaptcha($this->input->post('g-recaptcha-response'));
		
		$this->db->where("username",$this->input->post('username'));
		$this->db->where("password",md5($pass=$this->input->post('password')));
		$login=$this->db->get("tm_peserta");
		
		$this->db->where("username",$this->input->post('username'));
		$this->db->where("password",md5($pass=$this->input->post('password')));
		$loginAdmin=$this->db->get("admin");
		
		if($login->num_rows()==1)
		{   $var["cek"]=true;
			$login=$login->row();
			if($cekcap==true){ 
			    $nama="peserta";
				$this->saveSession($login->id,"peserta",$pass);
				$this->updateLogin("tm_peserta",$login->id);
			    $var["validasi"]=true; 
			    $var["direct"]=$this->direct($nama);
			/*success*/  }
			else{  $var["captca"]=false; };
		
		}elseif($loginAdmin->num_rows()==1)
		{
			 $var["cek"]=true;
			$login=$loginAdmin->row();
			if($cekcap==true){ 
			    $level=$this->m_reff->goField("admin","level","where id_admin='".$login->id_admin."'");
			    $nama=$this->getDataLevel($level);
				
				$this->saveSessionAdmin($login->id_admin,$nama,$pass);
				$this->updateLoginAdmin("admin",$login->id_admin);
			    $var["validasi"]=true; 
			    $var["direct"]=$this->direct($nama);
			/*success*/  }
			else{  $var["captca"]=false; };
		}else
		{
	    	 $var["validasi"]=false; $var["upass"]=false;
		}
		$data=$var;
	return $data;	
	}
	function getDataLevel($id)//id_level
	{
	$this->db->where("id_level",$id);
	$data=$this->db->get("main_level")->row();
	return $data->nama;
	}
	
	
	function direct($nama)
	{
		$this->db->where("nama",$nama);
	   $return=$this->db->get("main_level")->row();
	   return ($return->direct)?($return->direct):"";
	}
	
	private function saveSessionAdmin($id,$level,$pass)
	{
	$array=array(
	"id"=>$id,
	"level"=>$level,
	"pass"=>$pass,
	);
	$this->session->set_userdata($array);
	$this->m_konfig->log("Login","Login",$id);
	return "1_success";
	}
	private function saveSession($id,$level,$pass)
	{
	$array=array(
	"id"=>$id,
	"level"=>$level,
	"pass"=>$pass,
	);
	$this->session->set_userdata($array);
	$this->m_konfig->logPeserta("Login","Login",$id);
	return "1_success";
	}
	function updateLogin($tbl,$id)
	{	
		$this->db->set("last_login",date("Y-m-d H:i:s"));
		$this->db->where("id",$id);
	return	$this->db->update($tbl);
	}
	function updateLoginAdmin($tbl,$id)
	{	
		$this->db->set("last_login",date("Y-m-d H:i:s"));
		$this->db->where("id_admin",$id);
	return	$this->db->update($tbl);
	}

}
 