 <?php
$dbs=$this->db->query("select * from v_jadwal where id_guru='".$this->mdl->idu()."' and ids='1' ")->num_rows();
if(!$dbs){  
echo "<div class='card'>
<h4 style='padding:10px'>   Tidak ada mapel yang mewajibkan penginputan nilai sikap.  </h4>
</div>";
return true;
  }?>					
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header row">
                         <div class="col-md-2" style="padding-bottom:15px" >     <h2 style='font-size:16px'>Input Nilai Sikap</h2> </div>
						  <div class="col-md-10"   >
                                     <select id="idkelas" name="idkelas" class="form-control show-tick " onchange="getNilai()"  >
                                        <option value="" >=== Pilih Kelas / Mapel ===</option>
										
										
											<?php 
										   $db=$this->mdl->mapelAjarSikap();
										   foreach($db as $val){
											       echo "<option value='".$val->id."'>Kelas :".strtolower($val->kelas)." || Mapel :".strtolower($val->mapel)."</option>";
										   }
										   ?>
									  
                                    </select>   
                            </div>  
						<!--	<div class="col-md-5"  >
                                        
								 
									 $sms=$this->m_reff->semester();
									$ray[1]="Semester Ganjil";
									$ray[2]="Semester Genap";
								//	$ray[3]="Satukan Nilai";
									$dataray=$ray;
									echo form_dropdown("sms",$dataray,$sms,"class='form-control' onchange='getNilai()' ");?>
                            </div>  -->
							
							 
							  
							 
                        </div>
                       
                           <!----->
				 <div class="card" id="load">
                        <div class="body">
                            <div class="table-responsive">
                              <div id="data_nilai"><center><i>Pilih kelas terlebih dahulu</i></center></div>
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
			 $.post("<?php echo site_url("kesiswaan/getSikap"); ?>",{kelas:kelas,sms:sms},function(data){
			 $("#data_nilai").html(data);
			 unblock("load");
		      }); 
}
</script>
				
  <script>
 $('select').selectpicker();
 </script>
  
	
	
	
	
	

	  