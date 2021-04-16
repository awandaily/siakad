<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Referensi extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("admin", "pusat"));
		$this->load->model("Model", "mdl");
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
			echo	$this->load->view("artikel");
		} else {
			$data['konten'] = "artikel";
			$this->_template($data);
		}
	}
	public function rombel()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("rombel");
		} else {
			$data['konten'] = "rombel";
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
	public function eskul()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("eskul");
		} else {
			$data['konten'] = "eskul";
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
	public function kmapel()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("kmapel");
		} else {
			$data['konten'] = "kmapel";
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

	function hapus_kelas()
	{
		$id = $this->input->post("id");
		$this->db->query("UPDATE IGNORE  data_pegawai set id_kelas='' where id_kelas='" . $id . "'");
		echo $this->mdl->hapus_kelas($id);
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
			$lokasi = isset($dataDB->lokasi) ? ($dataDB->lokasi) : "";
			$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
                                    <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $alias . '`,`' . $lokasi . '`)" class="btn bg-teal waves-effect waves-light">EDIT</button>
                                    <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" class="hide btn bg-blue-grey waves-effect waves-light">HAPUS</button>
                                    
                                </div> 
                            </div>';
			if ($tbl == "tr_ektrakurikuler") {
				$tombol = '<div  >
                                
                                    <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $dataDB->kode . '`,`' . $dataDB->pembina . '`,`' . $dataDB->honor . '`,`' . $dataDB->honor_maksimal . '`,`' . $dataDB->username . '`,`' . $dataDB->password . '`)" class="btn btn-block bg-teal waves-effect waves-light">EDIT</button>
                                    <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" class="btn btn-block bg-blue-grey waves-effect waves-light">HAPUS</button>
                                    
                             
                                
                            </div>';
			}
			if ($tbl == "tr_kategory_mapel") {
				$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
                                    <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $dataDB->kode . '`)" class="btn bg-teal waves-effect waves-light">EDIT</button>
                                    <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" class="btn bg-blue-grey waves-effect waves-light">HAPUS</button>
                                    
                                </div> 
                            </div>';
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			if ($tbl == "tr_kategory_mapel") {
				$row[] = "<span class='size'>" . $dataDB->kode . " </span>";
			}
			$row[] = "<span class='size'>" . $dataDB->nama . " </span>";
			if ($tbl == "tr_jurusan") {
				$row[] = "<span class='size'>" . $dataDB->alias . " </span>";
				if ($dataDB->kbm == "true") {
					$cekkbm = "checked";
				} else {
					$cekkbm = "";
				}
				$tkbm = '<div class="switch">
                                    <label>TIDAK  <input  id="idkbm' . $dataDB->id . '" onchange="cekKbm(`' . $dataDB->id . '` )" type="checkbox" ' . $cekkbm . ' ><span class="lever"></span>REALTIME</label>
                                </div>';
				$row[] = "<span class='size'>" . $tkbm . " </span>";
			}


			if ($tbl == "tr_mitra") {
				$row[] = "<span class='size'>" . $dataDB->lokasi . " </span>";
			}

			if ($tbl == "tr_ektrakurikuler") {
				$row[] = "<span class='size'>" . $this->m_reff->goField("data_pegawai", "nama", "where nip='" . $dataDB->kode . "'") . " </span>";
				//	 $row[] = "<span class='size'>".$dataDB->pembina." </span>";
				$row[] = "<span class='size'>" . $dataDB->honor . " </span>";
				$row[] = "<span class='size'>" . $dataDB->honor_maksimal . " </span>";
				//	 $row[] = "<span class='size'>".$dataDB->username." </span>";
				//	 $row[] = "<span class='size'>".$dataDB->password." </span>";
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
	function setModeKbm()
	{
		echo  $this->mdl->setModeKbm();
	}
	function editRombel()
	{
		$this->load->view("editRombel");
	}
	function editMapel()
	{
		$this->load->view("editMapel");
	}
	function add_kelas()
	{


		echo $this->mdl->add_kelas();
		$db = $this->db->query("SELECT max(id) as id_kelas from tm_kelas")->row();
		$idkelas = isset($db->id_kelas) ? ($db->id_kelas) : "";
		$id_wali = $this->input->post("f[id_wali]");
		$this->db->query("UPDATE IGNORE    data_pegawai set id_kelas='" . $idkelas . "' where id='" . $id_wali . "' ");
	}
	function update_rombel()
	{
		$id_wali = $this->input->post("f[id_wali]");
		$this->db->query("UPDATE IGNORE  tm_kelas set id_wali=null where id_wali='" . $id_wali . "' ");
		echo $this->mdl->update_rombel();

		$idkelas = $this->input->post("id");


		$this->db->query("UPDATE IGNORE  data_pegawai set id_kelas='' where id_kelas='" . $idkelas . "' ");
		$this->db->query("UPDATE IGNORE  data_pegawai set id_kelas='" . $idkelas . "' where id='" . $id_wali . "' ");
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
	function update_status_kelas()
	{
		echo $this->mdl->update_status_kelas();
	}

	/*------------------getRombel------------------------*/
	function getRombel()
	{
		$tbl = "v_kelas";
		$list = $this->mdl->get_rombel($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////

			$tombol = '<div class="demo-button-groups ">
                                <div class="btn-group" role="group">
              <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->id_tk . '`,`' . $dataDB->id_jurusan . '`,`' . $dataDB->nama_kelas . '`,`' . $dataDB->id_wali . '` )" class="btn bg-teal waves-effect waves-light">EDIT</button>
              <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" class="hide btn bg-blue-grey waves-effect waves-light">HAPUS</button>
										
                                </div>
                                
                            </div>';

			if ($dataDB->sts_kelas == "1") {
				$cek_sts = "checked";
			} else {
				$cek_sts = "";
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $dataDB->id . " </span>";
			$row[] = "<span class='size'>" . $dataDB->nama_tingkat . " </span>";
			$row[] = "<span class='size'>" . $dataDB->alias . " </span>";
			$row[] = "<span class='size'>" . $dataDB->nama_kelas . " </span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("data_pegawai", "nama", "where id='" . $dataDB->id_wali . "'") . " </span>";
			$row[] = "<span class='size'>
						<div class='switch'>
                            <label>
                            	NONAKTIF
                            	<input id='idsts" . $dataDB->id . "' onchange='upd_sts(`" . $dataDB->id . "` )' type='checkbox' " . $cek_sts . " >
                            	<span class='lever'></span>
                            	AKTIF
                            </label>
                        </div>
					</span>";

			//add html for action
			$row[] = $tombol;
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdl->count_file_rombel($tbl),
			"recordsFiltered" => $this->mdl->count_file_rombel($tbl),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	/*------------------------------*/
	/*------------------getMapel------------------------*/

	function update_sikap()
	{
		echo $this->mdl->update_sikap();
	}

	function getMapel()
	{
		$tbl = "tr_mapel";
		$list = $this->mdl->get_mapel($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////

			$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
              <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->id_tk . '`,`' . $dataDB->id_jurusan . '`,`' . $dataDB->nama . '`,`' . $dataDB->k_mapel . '` )" class="btn bg-teal waves-effect waves-light">EDIT</button>
              <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" class="btn hide bg-blue-grey waves-effect waves-light">HAPUS</button>
										
                                </div>
                                
                            </div>';

			if ($dataDB->id_sikap == "1") {
				$cek_sikap = "checked";
			} else {
				$cek_sikap = "";
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField('tr_tingkat', 'nama', 'where id=' . $dataDB->id_tk . '') . " </span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField('tr_jurusan', 'alias', 'where id=' . $dataDB->id_jurusan . '') . " </span>";
			$row[] = "<span class='size'>" . $dataDB->nama . " </span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("tr_kategory_mapel", "nama", "where kode='" . $dataDB->k_mapel . "'") . " </span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField('tr_mapel', 'nama', 'where id="' . $dataDB->id_mapel_induk . '"') . " </span>";
			$row[] = "<span class='size'>
					<div class='switch'>
		                <label>
		                	Tidak
		                	<input id='idsts" . $dataDB->id . "' onchange='upd_sikap(`" . $dataDB->id . "` )' type='checkbox' " . $cek_sikap . " >
		                	<span class='lever'></span>
		                	Ya
		                </label>
		            </div>
				</span>";

			//add html for action
			$row[] = $tombol;
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdl->count_file_mapel($tbl),
			"recordsFiltered" => $this->mdl->count_file_mapel($tbl),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
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
	function download_format_mapel()
	{
		echo $this->mdl->download_format_mapel();
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
}
