<?php

class Model_pendidik extends CI_Model  {
    
 
	var $tbl_jadwal="tm_jadwal_mengajar";
	var $tbl="v_pegawai";
	var $tbl_log="data_pegawai";
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
		$id_kelas=$this->input->post("id_kelas");
		$id_mapel=$this->input->post("id_mapel");
		$sts=$this->input->post("sts");
		$gender=$this->input->post("gender");
		$jabatan=$this->input->post("jabatan");
		$aktifasi=$this->input->post("aktifasi");
		$pangkat=$this->input->post("pangkat");
		 
		$filter="";
		if($jabatan)
		{
			$filter.="AND id_jabatan='".$jabatan."' ";
		}
		else{
			$filter.="AND (id_jabatan='3' OR id_jabatan='15')";
		} 

		if($pangkat)
		{
			$filter.="AND id_pangkat='".$pangkat."' ";
		} 
		
		if($aktifasi)
		{
			$filter.="AND aktifasi='".$aktifasi."' ";
		} 
		if($id_mapel)
		{
			$filter.="AND id_mapel like ('%".$id_mapel."%') ";
		} 
		if($id_kelas)
		{
			$filter.="AND id_kelas='".$id_kelas."' ";
		} 
		if($sts)
		{
			$filter.="AND sts_kepegawaian='".$sts."' ";
		} 
		if($gender)
		{
			$filter.="AND jk='".$gender."' ";
		} 
		
		 
		$query="select * from ".$this->tbl." where 1=1  $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				nip LIKE '%".$searchkey."%'  or
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
		$query.=" order by id   DESC";
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
	 
	 
	function getDataMapel($id)
	{
		$data=explode(",",$id); $mapel="";
		foreach($data as $val)
		{
			$mapel.=$this->m_reff->goField("tr_mapel","nama","where id='".$val."' ").",";
		}
		return substr($mapel,0,-1);
	}		
	  
