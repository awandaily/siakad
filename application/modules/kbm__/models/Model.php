<?php

class Model extends CI_Model  {
    
	var $tbl="v_jadwal";
 	function __construct()
    {
        parent::__construct();
    }
    function update_rekap(){
		$id 	= $_POST["id"];
		$bahas 	= $_POST["bahas"];
		$kikd 	= $_POST["kikd"];

		$this->db->where("id", $kikd);
		$kd = $this->db->get("v_kikd")->row_array();

		$dt = array(
				"id_kikd"		=> $kikd,
				"kode_kd"		=> $kd["kd3_no"],
				"cpembelajaran"	=> $bahas
				
			);
		$this->db->where("id", $id);
		return $this->db->update("tm_absen_guru", $dt);

	}
    function getSiswaAlfa($idjadwal,$tgl,$id)
    {   $absen="absen".$id;
        $this->db->where("id_jadwal",$idjadwal);
        $this->db->where("SUBSTR(tgl,1,10)",substr($tgl,0,10));
        $data=$this->db->get("tm_absen_siswa")->row();
        $siswa=isset($data->$absen)?($data->$absen):"";
        $get=$this->m_reff->clearkomaray($siswa);
        $asik="";
        foreach($get as $val)
        {
            $asik.=$this->m_reff->goField("data_siswa","nama","where id='".$val."' ").",";
        }
        $asik=str_replace(",,",",",$asik);
        return substr($asik,0,-1);
    }
    function hapus_kbm()
    {
        $this->db->where("id",$this->input->post("id"));
            $this->db->where("id_guru",$this->idu());
        return $this->db->delete("tm_absen_guru");
    }
    function insert_izin()
    {
        $form=$this->input->post("f");
        $this->db->set($form);
                  $this->db->where("SUBSTR(tgl,1,10)",date('Y-m-d'));
			     $this->db->where("id_jadwal",$this->input->post("f[id_jadwal]"));
			      $this->db->where("id_guru",$this->idu());
       return $this->db->update("tm_absen_guru");
    }
    
