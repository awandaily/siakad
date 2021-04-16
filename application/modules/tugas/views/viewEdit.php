 <?php $database=$this->db->get_where("tm_catatan",array("id"=>$this->input->post("id")))->row();  ?>		
<input type="hidden" name="id" value="<?php echo $database->id;?>"> 
									  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">PILIH KELAS</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                        
										
											 
										   <?php 
										$ray="";
										 
										$data=$this->db->get("v_kelas")->result();
										foreach($data as $val){
											$ray[$val->id]=$val->nama;
										}
										$dataray=$ray;
										echo form_dropdown("f[id_kelas]",$dataray,$database->id_kelas,"class='form-control show-tick' onchange='pilsiswa2()' id='fid_kelas' data-live-search='true'");?>
									 
                                            </div>
                                        </div>
                                    </div>
                                </div>

									  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">NAMA SISWA</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_siswa2">
											<select class="form-control" required><option>=== Pilih ===</option></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

							 <!--
								
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">JENIS CATATAN</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" >
                                        
								 
										$ray="";
										$ray[]="=== Pilih ===";
										$data=$this->db->get("tr_jenis_catatan")->result();
										foreach($data as $val){
											$ray[$val->id]=$val->nama;
										}
										$dataray=$ray;
										echo form_dropdown("f[id_jenis]",$dataray,$database->id_jenis,"class='form-control show-tick' id='id_mapel' ");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
									<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">TERUSKAN KE   </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
									<?php
									$ortu=''; $bp="";$siswa="";
									$pos=strpos($database->teruskan,'1');
									if($pos!==false){
										$bp='checked=""';  
									}
									$pos=strpos($database->teruskan,'2');
									if($pos!==false){
										$ortu='checked=""'; 
									}
									
									$pos=strpos($database->teruskan,'3');
									if($pos!==false){
										$siswa='checked=""'; 
									}
									?>
                                        <div class="form-group">
                                            <div class="form-line"  >
											 
												<input id="md_checkbox_22" class="filled-in chk-col-red" name='t[]' <?php echo $bp;?> value='1' type="checkbox">
												<label for="md_checkbox_22" class='col-black'>Guru BP&nbsp;&nbsp;&nbsp;</label>
												<input id="md_checkbox_23" class="filled-in chk-col-red" name='t[]' <?php echo $ortu;?> value='2' type="checkbox">
												<label for="md_checkbox_23"  class='col-black'>Orang Tua&nbsp;&nbsp;&nbsp;</label>
												<input id="md_checkbox_24" class="filled-in chk-col-red" name='t[]' <?php echo $siswa;?> value='3' type="checkbox">
												<label for="md_checkbox_24"  class='col-black'>Siswa&nbsp;&nbsp;&nbsp;</label>
												 
                                    </div>
                                    </div>
									
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">KETERANGAN </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <textarea class="form-control" required name="f[ket]"><?php echo $database->ket;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
									
									
									
									 <script>
									 
  pilsiswa2();
  function pilsiswa2()
 {
	  var idk=$("#fid_kelas").val();
	  var val="<?php echo $database->id_siswa;?>";
			$.post("<?php echo site_url("catatan/getSiswa"); ?>",{idk:idk,val:val},function(data){
			  $("#data_siswa2").html(data);
		      }); 
 }
 </script>
									
									
 <script>
 $('select').selectpicker();
 </script>
			 