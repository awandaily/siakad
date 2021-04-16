<?php

class M_daftar extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	
		private function cekCaptcha($cap)
	{
	   /*$site_key = '6LfB0FQUAAAAABBPln58TZq83wpYk66VHa4xNKL-';  
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
        }*/
    $sesi=$this->session->userdata("captcha");   
    if($sesi==$cap)
    {
        return true;
    }else{
         return false;
    }


	}
	 	function cekLogin()
	{	
	      $var["validasi"]=false;
	      $var["direct"]=false;
	      $var["captca"]=true;
	      $var["upass"]=true;
	  
		$cekcap=$this->cekCaptcha($this->input->post('captcha'));
		
		$this->db->where("username",$this->input->post('username'));
		$this->db->where("password",md5($pass1=$this->input->post('password')));
		$login=$this->db->get("data_siswa");
		
		$this->db->where("username",$this->input->post('username'));
		$this->db->where("password",md5($pass2=$this->input->post('password')));
		$loginAdmin=$this->db->get("admin");
		
		$this->db->where("username",$this->input->post('username'));
		$this->db->where("password",md5($pass3=$this->input->post('password')));
		$loginPegawai=$this->db->get("data_pegawai");
		
		if($login->num_rows()==1)
		{   $var["cek"]=true;
			$login=$login->row();
			if($cekcap==true){ 
			    $nama="siswa";
				$this->saveSession($login->id,$nama,$pass1,"data_siswa");
				$this->updateLogin("data_siswa",$login->id);
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
				
				$this->saveSessionAdmin($login->id_admin,$nama,$pass2);
				$this->updateLoginAdmin("admin",$login->id_admin);
			    $var["validasi"]=true; 
			    $var["direct"]=$this->direct($nama);
			/*success*/  }
			else{  $var["captca"]=false; };
		}elseif($loginPegawai->num_rows()==1)
		{
			 $var["cek"]=true;
			$login=$loginPegawai->row();
			if($cekcap==true){ 
			    $level=$this->m_reff->goField("data_pegawai","id_jabatan","where id='".$login->id."'");
			    $nama=$this->getDataLevelJabatan($level);
				
				$this->saveSession($login->id,$nama,$pass3,"data_pegawai");
				$this->updateLogin("data_pegawai",$login->id);
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
	function getDataLevelJabatan($id)//id_level
	{
	$this->db->where("id",$id);
	$data=$this->db->get("tr_jabatan")->row();
	return $data->nama;
	}
	
	
	function direct($nama)
	{
		 $this->db->where("nama",$nama);
	   $return=$this->db->get("main_level")->row();
	return isset($return->direct)?($return->direct):"dashboard";
	}
	
	private function saveSessionAdmin($id,$level,$pass)
	{
	$array=array(
	"id"=>$id,
	"level"=>strtoupper($level),
	"pass"=>$pass,
	);
	$this->session->set_userdata($array);
	$this->m_konfig->log("Login","Login",$id);
	return "1_success";
	}
	private function saveSession($id,$level,$pass,$tbl)
	{
	$array=array(
	"id"=>$id,
	"level"=>strtoupper($level),
	"pass"=>$pass,
	);
	$this->session->set_userdata($array);
	$this->m_konfig->logMasuk($tbl,"Login",$id);
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
	
	 
	
	
	function add()
	{
	
		$nama=trim($this->input->post('nama'));
		$tempat_tugas=trim($this->input->post('tempat_tugas'));
		$email=trim($this->input->post('email'));
		$hp=trim($this->input->post('hp'));
		$username=trim($this->input->post('username'));
		$password=trim($this->input->post('password'));
		$tempat_lahir=trim($this->input->post('tempat_lahir'));
		$tgl_lahir=trim($this->input->post('tgl_lahir'));
		$jk=trim($this->input->post('jk'));
		$madrasah_peminatan=trim($this->input->post('madrasah_peminatan'));
		$posisi_peminatan=trim($this->input->post('posisi_peminatan'));
		
			//$array1=explode("/",$tgl_lahir);
			//$tanggal=$array1[2]."-".$array1[1]."-".$array1[0]; 
			//$tgllahir=$tanggal;

	    	$cek=$this->db->query("SELECT * FROM tm_peserta where username='".$username."' or email='".$email."' ")->num_rows();
			$cek2=$this->db->query("SELECT * FROM admin where username='".$username."' or email='".$email."'")->num_rows();
			
			$cek_email1=$this->db->query("SELECT * FROM tm_peserta where email='".$email."'")->num_rows();
			$cek_email2=$this->db->query("SELECT * FROM admin where email='".$email."'")->num_rows();
			
			$cek_hp1=$this->db->query("SELECT * FROM tm_peserta where hp='".$hp."'")->num_rows();
			$cek_hp2=$this->db->query("SELECT * FROM admin where telp='".$hp."'")->num_rows();
			
			
        if(($cek_email1+$cek_email2)>0)
        {
            return "email";
        }elseif(($cek_hp1+$cek_hp2)>0)
        {
              return "hp";
        }elseif(($cek+$cek2)<1){
			$data=array(
			"nama"=>$nama,
			"tempat_tugas"=>$tempat_tugas,
			"email"=>$email,
			"hp"=>$hp,
			"username"=>$username,
			"password"=>md5($password),
			"alias"=>"li".$password."la",
			"tempat_lahir"=>$tempat_lahir,
			"tgl_lahir"=>$this->tanggal->eng_($tgl_lahir,"-"),
			"jk"=>$jk,
			"madrasah_peminatan"=>$madrasah_peminatan,
			"posisi_peminatan"=>$posisi_peminatan,
			"tgl"=>date('Y-m-d h:i:sa'),
			);
		  
			 $this->db->insert("tm_peserta",$data);
			 $idx=$this->db->query("SELECT MAX(id) as id from tm_peserta")->row();
			 $reg=sprintf("%06s", $idx->id);
			 if (!file_exists('file_upload/peserta/'.$reg)) {
			     	mkdir('file_upload/peserta/'.$reg, 0777, true);
			 }
		
		
		    $this->db->query('update tm_peserta set reg="'.$reg.'" where id="'.$idx->id.'"');
		
			return true;
		}else{
			return "upas";
		}
		
	}

}
 