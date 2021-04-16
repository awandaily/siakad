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
	function id_siswa() //untuk ortu
	{
		$data=$this->db->query("select id_siswa from data_ortu where id='".$this->session->userdata("id")."' ")->row();
		return isset($data->id_siswa)?($data->id_siswa):"";
	}	
	function id_kelas() //untuk ortu
	{
		$data=$this->db->query("select id_kelas from data_siswa where id='".$this->id_siswa()."' ")->row();
		return isset($data->id_kelas)?($data->id_kelas):"";
	}		
	 
	 function getJamAwal($ha,$id)
	 {
		 if($ha==1)
		 {
			 $sts="1";
		 }else{ $sts="0"; }
		 
		 $this->db->where("urut",$id);
		 $this->db->where("sts",$sts);
		$data=$this->db->get("tr_jam_ajar")->row();
		$return=isset($data->jam_mulai)?($data->jam_mulai):"";
		return substr($return,0,5);
	 }
	 function getJamAkhir($ha,$id)
	 {
		if($ha==1)
		 {
			 $sts="1";
		 }else{ $sts="0"; }
		 $this->db->where("id",$id);
		 $this->db->where("sts",$sts);
		$data=$this->db->get("tr_jam_ajar")->row();
		$return=isset($data->jam_akhir)?($data->jam_akhir):"";
		return substr($return,0,5);
	 }
	 function getIdJadwal($urut,$id_kelas,$ha)
	 {
			$sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		 $return=$this->db->query("select id from v_jadwal where jam like '%,".$urut.",%' and id_kelas='".$id_kelas."' and id_hari='".$ha."' and id_semester='".$sms."' and id_tahun='".$tahun."' ")->row();
	 return isset($return->id)?($return->id):"";
	 }
	 function getStsHadir($id_sts)
	 {
		 $this->db->where("id",$id_sts);
		$data=$this->db->get("tr_sts_kehadiran")->row();
		return isset($data->nama)?($data->nama):"";
	 }
	 function persentaseHadir()
	 {
		 	 $sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
		 $jmlData=$this->db->query("select * from tm_absen_siswa where id_siswa='".$this->id_siswa()."' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 $jmlHadir=$this->db->query("select * from tm_absen_siswa where id_siswa='".$this->id_siswa()."' and id_sts='1' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 $return=($jmlHadir/$jmlData)*100;
		return number_format($return,0)." % ";
	 }
	 function catatan($jenis)
	 {
		 	 $sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
		 $jmlData=$this->db->query("select * from tm_catatan where id_siswa='".$this->id_siswa()."' AND id_jenis='".$jenis."' and teruskan like '%2%' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 
		return number_format($jmlData,0);
	 }
	 function jmlKehadiran($sts)
	 {		 $sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		 $jmlData=$this->db->query("select * from tm_absen_siswa where id_siswa='".$this->id_siswa()."' AND id_sts='".$sts."' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 
		return number_format($jmlData,0);
	 }
	 function simpan_akun()
	{
		$username=$this->input->post("username");
		$password=$this->input->post("password");
		$md5=md5($password);
		$cek1=$this->db->query("select * from admin where username='".$username."' and password='".$md5."' ")->num_rows();
		$cek2=$this->db->query("select * from data_siswa where username='".$username."' and password='".$md5."' ")->num_rows();
		$cek3=$this->db->query("select * from data_pegawai where username='".$username."' and password='".$md5."' and id!='".$this->idu()."' ")->num_rows();
		$jml=($cek1+$cek2+$cek3);
		if($jml)
		{
			$var["hasil"]="duplikat"; return $var;
		}else{
			$this->db->set("username",$this->security->xss_clean($username));
			$this->db->set("password",$this->security->xss_clean($md5));
			$this->db->set("alias",$this->security->xss_clean("se".$password."en"));
			$this->db->where("id",$this->idu());
			$this->db->update("data_ortu");
			$var["hasil"]=true;
			return $var;
		}
	}
	function cekKehadiranGuru($id_jadwal,$id_guru)
	{
		$this->db->where("SUBSTR(tgl,1,10)",date('Y-m-d'));
		$this->db->where("id_jadwal",$id_jadwal);
		$this->db->where("id_guru",$id_guru);
		return $db=$this->db->get("tm_absen_guru")->row();
	}
	function mapelAjar()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$this->db->set("id_semester",$sms);
		$this->db->set("id_tahun",$tahun);
	 
		$this->db->select("nama_tingkat,id_kelas,kelas,mapel,id");
 
		$this->db->order_by("kelas","asc");
	return	$this->db->get("v_mapel_ajar")->result();
	}
	
	function cekHadir($ha,$id_kelas,$urut,$id_guru,$id_jadwal,$mapel,$tgl)
	{
	    $cek_izin=$this->db->query("select * from tm_guru_izin where id_guru='".$id_guru."' and  CAST('".$tgl."' AS DATE) BETWEEN `start` AND `end` ")->row();
                    if(isset($cek_izin))
                    {
                        return "<span class='badge bg-yellow '><font color='black' size='2px'>  izin :  ".$cek_izin->ket."</font></span>";
                    }
	    
	    
	    
		$cek=$this->db->query("select * from tm_absen_guru where id_kelas='".$id_kelas."' and id_hari='".$ha."'   AND jam LIKE '%,".$urut.",%'
		and SUBSTR(tgl,1,10)='".$tgl."' and id_mapel='".$mapel."' order by id desc limit 1");
		if(!$cek->num_rows())
		{
			$jam=$this->m_reff->goField("v_jadwal","jam","where id='".$id_jadwal."'");
		return	$hadir="<button onclick='absenkaning(`".$id_guru."`,`".$id_kelas."`,`".$id_jadwal."`,`".$jam."`,`".$urut."`,`".$mapel."`,`".$tgl."`)' class='btn bg-blue waves-effect'>   BELUM ABSEN </button>";
											
		}else{
			$data=$cek->row();
			if(strpos($data->jam_blok,",".$urut.",")===false)
			{
			    
			    if($data->sumber==1){
											        $masukket="MASUK";$warnamasuk=" bg-teal ";$alasanizin="";
											    }elseif($data->sumber==2){
											        $masukket="TUGAS";$warnamasuk=" bg-indigo ";$alasanizin="";
											    }elseif($data->sumber==5){
											        $masukket="PELAKSANAAN PKL";$warnamasuk=" bg-deep-orange ";$alasanizin="";
											    }elseif($data->sumber==4){
											        $masukket="TIDAK MASUK";$warnamasuk=" bg-deep-orange ";$alasanizin="";
											    }else{
											        $masukket="IZIN";$warnamasuk=" bg-deep-orange ";
											        $alasanizin=br()."<i class='pull-right'>".$data->izin."</i>";
											    }
			    
			    
			return	$hadir="<button onclick='bloking(`".$id_guru."`,`".$id_kelas."`,`".$id_jadwal."`,` `,`".$urut."`,`".$tgl."`)' class='btn $warnamasuk waves-effect'>   $masukket </button>$alasanizin";				 
			}else{
			   if($data->sumber=="4")
			   {
			 	return $hadir="<button onclick='unbloking(`".$id_guru."`,`".$id_kelas."`,`".$id_jadwal."`,` `,`".$urut."`,`".$tgl."`)' class='btn bg-pink waves-effect'> <i class='material-icons'>pan_tool</i> TIDAK MASUK </button>";
			   }
			return $hadir="<button onclick='unbloking(`".$id_guru."`,`".$id_kelas."`,`".$id_jadwal."`,` `,`".$urut."`,`".$tgl."`)' class='btn bg-pink waves-effect'> <i class='material-icons'>pan_tool</i> DIBLOK </button>";
												
			}
		}
	}
	 function cekIzinHarian($tgl,$idguru)
    {
        return $this->db->query("select * from tm_guru_izin where id_guru='".$idguru."' and  CAST('".$tgl."' AS DATE) BETWEEN `start` AND `end` ")->row();
    }
	  function cekInval($tgl,$id_jadwal,$idguru)
	{    
	   // $this->db->where("jam like '%,".$jam.",%' ");
		$this->db->where("SUBSTR(tgl,1,10)", $tgl);
		$this->db->where("id_jadwal",$id_jadwal);
		$this->db->where("id_guru_sebelumnya",$idguru);
		return $db=$this->db->get("tm_inval")->row();
	}
	function cekHadirInval($ha,$id_kelas,$urut,$id_guru,$id_jadwal,$mapel,$tgl)
	{	$urutan=",".$urut.",";
		$cek=$this->db->query("select * from tm_inval where id_jadwal='".$id_jadwal."' and tgl='".$tgl."' and jam LIKE '%".$urutan."%' ")->row();
		if($cek)
		{
			$cari=strpos($cek->jam_valid,$urut);
			if($cari===false)
			{
				return	$hadir="<button onclick='unbloking_inval(`".$id_guru."`,`".$id_kelas."`,`".$id_jadwal."`,`".$urut."`,`".$urut."`,`".$tgl."`)' 
				class='btn bg-pink waves-effect'> <i class='material-icons'>lock_open</i> DIBLOK </button>";				 
			
	 		}else{
			return	$hadir="<button onclick='bloking_inval(`".$id_guru."`,`".$id_kelas."`,`".$id_jadwal."`,`".$urut."`,`".$urut."`,`".$tgl."`)' 
			class='btn bg-teal waves-effect'> <i class='material-icons'>lock_open</i> MASUK </button>";				 
			
			}				
		}else{
			 	$jam=$this->m_reff->goField("v_jadwal","jam","where id='".$id_jadwal."'");
				return	$hadir="<button onclick='absenkaning_inval(`".$id_guru."`,`".$id_kelas."`,`".$id_jadwal."`,`".$jam."`,`".$urut."`,`".$mapel."`,`".$tgl."`)' class='btn bg-blue waves-effect'>   BLUM ABSEN </button>";
										
			}
	}
	 
	function get_data_guru_izin()
	{
		$query=$this->_get_data_guru_izin();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_guru_izin()
	{
				 		  

		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();

		$query="select * from tm_guru_izin where 1=1";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
			/*
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  
				) ";*/
			}

		$column = array('', ''  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
			$query.=" order by _ctime DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_guru_izin()
	{				
		$query = $this->_get_data_guru_izin();
        return  $this->db->query($query)->num_rows();
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
		$id_jurusan=$this->input->post("jurusan");
		 
		  
		$filter="";
		  
		if($id_kelas)
		{
			$filter.="AND id_tk='".$id_kelas."' ";
		}
		if($id_jurusan)
		{
			$filter.="AND id_jurusan='".$id_jurusan."' ";
		}
		  
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from v_kelas where   1=1  $filter ";
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
		$query.=" order by nama   ASC";
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
	
	
	
	function get_dataguru()
	{
		$query=$this->_get_dataguru();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_dataguru()
	{
				 		  
		$id_kelas=$this->input->post("id_kelas");
		$tgl=$this->input->post("tgl");
		$tanggal=$this->tanggal->eng_($tgl,"-");
		$ha=date('N', strtotime($tanggal));
		  
		$filter="";
		  
//		if($id_kelas)
//		{
//			$filter.="AND id_kelas='".$id_kelas."' ";
//		}
	 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
	$query="select * from v_jadwal where id_hari='".$ha."' AND id_semester='".$sms."'
	and id_tahun='".$tahun."' $filter ";
	
 		$query="select *,id as id_guru from data_pegawai where 1=1 ";
		
		
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
		
		 
	//	$query.="group by nama  order by nama   ASC";
			$query.=" order by nama   ASC";
		 
		return $query;
	}
	
	public function count_guru()
	{				
		$query = $this->_get_dataguru();
        return  $this->db->query($query)->num_rows();
	}
	function setNonAktif($ket,$jamof,$tgl)
	{
		$tanggal=$this->tanggal->eng_($tgl,"-");
		$ha=date('N', strtotime($tanggal));
		$kelas=$this->input->get_post("kelas");//id_guru
		$jamnow=$this->m_reff->jam_aktif();
		if($jamof){	$jamnow=$jamof; }
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		foreach($kelas as $val)
		{
			$data=$this->db->query("select * from v_jadwal where   jam_akhir>=".$jamnow." and id_hari='".$ha."' and id_guru='".$val."' and id_tahun='".$tahun."' and id_semester='".$sms."'")->result();
			foreach($data as $pin)
			{	$id_jadwal=isset($pin->id)?($pin->id):"";
			 	$id_mapel=isset($pin->id_mapel)?($pin->id_mapel):"";
			 	$id_kelas=isset($pin->id_kelas)?($pin->id_kelas):"";
				$cek_absen=$this->db->query("SELECT * from tm_absen_guru where id_jadwal='".$pin->id."' and SUBSTR(tgl,1,10)='".$tanggal."'
				AND id_guru='".$val."' and id_tahun='".$tahun."' and id_semester='".$sms."'  ")->num_rows();
				if(!$cek_absen){
					$jam_range=isset($pin->jam)?($pin->jam):"";
					$jam_range=str_replace(",,",",",$jam_range);
					 $na=SUBSTR($jam_range,-1);
					 $nna=SUBSTR($jam_range,0,1);
						if($na==","){
						$jam_range_jml=substr($jam_range,0,-1);
						}
						if($nna==","){
							  $jam_range_jml=substr($jam_range_jml,1);
						}
		
					//$jml_jam=isset($pin->jam_akhir)?($pin->jam_akhir):"";
					$jml_jam=explode(",",$jam_range_jml);
					$jml_jam = array_unique($jml_jam);
					$jml_jam=count($jml_jam);
					
					$this->insert_liburkan($val,$jam_range,$jml_jam,$ket,$tahun,$sms,$jamnow,$id_jadwal,$id_mapel,$id_kelas,$tanggal);
				}else{
					$ceklagi=$this->db->query("select * from tm_diliburkan where id_guru='0' and SUBSTR(tgl,1,10)='".$tanggal."'  ")->num_rows();
					if(!$ceklagi){ $this->insert_liburkan("0","","",$ket,$tahun,$sms,$jamnow,$id_jadwal,$id_mapel,$id_kelas); }
				}
			}
			 
		}
		$this->db->query("delete from tm_diliburkan where id_guru='0'");
		return true;
	}
	function insert_liburkan($id_guru,$jam_range,$jml_jam,$ket,$tahun,$sms,$jamnow,$id_jadwal,$id_mapel,$id_kelas,$tanggal)
	{	 
	 
		$this->db->set("id_jadwal",$id_jadwal);
		$this->db->set("id_mapel",$id_mapel);
		$this->db->set("id_kelas",$id_kelas);
		$this->db->set("ket",$ket);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("id_semester",$sms);
		$this->db->set("jml_jam",$jml_jam);
		$this->db->set("jam",$jam_range);
		$this->db->set("tgl",$tanggal." ".date('H:i:s'));
		$this->db->set("_cid",$this->idu());
		$this->db->set("id_guru",$id_guru);
		$this->db->set("jam_mulai_off",$jamnow);
		$cek=$this->db->query("SELECT * from tm_diliburkan where id_guru='".$id_guru."' and substr(tgl,1,10)='".$tanggal."' and id_jadwal='".$id_jadwal."' ")->num_rows();
		if(!$cek){
		return $this->db->insert("tm_diliburkan");
		}return true;
	}
	function cekabsenguru($id_guru,$tanggal)
	{
	$noid=$this->m_reff->goField("data_pegawai","nip","where id='".$id_guru."'");
	$this->db->where("noid",$noid);
	$this->db->where("SUBSTR(tgl,1,10)",$tanggal);
	$return=$this->db->get("tm_log_kehadiran")->num_rows();
	if($return)
	{
		return "<span class='col-teal'>Masuk</span>";
	}else{
		return "<span class='col-pink'>Tidak</span>";
	}
	}
	function batalkan()
	{
	    $this->db->where("ket",$this->input->get_post("ket"));
		$this->db->where("SUBSTR(tgl,1,10)",date("Y-m-d"));
		$this->db->delete("tm_diliburkan");
	}
	function insertInval()
	{
		$idguru=$this->input->post("idguru");
		$idgurubaru=$this->input->post("idgurubaru");
		$idjadwal=$this->input->post("idjadwal");
		$jam=$this->input->post("jam");
		$urut=$this->input->post("urut"); //jam ke urut
		$mapel=$this->input->post("mapel");
		$tanggal=$this->input->post("tanggal");
		$this->db->where("id_jadwal",$idjadwal);
		$this->db->where("tgl",$tanggal);
		$urutan=",".$urut.",";
		$this->db->where("jam LIKE '%".$urutan."%' ");
		$cek=$this->db->get("tm_inval")->row();
		if(isset($cek->id)){

			 
		//	$this->db->where("id_jadwal",$idjadwal);
		//	$this->db->where("tgl",$tanggal);
		//	$this->db->set("id_guru",$idgurubaru);				 
	//	return	$this->db->update("tm_inval");
	
		 
			$jam_valid=$urutan;
			$jml_jam=1;
		 
		 
		
		if(strpos($cek->jam_invalid,$urutan)===false)
		{
			 
			$jml_jam_blok=0;
			$jam_invalid="";
		}else{
			 
			$jml_jam_blok=1;
			$jam_invalid=$urutan;
		}
	
	
		
		$data=array(
		"id_tahun"=>$this->m_reff->tahun(),
		"id_semester"=>$this->m_reff->semester(),
		"id_guru_sebelumnya"=>$idguru,
		"id_guru"=>$idgurubaru,
		"id_jadwal"=>$idjadwal,
		"tgl"=>$tanggal,
		"jam"=>$urutan,
		"jml_jam"=>$jml_jam,
		"jml_jam_blok"=>$jml_jam_blok,
		"jam_valid"=>$jam_valid,
		"jam_invalid"=>$jam_invalid,
		"honor_guru_sebelumnya"=>$this->m_reff->honor($idguru),
		"id_mapel"=>$mapel 
		);
		 $this->db->insert("tm_inval",$data);
		 
		 
		 
		$jam_valid=str_replace($urutan,",",$cek->jam_valid);
		$jam_invalid=str_replace($urutan,",",$cek->jam_invalid);
		$jam=str_replace($urutan,",",$cek->jam);
		if($jam_valid)
		{
			$jml_jam=count($this->m_reff->clearkomaray($jam_valid));
		}else{
			$jml_jam=0;
		}
		
		if($jam_invalid)
		{
			$jml_invalid=count($this->m_reff->clearkomaray($jam_invalid));
		}else{
			$jml_invalid=0;
		}
		
		if(strlen($jam_valid)<3)
		{
			$jam_valid=null;
			$jml_jam=0;
		}
		
		
		
		$data=array(
		"jam_valid"=>$jam_valid,
		"jam_invalid"=>$jam_invalid,
		"id_mapel"=>$mapel,
		"jam"=>$jam,
		"jml_jam"=>$jml_jam,
		"jml_jam_blok"=>$jml_invalid,
		);
		$this->db->where("id",$cek->id);
		  $this->db->update("tm_inval",$data);
		 
		 return  $this->db->query("delete from tm_inval where jam=', ' ");
	
		}else{
		 
			$data=array(
		"id_tahun"=>$this->m_reff->tahun(),
		"id_semester"=>$this->m_reff->semester(),
		"id_guru_sebelumnya"=>$idguru,
		"honor_guru_sebelumnya"=>$this->m_reff->honor($idguru),
		"id_guru"=>$idgurubaru,
		"id_jadwal"=>$idjadwal,
		"jam_valid"=>$jam,
		"id_mapel"=>$mapel,
		"jam"=>$jam,
		"tgl"=>$tanggal,
		"jml_jam"=>count($this->m_reff->clearkomaray($jam)),
		);
		return	$this->db->insert("tm_inval",$data);
		}
		
		
	}
	function idguruinval($tanggal,$idjadwal,$urut)
	{
		$this->db->where("jam LIKE '%,".$urut."%,' ");
		$this->db->where("id_jadwal",$idjadwal);
		$this->db->where("tgl",$tanggal);
		return $this->db->get("tm_inval")->row();
	}
	function hapus_izin($id)
	{
	    $this->db->where("id",$id);
	   return $this->db->delete("tm_guru_izin");
	}
	
}