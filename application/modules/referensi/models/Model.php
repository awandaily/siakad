<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
    function setModeKbm()
    {
        $id=$this->input->post("id");
        $mode=$this->input->post("mode"); 
        $this->db->set("kbm",$mode);
        $this->db->where("id",$id);
        return $this->db->update("tr_jurusan");
    }
    function update_status_kelas()
    {
        $id=$this->input->post("id");
        $mode=$this->input->post("mode"); 
        if($mode=="true"){
            $mode=1;
        }else{
            $mode=0;
        }
        $this->db->set("sts_kelas",$mode);
        $this->db->where("id",$id);
        return $this->db->update("tm_kelas");
    }

    function update_sikap()
    {
        $id=$this->input->post("id");
        $mode=$this->input->post("mode"); 
        if($mode=="true"){
            $mode=1;
        }else{
            $mode=0;
        }
        $this->db->set("id_sikap",$mode);
        $this->db->where("id",$id);
        return $this->db->update("tr_mapel");
    }
	function download_format_mapel()
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
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'ID TINGKAT');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'ID JURUSAN');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'NAMA MAPEL');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'KODE KATEGORY MAPEL');
      
    $objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
    $objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
    $objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
    $objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);

	 
		///------------------------///
		 
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:D1')->applyFromArray($style);
      
 
// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA MAPEL');
		
 
//<!-------------------------------------------------------------------------------  --->		
      
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID TINGKAT');
		$get=1;
        $objPHPExcel->addSheet($myWorkSheet, $get);
 
 
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('B')->setAutoSize(true);
    
        $objPHPExcel->getSheet($get)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet($get)->setCellValue('B1', 'TINGKAT');
        
        $objPHPExcel->getSheet($get)->getStyle('A1:B1')->applyFromArray($style);
		
        $datamapel = $this->db->query("select * from tr_tingkat")->result();
        $shit = 1;
        foreach ($datamapel as $listt) {
            $shit++;
            $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', $listt->id);
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', $listt->nama." - ".$listt->alias);
           
			
        }
       
//<!-------------------------------------------------------------------------------------->	
 
//<!-------------------------------------------------------------------------------  --->	
		$get=2;	
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'ID JURUSAN');
        $objPHPExcel->addSheet($myWorkSheet,$get);
 
 
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getSheet($get)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet($get)->setCellValue('B1', 'NAMA JURUSAN');
       
        $objPHPExcel->getSheet($get)->getStyle('A1:B1')->applyFromArray($style);
		
        $datamapel = $this->db->query("select * from tr_jurusan order by id asc")->result();
        $shit = 1;
        foreach ($datamapel as $list) {
            $shit++;
            $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', $list->id);
            $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', $list->nama);

        }
		 
//<!-------------------------------------------------------------------------------------->
	
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'KATEGORY');
		$get=3;
        $objPHPExcel->addSheet($myWorkSheet, $get);
 
 
        $objPHPExcel->getSheet($get)->getColumnDimension('A')->setAutoSize(true);
         $objPHPExcel->getSheet($get)->getColumnDimension('B')->setAutoSize(true);
        
        $objPHPExcel->getSheet($get)->setCellValue('A1', 'KODE');
         $objPHPExcel->getSheet($get)->setCellValue('B1', 'NAMA KATEGORY');
        
        $objPHPExcel->getSheet($get)->getStyle('A1:B1')->applyFromArray($style);
		
        $shit=2;
           
           $datak=$this->db->get("tr_kategory_mapel")->result();
           foreach($datak as $dk){
               $objPHPExcel->getSheet($get)->setCellValue('A' . $shit . '', $dk->kode);
                 $objPHPExcel->getSheet($get)->setCellValue('B' . $shit . '', $dk->nama);
                 $shit++;
           }
          
         //   $objPHPExcel->getSheet($get)->setCellValue('A' . $shit++ . '', "Normatif");
        //    $objPHPExcel->getSheet($get)->setCellValue('A' . $shit++ . '', "C1");
        //    $objPHPExcel->getSheet($get)->setCellValue('A' . $shit++ . '', "C2");
       //     $objPHPExcel->getSheet($get)->setCellValue('A' . $shit++ . '', "C3");
       //     $objPHPExcel->getSheet($get)->setCellValue('A' . $shit++ . '', "Muatan Lokal");
            

