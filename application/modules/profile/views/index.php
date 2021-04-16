<style>
.upload{
border:#DCDCDC dashed 1px;
}
</style>
<?php $data=$this->mdl->dataProfile();?> 
              <!-- Validation Stats -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATA PROFILE
                            </h2>
                            
                        </div>
                        <div class="body" id="area_f_formSubmit">
                            <form id="f_formSubmit" action="javascript:save_profile('f_formSubmit')" method="post" url="<?php echo base_url("profile/update");?>">
                       <center class=" ">  <label>
					   <div style="max-width:200px">  
								<b>	PHOTO PROFILE</b><br>				   
                                  <img style="border-radius:20px;border:#F5F5DC solid 2px;padding:5px" id="blah" src="<?php echo base_url()?>file_upload/dp/<?php echo $data->poto;?>" alt="" height="100px" />
								  <input type='file' accept=".JPG,.jpg,.png" name="poto" id="imgInp" class="form-control upload"  />
							</div>	 
							 </label>
						</center>
								 
								<div class="form-group form-float"><label class="form-label">Nama Akun</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control"  name="f[owner]"  value="<?php echo $data->owner;?>"  >
                                        
                                    </div>
                                </div>
								
								
								<?php $jkl=$jkp=""; if($data->jk=="l"){ $jkl="checked";}else{ $jkp="checked";}?>
								
							 
								
							 
						 
								
								<div class="form-group form-float"> <label class="form-label">Telpon</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[telp]" value="<?php echo $data->telp;?>"  >
                                       
                                    </div>
                                </div>
								<div class="form-group form-float"> <label class="form-label">Email</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[email]" value="<?php echo $data->email;?>"  >
                                       
                                    </div>
                                </div>
								
								 
								
								<div class="form-group form-float success">  <label class="form-label">Username</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[username]" value="<?php echo $data->username;?>" required>
                                      
                                    </div>
                                </div>
                                 <div class="form-group form-float">  <label class="form-label">Password baru</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="password" value="" >
                                      
                                    </div>
                                </div>
<center>
								<div class="form-group form-float">
                                     
                                        <button onclick="save_profile('f_formSubmit')" class="btn btn-primary" ><i class="material-icons">save</i> Simpan</button>
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
 