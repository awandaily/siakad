<?php

class Model extends CI_Model  {
    
	var $tbl="";
 
 	function __construct()
    {
        parent::__construct();
    }
	function idu()
	{
		return $this->session->userdata("id");
	}

	function get_tanah(){
		$this->db->order_by("nama_tanah", "asc");
		$x = $this->db->get("tm_aset_tanah")->result();

		return $x;
	}

	function total_aset(){
		$tnh = $this->db->get("tm_aset_tanah")->num_rows();
		$bng = $this->db->get("tm_aset_bangunan")->num_rows();
		$rng = $this->db->get("tm_aset_ruangan")->num_rows();
		$brg = $this->db->get("tm_aset_barang")->num_rows();

		$total = array(
				"tnh"	=> $tnh,
				"bng"	=> $bng,
				"rng"	=> $rng,
				"brg"	=> $brg
			);

		return $total;
	}

	function get_bangunan_by_tanah($id){
		$this->db->where("idtanah", $id);
		$this->db->order_by("nama_bangunan", "asc");
		$x = $this->db->get("tm_aset_bangunan")->result();
		return $x;
	}

	function get_ruangan_by_bangunan($id){
		$this->db->where("idbangunan", $id);
		$this->db->order_by("nama_ruangan", "asc");
		$x = $this->db->get("tm_aset_ruangan")->result();
		return $x;
	}

	function get_barang_by_ruangan($id){
		$this->db->where("idruangan", $id);
		$this->db->order_by("nama_barang", "asc");
		$x = $this->db->get("tm_aset_barang")->result();
		return $x;
	}

	function get_data_barang()
	{
		$query=$this->_get_data_barang();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_barang()
	{
		   
		 
		  
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="SELECT tm_aset_barang.*, tm_aset_ruangan.id AS ruangan_id, tm_aset_ruangan.nama_ruangan FROM tm_aset_barang, tm_aset_ruangan WHERE tm_aset_barang.idruangan = tm_aset_ruangan.id ";

		if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
			$query.=" AND (
				tm_aset_barang.nama_barang LIKE '%".$searchkey."%' or 
				tm_aset_ruangan.nama_ruangan LIKE '%".$searchkey."%'
			) ";
		}

		$column = array('', 'nama_barang', 'nama_ruangan', '',  'keterangan'  );
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

	function get_data_barang_full()
	{
		$query=$this->_get_data_barang_full();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}

