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
						  
				 		  
		$cari=$this->input->post("cari");
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
			
		} 
		 
		if($gender)
		{
			$filter.="AND jk='".$gender."' ";
		} 
		
		 
		$query="select * from ".$this->tbl." where aktifasi=1 and id_tahun_keluar is null $filter ";
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
	{		$this->load->library("PHPExcel");
		$insert=0;$gagal=0;$edit=0;$validasi_hp=true;$validasi=true;
		$file   = explode('.',$_FILES[$file_form]['name']);
		$length = count($file);
		if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){
         $tmp    = $_FILES[$file_form]['tmp_name']; 
	 
			    $load = PHPExcel_IOFactory::load($tmp);
                $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
				$i=1;
					 
				foreach ($sheets as $sheet) {
				if ($i > 1) {						
						//$penom=0;
						$nama=isset($sheet[1])?($sheet[1]):"";
						$jk=isset($sheet[2])?($sheet[2]):"";
						$tempat_lahir=isset($sheet[3])?($sheet[3]):"";
						$tempat_lahir=str_replace("`","",$tempat_lahir);
					
							$tgl_lahir=isset($sheet[4])?($sheet[4]):"";
							$tgl_lahir=str_replace("`","",$tgl_lahir);
							$tgl_lahir=$this->tanggal->eng_($tgl_lahir,"-");
						$nis=isset($sheet[5])?($sheet[5]):"";
						$nis=str_replace("`","",$nis);
						
						$nisn=isset($sheet[6])?($sheet[6]):"";
						$nisn=str_replace("`","",$nisn);
						
						$nik=isset($sheet[7])?($sheet[7]):"";
						$nik=str_replace("`","",$nik);
						
						$id_kelas=isset($sheet[8])?($sheet[8]):"";
						$id_tahun_masuk=isset($sheet[9])?($sheet[9]):"";
						
						$id_agama=isset($sheet[10])?($sheet[10]):"";
						$hp=$this->m_reff->hp(isset($sheet[11])?($sheet[11]):"");
						$email=isset($sheet[12])?($sheet[12]):"";
						$alamat=isset($sheet[13])?($sheet[13]):"";
						$asal_sd=isset($sheet[14])?($sheet[14]):"";
						$lulus_sd=isset($sheet[15])?($sheet[15]):"";
						$asal_smp=isset($sheet[16])?($sheet[16]):"";
						$lulus_smp=isset($sheet[17])?($sheet[17]):"";
						
						$nama_ayah=isset($sheet[18])?($sheet[18]):"";
						$hp_ayah=$this->m_reff->hp(isset($sheet[19])?($sheet[19]):"");
						$id_pekerjaan_ayah=isset($sheet[20])?($sheet[20]):"";
						$id_status_ayah=isset($sheet[21])?($sheet[21]):"";
						$nama_ibu=isset($sheet[22])?($sheet[22]):"";
						$hp_ibu=$this->m_reff->hp(isset($sheet[23])?($sheet[23]):"");
						
						$id_pekerjaan_ibu=isset($sheet[24])?($sheet[24]):"";
						$id_status_ibu=isset($sheet[25])?($sheet[25]):"";
						$alamat_ortu=isset($sheet[26])?($sheet[26]):"";
						$id_penghasilan=isset($sheet[27])?($sheet[27]):"";
						$nama_wali=isset($sheet[28])?($sheet[28]):"";
						$hp_wali=isset($sheet[29])?($sheet[29]):"";
						$hubungan=isset($sheet[30])?($sheet[30]):"";
					  
						if(!$nis){ 	 $var["nis"]=false; $var["validasi"]=false;	return $var; }
						
						$cek_idkelas=$this->cek_idkelas($id_kelas);
						if(!$cek_idkelas){ $var["id_kelas"]=false; $var["validasi"]=false; return $var; }
						
						$cek_idtahun=$this->cek_idtahunmasuk($id_tahun_masuk);
						if(!$cek_idkelas){ $var["id_tahun_masuk"]=false; $var["validasi"]=false; return $var; }
						 
						$cek_nis=$this->cek_nis($nis);
						if($cek_nis){
								
								$dataray=array(
								"alias"=>"in".$nis."ft",
								"username"=>$nis,
								"password"=>md5($nis),
								"nama"=>$nama,
								"alamat"=>$alamat,
								"hp"=>$hp,
								"jk"=>$jk,
								"nis"=>$nis,
								"email"=>$email,
								"id_tahun_masuk"=>$id_tahun_masuk,
								"id_kelas"=>$id_kelas,
								"id_agama"=>$id_agama,
								"tempat_lahir"=>$tempat_lahir,
								"tgl_lahir"=>$tgl_lahir,
								"nisn"=>$nisn,
								"nik"=>$nik,
								
								"asal_sd"=>$asal_sd,
								"tahun_lulus_sd"=>$lulus_sd,
								"asal_smp"=>$asal_smp,
								"tahun_lulus_smp"=>$lulus_smp,
								
								"nama_wali"=>$nama_wali,
								"hp_wali"=>$hp_wali,
								"hubungan"=>$hubungan,
								 
								"_uid"=>$this->idu(),
								"_utime"=>date("Y-m-d H:i:s")								
								);
								
							$this->update_siswa($dataray);
							
							
							$dataray=array(
								"alias"=>"in12345ft",
								"username"=>$nis,
								"password"=>md5("12345"),
								
								"nama_ibu"=>$nama_ibu,
								"hp_ibu"=>$hp_ibu,
								"id_pekerjaan_ibu"=>$id_pekerjaan_ibu,
								"nama_ayah"=>$nama_ayah,
								"hp_ayah"=>$hp_ayah,
								"id_pekerjaan_ayah"=>$id_pekerjaan_ayah,
								"id_status_ayah"=>$id_status_ayah,
								"id_status_ibu"=>$id_status_ibu,
								
								"id_penghasilan"=>$id_penghasilan,
								"alamat_ortu"=>$alamat_ortu,
							//	"nis_siswa"=>$nis,
								"id_siswa"=>$cek_nis->id_siswa,
								 
								"_uid"=>$this->idu(),
								"_utime"=>date("Y-m-d H:i:s")
								);
							$this->update_ortu($dataray);
							$edit++;
						}else{
							$dataray=array(
								"alias"=>"in".$nis."ft",
								"username"=>$nis,
								"password"=>md5($nis),
								"nama"=>$nama,
								"alamat"=>$alamat,
								"hp"=>$hp,
								"jk"=>$jk,
								"nis"=>$nis,
								"nisn"=>$nisn,
								"nik"=>$nik,
								"email"=>$email,
								"id_tahun_masuk"=>$id_tahun_masuk,
								"id_kelas"=>$id_kelas,
								"id_agama"=>$id_agama,
								"tempat_lahir"=>$tempat_lahir,
								"tgl_lahir"=>$tgl_lahir,
								
								"asal_sd"=>$asal_sd,
								"tahun_lulus_sd"=>$lulus_sd,
								"asal_smp"=>$asal_smp,
								"tahun_lulus_smp"=>$lulus_smp,
								
								"nama_wali"=>$nama_wali,
								"hp_wali"=>$hp_wali,
								"hubungan"=>$hubungan,
								 
								"_cid"=>$this->idu(),
								"_ctime"=>date("Y-m-d H:i:s")								
								);
								
						
							$this->insert_siswa($dataray,$idsiswa);
							
							$like=$this->db->query("SHOW TABLE STATUS LIKE 'data_siswa'")->row();
							$idsiswa=($like->Auto_increment-1);	
							
							$dataray=array(
								"alias"=>"in12345ft",
								"username"=>$nis,
								"password"=>md5("12345"),
								"id_siswa"=>$idsiswa,
								
								"nama_ibu"=>$nama_ibu,
								"hp_ibu"=>$hp_ibu,
								"id_pekerjaan_ibu"=>$id_pekerjaan_ibu,
								"nama_ayah"=>$nama_ayah,
								"hp_ayah"=>$hp_ayah,
								"id_pekerjaan_ayah"=>$id_pekerjaan_ayah,
								"id_status_ayah"=>$id_status_ayah,
								"id_status_ibu"=>$id_status_ibu,
								
								"id_penghasilan"=>$id_penghasilan,
								"alamat_ortu"=>$alamat_ortu,
							//	"nis_siswa"=>$nis,
								 
								"_cid"=>$this->idu(),
								"_ctime"=>date("Y-m-d H:i:s")
								);
							$this->insert_ortu($dataray);
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
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('T')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('U')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('V')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('W')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('X')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('Y')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('Z')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('AA')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('AB')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('AC')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('AD')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('AE')->setAutoSize(true);


//create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'NO');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'NAMA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'ID GENDER');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'TEMPAT LAHIR');
        $objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'TANGGAL LAHIR');
        $objPHPExcel->getActiveSheet(0)->setCellValue('F1', 'NIS');
        $objPHPExcel->getActiveSheet(0)->setCellValue('G1', 'NISN');
        $objPHPExcel->getActiveSheet(0)->setCellValue('H1', 'NIK');
        $objPHPExcel->getActiveSheet(0)->setCellValue('I1', 'ID KELAS');
        $objPHPExcel->getActiveSheet(0)->setCellValue('J1', 'ID TAHUN MASUK AJARAN');
        $objPHPExcel->getActiveSheet(0)->setCellValue('K1', 'ID AGAMA');

        $objPHPExcel->getActiveSheet(0)->setCellValue('L1', 'HP');
        $objPHPExcel->getActiveSheet(0)->setCellValue('M1', 'EMAIL');
        $objPHPExcel->getActiveSheet(0)->setCellValue('N1', 'ALAMAT');
        $objPHPExcel->getActiveSheet(0)->setCellValue('O1', 'ASAL SD');
        $objPHPExcel->getActiveSheet(0)->setCellValue('P1', 'LULUS SD');
        $objPHPExcel->getActiveSheet(0)->setCellValue('Q1', 'ASAL SMP');
        $objPHPExcel->getActiveSheet(0)->setCellValue('R1', 'LULUS SMP');
		
        $objPHPExcel->getActiveSheet(0)->setCellValue('S1', 'NAMA AYAH');
        $objPHPExcel->getActiveSheet(0)->setCellValue('T1', 'NO.HP AYAH');
        $objPHPExcel->getActiveSheet(0)->setCellValue('U1', 'PEKERJAAN (AYAH)');
        $objPHPExcel->getActiveSheet(0)->setCellValue('V1', 'STATUS AYAH');
        $objPHPExcel->getActiveSheet(0)->setCellValue('W1', 'NAMA IBU');
        $objPHPExcel->getActiveSheet(0)->setCellValue('X1', 'NO.HP IBU');
        $objPHPExcel->getActiveSheet(0)->setCellValue('Y1', 'PEKERJAAN(IBU)');
        $objPHPExcel->getActiveSheet(0)->setCellValue('Z1', 'STATUS IBU');
        $objPHPExcel->getActiveSheet(0)->setCellValue('AA1', 'ALAMAT ORANG TUA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('AB1', 'ID PENGHASILAN');
        $objPHPExcel->getActiveSheet(0)->setCellValue('AC1', 'NAMA WALI');
        $objPHPExcel->getActiveSheet(0)->setCellValue('AD1', 'NO HP WALI');
        $objPHPExcel->getActiveSheet(0)->setCellValue('AE1', 'HUBUNGAN WALI DENGAN SISWA');
 
		////------------------------///
        $objPHPExcel->getActiveSheet(0)->setCellValue('E2', 'contoh:2018/06/30');
     //   $objPHPExcel->getActiveSheet(0)->setCellValue('P2', 'contoh:2018/2019');
      //  $objPHPExcel->getActiveSheet(0)->setCellValue('R2', 'contoh:2018/2019');
       
        $objPHPExcel->getActiveSheet(0)->setCellValue('K2', 'Lihat Kode');
        $objPHPExcel->getActiveSheet(0)->setCellValue('I2', 'Lihat Kode');
        $objPHPExcel->getActiveSheet(0)->setCellValue('J2', 'Lihat Kode');
      //  $objPHPExcel->getActiveSheet(0)->setCellValue('L2', 'Lihat Kode');
        $objPHPExcel->getActiveSheet(0)->setCellValue('V2', 'Lihat Kode');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C2', 'Di isi L untuk laki - laki');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C3', 'Di isi P untuk perempuan');
        $objPHPExcel->getActiveSheet(0)->setCellValue('U2', 'Lihat Kode');
  
        $objPHPExcel->getActiveSheet(0)->setCellValue('V2', 'Disini 1 jika masih ada');
        $objPHPExcel->getActiveSheet(0)->setCellValue('V3', 'Disini 2 jika sudah tidak ada atau almarhum');
        $objPHPExcel->getActiveSheet(0)->setCellValue('Z2', 'Disini 1 jika masih ada');
        $objPHPExcel->getActiveSheet(0)->setCellValue('Z3', 'Disini 2 jika sudah tidak ada atau almarhum');
 
        $objPHPExcel->getActiveSheet(0)->setCellValue('Y2', 'Lihat Kode');
 
        $objPHPExcel->getActiveSheet(0)->setCellValue('AB2', 'Lihat Kode');
        $objPHPExcel->getActiveSheet(0)->setCellValue('AC2', 'Di isi jika orang tua tidak ada');
        $objPHPExcel->getActiveSheet(0)->setCellValue('AD2', 'Di isi jika orang tua tidak ada');
        $objPHPExcel->getActiveSheet(0)->setCellValue('AE2', 'Di isi jika orang tua tidak ada');
		///------------------------///
		
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:AE1')->applyFromArray($style);
      
 
// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA SISWA');
		
 
//<!-------------------------------------------------------------------------------  --->		
      
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID AGAMA');
		$get=1;
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
 
//<!-------------------------------------------------------------------------------  --->	
		$get=2;	
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID KELAS');
        $objPHPExcel->addSheet($myWorkSheet,$get);
 
 
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
	
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID TAHUN');
		$get=3;
        $objPHPExcel->addSheet($myWorkSheet, $get);
 
 
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('B')->setAutoSize(true);
    
        $objPHPExcel->getSheet($get)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet($get)->setCellValue('B1', 'TAHUN');
        
        $objPHPExcel->getSheet($get)->getStyle('A1:B1')->applyFromArray($style);
		
        $datamapel = $this->db->query("select * from tr_tahun_ajaran order by id desc limit 2")->result();
        $shit = 1;
        foreach ($datamapel as $listt) {
            $shit++;
            $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', $listt->id);
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', $listt->nama);
           
			
        }
		 
//<!-------------------------------------------------------------------------------------->	
  //<!-------------------------------------------------------------------------------  --->		
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
		 
//<!-------------------------------------------------------------------------------------->	      
		$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID PENGHASILAN');
		$get=5;
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
							$like=$this->db->query("SHOW TABLE STATUS LIKE 'data_siswa'")->row();
							$idsiswa=($like->Auto_increment);	
							
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
								
								$array_tambahan_siswa=array(
								"_uid"=>$idu,
								"_utime"=>date("Y-m-d H:i:s"),
								"tgl_lahir"=>$tgl,
								"password"=>md5($pass),
								"alias"=>"a3".$pass."45",
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
								
								$array_tambahan_siswa=array(
								"_cid"=>$idu,
								"tgl_lahir"=>$tgl,
								"password"=>md5($pass),
								"alias"=>"a3".$pass."45",
								);  
						}
						$data=array_merge($array_tambahan_siswa,$data);
						if($aksi_edit=="true"){ $id_siswa=$this->input->post("id_siswa"); $this->db->where("id",$id_siswa); }
						$this->db->$insert($this->tbl_log,$data);
						///
						
						$data_ortu=array_merge($data_ort,$data_ort2);
						
						if($aksi_edit=="true"){ $id_siswa=$this->input->post("id_siswa"); $this->db->where("id_siswa",$id_siswa); }
						$this->db->$insert("data_ortu",$data_ortu);
						return $var;
			}else{
					   $file["hp"]=true; 
				return $file;
			}
				
		}else{
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
						$array_tambahan_siswa=array(
								"_uid"=>$idu,
								"_utime"=>date("Y-m-d H:i:s"),
								"tgl_lahir"=>$tgl,
								"password"=>md5($pass),
								"alias"=>"a3".$pass."45",
								);  
								
								
								
						 $this->db->where("id",$id_siswa);
						 $data=array_merge($data,$array_tambahan_siswa);
						 $this->db->$insert($this->tbl_log,$data);
								
						$data_ort=$this->input->post("g");
						$data_ort=$this->security->xss_clean($data_ort);
		
						$data_ortu=array_merge($data_ort,$data_ort2);
						$this->db->where("id_siswa",$id_siswa); 
						$this->db->update("data_ortu",$data_ortu);
						
						
						
						
				return $var;


				}else{
							$like=$this->db->query("SHOW TABLE STATUS LIKE 'data_siswa'")->row();
							$idsiswa=($like->Auto_increment);	
							 
							$pass=$this->input->post("password");
						$array_tambahan_siswa=array(
								"_cid"=>$idu,
								"_ctime"=>date("Y-m-d H:i:s"),
								"tgl_lahir"=>$tgl,
								"password"=>md5($pass),
								"alias"=>"a3".$pass."45",
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
						return $var;
				
				}
				
		}
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