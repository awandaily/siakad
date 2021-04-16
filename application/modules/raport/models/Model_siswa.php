<?php

class Model_siswa extends CI_Model
{


	var $tbl_jadwal = "tm_jadwal_mengajar";
	var $tbl = "v_siswa";
	var $tbl_log = "data_siswa";
	var $tbl_tagihan = "tm_tagihan";
	var $tbl_bayar = "tm_pembayaran";
	var $tbl_penilaian = "v_penilaian";
	function __construct()
	{
		parent::__construct();
	}

	function import_data_siswa()
	{
		$file_form = "file";
		$tahun = $this->m_reff->tahun();
		$this->load->library("PHPExcel");
		$insert = 0;
		$gagal = 0;
		$edit = 0;
		$validasi_hp = true;
		$validasi = true;
		$file   = explode('.', $_FILES[$file_form]['name']);
		$length = count($file);

		if ($file[$length - 1] == 'xlsx' || $file[$length - 1] == 'xls') {
			$tmp    = $_FILES[$file_form]['tmp_name'];

			$load = PHPExcel_IOFactory::load($tmp);
			$sheets = $load->getActiveSheet()->toArray(null, true, true, true);
			$i = 1;

			foreach ($sheets as $sheet) {
				if ($i > 1) {
					$id_siswa 	= isset($sheet[0]) ? ($sheet[0]) : "";
					$nisn 		= isset($sheet[3]) ? ($sheet[3]) : "";
					$alamat 	= isset($sheet[5]) ? ($sheet[5]) : "";
					$hp 		= isset($sheet[6]) ? ($sheet[6]) : "";
					$smp 		= isset($sheet[7]) ? ($sheet[7]) : "";

					$anak 		= isset($sheet[4]) ? ($sheet[4]) : "";
					$ayah 		= isset($sheet[8]) ? ($sheet[8]) : "";
					$ibu 		= isset($sheet[9]) ? ($sheet[9]) : "";
					$alamat_ortu = isset($sheet[10]) ? ($sheet[10]) : "";
					$hp_ayah	= isset($sheet[11]) ? ($sheet[11]) : "";
					$hp_ibu		= isset($sheet[12]) ? ($sheet[12]) : "";
					$payah 		= isset($sheet[13]) ? ($sheet[13]) : "";
					$pibu 		= isset($sheet[14]) ? ($sheet[14]) : "";

					$wali 		= isset($sheet[15]) ? ($sheet[15]) : "";
					$alamat_wali = isset($sheet[16]) ? ($sheet[16]) : "";
					$hp_wali 	= isset($sheet[17]) ? ($sheet[17]) : "";
					$pwali 		= isset($sheet[18]) ? ($sheet[18]) : "";

					$arr1 = array(
						'nisn' 				=> $nisn,
						'alamat'			=> $alamat,
						'hp'				=> $hp,
						'asal_smp'			=> $smp,
						'nama_wali'			=> $wali,
						'alamat_wali' 		=> $alamat_wali,
						'hp_wali'			=> $hp_wali,
						'id_pekerjaan_wali'	=> $pwali
					);

					$arr2 = array(
						'anak_ke' 			=> $anak,
						'nama_ayah'			=> $ayah,
						'nama_ibu'			=> $ibu,
						'alamat_ortu'		=> $alamat_ortu,
						'hp_ayah'			=> $hp_ayah,
						'hp_ibu'			=> $hp_ibu,
						'id_pekerjaan_ayah'	=> $payah,
						'id_pekerjaan_ibu'	=> $pibu
					);

					$this->db->where("id", $id_siswa);
					$this->db->update("data_siswa", $arr1);

					$this->db->where("id_siswa", $id_siswa);
					$this->db->update("data_ortu", $arr2);

					$edit++;
				}
				$i++;
			}
		} else {
			$var["file"] = false;
			$var["type_file"] = "xlsx";
		}
		$var["import_data"] = true;
		$var["data_insert"] = $insert;
		$var["data_gagal"] = $gagal;
		$var["data_edit"] = $edit;
		$var["hp"] = $validasi_hp;
		$var["validasi"] = $validasi;
		return $var;
	}



