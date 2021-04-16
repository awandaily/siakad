<center>	  <a href="<?php echo base_url()?>static/formKIKD.xlsx">Download Format terlebih dahulu (jika belum ada)</a></center><br>
	  <form id="modal_import" action="javascript:importFormKikd('modal_import')" url="<?php echo base_url()?>guru_instal/import_kikd" 
								method="post" enctype="multipart/form-data">
									  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">MATA PELAJARAN/TINGKAT</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                        <select class="form-control show-tick" required name="id_mapel_ajar"  onchange="carikan()" >
                                        <option value="">=== Pilih ===</option>
										 
											<?php 
										   $db=$this->mdl->mapelAjarGroup();
										   foreach($db as $val){
											       echo "<option value='".$val->id."'>".$val->mapel." / Tingkat :".$val->nama_tingkat."</option>";
										   }
										   ?>
									  
                                    </select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>

						 <center><hr>
					 <p id="area_modal_import" style="width:60%"  >
						 
						 	
							  <span  id="submit" class=" " >
							      Upload file :
							      <input accept="xlsx" name="file" required type="file" class='btn-block' style="border:orange solid 1px"> 
							      <br>  
							  <button class="btn btn-block btn-xs  bg-teal" style="margin-top:2px" onclick="importFormKikd('modal_import')">
							      <i class="material-icons">cloud_upload</i> 
							      UPLOAD</button></span> 
							  </form>
				  </p>
						</center>			

									
									
 <script>
 //$('select').selectpicker();
 </script>
 
 <script>
     function reload_table2()
     {
         carikan();
     }
 </script>
 
 <script>
 function carikan()
 {	  
  var id=$("[name='id_mapel_ajar']").val();
	$.ajax({
		 url:"<?php echo site_url("guru_instal/ceknokd"); ?>",
		 data: {id:id},
		 method:"POST",
		 dataType:"JSON",
		 beforeSend: function() {
               loading("area_");
               loading("area_2");
            },
		 success: function(data)
				{ 	  
				unblock("area_"); 	
				unblock("area_2"); 	
		 	   $("[name='f[kd3_no]']").val("3."+data.kd3);
		 	   $("[name='f[kd4_no]']").val("4."+data.kd4);
		 
			}
  });
				
 }
 </script>
 
 