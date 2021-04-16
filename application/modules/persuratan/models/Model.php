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

	function getForm(){
		$id = $_POST["id"];

		$form = $this->m_reff->goField("tm_persuratan", "form", "WHERE id='".$id."'");

		return $form;
	}

	function getSiswa(){
		$this->db->order_by("nama", "asc");
		$this->db->where_in("id_sts_data", array("1", "4"));
		$d = $this->db->get("data_siswa")->result();

		return $d;
	}

	function getPegawai(){
		$this->db->order_by("nama", "asc");
		//$this->db->where_in("id_sts_data", array("1", "4"));
		$d = $this->db->get("data_pegawai")->result();

		return $d;
	}

	function save(){
		$id = $_POST["edit_id"];

		if ($id == "") {
			
			//$f = $this->security->xss_clean($this->input->post("f"));

			$f = $_POST["f"];
			$this->db->set("template", $_POST["template"]);
			$this->db->set("_ctime", date("Y-m-d H:i:s"));
			$this->db->set("_cid", $this->idu());
			return $this->db->insert("tm_persuratan", $f);
		}
		else{
			//$f = $this->security->xss_clean($this->input->post("f"));
			$f = $_POST["f"];
			
			$this->db->set("template", $_POST["template"]);
			$this->db->set("_utime", date("Y-m-d H:i:s"));
			$this->db->set("_uid", $this->idu());
			$this->db->where("id", $id);
			return $this->db->update("tm_persuratan", $f);

		}
	}

	function delete(){
		$id = $_POST["id"];

		//$this->db->set("_del", "1");
		$this->db->where("id", $id);
		return $this->db->delete("tm_persuratan");
	}
	
	function get_data(){
		$query=$this->_get_data();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data(){
		$filter="";
		$query="select * from tm_persuratan where 1=1 ".$filter;
			if($_POST['search']['value']){
			$searchkey=$_POST['search']['value'];
				$query.=" AND (
						nama_surat LIKE '%".$searchkey."%'
				) ";
			}

		$column = array('', 'nama_surat'  );
		$i=0;
		foreach ($column as $item) 
		{
		$column[$i] = $item;
		}
		
		if(isset($_POST['order']))
		{
		$query.=" order by nama_surat ASC";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	}
	
	public function count(){				
		$query = $this->_get_data();
        return  $this->db->query($query)->num_rows();
	}
	
	
}