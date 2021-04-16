<?php

class Model extends CI_Model  {
    
	var $tbl="tm_tagihan";
	var $tbl_bayar="tm_pembayaran";
	var $v_bayar="v_bayar";
	var $bank="tr_bank";
	var $tbl_log="data_siswa";
	var $thn="tr_tahun_ajaran";
 	function __construct()
    {
        parent::__construct();
    }
	function namaBiaya($id,$jenis=null)
	{
		
			$return=$this->m_reff->goField("keu_tr_biaya_pokok","nama","where id='".$id."'");
		if($return)
		{
			return $return;
		}else{
			return  $this->m_reff->goField("keu_tr_biaya_tetap","nama_biaya","where kode='".$id."'");
		}
	}
	function idu()
	{
		return $this->session->userdata("id");
	}
	function nis()
	{
		$this->db->select("nis");
		$this->db->limit(1);
		$this->db->where("id",$this->idu());
		return $this->db->get($this->tbl_log)->row()->nis;
	}
	function noid()
	{
		$this->nis();
	}
	function tahun()//tahun awal pelajaran
	{
		$this->db->where("id",$this->idu());
		$this->db->select("id_tahun_masuk");
		$data=$this->db->get($this->tbl_log)->row();
		$id_tahun_masuk=isset($data->id_tahun_masuk)?($data->id_tahun_masuk):"";
		$hasil=$this->db->get($this->thn,array("id"=>$id_tahun_masuk))->row();
		$return=isset($hasil->nama)?($hasil->nama):"";
		return substr($return,0,4);
	}
	/*===================================*/
	function get_data_tagihan()
	{
		$query=$this->_get_data_tagihan();
		if(isset($_POST['length'])?($_POST['length']):"" != -1)
		$query.=" limit ". $_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_tagihan()
	{
		$now=date("Y-m-d");
		$query="select * from ".$this->tbl." where  1=1  ";
			if(isset($_POST['search']['value'])){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama_tagihan LIKE '%".$searchkey."%'  
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
	
	public function count_tagihan()
	{				
		$query = $this->_get_data_tagihan();
        return  $this->db->query($query)->num_rows();
	}
	/*===================================*/
	
	
	
	
	
	
	
	/*===================================*/
	function get_data_transaksi()
	{
		$query=$this->_get_data_transaksi();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_transaksi()
	{
		$now=date("Y-m-d");
		$query="select * from ".$this->v_bayar." where nis='".$this->nis()."'   ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama_tagihan LIKE '%".$searchkey."%'  
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
		$query.=" order by id DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_trx()
	{				
		$query = $this->_get_data_transaksi();
        return  $this->db->query($query)->num_rows();
	}
	
	
	
	/*===================================*/
	function getHistory()
	{
		$query=$this->_getHistory();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getHistory()
	{	$filter="";
		$tgl=$this->input->post("tgl");
		$tgl1=$this->tanggal->range_1($tgl);
		$tgl2=$this->tanggal->range_2($tgl);
		$nis=$this->input->post("nis");
		$id_siswa=$this->input->post("id_siswa");
		if($nis)
		{
			$id_siswa=$this->m_reff->goField("data_siswa","id","where (nis='".$nis."' or nisn='".$nis."')");
			$filter.=" AND id_siswa='".$id_siswa."' ";
		}
		if($id_siswa)
		{
			 
			$filter.=" AND id_siswa='".$id_siswa."' ";
		}
		
		
		if($tgl){
		$filter.=" AND tgl_bayar BETWEEN '".$tgl1."' AND '".$tgl2."' ";
		}
		$query="SELECT * ,SUM(nominal_bayar)  AS nominal FROM keu_tm_bayar  where 1=1   ".$filter." GROUP BY tgl_bayar,id_siswa ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama_tagihan LIKE '%".$searchkey."%'  
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
	
	public function count__getHistory()
	{				
		$query = $this->_getHistory();
        return  $this->db->query($query)->num_rows();
	}
	
	/*===================================*/
	function getTagihanTambahan()
	{
		$query=$this->_getTagihanTambahan();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _getTagihanTambahan()
	{	$filter="";
		 
		$query="SELECT * FROM keu_tr_biaya_pokok where sts='2' ";
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
		$query.=" order by id desc ";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count_getTagihanTambahan()
	{				
		$query = $this->_getTagihanTambahan();
        return  $this->db->query($query)->num_rows();
	}
	/*===================================*/
	function getBank()
	{
	return	$this->db->get($this->bank)->result();
	}
	
	function getKonfirmasi($id)
	{
	return	$this->db->get_where($this->tbl,array("id"=>$id,"nis"=>$this->nis()));
	}
	function getDataKonfirmasi($id)
	{
	return	$this->db->get_where($this->v_bayar,array("id_bayar"=>$id,"nis"=>$this->nis()));
	}
	 
	function insKonfirmasi()
	{	
		$var=array();
		$var["size"]=""; 
		$var["file"]="";
		$var["validasi"]=false; 
		$var["token"]=true; 
		$polder=$this->tahun();//tahun awal angkatan masuk siswa
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["bukti_trf"]['tmp_name']))
		{
			$file=$this->m_reff->upload_file("bukti_trf","".$polder."/trf",$idu);
			if($file["validasi"]!=false)
			{
				$idt=$this->input->post("f[id_tagihan]");
				$nominal=$this->input->post("nominal");
				$tgl_trf=$this->input->post("tgl_trf");
				$tgl_trf=$this->tanggal->eng_($tgl_trf,"-");
				
				$this->setStsTagihan($idt,2);
					
				$this->db->set("nis",$this->nis());
				$this->db->set("bukti_trf",$file["name"]);
				$this->db->set("tgl_bayar",$this->security->xss_clean($tgl_trf));
				$this->db->set("nominal",$this->security->xss_clean(str_replace(".","",$nominal)));
			 	$this->db->set("_cid",$idu);
			
				$this->db->insert($this->tbl_bayar,$data);
				$this->m_konfig->log("tm_pembayaran","Melakukan konfirmasi pembayaran",$this->tbl_log);///insert log
				$this->session->unset_userdata("token");
				return $file;
			}else{
			return $file;
			}
		}else{
				return $var;
		}
		
	}
	
	function setStsTagihan($id,$sts)
	{		$this->db->set("sts",$sts);
			$this->db->where("id",$id);
	return	$this->db->update($this->tbl);
	}
	function telahDibayar($id)
	{
			$this->db->select("SUM(nominal) as jml");
			$this->db->where("id_tagihan",$id);
			$this->db->where("sts",3);
			return	$this->db->get($this->tbl_bayar)->row()->jml;
	}
	///====================== RUN NOW================///
	function bayaran()
	{	
		
		$id_siswa=$this->input->post("nama");
		$tgl_bayar=$this->input->post("tgl_bayar");
		$tgl_bayar=$this->tanggal->eng_($tgl_bayar,"-");
		$cr=$this->db->query("select * from keu_tm_bayar where substr(_ctime,1,10)='".date('Y-m-d')."' and id_siswa='".$id_siswa."'  ")->row();
		if($cr)
		{
			$code=$cr->code;
		}else{
			$code=date("dmYHis");
		}
		
	 /*	$db=$this->db->query("select * from keu_tr_biaya_pokok ")->result();		
		foreach($db as $val)
		{
			$input=$this->input->post("f[".$val->id."]");
			$input=str_replace(".","",$input);
			if($input){
				if($val->kelipatan>1)
				{
					$this->insert_bayar_ulang($val->id,$input,$id_siswa,$code,$tgl_bayar);
				}else{
					$this->insert_bayar($val->id,$input,$id_siswa,"",$code,$tgl_bayar);	
				}
			}
			
		} */
		
		$db=$this->db->query("select id_tagihan as kode,count(*) as kelipatan,id_tagihan from keu_tagihan_pokok where id_siswa='".$id_siswa."' GROUP BY id_tagihan  ")->result();		
		foreach($db as $val)
		{
			$input=$this->input->post("f[".$val->kode."]");
			$input=str_replace(".","",$input);
			if($input){
				if($val->kelipatan>1)
				{
					$this->insert_bayar_ulang($val->kode,$input,$id_siswa,$code,$tgl_bayar);
				}else{
					$this->insert_bayar($val->kode,$input,$id_siswa,"",$code,$tgl_bayar);	
				}
			}
			
		}
		return true;
	}
	function insert_bayar($id,$val,$id_siswa,$periode=null,$code,$tgl_bayar)
	{
		$getBiaya=$this->m_reff->goField("keu_tagihan_pokok","bayar"," where id_siswa='".$id_siswa."' and id_tagihan='".$id."'");
		$getBiaya=$getBiaya+$val;
		if($periode==null){
		$this->db->query("UPDATE keu_tagihan_pokok set bayar='".$getBiaya."',sts='1',tgl_bayar='".$tgl_bayar."' where id_siswa='".$id_siswa."' and id_tagihan='".$id."' ");	
		}
		$post=array(
		"id_siswa"=>$id_siswa,
		"id_tagihan"=>$id,
		"nominal_bayar"=>$val,
		"tgl_bayar"=>$tgl_bayar,
		"periode_spp"=>$periode,
		"code"=>$code
		);
		return $this->db->insert("keu_tm_bayar",$post);
	}
	function insert_bayar_ulang($id,$val,$id_siswa,$code,$tgl_bayar)
	{
		$getBiaya=$this->m_reff->goField("keu_tagihan_pokok","tagihan","where id_tagihan='".$id."' and id_siswa='".$id_siswa."' limit 1");
		$db=$this->db->query("select * from keu_tagihan_pokok where id_tagihan='".$id."' and id_siswa='".$id_siswa."' and (bayar < ".$getBiaya."  OR bayar IS NULL)  order by id asc ")->result();
		$uang=$val; $periode="";$i=1;
		foreach($db as $db)
		{	$getBiaya=$db->tagihan; //200rb
			$sudahbayar=$db->bayar; //misal 0
			$sisa_tagihan=$getBiaya-$sudahbayar; //sisa 200000
			
			if($uang<=0)
			{ 
					//return false;
			}elseif($uang>=$sisa_tagihan)
			{
				$this->db->query("UPDATE keu_tagihan_pokok set bayar='".$getBiaya."',tgl_bayar='".$tgl_bayar."' where id='".$db->id."' ");	
				$uang=$uang-$sisa_tagihan;	
				$periode.=$db->satuan.":lunas,";
			}else { //jika uang kurang dari tagihan
				$bayar=$db->bayar+$uang;
				$this->db->query("UPDATE keu_tagihan_pokok set bayar='".$bayar."',tgl_bayar='".$tgl_bayar."' where id='".$db->id."' ");	
				$periode.=$db->satuan.":sisa,";
				return $this->insert_bayar($id,$val,$id_siswa,$periode,$code,$tgl_bayar);
			 } 
			//$i++;
		}
		//	$periode=substr($periode,0,-1);
			return $this->insert_bayar($id,$val,$id_siswa,$periode,$code,$tgl_bayar);
	}
	function sisaTagihan($id_siswa,$id)
	{
		$db=$this->db->query("select sum(tagihan) as tagihan from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$id."'  ")->row();
		  $tagihan=isset($db->tagihan)?($db->tagihan):"";
		  
		  $db=$this->db->query("select sum(bayar) as bayar from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$id."' ")->row();
		  $bayar=isset($db->bayar)?($db->bayar):"";
		  return $tagihan-$bayar;
	}
	function setbebaskanTagihan($id,$ket,$bayar)
	{
		$this->db->set("tgl_bayar",date('Y-m-d'));
		$this->db->set("sts",2);
		$this->db->set("id_alasan",$ket);
		$this->db->set("ket","Dibebaskan");
		$this->db->set("bayar",$bayar);
		$this->db->where("id",$id);
		return $this->db->update("keu_tagihan_pokok");
	}
	function batalbebaskan($id)
	{
		$this->db->set("tgl_bayar",null);
		$this->db->set("sts",1);
		$this->db->set("ket",null);
		$this->db->set("id_alasan",null);
		$this->db->set("bayar",NULL);
		$this->db->where("id",$id);
		return $this->db->update("keu_tagihan_pokok");
	}
	
	function batalbayar($id,$tgl,$idsiswa)
	{
		$this->db->set("tgl_bayar",null);
		$this->db->set("sts",1);
		$this->db->set("ket",null);
		$this->db->set("bayar",NULL);
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("tgl_bayar",$tgl);
		$this->db->where("id_tagihan",$id);
		$this->db->update("keu_tagihan_pokok");

	 
		$this->db->where("id_siswa",$idsiswa);
		$this->db->where("tgl_bayar",$tgl);
		$this->db->where("id_tagihan",$id);
		return $this->db->delete("keu_tm_bayar");
	}
	function cancelBayar($id)
	{
		$db=$this->db->get_where("keu_tm_bayar",array("id"=>$id))->row();
		$nominal=isset($db->nominal_bayar)?($db->nominal_bayar):"";
		$id_tagihan=isset($db->id_tagihan)?($db->id_tagihan):"";
		$id_siswa=isset($db->id_siswa)?($db->id_siswa):"";
		$this->db->query("delete from keu_tm_bayar where id='".$id."'");
			$db=$this->db->query("SELECT id,bayar FROM keu_tagihan_pokok
			WHERE id_tagihan='".$id_tagihan."' AND id_siswa='".$id_siswa."'  AND sts='1' AND bayar IS NOT NULL OR bayar <1 ORDER BY id DESC")->result();
			foreach($db as $db)
			{
				$sudah_bayar=$db->bayar;
				if($sudah_bayar>=$nominal)
				{
					 
					return $this->db->query("update keu_tagihan_pokok set bayar='".($sudah_bayar-$nominal)."' where id='".$db->id."' "); 
				}elseif($sudah_bayar<$nominal)
				{
					$this->db->query("update keu_tagihan_pokok set bayar='0' where id='".$db->id."' "); 
					$nominal=$nominal-$sudah_bayar;
				}
			}
		
	}
	function periode_desc($id_tagihan,$desc)
	{
		if($id_tagihan==1)
		{
			return $this->periode_bulan($desc);
		}
		$data="";
		$data=substr($desc,0,-1);
		$array=explode(",",$data);
		$d="";
		foreach($array as $vis)
		{
			$vis=str_replace(":lunas","",$vis);
			$vis=str_replace(":sisa"," (belum lunas)",$vis);
			$d.=$vis."<br>";
		}
		return $d;
	}
	function periode_bulan($desc)
	{	$data="";
		$data=substr($desc,0,-1);
		$array=explode(",",$data);
		$d="";
		foreach($array as $vis)
		{
			$ex=explode(" - ",$vis);
			$bln=isset($ex[0])?($ex[0]):"";
			$thn=isset($ex[1])?($ex[1]):"";
			$bln=$this->tanggal->bulan($bln);
			$vis=$bln." - ".$thn;
			
			$vis=str_replace(":lunas","",$vis);
			$vis=str_replace(":sisa"," (belum lunas)",$vis);
			$d.=$vis."<br>";
		}
		return $d;
	}
	function input_tagihan()
	{	$id_tagihan=$this->db->query("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'keu_tr_biaya_pokok'")->row();
		$id_tagihan=$id_tagihan->auto_increment;
		$siswa=$this->input->post("nama[]");
		$nama_tagihan=$this->input->post("nama_tagihan");
		$jumlah_tagihan=$this->input->post("tagihan");
		$id_tk=$this->input->post("id_tk");
		$id_jurusan=$this->input->post("id_jurusan");
		$id_kelas=$this->input->post("id_kelas");
		$jumlah_tagihan=str_replace(".","",$jumlah_tagihan);
		$datasis=",";
		if($siswa)
		{
			foreach($siswa as $val)
			{
				$this->insert_tagihan_tambahan($val,$nama_tagihan,$jumlah_tagihan,$id_tagihan);
				$datasis.=$val.",";
			}
			$this->insert_tagihan_pokok($id_tagihan,$jumlah_tagihan,$nama_tagihan,$id_jurusan,$id_tk,$id_kelas,$datasis);
		}else
		{
			if(!$id_jurusan)
			{
				if(!$id_tk)
				{
					$and=" AND id_tk IN(select id FROM tr_tingkat)";
				}else{
					$and=" AND id_tk='".$id_tk."'";
				}
				
				$siswa=$this->db->query("select * from v_siswa WHERE id_jurusan IN (SELECT id FROM tr_jurusan) ".$and." ")->result();
			}else{
				$siswa=$this->db->query("select * from v_siswa where id_jurusan='".$id_jurusan."'")->result();
			}
				
				foreach($siswa as $val)
				{
					$this->insert_tagihan_tambahan($val->id,$nama_tagihan,$jumlah_tagihan,$id_tagihan);
				 
				}
			 
			$this->insert_tagihan_pokok($id_tagihan,$jumlah_tagihan,$nama_tagihan,$id_jurusan,$id_tk,$id_kelas,"");
		}
		
		 
	return true;
	}
	
	private function insert_tagihan_pokok($id_tagihan,$jumlah_tagihan,$nama_tagihan,$id_jurusan,$id_tk,$id_kelas,$datasis)
	{
		$this->db->set("sts",2);
		$this->db->set("tgl_input",date("Y-m-d"));
		$this->db->set("siswa",$datasis);
		$this->db->set("nama",$nama_tagihan);
		$this->db->set("id",$id_tagihan);
		$this->db->set("_cid",$this->idu());
		$this->db->set("jumlah_biaya",$jumlah_tagihan);
		$this->db->set("kelas",$id_kelas);
		$this->db->set("tingkat",$id_tk);
		$this->db->set("id_jurusan",$id_jurusan);
		return $this->db->insert("keu_tr_biaya_pokok");
	}
	
	private function insert_tagihan_tambahan($id_siswa,$nama_tagihan,$jumlah_tagihan,$id_tagihan)
	{
		$this->db->set("id_siswa",$id_siswa);
		$this->db->set("tgl_tagihan",date('Y-m-d'));
		$this->db->set("id_tagihan",$id_tagihan);
		$this->db->set("_cid",$this->idu());
		$this->db->set("tagihan",$jumlah_tagihan);
		return $this->db->insert("keu_tagihan_pokok");
	}
	function hapusTagihanSiswaSatuan($id_tagihan,$id_siswa)
	{
		$var["hasil"]="";
		$cek=$this->db->query("select * from keu_tagihan_pokok where bayar>0 and sts='1' and  id_tagihan='".$id_tagihan."' and id_siswa='".$id_siswa."'")->num_rows();
		if($cek)
		{
			return $var["hasil"]="bayar";
			 
		}
		$get=$this->db->query("select siswa from keu_tr_biaya_pokok where id='".$id_tagihan."'")->row();
		$get=isset($get->siswa)?($get->siswa):"";
		$data=str_replace(",".$id_siswa.",",",",$get);
		
		$this->db->query("UPDATE  keu_tr_biaya_pokok set siswa='".$data."' where id='".$id_tagihan."' ");
	return	$this->db->query("delete from keu_tagihan_pokok where id_tagihan='".$id_tagihan."' and id_siswa='".$id_siswa."' ");
	}
	
	function hapusTagihanTambahan($id_tagihan)
	{
		$var["hasil"]="";
		$cek=$this->db->query("select * from keu_tagihan_pokok where bayar>0 and sts='1' and  id_tagihan='".$id_tagihan."' ");
		if($cek->num_rows())
		{
			 
		return		$var["hasil"]="bayar";
		  
		}
	 
		
		$this->db->query("delete from keu_tr_biaya_pokok   where id='".$id_tagihan."' ");
	return	$this->db->query("delete from keu_tagihan_pokok where id_tagihan='".$id_tagihan."'   ");
	}
	function updateNominalTagihan($id_tagihan,$nominal)
	{
		$this->db->set("tagihan",$nominal);
		$this->db->where("id_tagihan",$id_tagihan);
		$this->db->update("keu_tagihan_pokok");
		
		$this->db->set("jumlah_biaya",$nominal);
		$this->db->where("id",$id_tagihan);
	return	$this->db->update("keu_tr_biaya_pokok");
	}function updateNamaTagihan($id_tagihan,$nama)
	{
		 
		$this->db->set("nama",$nama);
		$this->db->where("id",$id_tagihan);
	return	$this->db->update("keu_tr_biaya_pokok");
	}
	function import_pembayaran()
	{
		$var=array();
			$var["size"]=true; 
			$var["file"]=true;
			$var["validasi"]=false; 
			$var["token"]=true; 
			 
			$idu=$this->session->userdata("id");
			$input=$this->input->post("f");
			$data=$this->security->xss_clean($input);
			if(isset($_FILES["file"]['tmp_name']))
			{
					return $this->importFileNilai("file");
				 
			}else{
					return $var;
			}
	}
	
	function cekKode($kode)
	{
		$this->db->where("id_tagihan",$kode);
	return	$this->db->get("keu_tagihan_pokok")->num_rows();
	}
	function importFileNilai($file_form)
	{	 
		    
		$this->load->library("PHPExcel");
		$insert=0;$gagal=0;$edit=0;$validasi_hp=true;$validasi=true;
		$file   = explode('.',$_FILES[$file_form]['name']);
		$length = count($file);
		if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){
         $tmp    = $_FILES[$file_form]['tmp_name']; 
	 
			    $load = PHPExcel_IOFactory::load($tmp);
                $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
				$i=1;
					 
				foreach ($sheets as $sheet) {
				if ($i > 1) {						
						
						 
						$no=isset($sheet[0])?($sheet[0]):"";
						$kode=isset($sheet[1])?($sheet[1]):"";
						$kode=str_replace("'","",$kode);
						$kode=str_replace("`","",$kode);
						
						$nis=isset($sheet[2])?($sheet[2]):"";
						$nis=str_replace("'","",$nis);
						$nis=str_replace("`","",$nis);
						
						$nominal=isset($sheet[3])?($sheet[3]):"";
						$nominal=str_replace(",",".",$nominal);
						$nominal=str_replace("'","",$nominal);
						$nominal=str_replace("`","",$nominal);
						
						$tglDb=isset($sheet[4])?($sheet[4]):"";
						$tgl=str_replace("'","",$tglDb);
						$tgl=str_replace("`","",$tgl);
						
						$tgl_bayar=$this->tanggal->format($tgl);
						
						$bebas=isset($sheet[5])?($sheet[5]):"";
						$bebas=str_replace(",",".",$bebas);
						$bebas=str_replace("'","",$bebas);
						
					//	$var["gagal"]=false; $var["info"]="Kode :".$kode." tidak ditemukan.<br>Urut nomor : ".$no; return $var;
				if($nis and $tglDb){
					$cekKode=$this->cekKode($kode);
					if(!$cekKode){
						$var["gagal"]=false; $var["info"]="Kode :".$kode." tidak ditemukan.<br>Urut nomor : ".$no; return $var;
					}
					
					
					
						if(strlen($tgl_bayar)<10){
						$var["gagal"]=false; $var["info"]="Tanggal error:".$tglDb."<br>Urut nomor : ".$no; return $var;
						}

				
						$id_siswa=$this->m_reff->goField("data_siswa","id","where nis='".$nis."'");
						if(!$id_siswa){ $var["gagal"]=false; $var["info"]="NIS: '".$nis."' tidak ditemukan pada sistem.<br> no.urut:".($no)."<br> Silahkan perbaiki dan import ulang";  return $var; }
						 
						$cek_biaya=$this->cek_biaya($kode,$tgl,$id_siswa);
						if($cek_biaya){
							$gagal++;	 
						}else{
							
							 ///************///
							 	
								if($bebas and $tglDb)
								{
									$tgl_tagihan=substr($tgl_bayar,0,7)."-01";
									$nominalBayar=$this->m_reff->goField('keu_tagihan_pokok','tagihan','where id_siswa="'.$id_siswa.'" and id_tagihan="'.$kode.'" 
									and tgl_tagihan="'.$tgl_tagihan.'"  ');
									$array=array(
									"id_alasan"=>$bebas,
									"bayar"=>$nominalBayar,
									"tgl_bayar"=>$tgl_bayar,
									"sts"=>2,
									"ket"=>$this->m_reff->goField('keu_tr_alasanbebas','nama','where id="'.$bebas.'" '),
									);
									
									$this->db->where("tgl_tagihan",$tgl_tagihan);
									$this->db->where("id_siswa",$id_siswa);
									$this->db->where("id_tagihan",$kode);
									$this->db->update("keu_tagihan_pokok",$array);
									$insert++;
								}elseif($tglDb)
								{								
										 
										$cr=$this->db->query("select * from keu_tm_bayar where substr(_ctime,1,10)='".date('Y-m-d')."' and id_siswa='".$id_siswa."'  ")->row();
										if($cr)
										{
											$code=$cr->code;
										}else{
											$code=date("dmYHis");
										}
										
										$db=$this->db->query("select * from keu_tr_biaya_pokok where id='".$kode."'")->result();		
										foreach($db as $val)
										{
											$input=$nominal;
											 
											if($input){
												if($val->kelipatan>1)
												{
													$this->insert_bayar_ulang($val->id,$input,$id_siswa,$code,$tgl_bayar);
												}else{
													$this->insert_bayar($val->id,$input,$id_siswa,"",$code,$tgl_bayar);	
												}
											}
											
										} 
										
										$db=$this->db->query("select * from keu_tr_biaya_tetap where kode='".$kode."' ")->result();		
										foreach($db as $val)
										{
											$input=$nominal;
										 
											if($input){
												if($val->kelipatan>1)
												{
													$this->insert_bayar_ulang($val->kode,$input,$id_siswa,$code,$tgl_bayar);
												}else{
													$this->insert_bayar($val->kode,$input,$id_siswa,"",$code,$tgl_bayar);	
												}
											}
											
										}
									$insert++;
									 ///************///
								}else{
									$gagal++;
								}
								 
						}
						 
				      
					}
				
				}
				$i++;
                }
               
		}else{
			 $var["file"]=false;
			 $var["type_file"]="xlsx";
		}
			  $var["import_data"]=true;
			  $var["data_insert"]=$insert;
			  $var["data_gagal"]=$gagal;
			  $var["data_edit"]=$edit;
			  $var["hp"]=$validasi_hp;
			  $var["validasi"]=$validasi;
		return $var;
	}
	
	function cek_biaya($kode,$tgl,$id_siswa)
	{
		$this->db->where("id_tagihan",$kode);
		$this->db->where("id_siswa",$id_siswa);
		$this->db->where("tgl_bayar",$tgl);
		return $this->db->get("keu_tm_bayar")->num_rows();
	}
}