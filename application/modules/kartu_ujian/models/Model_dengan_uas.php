<?php

class Model extends CI_Model  {
    
	var $tbl="data_nilai";
 
	var $tbl_jadwal="v_jadwal";
	var $k_nilai="tr_kategory_nilai";
 	function __construct()
    {
        parent::__construct();
    }
 
     
	function idu()
	{
		return $this->session->userdata("id");
	}
	function id_kelas_wali()
	{
		return $this->m_reff->goField("tm_kelas","id","where id_wali='".$this->idu()."'");
	}
	function dataSiswa($idkelas)
	{
			$this->db->where("id_kelas",$idkelas);
	return	$this->db->get("data_siswa")->result();
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
	
	function getNilaiSikap($idsiswa,$mapel,$sts,$sms)
	{		 
		$tahun=$this->m_reff->tahun();
		 
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_semester",$sms);
		$this->db->where("id_mapel",$mapel);
		$this->db->where("id_tahun",$tahun);
 		$this->db->select("nilai".$sts." as nilai");
		$this->db->where("id_guru",$this->idu());
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
		 
		
		$this->db->where("id_guru",$idguru);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("id_semester",$sms);
		if($mapel){
		$this->db->where("id_mapel",$mapel);
		}
		$this->db->where("id_tahun",$tahun);
 		$this->db->select("AVG(((nilai1+nilai2+nilai3+nilai4+nilai5)/5)) as nilai");
	 
	 	$return=$this->db->get("tm_sikap")->row();
		$return=isset($return->nilai)?($return->nilai):"0"; 
			return number_format($return,2);
		 	
		
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
		return ($a*30)/100;
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
		and id_siswa='".$idsiswa."' and id_guru='".$idguru."'  and id_semester='".$sms."' ".$filter." ")->row();
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
		and id_siswa='".$idsiswa."' and id_guru!='".$idguru."'  and id_semester='".$sms."' ".$filter." ")->row();
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
		and id_siswa='".$idsiswa."' and id_guru='".$idguru."' and id_semester='".$sms."' ".$filter." ")->row();
	  	$return=isset($return->nilai)?($return->nilai):"0"; 
 	 //return number_format($return,2);
		if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$hasil=(($return/100*70)+$ujian);
				return number_format($hasil,2);
		} 
			
	}
	function getNilaiRataKeterampilanDuplicate($idsiswa,$mapel,$sms,$idguru) //mengambil nilai max dari nilai keterampilan
	{
		  
		$filter="";
		$tahun=$this->m_reff->tahun();
	 	if($mapel){
	 	$filter=" AND id_mapel='".$mapel."'  
		";
		}
	 	$return=$this->db->query("SELECT max(nilai_ki) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."' and id_guru!='".$idguru."' and id_semester='".$sms."' ".$filter." ")->row();
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
	 	$return=$this->db->query("SELECT max(nilai_ki) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."' and id_guru='".$idguru."' and id_semester='".$sms."' ".$filter." ")->row();
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
	 	$return=$this->db->query("SELECT max(nilai_ki) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
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
	 	$return=$this->db->query("SELECT max(nilai_ki) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='".$tahun."' 
		and id_siswa='".$idsiswa."' and id_guru='".$idguru."'  and id_semester='".$sms."' ".$filter." ")->row();
		$return=isset($return->nilai)?($return->nilai):"0"; 
		 
		if(!$return){ return 0; }else{
				$ujian=$this->hasilUjianAkhir($idsiswa,$mapel,$sms);
				$hasil=(($return/100*70)+$ujian);
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
					".$filterasi." group by id_mapel,id_guru")->result();
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
					 
						$nilaiSikap=$this->mdl->getNsNonMuslim($idsiswa);
						$nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					  
					}
					 
					
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='B'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='B'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' group by id_mapel,id_guru")->result();
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
					group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='C1'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' group by id_mapel,id_guru")->result();
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
					 group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='C2'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' 
					 group by id_mapel,id_guru")->result();
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
					 group by id_mapel,id_guru")->result();
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
					 group by id_mapel,id_guru")->result();
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
		function getNilaiAkhirRanking($idsiswa,$sms)
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
					".$filterasi." group by id_mapel,id_guru")->result();
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
					 
						$nilaiSikap=$this->mdl->getNsNonMuslim($idsiswa);
						$nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					  
					}
					 
					
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='B'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='B'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' group by id_mapel,id_guru")->result();
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
					group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='C1'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' group by id_mapel,id_guru")->result();
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
					 group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$data->id_kelas."' and k_mapel='C2'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' 
					 group by id_mapel,id_guru")->result();
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
					 group by id_mapel,id_guru")->result();
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
					 group by id_mapel,id_guru")->result();
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
			$total=($getNilaiRataSikap+$nilaiKeterampilan+$nilaiPengetahuan)/3; 
			//$NR=(($nilaiSeluruhKeterampilan/$jumlahMapel)+$eskul)-$NilaiMinKehadiran; 
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
	function dataMapelAjar()
	{
		$data=$this->db->select("DISTINCT(id_mapel) as id_mapel");
		$this->db->where("id_guru",$this->idu());
		return $this->db->get($this->tbl_jadwal)->result();
	}
	function dataKelasAjar()
	{
		$data=$this->db->select("DISTINCT(id_kelas) as id_kelas");
		$this->db->where("id_guru",$this->idu());
		$this->db->order_by("id_kelas","asc");
		return $this->db->get("v_jadwal")->result();
	}
	function cekWali()
	{
			   $this->db->where("id_wali",$this->session->userdata("id"));
		return $this->db->get_where("tm_kelas")->num_rows();
	}
	function dataKategoryNilai()
	{
	 	$cek=$this->cekWali();
		if(!$cek)
		{
			$this->db->where("sts!=",1);
		}
		return $this->db->get($this->k_nilai)->result();
	}
	function kehadiran($id_siswa,$id_mapel,$sms,$sts)
	{	
		$tahun=$this->m_reff->tahun();
		 
		return $this->db->query("select * from tm_absen_siswa where id_semester='".$sms."' and id_tahun='".$tahun."'
		and id_mapel='".$id_mapel."' and absen".$sts." like '%,".$id_siswa.",%'
		")->num_rows();
	}
	
	function add_prestasi()
	{	$sms=$this->m_reff->semester(); $tahun=$this->m_reff->tahun();
		 
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
 
		$this->db->set("id_semester",$sms);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("_cid",$this->idu());
		
		return $this->db->insert("tm_prestasi",$post);
	}
	function edit_prestasi()
	{ 
	 
		$id=$this->input->post("id");
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
  
		$this->db->set("_uid",$this->idu());
		$this->db->set("_utime",date("Y-m-d H:i:s"));
		$this->db->where("_cid",$this->idu());
		 
		$this->db->where("id",$id);
		return $this->db->update("tm_prestasi",$post);
	}
	
	function hapus_prestasi()
	{	$id=$this->input->post("id");
		 
		$this->db->where("id",$id);
		$this->db->where("_cid",$this->idu());
		return $this->db->delete("tm_prestasi");
	}
	
	function add_ekstra()
	{	$sms=$this->m_reff->semester(); $tahun=$this->m_reff->tahun();
		 
		$post=$this->input->post("f");
		$nilai=$this->input->post("nilai");
		$nilasi=str_replace(",",".",$nilai);
		$post=$this->security->xss_clean($post);
		
		$this->db->set("nilai",$nilai);
		$this->db->set("id_semester",$sms);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("_cid",$this->idu());
		
		return $this->db->insert("tm_ekstrakurikuler",$post);
	}
	function edit_ekstra()
	{ 
	 
		$id=$this->input->post("id");
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
			$nilai=$this->input->post("nilai");
			$nilasi=str_replace(",",".",$nilai);
		$this->db->set("_uid",$this->idu());
		$this->db->set("_utime",date("Y-m-d H:i:s"));
		$this->db->set("nilai",$nilai);
		$this->db->where("_cid",$this->idu());
		 
		$this->db->where("id",$id);
		return $this->db->update("tm_ekstrakurikuler",$post);
	}
	
	function hapus_ekstra()
	{	$id=$this->input->post("id");
		 
		$this->db->where("id",$id);
		$this->db->where("_cid",$this->idu());
		return $this->db->delete("tm_ekstrakurikuler");
	}
	function update_kh()
	{	$sms=$this->m_reff->semester(); $tahun=$this->m_reff->tahun();
		$absen=$this->input->post("absen");
		$id_siswa=$this->input->post("id_siswa");
		$jml=$this->input->post("jml");
		$cek=$this->m_reff->goField("tm_kh","id_siswa","where id_semester='".$sms."' and id_tahun='".$tahun."' and id_siswa='".$id_siswa."' ");
		if($cek)
		{
			$db="update";
			$this->db->set($absen,$jml);
			$this->db->where("id_siswa",$id_siswa);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_tahun",$tahun);
			$this->db->set("_uid",$this->idu());
			$this->db->set("_utime",date("Y-m-d H:i:s"));
		}else{
			$db="insert";
			$this->db->set($absen,$jml);
			$this->db->set("id_siswa",$id_siswa);
			$this->db->set("id_semester",$sms);
			$this->db->set("id_tahun",$tahun);
			$this->db->set("_cid",$this->idu());
		}
		
		return $this->db->$db("tm_kh");
	}
	function update_pkl()
	{	$sms=$this->m_reff->semester(); $tahun=$this->m_reff->tahun();
		$id_siswa=$this->input->post("id_siswa");
		$mitra=$this->input->post("mitra");
		$lama=$this->input->post("lama");
		$ket=$this->input->post("ket");
		$cek=$this->m_reff->goField("tm_pkl","id_siswa","where id_semester='".$sms."' and id_tahun='".$tahun."' and id_siswa='".$id_siswa."' ");
		if($cek)
		{
			$db="update";
			$this->db->set("id_mitra",$mitra);
			$this->db->set("lama",$lama);
			$this->db->set("ket",$ket);
			$this->db->where("id_siswa",$id_siswa);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_tahun",$tahun);
			 
		}else{
			$db="insert";
			$this->db->set("id_mitra",$mitra);
			$this->db->set("lama",$lama);
			$this->db->set("ket",$ket);
			$this->db->set("id_siswa",$id_siswa);
			$this->db->set("id_semester",$sms);
			$this->db->set("id_tahun",$tahun);
			 
		}
		
		return $this->db->$db("tm_pkl");
	}
	function update_catatan()
	{	$sms=$this->m_reff->semester(); $tahun=$this->m_reff->tahun();
		$ket=$this->input->post("ket");
		$id_siswa=$this->input->post("id_siswa");
		$jml=$this->input->post("jml");
		$cek=$this->db->query("select * from tm_catatan_walikelas where id_semester='".$sms."' and id_tahun='".$tahun."' and id_siswa='".$id_siswa."' ")->num_rows();
		if($cek)
		{
			$db="update";
			$this->db->set("ket",$ket);
			$this->db->where("id_siswa",$id_siswa);
			$this->db->where("id_semester",$sms);
			$this->db->where("id_tahun",$tahun);
			$this->db->where("_cid",$this->idu());
			$this->db->set("_uid",$this->idu());
			$this->db->set("_utime",date("Y-m-d H:i:s"));
		}else{
			$db="insert";
			$this->db->set("ket",$ket);
			$this->db->set("id_siswa",$id_siswa);
			$this->db->set("id_semester",$sms);
			$this->db->set("id_tahun",$tahun);
			$this->db->set("_cid",$this->idu());
		}
		
		return $this->db->$db("tm_catatan_walikelas");
	}
	
	function updateNilaiMurni($idsiswa,$sms,$tk)
	{
			$nilai=$this->mdl->getNilaiRataRataRanking($idsiswa,$sms);
			if($tk=="X")
			{		$this->db->set("x_1",$nilai);
			}elseif($tk=="XI")
			{		$this->db->set("xi_1",$nilai);
			}elseif($tk=="XII")
			{		$this->db->set("xii_1",$nilai);
			}
			
			$this->db->where("id",$idsiswa);
		return	$this->db->update("data_siswa");
	}	
	function updateNilaiAkhir($idsiswa,$sms,$tk)
	{
			$nilai=$this->mdl->getNilaiAkhirRanking($idsiswa,$sms);
			if($tk=="X")
			{		$this->db->set("x_2",$nilai);
			}elseif($tk=="XI")
			{		$this->db->set("xi_2",$nilai);
			}elseif($tk=="XII")
			{		$this->db->set("xii_2",$nilai);
			}
			
			$this->db->where("id",$idsiswa);
		return	$this->db->update("data_siswa");
	}	
	function setRankingMurni($idkelas,$tk)
	{
			if($tk=="X")
			{		$order="x_1 DESC"; $dbrank="rank_x1";
			}elseif($tk=="XI")
			{		$order="xi_1 DESC"; $dbrank="rank_xi1";
			}elseif($tk=="XII")
			{		$order="xii_1 DESC"; $dbrank="rank_xii1";
			}
			
			$dbsiswa=$this->db->query("select * from data_siswa where id_kelas='".$idkelas."' order by ".$order."  ")->result();
			$no=1;
			foreach($dbsiswa as $val)
			{
				$this->db->query("UPDATE data_siswa set ".$dbrank."='".$no++."' where id='".$val->id."'  ");
			}
		return true;
	}
	function rataKb($id_mapel,$id_kelas,$id_guru,$id_tahun,$id_semester)
	{
		 
		$data=$this->db->query("SELECT AVG(kd3_kb) as kb from v_kikd where (id_mapel='".$id_mapel."' AND id_kelas='".$id_kelas."')  
		and id_tahun='".$id_tahun."' and id_semester='".$id_semester."' and id_guru='".$id_guru."'  ")->row();
		$return=isset($data->kb)?($data->kb):"";
		return number_format($return,2);
		}
	function rataKbk($id_mapel,$id_kelas,$id_guru,$id_tahun,$id_semester)
	{
		$data=$this->db->query("SELECT AVG(kd4_kb) as kb from v_kikd where id_mapel='".$id_mapel."'
		  and id_kelas='".$id_kelas."' and id_tahun='".$id_tahun."'
		and id_semester='".$id_semester."' and id_guru='".$id_guru."'  ")->row();
		$return=isset($data->kb)?($data->kb):"";
		return number_format($return,2);
		}
	
	function setRankingAkhir($idkelas,$tk)
	{
			if($tk=="X")
			{		$order="x_2 DESC"; $dbrank="rank_x2";
			}elseif($tk=="XI")
			{		$order="xi_2 DESC"; $dbrank="rank_xi2";
			}elseif($tk=="XII")
			{		$order="xii_2 DESC"; $dbrank="rank_xii2";
			}
			
			$dbsiswa=$this->db->query("select * from data_siswa where id_kelas='".$idkelas."' order by ".$order."  ")->result();
			$no=1;
			foreach($dbsiswa as $val)
			{
				$this->db->query("UPDATE data_siswa set ".$dbrank."='".$no++."' where id='".$val->id."'  ");
			}
		
	}
	function predikat($NR) //nilai rata pengetahuan
	{
		if($NR>=86){
		return $predikat="A";	  
		}elseif($NR>=71){
		return $predikat="B";	
		}
		elseif($NR>=56){
		return $predikat="C";	
		}else{
		return $predikat="D"; 
		}
	}
	
	function desc_nrp($NR) //nilai rata pengetahuan
	{
		if($NR=="A"){
		return $predikat="Siswa telah menguasai seluruh kompetensi yang diajarkan dengan sangat baik";	  
		}elseif($NR=="B"){
		return $predikat="Siswa telah menguasai seluruh kompetensi yang diajarkan dengan baik dan ada beberapa kompetensi yang harus ditingkatkan";	
		}
		elseif($NR=="C"){
		return $predikat="Siswa cukup menguasai kompetensi yang telah diajarkan dan membutuhkan bimbingan untuk meningkatkan kembali  kompetensinya yang masih kurang";	
		}else{
		return $predikat="Siswa kurang menguasai kompetensi yang diajarkan dan harus mengulang kembali sebagaian atau seluruh kompetensi yang masih kurang"; 
		}
	}
	
	function desc_nrpNonmuslim($NR) //nilai rata pengetahuan
	{
		if($NR=="A"){
		return $predikat="Siswa telah menguasai seluruh kompetensi yang diajarkan dengan sangat baik";	  
		}elseif($NR=="B"){
		return $predikat="Siswa telah menguasai seluruh kompetensi yang diajarkan dengan baik dan ada beberapa kompetensi yang harus ditingkatkan";	
		}
		elseif($NR=="C"){
		return $predikat="Siswa cukup menguasai kompetensi yang telah diajarkan dan membutuhkan bimbingan untuk meningkatkan kembali  kompetensinya yang masih kurang";	
		}else{
		return $predikat="Siswa kurang menguasai kompetensi yang diajarkan dan harus mengulang kembali sebagaian atau seluruh kompetensi yang masih kurang"; 
		}
	}function desc_nrkNonmuslim($NR) //nilai rata pengetahuan
	{
		if($NR=="A"){
		return $predikat="Siswa telah menguasai seluruh kompetensi yang diajarkan dengan sangat baik";	  
		}elseif($NR=="B"){
		return $predikat="Siswa telah menguasai seluruh kompetensi yang diajarkan dengan baik dan ada beberapa kompetensi yang harus ditingkatkan";	
		}
		elseif($NR=="C"){
		return $predikat="Siswa cukup menguasai kompetensi yang telah diajarkan dan membutuhkan bimbingan untuk meningkatkan kembali  kompetensinya yang masih kurang";	
		}else{
		return $predikat="Siswa kurang menguasai kompetensi yang diajarkan dan harus mengulang kembali sebagaian atau seluruh kompetensi yang masih kurang"; 
		}
	}
	function desc_nrk($NR) //nilai rata pengetahuan
	{
		if($NR=="A"){
		return $predikat="Sangat mampu mengolah, menalar dan menyaji dalam ranah konkret dan ranah abstrak terkait dengan pengembangan diri yang dipelajarinya di sekolah secara mandiri, dan mampu menggunakan metoda sesuai kaidah";	  
		}elseif($NR=="B"){
		return $predikat="mampu mengolah, menalar dan menyaji dalam ranah konkret dan ranah abstrak terkait dengan pengembangan diri yang dipelajarinya di sekolah secara mandiri, dan mampu menggunakan metoda sesuai kaidah";	
		}
		elseif($NR=="C"){
		return $predikat="Cukup mampu mengolah, menalar dan menyaji dalam ranah konkret dan ranah abstrak terkait dengan pengembangan diri yang dipelajarinya di sekolah secara mandiri, dan mampu menggunakan metoda sesuai kaidah";	
		}else{
		return $predikat="Kurang mampu mengolah, menalar dan menyaji dalam ranah konkret dan ranah abstrak terkait dengan pengembangan diri yang dipelajarinya di sekolah secara mandiri, dan mampu menggunakan metoda sesuai kaidah"; 
		}
	}
	function getNilaiKBPengetahuan($id_mapel,$idguru)
	{	$sms=$this->m_reff->semester(); $tahun=$this->m_reff->tahun();
		$r=$this->db->query("select AVG(kd3_kb) as nilai from v_kikd where id_mapel='".$id_mapel."' AND id_guru='".$idguru."' and id_tahun='".$tahun."' and id_semester='".$sms."' ")->row();
		return isset($r->nilai)?($r->nilai):"";
	}
	function getNilaiKBKeterampilan($id_mapel,$idguru)
	{	$sms=$this->m_reff->semester(); $tahun=$this->m_reff->tahun();
		$r=$this->db->query("select AVG(kd4_kb) as nilai from v_kikd where id_mapel='".$id_mapel."' AND id_guru='".$idguru."'   and id_tahun='".$tahun."' and id_semester='".$sms."' ")->row();
		return isset($r->nilai)?($r->nilai):"";
	}
	/*===================================*/
	function getDataNilai()
	{
		$query=$this->_getDataNilai();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getDataNilai()
	{	
		$query="select * from data_siswa where id_kelas='".$this->input->post("id_kelas")."'  and aktifasi=1 and id_tahun_keluar is null";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  
				) ";
			}

		$column = array('', 'nama','hp'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by nama   asc";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_getDataNilai()
	{				
		$query = $this->_getDataNilai();
        return  $this->db->query($query)->num_rows();
	}
	function ttd_kepsek($tahun)
	{
		return $this->m_reff->goField("tr_tahun_ajaran","ttd_kepsek","where id='".$tahun."'");
	}	function nama_kepsek($tahun)
	{
		return $this->m_reff->goField("tr_tahun_ajaran","nama_kepsek","where id='".$tahun."'");
	}
	function titiMangsaRapot($sms)
	{
		if($sms==1)
		{
			$sms="tgl_cetak_raport";
		}else{
			$sms="tgl_cetak_raport_gnp";
		}
		$tahun=$this->m_reff->tahun();
		$t=$this->m_reff->goField("tr_tahun_ajaran",$sms,"where id='".$tahun."'");
		return $this->tanggal->indonesiaBulan($t," ");
		
	}
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
		$return=isset($get->s)?($get->s):0;
		return number_format($return,2);
	}

	
	 function id_kelas()
	{
		return $this->m_reff->goField("data_siswa","id_kelas","where id='".$this->idu()."'");
	}
	function id_agama()
	{
		return $this->m_reff->goField("data_siswa","id_agama","where id='".$this->idu()."'");
	}
	function id_guru($id_mapel)
	{
		$this->db->where("id_mapel",$id_mapel);
		$this->db->where("id_kelas",$this->id_kelas());
		$data=$this->db->get("tm_mapel_ajar")->row();
		return isset($data->id_guru)?($data->id_guru):"";
	}
  
}