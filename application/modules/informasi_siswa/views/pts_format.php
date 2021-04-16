


<?php
	$id 	= $_GET["id"];
	$jenis	= $_GET["jenis"];
	$cari 	= $_GET["cari"];
	$bln 	= $_GET["bln"];
	$tahun 	= $this->m_reff->tahun();
	$sms 	= $this->m_reff->semester();

	$tp 	= $this->m_reff->goField("tr_tahun_ajaran", "nama", " WHERE id='".$tahun."' ");
	$ttd 	= $this->m_reff->goField("tr_tahun_ajaran", "ttd_kepsek", " WHERE id='".$tahun."' ");

	switch ($sms) {
		case '1':
			$semester = "GANJIL";
		break;
		case '2':
			$semester = "GENAP";
		break;
		
		default:
			$semester = "-";
		break;
	}

	switch ($jenis) {
		case 'PTS':
			$title = "Penilaian Tengah Semester (PTS) / UJIAN AKHIR SEMESTER ".$semester;
			$bawah = "Dapat mengikuti Ujian  ".$title;	
		break;
		case 'PAS':
			$title = "Penilaian Akhir Semester (PAS) / UJIAN AKHIR SEMESTER ".$semester;
			$bawah = "Dapat mengikuti Ujian  ".$title;	
		break;
		case 'PRAUJIKOM':
			$title = "PRAUJIKOM Kejuruan";
			$bawah = "Sebagai Peserta Uji Kompetensi Keahlian";
		break;
		
		default:
			$title = "[[ERROR]]";
		break;
	}

	switch ($cari) {
		case "1":
			$this->db->order_by("nama", "asc");
			$this->db->where("id_kelas", $id);
			$this->db->where_in("id_sts_data", array("1", "4"));
			$d = $this->db->get("v_siswa")->result();
		break;
		case '2':

			$ex = explode(",", $id);

			$this->db->order_by("nama", "asc");
			$this->db->where_in("id", $ex);
			$this->db->where_in("id_sts_data", array("1", "4"));
			$d = $this->db->get("v_siswa")->result();

		break;
		
		default:
			$d = "";
		break;
	}


	$dt = "";
	foreach ($d as $v) {
		$dt.="

			<div>
					<img src='".base_url()."file_upload/dok/kop_pts.png' style='width: 200mm;height: 31mm'>
					<p style='font-size: 9.5px;text-align: center;'>
						<strong>
							KARTU PESERTA ".strtoupper($title)."<br>
							TAHUN PELAJARAN ".$tp."
						</strong>
					</p>
					<p style='font-size:11px'>
						Kepala SMK PGRI Subang menerangkan bahwa :
					</p>
					<table style='width: 210mm' class='table'>
						<tr>
							<td style='width: 20mm'>Nama</td>
							<td style='width: 2mm'>:</td>
							<td style='width: 50mm'>".$v->nama."</td>
							<td style='width: 35mm'>NIS</td>
							<td style='width: 2mm'>:</td>
							<td style='width: 80mm'>".$v->nis."</td>
						</tr>
						<tr>
							<td style='width: 20mm'>Kelas</td>
							<td style='width: 2mm'>:</td>
							<td style='width: 50mm'>".$v->nama_kelas."</td>
							<td style='width: 25mm'>Kompetensi Keahlian</td>
							<td style='width: 2mm'>:</td>
							<td style='width: 80mm'>".$v->jurusan."</td>
						</tr>
						<tr>
							<td style='width: 20mm'>Username CBT</td>
							<td style='width: 2mm'>:</td>
							<td style='width: 50mm'>".$v->username."</td>
							<td style='width: 25mm'>Password CBT</td>
							<td style='width: 2mm'>:</td>
							<td style='width: 80mm'>".$this->m_reff->goField("data_siswa", "password_cbt", " WHERE id='".$v->id."' ")."</td>
						</tr>
					</table>
					<p style='font-size:11px'>
						".$bawah." Tahun Pelajaran ".$tp."
					</p>
					<table style='width: 210mm' class='table'>
						<tr>
							<td style='width:145mm'>
								Catatan :<br>
								<i>
									Kartu ini harap dibawa selama Ujian<br>
									Ketinggalan Kartu harus <strong>Lapor Ke Pengawas</strong>
								</i>
							</td>
							<td style='width:50mm'>
								Subang, &nbsp; &nbsp; &nbsp; ".$bln."<br>
								Kepala Sekolah,<br>
								<img src='".base_url()."file_upload/dok/".$ttd."' style='width:170px;' /><br>
								<strong>
									<u>Dra. Hj. Sri Mulyati, M.M.Pd.</u><br>
									NIP. 19670916 199303 2 013
								</strong>
							</td>
						</tr>
					</table>
					<br>
					<table style='width: 190mm'>
						<tr >
							<td style='width: 198mm'><hr style='border-style: dashed;'></td>
						</tr>
					</table>
			</div>


		";
	}

?>


<style type="text/css">
	.tb {
	  border-collapse: collapse;
	}

		.tb tr td {
		  border: 1px solid black;
		  padding: 5px;
		  text-align: center;
		}

	body{
		font-family: Tahoma;
		font-size: 11px;
	}

	.table {
	  border-collapse: collapse;
	  font-size: 11px;
	}

	.table th td {
	  border: 1px solid black;
	}
</style>


<div style="width: 210mm;height: 300mm;" >
	<?php echo $dt; ?>
</div>


