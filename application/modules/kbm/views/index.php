 <style>
 	@media (max-width: 867px) {
 		.clasmo {
 			margin-top: -20px;
 		}

 		.clasmo2 {
 			margin-top: -30px;
 		}

 		.clasmo3 {
 			margin-top: -50px;
 		}

 		.clasmo25 {
 			margin-top: -35px;
 		}

 		.clasmo4 {
 			margin-top: -70px;
 		}

 		.center {
 			text-align: center;
 		}
 	}

 	select option[value="create"] {
 		/* value not val */
 		background: black;
 		color: white;
 		text-align: right;
 		cursor: pointer;
 		font-weight: bold;
 		font-style: italic;
 	}
 </style>

 <div class="breadcrumb-header justify-content-between">
 	<div>
 		<h4 class="content-title mb-2">Hi, Ini KBM </h4>
 		<nav aria-label="breadcrumb">
 			<ol class="breadcrumb">
 				<li class="breadcrumb-item"><a href="#">Mengajar</a></li>
 				<li class="breadcrumb-item active" aria-current="page"> </li>
 			</ol>
 		</nav>
 	</div>

 </div>
 <!-- /breadcrumb -->
 <div class=" col-sm-12 col-md-12 col-lg-12">
 	<div id="view"></div>
 </div>
 </div>


 <?php

	$datalibur = $this->db->query("select * from tm_jadwal_libur where start<='" . date('Y-m-d') . "' and end>='" . date('Y-m-d') . "' ")->row();
	$namaLibur = isset($datalibur->nama) ? ($datalibur->nama) : "";
	if ($namaLibur) {
		echo "<div class='card'><br><center> Hari ini KBM diliburkan<br> <i class='col-deep-orange'> " . $namaLibur . " </i></center></div>";
		return false;
	}











	$ha = date("N");
	if ($ha == 1) {
		$ss = 1;
	} elseif ($ha == 5) {
		$ss = 2;
	} else {
		$ss = 0;
	}
	$data = $this->db->query("select urut from tr_jam_ajar where sts='" . $ss . "' AND  '" . date("H:i:s") . "'<=jam_akhir order by jam_akhir asc limit 1 ")->row();
	$id_jam = isset($data->urut) ? ($data->urut) : "";
	$db = $this->mdl->getKelasIni($id_jam); //v_jadwal
	$data_jam = isset($db->jam) ? ($db->jam) : "";

	$jamkenow = isset($data->urut) ? ($data->urut) : "0";

	$jamkenow = (string)$jamkenow;
	$posisi = strpos($data_jam, $jamkenow);

	$jam_blok = substr($data_jam, 0, $posisi);
	if ($jam_blok == ",") {
		$jam_blok = "";
	}

	$id_jadwal = isset($db->id) ? ($db->id) : "";
	$kelas = isset($db->nama_kelas) ? ($db->nama_kelas) : "";
	$id_kelas = isset($db->id_kelas) ? ($db->id_kelas) : "";
	$id_hari = isset($db->id_hari) ? ($db->id_hari) : "";
	$id_mapel = isset($db->id_mapel) ? ($db->id_mapel) : "";
	$mapel = isset($db->mapel) ? ($db->mapel) : "";
	$tahun = $this->m_reff->tahun();
	$sms = $this->m_reff->semester();
	$idguru = $this->mdl->idu();
	$jamnow = $this->m_reff->jam_aktif();
	///===============================================================================//////
	$cekJadwalDouble = $this->db->query("select * from tm_penjadwalan where id_semester='" . $sms . "' 
	   and id_tahun='" . $tahun . "' and id_guru='" . $idguru . "' and id_hari='" . date('N') . "' and jam LIKE '%," . $jamnow . ",%'  ")->num_rows();
	if ($cekJadwalDouble > 1) //jika ada 2 jadwal bentrok
	{
		$jadwalbentrok = "true";
	} else {
		$jadwalbentrok = "false";
	}

	///=================================================================================/////

	$data = $this->db->query("select * from tr_semester where sts=1")->row();
	$smsini = isset($data->id) ? ($data->id) : "";
	$sms = $this->m_reff->semester();
	if ($smsini != $sms) {
		echo "<div class='card'><br><center><i>Anda sedang melihat history semester sebelumnya<br> Untuk melakukan KBM Silahkan pilih semester saat ini</i></center></div>";
		return false;
	}


	if (!$mapel) {
		echo "<div class='card'><br><center><i>Tidak Ada  Mengajar Di Jam Sekarang.</i></center></div>";
		return false;
	}




	$cekoff = $this->db->query("select * from tm_diliburkan where  substr(tgl,1,10)='" . date('Y-m-d') . "'  and id_guru='" . $this->mdl->idu() . "' and id_mapel='$id_mapel'  and id_kelas='$id_kelas'  ")->num_rows();
	if ($cekoff) {
		echo "<div class='card'><br><center><i>Pembelajaran di non-aktifkan</i></center></div>";
		return false;
	}





	$cekinval = $this->mdl->cekInval(date('Y-m-d'), $id_jadwal);
	if ($cekinval) {
		$namaguru = $guru = $this->m_reff->goField("data_pegawai", "nama", "where id='" . $cekinval->id_guru . "' ");
		echo "<center><h4 class='col-pink  '><u>Jadwal anda telah di inval oleh " . $namaguru . "</u></h4></center>";
		return false;
	}



	$cekizinharian = $this->mdl->cekIzinHarian(date('Y-m-d'));
	if ($cekizinharian) {

		echo "<center><h4 class='col-pink'><u>Anda sedang izin " . $cekizinharian->ket . "</u></h4></center>";
		return false;
	}









	$vis = $this->db->query("select * from tm_absen_guru where id_jadwal='" . $id_jadwal . "'
 and id_mapel='" . $id_mapel . "' and id_guru='" . $this->mdl->idu() . "' and substr(tgl,1,10)='" . date('Y-m-d') . "'")->row();
	$id_materi = isset($vis->id_materi) ? ($vis->id_materi) : "";
	$jam_diblok = isset($vis->jam_blok) ? ($vis->jam_blok) : "";


	$id_kikd = isset($vis->id_kikd) ? ($vis->id_kikd) : "";
	$cpembelajaran = isset($vis->cpembelajaran) ? ($vis->cpembelajaran) : "0";
	if ($cpembelajaran == 0) {
		$cpembelajaran = "-";
	}

	$sumber = isset($vis->sumber) ? ($vis->sumber) : "";
	$pkl = "Kelas sedang melaksanakan PKL";

	$visizin = $this->db->query("select * from tm_absen_guru where id_guru='" . $this->mdl->idu() . "' and substr(tgl,1,10)='" . date('Y-m-d') . "' limit 1")->row();
	$izin = isset($visizin->izin) ? ($visizin->izin) : "";
	if ($sumber == 3) {
		$izin = "<font color='yellow' size='3'>Anda sedang izin mengajar!</font>";
		$dataIzin = true;
	} elseif ($sumber == 5) {
		$pkl = "<font color='yellow' size='3'>Kelas sedang melaksanakan PKL</font>";
		$izin = "Izin mengajar ";
		$dataIzin = true;
	} else {
		$izin = "Tidak KBM, tidak Kirim tugas karena suatu hal";
		$dataIzin = false;
	}

	//if(strpos($jam_diblok,$jamkenow)!==false)
	//{
	//	echo "<div class='card font-bold col-pink' style='padding:10px'> <center> ABSEN ANDA TELAH DIBLOK  DI JAM PELAJARAN SEKARANG !! </center></div>";
	//	return false;
	//}


	?>
 <?php
	if ($sumber == 1 and $jadwalbentrok == "false") { ?>
 	<!-- Tahun Ajaran <?php echo $this->m_reff->tahun_ajaran(); ?> - Semester <?php echo $this->m_reff->semester(); ?>  Task Info -->
 	<div class="row clearfix" style="margin-top:-40px">


 		<div class=" col-sm-12 col-md-12 col-lg-12">
 			<div class="cardx" id="area_load"><br>
 				<center><b class='col-teal'> JADWAL MENGAJAR SEKARANG</b></center>

 				<div class="bodys">

 					<table class=" " width="100%">
 						<tr>
 							<td colspan="2" style='border-bottom:black solid 1px'>
 								<center> <b><?php echo $kelas; ?> : <?php echo $mapel; ?></b> </center>
 							</td>
 						</tr>
 						<tr>
 							<td><b>Pilih KD</b>
 								<?php
									$tahun = $this->m_reff->tahun();
									$sms = $this->m_reff->semester();
									//$this->db->where("id_tahun",$tahun);
									//$this->db->where("id_semester",$sms);
									//$this->db->where("id_guru",$this->mdl->idu());
									//$this->db->where("id_mapel",$id_mapel);
									//$this->db->where("id_kelas",$id_kelas);
									//$this->db->where("kd3_kb>",0);
									//$this->db->group_by("code");
									$dtkikd = $this->db->query("SELECT * FROM `v_kikd` WHERE `id_tahun` = '" . $tahun . "' AND `id_semester` = '" . $sms . "' AND `id_guru` = '" . $this->mdl->idu() . "' 
		AND `id_mapel` = '" . $id_mapel . "' AND `id_kelas` = '" . $id_kelas . "' AND `kd3_kb` >0 ORDER BY CAST(SUBSTR(kd3_no  , 3  , 5) AS SIGNED INTEGER) ASC");
									//$dtkikd=$this->db->get("v_kikd");
									if (!$dtkikd->num_rows()) {
										$id_guru = $this->mdl->idu();
										$this->m_reff->isi_kikd($tahun, $sms, $id_kelas, $id_mapel, $id_guru);
									}



									$ray = "";

									$ray[""] = "=== Pilih KI.KD ===";

									$val = "";
									foreach ($dtkikd->result() as $val) {
										$ray[$val->id] = $val->kd3_no . " - " . $val->kd3_desc . " __ " . $val->kd4_no . " - " . $val->kd4_desc;
									}
									$datakikd = $ray;
									echo form_dropdown("kikd", $datakikd, $id_kikd, "class='form-control' style=' width:100%' onchange='pindahInputan()' "); ?>

 							</td>
 						<tr>
 							<td><b>Isi Pembahasan</b> <textarea name='materi' class='form-control ' placeholder="Pembahasan..." onchange='insertMateriBaru()'></textarea>
 								<input type="hidden" name="id_materi">
 							</td>
 						</tr>
 						</tr>
 						<tr>
 							<td>
 								<center><a class='col-purple' href='javascript:history_mengajar()'>HISTORY MENGAJAR MINGGU LALU</a></center>
 							</td>
 						</tr>
 					</table>




 					<br>


 					<div class="  clearfix "> <span id="menu">
 							<button onclick="hokabsen()" class="btn btn-block bg-teal sadow"><i class="material-icons">save</i> SIMPAN</button>
 							<br>
 							<div class="progress-bar bg-cyan progress-bar-striped active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">

 							</div>
 						</span></div>



 				</div>





 				<!----->
 				<div class="col-md-12">&nbsp;</div>
 				&nbsp;
 			</div>
 		</div>


 	</div>
 <?php

	} ?>
 <!--- end if sumber--->

 <div id="dataPiihanSumber"> </div>

 <?php

	if (!$sumber or $sumber == 3  or $sumber == 4   or $sumber == 5 or $jadwalbentrok == "true") { ?>

 	<div id="sumber">

 		<center><b>SILAHKAN PILIH SESUAI KONDISI</b></center><br>
 		<div class="info-box bg-teal hover-expand-effect" onclick="sumber(`1`)">
 			<div class="icon">
 				<i class="material-icons">contacts</i>
 			</div>
 			<div class="content">
 				<div class="text">Melaksanakan KBM, Mengabsen Siswa</div>
 				<div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">MENGAJAR</div>
 			</div>
 		</div>
 		<div class="info-box bg-brown hover-expand-effect" onclick="sumber(`5`)">
 			<div class="icon">
 				<i class="material-icons">accessible</i>
 			</div>
 			<div class="content">
 				<div class="text"><?php echo $pkl; ?></div>
 				<div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">PELAKSANAAN PKL </div>
 			</div>
 		</div>
 		<!---   <div class="info-box bg-brown hover-expand-effect"  onclick="sumber(`2`)">
                        <div class="icon">
                            <i class="material-icons">import_contacts</i>
                        </div>
                        <div class="content">
                            <div class="text">Kirim tugas karena tidak bisa KBM</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">KIRIM TUGAS</div>
                        </div>
    </div>
  
   <!---  <textarea name="f[izin]" class="form-control"  placeholder="Alasan izin mengajar" style="min-height:80px"></textarea>-->



 		<div class="info-box bg-blue-grey hover-expand-effect" onclick="sumber(`3`)">
 			<div class="icon">
 				<i class="material-icons">live_help</i>
 			</div>
 			<div class="content">
 				<div class="text" style="font-size:11px"><?php echo $izin; ?></div>
 				<div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">IZIN MENGAJAR</div>
 			</div>
 		</div>


 		<!--<center><a href='<?php echo $this->m_reff->tutorial(1) ?>'><b>Anda Belum Mengerti ? klik disini. (youtube) </b></a></center>-->
 	</div>
 <?php } else { ?>

 	<script>
 		var sumberAbsen = "<?php echo $sumber; ?>";

 		setTimeout(function() {
 			getSumber(sumberAbsen);
 		}, 200);
 	</script>


 <?php } ?>

 <script>
 	function getSumber(sumber) {
 		if (sumber != 1) {
 			loadkonten();
 			$.post("<?php echo base_url() ?>kbm/getSumber", {
 				bentrok: "false",
 				id: sumber,
 				idMapel: <?php echo $id_mapel; ?>,
 				idJadwal: <?php echo $id_jadwal; ?>,
 				idkelas: <?php echo $id_kelas ?>,
 				idhari: <?php echo $id_hari ?>
 			}, function(data) {
 				$("#dataPiihanSumber").html(data);
 				unloadkonten();
 			});
 		}



 	}

 	function getSumberBentrok(sumber, idkelas, jam, izin, jam_blok, id_mapel, idJadwal) {
 		if (sumber != 1) {
 			loadkonten();
 			$.post("<?php echo base_url() ?>kbm/getSumber", {
 				bentrok: "true",
 				id: sumber,
 				idMapel: id_mapel,
 				idJadwal: idJadwal,
 				idkelas: idkelas,
 				idhari: <?php echo $id_hari ?>
 			}, function(data) {
 				$("#dataPiihanSumber").html(data);
 				unloadkonten();
 			});
 		}
 	}

 	function getKontenKBM() {
 		$.post("<?php echo base_url() ?>kbm", {
 			ajax: "yes"
 		}, function(data) {
 			$(".content").html(data);
 		});
 	}

 	function getKontenKBMBentrok(id, idkelas, jam, izin, jam_blok, id_mapel, idJadwal) {
 		$.post("<?php echo base_url() ?>kbm/bentrok", {
 			ajax: "yes",
 			id: id,
 			idMapel: id_mapel,
 			idJadwal: idJadwal,
 			idKelas: idkelas,
 			jam: jam,
 			izin: izin,
 			jam_blok: jam_blok
 		}, function(data) {
 			$(".content").html(data);
 		});
 	}

 	function sumber(id) {
 		var idkelas = "<?php echo $id_kelas ?>";
 		var jam = "<?php echo $data_jam ?>";
 		var izin = "<?php echo $dataIzin ?>";
 		var jam_blok = "<?php echo $jam_blok ?>";
 		var msg;
 		if (id == 1) {
 			msg = "Anda akan melaksanakan KBM seperti biasa : mengisi agenda dan mengabsen siswa.";
 		} else if (id == 2) {
 			msg = "Anda tidak akan melaksanakan KBM, tapi akan digantikan dengan KIRIM TUGAS ke siswa ?";
 		} else if (id == 5) {
 			msg = "Siswa sedang PKL ?";
 		} else {
 			msg = "Anda akan IZIN MENGAJAR tidak bisa melaksanakan KBM juga tidak bisa KIRIM TUGAS karena suatu hal ? ";
 		}
 		alertify.confirm("<center>" + msg + "</center>", function() {
 			loadkonten();
 			$.post("<?php echo base_url() ?>kbm/addSumber", {
 				lost: "false",
 				id: id,
 				idMapel: <?php echo $id_mapel; ?>,
 				idJadwal: <?php echo $id_jadwal; ?>,
 				idKelas: idkelas,
 				jam: jam,
 				izin: izin,
 				jam_blok: jam_blok
 			}, function(data) {
 				if (id == 1) {
 					if (data == "finger") {
 						notif("Anda belum fingerprint...");
 						//    $("#sumber").html("<br>Anda belum fingerprint...<br>");
 						unloadkonten();
 						return false;
 					}

 					if (data == "dua") {
 						getjadwalBentrok(id);
 						unloadkonten();
 						return false;
 					}


 					getKontenKBM();
 				} else {

 					if (data == "dua") {
 						getjadwalBentrok(id);
 						unloadkonten();
 						return false;
 					}

 					getSumber(id);
 				}

 				unloadkonten();
 				$("#sumber").html("<br><br>");
 			})
 		})

 	}





 	function sumberBentrok(id, idkelas, jam, izin, jam_blok, id_mapel, idJadwal) {
 		//  var idkelas="<?php echo $id_kelas ?>";
 		//   var jam="<?php echo $data_jam ?>";
 		//   var izin="<?php echo $dataIzin ?>";
 		//    var jam_blok="<?php echo $jam_blok ?>";
 		var msg;
 		if (id == 1) {
 			msg = "Anda akan melaksanakan KBM seperti biasa : mengisi agenda dan mengabsen siswa.";
 		} else if (id == 2) {
 			msg = "Anda tidak akan melaksanakan KBM, tapi akan digantikan dengan KIRIM TUGAS ke siswa ?";
 		} else if (id == 5) {
 			msg = "Siswa sedang PKL ?";
 		} else {
 			msg = "Anda akan IZIN MENGAJAR tidak bisa melaksanakan KBM juga tidak bisa KIRIM TUGAS karena suatu hal ? ";
 		}
 		alertify.confirm("<center>" + msg + "</center>", function() {
 			loadkonten();
 			$.post("<?php echo base_url() ?>kbm/addSumberBentrok", {
 				id: id,
 				idMapel: id_mapel,
 				idJadwal: idJadwal,
 				idKelas: idkelas,
 				jam: jam,
 				izin: izin,
 				jam_blok: jam_blok
 			}, function(data) {
 				//   if(id==1){

 				getKontenKBMBentrok(id, idkelas, jam, izin, jam_blok, id_mapel, idJadwal);
 				///    }else 
 				//    {

 				//          getSumberBentrok(id,idkelas,jam,izin,jam_blok,id_mapel,idJadwal);
 				///    }
 				$("#mdl_modal_bentrok").modal("hide");
 				unloadkonten();
 				$("#sumber").html("<br><br>");
 			})
 		})
 		$("div").removeClass("modal-backdrop");
 		$('.modal-backdrop').remove();
 	}
 </script>


 <?php
	$mobile = $this->m_reff->mobile();
	if ($mobile) { ?>
 	<br>
 	<br>
 	<br>
 	<br>
 	<br>
 	<br>
 	<br>
 	<br>
 	<br>





 	<script>
 		function tulis() {
 			$('html,body').animate({
 				scrollTop: 1000
 			}, 'slow');
 		}
 	</script>
 <?php } ?>
 <script>
 	function hokabsen() {
 		var materi = $("[name='materi']").val();
 		if (!materi) {
 			notif("Mohon isi agenda pembahasan.");
 			$("[name='materi']").focus();
 			return false;
 		}

 	}

 	function pindahInputan() {
 		$("[name='materi']").focus();
 	}


 	$("[name='kikd']").change(function() {
 		var kikd = $("[name='kikd']").val();
 		$("[name='materi']").val("");
 		$("[name='id_materi']").val("");
 		return false;

 	});

 	//	 $("#menu").hide();

 	setTimeout(function() {
 		var kikd = $("[name='kikd']").val();
 		if (kikd) {
 			getMateriNow();
 		}
 	}, 500);

 	setTimeout(function() {
 		var idmateri = $("[name='id_materi']").val();

 		if (idmateri > 0) {
 			$("#menu").show();
 			ready();
 		}
 	}, 1000);

 	function getMateriNow() //ambil materi hari ini bukan kemarin
 	{
 		loadkonten();
 		var id_kikd = $("[name='kikd']").val();
 		var idmapel = "<?php echo $id_mapel; ?>";
 		var idkelas = "<?php echo $id_kelas ?>";
 		var id_jadwal = "<?php echo $id_jadwal ?>";
 		$.ajax({

 			type: "POST",
 			dataType: "json",
 			url: "<?php echo site_url("kbm/getMateriNow"); ?>",
 			data: {
 				id_jadwal: id_jadwal,
 				id_kikd: id_kikd,
 				idkelas: idkelas,
 				idmapel: idmapel
 			},
 			success: function(data) {

 				$("[name='id_materi']").val(data.id);
 				$("[name='materi']").val(data.materi);
 				unloadkonten();
 				ready();
 			}
 		});

 	}

 	function ambilMateri() {
 		return false;
 		var loading = "<img src='<?php echo base_url() ?>plug/img/load.gif'> Mohon tunggu...";

 		var kikd = $("[name='kikd']").val();
 		var idkelas = "<?php echo $id_kelas; ?>";
 		var idmapel = "<?php echo $id_mapel; ?>";
 		if (kikd) {
 			blok("area_load");
 			$.post("<?php echo site_url("kbm/cekMateri"); ?>", {
 				kikd: kikd,
 				idkelas: idkelas,
 				idmapel: idmapel
 			}, function(data) {
 				unblock("area_load");
 				if (data < 1) {
 					$("[name='kikd']").val("")
 					notif(" Maaf KIKD sebelumnya belum tuntas !!  Mohon untuk memberikan nilai untuk KIKD sbelumnya.");
 					return false;

 				}

 			});
 		}

 		$.ajax({
 			url: "<?php echo site_url("kbm/getDropdownMateri"); ?>",
 			method: "POST",
 			data: "kikd=" + kikd + "&idkelas=" + idkelas + "&idmapel=" + idmapel,
 			dataType: "json",
 			success: function(data) {
 				$("#dataMateri").html(data["menu"]);
 				if (data["status"]) {
 					$("#menu").show();
 				}
 			}
 		});






 	}
 	$("[name='materi']").click(function() {
 		var id_kikd = $("[name='kikd']").val();
 		if (!id_kikd) {
 			$("[name='kikd']").focus();
 		}
 	});

 	function insertMateriBaru() {
 		var id_kikd = $("[name='kikd']").val();
 		var materi = $("[name='materi']").val();
 		var id_materi = $("[name='id_materi']").val();
 		var id_jadwal = "<?php echo $id_jadwal; ?>";
 		$.post("<?php echo site_url("kbm/insertMateriBaru"); ?>", {
 			id_kikd: id_kikd,
 			materi: materi,
 			id_jadwal: id_jadwal,
 			id_materi: id_materi
 		}, function(data) {
 			$("[name='id_materi']").val(data);
 			masuk(data);
 		});

 	}

 	function getBahanAjar(idjadwal) {
 		$("#defaultModalLabel").html("Bahan Ajar");
 		var id_jadwal = "<?php echo $id_jadwal; ?>";
 		var id_mapel = "<?php echo $id_mapel; ?>";
 		var id_kelas = "<?php echo $id_kelas; ?>";
 		blok();
 		$("#mdl_modal_history").modal("show");
 		$.post("<?php echo site_url("kbm/getBahanAjar"); ?>", {
 			id_kelas: id_kelas,
 			id_mapel: id_mapel,
 			id_jadwal: id_jadwal
 		}, function(data) {
 			$("#viewH").html(data);
 			unblock();
 		});
 	}

 	function history_mengajar() {
 		$("#defaultModalLabel").html("History Mengajar");
 		var id_jadwal = "<?php echo $id_jadwal; ?>";
 		var id_mapel = "<?php echo $id_mapel; ?>";
 		var id_kelas = "<?php echo $id_kelas; ?>";
 		blok();
 		$("#mdl_modal_history").modal("show");
 		$.post("<?php echo site_url("kbm/getHistory"); ?>", {
 			id_kelas: id_kelas,
 			id_mapel: id_mapel,
 			id_jadwal: id_jadwal
 		}, function(data) {
 			$("#viewH").html(data);
 			unblock();
 		});
 	}

 	function ready() {
 		var kikd = $("[name='kikd']").val();
 		if (!kikd) {
 			notif("SIlahkan pilih KIKD");
 			return false;
 		}

 		var id_materi = $("[name='id_materi']").val();
 		var id_jadwal = "<?php echo $id_jadwal; ?>";
 		var cat = '<?php echo $cpembelajaran; ?>';
 		if (id_materi != "create") {

 			blok("area_load");
 			$.post("<?php echo site_url("kbm/getMenuKbm"); ?>", {
 				id_jadwal: id_jadwal,
 				id_materi: id_materi,
 				idkelas: <?php echo $id_kelas ?>,
 				cat: cat
 			}, function(data) {
 				$("#menu").html(data);
 				unblock("area_load");
 				//	  masuk(id_materi);
 			});
 		} else {
 			//	$("#menu").hide();
 			var idkikd = $("[name='kikd']").val();
 			if (idkikd != null) {
 				inputMateri();
 				$("[name='id_materi']").val(0);
 			}
 		}
 	}

 	function masuk(id_materi) {
 		var kikd = $("[name='kikd']").val();
 		var mapel = "<?php echo $id_mapel; ?>";
 		var jam = "<?php echo $data_jam ?>";
 		var jam_blok = "<?php echo $jam_blok ?>";
 		var id_jadwal = "<?php echo $id_jadwal ?>";
 		var materi = $("[name='materi']").val();
 		$.post("<?php echo site_url("kbm/guruMasuk"); ?>", {
 			materi: materi,
 			id_mapel: mapel,
 			id_kikd: kikd,
 			id_materi: id_materi,
 			id_kelas: <?php echo $id_kelas ?>,
 			jam: jam,
 			jam_blok: jam_blok,
 			id_jadwal: id_jadwal
 		}, function(data) {
 			$("#menu").show();
 			ready();
 		});
 	}
 </script>
 <script>
 	function catt() {
 		var id_jadwal = "<?php echo $id_jadwal ?>";
 		var catt = $("[name='catatan']").val();
 		$.post("<?php echo site_url("kbm/insertCatatan"); ?>", {
 			catt: catt,
 			id_jadwal: id_jadwal
 		}, function(data) {
 			alertify.set('notifier', 'position', 'bottom-right');
 			alertify.warning("<b  > <i class='material-icons'>done_all</i> <span style='margin-top:2px;position:absolute'> &nbsp;Tersimpan !!</span></b>");
 			$('html,body').animate({
 				scrollTop: 0
 			}, 'slow');
 		});
 	}

 	function absenSiswaReady(idkelas, idjadwal) {

 		loadkonten();
 		$.post("<?php echo site_url("kbm/getDataSiswa"); ?>", {
 			idkelas: idkelas,
 			idjadwal: idjadwal
 		}, function(data) {
 			$("#view").html(data);
 			// unblock();
 			unloadkonten();
 			$('html,body').animate({
 				scrollTop: 0
 			}, 'slow');
 		});
 	}

 	function inputMateri() {
 		$("#mdl_add_materi").modal("show");
 		var id = $("[name='kikd']").val();
 		$("[name='id_kikd_add']").val(id);
 	}

 	function getjadwalBentrok(id) {
 		$.post("<?php echo site_url("kbm/getjadwalBentrok"); ?>", {
 			id: id
 		}, function(data) {
 			$("#mdl_modal_bentrok").modal("show");
 			$("#viewBentrok").html(data);
 			unloadkonten();
 		});
 	}
 </script>

 <div class="modal fade" id="mdl_modal_bentrok" tabindex="-1" role="dialog">
 	<div class="modal-dialog" id="area_mdl_modal" role="document">
 		<div class="modal-content modal-mini modal-sx"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
 			<div class="modal-header">
 				<h4 class="modal-title col-teal" id="defaultModalLabel"> TERDAPAT JADWAL BENTROK</h4>

 			</div>
 			<div class="modal-body">

 				<div id="viewBentrok"></div>

 			</div>
 		</div>

 	</div>
 </div><!-- /.modal-dialog -->






 <div class="modal fade" id="mdl_modal_history" tabindex="-1" role="dialog">
 	<div class="modal-dialog" id="area_mdl_modal" role="document">


 		<div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
 			<div class="modal-header">
 				<h4 class="modal-title col-teal" id="defaultModalLabel">History mengajar minggu lalu </h4>

 			</div>
 			<div class="modal-body">

 				<div id="viewH"></div>

 			</div>
 		</div>

 	</div>

 </div><!-- /.modal-dialog -->




 <div class="modal fade" id="mdl_modal" tabindex="-1" role="dialog">
 	<div class="modal-dialog modal-lg" id="area_mdl_modal" role="document">

 		<form action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="" method="post" enctype="multipart/form-data">
 			<div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
 				<div class="modal-header">
 					<h4 class="modal-title col-teal" id="defaultModalLabel">Absen siswa kelas <?php echo $kelas; ?> <span class="titles"></span> </h4>

 				</div>
 				<div class="modal-body">

 					<div id="data_siswa"></div>



 					<div class="modal-footer">
 						<span id="msg" class='pull-left'></span>
 						<div class="btn-group" role="group" aria-label="Default button group">

 							<button title="tutup" data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
 							<button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel')"><i class="material-icons">save</i> SIMPAN</button>
 						</div>

 					</div>

 				</div>
 			</div>


 	</div>
 	</form>
 </div><!-- /.modal-dialog -->







 <script>
 	function kirimCatatan(id_siswa, id_kelas, desc_nama) {
 		$("#mdl_modal_catatan").modal();
 		$("#desc_id_siswa").val(id_siswa);
 		$("#desc_id_kelas").val(id_kelas);
 		$("#desc_catatan").val("");
 		$(".desc_nama").html(desc_nama);
 	}
 </script>



 <div class="modal fade" id="mdl_modal_catatan" tabindex="-1" role="dialog">
 	<div class="modal-dialog" id="area_modal_artikel" role="document">

 		<form action="javascript:submitForm('modal_catatan')" id="modal_catatan" url="<?php echo base_url() ?>kbm/kirim_catatan" method="post" enctype="multipart/form-data">
 			<div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
 				<div class="modal-header">
 					<h4 class="modal-title col-teal" id="defaultModalLabel">Laporkan <span class='col-pink desc_nama'></span></h4>

 				</div>
 				<div class="modal-body">
 					<div class="row clearfix">

 						<div class="col-lg-12 col-md-12 col-xs-12 ">
 							<div class="form-groups">
 								<div class="form-line">
 									<textarea class="form-control" required name="f[ket]"></textarea>
 								</div>
 							</div>
 						</div>
 					</div><br>

 					<div class="row clearfix">
 						<div class="col-lg-3 col-md-3 col-xs-12 form-control-label">
 							<label for="email_address_2" class="col-black pull-left">Teruskan Ke </label>
 						</div>
 						<div class="col-lg-8 col-md-8  ">

 							<div class="form-group">
 								<div class="form-line">

 									<input id="md_checkbox_22" class="filled-in chk-col-red" checked="" disabled="" type="checkbox">
 									<label for="md_checkbox_22" class='col-black'>Wali kelas&nbsp;&nbsp;&nbsp;</label>
 									<input id="md_checkbox_23" class="filled-in chk-col-red" name='t[]' value='2' type="checkbox">
 									<label for="md_checkbox_23" class='col-black'>Orang Tua&nbsp;&nbsp;&nbsp;</label>
 									<input id="md_checkbox_24" class="filled-in chk-col-red" name='t[]' value='3' type="checkbox">
 									<label for="md_checkbox_24" class='col-black'>Siswa&nbsp;&nbsp;&nbsp;</label>

 								</div>
 							</div>
 						</div>
 					</div>
 					<input type='hidden' name='f[id_siswa]' id='desc_id_siswa'>
 					<input type='hidden' name='f[id_kelas]' id='desc_id_kelas'>

 					<div class="modal-footer">
 						<span id="msg" class='pull-left'></span>
 						<div class="btn-group" role="group" aria-label="Default button group">

 							<button title="tutup" data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
 							<button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_catatan')"><i class="material-icons">save</i> SIMPAN</button>
 						</div>

 					</div>

 				</div>
 			</div>


 	</div>
 	</form>
 </div><!-- /.modal-dialog -->