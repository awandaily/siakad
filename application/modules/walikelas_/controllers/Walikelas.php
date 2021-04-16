<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Walikelas extends CI_Controller {

	

	function __construct()
	{
		parent::__construct();	
		$this->m_konfig->validasi_session(array("BPBK","GURU","KEPSEK","ADMIN","TK","PIKET"));
		$this->load->model("model","mdl");
		date_default_timezone_set('Asia/Jakarta');
	}
	 
	function _template($data)
	{
	$this->load->view('temp_user/main',$data);	
	}
	 
	public function index()
	{
		 
		 
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo	$this->load->view("index");
		}else{
			$data['konten']="index";
			$this->_template($data);
		}
		
	}public function absensi()
	{
		 
		 
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo	$this->load->view("absensi");
		}else{
			$data['konten']="absensi";
			$this->_template($data);
		}
		
	}
	public function absensi_perhari()
	{
		 
		 
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo	$this->load->view("absensi_perhari");
		}else{
			$data['konten']="absensi_perhari";
			$this->_template($data);
		}
		
	}
	public function absensi_perhari_all()
	{
		 
		 
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo	$this->load->view("absensi_perhari_all");
		}else{
			$data['konten']="absensi_perhari_all";
			$this->_template($data);
		}
		
	}
	function getAbsenPerhari()
	{
		$list = $this->mdl->get_data_absenPerhari();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {
		////
		 
		
		$kelas=$this->m_reff->goField("v_kelas","nama","where id='".$dataDB->id_kelas."' ");
		 
			$row = array();
			$row[] = $no++;
			$row[] = "<a href='javascript:void(0)' class='linehover cursor' onclick='detail(`".$dataDB->id."`)'><b>".$dataDB->nama ."</b>".br().$kelas."</a>";
			 
			$row[] = "<a href='javascript:void(0)' class='col-black'><b>".$this->m_reff->jmlOffDay($dataDB->id,"all")."</b></a>";
			$row[] = "<a href='javascript:void(0)' onclick='cekAbsenPerhari(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`2`)'><b>".$this->m_reff->jmlOffDay($dataDB->id,2)."</b></a>";
			$row[] = "<a href='javascript:void(0)' onclick='cekAbsenPerhari(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`3`)'><b>".$this->m_reff->jmlOffDay($dataDB->id,3)."</b></a>";
			$row[] = "<a href='javascript:void(0)' onclick='cekAbsenPerhari(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`4`)'><b>".$this->m_reff->jmlOffDay($dataDB->id,4)."</b></a>";
			$row[] = "<a href='javascript:void(0)' onclick='cekAbsenPerhari(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`5`)'><b>".$this->m_reff->jmlOffDay($dataDB->id,5)."</b></a>";
			$row[] = "<a href='javascript:void(0)' onclick='cekAbsenPerhari(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`6`)'><b>".$this->m_reff->jmlOffDay($dataDB->id,6)."</b></a>";
			
			 
			$data[] = $row; 
			
			}
			
	 

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $c=$this->mdl->count_perhari(),
						"recordsFiltered" =>$c,
						"data" => $data,
						);
		//output to json format
		echo json_encode($output);

	}

	function getAbsenPerhariAll()
	{
		$list = $this->mdl->get_data_perhari_all();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {
		////
		 
		
		$kelas=$this->m_reff->goField("v_kelas","nama","where id='".$dataDB->id_kelas."' ");
		 
			$row = array();
			$row[] = $no++;
			$row[] = "<a href='javascript:void(0)' class='linehover cursor' onclick='detail(`".$dataDB->id."`)'><b>".$dataDB->nama ."</b>".br().$kelas."</a>";
			 
			$row[] = "<a href='javascript:void(0)' class='col-black'><b>".$this->m_reff->jmlOffDay($dataDB->id,"all")."</b></a>";
			$row[] = "<a href='javascript:void(0)' onclick='cekAbsenPerhari(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`2`)'><b>".$this->m_reff->jmlOffDay($dataDB->id,2)."</b></a>";
			$row[] = "<a href='javascript:void(0)' onclick='cekAbsenPerhari(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`3`)'><b>".$this->m_reff->jmlOffDay($dataDB->id,3)."</b></a>";
			$row[] = "<a href='javascript:void(0)' onclick='cekAbsenPerhari(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`4`)'><b>".$this->m_reff->jmlOffDay($dataDB->id,4)."</b></a>";
			$row[] = "<a href='javascript:void(0)' onclick='cekAbsenPerhari(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`5`)'><b>".$this->m_reff->jmlOffDay($dataDB->id,5)."</b></a>";
			$row[] = "<a href='javascript:void(0)' onclick='cekAbsenPerhari(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`6`)'><b>".$this->m_reff->jmlOffDay($dataDB->id,6)."</b></a>";
			
			 
			$data[] = $row; 
			
			}
			
	 

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $c=$this->mdl->count_perhari_all(),
						"recordsFiltered" =>$c,
						"data" => $data,
						);
		//output to json format
		echo json_encode($output);

	}
	function cekAbsenPerhari()
	{
	    echo	$this->load->view("cekAbsenDetailPerhari");
	}
	public function catatan()
	{
		 
		 
		$ajax=$this->input->get_post("ajax");
		if($ajax=="yes")
		{
			echo	$this->load->view("pengaduan");
		}else{
			$data['konten']="pengaduan";
			$this->_template($data);
		}
		
	}
	function viewTanggapi()
	{
		echo $this->load->view("viewTanggapi");
	}
	function ketidakhadiran()
	{
	echo	$this->index();
	}
	function insert_tanggapan()
	{
		echo $this->mdl->insert_tanggapan();
	}
	function update_tanggapan()
	{
		echo $this->mdl->update_tanggapan();
	}
	function hapus_bpbk()
	{
		echo $this->mdl->hapus_bpbk();
	}
	
	function getAbsen()
	{
		$list = $this->mdl->get_data_absen();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {
		////
		 
		
		$kelas=$this->m_reff->goField("v_kelas","nama","where id='".$dataDB->id_kelas."' ");
		 
			$row = array();
			$row[] = $no++;
			$row[] = "<a href='javascript:void(0)' class='linehover cursor' onclick='detail(`".$dataDB->id."`)'><b>".$dataDB->nama ."</b>".br().$kelas."</a>";
			 
			$row[] = "<a href='#' class='col-pink' onclick='cekAbsen(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`)'><b>".$dataDB->jml."</b></a>";
			$row[] = "<a href='#' onclick='cekAbsen(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`2`)'><b>".$dataDB->absen2."</b></a>";
			$row[] = "<a href='#' onclick='cekAbsen(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`3`)'><b>".$dataDB->absen3."</b></a>";
			$row[] = "<a href='#' onclick='cekAbsen(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`4`)'><b>".$dataDB->absen4."</b></a>";
			$row[] = "<a href='#' onclick='cekAbsen(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`5`)'><b>".$dataDB->absen5."</b></a>";
			$row[] = "<a href='#' onclick='cekAbsen(`".$dataDB->id."`,`".strtoupper($dataDB->nama)."`,`6`)'><b>".$dataDB->absen6."</b></a>";
			
			 
			$data[] = $row; 
			
			}
			
	 

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $c=$this->mdl->count_abs(),
						"recordsFiltered" =>$c,
						"data" => $data,
						);
		//output to json format
		echo json_encode($output);

	}
	function cekAbsen()
	{
	echo	$this->load->view("cekAbsenDetail");
	}
	
	function getCatatan()
	{
	 
	$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no =$no+1;
		foreach ($list as $dataDB) {
		////
		$respon="";
		$db=$this->db->query("select * from tm_tanggapan where id_catatan='".$dataDB->id."'")->result();
		 
		
		
		$nama=$this->m_reff->goField("data_siswa","nama","where id='".$dataDB->id_siswa."' ");
		  	
		  	if ($dataDB->file_bukti!="") {
		  		$img = "<img class='img-responsive' src='".base_url().$dataDB->file_bukti."' width='200'>";
		  	}
		  	else{
		  		$img = "";
		  	}
		  	$tombol = "";
		  	if ($dataDB->status_wk=="" AND $dataDB->tanggapan_wk=="") {
		  		$tombol = '
		  			<button title="Tulis Tanggapan" type="button" onclick="tanggapi2(`'.$dataDB->id.'`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   				<i class="material-icons">mode_edit</i>
		  			</button>
		  		';
		  	}

		  	$tombol.='
		  		<button title="Riwayat Tanggapan" type="button" onclick="tanggapi(`'.$dataDB->id.'`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   			<i class="material-icons">done_all</i>
		  		</button>
		  	';
		 
			$row = array();
		 
			$row[] = "<span class='size'>".$this->tanggal->ind(substr($dataDB->tgl,0,10),"/")."<br>".
			$this->m_reff->goField("data_pegawai","nama","where id='".$dataDB->id_guru."'")."</span>";	
			$row[] = "<a class='size cursor' onclick='detail(`".$dataDB->id_siswa."`)' >  ".$nama." </a><br>
			 ".$this->m_reff->goField("v_siswa","nama_kelas","where id='".$dataDB->id_siswa."'")."
			";
		 
 			$row[] = "<span class='size'>  ".$dataDB->ket." </span>";
 			$row[] = "<span class='size'>  ".$img." </span>";
 			$row[] = "<span class='size'>".$tombol."</span>";
 			 
			$data[] = $row; 
			
			}
			
	 

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $c=$this->mdl->count(),
						"recordsFiltered" =>$c,
						"data" => $data,
						);
		//output to json format
		echo json_encode($output);


	}
	
	 function detail_siswa()
	{
			$data["data"]=$this->db->get_where("v_siswa",array("id"=>$this->input->post("id")))->row();
		echo $this->load->view("isi_detail_siswa",$data);
	}						
	
	
	
}