	function import_data_guru()
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
				return $this->importFileGuru("file");
			 
		}else{
				return $var;
		}
		
	}
	
	function cek_nip($nip)
	{
	 return	$this->db->get_where($this->tbl,array("nip"=>$nip))->num_rows();
	}
	
	function importFileGuru($file_form)
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
						$hp=str_replace("'","",$sheet[7]); //hp
						$hp=str_replace("`","",$hp);
						$hp=str_replace("+62","0",$hp);
						 
						$nip=$this->m_reff->sheet($sheet,5);
						$nama=isset($sheet[1])?($sheet[1]):"";
						$kodesistem=$this->m_reff->sheet($sheet,3);
						$nuptk=$this->m_reff->sheet($sheet,6);
						$alamat=isset($sheet[9])?($sheet[9]):"";
						$jk=isset($sheet[2])?($sheet[2]):"";
						$email=isset($sheet[8])?($sheet[8]):"";
						$tmt=$this->m_reff->sheet($sheet,11);
					 	$tmt=$this->tanggal->format($tmt);
						$id_pangkat=$this->m_reff->sheet($sheet,4);
						$id_jabatan=$this->m_reff->sheet($sheet,13);
						$sts_kepegawaian=$this->m_reff->sheet($sheet,12);
						$id_kelas=$this->m_reff->sheet($sheet,10);
						$id_mapel=isset($sheet[3])?($sheet[3]):"";
						 $id_ijazah=isset($sheet[14])?($sheet[14]):"";
						 $tempat_lahir=$this->m_reff->sheet($sheet,15);
					 	 
						 $tgl_lahir=$this->m_reff->sheet($sheet,16);
						 $tgl_lahir=$this->tanggal->format($tgl_lahir);
						  
						 $gelar_depan=$this->m_reff->sheet($sheet,17);
						 $gelar_belakang=$this->m_reff->sheet($sheet,18);
					 
					//	if(!$hp){ 	 $var["hp"]=false; $var["validasi"]=false;	return $var; }
						if(!$kodesistem){ 	 $var["gagal"]=false;  $var["info"]="kode sistem mohon di isi"; $var["validasi"]=false;	return $var; }
					
						 
						$cek_nip=$this->cek_nip($kodesistem);
						if($cek_nip){
								
								$dataray=array(
								"alias"=>"de".$kodesistem."vi",
								"nama"=>$nama,
								"nip_asli"=>$nip,
								"nip"=>$kodesistem,
								"nuptk"=>$nuptk,
								"alamat"=>$alamat,
								"email"=>$email,
								"hp"=>$hp,
								"jk"=>$jk,
								"tmt"=>$tmt,
								"id_pangkat"=>$id_pangkat,
								"id_jabatan"=>$id_jabatan,
								"sts_kepegawaian"=>$sts_kepegawaian,
								"id_kelas"=>$id_kelas,
								"id_mapel"=>$id_mapel,
									"id_ijazah"=>$id_ijazah,
									"tempat_lahir"=>$tempat_lahir,
									"tgl_lahir"=>$tgl_lahir,
									"gelar_depan"=>$gelar_depan,
									"gelar_belakang"=>$gelar_belakang,
								"_uid"=>$this->idu(),
								"_utime"=>date("Y-m-d H:i:s"),
								
								);
								
							$this->update_peserta($dataray);
							$edit++;
						}else{
							$dataray=array(
								"username"=>$kodesistem,
								"password"=>md5($kodesistem),
								"alias"=>"de".$kodesistem."vi",
								"nama"=>$nama,
								"nip"=>$kodesistem,
								"nip_asli"=>$nip,
								"nuptk"=>$nuptk,
								"alamat"=>$alamat,
								"email"=>$email,
								"hp"=>$hp,
								"jk"=>$jk,
								"tmt"=>$tmt,
								"id_pangkat"=>$id_pangkat,
							 	"id_jabatan"=>$id_jabatan,
								"sts_kepegawaian"=>$sts_kepegawaian,
								"id_kelas"=>$id_kelas,
								"id_mapel"=>$id_mapel,
									"id_ijazah"=>$id_ijazah,
									"tempat_lahir"=>$tempat_lahir,
									"tgl_lahir"=>$tgl_lahir,
									"gelar_depan"=>$gelar_depan,
									"gelar_belakang"=>$gelar_belakang,
								"_cid"=>$this->idu(),
								);
								
							$this->insert_peserta($dataray);
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
	 
	function insert_peserta($dataray)
	{
		return	$this->db->insert($this->tbl_log,$dataray);
	}
	function update_peserta($dataray)
	{
			$this->db->where("nip",$dataray['nip']);
	return	$this->db->update($this->tbl_log,$dataray);
	}
	 
	 
	 
	 
	 
	 
	 
	 
	 
	function hapus_pendidik()
	{			
					$id=$this->input->post("id");
			//		$nama_file=$this->m_reff->goField($this->tbl_log,"poto","where id='".$id."'");
			//		$this->m_reff->hapus_file("file_upload/dp/".$nama_file."");
					$noid=$this->m_reff->goField($this->tbl_log,"nip","where id='".$id."'");
					
					$this->db->where("id",$id);
					$this->db->delete($this->tbl_log);
		
					$this->db->where("id_admin",$id);
					$this->db->delete("tm_cbt");
					
					$this->db->where("id_guru",$id);
					$this->db->delete("data_materi");
					
					$this->db->where("id_admin",$id);
					$this->db->delete("data_cbt");
					
				//	$this->db->where("noid",$noid);
				//	$this->db->delete("tm_izin_kehadiran");
					
					$this->db->where("noid",$noid);
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
	
	
	function download_format_guru()
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


//create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'NO');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'NAMA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'ID GENDER');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'KODE SISTEM');
        $objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'ID PANGKAT/GOL');
        $objPHPExcel->getActiveSheet(0)->setCellValue('F1', 'NIP');
        $objPHPExcel->getActiveSheet(0)->setCellValue('G1', 'NUPTK');

        $objPHPExcel->getActiveSheet(0)->setCellValue('H1', 'HP');
        $objPHPExcel->getActiveSheet(0)->setCellValue('I1', 'EMAIL');
        $objPHPExcel->getActiveSheet(0)->setCellValue('J1', 'ALAMAT');
        $objPHPExcel->getActiveSheet(0)->setCellValue('K1', 'ID KELAS');
        $objPHPExcel->getActiveSheet(0)->setCellValue('L1', 'TMT');
        $objPHPExcel->getActiveSheet(0)->setCellValue('M1', 'ID STATUS KEPEGAWAIAN');
        $objPHPExcel->getActiveSheet(0)->setCellValue('N1', 'ID JABATAN');
		
        $objPHPExcel->getActiveSheet(0)->setCellValue('O1', 'ID IJAZAH');
        $objPHPExcel->getActiveSheet(0)->setCellValue('P1', 'TEMPAT LAHIR');
        $objPHPExcel->getActiveSheet(0)->setCellValue('Q1', 'TANGGAL LAHIR');
        $objPHPExcel->getActiveSheet(0)->setCellValue('R1', 'GELAR DEPAN');
        $objPHPExcel->getActiveSheet(0)->setCellValue('S1', 'GELAR BELAKANG');
		////------------------------///
        $objPHPExcel->getActiveSheet(0)->setCellValue('L2', 'contoh:2018/06/30');
        $objPHPExcel->getActiveSheet(0)->setCellValue('Q2', 'contoh:2018/06/30');
		///------------------------///
		
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:S1')->applyFromArray($style);
      
 
// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA GURU');
		
						
//<!-------------------------------------------------------------------------------  --->		
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID GENDER');
        $objPHPExcel->addSheet($myWorkSheet, 1);
  
        $objPHPExcel->getSheet(1)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet(1)->setCellValue('B1', 'GENDER');
        $objPHPExcel->getSheet(1)->getStyle('A1:B1')->applyFromArray($style);
		 
            $objPHPExcel->getSheet(1)->setCellValue('A2',"L");
            $objPHPExcel->getSheet(1)->setCellValue('B2', "Laki-Laki");
			$objPHPExcel->getSheet(1)->setCellValue('A3',"P");
            $objPHPExcel->getSheet(1)->setCellValue('B3', "Perempuan");
       
//<!-------------------------------------------------------------------------------------->	
 
//<!-------------------------------------------------------------------------------  --->		
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID MAPEL');
        $objPHPExcel->addSheet($myWorkSheet, 2);
 
 
        $objPHPExcel->getSheet(2)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(2)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(2)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet(2)->setCellValue('B1', 'Nama Mata Pelajaran');
        $objPHPExcel->getSheet(2)->getStyle('A1:B1')->applyFromArray($style);
		
        $datamapel = $this->db->get("tr_mapel")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getSheet(2)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getSheet(2)->setCellValue('B' . $shit . '', $list->nama);
			
			
        }
		 
