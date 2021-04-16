<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keu_rekap extends CI_Controller
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

	function laporan_pembayaran()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "kepsek"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo $this->load->view("laporan_pembayaran");
		} else {
			$data['konten'] = "laporan_pembayaran";
			$this->_template($data);
		}
	}

	function laporan_pembayaran_pdf()
	{

		ob_start();
		$isi = $this->load->view('laporan_pembayaran_pdf');
		// return true;
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('L', array("210", "310"), 'en', true, '', array(20, 10, 20, 5));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->setDefaultFont("arial", "BI");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			ob_end_clean();
			$html2pdf->Output('Surat.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}

		//$this->load->view('laporan_pembayaran_pdf');
	}

	public function getBayar()
	{
		$d = $this->mdl->getBayar_input();

		$data = "";
		$jspp = 0;
		$jdsp = 0;
		$jsps = 0;
		$jksw = 0;
		$juji = 0;
		$jj = 0;
		$no = 1;

		foreach ($d as $v) {
			$kelas = $this->m_reff->goField("v_kelas", "nama", "WHERE id='" . $v->id_kelas . "' ");

			$spp = $this->mdl->sumBayar_input("spp", $v->id_siswa, $_POST['tgl']);
			$dsp = $this->mdl->sumBayar_input("dsp", $v->id_siswa, $_POST['tgl']);
			$sps = $this->mdl->sumBayar_input("sps", $v->id_siswa, $_POST['tgl']);
			$ksw = $this->mdl->sumBayar_input("ksw", $v->id_siswa, $_POST['tgl']);
			$uji = $this->mdl->sumBayar_input("uji", $v->id_siswa, $_POST['tgl']);

			$jumlah = ($spp + $dsp + $sps + $ksw + $uji);

			$jspp = ($jspp + $spp);
			$jdsp = ($jdsp + $dsp);
			$jsps = ($jsps + $sps);
			$jksw = ($jksw + $ksw);
			$juji = ($juji + $uji);
			$jj   = ($jumlah + $jj);

			$data .= "
				<tr>
					<td align='center'>" . $no . "</td>
					<td>" . $v->nama . "</td>
					<td align='center'>" . $kelas . "</td>
					<td align='right'>" . number_format($spp, 0, ',', '.') . "</td>
					<td align='right'>" . number_format($dsp, 0, ',', '.') . "</td>
					<td align='right'>" . number_format($sps, 0, ',', '.') . "</td>
					<td align='right'>" . number_format($ksw, 0, ',', '.') . "</td>
					<td align='right'>" . number_format($uji, 0, ',', '.') . "</td>
					<td align='right'><strong>" . number_format($jumlah, 0, ',', '.') . "</strong></td>
				</tr>
			";
			$no++;
		}

		$html = '
			<p>
				<a href="' . base_url() . 'keu_rekap/laporan_pembayaran_pdf?idkelas=' . $_POST['idkelas'] . '&tgl=' . $_POST['tgl'] . '" target="_blank" style="float:right" class="btn bg-teal waves-effect" type="submit"><i class="material-icons">print</i> PRINT PDF</a>
			</p>
			<p><strong>Dari Tanggal : ' . $_POST['tgl'] . '</strong></p>
			<table class="table table-bordered " id="tbl-siswa">
				<thead>
					<tr class="bg-teal">
						<th width="5%">No</th>
						<th>Nama Siswa</th>
						<th width="10%">Kelas</th>
						<th width="15%">Iuran Bulanan</th>
						<th width="10%">Invest</th>
						<th width="15%">Sarana Prasarana</th>
						<th width="10%">Kesiswaan</th>
						<th width="10%">Ujian</th>
						<th width="15%">JUMLAH</th>
					</tr>
				</thead>
				<tbody>
					' . $data . '
				</tbody>
				<tfoot>
					<tr style="font-weight:bold">
						<td></td>
						<td><center>JUMLAH</center></td>
						<td></td>
						<td align="right">' . number_format($jspp, 0, ',', '.') . '</td>
						<td align="right">' . number_format($jdsp, 0, ',', '.') . '</td>
						<td align="right">' . number_format($jsps, 0, ',', '.') . '</td>
						<td align="right">' . number_format($jksw, 0, ',', '.') . '</td>
						<td align="right">' . number_format($juji, 0, ',', '.') . '</td>
						<td align="right">' . number_format($jj, 0, ',', '.') . '</td>
					</tr>
					<tr style="font-weight:bold">
						<td></td>
						<td ><center>TERBILANG</center></td>
						<td colspan="7" align="center">' . ucwords($this->umum->terbilang($jj)) . ' Rupiah</td>
					</tr>
				</tfoot>
			</table>
		';

		echo $html;
	}

	public function staff()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "kepsek"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("staff");
		} else {
			$data['konten'] = "staff";
			$this->_template($data);
		}
	}

	public function print_tagihan_siswa()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "kepsek"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("print_tagihan_siswa");
		} else {
			$data['konten'] = "print_tagihan_siswa";
			$this->_template($data);
		}
	}

	function print_tagihan_siswa_pdf()
	{

		ob_start();
		$isi =	$this->load->view("print_tagihan_siswa_pdf");
		$isi = ob_get_clean();
		//$kelas = "";
		//$kelas = $this->m_reff->goField("v_kelas", "nama", " WHERE id='".$id."' ");

		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("215", "330"), 'en', true, '', array(5, 0, 5, 0));
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			ob_end_clean();
			$html2pdf->Output('kartu_ujian.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}


		//$this->load->view("print_tagihan_siswa_pdf");
	}

	public function staffko()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "kepsek"));
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
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "guru", "kepsek"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("siswa");
		} else {
			$data['konten'] = "siswa";
			$this->_template($data);
		}
	}
	public function perkelas()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "kepsek"));
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("perkelas");
		} else {
			$data['konten'] = "perkelas";
			$this->_template($data);
		}
	}
	function siswa()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "guru", "kepsek"));
		$this->index();
	}

	function getDataSiswa()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "guru", "kepsek"));
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
			$kelas = isset($db->nama_kelas) ? ($db->nama_kelas) : "";
			$nama = isset($db->nama) ? ($db->nama) : "";
			$nis = isset($db->nis) ? ($db->nis) : "";

			if ($this->mdl->stsTagihan($tagihan, $dataDB->id_siswa) <= 0) {
				$rp = "";
			} else {
				$rp = "Rp " . number_format($this->mdl->stsTagihan($tagihan, $dataDB->id_siswa), 0, ",", ".");
			}



			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $kelas . "</span>";
			$row[] = "<span class='size'> " . $nama . "<br><i class='col-orange'>NIS: " . $nis . " <i> </span>";
			$row[] = "<span class='size'>" . $tagihaninfo . "</span>";
			$row[] = "<span class='size'>" . $spp . "</span>";
			$row[] = "<span class='size'>  " . $rp . "</span>";

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



	function getDataKelas()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "kepsek"));
		$list = $this->mdl->getDataKelas();
		$tagihan = $this->input->get_post("tagihan");

		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {



			$ttagihan_ = $this->mdl->totalBiayaKelas($dataDB->id, $tagihan);
			$ttagihan = number_format($ttagihan_, 0, ",", ".");

			$tbayar_ = $this->mdl->totalBayarKelas($dataDB->id, $tagihan);
			$tbayar = number_format($tbayar_, 0, ",", ".");

			$sisa_ = $ttagihan_ - $tbayar_;
			$sisa = number_format($sisa_, 0, ",", ".");

			$kelas = isset($dataDB->nama) ? ($dataDB->nama) : "";
			$wali = $this->m_reff->goField("data_pegawai", "nama", "where id='" . $dataDB->id_wali . "'");
			if ($sisa_ >= 1) {
				$sisa = "<span class='font-bold col-pink'>" . $sisa . "</span>";
			} else {
				$sisa = "<span class='font-bold col-green'>" . $sisa . "</span>";
			}

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $kelas . "</span>";
			$row[] = "<span class='size'>" . $wali . " </span>";
			$row[] = "<span class='size'>" . $ttagihan . "</span>";
			$row[] = "<span class='size'>" . $tbayar . " </span>";
			$row[] = "<span class='size'> " . $sisa . " </span>";


			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_getDataKelas(),
			"recordsFiltered" => $count,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}



	function getDataGuru()
	{
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "kepsek"));
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
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "kepsek"));
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
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "guru", "kepsek"));

		$id_kelas = $this->input->get_post("id_kelas");
		$alumni = $this->input->get_post("alumni");
		$tagihan = $this->input->get_post("tagihan");
		$filter = "";
		if ($alumni == 1) {
			$filter .= " AND id_siswa IN (SELECT id from data_siswa where id_tahun_keluar IS NOT NULL and id_sts_data !=1 ) ";
		} else {

			if ($id_kelas) {
				$filter .= " AND id_siswa IN (SELECT id from data_siswa where id_kelas='" . $id_kelas . "' and id_tahun_keluar IS NULL ) ";
			}
		}

		$query = "SELECT DISTINCT(id_tagihan) as id_tagihan	FROM keu_tagihan_pokok  where 1=1   " . $filter . " order by id_tagihan asc";
		$data = $this->db->query($query)->result();
		$ray = array();
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
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "guru", "kepsek"));
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
		$this->m_konfig->validasi_session(array("keuangan", "koperasi", "keuangan siswa", "keuangan pegawai", "kepsek"));
		$data = $this->mdl->edit_staf();
		echo json_encode($data);
	}
}
