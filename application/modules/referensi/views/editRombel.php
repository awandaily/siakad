 <input type="hidden" name="id" value="<?php echo $this->input->post("id"); ?>">
 <input type="hidden" name="id_wali" value="<?php echo $this->input->post("id_wali"); ?>">
 <?php
    $id_tk = $this->input->post("id_tk");
    $id_jurusan = $this->input->post("id_jurusan");
    $id_wali = $this->input->post("id_wali");
    $nama = $this->input->post("nama");
    ?>
 <!--			<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">PILIH TINGKAT</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
										 php 
										    
										 $ray[1]="Tingkat X";
										 $ray[2]="Tingkat XI";
										 $ray[3]="Tingkat XII";
											 
										   $dataray=$ray;
										   echo form_dropdown("f[id_tk]",$dataray,$id_tk,'class="form-control show-tick"  required    ');
										   ?>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">PILIH JURUSAN</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
										php 
										   $db=$this->db->get("tr_jurusan")->result(); 
										   foreach($db as $val){
											  $ray[$val->id]=$val->alias;
											 }
										   $dataray=$ray;
										   echo form_dropdown("f[id_jurusan]",$dataray,$id_jurusan,'class="form-control show-tick"  required ');
										   ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
  
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">NAMA ROMBEL</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input type="text"   class="form-control" name='f[nama]' value="<?php echo $nama; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								--->
 <div class="row clearfix">
     <div class="col-lg-3 col-md-3  form-control-label">
         <label for="email_address_2" class="col-black">WALI KELAS</label>
     </div>
     <div class="col-lg-8 col-md-8  ">
         <div class="form-group">
             <div class="form-line">
                 <?php
                    $db = $this->db->get("data_pegawai")->result();
                    $ray = array();
                    $ray[""] = " ==== Pilih ====";
                    foreach ($db as $val) {
                        $ray[$val->id] = $val->nama . ' - Nip. ' . $val->nip;
                    }
                    $dataray = $ray;
                    echo form_dropdown("f[id_wali]", $dataray, $id_wali, 'class="form-control show-tick"    data-live-search="true"');
                    ?>
             </div>
         </div>
     </div>
 </div>

 <script>
     $('selects').selectpicker();
 </script>