<?php

class Model_siswa extends CI_Model  {
    
 
	var $tbl_jadwal="tm_jadwal_mengajar";
	var $tbl="v_siswa";
	var $tbl_log="data_siswa";
	var $tbl_tagihan="tm_tagihan";
	var $tbl_bayar="tm_pembayaran";
	var $tbl_penilaian="v_penilaian";
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	
	/*===================================*/
	function get_data()
	{
		$query=$this->_get_data();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data()
	{
						  
				 		  
		$cari=$this->input->post("searching");
		$id_kelas=$this->input->post("id_kelas");
		$gender=$this->input->post("gender");
		$aktifasi=$this->input->post("aktifasi");
		$id_agama=$this->input->post("id_agama");
		$id_tahun_masuk=$this->input->post("id_tahun_masuk");
		$id_status_ibu=$this->input->post("id_status_ibu");
		$id_status_ayah=$this->input->post("id_status_ayah");
		$id_penghasilan=$this->input->post("id_penghasilan");
		$id_pekerjaan_ibu=$this->input->post("id_pekerjaan_ibu");
		$id_pekerjaan_ayah=$this->input->post("id_pekerjaan_ayah");
	 	$id_stsdata=$this->input->post("id_stsdata");
	 	$id_tk = $this->input->post("id_tk");
	 	$id_jurusan = $this->input->post("id_jurusan");
	 
		 
		$filter="";
		
		
		if($id_stsdata)
		{
			$filter.=" AND id_sts_data='".$id_stsdata."' ";
		}else{
			//$filter.=" AND aktifasi=1 and id_tahun_keluar is null";
				if($aktifasi)
				{
		        	$filter.="AND aktifasi='".$aktifasi."'  and id_tahun_keluar is null";
			
				}else{
				    	$filter.=" AND id_sts_data in (1,4) ";
				}
		}
		 
		 
		if($cari)
		{
			$filter.=" AND (
				nama LIKE '%".$cari."%'  or
				nis LIKE '%".$cari."%'  or
				nama_ayah LIKE '%".$cari."%'  or
				nama_ibu LIKE '%".$cari."%'  or
				alamat LIKE '%".$cari."%'  or
				hp LIKE '%".$cari."%'  
				) ";
		}
		if ($id_tk) {
			$filter.=" AND id_tk ='".$id_tk."' ";
		}
		if ($id_jurusan) {
			$filter.=" AND id_jurusan ='".$id_jurusan."' ";
		}

		if($id_pekerjaan_ayah)
		{
			$filter.="AND id_pekerjaan_ayah='".$id_pekerjaan_ayah."' ";
		}
		if($id_pekerjaan_ibu)
		{
			$filter.="AND id_pekerjaan_ibu='".$id_pekerjaan_ibu."' ";
		}
		if($id_penghasilan)
		{
			$filter.="AND id_penghasilan='".$id_penghasilan."' ";
		}
		if($id_status_ayah)
		{
			$filter.="AND id_status_ayah='".$id_status_ayah."' ";
		} 
		if($id_status_ayah)
		{
			$filter.="AND id_status_ayah='".$id_status_ayah."' ";
		} 
		if($id_status_ibu)
		{
			$filter.="AND id_status_ibu='".$id_status_ibu."' ";
		} 
		if($id_tahun_masuk)
		{
			$filter.="AND id_tahun_masuk='".$id_tahun_masuk."' ";
		} 
		if($id_agama)
		{
			$filter.="AND id_agama='".$id_agama."' ";
		} 
		
		 
		/*if($id_kelas)
		{	$dtkls="";
			foreach($id_kelas as $valk)
			{
				$dtkls.=$valk.",";
			}
			$dtkls=substr($dtkls,0,-1);
			if($dtkls){
			$filterz="AND id_kelas in (".$dtkls.") ";
			$filter.=str_replace("(,","(",$filterz);
			}
			
		} */
		 
		if($id_kelas)
		{
			$filter.=" AND id_kelas='".$id_kelas."' ";
		} 
		
		if($gender)
		{
			$filter.=" AND jk='".$gender."' ";
		} 
		
		 
		$query="select * from ".$this->tbl." where 1=1 $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				nis LIKE '%".$searchkey."%'  or
				nama_ayah LIKE '%".$searchkey."%'  or
				nama_ibu LIKE '%".$searchkey."%'  or
				alamat LIKE '%".$searchkey."%'  or
				hp LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by id_tk,id_jurusan,nama_kelas,nama ASC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count()
	{				
		$query = $this->_get_data();
        return  $this->db->query($query)->num_rows();
	}
	 
	 /*===================================*//*===================================*/
	function data_migrasi()
	{
		$query=$this->_data_migrasi();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _data_migrasi()
	{
						  
				 		  
		$cari=$this->input->post("searching");
		$id_kelas=$this->input->post("id_kelas");
		$gender=$this->input->post("gender");
		$aktifasi=$this->input->post("aktifasi");
		$id_agama=$this->input->post("id_agama");
		$id_tahun_masuk=$this->input->post("id_tahun_masuk");
		$id_status_ibu=$this->input->post("id_status_ibu");
		$id_status_ayah=$this->input->post("id_status_ayah");
		$id_penghasilan=$this->input->post("id_penghasilan");
		$id_pekerjaan_ibu=$this->input->post("id_pekerjaan_ibu");
		$id_pekerjaan_ayah=$this->input->post("id_pekerjaan_ayah");
 		 
		$filter="";
		
		
	 
		
		if($cari)
		{
			$filter.=" AND (
				nama LIKE '%".$cari."%'  or
				nis LIKE '%".$cari."%'  or
				nama_ayah LIKE '%".$cari."%'  or
				nama_ibu LIKE '%".$cari."%'  or
				alamat LIKE '%".$cari."%'  or
				hp LIKE '%".$cari."%'  
				) ";
		}
		if($id_pekerjaan_ayah)
		{
			$filter.="AND id_pekerjaan_ayah='".$id_pekerjaan_ayah."' ";
		}
		if($id_pekerjaan_ibu)
		{
			$filter.="AND id_pekerjaan_ibu='".$id_pekerjaan_ibu."' ";
		}
		if($id_penghasilan)
		{
			$filter.="AND id_penghasilan='".$id_penghasilan."' ";
		}
		if($id_status_ayah)
		{
			$filter.="AND id_status_ayah='".$id_status_ayah."' ";
		} 
		if($id_status_ayah)
		{
			$filter.="AND id_status_ayah='".$id_status_ayah."' ";
		} 
		if($id_status_ibu)
		{
			$filter.="AND id_status_ibu='".$id_status_ibu."' ";
		} 
		if($id_tahun_masuk)
		{
			$filter.="AND id_tahun_masuk='".$id_tahun_masuk."' ";
		} 
		if($id_agama)
		{
			$filter.="AND id_agama='".$id_agama."' ";
		} 
		if($aktifasi)
		{
			$filter.="AND aktifasi='".$aktifasi."' ";
		} 
		 
		if($id_kelas)
		{	 
			 
			$filter="AND id_kelas = '".$id_kelas."' ";
	 
			
		} 
		 
		if($gender)
		{
			$filter.="AND jk='".$gender."' ";
		} 
		
		 
		$query="select * from ".$this->tbl." where aktifasi=1 $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				nis LIKE '%".$searchkey."%'  or
				nama_ayah LIKE '%".$searchkey."%'  or
				nama_ibu LIKE '%".$searchkey."%'  or
				alamat LIKE '%".$searchkey."%'  or
				hp LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by id_tk,id_jurusan,nama_kelas,nama ASC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_migrasi()
	{				
		$query = $this->_data_migrasi();
        return  $this->db->query($query)->num_rows();
	}
	 
	 /*===================================*/
	function catatan_penilaian()
	{
		$query=$this->_catatan_penilaian();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _catatan_penilaian()
	{
		$id_siswa=$this->input->post("id_siswa");
		$id_tk=$this->input->post("id_tk");
		$id_kpenilaian=$this->input->post("id_kpenilaian");
		$type=$this->input->post("type_penilaian");
		 
		$filter="";
		if($id_siswa)
		{
			$filter.="AND id_siswa='".$id_siswa."' ";
		} if($id_tk)
		{
			$filter.="AND id_tk='".$id_tk."' ";
		} 
		if($id_kpenilaian)
		{	$penilaian="";
			foreach($id_kpenilaian as $valk)
			{
				$penilaian.=$valk.",";
			}
			$penilaian=substr($penilaian,0,-1);
			
			
			$filterp="AND id_kpenilaian in (".$penilaian.") ";
			$filter.=str_replace("(,","(",$filterp);
		} 

		if($type)
		{
			$filter.="AND type='".$type."' ";
		} 
		 
		 
		$query="select * from ".$this->tbl_penilaian." where 1=1 $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				ket LIKE '%".$searchkey."%'  or
				penilaian LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by id   DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_catatan()
	{				
		$query = $this->_catatan_penilaian();
        return  $this->db->query($query)->num_rows();
	}
	//==============================================================///
	 
	function getDataMapel($id)
	{
		$data=explode(",",$id); $mapel="";
		foreach($data as $val)
		{
			$mapel.=$this->m_reff->goField("tr_mapel","nama","where id='".$val."' ").",";
		}
		return substr($mapel,0,-1);
	}		
	  
	function import_data_siswa()
	{	
		$var=array();
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		 
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["file"]['tmp_name']))
		{
				return $this->importData("file");
			 
		}else{
				return $var;
		}
		
	}
	
	function cek_nis($nis)
	{
	 return	$this->db->get_where($this->tbl,array("nis"=>$nis))->row();
	}
	function cek_idkelas($id)
	{
	 return	$this->db->get_where("tm_kelas",array("id"=>$id))->num_rows();
	}
	function cek_idtahunmasuk($id)
	{
	 return	$this->db->get_where("tr_tahun_ajaran",array("id"=>$id))->num_rows();
	}
	
function importData($file_form)
	{		
	$tahun=$this->m_reff->tahun();
	$this->load->library("PHPExcel");
		$insert=0;$gagal=0;$edit=0;$validasi_hp=true;$validasi=true;
		$file   = explode('.',$_FILES[$file_form]['name']);
		$length = count($file);
		if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){
         $tmp    = $_FILES[$file_form]['tmp_name']; 
	 
			    $load = PHPExcel_IOFactory::load($tmp);
                $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
				$i=1;
					 
				foreach ($sheets as $sheet) {
				if ($i > 2) {						
						$penom=1; $set=array(); $set1=array();
						$nama=$this->m_reff->sheet($sheet,$penom++);  $set["nama"]=$nama;
						$nis=$nipd=$this->m_reff->sheet($sheet,$penom++); $set["nis"]=$nis;
						$id_kelas=$this->m_reff->sheet($sheet,$penom++); $set["id_kelas"]=$id_kelas;
						$jk=$this->m_reff->sheet($sheet,$penom++);  $set["jk"]=$jk;
						$nisn=$this->m_reff->sheet($sheet,$penom++); $set["nisn"]=$nisn;
						$tempat_lahir=$this->m_reff->sheet($sheet,$penom++);  $set["tempat_lahir"]=$tempat_lahir;
						$tgl_lahir=$this->m_reff->sheet($sheet,$penom++);  
						$tgl_lahir=$this->tanggal->format($tgl_lahir);  $set["tgl_lahir"]=$tgl_lahir; 
						$nik=$this->m_reff->sheet($sheet,$penom++); $set["nik"]=$nik;
						$agama=$this->m_reff->sheet($sheet,$penom++); $set["id_agama"]=$agama;
						$alamat=$this->m_reff->sheet($sheet,$penom++); $set["alamat"]=$alamat;
						$rt=$this->m_reff->sheet($sheet,$penom++); $set["rt"]=$rt;
						$rw=$this->m_reff->sheet($sheet,$penom++); $set["rw"]=$rw;
						$n_dusun=$this->m_reff->sheet($sheet,$penom++); $set["n_dusun"]=$n_dusun;
						$n_kel=$this->m_reff->sheet($sheet,$penom++); $set["n_kel"]=$n_kel;
						$n_kec=$this->m_reff->sheet($sheet,$penom++); $set["n_kec"]=$n_kec;
						$kode_pos=$this->m_reff->sheet($sheet,$penom++); $set["kode_pos"]=$kode_pos;
							$j_tinggal=$this->m_reff->sheet($sheet,$penom++); $set["j_tinggal"]=$j_tinggal;
						$a_transport=$this->m_reff->sheet($sheet,$penom++); $set["a_transport"]=$a_transport;
							$telp=$this->m_reff->sheet($sheet,$penom++); $set["telp"]=$telp;
						$hp=$this->m_reff->sheet($sheet,$penom++); $set["hp"]=$hp;
						$email=$this->m_reff->sheet($sheet,$penom++); $set["email"]=$email;
						
						$skhun=$this->m_reff->sheet($sheet,$penom++);  $set["skhun"]=$skhun;
						$terima_kps=$this->m_reff->sheet($sheet,$penom++);  $set["terima_kps"]=$terima_kps;
						$no_kps=$this->m_reff->sheet($sheet,$penom++);  $set["no_kps"]=$no_kps;
						
						$nama_ayah=$this->m_reff->sheet($sheet,$penom++);  $set1["nama_ayah"]=$nama_ayah;
						$thn_lahir_ayah=$this->m_reff->sheet($sheet,$penom++);  $set1["thn_lahir_ayah"]=$thn_lahir_ayah;
						$jp_ayah=$this->m_reff->sheet($sheet,$penom++);  $set1["jp_ayah"]=$jp_ayah;
						$id_pekerjaan_ayah=$this->m_reff->sheet($sheet,$penom++);  $set1["id_pekerjaan_ayah"]=$id_pekerjaan_ayah;
						$id_penghasilan_ayah=$this->m_reff->sheet($sheet,$penom++);  $set1["id_penghasilan"]=$id_penghasilan_ayah;
						$nik_ayah=$this->m_reff->sheet($sheet,$penom++); $set1["nik_ayah"]=$nik_ayah;
						
						
						$nama_ibu=$this->m_reff->sheet($sheet,$penom++); $set1["nama_ibu"]=$nama_ibu;
						$thn_lahir_ibu=$this->m_reff->sheet($sheet,$penom++); $set1["thn_lahir_ibu"]=$thn_lahir_ibu;
						$jp_ibu=$this->m_reff->sheet($sheet,$penom++); $set1["jp_ibu"]=$jp_ibu;
						$id_pekerjaan_ibu=$this->m_reff->sheet($sheet,$penom++); $set1["id_pekerjaan_ibu"]=$id_pekerjaan_ibu;
						$id_penghasilan_ibu=$this->m_reff->sheet($sheet,$penom++); $set1["id_penghasilan_ibu"]=$id_penghasilan_ibu;	
						$nik_ibu=$this->m_reff->sheet($sheet,$penom++); $set1["nik_ibu"]=$nik_ibu;
					
						
							$nama_wali=$this->m_reff->sheet($sheet,$penom++); $set["nama_wali"]=$nama_wali;
						$tahun_lahir_wali=$this->m_reff->sheet($sheet,$penom++);  $set["tahun_lahir_wali"]=$tahun_lahir_wali;
							$jp_wali=$this->m_reff->sheet($sheet,$penom++);  $set["jp_wali"]=$jp_wali;
						$id_pekerjaan_wali=$this->m_reff->sheet($sheet,$penom++);  $set["id_pekerjaan_wali"]=$id_pekerjaan_wali;
						$id_penghasilan_wali=$this->m_reff->sheet($sheet,$penom++);  $set["id_penghasilan_wali"]=$id_penghasilan_wali;
						$nik_wali=$this->m_reff->sheet($sheet,$penom++);  $set["nik_wali"]=$nik_wali;
						$penom++;
						$no_peserta_un=$this->m_reff->sheet($sheet,$penom++);  $set["no_peserta_un"]=$no_peserta_un;
						$no_seri_ijazah=$this->m_reff->sheet($sheet,$penom++);  $set["no_seri_ijazah"]=$no_seri_ijazah;
						$terima_kip=$this->m_reff->sheet($sheet,$penom++); $set["terima_kip"]=$terima_kip;
						$no_kip=$this->m_reff->sheet($sheet,$penom++);  $set["no_kip"]=$no_kip;
						$nama_kip=$this->m_reff->sheet($sheet,$penom++);  $set["nama_kip"]=$nama_kip;
						$no_kks=$this->m_reff->sheet($sheet,$penom++);  $set["no_kks"]=$no_kks;
						$no_reg_aktalahir=$this->m_reff->sheet($sheet,$penom++);  $set["no_reg_aktalahir"]=$no_reg_aktalahir;
						$bank=$this->m_reff->sheet($sheet,$penom++);  $set["bank"]=$bank;
						$no_rek_bank=$this->m_reff->sheet($sheet,$penom++);  $set["no_rek_bank"]=$no_rek_bank;
						$an_bank=$this->m_reff->sheet($sheet,$penom++);  $set["an_bank"]=$an_bank;
						$layak_pip=$this->m_reff->sheet($sheet,$penom++);  $set["layak_pip"]=$layak_pip;
						$alasan_pip=$this->m_reff->sheet($sheet,$penom++);  $set["alasan_pip"]=$alasan_pip;
						$kebutuhan_khusus=$this->m_reff->sheet($sheet,$penom++);  $set["kebutuhan_khusus"]=$kebutuhan_khusus;
						$asal_sekolah_pindahan=$this->m_reff->sheet($sheet,$penom++);  $set["asal_sekolah_pindahan"]=$asal_sekolah_pindahan;
						$anak_ke=$this->m_reff->sheet($sheet,$penom++);  $set1["anak_ke"]=$anak_ke;
						$lat=$this->m_reff->sheet($sheet,$penom++);  $set["lat"]=$lat;
						$lng=$this->m_reff->sheet($sheet,$penom++);  $set["lng"]=$lng;
							$id_tahun_masuk=$this->m_reff->sheet($sheet,$penom++); $set["id_tahun_masuk"]=$id_tahun_masuk;
							$hubungan=$this->m_reff->sheet($sheet,$penom++);  $set["hubungan"]=$hubungan;
							$jml_saudara=$this->m_reff->sheet($sheet,$penom++);  $set1["jml_saudara"]=$jml_saudara;
					 
					  
						if(!$nis){ 	 $var["gagal"]=false; $var["info"]="Terdapat NIS/NIPD Kosong";	return $var; }
						
						$cek_idkelas=$this->cek_idkelas($id_kelas);
						if(!$cek_idkelas){ $var["gagal"]=false; $var["info"]="Kolom ID KELAS '$id_kelas' salah pengisian urut ke :$i - $nama ";	return $var; }
						
						$cek_idtahun=$this->cek_idtahunmasuk($id_tahun_masuk);
						if(!$cek_idtahun){  $var["gagal"]=false; $var["info"]="Kolom ID TAHUN MASUK salah pengisian";	return $var; }
						 
						$cek_nis=$this->cek_nis($nis);
						if($cek_nis){
							 $var["gagal"]=false; $var["info"]="Tehenti karena duplikat data NIS :$nis - dibaris ke $i - nama : $nama";	return $var;
						//		$set["alias"]="in".$nis."ft";
						////		$set["username"]=$nis;
						//		$set["password"]=md5($nis);
								$set["_uid"]=$this->idu();
								$set["_utime"]=date("Y-m-d H:i:s");
								
								
							$getkel=$this->db->query("select id_tk from tm_kelas where id='".$id_kelas."'")->row();
							$getIdTk=$getkel->id_tk;
							if($getIdTk==1)
							{
							////////	$this->db->query("UPDATE data_siswa SET id_kelas_2=null,id_tahun_2=null,id_kelas_3=null,id_tahun_3=null,id_kelas_1=id_kelas, id_tahun_1='".$tahun."' WHERE id='".$id_siswa."'  ");
								$raykelas=array(
								"id_kelas_6"=>null,
								"id_tahun_6"=>null,
								"id_kelas_5"=>null,
								"id_tahun_5"=>null,
								"id_kelas_4"=>null,
								"id_tahun_4"=>null,
								"id_kelas_3"=>null,
								"id_tahun_3"=>null,
								"id_kelas_2"=>null,
								"id_tahun_2"=>null,
								"id_kelas_1"=>$id_kelas,
								"id_tahun_1"=>$tahun,
								);
							}elseif($getIdTk==2)
							{
								//$this->db->query("UPDATE data_siswa SET id_kelas_3=null,id_tahun_3=null,id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$id_siswa."'  ");
							
								$raykelas=array(
								"id_kelas_6"=>null,
								"id_tahun_6"=>null,
								"id_kelas_5"=>null,
								"id_tahun_5"=>null,
								"id_kelas_4"=>null,
								"id_tahun_4"=>null,
								"id_kelas_3"=>null,
								"id_tahun_3"=>null,
								"id_kelas_2"=>$id_kelas,
								"id_tahun_2"=>$tahun,
								"id_kelas_1"=>null,
								"id_tahun_1"=>null,
								);
							
							}elseif($getIdTk==3)
							{
								//$this->db->query("UPDATE data_siswa SET id_kelas_3=null,id_tahun_3=null,id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$id_siswa."'  ");
							
								$raykelas=array(
								"id_kelas_6"=>null,
								"id_tahun_6"=>null,
								"id_kelas_5"=>null,
								"id_tahun_5"=>null,
								"id_kelas_4"=>null,
								"id_tahun_4"=>null,
								"id_kelas_3"=>$id_kelas,
								"id_tahun_3"=>$tahun,
								"id_kelas_2"=>null,
								"id_tahun_2"=>null,
								"id_kelas_1"=>null,
								"id_tahun_1"=>null,
								);
							
							}elseif($getIdTk==4)
							{
								//$this->db->query("UPDATE data_siswa SET id_kelas_3=null,id_tahun_3=null,id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$id_siswa."'  ");
							
								$raykelas=array(
								"id_kelas_6"=>null,
								"id_tahun_6"=>null,
								"id_kelas_5"=>null,
								"id_tahun_5"=>null,
								"id_kelas_4"=>$id_kelas,
								"id_tahun_4"=>$tahun,
								"id_kelas_3"=>null,
								"id_tahun_3"=>null,
								"id_kelas_2"=>null,
								"id_tahun_2"=>null,
								"id_kelas_1"=>null,
								"id_tahun_1"=>null,
								);
							
							}elseif($getIdTk==5)
							{
								//$this->db->query("UPDATE data_siswa SET id_kelas_3=null,id_tahun_3=null,id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$id_siswa."'  ");
							
								$raykelas=array(
								"id_kelas_6"=>null,
								"id_tahun_6"=>null,
								"id_kelas_5"=>$id_kelas,
								"id_tahun_5"=>$tahun,
								"id_kelas_4"=>null,
								"id_tahun_4"=>null,
								"id_kelas_3"=>null,
								"id_tahun_3"=>null,
								"id_kelas_2"=>null,
								"id_tahun_2"=>null,
								"id_kelas_1"=>null,
								"id_tahun_1"=>null,
								);
							
							} else
							{
								//$this->db->query("UPDATE data_siswa SET id_kelas_3=id_kelas, id_tahun_3='".$tahun."' WHERE id='".$id_siswa."'  ");
								$raykelas=array(
								"id_kelas_6"=>$id_kelas,
								"id_tahun_6"=>$tahun,
								"id_kelas_5"=>null,
								"id_tahun_5"=>null,
								"id_kelas_4"=>null,
								"id_tahun_4"=>null,
								"id_kelas_3"=>null,
								"id_tahun_3"=>null,
								"id_kelas_2"=>null,
								"id_tahun_2"=>null,
								"id_kelas_1"=>null,
								"id_tahun_1"=>null,
								);
							}
								 
							$dataraygabung=array_merge($set,$raykelas);
							$this->update_siswa($dataraygabung);
							//	$set1["alias"]="in12345ft";
							//	$set1["username"]=$nis;
							//	$set1["password"]=md5("12345");
								$id_siswa=$cek_nis->id;	  
								$set1["id_siswa"]=$id_siswa;
								$set1["nis_siswa"]=$id_siswa;
								$set1["_uid"]=$this->idu();
								$set1["_utime"]=date("Y-m-d H:i:s");
								$dataray=$set1;
								$this->update_ortu($dataray);
							$edit++;
						}else{
								$set["alias"]="in".$nis."ft";
								$set["username"]=$nis;
								$set["id"]=$nis;
								$set["password"]=md5($nis);
								$set["_cid"]=$this->idu();
								$set["_ctime"]=date("Y-m-d H:i:s");
								 
								
							 $getkel=$this->db->query("select id_tk from tm_kelas where id='".$id_kelas."'")->row();
							$getIdTk=$getkel->id_tk;
							if($getIdTk==1)
							{
							////////	$this->db->query("UPDATE data_siswa SET id_kelas_2=null,id_tahun_2=null,id_kelas_3=null,id_tahun_3=null,id_kelas_1=id_kelas, id_tahun_1='".$tahun."' WHERE id='".$id_siswa."'  ");
								$raykelas=array(
								"id_kelas_6"=>null,
								"id_tahun_6"=>null,
								"id_kelas_5"=>null,
								"id_tahun_5"=>null,
								"id_kelas_4"=>null,
								"id_tahun_4"=>null,
								"id_kelas_3"=>null,
								"id_tahun_3"=>null,
								"id_kelas_2"=>null,
								"id_tahun_2"=>null,
								"id_kelas_1"=>$id_kelas,
								"id_tahun_1"=>$tahun,
								);
							}elseif($getIdTk==2)
							{
								//$this->db->query("UPDATE data_siswa SET id_kelas_3=null,id_tahun_3=null,id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$id_siswa."'  ");
							
								$raykelas=array(
								"id_kelas_6"=>null,
								"id_tahun_6"=>null,
								"id_kelas_5"=>null,
								"id_tahun_5"=>null,
								"id_kelas_4"=>null,
								"id_tahun_4"=>null,
								"id_kelas_3"=>null,
								"id_tahun_3"=>null,
								"id_kelas_2"=>$id_kelas,
								"id_tahun_2"=>$tahun,
								"id_kelas_1"=>null,
								"id_tahun_1"=>null,
								);
							
							}elseif($getIdTk==3)
							{
								//$this->db->query("UPDATE data_siswa SET id_kelas_3=null,id_tahun_3=null,id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$id_siswa."'  ");
							
								$raykelas=array(
								"id_kelas_6"=>null,
								"id_tahun_6"=>null,
								"id_kelas_5"=>null,
								"id_tahun_5"=>null,
								"id_kelas_4"=>null,
								"id_tahun_4"=>null,
								"id_kelas_3"=>$id_kelas,
								"id_tahun_3"=>$tahun,
								"id_kelas_2"=>null,
								"id_tahun_2"=>null,
								"id_kelas_1"=>null,
								"id_tahun_1"=>null,
								);
							
							}elseif($getIdTk==4)
							{
								//$this->db->query("UPDATE data_siswa SET id_kelas_3=null,id_tahun_3=null,id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$id_siswa."'  ");
							
								$raykelas=array(
								"id_kelas_6"=>null,
								"id_tahun_6"=>null,
								"id_kelas_5"=>null,
								"id_tahun_5"=>null,
								"id_kelas_4"=>$id_kelas,
								"id_tahun_4"=>$tahun,
								"id_kelas_3"=>null,
								"id_tahun_3"=>null,
								"id_kelas_2"=>null,
								"id_tahun_2"=>null,
								"id_kelas_1"=>null,
								"id_tahun_1"=>null,
								);
							
							}elseif($getIdTk==5)
							{
								//$this->db->query("UPDATE data_siswa SET id_kelas_3=null,id_tahun_3=null,id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$id_siswa."'  ");
							
								$raykelas=array(
								"id_kelas_6"=>null,
								"id_tahun_6"=>null,
								"id_kelas_5"=>$id_kelas,
								"id_tahun_5"=>$tahun,
								"id_kelas_4"=>null,
								"id_tahun_4"=>null,
								"id_kelas_3"=>null,
								"id_tahun_3"=>null,
								"id_kelas_2"=>null,
								"id_tahun_2"=>null,
								"id_kelas_1"=>null,
								"id_tahun_1"=>null,
								);
							
							} else
							{
								//$this->db->query("UPDATE data_siswa SET id_kelas_3=id_kelas, id_tahun_3='".$tahun."' WHERE id='".$id_siswa."'  ");
								$raykelas=array(
								"id_kelas_6"=>$id_kelas,
								"id_tahun_6"=>$tahun,
								"id_kelas_5"=>null,
								"id_tahun_5"=>null,
								"id_kelas_4"=>null,
								"id_tahun_4"=>null,
								"id_kelas_3"=>null,
								"id_tahun_3"=>null,
								"id_kelas_2"=>null,
								"id_tahun_2"=>null,
								"id_kelas_1"=>null,
								"id_tahun_1"=>null,
								);
							};
								
								 
						//	$like=$this->db->query("SHOW TABLE STATUS LIKE 'data_siswa'")->row();
							$idsiswa=$nis;//($like->Auto_increment);	//stts id skrg
							
							 $dataraygabung=array_merge($set,$raykelas);
							$this->insert_siswa($dataraygabung,$idsiswa);
							
							
								$set1["alias"]="in12345ft";
							 	$set1["username"]=$nis;
							 	$set1["nis_siswa"]=$nis;
							 	$set1["password"]=md5("12345");
							 	$set1["id_siswa"]=$idsiswa;
							 	$set1["_cid"]=$this->idu();
							 	$set1["_ctime"]=date("Y-m-d H:i:s");
							 
							$this->insert_ortu($set1);
							$insert++;
						}
						 
				      
				}
				$i++;
                }
               
		}else{
			 $var["file"]=false;
			 $var["type_file"]="xlsx";
		}
			  $var["import_data"]=true;
			  $var["data_insert"]=$insert;
			  $var["data_gagal"]=$gagal;
			  $var["data_edit"]=$edit;
			  $var["hp"]=$validasi_hp;
			  $var["validasi"]=$validasi;
		return $var;
	}
	 
	function insert_siswa($dataray,$idsiswa)
	{	$idsiswa=($idsiswa+1); //ngambil dari auti incremen karena blm di insert makan ditambah 1
	   $nama_tahun=$this->m_reff->goField("tr_tahun_ajaran","nama","where id='".$dataray['id_tahun_masuk']."' ");
	   $thn_path=str_replace("/","_",$nama_tahun);
	   $path1="file_upload/siswa/".$thn_path; //tahun ajaran
	   if (!file_exists($path1)) {
		    mkdir($path1,0777, true);
	   }

	   $path2="file_upload/siswa/".$thn_path."/".$idsiswa; //nis
	   if (!file_exists($path2)) {
		    mkdir($path2,0777, true);
	   }
	  
		return	$this->db->insert($this->tbl_log,$dataray);
	}
	function update_siswa($dataray)
	{


			$this->db->where("nis",$dataray['nis']);
	return	$this->db->update($this->tbl_log,$dataray);
	}
	 
	 function insert_ortu($dataray)
	{
		return	$this->db->insert("data_ortu",$dataray);
	}
	function update_ortu($dataray)
	{
			$this->db->where("id_siswa",$dataray['id_siswa']);
	return	$this->db->update("data_ortu",$dataray);
	}
	 
	 
	  
	 
	 
	function hapus_pendidik()
	{			
					$id=$this->input->post("id");
					$nama_file=$this->m_reff->goField($this->tbl_log,"poto","where id='".$id."'");
					$this->m_reff->hapus_file("file_upload/dp/".$nama_file."");
					$noid=$this->m_reff->goField($this->tbl_log,"nip","where id='".$id."'");
					
					$this->db->where("id",$id);
					$this->db->delete($this->tbl_log);
		
					$this->db->where("id_admin",$id);
					$this->db->delete("tm_cbt");
					
					$this->db->where("id_guru",$id);
					$this->db->delete("data_materi");
					
					$this->db->where("id_admin",$id);
					$this->db->delete("data_cbt");
					
					$this->db->where("noid",$noid);
					$this->db->delete("tm_izin_kehadiran");
					
					$this->db->where("noid",$noid);
		return		$this->db->delete("tm_log_kehadiran");
		 
	}
 
	
  function kehadiran($id_siswa,$sts,$bln)
	{	
	 
		return $this->db->query("select * from tm_absen_siswa where  SUBSTR(tgl,1,7)='".$bln."'
		and     absen".$sts." like '%,".$id_siswa.",%'
		")->num_rows();
	}
	 
	function hapus_siswa()
	{			
					$id=$this->input->post("id");
					 
					 //$thn=$this->m_reff->goField("v_siswa","tahun_masuk","where id='".$id."' ");
					// $thn=str_replace("/","_",$thn);
					// $path="file_upload/siswa/".$thn."/".$id;
				 	//$this->m_reff->hapussemua($path);
					
					$this->db->where("id",$id);
					$this->db->delete($this->tbl_log);
		
					$this->db->where("id_siswa",$id);
					$this->db->delete("data_nilai");
					
					$this->db->where("id_siswa",$id);
					$this->db->delete("tm_pkl");
					
				 
					
					$this->db->where("id_siswa",$id);
					$this->db->delete("data_ortu");
					  
					$this->db->where("noid",$id);
		return		$this->db->delete("tm_log_kehadiran");
		 
	}
	
	function aktifasi_pendidik()
	{			
				$sts=$this->input->post("sts");
				if($sts==1)
				{	$akt="2";
				}else{ $akt="1";
				}
				$id=$this->input->post("id");
			   $this->db->where("id",$id);
			   $this->db->set("aktifasi",$akt);
		return $this->db->update($this->tbl_log);
	}
	
	
	function download_format_siswa()
	{
		
//////start
        $objPHPExcel = new PHPExcel();
//style
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '6CCECB')
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
        );
        $style2 = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccff99')
            )
        );
        $style3 = array(
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccff99')
            )
        );
       
         

