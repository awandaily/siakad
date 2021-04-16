 					
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        
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
				getNilai();
function getNilai()
{			 var kelas="<?php echo $this->m_reff->kelas_wali()?>";
			 var sms=$("[name='sms']").val();
			 loading("load");
			 $.post("<?php echo site_url("raport/getLegger"); ?>",{kelas:kelas,sms:sms},function(data){
			 $("#data_nilai").html(data);
			 unblock("load");
		      }); 
}
</script>
				
  <script>
 $('select').selectpicker();
 </script>
  
	
	
	
	
	

	  