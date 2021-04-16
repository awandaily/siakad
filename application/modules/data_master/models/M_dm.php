<?php

class M_dm extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	function kodeProperty()
	{
			  $carikode = $this->db->query("SELECT max(id_prop) as id_prop from data_property")->row();
			  $datakode =$carikode->id_prop;//$carikode->kode;
			 if ($datakode) {
		  	    $kode = (int) $datakode;
		   		return	$newID = sprintf("%05s", $kode+1);
		   	  } else {
				return "00001";
					 }
	}
	function kodeAgen()
	{
			  $carikode = $this->db->query("SELECT max(id_agen) as id_agen from data_agen")->row();
			  $datakode =$carikode->id_agen;//$carikode->kode;
			 if ($datakode) {
		  	    $kode = (int) $datakode;
		   		return	$newID = sprintf("%02s", $kode+1);
		   	  } else {
				return "01";
					 }
	}
	
	function getKodeList($agen)
	{
	return $agen.$this->kodeProperty();
	}
	function analisisKelengkapan()
	{
	$gambar1=isset($_FILES['gambar1']['type']);
	$gambar2=isset($_FILES['gambar2']['type']);
	$gambar3=isset($_FILES['gambar3']['type']);
	$gambar4=isset($_FILES['gambar4']['type']);
	$gambar5=isset($_FILES['gambar5']['type']);
	$jml=0;
	if($gambar1)
	{
		$jml++;
	}if($gambar2)
	{
		$jml++;
	}if($gambar3)
	{
		$jml++;
	}if($gambar4)
	{
		$jml++;
	}if($gambar5)
	{
		$jml++;
	}
	$total=$jml;	
	if($total==0)
	{
		return 0;
	}else{
		return 1;
	}
	
	}
	function addOwner($id,$nama=null)
	{
		if($id)
		{
			$data=array(
			'nama'=>$this->input->post("nama_own"),
			'hp'=>$this->input->post("hp1_own"),
			'hp2'=>$this->input->post("hp2_own"),
			'email'=>$this->input->post("email_own"),
			'alamat'=>$this->input->post("alamat_own"),
			'jk'=>$this->input->post("jk_own"),
			);
			$this->db->where("id_owner",$id);
			$this->db->update("data_owner",$data);
			return $id;
		}else{
		if($nama)
		{			
			$return=$this->db->query("SELECT MAX(CONVERT(id_owner,SIGNED)+1) AS maxs FROM data_owner")->row();
			$return=isset($return->maxs)?($return->maxs):"";
			$data=array(
			'id_owner'=>$return,
			'nama'=>$this->input->get_post("nama_own"),
			'hp'=>$this->input->get_post("hp1_own"),
			'hp2'=>$this->input->get_post("hp2_own"),
			'email'=>$this->input->get_post("email_own"),
			'alamat'=>$this->input->get_post("alamat_own"),
			'jk'=>$this->input->get_post("jk_own"),
			);
			$this->db->insert("data_owner",$data);
			return $return;
		}
		}
	}
	function cariKode($kode)
	{
		$return=$this->db->query("SELECT * FROM data_property WHERE kode_prop='".$kode."'")->num_rows();	
		if($return)
		{
			  $carikode = $this->db->query("SHOW TABLE STATUS LIKE 'data_property'")->row();
			  $datakode =isset($carikode->Auto_increment)?($carikode->Auto_increment):"1";//$carikode->kode;
		  	    $kode = (int) $datakode;
		   		$newID = sprintf("%03s", $kode);
				$thn=substr(date('Y'),2,2);
				$bln=sprintf("%02s",date('m'));
				$tgl=sprintf("%02s",date('d'));
		   	 return  $tgl.$bln.$thn."-".$newID;	
		}else{
			return $kode;
		}
	}
	function insert()
	{
		$agen=$this->input->post("agen");
		$jenis=$this->input->post("type_pro");
		$kode=$this->input->post("kode");
		$kode=$this->cariKode($kode);
		$array=array(
		"id_created"=>$this->session->userdata("id"),
		"kode_prop"=>$kode,
		"jenis_prop"=>$this->input->post("type_pro"),
		"jenis_listing"=>$this->input->post("jenis_list"),
		"type_jual"=>$this->input->post("type_list"),
		"desc"=>$this->input->post("desc"),
		"id_prov"=>$this->input->post("provinsi"),
		"id_kab"=>$this->input->post("kabupaten"),
		"id_owner"=>$this->addOwner($this->input->post("id_own"),$this->input->post("nama_own")),
		"komplek"=>$this->input->post("nama_komplek"),
		"nama_area"=>$this->input->post("area"),
		"lat_area"=>$this->input->post("lat_area"),
		"long_area"=>$this->input->post("long_area"),
		"alamat_detail"=>$this->input->post("alamat_detail"),
		"lat_detail"=>$this->input->post("lat"),
		"long_detail"=>$this->input->post("long"),
		"luas_tanah"=>$this->input->post("luas_tanah"),
		"luas_bangunan"=>$this->input->post("luas_bangunan"),
		"tahun_dibangun"=>$this->input->post("tahun_dibangun"),
		"harga"=>str_replace(".","",$this->input->post("harga")),
		"kamar_tidur"=>$this->input->post("kamar_tidur"),
		"kamar_mandi"=>$this->input->post("kamar_mandi"),
		"kamar_tidur_p"=>$this->input->post("kamar_tidur_pembantu"),
		"kamar_mandi_p"=>$this->input->post("kamar_mandi_pembantu"),
		"jml_lantai"=>$this->input->post("jumlah_lantai"),
		"jml_garasi"=>$this->input->post("garasi"),
		"jml_carports"=>$this->input->post("carports"),
		"daya_listrik"=>$this->input->post("daya_listrik"),
		"hadap"=>$this->input->post("hadap"),
		"type_sewa"=>$this->input->post("type_sewa"),
		"jenis_sertifikat"=>$this->input->post("sertifikat"),
		"kelengkapan"=>$this->analisisKelengkapan(),
		"agen"=>$this->input->post("agen"),
		"keterangan"=>$this->input->post("keterangan"),
		"gambar1"=>$this->uploadGambar($kode,"upload1"),
		"gambar2"=>$this->uploadGambar($kode,"upload2"),
		"gambar3"=>$this->uploadGambar($kode,"upload3"),
		"gambar4"=>$this->uploadGambar($kode,"upload4"),
		"gambar5"=>$this->uploadGambar($kode,"upload5"),
		"desain"=>$this->uploadGambar($kode,"upload6"),
		"gambar_utama"=>$this->input->post("set"),
		"fee_persen"=>str_replace(",",".",$this->input->post("fee_persen")),
		"fee_up"=>str_replace(".","",$this->input->post("fee_up")),
		"media_promosi"=>$this->input->post("media_iklan").",".$this->input->post("media_spanduk"),
		"tgl_masuk_listing"=>$this->tanggal->eng_($this->input->post("tgl_masuk_listing"),"-"),
		"tgl_expired"=>$this->tanggal->eng_($this->input->post("tgl_expired"),"-"),
		"air"=>$this->input->post("air"),
		"furniture"=>$this->input->post("furniture"),
		"area_listing"=>$this->input->post("area_listing"),
		"tgl_expired"=>$this->tanggal->eng_($this->input->post("tgl_masuk_listing"),"-"),
		"harga_tanah"=>str_replace(".","",$this->input->post("harga_tanah")),
		);
	return	$this->db->insert("data_property",$array);
	}
	
	function update()
	{	$id_prop=$this->input->post("id_property");
		$agen=$this->input->post("agen");
		$jenis=$this->input->post("type_pro");
		$array=array(
		"id_modified"=>$this->session->userdata("id"),
		"updated_time"=>date("Y-m-d H:i:s"),
		"kode_prop"=>$this->input->post("kode"),
		"jenis_prop"=>$this->input->post("type_pro"),
		"jenis_listing"=>$this->input->post("jenis_list"),
		"type_jual"=>$this->input->post("type_list"),
		"desc"=>$this->input->post("desc"),
		"id_prov"=>$this->input->post("provinsi"),
		"id_kab"=>$this->input->post("kabupaten"),
		"id_owner"=>$this->addOwner($this->input->post("id_own"),$this->input->post("nama_own")),
		"komplek"=>$this->input->post("nama_komplek"),
		"nama_area"=>$this->input->post("area"),
		"lat_area"=>$this->input->post("lat_area"),
		"long_area"=>$this->input->post("long_area"),
		"alamat_detail"=>$this->input->post("alamat_detail"),
		"lat_detail"=>$this->input->post("lat"),
		"long_detail"=>$this->input->post("long"),
		"luas_tanah"=>$this->input->post("luas_tanah"),
		"luas_bangunan"=>$this->input->post("luas_bangunan"),
		"tahun_dibangun"=>$this->input->post("tahun_dibangun"),
		"harga"=>str_replace(".","",$this->input->post("harga")),
		"kamar_tidur"=>$this->input->post("kamar_tidur"),
		"kamar_mandi"=>$this->input->post("kamar_mandi"),
		"kamar_tidur_p"=>$this->input->post("kamar_tidur_pembantu"),
		"kamar_mandi_p"=>$this->input->post("kamar_mandi_pembantu"),
		"jml_lantai"=>$this->input->post("jumlah_lantai"),
		"jml_garasi"=>$this->input->post("garasi"),
		"jml_carports"=>$this->input->post("carports"),
		"daya_listrik"=>$this->input->post("daya_listrik"),
		"hadap"=>$this->input->post("hadap"),
		"type_sewa"=>$this->input->post("type_sewa"),
		"jenis_sertifikat"=>$this->input->post("sertifikat"),
		"kelengkapan"=>$this->analisisKelengkapan(),
		"agen"=>$this->input->post("agen"),
		"keterangan"=>$this->input->post("keterangan"),
		"gambar1"=>$this->uploadGambarUpdate($id_prop,"upload1"),
		"gambar2"=>$this->uploadGambarUpdate($id_prop,"upload2"),
		"gambar3"=>$this->uploadGambarUpdate($id_prop,"upload3"),
		"gambar4"=>$this->uploadGambarUpdate($id_prop,"upload4"),
		"gambar5"=>$this->uploadGambarUpdate($id_prop,"upload5"),
		"desain"=>$this->uploadGambar($id_prop,"upload6"),
		"gambar_utama"=>$this->input->post("set"),
		"fee_persen"=>str_replace(",",".",$this->input->post("fee_persen")),
		"fee_up"=>str_replace(".","",$this->input->post("fee_up")),
		"media_promosi"=>$this->input->post("media_iklan").",".$this->input->post("media_spanduk"),
		"tgl_masuk_listing"=>$this->tanggal->eng_($this->input->post("tgl_masuk_listing"),"-"),
		"tgl_expired"=>$this->tanggal->eng_($this->input->post("tgl_masuk_listing"),"-"),
		"air"=>$this->input->post("air"),
		"furniture"=>$this->input->post("furniture"),
		"area_listing"=>$this->input->post("area_listing"),
		"harga_tanah"=>str_replace(".","",$this->input->post("harga_tanah")),
		);
		$this->db->where("id_prop",$id_prop);
	return	$this->db->update("data_property",$array);
	}
	
	
	
	function HapusAll()
	{
		$hapus=$this->input->post("hapus");
		foreach($hapus as $id)
		{
		 $this->hapus($id);
		}	return true;
	}
	function hapus($id)
	{
		$this->hapusGambar($id);
		$this->db->where("id_prop",$id);
		$this->db->delete("data_property");
	}
	function HapusAllSelling()
	{
		$hapus=$this->input->post("hapus");
		foreach($hapus as $id)
		{
		 $this->hapusSelling($id);
		}	return true;
	}
	function hapusSelling($id)
	{
		$this->hapusZip($id);
		$this->db->where("id",$id);
		$this->db->delete("data_selling");
	}
	function hapusGambar($id)
	{
		for($i=1;$i<=5;$i++)
		{
			$daprof=$this->geFieldGambar($id,"gambar".$i);
			if($daprof)
			 {
				 $path = "file_upload/img/".$daprof;
				 if (file_exists($path)) {
					unlink($path);
				 }
			 }
		}
	}
	function hapusZip($id)
	{
		for($i=1;$i<=5;$i++)
		{
			 $path = "file_upload/dok/".$id.".zip";
				 if (file_exists($path)) {
					unlink($path);
				 }
		}
	}
	function uploadGambarUpdate($id_prop,$form)
	{
		if(isset($_FILES[$form]['type']))
		{
		return	$this->upload_imgUpdate($id_prop,$form);
		}else{
			return  $daprof=$this->geFieldGambar($id_prop,$form);
		}
	}
	function geFieldGambar($id_prop,$form)
	{
		$gambar=str_replace("upload","gambar",$form);
		$this->db->where("id_prop",$id_prop);
	$data=$this->db->get("data_property")->row();
	return isset($data->$gambar)?($data->$gambar):"";
	}
	public function upload_imgUpdate($id_prop,$form)
	{	//$this->m_konfig->log("admin","Upload photo");
		///
		  $nama=date("YmdHis");
		  $lokasi_file = $_FILES[$form]['tmp_name'];
		  $tipe_file   = $_FILES[$form]['type'];
		  $nama_file   = $_FILES[$form]['name'];
		  
		  
		  $daprof=$this->geFieldGambar($id_prop,$form);
			if($daprof)
			 {
				 $path = "file_upload/img/".$daprof;
				 if (file_exists($path)) {
					unlink($path);
				 }
			 }
		  
		  
			//$jenis=explode(".",$nama_file);
			//$nama_file=$jenis[0];
			$nama_file=str_replace(" ","_",$nama_file);
		
			// $jenis="jpg";
			$nama=str_replace("/","",$nama.$nama_file);
			 $target_path = "file_upload/img/".$nama;
			 //
	//	  }
		  //
		if (!empty($lokasi_file)) {
		move_uploaded_file($lokasi_file,$target_path);
		//if($jenis=="png"){
		//$this->konversi->UploadImageResize($target_path,$jenis,200);
		}
	//	$this->reff->UploadImageResize($target_path,"jpg",800);
		//$this->reff->watermark_image($target_path);
		return $nama;
		}
		
		
		
		
		
		function uploadGambar($kode,$form)
	{
		if(isset($_FILES[$form]['type']))
		{
		return	$this->upload_img($kode,$form);
		}
	}
	public function upload_img($kode,$form)
	{	//$this->m_konfig->log("admin","Upload photo");
		///
			$nama=date("YmdHis");
		  $lokasi_file = $_FILES[$form]['tmp_name'];
		  $tipe_file   = $_FILES[$form]['type'];
		  $nama_file   = $_FILES[$form]['name'];
		  //if($tipe_file)
		  //{
		//  $daprof=$this->getGambarkode($kode);
		//	if($daprof!="")
		//	 {
		//		 $path = "file_upload/barang/".$daprof;
		//		 if (file_exists($path)) {
		//			unlink($path);
		//		 }
		//	 }
		  
		  
			//$jenis=explode(".",$nama_file);
			$nama_file=str_replace(" ","_",$nama_file);
			// $jenis="jpg";
			$nama=str_replace("/","",$kode.$nama.$nama_file);
			 $target_path = "file_upload/img/".$nama;
			 //
	//	  }
		  //
		if (!empty($lokasi_file)) {
		move_uploaded_file($lokasi_file,$target_path);
		//if($jenis=="png"){
		//$this->konversi->UploadImageResize($target_path,$jenis,200);
		}
	//	$this->reff->UploadImageResize($target_path,"jpg",800);
		return $nama;
	}
		
		
	function getDataProp()
	{
	return	$this->db->get("data_property")->result();
	}
	function get_one($id)
	{
		$this->db->where("id_prop",$id);
	return	$this->db->get("data_property");
	}
  
  /*------------------------------------------------------------------------------*/
		function get_dataProperty()
	{
		 $query = $this->_get_dataProperty();
        if ($_POST['length'] != -1)
            $query .= " limit " . $_POST['start'] . "," . $_POST['length'];
        return $this->db->query($query)->result();
 
	}
	  public function counts() {
        $query = $this->_get_dataProperty();
        return $this->db->query($query)->num_rows();
    }
	function _get_dataProperty()
	{
	$dan="";
	$provinsi=$this->input->get("provinsi");
	if($provinsi){
	$dan.=" AND id_prov=".$provinsi;
	}
	$kabupaten=$this->input->get("kabupaten");
	if($kabupaten){
	$dan.=" AND id_kab=".$kabupaten;
	}
	$area=$this->input->get("area");
	if($area){
	$dan.=" AND (kode_prop LIKE '%".$area."%' or nama_area LIKE '%".$area."%' or komplek LIKE '%".$area."%' or alamat_detail LIKE '%".$area."%' or agen LIKE '%".$area."%' or area_listing LIKE '%".$area."%')";
	}
	//$lat_area=$this->input->get("lat_area");
//	if($lat_area){
	//$dan.=" AND lat_area=".$lat_area;
//	}
//$long_area=$this->input->get("long_area");
///if($long_area){
//$dan.=" AND long_area=".$long_area;
//}
	$jenis_pro=$this->input->get("jenis_pro");
	if($jenis_pro){
	$dan.=" AND jenis_prop=".$jenis_pro;
	}$type_pro=$this->input->get("type_pro");
	
	if($type_pro){
	$dan.=" AND type_jual='".$type_pro."'";
	}
	
	$kamar_tidur=$this->input->get("kamar_tidur");
	if($kamar_tidur){
	$dan.=" AND kamar_tidur=".$kamar_tidur;
	}
	$kamar_mandi=$this->input->get("kamar_mandi");
	if($kamar_mandi){
	$dan.=" AND kamar_mandi=".$kamar_mandi;
	}
	$garasi=$this->input->get("garasi");
	if($garasi){
	$dan.=" AND jml_garasi=".$garasi;
	}
	$daya_listrik=$this->input->get("daya_listrik");
	if($daya_listrik){
	$dan.=" AND daya_listrik=".$daya_listrik;
	}
	
	$harga_min=$this->input->get("harga_min");
	if($harga_min){
	$dan.=" AND harga>='".str_replace(".","",$harga_min)."'";
	}
	$harga_max=$this->input->get("harga_max");
	if($harga_max){
	$dan.=" AND harga<='".str_replace(".","",$harga_max)."'";
	}
	
	
	$sertifikat=$this->input->get("sertifikat");
	if($sertifikat){
	$dan.=" AND jenis_sertifikat='".$sertifikat."'";
	}
	$agen=$this->input->get("agen");
	if($agen){
	$dan.=" AND agen='".$agen."'";
	}
	$type_sewa=$this->input->get("type_sewa");
	if($type_sewa){
	$dan.=" AND type_sewa=".$type_sewa;
	}
	$kelengkapan=$this->input->get("kelengkapan");
	if($kelengkapan){
		if($kelengkapan=='1')
		{
			$dan.=" AND (gambar1!='' AND gambar2!='' AND gambar3!='' AND gambar4!='' AND gambar5!='')    ";
		}elseif($kelengkapan=='2')
		{
			$dan.=" AND (gambar1 IS NULL AND gambar2 IS NULL AND gambar3 IS NULL AND gambar4 IS NULL AND gambar5 IS NULL) OR (gambar1='' AND gambar2='' AND gambar3='' AND gambar4='' AND gambar5='')  ";
		}elseif($kelengkapan=='3')
		{
			$dan.=" AND desain!=''  ";
		}elseif($kelengkapan=='4')
		{
				$dan.=" AND (desain IS NULL or desain='')  ";
		}
	
	}
	$status_penjualan=$this->input->get("status_penjualan");
	if($status_penjualan=='0'){
	$dan.=" AND status='0'";
	}elseif($status_penjualan=='1'){
	$dan.=" AND status='1'";
	}elseif($status_penjualan=='2'){
		$dan.=" AND status='2'";
	}
	
        $query = "SELECT * FROM data_property WHERE 1=1 $dan ";
        if (isset($_POST['search']['value'])) {
            $searchkey = $_POST['search']['value'];
            $query .= " AND (
			kode_prop LIKE '%" . $searchkey . "%' or 
			data_property.desc  LIKE '%" . $searchkey . "%' or
			keterangan LIKE '%" . $searchkey . "%' or
			alamat_detail LIKE '%" . $searchkey . "%' or
			nama_area LIKE '%" . $searchkey . "%' or
			area_listing LIKE '%" . $searchkey . "%' or
			agen LIKE '%" . $searchkey . "%' or
			komplek LIKE '%" . $searchkey . "%'  
			) ";
        }

        $column = array('');
        $i = 0;
        foreach ($column as $item) {
            $column[$i] = $item;
        }

      /*  if (isset($_POST['order'])) {
		//	$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            $query .= " order by " . $column[$_POST['order']['0']['column']] . " " . $_POST['order']['0']['dir'];
        } else if (isset($order)) {
            $order = $order;
			//	$this->db->order_by(key($order), $order[key($order)]);
			       $query .= " order by nama ASC";
        }*/
		$query.=" order by id_prop ASC" ;
        return $query;
	}
	
	/*-----------------------------------------------------------------------*/
	
	/*------------------------------------------------------------------------------*/
		function ajax_driver()
	{
		 $query = $this->_ajax_driver();
        if ($_POST['length'] != -1)
            $query .= " limit " . $_POST['start'] . "," . $_POST['length'];
        return $this->db->query($query)->result();
 
	}
	  public function counts_ajax_driver() {
        $query = $this->_ajax_driver();
        return $this->db->query($query)->num_rows();
    }
	function _ajax_driver()
	{

        $query = "SELECT * FROM admin WHERE level=4  ";
        if (isset($_POST['search']['value'])) {
            $searchkey = $_POST['search']['value'];
            $query .= " AND (
			owner LIKE '%" . $searchkey . "%' or 
			kode_tujuan  LIKE '%" . $searchkey . "%'  
		) ";
        }

        $column = array('');
        $i = 0;
        foreach ($column as $item) {
            $column[$i] = $item;
        }

     
		$query.=" order by times_narik ASC" ;
        return $query;
	}
	
	/*-----------------------------------------------------------------------*/
	
	
	
	
	
	
	function insertSellingJual()
	{
		if($this->input->post("options")=="1")
		{
			$selling=$this->input->post("selling1");
		}else{
			$selling=$this->input->post("selling2");
		}
		 if($this->input->post("options2")=="1")
		{
			$listing=$this->input->post("listing1");
		}else{
			$listing=$this->input->post("listing2");
		}
		 
		$data=array(
		"harga"=>str_replace(".","",$this->input->post("harga")),
		"kode_listing"=> $kodelis=$this->input->post("kode_listing"),
		"kode_agen"=> $listing,
		"id_pelanggan"=> $this->input->post("id_pelanggan"),
		//"nominal_bayar"=> $this->input->post("nominal_bayar"),
		//"tgl_pelunasan"=> $this->tanggal->eng_($this->input->post("tgl_pelunasan"),"-"),
		"tgl_closing"=> $this->tanggal->eng_($this->input->post("tgl_closing"),"-"),
		"selling"=> $selling,
		"total_komisi"=>  str_replace(".","",$this->input->post("terhitung") ),
		"komisi_persen"=>  $this->input->post("komisi_persen") ,
		"ket"=>  $this->input->post("ket") ,
		"sumber_selling"=>  $this->input->post("options") ,
		"sumber_listing"=>  $this->input->post("options2") ,
		"komisi_persen_listing"=>  $this->input->post("komisi_persen_listing") ,
		"nominal_komisi_listing"=>  str_replace(".","",$this->input->post("terhitung_listing")) ,
		"komisi_persen_selling"=>  $this->input->post("komisi_persen_selling") ,
		"nominal_komisi_selling"=>  str_replace(".","",$this->input->post("terhitung_selling")) ,
		);
			$this->updateListingStatus($kodelis,"1","");
	return	$this->db->insert("data_selling",$data);
	}
	
	function insertSellingSewa()
	{
		if($this->input->post("options")=="1")
		{
			$selling=$this->input->post("selling1");
		}else{
			$selling=$this->input->post("selling2");
		}
		 if($this->input->post("options2")=="1")
		{
			$listing=$this->input->post("listing1");
		}else{
			$listing=$this->input->post("listing2");
		}
		 
		$data=array(
		"harga"=>str_replace(".","",$this->input->post("hargax")),
		"kode_listing"=> $kodelis=$this->input->post("kode_listing"),
		"kode_agen"=> $listing,
		"id_pelanggan"=> $this->input->post("id_pelanggan"),
		//"nominal_bayar"=> $this->input->post("nominal_bayar"),
		//"tgl_pelunasan"=> $this->tanggal->eng_($this->input->post("tgl_pelunasan"),"-"),
		"tgl_closing"=> $this->tanggal->eng_($this->input->post("tgl_closing"),"-"),
		"selling"=> $selling,
		"type_selling"=> "sewa" ,
		"total_komisi"=>  str_replace(".","",$this->input->post("terhitungx") ),
		"komisi_persen"=>  $this->input->post("komisi_persenx") ,
		"ket"=>  $this->input->post("ket") ,
		"sumber_selling"=>  $this->input->post("options") ,
		"sumber_listing"=>  $this->input->post("options2") ,
		"komisi_persen_listing"=>  $this->input->post("komisi_persen_listingx") ,
		"nominal_komisi_listing"=>  str_replace(".","",$this->input->post("terhitung_listingx")) ,
		"komisi_persen_selling"=>  $this->input->post("komisi_persen_sellingx") ,
		"nominal_komisi_selling"=>  str_replace(".","",$this->input->post("terhitung_sellingx")),
		);
		$this->db->insert("data_selling",$data);
		$this->updateListingStatus($kodelis,"1",$this->tanggal->eng_($this->input->post("tgl_jatuh_tempo"),"-"));
		$kode=$this->db->query("SELECT max(id) as mak from data_selling")->row();
		return $this->uploadFIleZip($kode->mak,"zip");
	}
	
	
	function UpdateSelling()
	{
		
	 
		
		
		if($this->input->post("options")=="1")
		{
			$selling=$this->input->post("selling1");
		}else{
			$selling=$this->input->post("selling2");
		}
		 if($this->input->post("options2")=="1")
		{
			$listing=$this->input->post("listing1");
		}else{
			$listing=$this->input->post("listing2");
		}
		$data=array(
		"harga"=>str_replace(".","",$this->input->post("harga")),
		"kode_listing"=> $kodelis=$this->input->post("kode_listing"),
			"kode_agen"=> $listing,
		"id_pelanggan"=> $this->input->post("id_pelanggan"),
		//"nominal_bayar"=> $this->input->post("nominal_bayar"),
		//"tgl_pelunasan"=> $this->tanggal->eng_($this->input->post("tgl_pelunasan"),"-"),
		"tgl_closing"=> $this->tanggal->eng_($this->input->post("tgl_closing"),"-"),
		"selling"=> $selling,
		"total_komisi"=>  str_replace(".","",$this->input->post("terhitung") ),
		"komisi_persen"=>  $this->input->post("komisi_persen") ,
		"ket"=>  $this->input->post("ket") ,
		"sumber_selling"=>  $this->input->post("options") ,
		"sumber_listing"=>  $this->input->post("options2") ,
		"komisi_persen_listing"=>  $this->input->post("komisi_persen_listing") ,
		"nominal_komisi_listing"=>  str_replace(".","",$this->input->post("terhitung_listing")) ,
		"komisi_persen_selling"=>  $this->input->post("komisi_persen_selling") ,
		"nominal_komisi_selling"=>  str_replace(".","",$this->input->post("terhitung_selling")) ,
		);
		$this->db->where("id",$id=$this->input->post("id"));
		$this->db->update("data_selling",$data);
		//$this->updateListingStatus($kodelis,"1",$this->tanggal->eng_($this->input->post("tgl_jatuh_tempo"),"-"));
		//$kode=$this->db->query("SELECT max(id) as mak from data_selling")->row();
		return $this->uploadFIleZip($id,"zip");
	}
	function UpdateSellingSewa()
	{
		
	 
		
		
		if($this->input->post("options")=="1")
		{
			$selling=$this->input->post("selling1");
		}else{
			$selling=$this->input->post("selling2");
		}
		 if($this->input->post("options2")=="1")
		{
			$listing=$this->input->post("listing1");
		}else{
			$listing=$this->input->post("listing2");
		}
			$data=array(
		"harga"=>str_replace(".","",$this->input->post("hargax")),
		"kode_listing"=> $kodelis=$this->input->post("kode_listing"),
		"kode_agen"=> $listing,
		"id_pelanggan"=> $this->input->post("id_pelanggan"),
		//"nominal_bayar"=> $this->input->post("nominal_bayar"),
		//"tgl_pelunasan"=> $this->tanggal->eng_($this->input->post("tgl_pelunasan"),"-"),
		"tgl_closing"=> $this->tanggal->eng_($this->input->post("tgl_closing"),"-"),
		"selling"=> $selling,
		"type_selling"=> "sewa" ,
		"total_komisi"=>  str_replace(".","",$this->input->post("terhitungx") ),
		"komisi_persen"=>  $this->input->post("komisi_persenx") ,
		"ket"=>  $this->input->post("ket") ,
		"sumber_selling"=>  $this->input->post("options") ,
		"sumber_listing"=>  $this->input->post("options2") ,
		"komisi_persen_listing"=>  $this->input->post("komisi_persen_listingx") ,
		"nominal_komisi_listing"=>  str_replace(".","",$this->input->post("terhitung_listingx") ),
		"komisi_persen_selling"=>  $this->input->post("komisi_persen_sellingx") ,
		"nominal_komisi_selling"=>  str_replace(".","",$this->input->post("terhitung_sellingx")) ,
		);
		$this->db->where("id",$id=$this->input->post("id"));
		$this->db->update("data_selling",$data);
		$this->updateListingStatus($kodelis,"1",$this->tanggal->eng_($this->input->post("tgl_jatuh_tempo"),"-"));
		//$this->updateListingStatus($kodelis,"1",$this->tanggal->eng_($this->input->post("tgl_jatuh_tempo"),"-"));
		//$kode=$this->db->query("SELECT max(id) as mak from data_selling")->row();
		return $this->uploadFIleZip($id,"zip");
	}
	
	 function uploadFIleZip($kode,$form)
	 {
		if(isset($_FILES[$form]['type']))
		{
		return	$this->do_uploadFIleZip($kode,$form);
		}
 
	 }
	 public function do_uploadFIleZip($kode,$form)
	{	 
		  $lokasi_file = $_FILES[$form]['tmp_name'];
		  $tipe_file   = $_FILES[$form]['type'];
		  $nama_file   = $_FILES[$form]['name'];
		  $target_path = "file_upload/dok/".$kode.".zip";
		if (!empty($lokasi_file)) {
		move_uploaded_file($lokasi_file,$target_path);
		}	
	}
	function updateListingStatus($kode,$sts,$masa)
	{
		$array=array(
		"status"=>$sts,
		"tgl_jatuh_tempo"=>$masa,
		"alasan_cancel"=>$this->input->post("pilih_cancel"),
		"ket_cancel"=>$this->input->post("ket_cancel"),
		);
		$this->db->where("kode_prop",$kode);
	return	$this->db->update("data_property",$array);
	}
	
	
		function soldByOwner($kode)
	{
		$array=array(
		"status"=>"4",
	 	);
		$this->db->where("id_prop",$kode);
	return	$this->db->update("data_property",$array);
	}
	
		
  function saveReport()
	{
		$data=array(
		"id_agen"=>$this->session->userdata("id"),
		"kode_listing"=>$this->input->post("kode_listing"),
		"id_title"=>$this->input->post("title"),
		"ket"=>$this->input->post("text"),
		);
		
			return $this->db->insert("report_listing",$data);
	}
	
	function delHistory($id)
	{
		$this->db->where("id",$id);
		return $this->db->delete('report_listing');
	}
	function cek_alamat_js()
	{
		$this->db->where("alamat_detail",$this->input->post("alamat"));
		$this->db->where("alamat_detail!=","");
	return	$this->db->get("data_property")->num_rows();
	}function cek_alamat_js_edit()
	{
		$this->db->where("alamat_detail",$this->input->post("alamat"));
		$this->db->where("kode_prop!=",$this->input->post("id"));
		$this->db->where("alamat_detail!=","");
	return	$this->db->get("data_property")->num_rows();
	}
	
	function export()
	{
//////start
        $objPHPExcel = new PHPExcel();
//style
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '6CCECB')
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
        );
     //   $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(25);
     //   $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(25);
     //   $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(35);