//create column
$abjad="A";
 $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');               $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NO');   
 $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');               $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NAMA');   
 $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');                 $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NIS/NIPD'); 
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');               $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'ID KELAS/ROMBEL'); 
 $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');                        
                         
                         
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'ID GENDER/JK'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
           $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NISN');  $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'TEMPAT LAHIR'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'TANGGAL LAHIR'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
  
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NIK'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
      $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'ID AGAMA'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'ALAMAT'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
         $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'RT'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'RW'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'DUSUN'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'KELURAHAN'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'KECAMATAN'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
       // $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'KABUPATEN'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'KODE POS'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'JENIS TINGGAL'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'ALAT TRANSPORTASI'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'TELPON'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'HP'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'EMAIL'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'SKHUN'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
         $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'MENERIMA KPS'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NO KPS');// $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        
       $objPHPExcel->getActiveSheet(0)->setCellValue($abjad.'1', 'DATA AYAH'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells('Z1:AE1');   $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', 'NAMA'); 
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', 'TAHUN LAHIR');
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', '  JENJANG PENDIDIKAN'); 
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', '  PEKERJAAN ');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', '  PENGHASILAN'); 
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', 'NIK');
        
        
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad.'1', 'DATA IBU'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AF1:AK1');
         $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', 'NAMA');  
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', 'TAHUN LAHIR');
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', '  JENJANG PENDIDIKAN'); 
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', '  PEKERJAAN ');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', '  PENGHASILAN'); 
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', 'NIK');
        
         $objPHPExcel->getActiveSheet(0)->setCellValue($abjad.'1', 'DATA WALI'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AL1:AQ1');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', 'NAMA'); 
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', 'TAHUN LAHIR');
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', '  JENJANG PENDIDIKAN'); 
          $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', '  PEKERJAAN ');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', '  PENGHASILAN'); 
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'2', 'NIK');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'ROMBEL SAAT INI');   $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NO PESERTA UN');   $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NO SERI IJAZAH');   $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
           $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'MENERIMA KIP'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NO KIP'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NAMA DI KIP'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NO KKS'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
         $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NO REG AKTA LAHIR'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        
           $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', '  BANK'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'NO REKENING'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'REKENING ATAS NAMA '); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
         $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'LAYAK PIP (usulan sekolah)'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'ALASAN KELAYAKAN PIP'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'KEBUTUHAN KHUSUS'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
         $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'SEKOLAH ASAL  '); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'ANAK KE'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
         $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'LINTANG'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'BUJUR'); $objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
        
        
           $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'ID TAHUN MASUK AJARAN');$objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
           $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', 'HUBUNGAN WALI DENGAN SISWA');$objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
           $objPHPExcel->getActiveSheet(0)->setCellValue($abjad.'1', 'JUMLAH SAUDARA');
           //$objPHPExcel->setActiveSheetIndex(0)->mergeCells($abjad.'1:'.$abjad.'2');
         
        for($auto="A";$auto<="BL";$auto++)
        {
             $objPHPExcel->getSheet(0)->getColumnDimension($auto)->setAutoSize(true);
        }
	 
		///------------------------///
		 
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:'.$abjad.'1')->applyFromArray($style);
      $objPHPExcel->getActiveSheet(0)->getStyle('A2:'.$abjad.'2')->applyFromArray($style);
 
// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA SISWA');
		
 //<!-------------------------------------------------------------------------------  --->	
		$get=1;	
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID KELAS');
        $objPHPExcel->addSheet($myWorkSheet,$get);
 
 
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet($get)->setCellValue('B1', 'NAMA KELAS');
        $objPHPExcel->getSheet($get)->setCellValue('C1', 'TINGKAT');
        $objPHPExcel->getSheet($get)->setCellValue('D1', 'JURUSAN');
        $objPHPExcel->getSheet($get)->setCellValue('E1', 'KELAS/RUANG');
        $objPHPExcel->getSheet($get)->getStyle('A1:E1')->applyFromArray($style);
		
        $datamapel = $this->db->query("select * from v_kelas order by id_tk,id_jurusan,id")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', $list->nama);
            $objPHPExcel->getSheet($get)->setCellValue('C' . $shit . '', $list->nama_tingkat);
            $objPHPExcel->getSheet($get)->setCellValue('D' . $shit . '', $list->alias);
            $objPHPExcel->getSheet($get)->setCellValue('E' . $shit . '', $list->nama_kelas);
			
        }
		 
//<!-------------------------------------------------------------------------------------->
//<!-------------------------------------------------------------------------------  --->		
      
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID AGAMA');
		$get=2;
        $objPHPExcel->addSheet($myWorkSheet, $get);
 
 
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('B')->setAutoSize(true);
    
        $objPHPExcel->getSheet($get)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet($get)->setCellValue('B1', 'AGAMA');
        
        $objPHPExcel->getSheet($get)->getStyle('A1:B1')->applyFromArray($style);
		
        $datamapel = $this->db->query("select * from tr_agama")->result();
        $shit = 1;
        foreach ($datamapel as $listt) {
            $shit++;
            $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', $listt->id);
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', $listt->nama);
           
			
        }
       
