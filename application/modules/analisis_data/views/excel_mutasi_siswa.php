<?php 	
	
	ob_end_clean();
	header( "Content-type: application/vnd.ms-excel" );
	header('Content-Disposition: attachment; filename="mutasi.xls"');
	header("Pragma: no-cache");
	header("Expires: 0");
	ob_end_clean();
	
?>

<?php
	
	$tgl_terakhir = date('t F Y', strtotime(date("Y-m-d")));


	$this->db->where("sts_kelas", "1");
	$this->db->order_by("alias ASC, nama_kelas ASC");
	$this->db->group_by(array("id_jurusan", "nama_kelas"));
	$q = $this->db->get("v_kelas")->result();

	$kelas = "";
	$no = 1;

	$seluruh_l = 0;
	$seluruh_p = 0;

	foreach ($q as $v) {

		$this->db->where("id_jurusan", $v->id_jurusan);
		$this->db->where("nama_kelas", $v->nama_kelas);
		$rombel = $this->db->get("v_kelas")->num_rows();
		// 1 = masuk awal, 4 = pindahan
		// 3 = drop, 5 = pindah, 2 = lulus
		/*
		$this->db->where("id_jurusan", $v->id_jurusan);
		$a = $this->db->get("data_siswa")->num_rows();*/

		// KELAS X
		$sel_kelasx = "SELECT id FROM v_kelas WHERE id_jurusan='".$v->id_jurusan."' AND nama_kelas='".$v->nama_kelas."' AND id_tk='1' ";

		//$sel_xl = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasx.") AND jk='l' AND MONTH(tgl_update_sts) IN ('".$_GET['bln']."', '".($_GET['bln'] -1)."', '') AND YEAR(tgl_update_sts) IN ('".$_GET['thn']."', '') AND id_sts_data IN ('1', '4') AND MONTH(tgl_diterima) IN ('".$_GET['bln']."')  ";
		/*
		$sel_xl = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasx.") AND jk='l' AND (MONTH(tgl_update_sts) = '00' OR MONTH(tgl_update_sts)<='".$_GET['bln']."') AND (YEAR(tgl_update_sts) = '0000' OR YEAR(tgl_update_sts)<='".$_GET['thn']."') AND  (MONTH(tgl_diterima) is null OR MONTH(tgl_diterima)<='".$_GET['bln']."') AND (YEAR(tgl_diterima) is NULL OR YEAR(tgl_diterima)<='".$_GET['thn']."') ";*/

		$sel_xl = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasx.") AND jk='l' AND MONTH(tgl_update_sts) IN('00', '".$_GET["bln"]."') AND YEAR(tgl_update_sts) IN ('0000', '".$_GET["thn"]."') ";

		$xl = $this->db->query($sel_xl)->num_rows();

		//$sel_xl = "SELECT * FROM data_siswa WHERE id_kelas ='".$v->id."' AND jk='l' AND (DATE(tgl_update_sts) = '0000-00-00' OR DATE(tgl_update_sts) <= '".date('Y-m-')."01') AND ( DATE(tgl_diterima) IS NULL OR DATE(tgl_diterima) <= '".date('Y-m-')."01'  )";

		//$jmlxl = "SELECT * FROM data_siswa WHERE id_kelas='".$v->id."' AND jk='l' AND (DATE(tgl_update_sts) = '0000-00-00' OR DATE(tgl_update_sts) = '".date('Y-m-')."01')  ";


		//$sel_xp = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasx.") AND jk='p' AND MONTH(tgl_update_sts) IN ('".$_GET['bln']."', '".($_GET['bln'] -1)."', '') AND YEAR(tgl_update_sts) IN ('".$_GET['thn']."', '')  ";
		//$sel_xp = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasx.") AND jk='p' AND (MONTH(tgl_update_sts) = '00' OR MONTH(tgl_update_sts)<='".$_GET['bln']."') AND (YEAR(tgl_update_sts) = '0000' OR YEAR(tgl_update_sts)<='".$_GET['thn']."') AND  (MONTH(tgl_diterima) is null OR MONTH(tgl_diterima)<='".$_GET['bln']."') AND (YEAR(tgl_diterima) is NULL OR YEAR(tgl_diterima)<='".$_GET['thn']."') ";
		$sel_xp = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasx.") AND jk='p' AND MONTH(tgl_update_sts) IN('00', '".$_GET["bln"]."') AND YEAR(tgl_update_sts) IN ('0000', '".$_GET["thn"]."') ";

		$xp = $this->db->query($sel_xp)->num_rows();

		$sel_xml = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasx.") AND jk='l' AND id_sts_data='4' AND MONTH(tgl_diterima) = '".$_GET["bln"]."' AND YEAR(tgl_diterima) = '".$_GET["thn"]."' ";
		$xml = $this->db->query($sel_xml)->num_rows();

		$sel_xmp = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasx.") AND jk='p' AND id_sts_data='4' AND MONTH(tgl_diterima) = '".$_GET["bln"]."' AND YEAR(tgl_diterima) = '".$_GET["thn"]."' ";
		$xmp = $this->db->query($sel_xmp)->num_rows();

		$sel_xkl = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasx.") AND jk='l' AND id_sts_data IN ('3', '5') AND MONTH(tgl_update_sts) = '".$_GET["bln"]."' AND YEAR(tgl_update_sts) = '".$_GET["thn"]."' ";
		$xkl = $this->db->query($sel_xkl)->num_rows();

		$sel_xkp = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasx.") AND jk='p' AND id_sts_data IN ('3', '5') AND MONTH(tgl_update_sts) = '".$_GET["bln"]."' AND YEAR(tgl_update_sts) = '".$_GET["thn"]."' ";
		$xkp = $this->db->query($sel_xkp)->num_rows();

		$xjl = ($xl+$xml) - $xkl;
		$xjp = ($xp+$xmp) - $xkp;


		// KELAS XI
		$sel_kelasxi = "SELECT id FROM v_kelas WHERE id_jurusan='".$v->id_jurusan."' AND nama_kelas='".$v->nama_kelas."' AND id_tk='2' ";

		$sel_xil = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxi.") AND jk='l' AND MONTH(tgl_update_sts) IN('00', '".$_GET["bln"]."') AND YEAR(tgl_update_sts) IN ('0000', '".$_GET["thn"]."') ";

		$xil = $this->db->query($sel_xil)->num_rows();

		$sel_xip = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxi.") AND jk='p' AND MONTH(tgl_update_sts) IN('00', '".$_GET["bln"]."') AND YEAR(tgl_update_sts) IN ('0000', '".$_GET["thn"]."') ";

		$xip = $this->db->query($sel_xip)->num_rows();

		$sel_ximl = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxi.") AND jk='l' AND id_sts_data='4' AND MONTH(tgl_diterima) = '".$_GET['bln']."' AND YEAR(tgl_diterima) = '".$_GET['thn']."' ";
		$ximl = $this->db->query($sel_ximl)->num_rows();

		$sel_ximp = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxi.") AND jk='p' AND id_sts_data='4' AND MONTH(tgl_diterima) = '".$_GET['bln']."' AND YEAR(tgl_diterima) = '".$_GET['thn']."' ";
		$ximp = $this->db->query($sel_ximp)->num_rows();

		$sel_xikl = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxi.") AND jk='l' AND id_sts_data IN ('3', '5') AND MONTH(tgl_update_sts) = '".$_GET['bln']."' AND YEAR(tgl_update_sts) = '".$_GET['thn']."' ";
		$xikl = $this->db->query($sel_xikl)->num_rows();

		$sel_xikp = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxi.") AND jk='p' AND id_sts_data IN ('3', '5') AND MONTH(tgl_update_sts) = '".$_GET['bln']."' AND YEAR(tgl_update_sts) = '".$_GET['thn']."' ";
		$xikp = $this->db->query($sel_xikp)->num_rows();

		$xijl = ($xil+$ximl) - $xikl;
		$xijp = ($xip+$ximp) - $xikp;


		// KELAS XII
		$sel_kelasxii = "SELECT id FROM v_kelas WHERE id_jurusan='".$v->id_jurusan."' AND nama_kelas='".$v->nama_kelas."' AND id_tk='3' ";

		$sel_xiil = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxii.") AND jk='l' AND MONTH(tgl_update_sts) IN('00', '".$_GET["bln"]."') AND YEAR(tgl_update_sts) IN ('0000', '".$_GET["thn"]."') ";

		$xiil = $this->db->query($sel_xiil)->num_rows();

		$sel_xiip = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxii.") AND jk='p' AND MONTH(tgl_update_sts) IN('00', '".$_GET["bln"]."') AND YEAR(tgl_update_sts) IN ('0000', '".$_GET["thn"]."') ";

		$xiip = $this->db->query($sel_xiip)->num_rows();

		$sel_xiiml = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxii.") AND jk='l' AND id_sts_data='4' AND MONTH(tgl_diterima) = '".$_GET['bln']."' AND YEAR(tgl_diterima) = '".$_GET['thn']."' ";
		$xiiml = $this->db->query($sel_xiiml)->num_rows();

		$sel_xiimp = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxii.") AND jk='p' AND id_sts_data='4' AND MONTH(tgl_diterima) = '".$_GET['bln']."' AND YEAR(tgl_diterima) = '".$_GET['thn']."' ";
		$xiimp = $this->db->query($sel_xiimp)->num_rows();

		$sel_xiikl = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxii.") AND jk='l' AND id_sts_data IN ('3', '5') AND MONTH(tgl_update_sts) = '".$_GET['bln']."' AND YEAR(tgl_update_sts) = '".$_GET['thn']."' ";
		$xiikl = $this->db->query($sel_xiikl)->num_rows();

		$sel_xiikp = "SELECT * FROM data_siswa WHERE id_kelas IN (".$sel_kelasxii.") AND jk='p' AND id_sts_data IN ('3', '5') AND MONTH(tgl_update_sts) = '".$_GET['bln']."' AND YEAR(tgl_update_sts) = '".$_GET['thn']."' ";
		$xiikp = $this->db->query($sel_xiikp)->num_rows();

		$xiijl = ($xiil+$xiiml) - $xiikl;
		$xiijp = ($xiip+$xiimp) - $xiikp;

		$seluruh_l = $seluruh_l + ($xjl+$xijl+$xiijl);
		$seluruh_p = $seluruh_p + ($xjp+$xijp+$xiijp);


		$kelas .= "
			<tr>
				<td align='center'>".$no."</td>
				<td>".$v->alias." ".$v->nama_kelas."</td>
				<td align='right'>".$rombel."</td>
				<td align='right'>".$xl."</td>
				<td align='right'>".$xp."</td>
				<td align='right'>".($xl+$xp)."</td>
				<td align='right'>".$xml."</td>
				<td align='right'>".$xmp."</td>
				<td align='right'>".($xml+$xmp)."</td>
				<td align='right'>".$xkl."</td>
				<td align='right'>".$xkp."</td>
				<td align='right'>".($xkl+$xkp)."</td>
				<td align='right'>".$xjl."</td>
				<td align='right'>".$xjp."</td>
				<td align='right'>".($xjl+$xjp)."</td>

				<td  bgcolor='#e2e2e2'></td>

				<td align='right'>".$xil."</td>
				<td align='right'>".$xip."</td>
				<td align='right'>".($xil+$xip)."</td>
				<td align='right'>".$ximl."</td>
				<td align='right'>".$ximp."</td>
				<td align='right'>".($ximl+$ximp)."</td>
				<td align='right'>".$xikl."</td>
				<td align='right'>".$xikp."</td>
				<td align='right'>".($xikl+$xikp)."</td>
				<td align='right'>".$xijl."</td>
				<td align='right'>".$xijp."</td>
				<td align='right'>".($xijl+$xijp)."</td>

				<td bgcolor='#e2e2e2'></td>

				<td align='right'>".$xiil."</td>
				<td align='right'>".$xiip."</td>
				<td align='right'>".($xiil+$xiip)."</td>
				<td align='right'>".$xiiml."</td>
				<td align='right'>".$xiimp."</td>
				<td align='right'>".($xiiml+$xiimp)."</td>
				<td align='right'>".$xiikl."</td>
				<td align='right'>".$xiikp."</td>
				<td align='right'>".($xiikl+$xiikp)."</td>
				<td align='right'>".$xiijl."</td>
				<td align='right'>".$xiijp."</td>
				<td align='right'>".($xiijl+$xiijp)."</td>

				<td bgcolor='#e2e2e2'></td>


				<td align='right'>".($xjl+$xijl+$xiijl)."</td>
				<td align='right'>".($xjp+$xijp+$xiijp)."</td>
				<td align='right'>".(($xjl+$xijl+$xiijl)+($xjp+$xijp+$xiijp))."</td>
			</tr>
		";
		$no++;
	}

	$this->db->where("MONTH(tgl_diterima)", $_GET['bln']);
	$this->db->where("YEAR(tgl_diterima)", $_GET['thn']);
	$this->db->where("id_sts_data", "4");
	$qm = $this->db->get("v_siswa")->result();

	$masuk = "";
	$n = 1;
	foreach ($qm as $vm) {

		$kls2 = $this->m_reff->goField("v_kelas", "nama", " WHERE id='".$vm->id_kelas."'");

		$masuk.="
			<tr>
				<td align='center'>".$n."</td>
				<td>".$vm->nama."</td>
				<td align='center'>".strtoupper($vm->jk)."</td>
				<td align='center'>".$kls2."</td>
				<td align='center'>&#10004;</td>
				<td align='center'> </td>

			</tr>
		";
		$n++;
	}


	$this->db->where("MONTH(tgl_update_sts)", $_GET['bln']);
	$this->db->where("YEAR(tgl_update_sts)", $_GET['thn']);
	$this->db->where("id_sts_data", "3");
	$this->db->or_where("id_sts_data", "5");
	$qk = $this->db->get("data_siswa")->result();

	$keluar = "";
	$n2 = 1;
	foreach ($qk as $vk) {

		$kls = $this->m_reff->goField("v_kelas", "nama", " WHERE id='".$vk->id_kelas."'");

		$keluar.="
			<tr style='color:red'>
				<td align='center'>".$n2."</td>
				<td>".$vk->nama."</td>
				<td align='center'>".strtoupper($vk->jk)."</td>
				<td align='center'>".$kls."</td>
				<td align='center'></td>
				<td align='center'>&#10004;</td>

			</tr>
		";
		$n2++;
	}

	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
		.tb {
		  border-collapse: collapse;
		}

			.tb tr td {
			  border: 1px solid #e2e2e2;
			  padding: 5px;
			  text-align: center;
			}

		body{
			font-family: Tahoma;
			font-size: 11px;
		}

		.table {
		  border-collapse: collapse;
		}

		.table th td {
		  border: 1px solid #e2e2e2;
		}
	</style>

