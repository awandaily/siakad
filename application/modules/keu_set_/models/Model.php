<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
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

	function get_tagihan($tbl)
	{
		$query=$this->_get_datatables_tagihan($tbl);
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file_tagihan($tbl)
	{				
		$query = $this->_get_datatables_tagihan($tbl);
        return  $this->db->query($query)->num_rows();
	}
	private function _get_datatables_tagihan($tbl)
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
			 
			 nama_biaya LIKE '%".$searchkey."%'  or
			 kode LIKE '%".$searchkey."%'  or
			 biaya LIKE '%".$searchkey."%'  
			) ";
		}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		 
		$query.=" order by kode  asc";
		 
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
		$query.=" order by id asc";
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
	
	function add_biaya()
	{	$pengurutan=null;$nama_tambahan="";
		$kelipatan=$this->input->post("kelipatan");
		$kode=$this->input->post("kode");
		$nominal=$this->input->post("nominal");
		$nominal=str_replace(".","",$nominal);
		
		$id_jurusan=$this->input->post("id_jurusan");
		if(!$id_jurusan)
		{
			$this->db->set("id_jurusan",null);
		}else{
			$this->db->set("id_jurusan",$id_jurusan);
		}
		
		$id_tk=$this->input->post("id_tk");
		if(!$id_tk)
		{
			$this->db->set("id_tk",null);
		}else{
			$this->db->set("id_tk",$id_tk);
		}
		
		if($kelipatan==36)
		{
			$bln_kelipatan=1;
			$pengurutan=2; $nama_tambahan="Bulan";
		}elseif($kelipatan==6 || $kelipatan==4)
		{
			$bln_kelipatan=6;$pengurutan=1; $nama_tambahan="Semester";
		}
		
		$cekod=$this->db->get_where("keu_tr_biaya_tetap",array("kode"=>$kode))->num_rows();
		if($cekod)
		{
			$var["jadwal_duplicate"]=false;
			return $var;
		}			
		
		
		$this->db->set("kode",$kode);
		$this->db->set("biaya",$nominal);
		$this->db->set("bln_kelipatan",$bln_kelipatan);
		$this->db->set("kelipatan",$kelipatan);
		$this->db->set("pengurutan",$pengurutan);
		$this->db->set("nama_tambahan",$nama_tambahan);
		
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
	return	$this->db->insert("keu_tr_biaya_tetap",$data);
	}
	function update_biaya()
	{	$pengurutan=null;$nama_tambahan="";
		$kelipatan=$this->input->post("kelipatan");
		$kode=$this->input->post("kode");
		$nominal=$this->input->post("nominal");
		$nominal=str_replace(".","",$nominal);
		
		$id_jurusan=$this->input->post("id_jurusan");
		if(!$id_jurusan)
		{
			$this->db->set("id_jurusan",null);
		}else{
			$this->db->set("id_jurusan",$id_jurusan);
		}
		
		$id_tk=$this->input->post("id_tk");
		if(!$id_tk)
		{
			$this->db->set("id_tk",null);
		}else{
			$this->db->set("id_tk",$id_tk);
		}
		
		if($kelipatan==36)
		{
			$bln_kelipatan=1;
			$pengurutan=2; $nama_tambahan="Bulan";
		}elseif($kelipatan==6 || $kelipatan==4)
		{
			$bln_kelipatan=6;$pengurutan=1; $nama_tambahan="Semester";
		}else{
			$bln_kelipatan=1;
		}
		$this->db->where("id!=",$this->input->post("id"));
		$cekod=$this->db->get_where("keu_tr_biaya_tetap",array("kode"=>$kode))->num_rows();
		if($cekod)
		{
			$var["jadwal_duplicate"]=false;
			return $var;
		}			
		
		
		$this->db->set("kode",$kode);
		$this->db->set("biaya",$nominal);
		$this->db->set("bln_kelipatan",$bln_kelipatan);
		$this->db->set("kelipatan",$kelipatan);
		$this->db->set("pengurutan",$pengurutan);
		$this->db->set("nama_tambahan",$nama_tambahan);
		
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		$this->db->where("id",$this->input->post("id"));
	return	$this->db->update("keu_tr_biaya_tetap",$data);
	}
	
	function update_tagihan()
	{
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		$this->db->where("id",$this->input->post("id"));
	return	$this->db->update("tm_kelas",$data);
	}
	function hapus_tagihan($id)
	{
		$this->db->where("id",$id);
		return	$this->db->delete("keu_tr_biaya_tetap");
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
		
		if($cek)
		{
			$var["mapel_duplicate"]=true;
		}else{
				$input=$this->input->post("f");
				$data=$this->security->xss_clean($input);
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
		$nama=$this->input->post("f[nama]");
		$cek=$this->cekMapel($id_tk,$id_jurusan,$nama,$id);
		if($cek)
		{
			$var["mapel_duplicate"]=true;
		}else{
				$input=$this->input->post("f");
				$data=$this->security->xss_clean($input);
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
						 $sts=isset($sheet[3])?($sheet[3]):"";						 
						$cek_mapel=$this->cek_mapel($tk,$id_jurusan,$nama);
						if($cek_mapel){
							$edit++;
						}else{
							$dataray=array(
								"nama"=>$nama,
								"id_tk"=>$tk,
								"id_jurusan"=>$id_jurusan,
								"sts"=>$sts,
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
 