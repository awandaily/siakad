<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Posting extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("peserta"));
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
	function update_artikel()
	{
		$data = $this->mdl->update_artikel();
		echo json_encode($data);
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
			if ($dataDB->upd) {
				$tgl = $this->tanggal->ind(substr($dataDB->upd, 0, 10), "/");
			} else {
				$tgl = $this->tanggal->ind(substr($dataDB->tgl_posting, 0, 10), "/");
			}
			if ($dataDB->sts != 3) {
				$ctt = "<br><i>(Menunggu<font color='white'>_</font>Persetujuan)</i>";
			} else {
				$ctt = "";
			}

			if ($dataDB->sts == 3) {
				if ($dataDB->dilombakan == 1) {
					$sts = "<i class='font-bold col-purple'>Dilombakan</i>" . $ctt;
				} else {
					$sts = $this->m_reff->goField("tr_status", "nama", "where id='" . $dataDB->sts . "'");
				}
			} else {
				$sts = $this->m_reff->goField("tr_status", "nama", "where id='" . $dataDB->sts . "'");
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'><b>" . $dataDB->judul . "</b> </span>";
			$row[] = "<span class='size'>" . $this->m_reff->goField("tr_kategory", "nama", "where id='" . $dataDB->id_kategory . "'") . " </span>";
			$row[] = "<span class='size'>  " . $dataDB->bintang . "  </span>";
			$row[] = "<span class='size'>" . $dataDB->komentar . " </span>";
			$row[] = "<span class='size'>" . $dataDB->suka . " </span>";
			$row[] = "<span class='size'>" . $dataDB->tidak . "  </span>";
			$row[] = "<span class='size'>" . $sts . " </span>";
			$row[] = "<span class='size'>" . $tgl . " </span>";


			//add html for action
			$row[] = '
				<button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->dilombakan . '`)" class="btn bg-teal btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">edit</i>
                                </button>
								<button onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->judul . '`)" type="button" title="hapus" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">delete</i>
                                </button>
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
		$data_array["data"] = $this->mdl->getArtikel($id);
		echo $this->load->view("modalEdit", $data_array);
	}
	function calc($id)
	{
		$idu = $this->session->userdata("id");
		$batas = $this->m_reff->goField("tm_pengaturan", "val", "where id='1' ");
		$jml = $this->db->query("SELECT * from tm_artikel where id_admin='" . $idu . "' and dilombakan='1' ")->num_rows();
		if ($id == 1) {
			echo "true";
		} else {

			if ($jml >= $batas) {
				echo "false";
			} else {
				echo "true";
			}
		}
	}
	function set_table()
	{
		$sts = $this->input->post("id");
		echo $this->session->set_userdata("sts_table", $sts);
	}

	function count_table()
	{
		$sts = array();
		$sts1 = $this->m_reff->goField("jml_sts_artikel", "jml", "where sts='1'");
		$sts2 = $this->m_reff->goField("jml_sts_artikel", "jml", "where sts='3'");
		$sts3 = $this->m_reff->goField("jml_sts_artikel", "jml", "where sts='4'");
		$sts4 = $this->m_reff->goField("jml_sts_artikel", "jml", "where sts='2'");
		if ($sts1 == "") {
			$sts["ke1"] = 0;
		} else {
			$sts["ke1"] = $sts1;
		};
		if ($sts2 == "") {
			$sts["ke3"] = 0;
		} else {
			$sts["ke3"] = $sts2;
		};
		if ($sts3 == "") {
			$sts["ke4"] = 0;
		} else {
			$sts["ke4"] = $sts3;
		};
		if ($sts4 == "") {
			$sts["ke2"] = 0;
		} else {
			$sts["ke2"] = $sts4;
		};
		echo  json_encode($sts);
	}
}
