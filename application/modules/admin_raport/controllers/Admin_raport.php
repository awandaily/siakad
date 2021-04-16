<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_raport extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("admin", "pusat"));
		$this->load->model("Model", "mdl");
		$this->load->model("Model_siswa", "mdl_siswa");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{

		echo	$this->load->view("filter_kelas");
	}

	public function dataSiswa()
	{
		echo	$this->load->view("data_siswa");
	}

	public function dataLegger()
	{
		echo	$this->load->view("cetak_legger");
	}

	function getDataSiswa_cetak()
	{
		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		foreach ($list as $dataDB) {
			////

			$cetak = "";
			$id_kelas_1 = $dataDB->id_kelas_1;
			$id_tahun_1 = $dataDB->id_tahun_1;
			$id_kelas_2 = $dataDB->id_kelas_2;
			$id_tahun_2 = $dataDB->id_tahun_2;
			$id_kelas_3 = $dataDB->id_kelas_3;
			$id_tahun_3 = $dataDB->id_tahun_3;
			if ($id_kelas_1) {
				$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_1 . "' and id_semester='1' ")->num_rows();
				if ($cek) {

					$cetak .=	"
                    <span class='btn-group' role='group'>
                        <button id='btnGroupVerticalDrop1' type='button' class='btn bg-teal waves-effect dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						<i class='material-icons'>picture_as_pdf</i>   X - Ganjil</a> <span class='caret'></span>
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='btnGroupVerticalDrop1'>
                            <li><a target='_blank' href='" . base_url() . "admin_raport/cetak_lagger?
							id=" . $dataDB->id . "&id_kelas=" . $id_kelas_1 . "&id_semester=1&id_tahun="
						. $id_tahun_1 . "&id_tk=1&download=true'  >Cetak Lagger</a></li>
							<li><a target='_blank' href='" . base_url() . "raport/cetak_raport?
							id=" . $dataDB->id . "&id_kelas=" . $id_kelas_1 . "&id_semester=1&id_tahun="
						. $id_tahun_1 . "&id_tk=1&download=true'
							  > Cetak Raport </a></li>
                        </ul>
                   
					</span>";




					// 			$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
					// id=" . $dataDB->id . "&id_kelas=" . $id_kelas_1 . "&id_semester=1&id_tahun=" . $id_tahun_1 . "&id_tk=1&download=true' class='btn bg-light-green waves-effect '> 
					// <i class='material-icons'>picture_as_pdf</i>   X - Ganjil</a>";
					// 			$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_1 . "' and id_semester='2' ")->num_rows();
				}

				$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_1 . "' and id_semester='2' ")->num_rows();
				if ($cek) {


					$cetak .=	"
                    <span class='btn-group' role='group'>
                        <button id='btnGroupVerticalDrop1' type='button' class='btn bg-green waves-effect' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						<i class='material-icons'>picture_as_pdf</i>   X - Genap</a> <span class='caret'></span>
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='btnGroupVerticalDrop1'>
                            <li><a   target='_blank' href='" . base_url() . "admin_raport/cetak_lagger?
							// id=" . $dataDB->id . "&id_kelas=" . $id_kelas_1 . "&id_semester=2&id_tahun="
						. $id_tahun_1 . "&id_tk=1&download=true'>Cetak Lagger</a></li>
							<li><a   target='_blank' href='" . base_url() . "raport/cetak_raport?
							// id=" . $dataDB->id . "&id_kelas=" . $id_kelas_1 . "&id_semester=2&id_tahun="
						. $id_tahun_1 . "&id_tk=1&download=true' >  Cetak Raport </a></li>
                        </ul>
                    </span>
					";

					// 			" <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
					// id=" . $dataDB->id . "&id_kelas=" . $id_kelas_1 . "&id_semester=2&id_tahun=" . $id_tahun_1 . "&id_tk=1&download=true' class='btn bg-green waves-effect '> 
					// <i class='material-icons'>picture_as_pdf</i>   X - Genap</a>";
				}
			}
			if ($id_kelas_2) {
				$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_2 . "' and id_semester='1' ")->num_rows();
				if ($cek) {

					$cetak .=	"
                    <span class='btn-group' role='group'>
                        <button id='btnGroupVerticalDrop1' type='button' class='btn btn-warning' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						<i class='material-icons'>picture_as_pdf</i> XI - Ganjil </a> <span class='caret'></span>
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='btnGroupVerticalDrop1'>
                            <li> <a   target='_blank' href='" . base_url() . "admin_raport/cetak_lagger?
							id=" . $dataDB->id . "&id_kelas=" . $id_kelas_2 . "&id_semester=1&id_tahun="
						. $id_tahun_2 . "&id_tk=2&download=true' >Cetak Lagger</a></li>
							<li> <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
							id=" . $dataDB->id . "&id_kelas=" . $id_kelas_2 . "&id_semester=1&id_tahun="
						. $id_tahun_2 . "&id_tk=2&download=true' > Cetak Raport </a></li>
                        </ul>
                   
					</span>";



					// 			$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
					// id=" . $dataDB->id . "&id_kelas=" . $id_kelas_2 . "&id_semester=1&id_tahun=" . $id_tahun_2 . "&id_tk=2&download=true' class='btn bg-light-blue waves-effect '> 
					// <i class='material-icons'>picture_as_pdf</i> XI - Ganjil </a>";
				}
				$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_2 . "' and id_semester='2' ")->num_rows();
				if ($cek) {

					$cetak .=	"
                    <span class='btn-group' role='group'>
                        <button id='btnGroupVerticalDrop1' type='button' class='btn bg-blue waves-effect ' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						<i class='material-icons'>picture_as_pdf</i> XI - Genap </a> <span class='caret'></span>
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='btnGroupVerticalDrop1'>
                            <li><a   target='_blank' href='" . base_url() . "admin_raport/cetak_lagger?
							id=" . $dataDB->id . "&id_kelas=" . $id_kelas_2 . "&id_semester=2&id_tahun=" . $id_tahun_2 . "&id_tk=2&download=true' >Cetak Lagger</a></li>
							<li> <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
							id=" . $dataDB->id . "&id_kelas=" . $id_kelas_2 . "&id_semester=2&id_tahun=" . $id_tahun_2 . "&id_tk=2&download=true' > Cetak Raport </a></li>
                        </ul>
                   
					</span>";

					// 		$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
					// id=" . $dataDB->id . "&id_kelas=" . $id_kelas_2 . "&id_semester=2&id_tahun=" . $id_tahun_2 . "&id_tk=2&download=true' class='btn bg-blue waves-effect '> 
					// <i class='material-icons'>picture_as_pdf</i> XI - Genap</a>";
				}
			}
			if ($id_kelas_3) {
				$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_3 . "' and id_semester='1' ")->num_rows();
				if ($cek) {

					$cetak .=	"
                    <span class='btn-group' role='group'>
                        <button id='btnGroupVerticalDrop1' type='button' class='btn bg-red waves-effect ' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						<i class='material-icons'>picture_as_pdf</i> XII - Ganjil </a> <span class='caret'></span>
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='btnGroupVerticalDrop1'>
                            <li><a   target='_blank' href='" . base_url() . "admin_raport/cetak_lagger?
							id=" . $dataDB->id . "&id_kelas=" . $id_kelas_3 . "&id_semester=1&id_tahun=" . $id_tahun_3 . "&id_tk=3&download=true' >Cetak Lagger</a></li>
							<li> <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
							id=" . $dataDB->id . "&id_kelas=" . $id_kelas_3 . "&id_semester=1&id_tahun=" . $id_tahun_3 . "&id_tk=3&download=true' > Cetak Raport </a></li>
                        </ul>
                   
					</span>";



					// 			$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
					// id=" . $dataDB->id . "&id_kelas=" . $id_kelas_3 . "&id_semester=1&id_tahun=" . $id_tahun_3 . "&id_tk=3&download=true' class='btn bg-orange waves-effect '> 
					// <i class='material-icons'>picture_as_pdf</i> XII - Ganjil</a>";
				}
				$cek = $this->db->query("select id from tm_penjadwalan where id_tahun='" . $id_tahun_3 . "' and id_semester='2' ")->num_rows();
				if ($cek) {

					$cetak .=	"
                    <span class='btn-group' role='group'>
                        <button id='btnGroupVerticalDrop1' type='button' class='btn btn-success waves-effect ' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						<i class='material-icons'>picture_as_pdf</i> XII - Genap </a> <span class='caret'></span>
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='btnGroupVerticalDrop1'>
                            <li><a   target='_blank' href='" . base_url() . "admin_raport/cetak_lagger?
							id=" . $dataDB->id . "&id_kelas=" . $id_kelas_3 . "&id_semester=2&id_tahun=" . $id_tahun_3 . "&id_tk=3&download=true' >Cetak Lagger</a></li>
							<li>  <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
							id=" . $dataDB->id . "&id_kelas=" . $id_kelas_3 . "&id_semester=2&id_tahun=" . $id_tahun_3 . "&id_tk=3&download=true' > Cetak Raport </a></li>
                        </ul>
                   
					</span>";

					// 		$cetak .= " <a   target='_blank' href='" . base_url() . "raport/cetak_raport?
					// id=" . $dataDB->id . "&id_kelas=" . $id_kelas_3 . "&id_semester=2&id_tahun=" . $id_tahun_3 . "&id_tk=3&download=true' class='btn bg-deep-orange waves-effect '> 
					// <i class='material-icons'>picture_as_pdf</i> XII - Genap</a>";
				}
			}


			$ket = $this->m_reff->goField("tm_catatan_walikelas", "ket", "where id_siswa='" . $dataDB->id . "' 
			and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' ");
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = "<span class='cursor font-bold  hoverline size  ' onclick='detail(`" . $dataDB->id . "`)'>  " . $dataDB->nama . " (" . strtoupper($dataDB->jk) . ") </span>";
			$row[] = "<span class='size'>  " . $dataDB->nis . " </span>";

			$row[] = "<span class='size'> " . $cetak . " </span>";


			$data[] = $row;
		}


		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_siswa->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function cetak_lagger()
	{
		echo	$this->load->view("cetak_legger");
	}
}
