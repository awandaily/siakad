  <ul class="nav nav-tabs" role="tablist">

  	<li role="presentation" class="active sound">

  		<a href="#PROFILE1" data-toggle="tab">

  			<i class="material-icons">face</i> PROFILE

  		</a>

  	</li>

  	<li role="presentation" class="sound">

  		<a href="#profile_with_icon_title1" data-toggle="tab">

  			<i class="material-icons">account_balance</i> RIWAYAT PENDIDIKAN

  		</a>

  	</li>

  	<li class="sound" role="presentation">

  		<a href="#messages_with_icon_title1" data-toggle="tab">

  			<i class="material-icons">supervised_user_circle</i> ORANG TUA / WALI MURID

  		</a>

  	</li>

  	<li class="sound" role="presentation">

  		<a href="#settings_with_icon_title1" data-toggle="tab">

  			<i class="material-icons">weekend</i> PENETAPAN KELAS

  		</a>

  	</li>
  	<li class="sound" role="presentation">

  		<a href="#akuntable" data-toggle="tab">

  			<i class="material-icons">vpn_key</i> AKUN

  		</a>

  	</li>

  </ul>

  <!-- Tab panes -->

  <div class="tab-content">

  	<div role="tabpanel" class="tab-pane  animated flipInX  active" id="PROFILE1">



  		<p>


  		<div class="col-md-4">

  			<b>NAMA LENGKAP</b>

  			<div class="input-group">



  				<div class="form-line">

  					<input required class="form-control" placeholder="Nama Lengkap" value="<?php echo $data->nama; ?>" name="f[nama]" type="text">

  				</div>

  			</div>

  		</div>



  		<div class="col-md-4" data-placement="top">

  			<b>NIS</b>

  			<div class="input-group">



  				<div class="form-line">

  					<input name='f[nis]' value="<?php echo $data->nis; ?>" onkeydown="return nomor(this, event);" class="  form-control" placeholder="Nomor NIS" type="text">

  					<input type="hidden" name="id_siswa" value="<?php echo $data->id; ?>">

  				</div>

  			</div>

  		</div>



  		<div class="col-md-4">

  			<b>NISN</b>

  			<div class="input-group">



  				<div class="form-line">

  					<input name='f[nisn]' value="<?php echo $data->nisn; ?>" onkeydown="return nomor(this, event);" class="  form-control" placeholder="Nomor NISN" type="text">



  				</div>

  			</div>

  		</div>



  		<div class="col-md-6">

  			<b>NIK</b>

  			<div class="input-group">



  				<div class="form-line">

  					<input name='f[nik]' value="<?php echo $data->nik; ?>" onkeydown="return nomor(this, event);" class="  form-control" placeholder="Nomor NIK" type="text">



  				</div>

  			</div>

  		</div>



  		<div class="col-md-6">

  			<b>GENDER</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">supervisor_account</i>

  				</span>

  				<div class="form-line">



  					<?php

						$sts = $this->db->get("tr_jk")->result();
						$ray = array();
						$ray[""] = "=== Pilih ===";

						foreach ($sts as $val) {

							$ray[$val->id] = $val->nama;
						}

						echo form_dropdown("f[jk]", $ray, strtolower($data->jk), 'class="col-md-12 selectpicker show-tick" ');

						?>





  				</div>

  			</div>

  		</div>

  		<div class="row clearfix">&nbsp;</div>

  		<div class="col-md-4">

  			<b>AGAMA</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">local_library</i>

  				</span>

  				<div class="form-line">

  					<?php

						$sts = $this->db->get("tr_agama")->result();
						$ray = array();
						$ray[""] = "=== Pilih ===";

						foreach ($sts as $val) {

							$ray[$val->id] = $val->nama;
						}

						echo form_dropdown("f[id_agama]", $ray, $data->id_agama, 'class="col-md-12 selectpicker show-tick" ');

						?>

  				</div>

  			</div>

  		</div>



  		<div class="col-md-4">

  			<b>NOMOR HP</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">phone_iphone</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control" value="<?php echo $data->hp; ?>" onkeydown="return nomor(this, event);" placeholder="Nomor Hp" name="f[hp]" type="text">

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



  			<b>TEMPAT LAHIR</b>



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



  			<b>TANGGAL LAHIR</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">date_range</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control tmt" value="<?php echo $this->tanggal->ind($data->tgl_lahir, "/"); ?>" placeholder="contoh: 30/07/2016" name="tgl_lahir" type="text">

  				</div>

  			</div>



  		</div>





  		<div class="col-md-4">

  			<b>Photo</b>

  			<div class="input-group">



  				<div class="form-line">

  					<input class="form-control" name="file" type="file">

  				</div>

  			</div>

  		</div>

  		<div class="col-md-12">

  			<b>ALAMAT</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">home</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control" value="<?php echo $data->alamat; ?>" placeholder="Alamat" name="f[alamat]" type="text">

  				</div>

  			</div>

  		</div>











  		<div class="row clearfix"></div>










  		</p>

  	</div>

  	<div role="tabpanel" class="tab-pane  animated flipInX" id="profile_with_icon_title1">



  		<p>

  		<div class="col-md-6">

  			<b>ASAL SD</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">school</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control" value="<?php echo $data->asal_sd; ?>" placeholder="Asal SD" name="f[asal_sd]" type="text">

  				</div>

  			</div>

  		</div>



  		<div class="col-md-6">

  			<b>TAHUN LULUS SD</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">date_range</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control thn" value="<?php echo $data->tahun_lulus_sd; ?>" placeholder="contoh : 2005/2006" name="f[tahun_lulus_sd]" type="text">

  				</div>

  			</div>

  		</div>

  		<div class="row clearfix">&nbsp;</div>

  		<div class="col-md-6">

  			<b>ASAL SMP</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">school</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control " value="<?php echo $data->asal_smp; ?>" placeholder="Asal SMP" name="f[asal_smp]" type="text">

  				</div>

  			</div>

  		</div>

  		<div class="col-md-6">

  			<b>TAHUN LULUS SMP</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">date_range</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control thn" value="<?php echo $data->tahun_lulus_smp; ?>" placeholder="contoh : 2005/2006" name="f[tahun_lulus_smp]" type="text">

  				</div>

  			</div>

  		</div>



  		</p>

  	</div>

  	<div role="tabpanel" class="tab-pane  animated flipInX" id="messages_with_icon_title1">

  		<p>


  		<div class="col-md-4">

  			<b>NAMA AYAH</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">school</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control" value="<?php echo $data->nama_ayah; ?>" placeholder="Nama Ayah" name="g[nama_ayah]" type="text">

  				</div>

  			</div>

  		</div>



  		<div class="col-md-4">

  			<b>NO.HP AYAH</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">date_range</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control " value="<?php echo $data->hp_ayah; ?>" onkeydown="return nomor(this, event);" placeholder="Nomor Hp ayah" name="g[hp_ayah]" type="text">

  				</div>

  			</div>

  		</div>

  		<div class="col-md-4">

  			<b>PEKERJAAN AYAH</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">work</i>

  				</span>

  				<div class="form-line">





  					<?php

						$sts = $this->db->get("tr_pekerjaan")->result();
						$ray = array();
						$ray[""] = "=== Pilih ===";

						foreach ($sts as $val) {

							$ray[$val->id] = $val->nama;
						}

						echo form_dropdown("g[id_pekerjaan_ayah]", $ray, $data->id_pekerjaan_ayah, 'class="col-md-12 selectpicker show-tick" ');

						?>

  				</div>

  			</div>

  		</div>



  		<div class="row clearfix">&nbsp;</div>

  		<div class="col-md-4">

  			<b>NAMA IBU</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">school</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control" value="<?php echo $data->nama_ibu; ?>" placeholder="Nama ibu" name="g[nama_ibu]" type="text">

  				</div>

  			</div>

  		</div>

  		<div class="col-md-4">

  			<b>NO.HP IBU</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">date_range</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control" value="<?php echo $data->hp_ibu; ?>" onkeydown="return nomor(this, event);" placeholder="Nomor Hp ibu" name="g[hp_ibu]" type="text">

  				</div>

  			</div>

  		</div>

  		<div class="col-md-4">

  			<b>PEKERJAAN IBU</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">work</i>

  				</span>

  				<div class="form-line">

  					<?php

						$sts = $this->db->get("tr_pekerjaan")->result();
						$ray = array();
						$ray[""] = "=== Pilih ===";

						foreach ($sts as $val) {

							$ray[$val->id] = $val->nama;
						}

						echo form_dropdown("g[id_pekerjaan_ibu]", $ray, $data->id_pekerjaan_ibu, 'class="col-md-12 selectpicker show-tick" ');

						?>

  				</div>

  			</div>

  		</div>

  		<div class="row clearfix">&nbsp;</div>




  		<div class="col-md-6">

  			<b>PENGHASILAN KELUARGA</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">attach_money</i>

  				</span>

  				<div class="form-line">

  					<?php

						$sts = $this->db->get("tr_penghasilan")->result();
						$ray = array();
						$ray[""] = "=== Pilih ===";

						foreach ($sts as $val) {

							$ray[$val->id] = $val->nama;
						}

						echo form_dropdown("g[id_penghasilan]", $ray, $data->id_penghasilan, 'class="col-md-12 selectpicker show-tick" ');

						?>

  				</div>

  			</div>

  		</div>



  		<div class="col-md-6">

  			<b>ALAMAT ORANG TUA</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">home</i>

  				</span>

  				<div class="form-line">

  					<input class="form-control" value="<?php echo $data->alamat_ortu; ?>" placeholder="Alamat" name="g[alamat_ortu]" type="text">

  				</div>

  			</div>

  		</div>

  		<div class="row clearfix">&nbsp;</div>




  		<div class="col-md-6">

  			<b>STATUS AYAH</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">accessible</i>

  				</span>

  				<div class="form-line">

  					<?php

						$sts = $this->db->get("tr_status_hidup")->result();
						$ray = array();
						$ray[""] = "=== Pilih ===";

						foreach ($sts as $val) {

							$ray[$val->id] = $val->nama;
						}

						echo form_dropdown("g[id_status_ayah]", $ray, $data->id_status_ayah, 'class="col-md-12 selectpicker show-tick" ');

						?>

  				</div>

  			</div>

  		</div>

  		<div class="col-md-6">

  			<b>STATUS IBU</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">accessible</i>

  				</span>

  				<div class="form-line">



  					<?php

						$sts = $this->db->get("tr_status_hidup")->result();
						$ray = array();
						$ray[""] = "=== Pilih ===";

						foreach ($sts as $val) {

							$ray[$val->id] = $val->nama;
						}

						echo form_dropdown("g[id_status_ibu]", $ray, $data->id_status_ibu, 'class="col-md-12 selectpicker show-tick" ');

						?>



  					</select>

  				</div>

  			</div>

  		</div>







  		<p>

  		<div class="col-md-6">

  			<b>USERNAME</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">verified_user</i>

  				</span>

  				<div class="form-line">



  					<input type="text" name="g[username]" value="<?php echo $data->usernameortu; ?>">

  				</div>

  			</div>

  		</div>



  		<div class="col-md-6">

  			<b>PASSWORD</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">vpn_key</i>

  				</span>

  				<div class="form-line">

  					<?php $pass = substr($data->passortu, 2); ?>

  					<input type="text" name="password_ortu" value="<?php echo substr($pass, 0, -2); ?>">

  				</div>

  			</div>

  		</div>





  		</p>






















  		<div class="row clearfix">&nbsp;</div>

  		<p>
  			<center><b class="col-teal"> ==== DI ISI JIKA TIDAK ADA ORANG TUA ====</b></center>
  		</p>

  		<div class="col-md-4">

  			<b>NAMA WALI</b>

  			<div class="input-group">



  				<div class="form-line">

  					<input class="form-control" placeholder="Nama Wali" value="<?php echo $data->nama_wali; ?>" name="f[nama_wali]" type="text">

  				</div>

  			</div>

  		</div>



  		<div class="col-md-4">

  			<b>NO.HP WALI</b>

  			<div class="input-group">



  				<div class="form-line">

  					<input class="form-control " onkeydown="return nomor(this, event);" value="<?php echo $data->hp_wali; ?>" placeholder="Nomor Hp Wali" name="f[hp_wali]" type="text">

  				</div>

  			</div>

  		</div>

  		<div class="col-md-4">

  			<b>HUBUNGAN</b>

  			<div class="input-group">



  				<div class="form-line">

  					<input class="form-control " placeholder="Hubungan" name="f[hubungan]" value="<?php echo $data->hubungan; ?>" type="text">

  				</div>

  			</div>

  		</div>





  		</p>

  	</div>

  	<div role="tabpanel" class="tab-pane  animated flipInX" id="settings_with_icon_title1">



  		<p>

  		<div class="col-md-6">

  			<b>TGL PENERIMAAN</b>

  			<div class="input-group">



  				<div class="form-line">

  					<input class="form-control" readonly id="ftanggale" name="f[tgl_diterima]" type="text" value="<?php echo $data->tgl_diterima; ?>">

  				</div>

  			</div>

  		</div>

  		<div class="col-md-6">

  			<b>STATUS DATA MASUK</b>

  			<div class="input-group">



  				<div class="form-line">



  					<?php



						$ray = array();

						$ray[1] = "MASUK DIAWAL SESUAI TAHUN AJARAN";

						$ray[2] = "TELAH LULUS";

						$ray[3] = "DROP OUT";

						$ray[4] = "PINDAHAN DARI SEKOLAH LAIN";

						$ray[5] = "PINDAH SEKOLAH";



						echo form_dropdown("f[id_sts_data]", $ray, $data->id_sts_data, 'class="col-md-12 selectpicker show-tick" onchange="cek_keluar2(this.value)"  ');

						?>



  				</div>

  			</div>

  			<div style="display: none;" id="w_upd2">
  				<div class="row">
  					<div class="col-md-6 col-sm-6">
  						<b>TANGGAL KELUAR</b>
  						<div class="input-group">
  							<div class="form-line">
  								<input type="text" id="tgl_update_sts2" name="tgl_update_sts2" class="form-control tmt" placeholder="__/__/____">
  							</div>
  						</div>
  					</div>
  					<div class="col-md-6 col-sm-6" style="display: none" id="w_ke">
  						<b>PINDAH KE</b>
  						<div class="input-group">
  							<div class="form-line">
  								<input type="text" id="pindah_ke" name="f[pindah_ke]" class="form-control">
  							</div>
  						</div>
  					</div>

  				</div>
  			</div>


  		</div>

  		<div class="col-md-12">&nbsp;</div>

  		<div class="col-md-6">

  			<b>TINGKAT</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">school</i>

  				</span>

  				<div class="form-line">



  					<?php

						$sts = $this->db->get("tr_tingkat")->result();
						$ray = array();
						$ray[""] = "=== Pilih ===";

						foreach ($sts as $val) {

							$ray[$val->id] = $val->nama;
						}

						echo form_dropdown("id_tingkat", $ray, $data->id_tk, 'id="getIdTk" required class="col-md-12 selectpicker show-tick" ');

						?>



  				</div>

  			</div>

  		</div>



  		<div class="col-md-6">

  			<b>JURUSAN</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">school</i>

  				</span>

  				<div class="form-line">





  					<?php

						$sts = $this->db->get("tr_jurusan")->result();
						$ray = array();
						$ray[""] = "=== Pilih ===";

						foreach ($sts as $val) {

							$ray[$val->id] = $val->alias;
						}

						echo form_dropdown("id_jurusan", $ray, $data->id_jurusan, 'id="getIdJurusan" required class="col-md-12 selectpicker show-tick" ');

						?>

  				</div>

  			</div>

  		</div>



  		<div class="col-md-6">



  			<b>KELAS</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">school</i>

  				</span>

  				<div class="form-line">

  					<div id="responskls2"> <select required class="form-control">
  							<option value="">=== Pilih ===</option>
  						</select></div>

  				</div>

  			</div>

  		</div>



  		<div class="col-md-6">

  			<b>TAHUN MASUK AJARAN</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">school</i>

  				</span>

  				<div class="form-line">



  					<?php

						$sts = $this->db->query("select * from tr_tahun_ajaran   ")->result();

						$ray = array();

						foreach ($sts as $v) {

							$ray[$v->id] = $v->nama;
						}

						echo form_dropdown("f[id_tahun_masuk]", $ray, $data->id_tahun_masuk, 'id="id_tahun_masuk" required    class="  col-md-12 selectpicker show-tick" ');

						?>



  				</div>

  			</div>

  		</div>

  		<input type="hidden" name="aksi_edit" value="true">



  		</p>

  	</div>



  	<div role="tabpanel" class="tab-pane  animated flipInX" id="akuntable">



  		<p>

  		<div class="col-md-6">

  			<b>USERNAME</b>

  			<div class="input-group">

  				<span class="input-group-addon">

  					<i class="material-icons">verified_user</i>

  				</span>

  				<div class="form-line">



  					<input type="text" name="f[username]" value="<?php echo $data->username; ?>">

  				</div>

  			</div>

  		</div>



  		<div class="col-md-6">

  			<b>PASSWORD</b>

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





  		</p>

  	</div>



  </div>

  <div class="col-md-3 pull-right ">

  	<button onclick="submitForm('formSubmit_edit')" class="btn-block aves-effect btn bg-teal"><i class="material-icons">save</i> SIMPAN</button>

  </div>



  <script>
  	function cek_keluar2(id) {

  		if (id == "3" || id == "5") { // DROP OUT & PINDAH SEKOLAH
  			$("#w_upd2").show();
  			$("#tgl_update_sts2").val("");

  			if (id == "3") {
  				$("#w_ke").hide();
  				$("#pindah_ke").val("");
  			} else {
  				$("#w_ke").show();
  			}
  		} else {
  			$("#w_upd2").hide();
  			$("#pindah_ke").val("");
  		}
  	}
  	$('[data-toggle="tooltip"]').tooltip({

  		container: 'body'

  	});

  	$('select').selectpicker();

  	$(".tmt").inputmask("99/99/9999");
  </script>



  <script>
  	setTimeout(function() {
  		sel();
  	}, 500);



  	$(document).on("change", "#getIdTk,#getIdJurusan", function() {

  		sel();

  	});
  </script>

  <script>
  	function sel()

  	{

  		var jurusan = $("[name='id_jurusan']").val();

  		var idtk = $("[name='id_tingkat']").val();

  		var val = "<?php echo $data->id_kelas ?>";

  		$.post("<?php echo site_url("master/getKelas"); ?>", {
  			id: idtk,
  			jur: jurusan,
  			val: val
  		}, function(data) {

  			$("#responskls2").html(data);

  		});

  	}
  </script>

  <script>
  	$('#ftanggale').daterangepicker({

  		"showDropdowns": true,

  		singleDatePicker: true,



  		"locale": {

  			"format": "YYYY-MM-DD",

  			"separator": " - ",

  			"applyLabel": "Apply",

  			"cancelLabel": "Cancel",

  			"fromLabel": "From",

  			"toLabel": "To",

  			"customRangeLabel": "Custom",

  			"weekLabel": "W",

  			"daysOfWeek": [

  				"Min",

  				"Sen",

  				"Sel",

  				"Rab",

  				"Kam",

  				"Jum",

  				"Sab",



  			],

  			"monthNames": [

  				"Januari",

  				"Februari",

  				"Maret",

  				"April",

  				"Mei",

  				"Juni",

  				"Juli",

  				"Agustus",

  				"September",

  				"Oktober",

  				"November",

  				"Desember"

  			],

  			"firstDay": 1

  		},

  		"opens": "left"

  	}, function(start, end, label) {

  		console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');



  	});
  </script>