  <?php	$data=$this->m_reff->dataProfileOrtu(); ?>

    

     <br>

	<div class="col-md-12 card">

							 

									 <div class="col-md-6"><br>

                                      <b class='col-teal'>Username</b>

											<div class="input-group">

												  <span class="input-group-addon">

													<i class="material-icons">verified_user</i>

												</span>

												<div class="form-line">

													<input class="form-control" placeholder="Username" value="<?php echo $data->username;?>" name="username" type="text" onchange="akun()">

												</div>

											</div>

                                      </div>



									  <div class="col-md-6"><br>

										<b class='col-teal'>Password</b>

											<div class="input-group">

											 <span class="input-group-addon">

													<i class="material-icons">vpn_key</i>

												</span>

												 <?php   $pass=substr($data->alias,2);?>

												<div class="form-line">

													<input class="form-control" placeholder="Password" value="<?php echo substr($pass,0,-2);?>" name="password" type="text" onchange="akun()">

												</div>

											</div>

                                      </div>

			  </div> 

			  

			  

	<script>

	function akun()

	{

		var username=$("[name='username']").val();

		var password=$("[name='password']").val();

		  loading();

		var link="<?php echo base_url()?>oinfo/simpan_akun";

		 $.ajax({

			 url:link,

			 data: {username:username,password:password},

			 method:"POST",

			 dataType:"JSON",

			 success: function(data)

					{ 	 

					if(data["hasil"]=="duplikat")

					{

						notif("Maaf !!<br>Silahkan cari username/password lain. ");			

					}else{

						notif("Berhasil disimpan. ");		

					}

					 unblock();

					

					}

		 });

	}

	</script>	

			  

			  

<?php

$this->db->where("id",$this->m_reff->id_siswa());

$data=$this->db->get("v_siswa")->row();

?>		

 <form id="formSubmit_edit" action="javascript:submitFormNoResset('formSubmit_edit')"   url="<?php echo base_url()?>oinfo/update_profile" method="post"  >	  

<div class="col-md-12 card" id="area_formSubmit_edit">

	<div class="tab-content">

     <div role="tabpanel" class="tab-pane active animated flipInX" id="messages_with_icon_title1">

                                   <p>


									   <div class="col-md-4">

                                      <b>NAMA AYAH</b>

											<div class="input-group">

												 <span class="input-group-addon">

													<i class="material-icons">create</i>

												</span>

												<div class="form-line">

													<input class="form-control" value="<?php echo $data->nama_ayah;?>" placeholder="Nama Ayah" name="g[nama_ayah]" type="text">

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

													<input  class="form-control " value="<?php echo $data->hp_ayah;?>" onkeydown="return nomor(this, event);"  placeholder="Nomor Hp ayah" name="g[hp_ayah]" type="text">

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

													  $sts=$this->db->get("tr_pekerjaan")->result();$ray="";$ray[""]="=== Pilih ===";

													  foreach($sts as $val)

													  {

													  $ray[$val->id]=$val->nama;

													  }

													 echo form_dropdown("g[id_pekerjaan_ayah]",$ray,$data->id_pekerjaan_ayah,'class="col-xs-12 col-md-12 selectpicker show-tick" ');

													  ?>

												</div>

											</div>

                                    </div>

									

									<div class="row clearfix">&nbsp;</div>

									 <div class="col-md-4">	

									<b>NAMA IBU</b>

											<div class="input-group">

												<span class="input-group-addon">

													<i class="material-icons">create</i>

												</span>

												<div class="form-line">

													<input class="form-control" value="<?php echo $data->nama_ibu;?>" placeholder="Nama ibu" name="g[nama_ibu]" type="text">

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

													<input  class="form-control" value="<?php echo $data->hp_ibu;?>" onkeydown="return nomor(this, event);"  placeholder="Nomor Hp ibu" name="g[hp_ibu]" type="text">

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

													  $sts=$this->db->get("tr_pekerjaan")->result();$ray="";$ray[""]="=== Pilih ===";

													  foreach($sts as $val)

													  {

													  $ray[$val->id]=$val->nama;

													  }

													 echo form_dropdown("g[id_pekerjaan_ibu]",$ray, $data->id_pekerjaan_ibu,'class="col-md-12 col-xs-12  selectpicker show-tick" ');

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

													  $sts=$this->db->get("tr_penghasilan")->result();$ray="";$ray[""]="=== Pilih ===";

													  foreach($sts as $val)

													  {

													  $ray[$val->id]=$val->nama;

													  }

													 echo form_dropdown("g[id_penghasilan]",$ray,$data->id_penghasilan,'class="col-md-12 col-xs-12  selectpicker show-tick" ');

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

													<input class="form-control" value="<?php echo $data->alamat_ortu;?>" placeholder="Alamat" name="g[alamat_ortu]" type="text">

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

													  $sts=$this->db->get("tr_status_hidup")->result();$ray="";$ray[""]="=== Pilih ===";

													  foreach($sts as $val)

													  {

													  $ray[$val->id]=$val->nama;

													  }

													 echo form_dropdown("g[id_status_ayah]",$ray,$data->id_status_ayah,'class="col-md-12 col-xs-12  selectpicker show-tick" ');

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

													  $sts=$this->db->get("tr_status_hidup")->result();$ray="";$ray[""]="=== Pilih ===";

													  foreach($sts as $val)

													  {

													  $ray[$val->id]=$val->nama;

													  }

													 echo form_dropdown("g[id_status_ibu]",$ray,$data->id_status_ibu,'class="col-md-12 col-xs-12 selectpicker show-tick" ');

													  ?>

															  

													</select>

												</div>

											</div>

                                    </div>

									


									 

									  	<div class="row clearfix">&nbsp;</div>

									<p><center><b  class="col-teal"> ==== DI ISI JIKA TIDAK ADA ORANG TUA ====</b></center></p>

								    <div class="col-md-4">	

										 <b>NAMA WALI</b>

											<div class="input-group">

												  

												<div class="form-line">

													<input class="form-control" placeholder="Nama Wali" value="<?php echo $data->nama_wali;?>" name="f[nama_wali]" type="text">

												</div>

											</div>

                                      </div>

										

									<div class="col-md-4">	

										<b>NO.HP WALI</b>

											<div class="input-group">

												  

												<div class="form-line">

													<input  class="form-control " onkeydown="return nomor(this, event);" value="<?php echo $data->hp_wali;?>"  placeholder="Nomor Hp Wali" name="f[hp_wali]" type="text">

												</div>

											</div>

                                    </div>

									<div class="col-md-4">	

										<b>HUBUNGAN</b>

											<div class="input-group">

												 

												<div class="form-line">

													<input  class="form-control "   placeholder="Hubungan" name="f[hubungan]"  value="<?php echo $data->hubungan;?>" type="text">

												</div>

											</div>

                                    </div>

										

										

                                    </p>

                                </div>

                           

                            </div>

							 <div class="col-md-3 col-xs-12 pull-right" style="z-index:98">

									 <button onclick="submitFormNoResset('formSubmit_edit')"  class="btn-block waves-effect btn bg-teal"><i class="material-icons">save</i> SIMPAN</button>

				 </div>

				 <div class="col-md-12">&nbsp;</div>

				

		  </div>

		   </form>

							

							 <script>

	 						  $('[data-toggle="tooltip"]').tooltip({

								container: 'body'

							});

							$('select').selectpicker();

							$(".tmt").inputmask("99/99/9999");  

							</script>

							

				 

			  

		 