//create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'ID');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'TYPE');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'PRICE');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'LOCATION');
        $objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'DISTRIC');
        $objPHPExcel->getActiveSheet(0)->setCellValue('F1', 'VENDOR');
        $objPHPExcel->getActiveSheet(0)->setCellValue('G1', 'MEMBER');
        $objPHPExcel->getActiveSheet(0)->setCellValue('H1', 'SALES STATUS');
		$objPHPExcel->getActiveSheet(0)->setCellValue('I1', 'KT');
        $objPHPExcel->getActiveSheet(0)->setCellValue('J1', 'KM');
        $objPHPExcel->getActiveSheet(0)->setCellValue('K1', 'KTP');
        $objPHPExcel->getActiveSheet(0)->setCellValue('L1', 'KMP');
        $objPHPExcel->getActiveSheet(0)->setCellValue('M1', 'FLOOR');
        $objPHPExcel->getActiveSheet(0)->setCellValue('N1', 'GARAGE');
        $objPHPExcel->getActiveSheet(0)->setCellValue('O1', 'CARPORT');
        $objPHPExcel->getActiveSheet(0)->setCellValue('P1', 'COMPAS');
        $objPHPExcel->getActiveSheet(0)->setCellValue('Q1', 'ELECTRICITY');
		$objPHPExcel->getActiveSheet(0)->setCellValue('R1', 'WATER');
		$objPHPExcel->getActiveSheet(0)->setCellValue('S1', 'FURNITURE');
        $objPHPExcel->getActiveSheet(0)->setCellValue('T1', 'BUILDING');
        $objPHPExcel->getActiveSheet(0)->setCellValue('U1', 'LAND');
        $objPHPExcel->getActiveSheet(0)->setCellValue('V1', 'STATUS');
        $objPHPExcel->getActiveSheet(0)->setCellValue('W1', 'DESCRIPTION');
        $objPHPExcel->getActiveSheet(0)->setCellValue('X1', 'NOTE');



