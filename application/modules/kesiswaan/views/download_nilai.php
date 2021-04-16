<?php

	$id = $this->uri->segment(3);

	$sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
	$res=$this->db->get_where("data_nilai",array("id"=>$id))->row();
	$id_kelas=$res->id_kelas;
	$id_kikd=$res->id_kikd;
	$nama_nilai=$res->nama_nilai;
	$k_nilai=$res->id_kategory_nilai;
	$id_mapel=$res->id_mapel;
	$id_semester=$res->id_semester;
	$this->session->set_userdata("code",$res->code);

	$attr=array(
		"id_kikd"			=>$res->id_kikd,
		"id_kelas"			=>$res->id_kelas,
		"nama_nilai"		=>$res->nama_nilai,
		"id_kategory_nilai"	=>$res->id_kategory_nilai,
		"id_mapel"			=>$res->id_mapel,
		"id_semester"		=>$res->id_semester,
		"code"				=>$res->code
	);

	$cekmapelglobal=$this->m_reff->goField("tr_mapel","mapel_global","where id='".$id_mapel."'");

	$data=$this->mdl->dataSiswa($id_kelas);

	$row_data = "";
	$no = 1;

	if ($k_nilai == 1) {// kategori KIKD

		foreach ($data as $val) {

			if($cekmapelglobal==1 OR $val->id_agama<2){
				$row_data.="
					<tr>
						<td>".$no."</td>
						<td>".$val->nama."</td>
						<td>".$this->mdl_nilai->getNilaiSiswa($attr,$val->id)."</td>
						<td>".$this->mdl_nilai->getNilaiSiswaKi($attr,$val->id)."</td>
					</tr>
				";
			}
			else{
				$row_data.="
					<tr>
						<td>".$no."</td>
						<td>".$val->nama."</td>
						<td>Non Muslim</td>
					</tr>
				";
			}
			$no++;
		}
		
	}
	else{//kategori bkn KIKD

		foreach ($data as $val) {

			if($cekmapelglobal==1 OR $val->id_agama<2){
				$row_data.="
					<tr>
						<td>".$no."</td>
						<td>".$val->nama."</td>
						<td>".$this->mdl_nilai->getNilaiSiswa($attr,$val->id)."</td>
					</tr>
				";
			}
			else{
				$row_data.="
					<tr>
						<td>".$no."</td>
						<td>".$val->nama."</td>
						<td>Non Muslim</td>
					</tr>
				";
			}
			$no++;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Download Nilai</title>
</head>
<body>
	<?php 
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Nilai.xls");
	?>
	<center>
		<h1>DATA NILAI</h1>
	</center>
	<table>
		<tr>
			<td></td>
			<td>Kategori</td>
			<td>
				<?php 
					 if($id_semester==2 and $k_nilai==3){
					     echo "UKK";
					 }else{
					     echo $this->m_reff->goField("tr_kategory_nilai","nama","where id='".$k_nilai."'");
					 }
				?>
			</td>
		</tr>
		<?php  
			if ($k_nilai == 1) {
				echo "
					<tr>
						<td></td>
						<td>KD.KI</td>
						<td>".$this->m_reff->goField("tm_kikd","CONCAT(kd3_no,' - ',kd4_no)","where id='".$id_kikd."'")."</td>
					</tr>
				";
			}
		?>
		<tr>
			<td></td>
			<td>Kelas</td>
			<td><?php echo $this->m_reff->namaKelas($id_kelas);?></td>
		</tr>
		<tr>
			<td></td>
			<td>Mata Pelajaran</td>
			<td><?php echo $this->m_reff->namaMapel($id_mapel);?></td>
		</tr>
		<tr>
			<td></td>
			<td>Semester</td>
			<td><?php echo $this->m_reff->namaSemester($id_semester);?></td>
		</tr>
		<tr>
			<td></td>
			<td>Keterangan</td>
			<td><?php echo $nama_nilai;?></td>
		</tr>

	</table>
	<br>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>NAMA SISWA</th>
			<?php
				if ($k_nilai == 1) {
					echo "
						<th>NILAI PENGETAHUAN (KD)</th>
						<th>NILAI KETERAMPILAN (KI)</th>
					";
				}
				else{
					echo "<th>NILAI</th>";
				}
			?>
		</tr>
		<?php echo $row_data; ?>
	</table>
</body>
</html>