	function format_siswa()
	{
		$objPHPExcel = new PHPExcel();
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'rotation' => 0,
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '6CCECB')
			),
			'borders' =>
			array(
				'allborders' =>
				array(
					'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
				),
			),
		);
		$style2 = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'rotation' => 0,
			),
			'borders' =>
			array(
				'allborders' =>
				array(
					'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
				),
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'ccff99')
			)
		);
		$style3 = array(
			'borders' =>
			array(
				'allborders' =>
				array(
					'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'),
				),
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'ccff99')
			)
		);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setAutoSize(true);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('T')->setAutoSize(true);


		$objPHPExcel->getActiveSheet(0)->setCellValue('A1', 'KODE');
		$objPHPExcel->getActiveSheet(0)->setCellValue('B1', 'NAMA');
		$objPHPExcel->getActiveSheet(0)->setCellValue('C1', 'NIS');
		$objPHPExcel->getActiveSheet(0)->setCellValue('D1', 'NISN');
		$objPHPExcel->getActiveSheet(0)->setCellValue('E1', 'ANAK KE');
		$objPHPExcel->getActiveSheet(0)->setCellValue('F1', 'ALAMAT');
		$objPHPExcel->getActiveSheet(0)->setCellValue('G1', 'NO HP');
		$objPHPExcel->getActiveSheet(0)->setCellValue('H1', 'ASAL SMP');
		$objPHPExcel->getActiveSheet(0)->setCellValue('I1', 'NAMA AYAH');
		$objPHPExcel->getActiveSheet(0)->setCellValue('J1', 'NAMA IBU');
		$objPHPExcel->getActiveSheet(0)->setCellValue('K1', 'ALAMAT ORANG TUA');
		$objPHPExcel->getActiveSheet(0)->setCellValue('L1', 'NO HP AYAH');
		$objPHPExcel->getActiveSheet(0)->setCellValue('M1', 'NO HP IBU');
		$objPHPExcel->getActiveSheet(0)->setCellValue('N1', 'PEKERJAAN AYAH');
		$objPHPExcel->getActiveSheet(0)->setCellValue('O1', 'PEKERJAAN IBU');
		$objPHPExcel->getActiveSheet(0)->setCellValue('P1', 'NAMA WALI');
		$objPHPExcel->getActiveSheet(0)->setCellValue('Q1', 'ALAMAT WALI');
		$objPHPExcel->getActiveSheet(0)->setCellValue('R1', 'NO HP WALI');
		$objPHPExcel->getActiveSheet(0)->setCellValue('S1', 'PEKERJAAN WALI');

		$objPHPExcel->getActiveSheet(0)->getStyle('A1:S1')->applyFromArray($style);
		$objPHPExcel->getActiveSheet(0)->setTitle('DATA SISWA');

		$filter = "";
		$semester = $this->m_reff->semester();
		$tahun_real = $this->m_reff->tahun_asli();
		$tahun_kini = $this->m_reff->tahun();
		if ($tahun_real == $tahun_kini) {
			$id_kelas = $this->m_reff->goField("tm_kelas", "id", "where id_wali='" . $this->mdl->idu() . "'");
		} else {

			$getIdSiswa = $this->m_reff->goField("tm_catatan_walikelas", "id_siswa", "where _cid='" . $this->idu() . "' and id_tahun='" . $tahun_kini . "' order by RAND()   limit 1");
			$id_kelas = $this->m_reff->getHisKelas($getIdSiswa);

			// echo      $idkelas=$this->m_reff->goField("tm_kelas","id","where id_wali='".$this->mdl->idu()."'");	    
		}

		if ($this->m_reff->tahun_sts() == "true") {

			if ($id_kelas) {

				$filter .= "AND id_kelas='" . $id_kelas . "' ";
				$query = "select * from v_siswa where aktifasi=1 and id_tahun_keluar is null $filter ";
			}
		} else {
			$getIdSiswa = $this->m_reff->goField("tm_catatan_walikelas", "id_siswa", "where _cid='" . $this->idu() . "' and id_tahun='" . $tahun_kini . "'  order by RAND() limit 1");
			$idkelas = $this->m_reff->getHisKelas($getIdSiswa);
			$id_tk = $this->m_reff->goField("tm_kelas", "id_tk", "where id='" . $idkelas . "' ");

			if ($id_kelas) {

				$filter .= "AND   id_tahun_$id_tk=$tahun_kini and id_kelas_$id_tk=$idkelas  ";
			}

			$query = "select * from v_siswa where 1=1   $filter ";
		}

		$q = $this->db->query($query)->result();

		$n = 1;
		foreach ($q as $v) {

			$n++;
			$objPHPExcel->getActiveSheet(0)->setCellValue('A' . $n . '', $v->id);
			$objPHPExcel->getActiveSheet(0)->setCellValue('B' . $n . '',  $v->nama . " (" . strtoupper($v->jk) . ")");
			$objPHPExcel->getActiveSheet(0)->setCellValue('C' . $n . '', $v->nis);
			$objPHPExcel->getActiveSheet(0)->setCellValue('D' . $n . '', $v->nisn);
			$objPHPExcel->getActiveSheet(0)->setCellValue('E' . $n . '', $v->anak_ke);
			$objPHPExcel->getActiveSheet(0)->setCellValue('F' . $n . '', $v->alamat);
			$objPHPExcel->getActiveSheet(0)->setCellValue('G' . $n . '', $v->hp);
			$objPHPExcel->getActiveSheet(0)->setCellValue('H' . $n . '', $v->asal_smp);
			$objPHPExcel->getActiveSheet(0)->setCellValue('I' . $n . '', $v->nama_ayah);
			$objPHPExcel->getActiveSheet(0)->setCellValue('J' . $n . '', $v->nama_ibu);
			$objPHPExcel->getActiveSheet(0)->setCellValue('K' . $n . '', $v->alamat_ortu);
			$objPHPExcel->getActiveSheet(0)->setCellValue('L' . $n . '', $v->hp_ayah);
			$objPHPExcel->getActiveSheet(0)->setCellValue('M' . $n . '', $v->hp_ibu);
			$objPHPExcel->getActiveSheet(0)->setCellValue('N' . $n . '', $v->id_pekerjaan_ayah);
			$objPHPExcel->getActiveSheet(0)->setCellValue('O' . $n . '', $v->id_pekerjaan_ibu);
			$objPHPExcel->getActiveSheet(0)->setCellValue('P' . $n . '', $v->nama_wali);
			$objPHPExcel->getActiveSheet(0)->setCellValue('Q' . $n . '', $v->alamat_wali);
			$objPHPExcel->getActiveSheet(0)->setCellValue('R' . $n . '', $v->hp_wali);
			$objPHPExcel->getActiveSheet(0)->setCellValue('S' . $n . '', $v->id_pekerjaan_wali);
		}

		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="format-data-siswa.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}






	function idu()
	{
		return $this->session->userdata("id");
	}

	/*===================================*/
	function get_data($order = null)
	{
		$query = $this->_get_data($order);
		if ($_POST['length'] != -1)
			$query .= " limit " . $_POST['start'] . "," . $_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data($order)
	{


		$id_kelas = $this->input->post("id_kelas");
		$gender = $this->input->post("gender");
		$aktifasi = $this->input->post("aktifasi");
		$id_agama = $this->input->post("id_agama");
		$id_tahun_masuk = $this->input->post("id_tahun_masuk");
		$id_status_ibu = $this->input->post("id_status_ibu");
		$id_status_ayah = $this->input->post("id_status_ayah");
		$id_penghasilan = $this->input->post("id_penghasilan");
		$id_pekerjaan_ibu = $this->input->post("id_pekerjaan_ibu");
		$id_pekerjaan_ayah = $this->input->post("id_pekerjaan_ayah");


		$filter = "";
		if ($id_pekerjaan_ayah) {
			$filter .= "AND id_pekerjaan_ayah='" . $id_pekerjaan_ayah . "' ";
		}
		if ($id_pekerjaan_ibu) {
			$filter .= "AND id_pekerjaan_ibu='" . $id_pekerjaan_ibu . "' ";
		}
		if ($id_penghasilan) {
			$filter .= "AND id_penghasilan='" . $id_penghasilan . "' ";
		}
		if ($id_status_ayah) {
			$filter .= "AND id_status_ayah='" . $id_status_ayah . "' ";
		}
		if ($id_status_ayah) {
			$filter .= "AND id_status_ayah='" . $id_status_ayah . "' ";
		}
		if ($id_status_ibu) {
			$filter .= "AND id_status_ibu='" . $id_status_ibu . "' ";
		}
		if ($id_tahun_masuk) {
			$filter .= "AND id_tahun_masuk='" . $id_tahun_masuk . "' ";
		}
		if ($id_agama) {
			$filter .= "AND id_agama='" . $id_agama . "' ";
		}


		if ($gender) {
			$filter .= "AND jk='" . $gender . "' ";
		}


		if ($this->m_reff->tahun_sts() == "true") {
			if ($aktifasi) {
				$filter .= "AND aktifasi='" . $aktifasi . "' ";
			}

			if ($id_kelas) {

				$filter .= "AND id_kelas='" . $id_kelas . "' ";
				$query = "select * from " . $this->tbl . " where aktifasi=1 and id_tahun_keluar is null $filter ";
			}
		} else {
			$tahun = $this->m_reff->tahun();
			$getIdSiswa = $this->m_reff->goField("tm_catatan_walikelas", "id_siswa", "where _cid='" . $this->mdl->idu() . "' and id_tahun='" . $tahun . "'  order by RAND() limit 1");
			$idkelas = $this->m_reff->getHisKelas($getIdSiswa);
			$id_tk = $this->m_reff->goField("tm_kelas", "id_tk", "where id='" . $idkelas . "' ");

			if ($id_kelas) {

				$filter .= "AND   id_tahun_$id_tk=$tahun and id_kelas_$id_tk=$idkelas  ";
			}
			$query = "select * from " . $this->tbl . " where 1=1   $filter ";
		}














		if ($_POST['search']['value']) {
			$searchkey = $_POST['search']['value'];
			$query .= " AND (
				nama LIKE '%" . $searchkey . "%'  or
				nis LIKE '%" . $searchkey . "%'  or
				nama_ayah LIKE '%" . $searchkey . "%'  or
				nama_ibu LIKE '%" . $searchkey . "%'  or
				alamat LIKE '%" . $searchkey . "%'  or
				hp LIKE '%" . $searchkey . "%'  
				) ";
		}

		$column = array('', 'nama');
		$i = 0;
		foreach ($column as $item) {
			$column[$i] = $item;
		}


		if ($order == null) {

			if (isset($_POST['order'])) {
				$query .= " order by nama   asc";
			} else if (isset($order)) {
				$order = $order;
				$query .= " order by " . key($order) . " " . $order[key($order)];
			}
		} else {
			$query .= " order by " . $order;
		}


		return $query;
	}

	public function count($order = null)
	{
		$query = $this->_get_data($order);
		return  $this->db->query($query)->num_rows();
	}

	/*===================================*/

	/*===================================*/
	function get_data_non($order = null)
	{
		$query = $this->_get_data_non($order);
		if ($_POST['length'] != -1)
			$query .= " limit " . $_POST['start'] . "," . $_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_non($order)
	{


		$id_kelas = $this->input->post("id_kelas");
		$gender = $this->input->post("gender");
		$aktifasi = $this->input->post("aktifasi");
		$id_agama = $this->input->post("id_agama");
		$id_tahun_masuk = $this->input->post("id_tahun_masuk");
		$id_status_ibu = $this->input->post("id_status_ibu");
		$id_status_ayah = $this->input->post("id_status_ayah");
		$id_penghasilan = $this->input->post("id_penghasilan");
		$id_pekerjaan_ibu = $this->input->post("id_pekerjaan_ibu");
		$id_pekerjaan_ayah = $this->input->post("id_pekerjaan_ayah");


		$filter = "";
		if ($id_pekerjaan_ayah) {
			$filter .= " AND id_pekerjaan_ayah='" . $id_pekerjaan_ayah . "' ";
		}
		if ($id_pekerjaan_ibu) {
			$filter .= " AND id_pekerjaan_ibu='" . $id_pekerjaan_ibu . "' ";
		}
		if ($id_penghasilan) {
			$filter .= " AND id_penghasilan='" . $id_penghasilan . "' ";
		}
		if ($id_status_ayah) {
			$filter .= " AND id_status_ayah='" . $id_status_ayah . "' ";
		}
		if ($id_status_ayah) {
			$filter .= " AND id_status_ayah='" . $id_status_ayah . "' ";
		}
		if ($id_status_ibu) {
			$filter .= " AND id_status_ibu='" . $id_status_ibu . "' ";
		}
		if ($id_tahun_masuk) {
			$filter .= " AND id_tahun_masuk='" . $id_tahun_masuk . "' ";
		}
		if ($id_agama) {
			$filter .= " AND id_agama='" . $id_agama . "' ";
		}
		if ($aktifasi) {
			$filter .= " AND aktifasi='" . $aktifasi . "' ";
		}



		if ($gender) {
			$filter .= " AND jk='" . $gender . "' ";
		}
		$filter .= " AND id_agama>1";

		if ($this->m_reff->tahun_sts() == "true") {

			if ($id_kelas) {

				$filter .= " AND id_kelas='" . $id_kelas . "' ";
			}


			$query = "select * from " . $this->tbl . " where aktifasi=1 and id_tahun_keluar is null $filter ";
		} else {

			$id_tk = $this->m_reff->goField("tm_kelas", "id_tk", "where id='" . $id_kelas . "' ");
			$tahun = $this->m_reff->tahun();


			$query = "select * from " . $this->tbl . " where id_tahun_$id_tk=$tahun and id_kelas_$id_tk=$id_kelas $filter ";
		}







		if ($_POST['search']['value']) {
			$searchkey = $_POST['search']['value'];
			$query .= " AND (
				nama LIKE '%" . $searchkey . "%'  or
				nis LIKE '%" . $searchkey . "%'  or
				nama_ayah LIKE '%" . $searchkey . "%'  or
				nama_ibu LIKE '%" . $searchkey . "%'  or
				alamat LIKE '%" . $searchkey . "%'  or
				hp LIKE '%" . $searchkey . "%'  
				) ";
		}

		$column = array('', 'nama');
		$i = 0;
		foreach ($column as $item) {
			$column[$i] = $item;
		}


		if ($order == null) {

			if (isset($_POST['order'])) {
				$query .= " order by nama   asc";
			} else if (isset($order)) {
				$order = $order;
				$query .= " order by " . key($order) . " " . $order[key($order)];
			}
		} else {
			$query .= " order by " . $order;
		}


		return $query;
	}

	public function count_non($order = null)
	{
		$query = $this->_get_data_non($order);
		return  $this->db->query($query)->num_rows();
	}

	/*===================================*/

	//==============================================================///

	function getDataMapel($id)
	{
		$data = explode(",", $id);
		$mapel = "";
		foreach ($data as $val) {
			$mapel .= $this->m_reff->goField("tr_mapel", "nama", "where id='" . $val . "' ") . ",";
		}
		return substr($mapel, 0, -1);
	}

	//==============================================================///
	function kehadiranGroup($id_siswa, $sts, $bln)
	{

		return $this->db->query("select * from tm_absen_siswa where  SUBSTR(tgl,1,7)='" . $bln . "'
		and     absen" . $sts . " like '%," . $id_siswa . ",%' group by SUBSTR(tgl,1,10) ")->num_rows();
	}
	function kehadiran($id_siswa, $sts, $bln)
	{

		return $this->db->query("select * from tm_absen_siswa where  SUBSTR(tgl,1,7)='" . $bln . "'
		and     absen" . $sts . " like '%," . $id_siswa . ",%'
		")->num_rows();
	}


	function get_data_catatan()
	{
		$query = $this->_get_data_catatan();
		if ($_POST['length'] != -1)
			$query .= " limit " . $_POST['start'] . "," . $_POST['length'];
		return $this->db->query($query)->result();
	}
	function _get_data_catatan()
	{

		$id_kelas = $this->input->post("id_kelas");
		$id_jenis = $this->input->post("id_jenis");
		$ke_bp = $this->input->post("ke_bp");
		$id_siswa = $this->input->post("id_siswa");

		$filter = "";
		if ($ke_bp) {
			if ($ke_bp == 3) {
				$filter .= "AND teruskan='' ";
			} else {
				$filter .= "AND teruskan like '%" . $ke_bp . "%' ";
			}
		}


		if ($id_siswa) {
			$filter .= "AND id_siswa='" . $id_siswa . "' ";
		}
		if ($id_kelas) {
			$filter .= "AND id_kelas='" . $id_kelas . "' ";
		}
		if ($id_jenis) {
			$filter .= "AND id_jenis='" . $id_jenis . "' ";
		}



		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();


		$query = "select * from tm_catatan where     id_tahun='" . $tahun . "' and id_semester='" . $sms . "'  $filter ";
		if ($_POST['search']['value']) {
			$searchkey = $_POST['search']['value'];
			$query .= " AND (
				nama LIKE '%" . $searchkey . "%'  or
				 
				ket LIKE '%" . $searchkey . "%'  
				) ";
		}

		$column = array('', 'nama');
		$i = 0;
		foreach ($column as $item) {
			$column[$i] = $item;
		}

		if (isset($_POST['order'])) {
			$query .= " order by id   DESC";
		} else if (isset($order)) {
			$order = $order;
			$query .= " order by " . key($order) . " " . $order[key($order)];
		}
		return $query;
	}

	function count_catatan()
	{
		$query = $this->_get_data_catatan();
		return  $this->db->query($query)->num_rows();
	}

	function update_non()
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$valu = $this->input->post("valu");
		$id_siswa = $this->input->post("id_siswa");
		$jml = $this->input->post("jml");
		$cek = $this->m_reff->goField("data_nilai_nonmuslim", "id_siswa", "where id_semester='" . $sms . "' and id_tahun='" . $tahun . "' and id_siswa='" . $id_siswa . "' ");
		if ($cek) {
			$db = "update";
			$this->db->set($valu, $jml);
			$this->db->set("id_guru", $this->idu());
			$this->db->where("id_siswa", $id_siswa);
			$this->db->where("id_semester", $sms);
			$this->db->where("id_tahun", $tahun);
		} else {
			$db = "insert";
			$this->db->set($valu, $jml);
			$this->db->set("id_siswa", $id_siswa);
			$this->db->set("id_semester", $sms);
			$this->db->set("id_tahun", $tahun);
			$this->db->set("id_guru", $this->idu());
		}

		return $this->db->$db("data_nilai_nonmuslim");
	}
}
