<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	function nama_kepsek($tahun)
	{
		return $this->m_reff->goField("tr_tahun_ajaran","nama_kepsek","where id='".$tahun."'");
	}
	function tgl_surat($tahun)
	{
	    	return $this->m_reff->goField("tr_tahun_ajaran","tgl_cetak_un","where id='".$tahun."'");
	}
	function ttd_kepsek($tahun)
	{
		return $this->m_reff->goField("tr_tahun_ajaran","ttd_kepsek","where id='".$tahun."'");
	}
	function no_surat($id,$tahun)
	{         $dp=$this->m_reff->dataProfileSiswa($id); 
	
	    	$return=$this->m_reff->goField("tr_tahun_ajaran","no_surat_un","where id='".$tahun."'");
	    	$r=str_replace("{nis}",$dp->nis,$return);
	    	return	$r=str_replace("{no}",$dp->id,$r);
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
	 	$sts_un=$this->input->post("id_stsdata");
	 
		 
		$filter=" AND aktifasi='1'  and id_tahun_keluar is null";
		
		
		if($sts_un!="")
		{
			$filter.=" AND sts_un='".$sts_un."' ";
		} 
		 
		 
		if($cari)
		{
			$filter.=" AND (
				nama LIKE '%".$cari."%'  or
				nis LIKE '%".$cari."%'  
			 
				) ";
		}
	 
		
		 
		/*if($id_kelas)
		{	$dtkls="";
			foreach($id_kelas as $valk)
			{
				$dtkls.=$valk.",";
			}
			$dtkls=substr($dtkls,0,-1);
			if($dtkls){
			$filterz=" AND id_kelas in (".$dtkls.") ";
			$filter.=str_replace("(,","(",$filterz);
			}
			
		} */
		 
		if($id_kelas)
		{
			$filter.=" AND id_kelas='".$id_kelas."' ";
		}else{
		    	$filter.=" AND id_kelas IN (select id from tm_kelas where id_tk=3) ";
		}
		
		if($gender)
		{
			$filter.=" AND jk='".$gender."' ";
		} 
		
		 
		$query="select * from data_siswa where 1=1 $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				nis LIKE '%".$searchkey."%'  or 
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
		$query.="  order by id_kelas,nama";
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
	
	function setUn()
	{
	    $sts=$this->input->post("pilih");
	    $siswa=$this->input->post("value");
	    $ids="";
	    foreach($siswa as $val){
	        $ids.=$val.",";
	    }
	    $ids=substr($ids,0,-1);
	      $this->db->where("id IN (".$ids.")");
	    $this->db->set("sts_un",$sts); 
	  return  $this->db->update("data_siswa");
	}
	 /*===================================*//*===================================*/
 
 
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
     

//create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'NO');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'KELAS');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'NIS');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'NAMA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'JK');
        $objPHPExcel->getActiveSheet(0)->setCellValue('F1', 'STATUS KELULUSAN');
        $objPHPExcel->getActiveSheet(0)->setCellValue('G1', 'NOMOR UJIAN');
        $objPHPExcel->getActiveSheet(0)->setCellValue('H1', 'KETERANGAN');
       
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:H1')->applyFromArray($style); 
        
        $datasiswa = $this->db->query("select * from data_siswa where id_kelas in (select id from v_kelas where id_tk='3') order by id_kelas,nama")->result();
         $shit = 1; $no=1;$get=0;
        foreach ($datasiswa as $list) {
            $kelas=$this->m_reff->goField("v_kelas","nama","where id='".$list->id_kelas."'");
            $shit++;
            $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', $no++);
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', $kelas);
            $objPHPExcel->getSheet($get)->setCellValue('C' . $shit . '', $list->nis);
            $objPHPExcel->getSheet($get)->setCellValue('D' . $shit . '', $list->nama);
            $objPHPExcel->getSheet($get)->setCellValue('E' . $shit . '', $list->jk);
            $objPHPExcel->getSheet($get)->setCellValue('F' . $shit . '', $list->sts_un);
            $objPHPExcel->getSheet($get)->setCellValue('G' . $shit . '', $list->no_un);
            $objPHPExcel->getSheet($get)->setCellValue('H' . $shit . '', $list->ket_un);
			 
        }
        
        
// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA SISWA');
//<!-------------------------------------------------------------------------------------->	      
		$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'STATUS KELULUSAN');
		$get=1;
        $objPHPExcel->addSheet($myWorkSheet, $get);
 
 
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->setCellValue('A1', 'STATUS');
        $objPHPExcel->getSheet($get)->setCellValue('B1', 'KELULUSAN');
        $objPHPExcel->getSheet($get)->getStyle('A1:B1')->applyFromArray($style); 
         
        $shit = 1; 
            $shit++;
            $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', "1");
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', "LULUS");
             $shit++;
             $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', "2");
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', "TIDAK LULUS");
            $shit++;
             $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', "3");
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', "TIDAK DIINFOKAN");
			 
      
		 
  
//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format-Kelulusan-siswa.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
	function idu()
	{
	    return $this->session->userdata("id");
	}
	function id_kelas()
	{
	   return  $this->m_reff->goField("data_siswa","id_kelas","where id='".$this->idu()."' ");
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
				if ($i > 1) { 
						$nis=isset($sheet[2])?($sheet[2]):"";
							$sts=isset($sheet[5])?($sheet[5]):"";
								$no_un=isset($sheet[6])?($sheet[6]):"";
									$ket_un=isset($sheet[7])?($sheet[7]):""; 
								$dataray=array( 
								"sts_un"=>$sts,
									"ket_un"=>$ket_un,
										"no_un"=>$no_un,
								);
								  
							$this->db->where("nis = '".$nis."'");	  
							$this->db->update("data_siswa",$dataray);
							$edit++; 
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
	 
}