<?php

class Model extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }
	
	 function get_open()
	{
		$query=$this->_get_datatables_open();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file()
	{				
		$query = $this->_get_datatables_open();
        return  $this->db->query($query)->num_rows();
	}
	  function dataProfile()
	 {
		$idu=$this->session->userdata("id");
		$this->db->where("id_admin",$idu);
		return $this->db->get("admin")->row();
		 
	 }
	private function _get_datatables_open()
	{
	$id_madrasah=$this->input->post("id_madrasah");
	$jk=$this->input->post("jk");
	$posisi=$this->input->post("posisi");
	$mapel=$this->input->post("mapel");
	$status_kelulusan=$this->input->post("status_kelulusan");
	$filter="";
	if($id_madrasah)
	{
		$filter.="AND madrasah_peminatan='".$id_madrasah."' ";
	} 
	if($status_kelulusan)
	{
		$filter.="AND sts='".$status_kelulusan."' ";
	} 
	
	if($jk)
	{
		$filter.="AND jk='".$jk."' ";
	}
	
	if($posisi)
	{
		$filter.="AND posisi_peminatan='".$posisi."' ";
	}
	
	if($mapel)
	{
		$filter.="AND mapel_yg_diampu='".$mapel."' ";
	}
	 
	$query="select * from tm_peserta where sts NOT IN(0,1)  $filter ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			nama LIKE '%".$searchkey."%' or  
			hp LIKE '%".$searchkey."%'  
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
		$query.=" order by tgl   DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}	///-----------------------------------ajax//
 
	function save_artikel()
	{	
		$var=array();
		$var["size"]=""; 
		$var["file"]="";
		$var["validasi"]=false; 
	
		$idu=$this->session->userdata("id");
		$input=$this->input->post("f");
	//	$input=unset($input['file']);
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["poto"]['tmp_name']))
		{
			$file=$this->upload_file("poto","thumbnail",$idu);
			if($file["validasi"]!=false)
			{
				$this->db->set("thumbnail",$file["name"]);
				$this->db->set("id_admin",$idu);
				$this->db->insert("tm_artikel",$data);
				return $file;
			}else{
			return $file;
			}
		}else{
				return $var;
		}
		
	}
	
	function upload_file($form,$dok,$idu)
	{		
	$var=array();
	$var["size"]=""; 
	$var["file"]="";
	$var["validasi"]=false; 
	
		$nama=date("YmdHis")."_".$idu."_";
		  $lokasi_file = $_FILES[$form]['tmp_name'];
		  $tipe_file   = $_FILES[$form]['type'];
		  $nama_file   = $_FILES[$form]['name'];
		   $size  	   = $_FILES[$form]['size'];
			$nama_file=str_replace(" ","_",$nama_file);
			// $jenis="jpg";
			$nama=str_replace("/","",$nama."_".$nama_file);
			 $target_path = "file_upload/".$dok."/".$nama;
			 
			  $ex=substr($nama_file,-3);
			$extention=str_replace(" ","_",strtoupper($ex));
			
		 $maxsize = 3000000;
		 if($size>=$maxsize)
		 {
			$var["size"]=$size; 
		 }elseif($extention!="JPG" AND $extention!="PNG"){
			$var["file"]=$extention;
		 }else{
		 	$var["validasi"]=true;
			if (!empty($lokasi_file)) {
			move_uploaded_file($lokasi_file,$target_path);
			 }
			$var["name"]=$nama;
		 }
		 return $var;
	}
	
	function hapus($id)
	{	$idu=$this->session->userdata("id");
		$this->db->where("id",$id);
		$this->db->where("id_admin",$idu);
		$this->db->delete("tm_artikel");
		
		$this->db->where("id_artikel",$id);
		$this->db->where("id_admin",$idu);
		$this->db->delete("tm_komentar");
		
		$this->db->where("id_artikel",$id);
		$this->db->where("id_admin",$idu);
	return	$this->db->delete("tm_pengunjung");
		
	}
	
	function bintang($id)
	{	$idu=$this->session->userdata("id");
		$this->db->where("id",$id);
		$this->db->where("id_admin",$idu);
		$this->db->select("sum(jml_bintang) as jml");
		$da=$this->db->get("tm_bintang")->row();
	return isset($da->jml)?($da->jml):0;	
	}
	
	function komentar($id)
	{	$idu=$this->session->userdata("id");
		$this->db->where("id",$id);
		$this->db->where("id_admin",$idu);
		$da=$this->db->get("tm_komentar")->num_rows();
	return isset($da)?($da):0;	
	}
	
	function getPeserta($id)
	{
			 
			   $this->db->where("id",$id);
		return $this->db->get("tm_peserta")->row();
		 	
	}
	function set_point($id,$point)
	{	
		$idu=$this->session->userdata("id");
		$this->db->where("id",$id);
		$this->db->set("point",$point);
		$this->db->set("v_point",$idu);
	return	$this->db->update("tm_artikel");
	}
	
	function hapus_artikel($id,$nama)
	{		
			$this->m_konfig->log("tm_artikel","Hapus artikel '".$nama."' saat pertinjai");
			$this->db->where("id",$id);
	return	$this->db->delete("tm_artikel");
	}
	function terbitkan_artikel($id,$nama)
	{		$idu=$this->session->userdata("id");
			$this->m_konfig->log("tm_artikel","terbitkan artikel '".$nama."' ");
			$this->db->where("id",$id);
			$this->db->set("sts",3);
			$this->db->set("v_publish",$idu);
	return	$this->db->update("tm_artikel");
	}
 
	function tolak_artikel($id,$nama,$alasan)
	{		$alasan=$this->security->xss_clean($alasan);
			$this->m_konfig->log("tm_artikel","tolak artikel '".$nama."' ");
			$this->db->where("id",$id);
			$this->db->set("sts",4);
			$this->db->set("alasan",$alasan);
	return	$this->db->update("tm_artikel");
	}
	function blokir($id)
	{		$nama=$this->m_reff->goField("admin","owner","where id_admin='".$id."'");
			$this->m_konfig->log("admin","Blokir pengguna '".$nama."' ");
			$this->db->where("id_admin",$id);
			$this->db->set("sts_aktif",2);
	return	$this->db->update("admin");
	}

}

/* <ul class="webwidget_rating_sex">
  <li style="background-image: url(&quot;images//web_widget_star.gif&quot;); background-position: 0px -28px;"><span>1</span></li>
  <li style="background-image: url(&quot;images//web_widget_star.gif&quot;); background-position: 0px -28px;"><span>2</span></li>
  <li style="background-image: url(&quot;images//web_widget_star.gif&quot;); background-position: 0px -28px;"><span>3</span></li>
  <li style="background-image: url(&quot;images//web_widget_star.gif&quot;); background-position: 0px 0px;"><span>4</span></li>
  </ul>*/