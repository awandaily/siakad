<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Du extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("admin", "pimpinan"));
		$this->load->model("M_model", "dm");
		$this->load->model("M_du", "du");
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}
	function dropdownHak($id)
	{
		$val = $this->dm->dataProfile($id);
		$dataMenu = $this->db->query("select * from main_level where id_level='3' or id_level='9' ");
		$dt = "";
		foreach ($dataMenu->result() as $op) {
			$dt[$op->id_level] = $op->nama;
		}
		$array = $dt;
		echo form_dropdown("level", $array, isset($val->level) ? ($val->level) : "", "class='form-control'");
	}


	function update($id)
	{
		$data = $this->dm->update($id);
		echo json_encode($data);
	}
	function insert()
	{
		$data = $this->dm->insert();
		echo json_encode($data);
	}

	function saveSession()
	{
		$idprov = $this->input->get_post("idprov");
		$idkab = $this->input->get_post("idkab");
		$idkec = $this->input->get_post("idkec");
		$kondisi = $this->input->get_post("kondisi");
		$data = array(
			"idprov" => $idprov,
			"idkab" => $idkab,
			"kondisi" => $kondisi,
			"idkec" => $idkec,
		);
		$this->session->set_userdata($data);
		echo true;
	}
	function unsetSession()
	{

		$data = array("idprov", "idkab", "idkec", "kondisi", "idkec");
		$this->session->unset_userdata($data);
		echo true;
	}

	public function index()
	{
		$this->unsetSession();
		$data['konten'] = "index";
		$this->_template($data);
	}

	function ajax_open()
	{
		$levels = $this->session->userdata("level");
		$list = $this->dm->get_open();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$level = $dataDB->level;
			if ($level == "3") {
				$icon = "<img style='max-width:25px' src='" . base_url() . "file_upload/icon/" . $this->du->getMarker($dataDB->jenjang) . "'>";
				$nakal = "<span class='size'>" . $dataDB->nama_madrasah . "</a></span>";
				$nakat = "<span class='size'>" . $this->du->getNamaKatogry($dataDB->jenjang) . "</span>";
			} else {
				$nakal = $nakat = "";
				$icon = "<img style='max-width:35px' src='" . base_url() . "file_upload/dp/" . $dataDB->poto . "'>";
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = $icon . " " . $nakat;


			$row[] = "<span class='size'><a href='" . base_url() . "?nsm=" . $dataDB->nsm . "' target='_blank' > " . $dataDB->nama_madrasah . "</a></span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("tm_wilayah", "nama_prov", "idprov='" . $dataDB->kode_provinsi . "'") . "</a></span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("tm_wilayah", "nama_kab", "idprov='" . $dataDB->kode_provinsi . "' and idkab='" . $dataDB->kode_kabupaten . "'") . "</a></span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("tm_wilayah", "nama_kec", "idprov='" . $dataDB->kode_provinsi . "' and idkab='" . $dataDB->kode_kabupaten . "' and idkec='" . $dataDB->kode_kecamatan . "'") . "</a></span>";

			$row[] = "<span class='size'>" . $dataDB->telp . "</a></span>";

			if ($levels == 'pimpinan') {
				//add html for action
				$row[] = '
			
			 <div class="btn-group">
                                    <button type="button" class="btn bg-teal dropdown-toggle" onclick="edit(`' . $dataDB->id_admin . '`)" >
                                        Detail  
                                    </button>
                                    
                                </div>
		 
			 ';
			} else {
				$row[] = '
			
			 <div class="btn-group">
                                    <button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        OPSI <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class=" waves-effect waves-block" href="javascript:edit(`' . $dataDB->id_admin . '`);">Edit</a></li>
                                        <li><a class=" waves-effect waves-block" href="javascript:deleted(`' . $dataDB->id_admin . '`);">Hapus</a></li>
                                     
                                    </ul>
                                </div>
		 
			 ';
			}
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dm->count_file(),
			"recordsFiltered" => $this->dm->count_file(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function ajax_edit($id)
	{
		$data = $this->dm->getDataUser($id);
		echo json_encode($data);
	}
	function download()
	{
		echo $this->dm->download();
	}
	function deleted_UG($id)
	{
		$this->m_konfig->log("admin", "Delete data user (pengguna) ", $this->session->userdata("id"));
		$data = $this->du->deleted_UG($id);
		echo json_encode($data);
	}
}
