 	<?php
									$skrg = $jam=$this->m_reff->jam_aktif();
									if(!$skrg)
									{
									    $saat="<i class='col-deep-orange'>belum masuk jam mengajar</i>";
									}else{
									    $saat=$skrg;
									}
								?>
 <?php
 $token=date('His');
 ?>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						 
						
						<h2>SAAT INI JAM KE : <?php echo $saat;?></h2>
                           
                        </div>
						    <div class="body">
                           <div class="row clearfix">
						   
								  
							
                           		<div class="col-md-2">
                           			<div class="form-line">
	                           			<label>Lihat Jam Ke : </label>
	                           			<select class="form-control show-tick" id="id_jam" onchange="kelasLoad()">
	                           				<?php
	                           					for($i = 1;$i <= 10;$i++){
	                           						if ($i == $skrg) {
	                           							echo "<option value='".$i."' selected>".$i."</option>";
	                           						}
	                           						else{
	                           							echo "<option value='".$i."'>".$i."</option>";
	                           						}

	                           						
	                           					}
	                           				?>
	                           			</select>
                           			</div>
                           		</div>
                           		<!--
								<div class="col-md-6">
                                    <select class="form-control show-tick" id="id_kelas" data-live-search="true"   onchange="kelasLoad()">
                                       
                                        <option value="">=== JADWAL SEDANG BERLANGSUNG ===</option>
										
										
											<?php 
										   $db=$this->db->get("tr_tingkat")->result();
										   foreach($db as $val){
											   echo "<optgroup label='TINGKAT ".$val->nama."'>";
												 
												   $dbs=$this->db->get_where("v_kelas",array("id_tk"=>$val->id))->result();
												   foreach($dbs as $vals){
													   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
												   }
												  
											   echo "</optgroup>";
										   }
										   ?>
									  
                                    </select>
                                </div> -->
								
								<div class="col-md-3">
                                  
                                    <div class="form-line">
                                    	<label>Tanggal : </label>
                                        <input required type="text" id="tgl" autocomplete="off" name="tgl" class="form-control" onchange="kelasLoad()">
                                    </div>
                                  <script>
                                  //$("#hari").val(<?php echo date("N");?>);
								  </script>
                                    
                                </div>	
						 
							 
						    
                           </div>
						  
				 <div id="area_lod">
			            <div id="isi">      
					
						</div>						
					</div>						
					</div>	
                           <!----->
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
 
 <script>
 
 

	function detail(id,nama)
	{ 
		$("#judul_mdl_edit").html(nama);
					   $("#mdl_formSubmit_edit").modal( );
					    $("#formSubmit_edit").attr("url","<?php echo base_url("data_pendidik/detail_pendidik");?>");
					 	    $.post("<?php echo site_url("data_pendidik/detail_pendidik"); ?>",{id:id},function(data){
							   						    $("#edit_isi").html(data);
														});
	}							

</script>
	
 
	 
	
	 
 <script>
	
 
    

	function kelasLoad()
	{			 var jam 	= $("#id_jam").val();
				 var hari 	= $("#hari").val();
				 var tgl 	= toTglSys($("#tgl").val());

				 loading("area_lod");
				 $.post("<?php echo site_url("data_pendidik/getKelasJadwal"); ?>",{jam:jam,hari:hari, tgl:tgl},function(data){
				$("#isi").html(data);
				 	unblock("area_lod");
			    }); 
	}
</script>
	
	
	
	<script>
	     function toTglSys(v){
        //02-12-1996
        //0123456789

        var tgl = v.substr(0,2);
        var bln = v.substr(3,2);
        var thn = v.substr(6,4);

        var value = thn+"-"+bln+"-"+tgl;

        return value;
    }
	</script>
	<script>
	    	$('#tgl').daterangepicker({
		//maxDate: new Date(),
	    "singleDatePicker": true,
	    "showDropdowns": true,
	    "dateLimit": {
	        "days": 7
	    },
		"autoApply": false,
		"drops": "down",
	    "locale": {
	        "format": "DD/MM/YYYY",
	        "separator": " - ",
	        "applyLabel": "Apply",
	        "cancelLabel": "Cancel",
	        "fromLabel": "From",
	        "toLabel": "To",
	        "customRangeLabel": "Custom",
	        "weekLabel": "W",
	        "daysOfWeek": [
	            "MIN",
	            "SEN",
	            "SEL",
	            "RAB",
	            "KAM",
	            "JUM",
	            "SAB"
	        ],
	        "monthNames": [
	            "Januari",
	            "Februari",
	            "Maret",
	            "April",
	            "Mei",
	            "Juni",
	            "Juli",
	            "Augustus",
	            "September",
	            "Oktober",
	            "November",
	            "Desember"
	        ],
	        "firstDay": 1
	    },
	    "showCustomRangeLabel": false,
	    "startDate": "<?php echo date("d/m/Y")?>",   
	});
	</script>
	
	<script>
	    function detail(id,nama)
{ 
	$("#judul_mdl_edit").html(nama);
				   $("#mdl_formSubmit_edit").modal( );
				    $("#formSubmit_edit").attr("url","<?php echo base_url("data_pendidik/detail_pendidik");?>");
				 	    $.post("<?php echo site_url("data_pendidik/detail_pendidik"); ?>",{id:id},function(data){
						   						    $("#edit_isi").html(data);
													});
}	
	</script>
	
 
	<!-- Modal -->
<div class="modal fade" id="mdl_formSubmit_edit" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="area_formSubmit_edit">
        <div class="modal-content">
	 
                
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" id="judul_mdl_edit">  </h4>
            </div>
            
            <!-- Modal Body -->
				<div id="edit_isi"></div>
            <div class="row clearfix"></div>
            <div class="modal-footer">
			  
                         
                        </div>
           
        
		</div>
    </div>
</div>