//<!-------------------------------------------------------------------------------------->	
  //<!-------------------------------------------------------------------------------  --->		
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID PANGKAT');
        $objPHPExcel->addSheet($myWorkSheet, 3);
 
 
        $objPHPExcel->getSheet(3)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(3)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(3)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet(3)->setCellValue('B1', 'PANGKAT/GOL');
        $objPHPExcel->getSheet(3)->getStyle('A1:B1')->applyFromArray($style);
		
        $datamapel = $this->db->get("tr_pangkat")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getSheet(3)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getSheet(3)->setCellValue('B' . $shit . '', $list->nama);
			
			
        }
		 
//<!-------------------------------------------------------------------------------------->	      
		$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID KELAS');
        $objPHPExcel->addSheet($myWorkSheet, 4);
 
 
        $objPHPExcel->getSheet(4)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(4)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(4)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet(4)->setCellValue('B1', 'KELAS');
        $objPHPExcel->getSheet(4)->getStyle('A1:B1')->applyFromArray($style);
				
        $datamapel = $this->db->query("select * from v_kelas order by id_tk,id_jurusan,id")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getSheet(4)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getSheet(4)->setCellValue('B' . $shit . '', $list->nama);
			
			
        }
		 
//<!-------------------------------------------------------------------------------------->	
		$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID STS PEGAWAI');
        $objPHPExcel->addSheet($myWorkSheet, 5);
 
 
        $objPHPExcel->getSheet(5)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(5)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(5)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet(5)->setCellValue('B1', 'STATUS');
        $objPHPExcel->getSheet(5)->getStyle('A1:B1')->applyFromArray($style);
				
        $datamapel = $this->db->query("select * from tr_sts_pegawai")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getSheet(5)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getSheet(5)->setCellValue('B' . $shit . '', $list->nama);
        }
		 
//<!-------------------------------------------------------------------------------------->	
	$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID JABATAN');
        $objPHPExcel->addSheet($myWorkSheet, 6);
 
 
        $objPHPExcel->getSheet(6)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(6)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(6)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet(6)->setCellValue('B1', 'JABATAN');
        $objPHPExcel->getSheet(6)->getStyle('A1:B1')->applyFromArray($style);
				
        $datajabatan = $this->db->query("select * from tr_jabatan")->result();
        $shit = 1;
        foreach ($datajabatan as $list) {
            $shit++;
            $objPHPExcel->getSheet(6)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getSheet(6)->setCellValue('B' . $shit . '', $list->nama);
        }
		 
//<!-------------------------------------------------------------------------------------->	
		$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID IJAZAH');
        $objPHPExcel->addSheet($myWorkSheet, 7);
 
 
        $objPHPExcel->getSheet(7)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(7)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(7)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet(7)->setCellValue('B1', 'IJAZAH');
        $objPHPExcel->getSheet(7)->getStyle('A1:B1')->applyFromArray($style);
				
        $datajabatan = $this->db->query("select * from tr_ijazah")->result();
        $shit = 1;
        foreach ($datajabatan as $list) {
            $shit++;
            $objPHPExcel->getSheet(7)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getSheet(7)->setCellValue('B' . $shit . '', $list->nama);
        }
		 
