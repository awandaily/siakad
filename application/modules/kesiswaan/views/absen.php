 					<!-- breadcrumb -->
 					<div class="breadcrumb-header justify-content-between">
 						<div>
 							<h4 class="content-title mb-2">Rekapitulasi Absen </h4>
 							<nav aria-label="breadcrumb">
 								<ol class="breadcrumb">
 									<li class="breadcrumb-item"><a href="#"></a></li>
 									<li ></li>
 								</ol>
 							</nav>
 						</div>
					 	<div class="d-flex my-auto">
		<div class=" d-flex right-page">
			<div class="d-flex justify-content-center mr-5">
				<div class="">
					<span class="d-block">
						<span class="label "></span>
					</span>
					
					<select id="idkelas" name="idkelas" class="text-white border-white btn btn-outline-indigo btn-rounded btn-block form-control show-tick " onchange="getNilai()">
 										<option value="">=== Pilih Kelas / Mapel ===</option>
 										<?php
											$db = $this->mdl->mapelAjar();
											foreach ($db as $val) {
												echo "<option value='" . $val->id . "'>Kelas :" . strtolower($val->kelas) . " || Mapel :" . strtolower($val->mapel) . "</option>";
											}
											?>

 									</select>
					
				</div>

			</div>
			<div class="d-flex justify-content-center">
				<div class="">
					<span class="d-block">
						<span class="label"></span>
					</span>
					<span class="value">
          <button onclick="" class="text-white border-white btn btn-outline-indigo btn-rounded btn-block"> Download Excel</button>
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
 								<!-- <div class="col-md-3 col-teal" style="padding-bottom:15px">
 									<h2 class='col-teal' style='font-size:16px'>Rekapitulasi Absen</h2>
 								</div>
 								<div class="col-md-9">
 									<select id="idkelas" name="idkelas" class="form-control show-tick " onchange="getNilai()">
 										<option value="">=== Pilih Kelas / Mapel ===</option>
 										<?php
											$db = $this->mdl->mapelAjar();
											foreach ($db as $val) {
												echo "<option value='" . $val->id . "'>Kelas :" . strtolower($val->kelas) . " || Mapel :" . strtolower($val->mapel) . "</option>";
											}
											?>

 									</select>
 								</div>
 								<!--	<div class="col-md-4"   >
                                        
								 
									 $sms=$this->m_reff->semester();
									$ray[1]="Semester Ganjil";
									$ray[2]="Semester Genap";
								//	$ray[3]="Satukan Nilai";
									$dataray=$ray;
									echo form_dropdown("sms",$dataray,$sms,"class='form-control' onchange='getNilai()' ");?>
                            </div> -->




 							</div>

 							<!----->
 							<div class="card" id="load">
 								<div class="body">
 									<div class="table-responsive">
 										<div id="data_nilai">
 											<center><i>Pilih Kelas</i></center>
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
 							$.post("<?php echo site_url("kesiswaan/getAbsen"); ?>", {
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