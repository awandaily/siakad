 					
 
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
                
                
                
                
                <?php  
                               $semester=$this->m_reff->semester();
                             	$tahun_real=$this->m_reff->tahun_asli();
	                        	$tahun_kini=$this->m_reff->tahun();
                            	if($tahun_real==$tahun_kini){
                            $idkelas=$this->m_reff->goField("tm_kelas","id","where id_wali='".$this->mdl->idu()."'");
	                        	}else{ 
	                        	
	                        	   $getIdSiswa=$this->m_reff->goField("tm_catatan_walikelas","id_siswa","where _cid='".$this->mdl->idu()."' and id_tahun='".$tahun_kini."' order by RAND()  limit 1");
	                         	   $idkelas=$this->m_reff->getHisKelas($getIdSiswa);   
	                        	} 
                             ?>
                             
                             
                             
				<script>
				getNilai();
function getNilai()
{			 var kelas="<?php echo $idkelas;?>";
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
  
	
	
	
	
	

	  