    function insert_tugas()
	{	
		$form=$this->input->post("f");
		$hari=$this->input->post("hari");
		$kelas=$this->input->post("id_kelas"); 
		$id_mapel=$this->input->post("id_mapel");
	 
		$tgl=$this->tanggal->tambahTgl(null,$hari);
		$kelas=",".$kelas.",";
		$this->db->set('id_guru',$this->idu());
		$this->db->set("kelas",$kelas);
		$this->db->set("expired",$tgl);
		$this->db->set("sumber",1);
		$this->db->set($form);
		$this->db->set("id_mapel",$id_mapel);
		$notug=$this->m_reff->next_nomor('data_tugas');
		$path="file_upload/tugas";
		if(!file_exists($path)){
		    mkdir($path, 0777, true);
		}
			$path="file_upload/tugas/".$notug;
		if(!file_exists($path)){
		    mkdir($path, 0777, true);
		}
		
		
			if(isset($_FILES["file"]['tmp_name']))
			{
        		$do=$this->m_reff->upload_file("file","tugas/$notug",$nama_file_awal="tugas",$type_file_yg_diizinkan="JPG,JPEG,PNG,XLSX,DOCX,PDF,pptx,ZIP,zip,rar,RAR",$sizeFile="3000000",$before_file=null);
        		if($do["size"]==false){
        		  //  $max=$do["maxsize"]."MB";
        		      $do["gagal"]=false; $do["info"]="File terlalu besar maksimal 3MB";
        		      return $do;
        		}
        		else if($do["validasi"]==false){
        		     
        		      $do["gagal"]=false; $do["info"]="Tidak dapat mengupload file, coba ganti file ";
        		      return $do;
        		}
        		else if($do["file"]==false){
        		     $type=$do["type_file"];
        		      $do["gagal"]=false; $do["info"]="Gagal!! file yang diizinkan: $type ";
        		      return $do;
        		}else if(isset($do["name"])){
        		    	$this->db->set("file",$do["name"]);
        		}
			}
	if($this->input->post("id")){
			    $this->db->where("tgl",date('Y-m-d'));
			     $this->db->where("id_jadwal",$this->input->post("f[id_jadwal]"));
			      $this->db->where("id_guru",$this->idu());
            	return	$this->db->update("data_tugas");
			}else{
				return	$this->db->insert("data_tugas");    
			}
		
	}
	function addSumberNotRealtime($idguru,$idmapel,$idjadwal,$idkelas,$jam)
	{
	     $sms=$this->m_reff->semester();$tahun=$this->m_reff->tahun();
         $this->db->set("id_semester",$sms);
           $this->db->set("id_hari",date("N"));
             $this->db->set("id_kelas",$idkelas);
          $this->db->set("id_tahun",$tahun);
              $this->db->set("jam",$jam);
        $this->db->set("id_jadwal",$idjadwal);
         $this->db->set("sumber",$id);
          $this->db->set("id_guru",$idguru);
           $this->db->set("id_mapel",$idmapel);
           
           
           if($id!=3 or $izin==false){
               
               $cek=$this->db->query("select * from tm_absen_guru where  id_jadwal='".$idjadwal."' and id_guru='".$idguru."' and SUBSTR(tgl,1,10)='".date('Y-m-d')."' limit 1")->num_rows();
               if($cek)
               {
                   $this->db->where("id_jadwal",$idjadwal);
                     $this->db->where("id_guru",$idguru);
                       $this->db->where("SUBSTR(tgl,1,10)",date('Y-m-d'));
                     return  $this->db->update("tm_absen_guru");
               }else{
                     return  $this->db->insert("tm_absen_guru");
               }
                
               
           }else{
                if($izin){ 
               return false;
                 }
           }
	}
    function addSumber($id,$idguru,$idmapel,$idjadwal,$idkelas,$jam,$izin)
    {   $sms=$this->m_reff->semester();$tahun=$this->m_reff->tahun();
         $this->db->set("id_semester",$sms);
           $this->db->set("id_hari",date("N"));
             $this->db->set("id_kelas",$idkelas);
          $this->db->set("id_tahun",$tahun);
              $this->db->set("jam",$jam);
        $this->db->set("id_jadwal",$idjadwal);
         $this->db->set("sumber",$id);
          $this->db->set("id_guru",$idguru);
           $this->db->set("id_mapel",$idmapel);
           
           
           if($id!=3 or $izin==false){
               
               $cek=$this->db->query("select * from tm_absen_guru where  id_jadwal='".$idjadwal."' and id_guru='".$idguru."' and SUBSTR(tgl,1,10)='".date('Y-m-d')."' limit 1")->num_rows();
               if($cek)
               {
                   $this->db->where("id_jadwal",$idjadwal);
                     $this->db->where("id_guru",$idguru);
                       $this->db->where("SUBSTR(tgl,1,10)",date('Y-m-d'));
                     return  $this->db->update("tm_absen_guru");
               }else{
                   
                   if($id==1){
                       $cek=$this->m_reff->pengaturan(21);
                       if($cek=="ya"){
                            $ids=$this->m_reff->goField("data_pegawai","nip","where id='".$this->mdl->idu()."' ");
                             $cekfinger=$this->mdl->cekfinger($ids);
                             if(!$cekfinger)
                            { 
                                echo "finger";
                            	return false;
                            }
                            
                       }
                       
                       
                   }
                      $cek=$this->m_reff->pengaturan(22);
                       if($cek=="ya"){
                           $jam_blok= $this->input->post("jam_blok");  
                           	$this->db->set("jam_blok",$jam_blok);
                    	  	$jml_jam_valid=$this->m_reff->jamValid($jam,$jam_blok);	
                    		$jml_jam_blok=$this->m_reff->jamBlok($jam_blok);	
                			 $this->db->set("jml_jam_valid",$jml_jam_valid);
                             $this->db->set("jml_jam_blok",$jml_jam_blok);
                       }else{
                           $jam_blok=0;
                           $jml_jam_valid=$this->m_reff->jamValid($jam,$jam_blok);
                          $this->db->set("jml_jam_valid",$jml_jam_valid); 
                       }
                   
                     return  $this->db->insert("tm_absen_guru");
               }
                
               
           }else{
                if($izin){ 
               return false;
                 }
           }
          
    
    }
	function cekfinger($ids)
	{	$now=date("Y-m-d");
		$this->db->where("noid",$ids);
		$this->db->where("SUBSTR(tgl,1,10)",$now);
		$this->db->limit(1);
	return	$this->db->get("tm_log_kehadiran")->num_rows();
	}
	function idu()
	{
		return $this->session->userdata("id");
	}
	function guruMasuk()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$id_kikd=$this->input->post("id_kikd");
		$id_materi=$this->input->post("id_materi");
		$id_mapel=$this->input->post("id_mapel");
		$id_kelas=$this->input->post("id_kelas");
		$data_jam=$this->input->post("jam");
		$jam_blok=0;//$this->input->post("jam_blok"); jam blok dibebaskan
		$id_jadwal=$this->input->post("id_jadwal");
			$materi=$this->input->post("materi");
		$id_hari=date("N");
			