//<!-------------------------------------------------------------------------------------->	
   
//<!-------------------------------------------------------------------------------------->	      
	 
//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format-upload-Mapel.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
	
	 function get_open($tbl)
	{
		$query=$this->_get_datatables_open($tbl);
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file($tbl)
	{				
		$query = $this->_get_datatables_open($tbl);
        return  $this->db->query($query)->num_rows();
	}



	function get_rombel($tbl)
	{
		$query=$this->_get_datatables_rombel($tbl);
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file_rombel($tbl)
	{				
		$query = $this->_get_datatables_rombel($tbl);
        return  $this->db->query($query)->num_rows();
	}
	private function _get_datatables_rombel($tbl)
	{
		$jurusan=$this->input->post("jurusan");
		$tingkat=$this->input->post("tingkat");
		$filter="";
		if($jurusan)
		{
			$filter.="AND id_jurusan='".$jurusan."'";
		}
		if($tingkat)
		{
			$filter.="AND id_tk='".$tingkat."'";
		}
 
	$query="select * from ".$tbl."  where  1='1'   $filter ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			 alias LIKE '%".$searchkey."%'  or
			 nama LIKE '%".$searchkey."%'  or
			 nama_jurusan LIKE '%".$searchkey."%'  
			) ";
		}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		 
		$query.=" order by id  asc";
		 
		return $query;
	
	}	
	
	
	
	function get_mapel($tbl)
	{
		$query=$this->_get_datatables_mapel($tbl);
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file_mapel($tbl)
	{				
		$query = $this->_get_datatables_mapel($tbl);
        return  $this->db->query($query)->num_rows();
	}
	private function _get_datatables_mapel($tbl)
	{
		$jurusan=$this->input->post("jurusan");
		$tingkat=$this->input->post("tingkat");
		$filter="";
		if($jurusan)
		{
			$filter.="AND id_jurusan='".$jurusan."'";
		}
		if($tingkat)
		{
			$filter.="AND id_tk='".$tingkat."'";
		}
 
	$query="select * from ".$tbl."  where  1='1'   $filter ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			 k_mapel LIKE '%".$searchkey."%'  or
			 nama LIKE '%".$searchkey."%'   
			) ";
		}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		 
		$query.=" order by id_tk,id_jurusan,nama asc";
		 
		return $query;
	
	}	
	
	
	
	
	
	
	
	  function dataProfile()
	 {
		$idu=$this->session->userdata("id");
		$this->db->where("id_admin",$idu);
		return $this->db->get("admin")->row();
		 
	 }
	private function _get_datatables_open($tbl)
	{
		$pilihan=$this->input->post("pilihan");
		$filter="";
		if($pilihan)
		{
			$filter.="AND id_persyaratan='".$pilihan."'";
		}
	$idu=$this->session->userdata("id");
	$query="select * from ".$tbl."  where  1='1'   $filter ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			 nama LIKE '%".$searchkey."%'  
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
		$query.=" order by nama asc";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}	///-----------------------------------ajax//
 
	 
	
	 
	function hapus($tbl,$id)
	{	
		 
		$this->db->where("id",$id);
	return	$this->db->delete($tbl);
		
	}
	
	function update($tbl)
	{	
		$var=array();
		$var["size"]="true"; 
		$var["file"]="true";
		$var["validasi"]="true"; 
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
	
				
				$id=$this->input->post("id_");
				$this->db->where("id",$id);
				$this->db->update($tbl,$data);
				return $var;
 
	}
 
	 function insert($tbl)
	{	
		$var=array();
		$var["size"]="true"; 
		$var["file"]="true";
		$var["validasi"]="true"; 
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
				$this->db->insert($tbl,$data);
				return $var;
 
	}
 
	 
	function digunakan($tbl,$id)
	{
		$this->db->where("id",$id);
		return $this->db->get($tbl)->num_rows();
	}
	
	function add_kelas()
	{
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
	return	$this->db->insert("tm_kelas",$data);
	}
	
	function update_rombel()
	{
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		$this->db->where("id",$this->input->post("id"));
	return	$this->db->update("tm_kelas",$data);
	}
	function hapus_kelas($id)
	{
		$this->db->where("id",$id);
		return	$this->db->delete("tm_kelas");
	}
	/*==============MAPL===================*/
	function hapus_mapel($id)
	{
		$this->db->where("id",$id);
		return	$this->db->delete("tr_mapel");
	}
	function cekMapel($id_tk,$id_jurusan,$nama,$id=null)
	{
		$this->db->where("id_tk",$id_tk);
		$this->db->where("id_jurusan",$id_jurusan);
		$this->db->where("nama",$nama);
		if($id){
		$this->db->where("id!=",$id);
		}
	return	$this->db->get("tr_mapel")->num_rows();
	}
	function add_mapel()
	{
		$id_tk=$this->input->post("f[id_tk]");
		$id_jurusan=$this->input->post("f[id_jurusan]");
		$nama=$this->input->post("f[nama]");
		$cek=$this->cekMapel($id_tk,$id_jurusan,$nama);
			$id_mapel_induk=$this->input->post("f[id_mapel_induk]");
		if($cek)
		{
			$var["mapel_duplicate"]=true;
		}else{
				$input=$this->input->post("f");
				$data=$this->security->xss_clean($input);
				if(!$id_mapel_induk){
				    unset($data['id_mapel_induk']);
				}
				$this->db->insert("tr_mapel",$data);
				$var["mapel_duplicate"]=false;
		}
		return $var;
	}
	function update_mapel()
	{
		$id=$this->input->post("id");
		$id_tk=$this->input->post("f[id_tk]");
		$id_jurusan=$this->input->post("f[id_jurusan]");
		$id_mapel_induk=$this->input->post("f[id_mapel_induk]");
		$nama=$this->input->post("f[nama]");
		$cek=$this->cekMapel($id_tk,$id_jurusan,$nama,$id);
		if($cek)
		{
			$var["mapel_duplicate"]=true;
		}else{
				$input=$this->input->post("f");
				$data=$this->security->xss_clean($input);
				if(!$id_mapel_induk){
				    unset($data['id_mapel_induk']);
				}
				$this->db->where("id",$id);
				$this->db->update("tr_mapel",$data);
				$var["mapel_duplicate"]=false;
		}
		return $var;
	}
	
	function import_data_mapel()
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
				return $this->importMapel("file");
			 
		}else{
				return $var;
		}
		
	}

function cek_mapel($tk,$jurusan,$nama)
{
			$this->db->where("id_tk",$tk);
			$this->db->where("id_jurusan",$jurusan);
			$this->db->where("UCASE(nama)",strtoupper($nama) );
	return  $this->db->get("tr_mapel")->num_rows();
}

function importMapel($file_form)
{		
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
						
						 $tk=isset($sheet[0])?($sheet[0]):"";
						 $id_jurusan=isset($sheet[1])?($sheet[1]):"";
						 $nama=isset($sheet[2])?($sheet[2]):"";						 
						 $kategory=isset($sheet[3])?($sheet[3]):"";						 
						$cek_mapel=$this->cek_mapel($tk,$id_jurusan,$nama);
						if($cek_mapel){
							$edit++;
						}else{
							$dataray=array(
								"nama"=>$nama,
								"id_tk"=>$tk,
								"id_jurusan"=>$id_jurusan,
								"k_mapel"=>$kategory,
								);
							$this->db->insert("tr_mapel",$dataray);
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
}
 