	function _get_data_barang_full()
	{
		   
		 
		  
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="
				SELECT 
					tm_aset_barang.*, 
					tm_aset_ruangan.id AS ruangan_id, 
					tm_aset_ruangan.nama_ruangan,
					tm_aset_bangunan.id AS bangunan_id,
					tm_aset_bangunan.nama_bangunan,
					tm_aset_tanah.id AS tanah_id,
					tm_aset_tanah.nama_tanah 
				FROM 
					tm_aset_barang, 
					tm_aset_ruangan,
					tm_aset_bangunan,
					tm_aset_tanah 
				WHERE 
					tm_aset_barang.idruangan = tm_aset_ruangan.id AND
					tm_aset_ruangan.idbangunan = tm_aset_bangunan.id AND
					tm_aset_bangunan.idtanah = tm_aset_tanah.id 
		";



		if ($_POST["src_kondisi"]!="") {
			switch ($_POST["src_kondisi"]) {
				case 'baik':
					$query.=" AND tm_aset_barang.qty_rusak='0' ";
				break;
				case "rusak":
					$query.=" AND tm_aset_barang.qty_rusak!='0' ";
				break;
				
				default:
					$query.="  ";
				break;
			}
		}
		if ($_POST["src_tanah"]!="") {
			$query.=" AND tm_aset_tanah.id='".$_POST['src_tanah']."' ";
		}
		if ($_POST["src_bangunan"]!="") {
			$query.=" AND tm_aset_bangunan.id='".$_POST['src_bangunan']."' ";
		}
		if ($_POST["src_ruangan"]!="") {
			$query.=" AND tm_aset_ruangan.id='".$_POST['src_ruangan']."' ";
		}
		if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
			$query.=" AND (
				tm_aset_barang.nama_barang LIKE '%".$searchkey."%'
			) ";
		}

		$column = array('', 'nama_barang', 'nama_ruangan', '',  'keterangan'  );
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

	
	public function count_barang_full()
	{				
		$query = $this->_get_data_barang_full();
        return  $this->db->query($query)->num_rows();
	}

	public function count_barang()
	{				
		$query = $this->_get_data_barang();
        return  $this->db->query($query)->num_rows();
	}

	function get_data_ruangan()
	{
		$query=$this->_get_data_ruangan();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_ruangan()
	{
		   
		 
		  
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="SELECT tm_aset_ruangan.*, tm_aset_bangunan.id AS bangunan_id, tm_aset_bangunan.nama_bangunan FROM tm_aset_ruangan, tm_aset_bangunan WHERE tm_aset_ruangan.idbangunan = tm_aset_bangunan.id ";

		if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
			$query.=" AND (
				tm_aset_bangunan.nama_bangunan LIKE '%".$searchkey."%' or 
				tm_aset_ruangan.nama_ruangan LIKE '%".$searchkey."%'
			) ";
		}

		$column = array('', 'nama_ruangan', 'nama_bangunan', 'keterangan'  );
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

	
	public function count_ruangan()
	{				
		$query = $this->_get_data_ruangan();
        return  $this->db->query($query)->num_rows();
	}

	function get_data_bangunan()
	{
		$query=$this->_get_data_bangunan();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_bangunan()
	{
		   
		 
		  
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="SELECT tm_aset_bangunan.*, tm_aset_tanah.id AS tanah_id, tm_aset_tanah.nama_tanah FROM tm_aset_bangunan, tm_aset_tanah WHERE tm_aset_bangunan.idtanah = tm_aset_tanah.id ";

		if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
			$query.=" AND (
				tm_aset_bangunan.nama_bangunan LIKE '%".$searchkey."%' or 
				tm_aset_tanah.nama_tanah LIKE '%".$searchkey."%'
			) ";
		}

		$column = array('', 'nama_bangunan', 'nama_tanah', 'keterangan'  );
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

	
	public function count_bangunan()
	{				
		$query = $this->_get_data_bangunan();
        return  $this->db->query($query)->num_rows();
	}
	 
	function get_data_tanah()
	{
		$query=$this->_get_data_tanah();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_tanah()
	{
		   
		 
		  
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="SELECT * FROM tm_aset_tanah WHERE id!='' ";

		if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
			$query.=" AND (
			tm_aset_tanah.nama_tanah LIKE '%".$searchkey."%'  or
			tm_aset_tanah.atas_nama LIKE '%".$searchkey."%' or   
			) ";
		}

		$column = array('', 'nama_tanah'  );
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

	
	public function count_tanah()
	{				
		$query = $this->_get_data_tanah();
        return  $this->db->query($query)->num_rows();
	}
	public function tanah_save()
	{	
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		//$this->db->set("id_tahun",$tahun);
		//$this->db->set("id_semester",$sms);
	 	return $this->db->insert("tm_aset_tanah",$post);
		
	}

	function tanah_update()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();

		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->where("id",$this->input->post("edit_id"));
	 	return $this->db->update("tm_aset_tanah",$post);
	}
	function tanah_delete($id)
	{
		 
		$this->db->where("id",$id);
		return $this->db->delete("tm_aset_tanah");
	}
	public function bangunan_save()
	{	
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		//$this->db->set("id_tahun",$tahun);
		//$this->db->set("id_semester",$sms);
	 	return $this->db->insert("tm_aset_bangunan",$post);
		
	}

	function bangunan_update()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();

		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->where("id",$this->input->post("edit_id_bangunan"));
	 	return $this->db->update("tm_aset_bangunan",$post);
	}
	function bangunan_delete($id)
	{
		 
		$this->db->where("id",$id);
		return $this->db->delete("tm_aset_bangunan");
	}

	public function ruangan_save()
	{	
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		//$this->db->set("id_tahun",$tahun);
		//$this->db->set("id_semester",$sms);
	 	return $this->db->insert("tm_aset_ruangan",$post);
		
	}

	function ruangan_update()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();

		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->where("id",$this->input->post("edit_id_ruangan"));
	 	return $this->db->update("tm_aset_ruangan",$post);
	}
	function ruangan_delete($id)
	{
		 
		$this->db->where("id",$id);
		return $this->db->delete("tm_aset_ruangan");
	}

	public function barang_save()
	{	
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		//$this->db->set("id_tahun",$tahun);
		//$this->db->set("id_semester",$sms);
	 	return $this->db->insert("tm_aset_barang",$post);
		
	}

	function barang_update()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();

		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		$this->db->where("id",$this->input->post("edit_id_barang"));
	 	return $this->db->update("tm_aset_barang",$post);
	}
	function barang_delete($id)
	{
		 
		$this->db->where("id",$id);
		return $this->db->delete("tm_aset_barang");
	}
	

}