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


	function getBayar(){
		$idkelas 	= $_POST["idkelas"];
		$tgl1 		= $this->tanggal->eng_(substr($_POST["tgl"], 0,10), "-");
		$tgl2 		= $this->tanggal->eng_(substr($_POST["tgl"], 13,22), "-");
		
		$sl = "
			keu_tm_bayar.*,
			data_siswa.id AS siswa_id,
			data_siswa.id_kelas,
			data_siswa.nama,
			tm_kelas.id AS kelas_id,
			tm_kelas.id_tk
		";

		$this->db->select($sl);
		$this->db->from("keu_tm_bayar");
		$this->db->join("data_siswa", "data_siswa.id = keu_tm_bayar.id_siswa");
		$this->db->join("tm_kelas", "tm_kelas.id = data_siswa.id_kelas");	
		$this->db->where("tm_kelas.id_tk", $idkelas);
		$this->db->where("tgl_bayar >=", $tgl1);
		$this->db->where("tgl_bayar <=", $tgl2);
		$this->db->group_by("keu_tm_bayar.id_siswa");
		$d = $this->db->get()->result();


		return $d;
	}

	function sumBayar($id_tagihan, $id_siswa, $tgl){

		$tgl1 		= $this->tanggal->eng_(substr($tgl, 0,10), "-");
		$tgl2 		= $this->tanggal->eng_(substr($tgl, 13,22), "-");

		$sl = "
			SUM(keu_tm_bayar.nominal_bayar) AS jumlah,
			keu_tm_bayar.id_tagihan,
			keu_tm_bayar.id_siswa
		";
		$this->db->select($sl);
		$this->db->from("keu_tm_bayar");
		$this->db->where("tgl_bayar >=", $tgl1);
		$this->db->where("tgl_bayar <=", $tgl2);
		$this->db->where("id_tagihan", $id_tagihan);
		$this->db->where("id_siswa", $id_siswa);
		$d = $this->db->get()->row_array();

		return $d["jumlah"];
	}
	function getBayar_input(){
		$idkelas 	= $_POST["idkelas"];
		$tgl1 		= $this->tanggal->eng_(substr($_POST["tgl"], 0,10), "-");
		$tgl2 		= $this->tanggal->eng_(substr($_POST["tgl"], 13,22), "-");
		
		$sl = "
			keu_tm_bayar.*,
			data_siswa.id AS siswa_id,
			data_siswa.id_kelas,
			data_siswa.nama,
			tm_kelas.id AS kelas_id,
			tm_kelas.id_tk
		";

		$this->db->select($sl);
		$this->db->from("keu_tm_bayar");
		$this->db->join("data_siswa", "data_siswa.id = keu_tm_bayar.id_siswa");
		$this->db->join("tm_kelas", "tm_kelas.id = data_siswa.id_kelas");	
		$this->db->where("tm_kelas.id_tk", $idkelas);
		$this->db->where("tgl_bayar >=", $tgl1);
		$this->db->where("tgl_bayar <=", $tgl2);
		$this->db->where("gnr", 0);
		$this->db->group_by("keu_tm_bayar.id_siswa");
		$d = $this->db->get()->result();


		return $d;
	}

	function sumBayar_input($id_tagihan, $id_siswa, $tgl){

		$tgl1 		= $this->tanggal->eng_(substr($tgl, 0,10), "-");
		$tgl2 		= $this->tanggal->eng_(substr($tgl, 13,22), "-");

		$sl = "
			SUM(keu_tm_bayar.nominal_bayar) AS jumlah,
			keu_tm_bayar.id_tagihan,
			keu_tm_bayar.id_siswa
		";
		$this->db->select($sl);
		$this->db->from("keu_tm_bayar");
		$this->db->where("tgl_bayar >=", $tgl1);
		$this->db->where("tgl_bayar <=", $tgl2);
		$this->db->where("id_tagihan", $id_tagihan);
		$this->db->where("id_siswa", $id_siswa);
		$this->db->where("gnr", 0);
		$d = $this->db->get()->row_array();

		return $d["jumlah"];
	}
	/*
	function sumBayar($id_tagihan, $id_siswa, $tgl){

		$tgl1 		= $this->tanggal->eng_(substr($tgl, 0,10), "-");
		$tgl2 		= $this->tanggal->eng_(substr($tgl, 13,22), "-");

		$sl = "
			SUM(keu_tagihan_pokok.bayar) AS jumlah,
			keu_tagihan_pokok.id_tagihan,
			keu_tagihan_pokok.id_siswa
		";
		$this->db->select($sl);
		$this->db->from("keu_tagihan_pokok");
		$this->db->where("tgl_bayar >=", $tgl1);
		$this->db->where("sts",1);
		$this->db->where("tgl_bayar <=", $tgl2);
		$this->db->where("id_tagihan", $id_tagihan);
		$this->db->where("id_siswa", $id_siswa);
		$d = $this->db->get()->row_array();

		return $d["jumlah"];
	}
	*/

	 function namaBiaya($id,$jenis=null)
	{
		
			$return=$this->m_reff->goField("keu_tagihan_pokok","nama_tagihan","where id_tagihan='".$id."' limit 1");
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
	//	else if(isset($order))
	//	{
	//		$order = $order;
		//	$query.=" order by ".key($order)." ".$order[key($order)] ;
		$query.=" ORDER BY (SUM(tagihan) - SUM( CASE WHEN bayar IS NULL THEN 0 ELSE bayar END ) ) DESC ";
	//	}
		return $query;
	}
	
	public function count_getDataSiswa()
	{
		$query = $this->_getDataSiswa();
        return  $this->db->query($query)->num_rows();
	}



    //==================DATA TABLES REKAP KELAS ==================///
     function getDataKelas()
	{
		$query=$this->_getDataKelas();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getDataKelas()
	{	$g=$filter="";
	$id_tk=$this->input->get_post("id_tk");
	$id_jur=$this->input->get_post("id_jurusan"); 
	$tagihan=$this->input->get_post("tagihan");
 
	 
		if($id_tk)
		{
			$filter.=" AND  id_tk='".$id_tk."' ";
		}
 
    	if($id_jur)
		{
			$filter.=" AND  id_jurusan='".$id_jur."' ";
		}
 
	
	  
		$query="SELECT  * from v_kelas  where sts_kelas=1  ".$filter;
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
	//	$query.=" GROUP BY id_siswa ".$g;
		} 
	//	else if(isset($order))
	//	{
	//		$order = $order;
		//	$query.=" order by ".key($order)." ".$order[key($order)] ;
		$query.=" ORDER BY id_tk,id_jurusan,nama_kelas asc ";
	//	}
		return $query;
	}
	
	public function count_getDataKelas()
	{				
		$query = $this->_getDataKelas();
        return  $this->db->query($query)->num_rows();
	}



    //============================================================//






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
	function stsTagihan($tagihan,$id_siswa,$tgl=null)
	{
	    if($tgl){
	        $date=substr($tgl,0,7);
	    }else{
	        $date=date('Y-m');
	    }
	    
	    
		if($tagihan)
		{
		$data=$this->db->query("SELECT SUM((tagihan-(CASE WHEN bayar IS NULL THEN 0 ELSE  bayar END)))as sisa from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$tagihan."' 
		and (SUBSTR(tgl_tagihan,1,7)<='".$date."' or tgl_tagihan IS NULL) and sts='1'  ")->row();
		}else{
			$data=$this->db->query("SELECT SUM((tagihan-(CASE WHEN bayar IS NULL THEN 0 ELSE  bayar END)))as sisa from keu_tagihan_pokok where id_siswa='".$id_siswa."' 
			and (SUBSTR(tgl_tagihan,1,7)<='".$date."' or tgl_tagihan IS NULL) and sts='1'   ")->row();
		}
		return isset($data->sisa)?($data->sisa):"0";
	}

	function sisaBlnSpp($id_siswa,$tgl=null){
	    if($tgl){
	        $date=substr($tgl,0,7);
	    }else{
	        $date=date('Y-m');
	    }
	    
		$data = $this->db->query("SELECT * from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='spp' 
		and (SUBSTR(tgl_tagihan,1,7)<='".$date."' or tgl_tagihan IS NULL) and sts='1' and bayar is NULL  ")->num_rows();

		return $data;
	}

	function sisaPast($id_siswa, $id_kelas,$tgl=null){
		// X LIMIT 0
		// XI LIMIT 12
		// XII LIMIT 24
		if($tgl){
	        $date=substr($tgl,0,7);
	    }else{
	        $date=date('Y-m');
	    }

		$id_tk = $this->m_reff->goField("v_kelas", "id_tk", "WHERE id='".$id_kelas."'");

		switch ($id_tk) {
			case '1':
				//tagihan past = not
				$limit 	= "";
				$label = "";
			break;
			case '2':
				//tagihan past kelas x
				//0 - 12
				$limit = "LIMIT 0, 12";
				$label = "X";
			break;
			case '3':
				//tagihan past kelas x, xi
				// 0 - 24 bln
				$limit = "LIMIT 0, 24";
				$label = "X, XI";
			break;
			
			default:
				$limit 	= "";
				$label = "";
			break;
		}

		$data=$this->db->query("SELECT * from keu_tagihan_pokok where id_siswa='".$id_siswa."' and (SUBSTR(tgl_tagihan,1,7)<='".$date."' or tgl_tagihan IS NULL) and id_tagihan='spp' and sts='1' order by id asc $limit  ")->result();

		$tspp = 0;
		foreach ($data as $v) {
			if ($v->bayar == NULL) {
				$tspp = $tspp + $v->tagihan;
			}
			
		}



		$spp = array(
			"sisa" 	=> $tspp,
			"label"	=> $label
		);

		return $spp;
	}


	function telahBayar($tagihan,$id_siswa)
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
	 	function totalBiayaKelas($idkelas,$id_tagihan=null)
	{
	    $filter=" and id_siswa in (select id from data_siswa where id_kelas='".$idkelas."' AND id_sts_data IN (1,4)  )";
	    if($id_tagihan)
	    {
	        $filter.=" AND id_tagihan='".$id_tagihan."' ";
	    }
	    
	    
	    $query="SELECT
              `keu_tagihan_pokok`.`id_siswa` AS `id_siswa`,
              SUM(`keu_tagihan_pokok`.`tagihan`) AS `tagihan`,
              SUM(CASE WHEN `keu_tagihan_pokok`.`bayar` IS NULL THEN 0 ELSE `keu_tagihan_pokok`.`bayar` END) AS `bayar`,
              CAST(SUM(`keu_tagihan_pokok`.`tagihan`) - SUM(CASE WHEN `keu_tagihan_pokok`.`bayar` IS NULL THEN 0 ELSE `keu_tagihan_pokok`.`bayar` END) AS SIGNED) AS `sisa`
            FROM `keu_tagihan_pokok`
            WHERE 1 = 1 $filter
                AND (SUBSTR(`keu_tagihan_pokok`.`tgl_tagihan`,1,7) <= SUBSTR(CURRENT_TIMESTAMP(),1,7)
                      OR `keu_tagihan_pokok`.`tgl_tagihan` IS NULL)";
       $db= $this->db->query($query)->row();    
	    return isset($db->tagihan)?($db->tagihan):0;
	}
	
	function totalBayarKelas($idkelas,$id_tagihan=null)
	{
	    
	    $filter=" and id_siswa in (select id from data_siswa where id_kelas='".$idkelas."'  AND id_sts_data IN (1,4)  )";
	    if($id_tagihan)
	    {
	        $filter.=" AND id_tagihan='".$id_tagihan."' ";
	    }
	    
	    
	    $query="SELECT
              `keu_tagihan_pokok`.`id_siswa` AS `id_siswa`,
              SUM(`keu_tagihan_pokok`.`tagihan`) AS `tagihan`,
              SUM(CASE WHEN `keu_tagihan_pokok`.`bayar` IS NULL THEN 0 ELSE `keu_tagihan_pokok`.`bayar` END) AS `bayar`,
              CAST(SUM(`keu_tagihan_pokok`.`tagihan`) - SUM(CASE WHEN `keu_tagihan_pokok`.`bayar` IS NULL THEN 0 ELSE `keu_tagihan_pokok`.`bayar` END) AS SIGNED) AS `sisa`
            FROM `keu_tagihan_pokok`
            WHERE 1 = 1 $filter
                AND (SUBSTR(`keu_tagihan_pokok`.`tgl_tagihan`,1,7) <= SUBSTR(CURRENT_TIMESTAMP(),1,7)
                      OR `keu_tagihan_pokok`.`tgl_tagihan` IS NULL)";
       $db= $this->db->query($query)->row();    
	    return isset($db->bayar)?($db->bayar):0;
	    
	}
}