//<!-------------------------------------------------------------------------------------->	
 

	
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID TAHUN');
		$get=3;
        $objPHPExcel->addSheet($myWorkSheet, $get);
 
 
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('B')->setAutoSize(true);
    
        $objPHPExcel->getSheet($get)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet($get)->setCellValue('B1', 'TAHUN');
        
        $objPHPExcel->getSheet($get)->getStyle('A1:B1')->applyFromArray($style);
		
        $datamapel = $this->db->query("select * from tr_tahun_ajaran order by id desc limit 7")->result();
        $shit = 1;
        foreach ($datamapel as $listt) {
            $shit++;
            $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', $listt->id);
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', $listt->nama);
           
			
        }
		 
//<!-------------------------------------------------------------------------------------->	
/*
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID PEKERJAAN');
		$get=4;
        $objPHPExcel->addSheet($myWorkSheet, $get);
 
 
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet($get)->setCellValue('B1', 'PEKERJAAN');
        $objPHPExcel->getSheet($get)->getStyle('A1:B1')->applyFromArray($style);
		
        $datamapel = $this->db->get("tr_pekerjaan")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', $list->nama);
			
			
        }
		 */
//<!-------------------------------------------------------------------------------------->	      
/*		$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID PENGHASILAN');
		$get=4;
        $objPHPExcel->addSheet($myWorkSheet, $get);
 
 
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet($get)->setCellValue('B1', 'PENGHASILAN');
        $objPHPExcel->getSheet($get)->getStyle('A1:B1')->applyFromArray($style);
				
        $datamapel = $this->db->query("select * from tr_penghasilan")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', $list->nama);
			 
        }
		 
 */
