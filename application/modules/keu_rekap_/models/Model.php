<?php

class Model extends CI_Model  {
    
 
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	 function namaBiaya($id,$jenis=null)
	{
		
			$return=$this->m_reff->goField("keu_tr_biaya_pokok","nama","where id='".$id."'");
		if($return)
		{
			return $return;
		}else{
			return  $this->m_reff->goField("keu_tr_biaya_tetap","nama_biaya","where kode='".$id."'");
		}
	}
	 function getDataSiswa()
	{
		$query=$this->_getDataSiswa();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getDataSiswa()
	{	$g=$filter="";
	$id_kelas=$this->input->get_post("id_kelas");
	$alumni=$this->input->get_post("alumni");
	$tagihan=$this->input->get_post("tagihan");
	$stagihan=$this->input->get_post("stagihan");
	if($alumni=="1")
	{
		$filter.=" AND id_siswa IN (SELECT id from data_siswa where id_tahun_keluar IS NOT NULL ) ";
	}else{
	 
		if($id_kelas)
		{
			$filter.=" AND id_siswa IN (SELECT id from data_siswa where id_kelas='".$id_kelas."' and id_tahun_keluar IS NULL ) ";
		}
	}
	
	if($stagihan==1)
		{
			$g=" HAVING sisa <= 0 ";
		}elseif($stagihan==2)
		{
			$g=" HAVING sisa > 0";
		}
	
		if($tagihan)
		{
			$filter.=" AND id_tagihan ='".$tagihan."' ";
		} 
		$query="SELECT id_siswa,SUM(tagihan) AS tagihan,SUM( CASE WHEN bayar IS NULL THEN 0 ELSE  bayar END  ) AS bayar,
		(SUM(tagihan) - SUM( CASE WHEN bayar IS NULL THEN 0 ELSE bayar END ) ) AS sisa
		FROM keu_tagihan_pokok  where 1=1  AND (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' OR tgl_tagihan IS NULL)     ".$filter;
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				tagihan LIKE '%".$searchkey."%'   
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
		$query.=" GROUP BY id_siswa ".$g;
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_getDataSiswa()
	{				
		$query = $this->_getDataSiswa();
        return  $this->db->query($query)->num_rows();
	}



	function getDataGuru()
	{
		$query=$this->_getDataGuru();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getDataGuru()
	{	$g=$filter="";
	$sts=$this->input->get_post("sts");
	$pinjamanf=$this->input->get_post("pinjamanf");
     
	 
	
	 
	 
		$query="SELECT  * from data_pegawai  where aktifasi=1 ".$filter;
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
		$query.=" order by nama ASC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_getDataGuru()
	{				
		$query = $this->_getDataGuru();
        return  $this->db->query($query)->num_rows();
	}
	
	
	
	
	function hitungTunggakan($id_tagihan,$tagihan,$id_siswa)
	{
		$cek=$this->m_reff->goField("data_siswa","id_tahun_keluar","where id='".$id_siswa."' "); //apakah alumni
		if($cek)
		{
			return $tagihan;
		}else{
			$jml=$this->tagihanNext($id_tagihan,$id_siswa);
			return $tagihan-$jml;
		}
	}
	function tagihanNext($id_tagihan,$id_siswa)
	{	
	if($id_tagihan)
	{
		$filter=" AND id_tagihan='".$id_tagihan."'";
	}else{
		$filter="";
	}
		$ym=$this->tanggal->tambahBln(date('Y-m'),1);
		$q=$this->db->query("SELECT  SUM(tagihan) AS tagihan FROM keu_tagihan_pokok WHERE id_siswa='".$id_siswa."' AND
		bayar is null
		AND tgl_tagihan >= '".date(''.$ym.'-01')."'  ".$filter)->row();
		return $q->tagihan;
	}
	function stsSPP($id_siswa)
	{
		$data=$this->db->query("SELECT (tagihan-(CASE WHEN bayar IS NULL THEN 0 ELSE  bayar END))as sisa from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='1' and SUBSTR(tgl_tagihan,1,7)='".date('Y-m')."'  ")->row();
		return isset($data->sisa)?($data->sisa):"0";
	}
	function stsTagihan($tagihan,$id_siswa)
	{
		if($tagihan)
		{
		$data=$this->db->query("SELECT SUM((tagihan-(CASE WHEN bayar IS NULL THEN 0 ELSE  bayar END)))as sisa from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$tagihan."' 
		and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL) and sts='1'  ")->row();
		}else{
			$data=$this->db->query("SELECT SUM((tagihan-(CASE WHEN bayar IS NULL THEN 0 ELSE  bayar END)))as sisa from keu_tagihan_pokok where id_siswa='".$id_siswa."' 
			and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL) and sts='1'   ")->row();
		}
		return isset($data->sisa)?($data->sisa):"0";
	}function telahBayar($tagihan,$id_siswa)
	{
		if($tagihan)
		{
		$data=$this->db->query("SELECT SUM(bayar) as bayar from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$tagihan."' 
		and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL) and sts='1'  ")->row();
		}else{
			$data=$this->db->query("SELECT SUM(bayar) as bayar from keu_tagihan_pokok where id_siswa='".$id_siswa."' 
			and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL) and sts='1'  ")->row();
		}
		return isset($data->bayar)?($data->bayar):"0";
	}function jumlahTagihan($tagihan,$id_siswa)
	{
		if($tagihan)
		{
			$data=$this->db->query("SELECT SUM(tagihan) as tagihan from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$tagihan."' 
			and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL) and sts='1' ")->row();
		}else{
			$data=$this->db->query("SELECT SUM(tagihan) as tagihan from keu_tagihan_pokok where id_siswa='".$id_siswa."' 
			and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL) and sts='1'   ")->row();
		}
		return isset($data->tagihan)?($data->tagihan):"0";
	}
	function jml_pinjaman($id)
	{
		$data=$this->db->query("select sum(jumlah_pinjaman) as jml from keu_pinjaman where id_guru='".$id."'")->row();
			$return1=isset($data->jml)?($data->jml):"0";
			
		$data=$this->db->query("select sum(nominal) as jml from keu_bayar_pinjaman where id_guru='".$id."'")->row();
			$return2=isset($data->jml)?($data->jml):"0";
			return $return1-$return2;
	}
	function jml_simpanan($id)
	{
		if($id!=null){
		$this->db->where("id_guru",$id);
		}
		$this->db->select("SUM(nominal) as nominal");
		$return=$this->db->get("keu_simpanan")->row();
		$return=isset($return->nominal)?($return->nominal):"0";
		
			if($id!=null){
		$this->db->where("id_guru",$id);
		}
		$this->db->select("SUM(nominal) as nominal");
		$data=$this->db->get("keu_tarik_tabungan")->row();
			$return1=isset($data->nominal)?($data->nominal):"0";
			
		return $return-$return1;
	}
	function edit_staf()
	{
		$id=$this->input->post("id");
		$form=$this->input->post("f");
		$form=str_replace(".","",$form);
		$this->db->set($form);
		$this->db->where("id",$id);
		return $this->db->update("data_pegawai");
	}
	 
}