<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kirim_pesan extends CI_Controller
{


	var $tbl = "v_pegawai";
	function __construct()
	{
		parent::__construct();
		$this->m_konfig->validasi_session(array("ADMIN", "KEPSEK", "GURU"));
		$this->load->model("model", "mdl");
		$this->load->model("m_sms", "sms");
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
	///-----------------------SISWA--------------------------///




	///-----------------------CATATAN PENILIAAN--------------------------///
	function getPengumuman()
	{
		$mobile = $this->m_reff->mobile();
		$list = $this->mdl->get_data_pesan();
		$data = array();
		$no = $_POST['start'];
		$no = $no + 1;
		foreach ($list as $dataDB) {
			////
			$baca = $this->db->query("select * from data_pesan where kode='$dataDB->kode' and sts_baca='1'  ")->num_rows();
			$kls = "";
			$tt = '
             <div class="col-md-3 col-sx-12 col-xs-12 pull-right  ">
             
            <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                <a href="javascript:hapus(`' . $dataDB->kode . '`,`' . $dataDB->judul . '`)" class="btn bg-blue-grey waves-effect" role="button">HAPUS</a>
                                
                               
                            </div> 
            </div>';



			$tombol = ' 
          <div class="card" style="border:black solid 1px">
                        <div class="header bg-white">
                        <b style="font-size:14px" class="col-pink">  ' . $dataDB->judul . '</b> <br>
                          
                         <i class="col-deep-orange"> Created by : ' . strtolower($dataDB->pengirim) . '</i> 
                         
                        </div>
                        <div class="bodyx" style="padding:10px;font-size:16px">
                        ' . $dataDB->pesan . '
                        </div>
                        <div class="col-md-6 col-teal cursor " onclick="lihat(`' . $dataDB->kode . '`,`' . $dataDB->judul . '`)">  Telah dibaca : ' . $baca . ' Orang
                          <br><i class="col-blue-grey"> Created on : ' . $this->tanggal->hariLengkap(substr($dataDB->_ctime, 0, 10), "/") . ' ' . substr($dataDB->_ctime, 10, 10) . ' wib.</i>
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
		$id = $this->input->post("kode");
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
	function lihat()
	{
		$kode = $this->input->get_post("kode");
		$tbl = "";
		$n = 1;
		$data = $this->db->query("select id,nama from data_pegawai where id in (select id_guru from data_pesan where kode='" . $kode . "' ) order by nama asc")->result();
		foreach ($data as $val) {
			$sts = $this->db->query("select sts_baca from data_pesan where id_guru='" . $val->id . "' and kode='" . $kode . "' ")->row();
			if ($sts->sts_baca == 0) {
				$sts = "<label class='label bg-grey'> Belum dibaca</label>";
			} else {
				$sts = "<label class='label bg-teal'>Sudah dibaca</label>";
			}
			$tbl .= "<tr><td>" . $n++ . "</td>
	        <td>" . $val->nama . "</td>
	        <td>$sts</td>
	        </tr>";
		}
		echo "<table class='entry' width='100%'><tr class='bg-teal col-white'><td>NO</td><td>PENERIMA</td><td>STATUS</td></tr>";
		echo $tbl;
		echo "</table>";
	}
}
