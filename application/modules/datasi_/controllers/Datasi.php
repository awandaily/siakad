<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Datasi extends CI_Controller
{


	var $tbl_cbt = "data_cbt";
	var $v_kelas = "v_kelas";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("keuangan"));
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
	public function history()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("riwayat");
		} else {
			$data['konten'] = "riwayat";
			$this->_template($data);
		}
	}
	function input()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("input");
		} else {
			$data['konten'] = "input";
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
	public function bayar()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("bayar");
		} else {
			$data['konten'] = "bayar";
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
			$row[] = $tombol;

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


	function getHistory()
	{
		$list = $this->mdl->getHistory();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {


			$tombol = '<button onclick="rincian(`' . $dataDB->id . '`,`' . $dataDB->id_siswa . '`,`' . $dataDB->tgl_bayar . '`)" type="button" class="btn bg-pink btn-xs btn-block
					waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
					aria-expanded="true">
                    <span class="sr-only"><i class="material-icons">book</i> Rincian    </span>
                    </button>';


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";



			$row[] = "<span class='size'> " . $this->tanggal->ind($dataDB->tgl_bayar, "/") . "</span>";
			$row[] = "<span class='size'> " . $this->m_reff->goField("data_siswa", "nama", "where id='" . $dataDB->id_siswa . "'") . "  </span>";
			$row[] = "<span class='size'> Rp " . number_format($dataDB->nominal, 0, ",", ".") . "   </span>";
			$row[] = "<span class='size'> " . $tombol . "   </span>";

			$row[] = $tombol;

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



	function getTagihanTambahan()
	{
		$list = $this->mdl->getTagihanTambahan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			if (!$dataDB->id_jurusan) {
				$jurusan = "semua";
			} else {
				$jurusan = $this->m_reff->goField("tr_jurusan", "nama", "where id='" . $dataDB->id_jurusan . "'");
			}

			if (!$dataDB->tingkat) {
				$tingkat = "semua";
			} else {
				$tingkat = $this->m_reff->goField("tr_tingkat", "nama", "where id='" . $dataDB->tingkat . "'");
			}

			if (!$dataDB->kelas) {
				$kelas = "semua";
			} else {
				$kelas = $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->kelas . "'");
			}
			if (!$dataDB->siswa) {
				$siswa = ' semua ';
			} else {

				$datax = substr($dataDB->siswa, 1);
				$datax = substr($datax, 0, -1);
				$datax = explode(",", $datax);
				$siswa = count($datax);

				$siswa = '<span class="waves-effect label bg-pink cursor sadow" onclick="tampilkan(`' . $dataDB->nama . '`,`' . $dataDB->id . '`)"> ' . $siswa . ' siswa</span>';
			}

			$tombol = '<button onclick="hapus_data(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" type="button" class="btn bg-pink  
					waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
					aria-expanded="true">
                   <i class="material-icons">delete_forever</i> Hapus  
                    </button>';

			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $dataDB->id . "</span>";
			$row[] = "<span class='size'> " . $this->tanggal->ind($dataDB->tgl_input, "/") . "   </span>";
			$row[] = "<a class='cursor' href='javascript:edit_nama(`" . $dataDB->id . "`,`" . $dataDB->nama . "`)'> " . $dataDB->nama . "  </a>";
			$row[] = "<a class='cursor' href='javascript:edit_tagihan(`" . $dataDB->id . "`,`" . number_format($dataDB->jumlah_biaya, 0, ",", ".") . "`,`" . $dataDB->nama . "`)'>  " . number_format($dataDB->jumlah_biaya, 0, ",", ".") . "   </a>";
			$row[] = "<span class='size'>  " . $tingkat . "  </span>";
			$row[] = "<span class='size'> " . $jurusan . "   </span>";
			$row[] = "<span class='size'> " . $kelas . "   </span>";
			$row[] = "<span class='size'> " . $siswa . "   </span>";
			$row[] = $tombol;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count = $this->mdl->count_getTagihanTambahan(),
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
	function lihatDataSiswa()
	{
		$data_array["id"] = $this->input->post("id");
		echo	$this->load->view("lihatDataSiswa", $data_array);
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
	function getKelasperJurusan()
	{
		$jurusan = $this->input->post("jurusan");
		$tingkat = $this->input->post("tingkat");
		if ($jurusan) {
			$this->db->where("id_jurusan", $jurusan);
		}
		if ($tingkat) {
			$this->db->where("id_tk", $tingkat);
		}
		$data = $this->db->get($this->v_kelas)->result();
		$echo = '
		<div class="row clearfix">
									<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Pilih Kelas</label>
                                    </div>
									<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
	 
                                     <select class="form-control show-tick" id="id_kelas" name="id_kelas" onchange="pilihNama()" >
									 <option value="0">=== Semua Kelas ===</option>
									 ';
		foreach ($data as $val) {
			$echo .= "<option value='" . $val->id . "'>" . $val->nama . "</option>";
		}

		$echo .= '	</select>
                 </div>
                 </div>
                 </div>
               </div>';
		echo $echo;
	}
	function getNamaSiswa()
	{
		$id_kelas = $this->input->post("id");
		$this->db->where("id_tahun_keluar", NULL);
		$this->db->where("id_kelas", $id_kelas);
		$data = $this->db->get("data_siswa")->result();
		$echo = '  
                                     <select class="select form-control show-tick" data-live-search="true" name="nama" onchange="getAction()" >
									 
									 ';
		$echo .= "<option value=''> ==== Pilih ====</option>";
		foreach ($data as $val) {
			$echo .= "<option value='" . $val->id . "'>" . $val->nama . "</option>";
		}

		$echo .= '	</select> 
			 <script>
			 $(".select").selectpicker();
			 </script>


		';
		echo $echo;
	}
	function getNamaSiswaForInput()
	{
		$id_kelas = $this->input->post("id");
		$this->db->where("id_tahun_keluar", NULL);
		$this->db->where("id_kelas", $id_kelas);
		$data = $this->db->get("data_siswa")->result();
		$echo = '  
                                     <select required class="select form-control show-tick" data-selected-text-format="count" data-live-search="true" multiple name="nama[]" data-actions-box="true">
									 
									 ';

		foreach ($data as $val) {
			$echo .= "<option selected value='" . $val->id . "'>" . $val->nama . "</option>";
		}

		$echo .= '	</select> 
			 <script>
			 $(".select").selectpicker();
			 </script>


		';
		echo $echo;
	}

	function getNamaSiswaByNis()
	{
		$nis = $this->input->post("id");
		$this->db->where("nis", $nis);
		$this->db->or_where("nisn", $nis);
		$data = $this->db->get("data_siswa")->result();
		$echo = '  
                                     <select class="form-control show-tick" data-live-search="true" name="nama"   >
									 
									 ';
		$i = 1;
		foreach ($data as $val) {
			$i++;
			$echo .= "<option value='" . $val->id . "'>" . $val->nama . "</option>";
		}
		if ($i == 1) {
			echo "no";
			return false;
		}

		$echo .= '	</select> 
			 <script>
			getAction();
			 </script>


		';
		echo $echo;
	}
	function getFormBayar()
	{
		echo $this->load->view("formBayar");
	}
	function detailTagihan()
	{
		echo $this->load->view("detailTagihan");
	}
	function bayaran()
	{
		$echo = $this->mdl->bayaran();
		echo json_encode($echo);
	}
	function getDataSpp()
	{
		$data["limit"] = $this->input->post("limit");
		$data["id_siswa"] = $this->input->post("id_siswa");
		$data["konten"] = $this->input->post("konten");
		echo $this->load->view("getDataSpp", $data);
	}
	function getDataRincian()
	{
		$data["id"] = $this->input->post("id");
		$data["id_siswa"] = $this->input->post("id_siswa");
		echo $this->load->view("getDataRincianTagihan", $data);
	}
	function setbebaskanTagihan()
	{
		$id = $this->input->get("id");
		$ket = $this->input->get("ket");
		$tagihan = $this->input->get("tagihan");
		echo $this->mdl->setbebaskanTagihan($id, $ket, $tagihan);
	}
	function batalbayar()
	{
		$id = $this->input->get("id");
		$tgl = $this->input->get("tgl");
		$idsiswa = $this->input->get("idsiswa");
		echo $this->mdl->batalbayar($id, $tgl, $idsiswa);
	}
	function batalbebaskan()
	{
		$id = $this->input->get("id");
		echo $this->mdl->batalbebaskan($id);
	}
	function cancelBayar()
	{
		$id = $this->input->get_post("id");
		echo $this->mdl->cancelBayar($id);
	}
	function kwitansi()
	{
		ob_start();
		$isi = $this->load->view('kwitansi');
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "330"), 'en', true, '', array(8, 5, 8, 8));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('kwitansi.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}
	function kwitansi_pertnggal()
	{
		ob_start();
		$isi = $this->load->view('kwitansi_pertnggal');
		$isi = ob_get_clean();
		require_once('static/html2pdf/html2pdf.class.php');
		try {
			$html2pdf = new HTML2PDF('P', array("210", "330"), 'en', true, '', array(8, 5, 8, 8));
			// $html2pdf = new HTML2PDF('L', 'array("330","210")', 'fr');
			// $html2pdf->pdf->IncludeJS("print(true);");
			$html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
			$html2pdf->Output('kwitansi.pdf');
		} catch (HTML2PDF_exception $e) {
			echo $e;
		}
	}

	function getRincian()
	{
		$data["id"] = $this->input->get_post("id");
		$data["id_siswa"] = $this->input->get_post("id_siswa");
		$data["tgl_bayar"] = $this->input->get_post("tgl");
		echo $this->load->view("getRincian", $data);
	}
	function getJml()
	{
		$tgl = $this->input->get_post("tgl");
		$id_siswa = $this->input->get_post("id_siswa");
		$nis = $this->input->get_post("nis");
		$tgl = $this->input->post("tgl");
		$tgl1 = $this->tanggal->range_1($tgl);
		$tgl2 = $this->tanggal->range_2($tgl);
		$nis = $this->input->post("nis");
		$id_siswa = $this->input->post("id_siswa");

		$filter = "";
		if ($nis) {
			$id_siswa = $this->m_reff->goField("data_siswa", "id", "where (nis='" . $nis . "' or nisn='" . $nis . "')");
			$filter .= " AND id_siswa='" . $id_siswa . "' ";
		}
		if ($id_siswa && $id_siswa != 'undefined') {

			$filter .= " AND id_siswa='" . $id_siswa . "' ";
		}


		if ($tgl) {
			$filter .= " AND tgl_bayar BETWEEN '" . $tgl1 . "' AND '" . $tgl2 . "' ";
		}

		$data = $this->db->query("select sum(nominal_bayar) as bayar from keu_tm_bayar where 1=1 " . $filter . " ")->row();
		echo  "Rp " . number_format($data->bayar, 0, ",", ".");
	}
	function input_tagihan()
	{
		$echo = $this->mdl->input_tagihan();
		echo json_encode($echo);
	}

	function hapusTagihanSiswaSatuan()
	{
		$id_tagihan = $this->input->post("id_tagihan");
		$id_siswa = $this->input->post("id_siswa");
		$echo = $this->mdl->hapusTagihanSiswaSatuan($id_tagihan, $id_siswa);
		echo json_encode($echo);
	}
	function hapusTagihanTambahan()
	{
		$id_tagihan = $this->input->post("id_tagihan");
		$echo = $this->mdl->hapusTagihanTambahan($id_tagihan);
		echo json_encode($echo);
	}
	function updateNominalTagihan()
	{
		$id_tagihan = $this->input->post("id");
		$nominal = $this->input->post("nominal");
		$nominal = str_replace(".", "", $nominal);
		$echo = $this->mdl->updateNominalTagihan($id_tagihan, $nominal);
		echo json_encode($echo);
	}
	function updateNamaTagihan()
	{
		$id_tagihan = $this->input->post("id");
		$nama = $this->input->post("nama");
		$echo = $this->mdl->updateNamaTagihan($id_tagihan, $nama);
		echo json_encode($echo);
	}
	function import_pembayaran()
	{
		$data = $this->mdl->import_pembayaran();
		echo json_encode($data);
	}
}
