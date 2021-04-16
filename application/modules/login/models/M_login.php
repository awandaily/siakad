<?php

class M_login extends CI_Model  {
    
		
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
	  
		$cekcap=true;//$this->cekCaptcha($this->input->post('captcha'));
		///if($cekcap==false){  $var["captca"]=false; return $var; };
			
			
	
		
		$this->db->where("username",$this->input->post('username'));
		$this->db->where("password",md5($pass3=$this->input->post('password')));
		$loginPegawai=$this->db->get("data_pegawai");
		
		
	
		
	////	$this->db->where("username",$this->input->post('username'));
		//$this->db->where("password",$pass3=$this->input->post('password'));
	//	$logineskul=$this->db->get("tr_ektrakurikuler");
	
	
	    if($loginPegawai->num_rows()==1)
		{
			 $var["cek"]=true;
			$login=$loginPegawai->row();
			   /*===================================================*/
						$cek_piket=$this->cek_guru_piket($login->id);
						if($cek_piket)
						{						
							$this->saveSession($login->id,"PIKET",$pass3,"data_pegawai");
							$this->updateLogin("data_pegawai",$login->id);
							$var["validasi"]=true; 
							$var["direct"]=$this->direct("PIKET");
							$this->absen_piket($login->id);
						}else{
				/*===================================================*/		 
			
								if($cekcap==true){ 
									$level=$this->m_reff->goField("data_pegawai","id_jabatan","where id='".$login->id."'");
									$namalevel=$nama=$this->getDataLevelJabatan($level);
									if($level==3){
										$namalevel=$nama="Guru";
									}elseif($level==1){
										$namalevel=$nama="KEPSEK";
									}elseif($level==11){
										$namalevel=$nama="TK"; //tenaga kependidikan
									}elseif($level==15){
										$nama="Pembina Ektrakurikuler"; //eskul
										$namalevel="ESKUL";
									}
										$multi=$login->multiakun;
										if(strpos($multi,"6")!==false)
										{
											$namalevel=$nama="Guru";
										}
									$this->saveSession($login->id,$nama,$pass3,"data_pegawai");
									$this->updateLogin("data_pegawai",$login->id);
									$var["validasi"]=true; 
									$var["direct"]=$this->direct($namalevel);
								/*success*/  }
								else{  $var["captca"]=false; };
						}
							$data=$var;
                         	return $data;	
		}
	
	
	
	
	
	
	
	
	
	
	$this->db->where("id_tahun_keluar",null);
		$this->db->where("username",$this->input->post('username'));
		$this->db->where("password",md5($pass1=$this->input->post('password')));
		$login=$this->db->get("data_siswa"); 
		if($login->num_rows()==1)
		{   $var["cek"]=true;
				$login=$login->row();
			    $nama="siswa";
				$this->saveSession($login->id,$nama,$pass1,"data_siswa");
				$this->updateLogin("data_siswa",$login->id);
			    $var["validasi"]=true; 
			    $var["direct"]=$this->direct($nama);
			    	$data=$var;
                     return $data;	
		
		}
		
		
		$this->db->where("username",$this->input->post('username'));
		$this->db->where("password",md5($pass2=$this->input->post('password')));
		$loginAdmin=$this->db->get("admin");
		
