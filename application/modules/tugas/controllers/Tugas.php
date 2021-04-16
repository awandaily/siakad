<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tugas extends CI_Controller
{


	var $tbl = "data_tugas";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("GURU", "SISWA"));
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


	function cekTugas($id)
	{
		$this->db->where("id_siswa", $this->idu());
		$this->db->where("id_tugas", $id);
		return  $this->db->get("data_tugas_siswa")->num_rows();
	}
	function cekNilai($id)
	{
		$this->db->where("id_siswa", $this->idu());
		$this->db->where("id_tugas", $id);
		$return = $this->db->get("data_tugas_siswa")->row();
		return isset($return->nilai) ? ($return->nilai) : "";
	}
	///-----------------------CATATAN PENILIAAN--------------------------///
	function getCatatan()
	{
		$mobile = $this->m_reff->mobile();
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$mapel = "<div class='col-teal'>" . $this->m_reff->goField('tr_mapel', "nama", "where id='" . $dataDB->id_mapel . "'") . "</div>";
			$metode = "";
			$sumber = $dataDB->metode_pengerjaan;
			$warna = "";
			if ($sumber == 1) {

				$warna = "bg-blue-grey hide ";
				$teksupload = "TUGAS DIKUMPULKAN  ";
				$icon = '';
				$click = "";
				$metode = '<br> <li class="active">> Pengerjaan : Dikumpulkan Langsung</li>';
			} else {

				if ($cek = $this->cekTugas($dataDB->id)) {
					$warna = " bg-green ";
					$teksupload = "CEK ULANG TUGAS";
					$icon = '<i class="material-icons">check</i>';
				} else {
					$warna = " bg-brown ";
					$teksupload = "KERJAKAN TUGAS DISINI";
					$icon = '<i class="material-icons">file_upload</i>';
				}
				$click = 'onclick="upload(`' . $dataDB->id . '`,`' . $dataDB->judul . '`,`' . $cek . '`,`' . $dataDB->ket . '`,`' . $mapel . '`)"';
			}



			if ($n = $this->cekNilai($dataDB->id)) {
				$teksupload = "NILAI : " . $n;
				$icon = "";
				$click = '';
				$warna = " bg-teal";
			}

			if ($mobile) {
				$tt = '
               <div class="col-md-12 col-xs-12 ">    <button type="button" ' . $click . ' class="btn  btn-block  col-xs-12 ' . $warna . ' waves-effect"  style="min-width:70px">
                  ' . $icon . ' 
               ' . $teksupload . '  </button> </div>';
			} else {
				$tt = '
              <div class="col-md-3 col-xs-3 ">    <button type="button"  ' . $click . ' class="btn  btn-block ' . $warna . '  col-xs-3 bg-pink waves-effect"  style="min-width:70px">
                ' . $icon . ' 
                ' . $teksupload . '  </button> </div>';
			}


			$dakel = $this->m_reff->clearkomaray($dataDB->kelas);
			$kls = "";
			foreach ($dakel as $vis) {
				$kls .= $this->m_reff->goField("v_kelas", "nama", "where id='" . $vis . "' ") . ", ";
			}
			$kls = substr($kls, 0, -2);
			$nama = ""; //$this->m_reff->goField("data_siswa","nama","where id='".$dataDB->id_siswa."' ");

			$hari = $this->tanggal->selisih(date('Y-m-d'), $dataDB->expired);
			if ($hari > 0) {
				$sts = "<span class='col-indigo'>" . $hari . " Hari lagi</span>";
			} else {
				$sts = "<span class='col-red'>Expired</span>";
			}


			if ($dataDB->file) {
				$file = '<li > <i class="material-icons">attachment</i> 
		    <a download="" href="' . base_url() . 'file_upload/tugas/' . $dataDB->id . '/' . $dataDB->file . '?download=true" class="col-pink" > Download File disini </a></li>';
			} else {
				$file = " > ";
			}

			$file = '<ol class="breadcrumb breadcrumb-col-teal">
                                ' . $file . '
                                 
                                <li class="active"> Batas pengerjaan : ' . $sts . '</li>
                                ' . $metode . '
                            </ol>';

			$sts = $hari;
			$tombol = ' 
          <div class="card" style="border:black solid 1px">
                        <div class="headerj bg-white" style="border-bottom:black solid 1px;padding:10px">
                        <b style="font-size:14px" class="col-black">  ' . $dataDB->judul . '</b>
                          
                            ' . $mapel . '
                        </div>
                        <div class="bodys" style="padding:10px">
                        ' . $dataDB->ket . $file . '
                        </div>
        ' . $tt . '
                               <div class="row clearfix">&nbsp;</div>     
                 <div class="row clearfix">&nbsp;</div>     
                    </div>';

			$row = array();
			$row[] = $tombol;

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
	function insert()
	{
		$echo = $this->mdl->insert();
		echo json_encode($echo);
	}

	function hapus()
	{
		$id = $this->input->post("id");
		echo $this->mdl->hapus($id);
	}
	function getTugas()
	{
		$id = $this->input->post("id");
		$this->db->where("id_tugas", $id);
		$this->db->where("id_siswa", $this->mdl->idu());
		$data = $this->db->get("data_tugas_siswa")->row();
		$echo1 = isset($data->file) ? ($data->file) : "";
		$echo2 = isset($data->ket) ? ($data->ket) : "";
		echo $echo1 . "::" . $echo2;
	}
}
