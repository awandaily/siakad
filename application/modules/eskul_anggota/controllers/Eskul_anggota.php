<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eskul_anggota extends CI_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("Model", "mdl");
		$this->load->model("Model_siswa", "mdl_siswa");
		date_default_timezone_set('Asia/Jakarta');

		$id = $this->input->get_post("ideskul");
		if ($id) {
			$this->session->set_userdata("ids", $id);
		}
	}
	function ids()
	{
		echo $this->mdl->ids();
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

	public function anggota()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("anggota");
		} else {
			$data['konten'] = "anggota";
			$this->_template($data);
		}
	}


	public function nilai()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("nilai");
		} else {
			$data['konten'] = "nilai";
			$this->_template($data);
		}
	}

	public function riwayat()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("riwayat");
		} else {
			$data['konten'] = "riwayat";
			$this->_template($data);
		}
	}





	function hapus()
	{
		$id = $this->input->post("id");
		$tbl = $this->uri->segment("3");
		echo $this->mdl->hapus($tbl, $id);
	}





	function data()
	{
		$tbl = $this->uri->segment("3");
		$list = $this->mdl->get_open($tbl);
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$alias = isset($dataDB->alias) ? ($dataDB->alias) : "";
			$lokasi = isset($dataDB->lokasi) ? ($dataDB->lokasi) : "";
			$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
                                    <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $alias . '`,`' . $lokasi . '`)" class="btn bg-teal waves-effect waves-light">EDIT</button>
                                    <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" class="btn bg-blue-grey waves-effect waves-light">HAPUS</button>
                                    
                                </div>
                                
                            </div>';
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $dataDB->nama . " </span>";
			if ($tbl == "tr_jurusan") {
				$row[] = "<span class='size'>" . $dataDB->alias . " </span>";
			}

			if ($tbl == "tr_mitra") {
				$row[] = "<span class='size'>" . $dataDB->lokasi . " </span>";
			}
			//add html for action
			$row[] = $tombol;
			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mdl->count_file($tbl),
			"recordsFiltered" => $this->mdl->count_file($tbl),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}





	function insert()
	{
		$tbl = $this->uri->segment(3);
		$data = $this->mdl->insert($tbl);
		echo json_encode($data);
	}

	function inputNilai()
	{
		$data = $this->mdl->inputNilai();
		echo json_encode($data);
	}


	function update()
	{
		$tbl = $this->uri->segment(3);
		$data = $this->mdl->update($tbl);
		echo json_encode($data);
	}

	function pilih2()
	{
		$id = $this->input->post("id");
		$group = $this->input->post("id_group");
		echo $this->mdl->pilih2($id, $group);
	}
	function pilih()
	{
		$id = $this->input->post("id");
		$pertama = $this->input->post("pertama");
		echo $this->mdl->pilih($id, $pertama);
	}
	function unpilih()
	{
		$id = $this->input->post("id");
		$pertama = $this->input->post("pertama");
		echo $this->mdl->unpilih($id, $pertama);
	}


	function getSubMapel()
	{
		$id_tk = $this->input->post("id_tk");
		$id_jurusan = $this->input->post("id_jurusan");
		$ray = "";
		$ray[""] = "---- Pilih Jika Sub Mapel ----";
		$this->db->where("id_tk", $id_tk);
		$this->db->where("id_jurusan", $id_jurusan);
		$this->db->where("id_mapel_induk", "");
		$data = $this->db->get("tr_mapel")->result();
		foreach ($data as $data) {
			$ray[$data->id] = $data->nama;
		}

		$dataray = $ray;
		echo form_dropdown("f[id_mapel_induk]", $dataray, "", 'class="form-control show-tick" data-live-search="true"  ');
		echo " <script>
		 $('select').selectpicker();
		 </script>";
	}


	///-----------------------SISWA--------------------------///

	function data_siswa()
	{
		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$djml = $this->db->get_where("eskul_group", array("id_eskul" => $this->mdl->ids(), "kode" => $this->mdl->kode()));
		$jml = $djml->num_rows();
		$dataGroup = $djml->result();
		$pertama = isset($djml->row()->id) ? ($djml->row()->id) : "";

		$opsi[] = "--- pilih ---";
		foreach ($dataGroup as $val) {
			$opsi[$val->id] = $val->nama;
		}

		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$kode = $this->mdl->kode();
		foreach ($list as $dataDB) {
			////
			$row = array();
			$row[] = "<span class='size'  onclick='edit(`" . $dataDB->id . "`)'  >" . $no++ . "</span>";
			if ($dataDB->aktifasi == 2) {
				$akt = "NON AKTIF";
				$in = "AKTIFKAN ";
			} else {
				$akt = "AKTIF";
				$in = "NON-AKTIFKAN  ";
			}
			if (!$jml) {
				$tombol = "tidak ada group";
			} elseif ($jml == 1) {
				$cek = $this->mdl->cekEskul($dataDB->id, $pertama, $tahun, $sms, $kode);
				if ($cek) {
					$c_f = "unpilih";
					$c_class = "bg-pink";
				} else {
					$c_f = "pilih";
					$c_class = "btn-default";
				}
				$nama = '            
              <button  title="Profile detail"
			  type="button" id="opsi' . $dataDB->id . '" onclick="' . $c_f . '(`' . $dataDB->id . '`,`' . $pertama . '`)" class="btn ' . $c_class . ' btn-block " style="text-align:left">
			     <i class="material-icons">account_circle</i><span id="opsispan' . $dataDB->id . '" >' . $dataDB->nama . ' (' . strtoupper($dataDB->jk) . ') </span></button>
                        ';

				$row[] = "<center>" . $nama . "</center>";
			} else {
				$cek = $this->mdl->cekEskulNoGroup($dataDB->id, $tahun, $sms, $kode);
				if ($cek) {
					$c_f = "pilih2";
					$vilih = $cek;
					$c_class = "col-pink";
				} else {
					$c_f = "pilih2";
					$vilih = "";
					$c_class = "";
				}

				$nama = " <b id='opsi" . $dataDB->id . "' for='label" . $dataDB->id . "' class='" . $c_class . "'>" . $dataDB->nama . ' (' . strtoupper($dataDB->jk) . ')</b>';
				$nama .= form_dropdown("pilih" . $dataDB->id, $opsi, $vilih, "class='form-control cursor' id='label" . $dataDB->id . "' onchange=" . $c_f . "(`" . $dataDB->id . "`)");
				$row[] = "<center>" . $nama . "</center> ";
			}








			//add html for action

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

	function inputNilaiG()
	{
		echo $this->mdl->inputNilaiG();
	}


	///-----------------------nilai--------------------------///

	function data_nilai()
	{
		$list = $this->mdl_siswa->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$djml = $this->db->get_where("eskul_group", array("id_eskul" => $this->mdl->ids(), "kode" => $this->mdl->kode()));
		$jml = $djml->num_rows();
		$dataGroup = $djml->result();
		$pertama = isset($djml->row()->id) ? ($djml->row()->id) : "";

		$opsi[] = "--- pilih ---";
		foreach ($dataGroup as $val) {
			$opsi[$val->id] = $val->nama;
		}

		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$kode = $this->mdl->kode();
		foreach ($list as $dataDB) {
			////
			$row = array();
			$row[] = "<span class='size'  onclick='edit(`" . $dataDB->id . "`)'  >" . $no++ . "</span>";
			if ($dataDB->aktifasi == 2) {
				$akt = "NON AKTIF";
				$in = "AKTIFKAN ";
			} else {
				$akt = "AKTIF";
				$in = "NON-AKTIFKAN  ";
			}
			if (!$jml) {
				$tombol = "tidak ada group";
			} else {
				$cek = $this->mdl->cekNilai($dataDB->id, $tahun, $sms);
				if ($cek) {
					$getNilai = $this->mdl->getNilaiEskul($dataDB->id, $tahun, $sms);

					$hasilnilai = isset($getNilai->nilai) ? ($getNilai->nilai) : "";

					// switch ($hasilnilai) {
					// 	case (9 or 10):
					// 		$label_nilai = "SANGAT BAIK";
					// 		break;
					// 	case (7 or 8):
					// 		$label_nilai = "BAIK";
					// 		break;
					// 	case 6:
					// 		$label_nilai = "CUKUP";
					// 		break;
					// 	case 5:
					// 		$label_nilai = "KURANG";
					// 		break;

					// 	default:
					// 		$label_nilai = "Unknown";
					// 		break;
					// }

					$hasilket = isset($getNilai->ket) ? ($getNilai->ket) : "";
					$c_f = "setNilai";
					$c_class = "bg-green";
					$nilai = '<br><span>Nilai : ' . $hasilnilai . ' </span><br><span>  ' . $hasilket . ' </span>';
				} else {
					$hasilnilai = "";
					$hasilket = "";
					$c_f = "setNilai";
					$c_class = "btn-default";
					$nilai = '';
				}
				$jmlhadiran = $this->mdl->jmlabsen($dataDB->id, $tahun, $sms);
				$jmlhadir = $jmlhadiran['hadir'];
				$jmlalfa = $jmlhadiran['alfa'];
				$kehadiran = "Hadir : " . $jmlhadir . " , Tidak Hadir : " . $jmlalfa;
				$nama = '            
              <div 
			  id="opsi' . $dataDB->id . '" onclick="' . $c_f . '(`' . $dataDB->id . '`,`' . $pertama . '`,`' . $dataDB->nama . '`,`' . $hasilnilai . '`,`' . $hasilket . '`)" class="btn ' . $c_class . ' btn-block " style="text-align:left">
			    <b><span id="opsispan' . $dataDB->id . '" >' . $dataDB->nama . ' (' . strtoupper($dataDB->jk) . ') </span> </b>
				' . $nilai . ' <p style="border-top:white solid 1px">
				' . $kehadiran . '</p>
				 </div>
                        ';

				$row[] = "<center>" . $nama . "</center>";
			}
			/*
		 elseif($jml==1){
			 
		 }else{
			 $cek=$this->mdl->cekEskulNoGroup($dataDB->id,$tahun,$sms,$kode);
			 if($cek)
			 {
				 $c_f="pilih2";$vilih=$cek;
				  $c_class="col-pink";
			 }else{
			  $c_f="pilih2";
			 $vilih="";
			  $c_class="";
			 }
			 
			$nama=" <b id='opsi".$dataDB->id."' for='label".$dataDB->id."' class='".$c_class."'>".$dataDB->nama.' ('.strtoupper($dataDB->jk).') '.$jml.'</b>';			
			$nama.=form_dropdown("pilih".$dataDB->id,$opsi,$vilih,"class='form-control cursor' id='label".$dataDB->id."' onchange=".$c_f."(`".$dataDB->id."`)");		
			 $row[] = "<center>".$nama."</center> " ;
		 }*/








			//add html for action

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
	} ///-----------------------nilai--------------------------///

	function data_pertemuan()
	{
		$list = $this->mdl->data_pertemuan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;

		foreach ($list as $dataDB) {
			$tgl = $this->tanggal->hariLengkap($dataDB->tgl, "/");
			$jmlhadiran = $this->mdl->jmlabsenharian($dataDB->id);
			$row = array();
			$row[] = $no++;
			$row[] = "<center>" . $tgl . "</center>";
			$row[] = "<center>" . $jmlhadiran["hadir"] . "</center>";
			$row[] = "<center>" . $jmlhadiran["alfa"] . "</center>";
			$data[] = $row;
		}


		//add html for action





		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_p(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
}
