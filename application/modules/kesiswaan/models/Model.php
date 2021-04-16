<?php

class Model extends CI_Model  {
    
	var $tbl="data_cbt";
	var $tbl_jadwal="v_jadwal";
	var $k_nilai="tr_kategory_nilai";
 	function __construct()
    {
        parent::__construct();
    }
    
    
	function download_absenmapel($idkelas,$idmapel)
	{
	    
	  $sms=$this->m_reff->semester();
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
            
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'EC0E0E')
            )
        );
        
        $styleArray = array(
        'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'EC0E0E'), 
          ));
          
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
       
       

//create column
	 $objPHPExcel->getActiveSheet(0)->getStyle('A1:J2')->applyFromArray($style);
            $objPHPExcel->getActiveSheet(0)->mergeCells('A1:A2');
               $objPHPExcel->getActiveSheet(0)->mergeCells('B1:B2');
                  $objPHPExcel->getActiveSheet(0)->mergeCells('C1:C2');
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'NO');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'NAMA SISWA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'NIS');
        $objPHPExcel->getActiveSheet(0)->mergeCells('D1:J1');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'KEHADIRAN');
    
                                    $mulai_i="D";
                                     $datax=$this->db->get_where("tr_sts_kehadiran");
                                     $jmlkikd=$datax->num_rows();
                                     foreach($datax->result() as $data)
									 {
									     $mu_i=$mulai_i++;
									       $objPHPExcel->getActiveSheet(0)->setCellValue($mu_i.'2', $data->nama);
									 
									 } 
                                        $objPHPExcel->getActiveSheet(0)->setCellValue('J2', 'PERSENTASE');
         //<!----------------->
                                  $mu_i=2;$no=1;
                            	$datakelas=$this->mdl->dataSiswa($idkelas); 
								foreach($datakelas as $val)
								{       $mu_i++;
								      $objPHPExcel->getActiveSheet(0)->setCellValue("A".$mu_i, $no++);
								      $objPHPExcel->getActiveSheet(0)->setCellValue("B".$mu_i, $val->nama);
								      $objPHPExcel->getActiveSheet(0)->setCellValue("C".$mu_i, $val->nis);
								       
									$tatapmuka=0; $mu_ket="C";$data="";
									 foreach($datax->result() as $data)
									 {
										  $mu_ket++;
										  $jml= $this->mdl->kehadiran($val->id,$idmapel,$sms,$data->id);
										  if($jml and $mu_ket!="D")
										  {
										       $objPHPExcel->getActiveSheet(0)->getStyle($mu_ket.$mu_i)->applyFromArray($styleArray);
										       $objPHPExcel->getActiveSheet(0)->setCellValue($mu_ket.$mu_i, $jml); 
										  }else{
										       $objPHPExcel->getActiveSheet(0)->setCellValue($mu_ket.$mu_i, $jml); 
										  }
										 
										  $tatapmuka=$jml+$tatapmuka;
									 }
										if($tatapmuka){
										$tot=(($this->mdl->kehadiran($val->id,$idmapel,$sms,1)/$tatapmuka)*100);
										}else{
										$tot=0;	
										}$mu_ket++;
										$tot=number_format($tot,2,",",".");
										if($tot==100){
										 	  $objPHPExcel->getActiveSheet(0)->setCellValue($mu_ket++.$mu_i, $tot."%"); 
										}else{
										     $objPHPExcel->getActiveSheet(0)->getStyle($mu_ket.$mu_i)->applyFromArray($styleArray);
										    $objPHPExcel->getActiveSheet(0)->setCellValue($mu_ket.$mu_i, $tot."%"); 
										}
									  
							 
								}
         //<!----------------->
         
         
         
         
         
         
	 
        
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA ABSEN ');
		 
  
 		 
