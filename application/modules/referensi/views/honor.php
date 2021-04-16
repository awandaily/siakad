  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="load">
      
           
				   
                                    <div class="col-lg-12 col-md-12 card "><br>
									<center class='col-teal font-bold'>TETAPKAN HONOR PETUGAS PIKET  </center>
                                        <div class="form-group">
                                            <div class="form-line">
										 <?php 
										 $value=$this->m_reff->goField("tm_pengaturan","val","where id='5' ");
										 ?>
										 <input onchange="setHonor()" name="honor" type="text" style='text-align:center' class="form-control" name="honor" value="<?php echo $value;?>">
                                            </div><br>
                                        </div>
                                    </div>
									<br>
									<br>
		  
    
  </div>
   <script>
 $('select').selectpicker();
 function setHonor()
 {	 loading("load");
	var honor=$("[name='honor']").val();
	 $.post("<?php echo site_url("referensi/setHonor"); ?>",{honor:honor},function(data){
			  unblock("load");
				notif("Berhasil di simpan!");
		      }) 
 }
 </script>
 
 
 
 