//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format-upload-guru.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
	
	function input_data_guru()
	{
		$var=array();
		$var["hp"]=true; 
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		$var["nip_duplicate"]=false; 
		
		$nip=$this->input->post("nip");
		$ceknip=$this->cek_nip($nip);
		if($ceknip)
		{
			$var["gagal"]=false; 
			$var["info"]="GAGAL!!<bR>ID SISTEM/NIP sudah ada.";
			return $var;
		}
		 
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		
		
		
				
				$tmt=$this->input->post("tmt");
				$tgl=$this->input->post("tgl_lahir");
			 	$hp=$this->input->post("hp");
				$tgl=$this->tanggal->eng_($tgl,"-");
				$tmt=$this->tanggal->eng_($tmt,"-");
				
				$mapel=$this->input->post("mapel[]"); 
				$dm="";
				if($mapel)
				{
					foreach($mapel as $val)
					{
						$dm.=$val.",";
					}
					$dm=substr($dm,0,-1);
				}else{
					$dm="";
				}
				
				
			 	$this->db->set("id_mapel",$dm);
			 	$this->db->set("_cid",$idu);
			 	$n=$this->input->post("n");
				$ene="";
				if(count($n)){
					foreach($n as $en)
					{
						$ene.=$en.",";
					}
				}
			 	$this->db->set("multiakun",$ene);
				$this->db->set("hp",$hp);
				$this->db->set("tmt",$tmt);
				$this->db->set("nip",$nip);
				$this->db->set("tgl_lahir",$tgl);
				$this->db->set("id_jabatan",3);
				$this->db->set("username",$nip);
				$this->db->set("password",md5($nip));
				$this->db->set("alias","a3".$nip."45");
	  
				
		
		
		
		if(isset($_FILES["file"]['tmp_name']))
		{
			$file=$this->m_reff->upload_file("file","dp",$idu,"JPG,PNG,JPEG","1000000");
			if($file["validasi"]!=false)
			{
						$this->db->set("poto",$file["name"]);
						$this->db->insert($this->tbl_log,$data);
						return $var;
			}else{
					   $file["hp"]=true; 
				return $file;
			}
				
		}else{
				$this->db->insert($this->tbl_log,$data);
				return $var;
		}
	}
	
	
	 function update_data_guru()
	{
		$var=array();
		$var["hp"]=true; 
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		$var["nip_duplicate"]=false; 
		
		$nip=$this->input->post("nip");
		  
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		
				$tmt=$this->input->post("tmt");
				$tgl=$this->input->post("tgl_lahir");
			 	$hp=$this->input->post("hp");
				$tgl=$this->tanggal->eng_($tgl,"-");
				$tmt=$this->tanggal->eng_($tmt,"-");
				
				$mapel=$this->input->post("mapel[]"); 
				$dm="";
				if($mapel)
				{
					foreach($mapel as $val)
					{
						$dm.=$val.",";
					}
					$dm=substr($dm,0,-1);
				}else{
					$dm="";
				}
				
				$n=$this->input->post("n");
				$ene="";
				if(count($n)){
					foreach($n as $en)
					{
						$ene.=$en.",";
					}
				}
				
		 	 	$this->db->set("multiakun",$ene);
			 	$this->db->set("_uid",$idu);
			 	$this->db->set("_utime",date("Y-m-d H:i:s"));
			 	
				$this->db->set("hp",$hp);
				$this->db->set("tmt",$tmt);
				$pass=$this->input->post("password");
				$this->db->set("password",md5($pass));
				$this->db->set("alias","vb".$pass."tt");
				 
				$this->db->set("tgl_lahir",$tgl);
				$this->db->set("id_jabatan",3);
				  
				$this->db->where("id",$this->input->post("id"));
				$before_file=$this->input->post("before_file");
		if(isset($_FILES["file"]['tmp_name']))
		{
			$file=$this->m_reff->upload_file("file","dp",$idu,"JPG,PNG,JPEG","1000000",$before_file);
			if($file["validasi"]!=false)
			{
						$this->db->set("poto",$file["name"]);
						$this->db->update($this->tbl_log,$data);
						return $var;
			}else{
					   $file["hp"]=true; 
				return $file;
			}
				
		}else{
				$this->db->update($this->tbl_log,$data);
				return $var;
		}
	}
	function cektahap($id)
	{
		return $this->db->query("select * from data_pegawai where id='".$id."' and tahap4=0 ")->num_rows();
	}
	function status_instal($id)
	{
		if($this->cektahap($id))
		{
			return  '<button  class="btn bg-pink btn-xs waves-effect"> Belum </button>';
		}else{
			return '<button onclick="sudah(`'.$id.'`)" class="btn bg-teal btn-xs waves-effect"> Selesai</button>';
		}
	}
	 
}