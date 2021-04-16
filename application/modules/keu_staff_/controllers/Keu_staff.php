<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keu_staff extends CI_Controller
{



	function __construct()
	{
		parent::__construct();

		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function index()
	{

		$this->m_konfig->validasi_session(array("keuangan"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("index");
		} else {
			$data['konten'] = "index";
			$this->_template($data);
		}
	}
	public function pinjaman()
	{

		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("pinjaman");
		} else {
			$data['konten'] = "pinjaman";
			$this->_template($data);
		}
	}
	public function simpanan()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("simpanan");
		} else {
			$data['konten'] = "simpanan";
			$this->_template($data);
		}
	}
	public function penarikan()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("penarikan");
		} else {
			$data['konten'] = "penarikan";
			$this->_template($data);
		}
	}
	function honor()
	{
		echo $this->index();
	}
	function input_honor()
	{
		$this->m_konfig->validasi_session(array("keuangan"));
		$tgl = $this->input->post("tgl");
		$tgl = $this->tanggal->eng_($tgl, "-");
		$id_guru = $this->input->post("id_guru[]");
		$nama_honor = $this->input->post("nama_honor");
		$jumlah_honor = $this->input->post("jumlah_honor");
		$jumlah_honor = str_replace(".", "", $jumlah_honor);
		$ket = $this->input->post("ket");
		$echo = $this->mdl->input_honor($id_guru, $nama_honor, $jumlah_honor, $ket, $tgl);
		echo json_encode($echo);
	}
	function input_pinjaman()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$id_guru = $this->input->post("id_guru");
		$tgl = $this->input->post("tgl");
		$tgl = $this->tanggal->eng_($tgl, "-");
		$jumlah_pinjaman = $this->input->post("jumlah_pinjaman");
		$jumlah_pinjaman = str_replace(".", "", $jumlah_pinjaman);
		$jumlah_cicilan = $this->input->post("jumlah_cicilan");
		$jumlah_cicilan = str_replace(".", "", $jumlah_cicilan);
		$ket = $this->input->post("ket");
		$echo = $this->mdl->input_pinjaman($id_guru, $tgl, $jumlah_pinjaman, $jumlah_cicilan, $ket);
		echo json_encode($echo);
	}


	function input_simpanan()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$id_guru = $this->input->post("id_guru");
		$tgl = $this->input->post("tgl");
		$tgl = $this->tanggal->eng_($tgl, "-");
		$jumlah = $this->input->post("jumlah");
		$sts = $this->input->post("sts");
		$jumlah = str_replace(".", "", $jumlah);
		$ket = $this->input->post("ket");
		$echo = $this->mdl->input_simpanan($id_guru, $tgl, $jumlah, $ket, $sts);
		echo json_encode($echo);
	}

	function tarik_simpanan()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$sts = $this->input->post("sts");
		$id_guru = $this->input->post("id_guru");
		$tgl = $this->input->post("tgl");
		$tgl = $this->tanggal->eng_($tgl, "-");
		$ket = $this->input->post("ket");
		$jumlah = $this->input->post("jumlah");
		$jumlah = str_replace(".", "", $jumlah);
		$echo = $this->mdl->tarik_simpanan($id_guru, $tgl, $ket, $sts, $jumlah);
		echo json_encode($echo);
	}



	function getHonor()
	{
		$this->m_konfig->validasi_session(array("keuangan"));
		$list = $this->mdl->getHonor();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {

			$penerima = $this->db->query("select * from keu_honor where keu_honor.code='" . $dataDB->code . "' ")->num_rows();
			$penerima = '<span class="waves-effect label bg-pink cursor sadow" onclick="tampilkan(`' . $dataDB->nama . '`,`' . $dataDB->code . '`)"> ' . $penerima . ' Orang</span>';
			$tombol = '<button onclick="hapus_data(`' . $dataDB->code . '`,`' . $dataDB->nama . '`)" type="button" class="btn bg-pink  
					waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
					aria-expanded="true">
                   <i class="material-icons">delete_forever</i> Hapus  
                    </button>';

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'> " . $this->tanggal->ind($dataDB->tgl_input, "/") . "   </span>";
			$row[] = "<a class='cursor' href='javascript:edit_nama(`" . $dataDB->code . "`,`" . $dataDB->nama . "`)'> " . $dataDB->nama . "  </a>";
			$row[] = "<a class='cursor' href='javascript:edit_tagihan(`" . $dataDB->code . "`,`" . number_format($dataDB->nominal, 0, ",", ".") . "`,`" . $dataDB->nama . "`)'>  " . number_format($dataDB->nominal, 0, ",", ".") . "   </a>";
			$row[] = "<span class='size'>  " . $dataDB->ket . "  </span>";
			$row[] = "<span class='size'>  " . $penerima . "   </span>";

			$row[] = $tombol;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_getHonor(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getPinjaman()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$list = $this->mdl->getPinjaman();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {


			$tombol = '<button onclick="hapus_data(`' . $dataDB->id . '`,`' . $dataDB->nama_penerima . '`)" type="button" class="btn bg-pink  
					waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
					aria-expanded="true">
                   <i class="material-icons">delete_forever</i> Hapus  
                    </button>';


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'> " . $this->tanggal->ind($dataDB->tgl_pinjaman, "/") . "   </span>";
			$row[] = "<span class='size'> " . $dataDB->nama_penerima . "   </span>";
			$row[] = "<a class='cursor' href='javascript:edit_pinjaman(`" . $dataDB->id . "`,`" . number_format($dataDB->jumlah_pinjaman, 0, ",", ".") . "`,`" . $dataDB->nama_penerima . "`)'>  " . number_format($dataDB->jumlah_pinjaman, 0, ",", ".") . "   </a>";
			$row[] = "<a class='cursor' href='javascript:edit_cicilan(`" . $dataDB->id . "`,`" . number_format($dataDB->jumlah_cicilan, 0, ",", ".") . "`,`" . $dataDB->nama_penerima . "`)'>  " . number_format($dataDB->jumlah_cicilan, 0, ",", ".") . "   </a>";
			//	$row[] = "<span class='size'>  ".$dataDB->ket."  </span>";
			// 	$row[] = "<span class='size'>".number_format($dataDB->total_bayar,0,",",".")."  </span>";


			$row[] = $tombol;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_getPinjaman(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getSimpanan()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$list = $this->mdl->getSimpanan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			if ($dataDB->sts == 1) {
				$sts = "<label class='label bg-green'> Simpan </label>";
			} else {
				$sts = "<label class='label bg-pink'> Ambil </label>";
			}
			$indo = $this->tanggal->ind($dataDB->tgl, "/");
			if ($dataDB->periode) {
				$tombol = '<div  role="group">
                                  <i>No-edit</i>                    
                                   
                                </div>';
			} else {
				$tombol = '<div class="btn-group" role="group">
                                    <button type="button" class="btn bg-grey waves-effect" onclick="edit_data(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . number_format($dataDB->nominal, 0, ",", ".") . '`,`' . $indo . '`,`' . $dataDB->ket . '`)">EDIT</button>                                 
                                    <button type="button" class="btn bg-teal waves-effect" onclick="hapus_data(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)">HAPUS</button>
                                </div>';
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>  " . $dataDB->nama . "  </span>";
			$row[] = "<span class='size'> " . $indo . "   </span>";


			$row[] = "<span class='size'> " . $this->m_reff->goField("keu_tr_stssimpanan", "nama", "where id='" . $dataDB->kategory . "'") . "   </span>";
			$row[] = "<span class='size'>" . number_format($dataDB->nominal, 0, ",", ".") . "  </span>";
			$row[] = "<span class='size'>  " . $dataDB->ket . "  </span>";

			$row[] = $tombol;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_getSimpanan(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getPengambilan()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$list = $this->mdl->getPengambilan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {

			$sts = "<label class='label bg-pink'> Ambil </label>";

			$indo = $this->tanggal->ind($dataDB->tgl, "/");


			$tombol = '<div class="btn-group" role="group">
                                    <button type="button" class="btn bg-grey waves-effect" onclick="edit_data(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . number_format($dataDB->nominal, 0, ",", ".") . '`,`' . $indo . '`,`' . $dataDB->ket . '`)">EDIT</button>                                 
                                    <button type="button" class="btn bg-teal waves-effect" onclick="hapus_data(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)">HAPUS</button>
                                </div>';


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>  " . $dataDB->ket . "  </span>";
			$row[] = "<span class='size'> " . $indo . "   </span>";


			$row[] = "<span class='size'> " . $this->m_reff->goField("keu_tr_stssimpanan", "nama", "where id='" . $dataDB->kategory . "'") . "   </span>";
			$row[] = "<span class='size'>" . number_format($dataDB->nominal, 0, ",", ".") . "  </span>";

			//	$row[] = "<span class='size'>  ".$dataDB->nama."  </span>";

			$row[] = $tombol;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_getAmbil(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function lihatDataHonor()
	{
		$this->m_konfig->validasi_session(array("keuangan"));
		$data_array["id"] = $this->input->post("id");
		echo	$this->load->view("lihatDataHonor", $data_array);
	}
	function hapusHonorSatuan()
	{

		$this->m_konfig->validasi_session(array("keuangan"));
		$code = $this->input->post("code");
		$id_guru = $this->input->post("id_guru");
		$echo = $this->mdl->hapusHonorSatuan($code, $id_guru);
		echo json_encode($echo);
	}
	function hapusHonor()
	{

		$this->m_konfig->validasi_session(array("keuangan"));
		$code = $this->input->post("code");
		$echo = $this->mdl->hapusHonor($code);
		echo json_encode($echo);
	}
	function hapusPinjaman()
	{

		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));

		$code = $this->input->post("code");
		$echo = $this->mdl->hapusPinjaman($code);
		echo json_encode($echo);
	}
	function hapusSimpanan()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));

		$code = $this->input->post("code");
		$echo = $this->mdl->hapusSimpanan($code);
		echo json_encode($echo);
	}
	function updateNama()
	{

		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$id_tagihan = $this->input->post("id");
		$nama = $this->input->post("nama");
		$echo = $this->mdl->updateNama($id_tagihan, $nama);
		echo json_encode($echo);
	}
	function update_simpanan()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));

		$id_edit = $this->input->post("id_edit");
		$ket = $this->input->post("ket");
		$tgl = $this->input->post("tgl");
		$tgl = $this->tanggal->eng_($tgl, "-");
		$nominal = $this->input->post("nominal");
		$nominal = str_replace(".", "", $nominal);
		$echo = $this->mdl->update_simpanan($id_edit, $nominal, $tgl, $ket);
		echo json_encode($echo);
	}
	function update_penarikan()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$id_edit = $this->input->post("id_edit");
		$ket = $this->input->post("ket");
		$tgl = $this->input->post("tgl");
		$tgl = $this->tanggal->eng_($tgl, "-");
		$nominal = $this->input->post("nominal");
		$nominal = str_replace(".", "", $nominal);
		$echo = $this->mdl->update_penarikan($id_edit, $nominal, $tgl);
		echo json_encode($echo);
	}
	function updateNominal()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$id_tagihan = $this->input->post("id");
		$nominal = $this->input->post("nominal");
		$nominal = str_replace(".", "", $nominal);
		$echo = $this->mdl->updateNominal($id_tagihan, $nominal);
		echo json_encode($echo);
	}
	function updatePinjaman()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$id = $this->input->post("id");
		$nominal = $this->input->post("nominal");
		$nominal = str_replace(".", "", $nominal);
		$echo = $this->mdl->updatePinjaman($id, $nominal);
		echo json_encode($echo);
	}
	function updateCicilan()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$id = $this->input->post("id");
		$nominal = $this->input->post("nominal");
		$nominal = str_replace(".", "", $nominal);
		$echo = $this->mdl->updateCicilan($id, $nominal);
		echo json_encode($echo);
	}
	function getNominal()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$id = $this->input->post("id");
		$sts = $this->input->post("sts");
		$data = $this->mdl->getNominal($id, $sts);
		echo json_encode($data);
	}
	function ubahStatus()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$id = $this->input->get_post("id");
		$sts = $this->input->get_post("sts");
		$now = date('Y-m-d');
		if ($sts == 1) {
			$this->db->where("id", $id);
			$this->db->set("tgl_diambil", $now);
			$this->db->set("byr", 2);
			return	$this->db->update("keu_honor");
		} else {
			$this->db->where("id", $id);
			$this->db->set("tgl_diambil", null);
			$this->db->set("byr", 0);
			return	$this->db->update("keu_honor");
		}
	}
}