</head>
<body>

	<center>
		<p style="font-size: 12px">
			LAPORAN BULANAN<br>
			PESERTA DIDIK SMK PGRI SUBANG<br>
			KEADAAN : <?php echo $bulan[sprintf("%01d", $_GET['bln'])]." ".$_GET["thn"] ?>
			<?php //echo $tgl_terakhir ?>
		</p>
	</center>

	<table border="1" class="table">
		<tr>
			<td rowspan="3" align="center">NO</td>
			<td rowspan="3" width="20%" align="center">PROGRAM KEAHLIAN</td>
			<td rowspan="3" align="center">ROMBEL</td>
			<td colspan="3" rowspan="2" align="center">KELAS X</td>
			<td colspan="6" align="center">MUTASI</td>
			<td colspan="3" rowspan="2" align="center">JML. SISWA KELAS X</td>
			<td width="10" bgcolor="#e2e2e2"></td>
			<td colspan="3" rowspan="2" align="center">KELAS XI</td>
			<td colspan="6" align="center">MUTASI</td>
			<td colspan="3" rowspan="2" align="center">JML. SISWA KELAS XI</td>
			<td width="10" bgcolor="#e2e2e2"></td>
			<td colspan="3" rowspan="2" align="center">KELAS XII</td>
			<td colspan="6" align="center">MUTASI</td>
			<td colspan="3" rowspan="2" align="center">JML. SISWA KELAS XII</td>
			<td width="10" bgcolor="#e2e2e2"></td>
			<td colspan="3" align="center">JML. SISWA</td>
		</tr>
		<tr>
			<td colspan="3" align="center">MASUK</td>
			<td colspan="3" align="center">KELUAR</td>
			<td width="10" bgcolor="#e2e2e2"></td>
			<td colspan="3" align="center">MASUK</td>
			<td colspan="3" align="center">KELUAR</td>
			<td bgcolor="#e2e2e2"></td>
			<td colspan="3" align="center">MASUK</td>
			<td colspan="3" align="center">KELUAR</td>
			<td bgcolor="#e2e2e2"></td>
			<td colspan="3" align="center">SELURUHNYA</td>
		</tr>
		<tr>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td bgcolor="#e2e2e2"></td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td bgcolor="#e2e2e2"></td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
			<td bgcolor="#e2e2e2"></td>
			<td align="center">L</td>
			<td align="center">P</td>
			<td align="center">JML</td>
		</tr>
		<?php echo $kelas; ?>
		<tr>
			<td colspan="42" align="center"><strong>JUMLAH KESELURUHAN</strong></td>
			<td align="center"><strong><?php echo $seluruh_l ?></strong></td>
			<td align="center"><strong><?php echo $seluruh_p ?></strong></td>
			<td align="center"><strong><?php echo ($seluruh_l + $seluruh_p) ?></strong></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td valign="top" width="550">
				<table class="table" border="1" width="500">
					<tr>
						<td align="center" width="10%">NO</td>
						<td align="center">NAMA</td>
						<td align="center" width="10%">JK</td>
						<td align="center" width="15%">KELAS</td>
						<td align="center" width="10%">MASUK</td>
						<td align="center" width="10%">KELUAR</td>
					</tr>
					<?php echo $masuk ?>
					<?php echo $keluar ?>
				</table>
			</td>
			<td align="center">
				<table>
					<tr>
						<td></td>
						<td></td>
						<td colspan="6" align="center">
							Subang, <?php echo date("d F Y"); ?>
							<?php //echo $tgl_terakhir ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan="6" align="center">
							Kepala SMK PGRI SUBANG

						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan="6" align="center">
							<strong><u>Dra. Hj. SRI MULYATI, MM.Pd</u></strong>
														<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan="6" align="center">NIP. 19670916 199303 2 013</td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>

</body>
</html>