//make a border column
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:X1')->applyFromArray($style);

        $database = $this->_get_dataProperty();
        $shit = 1;
        $database = $this->db->query($database)->result();
        foreach ($database as $val) {
            $shit++;
			$type=$val->type_jual;
			if($type=="sewa")
			{
				if($val->status=="1")
				{	$status="Sell";
				}elseif($val->status=="2"){
					 $status=" Cancel ".$this->reff->cancelBy($val->alasan_cancel)." ";
				}else{
				 $status="Rent  ";
					 	}
			}elseif($type=="jual"){
				if($val->status=="1")
				{
				 $status="Sold  ";
				}elseif($val->status=="2"){
					 $status=" Cancel ".$this->reff->cancelBy($val->alasan_cancel)."    ";
				}else{
				 $status="Sell";
				}
				
			}else{
			 		
					$status=" Cancel  ";
			}
//create data per row
           $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $shit . '', '`'.$val->kode_prop);
           $objPHPExcel->getActiveSheet(0)->setCellValue('B' . $shit . '', ''.$this->reff->getNamaJenis($val->jenis_prop));
           $objPHPExcel->getActiveSheet(0)->setCellValue('C' . $shit . '', ''.$val->harga+$val->fee_up);
           $objPHPExcel->getActiveSheet(0)->setCellValue('D' . $shit . '', ''.$val->alamat_detail);
           $objPHPExcel->getActiveSheet(0)->setCellValue('E' . $shit . '', ''.$val->nama_area);
           $objPHPExcel->getActiveSheet(0)->setCellValue('F' . $shit . '', ''.$this->reff->getNamaOwner($val->id_owner));
           $objPHPExcel->getActiveSheet(0)->setCellValue('G' . $shit . '', ''.$this->reff->getNamaAgen($val->agen));
           $objPHPExcel->getActiveSheet(0)->setCellValue('H' . $shit . '', ''.$status);
           $objPHPExcel->getActiveSheet(0)->setCellValue('I' . $shit . '', ''.$val->kamar_tidur);
           $objPHPExcel->getActiveSheet(0)->setCellValue('J' . $shit . '', $val->kamar_mandi);
           $objPHPExcel->getActiveSheet(0)->setCellValue('K' . $shit . '', $val->kamar_tidur_p);
           $objPHPExcel->getActiveSheet(0)->setCellValue('L' . $shit . '', $val->kamar_mandi_p);
           $objPHPExcel->getActiveSheet(0)->setCellValue('M' . $shit . '', $val->jml_lantai);
           $objPHPExcel->getActiveSheet(0)->setCellValue('N' . $shit . '', $val->jml_garasi);
           $objPHPExcel->getActiveSheet(0)->setCellValue('O' . $shit . '', $val->jml_carports);
           $objPHPExcel->getActiveSheet(0)->setCellValue('P' . $shit . '', $this->reff->getNamaHadap($val->hadap));
           $objPHPExcel->getActiveSheet(0)->setCellValue('Q' . $shit . '', $val->daya_listrik);
           $objPHPExcel->getActiveSheet(0)->setCellValue('R' . $shit . '', $this->reff->getNamaAir($val->air));
           $objPHPExcel->getActiveSheet(0)->setCellValue('S' . $shit . '', $this->reff->getNamaFurniture($val->furniture));
           $objPHPExcel->getActiveSheet(0)->setCellValue('T' . $shit . '', $val->luas_bangunan);
           $objPHPExcel->getActiveSheet(0)->setCellValue('U' . $shit . '', $val->luas_tanah);
           $objPHPExcel->getActiveSheet(0)->setCellValue('V' . $shit . '', $this->reff->getNamaJenisSertifikat($val->jenis_sertifikat));
           $objPHPExcel->getActiveSheet(0)->setCellValue('W' . $shit . '', $val->desc);
           $objPHPExcel->getActiveSheet(0)->setCellValue('X' . $shit . '', $val->keterangan);     
        }

