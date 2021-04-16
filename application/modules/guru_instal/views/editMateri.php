<?php
 $disable="";
 $cek=$this->mdl->cektahap(3);
 if($cek){  
 $disable="disabled";
  } ?>
 <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">Edit Materi <?php echo $data->materi;?>  </h4>
							
                        </div>
                        <div class="modal-body">
                       	   <input type="hidden" name="id" value="<?php echo $data->id;?>">
                       	   <input type="hidden" name="code" value="<?php echo $data->code;?>">
						 <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                       <b>  Mapel - Tingkat</b>
                                    </div>
                                    <div class="col-lg-9 col-md-9  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
										  
											<?php 
										   $db=$this->mdl->mapelAjar();$ray="";
										   $ray[""]="=== Pilih ===";
										   foreach($db as $val){
											  $ray[$val->id]=$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."'")." - Tingkat: ".$this->m_reff->goField("v_kelas","nama_tingkat","where id='".$val->id_kelas."'");
											 }
										   $dataray=$ray;
										   echo form_dropdown("id_mapel_ajar",$dataray,$data->id_mapel_ajar,' '.$disable.' class="form-control show-tick"  required  id="id_mapel_ajar2" onchange="pilkikd2('.$data->id_kikd.')" ');
										   ?>
									  
                                   
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
                                            <div class="form-line" id="data_kikd2">
											 <select class="form-control show-tick" required name="f[id_kikd]" id="id_kikd" >
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
											<textarea class="form-control" required name="f[materi]"><?php echo $data->materi;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                       </div>

							  	
									
 <script>
 $('select').selectpicker();
 pilkikd2(<?php echo $data->id_kikd;?>);
 </script>
			 
					 
 
                      