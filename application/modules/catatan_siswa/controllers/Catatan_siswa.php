<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Catatan_siswa extends CI_Controller
{


	var $tbl = "v_pegawai";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("model", "mdl");
		//$this->load->model("m_sms","sms");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}
	public function jurusan()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("jurusan");
		} else {
			$data['konten'] = "jurusan";
			$this->_template($data);
		}
	}
	public function siswa()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			// 	echo "<script> window.location.href='pendidik';</script>";
			echo	$this->load->view("siswa");
		} else {
			$data['konten'] = "siswa";
			$this->_template($data);
		}
	}


	///-----------------------SISWA--------------------------///



	///-----------------------CATATAN PENILIAAN--------------------------///
	function getCatatan()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////

			if ($dataDB->id_guru != 0) {
				$qg = $this->m_reff->goField("data_pegawai", "nama", "where nip='" . $dataDB->id_guru . "' ");
				$nama = $qg;
			} else {
				$nama = "SEKOLAH";
			}

			$tombol = ' 
          
                             
              <button title="Edit data" type="button" onclick="edit(`' . $dataDB->id . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     <i class="material-icons">border_color</i></button>
           <button title="Hapus data" type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $nama . '`)" 
		   class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   <i class="material-icons">delete_forever</i></button>
                                 
                            </div>';

			if ($dataDB->privacy == 1) {
				$privacy 	= "Tampilkan";
				$cp 		= "info";
			} else {
				$privacy 	= "Sembunyikan";
				$cp 		= "danger";
			}

			$row = array();
			$row[] = $tombol;
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>  " . $nama . " </span>";
			$row[] = "<span class='size'><center>  <label class='label label-" . $cp . "' style='font-size:11px'>" . $privacy . "</label> <center></span>";
			//$row[] = "<span class='size'>  ".$this->m_reff->goField("tr_jenis_catatan","nama","where id='".$dataDB->id_jenis."'")." </span>";
			$row[] = "<span class='size'>  " . $dataDB->ket . " </span>";
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	//-------------------------------------------------END SISWA------------------------------------//
	function idu()
	{
		return $this->session->userdata("id");
	}

	function getKelas()
	{
		$idtk = $this->input->post("id");
		$idjurusan = $this->input->post("jur");
		$value = $this->input->post("val");

		$this->db->where("id_tk", $idtk);
		$this->db->where("id_jurusan", $idjurusan);
		$sts = $this->db->get("tm_kelas")->result();
		$ray = "";
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $val->nama;
		}
		echo form_dropdown("f[id_kelas]", $ray, $value, 'required class="form-control col-md-12 show-tick" ');
		echo "<script>$('select').selectpicker();</script>";
	}
	function getSiswa()
	{

		$idk = $this->input->post("idk");
		$this->db->where("id_kelas", $idk);
		$value = $this->input->post("val");
		$sts = $this->db->get("data_siswa")->result();
		$ray = "";
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $val->nama;
		}
		echo form_dropdown("f[id_siswa]", $ray, $value, 'required class="form-control col-md-12 show-tick" data-live-search="true" ');
		echo "<script>$('select').selectpicker();</script>";
	}
	function viewAdd()
	{
		echo $this->load->view("viewAdd");
	}
	function viewEdit()
	{
		echo $this->load->view("viewEdit");
	}
	function insert_catatan()
	{
		echo $this->mdl->insert_catatan();
	}
	function update_catatan()
	{
		echo $this->mdl->update_catatan();
	}
	function hapus_catatan()
	{
		$id = $this->input->post("id");
		echo $this->mdl->hapus_catatan($id);
	}
}
