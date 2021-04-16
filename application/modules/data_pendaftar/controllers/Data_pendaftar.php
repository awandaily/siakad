<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_pendaftar extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("pusat", "admin", "kanwil"));
		$this->load->model("Model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{
		$this->session->unset_userdata("sts_table");
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}
	function hapus()
	{
		$id = $this->input->post("id");
		echo $this->mdl->hapus($id);
	}
	function data()
	{
		$list = $this->mdl->get_open();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$sts = $dataDB->sts;

			$tombol = '<button onclick="tinjau(`' . $dataDB->id . '`)" type="button" class="btn bg-pink 
					waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
					aria-expanded="true">
                    <span class="sr-only"><i class="material-icons">remove_red_eye</i> Lihat</span>
                    </button>';


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = $tombol;
			$row[] = "<span class='size'><b> fgf gf gfg fg f g f gf g fg </b> </span>";
			$row[] = "<span class='size'> " . $this->m_reff->goField("tr_jk", "nama", "where id='" . $dataDB->jk . "'") . " </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("admin", "owner", "where id_admin='" . $dataDB->madrasah_peminatan . "'") . "  </span>";
			$row[] = "<span class='size'>" . $dataDB->hp . " </span>";
			$row[] = "<span class='size'> " . $dataDB->tempat_lahir . ", " . $this->tanggal->ind($dataDB->tgl_lahir, "/") . "</span>";
			$row[] = "<span class='size'> " . $dataDB->tempat_tugas . " </span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("tr_kategory", "nama", "where id='" . $dataDB->jabatan . "'") . " </span>";



			//add html for action

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

	function save_artikel()
	{
		$data = $this->mdl->save_artikel();
		echo json_encode($data);
	}

	function edit()
	{
		$id = $this->input->post("id");
		$data_array["data"] = $this->mdl->getArtikel($id);
		echo $this->load->view("modalEdit", $data_array);
	}
	function set_table()
	{
		$sts = $this->input->post("id");
		echo $this->session->set_userdata("sts_table", $sts);
	}
	function tinjau()
	{
		$id = $this->input->post("id");
		$data_array["data"] = $this->mdl->getPeserta($id);
		echo	$this->load->view("tinjau", $data_array);
	}

	function set_sts()
	{
		$this->db->where("id", $this->input->post("id"));
		$this->db->set("sts", $this->input->post("sts"));
		$this->db->set("alasan", $this->security->xss_clean($this->input->post("alasan")));
		echo $this->db->update("tm_peserta");
	}
}
