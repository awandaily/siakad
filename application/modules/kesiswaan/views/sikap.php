 <?php
	$dbs = $this->db->query("select * from v_jadwal where id_guru='" . $this->mdl->idu() . "' and ids='1' ")->num_rows();
	if (!$dbs) {
		echo "<div class='card'>
<h4 style='padding:10px'>   Tidak ada mapel yang mewajibkan penginputan nilai sikap.  </h4>
</div>";
		return true;
	} ?>
 <!-- breadcrumb -->
 <div class="breadcrumb-header justify-content-between">
 	<div>
 		<h4 class="content-title mb-2">Hi, Ini Nilai Sikap </h4>
 		<nav aria-label="breadcrumb">
 			<ol class="breadcrumb">
 				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
 				<li class="breadcrumb-item active" aria-current="page"> Nilai Sikap</li>
 			</ol>
 		</nav>
 	</div>
 	<div class="d-flex my-auto">
 		<div class=" d-flex right-page">
 			<div class="d-flex justify-content-center mr-5">
 				<div class="">
 					<span class="d-block">
 						<span class="label ">Indeks Sikap </span>
 					</span>
 					<span class="value">
 						Kosong
 					</span>
 				</div>

 			</div>
 			<div class="d-flex justify-content-center">
 				<div class="">
 					<span class="d-block">
 						<span class="label">Jumlah Murid</span>
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


 <!-- Task Info -->
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 	<div class="card">
 		<div class="header row">
 			<div class="col-md-2" style="padding-bottom:15px">
 				<h2 style='font-size:16px'>Input Nilai Sikap</h2>
 			</div>
 			<div class="col-md-10">
 				<select id="idkelas" name="idkelas" class="form-control show-tick " onchange="getNilai()">
 					<option value="">=== Pilih Kelas / Mapel ===</option>


 					<?php
						$db = $this->mdl->mapelAjarSikap();
						foreach ($db as $val) {

							$idsikap = $this->m_reff->goField("tr_mapel", "id_sikap", "WHERE id='" . $val->id_mapel . "' ");

							if ($idsikap == "1") {
								echo "<option value='" . $val->id . "'>Kelas :" . strtolower($val->kelas) . " || Mapel :" . strtolower($val->mapel) . "</option>";
							}
						}
						?>

 				</select>
 			</div>
 			<!--	<div class="col-md-5"  >
                                        
								 
									 $sms=$this->m_reff->semester();
									$ray[1]="Semester Ganjil";
									$ray[2]="Semester Genap";
								//	$ray[3]="Satukan Nilai";
									$dataray=$ray;
									echo form_dropdown("sms",$dataray,$sms,"class='form-control' onchange='getNilai()' ");?>
                            </div>  -->




 		</div>

 		<!----->
 		<div class="card" id="load">
 			<div class="body">
 				<div class="table-responsive">
 					<div id="data_nilai">
 						<center><i>Pilih kelas terlebih dahulu</i></center>
 					</div>
 				</div>
 			</div>
 		</div>
 		<!----->

 	</div>
 </div>
 <!-- #END# Task Info -->
 <script>
 	function getNilai() {
 		var kelas = $("[name='idkelas']").val();
 		var sms = $("[name='sms']").val();
 		loading("load");
 		$.post("<?php echo site_url("kesiswaan/getSikap"); ?>", {
 			kelas: kelas,
 			sms: sms
 		}, function(data) {
 			$("#data_nilai").html(data);
 			unblock("load");
 		});
 	}
 </script>

 <script>
 	$('select').selectpicker();
 </script>