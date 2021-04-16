
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="judul"   class="pull-left">Judul  </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                          <input style="border:#A9A9A9 solid 1px;padding-left:5px" type="text" name="form[judul]" id="judul" class="form-control " required value="<?php echo $data->judul;?>">
                                            <input type="hidden" name="id_artikel" value="<?php echo $data->id;?>">
                                            <input type="hidden" name="file" value="xx">
                                           
											</div>
                                        </div>
                                    </div>
                                </div><br>
								
								<div class="row clearfix">
                                    <textarea id="ckeditor_edits" name="form[konten]"><?php echo $data->konten;?></textarea>
                                </div>
								
								
		<div class="col-md-4">
		<center>
		<label>
		 <img  id="blaho" src="<?php echo base_url()?>file_upload/ghalery/<?php echo $data->thumbnail;?>" alt="" height="100px" width="230px" style="padding:5px" />
		 <input type='file' accept=".JPG,.jpg,.png" name="poto" id="imgInpo" class="form-control upload"  /></label>
		</center>
		</div>						
		<div class="col-md-8">
 <br>
								<div class="row clearfix"  style="margin-top:5px">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="id_kategory"  class="pull-left">Kategory </label>
                                    </div> 
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-lines">
                                                <select name="form[id_kategory]" id="id_kategory" required class="form-control" style="border:#A9A9A9 solid 1px">
												<option value=''>==== Pilih ====</option>
												<?php $datax=$this->m_reff->goResult("tr_kategory_ghalery","*")->result();
												foreach($datax as $datax)
												{
													echo "<option value='".$datax->id."'>".$datax->nama."</option>";
												}
												?>
												</select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix"  style="margin-top:5px">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="sts" class="pull-left">Publikasi </label>
                                    </div> 
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-lines">
                                                <select   name="form[sts]" id="sts" required class="form-control" style="border:#A9A9A9 solid 1px">
												<option value=''>==== Pilih ====</option>
												<option value='3'>Terbitkan</option>
												<option value='2' >Simpan Sebagai Konsep</option>
												</select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							
								 
							 	 
								  
   </div>
   </div>

<div class="clearfix"></div>

 	<script>
								$("[name='form[id_kategory]']").val("<?php echo $data->id_kategory?>");
							 	$("#sts").val("<?php echo $data->sts?>");
								 
	 </script>
<script>
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blaho').attr('src', e.target.result);
     }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInpo").change(function() {
  readURL(this);
});

    CKEDITOR.replace('ckeditor_edits');
    CKEDITOR.config.height = 300;
 </script>