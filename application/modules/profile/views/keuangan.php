<style>
.upload{
border:#DCDCDC dashed 1px;
}
</style>
<?php $data=$this->mdl->dataProfile();?> 
              <!-- Validation Stats -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="area_formSubmit">
                        <div class="header">
                            <h2>
                                DATA PROFILE
                            </h2>
                            
                        </div>
                        <div class="body">
                            <form id="formSubmit" action="javascript:save_profile('formSubmit')" method="post" url="<?php echo base_url("profile/update");?>">
                       <center  >  <label>
					   <div style="max-width:200px">  
								<b>	PHOTO PROFILE</b><br>				   
                                  <img style="border-radius:20px;border:#F5F5DC solid 2px;padding:5px" id="blah" src="<?php echo base_url()?>file_upload/dp/<?php echo $this->m_reff->dp();?>" alt="" height="100px" />
								  <input type='file' accept=".JPG,.jpg,.png" name="poto" id="imgInp" class="form-control upload"  />
							</div>	 
							 </label>
						</center>
								 <label for="email_address" class="col-black" style="padding-top:10px;">Nama Akun </label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="f[owner]"   value="<?php echo $data->owner;?>"  >
                                    </div>
                                </div>
								
							 
								
								<?php $jkl=$jkp=""; if($data->jk=="l"){ $jkl="checked";}else{ $jkp="checked";}?>
								
							 
								 <label for="email_address" class="col-black" style="padding-top:10px;">Telpon </label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="f[telp]" value="<?php echo $data->telp;?>"  >
                                    </div>
                                </div>
							 
						 
								 <label for="email_address" class="col-black" style="padding-top:10px;">Email </label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="f[email]" value="<?php echo $data->email;?>"  >
                                    </div>
                                </div>
							 
						 
								 <label for="email_address" class="col-black" style="padding-top:10px;">Username </label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="text" class="form-control" name="f[username]" value="<?php echo $data->username;?>" required>
                                      
                                    </div>
                                </div>
							 
						  <label for="email_address" class="col-black" style="padding-top:10px;">Password baru </label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="text" class="form-control" name="password" value="" >   
                                    </div>
                                </div>
							 
						 
							 
								
							  
<center>
								<div class="form-group form-float">
                                     
                                        <button onclick="save_profile('formSubmit')" class="btn waves-effect btn-primary" ><i class="material-icons">save</i> Simpan</button>
                                    <span class="pull-right" id="msg"></span>
                                    
                                </div>
        </center>                         
                            </form>
                        </div>
                    </div>
                </div>
            </div>               				
 
		  

<script>
 function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
      $('#blah2').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>
 