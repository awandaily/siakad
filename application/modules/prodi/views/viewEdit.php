 <?php $database=$this->db->get_where("tr_mitra",array("id"=>$this->input->post("id")))->row();  ?>		
<input type="hidden" name="id" value="<?php echo $database->id;?>"> 
							 

				
									
								 
									  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">NAMA MITRA</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											<input type="text" class="form-control" required name="f[nama]" value="<?php echo $database->nama;?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>

							 
					 	  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">JUMLAH QUOTA</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											<input type="text" class="form-control" required name="f[quota]"  value="<?php echo $database->quota;?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							 
								
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">LOKASI/ALAMAT </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <textarea class="form-control" required name="f[lokasi]"><?php echo $database->lokasi;?></textarea>
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
 $('select').selectpicker();
 </script>
			 