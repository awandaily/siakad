<?php

class Model extends CI_Model  {
    
	var $tbl="tm_tagihan";
	var $tbl_bayar="tm_pembayaran";
	var $v_bayar="v_bayar";
	var $bank="tr_bank";
	var $tbl_log="data_siswa";
	var $thn="tr_tahun_ajaran";
 	function __construct()
    {
        parent::__construct();
    }
	function namaBiaya($id,$jenis=null)
	{
		
			$return=$this->m_reff->goField("keu_tr_biaya_tetap","nama","where id='".$id."'");
		if($return)
		{
			return $return;
		}else{
			return  $this->m_reff->goField("keu_tr_biaya_tetap","nama_biaya","where kode='".$id."'");
		}
	}
	function idu()
	{
		return $this->session->userdata("id");
	}
	function nis()
	{
		$this->db->select("nis");
		$this->db->limit(1);
		$this->db->where("id",$this->idu());
		return $this->db->get($this->tbl_log)->row()->nis;
	}
	function noid()
	{
		$this->nis();
	}
	function tahun()//tahun awal pelajaran
	{
		$this->db->where("id",$this->idu());
		$this->db->select("id_tahun_masuk");
		$data=$this->db->get($this->tbl_log)->row();
		$id_tahun_masuk=isset($data->id_tahun_masuk)?($data->id_tahun_masuk):"";
		$hasil=$this->db->get($this->thn,array("id"=>$id_tahun_masuk))->row();
		$return=isset($hasil->nama)?($hasil->nama):"";
		return substr($return,0,4);
	}
	/*===================================*/
	function get_data_tagihan()
	{
		$query=$this->_get_data_tagihan();
		if(isset($_POST['length'])?($_POST['length']):"" != -1)
		$query.=" limit ". $_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_tagihan()
	{
		$now=date("Y-m-d");
		$query="select * from ".$this->tbl." where  1=1  ";
			if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama_tagihan LIKE '%".$searchkey."%'  
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
	
	public function count_tagihan()
	{				
		$query = $this->_get_data_tagihan();
        return  $this->db->query($query)->num_rows();
	}
	/*===================================*/
	
	
	
	
	
	
	
	/*===================================*/
	function get_data_transaksi()
	{
		$query=$this->_get_data_transaksi();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_transaksi()
	{
		$now=date("Y-m-d");
		$query="select * from ".$this->v_bayar." where nis='".$this->nis()."'   ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama_tagihan LIKE '%".$searchkey."%'  
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
		$query.=" order by id DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_trx()
	{				
		$query = $this->_get_data_transaksi();
        return  $this->db->query($query)->num_rows();
	}
	
	
	
	/*===================================*/
	function getHistory()
	{
		$query=$this->_getHistory();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getHistory()
	{	$filter="";
		$tgl=$this->input->post("tgl");
	//	$tgl1=$this->tanggal->range_1($tgl);
	//	$tgl2=$this->tanggal->range_2($tgl);
		$nis=$this->input->post("nis");
		$id_siswa=$this->input->post("id_siswa");
		if($nis)
		{
			$id_siswa=$this->m_reff->goField("data_siswa","id","where (nis='".$nis."' or nisn='".$nis."')");
			$filter.=" AND id_siswa='".$id_siswa."' ";
		}
		if($id_siswa)
		{
			 
			$filter.=" AND id_siswa='".$id_siswa."' ";
		}
		
		
	
		$query="SELECT * ,SUM(nominal_bayar)  AS nominal FROM keu_tm_bayar  where id_siswa='".$this->m_reff->id_siswa_ortu()."'   ".$filter." GROUP BY tgl_bayar,id_siswa ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama_tagihan LIKE '%".$searchkey."%'  
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
		$query.=" order by tgl_bayar desc ";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count__getHistory()
	{				
		$query = $this->_getHistory();
        return  $this->db->query($query)->num_rows();
	}
	
 
	/*===================================*/
	 
	  
  function stsTagihan($tagihan,$id_siswa)
	{
		if($tagihan)
		{
		$data=$this->db->query("SELECT SUM((tagihan-(CASE WHEN bayar IS NULL THEN 0 ELSE  bayar END)))as sisa from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$tagihan."' 
		and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL)  and sts='1' ")->row();
		}else{
			$data=$this->db->query("SELECT SUM((tagihan-(CASE WHEN bayar IS NULL THEN 0 ELSE  bayar END)))as sisa from keu_tagihan_pokok where id_siswa='".$id_siswa."' 
			and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL) and sts='1'  ")->row();
		}
		return isset($data->sisa)?($data->sisa):"0";
	}
	 function jumlahTagihan($tagihan,$id_siswa)
	{
		if($tagihan)
		{
		$data=$this->db->query("SELECT SUM(tagihan) as tagihan from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$tagihan."' 
		and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL) and sts='1' ")->row();
		}else{
			$data=$this->db->query("SELECT SUM(tagihan) as tagihan from keu_tagihan_pokok where id_siswa='".$id_siswa."' 
			and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL)  and sts='1'  ")->row();
		}
		return isset($data->tagihan)?($data->tagihan):"0";
	}
	 function telahBayar($tagihan,$id_siswa)
	{
		if($tagihan)
		{
		$data=$this->db->query("SELECT SUM(bayar) as bayar from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$tagihan."' 
		and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL)  and sts='1' ")->row();
		}else{
			$data=$this->db->query("SELECT SUM(bayar) as bayar from keu_tagihan_pokok where id_siswa='".$id_siswa."' 
			and (SUBSTR(tgl_tagihan,1,7)<='".date('Y-m')."' or tgl_tagihan IS NULL)  and sts='1' ")->row();
		}
		return isset($data->bayar)?($data->bayar):"0";
	}
}