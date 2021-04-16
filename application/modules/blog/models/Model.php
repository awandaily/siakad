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
	 function get_open_peraturan()
	{
		$query=$this->_get_datatables_peraturan();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file_peraturan()
	{				
		$query = $this->_get_datatables_open();
        return  $this->db->query($query)->num_rows();
	} 
	
	function get_open_ghalery()
	{
		$query=$this->_get_datatables_open_ghalery();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file_ghalery()
	{				
		$query = $this->_get_datatables_open_ghalery();
        return  $this->db->query($query)->num_rows();
	}
	  function dataProfile()
	 {
		$idu=$this->session->userdata("id");
		$this->db->where("id_admin",$idu);
		return $this->db->get("admin")->row();
		 
	 }
	private function _get_datatables_open_ghalery()
	{
	 
	$query="select * from tm_ghalery    WHERE 1=1    ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			judul LIKE '%".$searchkey."%' or  
			konten LIKE '%".$searchkey."%'  
			) ";
		}

		$column = array('', 'judul','tag'  );
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
	
	}	///-----------------------------------ajax//
 
 
 private function _get_datatables_open()
	{
	 
	$query="select * from tm_berita    WHERE 1=1  ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			judul LIKE '%".$searchkey."%' or  
			konten LIKE '%".$searchkey."%'  
			) ";
		}

		$column = array('', 'judul','tag'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by dilombakan   DESC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}	///-----------------------------------ajax//
 
 
 
 
 private function _get_datatables_peraturan()
	{
	 
	$query="select * from tm_peraturan    WHERE 1=1  ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			judul LIKE '%".$searchkey."%' or  
			konten LIKE '%".$searchkey."%'  
			) ";
		}

		$column = array('', 'judul','tag'  );
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
	
	}	///-----------------------------------ajax//
 
 
 
 
	function update_artikel()
	{	
		$var=array();
		$var["size"]=""; 
		$var["file"]="";
		$var["validasi"]=false; 
	
		$id=$this->input->post("id_artikel");
		$idu=$this->session->userdata("id");
		$input=$this->input->post("form");
	//	$input=unset($input['file']);
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["poto"]['tmp_name']))
		{
			$file=$this->upload_file("poto","thumbnail",$idu,$id);
			if($file["validasi"]!=false)
			{
				$this->db->set("thumbnail",$file["name"]);
			 	$this->db->set("cuid",$idu);
				$this->db->set("upd",date("Y-m-d H:i:s"));
				$this->db->where("id",$id);
				$this->db->update("tm_berita",$data);
				return $file;
			}else{
			return $file;
			}
		}else{
				$var["validasi"]="true"; 
				$this->db->set("cuid",$idu);
				$this->db->set("upd",date("Y-m-d H:i:s"));
				$this->db->where("id",$id);
				$this->db->update("tm_berita",$data);
				return $var;
		}
		
	}
	
	
	function update_peraturan()
	{	
		$var=array();
		$var["size"]=""; 
		$var["file"]="";
		$var["validasi"]=false; 
	
		$id=$this->input->post("id_artikel");
		$idu=$this->session->userdata("id");
		$input=$this->input->post("form");
		$data=$this->security->xss_clean($input);
				$var["validasi"]="true"; 
				$this->db->set("cuid",$idu);
				$this->db->set("upd",date("Y-m-d H:i:s"));
				$this->db->where("id",$id);
				$this->db->update("tm_peraturan",$data);
				return $var;
	
	}
	
	
	
	function update_artikel_ghalery()
	{	
		$var=array();
		$var["size"]=""; 
		$var["file"]="";
		$var["validasi"]=false; 
		$idu=$this->session->userdata("id");
		$id=$this->input->post("id_artikel");
	 
		$input=$this->input->post("form");
	//	$input=unset($input['file']);
		$data=$this->security->xss_clean($input);
		if(isset($_FILES["poto"]['tmp_name']))
		{
			$file=$this->upload_file("poto","ghalery",$idu,$id,"tm_ghalery");
			if($file["validasi"]!=false)
			{
				$this->db->set("thumbnail",$file["name"]);
				$this->db->set("cuid",$idu);
				$this->db->set("upd",date("Y-m-d H:i:s"));
				$this->db->where("id",$id);
				$this->db->update("tm_ghalery",$data);
				return $file;
			}else{
			return $file;
			}
		}else{
				$var["validasi"]="true"; 
				$this->db->set("cuid",$idu);
				$this->db->set("upd",date("Y-m-d H:i:s"));
				$this->db->where("id",$id);
				$this->db->update("tm_ghalery",$data);
				return $var;
		}
		
	}
	
	
	
	
	
	
	
	function save_ghalery()
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
			$file=$this->upload_file("poto","ghalery",$idu);
			if($file["validasi"]!=false)
			{
				$this->db->set("thumbnail",$file["name"]);
				$this->db->set("id_admin",$idu);
				$this->db->insert("tm_ghalery",$data);
				return $file;
			}else{
			return $file;
			}
		}else{
				return $var;
		}
		
	}
	
	
	
	
	
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
				$this->db->insert("tm_berita",$data);
				return $file;
			}else{
			return $file;
			}
		}else{
				return $var;
		}
		
	}
	
	function upload_file($form,$dok,$idu,$id=null,$tabel="tm_berita")
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
				if($id)
				{
					$namapotoid=$this->m_reff->goField($tabel,"thumbnail","where id='".$id."'");
					$file_namapotoid="file_upload/".$dok."/".$namapotoid."";
					if(file_exists($file_namapotoid))
					{
						unlink($file_namapotoid);
					}
				}
			
			 }
			$var["name"]=$nama;
		 }
		 return $var;
	}
	
	function hapus($id)
	{	 
		$file=$this->m_reff->goField("tm_berita","thumbnail","where id='".$id."'");
		$this->hapus_gambar("thumbnail",$file);
		$this->db->where("id",$id);
	 return	$this->db->delete("tm_berita");
 		
	}
	function hapus_ghalery($id)
	{	 
			$file=$this->m_reff->goField("tm_ghalery","thumbnail","where id='".$id."'");
			$this->hapus_gambar("ghalery",$file);
			$this->db->where("id",$id);
	return	$this->db->delete("tm_ghalery");
		
	}
	
	function hapus_peraturan($id)
	{	 
			$this->db->where("id",$id);
	return	$this->db->delete("tm_peraturan");
	}
	
	function hapus_gambar($dok,$file)
	{
		$path="file_upload/".$dok."/".$file;
		if(file_exists($path))
		{
			unlink($path);
		}
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
	
	function getArtikel($id)
	{
			 
			   $this->db->where("id",$id);
		return $this->db->get("tm_berita")->row();
		 	
	}
	function getArtikelGhalery($id)
	{
			 
			   $this->db->where("id",$id);
		return $this->db->get("tm_ghalery")->row();
		 	
	}
	function getArtikelPeraturan($id)
	{
			 
			   $this->db->where("id",$id);
		return $this->db->get("tm_peraturan")->row();
		 	
	}
	
	/* --------------------------------------------- */
	
	function t_peserta($minat=null,$idm=null,$jk=null)
	{
		if($minat!=null)
		{
			$this->db->where("posisi_peminatan",$minat);
		}	
		
		if($idm!=null)
		{
			 
			$this->db->where("madrasah_peminatan",$idm);
		}

		if($jk!=null)
		{
			 
			$this->db->where("jk",$jk);
		}			
		 
		return $this->db->get("tm_peserta")->num_rows();
	}
	 function t_peserta_jk($jk)
	{		
		$this->db->where("jk",$jk);
		return $this->db->get("tm_peserta")->num_rows();
	}

}

/* <ul class="webwidget_rating_sex">
  <li style="background-image: url(&quot;images//web_widget_star.gif&quot;); background-position: 0px -28px;"><span>1</span></li>
  <li style="background-image: url(&quot;images//web_widget_star.gif&quot;); background-position: 0px -28px;"><span>2</span></li>
  <li style="background-image: url(&quot;images//web_widget_star.gif&quot;); background-position: 0px -28px;"><span>3</span></li>
  <li style="background-image: url(&quot;images//web_widget_star.gif&quot;); background-position: 0px 0px;"><span>4</span></li>
  </ul>*/