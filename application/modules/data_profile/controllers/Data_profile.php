<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_profile extends CI_Controller
{



	function __construct()
	{
		parent::__construct();

		$this->load->model("Model", "mdl");
		$this->load->model("Model_extra", "mdl_extra");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{
		$this->m_konfig->validasi_session(array("peserta"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}

	public function berkas()
	{
		$this->m_konfig->validasi_session(array("peserta"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("berkas");
		} else {
			$data['konten'] = "berkas";
			$this->_template($data);
		}
	}


	public function sertifikat()
	{
		$this->m_konfig->validasi_session(array("peserta"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("sertifikat");
		} else {
			$data['konten'] = "sertifikat";
			$this->_template($data);
		}
	}


	public function data()
	{
		$this->m_konfig->validasi_session(array("panitia", "admin"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("profile_panitia");
		} else {
			$data['konten'] = "profile_panitia";
			$this->_template($data);
		}
	}


	function update()
	{
		$this->m_konfig->validasi_global();
		$this->m_konfig->logPeserta("tm_peserta", "update biodata ", $this->session->userdata("id"));
		$data = $this->mdl->update();
		echo json_encode($data);
	}

	function upload()
	{
		$this->m_konfig->validasi_global();
		$idu = $this->session->userdata("id");
		$idt = $this->input->get("idt");
		$idp = $this->input->get("idp");
		$data = $this->mdl->upload_file("myfile", "peserta", $idu, $idt, $idp);
		echo json_encode($data);
	}



	function reload()
	{
		$this->m_konfig->validasi_global();
		$idu = $this->session->userdata("id");
		$idupload = $this->input->get("idupload");
		$id_persyaratan = $this->input->get("id_persyaratan");
		$file = $this->m_reff->goField("tm_data_upload", "nama_file", "where id_persyaratan='" . $id_persyaratan . "' and id_upload='" . $idupload . "' and id_admin='" . $idu . "' ");
		$filex = substr($file, -3);
		if (strtoupper($filex) == "PDF") {
			echo '<iframe  width="100%" style="max-height:200px"  id="iframepdf" src="' . base_url() . 'file_upload/peserta/' . sprintf('%06s', $idu) . '/' . $file . '"></iframe>';
		} else {
			echo  "<center><img class='img-responsive thumbnail' width='100%' style='max-height:200px' src='" . base_url() . "file_upload/peserta/" . sprintf("%06s", $idu) . "/" . $file . "'></center>";
		}
	}


	function data_sertifikat()
	{
		$list = $this->mdl->get_open_sertifikat();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////



			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'><a href='" . base_url() . "file_upload/peserta/" . sprintf("%06s", $dataDB->id_admin) . "/" . $dataDB->file . "' target='_blank'>
			<img width='100px' class='img-responsive thumbnail' src=" . base_url() . "file_upload/peserta/" . sprintf("%06s", $dataDB->id_admin) . "/" . $dataDB->file . "></a> </span>";
			$row[] = "<span class='size'> <b>" . $dataDB->nama . "</b>  </span>";
			$row[] = "<span class='size'>" . strip_tags($dataDB->ket) . "</span>";


			//add html for action
			$row[] = '
		 
								<button onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" type="button" title="hapus" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">delete</i>
                                </button>
			 ';
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdl->count_file_sertifikat(),
			"recordsFiltered" => $this->mdl->count_file_sertifikat(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	function save_sertifikat()
	{
		$data = $this->mdl->save_sertifikat();
		echo json_encode($data);
	}

	function hapus_sertifikat()
	{
		$id = $this->input->post("id");
		echo $this->mdl->hapus_sertifikat($id);
	}
}
