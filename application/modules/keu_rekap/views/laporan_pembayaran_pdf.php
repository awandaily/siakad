<?php

	$link_kop = $this->m_reff->goField("tm_pengaturan", "val", "WHERE id='12'");
	$kop_surat = "<img src='".base_url()."file_upload/img/".$link_kop."' width='1050' height='150' align='center' /><br>";

	$tahun  = $this->m_reff->goField("tr_tahun_ajaran", "nama", "WHERE id='".$this->m_reff->tahun()."' ");
	$sms 	= $this->m_reff->semester();


	$idkelas 	= $_GET["idkelas"];
	$tgl1 		= $this->tanggal->eng_(substr($_GET["tgl"], 0,10), "-");
	$tgl2 		= $this->tanggal->eng_(substr($_GET["tgl"], 13,22), "-");

	$this->db->where("id", $this->m_reff->tahun());
	$kepsek = $this->db->get("tr_tahun_ajaran")->row_array();
	
	$sl = "
		keu_tm_bayar.*,
		data_siswa.id AS siswa_id,
		data_siswa.id_kelas,
		data_siswa.nama,
		tm_kelas.id AS kelas_id
	";

	$this->db->select($sl);
	$this->db->from("keu_tm_bayar");
	$this->db->join("data_siswa", "data_siswa.id = keu_tm_bayar.id_siswa");
	$this->db->join("tm_kelas", "tm_kelas.id = data_siswa.id_kelas");	
	$this->db->where("tm_kelas.id_tk", $idkelas);
	$this->db->where("tgl_bayar >=", $tgl1);
	$this->db->where("tgl_bayar <=", $tgl2);
	$this->db->where("gnr",0);
	$this->db->group_by("keu_tm_bayar.id_siswa");
	$d = $this->db->get()->result();

	$data = "";
	$jspp = 0;
	$jdsp = 0;
	$jsps = 0;
	$jksw = 0;
	$juji = 0;
	$jj = 0;
	$no = 1;

	//$kelas = $this->m_reff->goField("v_kelas", "nama", "WHERE id='".$_GET['idkelas']."' ");
	$tingkat = $this->m_reff->goField("tr_tingkat", "nama", "WHERE id='".$_GET['idkelas']."' ");

	foreach ($d as $v) {
		$kelas = $this->m_reff->goField("v_kelas", "nama", "WHERE id='".$v->id_kelas."' ");

		$spp = $this->mdl->sumBayar_input("spp", $v->id_siswa, $_GET['tgl']);
		$dsp = $this->mdl->sumBayar_input("dsp", $v->id_siswa, $_GET['tgl']);
		$sps = $this->mdl->sumBayar_input("sps", $v->id_siswa, $_GET['tgl']);
		$ksw = $this->mdl->sumBayar_input("ksw", $v->id_siswa, $_GET['tgl']);
		$uji = $this->mdl->sumBayar_input("uji", $v->id_siswa, $_GET['tgl']);

		$jumlah = ($spp+$dsp+$sps+$ksw+$uji);

		$jspp = ($jspp+$spp);
		$jdsp = ($jdsp+$dsp);
		$jsps = ($jsps+$sps);
		$jksw = ($jksw+$ksw);
		$juji = ($juji+$uji);
		$jj   = ($jumlah+$jj);

		$data.="
			<tr>
				<td align='center'>".$no."</td>
				<td>".$v->nama."</td>
				<td align='center'>".$kelas."</td>
				<td align='right'>".number_format($spp, 0, ',', '.')."</td>
				<td align='right'>".number_format($dsp, 0, ',', '.')."</td>
				<td align='right'>".number_format($sps, 0, ',', '.')."</td>
				<td align='right'>".number_format($ksw, 0, ',', '.')."</td>
				<td align='right'>".number_format($uji, 0, ',', '.')."</td>
				<td align='right'><strong>".number_format($jumlah, 0, ',', '.')."</strong></td>
			</tr>
		";
		$no++;
	}

	$tgl_surat = $this->tanggal->indBulan(date('Y-m-d'), " ");

?>

	<style type="text/css">
		table {
		    border-collapse: collapse;
		}
		.metd, .meth {
		    border: 1px solid black;
		    padding: 3px;
		}
	</style>

	<?php echo $kop_surat; ?>
	<br>
	<br>
	<div style="text-align:center;font-weight: bold;">
		BUKTI PENERIMAAN KEUANGAN KELAS <?php  echo $tingkat; ?><br>
		SMK PGRI SUBANG<br>
		TAHUN PELAJRAN <?php echo $tahun; ?>
	</div>
	<br>
	<br>
	<table border="1">
		<tr >
			<td width="40" align="center" class="metd">No</td>
			<td width="200" align="center" class="metd">Nama Siswa</td>
			<td width="100" align="center" class="metd">Kelas</td>
			<td width="100" align="center" class="metd">Iuran Bulanan</td>
			<td width="80" align="center" class="metd">Invest</td>
			<td width="100" align="center" class="metd">Sarana Prasarana</td>
			<td width="100" align="center" class="metd">Kesiswaan</td>
			<td width="80" align="center" class="metd">Ujian</td>
			<td width="100" align="center" class="metd">JUMLAH</td>
		</tr>
		<?php echo $data; ?>

			<tr style="font-weight:bold">
				<td class="metd"></td>
				<td align="center" class="metd">JUMLAH</td>
				<td class="metd"></td>
				<td class="metd" align="right"><?php echo number_format($jspp, 0, ',', '.') ?></td>
				<td class="metd" align="right"><?php echo number_format($jdsp, 0, ',', '.')?></td>
				<td class="metd" align="right"><?php echo number_format($jsps, 0, ',', '.')?></td>
				<td class="metd" align="right"><?php echo number_format($jksw, 0, ',', '.')?></td>
				<td class="metd" align="right"><?php echo number_format($juji, 0, ',', '.')?></td>
				<td class="metd" align="right"><?php echo number_format($jj, 0, ',', '.')?></td>
			</tr>
			<tr style="font-weight:bold">
				<td class="metd"></td>
				<td class="metd" align="center">TERBILANG</td>
				<td class="metd" colspan="7" align="center"><?php echo ucwords($this->umum->terbilang($jj)) ?> Rupiah</td>
			</tr>

	</table>
	<br>
	<br>
	<table>
		<tr>
			<td align="center" width="350">
				Mengetahui,<br>
				Kepala Sekolah<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<u><strong><?php echo strtoupper($kepsek['nama_kepsek']) ?></strong></u><br>
				NIP. <?php echo $kepsek['nip_kepsek'] ?>
			</td>
			<td width="350" align="center">
				<br>
				Bendahara<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<u><strong>EDAH JUBAEDAH</strong></u><br>
				<span style="color:white">NIP. <?php echo $kepsek['nip_kepsek'] ?></span>
			</td>
			<td width="300" align="center"  valign="top">
				Subang, <?php echo $tgl_surat; ?><br>
				Petugas Penerima Keuangan<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<strong>...................................................</strong>
			</td>
		</tr>
	</table>
