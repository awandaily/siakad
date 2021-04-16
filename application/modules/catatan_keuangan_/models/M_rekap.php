<?php

Class M_rekap extends ci_model {

    
    function get_datarekap() {
        $query = $this->_get_datarekap();
        if ($_POST['length'] != -1)
            $query .= " limit " . $_POST['start'] . "," . $_POST['length'];
        return $this->db->query($query)->result();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
    public function count() {

        $query = $this->_get_datarekap();
        return $this->db->query($query)->num_rows();
    }

    function insert() {
		$nominal=$this->input->post("nominal");
		$nominal=str_replace(".","",$nominal);
		$tgl=$this->input->post("tgl");
		$tgl=$this->tanggal->eng_($tgl,"-");
        
		$this->db->set("_cid",$this->idu());
		$this->db->set("nominal",$nominal);
		$this->db->set("tgl",$tgl);
		$input=$this->input->post("f");
		$input=$this->security->xss_clean($input);
		$this->db->set($input);
        return $this->db->insert("keu_data_pemasukan");
    }

    function update() {
        $id=$this->input->post("id");
        $nominal=$this->input->post("nominal");
		$nominal=str_replace(".","",$nominal);
		$tgl=$this->input->post("tgl");
		$tgl=$this->tanggal->eng_($tgl,"-");
        
		$this->db->set("_cid",$this->idu());
		$this->db->set("nominal",$nominal);
		$this->db->set("tgl",$tgl);
		$input=$this->input->post("f");
		$input=$this->security->xss_clean($input);
		$this->db->set($input);
		$this->db->where("id",$id);
		$this->db->where("tipe",0);
        return $this->db->update("keu_data_pemasukan");
    }
	function hapus()
	{ 	$id=$this->input->post("id");
		$this->db->where("id",$id);
		$this->db->where("tipe",0);
		return $this->db->delete("keu_data_pemasukan");
	}
    private function _get_datarekap() {
        $tgl = $this->input->get("tanggal");
        $grafik = $this->input->get("grafik");
        $tipe = $this->input->get("tipe");
        $tgl1 = $this->tanggal->rangeindo($tgl, 0);
        $tgl2 = $this->tanggal->rangeindo($tgl, 1);
		$filter="";
        if ($tipe) {
            $filter = " and tipe=".$tipe;
        }

		if ($tgl1) {
            $tgl = " and tgl BETWEEN '" . $tgl1 . " 00:00:00' AND '" . $tgl2 . " 23:59:59' ";
        }
        $id = $this->session->userdata("id");

        if ($grafik == "tdetail" or $grafik == "gdetail") {
            $group_by = "";
            $select = "kredit,debit,tgl,ket,tipe";
        }
        if ($grafik == "th" or $grafik == "gh") {
            $group_by = "group by SUBSTRING(tgl,1,10)";
            $select = "SUM(kredit) as kredit,SUM(debit) as debit,tgl,ket,tipe";
        }
        if ($grafik == "tm" or $grafik == "gm") {
            $group_by = "group by YEARWEEK(SUBSTRING(tgl,1,10))";
            $select = "CONCAT('minggu ke:',WEEK(tgl),'-',YEAR(tgl)) AS tgl,SUM(kredit) as kredit,SUM(debit) as debit,ket,tipe";
        }
        if ($grafik == "tb" or $grafik == "gb") {
            $group_by = "group by MONTH(SUBSTRING(tgl,1,10))";
            $select = "CONCAT(MONTH(tgl),'-',YEAR(tgl)) AS tgl,SUM(kredit) as kredit,SUM(debit) as debit,ket,tipe";
        }
        if ($grafik == "tt" or $grafik == "gt") {
            $group_by = "group by YEAR(SUBSTRING(tgl,1,10))";
            $select = "YEAR(tgl) AS tgl,SUM(kredit) as kredit,SUM(debit) as debit,ket,tipe";
        }



        $query = "SELECT " . $select . " FROM v_transaksi WHERE 1=1 $tgl $filter ";

        if (isset($_POST['search']['value'])) {
            $searchkey = $_POST['search']['value'];
            $query .= " AND (
			tgl LIKE '%" . $searchkey . "%' or  
			ket LIKE '%" . $searchkey . "%' 
			) ";
        }

        $column = array('', 'tgl',  'ket');
        $i = 0;
        foreach ($column as $item) {
            $column[$i] = $item;
        }
        $query .= " " . $group_by;
      //  if (isset($_POST['order'])) {
            //	$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      //      $query .= " order by " . $column[$_POST['order']['0']['column']] . " " . $_POST['order']['0']['dir'];
     //   } else if (isset($order)) {
      //      $order = $order;
            //	$this->db->order_by(key($order), $order[key($order)]);
            $query .= " order by tgl DESC";
      //  }
        //$query.=" order by entry DESC" ;
        return $query;
    }

     

    function totalPemasukanPeriode($awal, $akhir) {
        $this->db->select("SUM(nominal) as jml");
        $this->db->where('tgl BETWEEN "' . $awal . ' 00:00:00" and "' . $akhir . ' 23:59:59"');
        $data = $this->db->get("v_pemasukan")->row();
        return number_format($data->jml, 0, ",", ".");
    }

    function exportData($tanggal, $grafik,$tipe) {
      //  $awal = $this->tanggal->rangeindo($tanggal, 0);
      //  $akhir = $this->tanggal->rangeindo($tanggal, 1);
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

        if ($grafik == "tdetail" or $grafik == "gdetail") {
            $title = "Tanggal";
            $subtitle = "Detail";
        } elseif ($grafik == "th" or $grafik == "gh") {
            $title = "Tanggal";
            $subtitle = "Perhari";
        } elseif ($grafik == "tm" or $grafik == "gm") {
            $subtitle = $title = "Minggu";
            $subtitle = "Perminggu";
        } elseif ($grafik == "tb" or $grafik == "gb") {
            $title = "Bulan";
            $subtitle = "Perbulan";
        } else {
            $subtitle = $title = "Tahun";
            $subtitle = "Pertahun";
        }

        //create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'No');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', $title);
        if ($grafik == "tdetail") {
            $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'Nama Pemasukan');
        }
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'Nominal Pemasukan');
        if ($grafik == "tdetail") {
            $objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'Keterangan');
        }

        //make a border column
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:E1')->applyFromArray($style);
        $database = $this->_get_datarekap();
        $database = $this->db->query($database)->result();
        $shit = 1;
        foreach ($database as $list) {
            $shit++;
            $tanggal = explode("-", $list->tgl);
            //create data per row
			
			
			 if($list->tipe==2)
			 {	$siswa=$this->m_reff->goField("data_siswa","nama","where id='".$list->id_guru."'");
				 $nama=$siswa." - Bayar ".$this->m_reff->namaBiaya($list->nama);
				 $ket=str_replace(":lunas,",", ",$list->ket);
			 }else{
				 $nama=$list->nama;
				 $ket=$list->ket;
			 }
			
			
			
			
			
			
			
            $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $shit . '', $shit - 1);
            if ($this->input->get("grafik") == "tdetail" or $this->input->get("grafik") == "gdetail") {
                $objPHPExcel->getActiveSheet(0)->setCellValue('B' . $shit . '', $this->tanggal->hariLengkap(substr($list->tgl, 0, 10), "-"));
                $objPHPExcel->getActiveSheet(0)->setCellValue('C' . $shit . '', $nama);
            } elseif ($grafik == "th" or $grafik == "gh") {
                $objPHPExcel->getActiveSheet(0)->setCellValue('B' . $shit . '', $this->tanggal->hariLengkap(substr($list->tgl, 0, 10), "-"));
            } else {
                $objPHPExcel->getActiveSheet(0)->setCellValue('B' . $shit . '', $list->tgl);
            }


            $objPHPExcel->getActiveSheet(0)->setCellValue('D' . $shit . '', $list->nominal);
            if ($grafik == "tdetail" or $grafik == "gdetail") {
                $objPHPExcel->getActiveSheet(0)->setCellValue('E' . $shit . '', $ket);
            }
        }

        //auto size column
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);

        // Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('Data Pemasukan ' . $subtitle . '');



        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data-Pemasukan.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //////finish
    }
    
    function download_template()
	{
	
	//////start
	$objPHPExcel = new PHPExcel();
	//style
	$style = array( 
     'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              'rotation'   => 0,
      ),
      'fill' => array(
              'type' => PHPExcel_Style_Fill::FILL_SOLID,
              'color' => array('rgb' => '6CCECB')
          ),
     'borders' => 
      array( 'allborders' => 
        array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), 
          ), 
        ), 
    );
	$style2 = array( 
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              'rotation'   => 0,
      ),
	  'borders' => 
      array( 'allborders' => 
        array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), 
          ), 
        ), 
      'fill' => array(
              'type' => PHPExcel_Style_Fill::FILL_SOLID,
              'color' => array('rgb' => 'ccff99')
          )
    );	
	$style3 = array( 
     'borders' => 
      array( 'allborders' => 
        array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), 
          ), 
        ), 
      'fill' => array(
              'type' => PHPExcel_Style_Fill::FILL_SOLID,
              'color' => array('rgb' => 'ccff99')
          )
    );

	//create column
	$objPHPExcel->getActiveSheet(0)->setCellValue('A1', '(Tgl-bln-Thn) Pemasukan');
	$objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'Nama Pemasukan');
	$objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'Nominal Pemasukan');
	$objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'Keterangan');
	
	
	//make a border column
	$objPHPExcel->getActiveSheet(0)->getStyle('A1:D1')->applyFromArray($style);
	//auto size column
	$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);
	$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
	$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
	$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(35);
	
	// Rename worksheet (worksheet, not filename)
	$objPHPExcel->getActiveSheet(0)->setTitle('Template Data pemasukan');
	  

	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	
	header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Data-Barang.xlsx"');
	header('Cache-Control: max-age=0');
	 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	//////finish
	}
	function dataPemasukan($tgl, $grafik,$tipe) {
        if ($grafik == "gdetail") {
            $this->db->select("nominal,tgl");
        }
        if ($grafik == "gh") {
            $this->db->group_by("SUBSTRING(tgl,1,10)");
            $this->db->select("SUM(nominal) as nominal,tgl");
        }
        if ($grafik == "gm") {
            $this->db->group_by("YEARWEEK(SUBSTRING(tgl,1,10))");
            $this->db->select(" CONCAT('minggu ke:',WEEK(tgl),'-',YEAR(tgl)) AS tgl,SUM(nominal) AS nominal");
        }
        if ($grafik == "gb") {
            $this->db->group_by("MONTH(SUBSTRING(tgl,1,10))");
            $this->db->select("CONCAT(MONTH(tgl),'-',YEAR(tgl)) AS tgl,SUM(nominal) AS nominal");
        }
        if ($grafik == "gt") {
            $this->db->group_by("YEAR(SUBSTRING(tgl,1,10))");
            $this->db->select("YEAR(tgl) AS tgl,SUM(nominal) AS nominal");
        }
		if($tipe!="all")
		{
			$this->db->where("tipe",$tipe);
		}
       
        $awal = $this->tanggal->rangeindo($tgl, 0);
        $akhir = $this->tanggal->rangeindo($tgl, 1);
        $this->db->where('tgl BETWEEN "' . $awal . ' 00:00:00" and "' . $akhir . ' 23:59:59"');
		$this->db->order_by("tgl","ASC");
        return $this->db->get("v_pemasukan")->result();
    }
}
