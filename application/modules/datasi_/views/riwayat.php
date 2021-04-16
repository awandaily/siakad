  <?php $token=date("His")?>

		 
		<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="info-box hover-zoom-effect">
                        <div class="icon bg-light-blue">
                            <i class="material-icons">monetization_on</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL UANG PEMABAYARN</div>
                            <div class="number">  </div>
                        </div>
                    </div>
                </div>
               
                
            </div>
		
		
		
		
	 
	
	<div class="row clearfix" >	
		
 	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="blockarea"  >
                        
                        <div class="bodyd" style="min-height:200px;padding:10px">
						<!---------------------->
					 
								<div class="col-sm-6" id="bulan">
                                       <?php 

									  $awal=$this->tanggal->minTgl(10,date('Y-m-d'));
									  $awal=$this->tanggal->eng($awal,"-");
									  $awal=$this->tanggal->ind($awal,"/");
									   
									   ?>
								 <input value="<?php echo $awal;?> - <?php echo date("d/m/Y");?>" id="ftanggal<?php echo $token?>" readonly class="cursor form-control col-md-12 " type="text" >
							            
                        </div>
								
								
								 
								<div class="col-sm-3"></div>
								<div class="col-sm-3">
                                     
                                <button onclick="filter()" type="button" class="btn btn-block bg-indigo waves-effect">
                                    <i class="material-icons">search</i>
                                    <span>Filter  </span>
                                </button>
                                    
                             
                                    
                                </div>
							  <div class="clearfix"> </div>
							  <br>
						<div class="table-responsive" id="area_lod">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >TANGGAL </th>
									<th class='thead' >SISWA</th>
									<th class='thead' >JUMLAH PEMBAYARAN </th>
									<th class='thead' >RINCIAN</th>
								</thead>
							</table>
							</div>			
                     		<!---------------------->
						 
                           </div>
						   <div class="row">&nbsp;</div><br>
						</div>
         </div>
	
 </div>
	 <script>
	  var  dataTable = $('#table').DataTable({ 
		"paging": true,
        "processing": false, //Feature control the processing indicator.
		"language": {
					 "sSearch": "Pencarian",
					 "processing": ' <span class="sr-only dataTables_processing">Loading...</span> <br><b style="color:black;background:white">Proses menampilkan data<br> Mohon Menunggu..</b>',
						  "oPaginate": {
							"sFirst": "Hal Pertama",
							"sLast": "Hal Terakhir",
							 "sNext": "Selanjutnya",
							 "sPrevious": "Sebelumnya"
							 },
						"sInfo": "",
						 "sInfoEmpty": "",
						   "sZeroRecords": "Data tidak tersedia",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": false,
		 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
		/* {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1]
                },text:'Export Excell',
							
                    },*/
					
					  
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('datasi/getHistory');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.tgl= $('#ftanggal<?php echo $token?>').val();
						  data.id_siswa= $("[name='nama']").val();
						  data.nis= $("[name='nis']").val();
						  
		 },
		   beforeSend: function() {
               loading("area_lod");
            },
			complete: function() {
              unblock('area_lod');
						  var tgl= $('#ftanggal<?php echo $token?>').val();
						  var id_siswa= $("[name='nama']").val();
						  var nis= $("[name='nis']").val();
			  getJml(tgl,id_siswa,nis);
            },
			
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
     	  
	 
		var x=0; 
	   $(document).on('change', '#ftanggal<?php echo $token?>', function (event, messages) {			   
        
			 dataTable.ajax.reload(null,false);	
		 
		});
	 
	</script>
	
						
						
						
<script>
var link="<?php echo base_url()?>";
 
function getJml(tgl,id_siswa,nis)
{	  
    $.ajax({
	 url:link+"datasi/getJml",
     data:"tgl="+tgl+"&id_siswa="+id_siswa+"&nis="+nis,
	 method:"POST",
     success: function(data)
            {
				 $(".number").html(data);	
            }
    });   
}

function rincian(id,id_siswa,tgl)
{	loading();
	 
	  $("#mdl_rincian").modal();
    $.ajax({
	 url:link+"datasi/getRincian",
     data:"id="+id+"&id_siswa="+id_siswa+"&tgl="+tgl,
	 method:"POST",
     success: function(data)
            {
				 $("#isiRincian").html(data);		
				 unblock(); 
            }
    });   
}
</script>						
						
			    
<script>
 function getAction()
 {
	 	 dataTable.ajax.reload(null,false);	
 }
 function table_reload()
 {
	  dataTable.ajax.reload(null,false);	
 }
 
  function filter()
  { 
			  $("#mdl_filter").modal();

  }
 
 
function gantiBulan(bulan,tahun)
{
	var bulan=$("[name='bulan']").val();
	var tahun=$("[name='tahun']").val();
	$.ajax({
	 url:link+"abs/getDataBulan",
     data:"bulan="+bulan+"&tahun="+tahun,
	 method:"POST",
     success: function(data)
            {
				 $("#bulan").html(data);		
	        }
    });   
	 
}
</script>		


	
  <!-- Modal -->
<div class="modal fade" id="mdl_rincian" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="area_formSubmit">
        <div class="modal-content">
	 
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" > RINCIAN PEMBAYARAN </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="col-md-12 body" id="isiRincian">    
       
                  
            </div>
            </div>
            <div class="row clearfix"></div>
            <div class="modal-footer">
			   
                        </div> 
		</div>
    </div>
</div>



  
	
  <!-- Modal -->
<div class="modal fade" id="mdl_filter" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="area_formSubmit">
        <div class="modal-content">
	 
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" > FILTER PENCARIAN </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="col-md-12 body">    
      
			<form class="form-horizontal">
			
			 
			
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">NIS/NISN</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                       <input type="text" name="nis" class='form-control' onchange="table_reload()">
									   </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<br>
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">KELAS</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                      	  <select class="form-control show-tick" id="id_kelas" data-live-search="true"   onchange="kelasLoad()">
                                       
											<option value="">=== PILIH ===</option>
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
									  
											</select>   </div>
                                        </div>
                                    </div>
                                </div><br>
								
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">PILIH SISWA</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="getNama">
                                         <input type="text" id="nama" class="form-control" disabled placeholder="Silahkan pilih kelas terlebih dahulu">
										 </div>
                                        </div>
                                    </div>
                                </div>
								
							 
								
								
			</form>					
	  
	  
                  
            </div>
            </div>
            <div class="row clearfix"></div>
            <div class="modal-footer">
			   
                        </div> 
		</div>
    </div>
</div>



  
   
<script>
  function kelasLoad()
 {
	
	 var id=$("#id_kelas").val();
	 $.post("<?php echo site_url("datasi/getNamaSiswa"); ?>",{id:id},function(data){
		$("#getNama").html(data);
	 });
 }
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
 
</script>			

 






<script>	

$('#ftanggal<?php echo $token;?>').daterangepicker({
    "showDropdowns": true,
    ranges: {
      //  'Hari ini': [moment(), moment()],
      //  'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '10 Hari yang lalu': [moment().subtract(9, 'days'), moment()],
        '30 Hari yang lalu': [moment().subtract(29, 'days'), moment()],
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
        "customRangeLabel": "Custom",
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
    "startDate": "<?php echo $this->tanggal->minTgl(10,date("Y/m/d"));?>",
    "endDate": "<?php echo date("d/m/Y");?>",
    "opens": "left"
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');
 
});
 $( document ).ready(function() {

$('#ftanggal<?php echo $token;?>').daterangepicker({
    "showDropdowns": true,
    ranges: {
      //  'Hari ini': [moment(), moment()],
      //  'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '10 Hari yang lalu': [moment().subtract(9, 'days'), moment()],
        '30 Hari yang lalu': [moment().subtract(29, 'days'), moment()],
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
        "customRangeLabel": "Custom",
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
    "startDate": "<?php echo $this->tanggal->minTgl(10,date("Y/m/d"));?>",
    "endDate": "<?php echo date("d/m/Y");?>",
    "opens": "left"
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');
 
});

 });

</script>									