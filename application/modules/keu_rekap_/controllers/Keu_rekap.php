<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keu_rekap extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("keuangan", "koperasi"));
		$this->load->model("model", "mdl");
		date_default_timezone_set('Asia/Jakarta');
	}

	function _template($data)
	{
		$this->load->view('template/main', $data);
	}

	public function staff()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("staff");
		} else {
			$data['konten'] = "staff";
			$this->_template($data);
		}
	}
	public function staffko()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("staffko");
		} else {
			$data['konten'] = "staffko";
			$this->_template($data);
		}
	}
	public function index()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("siswa");
		} else {
			$data['konten'] = "siswa";
			$this->_template($data);
		}
	}
	function siswa()
	{
		$this->index();
	}

	function getDataSiswa()
	{
		$list = $this->mdl->getDataSiswa();
		$tagihan = $this->input->get_post("tagihan");
		if ($tagihan) {
			$tagihaninfo = $this->mdl->namaBiaya($tagihan);
		} else {
			$tagihaninfo = "Semua";
		}
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {


			if ($this->mdl->stsTagihan($tagihan, $dataDB->id_siswa)) {
				$spp = "<span class='col-pink'><b>Belum Lunas</b></span>";
			} else {
				$spp = "<span class='col-green'><b>  Lunas</b></span>";
			}



			$db = $this->db->query("select * from v_siswa where id='" . $dataDB->id_siswa . "' ")->row();
			$tombol = '<a target="_blank" href="' . base_url() . 'keu_rekap/rincian?id=' . $dataDB->id_siswa . '"  class="btn bg-teal btn-mini 
					waves-effect     aria-haspopup="true"	aria-expanded="true">
                   Rekapan
                    </a>';

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $db->nama_kelas . "</span>";
			$row[] = "<span class='size'>" . $db->nama . "</span>";
			$row[] = "<span class='size'>" . $tagihaninfo . "</span>";
			$row[] = "<span class='size'>" . $spp . "</span>";
			$row[] = "<span class='size'><font color='white'>`</font>" . number_format($this->mdl->stsTagihan($tagihan, $dataDB->id_siswa), 0, ",", ".") . "</span>";

			$row[] = $tombol;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_getDataSiswa(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getDataGuru()
	{
		$list = $this->mdl->getDataGuru();

		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $db) {
			$act = 'edit(`' . $db->id . '`,`' . $db->nama . '`,`' . number_format($db->gaji_pokok, 0, ",", ".") . '`,
				 `' . number_format($db->tunjangan_jabatan, 0, ",", ".") . '`,`' . number_format($db->pembina_eskul, 0, ",", ".") . '`,
				 `' . number_format($db->p_fungsional, 0, ",", ".") . '`,`' . number_format($db->kepramukaan_wajib, 0, ",", ".") . '`,
				 `' . number_format($db->supervisi_akademik, 0, ",", ".") . '`,
				 `' . number_format($db->bpjs, 0, ",", ".") . '` 
				 )';
			$tombol = '<a   href="#" onclick="' . $act . '"  class="btn bg-teal btn-mini 
					waves-effect     aria-haspopup="true"	aria-expanded="true">
                   EDIT
                    </a>';
			$jml_pinjaman = $this->mdl->jml_pinjaman($db->id);
			$jml_simpanan = $this->mdl->jml_simpanan($db->id);
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size linkhover cursor col-blue' onclick='" . $act . "'>" . $db->nama . "</span>";
			$row[] = "<span class='size'>" . number_format($jml_pinjaman, 0, ",", ".") . "</span>";
			$row[] = "<span class='size'>" . number_format($jml_simpanan, 0, ",", ".") . "</span>";
			$row[] = "<span class='size'>" . number_format($db->gaji_pokok, 0, ",", ".") . "</span>";
			$row[] = "<span class='size'>" . number_format($db->tunjangan_jabatan, 0, ",", ".") . "</span>";
			$row[] = "<span class='size'>" . number_format($db->pembina_eskul, 0, ",", ".") . "</span>";
			$row[] = "<span class='size'>" . number_format($db->p_fungsional, 0, ",", ".") . "</span>";
			$row[] = "<span class='size'>" . number_format($db->kepramukaan_wajib, 0, ",", ".") . "</span>";
			$row[] = "<span class='size'>" . number_format($db->supervisi_akademik, 0, ",", ".") . "</span>";

			$row[] = $tombol;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_getDataGuru(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getDataGuruKo()
	{
		$list = $this->mdl->getDataGuru();

		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $db) {
			$act = 'edit(`' . $db->id . '`,`' . $db->nama . '`,`' . number_format($db->gaji_pokok, 0, ",", ".") . '`,
				 `' . number_format($db->tunjangan_jabatan, 0, ",", ".") . '`,`' . number_format($db->pembina_eskul, 0, ",", ".") . '`,
				 `' . number_format($db->p_fungsional, 0, ",", ".") . '`,`' . number_format($db->kepramukaan_wajib, 0, ",", ".") . '`,
				 `' . number_format($db->supervisi_akademik, 0, ",", ".") . '`,
				 `' . number_format($db->bpjs, 0, ",", ".") . '` 
				 )';
			$tombol = '<a   href="#" onclick="' . $act . '"  class="btn bg-teal btn-mini 
					waves-effect     aria-haspopup="true"	aria-expanded="true">
                   EDIT
                    </a>';
			$jml_pinjaman = $this->mdl->jml_pinjaman($db->id);
			$jml_simpanan = $this->mdl->jml_simpanan($db->id);
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size linkhover cursor '  >" . $db->nama . "</span>";
			$row[] = "<span class='size'>" . number_format($jml_pinjaman, 0, ",", ".") . "</span>";
			$row[] = "<span class='size'>" . number_format($jml_simpanan, 0, ",", ".") . "</span>";



			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_getDataGuru(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function getTagihan()
	{

		$id_kelas = $this->input->get_post("id_kelas");
		$alumni = $this->input->get_post("alumni");
		$tagihan = $this->input->get_post("tagihan");
		$filter = "";
		if ($alumni == 1) {
			$filter .= " AND id_siswa IN (SELECT id from data_siswa where id_tahun_keluar IS NOT NULL ) ";
		} else {

			if ($id_kelas) {
				$filter .= " AND id_siswa IN (SELECT id from data_siswa where id_kelas='" . $id_kelas . "' and id_tahun_keluar IS NULL ) ";
			}
		}

		$query = "SELECT DISTINCT(id_tagihan) as id_tagihan	FROM keu_tagihan_pokok  where 1=1   " . $filter . " order by id_tagihan asc";
		$data = $this->db->query($query)->result();
		$ray = "";
		$ray[] = "==== Pilih Tagihan ====";
		foreach ($data as $val) {
			$ray[$val->id_tagihan] = $this->mdl->namaBiaya($val->id_tagihan);
		}
		$array = $ray;
		$echo = form_dropdown("filterf", $array, $tagihan, 'class="form-control show-tick" id="tagihanf" data-live-search="true"   onchange="reload_table()"');
		$echo .= '		<script>$("select").selectpicker();</script>             ';
		echo $echo;
	}

	function rincian()
	{
		ob_start();
		$isi = $this->load->view('rincian');
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "330"), 'en', true, '', array(8, 5, 8, 8));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('rincian.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}
	function edit_staf()
	{
		$data = $this->mdl->edit_staf();
		echo json_encode($data);
	}
}
