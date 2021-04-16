<?php

class Model extends CI_Model  {
    
	var $tbl_pegawai="v_absen_pegawai";
	var $tbl_siswa="v_absen_siswa";
	var $tbl_mapel="tm_jadwal_mengajar";
	var $v_kelas="v_kelas";
	var $mapel="tr_mapel";
	var $data_pegawai="data_pegawai";
	var $tbl_izin="tm_izin_kehadiran";
	var $tbl_libur="tm_kalender_akademik";
	var $thn="tr_tahun_ajaran";
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	function noid()
	{
		$this->db->where("id",$this->idu());
		$db=$this->db->get($this->data_pegawai)->row();
	return isset($db->nip)?($db->nip):"";
	}
	function level()
	{
		return $this->session->userdata("level");
	}
	 
	function hariLibur($tgl)
	{		
			$hariDB=$this->tanggal->namaHari($tgl); 
			$bulanDB=substr($tgl,8,2); 
			$thnDB=substr($tgl,0,4); 
			
			/*------------------------------------------*/ 
			$this->db->where("fr",1);
			$this->db->where("libur","ya");
			$return=$this->db->get($this->tbl_libur)->result();
			$jml=0;
			foreach($return as $val)
			{
				$hariKalender=$this->tanggal->namaHari($val->tgl); 
				if($hariDB==$hariKalender)
				{
					return $jml="1::".$val->nama;
				}
			}
			/*------------------------------------------*/
			$this->db->where("fr",2);
			$this->db->where("libur","ya");
			$return=$this->db->get($this->tbl_libur)->result();
			$jml=0;
			foreach($return as $val)
			{
				$hariKalender=substr($val->tgl,8,2); 
				if($bulanDB==$hariKalender)
				{
					return $jml="1::".$val->nama;
				}
			}
			/*------------------------------------------*/
			
	 
			$this->db->where("fr",3);
			$this->db->where("libur","ya");
			$return=$this->db->get($this->tbl_libur)->result();
			$jml=0;
			foreach($return as $val)
			{
				$perTglDb=substr($val->tgl,5,5);
				$perTgl=substr($tgl,5,5);
				if($perTglDb==$perTgl)
				{
					return $jml="1::".$val->nama;
				}
			}
			/*------------------------------------------*/
			
			$this->db->where("fr",4);
			$this->db->where("libur","ya");
			$return=$this->db->get($this->tbl_libur)->result();
			$jml=0;
			foreach($return as $val)
			{
				 
				if($tgl==$val->tgl)
				{
					return $jml="1::".$val->nama;
				}
			}
			/*------------------------------------------*/
			
			
			
			return $jml;
	}
	function cek_izin($noid,$tgl,$kodeHari=null)
	{
		 
			$this->db->where("noid",$noid);
			$this->db->order_by("tgl","ASC");
			$this->db->limit(1);
			$this->db->where("tgl",$tgl);
			return $this->db->get($this->tbl_izin)->row();
			 
	}
	function cekKehadiran($noid,$tgl,$kodeHari=null)
	{	$libur=$this->hariLibur($tgl); $titik="";
		$libur=explode("::",$libur);
		$hari_ini=date("Y-m-d");
		$this->db->where("noid",$noid);
		$this->db->order_by("tgl","ASC");
		$this->db->limit(1);
		$this->db->where("SUBSTR(tgl,1,10)",$tgl);
	    $return=$this->db->get($this->tbl_pegawai)->row();
		if($tgl>$hari_ini)
		{
			return "<td></td>";
		}
		
		if(isset($return))
		{
			if($this->level()=="GURU")
			{
				$aksi="  onclick='getMapel(`".$noid."`,`".$tgl."`,`".$kodeHari."`)' ";
			}else{
				$akse="";
			}
			
			
			
			return '<td '.$aksi.' class="col-green" align="center" data-original-title="'.substr($return->tgl,11,8).'"  data-toggle="tooltip" data-placement="bottom"> <b><i class="material-icons" style="font-size:15px">brightness_1</i></b></td>';
		}else{
			
			$cek=$this->cek_izin($noid,$tgl,$kodeHari=null);
			 if(isset($cek))
			 {
				return '<td class="col-orange"  align="center" data-original-title="'.$cek->alasan.'"  data-toggle="tooltip" data-placement="bottom">  <i class="material-icons" style="font-size:15px">brightness_1</i></td>';	 
			 }
			 
			if($libur[0]==1)
			{	if(strlen($libur[1])>9)
				{
					$titik="...";
				}
				return '<td class="bg-red" style="opacity:0.6" align="center" data-original-title="'.$libur[1].'"  data-toggle="tooltip" data-placement="bottom"> '.substr($libur[1],0,9).$titik.' </td>';
			}else{
				return '<td class="col-red"  align="center">  <i class="material-icons" style="font-size:15px">clear</i></td>';	
			}
		
		}
	}
	
