


<?php  
	$id = $_GET["id"];
	$tahun = $this->m_reff->goField("tr_tahun_ajaran", "nama", " WHERE id='".$this->m_reff->tahun()."' ");

	$this->db->where("id", $id);
	$kelas = $this->db->get("v_kelas")->row_array();

	$this->db->order_by("nama", "asc");
	$this->db->where("id_kelas", $id);
	$this->db->where_in("id_sts_data", array("1", "4"));
	$d = $this->db->get("v_siswa")->result();

	$this->db->where("id_kelas", $id);
	$this->db->where("jk", "l");
	$this->db->where_in("id_sts_data", array("1", "4"));
	$l = $this->db->get("v_siswa")->num_rows();

	$this->db->where("id_kelas", $id);
	$this->db->where("jk", "p");
	$this->db->where_in("id_sts_data", array("1", "4"));
	$p = $this->db->get("v_siswa")->num_rows();

	$dt = "";
	$no = 1;
	foreach ($d as $v) {
		$dt.="
			<tr>
				<td style='text-align:center'>".$no."</td>
				<td style='text-align:center'>".$v->nis."</td>
				<td style='text-align:left'>".$v->nama."</td>
				<td style='text-align:center'>".strtoupper($v->jk)."</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		";
		$no++;
	}

	$sisa = 40 - $no;
	$no2 = $no;
	if ($sisa > 0) {
		
		$col = "";
		for($i = 0;$i <= $sisa;$i++){
			$col.= "
					<tr>
						<td style='text-align:center;'>".$no2."</td>
						<td style='text-align:center'></td>
						<td style='text-align:left'></td>
						<td style='text-align:center'></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				";
			$no2++;
		}

	}
	else{
		$col = "";
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
	}

	.table {
	  border-collapse: collapse;
	}

	.table th td {
	  border: 1px solid black;
	}
