 					
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                         <div class="col-md-2"  >     <h2 style='font-size:16px'>Rekapitulasi Nilai</h2> </div>
						  <div class="col-md-6" style="margin-top:-9px" >
                                     <select id="idkelas" name="idkelas" class="form-control show-tick " onchange="getNilai()"  >
                                        <option value="" >=== Pilih Kelas / Mapel ===</option>
										
										
											<?php 
										   $db=$this->mdl->mapelAjar();
										   foreach($db as $val){
											       echo "<option value='".$val->id."'>Kelas :".strtolower($val->kelas)." || Mapel :".strtolower($val->mapel)."</option>";
										   }
										   ?>
									  
                                    </select>   
                            </div>  
							<div class="col-md-4" style="margin-top:-9px" >
                                        
									<?php 
									 $sms=$this->m_reff->semester();
									$ray[1]="Semester Ganjil";
									$ray[2]="Semester Genap";
								//	$ray[3]="Satukan Nilai";
									$dataray=$ray;
									echo form_dropdown("sms",$dataray,$sms,"class='form-control' onchange='getNilai()' ");?>
                            </div>  
							
							
							  
							 <br>
                        </div>
                       
                           <!----->
				 <div class="card" id="load">
                        <div class="body">
                            <div class="table-responsive">
                              <div id="data_nilai"></div>
							</div>						
						</div>						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				<script>
function getNilai()
{			 var kelas=$("[name='idkelas']").val();
			 var sms=$("[name='sms']").val();
			 loading("load");
			 $.post("<?php echo site_url("kesiswaan/getNilai"); ?>",{kelas:kelas,sms:sms},function(data){
			 $("#data_nilai").html(data);
			 unblock("load");
		      }); 
}
</script>
				
  <script>
 $('select').selectpicker();
 </script>
  
	
	
	
	
	

	  