<style>
.upload{
border:#DCDCDC dashed 1px;
}
</style>
<?php $data=$this->mdl->dataProfilePegawai();?> 
              <!-- Validation Stats -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATA PROFILE
                            </h2>
                            
                        </div>
                        <div class="body" id="area_formSubmit">
                            <form id="formSubmit" action="javascript:save_profile('formSubmit')" method="post" url="<?php echo base_url("profile/updatePegawai");?>">
                       <center class="hide">  <label>
					   <div style="max-width:200px">  
								<b>	PHOTO PROFILE</b><br>				   
                                  <img style="border-radius:20px;border:#F5F5DC solid 2px;padding:5px" id="blah" src="<?php echo base_url()?>file_upload/dp/<?php echo isset($data->poto)?($data->poto):"";?>" alt="" height="100px" />
								  <input type='file' accept=".JPG,.jpg,.png" name="poto" id="imgInp" class="form-control upload"  />
							</div>	 
							 </label>
						</center>
								 
								<div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control"  readonly value="<?php echo $data->nama;?>"  >
                                        <label class="form-label">Nama </label>
                                    </div>
                                </div>
								
								
								<?php $jkl=$jkp=""; if($data->jk=="l"){ $jkl="checked";}else{ $jkp="checked";}?>
								
							 
								
							 
						 
								
								<div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[hp]" value="<?php echo $data->hp;?>" required>
                                        <label class="form-label">Telpon</label>
                                    </div>
                                </div>
								 
								 
								
								<div class="form-group form-float success">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[username]" value="<?php echo $data->username;?>" required>
                                        <label class="form-label">Username</label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="password" value="" >
                                        <label class="form-label">Password baru</label>
                                    </div>
                                </div>
<center>
								<div class="form-group form-float">
                                     
                                        <button onclick="save_profile('formSubmit')" class="btn btn-primary waves-effect" ><i class="material-icons">save</i> Simpan</button>
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
      $('.image img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>
 