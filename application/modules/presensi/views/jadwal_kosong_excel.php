<?php 
	
	$tgl_eng = $this->tanggal->eng_($_GET['tgl'], "");

	ob_end_clean();
	header( "Content-type: application/vnd.ms-excel" );
	header('Content-Disposition: attachment; filename="jadwal_kosong_tgl_'.$tgl_eng.'_jam_ke_'.$_GET['jam'].'.xls"');
	header("Pragma: no-cache");
	header("Expires: 0");
	ob_end_clean();
	

?>

<?php
	$html = $this->mdl->getJadwalKosongResult($_GET['tgl'], $_GET['jam']);


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
			<p style="font-size: 16px">
				LAPORAN JADWAL KOSONG GURU TANGGAL <?php echo $_GET['tgl'] ?> JAM KE <?php echo $_GET['jam'] ?>
			</p>
		</center>

		<table border="1" class="table">
			<tr>
				<td align="center">NO</td>
				<td align="center">NAMA GURU</td>
				<td align="center">JAM KE</td>
			</tr>
			<?php echo $html; ?>	
		</table>

	</body>



</html>