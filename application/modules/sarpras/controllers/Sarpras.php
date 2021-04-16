<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sarpras extends CI_Controller
{


	var $tbl = "v_pegawai";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("HUMAS", "GURU", "ADMIN"));
		$this->load->model("model", "mdl");
		$this->load->model("m_sms", "sms");
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

	public function data_aset()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("data_aset");
		} else {
			$data['konten'] = "data_aset";
			$this->_template($data);
		}
	}

	public function rekap()
	{

		$total = $this->mdl->total_aset();

		$tanah = $this->mdl->get_tanah();

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			$data['total'] = $total;
			$data["tanah"] = $tanah;
			echo	$this->load->view("rekap", $data);
		} else {
			$data['total'] = $total;
			$data["tanah"] = $tanah;
			$data['konten'] = "rekap";
			$this->_template($data);
		}
	}

	function get_select()
	{

		$type 	= $_POST["type"];
		$id 	= $_POST["id"];

		switch ($type) {
			case 'bangunan':
				$q = $this->mdl->get_bangunan_by_tanah($id);
				$d = "
					<select class='form-control' id='src_bangunan' onchange='sel_ruangan(this.value)'>
						<option value=''>== Pilih Bangunan ==</option>
				";
				foreach ($q as $v) {
					$d .= "<option value='" . $v->id . "'>" . $v->nama_bangunan . "</option>";
				}
				$d .= "</select>";
				break;
			case 'ruangan':
				$q = $this->mdl->get_ruangan_by_bangunan($id);
				$d = "
					<select class='form-control' id='src_ruangan' onchange='reload_table()'>
						<option value=''>== Pilih Ruangan ==</option>
				";
				foreach ($q as $v) {
					$d .= "<option value='" . $v->id . "'>" . $v->nama_ruangan . "</option>";
				}
				$d .= "</select>";
				break;

			default:
				$d = "";
				break;
		}

		echo $d;
	}

	function data_rekap()
	{
	}



	///-----------------------SISWA--------------------------///



	///-----------------------mitra PENILIAAN--------------------------///
	function getTanah()
	{
		$list = $this->mdl->get_data_tanah();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$nama = $dataDB->nama_tanah;
			$tombol = ' 
		  		<div style="text-align:center">                       
              		<button title="Edit data" type="button" onclick="tanah_edit(`' . $dataDB->id . '`, `' . $nama . '`, `' . $dataDB->luas_tanah . '`, `' . $dataDB->atas_nama . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     		<i class="material-icons">border_color</i>
			     	</button>
           			<button title="Hapus data" type="button" onclick="tanah_delete(`' . $dataDB->id . '`,`' . $nama . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   				<i class="material-icons">delete_forever</i>
		   			</button>
                                 
                </div>';

			$row = array();
			$row[] = $tombol;
			$row[] = "<span class='size'>  " . $nama . " </span>";
			$row[] = "<span class='size'> " . $dataDB->luas_tanah . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->atas_nama . " </span>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_tanah(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function tanah_save()
	{
		/*
		$data=$this->mdl->tanah_save();
		echo json_encode($data);*/
		if ($_POST["edit_id"] != "") {
			echo $this->mdl->tanah_update();
		} else {
			echo $this->mdl->tanah_save();
		}
	}
	function tanah_delete()
	{
		$id = $this->input->post("id");
		echo $this->mdl->tanah_delete($id);
	}
	function tanah_select()
	{

		$this->db->order_by("nama_tanah", "asc");
		$d = $this->db->get("tm_aset_tanah")->result();

		$dt = "
				<select class='form-control' name='f[idtanah]' require>
					<option value=''>== PILIH TANAH ==</option>
			";
		foreach ($d as $v) {
			if ($_POST['id'] == $v->id) {
				$sl = "selected";
			} else {
				$sl = "";
			}
			$dt .= "<option value='" . $v->id . "' " . $sl . ">" . $v->nama_tanah . "</option>";
		}
		$dt .= "</select>";

		echo $dt;
	}

	function getBangunan()
	{
		$list = $this->mdl->get_data_bangunan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$nama = $dataDB->nama_bangunan;
			$tombol = ' 
		  		<div style="text-align:center">                       
              		<button title="Edit data" type="button" onclick="bangunan_edit(`' . $dataDB->id . '`, `' . $nama . '`, `' . $dataDB->idtanah . '`, `' . $dataDB->keterangan . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     		<i class="material-icons">border_color</i>
			     	</button>
           			<button title="Hapus data" type="button" onclick="bangunan_delete(`' . $dataDB->id . '`,`' . $nama . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   				<i class="material-icons">delete_forever</i>
		   			</button>
                                 
                </div>';

			$row = array();
			$row[] = $tombol;
			$row[] = "<span class='size'>  " . $nama . " </span>";
			$row[] = "<span class='size'> " . $dataDB->nama_tanah . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->keterangan . " </span>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_bangunan(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function bangunan_save()
	{
		/*
		$data=$this->mdl->tanah_save();
		echo json_encode($data);*/
		if ($_POST["edit_id_bangunan"] != "") {
			echo $this->mdl->bangunan_update();
		} else {
			echo $this->mdl->bangunan_save();
		}
	}
	function bangunan_delete()
	{
		$id = $this->input->post("id");
		echo $this->mdl->bangunan_delete($id);
	}
	function bangunan_select()
	{

		$this->db->order_by("nama_bangunan", "asc");
		$d = $this->db->get("tm_aset_bangunan")->result();

		$dt = "
				<select class='form-control' name='f[idbangunan]' require>
					<option value=''>== PILIH BANGUNAN ==</option>
			";
		foreach ($d as $v) {
			if ($_POST['id'] == $v->id) {
				$sl = "selected";
			} else {
				$sl = "";
			}
			$dt .= "<option value='" . $v->id . "' " . $sl . ">" . $v->nama_bangunan . "</option>";
		}
		$dt .= "</select>";

		echo $dt;
	}

	function getRuangan()
	{
		$list = $this->mdl->get_data_ruangan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$nama = $dataDB->nama_ruangan;
			$tombol = ' 
		  		<div style="text-align:center">                       
			     	<button title="Edit data" type="button" onclick="ruangan_edit(`' . $dataDB->id . '`, `' . $nama . '`, `' . $dataDB->idbangunan . '`, `' . $dataDB->keterangan . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     		<i class="material-icons">border_color</i>
			     	</button>
           			<button title="Hapus data" type="button" onclick="ruangan_delete(`' . $dataDB->id . '`,`' . $nama . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   				<i class="material-icons">delete_forever</i>
		   			</button>
                                 
                </div>';

			$row = array();
			$row[] = $tombol;
			$row[] = "<span class='size'>  " . $nama . " </span>";
			$row[] = "<span class='size'> " . $dataDB->nama_bangunan . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->keterangan . " </span>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_ruangan(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function ruangan_save()
	{
		/*
		$data=$this->mdl->tanah_save();
		echo json_encode($data);*/
		if ($_POST["edit_id_ruangan"] != "") {
			echo $this->mdl->ruangan_update();
		} else {
			echo $this->mdl->ruangan_save();
		}
	}
	function ruangan_delete()
	{
		$id = $this->input->post("id");
		echo $this->mdl->ruangan_delete($id);
	}
	function ruangan_select()
	{

		$this->db->order_by("nama_ruangan", "asc");
		$d = $this->db->get("tm_aset_ruangan")->result();

		$dt = "
				<select class='form-control' name='f[idruangan]' require>
					<option value=''>== PILIH RUANGAN ==</option>
			";
		foreach ($d as $v) {
			if ($_POST['id'] == $v->id) {
				$sl = "selected";
			} else {
				$sl = "";
			}
			$dt .= "<option value='" . $v->id . "' " . $sl . ">" . $v->nama_ruangan . "</option>";
		}
		$dt .= "</select>";

		echo $dt;
	}

	function getBarang()
	{
		$list = $this->mdl->get_data_barang();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$nama = $dataDB->nama_barang;
			$tombol = ' 
		  		<div style="text-align:center">                       
			     	<button title="Edit data" type="button" onclick="barang_edit(`' . $dataDB->id . '`, `' . $nama . '`, `' . $dataDB->idruangan . '`, `' . $dataDB->qty . '`, `' . $dataDB->keterangan . '`, `' . $dataDB->qty_rusak . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     		<i class="material-icons">border_color</i>
			     	</button>
           			<button title="Hapus data" type="button" onclick="barang_delete(`' . $dataDB->id . '`,`' . $nama . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   				<i class="material-icons">delete_forever</i>
		   			</button>
                                 
                </div>';

			$row = array();
			$row[] = $tombol;
			$row[] = "<span class='size'>  " . $nama . " </span>";
			$row[] = "<span class='size'> " . $dataDB->nama_ruangan . " </span>";
			$row[] = "<span class='size' style='text-align:right'> " . $dataDB->qty . " </span>";
			$row[] = "<span class='size' style='text-align:right'> " . $dataDB->qty_rusak . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->keterangan . " </span>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_barang(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getBarangFull()
	{
		$list = $this->mdl->get_data_barang_full();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$nama = $dataDB->nama_barang;

			$row = array();
			$row[] = "<span class='size'>  " . $nama . " </span>";
			$row[] = "<span class='size'> <center>" . $dataDB->qty . "</center> </span>";
			$row[] = "<span class='size'> <center>" . $dataDB->qty_rusak . "</center> </span>";
			$row[] = "<span class='size'>  " . $dataDB->keterangan . " </span>";
			$row[] = "<span class='size'>" . $dataDB->nama_tanah . "</span>";
			$row[] = "<span class='size'>" . $dataDB->nama_bangunan . "</span>";
			$row[] = "<span class='size'>" . $dataDB->nama_ruangan . "</span>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_barang_full(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function barang_save()
	{
		/*
		$data=$this->mdl->tanah_save();
		echo json_encode($data);*/
		if ($_POST["edit_id_barang"] != "") {
			echo $this->mdl->barang_update();
		} else {
			echo $this->mdl->barang_save();
		}
	}
	function barang_delete()
	{
		$id = $this->input->post("id");
		echo $this->mdl->barang_delete($id);
	}



	//-------------------------------------------------END SISWA------------------------------------//
	function idu()
	{
		return $this->session->userdata("id");
	}
}
