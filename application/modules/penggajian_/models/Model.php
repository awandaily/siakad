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
	 function hapusAll($id,$periode)
	 {
		 $explode=explode(",",$id);
		 foreach($explode as $id_guru)
		 {
		 
				 $this->db->where("nama_periode",$periode);
				 $this->db->where("id_guru",$id_guru);
				 $db=$this->db->get("keu_data_gaji")->row();
				 $nama_periode=$db->periode;
				 $id_gaji=$db->id;
				
				$tgl1=$db->tgl1;
				$tgl2=$db->tgl2;
				 
				$this->db->query("delete from keu_bayar_pinjaman where id_guru='".$id_guru."' and id_gaji='".$id_gaji."'");
				$this->db->query("delete from keu_simpanan where id_guru='".$id_guru."' and periode='".$nama_periode."'");
				$this->db->query("update keu_honor set byr='0' where id_guru='".$id_guru."'     and   tgl_input BETWEEN '".$tgl1."' and '".$tgl2."'  ");
				$this->db->query("delete from keu_data_gaji where id_guru='".$id_guru."'  and periode='".$nama_periode."'");
		 } return true;
			 
		 
	 } function hapus_gaji()
	 {
		 $id=$this->input->post("id");
		 $id_guru=$this->input->post("id_guru");
		 $periode=$this->input->post("periode");
		 $this->db->where("id",$id);
		 $db=$this->db->get("keu_data_gaji")->row();
		 $periode=$db->periode;
		 $nama_periode=$db->nama_periode;
		$tgl1=$db->tgl1;
		$tgl2=$db->tgl2;
		 	$this->db->query("delete from keu_bayar_pinjaman where id_guru='".$id_guru."' and periode='".$periode."'  ");
	 	$this->db->query("delete from keu_simpanan where id_guru='".$id_guru."' and periode='".$periode."'");
	 	$this->db->query("update keu_honor set byr='0' where id_guru='".$id_guru."'     and   tgl_input BETWEEN '".$tgl1."' and '".$tgl2."'  ");
	  	return $this->db->query("delete from keu_data_gaji where id_guru='".$id_guru."' and id='".$id."' and periode='".$periode."'");
		
	 }
	function sms()
	{
		return $this->m_reff->semester_asli();
		// id_semester='".$this->sms()."'  and id_tahun='".$this->tahun()."' and
	}
	function tahun()
	{
		return $this->m_reff->tahun_asli();
	}
	 function jmlJamMengajarBlok($periode,$idu,$tk)
	 {
		 $jamseluruh=$this->jmlJamMengajarBuild($periode,$idu,$tk);
		 $jamMasuk=$this->jmlJamMengajarNormal($periode,$idu,$tk);
		 if(!$jamMasuk){ return 0;}
		 return $jamseluruh-$jamMasuk;		 
	 }

	 /*function jmlJamMengajarBlok($periode,$idu,$tk)
	 {
		 
		   $tgl1=$this->tanggal->range_1($periode,"-");
		   $tgl2=$this->tanggal->range_2($periode,"-");
		   
		   
		   
		   $jam_absen=$this->db->query("SELECT (SUM(jml_jam_blok)) AS jml from tm_absen_guru where id_guru='".$idu."' and 
		   substr(tgl,1,10) BETWEEN '".$tgl1."' and '".$tgl2."'
		   and id_kelas IN (SELECT id FROM  tm_kelas WHERE id_tk='".$tk."') ")->row();
		   if(isset($jam_absen->jml)){
			   $jam=$jam_absen->jml;
		   }else{
			   $jam=0;
		   } return $jam;
		 
	 } */
	 function jmlJamMengajarNormal($periode,$idu,$id_tk)
	 {
		 
		   $tgl1=$this->tanggal->range_1($periode,"-");
		   $tgl2=$this->tanggal->range_2($periode,"-");
		   
		   $jml_absen_diliburkan=$this->hitung_diliburkan($periode,$idu,$id_tk);
		   
		   $jam_absen=$this->db->query("SELECT (SUM(jml_jam_valid)+SUM(jml_jam_blok)) AS jml from tm_absen_guru where id_guru='".$idu."' and 
		   substr(tgl,1,10) BETWEEN '".$tgl1."' and '".$tgl2."'
		   and id_kelas IN (SELECT id FROM  tm_kelas WHERE id_tk='".$id_tk."') ")->row();
		   if(isset($jam_absen->jml)){
			   $jam=$jam_absen->jml+$jml_absen_diliburkan;
		   }else{
			   $jam=0;
		   } return $jam;
		 
	 }
	 function hitung_diliburkan($periode,$idu,$id_tk)
	 {
		   $tgl1=$this->tanggal->range_1($periode,"-");
		   $tgl2=$this->tanggal->range_2($periode,"-");
		   $q=$this->db->query("SELECT SUM(jml_jam) AS jml from tm_diliburkan where id_guru='".$idu."' and 
		    substr(tgl,1,10) BETWEEN '".$tgl1."' and '".$tgl2."'
		   and id_kelas IN (SELECT id FROM  tm_kelas WHERE id_tk='".$id_tk."')")->row();
		   return isset($q->jml)?($q->jml):0;
	 }function getHonorMengajar($id_guru)
	 {	return $this->m_reff->honor($id_guru);
		// $cari=$this->m_reff->goField("data_pegawai","sts_kepegawaian","where id='".$id_guru."'");
		// return $get=$this->m_reff->goField("tr_sts_pegawai","honor","where id='".$cari."'");
		 
	 }function jmlJamMengajarBuild($periode,$idu,$id_tk)
	 {
		   $tgl1=$this->tanggal->range_1($periode,"-");
		   $tgl2=$this->tanggal->range_2($periode,"-");
		    $jml_hari_senin=$this->tanggal->jumlahHari($tgl1,$tgl2,1);
		     $jml_hari_selasa=$this->tanggal->jumlahHari($tgl1,$tgl2,2);
		      $jml_hari_rabu=$this->tanggal->jumlahHari($tgl1,$tgl2,3);
		       $jml_hari_kamis=$this->tanggal->jumlahHari($tgl1,$tgl2,4);
		        $jml_hari_jumat=$this->tanggal->jumlahHari($tgl1,$tgl2,5);
		         $jml_hari_sabtu=$this->tanggal->jumlahHari($tgl1,$tgl2,6);
		          $jml_hari_minggu=$this->tanggal->jumlahHari($tgl1,$tgl2,7);
		$hitung1=$this->jmlMengajarByJadwal(1,$id_tk,$idu)*$jml_hari_senin;		  
		$hitung2=$this->jmlMengajarByJadwal(2,$id_tk,$idu)*$jml_hari_selasa;		  
		$hitung3=$this->jmlMengajarByJadwal(3,$id_tk,$idu)*$jml_hari_rabu;		  
		$hitung4=$this->jmlMengajarByJadwal(4,$id_tk,$idu)*$jml_hari_kamis;		  
		$hitung5=$this->jmlMengajarByJadwal(5,$id_tk,$idu)*$jml_hari_jumat;		  
		$hitung6=$this->jmlMengajarByJadwal(6,$id_tk,$idu)*$jml_hari_sabtu;		  
		$hitung7=$this->jmlMengajarByJadwal(7,$id_tk,$idu)*$jml_hari_minggu;		
		return $hitung1+$hitung2+$hitung3+$hitung4+$hitung5+$hitung6+$hitung7;
		
	 }
	 function jmlMengajarByJadwal($id_hari,$id_tk,$idu)
	 {
		$data= $this->db->query("select SUM(((jam_akhir-jam_awal)+1)) as jml from v_jadwal where id_guru='".$idu."' 
		 and id_semester='".$this->sms()."' and id_tahun='".$this->tahun()."' and id_hari='".$id_hari."'
		 and id_kelas IN (SELECT id FROM  tm_kelas WHERE id_tk='".$id_tk."')")->row();
		 return isset($data->jml)?($data->jml):0;
	 }function gajiPokok($id_guru)
	 {
		  $dt=$this->m_reff->goField("data_pegawai","gaji_pokok","where id='".$id_guru."'");
		  if($dt){
		  return $dt;
		  }return 0;
	 }function tunjanganJabatan($id_guru)
	 {
		  $dt=$this->m_reff->goField("data_pegawai","tunjangan_jabatan","where id='".$id_guru."'");
		  if($dt){
		  return $dt;
		  }return 0;
	 }function pembinaEskul($id_guru,$periode)
	 {
		  $dt=$this->m_reff->goField("data_pegawai","pembina_eskul","where id='".$id_guru."'");
		  if($dt){
		  return $dt;
		  }else{
			  $kode=$this->m_reff->goField("data_pegawai","nip","where id='".$id_guru."' ");
			$besaran=$this->db->query("select sum(honor_maksimal) as honor from tr_ektrakurikuler where kode='".$kode."' ")->row();  
			 $maksi=isset($besaran->honor)?($besaran->honor):"0";
			  
		  $tgl1=$this->tanggal->range_1($periode);
		  $tgl2=$this->tanggal->range_2($periode);
		  $this->db->select("sum(honor) as honor");
		  $this->db->where("kode",$kode);
		  $this->db->where("tgl BETWEEN '".$tgl1."' and '".$tgl2."'   ");
		  $dt=$this->db->get("eskul_absen")->row();
		  $honor=isset($dt->honor)?($dt->honor):"0";
			  if($honor>$maksi)
			  {
				  return $maksi;
			  }else{
				    return $honor;
			  }
		  }
			  return 0;
	 }function p_fungsional($id_guru)
	 {
		  $dt=$this->m_reff->goField("data_pegawai","p_fungsional","where id='".$id_guru."'");
		  if($dt){
		  return $dt;
		  }return 0;
	 }function kepramukaan_wajib($id_guru)
	 {
		  $dt=$this->m_reff->goField("data_pegawai","kepramukaan_wajib","where id='".$id_guru."'");
		  if($dt){
		  return $dt;
		  }return 0;
	 }function supervisi_akademik($id_guru)
	 {
		  $dt=$this->m_reff->goField("data_pegawai","supervisi_akademik","where id='".$id_guru."'");
		  if($dt){
		  return $dt;
		  }return 0;
	 }function getNominalBPJS($id_guru)
	 {
		  $dt=$this->m_reff->goField("data_pegawai","bpjs","where id='".$id_guru."'");
		  if($dt){
		  return $dt;
		  }return 0;
	 }function waliKelas($id_guru)
	 {
		  $dt=$this->db->query("select * from tm_kelas where id_wali='".$id_guru."' ")->num_rows();
		  if($dt){
		  return   $this->m_reff->goField("tm_pengaturan","val","where id='9'");
		  }return 0;
	 }function piket($periode,$id_guru)
	 {
		   $tgl1=$this->tanggal->range_1($periode,"-");
		   $tgl2=$this->tanggal->range_2($periode,"-");
		   
		  $dt=$this->db->query("select sum(honor) as honor from tm_petugas_piket where id_guru='".$id_guru."' and tgl BETWEEN '".$tgl1."' and '".$tgl2."' ")->row();
		  if(isset($dt->honor)){
		  return  $dt->honor;
		  }return 0;
	 }function getNominalCicilan($id_guru)
	 {
		 $data=$this->db->query("select sum(jumlah_cicilan) as cicilan,(SUM(jumlah_pinjaman)-SUM( CASE WHEN total_bayar IS NULL THEN 0 ELSE  total_bayar END  ))  AS hutang  from v_pinjaman where id_guru='".$id_guru."' and jumlah_pinjaman>CASE WHEN total_bayar IS NULL THEN 0 ELSE  total_bayar END ")->row();
		$cicilan=isset($data->cicilan)?($data->cicilan):0;
		$hutang=isset($data->hutang)?($data->hutang):0;
		if($cicilan>$hutang)
		{
			return $hutang;
		}else{
			return $cicilan;
		}
	 }function getJumlahPinjaman($id_guru)
	 {
		 $data=$this->db->query("select  (SUM(jumlah_pinjaman)-SUM( CASE WHEN total_bayar IS NULL THEN 0 ELSE  total_bayar END  ))  AS hutang  from v_pinjaman where id_guru='".$id_guru."'  ")->row();
		 $hutang=isset($data->hutang)?($data->hutang):0;
		 return $hutang;
		 
	 }function simpanPenggajian()
	 {	 
		$potongan=$this->input->post("potongan");
		$potongan=str_replace(".","",$potongan);
		$id_guru=$this->input->post("id_guru");
		$periode=$this->input->post("periode");
		$pemasukan=$this->input->post("pemasukan");
		$total_pembayaran=$this->input->post("total_pembayaran");
		$total_potongan=$this->input->post("total_potongan");
		$tgl1=$this->tanggal->range_1($periode,"-");
		$tgl2=$this->tanggal->range_2($periode,"-");
		$tgl=$this->tanggal->indBulan($tgl2,"-");
		$nama_periode=substr($tgl,3,50);
		$periode=$this->input->post("periode");
		$data_simpanan=$this->input->post("simpanan[]");
	//	print_r($data_simpanan);
		 $pendapatan=$this->input->post("form[]");
		 $cicilan=$this->input->post("bayar_pinjaman");
		 $cicilan=str_replace(".","",$cicilan);

		 $bpjs=$this->input->post("bpjs");
		 $bpjs=str_replace(".","",$bpjs);
		 foreach($data_simpanan as $var=>$nominal)
		 {			  
			$this->insertSimpanan($id_guru,$periode,$nama_periode,$var[1],$nominal);
		 }
		///	$this->bayarCicilan($id_guru,$cicilan,$periode,$nama_periode);
				//	if($cicilan)
				//	{
				//		$this->kalkulasiCicilan($id_guru,$cicilan);
				//	}
			$this->updateHonorNonKBM($id_guru,$periode,$nama_periode);
			$nama=$this->m_reff->goField("data_pegawai","nama","where id='".$id_guru."'");
			$this->db->set($pendapatan);
			$this->db->set("id_semester",$this->sms());
			$this->db->set("id_tahun",$this->tahun());
			$this->db->set("honor_kbm",$this->m_reff->honor($id_guru));
			$this->db->set("kbm_invalid",$potongan);
			$this->db->set("bpjs",$bpjs);
			$this->db->set("nama_penerima",$nama);
			$this->db->set("jml_potongan",$total_potongan);
			$this->db->set("jml_pemasukan",$pemasukan);
			$this->db->set("gaji",$total_pembayaran);
			$this->db->set("nama_periode",$nama_periode);
			$this->db->set("periode",$periode);
			$this->db->set("tgl1",$tgl1);
			$this->db->set("tgl2",$tgl2);
			$this->db->set("cicilan",$cicilan);
			$this->db->set("id_guru",$id_guru);
			$this->db->set("_cid",$this->idu());
			$gajiasli=($pemasukan-$potongan);
			$this->db->set("gaji_asli",$gajiasli);
		 	return	$this->db->insert("keu_data_gaji");
	 }
	 
	 function updateHonorNonKBM($id_guru,$periode,$nama_periode)
	 {
		  $tgl1=$this->tanggal->range_1($periode,"-");
		  $tgl2=$this->tanggal->range_2($periode,"-");
		 return $this->db->query("update keu_honor set byr='1',periode='".$periode."',nama_periode='".$nama_periode."'   where id_guru='".$id_guru."' and  tgl_input BETWEEN '".$tgl1."' and '".$tgl2."'  ");
	 }
	 
	 function insertSimpanan($id_guru,$periode,$nama_periode,$kategory,$nominal)
	 {	$nominal=str_replace(".","",$nominal);
		if(!$nominal){ return true; }
		 $array=array(
		 "id_guru"=>$id_guru,
		 "tgl"=>date('Y-m-d'),
		 "nama"=>$this->m_reff->goField("data_pegawai","nama","where id='".$id_guru."'"),
		 "periode"=>$periode,
		 "nama_periode"=>$nama_periode,
		 "kategory"=>$kategory,
		 "sts"=>1,
		 "eksekusi"=>2,
		 "nominal"=>$nominal,
		 );
		 $this->db->set("_cid",$this->idu());
	return	$this->db->insert("keu_simpanan",$array);
	 }
	 
	 function kalkulasiCicilan($id_guru,$cicilan)
	 {
		 $this->db->where("id_guru",$id_guru);		 
		 $this->db->where("(total_bayar IS NULL or jumlah_pinjaman>total_bayar )");
		 $db=$this->db->get("v_pinjaman")->result();
		 $budget=$cicilan;//10rb
		 foreach($db as $val)
		 {
			 $jcicilan=$val->jumlah_cicilan; //30rb
			 $sisa=$val->jumlah_pinjaman-$val->total_bayar; //80ribu
			 
				 if($sisa>$jcicilan)
				 {
					 if($sisa>$budget)
					 {
						 $bayar=$budget;
						 $budget=0;
						return $this->updateDataPinjaman($val->id,($val->total_bayar+$bayar));
					 }else{
						$bayar=$sisa;
						$budget=$budget-$sisa;
						 $this->updateDataPinjaman($val->id,($val->total_bayar+$bayar));
					 }
				 }else{
				 $bayar=$sisa;
				 $budget=$budget-$sisa;
				  $this->updateDataPinjaman($val->id,($val->total_bayar+$bayar));
				 }				 
			 
			 
		 }return true;
	 }
	 function updateDataPinjaman($id,$tb)
	 {
		 $this->db->where("id",$id);
		 $this->db->set("total_bayar",$tb);
		 return $this->db->update("keu_pinjaman");
	 }
	 function getHonorNonKbm($id_guru,$periode)
	 {
		 $tgl1=$this->tanggal->range_1($periode,"-");
		 $tgl2=$this->tanggal->range_2($periode,"-");
		 $data=$this->db->query("select SUM(nominal) as jml from keu_honor where id_guru='".$id_guru."' and   tgl_input BETWEEN '".$tgl1."' and '".$tgl2."' and byr=0 ")->row();
		 return $data->jml;
	 }
	 
	 
	 function getDataGaji()
	{
		$query=$this->_getDataGaji();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getDataGaji()
	{	$filter="";
	$id_guru=$this->input->get_post("id_guru");
	$periode=$this->input->get_post("periode");
	$status=$this->input->get_post("status");
	if($id_guru)
	{
		$filter.=" AND id_guru='".$id_guru."' ";
	}if($periode)
	{
		$filter.=" AND nama_periode='".$periode."' ";
	}if($status!='')
	{
		$filter.=" AND sts='".$status."' ";
	}
		 
		$query="select * from keu_data_gaji where 1=1 ".$filter;
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				periode LIKE '%".$searchkey."%'   
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
	
	public function count_getDataGaji()
	{				
		$query = $this->_getDataGaji();
        return  $this->db->query($query)->num_rows();
	}
	function ubahStatus($id,$sts)
	{	$now=date('Y-m-d');
		
		if($sts==1)
		{	$this->updateDataSimpanan($id,$now,1);
			$this->insertDataBayarPinjaman($id,$now);
			$this->db->where("id",$id);
			$this->db->set("tgl_dibayarkan",$now);
		return	$this->db->update("keu_data_gaji");
			
		 
		}else{
			$this->updateDataSimpanan($id,$now,2);
			$this->deleteDataBayarPinjaman($id,$now);
			$this->db->where("id",$id);
			$this->db->set("tgl_dibayarkan",null);
		return	$this->db->update("keu_data_gaji");
		 
		}
		 
	}
	
	function insertDataBayarPinjamanAll($id_guru,$now,$periode)
	{
	$cek=$this->db->query("select * from keu_bayar_pinjaman where id_guru='".$id_guru."' and nama_periode='".$periode."' ")->num_rows();	
	if(!$cek)
	{
		$get=$this->db->get_where("keu_data_gaji",array("id_guru"=>$id_guru,"nama_periode"=>$periode))->row();
		if($get->cicilan)
		{
			$this->db->set("id_gaji",$get->id);
			$this->db->set("id_guru",$get->id_guru);
			$this->db->set("nominal",$get->cicilan);
			$this->db->set("tgl",$now);
			$this->db->set("periode",$get->periode);
			$this->db->set("nama_periode",$get->nama_periode);
			$this->db->set("tipe",2);
			$this->db->set("_cid",$this->idu());
			return $this->db->insert("keu_bayar_pinjaman");
		}return false;
	}return false;
		
	}
	
	function ubahStatusAll($val,$periode)
	{	$now=date('Y-m-d');
		$explode=explode(",",$val);
		foreach($explode as $id)
		{
		 	
			$this->insertDataBayarPinjamanAll($id,$now,$periode);
			
		}
			$this->updateDataSimpananAll($id,$now,1,$periode,$val);
			$this->db->where("id_guru in (".$val.") ");
			$this->db->where("nama_periode",$periode);
			$this->db->set("tgl_dibayarkan",$now);
		return	$this->db->update("keu_data_gaji");
			
	 
		 
	}
	function updateDataSimpananAll($id_guru,$now,$sts,$periode,$val)
	{
		 
			$this->db->set("eksekusi",$sts); 
			$this->db->set("tgl",$now); 
			$this->db->set("_cid",$this->idu());
			$this->db->set("_ctime",date('Y-m-d H:i:s'));
			$this->db->where("id_guru in (".$val.") ");
			$this->db->where("nama_periode",$periode);
			return $this->db->update("keu_simpanan");
		 
	}
	
	
	function updateDataSimpanan($id,$now,$sts)
	{
		$get=$this->db->get_where("keu_data_gaji",array("id"=>$id))->row();
		 
			$this->db->set("eksekusi",$sts); 
			$this->db->set("tgl",$now); 
			$this->db->set("_cid",$this->idu());
			$this->db->set("_ctime",date('Y-m-d H:i:s'));
			$this->db->where("id_guru",$get->id_guru);
			$this->db->where("periode",$get->periode);
			return $this->db->update("keu_simpanan");
		 
	}
	
	
	
	
	function insertDataBayarPinjaman($id,$now)
	{
		$cek=$this->db->query("select * from keu_bayar_pinjaman where id_gaji='".$id."' ")->num_rows();	
	if(!$cek)
	{
		$get=$this->db->get_where("keu_data_gaji",array("id"=>$id))->row();
		if($get->cicilan)
		{
			$this->db->set("id_gaji",$get->id);
			$this->db->set("id_guru",$get->id_guru);
			$this->db->set("nominal",$get->cicilan);
			$this->db->set("tgl",$now);
			$this->db->set("periode",$get->periode);
			$this->db->set("nama_periode",$get->nama_periode);
			$this->db->set("tipe",2);
			$this->db->set("_cid",$this->idu());
			return $this->db->insert("keu_bayar_pinjaman");
		}return false;
	}return false;
		
	}	
	
	
	
	function deleteDataBayarPinjaman($id,$now)
	{
		$get=$this->db->get_where("keu_data_gaji",array("id"=>$id))->row();
		if($get->cicilan)
		{
			$this->db->where("id_gaji",$get->id);
			$this->db->where("id_guru",$get->id_guru);
			$this->db->where("tipe",2);
			return $this->db->delete("keu_bayar_pinjaman");
		}return false;
		
	}
	function getTotalSimpanan($idguru,$periode)
	{
		$this->db->where("id_guru",$idguru);
		$this->db->where("periode",$periode);
		$this->db->select("SUM(nominal) as nominal");
		$db=$this->db->get("keu_simpanan")->row();
		return isset($db->nominal)?($db->nominal):"0";
	}
	function getTotalInval($id_guru,$periode)
	{
		$tgl1=$this->tanggal->range_1($periode);
		$tgl2=$this->tanggal->range_2($periode);
		
		$db=$this->db->query("select sum(honor_guru_sebelumnya*jml_jam) as jml from tm_inval where id_guru='".$id_guru."' and tgl BETWEEN '".$tgl1."' and '".$tgl2."' ")->row();
		return isset($db->jml)?($db->jml):"0";
	}
	
}