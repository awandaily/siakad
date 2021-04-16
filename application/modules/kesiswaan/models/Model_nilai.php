<?php

class Model_nilai extends CI_Model  {
    
	var $tbl="data_nilai";
	var $tbl_jadwal="tm_jadwal_mengajar";
	var $tbl_log="data_pegawai";
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}

	function setKet($ket, $code){

		$dt = array(
				"nama_nilai"	=> $ket
			);
		$this->db->where("code", $code);
		$this->db->update("data_nilai", $dt);
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
		$id_kelas=$this->input->post("id_kelas");
		$id_mapel=$this->input->post("id_mapel");
		$sms=$this->m_reff->semester();
		$k_nilai=$this->input->post("k_nilai");
		$id_kikd=$this->input->post("id_kikd");
		 
		$filter="";
		if($id_kelas)
		{
			$filter.="AND id_kelas='".$id_kelas."' ";
		} 
		if($id_mapel)
		{
			$filter.="AND id_mapel='".$id_mapel."' ";
		} if($id_kikd)
		{
		     $codekd=$this->m_reff->goField("tm_kikd","code","where id='$id_kikd' ");
		 $get=$this->db->query("select id from tm_kikd where code='$codekd'  ")->result();
		 $idkd="";
		 foreach($get as $cd)
		 {
		     $idkd.=$cd->id.",";
		 }
	    	$id_kikd=$this->m_reff->clearkoma($idkd);
			$filter.="AND id_kikd IN (".$id_kikd.") ";
		} 
	 
		 
			$filter.="AND id_semester='".$sms."' ";
		 
		 if($k_nilai)
		{
			$filter.="AND id_kategory_nilai='".$k_nilai."' ";
		} 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 //#and substr(_ctime,1,10)>='".$this->m_reff->tgl_pergantian()."' 
		$query="SELECT * FROM ".$this->tbl." where id_guru='".$this->idu()."' AND id_semester='".$sms."' and id_tahun='".$tahun."'	$filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama_nilai LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		if($k_nilai==1){
		    	$query.=" GROUP BY code,nama_nilai,id_mapel,id_kikd,id_semester,id_kelas ";
		}else{
		   	$query.=" GROUP BY code,nama_nilai,id_mapel,id_semester,id_kelas "; 
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
	
	public function count()
	{				
		$query = $this->_get_data();
        return  $this->db->query($query)->num_rows();
	}
	 
	 
	function insertNilai($array) 
	{		
			
			$cek=$this->cekNilai($array);
			
			$nilai=$this->security->xss_clean($this->input->post("nilai"));
			$nilai=str_replace(",",".",$nilai);
			if($nilai=="")
			{
				$nilai=null;
			}
			
			if($cek)
			{			$this->m_konfig->log($this->tbl,"Update Nilai",$this->tbl_log);///insert log
						$this->db->set("_uid",$this->session->userdata("id"));
						$this->db->set("_utime",date("Y-m-d H:i:s"));
						$this->db->set("nilai",$nilai);
					//	$this->db->set("id_tahun",$this->m_reff->tahun());
						$this->db->where($array);
				return	$this->db->update($this->tbl,$array);
			}else{
				$this->m_konfig->log($this->tbl,"Input Nilai",$this->tbl_log);///insert log
				$this->db->set("nilai",$nilai);
				$this->db->set("code",$this->session->userdata("code"));
				//$this->db->set("id_tahun",$this->m_reff->tahun());
				$this->db->set("_cid",$this->session->userdata("id"));
				return	$this->db->insert($this->tbl,$array);
			}
	
	}
	function insertNilaiSikap($array) 
	{		
			
			$cek=$this->cekNilaiSikap($array);
			
			$nilai=$this->security->xss_clean($this->input->post("nilai"));
			$id_sikap=$this->security->xss_clean($this->input->post("sts"));
			$nilai=str_replace(",",".",$nilai);
			if($nilai=="")
			{
				$nilai=null;
			}
			
			if($cek)
			{			$this->m_konfig->log($this->tbl,"Update Nilai sikap",$this->tbl_log);///insert log
						$this->db->set("_uid",$this->session->userdata("id"));
						$this->db->set("_utime",date("Y-m-d H:i:s"));
						$this->db->set("nilai".$id_sikap,$nilai);
						$this->db->where($array);
				return	$this->db->update("tm_sikap",$array);
			}else{
				$this->m_konfig->log($this->tbl,"Input Nilai",$this->tbl_log);///insert log
				$this->db->set("nilai".$id_sikap,$nilai);
				$this->db->set("_cid",$this->session->userdata("id"));
				return	$this->db->insert("tm_sikap",$array);
			}
	
	}
	function insertNilaiSikap2($array) 
	{		
			
			$cek=$this->cekNilaiSikap($array);
			
			$nilai=$this->security->xss_clean($this->input->post("nilai"));
			//$id_sikap=$this->security->xss_clean($this->input->post("sts"));
			//$nilai=str_replace(",",".",$nilai);
			if($nilai=="")
			{
				$nilai=null;
			}
			
			if($cek)
			{			$this->m_konfig->log($this->tbl,"Update Nilai sikap",$this->tbl_log);///insert log
						$this->db->set("_uid",$this->session->userdata("id"));
						$this->db->set("_utime",date("Y-m-d H:i:s"));
						$this->db->set("nilai",$nilai);
						$this->db->where($array);
				return	$this->db->update("tm_sikap",$array);
			}else{
				$this->m_konfig->log($this->tbl,"Input Nilai",$this->tbl_log);///insert log
				$this->db->set("nilai",$nilai);
				$this->db->set("_cid",$this->session->userdata("id"));
				return	$this->db->insert("tm_sikap",$array);
			}
	
	}
	
	function importNilaiSikap($array,$nilai) 
	{					
			$cek=$this->cekNilaiSikap($array);
			$nilai=$this->security->xss_clean($nilai);

			$nilai=str_replace(",",".",$nilai);
			$nilai=str_replace("'","",$nilai);
			$nilai=str_replace("`","",$nilai);
			
			if($nilai=="")
			{
				$nilai=null;
			}
			
			if($cek)
			{			$this->m_konfig->log($this->tbl,"Update Nilai sikap",$this->tbl_log);///insert log
						$this->db->set("_uid",$this->session->userdata("id"));
						$this->db->set("_utime",date("Y-m-d H:i:s"));
						$this->db->set($nilai);
						$this->db->where($array);
				return	$this->db->update("tm_sikap",$array);
			}else{
				$this->m_konfig->log($this->tbl,"Input Nilai",$this->tbl_log);///insert log
				$this->db->set($nilai);
				$this->db->set("_cid",$this->session->userdata("id"));
				return	$this->db->insert("tm_sikap",$array);
			}
	
	}
	function importNilaiSikap2($array,$nilai) 
	{					
			$cek=$this->cekNilaiSikap($array);
			$nilai=$this->security->xss_clean($nilai);
			
			if($nilai=="")
			{
				$nilai=null;
			}
			
			if($cek)
			{			$this->m_konfig->log($this->tbl,"Update Nilai sikap",$this->tbl_log);///insert log
						$this->db->set("_uid",$this->session->userdata("id"));
						$this->db->set("_utime",date("Y-m-d H:i:s"));
						$this->db->set($nilai);
						$this->db->where($array);
				return	$this->db->update("tm_sikap",$array);
			}else{
				$this->m_konfig->log($this->tbl,"Input Nilai",$this->tbl_log);///insert log
				$this->db->set($nilai);
				$this->db->set("_cid",$this->session->userdata("id"));
				return	$this->db->insert("tm_sikap",$array);
			}
	
	}
	function insertNilaiKi($array) 
	{		
			
			$cek=$this->cekNilai($array);
			
			$nilai=$this->security->xss_clean($this->input->post("nilai"));
			$nilai=str_replace(",",".",$nilai);
			if($nilai=="")
			{
				$nilai=null;
			}
			
			if($cek)
			{			$this->m_konfig->log($this->tbl,"Update Nilai",$this->tbl_log);///insert log
						$this->db->set("_uid",$this->session->userdata("id"));
						$this->db->set("_utime",date("Y-m-d H:i:s"));
						$this->db->set("nilai_ki",$nilai);
						$this->db->set("id_tahun",$this->m_reff->tahun());
						$this->db->where($array);
				return	$this->db->update($this->tbl,$array);
			}else{
				$this->m_konfig->log($this->tbl,"Input Nilai",$this->tbl_log);///insert log
				$this->db->set("nilai_ki",$nilai);
				$this->db->set("id_tahun",$this->m_reff->tahun());
				$this->db->set("_cid",$this->session->userdata("id"));
				return	$this->db->insert($this->tbl,$array);
			}
	
	}
	function cekNilai($array)
	{
		$this->db->where($array);
	return	$this->db->get($this->tbl)->num_rows();
	}
	function cekNilaiSikap($array)
	{
		$this->db->where($array);
	return	$this->db->get("tm_sikap")->num_rows();
	}
	
	function updateSetNamaNilai($array)
	{
		$nama=$this->security->xss_clean($this->input->post("nama"));
		$this->db->where($array);
		$this->db->set("nama_nilai",$nama);
	return	$this->db->update($this->tbl);
	}
	
	function updateSetKaNilai($array)
	{
		$ka_nilai=$this->security->xss_clean($this->input->post("ka_nilai"));
		$id_kikd=$this->security->xss_clean($this->input->post("id_kikd"));
		if(!$id_kikd){ $id_kikd=null;}
		$this->db->where($array);
		$this->db->set("id_kategory_nilai",$ka_nilai);
		$this->db->set("id_kikd",$id_kikd);
	return	$this->db->update($this->tbl);
	}
	
	function hapus_nilai($id)
	{	$this->m_konfig->log($this->tbl,"Hapus Data Nilai",$this->tbl_log);///insert log
		$data=$this->db->get_where($this->tbl,array("id"=>$id))->row();
		$row=array(
		"id_guru"=>$this->session->userdata("id"),
		"id_mapel"=>$data->id_mapel,
		"id_kelas"=>$data->id_kelas,
		"nama_nilai"=>$data->nama_nilai,
		"id_kategory_nilai"=>$data->id_kategory_nilai,
		"id_kikd"=>$data->id_kikd,
		"id_semester"=>$data->id_semester,
		"code"=>$data->code,
		);
		
		$this->db->where($row);
		return $this->db->delete($this->tbl);
	}
	function getNilaiSiswa($attr,$id_siswa)
	{		$tahun=$this->m_reff->tahun();
		$this->db->where($attr);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$id_siswa);
		$data=$this->db->get($this->tbl)->row();
		return isset($data->nilai)?($data->nilai):"";
	}function getNilaiSiswaKi($attr,$id_siswa)
	{		$tahun=$this->m_reff->tahun();
		$this->db->where("id_tahun",$tahun);
		$this->db->where($attr);
		$this->db->where("id_siswa",$id_siswa);
		$data=$this->db->get($this->tbl)->row();
		return isset($data->nilai_ki)?($data->nilai_ki):"";
	}
	 
}