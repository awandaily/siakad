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
	function idu()
	{
		return $this->session->userdata("id");
	}
	 
	function id_siswa()
	{
		return $this->m_reff->id_siswa();
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
		$query="select * from ".$this->tbl." where id_siswa='".$this->id_siswa()."' and sts!='3'  ";
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
		$query="select * from ".$this->v_bayar." where id_siswa='".$this->id_siswa()."'   ";
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
	function getBank()
	{
	return	$this->db->get($this->bank)->result();
	}
	
	function getKonfirmasi($id)
	{
	return	$this->db->get_where($this->tbl,array("id"=>$id,"id_siswa"=>$this->id_siswa()));
	}
	function getDataKonfirmasi($id)
	{
	return	$this->db->get_where($this->v_bayar,array("id_bayar"=>$id,"id_siswa"=>$this->id_siswa()));
	}
	 
	function insKonfirmasi()
	{	
		$var=array();
		$var["size"]=""; 
		$var["file"]="";
		$var["validasi"]=false; 
		$var["token"]=true; 
		$polder=$this->tahun();//tahun awal angkatan masuk siswa
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["bukti_trf"]['tmp_name']))
		{
			$file=$this->m_reff->upload_file("bukti_trf","".$polder."/trf",$idu);
			if($file["validasi"]!=false)
			{
				$idt=$this->input->post("f[id_tagihan]");
				$nominal=$this->input->post("nominal");
				$tgl_trf=$this->input->post("tgl_trf");
				$tgl_trf=$this->tanggal->eng_($tgl_trf,"-");
				
				$this->setStsTagihan($idt,2);
					
				$this->db->set("id_siswa",$this->id_siswa());
				$this->db->set("bukti_trf",$file["name"]);
				$this->db->set("tgl_bayar",$this->security->xss_clean($tgl_trf));
				$this->db->set("nominal",$this->security->xss_clean(str_replace(".","",$nominal)));
			 	$this->db->set("_cid",$idu);
			
				$this->db->insert($this->tbl_bayar,$data);
				$this->m_konfig->log("tm_pembayaran","Melakukan konfirmasi pembayaran",$this->tbl_log);///insert log
				$this->session->unset_userdata("token");
				return $file;
			}else{
			return $file;
			}
		}else{
				return $var;
		}
		
	}
	
	function setStsTagihan($id,$sts)
	{		$this->db->set("sts",$sts);
			$this->db->where("id",$id);
	return	$this->db->update($this->tbl);
	}
	function telahDibayar($id)
	{
			$this->db->select("SUM(nominal) as jml");
			$this->db->where("id_tagihan",$id);
			$this->db->where("sts",3);
	return	$this->db->get($this->tbl_bayar)->row()->jml;
	}
}