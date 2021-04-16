<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_peserta extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("panitia"));
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


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'><img class='img' width='100px' src='" . base_url() . "file_upload/dp/" . $dataDB->poto . "'></span>";
			$row[] = "<span class='size'> " . $dataDB->owner . "  </span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("tr_jk", "nama", "where id='" . $dataDB->jk . "'") . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->telp . "  </span>";
			$row[] = "<span class='size'>" . $dataDB->email . " </span>";
			$row[] = "<span class='size'>" . $dataDB->alamat . "</span>";
			$row[] = "<span class='size'>" . $this->tanggal->ind(substr($dataDB->upd, 0, 10), "/") . " </span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("tr_kategory_penulis", "nama", "where id='" . $dataDB->id_kategory_penulis . "'") . " </span>";


			//add html for action
			$row[] = '
			<div class="btn-group-vertical">
                                    <button onclick="edit(`' . $dataDB->id_admin . '`)" type="button" class="btn bg-teal waves-effect">EDIT  </button>
                                    <button onclick="hapus(`' . $dataDB->id_admin . '`,`' . $dataDB->owner . '`)" type="button" class="btn bg-blue-grey waves-effect">HAPUS </button>
                                   
                                </div>
			 ';
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
	function tes()
	{



		$userDoc = 'file_upload/dok/20180327184922_76__print.docx';
		$fileHandle = fopen($userDoc, "r");
		$line = @fread($fileHandle, filesize($userDoc));
		$lines = explode(chr(0x0D), $line);
		$outtext = "";
		foreach ($lines as $thisline) {
			$pos = strpos($thisline, chr(0x00));
			if (($pos !== FALSE) || (strlen($thisline) == 0)) {
			} else {
				$outtext .= $thisline . " ";
			}
		}
		$outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", "", $outtext);
		echo $outtext;


		$userDoc = "cv.doc";

		$text = parseWord($userDoc);
		echo $text;
	}
	function edit()
	{
		$id = $this->input->post("id");
		$data = $this->mdl->getData($id);
		echo json_encode($data);
	}

	function update_peserta()
	{
		$data = $this->mdl->update_peserta();
		echo json_encode($data);
	}
}
