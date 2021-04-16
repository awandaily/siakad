<?php

class M_model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	 
	 
	 
	 function jmlMadrasah($j)
	 {
		 $data=$this->dataProfile();
	$level=$this->session->userdata("level");
	if($level=="kanwil")
	{
		$this->db->where("kode_provinsi",$data->idprov);
	}else 
	{
		$this->db->where("kode_provinsi",$data->idprov);
		$this->db->where("kode_kabupaten",$data->idkab);
	} 
		$this->db->select("COUNT(*) as jml");
		$this->db->where("jenjang",$j);
	$return=$this->db->get("admin")->row();
	return isset($return->jml)?($return->jml):"";
	 }
	 
	  function dataProfile($id=null)
	 {	$idu=$this->session->userdata("id");
		 if($id)
		 {
			 $idu=$id;
		 }
		
		$this->db->where("id",$idu);
		return $this->db->get("tm_akun")->row();
		 
	 }
	 function kondisiSarpras($id,$jenjang,$status) //id rusak
	 {
			$data=$this->dataProfile();
			$level=$this->session->userdata("level");
			if($level=="kanwil")
			{
				$this->db->where("kode_provinsi",$data->idprov);
			}else 
			{
				$this->db->where("kode_provinsi",$data->idprov);
				$this->db->where("kode_kabupaten",$data->idkab);
			} 
				 $this->db->select("COUNT(*) as jml");
				 if($jenjang)
				 {
				$this->db->where("jenjang",$jenjang);
				 }
				$this->db->where("kd_kondisibangunan",$id);
				if($status)
				{
				$this->db->where("status",$status);
				}
			$return=$this->db->get("admin")->row();
			return isset($return->jml)?($return->jml):"";
	 }
	
	function jmlBelumUpload($j)
	{
			$data=$this->dataProfile();
			$level=$this->session->userdata("level");
			if($level=="kanwil")
			{
				$this->db->where("kode_provinsi",$data->idprov);
			}else 
			{
				$this->db->where("kode_provinsi",$data->idprov);
				$this->db->where("kode_kabupaten",$data->idkab);
			} 
				 $this->db->select("COUNT(*) as jml");
				 if($j)
				 {
				$this->db->where("jenjang",$j);
				 }
			$this->db->where('kd_kondisibangunan is NULL', NULL, FALSE);
			
			$return=$this->db->get("admin")->row();
			return isset($return->jml)?($return->jml):"";
	}
	 
	 
	 
	 
	 
	 ///-----------------------------------ajax//
	private function _get_datatables_open()
	{
	$profil=$this->dm->dataProfile();
	$level		=	$this->session->userdata("level");
	$idprov		=	$this->session->userdata("idprov");
	$idkab		=	$this->session->userdata("idkab");
	$idkec		=	$this->session->userdata("idkec");
    $kondisi	=	$this->session->userdata("kondisi");
		
	$query="select *,b.nama as namaGroup from admin a,main_level b where a.level=b.id_level and level='3'     ";
	
		 if($idkec)
		 {
			$query.="  AND kode_kecamatan='".$idkec."'"; 
		 }
		 
		 if($idkab)
		 {
			$query.="AND  kode_kabupaten='".$idkab."' "; 
		 }
		 if($idprov)
		 {
			$query.="AND  kode_provinsi='".$idprov."' "; 
		 }
	
		if($kondisi=="null")
		{
			$query.="AND kd_kondisibangunan IS NULL "; 
		}elseif(!$kondisi)
		{
			
		}else{
			$query.="AND kd_kondisibangunan='".$kondisi."' "; 
		}
	
		if(isset($_POST['search']['value'])){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			b.nama LIKE '%".$searchkey."%' or 
			nama LIKE '%".$searchkey."%' or 
			owner LIKE '%".$searchkey."%' or 
			nama_madrasah LIKE '%".$searchkey."%' or 
			npsn LIKE '%".$searchkey."%' or 
			nsm LIKE '%".$searchkey."%' or 
			alamat LIKE '%".$searchkey."%' or 
			telp LIKE '%".$searchkey."%' or 
			email LIKE '%".$searchkey."%'
			) ";
		}

		$column = array('','poto','nama','telp','email','namaGroup');
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		//	$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			$query.=" order by ".$column[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir'] ;
		} 
		else if(isset($order))
		{
			$order = $order;
		//	$this->db->order_by(key($order), $order[key($order)]);
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}	///-----------------------------------ajax//
 
	
	function get_open()
	{
		
		$query=$this->_get_datatables_open();
		if($_POST['length'] != -1)
		//$this->db->limit($_POST['length'], $_POST['start']);
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		//if($keyword=$this->uri->segment(3)){ $this->db->like('TextDecoded',$keyword);};
		
		//$query = $this->db->get();
		return $this->db->query($query)->result();
	}
	
 
	
	public function count_file()
	{		
		
		 $query = $this->_get_datatables_open();
        return  $this->db->query($query)->num_rows();
	}
	function count_filtered($tabel)
	{
		$this->db->from($tabel);
		$query=$this->_get_datatables_open();
		return $this->db->query($query)->num_rows();
	}
	 
	 function getDataUser($id) //id_file
	{
	$this->db->where("id_admin",$id);
	$this->db->join("main_level b","a.level=b.id_level");
	$this->db->from("admin a");
	return $this->db->get()->row();
	}
	 
	function insert()
	{
	
	 $user=$this->input->get_post("f[username]");
	 $pass=$this->input->get_post("password");
	 $idkec=$this->input->get_post("kode_kecamatan");
	 $idkab=$this->input->get_post("kode_kabupaten");
	 $id="all";
	 $data=$this->input->post("f");
	 
	  	if($this->cekPassword($id,$user,$pass)>0)
		{
		 	return 0;//password tidak tersedia
		}else
		{
		
		 if($pass)
		 {
		 $this->db->set("password",md5($pass));
		 } 
		
		$this->db->set("kode_kabupaten",$idkab);
		$this->db->set("kode_kecamatan",$idkec);
		$this->db->where("id_admin",$id);
		$this->db->insert("admin",$data);		
		 	return true;
		}
	
	}
	function update()
	{
	
	 $user=$this->input->get_post("f[username]");
	 $pass=$this->input->get_post("password");
	 $idkec=$this->input->get_post("kode_kecamatan");
	 $idkab=$this->input->get_post("kode_kabupaten");
	 $id=$this->input->get_post("id");
	 $data=$this->input->post("f");
	 
	  	if($this->cekPassword($id,$user,$pass)>0)
		{
		 	return 0;//password tidak tersedia
		}else
		{
		
		 if($pass)
		 {
		 $this->db->set("password",md5($pass));
		 } 
		
		$this->db->set("kode_kabupaten",$idkab);
		$this->db->set("kode_kecamatan",$idkec);
		$this->db->where("id_admin",$id);
		$this->db->update("admin",$data);		
		 	return true;
		}
	
	}
	
	function cekPassword($id,$user,$pass)
	{
		 
		$this->db->where("id!=",$id);
		$this->db->where("username",$user);
		$this->db->where("password",$pass);
	$return1=$this->db->get("tm_akun")->num_rows();
	
	$this->db->where("id_admin!=",$id);
		$this->db->where("username",$user);
		$this->db->where("password",md5($pass));
	$return2=	$this->db->get("admin")->num_rows();
		return ($return1+$return2);
	}
	 
	  function download()
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
		
	//	$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(5);

		$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);
		
		
		
		//create column
		
		$objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'PROVINSI');
		$objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'KAB/KOTA');
		$objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'KECAMATAN');
		$objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'KELURAHAN');
		$objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'NAMA MADRASAH');
		$objPHPExcel->getActiveSheet(0)->setCellValue('F1', 'JENJANG');
		$objPHPExcel->getActiveSheet(0)->setCellValue('G1', 'STATUS');
		$objPHPExcel->getActiveSheet(0)->setCellValue('H1', 'NSM');
		$objPHPExcel->getActiveSheet(0)->setCellValue('I1', 'NPSN');
		$objPHPExcel->getActiveSheet(0)->setCellValue('J1', 'NAMA KEPALA');
		$objPHPExcel->getActiveSheet(0)->setCellValue('K1', 'KEPALA TELP');
		$objPHPExcel->getActiveSheet(0)->setCellValue('L1', 'KONDISI BANGUNAN');
		$objPHPExcel->getActiveSheet(0)->setCellValue('M1', 'TAHUN KONDISI');
		 
		//make a border column
		$objPHPExcel->getActiveSheet(0)->getStyle('A1:M1')->applyFromArray($style);
		
		
		$shit=5;
		$q=$this->_get_datatables_open();				
		$query=$this->db->query($q);
		$query=$query->result();
		$shit++;$row="2";
		foreach($query as $dataDB)
		{
		$objPHPExcel->getActiveSheet(0)->setCellValue('A'.$row.'', $this->m_reff->goField("tm_wilayah","nama_prov","idprov='".$dataDB->kode_provinsi."'"));
		$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row.'', $this->m_reff->goField("tm_wilayah","nama_kab","idprov='".$dataDB->kode_provinsi."' and idkab='".$dataDB->kode_kabupaten."'"));
		$objPHPExcel->getActiveSheet(0)->setCellValue('C'.$row.'', $this->m_reff->goField("tm_wilayah","nama_kec","idprov='".$dataDB->kode_provinsi."' and idkab='".$dataDB->kode_kabupaten."' and idkec='".$dataDB->kode_kecamatan."'"));
		$objPHPExcel->getActiveSheet(0)->setCellValue('D'.$row.'', $dataDB->kelurahan);
		$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$row.'', $dataDB->nama_madrasah);
		$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$row.'', $this->m_reff->goField("katagory_icon","nama","id='".$dataDB->jenjang."'"));
		$objPHPExcel->getActiveSheet(0)->setCellValue('G'.$row.'', $dataDB->status);
		$objPHPExcel->getActiveSheet(0)->setCellValue('H'.$row.'', '`'.$dataDB->nsm);
		$objPHPExcel->getActiveSheet(0)->setCellValue('I'.$row.'', '`'.$dataDB->npsn);
		$objPHPExcel->getActiveSheet(0)->setCellValue('J'.$row.'', $dataDB->kepala_nama);
		$objPHPExcel->getActiveSheet(0)->setCellValue('K'.$row.'', '`'.$dataDB->kepala_telp);
		$objPHPExcel->getActiveSheet(0)->setCellValue('L'.$row.'', $this->m_reff->goField("tr_kondisibangunan","nama","id='".$dataDB->kd_kondisibangunan."'"));
		$objPHPExcel->getActiveSheet(0)->setCellValue('M'.$row.'', '`'.$dataDB->thn_sarpras);
		$row++;
		}
		
		
			
		// Rename worksheet (worksheet, not filename)
		$objPHPExcel->getActiveSheet(0)->setTitle('Data');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="DATA MADRASAH.xlsx"');
		header('Cache-Control: max-age=0');
		 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		//////finish
		
	 }
	 
	 
	 
}