	function dataMapel($hari)
	{
		return $this->db->query("SELECT * FROM ".$this->tbl_mapel." where sts=1 and id_guru=".$this->idu()." and id_hari='".$hari."' order by jam_masuk asc")->result();
	}
	
	function mulaiAbsen()
	{
		$return=$this->db->get_where("pengaturan",array("id"=>4))->row();
		return $return->val;
	}
	
	function batasAbsen()
	{
		$return=$this->db->get_where("pengaturan",array("id"=>5))->row();
		return $return->val;
	}
	function getIp($id_kelas)
	{
		$r=$this->db->get_where($this->v_kelas,array("id"=>$id_kelas))->row();
		return isset($r->ip)?($r->ip):"";
	}
	function getIpMapel($mapel)
	{
		$r=$this->db->get_where($this->mapel,array("id"=>$mapel))->row();
		return isset($r->ip)?($r->ip):"";
	}
	
	function stsAbsenMapel($noid,$tgl,$masuk,$keluar,$id_kelas)
	{	
		$ipKelas=$this->getIp($id_kelas);
		$jam_masuk=$tgl." ".$this->tanggal->minJam($this->mulaiAbsen(),$masuk);			
		$jam_akhir=$tgl." ".$this->tanggal->plusJam($this->batasAbsen(),$keluar);
		$this->db->limit(1);
		$this->db->where("noid",$noid);
		$this->db->where("tgl>=",$jam_masuk);
		$this->db->where("tgl<=",$jam_akhir);
		if($ipKelas)	{	$this->db->where("ip",$ipKelas);	} 
		return $this->db->get($this->tbl_pegawai)->row();
	}
	
	function jmlSiswaHadir($tgl,$masuk,$keluar,$id_kelas,$mapel)
	{	
		
		$getIpMapel=$this->getIpMapel($mapel);
		$ipKelas=$this->getIp($id_kelas);
			
		$jam_masuk=$tgl." ".$this->tanggal->minJam($this->mulaiAbsen(),$masuk);			
		$jam_akhir=$tgl." ".$this->tanggal->plusJam($this->batasAbsen(),$keluar);
		$this->db->where("tgl>=",$jam_masuk);
		$this->db->where("tgl<=",$jam_akhir);
		$this->db->where("id_kelas",$id_kelas);
		
		if($getIpMapel)	{	$this->db->where("ip",$getIpMapel);	}else{
		if($ipKelas)	{	$this->db->where("ip",$ipKelas);	} 	 }
			 
		return $this->db->get($this->tbl_siswa)->num_rows();
	}
	function jmlSiswa($id_kelas)
	{
	return	$this->db->get_where("data_siswa",array("id_kelas"))->num_rows();
	}
	function jmlSiswaMapel($tgl,$masuk,$keluar,$id_kelas,$mapel)
	{
	return	$this->db->get_where("data_siswa",array("id_kelas"))->num_rows();
	}
	function persentaseAbsenMapel($tgl,$masuk,$keluar,$id_kelas,$mapel)
	{
		$jml_siswa=$this->jmlSiswa($id_kelas);
		$jml_siswa_hadir=$this->jmlSiswaHadir($tgl,$masuk,$keluar,$id_kelas,$mapel);
		return number_format(($jml_siswa_hadir/$jml_siswa)*100,0);
	}
	
