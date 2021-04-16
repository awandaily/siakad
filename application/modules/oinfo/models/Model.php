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
	    $level=$this->session->userdata("level");
	    if($level=="SISWA"){
	        return $this->idu();
	    }else{
		$data=$this->db->query("select id_siswa from data_ortu where id='".$this->session->userdata("id")."' ")->row();
		return isset($data->id_siswa)?($data->id_siswa):"";
	    }
	}
	function nis_siswa() //untuk ortu
	{
		$data=$this->db->query("select nis from data_siswa where id='".$this->id_siswa()."' ")->row();
		return isset($data->nis)?($data->nis):"";
	}	
	function nama_siswa() //untuk ortu
	{
		$data=$this->db->query("select * from data_siswa  where id='".$this->id_siswa."' ")->row();
		return isset($data->nama)?($data->nama):"";
	}	
	function id_kelas() //untuk ortu
	{
		$data=$this->db->query("select id_kelas from data_siswa where id='".$this->id_siswa()."' ")->row();
		return isset($data->id_kelas)?($data->id_kelas):"";
	}	
	function id_wali() //untuk ortu
	{
		$return=$this->db->query("select * from tm_kelas where id='".$this->id_kelas()."' ")->row();
		return isset($return->id_wali)?($return->id_wali):"";
	 
	}		
	function data_wali()
	{
		return $this->db->get_where("data_pegawai",array("id"=>$this->id_wali()))->row();
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
		 $return=$this->db->query("select id from v_jadwal where jam like '%,".$urut.",%' and id_kelas='".$id_kelas."'
		 and id_hari='".$ha."' and id_semester='".$sms."' and id_tahun='".$tahun."' ")->row();
	 return isset($return->id)?($return->id):"";
	 }
	 function getStsHadir($id_sts)
	 {
		 $this->db->where("id",$id_sts);
		$data=$this->db->get("tr_sts_kehadiran")->row();
		return isset($data->alias)?($data->alias):"Belum absen";
	 }
	 function persentaseHadir()
	 {
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 $jmlData=$this->db->query("select * from tm_absen_siswa where
		 (absen1 like '%,".$this->id_siswa().",%' or
		 absen2 like '%,".$this->id_siswa().",%' or
		 absen3 like '%,".$this->id_siswa().",%' or
		 absen4 like '%,".$this->id_siswa().",%' or
		 absen5 like '%,".$this->id_siswa().",%' or
		 absen6 like '%,".$this->id_siswa().",%' ) 
		 and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 $jmlHadir=$this->db->query("select * from tm_absen_siswa where absen1 like '%,".$this->id_siswa().",%' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 $jmlHadirD=$this->db->query("select * from tm_absen_siswa where absen5 like '%,".$this->id_siswa().",%' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();

		if(!$jmlData){ return "0 %";}
		$return=(($jmlHadir+$jmlHadirD)/$jmlData)*100;
		return number_format($return,0)." % ";
	 }
	 function catatan($jenis=null)
	 {
		 if($jenis==null)
		 {
			 $jenis="";
		 }else{
			 $jenis="AND id_jenis='".$jenis."'";
		 }
		 	 $sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
		 $jmlData=$this->db->query("select * from tm_catatan where id_siswa='".$this->id_siswa()."' ".$jenis." and teruskan like '%2%' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 
		return number_format($jmlData,0);
	 }
	 function jmlKehadiran($sts)
	 {		 $sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun();
		 $jmlData=$this->db->query("select * from tm_absen_siswa where
		     absen".$sts." like '%,".$this->id_siswa().",%' and id_semester='".$sms."' and id_tahun='".$tahun."'")->num_rows();
		 
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
	function statusKehadiran($id_siswa,$id_jadwal)
	{
		$hadir=$this->db->query("select * from tm_absen_siswa where SUBSTR(tgl,1,10)='".date('Y-m-d')."' 
		and id_jadwal='".$id_jadwal."' and absen1 like '%,".$id_siswa.",%' ")->num_rows();
		if($hadir)
		{
		  return 1;
		} 
		
		$hadir=$this->db->query("select * from tm_absen_siswa where SUBSTR(tgl,1,10)='".date('Y-m-d')."' 
		and id_jadwal='".$id_jadwal."' and absen2 like '%,".$id_siswa.",%' ")->num_rows();
		if($hadir)
		{
		  return 2;
		} 
		$hadir=$this->db->query("select * from tm_absen_siswa where SUBSTR(tgl,1,10)='".date('Y-m-d')."' 
		and id_jadwal='".$id_jadwal."' and absen3 like '%,".$id_siswa.",%' ")->num_rows();
		if($hadir)
		{
		  return 3;
		} 
		$hadir=$this->db->query("select * from tm_absen_siswa where SUBSTR(tgl,1,10)='".date('Y-m-d')."' 
		and id_jadwal='".$id_jadwal."' and absen4 like '%,".$id_siswa.",%' ")->num_rows();
		if($hadir)
		{
		  return 4;
		} 
		$hadir=$this->db->query("select * from tm_absen_siswa where SUBSTR(tgl,1,10)='".date('Y-m-d')."' 
		and id_jadwal='".$id_jadwal."' and absen5 like '%,".$id_siswa.",%' ")->num_rows();
		if($hadir)
		{
		  return 5;
		} $hadir=$this->db->query("select * from tm_absen_siswa where SUBSTR(tgl,1,10)='".date('Y-m-d')."' 
		and id_jadwal='".$id_jadwal."' and absen6 like '%,".$id_siswa.",%' ")->num_rows();
		if($hadir)
		{
		  return 6;
		} 
		return 0;
									  
	}
	function  absen_datang()
	{
		$data=$this->db->query("select * from tm_log_kehadiran where noid='".$this->nis_siswa()."' and substr(tgl,1,10)='".date('Y-m-d')."' order by id asc limit 1")->row();
		if($data)
		{	$jam_min=date("Y-m-d")." 09:00:00";
			if($data->tgl>$jam_min)
			{
				return strtoupper("Siswa tidak absen pagi");
			}else{
				return strtoupper("Siswa absen pagi pukul ".substr($data->tgl,11,8)." WIB");
			}
		}
		return strtoupper("Siswa belum absen pagi");
	}
	
	function  absen_pulang()
	{
		$data=$this->db->query("select * from tm_log_kehadiran where noid='".$this->nis_siswa()."' and substr(tgl,1,10)='".date('Y-m-d')."' order by id DESC limit 1")->row();
		if($data)
		{	$jam_min=date("Y-m-d")." 14:00:00";
			if($data->tgl<$jam_min)
			{
				return strtoupper("Siswa belum absen pulang");
			}else{
				return strtoupper("Siswa absen pulang pukul ".substr($data->tgl,11,8)." WIB");
			}
		}
		return strtoupper("Siswa belum absen pulang");
	}
	function update_profile()
	{
		$data=$this->input->post("g");
		$data=$this->security->xss_clean($data);
		$this->db->where("id",$this->idu());
		  $this->db->update("data_ortu",$data);

		$data=$this->input->post("f");
		$data=$this->security->xss_clean($data);
		$this->db->where("id",$this->id_siswa());
		return $this->db->update("data_siswa",$data);
	}
	
	
	
	/*===================================*/
	function get_data_guru()
	{
		$query=$this->_get_data_guru();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_guru()
	{
		 
	 
		 
		$query="select * from data_pegawai where id_jabatan=3 ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				email LIKE '%".$searchkey."%'  or
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
		$query.=" order by id   DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_guru()
	{				
		$query = $this->_get_data_guru();
        return  $this->db->query($query)->num_rows();
	}
	 
	 
}