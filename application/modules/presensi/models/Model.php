<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }

    function getJadwalKosong(){
    	$tgl 		= $this->tanggal->eng_($_POST['tgl'], "-");
    	$hari 		= date('N', strtotime($tgl));

    	switch ($hari) {
    		case '1':
    			$sts_jam = "1";
    		break;

    		case '5':
    			$sts_jam = "2";
    		break;
    		
    		default:
    			$sts_jam = "0";
    		break;
    	}

    	// 0 = sel, rab, kam
    	// 1 = sen
    	// 2 = jum
    	$this->db->order_by("nama", "ASC");
    	$d 			= $this->db->get("data_pegawai")->result();
    	$tahun 		= $this->m_reff->tahun();
		$semester 	= $this->m_reff->semester();


		$this->db->where("urut!=", null);
		$this->db->where("sts", $sts_jam);
		$qjam = $this->db->get("tr_jam_ajar")->result();

		$json = "[";
		$no = 1;
		foreach ($d as $v) {

			$this->db->where("id_semester", $semester);
			$this->db->where("id_tahun", $tahun);
			$this->db->where("id_hari", $hari);
			$this->db->where("id_guru", $v->id);
			$this->db->like("jam", $_POST['jam'].",");
			$q 	= $this->db->get("v_jadwal");
			$x 	= $q->num_rows();
			$dj	= $q->result();

			if ($x == 0) {
				if ($no > 1) {
					$json.=", ";
				}

		 		$data = array(
			 		"jam"	=> $_POST['jam'],
			 		"x"	=> $x,
			 		"nama"	=> $v->nama,
			 		"id_guru"	=> $v->id
			 	);

			 	$json.= json_encode($data);

			 	$no++;
			}

		}
		$json.="]";

		return $json;

		/*
		$json = "[";
		$no = 1;
		$guru = "";
		$jam = "";
		foreach ($x as $vx) {
			
			if ($guru == "") {
				$jam.=$vx->jam;
				$guru = $vx->id_guru;
			}
			else{
				if ($guru == $vx->id_guru) {
					$jam.=$vx->jam;
				}
				else{
					


					foreach ($qjam as $vjam) {
						if (strpos($vx->jam, $jam) !== false) {

							if ($no > 1) {
								$json.=", ";
							}

							$data = array(
						 		"nama_pegawai"	=> $this->m_reff->goField("data_pegawai", "nama", "WHERE id='".$vx->id_guru."'"),
						 		"jam"			=> $vjam->urut,
						 		"hari"			=> $hari
						 	);

						 	$json.= json_encode($data);

						 	$no++;
						}
					}

					$jam = "";
					$guru = $vx->id_guru;
				}
			}

			
			
			

		}
		$json.="]";
		*/
		
		/*
		$this->db->where("urut!=", null);
		$this->db->where("sts", $sts_jam);
		$x 			= $this->db->get("tr_jam_ajar")->result();

		$json = "[";
		$no = 1;
		foreach ($d as $v) {

			foreach ($x as $vx) {
				
				

				$this->db->where("id_tahun", $tahun);
			 	$this->db->where("id_semester", $semester);
			 	$this->db->where("id_guru", $v->id);
			 	$this->db->where("id_hari", $hari);
			 	$this->db->like("jam", $vx->urut);
			 	$g = $this->db->get("v_jadwal")->num_rows();

			 	if ($g == 0) {

			 		if ($no > 1) {
						$json.=", ";
					}

			 		$data = array(
				 		"nama_pegawai"	=> $v->nama,
				 		"jam"			=> $vx->urut,
				 		"hari"			=> $hari
				 	);

				 	$json.= json_encode($data);

				 	$no++;
			 	}
			 	
		 	}
		}

		$json.="]";*/

    	
    }

    function getJadwalKosongResult($date, $jam){
    	$tgl 		= $this->tanggal->eng_($date, "-");
    	$hari 		= date('N', strtotime($tgl));

    	switch ($hari) {
    		case '1':
    			$sts_jam = "1";
    		break;

    		case '5':
    			$sts_jam = "2";
    		break;
    		
    		default:
    			$sts_jam = "0";
    		break;
    	}

    	// 0 = sel, rab, kam
    	// 1 = sen
    	// 2 = jum
    	$this->db->order_by("nama", "ASC");
    	$d 			= $this->db->get("data_pegawai")->result();
    	$tahun 		= $this->m_reff->tahun();
		$semester 	= $this->m_reff->semester();


		$this->db->where("urut!=", null);
		$this->db->where("sts", $sts_jam);
		$qjam = $this->db->get("tr_jam_ajar")->result();

		$html = "";
		$no = 1;
		foreach ($d as $v) {

			$this->db->where("id_semester", $semester);
			$this->db->where("id_tahun", $tahun);
			$this->db->where("id_hari", $hari);
			$this->db->where("id_guru", $v->id);
			$this->db->like("jam", $jam.",");
			$q 	= $this->db->get("v_jadwal");
			$x 	= $q->num_rows();
			$dj	= $q->result();
			
			if ($x == 0) {
				$html .= "
					<tr>
						<td align='center'>".$no."</td>
						<td>".$v->nama."</td>
						<td align='center'>".$jam."</td>
					</tr>
				";

				$no++;
			}

		}

		return $html;

    	
    }
    
    
    function status_absen($tgl,$nip)
    {   $jamMulai="050000"; $jamAkhir="200000"; $jamToleransi="080000"; //masuk
         $jamMasuk=$this->m_reff->pengaturan(4);  
         $jamPulang=$this->m_reff->pengaturan(5);
        $datang=$this->absenDatang($tgl,$nip);
        $pulang=$this->absenPulang($tgl,$nip,$datang);
        if($datang=="-" or !$datang){ return "0";  } //tidak masuk
        if($pulang=="-" or !$pulang){ return "0";  } //tidak masuk
        if($pulang=="-" or !$pulang){ return "0";  } //tidak masuk
       
        
          $jamMasuk=str_replace(":","",$jamMasuk);
          $jamPulang=str_replace(":","",$jamPulang);
          $pulang=str_replace(":","",$pulang); 
          $datang=str_replace(":","",$datang);
          
          if($datang>$jamToleransi){ return "0";  } //tidak masuk    
          if($pulang>$jamAkhir){ return "0";  } //tidak masuk    
          
        if($datang>=$jamMulai and $datang<=$jamMasuk and $pulang>=$jamPulang and $pulang<=$jamAkhir ){ return "m"; }
        if($datang>=$jamMulai and $datang<=$jamMasuk and $pulang>=$jamPulang and $pulang>$jamAkhir ){ return "0"; }
         if($datang>=$jamMulai and $datang<=$jamMasuk and $pulang<=$jamPulang){ return "p"; }//pulang lebih awal
         if($datang>=$jamMulai and $datang>=$jamMasuk and  $datang<=$jamToleransi  and  $pulang>=$jamPulang and $pulang<=$jamAkhir   ){ return "t"; } 
         if($datang>=$jamMulai and $datang>=$jamMasuk and  $datang<=$jamToleransi  and  $pulang<$jamPulang ){ return "tp"; } 
    }
    	function absenDatang($tgl,$nip)
		{
	 
		   $data=$this->db->query("select * from tm_log_kehadiran where noid='".$nip."' and SUBSTR(tgl,1,10)='".$tgl."' order by id asc limit 1 ")->row();
		   $return=isset($data->tgl)?($data->tgl):"-";
            if($return && $return!="-"){
                return substr($return,10,9);
            }else{
                return $return;
            }		
		    
		}
			function absenPulang($tgl,$nip,$datang=null)
		{      
		   $data=$this->db->query("select * from tm_log_kehadiran where noid='".$nip."' and SUBSTR(tgl,1,10)='".$tgl."'  and SUBSTR(tgl,12,5)>'13:00'  order by id DESC limit 1 ")->row();
		   $pulang=isset($data->tgl)?($data->tgl):"-";
		   if($pulang==$datang)
		   {
		       return "-";
		   }else{
		       if($pulang && $pulang!="-"){
                return substr($pulang,10,9);
            }else{
                return $pulang;
            }	
		   }
		}
    function cekAbsenFinger($nip,$tgl){
        $kodeH=date('N', strtotime($tgl));
       	$return=$this->m_reff->goField("tm_log_kehadiran","id","where noid='".$nip."' and SUBSTR(tgl,1,10)='".$tgl."'");
        $ceklibur=$this->db->query("select id from tm_jadwal_libur where SUBSTR(tm_jadwal_libur.start,1,10)<='".$tgl."'  and SUBSTR(tm_jadwal_libur.end,1,10)>='".$tgl."'")->num_rows();
         
        $jamawal=$this->db->query("select * from tm_log_kehadiran where  noid='".$nip."' and SUBSTR(tgl,1,10)<'".$tgl."' ")->row();
         
         
        if($kodeH=="6"){
             return 6;
        }if($kodeH=="7"){
             return 7;
        }
        if($return and $ceklibur){
            return 3;
        }elseif($return and !$ceklibur){
            return 1;
        }elseif(!$return and $ceklibur){
            return 4;
        }elseif(!$return and !$ceklibur){
            return 2;
        } 
        
    }
	function nama_kepsek($tahun)
	{
		return $this->m_reff->goField("tr_tahun_ajaran","nama_kepsek","where id='".$tahun."'");
	}
	function tgl_surat($tahun)
	{
	    	return $this->m_reff->goField("tr_tahun_ajaran","tgl_cetak_un","where id='".$tahun."'");
	}
	function ttd_kepsek($tahun)
	{
		return $this->m_reff->goField("tr_tahun_ajaran","ttd_kepsek","where id='".$tahun."'");
	}
	function no_surat($id,$tahun)
	{         $dp=$this->m_reff->dataProfileSiswa($id); 
	
	    	$return=$this->m_reff->goField("tr_tahun_ajaran","no_surat_un","where id='".$tahun."'");
	    	$r=str_replace("{nis}",$dp->nis,$return);
	    	return	$r=str_replace("{no}",$dp->id,$r);
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
						  
				 		  
		$cari=$this->input->post("searching");
		$id_kelas=$this->input->post("id_kelas");
		$gender=$this->input->post("gender"); 
	 	$sts_un=$this->input->post("id_stsdata");
	 
		 
		$filter=" AND aktifasi='1'  and id_tahun_keluar is null";
		
		
		if($sts_un!="")
		{
			$filter.=" AND sts_un='".$sts_un."' ";
		} 
		 
		 
		if($cari)
		{
			$filter.=" AND (
				nama LIKE '%".$cari."%'  or
				nis LIKE '%".$cari."%'  
			 
				) ";
		}
	 
		
		 
		/*if($id_kelas)
		{	$dtkls="";
			foreach($id_kelas as $valk)
			{
				$dtkls.=$valk.",";
			}
			$dtkls=substr($dtkls,0,-1);
			if($dtkls){
			$filterz=" AND id_kelas in (".$dtkls.") ";
			$filter.=str_replace("(,","(",$filterz);
			}
			
		} */
		 
		if($id_kelas)
		{
			$filter.=" AND id_kelas='".$id_kelas."' ";
		}else{
		    	$filter.=" AND id_kelas IN (select id from tm_kelas where id_tk=3) ";
		}
		
		if($gender)
		{
			$filter.=" AND jk='".$gender."' ";
		} 
		
		 
		$query="select * from data_siswa where 1=1 $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				nis LIKE '%".$searchkey."%'  or 
				alamat LIKE '%".$searchkey."%'  or
				hp LIKE '%".$searchkey."%'  
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
		$query.="  order by id_kelas,nama";
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
	
	function setUn()
	{
	    $sts=$this->input->post("pilih");
	    $siswa=$this->input->post("value");
	    $ids="";
	    foreach($siswa as $val){
	        $ids.=$val.",";
	    }
	    $ids=substr($ids,0,-1);
	      $this->db->where("id IN (".$ids.")");
	    $this->db->set("sts_un",$sts); 
	  return  $this->db->update("data_siswa");
	}
	 /*===================================*//*===================================*/
 
 	/*===================================*/
	function get_data_pendidik()
	{
		$query=$this->_get_data_pendidik();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_pendidik()
	{
		$id_kelas=$this->input->get_post("id_kelas");
		$id_mapel=$this->input->get_post("id_mapel");
		$sts=$this->input->get_post("sts");
		$gender=$this->input->get_post("gender");
		$jabatan=$this->input->get_post("jabatan");
		$aktifasi=$this->input->get_post("aktifasi");
		$pangkat=$this->input->get_post("pangkat");
		$idguru = $this->input->get_post("idguru");
		 
		$filter="";

		if ($idguru!="") {
			$filter.=" AND id = '".$idguru."' ";
		}
		else{
			if($jabatan)
			{
				$filter.="AND id_jabatan='".$jabatan."' ";
			} if($pangkat)
			{
				$filter.="AND id_pangkat='".$pangkat."' ";
			} if($aktifasi)
			{
				$filter.="AND aktifasi='".$aktifasi."' ";
			} 
			if($id_mapel)
			{
				$filter.="AND id_mapel like ('%".$id_mapel."%') ";
			} 
			if($id_kelas)
			{
				$filter.="AND id_kelas='".$id_kelas."' ";
			} 
			if($sts)
			{
				$filter.="AND sts_kepegawaian='".$sts."' ";
			} 
			if($gender)
			{
				$filter.="AND jk='".$gender."' ";
			}
		}
		 
		
		 
		$query="select * from v_pegawai where 1=1 $filter ";
			if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				nip LIKE '%".$searchkey."%'  or
				hp LIKE '%".$searchkey."%'  
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
		$query.=" order by nama   ASC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_pendidik()
	{				
		$query = $this->_get_data_pendidik();
        return  $this->db->query($query)->num_rows();
	}
	 
	 
	function getDataMapel($id)
	{
		$data=explode(",",$id); $mapel="";
		foreach($data as $val)
		{
			$mapel.=$this->m_reff->goField("tr_mapel","nama","where id='".$val."' ").",";
		}
		return substr($mapel,0,-1);
	}		
  
  function selisih($akhir,$awal) //menit
  {
      return $hourdiff  = round((strtotime($akhir) - strtotime($awal))/60, 2)*60;
  }
  function selisih_perhari($akhir,$awal) //menit
  {
      return $hourdiff  = round((strtotime($akhir) - strtotime($awal))/60, 2)*60;
  }
  
/*  function hitungJam($menit)
  { return $this->waktu($menit*60);
      $return=number_format(($menit/60),2);
      if($return<1){
          $return= "0.".number_format(($menit),0);
      }
      return str_replace(".",":",$return);
  }*/
  
	 function hitungJam($waktu){
	     
                if(($waktu>0) and ($waktu<60)){
                    $lama=number_format($waktu,2)."  ";
                    return "00:00:".sprintf("%'.02d",$lama);
                }
                if(($waktu>60) and ($waktu<3600)){
                    $detik=fmod($waktu,60);
                    $menit=$waktu-$detik;
                    $menit=$menit/60;
                    $lama="00:".sprintf("%2d",$menit).":".sprintf("%'.02d",number_format($detik,0))."  ";
                    return $lama;
                }
                elseif($waktu >3600){
                    $detik=fmod($waktu,60);
                    $tempmenit=($waktu-$detik)/60;
                    $menit=fmod($tempmenit,60);
                    $jam=($tempmenit-$menit)/60;    
                    $lama=sprintf("%'.02d",$jam).":".sprintf("%'.02d",$menit).":".sprintf("%'.02d",number_format($detik,0))." ";
                    return $lama;
                }
    
	 }
}