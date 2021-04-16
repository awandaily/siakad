<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keu_set extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("keuangan"));
		$this->load->model("Model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function spp()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("spp");
		} else {
			$data['konten'] = "spp";
			$this->_template($data);
		}
	}

	public function getSiswa()
	{
		$id_kelas = $_POST["id_kelas"];

		$this->db->where("id_kelas", $id_kelas);
		$this->db->where_in("id_sts_data", array('1', '4'));
		$d = $this->db->get("data_siswa")->result();

		$op = "
			<select class='form-control show-tick' multiple id='src_siswa' data-live-search='true' data-actions-box='true' required=''>
				<option value=''>-- PILIH SISWA --</option>
		";

		foreach ($d as $v) {
			$op .= "<option value='" . $v->id . "'>" . $v->nama . "</option>";
		}

		$op .= "</select>";

		echo $op;
	}

	public function updateSpp()
	{
		echo $this->mdl->updateSpp();
	}

	public function getNamaSiswa()
	{
		$siswa = $_POST["siswa"];

		$r = "";
		for ($i = 0; $i < count($siswa); $i++) {
			$nama = $this->m_reff->goField("data_siswa", "nama", "WHERE id='" . $siswa[$i] . "'");
			$r .= "	<tr>
						<td align='center'>" . ($i + 1) . "</td>
						<td>" . $nama . "</td>
					</tr>
			";
		}

		echo $r;
	}

	public function edit_spp()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("edit_spp");
		} else {
			$data['konten'] = "edit_spp";
			$this->_template($data);
		}
	}

	public function index()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("biaya");
		} else {
			$data['konten'] = "biaya";
			$this->_template($data);
		}
	}


	public function konten()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("konten");
		} else {
			$data['konten'] = "konten";
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
	public function honor()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("honor");
		} else {
			$data['konten'] = "honor";
			$this->_template($data);
		}
	}
	public function mapel()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("mapel");
		} else {
			$data['konten'] = "mapel";
			$this->_template($data);
		}
	}
	public function jabatan()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("jabatan");
		} else {
			$data['konten'] = "jabatan";
			$this->_template($data);
		}
	}
	public function tempat_pkl()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("tempat_pkl");
		} else {
			$data['konten'] = "tempat_pkl";
			$this->_template($data);
		}
	}
	public function upload()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("upload");
		} else {
			$data['konten'] = "upload";
			$this->_template($data);
		}
	}
	function artikel()
	{
		$this->index();
	}

	function hapus()
	{
		$id = $this->input->post("id");
		$tbl = $this->uri->segment("3");
		echo $this->mdl->hapus($tbl, $id);
	}

	function hapus_tagihan()
	{
		$id = $this->input->post("id");
		echo $this->mdl->hapus_tagihan($id);
	}
	function hapus_mapel()
	{
		$id = $this->input->post("id");
		echo $this->mdl->hapus_mapel($id);
	}


	function data()
	{
		$tbl = $this->uri->segment("3");
		$list = $this->mdl->get_open($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$alias = isset($dataDB->alias) ? ($dataDB->alias) : "";
			$alias2 = "";
			if ($tbl == "keu_tr_kategori_pengeluaran" or $tbl == "keu_tr_pengeluaran") {
				$alias = $dataDB->kode;
			}
			if ($tbl == "keu_tr_pengeluaran") {
				$alias2 = $dataDB->kode_kategori;
			}
			$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
                                    <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $alias . '`,`' . $alias2 . '`)" class="btn bg-teal waves-effect waves-light">EDIT</button>
                                    <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" class="btn bg-blue-grey waves-effect waves-light">HAPUS</button>
                                    
                                </div>
                                
                            </div>';
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			if ($tbl == "keu_tr_pengeluaran") {
				$row[] = "<span class='size'>" . $this->m_reff->goField("keu_tr_kategori_pengeluaran", "kode", "where kode='" . $dataDB->kode_kategori . "'") . " </span>";
			}

			if ($tbl == "keu_tr_kategori_pengeluaran" or $tbl == "keu_tr_pengeluaran") {
				$row[] = "<span class='size'>" . $dataDB->kode . " </span>";
			}
			$row[] = "<span class='size'>" . $dataDB->nama . " </span>";
			if ($tbl == "tr_jurusan") {
				$row[] = "<span class='size'>" . $dataDB->alias . " </span>";
			}


			//add html for action
			$row[] = $tombol;
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdl->count_file($tbl),
			"recordsFiltered" => $this->mdl->count_file($tbl),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function editTagihan()
	{
		$this->load->view("editTagihan");
	}
	function editMapel()
	{
		$this->load->view("editMapel");
	}
	function add_biaya()
	{


		$echo = $this->mdl->add_biaya();
		echo json_encode($echo);
	}
	function update_tagihan()
	{


		$echo = $this->mdl->update_biaya();
		echo json_encode($echo);
	}
	function update_rombel()
	{
		$id_wali = $this->input->post("f[id_wali]");
		$this->db->query("UPDATE tm_kelas set id_wali='' where id_wali='" . $id_wali . "' ");
		echo $this->mdl->update_rombel();

		$idkelas = $this->input->post("id");


		$this->db->query("UPDATE data_pegawai set id_kelas='' where id_kelas='" . $idkelas . "' ");
		$this->db->query("UPDATE data_pegawai set id_kelas='" . $idkelas . "' where id='" . $id_wali . "' ");
	}


	function add_mapel()
	{
		$echo = $this->mdl->add_mapel();
		echo json_encode($echo);
	}
	function update_mapel()
	{
		$echo = $this->mdl->update_mapel();
		echo json_encode($echo);
	}

	/*------------------getRombel------------------------*/

	/*------------------------------*/
	/*------------------getMapel------------------------*/

	/*------------------------------*/

	function data_upload()
	{
		$tbl = $this->uri->segment("3");
		$list = $this->mdl->get_open($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			if ($dataDB->required == 1) {
				$r = "YA";
			} else {
				$r = "TIDAK";
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $dataDB->nama . " </span>";
			$row[] = "<span class='size'>" . $dataDB->type . " </span>";
			$row[] = "<span class='size'>" . $r . " </span>";
			//add html for action
			$row[] = '
			<div class="btn-group-vertical">
                                    <button onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $dataDB->type . '`,`' . $dataDB->id_persyaratan . '`,`' . $dataDB->required . '`)" type="button" class="btn bg-teal waves-effect">EDIT  </button>
                                    <button onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" type="button" class="btn bg-blue-grey waves-effect">HAPUS </button>
                                   
                                </div>
			 ';
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdl->count_file($tbl),
			"recordsFiltered" => $this->mdl->count_file($tbl),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function insert()
	{
		$tbl = $this->uri->segment(3);
		$data = $this->mdl->insert($tbl);
		echo json_encode($data);
	}


	function update()
	{
		$tbl = $this->uri->segment(3);
		$data = $this->mdl->update($tbl);
		echo json_encode($data);
	}

	function save_()
	{
		$id = $this->input->post("id");
		$val = $this->input->post("val");
		$val = $this->security->xss_clean($val);
		$this->db->set("val", $val);
		$this->db->where("id", $id);
		echo $this->db->update("pengaturan");
	}
	function import_data_mapel()
	{
		$data = $this->mdl->import_data_mapel();
		echo json_encode($data);
	}
	function setHonor()
	{
		$this->db->set("val", $this->input->post("honor"));
		$this->db->where("id", 5);
		echo $this->db->update("tm_pengaturan");
	}
	function getSubMapel()
	{
		$id_tk = $this->input->post("id_tk");
		$id_jurusan = $this->input->post("id_jurusan");
		$ray = "";
		$ray[""] = "---- Pilih Jika Sub Mapel ----";
		$this->db->where("id_tk", $id_tk);
		$this->db->where("id_jurusan", $id_jurusan);
		$this->db->where("id_mapel_induk", "");
		$data = $this->db->get("tr_mapel")->result();
		foreach ($data as $data) {
			$ray[$data->id] = $data->nama;
		}

		$dataray = $ray;
		echo form_dropdown("f[id_mapel_induk]", $dataray, "", 'class="form-control show-tick" data-live-search="true"  ');
		echo " <script>
		 $('select').selectpicker();
		 </script>";
	}
	public function kategori()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("kategori");
		} else {
			$data['konten'] = "kategori";
			$this->_template($data);
		}
	}
	public function alasan()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("alasan");
		} else {
			$data['konten'] = "alasan";
			$this->_template($data);
		}
	}

	public function item()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("item");
		} else {
			$data['konten'] = "item";
			$this->_template($data);
		}
	}
	function getTagihan()
	{
		$tbl = "keu_tr_biaya_tetap";
		$list = $this->mdl->get_tagihan($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			if ($dataDB->sts == 1) {
				$sts = "<span class='label bg-pink'>AKTIF</span>";
			} else {
				$sts = "<span class='label bg-blue-grey'>TIDAK AKTIF</span>";
			}

			$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
              <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->id_tk . '`,`' . $dataDB->id_jurusan . '`,`' . $dataDB->id . '`,`' . $dataDB->id . '` )" class="btn bg-teal waves-effect waves-light">EDIT</button>
              <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama_biaya . '`)" class="btn bg-blue-grey waves-effect waves-light">HAPUS</button>
										
                                </div>
                                
                            </div>';
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $dataDB->kode . " </span>";
			$row[] = "<span class='size'>" . $dataDB->nama_biaya . " </span>";
			$row[] = "<span class='size'>" . number_format($dataDB->biaya, 0, ",", ".") . " </span>";

			$row[] = "<span class='size'>" . $dataDB->kelipatan . " Kali</span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("tr_jurusan", "alias", "where id='" . $dataDB->id_jurusan . "'") . " </span>";
			$row[] = "<span class='size'>" . $dataDB->id_tk . " </span>";
			$row[] = "<span class='size'>" . $this->tanggal->bulan($dataDB->bln_penagihan) . " </span>";
			$row[] = "<span class='size'>" . $sts . " </span>";
			//add html for action
			$row[] = $tombol;
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdl->count_file_tagihan($tbl),
			"recordsFiltered" => $this->mdl->count_file_tagihan($tbl),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function setBesaranSpp()
	{
		$data = $this->mdl->setBesaranSpp();
		echo json_encode($data);
	}
}
