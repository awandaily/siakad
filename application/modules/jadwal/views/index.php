 <!-- breadcrumb -->
 <div class="breadcrumb-header justify-content-between">
 	<div>
 		<h4 class="content-title mb-2">Hi, Ini Jadwal</h4>
 		<nav aria-label="breadcrumb">
 			<ol class="breadcrumb">
 				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
 				<li class="breadcrumb-item active" aria-current="page"> Jadwal</li>
 			</ol>
 		</nav>
 	</div>
 	<div class="d-flex my-auto">
 		<div class=" d-flex right-page">
 			<div class="d-flex justify-content-center mr-5">
 				<div class="">
 					<span class="d-block">
 						<span class="label ">Jadwal Hari ini</span>
 					</span>
 					<span class="value">
 						Kosong
 					</span>
 				</div>

 			</div>
 			<div class="d-flex justify-content-center">
 				<div class="">
 					<span class="d-block">
 						<span class="label">Jadwal Kelas</span>
 					</span>
 					<span class="value">
 						Kosong
 					</span>
 				</div>

 			</div>
 		</div>
 	</div>
 </div>
 <!-- /breadcrumb -->
 <div class="row clearfix">

 	<?php
		$token = date('His');
		$id_guru = $this->mdl->idu();
		$id_tahun = $this->m_reff->tahun();
		$id_semester = $this->m_reff->semester();
		for ($i = 1; $i <= 5; $i++) {
			if ($i == 1) {
				$sts = 1;
			} elseif ($i == 5) {
				$sts = 2;
			} else {
				$sts = 0;
			}
			$jam = date("H:i:s");
			$ha = date("N");

		?>

 		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
 			<div class="card">

 				<div class="bodyd" style=" padding:10px">
 					<!---------------------->
 					<span style="font-size:18px"><?php echo $this->m_reff->goField("tr_hari", "nama", "where id='" . $i . "'"); ?></span>
 					<table class="table table-bordered mg-b-0 text-md-nowrap" width="100%">
 						<tr style='font-size:12px'>
 							<th width="100px">JAM KE </th>
 							<th>MASUK</th>
 							<th>MAPEL</th>
 							<th>KELAS</th>
 							<th>MATERI TERKAHIR</th>
 						</tr>
 						<?php
							$urut = $val = "";
							$db = $this->db->query("select * from tr_jam_ajar where sts='" . $sts . "' order by jam_mulai asc ")->result();
							foreach ($db as $val) {
								if ($ha == $i && $jam >= $val->jam_mulai && $jam <= $val->jam_akhir) {
									$cls = "bg-orange col-black";
								} else {
									$cls = "";
								}

								$urut = $val->urut;
								if (!$urut) {
									echo "<tr class='font-bold " . $cls . "' style='background-color:#ababab'>
									  <td>" . $urut . "</td>
									  <td>" . substr($val->jam_mulai, 0, 5) . "</td>
									  <td colspan='3'>" . $val->kegiatan . "</td>
									  </tr>";
								} else {
									$base = $this->db->query("select * from v_jadwal where id_guru='" . $id_guru . "' 
											and id_tahun='" . $id_tahun . "' and id_semester='" . $id_semester . "' and id_hari='" . $i . "'
											and jam like '%," . $urut . ",%' ")->row();
									$mapel = isset($base->mapel) ? ($base->mapel) : "";
									$nama_kelas = isset($base->nama_kelas) ? ($base->nama_kelas) : "";
									if ($mapel) {
										echo "<tr class='" . $cls . " '>
									  <td>" . $urut . "</td>
									  <td>" . substr($val->jam_mulai, 0, 5) . "</td>
									  <td><span class='col-teal'>" . $mapel . "</span>
									  </td>	
									  <td>" . $nama_kelas . " </td>
									  <td> HSDSHDUSHDU </td>								 
									  </tr>";
									} else {
										if ($val->kegiatan) {
											$kegi = $val->kegiatan;
											$cls = "bg-grey";
										} else {
											$kegi = "<i class='col-orange'>Kosong</i>";
											$cls = "";
										}

										echo "<tr class='  " . $cls . " font-bold' >
										  <td>" . $urut . "</td>
										  <td>" . substr($val->jam_mulai, 0, 5) . "</td>
										  <td colspan='3'>$kegi</td>						 
										  </tr>";
									}
								}
							}
							?>
 					</table>

 					<!---------------------->

 				</div>
 			</div>
 		</div>
 	<?php  } ?>



 </div>