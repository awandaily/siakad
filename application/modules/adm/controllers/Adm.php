<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adm extends CI_Controller
{


	var $tbl_cbt = "data_cbt";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("siswa", "ORTU"));
		$this->load->model("model", "mdl");
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

	public function transaksi()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("transaksi");
		} else {
			$data['konten'] = "transaksi";
			$this->_template($data);
		}
	}
	function tagihan()
	{
		$this->index();
	}

	function data_tagihan()
	{
		$list = $this->mdl->get_data_tagihan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {


			$tombol = '<button onclick="tinjau(`' . $dataDB->id . '`,`' . $dataDB->nama_tagihan . '`)" type="button" class="btn bg-pink btn-xs btn-block
					waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
					aria-expanded="true">
                    <span class="sr-only"><i class="material-icons">payment</i> Bayar    </span>
                    </button>';


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			//	$row[] = $tombol ;

			$row[] = "<span class='size'>  " . $dataDB->nama_tagihan . "   </span>";
			$row[] = "<span class='size'>  " . number_format($dataDB->nominal, 0, ",", ".") . "   </span>";
			$row[] = "<span class='size'>  " . number_format($t = $this->mdl->telahDibayar($dataDB->id), 0, ",", ".") . "   </span>";
			$row[] = "<span class='size'>  " . number_format($dataDB->nominal - $t, 0, ",", ".") . "   </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("tr_sts_tagihan", "nama", "where id='" . $dataDB->sts . "'") . "   </span>";
			$row[] = "<span class='size'>  " . strip_tags($dataDB->ket) . "  </span>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_tagihan(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}



	function data_transaksi()
	{
		$list = $this->mdl->get_data_transaksi();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {

			$tombol = '<button onclick="lihat(`' . $dataDB->id_bayar . '`,`' . $dataDB->nama_tagihan . '`)" type="button" class="btn bg-grey btn-xs btn-block
					waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
					aria-expanded="true">
                    <span class="sr-only"><i class="material-icons">payment</i> Detail pembayaran    </span>
                    </button>';




			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>  " . $this->tanggal->ind($dataDB->tgl_bayar, "/") . "   </span>";
			$row[] = "<span class='size'>  " . $dataDB->nama_tagihan . "   </span>";
			$row[] = "<span class='size'>  " . number_format($dataDB->jml_bayar, 0, ",", ".") . "   </span>";
			$row[] = "<span class='size'>  " . str_replace("Lunas", "Diterima", $dataDB->nama_status) . "   </span>";
			$row[] = $tombol;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_trx(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	function lihat_catatan_bayar()
	{
		$id = $this->input->post("id");
		$nama = $this->input->post("nama");
		$data_array["id"] = $id;
		$data_array["nama"] = $nama;
		echo	$this->load->view("catatan_bayar", $data_array);
	}

	function tinjau()
	{
		$id = $this->input->post("id");
		$nama = $this->input->post("nama");
		$data_array["id"] = $id;
		$data_array["nama"] = $nama;
		echo	$this->load->view("tinjau", $data_array);
	}

	function insKonfirmasi()
	{
		$token = $this->m_reff->cekToken();
		if ($token == false) {
			$data = array("token" => false);
		} else {
			$data = $this->mdl->insKonfirmasi();
		}
		echo json_encode($data);
	}
}
