<?php

class Model extends CI_Model  {
    
	var $tbl="tr_mitra";
 
 	function __construct()
    {
        parent::__construct();
    }
    function getNamaKel($id=null)
    {
      return  $this->m_reff->goField("wil_kelurahan","nama","where id_kel='".$id."' ");
    }
     function getNamaKab($id=null)
    {
      return  $this->m_reff->goField("wil_kabupaten","nama","where id_kab='".$id."' ");
    }
     function getNamaKec($id=null)
    {
      return  $this->m_reff->goField("wil_kecamatan","nama","where id_kec='".$id."' ");
    }
     function getNamaProv($id=null)
    {
      return  $this->m_reff->goField("wil_provinsi","nama","where id_prov='".$id."' ");
    }
	function idu()
	{
		return $this->session->userdata("id");
	}
    public function toTglSys($v){
        $tgl = substr($v, 0,2);
        $bln = substr($v, 3,2);
        $thn = substr($v, 6,4);

        return $thn."-".$bln."-".$tgl;
    }
	function upload_mou(){
		 

		$lama = $this->input->post('f[lama_pkl]');
		$tgl  = $this->toTglSys($this->input->post('tgl_berangkat'));

		if(isset($_FILES["mou"]['tmp_name'])){
		 
		 
			$config['upload_path']      = './file_upload/mou/';
	        $config['allowed_types']    = '*';
	        $config["overwrite"]        = TRUE;
	        $config['encrypt_name'] 	= TRUE;

	        $this->load->library('upload', $config);

	        $s1=$this->upload->do_upload('mou');
	        $g1 =$this->upload->data();
	        if($s1){

	            
	            $sms=$this->m_reff->semester();
				$tahun=$this->m_reff->tahun();
			 
	            $kode=substr(str_shuffle("123456789234567891ABCDEFGHIJKLMNPQRSTUVWXYZ"),0,5);
			 	$dt = array(
			 			"mou"			=> "file_upload/mou/".$g1["file_name"],
			 			"quota"			=> $this->input->post('f[quota]'),
			 			"ket"			=> $this->input->post('f[ket]'),
			 			"id_pembimbing"	=> $this->input->post('f[id_pembimbing]'),
			 			"lama_pkl"		=> $this->input->post('f[lama_pkl]'),
			 			"no_mou"		=> $this->input->post('f[no_mou]'),
			 			"judul_mou"		=> $this->input->post('f[judul_mou]'),
			 			"tgl_awal_mou"		=> $this->toTglSys($this->input->post('f[tgl_awal_mou]')),
			 			"tgl_akhir_mou"		=> $this->toTglSys($this->input->post('f[tgl_akhir_mou]')),
			 			"tgl_berangkat"	=> $this->toTglSys($this->input->post('tgl_berangkat')),
			 			"id_mitra"		=> $this->input->post('id'),
			 			"id_semester"	=> $sms,
			 		//	"kode"      	=> $kode,
			 			"id_tahun"		=> $tahun

			 		);
					if($lama==1){
					     $tgl_trim=strtotime($tgl);
					     $tgl_otw=$tgl;
					     $m_1=$this->tanggal->tambah_tgl($tgl,7);
					     
					     	$tgl_pulang= date('Y-m-d', strtotime('+1 months', $tgl_trim));
					         $this->db->set("monitoring1",$m_1);  
					          $this->db->set("monitoring2",null);
					          $this->db->set("monitoring3",null);
						      $this->db->set("monitoring4",null);
						      $this->db->set("monitoring5",null);
						      $this->db->set("monitoring6",null);
						         
					}elseif($lama==2){
					     $tgl_trim=strtotime($tgl);
					     $tgl_otw=$tgl;
					     $m_1=$this->tanggal->tambah_tgl($tgl,7);
					     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
					   
					     $tgl_pulang= date('Y-m-d', strtotime('+2 months', $tgl_trim));
					         $this->db->set("monitoring1",$m_1); 
						        $this->db->set("monitoring2",$m_2);
						       
					          $this->db->set("monitoring3",null);
						      $this->db->set("monitoring4",null);
						      $this->db->set("monitoring5",null);
						      $this->db->set("monitoring6",null);
						         
					}elseif($lama==3){
					     $tgl_trim=strtotime($tgl);
					     $tgl_otw=$tgl;
					     $m_1=$this->tanggal->tambah_tgl($tgl,7);
					     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
					     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
					     $tgl_pulang= date('Y-m-d', strtotime('+3 months', $tgl_trim));
					         $this->db->set("monitoring1",$m_1); 
						        $this->db->set("monitoring2",$m_2); 
						          $this->db->set("monitoring3",$m_3); 
						           $this->db->set("monitoring4",null);
						      $this->db->set("monitoring5",null);
						      $this->db->set("monitoring6",null);
					}elseif($lama==4){
					     $tgl_trim=strtotime($tgl);
					     $tgl_otw=$tgl;
					     $m_1=$this->tanggal->tambah_tgl($tgl,7);
					     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
					     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
					     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
					     $tgl_pulang= date('Y-m-d', strtotime('+4 months', $tgl_trim));
					     
					             $this->db->set("monitoring1",$m_1); 
						         $this->db->set("monitoring2",$m_2); 
						         $this->db->set("monitoring3",$m_3); 
						         $this->db->set("monitoring4",$m_4); 
						         $this->db->set("monitoring5",null);
						      	$this->db->set("monitoring6",null);
						          
					}elseif($lama==5){
					     $tgl_trim=strtotime($tgl);
					     $tgl_otw=$tgl;
					     $m_1=$this->tanggal->tambah_tgl($tgl,7);
					     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
					     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
					     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
					      $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
					     $tgl_pulang= date('Y-m-d', strtotime('+5 months', $tgl_trim));
					     
					             $this->db->set("monitoring1",$m_1); 
						         $this->db->set("monitoring2",$m_2); 
						         $this->db->set("monitoring3",$m_3); 
						         $this->db->set("monitoring4",$m_4); 
						         $this->db->set("monitoring5",$m_5); 
						          $this->db->set("monitoring6",null);
						          
					}else{
					     $tgl_trim=strtotime($tgl);
					     $tgl_otw=$tgl;
					     $m_1=$this->tanggal->tambah_tgl($tgl,7);
					     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
					     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
					     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
					     $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
					     $m_6= date('Y-m-d', strtotime('+5 months', $tgl_trim));     
					     $tgl_pulang= date('Y-m-d', strtotime('+'.$lama.' months', $tgl_trim));
					     
					             $this->db->set("monitoring1",$m_1); 
						         $this->db->set("monitoring2",$m_2); 
						         $this->db->set("monitoring3",$m_3); 
						         $this->db->set("monitoring4",$m_4); 
						         $this->db->set("monitoring5",$m_5);
						         $this->db->set("monitoring6",$m_6);
						          
					}
			 	$in = $this->db->insert("tr_mitra_quota", $dt);
			 	if ($in) {
			 		echo $_POST["id"];
			 	}
			 	else{
			 		echo "0";
			 	}
	        }
	        else{
	            return $this->upload->display_errors();
	        }
		 
				
		}
		else{
		 
            $sms=$this->m_reff->semester();
			$tahun=$this->m_reff->tahun(); 
		 	$dt = array(
		 		 
		 			"quota"			=> $this->input->post('f[quota]'),
		 			"ket"			=> $this->input->post('f[ket]'),
		 			"id_pembimbing"	=> $this->input->post('f[id_pembimbing]'),
		 			"lama_pkl"		=> $this->input->post('f[lama_pkl]'),
		 			"no_mou"		=> $this->input->post('f[no_mou]'),
		 			"judul_mou"		=> $this->input->post('f[judul_mou]'),
		 			"tgl_awal_mou"		=> $this->toTglSys($this->input->post('f[tgl_awal_mou]')),
		 			"tgl_akhir_mou"		=> $this->toTglSys($this->input->post('f[tgl_akhir_mou]')),
		 			"tgl_berangkat"	=> $this->toTglSys($this->input->post('tgl_berangkat')),
		 			"id_mitra"		=> $this->input->post('id'),
		 			"id_semester"	=> $sms, 
		 			"id_tahun"		=> $tahun

		 		);
				if($lama==1){
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     
				     	$tgl_pulang= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				         $this->db->set("monitoring1",$m_1);  
				          $this->db->set("monitoring2",null);
				          $this->db->set("monitoring3",null);
					      $this->db->set("monitoring4",null);
					      $this->db->set("monitoring5",null);
					      $this->db->set("monitoring6",null);
					         
				}elseif($lama==2){
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				   
				     $tgl_pulang= date('Y-m-d', strtotime('+2 months', $tgl_trim));
				         $this->db->set("monitoring1",$m_1); 
					        $this->db->set("monitoring2",$m_2);
					       
				          $this->db->set("monitoring3",null);
					      $this->db->set("monitoring4",null);
					      $this->db->set("monitoring5",null);
					      $this->db->set("monitoring6",null);
					         
				}elseif($lama==3){
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
				     $tgl_pulang= date('Y-m-d', strtotime('+3 months', $tgl_trim));
				         $this->db->set("monitoring1",$m_1); 
					        $this->db->set("monitoring2",$m_2); 
					          $this->db->set("monitoring3",$m_3); 
					           $this->db->set("monitoring4",null);
					      $this->db->set("monitoring5",null);
					      $this->db->set("monitoring6",null);
				}elseif($lama==4){
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
				     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
				     $tgl_pulang= date('Y-m-d', strtotime('+4 months', $tgl_trim));
				     
				             $this->db->set("monitoring1",$m_1); 
					         $this->db->set("monitoring2",$m_2); 
					         $this->db->set("monitoring3",$m_3); 
					         $this->db->set("monitoring4",$m_4); 
					         $this->db->set("monitoring5",null);
					      	$this->db->set("monitoring6",null);
					          
				}elseif($lama==5){
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
				     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
				      $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
				     $tgl_pulang= date('Y-m-d', strtotime('+5 months', $tgl_trim));
				     
				             $this->db->set("monitoring1",$m_1); 
					         $this->db->set("monitoring2",$m_2); 
					         $this->db->set("monitoring3",$m_3); 
					         $this->db->set("monitoring4",$m_4); 
					         $this->db->set("monitoring5",$m_5); 
					          $this->db->set("monitoring6",null);
					          
				}else{
				     $tgl_trim=strtotime($tgl);
				     $tgl_otw=$tgl;
				     $m_1=$this->tanggal->tambah_tgl($tgl,7);
				     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
				     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
				     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
				     $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
				     $m_6= date('Y-m-d', strtotime('+5 months', $tgl_trim));     
				     $tgl_pulang= date('Y-m-d', strtotime('+'.$lama.' months', $tgl_trim));
				     
				             $this->db->set("monitoring1",$m_1); 
					         $this->db->set("monitoring2",$m_2); 
					         $this->db->set("monitoring3",$m_3); 
					         $this->db->set("monitoring4",$m_4); 
					         $this->db->set("monitoring5",$m_5);
					         $this->db->set("monitoring6",$m_6);
					          
				}
				$this->db->set("tgl_pulang", $tgl_pulang);
		 	$in = $this->db->insert("tr_mitra_quota", $dt);
		 	if ($in) {
		 		echo $_POST["id"];
		 	}
		 	else{
		 		echo "0";
		 	}
        }

        //$this->setMonitoring("", $this->toTglSys($this->input->post('tgl_berangkat')), $this->input->post('f[lama_pkl]'), "insert");
         
		 

    }
    public function setMonitoring($id, $tgl_berangkat, $lama_pkl, $method){
		$tgl 	= $tgl_berangkat;
		//$tgl 	= $this->tanggal->eng_($tgl,"-");
		$lama 	= $lama_pkl;


		if ($lama!="" && $tgl!="0000-00-00") {

			if($lama==1){
			     $tgl_trim=strtotime($tgl);
			     $tgl_otw=$tgl;
			     $m_1=$this->tanggal->tambah_tgl($tgl,7);
			     
			     	$tgl_pulang= date('Y-m-d', strtotime('+1 months', $tgl_trim));
			         $this->db->set("monitoring1",$m_1);  
			          $this->db->set("monitoring2",null);
			          $this->db->set("monitoring3",null);
				      $this->db->set("monitoring4",null);
				      $this->db->set("monitoring5",null);
				      $this->db->set("monitoring6",null);
				         
			}elseif($lama==2){
			     $tgl_trim=strtotime($tgl);
			     $tgl_otw=$tgl;
			     $m_1=$this->tanggal->tambah_tgl($tgl,7);
			     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
			   
			     $tgl_pulang= date('Y-m-d', strtotime('+2 months', $tgl_trim));
			         $this->db->set("monitoring1",$m_1); 
				        $this->db->set("monitoring2",$m_2);
				       
			          $this->db->set("monitoring3",null);
				      $this->db->set("monitoring4",null);
				      $this->db->set("monitoring5",null);
				      $this->db->set("monitoring6",null);
				         
			}elseif($lama==3){
			     $tgl_trim=strtotime($tgl);
			     $tgl_otw=$tgl;
			     $m_1=$this->tanggal->tambah_tgl($tgl,7);
			     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
			     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
			     $tgl_pulang= date('Y-m-d', strtotime('+3 months', $tgl_trim));
			         $this->db->set("monitoring1",$m_1); 
				        $this->db->set("monitoring2",$m_2); 
				          $this->db->set("monitoring3",$m_3); 
				           $this->db->set("monitoring4",null);
				      $this->db->set("monitoring5",null);
				      $this->db->set("monitoring6",null);
			}elseif($lama==4){
			     $tgl_trim=strtotime($tgl);
			     $tgl_otw=$tgl;
			     $m_1=$this->tanggal->tambah_tgl($tgl,7);
			     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
			     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
			     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
			     $tgl_pulang= date('Y-m-d', strtotime('+4 months', $tgl_trim));
			     
			             $this->db->set("monitoring1",$m_1); 
				         $this->db->set("monitoring2",$m_2); 
				         $this->db->set("monitoring3",$m_3); 
				         $this->db->set("monitoring4",$m_4); 
				         $this->db->set("monitoring5",null);
				      	$this->db->set("monitoring6",null);
				          
			}elseif($lama==5){
			     $tgl_trim=strtotime($tgl);
			     $tgl_otw=$tgl;
			     $m_1=$this->tanggal->tambah_tgl($tgl,7);
			     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
			     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
			     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
			      $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
			     $tgl_pulang= date('Y-m-d', strtotime('+5 months', $tgl_trim));
			     
			             $this->db->set("monitoring1",$m_1); 
				         $this->db->set("monitoring2",$m_2); 
				         $this->db->set("monitoring3",$m_3); 
				         $this->db->set("monitoring4",$m_4); 
				         $this->db->set("monitoring5",$m_5); 
				          $this->db->set("monitoring6",null);
				          
			}else{
			     $tgl_trim=strtotime($tgl);
			     $tgl_otw=$tgl;
			     $m_1=$this->tanggal->tambah_tgl($tgl,7);
			     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
			     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
			     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
			     $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
			     $m_6= date('Y-m-d', strtotime('+5 months', $tgl_trim));     
			     $tgl_pulang= date('Y-m-d', strtotime('+'.$lama.' months', $tgl_trim));
			     
			             $this->db->set("monitoring1",$m_1); 
				         $this->db->set("monitoring2",$m_2); 
				         $this->db->set("monitoring3",$m_3); 
				         $this->db->set("monitoring4",$m_4); 
				         $this->db->set("monitoring5",$m_5);
				         $this->db->set("monitoring6",$m_6);
				          
			}
			if ($method=="update") {
				$this->db->set("tgl_pulang", $tgl_pulang);
				$this->db->where("id",$id);
			  	$this->db->update("tr_mitra_quota");

			}
			else{
			  	$this->db->insert("tr_mitra_quota");

			}

		}
	}
    function hapus_bahan2($_id=null)
	{	$id=$this->input->post("id");
		if($_id!=null)
		{
			$id=$_id;
		}			

	 	$this->db->where("id",$id);
		$nama_file=$this->m_reff->goField("tr_mitra_quota","mou","where id='".$id."' ");
		$this->m_reff->hapus_file($nama_file); 
			
		return $this->db->delete("tr_mitra_quota");
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
		   
		 
		  
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select *
				from 
					".$this->tbl." 
				 where 1=1
				";

			if($_POST['search']['value']){
				$searchkey=$_POST['search']['value'];
				$query.=" AND (
				".$this->tbl.".nama LIKE '%".$searchkey."%'  or
				".$this->tbl.".lokasi LIKE '%".$searchkey."%'  
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
	function get_data_mou()
	{
		$query=$this->_get_data_mou();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_mou()
	{
		   
		 
		  
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		 
		 
		$query="select
					".$this->tbl.".*,
					tr_tahun_ajaran.id AS thn_id,
					tr_tahun_ajaran.nama AS tahun,
					tr_semester.id AS sms_id,
					tr_semester.nama AS semester
				from 
					".$this->tbl.", 
					tr_tahun_ajaran, 
					tr_semester
					WHERE
					tr_semester.id = ".$this->tbl.".id_semester AND 
					tr_tahun_ajaran.id = ".$this->tbl.".id_tahun  
				";

			if($_POST['search']['value']){
				$searchkey=$_POST['search']['value'];
				/*
				$query.=" AND (
				nama LIKE '%".$searchkey."%'  or
				lokasi LIKE '%".$searchkey."%'  
				) ";*/
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
	function insert_mitra()
	{	
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		//$this->db->set("id_tahun",$tahun);
		//$this->db->set("id_semester",$sms);
	 	return $this->db->insert($this->tbl,$post);
	}

	function update_mitra()
	{
		$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
		$post=$this->input->post("f");
		$post=$this->security->xss_clean($post);
		//$this->db->set("id_tahun",$tahun);
	//	$this->db->set("id_semester",$sms);
		$this->db->where("id",$this->input->post("id"));
	 	return $this->db->update($this->tbl,$post);
		

	return	$this->db->update("tm_mitra",$post);
	}
	function hapus_mitra($id)
	{
	    $cek=$this->db->get_where("tm_pkl",array("id_mitra"=>$id))->num_rows();
	    if($cek){
	        return "false";
	    }
		 
		$this->db->where("id",$id);
		return $this->db->delete("tr_mitra");
	}
	
	 function get_open_bursa()
	{
		$query=$this->_get_open_bursa();
		if($_POST['length'] != -1)
		$query.=" limit ".$_POST['start'].",".$_POST['length'];
		return $this->db->query($query)->result();
	}
	public function count_file()
	{				
		$query = $this->_get_open_bursa();
        return  $this->db->query($query)->num_rows();
	}
		private function _get_open_bursa()
	{
	$idu=$this->session->userdata("id");
	$query="select * from tm_bursa_kerja   ";
		if($_POST['search']['value']){
		$searchkey=$_POST['search']['value'];
			$query.=" AND (
			 file LIKE '%".$searchkey."%'  
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
		$query.=" order by id asc";
		} 
		else if(isset($order))
		{
			$order = $order;
			$query.=" order by ".key($order)." ".$order[key($order)] ;
		}
		return $query;
	
	}	///-----------------------------------ajax//
	function save_bursa()
	{
			$var=array();
		$var["hp"]=true; 
		$var["size"]=true; 
		$var["file"]=true;
		$var["validasi"]=false; 
		$var["token"]=true; 
		$var["nis_duplicate"]=false; 
		 
		$tgl=$this->input->get_post("batas");
		$id=$this->input->get_post("id");
		$aksi_edit=$this->input->get_post("aksi_edit");
		 if(isset($_FILES["file"]['tmp_name']))
		{
			$pullpath="bursa";
			$file=$this->m_reff->upload_file("file",$pullpath,"file","JPG,JPEG,PNG,PDF","3000000");
			
			if($aksi_edit=="true"){
				$nama_file=$this->m_reff->goField("tm_bursa_kerja","file","where id='".$id."' ");
				
				if($file["validasi"]!=false)
				{
					$this->m_reff->hapus_file("file_upload/bursa/".$nama_file);  
					$this->db->set("file",$file["name"]);
					$this->db->set("batas",$this->tanggal->eng_($tgl,"-"));
					$this->db->where("id",$id);
					$this->db->update("tm_bursa_kerja");
				}
				
				}else{
					if($file["validasi"]!=false)
					{
						$this->db->set("file",$file["name"]);
						$this->db->set("batas",$this->tanggal->eng_($tgl,"-"));
						$this->db->insert("tm_bursa_kerja");
					}
				}
			
			
		}else{
						if($aksi_edit=="true"){
							  
								$this->db->set("batas",$this->tanggal->eng_($tgl,"-"));
								$this->db->where("id",$id);
								$this->db->update("tm_bursa_kerja");
							 
						}else{
									$this->db->set("batas",$this->tanggal->eng_($tgl,"-"));
									$this->db->insert("tm_bursa_kerja");
						}
		}
		
			return $var;
	}
	function hapus_bursa()
	{
			$id=$this->input->post("id");
		 
			$this->db->where("id",$id);
			$nama_file=$this->m_reff->goField("tm_bursa_kerja","file","where id='".$id."' ");
		 	$nama_file="file_upload/bursa/".$nama_file;
		$this->m_reff->hapus_file($nama_file); 
		$this->db->where("id",$id);
		return $this->db->delete("tm_bursa_kerja");
	}
	
	function download_format_quota()
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
        $style2 = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccff99')
            )
        );
        $style3 = array(
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccff99')
            )
        );
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

//create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'NO ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'KODE MITRA ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'NAMA MITRA ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'ALAMAT ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'QUOTA');
        $objPHPExcel->getActiveSheet(0)->setCellValue('F1', 'LAMA PKL ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('G1', 'TGL BERANGKAT ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('H1', 'KODE PEMBIMBING ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('I1', 'NO MOU ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('J1', 'JUDUL MOU ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('K1', 'TGL AWAL MOU ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('L1', 'TGL AKHIR MOU ');


        $objPHPExcel->getActiveSheet(0)->setCellValue('M1', 'KETERANGAN ');
     
		
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:M1')->applyFromArray($style);
      
 
// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA QUOTA');
        $this->db->order_by("nama","asc");
		$data=$this->db->get("tr_mitra")->result();
		  $shit = 1;$no=1;
		foreach($data as $val)
		{
		      $shit++;
	         $objPHPExcel->getSheet(0)->setCellValue('A' . $shit . '', $no++);
	          $objPHPExcel->getSheet(0)->setCellValue('B' . $shit . '', $val->id);
	           $objPHPExcel->getSheet(0)->setCellValue('C' . $shit . '', $val->nama);
	          $objPHPExcel->getSheet(0)->setCellValue('D' . $shit . '', $val->lokasi); 
		}
						
//<!-------------------------------------------------------------------------------  --->		
 /*       $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, ' ');
        $objPHPExcel->addSheet($myWorkSheet, 1);
  
        $objPHPExcel->getSheet(1)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet(1)->setCellValue('B1', 'GENDER');
        $objPHPExcel->getSheet(1)->getStyle('A1:B1')->applyFromArray($style);
		 
            $objPHPExcel->getSheet(1)->setCellValue('A2',"L");
            $objPHPExcel->getSheet(1)->setCellValue('B2', "Laki-Laki");
			$objPHPExcel->getSheet(1)->setCellValue('A3',"P");
            $objPHPExcel->getSheet(1)->setCellValue('B3', "Perempuan");
       */
//<!-------------------------------------------------------------------------------------->	
//<!-------------------------------------------------------------------------------  --->	
      
        $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'DATA PEMBIMBING');
        $objPHPExcel->addSheet($myWorkSheet, 1);
  
        $objPHPExcel->getSheet(1)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->getColumnDimension('B')->setAutoSize(true);
   
        $objPHPExcel->getSheet(1)->setCellValue('A1', 'KODE');
        $objPHPExcel->getSheet(1)->setCellValue('B1', 'NAMA');
         
        $objPHPExcel->getSheet(1)->getStyle('A1:B1')->applyFromArray($style);
		 	$db=$this->db->query("select * from data_pegawai order by nama asc")->result();
		 	$shit = 1;$no=1;
		foreach($db as $val)
		{    
		      $shit++;
	         $objPHPExcel->getSheet(1)->setCellValue('A' . $shit . '', $val->id);
	          $objPHPExcel->getSheet(1)->setCellValue('B' . $shit . '', $val->nama);
	        
		}
		 
        
//<!-------------------------------------------------------------------------------------->	
  
//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format-upload-quota-pkl.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
	
	function download_format_mitra()
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
        $style2 = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
            ),
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccff99')
            )
        );
        $style3 = array(
            'borders' =>
            array('allborders' =>
                array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
                ),
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccff99')
            )
        );
        
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

        


//create column
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'NO ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'NAMA MITRA ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'ALAMAT / LOKASI ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'JENIS KERJASAMA ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'BUJUR ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('F1', 'LINTANG ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('G1', 'TELP. KANTOR ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('H1', 'EMAIL ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('I1', 'WEBSITE ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('J1', 'FAX ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('K1', 'BIDANG USAHA ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('L1', 'NAMA CP ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('M1', 'TELP CP ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('N1', 'JABATAN CP ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('O1', 'KETERANGAN ');
     
		
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:O1')->applyFromArray($style);
      
 
// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet(0)->setTitle('DATA MITRA PKL');
		
						
//<!-------------------------------------------------------------------------------  --->		
 /*       $myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, ' ');
        $objPHPExcel->addSheet($myWorkSheet, 1);
  
        $objPHPExcel->getSheet(1)->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getSheet(1)->setCellValue('A1', 'ID');
        $objPHPExcel->getSheet(1)->setCellValue('B1', 'GENDER');
        $objPHPExcel->getSheet(1)->getStyle('A1:B1')->applyFromArray($style);
		 
            $objPHPExcel->getSheet(1)->setCellValue('A2',"L");
            $objPHPExcel->getSheet(1)->setCellValue('B2', "Laki-Laki");
			$objPHPExcel->getSheet(1)->setCellValue('A3',"P");
            $objPHPExcel->getSheet(1)->setCellValue('B3', "Perempuan");
       */
//<!-------------------------------------------------------------------------------------->


  
//<!-------------------------------------------------------------------------------------->	
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format-upload-mitra-pkl.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
	}
	function import_data_quota()
	{   $sms=$this->m_reff->semester();
	    $tahun=$this->m_reff->tahun();
	    $file_form="file";
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
					 
					 	 
						 $kode=$this->m_reff->sheet($sheet,1); 
						 $quota=$this->m_reff->sheet($sheet,4);
						 $lama=$this->m_reff->sheet($sheet,5);
						 $berangkat=$this->tanggal->format($this->m_reff->sheet($sheet,6));
						 $tgl = $berangkat;

						 $pemb=$this->m_reff->sheet($sheet,7);

						 $no_mou = $this->m_reff->sheet($sheet,8);
						 $judul_mou = $this->m_reff->sheet($sheet,9);
						 $tgl_awal_mou = $this->tanggal->format($this->m_reff->sheet($sheet,10));
						 $tgl_akhir_mou = $this->tanggal->format($this->m_reff->sheet($sheet,11));

						 $ket=$this->m_reff->sheet($sheet,12);
						 
						 if ($kode && $quota && $lama && $berangkat && $pemb !="") {
						 	$cek=$this->db->query("select * from tr_mitra where id='".$kode."' ")->num_rows();
								if(!$cek){
										 $var["gagal"]=false;
										 $var["info"]="Proses terhenti karena kode mitra tidak ditemukan pada no ke ($i-1)";
		                                return $var;								 
								}else{
									$dataray=array(
										"quota"=>$quota,
										"lama_pkl"	=> $lama,
										"tgl_berangkat"	=> $berangkat,
										"id_pembimbing"	=> $pemb,
										"id_mitra"=>$kode,
										"no_mou"	=> $no_mou,
										"judul_mou"	=> $judul_mou,
										"tgl_awal_mou"	=> $tgl_awal_mou,
										"tgl_akhir_mou"	=> $tgl_akhir_mou,
										"id_semester"=>$sms,
										"id_tahun"=>$tahun,
										"ket"=>$ket,
										"created_by"=>$this->mdl->idu(),
										"created_on"=>date("Y-m-d H:i:s")
										);
									if($lama==1){
									     $tgl_trim=strtotime($tgl);
									     $tgl_otw=$tgl;
									     $m_1=$this->tanggal->tambah_tgl($tgl,7);
									     
									     	$tgl_pulang= date('Y-m-d', strtotime('+1 months', $tgl_trim));
									         $this->db->set("monitoring1",$m_1);  
									          $this->db->set("monitoring2",null);
									          $this->db->set("monitoring3",null);
										      $this->db->set("monitoring4",null);
										      $this->db->set("monitoring5",null);
										      $this->db->set("monitoring6",null);
										         
									}elseif($lama==2){
									     $tgl_trim=strtotime($tgl);
									     $tgl_otw=$tgl;
									     $m_1=$this->tanggal->tambah_tgl($tgl,7);
									     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
									   
									     $tgl_pulang= date('Y-m-d', strtotime('+2 months', $tgl_trim));
									         $this->db->set("monitoring1",$m_1); 
										        $this->db->set("monitoring2",$m_2);
										       
									          $this->db->set("monitoring3",null);
										      $this->db->set("monitoring4",null);
										      $this->db->set("monitoring5",null);
										      $this->db->set("monitoring6",null);
										         
									}elseif($lama==3){
									     $tgl_trim=strtotime($tgl);
									     $tgl_otw=$tgl;
									     $m_1=$this->tanggal->tambah_tgl($tgl,7);
									     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
									     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
									     $tgl_pulang= date('Y-m-d', strtotime('+3 months', $tgl_trim));
									         $this->db->set("monitoring1",$m_1); 
										        $this->db->set("monitoring2",$m_2); 
										          $this->db->set("monitoring3",$m_3); 
										           $this->db->set("monitoring4",null);
										      $this->db->set("monitoring5",null);
										      $this->db->set("monitoring6",null);
									}elseif($lama==4){
									     $tgl_trim=strtotime($tgl);
									     $tgl_otw=$tgl;
									     $m_1=$this->tanggal->tambah_tgl($tgl,7);
									     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
									     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
									     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
									     $tgl_pulang= date('Y-m-d', strtotime('+4 months', $tgl_trim));
									     
									             $this->db->set("monitoring1",$m_1); 
										         $this->db->set("monitoring2",$m_2); 
										         $this->db->set("monitoring3",$m_3); 
										         $this->db->set("monitoring4",$m_4); 
										         $this->db->set("monitoring5",null);
										      	$this->db->set("monitoring6",null);
										          
									}elseif($lama==5){
									     $tgl_trim=strtotime($tgl);
									     $tgl_otw=$tgl;
									     $m_1=$this->tanggal->tambah_tgl($tgl,7);
									     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
									     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
									     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
									      $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
									     $tgl_pulang= date('Y-m-d', strtotime('+5 months', $tgl_trim));
									     
									             $this->db->set("monitoring1",$m_1); 
										         $this->db->set("monitoring2",$m_2); 
										         $this->db->set("monitoring3",$m_3); 
										         $this->db->set("monitoring4",$m_4); 
										         $this->db->set("monitoring5",$m_5); 
										          $this->db->set("monitoring6",null);
										          
									}else{
									     $tgl_trim=strtotime($tgl);
									     $tgl_otw=$tgl;
									     $m_1=$this->tanggal->tambah_tgl($tgl,7);
									     $m_2= date('Y-m-d', strtotime('+1 months', $tgl_trim));
									     $m_3= date('Y-m-d', strtotime('+2 months', $tgl_trim)); 
									     $m_4= date('Y-m-d', strtotime('+3 months', $tgl_trim)); 
									     $m_5= date('Y-m-d', strtotime('+4 months', $tgl_trim)); 
									     $m_6= date('Y-m-d', strtotime('+5 months', $tgl_trim));     
									     $tgl_pulang= date('Y-m-d', strtotime('+'.$lama.' months', $tgl_trim));
									     
									             $this->db->set("monitoring1",$m_1); 
										         $this->db->set("monitoring2",$m_2); 
										         $this->db->set("monitoring3",$m_3); 
										         $this->db->set("monitoring4",$m_4); 
										         $this->db->set("monitoring5",$m_5);
										         $this->db->set("monitoring6",$m_6);
										          
									}
									$this->db->set("tgl_pulang", $tgl_pulang);	
									$this->db->insert("tr_mitra_quota",$dataray);
									$insert++;
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
				
				
				 
				
			 
		}else{
				return $var;
		}
	}
	function import_data_mitra()
	{
	    $file_form="file";
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
					 
					 	 
						 $nama=$this->m_reff->sheet($sheet,1);
						 $lokasi=$this->m_reff->sheet($sheet,2);
						 $jenis=$this->m_reff->sheet($sheet,3);
						 $bujur=$this->m_reff->sheet($sheet,4);
						 $lintang=$this->m_reff->sheet($sheet,5);
						 $telp=$this->m_reff->sheet($sheet,6);
						 $email=$this->m_reff->sheet($sheet,7);
						 $website=$this->m_reff->sheet($sheet,8);
						 $fax=$this->m_reff->sheet($sheet,9);
						 $bidang=$this->m_reff->sheet($sheet,10);
						 $nama_cp=$this->m_reff->sheet($sheet,11);
						 $telp_cp=$this->m_reff->sheet($sheet,12);
						 $jabatan_cp=$this->m_reff->sheet($sheet,13);
						 $ket=$this->m_reff->sheet($sheet,14);
	
						 
						$cek=$this->cek_mitra($nama);
						if($cek){
								 $var["gagal"]=false;
								 $var["info"]="Proses input terhenti karena data mitra ( $nama ) pernah di input";
                                return $var;								 
						}else{
							$dataray=array(
								"nama"=>$nama,
								"lokasi"=>$lokasi,
								"jenis_kerjasama"	=> $jenis,
								"longt"	=> $bujur,
								"latt"	=> $lintang,
								"telp"	=> $telp,
								"email"	=> $email,
								"website"	=> $website,
								"fax"		=> $fax,
								"bidang_usaha"	=> $bidang,
								"nama_cp"	=> $nama_cp,
								"telp_cp"	=> $telp_cp,
								"jabatan_cp"	=> $jabatan_cp,
								"ket"=>$ket);
								
							$this->db->insert("tr_mitra",$dataray);
							$insert++;
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
				
				
				 
				
			 
		}else{
				return $var;
		}
	}
	
	function cek_mitra($nama)
	{
	    return $this->db->get_where("tr_mitra",array("nama"=>$nama))->num_rows();
	}
}