//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);
        $kelas=$this->m_reff->goField("v_kelas","nama","where id='".$idkelas."'");
        $mapel=$this->m_reff->goField("tr_mapel","nama","where id='".$idmapel."'");
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ABSEN| '.$kelas.'-'.$mapel.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');  
	    
	}
	
	
	function idu()
	{
		return $this->session->userdata("id");
	}
	function dataSiswa($idkelas)
	{
			$this->db->where("id_tahun_keluar",NULL);
			$this->db->where("aktifasi","1");
			$this->db->where("aktifasi","1");
			$this->db->where("id_kelas",$idkelas);
			$this->db->order_by("nama","asc");
	return	$this->db->get("data_siswa")->result();
	}
	function getNilaiKd($idsiswa,$idkikd,$idkelas,$idmapel,$id_kate,$sms)
	{
		  
	    $datakd=$this->db->query("select * from tm_kikd where id='".$idkikd."' ")->row();
	     $kd3_no=isset($datakd->kd3_no)?($datakd->kd3_no):"";
		  $codekd=isset($datakd->code)?($datakd->code):"";
		 $get=$this->db->query("select id from tm_kikd where code='$codekd' and kd3_no='$kd3_no'  ")->result();
		 
		 $idkd="";
		 foreach($get as $cd)
		 {
		     $idkd[]=$cd->id;
		 }
	///	 $idkd=$this->m_reff->clearkoma($idkd);
		 
	 	$this->db->where_in("id_kikd",$idkd);
		//$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
	//	$this->db->where("id_kikd",$idkikd);
		$this->db->where("nilai!=",null);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_kategory_nilai",$id_kate);
		$this->db->select("AVG(nilai) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
	function getNilaiKi($idsiswa,$idkikd,$idkelas,$idmapel,$id_kate,$sms)
	{
		 $datakd=$this->db->query("select * from tm_kikd where id='".$idkikd."' ")->row();
	     $kd4_no=isset($datakd->kd4_no)?($datakd->kd4_no):"";
		  $codekd=isset($datakd->code)?($datakd->code):"";
		 $get=$this->db->query("select id from tm_kikd where code='$codekd' and kd4_no='$kd4_no'  ")->result();
		 
		
		 $idkd="";
		 foreach($get as $cd)
		 {
		     $idkd[]=$cd->id;
		 }
	///	 $idkd=$this->m_reff->clearkoma($idkd);
		 
	 	$this->db->where_in("id_kikd",$idkd);
		  
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
	 ///	$this->db->where("id_kikd",$idkikd);
		$this->db->where("nilai_ki!=",null);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_kategory_nilai",$id_kate);
		$this->db->where("id_guru",$this->idu());
		$this->db->select("AVG(nilai_ki) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
	function getNilaiUT($idsiswa,$idkelas,$idmapel,$sms)
	{
	 
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_kategory_nilai",2);
		$this->db->where("id_guru",$this->idu());
		$this->db->select("AVG(nilai) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
	function getNilaiUA($idsiswa,$idkelas,$idmapel,$sms)
	{
	 
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_kategory_nilai",3);
		$this->db->where("id_guru",$this->idu());
		$this->db->select("AVG(nilai) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
	function getNilaiRataKi($idsiswa,$idkelas,$idmapel,$sms)
	{	 
	 
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_kategory_nilai",1);
		$this->db->select("AVG(nilai_ki) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,2);
	}function getNilaiRataKi_max($idsiswa,$idkelas,$idmapel,$sms)
	{	 
	 
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_kategory_nilai",1);
		$this->db->select("AVG(nilai_ki) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
	 
	 function getNilaiRata($idsiswa,$idkelas,$idmapel,$sms)
	{	 
	 
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_kategory_nilai",1);
		$this->db->select("AVG(nilai) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
	 
	 
	function mapelAjar()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
			$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
	//	$this->db->group_by("mapel,id_tk");
		$this->db->select("nama_tingkat,id_kelas,kelas,mapel,id,id_mapel");
		$this->db->where("id_guru",$this->idu());
		$this->db->order_by("kelas","asc");
	return	$this->db->get("v_mapel_ajar")->result();
	}
		function mapelAjarSikap()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
	//	$this->db->group_by("mapel,id_tk");
		$this->db->select("nama_tingkat,id_kelas,kelas,mapel,id,id_mapel");
		$this->db->where("id_guru",$this->idu());
		$this->db->where("ids",1);
		$this->db->order_by("kelas","asc");
	return	$this->db->get("v_mapel_ajar")->result();
	}
	
	function getNilaiSikap($idsiswa,$mapel,$sts,$sms)
	{		 
		$tahun=$this->m_reff->tahun();
		 
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_semester",$sms);
		$this->db->where("id_mapel",$mapel);
		$this->db->where("id_tahun",$tahun);
 		$this->db->select("nilai".$sts." as nilai");
		$this->db->where("id_guru",$this->idu());
	 	$return=$this->db->get("tm_sikap")->row();
		return isset($return->nilai)?($return->nilai):"";
	}
	function getNilaiSikap2($idsiswa,$mapel,$sms)
	{		 
		$tahun=$this->m_reff->tahun();
		 
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_semester",$sms);
		$this->db->where("id_mapel",$mapel);
		$this->db->where("id_tahun",$tahun);
 		$this->db->select("nilai");
		$this->db->where("id_guru",$this->idu());
	 	$return=$this->db->get("tm_sikap")->row();
		return isset($return->nilai)?($return->nilai):"";
	}
	function getNilaiRataSikap($idsiswa,$mapel,$sms)
	{
		$tahun=$this->m_reff->tahun();
		$filter="";
		if($mapel)
		{
			$filter=" and id_mapel='".$mapel."' ";
		}
	  
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_semester",$sms);
		if($mapel){
		$this->db->where("id_mapel",$mapel);
		}
		$this->db->where("id_tahun",$tahun);
 	//	$this->db->select("((nilai1+nilai2+nilai3+nilai4+nilai5)/5) as nilai");
	//	$this->db->where("id_guru",$this->idu());
	 	$return=$this->db->get("tm_sikap")->row();
	return	$return=isset($return->nilai)?($return->nilai):"-"; 
		//$persentasi_kehadrian = (100/$jml_tatap_muka)*$jml_tidak_masuk;
		 
		if(!$return){ return 0; }else{
			return number_format($return,2);
		}
	}
	/*===================================*/
	function get_data_cbt()
	{
		$query=$this->_get_datatables_cbt();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_datatables_cbt()
	{
		$id_madrasah=$this->input->post("id_madrasah");
		$jk=$this->input->post("jk");
		$posisi=$this->input->post("posisi");
		$mapel=$this->input->post("mapel");
		$status_kelulusan=$this->input->post("status_kelulusan");
		$filter="";
		if($id_madrasah)
		{
			$filter.="AND madrasah_peminatan='".$id_madrasah."' ";
		} 
		if($status_kelulusan)
		{
			$filter.="AND sts='".$status_kelulusan."' ";
		} 
		
		if($jk)
		{
			$filter.="AND jk='".$jk."' ";
		}
		
		if($posisi)
		{
			$filter.="AND posisi_peminatan='".$posisi."' ";
		}
		
		if($mapel)
		{
			$filter.="AND mapel_yg_diampu='".$mapel."' ";
		}
		 
		$query="select * from ".$this->tbl." where id_admin='".$this->idu()."'  $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama','hp'  );
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
	
	public function count_cbt()
	{				
		$query = $this->_get_datatables_cbt();
        return  $this->db->query($query)->num_rows();
	}
	/*===================================*/
	
	/*===================================*/
	function getDataNilai()
	{
		$query=$this->_getDataNilai();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getDataNilai()
	{	
		$query="select * from data_siswa where id_kelas='".$this->input->post("id_kelas")."' ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama','hp'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by nama   asc";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_getDataNilai()
	{				
		$query = $this->_getDataNilai();
        return  $this->db->query($query)->num_rows();
	}
	/*===================================*/
	function dataMapelAjar()
	{
		$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		$data=$this->db->select("DISTINCT(id_mapel) as id_mapel");
			$this->db->where("id_semester",$sms);
			$this->db->where("id_tahun",$tahun);
		$this->db->where("id_guru",$this->idu());
		return $this->db->get($this->tbl_jadwal)->result();
	}
	function dataKelasAjar()
	{
		$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		$data=$this->db->select("DISTINCT(id_kelas) as id_kelas");
		$this->db->where("id_guru",$this->idu());
			$this->db->where("id_semester",$sms);
			$this->db->where("id_tahun",$tahun);
		$this->db->order_by("id_kelas","asc");
		return $this->db->get("v_jadwal")->result();
	}
	function cekWali()
	{
			   $this->db->where("id_wali",$this->session->userdata("id"));
		return $this->db->get_where("tm_kelas")->num_rows();
	}
	function dataKategoryNilai()
	{	$sms=$this->m_reff->semester();
	 	//$cek=$this->cekWali();
		/*if($sms==1)
		{
			$this->db->where("id!=",3);
		}
		if($sms==2)
		{
			$this->db->where("id!=",2);
		}*/
		return $this->db->get($this->k_nilai)->result();
	}
	function kehadiran($id_siswa,$id_mapel,$sms,$sts)
	{	
		$tahun=$this->m_reff->tahun();
		 
		return $this->db->query("select * from tm_absen_siswa where id_semester='".$sms."' and id_tahun='".$tahun."'
		and id_mapel='".$id_mapel."' and absen".$sts." like '%,".$id_siswa.",%'
		")->num_rows();
	}
	function download_format_nilai()
	{
		$id_kelas=$this->input->get("id_kelas");
		$ujian=$this->input->get("ujian");
		$id_mapel=$this->input->get("id_mapel");
		 
		$cekmapelglobal=$this->m_reff->goField("tr_mapel","mapel_global","where id='".$id_mapel."'");
 
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
       
       

//create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'KODE');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'NAMA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'NIS');
		if($ujian==1){
			$objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'NILAI PENGETAHUAN (K.D)');
			$objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'NILAI KETERAMPILAN (K.I)');
			$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
			 $objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->applyFromArray($style);
        }else{
			  $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'NILAI');
			  $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
			   $objPHPExcel->getActiveSheet(0)->getStyle('A1:D1')->applyFromArray($style);
		}
        
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA NILAI');
		 
 
        $datamapel = $this->db->query("select id_agama,jk,nama,nis,id from data_siswa where id_kelas='".$id_kelas."' order by nama asc ")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B' . $shit . '',  $list->nama." (".strtoupper($list->jk).")" );
            $objPHPExcel->getActiveSheet(0)->setCellValue('C' . $shit . '', $list->nis);
			if($cekmapelglobal==2 AND $list->id_agama>1)
			{
				 $objPHPExcel->getActiveSheet(0)->setCellValue('D' . $shit . '', "Non-Muslim");
				 $objPHPExcel->getActiveSheet(0)->setCellValue('E' . $shit . '', "Non-Muslim");
			} 
          
        }
		 
 		 
//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format-upload-nilai.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
	
	
	
	
	
	
	
	function getFormalSikap2()
	{
		$id_kelas=$this->input->get("id");
		 
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
       
       

		//create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'KODE SISTEM');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'NAMA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'NIS');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'NILAI');

      
       $objPHPExcel->getActiveSheet(0)->getStyle('A1:D1')->applyFromArray($style);
 
		// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA NILAI SIKAP');
		 
		//<!-------------------------------------------------------------------------------  --->		
      
        $datamapel = $this->db->query("select nama,nis,id from data_siswa where id_kelas='".$id_kelas."' order by nama asc ")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B' . $shit . '', $list->nama);
            $objPHPExcel->getActiveSheet(0)->setCellValue('C' . $shit . '', $list->nis);
          
        }
		 	/*
 		    $objPHPExcel->getActiveSheet(0)->setCellValue('D2', "Di isi dengan di awalai tanda petik (`) atau kutif (').");
 		    $objPHPExcel->getActiveSheet(0)->setCellValue('D3', "contoh : '56.70");
			$objPHPExcel->getActiveSheet(0)->getColumnDimension("D")->setAutoSize(true);*/
		 
		//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format-upload-nilai-sikap.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
	function getFormalSikap()
	{
		$id_kelas=$this->input->get("id");
		 
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
       
       

		//create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'KODE SISTEM');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'NAMA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'NIS');
		$datax=$this->db->get("tr_sikap")->result();
		$abjad="D";
		foreach($datax as $val)
		{
			 $objPHPExcel->getActiveSheet(0)->setCellValue($abjad++.'1', strtoupper($val->nama));
			 $objPHPExcel->getActiveSheet(0)->getColumnDimension($abjad)->setAutoSize(true);
		}
      
       $objPHPExcel->getActiveSheet(0)->getStyle('A1:H1')->applyFromArray($style);
 
		// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA NILAI SIKAP');
		 
		//<!-------------------------------------------------------------------------------  --->		
      
        $datamapel = $this->db->query("select nama,nis,id from data_siswa where id_kelas='".$id_kelas."' order by nama asc ")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B' . $shit . '', $list->nama);
            $objPHPExcel->getActiveSheet(0)->setCellValue('C' . $shit . '', $list->nis);
          
        }
		 
 		    $objPHPExcel->getActiveSheet(0)->setCellValue('D2', "Di isi dengan di awalai tanda petik (`) atau kutif (').");
 		    $objPHPExcel->getActiveSheet(0)->setCellValue('D3', "contoh : '56.70");
			$objPHPExcel->getActiveSheet(0)->getColumnDimension("D")->setAutoSize(true);
		 
		//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format-upload-nilai-sikap.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		function import_data_nilai()
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
					return $this->importFileNilai("file");
				 
			}else{
					return $var;
			}
	}
	
	
	
	
	
	
	
	
	
	
	function import_data_nilai_multi()
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
					return $this->importFileNilaiMulti("file");
				 
			}else{
					return $var;
			}
	}
	
	
	
	
	
	
	
	
	
	
	 
	
	function cek_nilai($array)
	{
			$this->db->where($array);
	return	$this->db->get("data_nilai")->num_rows();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function importNilaiSikap2($file_form){	
 
		$id_guru=$this->idu();
		  
			  $id_kelas=$this->security->xss_clean($this->input->get_post("id_kelas"));
			  $id_mapel=$this->security->xss_clean($this->input->get_post("id_mapel"));
			 
			$sms=$this->m_reff->semester();
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
						 
						$id_siswa=isset($sheet[0])?($sheet[0]):"";
						$nilai1=isset($sheet[3])?($sheet[3]):"";
						if(strtolower($nilai1)=="sangat baik"){
						    $nilai1="A";
						}
					 
							  $array=array( 
							 "id_mapel"=>$id_mapel,
							 "id_siswa"=>$id_siswa,
							 "id_guru"=>$id_guru,
							 "id_semester"=>$sms,
							 "id_tahun"=>$tahun,
							 );  
							 
							 $nilai=array( 
							 	"nilai"=>$nilai1,
							 );
							 
					  $this->mdl_nilai->importNilaiSikap2($array,$nilai);
				      $insert++;
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

	function importNilaiSikap($file_form){	
 
		$id_guru=$this->idu();
		  
			  $id_kelas=$this->security->xss_clean($this->input->get_post("id_kelas"));
			  $id_mapel=$this->security->xss_clean($this->input->get_post("id_mapel"));
			 
			$sms=$this->m_reff->semester();
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
						 
						$id_siswa=isset($sheet[0])?($sheet[0]):"";
						$nilai1=isset($sheet[3])?($sheet[3]):"";
						$nilai2=isset($sheet[4])?($sheet[4]):"";
						$nilai3=isset($sheet[5])?($sheet[5]):"";
						$nilai4=isset($sheet[6])?($sheet[6]):"";
						$nilai5=isset($sheet[7])?($sheet[7]):"";
						
					 
							  $array=array( 
							 "id_mapel"=>$id_mapel,
							 "id_siswa"=>$id_siswa,
							 "id_guru"=>$id_guru,
							 "id_semester"=>$sms,
							 "id_tahun"=>$tahun,
							 );  
							 
							 $nilai=array( 
							 "nilai1"=>$nilai1,
							 "nilai2"=>$nilai2,
							 "nilai3"=>$nilai3,
							 "nilai4"=>$nilai4,
							 "nilai5"=>$nilai5,
							 );
							 
							 $this->mdl_nilai->importNilaiSikap($array,$nilai);
				      $insert++;
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function importFileNilaiMulti($file_form)
	{	
		$id_guru=$this->idu();
		 
		
			$id_kikd=$this->security->xss_clean($this->input->get_post("kikd"));
			if($id_kikd=="" or $id_kikd=="true" or $id_kikd=="false"){
			  $id_kikd=null;  
			}
	
	$Dataloop=$this->m_reff->clearkomaray($id_kikd);		

		 
			  $id_kelas=$this->security->xss_clean($this->input->get_post("id_kelas"));
			 $id_mapel=$this->security->xss_clean($this->input->get_post("id_mapel"));
			 $id_siswa=$this->security->xss_clean($this->input->get_post("id_siswa"));
			 $k_nilai=$this->security->xss_clean($this->input->get_post("k_nilai"));
			$nama_nilai=$this->security->xss_clean($this->input->get_post("ket"));
			$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		   $cekmapelglobal=$this->m_reff->goField("tr_mapel","mapel_global","where id='".$id_mapel."'");
		
		$this->load->library("PHPExcel");
		$insert=0;$gagal=0;$edit=0;$validasi_hp=true;$validasi=true;
		$i=0;
			foreach($Dataloop as $id_kikd)
	{
	    $this->session->set_userdata("code",date("dmYHis").$i++);
		$file   = explode('.',$_FILES[$file_form]['name']);
		$length = count($file);
		if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){
         $tmp    = $_FILES[$file_form]['tmp_name']; 
	 
			    $load = PHPExcel_IOFactory::load($tmp);
                $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
				$i=1;
					 
				foreach ($sheets as $sheet) {
				if ($i > 1) {						
						
						$id_siswa=isset($sheet[0])?($sheet[0]):"";
						$nilai_kd=isset($sheet[3])?($sheet[3]):"";
						$nilai_kd=str_replace(",",".",$nilai_kd);
						$nilai_kd=str_replace("'","",$nilai_kd);
						$nilai_kd=str_replace("`","",$nilai_kd);
							if(!$nilai_kd){   $nilai_kd=null;}
						
						$nilai_ki=isset($sheet[4])?($sheet[4]):"";
						$nilai_ki=str_replace(",",".",$nilai_ki);
						$nilai_ki=str_replace("'","",$nilai_ki);
						$nilai_ki=str_replace("`","",$nilai_ki);
						if(!$nilai_ki){   $nilai_ki=null;}
						
						$id_kelas_siswa=$this->m_reff->goField("data_siswa","id_kelas","where id='".$id_siswa."' ");
						$cekKetersediaan=$this->db->query("select * from v_mapel_ajar where id_mapel='".$id_mapel."' and id_guru='".$id_guru."' 
						and id_tahun='".$tahun."' and id_semester='".$sms."' and id_kelas='".$id_kelas_siswa."'  ")->num_rows();
						if(!$cekKetersediaan){
						    $var["gagal"]=false;
						    $var["info"]="Maaf! data siswa tidak sesuai dengan kelas yang anda maksud, mohon cek kembali file anda.";
						    return $var;
						}
							
							 $array=array(
							 "id_kategory_nilai"=>$k_nilai,
							  "id_kelas"=>$id_kelas,
							 "id_kikd"=>$id_kikd,
							 "id_mapel"=>$id_mapel,
							 "id_siswa"=>$id_siswa,
							 "nama_nilai"=>$nama_nilai,
							 "id_guru"=>$id_guru,
							 "id_semester"=>$sms,
							 "id_tahun"=>$tahun,
							 );
						$agama=$this->m_reff->goField("data_siswa","id_agama","where id='".$id_siswa."' ");
						
						$cek_nilai=$this->cek_nilai($array);
						if($cek_nilai){
							if($k_nilai==1)
							{
								 $nilai=array("nilai"=>$nilai_kd,
								 "nilai_ki"=>$nilai_ki,
								 "_uid"=>$id_guru,
								 "_utime"=>date("Y-m-d H:i:s"),
								 );
							}else{
								 $nilai=array("nilai"=>$nilai_kd,
								 "_uid"=>$id_guru,
								 "_utime"=>date("Y-m-d H:i:s"),
								 );
							
							}
							
							if($cekmapelglobal==1 OR $agama<2)
							{
							$this->update_nilai($array,$nilai);
							$edit++;
							}
							
							
							
							
						}else{
							if($k_nilai==1)
							{
							    
							   $nilai=array(
							   "nilai"=>$nilai_kd,
							   "nilai_ki"=>$nilai_ki,
							    "_cid"=>$id_guru
								 );
							}else{
								 $nilai=array("nilai"=>$nilai_kd,
								 "_uid"=>$id_guru,
								 "_utime"=>date("Y-m-d H:i:s"),
								 );
							}
								
							   if($cekmapelglobal==1 OR $agama<2)
								{
									$this->insert_nilai($array,$nilai);
									$insert++;
								}
						}
						 
				      
				}
				$i++;
                }
               
		}else{
			 $var["file"]=false;
			 $var["type_file"]="xlsx";
		}
	}
			  $var["import_data"]=true;
			  $var["data_insert"]=$insert;
			  $var["data_gagal"]=$gagal;
			  $var["data_edit"]=$edit;
			  $var["hp"]=$validasi_hp;
			  $var["validasi"]=$validasi;
		return $var;
	}
	
		function importFileNilai($file_form)
	{	
		$id_guru=$this->idu();
		 
		
			$id_kikd=$this->security->xss_clean($this->input->get_post("kikd"));
			if($id_kikd=="" or $id_kikd=="true" or $id_kikd=="false"){
			  $id_kikd=null;  
			}
	
 		
			  $id_kelas=$this->security->xss_clean($this->input->get_post("id_kelas"));
			 $id_mapel=$this->security->xss_clean($this->input->get_post("id_mapel"));
			 $id_siswa=$this->security->xss_clean($this->input->get_post("id_siswa"));
			 $k_nilai=$this->security->xss_clean($this->input->get_post("k_nilai"));
			$nama_nilai=$this->security->xss_clean($this->input->get_post("ket"));
			$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		   $cekmapelglobal=$this->m_reff->goField("tr_mapel","mapel_global","where id='".$id_mapel."'");
		
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
						
						$id_siswa=isset($sheet[0])?($sheet[0]):"";
						$nilai_kd=isset($sheet[3])?($sheet[3]):"";
						$nilai_kd=str_replace(",",".",$nilai_kd);
						$nilai_kd=str_replace("'","",$nilai_kd);
						$nilai_kd=str_replace("`","",$nilai_kd);
							if(!$nilai_kd){   $nilai_kd=null;}
						
						$nilai_ki=isset($sheet[4])?($sheet[4]):"";
						$nilai_ki=str_replace(",",".",$nilai_ki);
						$nilai_ki=str_replace("'","",$nilai_ki);
						$nilai_ki=str_replace("`","",$nilai_ki);
						if(!$nilai_ki){   $nilai_ki=null;}
						
						$id_kelas_siswa=$this->m_reff->goField("data_siswa","id_kelas","where id='".$id_siswa."' ");
						$cekKetersediaan=$this->db->query("select * from v_mapel_ajar where id_mapel='".$id_mapel."' and id_guru='".$id_guru."' 
						and id_tahun='".$tahun."' and id_semester='".$sms."' and id_kelas='".$id_kelas_siswa."'  ")->num_rows();
						if(!$cekKetersediaan){
						    $var["gagal"]=false;
						    $var["info"]="Maaf! data siswa tidak sesuai dengan kelas yang anda maksud, mohon cek kembali file anda.";
						    return $var;
						}
							
							 $array=array(
							 "id_kategory_nilai"=>$k_nilai,
							  "id_kelas"=>$id_kelas,
							 "id_kikd"=>$id_kikd,
							 "id_mapel"=>$id_mapel,
							 "id_siswa"=>$id_siswa,
							 "nama_nilai"=>$nama_nilai,
							 "id_guru"=>$id_guru,
							 "id_semester"=>$sms,
							 "id_tahun"=>$tahun,
							 );
						$agama=$this->m_reff->goField("data_siswa","id_agama","where id='".$id_siswa."' ");
						
						$cek_nilai=$this->cek_nilai($array);
						if($cek_nilai){
							if($k_nilai==1)
							{
								 $nilai=array("nilai"=>$nilai_kd,
								 "nilai_ki"=>$nilai_ki,
								 "_uid"=>$id_guru,
								 "_utime"=>date("Y-m-d H:i:s"),
								 );
							}else{
								 $nilai=array("nilai"=>$nilai_kd,
								 "_uid"=>$id_guru,
								 "_utime"=>date("Y-m-d H:i:s"),
								 );
							
							}
							
							if($cekmapelglobal==1 OR $agama<2)
							{
							$this->update_nilai($array,$nilai);
							$edit++;
							}
							
							
							
							
						}else{
							if($k_nilai==1)
							{
							    
							   $nilai=array(
							   "nilai"=>$nilai_kd,
							   "nilai_ki"=>$nilai_ki,
							    "_cid"=>$id_guru
								 );
							}else{
								 $nilai=array("nilai"=>$nilai_kd,
								 "_uid"=>$id_guru,
								 "_utime"=>date("Y-m-d H:i:s"),
								 );
							}
								
							   if($cekmapelglobal==1 OR $agama<2)
								{
									$this->insert_nilai($array,$nilai);
									$insert++;
								}
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
	function insert_nilai($dataray,$nilai)
	{       $code=$this->session->userdata("code");
	 		$this->db->set($nilai);
	 		$this->db->set("code",$code);
	return	$this->db->insert("data_nilai",$dataray);
	}
	function update_nilai($dataray,$nilai)
	{
		$this->db->where($dataray);
		$this->db->set($nilai);
	return	$this->db->update("data_nilai");
	}
	
	function gethitungNA($nilai70,$uts,$uas)
	{
		$nilai70=($nilai70/100)*60;
		$ujian=($uts+$uas)/2;
		$nilai30=($ujian/100)*40;
		$nilai=$nilai30+$nilai70;
		return	number_format($nilai,2,",",".");
		
	}
	
	
	
}