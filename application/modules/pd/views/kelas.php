 					
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                         <div class="col-md-2"  >     <h2 style='font-size:16px'>Pilih Kelas</h2> </div>
						  <div class="col-md-5"   >
                                    <select class="form-control show-tick fkelas" name="idkelas"  id="fkelas" data-live-search="true"  onchange="kelasLoad()">
                                        <option value="">=== Filter Kelas ===</option>
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
                            </div>  
							 
							
							 					
							<div class="col-md-5"   >
							<div class="form-group">
                                            <div class="form-line">
                                                <input  type="text" id="pilihtgl"  name="tgl" class="form-control cursor">
                                            </div>
                                        </div>
                            </div>  
							 
							
							 
							  
							 <br>
                        </div>
                       
                           <!----->
				 <div class="card" id="load">
                        <div class="body">
                            <div class="table-responsive">
                              <div id="data_kelas"><center><i>Silahkan Pilih Kelas Terlebih Dahulu.</i></center></div>
							</div>						
						</div>						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
	
				<script>
			 
function kelasLoad()
{			 var kelas=$("[name='idkelas']").val();
			 var tgl=$("[name='tgl']").val();
			 loading("load");
			 $.post("<?php echo site_url("pd/getKelas"); ?>",{kelas:kelas,tgl:tgl},function(data){
			 $("#data_kelas").html(data);
			 unblock("load");
		      }); 
}
</script>
				
  <script>
 $('select').selectpicker();
 </script>
  
	
	<script>
 function unbloking(id_guru,id_kelas,id_jadwal,id_jam,jam_blok,tgl)
 {
	  
	  $.post("<?php echo site_url("pd/unblok"); ?>",{jam_blok:jam_blok,id_guru:id_guru,id_kelas:id_kelas,id_jadwal:id_jadwal,id_jam:id_jam,tgl:tgl},function(data){
			      
				kelasLoad();
		      })
 };

 function absenkaning(id_guru,id_kelas,id_jadwal,id_jam,jam_blok,mapel,tgl)
 {
	  
	  $.post("<?php echo site_url("pd/absenkan"); ?>",{mapel:mapel,jam_blok:jam_blok,id_guru:id_guru,id_kelas:id_kelas,id_jadwal:id_jadwal,id_jam:id_jam,tgl:tgl},function(data){
			     kelasLoad();
		      })
 };

 function bloking(id_guru,id_kelas,id_jadwal,id_jam,jam_blok,tgl)
 {
	   
	  $.post("<?php echo site_url("pd/blok"); ?>",{jam_blok:jam_blok,id_guru:id_guru,id_kelas:id_kelas,id_jadwal:id_jadwal,id_jam:id_jam,tgl:tgl},function(data){
			      
				kelasLoad();
		      })
 };
 
 function bloking_inval(id_guru,id_kelas,id_jadwal,id_jam,jam_blok,tgl)
 {
	   
	  $.post("<?php echo site_url("pd/blok_inval"); ?>",{jam_blok:jam_blok,id_guru:id_guru,id_kelas:id_kelas,id_jadwal:id_jadwal,id_jam:id_jam,tgl:tgl},function(data){
			      
				kelasLoad();
		      })
 };
 function unbloking_inval(id_guru,id_kelas,id_jadwal,id_jam,jam_blok,tgl)
 {
	   
	  $.post("<?php echo site_url("pd/unbloking_inval"); ?>",{jam_blok:jam_blok,id_guru:id_guru,id_kelas:id_kelas,id_jadwal:id_jadwal,id_jam:id_jam,tgl:tgl},function(data){
			      
				kelasLoad();
		      })
 };
 
 
 
 </script>
	
	
	

	  				
<script> 
$('#pilihtgl').daterangepicker({
	//maxDate: new Date(),
    "singleDatePicker": true,
    "showDropdowns": true,
    "dateLimit": {
        "days": 7
    },
	  "autoApply": true,
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
            "M",
            "S",
            "S",
            "R",
            "K",
            "J",
            "S"
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
   
},
function cb() {      
setTimeout(function(){ kelasLoad(); }, 300); 
		
    });

 
 </script>   