//auto size column
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('T')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('U')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('V')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('W')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('X')->setAutoSize(true);

// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('Data Listing');
        
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data-Listing.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
//////finish
    
	}	
	
	
	function export_selling()
	{
//////start
        $objPHPExcel = new PHPExcel();
//style
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '6CCECB')
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
        );
     //   $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(25);
     //   $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(25);
     //   $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(35);




//create column
		$objPHPExcel->getActiveSheet(0)->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'TRANSACTION');
        $objPHPExcel->getActiveSheet(0)->setCellValue('A2', 'CLOSING DATE');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B2', 'AREA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C2', 'ID');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D2', 'VENDOR');
        $objPHPExcel->getActiveSheet(0)->setCellValue('E2', 'BUYER');
        $objPHPExcel->getActiveSheet(0)->setCellValue('F2', 'DEAL PRICE');
        $objPHPExcel->getActiveSheet(0)->setCellValue('G2', 'COMMISION TOTAL');
		
		
		$objPHPExcel->getActiveSheet(0)->mergeCells('H1:I1');
        $objPHPExcel->getActiveSheet(0)->setCellValue('H1', 'SELLING');
		$objPHPExcel->getActiveSheet(0)->setCellValue('H2', 'MEMBER');
        $objPHPExcel->getActiveSheet(0)->setCellValue('I2', 'COMMISION');
      
	  
		$objPHPExcel->getActiveSheet(0)->mergeCells('J1:K1');
        $objPHPExcel->getActiveSheet(0)->setCellValue('J1', 'LISTING');
		$objPHPExcel->getActiveSheet(0)->setCellValue('J2', 'MEMBER');
        $objPHPExcel->getActiveSheet(0)->setCellValue('K2', 'COMMISION');
		
        $objPHPExcel->getActiveSheet(0)->setCellValue('L1', 'NOTE');
      

