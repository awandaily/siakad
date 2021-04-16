  <?php	$data=$this->m_reff->dataProfilePegawai(); ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card" id="area_">         
     <br>
	<div class="col-md-12">
							 
									 <div class="col-md-6">
                                      <b class='col-teal'>Username</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input class="form-control" placeholder="Gelar depan" value="<?php echo $data->username;?>" name="username" type="text" onchange="akun()">
												</div>
											</div>
                                      </div>

									  <div class="col-md-6">
										<b class='col-teal'>Password</b>
											<div class="input-group">
												 <?php   $pass=substr($data->alias,2);?>
												<div class="form-line">
													<input class="form-control" placeholder="Gelar depan" value="<?php echo substr($pass,0,-2);?>" name="password" type="text" onchange="akun()">
												</div>
											</div>
                                      </div>
			  </div> 
			  </div> 
			  
	<script>
	function akun()
	{
		var username=$("[name='username']").val();
		var password=$("[name='password']").val();
		  loading("area_");
		var link="<?php echo base_url()?>guru_instal/simpan_akun";
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
					 unblock("area_");
					
					}
		 });
	}
	</script>	
			  
			  
			  
			  
			  
			  
			  
			  
                <!-- Task Info -->
		<form  action="javascript:submitFormNoResset('modal_edit')" id="modal_edit" url="<?php echo base_url()?>guru_instal/update_data_guru"  method="post" enctype="multipart/form-data">
   <input type="hidden" name="before_file" value="<?php echo $data->poto;?>">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card" id="area_modal_edit">
                    
             <br>
			
			<div class="col-md-12">
							 
									 <div class="col-md-4">
                                      <b>GELAR DEPAN</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input class="form-control" placeholder="Gelar depan" value="<?php echo $data->gelar_depan;?>" name="f[gelar_depan]" type="text">
												</div>
											</div>
                                      </div>
										
									<div class="col-md-4">	
										<b>NAMA LENGKAP</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input class="form-control" required value="<?php echo $data->nama;?>"  placeholder="Nama lengkap" name="f[nama]" type="text">
												</div>
											</div>
                                    </div>
									
									<div class="col-md-4">	
									<b>GELAR BELAKANG</b>
											<div class="input-group">
												 
												<div class="form-line">
													<input class="form-control" placeholder="Gelar belakang"  value="<?php echo $data->gelar_belakang;?>" name="f[gelar_belakang]" type="text">
												</div>
											</div>
                                    </div>

									<div class="col-md-4">	
									<b>NIP / ID SISTEM</b>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons">credit_card</i>
												</span>
												<div class="form-line">
													<input data-placement="top" data-original-title="NIP tidak dapat diedit" data-toggle="tooltip"  readonly value="<?php echo $data->nip;?>" class="form-control" required placeholder="Nomor NIP"   type="text">
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
													<input class="form-control" value="<?php echo $data->nuptk;?>"   placeholder="Nomor NUPTK" name="f[nuptk]" type="text">
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
													<input class="form-control"  value="<?php echo $data->hp;?>" onkeydown="return nomor(this, event);" required placeholder="Nomor Hp" name="hp" type="text">
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
													<input class="form-control"  value="<?php echo $data->email;?>" placeholder="email" name="f[email]" type="email">
												</div>
											</div>
                                    </div>
									
									<div class="col-md-4">	
										<b>ALAMAT</b>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons">home</i>
												</span>
												<div class="form-line">
													<input class="form-control"  value="<?php echo $data->alamat;?>" placeholder="Alamat" name="f[alamat]" type="text">
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
                                                <input class="form-control tmt"  value="<?php echo $this->tanggal->ind($data->tmt,"/");?>" placeholder="contoh: 30/07/2016" name="tmt" type="text">
                                            </div>
                                        </div>
                                 
                                    </div>
									
									

									<div class="col-md-4">	 
									<div class="form-group form-float">
									<b>  GENDER </b>
										<?php
										$dataray[]="=== Pilih ===";
										$dataray["l"]="Laki-laki";
										$dataray["p"]="Perempuan";
										echo form_dropdown("f[jk]",$dataray,strtolower($data->jk),'class="col-md-12 selectpicker show-tick" required');
										?>
									</div> 
                                  
                                    </div> 
									
									<div class="col-md-4">	 
									<div class="form-group form-float">
									<b>   STATUS KEPEGAWAIAN</b>
										<?php
										$dataray="";
										$dataray[]="=== Pilih ===";
										$db=$this->db->get("tr_sts_pegawai")->result();
										foreach($db as $db)
										{
											$dataray[$db->id]=$db->nama;
										}
										echo form_dropdown("f[sts_kepegawaian]",$dataray,$data->sts_kepegawaian,'class="col-md-12 selectpicker show-tick" style="width:100%"');
										?>
									</div> 
                                  
                                    </div> 
									
                              <div class="col-md-4">	 
									<div class="form-group form-float">
									 <b>PANGKAT/GOLONGAN</b>
										 
										
										<?php
										$dataray="";
										$dataray[]="=== Pilih ===";
										$db=$this->db->get("tr_pangkat")->result();
										foreach($db as $db)
										{
											$dataray[$db->id]=$db->nama;
										}
										echo form_dropdown("f[id_pangkat]",$dataray,$data->id_pangkat,'class="selectpicker col-md-12 show-tick" data-live-search="true" ');
										?>
									</div> 
                             </div> 
							 
                              
							 
                              

							 <div class="col-md-4">	 
									<div class="form-group form-float">
									<b> Ijazah</b>
									 
										
										<?php
										$dataray="";
										$dataray[]="=== Pilih ===";
										$db=$this->db->get("tr_ijazah")->result();
										foreach($db as $db)
										{
											$dataray[$db->id]=$db->nama;
										}
										echo form_dropdown("f[id_ijazah]",$dataray,$data->id_ijazah,'class="col-md-12 selectpicker show-tick"  ');
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
                                                <input  class="form-control" value="<?php echo $data->tempat_lahir;?>" placeholder="Tempat lahir" name="f[tempat_lahir]" type="teks">
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
                                                <input  class="form-control tmt"   value="<?php echo $this->tanggal->ind($data->tgl_lahir,"/");?>"  placeholder="contoh:30/01/1995" name="tgl_lahir" type="teks">
                                            </div>
                                        </div>
                                 
                                    </div> 
									 
									
								 
								 
									
									 <div class="col-md-4" style="z-index:8">
                                    <center>
                                        <label for="email_address_2" class="col-black">UPLOAD FOTO PROFILE</label>
                                  
                                    <div class="col-lg-12 col-md-12  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                                   <input  class="form-control"  name="file" type="file" id="imgInp">
                                            </div>
                                        </div>
                                    </div>
									</center>
                                </div>
								
								 
								
								<div class="col-md-4" style="z-index:8">
									 
									 <button onclick="submitFormNoResset('modal_edit')"  class="btn-block pull-right waves-effect btn bg-teal"><i class="material-icons">save</i> SIMPAN</button>
								</div>
								<div class="row clearfix"></div>
								<hr>
				 
			</div>
			
		
            </div>
			</form>
          <hr>
		  
		 
		  
		  
		  
		 
	  <div class="col-md-12 row clearfix">&nbsp;</div>
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
	 