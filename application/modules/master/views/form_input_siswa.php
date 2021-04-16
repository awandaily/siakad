  <form id="formSubmit_input" action="javascript:submitForm('formSubmit_input')" method="post"  >
  <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active sound">
                                    <a href="#PROFILE" data-toggle="tab">
                                        <i class="material-icons">face</i> PROFILE
                                    </a>
                                </li>
                                <li role="presentation" class="sound">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">account_balance</i> RIWAYAT PENDIDIKAN
                                    </a>
                                </li>
                                <li  class="sound" role="presentation">
                                    <a href="#messages_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">supervised_user_circle</i> ORANG TUA / WALI MURID
                                    </a>
                                </li>
								<li  class="sound" role="presentation">
                                    <a href="#akun" data-toggle="tab">
                                        <i class="material-icons">vpn_key</i> AKUN
                                    </a>
                                </li>
                                <li  class="sound" role="presentation">
                                    <a href="#settings_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">weekend</i> PENETAPAN KELAS
                                    </a>
                                </li>
								
                            </ul>
							<!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane  animated flipInX  active" id="PROFILE">
                                    
                                    <p>
                                       <!------------------------>
									   <div class="col-md-4">
                                      <b>NAMA LENGKAP</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input required class="form-control" placeholder="Nama Lengkap" name="f[nama]" type="text">
												</div>
											</div>
                                      </div>
										
									<div class="col-md-4">	
										<b>NIS</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input   onkeydown="return nomor(this, event);" class="form-control"  placeholder="Nomor NIS" name="f[nis]" type="text">
												</div>
											</div>
                                    </div>
									<div class="col-md-4">	
										<b>NISN</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input   onkeydown="return nomor(this, event);" class="form-control"  placeholder="Nomor NISN" name="f[nisn]" type="text">
												</div>
											</div>
                                    </div><div class="col-md-6">	
										<b>NIK</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input   onkeydown="return nomor(this, event);" class="form-control"  placeholder="Nomor NIK" name="f[nik]" type="text">
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
													<select class="selectpicker show-tick col-md-12 "  name="f[jk]">
													  <option value="">=== Pilih === </option>
													  <?php
													  $sts=$this->db->get("tr_jk")->result();
													  foreach($sts as $val)
													  {
														  echo " <option value='".$val->id."'>".$val->nama."</option>";
													  }
													  ?>
															  
													</select>
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
													<select class="selectpicker show-tick"  name="f[id_agama]">
													  <option value="">=== Pilih === </option>
													  <?php
													  $sts=$this->db->get("tr_agama")->result();
													  foreach($sts as $val)
													  {
														  echo " <option value='".$val->id."'>".$val->nama."</option>";
													  }
													  ?>
															  
													</select>
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
													<input class="form-control" value="08" onkeydown="return nomor(this, event);"  placeholder="Nomor Hp" name="f[hp]" type="text">
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
													<input class="form-control" placeholder="email" name="f[email]" type="email">
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
                                                <input  class="form-control" placeholder="Tempat lahir" name="f[tempat_lahir]" type="teks">
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
                                                <input class="form-control tmt" placeholder="contoh: 30/07/2016" name="tgl_lahir" type="text">
                                            </div>
                                        </div>
                                 
                                    </div>
									
									
								<div class="col-md-4">	
										<b>Photo</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input class="form-control"  name="file" type="file">
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
													<input class="form-control" placeholder="Alamat" name="f[alamat]" type="text">
												</div>
											</div>
                                    </div>
									
                              
                               
									 
									 
									<div class="row clearfix"></div>
									
									 
								
									
                                       <!------------------------>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane  animated flipInX" id="profile_with_icon_title">
                                    
                                    <p>
                                      <!------------------------->
									   <div class="col-md-6">
                                      <b>ASAL SD</b>
											<div class="input-group">
												 <span class="input-group-addon">
													<i class="material-icons">school</i>
												</span>
												<div class="form-line">
													<input class="form-control" placeholder="Asal SD" name="f[asal_sd]" type="text">
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
													<input  class="form-control thn"   placeholder="contoh : 2005/2006" name="f[tahun_lulus_sd]" type="text">
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
													<input class="form-control " placeholder="Asal SMP" name="f[asal_smp]" type="text">
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
													<input  class="form-control thn"    placeholder="contoh : 2005/2006" name="f[tahun_lulus_smp]" type="text">
												</div>
											</div>
                                    </div>
									
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane  animated flipInX" id="messages_with_icon_title">
                                   <p>
                                    
									  
								 
									  
									   <div class="col-md-4">
                                      <b>NAMA AYAH</b>
											<div class="input-group">
												 <span class="input-group-addon">
													<i class="material-icons">school</i>
												</span>
												<div class="form-line">
													<input class="form-control" placeholder="Nama Ayah" name="g[nama_ayah]" type="text">
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
													<input  class="form-control " onkeydown="return nomor(this, event);"  placeholder="Nomor Hp ayah" name="g[hp_ayah]" type="text">
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
											<!--	<input  class="form-control "    name="g[id_pekerjaan_ayah]" type="text">-->
												<select class="selectpicker show-tick col-md-12"  name="g[id_pekerjaan_ayah]">
													  <option value="">=== Pilih === </option>
													  <?php
													  $sts=$this->db->get("tr_pekerjaan")->result();
													  foreach($sts as $val)
													  {
														  echo " <option value='".$val->id."'>".$val->nama."</option>";
													  }
													  ?>
															  
													</select> 
												 
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
													<input  class="form-control "    name="g[id_pekerjaan_ibu]" type="text">
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
													<input  class="form-control" onkeydown="return nomor(this, event);"  placeholder="Nomor Hp ibu" name="g[hp_ibu]" type="text">
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
												 	<select class="selectpicker show-tick col-md-12"  name="g[id_pekerjaan_ibu]">
													  <option value="">=== Pilih === </option>
													  <?php
													  $sts=$this->db->get("tr_pekerjaan")->result();
													  foreach($sts as $val)
													  {
														  echo " <option value='".$val->id."'>".$val->nama."</option>";
													  }
													  ?>
															  
													</select> 
													<!--<input  class="form-control "    name="g[id_pekerjaan_ibu]" type="text">-->
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
													<select class="selectpicker show-tick col-md-12"  name="g[id_penghasilan]">
													  <option value="">=== Pilih === </option>
													  <?php
													  $sts=$this->db->get("tr_penghasilan")->result();
													  foreach($sts as $val)
													  {
														  echo " <option value='".$val->id."'>".$val->nama."</option>";
													  }
													  ?>
															  
													</select>
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
													<input class="form-control" placeholder="Alamat" name="g[alamat_ortu]" type="text">
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
													<select class="selectpicker show-tick col-md-12"  name="g[id_status_ayah]">
													  <option value="">=== Pilih === </option>
													  <?php
													  $sts=$this->db->get("tr_status_hidup")->result();
													  foreach($sts as $val)
													  {
														  echo " <option value='".$val->id."'>".$val->nama."</option>";
													  }
													  ?>
															  
													</select>
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
													<select class="selectpicker show-tick col-md-12"  name="g[id_status_ibu]">
													  <option value="">=== Pilih === </option>
													  <?php
													  $sts=$this->db->get("tr_status_hidup")->result();
													  foreach($sts as $val)
													  {
														  echo " <option value='".$val->id."'>".$val->nama."</option>";
													  }
													  ?>
															  
													</select>
												</div>
											</div>
                                    </div>
									
									   <div class="col-md-6">	
									  <b>USERNAME</b>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons">verified_user</i>
												</span>
												<div class="form-line">
																										
												 <input type="text" name="g[username]"  >
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
											 
													  <input type="text" name="password_ortu"  >
												</div>
											</div>
                                    </div> 
									 
									  	<div class="row clearfix">&nbsp;</div>
								 
									<p><center><b  class="col-teal"> ==== DI ISI JIKA ORANG TUA TIDAK ADA ====</b></center></p>
								    <div class="col-md-4">	
										 <b>NAMA WALI</b>
											<div class="input-group">
												  
												<div class="form-line">
													<input class="form-control" placeholder="Nama Wali  " name="f[nama_wali]" type="text">
												</div>
											</div>
                                      </div>
										
									<div class="col-md-4">	
										<b>NO.HP WALI</b>
											<div class="input-group">
												  
												<div class="form-line">
													<input  class="form-control " onkeydown="return nomor(this, event);"  placeholder="Nomor Hp Wali" name="f[hp_wali]" type="text">
												</div>
											</div>
                                    </div>
									<div class="col-md-4">	
										<b>HUBUNGAN</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input  class="form-control "   placeholder="Hubungan" name="f[hubungan]" type="text">
												</div>
											</div>
                                    </div>
										
										
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane  animated flipInX" id="settings_with_icon_title">
                                    <p class="col-md-12">		
								  <div class="col-md-6">
                                      <b>TGL PENERIMAAN</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input class="form-control" readonly  id="ftanggal" name="f[tgl_diterima]" type="text" value="<?php echo date('Y-m-d')?>">
												</div>
											</div>
                                      </div>
									<div class="col-md-6">	
									  		<b>STATUS DATA MASUK</b>
											<div class="input-group">
												 
												<div class="form-line">
													 
													  <select required class="selectpicker show-tick col-md-12" name='id_sts_data'  onchange="cek_keluar(this.value)">
														  <option  value="">=== Pilih === </option>
														  <option  value="1"> MASUK SESUAI TAHUN AJARAN</option>
														  <option  value="4"> PINDAHAN DARI LUAR</option>

														  <option  value="3"> DROP OUT</option>														  
													  </select>
													  
													  
												</div>
											</div>
											<div style="display: none;" id="w_upd">
												<b>TANGGAL KELUAR</b>
												<div class="input-group">
													<div class="form-line">
														<input type="text" id="tgl_update_sts" name="tgl_update_sts" class="form-control tmt" placeholder="__/__/____">
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
													<select required class="selectpicker show-tick col-md-12" id="getIdTk" name="getIdTk" >
													  <option value="">=== Pilih === </option>
													  <?php
													  $sts=$this->db->get("tr_tingkat")->result();
													  foreach($sts as $val)
													  {
														  echo " <option value='".$val->id."'>".$val->nama."</option>";
													  }
													  ?>
															  
													</select>
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
													<select required class="selectpicker show-tick col-md-12 getIdJurusan" id="getIdJurusan" >
													  <option  value="">=== Pilih === </option>
													  <?php
													  $sts=$this->db->get("tr_jurusan")->result();
													  foreach($sts as $val)
													  {
														  echo " <option value='".$val->id."'>".$val->alias."</option>";
													  }
													  ?>
															  
													</select>
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
													<div id="responskls"> <select style='z-index:999787' required class="form-control"><option value="">=== Pilih ===</option></select></div>
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
													  $sts=$this->db->query("select * from tr_tahun_ajaran  ")->result();
													$value=$this->m_reff->tahun();
													$dataray="";
													foreach($sts as $val)
													{
													$dataray[$val->id]=$val->nama;
													}
													echo form_dropdown("f[id_tahun_masuk]",$dataray,$value,"required readonly   class='electpicker show-tick col-md-12'");?>
												
												</div>
											</div>
                                    </div>
									
									 
									
									
									<input  value="<?php echo $this->m_reff->semester(); ?>" name="f[id_sms_diterima]" type="hidden">
									
									 <div class="col-md-3 pull-right ">
									 <button onclick="submitForm('formSubmit_input')"  class="btn-block aves-effect btn bg-teal"><i class="material-icons">save</i> SIMPAN</button>
				 </div>
                                    </p>
                                </div>
								
								
								<div role="tabpanel" class="tab-pane  animated flipInX" id="akun">
                                    
                                    <p>
                                    <div class="col-md-6">	
									  <b>USERNAME</b>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons">verified_user</i>
												</span>
												<div class="form-line">
																										
												 <input type="text" name="f[username]"  >
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
											 
													  <input type="text" name="password"  >
												</div>
											</div>
                                    </div> 
									 
									
                                    </p>
                                </div>
									
								
								
								
                            </div>
							
<script>	
				$(document).on("change","#getIdTk,#getIdJurusan",function(){
					var jurusan=$("#getIdJurusan").val();
					var idtk=$("#getIdTk").val();
				 $.post("<?php echo site_url("master/getKelas"); ?>",{id:idtk,jur:jurusan},function(data){					 
					$("#responskls").html(data);
					});
				});
				
	

	function cek_keluar(id){
		if (id == "3" || id == "5") { // DROP OUT & PINDAH SEKOLAH
			$("#w_upd").show();
			$("#tgl_update_sts").val("");
		}
		else{
			$("#w_upd").hide();
		}
	}				
				
 
$('#ftanggal').daterangepicker({
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
				</form>