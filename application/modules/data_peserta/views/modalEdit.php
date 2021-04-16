
							<center>  <label>
					   <div style="max-width:200px">  
								<b>	PHOTO PROFILE</b><br>				   
                                  <img  id="blah"  alt="" height="100px" />
								  <input type='file' accept=".JPG,.jpg,.png" name="poto" id="imgInp" class="form-control upload"  />
							</div>	 
							 </label>
						</center>
								<hr>
								
								<div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[owner]"   required>
                                        <label class="form-label">Nama</label>
                                    </div>
                                </div>
								
								 <div class="form-group form-float">
                                   <span class="card-inside-titles col-md-3"   >Jenis Kelamin</span>
								 <span style="margin-left:14px">
									<input name="f[jk]" type="radio" id="radio_1" value="l"  />
									<label for="radio_1">laki-laki</label>
									<input name="f[jk]" type="radio" id="radio_2" value="p"  />
									<label for="radio_2">Perempuan</label>
								 </span>
							    </div>
							 
							 
                              <div class="col-md-3 " style="margin-top:-10px">      
							  <span class="card-inside-titles">Kategory</span></div> 
							  <div class="col-md-9"  style="margin-top:-20px">
                                    
                              			<?php
										$kategory[""]="=== pilih ===";
										$data_penulis=$this->db->get("tr_kategory_penulis")->result();
										foreach($data_penulis as $val)
										{
											$kategory[$val->id]=$val->nama;
										}
											$default=$kategory;
										 
										echo form_dropdown("f[id_kategory_penulis]",$default,"",'class="form-control col-md-12" required');
										?>
                                   
                                </div> <hr>
                          <div class="col-md-12 row clearfix">&nbsp;</div>
						  <hr>
						   <div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[telp]"   required>
                                        <label class="form-label">Telpon</label>
                                    </div>
                                </div>
								
								<div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[email]"   required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
									 
			 
					<div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <textarea type="text" class="form-control" name="f[alamat]"  required> </textarea>
                                        <label class="form-label">Alamat Lengkap</label>
                                    </div>
                                </div>
								
								<div class="form-group form-float success">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[username]"   required>
                                        <label class="form-label">Username</label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="password" value="" >
                                        <label class="form-label">Password baru</label>
                                    </div>
                                </div>
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  class="btn bg-teal waves-effect" onclick="save_profile_modal('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>