</style>





	<div style="width: 210mm;height: 300mm;">
		<img src="<?php echo base_url() ?>file_upload/dok/kop.jpeg" style="width: 200mm;">
		<table style="width: 200mm">
			<tr><td style="width: 198mm"><hr></td></tr>
		</table>
		<p style="text-align: center;font-weight: bold;font-size: 11px;">PRESENSI SISWA </p>
		<table style="width: 210mm;font-size: 10px;">
			<tr>
				<td style="width: 50mm;">Mata Diklat</td>
				<td style="width: 5mm;">:</td>
				<td style="width: 50mm;">.............................	...................</td>
				<td style="width: 40mm;">Kelas</td>
				<td style="width: 5mm;">:</td>
				<td style="width: 40mm;"><?php echo $kelas["nama_tingkat"] ?></td>
			</tr>
			<tr>
				<td style="width: 50mm;">Kode Mata Diklat</td>
				<td style="width: 5mm;">:</td>
				<td style="width: 50mm;">................................................</td>
				<td style="width: 40mm;">Kompetensi Keahlian</td>
				<td style="width: 5mm;">:</td>
				<td style="width: 40mm;"><?php echo $kelas["nama_jurusan"]." ".$kelas["nama_kelas"] ?></td>
			</tr>
			<tr>
				<td style="width: 50mm;">Nama Staff Pengajar</td>
				<td style="width: 5mm;">:</td>
				<td style="width: 50mm;">................................................</td>
				<td style="width: 40mm;">Semester</td>
				<td style="width: 5mm;">:</td>
				<td style="width: 40mm;">................................................</td>
			</tr>
			<tr>
				<td style="width: 50mm;"></td>
				<td style="width: 5mm;"></td>
				<td style="width: 50mm;"></td>
				<td style="width: 40mm;">Beban</td>
				<td style="width: 5mm;">:</td>
				<td style="width: 40mm;">................................................JP</td>
			</tr>

		</table>
		<p style="text-align: center;font-weight: bold;font-size: 10px;">TAHUN PELAJARAN <?php echo $tahun; ?></p>

		<table style="width: 210mm;font-size: 10px;" border="1" class="table">
			<tr style="font-weight: bold;text-align: center;">
				<td colspan="2" >Nomor</td>
				<td rowspan="3" style="width: 63mm">Nama Siswa</td>
				<td rowspan="3" style="width: 10mm">L/P</td>
				<td colspan="13">Presensi</td>
				
			</tr>
			<tr style="font-weight: bold;text-align: center;">
				<td rowspan="2" style="width: 6mm">Urt</td>
				<td rowspan="2" style="width: 20mm">Induk Siswa</td>
				<td colspan="9">Tanggal Kehadiran</td>
				<td colspan="3">Jumlah</td>
				<td rowspan="2" style="width: 5mm">%</td>
			</tr>
			<tr style="font-weight: bold;text-align: center;">
				<td style="width: 5mm"></td>
				<td style="width: 5mm"></td>
				<td style="width: 5mm"></td>
				<td style="width: 5mm"></td>
				<td style="width: 5mm"></td>
				<td style="width: 5mm"></td>
				<td style="width: 5mm"></td>
				<td style="width: 5mm"></td>
				<td style="width: 5mm"></td>
				<td style="width: 5mm">S</td>
				<td style="width: 5mm">I</td>
				<td style="width: 5mm">K</td>
			</tr>
			<?php echo $dt; ?>
			<?php echo $col; ?>
			<tr>
				<td style='text-align:center;'></td>
				<td style='text-align:center'></td>
				<td style='text-align:center;' colspan="14">Jumlah Presensi Seharusnya</td>
				<td></td>

			</tr>
			<tr>
				<td style='text-align:center;'></td>
				<td style='text-align:center'></td>
				<td style='text-align:center;' colspan="14">Jumlah Presensi</td>
				<td></td>

			</tr>
			<tr>
				<td style='text-align:center;'></td>
				<td style='text-align:center'></td>
				<td style='text-align:center;' colspan="14">Jumlah Absesnsi</td>
				<td></td>

			</tr>

			<tr>
				<td colspan="2"><u>Keterangan</u></td>
				<td style='text-align:left'>Laki - laki</td>
				<td style='text-align:center'><?php echo $l; ?></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
				<td style="border: 0px;"></td>
			</tr>
			
			<tr>
				<td style='text-align:center;'>S</td>
				<td style='text-align:left'>= Sakit</td>
				<td style='text-align:left'>Perempuan</td>
				<td style='text-align:center'><?php echo $p ?></td>
				<td colspan="6" style='text-align:center;border: 0px;'>Mengetahui,</td>
				<td style="border: 0px;"></td>
				<td colspan="6" style="border: 0px;">Subang, ................................</td>
			</tr>
			<tr>
				<td style='text-align:center;'>I</td>
				<td style='text-align:left'>= Izin</td>
				<td style='text-align:left'>Jumlah</td>
				<td style='text-align:center'><?php echo ($p+$l) ?></td>
				<td colspan="6" style='text-align:center;border: 0px;'>Kepala Sekolah</td>
				<td style="border: 0px;"></td>
				<td colspan="6" style='text-align:center;border: 0px;'>Guru Mata Diklat</td>
			</tr>
			<tr>
				<td style='text-align:center;'>TK</td>
				<td style='text-align:left;'>= Tanpa Keterangan</td>
				<td style='text-align:left;'>Prosentase Presensi</td>
				<td style='text-align:right;'>%</td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
			</tr> <!---->
			<tr>
				<td style='text-align:center;color:white;border:0px'>1</td>
				<td style='text-align:center;border:0px'></td>
				<td style='text-align:left;border:0px'></td>
				<td style='text-align:center;border:0px'></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
			</tr>
			<tr>
				<td style='text-align:center;color:white;border:0px'>1</td>
				<td style='text-align:center;border:0px'></td>
				<td style='text-align:left;border:0px'></td>
				<td style='text-align:center;border:0px'></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
			</tr>
			<tr style="font-weight: bold">
				<td style='text-align:center;border:0px'></td>
				<td style='text-align:center;border:0px'></td>
				<td style='text-align:left;border:0px'></td>
				<td style='text-align:center;border:0px'></td>
				<td colspan="6" style='text-align:center;border:0px'>Dra. Hj. SRI MULAYATI, M.M.Pd</td>
				<td style="border:0px"></td>
				<td colspan="6" style='text-align:center;border:0px'>.............................</td>
			</tr>
			<tr style="font-weight: bold;border:0px">
				<td style='text-align:center;border:0px'></td>
				<td style='text-align:center;border:0px'></td>
				<td style='text-align:left;border:0px'></td>
				<td style='text-align:center;border:0px'></td>
				<td colspan="6" style='text-align:center;border:0px'>NIP. 19670916 199303 2 013</td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
				<td style="border:0px"></td>
			</tr>
		</table>


	</div>