//make a border column
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:L1')->applyFromArray($style);
        $objPHPExcel->getActiveSheet(0)->getStyle('A2:L2')->applyFromArray($style);

        $database = $this->_ajax_selling();
        $shit = 2;
        $database = $this->db->query($database)->result();
        foreach ($database as $val) {
            $shit++;
			if($this->reff->getNamaPelanggan(isset($val->id_pelanggan)?($val->id_pelanggan):""))
			{
			$buyer=$this->reff->getNamaPelanggan(isset($val->id_pelanggan)?($val->id_pelanggan):"");
			}else{
			$buyer=$val->id_pelanggan;
			}
			
			$kp="";	$kpl= $kps="";
			
			if($val->sumber_selling=="1")
			{
				$ejen=$this->reff->getNamaAgen($val->selling);
				$ks=$val->nominal_komisi_selling;
			}else{
				$ejen=$val->selling;
				$ks="";
			}
			
			
				$ejenListing=$val->kode_agen;
			if($val->sumber_listing=="1")
			{
				$ejenListing=$this->reff->getNamaAgen($val->kode_agen);
				$kl=$val->nominal_komisi_listing;
			}else{
				$kl="";
			} 
			
			
			if($val->komisi_persen){
				//$kp=$val->komisi_persen."%";
				$kp="";
			}
			
//create data per row
           $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $shit . '', $this->tanggal->ind($val->tgl_closing,"/"));
           $objPHPExcel->getActiveSheet(0)->setCellValue('B' . $shit . '', $this->reff->getAlamatListingByKode($val->kode_listing));
           $objPHPExcel->getActiveSheet(0)->setCellValue('C' . $shit . '', $val->kode_listing);
           $objPHPExcel->getActiveSheet(0)->setCellValue('D' . $shit . '', $this->reff->getNamaOwnerByListing($val->kode_listing));
           $objPHPExcel->getActiveSheet(0)->setCellValue('E' . $shit . '', $buyer);
           $objPHPExcel->getActiveSheet(0)->setCellValue('F' . $shit . '', $val->harga);
           $objPHPExcel->getActiveSheet(0)->setCellValue('G' . $shit . '', $val->total_komisi);
           $objPHPExcel->getActiveSheet(0)->setCellValue('H' . $shit . '', $ejenListing);
           $objPHPExcel->getActiveSheet(0)->setCellValue('I' . $shit . '', $kpl."". $kl);
           $objPHPExcel->getActiveSheet(0)->setCellValue('J' . $shit . '', $ejen);
           $objPHPExcel->getActiveSheet(0)->setCellValue('K' . $shit . '', $kps."". $ks);
           $objPHPExcel->getActiveSheet(0)->setCellValue('L' . $shit . '', $val->ket);

 
        }

//auto size column
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);


// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('TRANSACTION');
        
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="TRANSACTION.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
//////finish
    
	}
 
	function saveStatus($id,$sts)
	{
		$this->db->set("status_profile",$sts);
		$this->db->where("id_agen",$id);
	return	$this->db->update("data_agen");
	}

}