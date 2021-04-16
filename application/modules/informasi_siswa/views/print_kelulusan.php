<?php
	
	
	$this->db->where("nis", $nis);
	$d = $this->db->get("v_siswa")->row_array();
	
	$this->db->where("nis", $nis);
	$x = $this->db->get("kelulusan")->row_array();


	if (date("N", strtotime($d["tgl_lahir"])) == "01") {
		$bln = "Januari";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "02") {
		$bln = "Februari";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "03") {
		$bln = "Maret";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "04") {
		$bln = "April";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "05") {
		$bln = "Mei";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "06") {
		$bln = "Juni";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "07") {
		$bln = "Juli";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "08") {
		$bln = "Agustus";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "09") {
		$bln = "September";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "10") {
		$bln = "Oktober";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "11") {
		$bln = "November";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "12") {
		$bln = "Desember";
	}
	if (date("N", strtotime($d["tgl_lahir"])) == "0") {
		$bln = "Error";
	}

	switch ($x['status']) {
		case '1':
			$hasil = "LULUS";
		break;
		case '2':
			$hasil = "TIDAK DITAMPILKAN";
		break;
		case '3':
			$hasil = "TIDAK LULUS";
		break;
		case '3':
			$hasil = "BELUM DITENTUKAN";
		break;
		
		default:
			$hasil = "ERROR";
			break;
	}

	$this->db->where("nis", $nis);
	$n = $this->db->get("kelulusan_nilai")->result();
	$no = 1;
	$nilai = "";
	$total = 0;
	foreach ($n as $v) {
		$nilai.="
			<tr>
				<td style='text-align:center'>".$no."</td>
				<td>".$this->m_reff->goField('kelulusan_mapel', 'nama_mapel', 'WHERE id="'.$v->id_mapel.'" ')."</td>
				<td style='text-align:center'>".number_format($v->score, 0, ',', '.')."</td>
			</tr>
		";
		$total = $total+number_format($v->score, 0, ',', '.');
		$no++;
	}
	$rata = number_format(($total/6), 2, ',','.');
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
		font-family: Tahoma !important;
		font-size: 15px;
	}

	.table {
	  border-collapse: collapse;
	  font-size: 15px;
	}

	.table th td {
	  border: 1px solid black;
	}
</style>


<div style="width: 210mm;height: 300mm;" >
	<div>
		<img src='<?php echo base_url() ?>file_upload/dok/kop_pts.png' style='width: 200mm;height: 45mm'>
		<p style='text-align: center;'>
			<strong><u style="font-size: 16px;">SURAT KETERANGAN LULUS</u></strong><br/>
			<span style="font-size: 15px;">Nomor: 202/SATDIK – SMK PGRI/SBG/II.2/O/2020</span>
		</p>
		<br/>
		<br/>
		<p style="padding: 0 40px 0 40px;font-size: 15px;line-height: 20px">
			Kepala SMK PGRI Subang Selaku Ketua Penyelenggara Ujian Sekolah Tahun Pelajaran 2019/2020 berdasarkan :<br/><br/>
			1. Ketuntasan dari seluruh program pembelajaran pada kurikulum 2013 Revisi;<br/>
			2. Kriteria kelulusan dari satuan pendidikan sesuai dengan peraturan perundang-undangan; <br/>
			3. Rapat Pleno Dewan Guru tentang Kelulusan pada tanggal 30 April 2020 yang dilaksanakan secara daring.<br/>
			<br/>
			Menerangkan bahwa : <br/>
			<br/>
		</p>

	</div>
	<div style="width: 200mm;padding-left: 50px;line-height: 30px;font-size: 16px;">
		<table border="0" class='table' cellpadding="0">
			<tr>
				<td style="width: 55mm;padding-bottom: 5px;">Nama</td>
				<td style='width: 2mm'>:</td>
				<td style="width: 80mm"><?php echo $d['nama'] ?></td>
			</tr>
			<tr>
				<td style="width: 55mm;padding-bottom: 5px;">Tempat dan Tanggal Lahir</td>
				<td style='width: 2mm'>:</td>
				<td style="width: 80mm"><?php echo $x['tmp'].", ".$x["tgl"] ?></td>
			</tr>
			<tr>
				<td style="width: 55mm;padding-bottom: 5px;">Nomor Induk Siswa</td>
				<td style='width: 2mm'>:</td>
				<td style="width: 80mm"><?php echo $d["nis"] ?></td>
			</tr>
			<tr>
				<td style="width: 55mm;padding-bottom: 5px;">Nomor Induk Siswa Nasional</td>
				<td style='width: 2mm'>:</td>
				<td style="width: 80mm"><?php echo $d["nisn"] ?></td>
			</tr>
			<tr>
				<td style="width: 55mm;padding-bottom: 5px;">Kompetensi Keahlian</td>
				<td style='width: 2mm'>:</td>
				<td style="width: 80mm"><?php echo $d["jurusan"] ?></td>
			</tr>
			<tr>
				<td style="width: 55mm;padding-bottom: 5px;">Dinyatakan</td>
				<td style='width: 2mm'>:</td>
				<td style="width: 80mm"><strong><?php echo $hasil; ?></strong></td>
			</tr>


		</table>
	</div>
	<p style="padding-left: 40px;font-size: 16px;">Dengan Nilai sebagai berikut : </p>
	<div style="width: 200mm;padding-left: 50px;line-height: 30px;">
		<table border="1" class='table' cellpadding="2">
			<tr>
				<td style='width: 5mm;text-align: center'><strong>No</strong></td>
				<td style="width: 140mm;text-align: center;"><strong>Mata Pelajaran<br/>(Kurikulum 2013 Revisi)</strong></td>
				<td style="width: 20mm;text-align: center"><strong>Nilai Ujian Sekolah</strong></td>
			</tr>
			<?php echo $nilai; ?>
			<tr>
				<td></td>
				<td style="text-align: center"><strong>RATA - RATA</strong></td>
				<td style="text-align: center"><strong><?php echo $rata; ?></strong></td>
			</tr>
		</table>
	</div>
	<br/>
	<br/>
	<br/>
	<table border="0" class='table' cellpadding="2">
		<tr>
			<td style="width: 120mm"></td>
			<td>
				<br/>	
				Subang, 02 Mei 2020<br/>
				Kepala Sekolah,<br/>
				<br/>
				<img src="<?php echo base_url();?>file_upload/dok/ttd___122044.JPG" style="width:48mm;height:10mm;"><br/>
				<br/>
				<strong><u>Dra. Hj. SRI MULYATI, M.M.Pd.</u></strong><br/>
				NIP. 19670916 199303 2 013
			</td>
		</tr>
	</table>
</div>