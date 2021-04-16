<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_reff extends ci_Model
{
	
	public function __construct() {
        parent::__construct();
    }
	function mobile()
	{
						$useragent=$_SERVER['HTTP_USER_AGENT'];
                       if(preg_match('/(android|bb\d+|meego).+mobile|Android|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
						{ return true;}else{ return false; }
                   
	}
	function id_siswa_ortu() //untuk ortu
	{
		$data=$this->db->query("select id_siswa from data_ortu where id='".$this->session->userdata("id")."' ")->row();
		return isset($data->id_siswa)?($data->id_siswa):"";
	}	
	function nama_siswa() //untuk ortu
	{
		$data=$this->db->query("select * from data_siswa  where id='".$this->id_siswa_ortu()."' ")->row();
		return isset($data->nama)?($data->nama):"";
	}	
	function nama_kelas() //untuk ortu
	{
		$data=$this->db->query("select * from v_kelas  where id='".$this->id_kelas()."' ")->row();
		return isset($data->nama)?($data->nama):"";
	}	
	function jam_aktif()
	{
		    $n=date("N");
		  if($n==1){ $sts=1; }else{	$sts=0;}
		   
		  $data=$this->db->query("select urut from tr_jam_ajar where sts='".$sts."' AND 
		  '".date("H:i:s")."'<=jam_akhir order by jam_akhir asc limit 1 ")->row();
		  return isset($data->urut)?($data->urut):"";
 
	}
	
	function idu()
	{
		return $this->session->userdata("id");
	}
	
	function poto_akun()
	{
		$jk=$this->goField("data_pegawai","jk","where id='".$this->idu()."'");
		if($jk=="l")
		{
			return base_url()."plug/img/l.png";
		}else{
			return base_url()."plug/img/p.png";
		}
	}
	function poto_siswa($id)
	{
		$data=$this->db->get_where("data_siswa",array("id"=>$id))->row();
		if($data)
		{			$tahun_masuk=$this->goField("tr_tahun_ajaran","nama","where id='".$data->id_tahun_masuk."' ");
					$filename="file_upload/siswa/".str_replace("/","_",$tahun_masuk)."/".$id."/".$data->poto;
					if ($data->poto) {
						if(file_exists($filename)){
						return base_url().$filename;
						}else{
							if($data->jk=="l")
						{
							return base_url()."plug/img/cowok.png";
						}else{
							return base_url()."plug/img/cewek.png";
						}
							
						}
					}else{
						if($data->jk=="l")
						{
							return base_url()."plug/img/cowok.png";
						}else{
							return base_url()."plug/img/cewek.png";
						}
					}						
					
		}else{
			return base_url()."plug/img/logo.png";
		}
	}
	function nama_guru($id)
	{
		$data=$this->db->get_where("data_pegawai",array("id"=>$id))->row();
		return $data->gelar_depan." ".$data->nama." ".$data->gelar_belakang;
	}
	function nama_wali_kelas($id_siswa)
	{
		$id_kelas=$this->m_reff->goField("data_siswa","id_kelas","where id='".$id_siswa."' ");
		$id_wali=$this->m_reff->goField("tm_kelas","id_wali","where id='".$id_kelas."' ");
		return $this->nama_guru($id_wali);
	}
    function dataProfilePegawai()
	{
		return $this->db->query("select * from data_pegawai where id='".$this->idu()."'")->row();
	}
	function dataProfileSiswa()
	{
		return $this->db->get_where("data_siswa",array("id"=>$this->idu()))->row();
	}
	function dataProfileOrtu()
	{
		return $this->db->get_where("data_ortu",array("id"=>$this->idu()))->row();
	}
	function dataProfileAdmin()
	{
		return $this->db->get_where("admin",array("id_admin"=>$this->idu()))->row();
	}
	
	function goField($tbl,$select,$where=null)
	{
	    $data=$this->db->query("SELECT $select from $tbl $where ")->row();
		return isset($data->$select)?($data->$select):"";
	}
	
	function goResult($tbl,$select,$where=null)
	{
	   return $data=$this->db->query("SELECT $select from $tbl $where ");  
	}
	 function jk($id)
	 {
	     if($id=="l")
	     {
	         return "Laki-laki";
	     }elseif($id=="p")
	     {
	         return "Perempuan";
	     }
	 }
	 
	function tgl_pergantian()
	{
		$data=$this->db->query("select * from tr_tahun_ajaran where sts=1")->row();
		return isset($data->tgl_pindah)?($data->tgl_pindah):"";
	}	
	function id_siswa() //untuk ortu
	{
		$data=$this->db->query("select id_siswa from data_ortu where id='".$this->session->userdata("id")."' ")->row();
		return isset($data->id_siswa)?($data->id_siswa):"";
	}	
	function id_kelas() //untuk ortu
	{
		$data=$this->db->query("select id_kelas from data_siswa where id='".$this->id_siswa()."' ")->row();
		return isset($data->id_kelas)?($data->id_kelas):"";
	}		
	function kelas_wali()
	{
		$this->db->where("id_wali",$this->idu());
		$data=$this->db->get("tm_kelas")->row();
		return isset($data->id)?($data->id):"";
	}
	
	 function tahun_ajaran($id=null)
	{
		if($id)
		{
			$data=$this->db->query("select * from tr_tahun_ajaran where id='".$id."'")->row();
		}else{
		$data=$this->db->query("select * from tr_tahun_ajaran where sts=1")->row();
		}
		return isset($data->nama)?($data->nama):"";
	}	
	function nama_tahun()
	{
		return $this->tahun_ajaran();
	}
	function tahun() //id tahun
	{
		$sesion=$this->session->userdata("tahun_id");
		if($sesion){
			$data=$this->db->query("select * from tr_tahun_ajaran where id='".$sesion."' ")->row();
			return isset($data->id)?($data->id):"";
		}
		
		$data=$this->db->query("select * from tr_tahun_ajaran where sts=1")->row();
		return isset($data->id)?($data->id):"";
	}		
	function tahun_asli() //id tahun
	{
		 
		
		$data=$this->db->query("select * from tr_tahun_ajaran where sts=1")->row();
		return isset($data->id)?($data->id):"";
	}		
	 
	function zipz($nama_file,$dir,$file)
	{
             $error=true;
            /* nama zipfile yang akan dibuat */
            $zipname = $nama_file.".zip";
            /* proses membuat zip file */
            $zip = new ZipArchive;
            $zip->open($zipname, ZipArchive::CREATE);
             
          //  foreach ($file as $value) {
            $zip->addFile($dir.$file,$file);
        //    }
             $zip->close();
            /* preses pembuatan zip file selesai disini */
             
            /* download file jika eksis*/
            if(file_exists($zipname)){
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; 
            filename="'.$zipname.'"');
            header('Content-Length: ' . filesize($zipname));
            readfile($zipname);
            unlink($zipname);
             
            } else{
            $error = "Proses mengkompresi file gagal  ";
            } //end of if file_exist
            
            return $error;
            
    }
    
    function zip($zip_file,$dir,$data)
    {
            
            
            // Get real path for our folder
            $rootPath = realpath($dir);
            
            // Initialize archive object
            $zip = new ZipArchive();
            $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
            
            // Create recursive directory iterator
            /** @var SplFileInfo[] $files */
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($rootPath),
                RecursiveIteratorIterator::LEAVES_ONLY
            );
            
            foreach ($files as $name => $file)
            {
                // Skip directories (they would be added automatically)
                if (!$file->isDir())
                {
                    // Get real and relative path for current file
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($rootPath) + 1);
            
                    // Add current file to archive
                   $polder=substr($relativePath,0,6);
                   if (in_array($polder, $data)) {
                       $zip->addFile($filePath, $relativePath);
                    }  
                   
                   
                   
                }
            }
            
            // Zip archive will be created only after closing object
            $zip->close();
            
            
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($zip_file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($zip_file));
            readfile($zip_file);

            
    }
 
	function setToken()
	{
	$code=substr(str_shuffle("123aYbCdEfGhIj0K0opqrStUvwXyZ4567809"),0,25); $this->session->set_userdata("token",$code); 
	echo '<input type="hidden" name="token" value="'.$this->session->userdata("token").'">';
	}
	function cekToken()
	{
		$token_post=$this->input->post("token");
		$token_server=$this->session->userdata("token");
	
		if($token_post==$token_server)
		{
		return true;
		}else{
		return false;
		}
		
	}
	function dp()
	{
		$id=$this->session->userdata("id");
		$return=$this->db->get_where("admin",array("id_admin"=>$id))->row();
		$return=isset($return->poto)?($return->poto):"";
		if(!file_exists("file_upload/dp/".$return)) {
			$id=$this->session->userdata("id");
			$return=$this->db->get_where("data_pegawai",array("id"=>$id))->row();
			return isset($return->poto)?($return->poto):"";
		}else{
			return $return;
		}
		
	}
	function hapus_file($nama_file) //full path
	{
		$filename = $nama_file;

		if (file_exists($filename)) {
			unlink($nama_file);
		}  
		return true;
	}
	function upload_file($form,$dok,$nama_file_awal="file",$type_file_yg_diizinkan="JPG,JPEG,PNG",$sizeFile="3000000",$before_file=null)
	{		
	$var=array();
	$var["size"]=true; 
	$var["file"]=true;
	$var["validasi"]=false; 
		$nama_file_awal=preg_replace('/[^A-Za-z0-9\ ]/', "",$nama_file_awal);
		$nama_file_awal=str_replace(' ', "-",$nama_file_awal);
		$nama=$nama_file_awal."___".date("His");
		  $lokasi_file = $_FILES[$form]['tmp_name'];
		  $tipe_file   = $_FILES[$form]['type'];
		  $nama_file   = $_FILES[$form]['name'];
		   $size  	   = $_FILES[$form]['size'];
			 
			 $type_file_yg_diupload =substr(strrchr($nama_file, '.'), 1);
			 $nama=$nama.".".$type_file_yg_diupload;
			 $target_path = "file_upload/".$dok."/".$nama;
			 
		  $extention=$type_file_yg_diupload;
		  $var["maxsize"]=substr($sizeFile,0,-6); 
		  
		 $pos = strpos(strtoupper($type_file_yg_diizinkan), strtoupper($extention));
		 if ($pos === false) {
			$file_extention=false;
		} else {
			$file_extention=true;
		}
		 
		 
		 $maxsize =$sizeFile;
		 if($size>=$maxsize)
		 {
			$var["size"]=false; 
		 }elseif($file_extention==false){
			$var["file"]=false; $var["type_file"]=$type_file_yg_diizinkan;
		 }else{
			if($before_file!=null)
			{
				$filename="file_upload/".$dok."/".$before_file;
				if (file_exists($filename)) {
					unlink($filename);
				} 
			}				
			 
			 
			 
		 	$var["validasi"]=true;
			if (!empty($lokasi_file)) {
			move_uploaded_file($lokasi_file,$target_path);
			 }
			$var["name"]=$nama;
		 }
		 return $var;
	}
	function getDataSiswa($id_kelas)
	{
		return $this->db->get_where("data_siswa",array("id_kelas"=>$id_kelas))->result();
	}
	function semester()
	{
		$sesion=$this->session->userdata("sms_id");
		if($sesion){
			$data=$this->db->query("select * from tr_semester where id='".$sesion."' ")->row();
			return isset($data->id)?($data->id):"";
		}
		
		$data=$this->db->query("select * from tr_semester where sts=1")->row();
		return isset($data->id)?($data->id):"";
	}function semester_asli()
	{
		 
		$data=$this->db->query("select * from tr_semester where sts=1")->row();
		return isset($data->id)?($data->id):"";
	}
	function namaKelas($id_kelas)
	{
		$data=$this->db->get_where("v_kelas",array("id"=>$id_kelas))->row();
		return isset($data->nama)?($data->nama):"";
	}function namaMapel($id_mapel)
	{
		$data=$this->db->get_where("tr_mapel",array("id"=>$id_mapel))->row();
		return isset($data->nama)?($data->nama):"";
	}
	function namaSemester($id)
	{
		$data=$this->db->get_where("tr_semester",array("id"=>$id))->row();
		return isset($data->nama)?($data->nama):"";
	}
	function alias_semester($id)
	{
		$data=$this->db->get_where("tr_semester",array("id"=>$id))->row();
		return isset($data->alias)?($data->alias):"";
	}
	function tahunAktif()
	{
		$data=$this->db->get_where("tr_tahun_ajaran",array("sts"=>1))->row();
		return isset($data->id)?($data->id):"";
	}
	function hp($no)
	{
						$hp=str_replace("'","",$no); //hp
						$hp=str_replace("`","",$hp);
			return		str_replace("+62","0",$hp);
	}
	function hapussemua($src){ //nama folder
				$dir = opendir($src);
				while(false !== ( $file = readdir($dir)) ) {
				if (( $file != '.' ) && ( $file != '..' )) {
				$full = $src . '/' . $file;
				if ( is_dir($full) ) {
				hapussemua($full);
				}
				else {
				unlink($full);
				}
				}
				}
				closedir($dir);
				rmdir($src);
	}
	function pengaturan($id)
	{
		$return=$this->db->get_where("pengaturan",array("id"=>$id))->row();
		return $return->val;
	}function tm_pengaturan($id)
	{
		$return=$this->db->get_where("tm_pengaturan",array("id"=>$id))->row();
		return $return->val;
	}
	
	 function deleteElement($element,  &$array){
		$index = array_search($element, $array);
		if($index !== false){
			unset($array[$index]);
		}
	}
	
	public function jamValid($jam_aktif,$jam_blok)
	{
		//phpinfo();
		$a=$jam_aktif;
		$a=str_replace(",,",",",$jam_aktif);
		$h=$jam_blok;
		$h=str_replace(",,",",",$jam_blok);
		
		if($a==","){ return false;}
	 
		  $na=SUBSTR($a,-1);
		  $nna=SUBSTR($a,0,1);
		
		if($na==","){
			$a=substr($a,0,-1);
		}
		if($nna==","){
			  $a=substr($a,1);
		}
		
		$array_a=explode(",",$a);
		$array_a = array_unique($array_a); //hapus isi array yg sama
		
		$array_b=explode(",",$h);
		$array_b = array_unique($array_b); //hapus isi array yg sama
		
		
		foreach($array_b as $e){
		$this->deleteElement($e,$array_a);
		}
		
		return count($array_a);
		 
	}
	
	public function jamBlok($jam_blok)
	{
		
	 
		$h=$jam_blok;
		$h=str_replace(",,",",",$jam_blok);
	 
		if(!$h){
		return 0;
		}
		
	 
	 
		  $na=SUBSTR($h,-1);
		  $nna=SUBSTR($h,0,1);
		
		if($na==","){
			$h=substr($h,0,-1);
		}
		if($nna==","){
			  $h=substr($h,1);
		}
		 
		$array_b=explode(",",$h);
		$array_b = array_unique($array_b); //hapus isi array yg sama
		
		
		return count($array_b);
		 
	}
	public function filter_array($jam_blok)//hapus isi array yg sama
	{
		
	 
		$h=$jam_blok;
		$h=str_replace(",,",",",$jam_blok);
	 
		if(!$h){
		return 0;
		}
		
	 
	 
		  $na=SUBSTR($h,-1);
		  $nna=SUBSTR($h,0,1);
		
		if($na==","){
			$h=substr($h,0,-1);
		}
		if($nna==","){
			  $h=substr($h,1);
		}
		 
		$array_b=explode(",",$h);
		return array_unique($array_b); //hapus isi array yg sama
		 
	}
	
	function data_id_kelas($tk)
	{
		if($tk)
		{
			$this->db->where("id_tk",$tk);
		}
		$return=$this->db->get("tm_kelas")->result();
		$isi="";
		foreach($return as $val)
		{
			$isi.=$val->id.",";
		}
		return substr($isi,0,-1);
	
	}
	function data_nis_siswa($tk)
	{
		$data=$this->m_reff->data_id_kelas($tk);
		$return=$this->db->query("select nis from data_siswa where id_kelas in (".$data.") and aktifasi like '%1%' ")->result();
		$isi="";
		foreach($return as $val)
		{
			$isi.="'".$val->nis."',";
		}
		return substr($isi,0,-1);
	}
	function data_noid()
	{
		$return=$this->db->query("select noid from tm_log_kehadiran where SUBSTR(tgl,1,10)='".date('Y-m-d')."' ")->result();
		$isi="";
		foreach($return as $val)
		{
			$isi.="'".$val->noid."',";
		}
		return substr($isi,0,-1);
	}
	function persentase($perolehan,$total=0)
	{
		if($total==0){ return 0;}
	return	number_format(($perolehan/$total*100),2,",",".");
	}
	function counter()
	{
			$browser = $_SERVER['HTTP_USER_AGENT'];
			$chrome = '/Chrome/';
			$firefox = '/Firefox/';
			$ie = '/IE/';
			if (preg_match($chrome, $browser))
				$data = "Chrome/Opera";
			if (preg_match($firefox, $browser))
				$data = "Firefox";
			if (preg_match($ie, $browser))
				$data = "IE";

			// untuk mengambil informasi dari pengunjung
			$ipaddress =  $_SERVER['REMOTE_ADDR'];
			$browser = $data;
			$tanggal = date('Y-m-d');
			$kunjungan = 1;
			// Daftarkan Kedalam Session Lalu Simpan Ke Database
			if (!$this->session->userdata('counterdb')){
				 $this->session->set_userdata("counterdb",$ipaddress);
			return $this->db->query("INSERT INTO counterdb (tanggal,ip,counter,browser) VALUES ('".$tanggal."','".$ipaddress."','".$kunjungan."','".$browser."')");
			} 
			  
	}
	function honor($id) //honor pegawai
	{
		$gt=$this->db->query("select sts_kepegawaian,sertifikasi from data_pegawai where id='".$id."' ")->row();
		$jenisPeg=$gt->sts_kepegawaian;
		$sertifikasi=$gt->sertifikasi;
		$data=$this->db->query("select * from tr_sts_pegawai where id='".$jenisPeg."'")->row();
		if($sertifikasi=="ya")
		{
			return $data->honor_sertifikasi;
		}else{
			return $data->honor;
		}
	}
	function namaBiaya($id)
	{
		
			$return=$this->m_reff->goField("keu_tr_biaya_pokok","nama","where id='".$id."'");
		if($return)
		{
			return $return;
		}else{
			return  $this->m_reff->goField("keu_tr_biaya_tetap","nama_biaya","where kode='".$id."'");
		}
	}
	function updateLogin()
	{	$agen=$_SERVER['HTTP_USER_AGENT'];
		$ip=$_SERVER['SERVER_ADDR'];
		$date=date("Y-m-d H:i:s");
		$waktu=$this->tanggal->tambah_menit($date,20);
				$id=$this->session->userdata("id");
				$level=$this->session->userdata("level");
		 		$this->db->where("id",$id);
				$this->db->where("level",$level);
				$this->db->set("ip",$ip);
				$this->db->set("browser",$agen);
				$this->db->set("waktu",$waktu);
				return $this->db->update("aktif_login"); 
	}
	function logout()
	{	 
				$id=$this->session->userdata("id");
				$level=$this->session->userdata("level");
		 		$this->db->where("id",$id);
				$this->db->where("level",$level);
				$this->db->set("waktu","");
				return $this->db->update("aktif_login"); 
	}
	function clearkoma($data)
	{
		$data=substr($data,0,-1);
		return $data=substr($data,1);
	}function clearkomaray($data)
	{
		$data=$this->clearkoma($data);
		return explode(",",$data);
	}
	
}

?>