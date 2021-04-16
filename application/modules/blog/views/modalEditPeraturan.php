
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="judul"   class="pull-left">Nama  Peraturan</label>
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
								
								
		 				
		<div class="col-md-8">
 <br>
								 
							
								 
							 	 
								  
   </div>
   </div>

<div class="clearfix"></div>

  
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