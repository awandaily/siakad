  <?php	$data=$this->m_reff->dataProfileSiswa(); ?>
     
	<div class="col-md-12 card">
							 
									 <div class="col-md-6"><br>
                                      <b class='col-teal'>Username</b>
											<div class="input-group">
												  <span class="input-group-addon">
													<i class="material-icons">verified_user</i>
												</span>
												<div class="form-line">
													<input class="form-control" placeholder="Gelar depan" value="<?php echo $data->username;?>" name="username" type="text" onchange="akun()">
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
													<input class="form-control" placeholder="Gelar depan" value="<?php echo substr($pass,0,-2);?>" name="password" type="text" onchange="akun()">
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
		var link="<?php echo base_url()?>dsh/simpan_akun";
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
 <form id="formSubmit_edit" action="javascript:submitFormNoResset('formSubmit_edit')"   url="<?php echo base_url()?>dsh/update_profile" method="post"  >	  
<div class="col-md-12 card" id="area_formSubmit_edit">
	<div class="tab-content"><br>
	<input type="hidden" name="before_file" value="<?php echo $data->poto;?>">
                                    <div class="col-md-4">
                                      <b>NAMA LENGKAP</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input required class="form-control" placeholder="Nama Lengkap" value="<?php echo $data->nama;?>" name="f[nama]" type="text">
												</div>
											</div>
                                      </div>
										
									<div class="col-md-4"  >	
										<b>NIS</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input name="f[nis]"    value="<?php echo $data->nis;?>"   onkeydown="return nomor(this, event);" class="  form-control"  placeholder="Nomor NIS" type="text">
												 
												</div>
											</div>
                                    </div>
									<div class="col-md-4"  >	
										<b>NISN</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input name="f[nisn]"    value="<?php echo $data->nisn;?>"   onkeydown="return nomor(this, event);" class="  form-control"  placeholder="Nomor NISN" type="text">
												 
												</div>
											</div>
                                    </div>
									<div class="col-md-6"  >	
										<b>NIK</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input name="f[nik]"    value="<?php echo $data->nik;?>"   onkeydown="return nomor(this, event);" class="  form-control"  placeholder="Nomor NIK" type="text">
												 
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
													  $sts=$this->db->get("tr_jk")->result();$ray="";$ray[""]="=== Pilih ===";
													  foreach($sts as $val)
													  {
													  $ray[$val->id]=$val->nama;
													  }
													 echo form_dropdown("f[jk]",$ray,strtolower($data->jk),'class="selectpicker col-xs-12 col-md-12 show-tick" ');
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
													  $sts=$this->db->get("tr_agama")->result();$ray="";$ray[""]="=== Pilih ===";
													  foreach($sts as $val)
													  {
													  $ray[$val->id]=$val->nama;
													  }
													 echo form_dropdown("f[id_agama]",$ray,$data->id_agama,'class="col-md-12 col-xs-12 selectpicker show-tick" ');
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
													<input class="form-control" value="<?php echo $data->hp;?>" onkeydown="return nomor(this, event);"  placeholder="Nomor Hp" name="hp" type="text">
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
													<input class="form-control" value="<?php echo $data->email;?>" placeholder="email" name="f[email]" type="email">
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
                                                <input  class="form-control" value="<?php echo $data->tempat_lahir;?>" placeholder="Tempat lahir" name="f[tempat_lahir]" type="teks">
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
                                                <input class="form-control tmt" value="<?php echo $this->tanggal->ind($data->tgl_lahir,"/");?>" placeholder="contoh: 30/07/2016" name="tgl_lahir" type="text">
                                            </div>
                                        </div>
                                 
                                    </div>
									
									
								<div class="col-md-4">	
										<b>PHOTO</b>
											<div class="input-group">
												 
												<div class="form-line">
													  <input  class="form-control"  name="file" type="file" id="imgInp">
												</div>
											</div>
                                    </div>
									
								<div class="col-md-6">	
									 
                                        <b>ASAL SD</b>
										 
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="material-icons">account_balance</i>
                                            </span>
                                            <div class="form-line">
                                                <input  class="form-control" value="<?php echo $data->asal_sd;?>" placeholder="Asal SD" name="f[asal_sd]" type="text">
                                            </div>
                                        </div>
                                 
                                    </div> 	
									<div class="col-md-6">	
									 
                                        <b>TAHUN LULUS SD</b>
										 
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="material-icons">today</i>
                                            </span>
                                            <div class="form-line">
                                                <input  class="form-control" value="<?php echo $data->tahun_lulus_sd;?>" placeholder="Tahun Lulus SD" name="f[tahun_lulus_sd]" type="text">
                                            </div>
                                        </div>
                                 
                                    </div> 	
									<div class="col-md-6">	
									 
                                        <b>ASAL SMP</b>
										 
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="material-icons">account_balance</i>
                                            </span>
                                            <div class="form-line">
                                                <input  class="form-control" value="<?php echo $data->asal_smp;?>" placeholder="ASAL SMP" name="f[asal_smp]" type="text">
                                            </div>
                                        </div>
                                 
                                    </div> 	
									<div class="col-md-6">	
									 
                                        <b>TAHUN LULUS SMP</b>
										 
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="material-icons">today</i>
                                            </span>
                                            <div class="form-line">
                                                <input  class="form-control" value="<?php echo $data->tahun_lulus_smp;?>" placeholder="Tahun Lulus SMP" name="f[tahun_lulus_smp]" type="text">
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
													<input class="form-control" value="<?php echo $data->alamat;?>" placeholder="Alamat" name="f[alamat]" type="text">
												</div>
											</div>
                                    </div>
									
                              
                               
									 
									 
									<div class="row clearfix"></div>
									
                           
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
							
				 
			  <script>
 function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#photo_profile').attr('src', e.target.result);
     }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

	 
    //CKEditor
   
</script>
		 