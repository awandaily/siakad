 
 <?php
 $token=date('His');
 ?>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						
                       <div class="col-md-3 col-sx-12 col-xs-12 pull-right">
                            <input required type="text" id="periode" name="periode" class="cursor form-control" onchange="getData()" >
                       </div>
                                               
                                            
                               
						 
						
						
						<h2>KEHADIRAN PEGAWAI</h2>
                           
                        </div>
						    <div class="body">
                           <div class="row clearfix">
						   
						 <div class="col-sm-4">
                                    <select class="form-control show-tick" id="jabatan" data-live-search="true" onchange="getData()">
                                        <option value="">=== Pilih Jabatan ===</option>
                                         <?php 
									   $db=$this->db->get("tr_jabatan")->result();
									   foreach($db as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>
                                    </select>
                                </div> 
						
						
								<div class="col-sm-4">
                                    <select class="form-control show-tick" id="sts" onchange="getData()">
                                        <option value="">=== Status Kepegawiaan ===</option>
                                        <?php 
									   $db=$this->db->get("tr_sts_pegawai")->result();
									   foreach($db as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>
                                         
                                    </select>
                                </div> 
                                
								<div class="col-sm-4">
                                    <select class="form-control show-tick" id="gender" onchange="getData()">
                                        <option value="">=== Pilih Gender ===</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                         
                                    </select>
                                </div> 
								
								
								  
								
						 
						   
						    
                           </div>
						  
				 <div   id="area_lod">
			            <div   id="dataget">
                            					
						</div>						
					</div>	
                           <!----->
                        </div>
                        
                        
                        
                    </div>
                    
                     <div class="card">
                            <table class="entry" width="100%">
                                <tr>
                                    <td colspan="2"><b>Keterangan</b></td>
                                </tr>
                                <tr>
                                    <td><i class="material-icons col-green">check_circle</i></td><td>Masuk</td>
                                </tr>
                                <tr>
                                    <td><i class="material-icons col-blue-grey">highlight_off</i></td><td>Tidak masuk</td>
                                </tr>
                                <tr>
                                    <td><b class="col-pink">L</b></td><td>Libur Nasional/diliburkan</td>
                                </tr>
                                 <tr>
                                    <td><b class="col-pink">S</b></td><td>Sabtu</td>
                                </tr>
                                 <tr>
                                    <td><b class="col-pink">M</b></td><td>Minggu</td>
                                </tr>
                                 <tr>
                                    <td><b class="col-green">L</b></td><td>Libur tapi  melakukan fingerprint</td>
                                </tr>
                                 
                            </table>
                            
                        </div>
                    
                    
                </div>
                <!-- #END# Task Info -->
				

 
	
 <script>	 
 
function getData()
{	loading("area_lod");
var tgl=$("#periode").val();
var sts=$("#sts").val();
var gender=$("#gender").val();
var jabatan=$("#jabatan").val();
	$.ajax({
			url:"<?php echo base_url()?>presensi/getDataPegawai",
			data:"sts="+sts+"&periode="+tgl+"&gender="+gender+"&jabatan="+jabatan,
			type: "POST",
		//	dataType: "JSON",
			success: function(data)
					{	   
						$("#dataget").html(data);
						unblock("area_lod");
					}
			});
}
</script>	   




 <script>
$('#periode').daterangepicker({
    "showDropdowns": true,
    ranges: {
      //  'Hari ini': [moment(), moment()],
      //  'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       
    //    '30 Hari yang lalu': [moment().subtract(29, 'days'), moment()],
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Apply",
        "cancelLabel": "Cancel",
        "fromLabel": "From",
        "toLabel": "To",
        "customRangeLabel": "Sesuaikan",
        "weekLabel": "W",
        "daysOfWeek": [
			"Min",
            "Sen",
            "Sel",
            "Rab",
            "Kam",
            "Jum",
            "Sab",
             
        ],
        "monthNames": [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ],
        "firstDay": 1
    },
    "startDate": moment().subtract(1, 'month').startOf('month'),
    "endDate":  moment().subtract(1, 'month').endOf('month'),
    "opens": "left"
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');
 
});
</script>

	 