	
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

							 <div class="col-md-6" id="area_">
						 
                                   <div class="col-md-12">
                                        <b>KODE KD3</b>
                                        <div class="input-group">
                                           
                                            <div class="form-line">
                                                <input type="text" class="form-control " autocomplete="off" required name="f[kd3_no]"  onKeyPress="return angkadanhuruf(event,'1234567890.',this)">
                                            </div>
                                        </div>
                                </div>

								 
                                 <div class="col-md-12">
                                        <b>KRITERIA KETUNTASAN MINIMAL</b>
                                        <div class="input-group">
                                           
                                            <div class="form-line">
                                                <input type="text" class="form-control" required name="f[kd3_kb]"  onKeyPress="return angkadanhuruf(event,'1234567890.',this)">
                                            </div>
                                        </div>
                                </div>
								 <div class="col-md-12">
                                        <b>KD3 Deskripsi</b>
                                        <div class="input-group">
                                           
                                            <div class="form-line">
                                               <textarea class="form-control" name="f[kd3_desc]"  required></textarea>
                                            </div>
                                        </div>
                                </div>
								
                                
							 </div>
							 <div class="col-md-6" id="area_2">
							 <div class="col-md-12">
                                        <b>KODE KD4</b>
                                        <div class="input-group">
                                           
                                            <div class="form-line">
                                                <input type="text" class="form-control" autocomplete="off" required name="f[kd4_no]"  onKeyPress="return angkadanhuruf(event,'1234567890.',this)">
                                            </div>
                                        </div>
                                </div>

								 
                                 <div class="col-md-12">
                                        <b>KRITERIA KETUNTASAN MINIMAL</b>
                                        <div class="input-group">
                                           
                                            <div class="form-line">
                                                <input type="text" class="form-control" required name="f[kd4_kb]"  onKeyPress="return angkadanhuruf(event,'1234567890.',this)">
                                            </div>
                                        </div>
                                </div>
								 <div class="col-md-12">
                                        <b>KD4 Deskripsi</b>
                                        <div class="input-group">
                                           
                                            <div class="form-line">
                                               <textarea class="form-control" name="f[kd4_desc]"  required></textarea>
                                            </div>
                                        </div>
                                </div>
								
								
							 </div>
								 

									
									
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
 
 <div class="btn-group pull-right" role="group" aria-label="Default button group">
                                  
                                      <!--  <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>-->
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitFormKikd('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>