		$jml_jam_valid=$this->m_reff->jamValid($data_jam,$jam_blok);	
		$jml_jam_blok=$this->m_reff->jamBlok($jam_blok);	
			
			
		if(!$id_materi)
		{
	//		return false;
		}	
		
		$kode_kd=$this->m_reff->goField("tm_kikd","kd3_no","where id='".$id_kikd."'");
		
		$data=array(
		"id_semester"=>$sms,
		"id_tahun"=>$tahun,
		"id_kikd"=>$id_kikd,
		"kode_kd"=>$kode_kd,
		"id_guru"=>$this->idu(),
		"id_jadwal"=>$id_jadwal,
	//	"id_materi"=>$id_materi,
		"id_hari"=>$id_hari,
		"id_kelas"=>$id_kelas,
		"jam"=>$data_jam,
		"id_mapel"=>$id_mapel 
		);
		$cek=$this->db->query("select * from tm_absen_guru where id_jadwal='".$id_jadwal."' and substr(tgl,1,10)='".date('Y-m-d')."' ")->num_rows();
		if($cek)
		{	
					$this->db->where("id_jadwal",$id_jadwal);
					$this->db->where("substr(tgl,1,10)",date('Y-m-d'));
					$this->db->set("tgl",date("Y-m-d H:i:s"));
						$this->db->set("cpembelajaran",$materi);
			return	$this->db->update("tm_absen_guru",$data);
		}else{
				$this->db->set("jml_jam_valid",$jml_jam_valid);
				$this->db->set("jml_jam_blok",$jml_jam_blok);
				$this->db->set("tgl",date("Y-m-d H:i:s"));
					$this->db->set("cpembelajaran",$materi);
			$this->db->set("jam_blok",$jam_blok);
			return	$this->db->insert("tm_absen_guru",$data);
		}
	}
	
	function siswaMasuk__()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		$id_siswa=$this->input->post("idsiswa");
		$id_absen=$this->input->post("idabsen");
		$id_jadwal=$this->input->post("idjadwal");
		$id_mapel=$this->input->post("idmapel");
		$tgl=$this->input->post("tgl");
		if(!$tgl){ $tgl=date("Y-m-d H:i:s") ; }
		$id_hari=date("N");
				
		$data=array(
		"id_semester"=>$sms,
		"id_tahun"=>$tahun,
		"id_jadwal"=>$id_jadwal,
		"id_siswa"=>$id_siswa,
		"id_sts"=>$id_absen,
		"id_mapel"=>$id_mapel,
		 
		);
		$cek=$this->db->query("select * from tm_absen_siswa where id_jadwal='".$id_jadwal."' and id_siswa='".$id_siswa."' and substr(tgl,1,10)='".substr($tgl,0,10)."' ")->num_rows();
		if($cek)
		{	
					$this->db->where("id_siswa",$id_siswa);
					$this->db->where("id_jadwal",$id_jadwal);
					$this->db->where("substr(tgl,1,10)",$tgl);
					$this->db->set("tgl",$tgl);
			return	$this->db->update("tm_absen_siswa",$data);
		}else{
			$this->db->set("tgl",$tgl);
			return	$this->db->insert("tm_absen_siswa",$data);
		}
		
		
	}
	function siswaMasuk()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		$id_siswa=$this->input->post("idsiswa");
		$id_absen=$this->input->post("idabsen");
		$id_jadwal=$this->input->post("idjadwal");
		$id_mapel=$this->input->post("idmapel");
		$hadir=$this->input->post("hadir");
		$sakit=$this->input->post("sakit");
		$izin=$this->input->post("izin");
		$alfa=$this->input->post("alfa");
		$bolos=$this->input->post("bolos");
		$dispen=$this->input->post("dispen");
		$tgl=$this->input->post("tgl");
		if(!$tgl){ $tgl=date("Y-m-d") ; }
		$id_hari=date("N");
				
		$data=array(
		"id_semester"=>$sms,
		"id_tahun"=>$tahun,
		"id_jadwal"=>$id_jadwal,
		"id_mapel"=>$id_mapel,
		 
		);
		$cek=$this->db->query("select * from tm_absen_siswa where id_jadwal='".$id_jadwal."' and id_mapel='".$id_mapel."'  and substr(tgl,1,10)='".substr($tgl,0,10)."' ")->num_rows();
		if($cek)
		{	
 
				 
					$this->db->where("id_mapel",$id_mapel);
					$this->db->where("id_jadwal",$id_jadwal);
					$this->db->where("substr(tgl,1,10)",$tgl);
					$this->db->set("tgl",$tgl);
					$this->db->set("absen1",$hadir.",");
					$this->db->set("absen2",$sakit.",");
					$this->db->set("absen3",$izin.",");
					$this->db->set("absen4",$alfa.",");
					$this->db->set("absen5",$bolos.",");
					$this->db->set("absen6",$dispen.",");
					
			return	$this->db->update("tm_absen_siswa",$data);
		}else{
			$this->db->set("tgl",$tgl);
					$this->db->set("absen1",$hadir.",");
					$this->db->set("absen2",$sakit.",");
					$this->db->set("absen3",$izin.",");
					$this->db->set("absen4",$alfa.",");
					$this->db->set("absen5",$bolos.",");
					$this->db->set("absen6",$dispen.",");
			return	$this->db->insert("tm_absen_siswa",$data);
		}
	}
	function cekStsHadirSiswa($id_jadwal,$id_siswa,$tgl=null)
	{
			if($tgl==null){
				$tgl="SUBSTR(tgl,1,10)='".date("Y-m-d")."'";
			}else{
				$tgl="SUBSTR(tgl,1,10) = '".$tgl."'";
			}
			 
			 
			$return=$this->db->query("select * from tm_absen_siswa where id_jadwal='".$id_jadwal."' and ".$tgl." and absen1 like('%,".$id_siswa.",%') ")->num_rows();
			if($return)
			{
				return 1;
			} 
			
			 $return=$this->db->query("select * from tm_absen_siswa where id_jadwal='".$id_jadwal."' and ".$tgl." and absen2 like('%,".$id_siswa.",%') ")->num_rows();
			 if($return)
			 {
				 return 2;
			 } 
					
			 $return=$this->db->query("select * from tm_absen_siswa where id_jadwal='".$id_jadwal."' and ".$tgl." and absen3 like('%,".$id_siswa.",%') ")->num_rows();
			 if($return)
			 {
				return 3;
			 } 			
				 $return=$this->db->query("select * from tm_absen_siswa where id_jadwal='".$id_jadwal."' and ".$tgl." and absen4 like('%,".$id_siswa.",%') ")->num_rows();
			 if($return)
			 {
				return 4;
			 } 		
			 
			 $return=$this->db->query("select * from tm_absen_siswa where id_jadwal='".$id_jadwal."' and ".$tgl." and absen5 like('%,".$id_siswa.",%') ")->num_rows();
			 if($return)
			 {
				return 5;
			 } 			
				 
				 $return=$this->db->query("select * from tm_absen_siswa where id_jadwal='".$id_jadwal."' and ".$tgl." and absen6 like('%,".$id_siswa.",%') ")->num_rows();
			 if($return)
			 {
				return 6;
			 } 			
				 
				 return 1;
			 
	}
	function cekInstal()
	{ 
	$this->db->where("id",$this->idu());
	$return=$this->db->get("data_pegawai")->row();
	return isset($return->sts_isi)?($return->sts_isi):"0";
	}
	function insertCatatan()
	{
		$id_jadwal=$this->input->post("id_jadwal");
		$catt=$this->input->post("catt");
		$catt=$this->security->xss_clean($catt);
		$this->db->set("cpembelajaran",$catt);
		$this->db->where("SUBSTR(tgl,1,10)",date("Y-m-d"));
		$this->db->where("id_jadwal",$id_jadwal);
	return $this->db->update("tm_absen_guru");
	}
	
	function getKelasIni($id_jam)
	{	$hari=date("N");
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
	//	$this->db->where("id_semester",$sms);
	//	$this->db->where("id_tahun",$tahun);
	//	$jam=",".$jam.",";
	//	$this->db->like("jam",$jam);
		//$this->db->where("jam_awal>=",$id_jam);
		//$this->db->where("jam_akhir<=",$id_jam);
		//$this->db->where("id_hari",$hari);
		//$this->db->where("id_guru",$this->idu());
	return	$this->db->query("select * from v_jadwal where id_guru='".$this->idu()."' and id_hari='".$hari."' 
	and id_tahun='".$tahun."' and id_semester='".$sms."'and jam like '%,".$id_jam.",%'  ")->row();
	}
	
	function getMateri($id_kelas,$id_mapel,$idkikd)
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_mapel",$id_mapel);
		$this->db->where("id_kelas",$id_kelas);
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_kikd",$idkikd);
	return	$this->db->get("v_materi")->result();
	}
	function lastKikd($id_kelas,$id_mapel)
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->where("id_mapel",$id_mapel);
		$this->db->where("id_kelas",$id_kelas);
		$this->db->where("id_semester",$sms);
		$this->db->where("id_tahun",$tahun);
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id_kikd!=","");
		$this->db->group_by("id_kikd");
		$data=$this->db->get("data_nilai")->result();
		$x="";
		foreach($data as $val)
		{
			$x.=$val->id_kikd.",";
		}
		$x=substr($x,0,-1);
		$fil="";
		if($x)
		{
			$fil="and id NOT IN(".$x.")";
		}
		return $this->db->query("select * from v_kikd where id_guru='".$this->idu()."' and id_semester='".$sms."' and id_tahun='".$tahun."'
		and id_mapel='".$id_mapel."' and id_kelas='".$id_kelas."' $fil order by kd3_no asc limit 1")->row();
	}
	
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
		$tgl=$this->input->post("tgl");
		 
		$filter="";
		 
		
		if($id_kelas)
		{
			$filter.="AND id_kelas='".$id_kelas."' ";
		}
		if($tgl)
		{
			$range_1=$this->tanggal->range_1($tgl);
			$range_2=$this->tanggal->range_2($tgl);
			$filter.="AND tgl>='".$range_1." 00:00:01' AND tgl<='".$range_2." 23:59:59' ";
		}
		
		$id_guru=$this->idu();
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from tm_absen_guru where  sumber!=4 and id_guru=".$id_guru." and id_tahun='".$tahun."' and id_semester='".$sms."'  $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				cpembelajaran LIKE '%".$searchkey."%'   
				) ";
			}

		$column = array('', 'cpembelajaran'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by id   DESC";
		} 
		else  
		{
			 
			$query.=" order by  tgl ,id_materi desc";
		}
		return $query;
	}
	
	public function count()
	{				
		$query = $this->_get_data();
        return  $this->db->query($query)->num_rows();
	}
	function dataKelasAjar()
	{
		$data=$this->db->select("DISTINCT(id_kelas) as id_kelas");
		$this->db->where("id_guru",$this->idu());
		$this->db->order_by("id_kelas","asc");
		return $this->db->get("v_jadwal")->result();
	}
	function kirim_catatan()
	{	 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("id_semester",$sms);
		$this->db->set("id_guru",$this->idu());
		$c="";
		$t=$this->input->post("t");
		if($t){
		foreach($t as $val)
		{	 
			$c.=$val.",";
		}
		$c=substr($c,0,-1);
		}
		
		$this->db->set("teruskan",$c);
		$this->db->insert("tm_catatan",$post);
		if(strpos($c,"2")!==false)
		{
			$idsiswa=$this->input->post("f[id_siswa]");
			$pesan="[INFO SMK]". $this->input->post("f[ket]");
			$nomor=$this->getNomorOrtu($idsiswa);
			$this->sms->_kirimSms($nomor,$pesan,"","","catatan langsung");
		}
		return true;
	}
	function getNomorOrtu($idsiswa)
	{
		$nomor=$this->m_reff->goField("data_ortu","hp_ibu"," where id_siswa='".$idsiswa."'");
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
	
}