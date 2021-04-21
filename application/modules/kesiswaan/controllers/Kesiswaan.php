<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kesiswaan extends CI_Controller
{

	var $tbl_log = "data_siswa";
	var $tbl_cbt = "data_cbt";
	var $tbl_jadwal = "v_jadwal";
	var $tbl_mapel = "tr_mapel";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("guru"));
		$this->load->model("model", "mdl");
		$this->load->model("model_materi", "mdl_materi");
		$this->load->model("model_nilai", "mdl_nilai");
		date_default_timezone_set('Asia/Jakarta');
		//$this->session->unset_userdata("tahun_id");
		//$this->session->unset_userdata("sms_id");
	}
	function isi_sikap()
	{
		$tahun_real = $this->m_reff->tahun_asli();
		$tahun_kini = $this->m_reff->tahun();
		if ($tahun_real != $tahun_kini) {
			return false;
		}

		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$id_guru = $this->mdl->idu();
		$idkelas = $this->input->get_post("id_kelas");
		$idmapel = $this->input->get_post("idmapel");
		$nilai = $this->input->get_post("nilai");
		$dt = $this->db->query("select * from data_siswa where id_kelas='" . $idkelas . "' ")->result();
		foreach ($dt as $val) {
			$cek = $this->db->query("select * from tm_sikap where id_tahun='$tahun' and id_semester='$sms' and id_siswa='$val->id' and id_mapel='$idmapel' and id_guru='$id_guru' ")->num_rows();
			if (!$cek) {
				$this->db->set("id_siswa", $val->id);
				$this->db->set("id_semester", $sms);
				$this->db->set("id_tahun", $tahun);
				$this->db->set("id_mapel", $idmapel);
				$this->db->set("_cid", $this->mdl->idu());
				$this->db->set("id_guru", $this->mdl->idu());
				$this->db->set("nilai", $nilai);
				$this->db->insert("tm_sikap");
			}
		}
	}
	function download_absenmapel()
	{
		$idkelas = $this->input->get_post("idkelas");
		$idmapel = $this->input->get_post("idmapel");
		$this->mdl->download_absenmapel($idkelas, $idmapel);
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

	public function setKet()
	{
		$ket 	= $_POST["ket"];
		$code 	= $_POST["code"];

		$this->mdl_nilai->setKet($ket, $code);
	}

	public function rekap_nilai()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("rekap_nilai");
		} else {
			$data['konten'] = "rekap_nilai";
			$this->_template($data);
		}
	}
	public function absen()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("absen");
		} else {
			$data['konten'] = "absen";
			$this->_template($data);
		}
	}
	public function sikap()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("sikap");
		} else {
			$data['konten'] = "sikap";
			$this->_template($data);
		}
	}
	function getNilai()
	{
		echo	$this->load->view("getNilai");
	}
	function getAbsen()
	{
		echo	$this->load->view("getAbsen");
	}
	function getSikap()
	{
		echo	$this->load->view("getSikap");
	}
	public function materi()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo "<script> window.location.href='kesiswaan/materi';</script>";
			//echo	$this->load->view("materi");
		} else {
			$data['konten'] = "materi";
			$this->_template($data);
		}
	}

	public function nilai()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			//echo "<script> window.location.href='kesiswaan/nilai';</script>";
			echo	$this->load->view("nilai");
		} else {
			$data['konten'] = "nilai";
			$this->_template($data);
		}
	}
	function cbt()
	{
		$this->index();
	}

	function data_cbt()
	{
		$list = $this->mdl->get_data_cbt();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			if ($dataDB->sts == 0) {
				$sts = "Konsep";
			} else {
				$sts = "<span class='col-teal'>Aktif</span>";
				if ($dataDB->jam_mulai <= date("H:i:s") and $dataDB->jam_akhir >= date("H:i:s") and $dataDB->tgl_mulai = date("Y-m-d")) {
					$sts = "<span class='col-orange'>Sedang berlangsung</span>";
				} else {
					$sts = "<span class='col-red'>Sudah berakhir</span>";
				}
			}

			$tombol = '<button onclick="tinjau(`' . $dataDB->id . '`)" type="button" class="btn bg-teal btn-xs btn-block
					waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
					aria-expanded="true">
                    <span class="sr-only"><i class="material-icons">remove_red_eye</i>  </span>
                    </button>';


			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";


			$row[] = "<span class='size'>  " . $this->m_reff->goField("tm_cbt", "nama", "where id='" . $dataDB->id_cbt . "'") . " </b> </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("tm_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . "</span>";
			$row[] = "<span class='size'>  " . $this->tanggal->hariLengkap($dataDB->tgl_mulai, "/") . "   </span>";
			$row[] = "<span class='size'>  " . $dataDB->jam_mulai . "  - " . $dataDB->jam_akhir . " </span>";
			$row[] = "<span class='size'>  " . $sts . "   </span>";
			$row[] = $tombol;




			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_cbt(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	function getDataNilai()
	{
		$id_mapel_ajar = $this->input->post("id_mapel_ajar");
		$idkelas = $this->input->post("id_kelas");
		$id_mapel = $this->input->post("id_mapel");
		$sms = $this->m_reff->semester();
		$list = $this->mdl->getDataNilai();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		$datax = $this->db->query("select * from tm_kikd where id_tahun='" . $this->m_reff->tahun() . "'
		 and id_semester='" . $this->m_reff->semester() . "' and id_mapel_ajar='" . $id_mapel_ajar . "' ORDER BY CAST(SUBSTR(kd3_no,3,3) AS SIGNED INTEGER) ASC");
		foreach ($list as $dataDB) {
			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";
			$row[] = "<span class='size'>" . $dataDB->nama . "</span>";
			$row[] = "<span class='size'>" . $dataDB->nis . "</span>";
			//	 $nnkdp="";
			$kbp = "";
			foreach ($datax->result() as $data1) {
				$min = $data1->kd3_kb;
				$kbp[] = $min;
				$nilai = $this->mdl->getNilaiKd($dataDB->id, $data1->id, $idkelas, $id_mapel, 1, $sms);
				if ($nilai < $min) {
					$class = "col-red font-bold";
				} else {
					$class = "font-bold";
				}

				$row[] = "<span  class='" . $class . "'>" . $nilai . "</span>";
				//			$nnkdp+=$nilai;	 
			}

			$nilaiKd = $this->mdl->getNilaiRata($dataDB->id, $idkelas, $id_mapel, $sms);
			$kbp = array_sum($kbp) / count($kbp);
			if ($kbp > $nilaiKd) {
				$warnap = 'col-red font-bold';
			} else {
				$warnap = '';
			}
			$row[] = "<span class='size $warnap' title='$kbp'>" . $nilaiKd . "</span>";
			$kbk = "";
			foreach ($datax->result() as $data2) {
				$min = $data2->kd3_kb;
				$kbk[] = $min;
				$nilai = $this->mdl->getNilaiKi($dataDB->id, $data2->id, $idkelas, $id_mapel, 1, $sms);
				if ($nilai < $min) {
					$class = "col-red font-bold";
				} else {
					$class = "font-bold";
				}


				$row[] = "<span  class='" . $class . "'>" . $nilai . "</span>";
			}

			$nilaiUT = $this->mdl->getNilaiUT($dataDB->id, $idkelas, $id_mapel, $sms);
			$nilaiUA = $this->mdl->getNilaiUA($dataDB->id, $idkelas, $id_mapel, $sms);
			//	$nilaiPengetahuan=$this->mdl->getNilaiKBPengetahuan($id_mapel);
			$nilaiRataKi = $this->mdl->getNilaiRataKi($dataDB->id, $idkelas, $id_mapel, $sms);
			//	$nilaiRataKi_Max=$this->mdl->getNilaiRataKi_max($dataDB->id,$idkelas,$id_mapel,$sms);



			$nilaiSikap = $this->mdl->getNilaiRataSikap($dataDB->id, $id_mapel, $sms);
			$NAP = $this->mdl->gethitungNA($nilaiKd, $nilaiUT, $nilaiUA);

			if ($kbp > $NAP) {
				$warnaNAP = 'col-red font-bold';
			} else {
				$warnaNAP = '';
			}

			$kbk = array_sum($kbk) / count($kbk);
			if ($kbk > $nilaiRataKi) {
				$warnaKI = 'col-red font-bold';
			} else {
				$warnaKI = '';
			}


			if ($kbp > $nilaiUT) {
				$warnaUT = 'col-red font-bold';
			} else {
				$warnaUT = '';
			}

			if ($kbp > $nilaiUA) {
				$warnaUA = 'col-red font-bold';
			} else {
				$warnaUA = '';
			}


			$row[] = "<span title='$kbk' class='size $warnaKI'>" . $nilaiRataKi . "</span>";
			$row[] = "<span title='$kbp'  class='size $warnaUT'>" . $nilaiUT . "</span>";
			$row[] = "<span  title='$kbp' class='size $warnaUA'>" . $nilaiUA . "</span>";







			$row[] = "<span class='size'>" . $nilaiSikap . "</span>";
			$row[] = "<span   title='$kbp' class='size $warnaNAP'>" . $NAP . "</span>";
			$row[] = "<span title='$kbk' class='size $warnaKI'>" . $nilaiRataKi . "</span>";


			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count_getDataNIlai(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}



	function data_materi()
	{
		$list = $this->mdl_materi->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////


			$tombol = '<div class="demo-button-groups">
                                <div class="btn-group" role="group">
                                    <button type="button" onclick="edit(`' . $dataDB->id . '`,`' . $dataDB->nama . '`,`' . $dataDB->id_kelas . '`,`' . $dataDB->id_mapel . '`,`' . $dataDB->ket . '`)" class="btn bg-teal waves-effect waves-light">EDIT</button>
                                    <button type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama . '`)" class="btn bg-blue-grey waves-effect waves-light">HAPUS</button>
                                   
                                </div>
                                
                            </div>';



			$row = array();
			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = $tombol;
			$row[] = "<span class='size'>  " . $this->tanggal->dateTime($dataDB->_ctime, "/") . " </b> </span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("v_kelas", "nama", "where id='" . $dataDB->id_kelas . "'") . "</span>";
			$row[] = "<span class='size'>  " . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $dataDB->id_mapel . "'") . "</span>";
			$row[] = "<span class='size'>  " . $dataDB->nama . " </span>";
			$row[] = '<a class="col-teal" href="' . base_url() . "file_upload/dok/" . $dataDB->file . '" download>
			<div class="demo-icon-container"><i class="material-icons">file_download</i> <span class="icon-name"  >download</span></div></a> ';
			$row[] = "<span class='size'> " . $dataDB->ket . "   </span>";


			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_materi->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	function download_nilai()
	{
		$this->load->view("download_nilai");
	}

	function data_nilai()
	{

		$list = $this->mdl_nilai->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$id_semester = $dataDB->id_semester;
			$kikd = $this->db->query("SELECT * from tm_kikd where id='" . $dataDB->id_kikd . "'")->row();
			if ($dataDB->id_kategory_nilai == 1) {
				$kd3 = isset($kikd->kd3_no) ? ($kikd->kd3_no) : "";
				$kd3_desc = isset($kikd->kd3_desc) ? ($kikd->kd3_desc) : "";
				$kd4_no = isset($kikd->kd4_no) ? ($kikd->kd4_no) : "";
				$kd4_desc = isset($kikd->kd4_desc) ? ($kikd->kd4_desc) : "";
				$kikd = "KD:" . $kd3 . "   | KI:" . $kd4_no;
			} else {
				$kikd = "";
			}
			$namakelas = $this->m_reff->goField("v_siswa", "nama_kelas", "where id='" . $dataDB->id_siswa . "'");

			$tombol = '
		
					<button data-toggle="dropdown" class="btn btn-indigo btn-block">Pilih Aksi</button>
					<div class="dropdown-menu">
						<a href="' . base_url() . 'kesiswaan/download_nilai/' . $dataDB->id . '" class="dropdown-item"> Download</a>
						<button title="Edit data" type="button" onclick="edit(`' . $dataDB->id . '`)" class="btn btn-default btn-circle">Edit Nilai</button><br>
						<button title="Edit data" type="button" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->nama_nilai . '`,`' . $namakelas . '`)" class="btn btn-default btn-circle waves-effect waves-circle waves-float">Hapus</button>
					</div>
					
	
			';

			if ($id_semester == 2 and $dataDB->id_kategory_nilai == 3) {
				$n = "UKK";
			} else {
				$n = $this->m_reff->goField("tr_kategory_nilai", "nama", "where id='" . $dataDB->id_kategory_nilai . "'");
			}

			$row = array();

			$row[] = "<span class='size'>" . $no++ . "</span>";

			$row[] = $tombol;
			$row[] = "<span class='size'>  " . $this->tanggal->dateTime($dataDB->_ctime, "/") . " </b> </span>";
			$row[] = "<span class='size'>  " . $n . "
			 
			</span>";

			$row[] = "<span class='size'>  " . $namakelas . "</span>";

			$row[] = "<span class='size'>  " . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $dataDB->id_mapel . "'") . "</span>";

			$row[] = "<span class='size'>  " . $kikd . "</span>";
			$row[] = "<span class='size'>  " . $dataDB->nama_nilai . " </span>";

			//add html for action

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl_nilai->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	function tinjau()
	{
		$id = $this->input->post("id");
		$data_array["data"] = $this->db->get_where($this->tbl_cbt, array("id" => $id))->row();
		echo	$this->load->view("tinjau", $data_array);
	}

	function kirimMateri()
	{
		$token = $this->m_reff->cekToken();
		if ($token == false) {
			$data = array("token" => false);
		} else {
			$data = $this->mdl_materi->kirimMateri();
		}
		echo json_encode($data);
	}
	function editKirimMateri()
	{
		$token = $this->m_reff->cekToken();
		if ($token == false) {
			$data = array("token" => false);
		} else {
			$data = $this->mdl_materi->editKirimMateri();
		}
		echo json_encode($data);
	}
	function hapus_materi()
	{
		$data = $this->mdl_materi->hapus_materi();
		echo json_encode($data);
	}
	function getDataSiswa()
	{
		$data["code"] = $this->session->set_userdata("code", date('dmYhis'));
		$data["id_kelas"] = $this->input->post("kelas");
		$data["id_mapel"] = $this->input->post("mapel");


		if ($this->input->post("k_nilai") == "1") {
			$kd = $this->input->post("kikd[]");
			$data["id_kikd"] = $kd[0];
		} else {
			$kd = $this->input->post("kikd[]");
			$data["id_kikd"] = true;
		}

		$data["nama_nilai"] = $this->input->post("nama_nilai");
		$data["k_nilai"] = $this->input->post("k_nilai");
		echo	$this->load->view("input_nilai", $data);
	}
	function insertNilai()
	{
		$id_kikd = $this->security->xss_clean($this->input->post("id_kikd"));
		$id_kelas = $this->security->xss_clean($this->input->post("id_kelas"));
		$id_mapel = $this->security->xss_clean($this->input->post("id_mapel"));
		$id_siswa = $this->security->xss_clean($this->input->post("id_siswa"));
		$k_nilai = $this->security->xss_clean($this->input->post("k_nilai"));
		$code = $this->session->userdata("code");
		if ($id_kikd == "" or $id_kikd == "true" or $id_kikd == "false") {
			$id_kikd = null;
		}

		if ($k_nilai != 1) {
			$id_kikd = null;
		}

		$nama_nilai = $this->security->xss_clean($this->input->post("nama_nilai"));
		$array = array(
			"id_kategory_nilai" => $k_nilai,
			"id_kelas" => $id_kelas,
			"id_kikd" => $id_kikd,
			"id_mapel" => $id_mapel,
			"id_siswa" => $id_siswa,
			"nama_nilai" => $nama_nilai,
			"id_guru" => $this->session->userdata("id"),
			"id_semester" => $this->m_reff->semester(),
			"id_tahun" => $this->m_reff->tahun(),
			"code" => $code,
		);
		return $this->mdl_nilai->insertNilai($array);
	}
	function insertNilaiSikap()
	{

		$id_mapel = $this->security->xss_clean($this->input->post("idmapel"));
		$id_siswa = $this->security->xss_clean($this->input->post("idsiswa"));
		$id_sikap = $this->security->xss_clean($this->input->post("sts"));
		$nilai = $this->security->xss_clean($this->input->post("nilai"));


		$array = array(
			"id_mapel" => $id_mapel,
			"id_siswa" => $id_siswa,
			"id_guru" => $this->mdl->idu(),
			"id_semester" => $this->m_reff->semester(),
			"id_tahun" => $this->m_reff->tahun(),
		);
		return $this->mdl_nilai->insertNilaiSikap($array);
	}
	function insertNilaiSikap2()
	{

		$id_mapel = $this->security->xss_clean($this->input->post("idmapel"));
		$id_siswa = $this->security->xss_clean($this->input->post("idsiswa"));
		$nilai = $this->security->xss_clean($this->input->post("nilai"));


		$array = array(
			"id_mapel" => $id_mapel,
			"id_siswa" => $id_siswa,
			"id_guru" => $this->mdl->idu(),
			"id_semester" => $this->m_reff->semester(),
			"id_tahun" => $this->m_reff->tahun(),
		);
		return $this->mdl_nilai->insertNilaiSikap2($array);
	}
	function insertNilaiKi()
	{
		$code = $this->session->userdata("code");
		$id_kikd = $this->input->post("id_kikd");
		$id_kelas = $this->security->xss_clean($this->input->post("id_kelas"));
		$id_mapel = $this->security->xss_clean($this->input->post("id_mapel"));
		$id_siswa = $this->security->xss_clean($this->input->post("id_siswa"));
		$k_nilai = $this->security->xss_clean($this->input->post("k_nilai"));
		if ($id_kikd == "" or $id_kikd == "true" or $id_kikd == "false") {
			$id_kikd = null;
		}
		$nama_nilai = $this->security->xss_clean($this->input->post("nama_nilai"));
		$array = array(
			"id_kategory_nilai" => $k_nilai,
			"id_kelas" => $id_kelas,
			"id_kikd" => $id_kikd,
			"id_mapel" => $id_mapel,
			"id_siswa" => $id_siswa,
			"nama_nilai" => $nama_nilai,
			"id_guru" => $this->session->userdata("id"),
			"id_semester" => $this->m_reff->semester(),
			"code" => $code,
		);
		return $this->mdl_nilai->insertNilaiKi($array);
	}
	function getDataMapelByClass($id)
	{
		$this->db->where("id_guru", $this->session->userdata("id"));
		$this->db->where("id_kelas", $id);
		$this->db->group_by("id_mapel");
		return	$this->db->get($this->tbl_jadwal)->result();
	}
	function getDataMapelUn()
	{

		$this->db->where("sts", 1);
		return	$this->db->get("tr_mapel")->result();
	}
	function getPilihanMapel()
	{
		$data = '	 <select class="form-control show-tick" id="id_mapel" onchange="getKikdFilter()">
                      <option value="">--- Pilih Mata Pelajaran ---</option>';
		$mapel_un = $this->input->post("mapel_un");
		$kelas = $this->input->post("kelas");
		/*if($mapel_un==1)
		 {
				$dbmepel=$this->getDataMapelUn();
				foreach($dbmepel as $val){
				$data.="<option value='".$val->id."'>".$val->nama."</option>";
				};	
		 }else{ */
		$dbmepel = $this->getDataMapelByClass($kelas);
		foreach ($dbmepel as $val) {
			$data .= "<option value='" . $val->id_mapel . "'>" . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $val->id_mapel . "'") . "</option>";
		};
		//	 }

		$data .= ' </select>';
		echo $data;
	}

	function cekKateUn($kategory)
	{
		$db = $this->db->get_where("tr_kategory_nilai", array("id" => $kategory))->row();
		return isset($db->sts) ? ($db->sts) : "";
	}
	function getPilihanKelasnya()
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$kategory = $this->input->post("kategory");
		$cekKateUn = $this->cekKateUn($kategory);
		/*	if($cekKateUn=="1") /// jika nilai uas 
		{
			$this->db->where("id_wali",$this->session->userdata("id"));
			$data="<input type='hidden' id='mapel_un' value='1'> ";
			$data.=' <select class="form-control show-tick" id="kelas" name="f[id_kelas]" required onchange="pilihKelasInput()">';
		$database=$this->db->get("v_kelas")->result();
		 foreach($database as $val){
			 $data.="<option value='".$val->id."'>".$val->nama."</option>";
			};
			
		}else{*/
		$data = "<input type='hidden' id='mapel_un' value='0'> ";
		$data .= ' <select class="form-control show-tick" id="kelas" name="f[id_kelas]" required onchange="pilihKelasInput()">';
		$data .= '<option value="">--- Pilih Kelas ---</option>';
		$this->db->group_by("nama_kelas", "asc");
		$this->db->where("id_semester", $sms);
		$this->db->where("id_tahun", $tahun);
		$database = $this->db->get("v_jadwal")->result();
		foreach ($database as $val) {
			$data .= "<option value='" . $val->id_kelas . "'>" . $val->nama_kelas . "</option>";
		};
		//	}


		$data .= ' </select>';
		echo $data;
	}

	function getPilihanClassnya()
	{

		$kategory = $this->input->post("kategory");
		$cekKateUn = $this->cekKateUn($kategory);
		/*	if($cekKateUn==1)
		{
			 
			$data="<input type='hidden' id='mapel_un' value='1'> ";
			$data.=' <select class="form-control show-tick" id="id_kelas" onchange="pilihKelas()">';
			$this->db->where("id_wali",$this->session->userdata("id"));
			$database=$this->db->get("v_kelas")->result();
		 foreach($database as $val){
			 $data.="<option value='".$val->id."'>".$val->nama."</option>";
			};
		}else{*/
		$data = "<input type='hidden' id='mapel_un' value='0'> ";
		$data .= ' <select class="form-control show-tick" id="id_kelas" onchange="pilihKelas()">';
		$data .= '<option value="">--- Pilih Kelas ---</option>';
		$this->db->group_by("id_kelas");
		$database = $this->db->get("v_jadwal")->result();
		foreach ($database as $val) {
			$data .= "<option value='" . $val->id_kelas . "'>" . $val->nama_kelas . "</option>";
		};

		//	}

		$data .= ' </select>';
		echo $data;
	}

	function getPilihanUjian()
	{
		$kelas = $this->input->post("kelas");
		$data = '	  <select class="form-control show-tick" name="k_nilai">
                                        <option value="">--- Pilih Mata Pelajaran ---</option>';
		$dbmepel = $this->getDataUjian($kelas);
		foreach ($dbmepel as $val) {
			$data .= "<option value='" . $val->id_mapel . "'>" . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $val->id_mapel . "'") . "</option>";
		};
		$data .= ' </select>';
		echo $data;
	}
	function getPilihanMapelInput()
	{
		$kelas = $this->input->post("kelas");
		$mapel_un = $this->input->post("mapel_un");
		$data = '	  <div class="col-md-12"> 	<label> Pilih Mata Pelajaran</label>	  <select class="form-control col-md-12 show-tick" id="mapel"  required name="f[id_mapel]" onchange="getKikd()">
                                        <option value="">--- Pilih Mapel ---</option>';
		/* if($mapel_un==1)
		 {
				$dbmepel=$this->getDataMapelUn();
				foreach($dbmepel as $val){
				$data.="<option value='".$val->id."'>".$val->nama."</option>";
				};	
		 }else{*/
		$dbmepel = $this->getDataMapelByClass($kelas);
		foreach ($dbmepel as $val) {
			$data .= "<option value='" . $val->id_mapel . "'>" . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $val->id_mapel . "'") . "</option>";
		};
		// }

		$data .= ' </select></div>';
		echo $data;
	}


	function getKikd()
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$mapel = $this->input->post("mapel");
		$kelas = $this->input->post("kelas");
		$mapel_ajar = $this->m_reff->goField("tm_mapel_ajar", "id", "where id_mapel='" . $mapel . "' 
		and id_kelas='" . $kelas . "' and id_guru='" . $this->mdl->idu() . "' and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' ");
		$data = '	<br>	<label> Pilih KD Penilaian</label>			     <select data-size="5" data-header="Bisa pilih lebih dari 1 KD (khusus import file)" multiple class="select form-control show-tick" id="mapel" required name="kd[]"  data-selected-text-format="count"  >
                 ';
		$dbmepel = $this->db->query("SELECT * from tm_kikd where id_mapel_ajar='" . $mapel_ajar . "' 
				and id_guru='" . $this->mdl->idu() . "' and id_semester='" . $sms . "' and id_tahun='" . $tahun . "'
				  ORDER BY CAST(SUBSTR(kd3_no,3,3) AS SIGNED INTEGER),id ASC  ")->result();
		foreach ($dbmepel as $val) {
			$data .= "<option value='" . $val->id . "'>KD : " . $val->kd3_no . " / " . $val->kd4_no . "  </option>";
		};
		$data .= ' </select>';
		echo $data;
		echo "<script>$('.select').selectpicker();</script>";
	}
	function getKikdFilter()
	{
		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$mapel = $this->input->post("mapel");
		$ma = $this->input->post("ma");
		$data = '	  <select class="form-control show-tick" id="fid_kikd" onchange="reload()" >
                  <option value="">--- Pilih KI.KD ---</option>';
		$dbmepel = $this->db->query("SELECT * from v_kikd where id_mapel='" . $mapel . "'  and id_semester='" . $sms . "' and id_tahun='" . $tahun . "' and 
				id_mapel_ajar in (select id from v_mapel_ajar where id_kelas='" . $ma . "' and id_mapel='" . $mapel . "'  and id_semester='" . $sms . "' and id_tahun='" . $tahun . "') group by kd3_no 
				ORDER BY CAST(SUBSTR(kd3_no,3,3) AS SIGNED INTEGER),id ASC ")->result();
		foreach ($dbmepel as $val) {
			$data .= "<option value='" . $val->id . "'>" . $val->kd3_no . " - " . $val->kd3_desc . " | " . $val->kd4_no . " - " . $val->kd4_desc . "</option>";
		};
		$data .= ' </select>';
		echo $data;
	}


	function hapus_nilai()
	{
		$id = $this->input->post("id");
		echo $this->mdl_nilai->hapus_nilai($id);
	}
	function updateSetNamaNilai()
	{
		$id_kikd = $this->security->xss_clean($this->input->post("id_kikd"));
		$id_siswa = $this->security->xss_clean($this->input->post("id_siswa"));
		$id_mapel = $this->security->xss_clean($this->input->post("id_mapel"));
		$nama_nilai = $this->security->xss_clean($this->input->post("nama_nilai"));
		$k_nilai = $this->security->xss_clean($this->input->post("k_nilai"));
		$id_sms = $this->security->xss_clean($this->input->post("id_sms"));
		$nama_nilai = $this->security->xss_clean($this->input->post("nama_nilai"));
		if ($id_kikd == "" or $id_kikd == "true" or $id_kikd == "false") {
			$id_kikd = null;
		}
		$array = array(
			"id_kikd" => $id_kikd,
			"id_kategory_nilai" => $k_nilai,
			// "id_siswa"=>$id_siswa,
			"id_mapel" => $id_mapel,
			"id_guru" => $this->session->userdata("id"),
			"id_semester" => $id_sms,
		);
		echo $this->mdl_nilai->updateSetNamaNilai($array);
	}

	function updateSetKaNilai()
	{
		$id_kelas = $this->security->xss_clean($this->input->post("id_kelas"));
		$id_mapel = $this->security->xss_clean($this->input->post("id_mapel"));
		$nama_nilai = $this->security->xss_clean($this->input->post("nama_nilai"));
		$k_nilai = $this->security->xss_clean($this->input->post("k_nilai"));
		$id_sms = $this->security->xss_clean($this->input->post("id_sms"));

		$id_kikd = $this->security->xss_clean($this->input->post("idkikdawal")); //id kikd sebeleumnya
		if ($id_kikd == "" or $id_kikd == "true" or $id_kikd == "false") {
			$id_kikd = null;
		}
		$array = array(
			"id_kategory_nilai" => $k_nilai,
			"id_kelas" => $id_kelas,
			"id_kikd" => $id_kikd,
			"id_mapel" => $id_mapel,
			"nama_nilai" => $nama_nilai,
			"id_guru" => $this->session->userdata("id"),
			"id_semester" => $id_sms,
		);
		echo $this->mdl_nilai->updateSetKaNilai($array);
	}
	function editNilai()
	{
		$data["id"] = $this->input->post("id");
		echo	$this->load->view("edit_nilai", $data);
	}
	function download_format_nilai()
	{
		echo $this->mdl->download_format_nilai();
	}
	function getFormalSikap()
	{
		echo $this->mdl->getFormalSikap();
	}
	function getFormalSikap2()
	{
		echo $this->mdl->getFormalSikap2();
	}

	function import_data_nilai_multi()
	{
		$data = $this->mdl->import_data_nilai_multi();
		echo json_encode($data);
	}
	function import_data_nilai()
	{
		$this->session->set_userdata("code", date("dmYHis"));
		$data = $this->mdl->import_data_nilai();
		echo json_encode($data);
	}

	function importNilaiSikap()
	{
		$data = $this->mdl->importNilaiSikap("file");
		echo json_encode($data);
	}
	function importNilaiSikap2()
	{
		$data = $this->mdl->importNilaiSikap2("file");
		echo json_encode($data);
	}
}