	function jmlMasuk($periode) //YYYY-mm
	{
		$this->db->where("noid",$this->noid());
		$this->db->limit(31);
		$this->db->where("substr(tgl,1,7)",$periode);
		$this->db->group_by("substr(tgl,1,10)");
	return	$this->db->get($this->tbl_pegawai)->num_rows();
	}
	
	function jmlIzin($periode) //YYYY-mm
	{
		$this->db->where("noid",$this->noid());
		$this->db->limit(31);
		$this->db->where("substr(tgl,1,7)",$periode);
		$this->db->group_by("substr(tgl,1,10)");
	return	$this->db->get($this->tbl_izin)->num_rows();
	}
	
	function jmlLibur($bulan,$tahun)
	{	
			 
	 		/*----------------------------------mingguan--------*/ 
			$this->db->where("fr",1);
			$this->db->where("libur","ya");
			$this->db->group_by("tgl");
			$return=$this->db->get($this->tbl_libur)->result();
			$jml=0;
			foreach($return as $val)
			{
				for($x=1;$x<=31;$x++)
				{
					$tgl_loop=$tahun."-".$bulan."-".sprintf("%02s", $x);
					$hariKalender=$this->tanggal->namaHari($val->tgl); 
					$hariDB=$this->tanggal->namaHari($tgl_loop); 
					if($hariDB==$hariKalender)
					{
						$jml++;
					}
				}
				 
			}
			/*------------------------------------bulanan / setiap tanggal ------*/
			$this->db->where("fr",2);
			$this->db->where("libur","ya");
			$this->db->group_by("tgl");
			$return=$this->db->get($this->tbl_libur)->result();
		 
			foreach($return as $val)
			{
				$perTglDb=substr($val->tgl,8,2);
			  	for($x=1;$x<=31;$x++)
				{
					$hariKalender=sprintf("%02s", $x); 
					if($perTglDb==$hariKalender)
					{
						$jml++;
					}
				}
				
				
			}
			/*---------------------------per tahun---------------*/
			
	 
			$this->db->where("fr",3);
			$this->db->where("libur","ya");
			$this->db->group_by("tgl");
			$return=$this->db->get($this->tbl_libur)->result();
	 		foreach($return as $val)
			{
				 
				$perTglDb=substr($val->tgl,5,5);//bln-tgl
			  	for($x=1;$x<=31;$x++)
				{
					$perTgl=$bulan."-".sprintf("%02s", $x); 
					if($perTglDb==$perTgl)
					{
						$jml++;
					}
				}
				
			}
			/*------------------------------------------*/
			
			$this->db->where("fr",4);
			$this->db->where("libur","ya");
			$this->db->group_by("tgl");
			$return=$this->db->get($this->tbl_libur)->result();
			 
			foreach($return as $val)
			{
				 
				$tglDb=$val->tgl;
				for($x=1;$x<=31;$x++)
				{
					$repeatTgl=$tahun."-".$bulan."-".sprintf("%02s", $x); 
					if($tglDb==$repeatTgl)
					{
						$jml++;
					}
				}
			}
			/*------------------------------------------*/
			 
			return $jml;
	 
	}
	
	function jmlAlfa($tahun,$bulan) //YYYY-mm
		{	
			$periode=$tahun."-".$bulan;
			$jml_hari  = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
			$jml_libur = $this->jmlLibur($bulan,$tahun); 
			$jml_masuk = $this->jmlMasuk($periode); 
			$jml_izin = $this->jmlIzin($periode); 
			return   ($jml_hari-$jml_libur)-($jml_masuk+$jml_izin);
		}
	
	function getRepatTahun()
	{
	$this->db->limit(2);
	$this->db->order_by("id","DESC");
	return	$this->db->get($this->thn)->result();
	}	
}