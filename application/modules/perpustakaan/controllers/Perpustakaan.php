	<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Perpustakaan extends CI_Controller
	{


		function __construct()
		{
			parent::__construct();
			$this->m_konfig->validasi_session(array("siswa"));
			$this->load->model("model_buku", "mdl_buku");
			$this->load->model("Model_peminjaman", "mdl_pinjam");
			$this->perpus = $this->load->database("perpus", TRUE);

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
				// 	echo "<script> window.location.href='pendidik';</script>";
				echo	$this->load->view("index");
			} else {
				$data['konten'] = "index";
				$this->_template($data);
			}
		}

		public function peminjaman()
		{

			$ajax = $this->input->get_post("ajax");

			if ($ajax == "yes") {
				echo	$this->load->view("peminjaman");
			} else {
				$data['konten'] = "peminjaman";
				$this->_template($data);
			}
		}

		function data_peminjaman()
		{
			$list = $this->mdl_pinjam->getData();
			$data = array();
			$no = $_POST['start'];
			$no = $no + 1;
			foreach ($list as $dataDB) {
				$siswa = $this->db->query("select * from data_siswa where nis='" . $dataDB->id_anggota . "' ")->row();
				$nama_siswa = isset($siswa->nama) ? ($siswa->nama) : "";
				$id_kelas = isset($siswa->id_kelas) ? ($siswa->id_kelas) : "";
				$nama_kelas = $this->m_reff->goField("v_kelas", "nama", "where id='" . $id_kelas . "' ");




				$poto = "";

				$masaPinjam = $this->tanggal->selisih(date('Y-m-d'), $dataDB->tgl_kembali);
				if ($masaPinjam == 0) {
					$masaPinjam = "<label class='label bg-purple'> Hari ini</label>";
				} elseif ($masaPinjam < 0) {
					$masaPinjam = "<label class='label label-danger'> Lewat " . $masaPinjam . " Hari </label";
				} else {
					$masaPinjam = "<label class='label label-primary'>" . $masaPinjam . " Hari lagi </label";
				}

				$buku = $this->perpus->get_where("data_buku", array("barcode" => $dataDB->barcode))->row();

				$nama_buku = isset($buku->nama_buku) ? ($buku->nama_buku) : "";
				$poto = isset($buku->cover) ? ($buku->cover) : "";
				if ($poto) {
					$poto = "file_upload/cover/" . $poto;
					$poto = "<img src='" . base_url() . $poto . "' width='80px'><br>";
				} else {
					$poto = "";
				}

				if ($dataDB->sts == 0) //sts=belum kembali
				{
					$tombol = '<label class="label label-danger">Belum Dikembalikan</label>';
					$masaPinjam = $masaPinjam;
				} else {
					$tombol = '<label class="label label-success">Sudah Dikembalikan</label>';
					$masaPinjam = "";
				}




				$row = array();
				$row[] = "<span class='size'>" . $no++ . "</span>";
				$row[] = "<span class='size'>  " . $this->tanggal->hariLengkap(substr($dataDB->tgl_pinjam, 0, 10), "/") . "   </span>";
				$row[] = "<span class='size'>  " . $this->tanggal->hariLengkap(substr($dataDB->tgl_kembali, 0, 10), "/") . "    </span>";
				$row[] = "<span class='size'>  <center>" . $masaPinjam . "</center>    </span>";
				$row[] = "<span class='size'>  " . $poto . $nama_buku . br() . "<i class='col-deep-orange'>" . $dataDB->barcode . "</i></span>";

				$row[] = "<span class='size'>  <center>" . $tombol . "</center>   </span>";

				$data[] = $row;
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $count = $this->mdl_pinjam->count(),
				"recordsFiltered" => $count,
				"data" => $data,
			);
			//output to json format
			echo json_encode($output);
		}


		public function buku()
		{

			$ajax = $this->input->get_post("ajax");

			$this->perpus->where("_del", "0");
			$this->perpus->order_by("nama_kategori", "asc");
			$qk = $this->perpus->get("data_kategori")->result();

			$this->perpus->where("_del", "0");
			$this->perpus->order_by("nama_rak", "asc");
			$qr = $this->perpus->get("data_rak")->result();

			if ($ajax == "yes") {
				// 	echo "<script> window.location.href='pendidik';</script>";
				$data['kt']	= $qk;
				$data['rk']	= $qr;
				echo	$this->load->view("buku", $data);
			} else {
				$data['konten'] = "buku";
				$data['kt']	= $qk;
				$data['rk']	= $qr;
				$this->_template($data);
			}
		}



		function detail_buku()
		{
			echo $this->load->view("buku_detail");
		}

		function data_buku()
		{
			$list = $this->mdl_buku->get_data();
			$data = array();
			$no = $_POST['start'];
			$no = $no + 1;

			foreach ($list as $dataDB) {



				if ($dataDB->pinjam == "1") {
					$pinjam = "<label class='label label-primary'>Bisa Dipinjam</label>";
				} else {
					$pinjam = "<label class='label label-danger'>Tidak Bisa Dipinjam</label>";
				}

				if ($dataDB->cover != "") {
					$img = "<img src='" . base_url() . "perpus/file_upload/cover/" . $dataDB->cover . "' class='img-responsive' style='width:100px'>";
				} else {
					$img = "<img src='" . base_url() . "perpus/file_upload/cover/no_img2.jpg' class='img-responsive' style='width:100px'>";
				}

				$row = array();
				$row[] = "<span class='size'>
						<a href='javascript:void(0);' onclick='detail(" . $dataDB->id . ", `" . $dataDB->nama_buku . "`)'>
							<div class='row'>
								<div class='col-lg-3 col-md-3 col-sm-6 col-xs-6'>
									<center>
										" . $img . " <br>
										" . $pinjam . "
									</center>
								</div>
								<div class='col-lg-9 col-md-9 col-sm-6 col-xs-6'>
									" . $dataDB->nama_buku . " 
									<br>
									" . $dataDB->stok . " Pcs
								</div>
							</div>
						</a>
					</span>";


				//add html for action

				$data[] = $row;
			}



			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $c = $this->mdl_buku->count(),
				"recordsFiltered" => $c,
				"data" => $data,
			);
			//output to json format
			echo json_encode($output);
		}

		function idu()
		{
			return $this->session->userdata("id");
		}
	}
