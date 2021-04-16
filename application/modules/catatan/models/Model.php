<?php

class Model extends CI_Model  {
    
	var $tbl="tm_catatan";
 
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
	
	 
	function dataKelas()
	{
		$data=$this->db->select("DISTINCT(id_kelas) as id_kelas");
		$this->db->order_by("id_kelas","asc");
		return $this->db->get($this->tbl_jadwal)->result();
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
		$id_jenis=$this->input->post("id_jenis");
		$ke_bp=$this->input->post("ke_bp");
		$id_siswa=$this->input->post("id_siswa");
		  
		$filter="";
		if($ke_bp)
		{
			if($ke_bp==4)
			{
				$filter.="AND teruskan='' ";
			}else{
				$filter.="AND teruskan like '%".$ke_bp."%' ";
			}
		}
		
		
		if($id_siswa)
		{
			$filter.="AND id_siswa='".$id_siswa."' ";
		}
		if($id_kelas)
		{
			$filter.="AND id_kelas='".$id_kelas."' ";
		}
		if($id_jenis)
		{
			$filter.="AND id_jenis='".$id_jenis."' ";
		}
		
		$id_guru=$this->idu();
		 
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select * from ".$this->tbl." where id_guru=".$id_guru." and id_tahun='".$tahun."' and id_semester='".$sms."'  $filter ";
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				 
				ket LIKE '%".$searchkey."%'  
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
	
	public function count()
	{				
		$query = $this->_get_data();
        return  $this->db->query($query)->num_rows();
	}
	function insert_catatan()
	{	

		$config['upload_path']      = './file_upload/bukti/';
        $config['allowed_types']    = 'JPG|PNG|GIF|JPEG|jpeg|png|jpg|gif';
        $config["overwrite"]        = TRUE;
        $config['encrypt_name'] 	= TRUE;

        $this->load->library('upload', $config);

        $s1=$this->upload->do_upload('bukti');
        $g1 =$this->upload->data();

		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("id_semester",$sms);
		$this->db->set("id_guru",$this->idu());

        if($s1){
        	$this->db->set("file_bukti", "file_upload/bukti/".$g1["file_name"]);
        }
        else{
        	//$this->set("file_bukti", "");
        }

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


		if(strpos($c,"2")!==false){
			$id_siswa=$this->input->post("f[id_siswa]");
			$nomor=$this->m_reff->goField("v_siswa","hp_ibu","where id='".$id_siswa."'");
			$pesan="[INFO SMK]". $this->input->post("f[ket]");
			$this->sms->dikirim($nomor,$pesan,$source="catatan_guru",$modem=null);
		}
		return true;
		
	}
	function update_catatan()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->set("id_tahun",$tahun);
		$this->db->set("id_semester",$sms);

		$config['upload_path']      = './file_upload/bukti/';
        $config['allowed_types']    = 'JPG|PNG|GIF|JPEG|jpeg|png|jpg|gif';
        $config["overwrite"]        = TRUE;
        $config['encrypt_name'] 	= TRUE;

        $this->load->library('upload', $config);

        $s1=$this->upload->do_upload('bukti');
        $g1 =$this->upload->data();

        if($s1){
        	$this->db->set("file_bukti", "file_upload/bukti/".$g1["file_name"]);
        }
        else{
        	//$this->set("file_bukti", "");
        }


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
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id",$this->input->post("id"));

	return	$this->db->update("tm_catatan",$post);
	}
	function hapus_catatan($id)
	{
		$nama_file = $this->m_reff->goField("tm_catatan", "file_bukti", "WHERE id = '".$id."' ");
		$this->m_reff->hapus_file($nama_file);
		
		$this->db->where("id_guru",$this->idu());
		$this->db->where("id",$id);
		return $this->db->delete("tm_catatan");

	}
}