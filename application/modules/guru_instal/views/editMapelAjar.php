 <input type="hidden" name="id" value="<?php echo $this->input->post("id");?>">
 <?php
 $id_kelas=$this->input->post("kelas");
 $id_mapel=$this->input->post("mapel");
 $jam=$this->input->post("jam");
 $jmljam=$this->input->post("jmljam");
 ?>
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">  KELAS</label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line">
										  <?php 
										    $db=$this->db->get("tr_tingkat")->result();
										    foreach($db as $val){ 
												$dbs=$this->db->get_where("v_kelas",array("id_tk"=>$val->id))->result();
											   
											   foreach($dbs as $vals){
												   $ray[$vals->id]=$vals->nama;
											   }
											}
											 
										   $dataray=$ray;
										   echo form_dropdown("id_kelas",$dataray,$id_kelas,'  id="Eedit" disabled  class="form-control show-tick" data-live-search="true" required  onchange="pilmapelEdit()"  ');
										   ?>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								 <input type="hidden" value="<?php echo $id_kelas;?>" name="id_kelas"> 
								 <input type="hidden" value="<?php echo $id_mapel;?>" name="id_mapel"> 
  
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black"> MAPEL</label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                              <div class="form-line" id="Edata_mapel">
                                         <select class="form-control show-tick"  >
                                        <option value="">--- Pilih ---</option>
                                        </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">JML JAM / Minggu</label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  
											<?php 
													$ray="";
												for($i=1;$i<=50;$i++){
													$ray[$i]=$i;
												} 
											 
										   $dataray=$ray;
										   echo form_dropdown("jml_jam",$dataray,$jam,'  class="form-control show-tick" data-live-search="true" required    ');
										   ?>  
                                            </div>
                                        </div>
                                    </div>
										<div class="row clearfix">
                             	             <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">TOTAL JAM 1 SEMESTER</label>
                                    </div>
                                     <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <input type="text" value="<?php echo $jmljam; ?>" onkeydown="return nomor(this, event);" placeholder="Total jam dalam satu semester" class="form-control show-tick" required name="total_jam" style="margin-left:4px;width:310px" > 
                                            </div>
                                        </div>
                                    </div>
								</div>		
								
								
									 <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">File RPP</label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  " data-toggle='tooltip'  data-original-title='Abaikan jika tidak ingin mengganti file RPP' data-placement='top'>
                                        <div class="form-group">
                                            <div class="form-line"  >
											 
											 <input type="file" name="upload" class="  form-control">
											<i class='col-pink  '> *Hanya diisi jika anda ingin mengganti file RPP sebelumnya.</i>
                                            </div>
                                        </div>
                                    </div>
									
									
                                </div>
							 
 <script>
 //$('select').selectpicker();
  $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
 </script>
			 
					 
							 <script>
							 pilmapelEdit();
  function pilmapelEdit()
 {
	  var idk=$("#Eedit").val();
			$.post("<?php echo site_url("guru_instal/getMapelDisabled/".$id_mapel.""); ?>",{idk:idk},function(data){
			  $("#Edata_mapel").html(data);
			  
		      }); 
 }
 </script>
                      