    <div class=" ">
    	<br>

    	<div class="col-md-12">

    		<div class="col-md-4">
    			<b>Gelar Depan</b>
    			<div class="input-group">

    				<div class="form-line">
    					<input class="form-control" placeholder="Gelar depan" value="<?php echo $data->gelar_depan; ?>" name="f[gelar_depan]" type="text">
    				</div>
    			</div>
    		</div>

    		<div class="col-md-4">
    			<b>Nama Lengkap</b>
    			<div class="input-group">

    				<div class="form-line">
    					<input class="form-control" required value="<?php echo $data->nama; ?>" placeholder="Nama lengkap" name="f[nama]" type="text">
    				</div>
    			</div>
    		</div>

    		<div class="col-md-4">
    			<b>Gelar Belakang</b>
    			<div class="input-group">

    				<div class="form-line">
    					<input class="form-control" placeholder="Gelar belakang" value="<?php echo $data->gelar_belakang; ?>" name="f[gelar_belakang]" type="text">
    				</div>
    			</div>
    		</div>

    		<div class="col-md-4">
    			<b>NIP</b>
    			<div class="input-group">
    				<span class="input-group-addon">
    					<i class="material-icons">credit_card</i>
    				</span>
    				<div class="form-line">
    					<input data-placement="top" name="f[nip_asli]" value="<?php echo $data->nip_asli; ?>" class="form-control" required placeholder="Nomor NIP" type="text">
    				</div>
    			</div>
    		</div>

    		<div class="col-md-4">
    			<b>NUPTK</b>
    			<div class="input-group">
    				<span class="input-group-addon">
    					<i class="material-icons">credit_card</i>
    				</span>
    				<div class="form-line">
    					<input class="form-control" value="<?php echo $data->nuptk; ?>" placeholder="Nomor NUPTK" name="f[nuptk]" type="text">
    				</div>
    			</div>
    		</div>

    		<div class="col-md-4">
    			<b>Nomor HP</b>
    			<div class="input-group">
    				<span class="input-group-addon">
    					<i class="material-icons">phone_iphone</i>
    				</span>
    				<div class="form-line">
    					<input class="form-control" value="<?php echo $data->hp; ?>" onkeydown="return nomor(this, event);" required placeholder="Nomor Hp" name="hp" type="text">
    				</div>
    			</div>
    		</div>

    		<div class="col-md-4">
    			<b>E-mail</b>
    			<div class="input-group">
    				<span class="input-group-addon">
    					<i class="material-icons">email</i>
    				</span>
    				<div class="form-line">
    					<input class="form-control" value="<?php echo $data->email; ?>" placeholder="email" name="f[email]" type="email">
    				</div>
    			</div>
    		</div>

    		<div class="col-md-4">
    			<b>Alamat</b>
    			<div class="input-group">
    				<span class="input-group-addon">
    					<i class="material-icons">home</i>
    				</span>
    				<div class="form-line">
    					<input class="form-control" value="<?php echo $data->alamat; ?>" placeholder="Alamat" name="f[alamat]" type="text">
    				</div>
    			</div>
    		</div>

    		<div class="col-md-4">

    			<b>TMT</b>
    			<div class="input-group">
    				<span class="input-group-addon">
    					<i class="material-icons">date_range</i>
    				</span>
    				<div class="form-line">
    					<input class="form-control tmt" value="<?php echo $this->tanggal->ind($data->tmt, "/"); ?>" placeholder="contoh: 30/07/2016" name="tmt" type="text">
    				</div>
    			</div>

    		</div>



    		<div class="col-md-4">
    			<div class="form-group form-float">
    				<b> Jenis Kelamin </b>
    				<?php
					$dataray[] = "=== Pilih ===";
					$dataray["l"] = "Laki-laki";
					$dataray["p"] = "Perempuan";
					echo form_dropdown("f[jk]", $dataray, strtolower($data->jk), 'class="selectpicker show-tick" required');
					?>
    			</div>

    		</div>

    		<div class="col-md-4">
    			<div class="form-group form-float">
    				<b> Status Kepegawaian</b>
    				<?php
					$dataray = array();
					$dataray[] = "=== Pilih ===";
					$db = $this->db->get("tr_sts_pegawai")->result();
					foreach ($db as $db) {
						$dataray[$db->id] = $db->nama;
					}
					echo form_dropdown("f[sts_kepegawaian]", $dataray, $data->sts_kepegawaian, 'class="selectpicker show-tick"');
					?>
    			</div>

    		</div>





    		<div class="col-md-4">
    			<div class="form-group form-float">
    				<b> Ijazah</b>


    				<?php
					$dataray = array();
					$dataray[] = "=== Pilih ===";
					$db = $this->db->get("tr_ijazah")->result();
					foreach ($db as $db) {
						$dataray[$db->id] = $db->nama;
					}
					echo form_dropdown("f[id_ijazah]", $dataray, $data->id_ijazah, 'class="selectpicker show-tick"  ');
					?>
    			</div>
    		</div>


    		<div class="col-md-4">

    			<b>Tempat Lahir</b>

    			<div class="input-group">
    				<span class="input-group-addon">
    					<i class="material-icons">home</i>
    				</span>
    				<div class="form-line">
    					<input class="form-control" value="<?php echo $data->tempat_lahir; ?>" placeholder="Tempat lahir" name="f[tempat_lahir]" type="teks">
    				</div>
    			</div>

    		</div>
    		<div class="col-md-4">

    			<b>Tanggal Lahir</b>
    			<div class="input-group">
    				<span class="input-group-addon">
    					<i class="material-icons">date_range</i>
    				</span>
    				<div class="form-line">
    					<input class="form-control tmt" value="<?php echo $this->tanggal->ind($data->tgl_lahir, "/"); ?>" placeholder="contoh:30/01/1995" name="tgl_lahir" type="teks">
    				</div>
    			</div>

    		</div>


    		<div class="col-md-4">

    			<b>Jabatan</b>
    			<div class="input-group">
    				<span class="input-group-addon">
    					<i class="material-icons">date_range</i>
    				</span>
    				<div class="form-line">
    					<?php
						$dataray = array();
						$dataray[] = "=== Pilih ===";
						$db = $this->db->get("tr_jabatan")->result();
						foreach ($db as $db) {
							$dataray[$db->id] = $db->nama;
						}
						echo form_dropdown("f[id_jabatan]", $dataray, $data->id_jabatan, 'id="id_jabatan" class="selectpicker show-tick" onchange="PilihJabatan()" ');
						?>
    				</div>
    			</div>

    		</div>

    		<div class="col-md-12">

    			<div class="col-md-4">

    				<b>Sertifikasi Pendidik</b>
    				<div class="input-group">
    					<span class="input-group-addon">
    						<i class="material-icons">school</i>
    					</span>
    					<div class="form-line">
    						<?php

							$dataray = array();
							$dataray["ya"] = "YA";
							$dataray["tidak"] = "TIDAK";

							echo form_dropdown("f[sertifikasi]", $dataray, $data->sertifikasi, 'id="sertifikasi" class="selectpicker show-tick"  ');
							?>
    					</div>
    				</div>

    			</div>




    			<div class="col-md-4">
    				<b>Username</b>
    				<div class="input-group">
    					<span class="input-group-addon">
    						<i class="material-icons">verified_user</i>
    					</span>
    					<div class="form-line">

    						<input type="text" name="f[username]" value="<?php echo $data->username; ?>">
    					</div>
    				</div>
    			</div>

    			<div class="col-md-4">
    				<b>Password</b>
    				<div class="input-group">
    					<span class="input-group-addon">
    						<i class="material-icons">vpn_key</i>
    					</span>
    					<div class="form-line">
    						<?php $pass = substr($data->alias, 2); ?>
    						<input type="text" name="password" value="<?php echo substr($pass, 0, -2); ?>">
    					</div>
    				</div>
    			</div>


    		</div>



    		<div class="row clearfix"></div>
    		<div class="col-md-12">
    			<center> <b>HAK AKSES<b><br>
    						<div class="demo-checkbox">
    							<?php
								$multi = $data->multiakun;
								if (strpos($multi, "1") === false) {
								?>
    								<input id="basic_checkbox_11" name="n[]" class="filled-in" type="checkbox" value="1">
    								<label for="basic_checkbox_11" style='text-align:left'>KURIKULUM</label>
    							<?php
								} else {
								?>
    								<input id="basic_checkbox_11" name="n[]" class="filled-in" checked="checked" type="checkbox" value="1">
    								<label for="basic_checkbox_11" style='text-align:left'>KURIKULUM</label>
    							<?php
								}
								?>


    							<?php
								$multi = $data->multiakun;
								if (strpos($multi, "2") === false) {
								?>
    								<input id="basic_checkbox_22" name="n[]" class="filled-in" type="checkbox" value="2">
    								<label for="basic_checkbox_22" style='text-align:left'>KESISWAAN</label>
    							<?php
								} else {
								?>
    								<input id="basic_checkbox_22" name="n[]" class="filled-in" checked="checked" type="checkbox" value="2">
    								<label for="basic_checkbox_22" style='text-align:left'>KESISWAAN</label>
    							<?php
								}
								?>

    							<?php
								$multi = $data->multiakun;
								if (strpos($multi, "3") === false) {
								?>
    								<input id="basic_checkbox_33" name="n[]" class="filled-in" type="checkbox" value="3">
    								<label for="basic_checkbox_33" style='text-align:left'>BPBK</label>
    							<?php
								} else {
								?>
    								<input id="basic_checkbox_33" name="n[]" class="filled-in" checked="checked" type="checkbox" value="3">
    								<label for="basic_checkbox_33" style='text-align:left'>BPBK</label>
    							<?php
								}
								?>

    							<?php
								$multi = $data->multiakun;
								if (strpos($multi, "4") === false) {
								?>
    								<input id="basic_checkbox_44" name="n[]" class="filled-in" type="checkbox" value="4">
    								<label for="basic_checkbox_44" style='text-align:left'>HUMAS</label>
    							<?php
								} else {
								?>
    								<input id="basic_checkbox_44" name="n[]" class="filled-in" checked="checked" type="checkbox" value="4">
    								<label for="basic_checkbox_44" style='text-align:left'>HUMAS</label>
    							<?php
								}
								?>

    							<br>
    							<?php
								$multi = $data->multiakun;
								if (strpos($multi, "5") === false) {
								?>
    								<input id="basic_checkbox_55" name="n[]" class="filled-in" type="checkbox" value="5">
    								<label for="basic_checkbox_55" style='text-align:left'>PRODI</label>
    							<?php
								} else {
								?>
    								<input id="basic_checkbox_55" name="n[]" class="filled-in" checked="checked" type="checkbox" value="5">
    								<label for="basic_checkbox_55" style='text-align:left'>PRODI</label>
    							<?php
								}
								?>
    							<span id="basic_checkbox_66_">
    								<?php
									$multi = $data->multiakun;
									if (strpos($multi, "6") === false) {
									?>
    									<input id="basic_checkbox_66" name="n[]" class="filled-in" type="checkbox" value="6">
    									<label for="basic_checkbox_66" style='text-align:left'>MENGAJAR</label>
    								<?php
									} else {
									?>
    									<input id="basic_checkbox_66" name="n[]" class="filled-in" checked="checked" type="checkbox" value="6">
    									<label for="basic_checkbox_66" style='text-align:left'>MENGAJAR</label>
    								<?php
									}
									?>
    							</span>


    							<span id="basic_checkbox_77_">
    								<?php
									$multi = $data->multiakun;
									if (strpos($multi, "7") === false) {
									?>
    									<input id="basic_checkbox_77" name="n[]" class="filled-in" type="checkbox" value="7">
    									<label for="basic_checkbox_77" style='text-align:left'>M.MUTU</label>
    								<?php
									} else {
									?>
    									<input id="basic_checkbox_77" name="n[]" class="filled-in" checked="checked" type="checkbox" value="7">
    									<label for="basic_checkbox_77" style='text-align:left'>M.MUTU</label>
    								<?php
									}
									?>
    							</span>



    							<span id="basic_checkbox_88_">
    								<?php
									$multi = $data->multiakun;
									if (strpos($multi, "8") === false) {
									?>
    									<input id="basic_checkbox_88" name="n[]" class="filled-in" type="checkbox" value="8">
    									<label for="basic_checkbox_88" style='text-align:left'>SDM</label>
    								<?php
									} else {
									?>
    									<input id="basic_checkbox_88" name="n[]" class="filled-in" checked="checked" type="checkbox" value="8">
    									<label for="basic_checkbox_88" style='text-align:left'>SDM</label>
    								<?php
									}
									?>
    							</span>


    							<span id="basic_checkbox_99_">
    								<?php
									$multi = $data->multiakun;
									if (strpos($multi, "9") === false) {
									?>
    									<input id="basic_checkbox_99" name="n[]" class="filled-in" type="checkbox" value="9">
    									<label for="basic_checkbox_99" style='text-align:left'>SARPRAS</label>
    								<?php
									} else {
									?>
    									<input id="basic_checkbox_99" name="n[]" class="filled-in" checked="checked" type="checkbox" value="9">
    									<label for="basic_checkbox_99" style='text-align:left'>SARPRAS</label>
    								<?php
									}
									?>
    							</span>



    							<script>
    								PilihJabatan();

    								function PilihJabatan() {
    									var jab = $("#id_jabatan").val();

    									if (jab == 3) {
    										$("#basic_checkbox_66_").hide();
    									} else {
    										$("#basic_checkbox_66_").show();
    									}

    								}
    							</script>

    						</div>
    			</center>
    		</div>


    		<div class="row clearfix"></div>

    		<div class="row clearfix col-md-9">
    			<div class="col-lg-4 col-md-4  form-control-label">
    				<label for="email_address_2" class="col-black">UPLOAD FOTO</label>
    			</div>
    			<div class="col-lg-8 col-md-8  ">
    				<div class="form-group">
    					<div class="form-line">
    						<input class="form-control" name="file" type="file">
    					</div>
    				</div>
    			</div>
    		</div>

    		<div class="col-md-3">

    			<button onclick="submitForm('formSubmit_edit')" class="btn-block pull-right waves-effect btn bg-teal"><i class="material-icons">save</i> SIMPAN</button>
    		</div>

    	</div>


    </div>
    <input type="hidden" name="id" value="<?php echo $data->id; ?>">
    <input type="hidden" name="before_file" value="<?php echo $data->poto; ?>">

    <script>
    	$('[data-toggle="tooltip"]').tooltip({
    		container: 'body'
    	});
    	$('select').selectpicker();
    	$(".tmt").inputmask("99/99/9999");
    </script>