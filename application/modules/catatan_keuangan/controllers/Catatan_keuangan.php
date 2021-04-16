<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Catatan_keuangan extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("keuangan", "keuangan siswa", "kepsek"));
		$this->load->model("M_pengeluaran", "pengeluaran");
		$this->load->model("M_pemasukan", "pemasukan");
		$this->load->model("M_rekap", "rekap");
	}

	function download_template()
	{
		$this->load->library("PHPExcel");
		$this->pengeluaran->download_template();
	}
	function upload_file()
	{
		if ($this->input->post("hapus") == 1) {
			$iduser = $this->session->userdata("id");
			$this->db->where("id_user", $iduser);
			$this->db->delete("tm_pengeluaran");
		}
		$data = $this->pengeluaran->do_upload_file();
		$data = explode("-", $data);
?>
		<hr>
		<center>
			<p class="text-green"><b>Selesai di Import</b></p>
		</center>
		<table class="table table-hover table-bordered">
			<?php echo "<tr><td>Berhasil di Import</td><td>:</td><td>" . $data[0] . "</td></tr>"; ?>
			<?php echo "<tr><td>Gagal di Import</td><td>:</td><td>" . $data[1] . "</td></tr>"; ?>
		</table>
<?php
	}
	function _template($data)
	{
		$this->load->view('template/main', $data);
	}
	public function pengeluaran()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("pengeluaran");
		} else {
			$data['konten'] = "pengeluaran";
			$this->_template($data);
		}
	}
	public function pemasukan()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("pemasukan/pemasukan");
		} else {
			$data['konten'] = "pemasukan/pemasukan";
			$this->_template($data);
		}
	}
	public function rekap()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("rekap/rekap");
		} else {
			$data['konten'] = "rekap/rekap";
			$this->_template($data);
		}
	}
	public function analisis()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			$this->load->model("M_reff");
			$thn = $this->M_reff->tahun();

			$this->db->where("id<=", $thn);
			$this->db->limit(3, 1);
			$qthn = $this->db->get("tr_tahun_ajaran")->result();

			$data['qthn']	= $qthn;
			$data['konten']	= "analisis";
			echo	$this->load->view("analisis", $data);
		} else {

			$this->load->model("M_reff");
			$thn = $this->M_reff->tahun();

			$this->db->where("id<=", $thn);
			$this->db->limit(3, 1);
			$qthn = $this->db->get("tr_tahun_ajaran")->result();

			$data['qthn']	= $qthn;
			$data['konten']	= "analisis";
			$this->_template($data);
		}
	}

	public function analisis_header()
	{
		$tk 	= $_POST["t"];

		$this->load->model("M_reff");
		$thnw = $this->M_reff->tahun();

		switch ($tk) {
			case '1':
				$col = "3";
				break;
			case '2':
				$col = "2";
				break;
			case '3':
				$col = "1";
				break;

			default:
				$col = "1";
				break;
		}

		$this->db->where("id<=", $thnw);
		$this->db->limit(3, $col);
		$qthn = $this->db->get("tr_tahun_ajaran")->result();

		$hthn = "<th></th>";
		$hthn2 = "";
		$nthn = 1;
		foreach ($qthn as $vthn) {


			if ($nthn == 1) {
				$hthn2 .= "<th>URAIAN PENERIMAAN DANA</th>";
				$colthn = "2";
			} else {
				$hthn2 .= "";
				$colthn = "2";
			}

			$hthn .= "
		        		<th colspan='" . $colthn . "'><center>" . $vthn->nama . "</center></th>";

			$hthn2 .= "
		            <th>MASUK DARI SISWA</th>
		            <th>TERHUTANG DI SISWA</th>
		        ";

			$nthn++;
		}
		$arr = array(
			"hthn"	=> $hthn,
			"hthn2"	=> $hthn2
		);
		$json = json_encode($arr);

		echo "[" . $json . "]";
	}

	public function analisis_data()
	{

		$this->load->model("M_analisis");

		$thn 	= $_POST["d"];
		$tk 	= $_POST["t"];
		$bln 	= $_POST["b"];


		$biaya 	= $this->M_analisis->get_biaya();

		$html 	= "";
		$n 		= 1;
		$masuk 	= 0;
		$hutang = 0;

		$this->load->model("M_reff");
		$thnw = $this->M_reff->tahun();

		switch ($tk) {
			case '1':
				$col = "3";
				break;
			case '2':
				$col = "2";
				break;
			case '3':
				$col = "1";
				break;

			default:
				$col = "1";
				break;
		}

		$this->db->where("id<=", $thnw);
		$this->db->limit(3, $col);
		$qthn = $this->db->get("tr_tahun_ajaran")->result();




		$rtotal = "";

		foreach ($biaya as $vb) {
			$html .= "
				<tr>
						<td>" . strtoupper($vb->nama_biaya) . "</td>
			";
			$row_t = "";
			$row_s = "";
			$row_y = "";
			foreach ($qthn as $vthn) {
				$dt 		= $this->M_analisis->get_data($vb->kode, $vthn->nama, $tk, $bln);
				$dt_total 	= $this->M_analisis->get_total($vb->kode, $vthn->nama, $tk, $bln);

				$html .= "		
					<td align='right'>" . number_format($dt['jbayar'], 0, ',', '.') . "</td>
					<td align='right'>" . number_format(($dt['jtagihan'] - $dt['jbayar']), 0, ',', '.') . "</td>
				";



				$n++;

				$hutang += ($dt['jtagihan'] - $dt['jbayar']);
				$masuk += $dt['jbayar'];

				$row_t .= "
					<td align='right'>" . number_format($dt_total['jbayar'], 0, ',', '.') . "</td>
                    <td align='right'>" . number_format(($dt_total['jtagihan'] - $dt_total['jbayar']), 0, ',', '.') . "</td>
				";
				$row_s .= "
					<td align='right'>" . number_format(($dt_total['jbayar'] * 70 / 100), 0, ',', '.') . "</td>
                    <td align='right'>" . number_format((($dt_total['jtagihan'] - $dt_total['jbayar']) * 70 / 100), 0, ',', '.') . "</td>
				";
				$row_y .= "
					<td align='right'>" . number_format(($dt_total['jbayar'] * 30 / 100), 0, ',', '.') . "</td>
                    <td align='right'>" . number_format((($dt_total['jtagihan'] - $dt_total['jbayar']) * 30 / 100), 0, ',', '.') . "</td>
				";
			}


			$html .= "</tr>";
		}

		$rtotal .= "
				<tr style='font-weight:bold'>
					<td align='center'>TOTAL</td>
					" . $row_t . "
				</tr>
				<tr style='font-weight:bold'>
					<td align='center'>SEKOLAH</td>
					" . $row_s . "
				</tr>
				<tr style='font-weight:bold'>
					<td align='center'>YAYASAN</td>
					" . $row_y . "
				</tr>
			";

		$html .= $rtotal;


		/*
		$html.="
				<tr style='font-weight:bold'>
                    <td align='center' colspan='2'><center>TOTAL</center></td>
                    <td align='right'>".number_format($masuk, 0, ',', '.')."</td>
                    <td align='right'>".number_format($hutang, 0, ',', '.')."</td>
                </tr>
                <tr style='font-weight:bold'>
                    <td align='center' colspan='2'><center>SEKOLAH</center></td>
                    <td align='right'>".number_format(($masuk*70/100), 0, ',', '.')."</td>
                    <td align='right'>".number_format(($hutang*70/100), 0, ',', '.')."</td>
                </tr>
                <tr style='font-weight:bold'>
                    <td align='center' colspan='2'><center>YAYASAN</center></td>
                    <td align='right'>".number_format(($masuk*30/100), 0, ',', '.')."</td>
                    <td align='right'>".number_format(($hutang*30/100), 0, ',', '.')."</td>
                </tr>
		";*/

		$data["dt"]	= $html;
		$this->load->view("analisis_data", $data);
	}


	function insert()
	{
		echo $this->pengeluaran->insert();
	}
	function insertPemasukan()
	{
		echo $this->pemasukan->insert();
	}

	function hapus()
	{
		echo $this->pengeluaran->hapus();
	}
	function hapusPemasukan()
	{
		echo $this->pemasukan->hapus();
	}
	function getListPengeluaran()
	{
		$list = $this->pengeluaran->get_datapengeluaran();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $val) {
			///
			if ($val->tipe == 0) {
				$tgl = $this->tanggal->ind($val->tgl, "/");
				$nominal = number_format($val->nominal, 0, ",", ".");
				$tombol = '<div class="btn-group" role="group">
                                    <button type="button" class="btn bg-grey waves-effect" onclick="edit_data(`' . $val->id . '`,`' . $val->nama . '`,`' . $nominal . '`,`' . $tgl . '`,`' . $val->ket . '`)">EDIT</button>                                 
                                    <button type="button" class="btn bg-teal waves-effect" onclick="hapus_data(`' . $val->id . '`,`' . $val->nama . '`)">HAPUS</button>
                                </div>';
				//	$nama="<b>".$val->kode."</b> ".$this->m_reff->goField("keu_tr_pengeluaran","nama","where kode='".$val->kode."' ");
			} else {
				$tombol = '-';
			}
			$row = array();
			$row[] = $no++;


			$nama = "<b>" . $val->kode . "</b> " . $this->m_reff->goField("keu_tr_pengeluaran", "nama", "where kode='" . $val->kode . "' ");

			if ($this->input->get("grafik") == "tdetail") {
				$row[] = $this->tanggal->hariLengkap(substr($val->tgl, 0, 10), "/");
				$row[] = $nama;
			} elseif ($this->input->get("grafik") == "th") {
				$row[] = $this->tanggal->hariLengkap(substr($val->tgl, 0, 10), "/");
			} else {
				$row[] = $val->tgl;
			}

			$row[] = number_format($val->nominal, 0, ",", ".");
			if ($this->input->get("grafik") == "tdetail" or $this->input->get("grafik") == "th") {
				$row[] = $val->ket;
				$row[] = $tombol;
			}
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pengeluaran->counts(),
			"recordsFiltered" => $this->pengeluaran->counts(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function getListPemasukan()
	{
		$list = $this->pemasukan->get_datapemasukan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $val) {
			///
			if ($val->tipe == 0) {
				$tgl = $this->tanggal->ind($val->tgl, "/");
				$nominal = number_format($val->nominal, 0, ",", ".");
				$tombol = '<div class="btn-group" role="group">
                                    <button type="button" class="btn bg-grey waves-effect" onclick="edit_data(`' . $val->id . '`,`' . $val->nama . '`,`' . $nominal . '`,`' . $tgl . '`,`' . $val->ket . '`)">EDIT</button>                                 
                                    <button type="button" class="btn bg-teal waves-effect" onclick="hapus_data(`' . $val->id . '`,`' . $val->nama . '`)">HAPUS</button>
                                </div>';
			} else {
				$tombol = '-';
			}
			$row = array();
			$row[] = $no++;
			if ($val->tipe == 2) {
				$siswa = $this->m_reff->goField("data_siswa", "nama", "where id='" . $val->id_siswa . "'");
				$nama = $siswa . br() . " Bayar " . $this->m_reff->namaBiaya($val->nama);
				$ket = str_replace(":lunas,", ", ", $val->ket);
			} else {
				$nama = $val->nama;
				$ket = $val->ket;
			}
			if ($this->input->get("grafik") == "tdetail") {


				$row[] = $this->tanggal->hariLengkap(substr($val->tgl, 0, 10), "/");
				$row[] = $nama;
			} elseif ($this->input->get("grafik") == "th") {
				$row[] = $this->tanggal->hariLengkap(substr($val->tgl, 0, 10), "/");
			} else {
				$row[] = $val->tgl;
			}

			$row[] = number_format($val->nominal, 0, ",", ".");
			if ($this->input->get("grafik") == "tdetail" or $this->input->get("grafik") == "th") {
				$row[] = $ket;
				$row[] = $tombol;
			}
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pemasukan->counts(),
			"recordsFiltered" => $this->pemasukan->counts(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function getListRekap()
	{
		$list = $this->rekap->get_datarekap();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $val) {
			///
			if ($val->tipe == 0) {
				$tgl = $this->tanggal->ind($val->tgl, "/");
				$nominal = number_format($val->nominal, 0, ",", ".");
				$tombol = '<div class="btn-group" role="group">
                                    <button type="button" class="btn bg-grey waves-effect" onclick="edit_data(`' . $val->id . '`,`' . $val->nama . '`,`' . $nominal . '`,`' . $tgl . '`,`' . $val->ket . '`)">EDIT</button>                                 
                                    <button type="button" class="btn bg-teal waves-effect" onclick="hapus_data(`' . $val->id . '`,`' . $val->nama . '`)">HAPUS</button>
                                </div>';
			} else {
				$tombol = '-';
			}
			$row = array();
			$row[] = $no++;


			if ($this->input->get("grafik") == "tdetail") {

				$row[] = $this->tanggal->hariLengkap(substr($val->tgl, 0, 10), "/");
			} elseif ($this->input->get("grafik") == "th") {
				$row[] = $this->tanggal->hariLengkap(substr($val->tgl, 0, 10), "/");
			} else {
				$row[] = $val->tgl;
			}



			if ($val->kredit) {
				$row[] = "Rp " . number_format($val->kredit, 0, ",", ".");
			} else {
				$row[] = "-";
			};
			if ($val->debit) {
				$row[] = "Rp " . number_format($val->debit, 0, ",", ".");
			} else {
				$row[] = "-";
			}
			if ($this->input->get("grafik") == "tdetail") {
				$row[] = $val->ket;
			}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->rekap->count(),
			"recordsFiltered" => $this->rekap->count(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	function exportData()
	{
		$tanggal = $this->input->get("tanggal");
		$grafik = $this->input->get("grafik");
		$tipe = $this->input->get("tipe");
		$akun = $this->input->get("akun");
		return $this->pengeluaran->exportData($tanggal, $grafik, $tipe, $akun);
	}
	function exportDataPemasukan()
	{
		$tanggal = $this->input->get("tanggal");
		$grafik = $this->input->get("grafik");
		$tipe = $this->input->get("tipe");
		return $this->pemasukan->exportData($tanggal, $grafik, $tipe);
	}


	function update()
	{
		echo $this->pengeluaran->update();
	}
	function updatePemasukan()
	{
		echo $this->pemasukan->update();
	}
	function getTablePengeluaran()
	{
		$data["grafik"] = $g = $this->input->get_post("grafik");
		$data["tanggal"] = $this->input->get_post("tanggal");
		$data["tipe"] = $this->input->get_post("tipe");
		$data["kode"] = $this->input->get_post("kode");

		if (substr($g, 0, 1) == "t") {
			$this->load->view("table", $data);
		} else {
			$this->load->view("grafik", $data);
		}
	}
	function getTablePemasukan()
	{
		$data["grafik"] = $g = $this->input->get_post("grafik");
		$data["tanggal"] = $this->input->get_post("tanggal");
		$data["tipe"] = $this->input->get_post("tipe");
		if (substr($g, 0, 1) == "t") {
			$this->load->view("pemasukan/table", $data);
		} else {
			$this->load->view("pemasukan/grafik", $data);
		}
	}
	function getTableRekap()
	{
		$data["grafik"] = $g = $this->input->get_post("grafik");
		$data["tanggal"] = $this->input->get_post("tanggal");
		$data["tipe"] = $this->input->get_post("tipe");
		if (substr($g, 0, 1) == "t") {
			$this->load->view("rekap/table", $data);
		} else {
			$this->load->view("rekap/grafik", $data);
		}
	}
	function getTrPengeluaran()
	{
		$val = $this->input->get_post("val");
		$idkategori = $this->input->get_post("id");
		$opsi = "";
		$opsi[''] = "==== Pilih ====";
		if ($idkategori) {
			$this->db->where("kode_kategori", $idkategori);
		}
		foreach ($this->db->get("keu_tr_pengeluaran")->result() as $val) {
			$opsi[$val->kode] = $val->kode . " " . $val->nama;
		}

		echo form_dropdown("f[kode]", $opsi, $val, " class='select form-control show-tick  cursor' id='kode'  required data-live-search='true'     ");

		echo "  <script>
			 $('.select').selectpicker();
			 </script>";
	}

	function getDataFilter()
	{
		$val = $this->input->get_post("val");
		$idkategori = $this->input->get_post("id");
		$opsi = "";

		$kode = $this->input->post("tipe");
		$this->db->where_in("kode_kategori", $kode);
		foreach ($this->db->get("keu_tr_pengeluaran")->result() as $val) {
			$opsi[$val->kode] = $val->kode . " " . $val->nama;
		}

		echo form_dropdown("fkode[]", $opsi, $val, " class='select form-control show-tick  cursor' id='fkode' onchange='loadTable()' data-actions-box='true'  multiple  required data-live-search='true'     ");

		echo "  <script>
			 $('.select').selectpicker();
			 </script>";
	}


	function getEditPengeluaran()
	{
		$data["id"] = $this->input->get_post("id");
		echo $this->load->view("getEditPengeluaran", $data);
	}
}
