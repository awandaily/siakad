
<?php
	$tgl 		= $this->tanggal->eng_($_GET["tgl"], "-");
	$id_kelas 	= $_GET["id_kelas"];
	$nm_kelas	= $this->m_reff->goField("v_kelas", "nama", " WHERE id='".$id_kelas."' ");
	$tahun 		= $this->m_reff->tahun();
	$sms 		= $this->m_reff->semester();
	$tp 		= $this->m_reff->goField("tr_tahun_ajaran", "nama", " WHERE id='".$tahun."' ");
	$id_wali 	= $this->m_reff->goField("v_kelas", "id_wali", " WHERE id='".$id_kelas."' ");
	$wali 		= $this->m_reff->goField("data_pegawai", "nama", " WHERE id='".$id_wali."' ");

	$this->db->where("id_kelas", $id_kelas);
	$this->db->where_in("id_sts_data", array('1', '4'));
	$this->db->order_by("nama", "asc");
	$s = $this->db->get("v_siswa")->result();

	$dt = "";
	$no = 1;
	$sisa_kelas = "";
	$gtotal = 0;
	foreach ($s as $v) {

		$sisaSPP = $this->mdl->stsTagihan("spp",$v->id,$tgl);
		$sisaBln = $this->mdl->sisaBlnSpp($v->id,$tgl);
		$sisaDSP = $this->mdl->stsTagihan("dsp",$v->id,$tgl);
		$sisaPast = $this->mdl->sisaPast($v->id, $v->id_kelas,$tgl);

		$sisa_kelas = $sisaPast["label"];

		$gtotal = ($sisaSPP + $sisaDSP + $sisaPast["sisa"]);

		$dt.="
			<tr>
				<td>".$no++."</td>
				<td>".$v->nis."</td>
				<td style='text-align:left'>".$v->nama."</td>
				<td style='text-align:right'>".number_format($sisaPast['sisa'],0,",",".")."</td>
				<td>".$sisaBln."</td>
				<td style='text-align:right'>".number_format($sisaSPP,0,",",".")."</td>
				<td style='text-align:right'>".number_format($sisaDSP,0,",",".")."</td>
				<td style='text-align:right'>".number_format($gtotal,0,",",".")."</td>

			</tr>
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
		  font-size: 12px;
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

<div style="width: 215mm;height: 300mm;" >
	
	<h4 style="text-align: center;">
		DAFTAR TUNGGAKAN KEUANGAN SISWA KELAS <?php echo $nm_kelas ?> <br/>
		SMK PGRI SUBANG <br/>
		TAHUN PELAJARAN <?php echo $tp ?><br/>
	</h4>


	<h5>
		TAGIHAN SAMPAI TANGGAL <?php echo $_GET["tgl"] ?> <br/>
		WALI KELAS : <?php echo strtoupper($wali) ?>
	</h5>

	<table class="tb" border="1" style='width: 210mm'>
		<tr>
			<td style="width: 5mm;" rowspan="3">No</td>
			<td style="width: 10mm" rowspan="3">NIS</td>
			<td style="width: 35mm" rowspan="3">NAMA</td>
			<td colspan="5">TUNGGAKAN</td>
		</tr>
		<tr>
			<td rowspan="2">Sisa SPP <br>Kelas <?php echo $sisa_kelas; ?></td>
			<td colspan="2"  style="width: 40mm">SPP Kelas </td>
			<td rowspan="2" style="width: 20mm">Sumbangan <br>Investasi</td>
			<td style="width: 35mm" rowspan="2">JUMLAH</td>
		</tr>
		<tr>
			<td style="width: 10mm">Jumlah (Bln)</td>
			<td style="width: 15mm">Jumlah <br>(Rp)</td>
		</tr>
		<?php echo $dt; ?>
	</table>

</div>