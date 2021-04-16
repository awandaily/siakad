<form  action="javascript:updateFormKikd('modal_edit')" id="modal_edit" url="<?php echo base_url()?>guru_instal/update_kikd"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">EDIT DATA KI.KD  </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	  <input type="hidden" name="id" value="<?php echo $data->id;?>">
					   	  <input type="hidden" name="id_mapel_ajar" value="<?php echo $data->id_mapel_ajar;?>">
					   	  <input type="hidden" name="kd3_no" value="<?php echo $data->kd3_no;?>">
					   	  <input type="hidden" name="kd4_no" value="<?php echo $data->kd4_no;?>">
					   	  <input type="hidden" name="code" value="<?php echo $data->code;?>">
									
									  <div class="row clearfix"  data-placement="top" data-toggle="tooltip" data-original-title="Tidak dapat diedit">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">MATA PELAJARAN/TINGKAT</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9  " >
                                        <div class="form-group">
                                            <div class="form-line"  >
                                         
											<?php 
										   $db=$this->mdl->mapelAjar();$ray="";
										   $ray[""]="=== Pilih ===";
										   foreach($db as $val){
											  $ray[$val->id]=$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."'")." - Tingkat: ".$this->m_reff->goField("v_kelas","nama_tingkat","where id='".$val->id_kelas."'");
											 }
										   $dataray=$ray;
										   echo form_dropdown("id_mapel_ajar",$dataray,$data->id_mapel_ajar,'class="form-control show-tick" disabled readonly required  id="id_mapel_ajar2" ');
										   ?>
										   
                                            </div>
                                        </div>
                                    </div>
                                </div>

							 <div class="col-md-6">
						 
                                   <div class="col-md-12"   data-placement="top" data-toggle="tooltip" data-original-title="Tidak dapat diedit">
                                        <b>KODE KD3</b>
                                        <div class="input-group"   >
                                             
                                            <div class="form-line">
                                                <input type="text" readonly class="form-control " required readonly disabled  value="<?php echo $data->kd3_no;?>">
                                            </div>
                                        </div>
                                </div>

								 
                                 <div class="col-md-12">
                                        <b>KRITERIA KETUNTASAN MINIMAL</b>
                                        <div class="input-group">
                                            
                                            <div class="form-line">
                                                <input type="text" value="<?php echo $data->kd3_kb;?>" class="form-control" required name="f[kd3_kb]" onKeyPress="return angkadanhuruf(event,'1234567890.',this)">
                                            </div>
                                        </div>
                                </div>
								 <div class="col-md-12">
                                        <b>KD3 Deskripsi</b>
                                        <div class="input-group">
                                            
                                            <div class="form-line">
                                               <textarea class="form-control" name="f[kd3_desc]" required><?php echo $data->kd3_desc;?></textarea>
                                            </div>
                                        </div>
                                </div>
								
                                
							 </div>
							 <div class="col-md-6">
							 <div class="col-md-12"   data-placement="top" data-toggle="tooltip" data-original-title="Tidak dapat diedit">
                                        <b>KODE KD4</b>
                                        <div class="input-group">
                                            
                                            <div class="form-line">
                                                <input readonly disabled type="text" class="form-control"   onKeyPress="return angkadanhuruf(event,'1234567890.',this)" value="<?php echo $data->kd4_no;?>">
                                            </div>
                                        </div>
                                </div>

								 
                                 <div class="col-md-12">
                                        <b>KRITERIA KETUNTASAN MINIMAL</b>
                                        <div class="input-group">
                                            
                                            <div class="form-line">
                                                <input type="text" class="form-control" required name="f[kd4_kb]" value="<?php echo $data->kd4_kb;?>" onkeydown="return nomor(this, event);">
                                            </div>
                                        </div>
                                </div>
								 <div class="col-md-12">
                                        <b>KD4 Deskripsi</b>
                                        <div class="input-group">
                                            
                                            <div class="form-line">
                                               <textarea class="form-control" name="f[kd4_desc]"  required><?php echo $data->kd4_desc;?></textarea>
                                            </div>
                                        </div>
                                </div>
								
								
							 </div>
								
								
									
									
									

									
									
 <script>
	$('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
 </script>
 <script>
 $('select').selectpicker();
 </script>
			 
					 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                  <!--      <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>-->
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="updateFormKikd('modal_edit')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
      </form> 		
			 