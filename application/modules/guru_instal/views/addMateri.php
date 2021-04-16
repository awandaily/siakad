	   
						 <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                       <b>  Mapel - Tingkat</b>
                                    </div>
                                    <div class="col-lg-9 col-md-9  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											<select class="form-control show-tick" required name="id_mapel_ajar" id="id_mapel_ajar" onchange="pilkikd()">
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
						 <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <b>Pilih KI.KD</b>
                                    </div>
                                    <div class="col-lg-9 col-md-9  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_kikd">
											 <select class="form-control show-tick" required name="id_kikd" id="id_kikd" >
											<option value="">=== Pilih ===</option>
										  
											</select>     
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
						 <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <b>Materi</b>
                                    </div>
                                    <div class="col-lg-9 col-md-9  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_kikd">
											<textarea class="form-control" required name="f[materi]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                        </div>
						 
						 
	 			
								
							   									
 <script>
 $('select').selectpicker();
 </script>