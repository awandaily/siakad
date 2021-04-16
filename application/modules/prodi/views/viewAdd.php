
								
						 
									
								 
									  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">NAMA MITRA</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											<input type="text" class="form-control" required name="f[nama]"></input>
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
											<input type="text" class="form-control" required name="f[quota]"></input>
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
											  <textarea class="form-control" required name="f[lokasi]"></textarea>
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
											  <textarea class="form-control" required name="f[ket]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
									
									
									
									 <script>
  function pilsiswa()
 {
	  var idk=$("[name='f[id_kelas]']").val();
			$.post("<?php echo site_url("catatan/getSiswa"); ?>",{idk:idk},function(data){
			  $("#data_siswa").html(data);
		      }); 
 }
 </script>
									
									
 <script>
 $('select').selectpicker();
 </script>
			 