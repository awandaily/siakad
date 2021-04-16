<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Humas extends CI_Controller
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

	public function bursa_kerja()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("bursa_kerja");
		} else {
			$data['konten'] = "bursa_kerja";
			$this->_template($data);
		}
	}



	///-----------------------SISWA--------------------------///



	///-----------------------mitra PENILIAAN--------------------------///
	function getData()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$nama = $dataDB->nama;
			$tombol = '
	              	<button title="MOU Data" type="button" onclick="add_mou(`' . $dataDB->id . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     		<i class="material-icons">file_copy</i>
			    	</button>                          
              		<button title="Edit data" type="button" onclick="edit(`' . $dataDB->id . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     		<i class="material-icons">border_color</i>
			     	</button>
           			<button title="Hapus data" type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $nama . '`)" class="hide btn btn-default btn-circle waves-effect waves-circle waves-float">
		   				<i class="material-icons">delete_forever</i>
		   			</button>
                                 
                </div>';
			if ($dataDB->id_kel) {
				$wil = " Kel. " . $this->mdl->getNamaKel($dataDB->id_kel) . " Kec. " . $this->mdl->getNamaKec($dataDB->id_kec) . " " . $this->mdl->getNamaKab($dataDB->id_kab) . " Prov. " . $this->mdl->getNamaProv($dataDB->id_prov);
			} else {
				$wil = "";
			}

			$row = array();
			$row[] = $tombol;
			//	$row[] = "<span class='size'>".$no++."</span>";	
			$row[] = $dataDB->id;
			$row[] = "<span class='size'>  " . $nama . " </span>";
			$row[] = "<span class='size'>" . $dataDB->lokasi . " " . $wil . "</span>";
			$row[] = "<span class='size'>  " . $dataDB->jenis_kerjasama . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->longt . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->latt . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->telp . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->email . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->website . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->fax . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->bidang_usaha . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->nama_cp . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->telp_cp . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->jabatan_cp . " </span>";
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
	function dataMou()
	{

		$data["id"] = $this->input->post("id");
		echo	$this->load->view("data_mou", $data);
	}


	//-------------------------------------------------END SISWA------------------------------------//
	function idu()
	{
		return $this->session->userdata("id");
	}

	function get_kota()
	{
		$d = $this->m_konfig->get_kota_ajax();
		echo $d;
	}
	function get_kecamatan()
	{
		$d = $this->m_konfig->get_kecamatan_ajax();
		echo $d;
	}
	function get_kelurahan()
	{
		$d = $this->m_konfig->get_kelurahan_ajax();
		echo $d;
	}

	function viewAdd()
	{
		echo $this->load->view("viewAdd");
	}
	function viewEdit()
	{
		echo $this->load->view("viewEdit");
	}
	function viewMOU()
	{
		echo $this->load->view("viewMOU");
	}
	function insert_mitra()
	{
		echo $this->mdl->insert_mitra();
	}
	function upload_mou()
	{
		echo $this->mdl->upload_mou();
	}
	function hapus_bahan2()
	{
		$idu = $this->input->post("id");
		echo $this->mdl->hapus_bahan2($idu);
	}
	function update_mitra()
	{
		echo $this->mdl->update_mitra();
	}
	function hapus_mitra()
	{
		$id = $this->input->post("id");
		echo $this->mdl->hapus_mitra($id);
	}
	function data_bursa()
	{
		$tbl = "tm_bursa_kerja";
		$list = $this->mdl->get_open_bursa($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$now = date("Y-m-d");
		foreach ($list as $dataDB) {
			$tombol = '                             

			    <button title="Edit data" type="button" onclick="edit(`' . $dataDB->id . '`,`' . $this->tanggal->ind($dataDB->batas, "/") . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     	<i class="material-icons">border_color</i>
			    </button>
	           	<button title="Hapus data" type="button" onclick="hapus(`' . $dataDB->id . '`,``)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			   		<i class="material-icons">delete_forever</i>
			   	</button>
                                 
                            </div>';
			////
			if (strpos($dataDB->file, ".pdf") !== false) {
				$gambar = "<a href='" . base_url() . "file_upload/bursa/" . $dataDB->file . "'><b>Buka files</b></a>";
			} else {
				$gambar = "<a href='" . base_url() . "file_upload/bursa/" . $dataDB->file . "'>
			  <img width='100px' class='img-responsive thumbnail' src='" . base_url() . "file_upload/bursa/" . $dataDB->file . "'></a>";
			}
			$batas = $this->tanggal->ind($dataDB->batas, "/");
			if ($dataDB->batas > $now) {
				$batas = "<span class='col-red'><b>" . $batas . "</b> ( <i>Kadaluarsa </i>)</span>";
			}


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $gambar . " </span>";
			$row[] = "<span class='size'>" . $batas . " </span>";

			//add html for action
			$row[] = $tombol;
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdl->count_file(),
			"recordsFiltered" => $this->mdl->count_file(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function save_bursa()
	{
		$data = $this->mdl->save_bursa();
		echo json_encode($data);
	}

	function hapus_bursa()
	{
		$data = $this->mdl->hapus_bursa();
		echo json_encode($data);
	}

	function setTgl()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("tgl_berangkat", $this->mdl->toTglSys($this->input->post("val")));
		$up = $this->db->update('tr_mitra_quota');

		if ($up) {
			$this->db->where("id", $this->input->post("id"));
			$x = $this->db->get("tr_mitra_quota")->row_array();

			$this->mdl->setMonitoring($this->input->post("id"), $this->tanggal->eng_($this->input->post("val")), $x["lama_pkl"], "update");

			return $up;
		}
	}
	function setLama()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("lama_pkl", $this->input->post("val"));
		$up = $this->db->update('tr_mitra_quota');

		if ($up) {

			$this->db->where("id", $this->input->post("id"));
			$x = $this->db->get("tr_mitra_quota")->row_array();

			$this->mdl->setMonitoring($this->input->post("id"), $x["tgl_berangkat"], $this->input->post("val"), "update");

			return $up;
		}
	}



	function setPembimbing()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("id_pembimbing", $this->input->post("val"));
		return $this->db->update('tr_mitra_quota');
	}
	function setKuota()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("quota", $this->input->post("val"));
		return $this->db->update('tr_mitra_quota');
	}
	function setno()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("no_mou", $this->input->post("val"));
		return $this->db->update('tr_mitra_quota');
	}
	function setjudul()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("judul_mou", $this->input->post("val"));
		return $this->db->update('tr_mitra_quota');
	}
	function setawal()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("tgl_awal_mou", $this->mdl->toTglSys($this->input->post("val")));
		return $this->db->update('tr_mitra_quota');
	}
	function setakhir()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("tgl_akhir_mou", $this->mdl->toTglSys($this->input->post("val")));
		return $this->db->update('tr_mitra_quota');
	}
	function setKet()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("ket", $this->input->post("val"));
		return $this->db->update('tr_mitra_quota');
	}
	function setM()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("no_mou", $this->input->post("val"));
		return $this->db->update('tr_mitra_quota');
	}
	function download_format_mitra()
	{
		echo $this->mdl->download_format_mitra();
	}
	function download_format_quota()
	{
		echo $this->mdl->download_format_quota();
	}
	function import_data_mitra()
	{
		$data = $this->mdl->import_data_mitra();
		echo json_encode($data);
	}
	function import_data_quota()
	{
		$data = $this->mdl->import_data_quota();
		echo json_encode($data);
	}
}
