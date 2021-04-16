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
	function input_pinjaman($id_guru,$tgl,$jumlah_pinjaman,$jumlah_cicilan,$ket) 
	{		$nama=$this->m_reff->goField("data_pegawai","nama","where id='".$id_guru."' ");
			$array=array(
			"id_guru"=>$id_guru,
			"nama_penerima"=>$nama,
			"tgl_pinjaman"=>$tgl,
			"jumlah_pinjaman"=>$jumlah_pinjaman,
			"jumlah_cicilan"=>$jumlah_cicilan,
			"ket"=>$ket,
			"_cid"=>$this->idu(),
			);
		return	$this->db->insert("keu_pinjaman",$array);
			
		/*	$ai=$this->db->query("SHOW TABLE STATUS LIKE 'keu_pinjaman'")->row();
			$ai=($ai->Auto_increment-1);
			$xx=array(
			"nama"=>"Pinjaman",
			"ket"=>$nama,
			"tgl"=>$tgl,
			"id_gaji"=>$ai,
			"nominal"=>$jumlah_pinjaman,
			"id_guru"=>$id_guru,
			"type"=>2, //1=untuk type pinjaman
			"_cid"=>$this->idu(),
			);
			return $this->db->insert("keu_data_pengeluaran",$xx);*/
			
			 
	}function input_simpanan($id_guru,$tgl,$jumlah,$ket,$kategory)
	{		$nama=$this->m_reff->goField("data_pegawai","nama","where id='".$id_guru."' ");
			$array=array(
			"id_guru"=>$id_guru,
			"sts"=>1,
			"kategory"=>$kategory,
		 	"tgl"=>$tgl,
			"nominal"=>$jumlah,
			"ket"=>$ket,
			"nama"=>$nama,
			"_cid"=>$this->idu(),
			);
			$this->db->insert("keu_simpanan",$array);
			return true;
	}function tarik_simpanan($id_guru,$tgl,$ket,$kategory,$jumlah)
	{			if(!$jumlah){ return false;}		 
			$nama=$this->m_reff->goField("data_pegawai","nama","where id='".$id_guru."' ");
			$array=array(
			"nama"=>"Pengambilan ".$this->m_reff->goField("keu_tr_stssimpanan","nama","where id='".$kategory."'"),
			"id_guru"=>$id_guru,
		 	"tgl"=>$tgl,
			"nominal"=>$jumlah,
			"kategory"=>$kategory,
			"ket"=>$nama,
			"_cid"=>$this->idu(),
			);
			$this->db->insert("keu_tarik_tabungan",$array);
		return true;
	}
	function input_honor($id_guru,$nama_honor,$jumlah_honor,$ket,$tgl)
	{	$code=date("dmYHis");	 
		foreach($id_guru as $val)
		{
			$nama=$this->m_reff->goField("data_pegawai","nama","where id='".$val."'");
			$array=array(
			"tgl_input"=>$tgl,
			"id_guru"=>$val,
			"nama_penerima"=>$nama,
			"nama"=>$nama_honor,
			"nominal"=>$jumlah_honor,
			"ket"=>$ket,
			"tgl_input"=>$tgl,
			"code"=>$code,
			"_cid"=>$this->idu(),
			);
			$this->db->insert("keu_honor",$array);
		}
		return true;
	}
	/*===========================*/
		function getHonor()
	{
		$query=$this->_getHonor();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getHonor()
	{	$filter="";
		 
		$query="select * from keu_honor group by keu_honor.code";
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
		$query.=" order by id desc ";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_getHonor()
	{				
		$query = $this->_getHonor();
        return  $this->db->query($query)->num_rows();
	}
	/*========pinjaman==============*/
		function getPinjaman()
	{
		$query=$this->_getPinjaman();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getPinjaman()
	{	$filter="";
		 
		$query="select * from keu_pinjaman where 1=1 ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama_penerima LIKE '%".$searchkey."%' OR 
				jumlah_cicilan LIKE '%".$searchkey."%' OR 
				jumlah_pinjaman LIKE '%".$searchkey."%'  
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
		$query.=" order by id desc ";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_getPinjaman()
	{				
		$query = $this->_getPinjaman();
        return  $this->db->query($query)->num_rows();
	}
	
	
	
	
		/*========simpanan==============*/
		function getSimpanan()
	{
		$query=$this->_getSimpanan();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getSimpanan()
	{	$filter="";
		 
		$query="select * from keu_simpanan where eksekusi=1 ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%' OR 
				nominal LIKE '%".$searchkey."%'  
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
		$query.=" order by id desc ";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_getSimpanan()
	{				
		$query = $this->_getSimpanan();
        return  $this->db->query($query)->num_rows();
	}
	
	
		/*========simpanan==============*/
		function getPengambilan()
	{
		$query=$this->_getPengambilan();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getPengambilan()
	{	$filter="";
		 
		$query="select * from keu_tarik_tabungan where 1=1 ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%' OR 
				ket LIKE '%".$searchkey."%' OR 
				nominal LIKE '%".$searchkey."%'  
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
		$query.=" order by id desc ";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_getAmbil()
	{				
		$query = $this->_getPengambilan();
        return  $this->db->query($query)->num_rows();
	}
	
	
	
	
	
	function hapusHonorSatuan($code,$id_guru)
	{
		$var["hasil"]="";
		$this->db->query("delete from keu_honor where code='".$code."' and id_guru='".$id_guru."' ");
		return $var;
	}function hapusPinjaman($id)
	{
		$var["hasil"]="";
		$this->db->query("delete from keu_pinjaman where id='".$id."'   ");
		return $var;
	}function hapusSimpanan($id)
	{
		$var["hasil"]="";
		$this->db->query("delete from keu_simpanan where id='".$id."'   ");
		return $var;
	}function hapusHonor($code)
	{
		$cek=$this->db->query("select * from keu_honor where  code='".$code."' and byr!='0' ")->num_rows();
		if($cek)
		{
			$var["hasil"]=false;
			return $var;
		}
		$var["hasil"]=true;
		$this->db->query("delete from keu_honor where code='".$code."'  ");
		return $var;
	}
	function updateNama($code,$nama)
	{
		 
		$this->db->set("nama",$nama);
		$this->db->where("code",$code);
	return	$this->db->update("keu_honor");
	}
		function updateNominal($code,$nominal)
	{
		  
		$this->db->set("nominal",$nominal);
		$this->db->where("code",$code);
	return	$this->db->update("keu_honor");
	}
	function updatePinjaman($id,$nominal) 
	{
		  
		$this->db->set("jumlah_pinjaman",$nominal);
		$this->db->where("id",$id);
	return	$this->db->update("keu_pinjaman");
	}function updateCicilan($id,$nominal) 
	{
		  
		$this->db->set("jumlah_cicilan",$nominal);
		$this->db->where("id",$id);
	return	$this->db->update("keu_pinjaman");
	}
	function getNominal($id,$sts)
	{
		$data=$this->db->query("select SUM(nominal) as jml from keu_simpanan where id_guru='".$id."'  and kategory='".$sts."'  ");
		if($data->num_rows()){
		$jml_tarik=$this->db->query("select SUM(nominal) as jml from keu_tarik_tabungan where id_guru='".$id."'  and kategory='".$sts."'  ");
			$max=$data->row()->jml-$jml_tarik->row()->jml;
		$var["nominal"]=number_format($max,0,",",".");
		$var["baca"]="Maksimal Pengambilan Rp ".number_format($max,0,",",".");
		}else{
			$var["nominal"]="";
			$var["baca"]="Tidak ada simpanan"; 
		}
		return $var;
	}
	function update_simpanan($id_edit,$nominal,$tgl,$ket)
	{
		$array=array(
		"nominal"=>$nominal,
		"tgl"=>$tgl,
		"ket"=>$ket,
		);
		$this->db->where("id",$id_edit);
	return	$this->db->update("keu_simpanan",$array);
	}function update_penarikan($id_edit,$nominal,$tgl)
	{
		$array=array(
		"nominal"=>$nominal,
		"tgl"=>$tgl,
		);
		$this->db->where("id",$id_edit);
	return	$this->db->update("keu_tarik_tabungan",$array);
	}
}