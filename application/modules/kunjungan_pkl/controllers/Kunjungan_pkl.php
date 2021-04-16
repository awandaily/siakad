<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kunjungan_pkl extends CI_Controller
{


	var $tbl = "v_pegawai";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("GURU"));
		$this->load->model("model", "mdl");

		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function data_siswa()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("data_siswa");
		} else {
			$data['konten'] = "data_siswa";
			$this->_template($data);
		}
	}
	public function jadwal_kunjungan()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("jadwal_kunjungan");
		} else {
			$data['konten'] = "jadwal_kunjungan";
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
	function getMitra()
	{
		$list = $this->mdl->get_data_siswa();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$dbsiswa = $this->db->query("select * from data_siswa where id='" . $dataDB->id_siswa . "' ")->row();
			$nama = isset($dbsiswa->nama) ? ($dbsiswa->nama) : "";
			$id_kelas = isset($dbsiswa->id_kelas) ? ($dbsiswa->id_kelas) : "";
			$kelas = $this->m_reff->goField("v_kelas", "nama", "where id='" . $id_kelas . "'");

			$row = array();

			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>  " . $nama . " </span>";
			$row[] = "<span class='size'>  " . $kelas . " </span>";
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_siswa(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	//-------------------------------------------------END SISWA------------------------------------//



	///-----------------------CATATAN PENILIAAN--------------------------///
	function getJadwalKunjungan()
	{
		echo $this->load->view("getJadwal");
	}
	function setOtw()
	{
		echo $this->load->view("getForm");
	}

	//-------------------------------------------------END SISWA------------------------------------//


	///-----------------------CATATAN PENILIAAN--------------------------///
	function getJadwal()
	{
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$nama = $this->m_reff->goField("data_siswa", "nama", "where id='" . $dataDB->id_siswa . "' ");
			$tombol = ' 
          
                             
              	<button title="Edit data" type="button" onclick="edit(`' . $dataDB->id . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
			     	<i class="material-icons">border_color</i>
			    </button>
           		<button title="Hapus data" type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $nama . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   			<i class="material-icons">delete_forever</i>
		  		</button>
		  		<button title="Riwayat Tanggapan" type="button" onclick="tanggapi(`' . $dataDB->id . '`,`' . $nama . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
		   			<i class="material-icons">done_all</i>
		  		</button>
                                 
            </div>';

			if ($dataDB->file_bukti != "") {
				$img = "<img class='img-responsive' width='200' src='" . base_url() . $dataDB->file_bukti . "'>";
			} else {
				$img = "";
			}

			$row = array();
			$row[] = $tombol;
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>  " . $nama . " </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("v_siswa", "nama_kelas", "where id='" . $dataDB->id_siswa . "'") . " </span>";
			//$row[] = "<span class='size'>  ".$this->m_reff->goField("tr_jenis_catatan","nama","where id='".$dataDB->id_jenis."'")." </span>";
			$row[] = "<span class='size'>  " . $dataDB->ket . " </span>";
			$row[] = "<span class='size'><center>  " . $img . " </center></span>";
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
	function viewTanggapi()
	{
		echo $this->load->view("viewTanggapi");
	}
	function viewEdit()
	{
		echo $this->load->view("viewEdit");
	}
	function insert()
	{
		echo $this->mdl->insert();
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
