  	<script>							 
									 
 function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
      $('.image img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>



             <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>BACKUP DATABASE</h2> 
                        </div>
                        <div class="body">
                           <!----->
				 <div  >
                        <div >
                            <div class=" ">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
								
									<th class='thead' >NAMA PENGATURAN </th>
									<th class='thead' >  </th>
									 
								</thead>
								
								<tr>
								<td>1</td>
								<td>Nama Database</td>
								<td>
								
								 <input type="text" id="val_15" name="val_15" onchange='save_(`15`,`val_15`)' class='form-control' value="<?php echo $this->m_reff->tm_pengaturan(15);?>">
								
								</td>
								</tr>
								
								
									<tr>
								<td>2</td>
								<td>Download Table</td>
								<td>
								<form action="<?php echo base_url();?>pengaturan/backuptb" method="post">
                                 <div class="col-md-8">   <select required="" data-actions-box="true" multiple name="tabel[]" class="form-control select" data-live-search="true" data-selected-text-format="count">
                                        <?php
                                        $nama="Tables_in_".$this->m_reff->tm_pengaturan(15);
                                           foreach ($tabel as $baris) {  ?>
                                            <option value="<?php echo $baris->$nama; ?>"><?php echo $baris->$nama; ?></option>
                                        <?php } ?>
                                    </select></div>
                                    <div class="col-md-4">
                                    <button type="submit"  class="waves-effect btn bg-teal" >Backup Table</button>
                                    </div>
                                </form>
								</td>
								</tr>
																	<tr>
								<td>3</td>
								<td>Download Database Untuk CBT</td>
								<td>
								<form action="<?php echo base_url();?>pengaturan/backuptbcbt" method="post"> 
                                    <button type="submit" class="waves-effect btn bg-teal">Download</button>
                                </form>
								</td>
								</tr>
								
                            	<tr>
								<td>4</td>
								<td>Table View Database</td>
								<td>
								
								 <textarea id="val_16" name="val_16" onchange='save_(`16`,`val_16`)' class='form-control'> <?php echo $this->m_reff->tm_pengaturan(16);?></textarea>
								 
								
								</td>
								</tr>
								
								
								 
							</table>
							</div>						
						</div>						
					</div>	
                           <!----->
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
  
	
 

	
 <script> 
	$('select').selectpicker();  
	</script>
   
<script>
  $('#val_2').jqte();
  $('#val_3').jqte();
  $('#val_4').jqte();
 
 function save_(idpengaturan,idkonten)
	 {	 
	 var idkonten=$("[name='"+idkonten+"']").val();
		 $.ajax({
		 url:"<?php echo base_url()?>pengaturan/save_",
		 data: "idpengaturan="+idpengaturan+"&idkonten="+idkonten,
		 method:"POST",
		 success: function(data)
            {	 
				 notif_success("<span class='sadow white'><div class='demo-google-material-icon'> <i class='material-icons'>done_all</i> <span class='icon-name'>Tersimpan!</span>");
            }
		});
	 }
	  
 
    
	
</script>


 