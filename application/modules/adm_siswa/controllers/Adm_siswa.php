<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adm_siswa extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("ortu", "siswa"));
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{

		$this->load->view('template/main', $data);
	}

	public function rincian()
	{
		echo "<b class='col-pink'>DATA MASIH PROSES PENCOCOKAN, MOHON ABAIKAN DATA DIBAWAH INI KARENA BELUM FINAL</b>";
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("rincian");
		} else {
			$data['konten'] = "rincian";
			$this->_template($data);
		}
	}
	public function index()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("riwayat");
		} else {
			$data['konten'] = "riwayat";
			$this->_template($data);
		}
	}
	function data_pembayaran()
	{
		echo "<b class='col-pink'>DATA MASIH PROSES PENCOCOKAN, MOHON ABAIKAN DATA DIBAWAH INI KARENA MUNGKIN SAJA KELIRU</b>";
		return $this->index();
	}


	function getHistory()
	{
		$list = $this->mdl->getHistory();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {


			$tombol = '<button onclick="rincian(`' . $dataDB->tgl_bayar . '`,`' . $dataDB->id_siswa . '`)" type="button" class="btn bg-pink btn-xs btn-block
					waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
					aria-expanded="true">
                    <span class="sr-only"><i class="material-icons">book</i> Rincian    </span>
                    </button>';

			if ($dataDB->gnr == 1) {
				$tgl_bayar = "";
			} else {
				$tgl_bayar = "<i>" . br() . $this->tanggal->hariLengkapBulan($dataDB->tgl_bayar, " ") . "</i>";
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<a href='javascript:rincian(`" . $dataDB->tgl_bayar . "`,`" . $dataDB->id_siswa . "`)'><span class='size col-black' style='font-size:15px'> <b>Rp " . number_format($dataDB->nominal, 0, ",", ".") . " </b>  </span>" . $tgl_bayar . "</a>";


			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count__getHistory(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getJml()
	{
		$id_siswa = $this->m_reff->id_siswa_ortu();

		$data = $this->db->query("select sum(nominal_bayar) as bayar from keu_tm_bayar where id_siswa='" . $id_siswa . "'  ")->row();
		echo  "Rp " . number_format($data->bayar, 0, ",", ".");
	}
	function getRincian()
	{
		$data["tgl"] = $this->input->get_post("tgl");
		$data["id_siswa"] = $this->input->get_post("id_siswa");
		echo $this->load->view("getRincian", $data);
	}
}