//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format-upload-siswa.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
	
	function input_data_siswa()
	{
							
							
		$var=array();
		$var["hp"]=true; 
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		$var["nis_duplicate"]=false; 
		
		
		$nis=$this->input->post("f[nis]");
		$id_tahun_masuk=$this->input->post("id_tahun_masuk");
		$ceknis=$this->cek_nis($nis);
		
		$aksi_edit=$this->input->post("aksi_edit");
		if($aksi_edit=="true")
		{
			$insert="update";
			$id_siswa=$this->input->post("id_siswa");
			$idsiswa=$this->input->post("id_siswa");
		}else{
						//	$like=$this->db->query("SHOW TABLE STATUS LIKE 'data_siswa'")->row();
							$idsiswa=$nis;//($like->Auto_increment);	
							
			$insert="insert";
			if($ceknis)
			{
				$var["nis_duplicate"]=true; 
				return $var;
			}
		}
		
	
		
						$id_kelas=$this->input->post("f[id_kelas]");
						$cek_idkelas=$this->cek_idkelas($id_kelas);
						if(!$cek_idkelas){ $var["id_kelas"]=false; $var["validasi"]=false; return $var; }
						
						$cek_idtahun=$this->cek_idtahunmasuk($id_tahun_masuk);
						if(!$cek_idkelas){ $var["id_tahun_masuk"]=false; $var["validasi"]=false; return $var; }
						
		
		
		
		 
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);

		$data_ort=$this->input->post("g");
		$data_ort=$this->security->xss_clean($data_ort);
		
		 
				$tgl=$this->input->post("tgl_lahir");
				$pass=$this->input->post("password");
			 	$tgl=$this->tanggal->eng_($tgl,"-");
			  
			 $id_tahun_masuk=$this->input->post("f[id_tahun_masuk]");
	   $nama_tahun=$this->m_reff->goField("tr_tahun_ajaran","nama","where id='".$id_tahun_masuk."' ");
	   $thn_path=str_replace("/","_",$nama_tahun);
	   $path1="file_upload/siswa/".$thn_path; //tahun ajaran
	   if (!file_exists($path1)) {
		    mkdir($path1,0777, true);
	   }

	   $path2="file_upload/siswa/".$thn_path."/".$idsiswa; //nis
	   if (!file_exists($path2)) {
		    mkdir($path2,0777, true);
	   }
	  
	 
		if(isset($_FILES["file"]['tmp_name']))
		{
			$pullpath="siswa/".$thn_path."/".$idsiswa;
			$file=$this->m_reff->upload_file("file",$pullpath,"foto","JPG,JPEG,PNG","1000000");
			
			if($aksi_edit=="true"){
			$nama_file=$this->m_reff->goField($this->tbl_log,"poto","where nis='".$nis."' ");
			$this->m_reff->hapus_file("file_upload/".$pullpath."/".$nama_file);  }
			
			if($file["validasi"]!=false)
			{
					 
			 	
		  
				
						$this->db->set("poto",$file["name"]);
						if($aksi_edit=="true"){
								  $pass_ortu=$this->input->post("password_ortu");
								  
								$data_ort2=array(
								"_uid"=>$idu,
								"_utime"=>date("Y-m-d H:i:s"),
								 
								"password"=>md5($pass_ortu),
								"alias"=>"s3".$pass_ortu."s5",
								);

								if ($this->input->post("f[id_sts_data]") == "3" || $this->input->post("f[id_sts_data]") == "5") {
									$tgl_keluar = $this->toTglSys($_POST["tgl_update_sts2"]);

								}
								else{
									$tgl_keluar = "";
								}
								
								$array_tambahan_siswa=array(
									"_uid"=>$idu,
									"id"=>$nis,
									"_utime"=>date("Y-m-d H:i:s"),
									"tgl_lahir"=>$tgl,
									"password"=>md5($pass),
									"alias"=>"a3".$pass."45",
									"tgl_update_sts"	=> $tgl_keluar
								);  
						
						}else{ //jika insert
							 
							$like=$this->db->query("SHOW TABLE STATUS LIKE 'data_siswa'")->row();
							$idsiswa=($like->Auto_increment);	
							
								$data_ort2=array(
								"_cid"=>$idu,
								"id_siswa"=>$idsiswa,
								"password"=>md5("12345"),
								"alias"=>"s312345s5",
								);

								if ($_POST["id_sts_data"] == "3" || $_POST["id_sts_data"] == "5") {
									$tgl_keluar = $this->toTglSys($_POST["tgl_update_sts"]);
								}
								else{
									$tgl_keluar = "";
								}
								
								$array_tambahan_siswa=array(
									"_cid"=>$idu,
									"tgl_lahir"=>$tgl,
									"password"=>md5($pass),
									"alias"=>"a3".$pass."45",
									"tgl_update_sts"	=> $tgl_keluar,
									"id_sts_data"		=> $_POST["id_sts_data"]
								);  
						}
						$data=array_merge($array_tambahan_siswa,$data);
						if($aksi_edit=="true"){ $id_siswa=$this->input->post("id_siswa"); $this->db->where("id",$id_siswa); }
						$this->db->$insert($this->tbl_log,$data);
						///
						
						$data_ortu=array_merge($data_ort,$data_ort2);
						
						if($aksi_edit=="true"){ $id_siswa=$this->input->post("id_siswa"); $this->db->where("id_siswa",$id_siswa); }
						$this->db->$insert("data_ortu",$data_ortu);
			$tahun=$this->m_reff->tahun();
		//	$au=$this->db->query("SHOW TABLE STATUS WHERE `Name` = 'data_siswa'")->row();
			$au=$nis;//($au->Auto_increment-1);
			$getIdTk=$this->input->post("getIdTk");
			if($getIdTk==1)
			{
				$this->db->query("UPDATE data_siswa SET id_kelas_1=id_kelas, id_tahun_1='".$tahun."' WHERE id='".$au."'  ");
			}elseif($getIdTk==2)
			{
				$this->db->query("UPDATE data_siswa SET id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$au."'  ");
			}else
			{
				$this->db->query("UPDATE data_siswa SET id_kelas_3=id_kelas, id_tahun_3='".$tahun."' WHERE id='".$au."'  ");
			}
	 	
	  	
						return $var;
			}else{
					   $file["hp"]=true; 
				return $file;
			}
				
		}else{
			$tahun=$this->m_reff->tahun();
				if($aksi_edit=="true"){ 			
						$id_siswa=$this->input->post("id_siswa");				
						$pass=$this->input->post("password_ortu");				
					 
						$data_ort2=array(
						"_uid"=>$idu,
						"_utime"=>date("Y-m-d H:i:s"),
						"password"=>md5($pass),
						"alias"=>"s3".$pass."s5",
						);
							$pass=$this->input->post("password");
						$stsdata=$this->input->post("f[id_sts_data]");
						
						if($stsdata==2 or $stsdata==3  or $stsdata==5)
						{
							$aktifasi=2;
							$tahun_keluar=$tahun;
						}else{
							$aktifasi=1;
							$tahun_keluar=null;
						}
							
						
						if ($this->input->post("f[id_sts_data]") == "3" || $this->input->post("f[id_sts_data]") == "5") {
							$tgl_keluar = $this->toTglSys($_POST["tgl_update_sts2"]);

						}
						else{
							$tgl_keluar = "";
						}
						$array_tambahan_siswa=array(
								"aktifasi"=>$aktifasi,
								"id_tahun_keluar"=>$tahun_keluar,
								"_uid"=>$idu,
								"_utime"=>date("Y-m-d H:i:s"),
								"tgl_lahir"=>$tgl,
								"password"=>md5($pass),
								"alias"=>"a3".$pass."45",
								"id"=>$nis,
								"tgl_update_sts" => $tgl_keluar
								);  
								
								
								
						 $this->db->where("id",$id_siswa);
						 $data=array_merge($data,$array_tambahan_siswa);
						 $this->db->$insert($this->tbl_log,$data);
								
								
						$data_ort=$this->input->post("g");
						$data_ort=$this->security->xss_clean($data_ort);
		
						$data_ortu=array_merge($data_ort,$data_ort2);
						$this->db->where("id_siswa",$id_siswa); 
						$this->db->update("data_ortu",$data_ortu);
						
						$getIdTk=$this->input->post("id_tingkat");
						if($getIdTk==1)
						{
							$this->db->query("UPDATE data_siswa SET id_kelas_2=null,id_tahun_2=null,id_kelas_3=null,id_tahun_3=null,id_kelas_1=id_kelas, id_tahun_1='".$tahun."' WHERE id='".$id_siswa."'  ");
						}elseif($getIdTk==2)
						{
							$this->db->query("UPDATE data_siswa SET id_kelas_3=null,id_tahun_3=null,id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$id_siswa."'  ");
						}else
						{
							$this->db->query("UPDATE data_siswa SET id_kelas_3=id_kelas, id_tahun_3='".$tahun."' WHERE id='".$id_siswa."'  ");
						}
						
						
				return $var;


				}else{
						//	$like=$this->db->query("SHOW TABLE STATUS LIKE 'data_siswa'")->row();
							$idsiswa=$nis;//($like->Auto_increment);	
							 
								if ($_POST["id_sts_data"] == "3" || $_POST["id_sts_data"] == "5") {
									$tgl_keluar = $this->toTglSys($_POST["tgl_update_sts"]);
								}
								else{
									$tgl_keluar = "";
								}

							$pass=$this->input->post("password");
						$array_tambahan_siswa=array(
								"_cid"=>$idu,
								"_ctime"=>date("Y-m-d H:i:s"),
								"tgl_lahir"=>$tgl,
								"password"=>md5($pass),
								"alias"=>"a3".$pass."45",
								"id"=>$nis,
								"tgl_update_sts"	=> $tgl_keluar,
								"id_sts_data"		=> $_POST["id_sts_data"]
								);  
								
						  $pass_ortu=$this->input->post("password_ortu");			
						$data_ort2=array(
						"id_siswa"=>$idsiswa,
						"_cid"=>$idu,
						"password"=>md5($pass_ortu),
						"alias"=>"s3".$pass_ortu."s5",
						);
						
					 
						 $data=array_merge($data,$array_tambahan_siswa);
						 $this->db->$insert($this->tbl_log,$data);
						 
						 $data_ort=$this->input->post("g");
						$data_ort=$this->security->xss_clean($data_ort);
						$data_ort=array_merge($data_ort,$data_ort2);
					 
						$this->db->$insert("data_ortu",$data_ort);
						
						$tahun=$this->m_reff->tahun();
					//	$au=$this->db->query("SHOW TABLE STATUS WHERE `Name` = 'data_siswa'")->row();
						$au=$nis;//($au->Auto_increment-1);
						$getIdTk=$this->input->post("getIdTk");
						if($getIdTk==1)
						{
							$this->db->query("UPDATE data_siswa SET id_kelas_1=id_kelas, id_tahun_1='".$tahun."' WHERE id='".$au."'  ");
						}elseif($getIdTk==2)
						{
							$this->db->query("UPDATE data_siswa SET id_kelas_2=id_kelas, id_tahun_2='".$tahun."' WHERE id='".$au."'  ");
						}else
						{
							$this->db->query("UPDATE data_siswa SET id_kelas_3=id_kelas, id_tahun_3='".$tahun."' WHERE id='".$au."'  ");
						}
	 	
		
		
						return $var;
				
				}
				
		}
		
		
		
		
	}
	
    public function toTglSys($v){
        $tgl = substr($v, 0,2);
        $bln = substr($v, 3,2);
        $thn = substr($v, 6,4);

        return $thn."-".$bln."-".$tgl;
    }

	 
	function getTagihan($nis)
	{
			$now=date("Y-m-d");
			$query="select * from ".$this->tbl_tagihan." where nis='".$nis."' and sts!='3'  ";
	return		$this->db->query($query)->result();
	}
	function telahDibayar($id)
	{
			$this->db->select("SUM(nominal) as jml");
			$this->db->where("id_tagihan",$id);
			$this->db->where("sts",3);
	return	$this->db->get($this->tbl_bayar)->row()->jml;
	}
}