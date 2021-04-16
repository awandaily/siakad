
									 <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Pilih Mapel</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                           	<div   >
                                    <select   class="form-control show-tick id_kelas" id="id_mapel" name='id_mapel' onchange="pilihKelasbymapel()">
                                        <option value="">--- pilih ---</option>
                                         <?php 
									   $dbkelas=$this->m_reff->getMapelGuru();
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id_mapel."'>$val->nama_tingkat - ".$val->mapel."</option>";
									   }
									   ?>
                                    </select>
                                </div>
                                        </div>
                                    </div>
                                </div>
						 
									
									
							 <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Pilih Kelas</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                           	<div  id="pilihKelas">
                                    <select multyple class="form-control show-tick id_kelas" id="id_kelas" name='id_kelas' >
                                        <option value="">--- pilih ---</option> 
                                    </select>
                                </div>
                                        </div>
                                    </div>
                                </div>

									  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Masa Berlaku</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="input-group input-group-sm">
                                
                                        <div class="form-line">
                                            <input type="number" name="hari" class="form-control" value="7">
                                        </div>
                                        <span class="input-group-addon">Hari</span>
                                    </div>
                                    </div>
                                    
                                     
                                </div>

							 
					 
								
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Judul Tugas </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <input type="text" class="form-control" required name="f[judul]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Keterangan </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <textarea class="form-control" required name="f[ket]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
									<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Upload File (Opsional) </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        	
												   <div class="form-group">
                                            <div class="form-line"  >
											  <input type="file" name="file" class='form-contol' accept="JPG,jpg,JPEG,PNG.png,docx,pdf,pptx,xlsx*">
												 
                                    </div>
                                    </div>
                                    </div>
                                </div>
									
									
									 <script>
  function pilsiswa()
 {
	  var idk=$("[name='f[id_kelas]']").val();
			$.post("<?php echo site_url("kirim_tugas/getSiswa"); ?>",{idk:idk},function(data){
			  $("#data_siswa").html(data);
		      }); 
 }
 function pilihKelasbymapel()
 {
     var idm=$("[name='id_mapel']").val();
			$.post("<?php echo site_url("kirim_tugas/getKelasByMapel"); ?>",{idm:idm},function(data){
			  $("#pilihKelas").html(data);
		      }); 
 }
 
 </script>
		
		<?php
		$mobile=$this->m_reff->mobile();
		if(!$mobile)
		{?>
	 <script>
 $('select').selectpicker();
 </script>
			 	    
<?php		}
?>
			 