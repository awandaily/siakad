<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kiriman_tugas extends CI_Controller
{


	var $tbl = "v_pegawai";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_global();
		$this->load->model("model", "mdl");
		$this->load->model("m_sms", "sms");
		date_default_timezone_set('Asia/Jakarta');
	}
	function kirim_pengumuman()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("kirim_pengumuman");
		} else {
			$data['konten'] = "kirim_pengumuman";
			$this->_template($data);
		}
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
			$data["mapel"]	= $this->mdl->dataMapel();
			$this->_template($data);
		}
	}
	public function jurusan()
	{
		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			echo	$this->load->view("jurusan");
		} else {
			$data['konten'] = "jurusan";
			$this->_template($data);
		}
	}
	public function siswa()
	{

		$ajax = $this->input->get_post("ajax");
		if ($ajax == "yes") {
			// 	echo "<script> window.location.href='pendidik';</script>";
			echo	$this->load->view("siswa");
		} else {
			$data['konten'] = "siswa";
			$this->_template($data);
		}
	}


	///-----------------------SISWA--------------------------///



	///-----------------------CATATAN PENILIAAN--------------------------///
	function getCatatan()
	{
		$mobile = $this->m_reff->mobile();
		$list = $this->mdl->get_data();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////

			if ($mobile) {
				$edit = '<ul class="header-dropdown m-r-0">
                                
                                <li>
                                    <a href="javascript:edit(`' . $dataDB->id . '`,`' . $dataDB->judul . '`);">
                                        <i class="material-icons">border_color</i>
                                    </a>
                                </li>
                            </ul>';
				$tt = '
               <div class="col-md-8 col-xs-8 ">    <button  onclick="periksa(`' . $dataDB->id . '`,`' . $dataDB->kelas . '`)" type="button" class="btn  btn-block  col-xs-3 bg-teal waves-effect"  style="min-width:70px">PERIKSA  TUGAS</button> </div>
            <div class="col-md-4  col-xs-4"> <button   type="button" class=" btn bg-pink col-xs-4  btn-block  waves-effect" onclick="hapus(`' . $dataDB->id . '`,`' . $dataDB->judul . '`)" >HAPUS</button>  </div>';
			} else {
				$tt = '
               <div class="col-md-2 ">    <button onclick="periksa(`' . $dataDB->id . '`,`' . $dataDB->kelas . '`)"  type="button" class="btn   col-md-12 btn-block bg-teal waves-effect">PERIKSA TUGAS</button> </div>
            <div class="col-md-3 pull-right  ">
             
            <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                <a href="javascript:edit(`' . $dataDB->id . '`,`' . $dataDB->judul . '`)" class="btn bg-grey waves-effect" role="button">EDIT</a>
                                <a href="javascript:hapus(`' . $dataDB->id . '`,`' . $dataDB->judul . '`)" class="btn bg-blue-grey waves-effect" role="button">HAPUS</a>
                               
                            </div> 
            </div>';
				$edit = "";
			}


			$dakel = $this->m_reff->clearkomaray($dataDB->kelas);
			$kls = "";
			foreach ($dakel as $vis) {
				$kls .= $this->m_reff->goField("v_kelas", "nama", "where id='" . $vis . "' ") . ", ";
			}
			$kls = substr($kls, 0, -2);
			$nama = ""; //$this->m_reff->goField("data_siswa","nama","where id='".$dataDB->id_siswa."' ");
			$mapel = "<div class='col-orange'>" . $this->m_reff->goField('tr_mapel', "nama", "where id='" . $dataDB->id_mapel . "'") . "</div>";
			$hari = $this->tanggal->selisih(date('Y-m-d'), $dataDB->expired);
			if ($hari > 0) {
				$sts = "<span class='col-indigo'>" . $hari . " Hari lagi</span>";
			} else {
				$sts = "<span class='col-red'>Expired</span>";
			}


			if ($hari > 0) {
				$sts = "<span class='col-indigo'>" . $hari . " Hari lagi</span>";
			} else {
				$sts = "<span class='col-red'>Expired</span>";
			}


			if ($dataDB->file) {
				$file = '<li > <i class="material-icons">attachment</i> 
		    <a download="" href="' . base_url() . 'file_upload/tugas/' . $dataDB->id . '/' . $dataDB->file . '?download=true" class="col-pink" >   File tugas </a></li>';
			} else {
				$file = "";
			}

			$file = '<ol class="breadcrumb breadcrumb-col-teal">
                                ' . $file . '
                                 
                                <li class="active"> Batas pengerjaan : ' . $sts . '</li>
                            </ol>';
			$sts = $hari;




			$tombol = ' 
          <div class="card" style="border:black solid 1px">
                        <div class="header bg-white">
                        <b style="font-size:14px" class="col-teal">  ' . $dataDB->judul . '</b>
                          
                          
                          
                            
                            ' . $mapel . $kls . '
                        </div>
                        <div class="bodyx" style="padding:10px">
                        ' . $dataDB->ket . $file . '
                        </div>
        
                               <div class="row clearfix">&nbsp;</div>     
                 <div class="row clearfix">&nbsp;</div>     
                    </div>';

			$row = array();
			$row[] = $tombol;

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->count(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	///-----------------------CATATAN PENILIAAN--------------------------///
	function getPengumuman()
	{
		$mobile = $this->m_reff->mobile();
		$list = $this->mdl->get_data_pengumuman();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////


			$tt = '
             <div class="col-md-3 pull-right  ">
             
            <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                <a href="javascript:edit(`' . $dataDB->id . '`,`' . $dataDB->judul . '`)" class="btn bg-grey waves-effect" role="button">EDIT</a>
                                <a href="javascript:hapus(`' . $dataDB->id . '`,`' . $dataDB->judul . '`)" class="btn bg-blue-grey waves-effect" role="button">HAPUS</a>
                               
                            </div> 
            </div>';
			$edit = "";


			$dakel = $this->m_reff->clearkomaray($dataDB->kelas);
			$kls = "";
			foreach ($dakel as $vis) {
				$kls .= $this->m_reff->goField("v_kelas", "nama", "where id='" . $vis . "' ") . ", ";
			}
			$kls = substr($kls, 0, -2);
			$nama = ""; //$this->m_reff->goField("data_siswa","nama","where id='".$dataDB->id_siswa."' ");

			$hari = $this->tanggal->selisih(date('Y-m-d'), $dataDB->expired);
			if ($hari > 0) {
				$sts = "<span class='col-indigo'>" . $hari . " Hari lagi</span>";
			} else {
				$sts = "<span class='col-red'>Expired</span>";
			}


			if ($hari > 0) {
				$sts = "<span class='col-indigo'>" . $hari . " Hari lagi</span>";
			} else {
				$sts = "<span class='col-red'>Expired</span>";
			}


			if ($dataDB->file) {
				$file = '<li > <i class="material-icons">attachment</i> 
		    <a download="" href="' . base_url() . 'file_upload/pengumuman/' . $dataDB->file . '?download=true" class="col-pink" >   File  upload </a></li>';
			} else {
				$file = "";
			}

			$file = '<ol class="breadcrumb breadcrumb-col-teal">
                                ' . $file . '
                                 
                                <li class="active"> Masa publikasi : ' . $sts . '</li>
                            </ol>';
			$sts = $hari;




			$tombol = ' 
          <div class="card" style="border:black solid 1px">
                        <div class="header bg-white">
                        <b style="font-size:14px" class="col-teal">  ' . $dataDB->judul . '</b><br>
                          
                          ' . $edit . '
                          
                            
                            ' . $kls . '
                        </div>
                        <div class="bodyx" style="padding:10px">
                        ' . $dataDB->ket . $file . '
                        </div>
        ' . $tt . '
                               <div class="row clearfix">&nbsp;</div>     
                 <div class="row clearfix">&nbsp;</div>     
                    </div>';

			$row = array();
			$row[] = $tombol;

			$data[] = $row;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $c = $this->mdl->countPengumuman(),
			"recordsFiltered" => $c,
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	//-------------------------------------------------END SISWA------------------------------------//
	function idu()
	{
		return $this->session->userdata("id");
	}

	function getKelas()
	{
		$idtk = $this->input->post("id");
		$idjurusan = $this->input->post("jur");
		$value = $this->input->post("val");

		$this->db->where("id_tk", $idtk);
		$this->db->where("id_jurusan", $idjurusan);
		$sts = $this->db->get("tm_kelas")->result();
		$ray = "";
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $val->nama;
		}
		echo form_dropdown("f[id_kelas]", $ray, $value, 'required class="form-control col-md-12 show-tick" ');
		echo "<script>$('select').selectpicker();</script>";
	}
	function getSiswa()
	{

		$idk = $this->input->post("idk");
		$this->db->where("id_kelas", $idk);
		$value = $this->input->post("val");
		$sts = $this->db->get("data_siswa")->result();
		$ray = "";
		$ray[""] = "=== Pilih ===";
		foreach ($sts as $val) {
			$ray[$val->id] = $val->nama;
		}
		echo form_dropdown("f[id_siswa]", $ray, $value, 'required class="form-control col-md-12 show-tick" data-live-search="true" ');
		echo "<script>$('select').selectpicker();</script>";
	}
	function periksa()
	{
		echo $this->load->view("periksa");
	}
	function periksa_perkelas()
	{
		echo $this->load->view("periksa_perkelas");
	}
	function viewAdd()
	{
		echo $this->load->view("viewAdd");
	}
	function viewAddPengumuman()
	{
		echo $this->load->view("viewAddPengumuman");
	}
	function viewEdit()
	{
		echo $this->load->view("viewEdit");
	}
	function viewEditPengumuman()
	{
		echo $this->load->view("viewEditPengumuman");
	}
	function insert()
	{
		$echo = $this->mdl->insert();
		echo json_encode($echo);
	}
	function insert_pengumuman()
	{
		$echo = $this->mdl->insert_pengumuman();
		echo json_encode($echo);
	}
	function update()
	{
		echo $this->mdl->update();
	}
	function update_pengumuman()
	{
		echo $this->mdl->update_pengumuman();
	}
	function hapus()
	{
		$id = $this->input->post("id");
		echo $this->mdl->hapus($id);
	}
	function hapus_pengumuman()
	{
		$id = $this->input->post("id");
		echo $this->mdl->hapus_pengumuman($id);
	}
	function getKelasByMapel()
	{
		$idm = $this->input->get_post("idm");
		if (!$idm) {
			echo "<i>Mohon pilih mapel.</i>";
			return false;
		}
		$mapel = $this->m_reff->getMapelSerupa($idm);
		$data = $this->db->query("select * from v_mapel_ajar where id_guru='" . $this->idu() . "' and 
     id_mapel IN(" . $mapel . ") and id_tahun='" . $this->m_reff->tahun() . "' and id_semester='" . $this->m_reff->semester() . "' ")->result();
		// $key[]="==== pilih ====";
		foreach ($data as $val) {
			$key[$val->id_kelas] = $val->kelas;
		}
		$kelas = $key;
		echo form_dropdown("id_kelas[]", $kelas, "", "multiple class='form-control' data-actions-box='true'");

		$mobile = $this->m_reff->mobile();
		if (!$mobile) {
			echo "  	 <script>
         $('select').selectpicker();
         </script>";
		}
	}
	function getKelasByMapelnoMulty()
	{
		$idm = $this->input->get_post("idm"); //if(!$idm){ echo "<i>Mohon pilih mapel.</i>"; return false;}
		$mapel = $this->m_reff->getMapelSerupa($idm);
		$data = $this->db->query("select * from v_mapel_ajar where id_guru='" . $this->idu() . "' and 
     id_mapel IN(" . $mapel . ") and id_tahun='" . $this->m_reff->tahun() . "' and id_semester='" . $this->m_reff->semester() . "' ")->result();
		$key[] = "==== pilih ====";
		foreach ($data as $val) {
			$key[$val->id_kelas] = $val->kelas;
		}
		$kelas = $key;
		echo form_dropdown("id_kelas", $kelas, "", "id='id_kelas' class='form-control' data-actions-box='true' onchange='reload_table()'");

		$mobile = $this->m_reff->mobile();
		if (!$mobile) {
			echo "  	 <script>
         $('select').selectpicker();
         </script>";
		}
	}
	function setNilai()
	{
		$idtugas = $this->input->post("idtugas");
		$idsiswa = $this->input->post("idsiswa");
		$nilai = $this->input->post("nilai");
		echo $this->mdl->setNilai($idtugas, $idsiswa, $nilai);
	}
	function sinkron_nilai()
	{
		echo $this->mdl->sinkron_nilai();
	}
}
