
<?php 

	ob_end_clean();
	header( "Content-type: application/vnd.ms-word" );
	header('Content-Disposition: attachment; filename="kartu_ujian.doc"');
	header("Pragma: no-cache");
	header("Expires: 0");
	ob_end_clean();

?>

<?php
	$id 	= $_GET["id"];
	$jenis	= $_GET["jenis"];
	$tahun 	= $this->m_reff->tahun();
	$sms 	= $this->m_reff->semester();

	$tp 	= $this->m_reff->goField("tr_tahun_ajaran", "nama", " WHERE id='".$tahun."' ");

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
			$title = "Penilaian Tengah Semester (PTS)";	
		break;
		case 'PAS':
			$title = "Penilaian Akhir Semester (PAS)";	
		break;
		
		default:
			$title = "[[ERROR]]";
		break;
	}

	$this->db->order_by("nama", "asc");
	$this->db->where("id_kelas", $id);
	$d = $this->db->get("v_siswa")->result();

	$dt = "";
	foreach ($d as $v) {
		$dt.="

			<div>
					<img src='".base_url()."file_upload/dok/kop_pts.png' style='width: 200mm;height: 31mm'>
					<p style='font-size: 9.5px;text-align: center;'>
						<strong>
							KARTU PESERTA ".strtoupper($title)." / UJIAN AKHIR SEMESTER ".$semester." <br>
							TAHUN PELAJARAN ".$tp."
						</strong>
					</p>
					<p>
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
					</table>
					<p>
						Dapat mengikuti Ujian ".$title." / Ujian Akhir Semester ".$semester." Tahun Pelajaran ".$tp."
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
								Subang, &nbsp; &nbsp; &nbsp; ".date('F Y')."<br>
								Kepala Sekolah,<br>
								<br>
								<br> 
								<br>
								<br>
								<br>
								<strong>
									<u>Dra. Hj. Sri Mulyati, M.M.Pd.</u><br>
									NIP. 19670916 199303 2 013
								</strong>
							</td>
						</tr>
					</table>
					<br>
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
		font-size: 9.5px;
	}

	.table {
	  border-collapse: collapse;
	  font-size: 9.5px;
	}

	.table th td {
	  border: 1px solid black;
	}
</style>


<div style="width: 210mm;height: 300mm;" >
	<?php echo $dt; ?>
</div>