		if($loginAdmin->num_rows()==1)
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
		             $data=$var;
                     return $data;	
		}
		
		
	
		$this->db->where("username",$this->input->post('username'));
		$this->db->where("password",md5($pass3=$this->input->post('password')));
		$loginOrtu=$this->db->get("data_ortu");
	if($loginOrtu->num_rows()==1)
		{
			 $var["cek"]=true;
			$login=$loginOrtu->row();
			if($cekcap==true){ 
			   // $level="ORTU";
			    $nama="ortu";//$this->getDataLevelJabatan($level);
				
				$this->saveSession($login->id,$nama,$pass3,"data_ortu","Ibu ".$login->nama_ibu);
				$this->updateLogin("data_ortu",$login->id);
			    $var["validasi"]=true; 
			    $var["direct"]=$this->direct($nama);
			/*success*/  }
			else{  $var["captca"]=false; };
			
			         $data=$var;
                     return $data;	
		}
		/*elseif($logineskul->num_rows()==1)
		{
			 $var["cek"]=true;
			$login=$logineskul->row();
			if($cekcap==true){ 
			   // $level="ORTU";
			    $nama="eskul";//$this->getDataLevelJabatan($level);
				
				$this->saveSessionEskul($login->id,$nama,$pass3,"tr_ektrakurikuler",$login->kode);
				$this->updateLogin("tr_ektrakurikuler",$login->id);
			    $var["validasi"]=true; 
			    $var["direct"]=$this->direct($nama);
			/*success  }
			else{  $var["captca"]=false; };*/
		
		else
		{
	    	 $var["validasi"]=false; $var["upass"]=false;
		}
		$data=$var;
	return $data;	
	}
	
	function cek_guru_piket($id)
	{
		return $this->db->query("select * from tr_jadwal_piket where id_hari='".date('N')."' and id_guru='".$id."' ")->num_rows();
	}
	function absen_piket($id)
	{	 
	
	$datalibur=$this->db->query("select * from tm_jadwal_libur where start<='".date('Y-m-d')."' and end>='".date('Y-m-d')."' ")->row();
	$namaLibur=isset($datalibur->nama)?($datalibur->nama):"";
	if($namaLibur)
	{
		  return false;
	}


	
		$tahun=$this->m_reff->tahun();
		 $sms=$this->m_reff->semester();
		 $honor=$this->m_reff->goField("tm_pengaturan","val","where id='5'");
		 $idguru=$id;
		 $this->db->where("tgl",date("Y-m-d"));
		 $d=$this->db->get("tm_petugas_piket")->num_rows();
		if(!$d) {
				$this->db->set("id_tahun",$tahun);
				$this->db->set("id_semester",$sms);
				$this->db->set("tgl",date("Y-m-d"));
				$this->db->set("id_guru",$idguru);
				$this->db->set("honor",$honor);
			return	$this->db->insert("tm_petugas_piket");
			}
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
	$this->m_konfig->log("Login","Login");
	return "1_success";
	}
	private function saveSession($id,$level,$pass,$tbl,$nama=null)
	{
	$array=array(
	"id"=>$id,
	"level"=>strtoupper($level),
	"pass"=>$pass,
	);
	$this->session->set_userdata($array);
	$this->m_konfig->logMasuk($tbl,"Login",$id,$nama=null);
	return "1_success";
	}private function saveSessionEskul($id,$level,$pass,$tbl,$kode)
	{
	$array=array(
	"id"=>$kode, //id owner
	"level"=>strtoupper($level),
	"id_eskul"=>$id,
	"pass"=>$pass,
	);
	$this->session->set_userdata($array);
	$this->m_konfig->logMasuk($tbl,"Login",$id,$nama=null);
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
	
	
	
	
	
	
	
	
	
		 	function cekLoginOtomatis($deviceID)
	{	
	      $var["validasi"]=false;
	      $var["direct"]=false;
	      $var["captca"]=true;
	      $var["upass"]=true;
	  
		$cekcap=true;//$this->cekCaptcha($this->input->post('captcha')); 
		$this->db->where("device",$deviceID); 
		$loginPegawai=$this->db->get("data_pegawai"); 
	    if($loginPegawai->num_rows()==1)
		{
			 $var["cek"]=true;
			$login=$loginPegawai->row();
			   /*===================================================*/
						$cek_piket=$this->cek_guru_piket($login->id);
						if($cek_piket)
						{						
							$this->saveSession($login->id,"PIKET",$pass3,"data_pegawai");
							$this->updateLogin("data_pegawai",$login->id);
							$var["validasi"]=true; 
							$var["direct"]=$this->direct("PIKET");
							$this->absen_piket($login->id);
						}else{
				/*===================================================*/		 
			
								if($cekcap==true){ 
									$level=$this->m_reff->goField("data_pegawai","id_jabatan","where id='".$login->id."'");
									$namalevel=$nama=$this->getDataLevelJabatan($level);
									if($level==3){
										$namalevel=$nama="Guru";
									}elseif($level==1){
										$namalevel=$nama="KEPSEK";
									}elseif($level==11){
										$namalevel=$nama="TK"; //tenaga kependidikan
									}elseif($level==15){
										$nama="Pembina Ektrakurikuler"; //eskul
										$namalevel="ESKUL";
									}
										$multi=$login->multiakun;
										if(strpos($multi,"6")!==false)
										{
											$namalevel=$nama="Guru";
										}
									$this->saveSession($login->id,$nama,$pass3,"data_pegawai");
									$this->updateLogin("data_pegawai",$login->id);
									$var["validasi"]=true; 
									$var["direct"]=$this->direct($namalevel);
								/*success*/  }
								else{  $var["captca"]=false; };
						}
							$data=$var;
                         	return $data;	
		}
	
	
	 
	
	$this->db->where("id_tahun_keluar",null);
		$this->db->where("device",$deviceID); 
		$login=$this->db->get("data_siswa"); 
		if($login->num_rows()==1)
		{   $var["cek"]=true;
				$login=$login->row();
			    $nama="siswa";
				$this->saveSession($login->id,$nama,$pass1,"data_siswa");
				$this->updateLogin("data_siswa",$login->id);
			    $var["validasi"]=true; 
			    $var["direct"]=$this->direct($nama);
			    	$data=$var;
                     return $data;	
		
		}
		
		
		$this->db->where("device",$deviceID); 
		$loginAdmin=$this->db->get("admin");
		
		if($loginAdmin->num_rows()==1)
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
		             $data=$var;
                     return $data;	
		}
		
		
	
		$this->db->where("device",$deviceID); 
		$loginOrtu=$this->db->get("data_ortu");
	if($loginOrtu->num_rows()==1)
		{
			 $var["cek"]=true;
			$login=$loginOrtu->row();
			if($cekcap==true){ 
			   // $level="ORTU";
			    $nama="ortu";//$this->getDataLevelJabatan($level);
				
				$this->saveSession($login->id,$nama,$pass3,"data_ortu","Ibu ".$login->nama_ibu);
				$this->updateLogin("data_ortu",$login->id);
			    $var["validasi"]=true; 
			    $var["direct"]=$this->direct($nama);
			/*success*/  }
			else{  $var["captca"]=false; };
			
			         $data=$var;
                     return $data;	
		}
	 
		
		else
		{
	    	 $var["validasi"]=false; $var["upass"]=false;
		}
		$data=$var;
	return $data;	
	}

}
 