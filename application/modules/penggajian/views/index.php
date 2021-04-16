  <div class="row clearfix" style="margin-top:-20px">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_formhonor">
				<form class="form-horizontal" id="formhonor"  action="javascript:submitForm('formhonor')"   url="<?php echo base_url()?>keu_staff/input_honor"  method="post" >
                     
                    <div class="card">
					  
                        <div class="header">
						  <h2>PENGGAJIAN</h2> 
                        </div> 
                       
                             <div class="body" >
							 	<div class="row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Periode Penggajian </label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-7 cursor ">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input required type="text" id="periode" name="periode" class="cursor form-control" onchange="getData()" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
							  <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2"> Pilih Staff/Guru</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            	  <select class="select form-control show-tick"   name="id_guru"    id="id_guru" data-live-search="true" onchange="getData()"  >
                                       <option value="">==== Pilih ====</option>
										 
										 	<?php 
													$this->db->order_by("nama","asc");
												   $dbs=$this->db->get_where("data_pegawai")->result();
												   foreach($dbs as $vals){
													   echo "<option select value='".$vals->id."'>".$vals->nama."</option>";
												   } 
										   ?>	
										 
									  
											</select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                 
						  
			 
                           <!----->
                        </div></form>
                    </div>
					 <div id="area_lod">
					<div id="dataget"><div>
					 </div>
					  
                </div>
       </div>
	   
<script>	   
function getData()
{	loading("area_lod");
var tgl=$("#periode").val();
var id_guru=$("#id_guru").val();
if(!id_guru){ $("#dataget").html(""); unblock("area_lod"); return false; }
	$.ajax({
			url:"<?php echo base_url()?>penggajian/getData",
			data:"id_guru="+id_guru+"&periode="+tgl,
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
		 "searching": true,
		  
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
            "url": "<?php echo site_url('keu_staff/getHonor');?>",
            "type": "POST",
			"data": function ( data ) {
						
				 
						  
		 },
		   beforeSend: function() {
               loading("area_lod");
            },
			complete: function() {
              unblock('area_lod');
					 
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
});

  
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
 <script>
			 $(".select").selectpicker();
	  </script>