<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_plugin extends ci_Model
{
	
	public function __construct() {
        parent::__construct();
     	}
     	
     	
     		function kehadiranPerhari($id_siswa,$sts,$bln)
	{	
	 
	 
	
	 if($sts=="all"){
                 return $this->db->query("select * from tm_absen_harian where
                 (absen2 LIKE '%,".$id_siswa.",%' OR 
                 absen3 LIKE '%,".$id_siswa.",%' OR
                 absen4 LIKE '%,".$id_siswa.",%' OR 
                 absen5 LIKE '%,".$id_siswa.",%' OR 
                 absen6 LIKE '%,".$id_siswa.",%'
                 )
                  
                   and SUBSTR(tgl,1,7)='$bln' ")->num_rows();
      }
      
        
         $this->db->where("SUBSTR(tgl,1,7)",$bln);
      //  $this->db->where("id_semester",$sms);
      //  $this->db->where("id_tahun",$tahun);
        $this->db->where("absen$sts LIKE '%,".$id_siswa.",%'");
      return  $this->db->get("tm_absen_harian")->num_rows();
	
	
	}
	
     	
     	
     	
     	
     	
		function absenDatang($nip)
		{
		   $data=$this->db->query("select * from tm_log_kehadiran where noid='".$nip."' and SUBSTR(tgl,1,10)='".date('Y-m-d')."' order by id asc limit 1 ")->row();
		   return isset($data->tgl)?($data->tgl):"-";
		}
			function absenPulang($nip,$datang=null)
		{      
		   $data=$this->db->query("select * from tm_log_kehadiran where noid='".$nip."' and SUBSTR(tgl,1,10)='".date('Y-m-d')."'  and SUBSTR(tgl,12,5)>'13:00'  order by id DESC limit 1 ")->row();
		   $pulang=isset($data->tgl)?($data->tgl):"-";
		   if($pulang==$datang)
		   {
		       return "-";
		   }else{
		       return $pulang;
		   }
		}
		 function kehadiran($id_siswa,$sts,$bln)
	{	
	 
		$return=$this->db->query("select COUNT(*) as jml from tm_absen_siswa where  SUBSTR(tgl,1,7)='".$bln."'
		and     absen".$sts." like '%,".$id_siswa.",%' group by SUBSTR(tgl,1,7)
		")->row(); 
		return isset($return->jml)?($return->jml):"0";
	}
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
	function update_guru()
	{			$sms=$this->m_reff->semester();$tahun=$this->m_reff->tahun();
		$data=$this->db->query("select * from data_pegawai where id_jabatan='3' and aktifasi='1' ")->result();
		foreach($data as $data)
		{
				$return=$this->db->query("select sum(jml_jam_valid) as jam_valid, sum(jml_jam_blok) as jam_blok
				from tm_absen_guru where id_guru='".$data->id."'	and id_semester='".$sms."' and id_tahun='".$tahun."'   ")->result();
				foreach($return as $var)
				{	$jam_valid=isset($var->jam_valid)?($var->jam_valid):"";
				 	$jam_blok=isset($var->jam_blok)?($var->jam_blok):"";
					$this->update_jam_guru($data->id,$jam_valid,$jam_blok);
				}
		}
				
			
	}
	
	function update_jam_guru($guru,$jam_valid,$jam_blok)
	{
	    if(!$jam_valid){ $jam_valid=0;}
	     if(!$jam_blok){ $jam_blok=0;}
		$this->db->where("id",$guru);
		$this->db->set("jam_valid",$jam_valid);
		$this->db->set("jam_blok",$jam_blok);
		return $this->db->update("data_pegawai");
	}
	
	
	function update_ketidakhadiran($idkelas)
	{		$sms=$this->m_reff->semester();$tahun=$this->m_reff->tahun();
			$return=$this->db->query("select * from data_siswa where id_kelas='".$idkelas."' ")->result();
			foreach($return as $var)
			{
				$absen2=$this->db->query("select * from tm_absen_siswa where absen2 like '%,".$var->id.",%' and id_semester='".$sms."' and id_tahun='".$tahun."' ")->num_rows();
				$absen3=$this->db->query("select * from tm_absen_siswa where absen3 like '%,".$var->id.",%' and id_semester='".$sms."' and id_tahun='".$tahun."' ")->num_rows();
				$absen4=$this->db->query("select * from tm_absen_siswa where absen4 like '%,".$var->id.",%' and id_semester='".$sms."' and id_tahun='".$tahun."' ")->num_rows();
				$absen5=$this->db->query("select * from tm_absen_siswa where absen5 like '%,".$var->id.",%' and id_semester='".$sms."' and id_tahun='".$tahun."' ")->num_rows();
				$absen6=$this->db->query("select * from tm_absen_siswa where absen6 like '%,".$var->id.",%' and id_semester='".$sms."' and id_tahun='".$tahun."' ")->num_rows();
				$this->update_absen($var->id,$absen2,$absen3,$absen4,$absen5,$absen6);
				$this->update_siswa($var->id,$absen2,$absen3,$absen4,$absen5,$absen6);
			}
			return true;
	}
	function update_siswa($id,$absen2,$absen3,$absen4,$absen5,$absen6)
	{
				$array=array(
					"absen2"=>$absen2,
					"absen3"=>$absen3,
					"absen4"=>$absen4,
					"absen5"=>$absen5,
					"absen6"=>$absen6,
					);
				$this->db->where("id",$id);
		return	$this->db->update("data_siswa",$array);
	}
	function update_absen($id,$absen2,$absen3,$absen4,$absen5,$absen6)
	{	$sms=$this->m_reff->semester();$tahun=$this->m_reff->tahun();
		$cek=$this->db->query("select * from data_rekap_ketidakhadiran where id_siswa='".$id."' and id_semester='".$sms."' and id_tahun='".$tahun."' ")->num_rows();
		if($cek)
		{
			$array=array(
			"absen2"=>$absen2,
			"absen3"=>$absen3,
			"absen4"=>$absen4,
			"absen5"=>$absen5,
			"absen6"=>$absen6,
			"tgl"=>date("Y-m-d H:i:s"),
			);
				$this->db->where("id_siswa",$id);
		return	$this->db->update("data_rekap_ketidakhadiran",$array);
		}else{
			$array=array(
			"id_siswa"=>$id,
			"absen2"=>$absen2,
			"absen3"=>$absen3,
			"absen4"=>$absen4,
			"absen5"=>$absen5,
			"absen6"=>$absen6,
			"id_semester"=>$sms,
			"id_tahun"=>$tahun,
			);
		return	$this->db->insert("data_rekap_ketidakhadiran",$array);
		}
		
	}
	
	function insertBiayaPokok($data,$where)
	{
		$this->db->where($where);
		$cek=$this->db->get("keu_tagihan_pokok")->num_rows();
		if(!$cek){
		return $this->db->insert("keu_tagihan_pokok",$data);
		}return false;
	}
	
		function hapusBiayaPokok($data,$where)
	{
		$this->db->where($where);
		$this->db->where("bayar IS NULL");
		$cek=$this->db->get("keu_tagihan_pokok")->row();
		if(isset($cek->id)){
		    $this->db->where("id",$cek->id);
		    $this->db->where("bayar IS NULL");
		  return $this->db->delete("keu_tagihan_pokok");
		}return false;
	}
			function getNilaiKd($idsiswa,$idkikd,$idkelas,$idmapel,$id_kate,$sms)
	{
		
		//$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_kikd",$idkikd);
		$this->db->where("nilai!=",null);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_kategory_nilai",$id_kate);
		$this->db->select("AVG(nilai) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
		function getNilaiKi($idsiswa,$idkikd,$idkelas,$idmapel,$id_kate,$sms)
	{
		 
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_kikd",$idkikd);
		$this->db->where("nilai_ki!=",null);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_kategory_nilai",$id_kate);
		$this->db->where("id_guru",$this->idu());
		$this->db->select("AVG(nilai_ki) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
	function getNilaiUT($idsiswa,$idkelas,$idmapel,$id_kate,$sms)
	{
	 
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_kategory_nilai",$id_kate);
		$this->db->where("id_guru",$this->idu());
		$this->db->select("AVG(nilai) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
	function getNilaiRataKi($idsiswa,$idkelas,$idmapel,$sms)
	{	 
	 
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_kategory_nilai",1);
		$this->db->select("AVG(nilai_ki) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
	 
	 function getNilaiRata($idsiswa,$idkelas,$idmapel,$sms)
	{	 
	 
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_mapel",$idmapel);
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_kategory_nilai",1);
		$this->db->select("AVG(nilai) as nilai");
		$data=$this->db->get("data_nilai")->row();
		$return=isset($data->nilai)?($data->nilai):"0"; 
		return number_format($return,1);
	}
	 
	 
	function mapelAjar()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->set("id_semester",$sms);
		$this->db->set("id_tahun",$tahun);
	//	$this->db->group_by("mapel,id_tk");
		$this->db->select("nama_tingkat,id_kelas,kelas,mapel,id");
		$this->db->where("id_guru",$this->idu());
		$this->db->order_by("kelas","asc");
	return	$this->db->get("v_mapel_ajar")->result();
	}
	
	function getNilaiSikap($idsiswa,$mapel,$sms)
	{		 
		$tahun=$this->m_reff->tahun();
		 
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_semester",$sms);
		$this->db->where("id_mapel",$mapel);
		$this->db->where("id_tahun",$tahun);
 	///	$this->db->where("id_guru",$this->idu());
	 	$return=$this->db->get("tm_sikap")->row();
		return isset($return->nilai)?($return->nilai):"";
	}
	
	
	function getNilaiRataSikap($idsiswa,$mapel,$sms,$idguru) ///
	{
		$tahun=$this->m_reff->tahun();
		$filter="";
		if($mapel)
		{
			$filter=" and id_mapel='".$mapel."' ";
		}
		 
		
		//$this->db->where("id_guru",$idguru);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_semester",$sms);
		if($mapel){
		$this->db->where("id_mapel",$mapel);
		}
		$this->db->where("id_tahun",$tahun);
 	//	$this->db->select("AVG(((nilai1+nilai2+nilai3+nilai4+nilai5)/5)) as nilai");
	 
	 	$return=$this->db->get("tm_sikap")->row();
		return $return=isset($return->nilai)?($return->nilai):"-"; 
		//	return number_format($return,2);
		 	
		
	}
	
	function getNilaiRataSikapRanking($idsiswa,$mapel,$sms) ///
	{
		$tahun=$this->m_reff->tahun();
		$filter="";
		 
		 $id_kelas=$this->m_reff->goField("data_siswa","id_kelas","where id='".$idsiswa."' ");
		  
		 if($mapel)
		{
				$filter=" and id_mapel='".$mapel."' ";
		}else{
				$filter=" and id_mapel IN (SELECT id_mapel from v_jadwal where id_kelas='".$id_kelas."' AND 
				id_tahun='".$tahun."' and id_semester='".$sms."' ) ";
		}
		
	  	$return=$this->db->query("select AVG(((nilai1+nilai2+nilai3+nilai4+nilai5)/5)) as nilai from tm_sikap where
		id_tahun='".$tahun."' and id_semester='".$sms."' ".$filter." ")->row();
		$return=isset($return->nilai)?($return->nilai):"0"; 
			return number_format($return,2);
		 	
		
	}
	
	
	function hasilUjianAkhir($idsiswa,$mapel,$sms)
	{
				$uts = $this->getNilaiUts($idsiswa,$mapel,$sms);
				$uas =$this->getNilaiUas($idsiswa,$mapel,$sms);
		  $a=($uts+$uas)/2;
		return ($a/100)*30;
	}
	

	function getNilaiUas($idsiswa,$mapel,$sms) //nilai rata2 UTS di bagi 30%
	{
		$filter="";
		$tahun=$this->m_reff->tahun();
	 	if($mapel){
	 	$filter=" AND id_mapel='".$mapel."'	";
		}
	 	$return=$this->db->query("SELECT AVG(nilai) as nilai from data_nilai where id_kategory_nilai='3' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'  and id_semester='".$sms."' ".$filter." ")->row();
		$return=isset($return->nilai)?($return->nilai):0;
		return number_format($return,2);
			
	}
		
	
	function getNilaiUts($idsiswa,$mapel,$sms) //nilai rata2 UTS di bagi 30%
	{
		$filter="";
		$tahun=$this->m_reff->tahun();
	 	if($mapel){
	 	$filter=" AND id_mapel='".$mapel."' ";
		}
	 	$return=$this->db->query("SELECT AVG(nilai) as nilai from data_nilai where id_kategory_nilai='2' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'  and id_semester='".$sms."' ".$filter." ")->row();
		$return=isset($return->nilai)?($return->nilai):0;
		return number_format($return,2);
			
	}
		
	
	
	function getNilaiRataPengetahuan($idsiswa,$mapel,$sms,$idguru)
	{	$filter="";
		$tahun=$this->m_reff->tahun();
	 	if($mapel){
	 	$filter=" AND id_mapel='".$mapel."'  
		";
		}
	 	$return=$this->db->query("SELECT AVG(nilai) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'  and id_semester='".$sms."' ".$filter." ")->row();
	  	$return=isset($return->nilai)?($return->nilai):"0"; 
		 
			if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$return=($return/100*70)+$ujian;
				return number_format($return,2);
			}
		
	}
	function getNilaiRataPengetahuanDuplicate($idsiswa,$mapel,$sms,$idguru)
	{	$filter="";
		$tahun=$this->m_reff->tahun();
	 	if($mapel){
	 	$filter=" AND id_mapel='".$mapel."'  
		";
		}
	 	$return=$this->db->query("SELECT AVG(nilai) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'   and id_semester='".$sms."' ".$filter." ")->row();
	  	$return=isset($return->nilai)?($return->nilai):"0"; 
		 
			if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$return=($return/100*70)+$ujian;
				return number_format($return,2);
			}
		
	}
	
	
	
	function getNilaiRataPengetahuanRanking($idsiswa,$mapel,$sms)
	{	$filter="";
		$tahun=$this->m_reff->tahun();
		
		$id_kelas=$this->m_reff->goField("data_siswa","id_kelas","where id='".$idsiswa."' ");
		  
		 if($mapel)
		{
				$filter=" and id_mapel='".$mapel."' ";
		}else{
				$filter=" and id_mapel IN (SELECT id_mapel from v_jadwal where id_kelas='".$id_kelas."' AND 
				id_tahun='".$tahun."' and id_semester='".$sms."' ) ";
		}
		
		
	 	 
	 	$return=$this->db->query("SELECT AVG(nilai) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'  and id_semester='".$sms."' ".$filter." ")->row();
	 	$return=isset($return->nilai)?($return->nilai):"0"; 
		 
			if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$return=($return/100*70)+$ujian;
				return number_format($return,2);
			}
		
	}
	
	function getNilaiRataPengetahuanTotalLegger($idsiswa,$mapel,$sms)
	{	$filter="";
		$tahun=$this->m_reff->tahun();
	 	if($mapel){
	 	$filter=" AND id_mapel='".$mapel."'	";
		}
	 	$return=$this->db->query("SELECT AVG(nilai) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'  and id_semester='".$sms."' ".$filter." ")->row();
		$return=isset($return->nilai)?($return->nilai):"0"; 
		 
			if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$return=($return/100*70)+$ujian;
				return number_format($return,2);
			}
		
	}
	
	
	
	function getNilaiRataPengetahuanLegger($idsiswa,$mapel,$sms,$idguru)
	{	

	$filter="";
		$tahun=$this->m_reff->tahun();
	 	if($mapel){
			$filter=" AND id_mapel='".$mapel."'	";
		}
		 
	 	$return=$this->db->query("SELECT AVG(nilai) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'   and id_semester='".$sms."' ".$filter." ")->row();
	  	$return=isset($return->nilai)?($return->nilai):"0"; 
 	 //return number_format($return,2);
		if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$hasil=(($return/100*70)+$ujian);
				return number_format($hasil,2);
		} 
			
	}
	function getNilaiRataKeterampilanDuplicate($idsiswa,$mapel,$sms,$idguru) //mengambil nilai avg dari nilai keterampilan
	{
		  
		$filter="";
		$tahun=$this->m_reff->tahun();
	 	if($mapel){
	 	$filter=" AND id_mapel='".$mapel."'  
		";
		}
	 	$return=$this->db->query("SELECT avg(nilai_ki) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'   and id_semester='".$sms."' ".$filter." ")->row();
		 $return=isset($return->nilai)?($return->nilai):"0"; 
	//	return number_format($return,2);
	 	if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$hasil=(($return/100*70)+$ujian);
				return number_format($hasil,2);
		}  
		
	}function getNilaiRataKeterampilan($idsiswa,$mapel,$sms,$idguru) //mengambil nilai max dari nilai keterampilan
	{
		 
		
		$filter="";
		$tahun=$this->m_reff->tahun();
	 	if($mapel){
	 	$filter=" AND id_mapel='".$mapel."'  
		";
		}
	 	$return=$this->db->query("SELECT AVG(nilai_ki) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'   and id_semester='".$sms."' ".$filter." ")->row();
		 $return=isset($return->nilai)?($return->nilai):"0"; 
	//	return number_format($return,2);
		if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$hasil=(($return/100*70)+$ujian);
				return number_format($hasil,2);
		} 
		
	}
	
	function getNilaiRataKeterampilanRanking($idsiswa,$mapel,$sms) //mengambil nilai max dari nilai keterampilan
	{
		 
		
		$filter="";
		$tahun=$this->m_reff->tahun();
		
		 $id_kelas=$this->m_reff->goField("data_siswa","id_kelas","where id='".$idsiswa."' ");
		 
		
	 	 if($mapel)
		{
				$filter=" and id_mapel='".$mapel."' ";
		}else{
				$filter=" and id_mapel IN (SELECT id_mapel from v_jadwal where id_kelas='".$id_kelas."' AND 
				id_tahun='".$tahun."' and id_semester='".$sms."' ) ";
		}
	 	$return=$this->db->query("SELECT avg(nilai_ki) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'  and id_semester='".$sms."' ".$filter." ")->row();
		$return=isset($return->nilai)?($return->nilai):"0"; 
	//	return number_format($return,2);
		if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$hasil=(($return/100*70)+$ujian);
				return number_format($hasil,2);
		} 
		
	}
	function getNilaiRataKeterampilanLegger($idsiswa,$mapel,$sms,$idguru) //mengambil nilai max dari nilai keterampilan
	{
		  
		$filter="";
		$tahun=$this->m_reff->tahun();
	 	if($mapel){
	 	$filter=" AND id_mapel='".$mapel."' ";
		}
	 	$return=$this->db->query("SELECT AVG(nilai_ki) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."'    and id_semester='".$sms."' ".$filter." ")->row();
		$return=isset($return->nilai)?($return->nilai):"0"; 
		 
		if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$hasil=((($return/100)*70)+$ujian);
				return number_format($hasil,2);
		} 
		
	}
	
	/*===================================*/
	function nilaiRataUjianAkhir($idsiswa,$mapel,$sms)
	{	
	 $uts=$this->getNilaiUts($idsiswa,$mapel,$sms);
	$uas=$this->getNilaiUas($idsiswa,$mapel,$sms);
	$jumlah=($uts+$uas)/2;
		if($jumlah>0)
		{
			$diambil=30;
			//$persen=100;
			$return=$jumlah;
			$nmax=100;
			$return=($return/$nmax)*$diambil;	
			return number_format($return,2);
		}else{
			return 0;
		}
	}
	
	 function getNilaiRataRata($idsiswa,$sms)
	 {
	//	 $nilaiUjianAkhir=$this->nilaiRataUjianAkhir($idsiswa,$mapel=null,$sms);
	 	 $s=$this->getNilaiRataSikap($idsiswa,$mapel=null,$sms);
			 
	 	 $p=$this->getNilaiRataPengetahuan($idsiswa,$mapel=null,$sms);
	//	 $p=($p/100)*70; //diambil 70% 
	//	 $p=$p+$nilaiUjianAkhir;
		 
		 $k=$this->getNilaiRataKeterampilan($idsiswa,$mapel=null,$sms);
	//	 $k=($k/100)*70; //diambil 70% 
	//	 $k=$k+$nilaiUjianAkhir;
		 
		 if($s>0){
			$return=(($s+$p+$k)/3);
		 }else{
			 $return=(($p+$k)/2); 
		 }
		 return number_format($return,2);
	 }
	
		function getNilaiRataRataRanking($idsiswa,$sms)
	 {
	  	$tahun=$this->m_reff->tahun();
	  	$sms=$this->m_reff->semester();
		$data=$this->db->query("select * from data_siswa where id='".$idsiswa."'")->row();
		$agama=$data->id_agama;
		
		 if($agama>1)
					 {
						 $filterasi=" AND mapel_global='1' ";
					 }else{
						  $filterasi="";
					 }
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' 
					 and k_mapel='A' and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					".$filterasi." group by id_mapel")->result();
					 $no=1;
					 $nilaiSeluruh=0;$jumlahMapel=0;
					 $nilaiSeluruhKeterampilan=0;
					  $nilaiSeluruhSikap=0; 
					 foreach($getMapel as $gm)
					 {	
					   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);  
                       $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru); 
					   $jumlahMapel++; 
					    $nilaiSeluruh=$NRP+$nilaiSeluruh;
					    $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					 
					  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					
					}  
					
					if($agama>1)
					{ 
				      $NRP=$this->mdl->getNpNonMuslim($idsiswa); 
                      $NRK=$this->mdl->getNkNonMuslim($idsiswa); 
                      $jumlahMapel++; 
						$nilaiSeluruh=$NRP+$nilaiSeluruh;
						$nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					 
						$nilaiSikap=0;//$this->mdl->getNsNonMuslim($idsiswa);
						$nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					  
					}
					 
					
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='B'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='B'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' group by id_mapel")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }   
					 
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='C1'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					group by id_mapel")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='C1'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' group by id_mapel")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  
					  
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='C2'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='C2'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' 
					 group by id_mapel")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  
					 
					 
					  
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='C3'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='C3'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."'")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }   
					 if($agama>1)
					 {
						 $filterasi=" AND mapel_global='1' ";
					 }else{
						  $filterasi="";
					 }
					 
					 $getMapel=$this->db->query("select * from v_jadwal where 
					 id_kelas='".$data->id_kelas."' and k_mapel='Muatan Lokal' ".$filterasi."
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL)
					 group by id_mapel")->result();
					 $no=1;
					 foreach($getMapel as $gm)
					 {
							$NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);  
                            $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);  
                
							$jumlahMapel++;
							$nilaiSeluruh=$NRP+$nilaiSeluruh;
							$nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
						   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } 
					
                
			//$NR=$this->mdl->getNilaiAkhir($idsiswa,$sms); //nilai rata-rata
			//$eskul=$this->mdl->getNilaiEskul($idsiswa,$sms);
			//$NilaiMinKehadiran=$this->mdl->NilaiMinKehadiran($idsiswa,$sms); 
			$getNilaiRataSikap=$nilaiSeluruhSikap; 
			$nilaiKeterampilan=$nilaiSeluruhKeterampilan;
			$nilaiPengetahuan=$nilaiSeluruh; 
			$total=($getNilaiRataSikap+$nilaiKeterampilan+$nilaiPengetahuan)/3; 
			//$NR=(($nilaiSeluruhKeterampilan/$jumlahMapel)+$eskul)-$NilaiMinKehadiran; 
			$NR=$total/$jumlahMapel;
			//$NR=($NR+$eskul)-$NilaiMinKehadiran;
			return number_format($NR,4);
			  
		
	 }
		function getNilaiAkhirRanking($idsiswa,$sms,$tk)
	 {
	  	$tahun=$this->m_reff->tahun();
	  	$sms=$this->m_reff->semester();
		$data=$this->db->query("select * from data_siswa where id='".$idsiswa."'")->row();
		$agama=$data->id_agama;
		$idklstk="id_kelas_$tk";
		$id_kelas=$data->$idklstk;
					 if($agama>1)
					 {
						 $filterasi=" AND mapel_global='1' ";
					 }else{
						  $filterasi="";
					 }
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' 
					 and k_mapel='A' and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					".$filterasi." group by id_mapel")->result();
					 $no=1;
					 $nilaiSeluruh=0;$jumlahMapel=0;
					 $nilaiSeluruhKeterampilan=0;
					  $nilaiSeluruhSikap=0; 
					 foreach($getMapel as $gm)
					 {	
					   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);  
                       $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru); 
					   $jumlahMapel++; 
					    $nilaiSeluruh=$NRP+$nilaiSeluruh;
					    $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					 
					  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					
					}  
					
						 $getMapelAgama=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' 
					 and k_mapel='A' and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 AND mapel_global='2'   group by id_mapel")->num_rows();
					 
					if($agama>1  && $getMapelAgama>0)
					{ 
				      $NRP=$this->mdl->getNpNonMuslim($idsiswa); 
                      $NRK=$this->mdl->getNkNonMuslim($idsiswa); 
                      $jumlahMapel++; 
						$nilaiSeluruh=$NRP+$nilaiSeluruh;
						$nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					 
						$nilaiSikap=0;//$this->mdl->getNsNonMuslim($idsiswa);
						$nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					  
					}
					 
					
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='B'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='B'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' group by id_mapel")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }   
					 
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C1'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					group by id_mapel")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C1'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' group by id_mapel")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  
					  
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C2'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C2'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' 
					 group by id_mapel")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  
					 
					 
					  
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C3'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C3'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."'")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }   
					 if($agama>1)
					 {
						 $filterasi=" AND mapel_global='1' ";
					 }else{
						  $filterasi="";
					 }
					 
					 $getMapel=$this->db->query("select * from v_jadwal where 
					 id_kelas='".$id_kelas."' and k_mapel='Muatan Lokal' ".$filterasi."
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL)
					 group by id_mapel")->result();
					 $no=1;
					 foreach($getMapel as $gm)
					 {
							$NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);  
                            $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);  
                
							$jumlahMapel++;
							$nilaiSeluruh=$NRP+$nilaiSeluruh;
							$nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
						   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } 
					
					
                
			 
			 $eskul=$this->mdl->getNilaiEskul($idsiswa,$sms);
			 $NilaiMinKehadiran=$this->mdl->NilaiMinKehadiran($idsiswa,$sms); 
			$getNilaiRataSikap=$nilaiSeluruhSikap; 
			$nilaiKeterampilan=$nilaiSeluruhKeterampilan;
			$nilaiPengetahuan=$nilaiSeluruh; 
		//	$total=($getNilaiRataSikap+$nilaiKeterampilan+$nilaiPengetahuan)/3; 
	    	$total=($nilaiKeterampilan+$nilaiPengetahuan)/2; 
			//$NR=(($nilaiSeluruhKeterampilan/$jumlahMapel)+$eskul)-$NilaiMinKehadiran; 
			if(!$jumlahMapel){ return 0;}
			$NR=(($total/$jumlahMapel)+$eskul)-$NilaiMinKehadiran;
			//$NR=($NR+$eskul)-$NilaiMinKehadiran;
			return number_format($NR,4);
			  
		
	 }

	 function getNilaiRataRataLegger($idsiswa,$sms)
	 {
	//	 $nilaiUjianAkhir=$this->nilaiRataUjianAkhir($idsiswa,$mapel=null,$sms);
	 	 $s=$this->getNilaiRataSikap($idsiswa,$mapel=null,$sms);
			 
	  	 $p=$this->getNilaiRataPengetahuanLegger($idsiswa,$mapel=null,$sms);
	//	 $p=($p/100)*70; //diambil 70% 
	//	 $p=$p+$nilaiUjianAkhir;
		 
		 $k=$this->getNilaiRataKeterampilanLegger($idsiswa,$mapel=null,$sms);
	//	 $k=($k/100)*70; //diambil 70% 
	//	 $k=$k+$nilaiUjianAkhir;
		 
		 if($s>0){
			$return=(($s+$p+$k)/3);
		 }else{
			 $return=(($p+$k)/2); 
		 }
		 return number_format($return,2);
	 }
	 function getNilaiAkhir($idsiswa,$sms)
	 {	
		 $nilaiRata=$this->getNilaiRataRataRanking($idsiswa,$sms);		 
		 $nilaiEskul=$this->getNilaiEskul($idsiswa,$sms);
		 $nilaiMinKehadiran=$this->NilaiMinKehadiran($idsiswa,$sms);
		 $return=$nilaiRata+$nilaiEskul-$nilaiMinKehadiran;
		 return number_format($return,2);
	 }
	 function getNilaiAkhirLegger($idsiswa,$sms)
	 {	
		 $nilaiRata=$this->getNilaiRataRataLegger($idsiswa,$sms);		 
		 $nilaiEskul=$this->getNilaiEskul($idsiswa,$sms);
		 $nilaiMinKehadiran=$this->NilaiMinKehadiran($idsiswa,$sms);
		 $return=$nilaiRata+$nilaiEskul-$nilaiMinKehadiran;
		 return number_format($return,2);
	 }
	 function NilaiMinKehadiran($idsiswa,$sms)
	 {	
		 $tahun=$this->m_reff->tahun();
		 $return=$this->db->query("SELECT * FROM tm_kh WHERE   id_siswa='".$idsiswa."'  
		 AND id_tahun='".$tahun."' AND id_semester='".$sms."' ")->row();
		 $sakit=isset($return->sakit)?($return->sakit):"0";
		 $izin=isset($return->izin)?($return->izin):"0";
		 $alfa=isset($return->alfa)?($return->alfa):"0";
		 $return=(($sakit*1)+($izin*2)+($alfa*3))/100;
		  return number_format($return,2);
	 }
	 function getNilaiEskul($idsiswa,$sms)
	 {	$tahun=$this->m_reff->tahun();
		$data= $this->db->query("select max(nilai) as nilai from tm_ekstrakurikuler where 
		id_siswa='".$idsiswa."' and id_tahun='".$tahun."' and id_semester='".$sms."'
		 ")->row();
		  $return=isset($data->nilai)?($data->nilai):"0";
		  if(!$return){ return 0;}
		  $return=$return*0.02;
		  
		  
		 return number_format($return,2);
	 }
	 function setNilaiEskul($idsiswa,$nilai,$sms)
	 {	 $tahun=$this->m_reff->tahun();
		 $cek=$this->db->query("select * from tm_nilai_eskul where id_tahun='".$tahun."' and id_semester='".$sms."'
		 and id_siswa='".$idsiswa."' ")->num_rows();
		 if(!$cek)
		 {
			 $this->db->set("id_siswa",$idsiswa);
			 $this->db->set("id_tahun",$tahun);
			 $this->db->set("id_semester",$sms);
			 $this->db->set("nilai",$nilai);
			 return $this->db->insert("tm_nilai_eskul");
		 }else{
			 $this->db->where("id_siswa",$idsiswa);
			 $this->db->where("id_tahun",$tahun);
			 $this->db->where("id_semester",$sms);
			 $this->db->set("nilai",$nilai);
			 return $this->db->update("tm_nilai_eskul");
		 }
	 }
	 function getJmlKehadiran($idsiswa,$sms,$sts)
	 {
		 $tahun=$this->m_reff->tahun();
		 $sts=$this->m_reff->goField("tr_sts_kehadiran","nama","where id='".$sts."' ");
		$return=$this->db->query("SELECT ".$sts." as jml FROM tm_kh WHERE   id_siswa='".$idsiswa."'  
		 AND id_tahun='".$tahun."' AND id_semester='".$sms."' ")->row();
		 return isset($return->jml)?($return->jml):"0";
	 }
	/*===================================*/
		function getKKMNonMuslim($idsiswa)
	{	$tahun=$this->m_reff->tahun();$sms=$this->m_reff->semester();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->select("kkm");
		$get=$this->db->get("data_nilai_nonmuslim")->row();
		$return=isset($get->kkm)?($get->kkm):0;
		return number_format($return,2);
	}function getNpNonMuslim($idsiswa)
	{	$tahun=$this->m_reff->tahun();$sms=$this->m_reff->semester();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->select("p");
		$get=$this->db->get("data_nilai_nonmuslim")->row();
		$return=isset($get->p)?($get->p):0;
		return number_format($return,2);
	}function getNkNonMuslim($idsiswa)
	{	$tahun=$this->m_reff->tahun();$sms=$this->m_reff->semester();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->select("k");
		$get=$this->db->get("data_nilai_nonmuslim")->row();
		$return=isset($get->k)?($get->k):0;
		return number_format($return,2);
	}function getNsNonMuslim($idsiswa)
	{	$tahun=$this->m_reff->tahun();$sms=$this->m_reff->semester();
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->select("s");
		$get=$this->db->get("data_nilai_nonmuslim")->row();
		return $return=isset($get->s)?($get->s):"-";
	///	return number_format($return,2);
	}
	function predikat($id,$nilai) //id=1 =adaftif/normatif 2=produktif
	{
	     
	        $dt=$this->db->query("SELECT * FROM tr_predikat WHERE id_nilai=$id AND min_range<=CAST('".$nilai."' AS INT) AND max_range>=CAST('".$nilai."' AS INT) ")->row();
	        return isset($dt->predikat)?($dt->predikat):"-";
	}
	
}

?>