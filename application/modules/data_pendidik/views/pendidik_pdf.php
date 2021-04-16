<?php
	
	//$this->load->model('Model_pendidik', 'md');
	$this->db->where('id', $_GET["id"]);
	$data = $this->db->get("data_pegawai")->row_array();

	$link = $this->mdl->poto_guru($data["id"]);

	$idguru = $data['id'];

?>

<style type="text/css">
	table {
	    border-collapse: collapse;
	}
	td{
		font-size: 16px;
	}

	.ph{
		padding:5px;
		background-color: #009688;
		color:white;
		font-weight: bold;
	}

	.pi{
		padding: 2px 2px 2px 5px;
	}

	.thumbnail{
	    padding: 4px;
	    border: 1px solid #ddd;
	    border-radius: 4px;
	}

	.teal{
		background-color: #009688;
	}
</style>

<page format="210x310" backtop="5mm" backbottom="1mm" backleft="10mm" backright="1mm">

	<table border="0" style="width:100%;" >
		<tr>
			<td width="150" height="200" valign="top">
				<img style="width: 137px;height: 191px" src="<?php echo $link;?>">
			</td>
			<td width="430" valign="top">
				<table border="1" >
					<tr>
						<td colspan="2" class="ph">DATA PROFILE</td>
					</tr>
					<tr>
						<td width="100" class="pi">NAMA</td>
						<td width="370" class="pi"><?php echo $data['nama'] ?></td>
					</tr>
					<tr>
						<td class="pi">GENDER</td>
						<td class="pi"><?php echo $this->m_reff->gofield("tr_jk","nama","where id='".$data['jk']."'");?></td>
					</tr>
					<tr>
						<td class="pi">TTL</td>
						<td class="pi"><?php echo $data['tempat_lahir'].", ".$this->tanggal->ind($data['tgl_lahir'],"/") ?></td>
					</tr>
					<tr>
						<td class="pi">AGAMA</td>
						<td class="pi"><?php echo $this->m_reff->gofield("tr_agama","nama","where id='".$data['id_agama']."'");?></td>
					</tr>
					<tr>
						<td class="pi">ID/NIP</td>
						<td class="pi"><?php echo $data['nip'] ?></td>
					</tr>
					<tr>
						<td class="pi">NO HP</td>
						<td class="pi"><?php echo $data['hp'] ?></td>
					</tr>
					<tr>
						<td class="pi">EMAIL</td>
						<td class="pi"><?php echo $data['email'] ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<table border="1" style="width:100%;">
		<tr>
			<td colspan="2" class="ph">DATA PROFILE</td>
		</tr>
		<tr>
			<td width="200" class="pi">ALAMAT</td>
			<td width="425" class="pi"><?php echo $data['alamat'] ?></td>
		</tr>
		<tr>
			<td class="pi">TMT</td>
			<td class="pi"><?php echo $this->tanggal->ind($data["tmt"],"-")?></td>
		</tr>
		<tr>
			<td class="pi">STATUS KEPEGAWAIAN</td>
			<td class="pi"><?php echo $this->m_reff->goField("tr_sts_pegawai","nama","where id='".$data["sts_kepegawaian"]."'");?></td>
		</tr>
		<tr>
			<td class="pi">IJAZAH</td>
			<td class="pi"><?php echo $this->m_reff->gofield("tr_ijazah","nama","where id='".$data["id_ijazah"]."'");?></td>
		</tr>
		<tr>
			<td class="pi">JABATAN</td>
			<td class="pi"><?php echo $this->m_reff->gofield("tr_jabatan","nama","where id='".$data["id_jabatan"]."'");?></td>
		</tr>
	</table>
	<br>
	<br>
	<table border="1" style="width:100%;">
		<tr>
			<td colspan="2" class="ph">AKTIVITAS MENGAJAR SEMESTER SAAT INI</td>
		</tr>
		<tr>
			<td width="250" class="pi">JUMLAH KELAS MENGAJAR</td>
			<td width="375" class="pi"><?php echo $this->mdl->jmlKelasMengajar($idguru)?> Rombel</td>
		</tr>
		<tr>
			<td class="pi">TOTAL PERTEMUAN</td>
			<td class="pi"><?php echo $this->mdl->totalPertemuan($idguru)?> Kali Pertemuan</td>
		</tr>
		<tr>
			<td class="pi">TOTAL IZIN MENGAJAR</td>
			<td class="pi"><?php echo $this->mdl->totalPertemuanIzin($idguru);?> Pertemuan</td>
		</tr>
		<tr>
			<td class="pi">TOTAL TIDAK MENGAJAR</td>
			<td class="pi"><?php echo $this->mdl->totalPertemuanTidakMasuk($idguru);?> Pertemuan</td>
		</tr>
	</table>
	<br>
	<br>
	<table border="1" style="width:100%;">
		<tr>
			<td colspan="2" class="ph">AKTIVITAS MENGAJAR SELAMA BERTUGAS</td>
		</tr>
		<tr>
			<td class="pi" width="250">TOTAL PERTEMUAN</td>
			<td class="pi" width="375"><?php echo $this->mdl->totalPertemuan($idguru,"all")?> Kali Pertemuan</td>
		</tr>
		<tr>
			<td class="pi">TOTAL IZIN MENGAJAR</td>
			<td class="pi"><?php echo $this->mdl->totalPertemuanIzin($idguru,"all");?> Pertemuan</td>
		</tr>
		<tr>
			<td class="pi">TOTAL TIDAK MENGAJAR</td>
			<td class="pi"><?php echo $this->mdl->totalPertemuanTidakMasuk($idguru,"all");?> Pertemuan</td>
		</tr>
	</table>

</page>
		