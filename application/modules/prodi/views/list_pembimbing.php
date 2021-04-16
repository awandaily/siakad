<?php $token=date("His");?>  
  <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                     <!--   <div class="header">  
						<h2 class="sound">DATA SISWA KELAS XI (SEBELAS)
						    
                        </div>--->
						   
                           <div  >
						   
					 
							 
								<div class="col-sm-4">
                                     <select class="form-control show-tick"   onchange="reload_table()"  id="mitraf<?php echo $token;?>" >
                                        <option value="" selected>=== Filter Mitra PKL ===</option>
										
										
											<?php 
											$tahun=$this->m_reff->tahun();
											$sms=$this->m_reff->semester();
											$this->db->order_by("nama","ASC");
										    $db=$this->db->get_where("tr_mitra")->result();
										     foreach($db as $vals){
													   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
												   }
										   ?>
									  
                                    </select>
                                </div> 
								
								
							 
								<div class="col-sm-4">
								<select class="form-control show-tick"   onchange="reload_table()"  id="id_pembimbing" data-live-search="true" >
                                        <option value="" selected>=== Filter pembimbing ===</option>
										 
											<?php 
											 
										    $db=$this->db->get_where("v_pegawai")->result();
										     foreach($db as $vals){
													   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
												   }
										   ?>
									  
                                    </select>
								</div>
								<div class="col-sm-4">
							 	
								<div class="input-group date" id="bs_datepicker_component_container">
                                        <div class="form-line">
                                            <input type="text"  id="cari" class="form-control" placeholder="Please choose a date..." onchange="reload_table()">
                                        </div>
                                        <span class="input-group-addon">
                                           <button onclick="semua()">semua</button>  
                                        </span>
                                    </div>
                                    
                                    
								</div>
								
								
							 
						 
						    
                           </div>
						   <div class="clearfix body">
				 <div   id="area_lod">
			            <div  >
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable"  style="font-size:12px;width:100%" >
								<thead  class='sadow bg-teal' >			
									<th class='thead' style='max-width:3px'><center>NO</center></th>
									<th class='thead' ><center>NAMA PEMBIMBING</center></th> 
									<th class='thead' ><center>MITRA/DUDI</center></th> 
									<th class='thead' ><center>TGL PEMBERANGKATAN</th>  
									<th class='thead' ><center>MONITORING 1</center></th>
								   	<th class='thead' ><center>MONITORING 2</center></th>
								   	<th class='thead' ><center>MONITORING 3</center></th>
								   	<th class='thead' ><center>MONITORING 4</center></th>
								   	<th class='thead' ><center>MONITORING 5</center></th>
								    <th class='thead' ><center>MONITORING 6</center></th>
								    <th class='thead'  ><center>TGL KEPULANGAN</center></th>  
							 		</thead>
							</table>
							</div>						
						</div>						
					</div>	
                           <!----->
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
 
	 
	<script type="text/javascript">
	 
   var  dataTable = $('#tabel').DataTable({ 
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
						"sInfo": "Total :  _TOTAL_ , Halaman (_START_ - _END_)",
						 "sInfoEmpty": "Tidak ada data yang di tampilkan",
						   "sZeroRecords": "Data tidak tersedia",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": false,
		 "lengthMenu":
		 [[10 , 30,50,100,200,300,400,500,1000,2000], 
		 [10 , 30,50,100,200,300,400,500,1000,2000]], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1,2,3,5,6,7,8,9,10]
                },text:' Download  ',title:' DATA   PEMBIMBING  ',
							
                    },
					
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('prodi/data_pembimbing');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.cari= $('#cari').val(); 
						  data.mitra = $('#mitraf<?php echo $token;?>').val(); 
						   data.id_pembimbing = $('#id_pembimbing').val();
						 
						 
		 },
		   beforeSend: function() {
               loading("area_lod");
            },
			complete: function() {
              unblock('area_lod');
		//	  amankan();
            },
			
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3,-4 ], //last column
          "orderable": false, //set not orderable
        },
		// { "visible": false, "targets": 5 }
        ],
	
      });
     	  
	 
function semua(){
    $("#cari").val("");
    reload_table();
}
    
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
	 
}
 

 
 $('select').selectpicker();
  
 
 
    $('#cari').daterangepicker({
    "showDropdowns": true,
    ranges: {
        'Hari ini': [moment(), moment()], 
        '7 Hari yang lalu': [moment().subtract(6, 'days'), moment()], 
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
         
    },
     "timePickerSeconds": true,
    "autoApply": true,
     
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
    "startDate": moment().subtract(6, 'days') ,
    "endDate":moment(),
    "opens": "left"
} );

$("#cari").val("");
reload_table();

function showImg(url,nama,tgl)
{
     $(".modal-titlet").html(nama);
     $(".tgl_dok").html(tgl);
    $("#modal_dialog").modal("show");
    $("#isimodal").html("<img class='img-responsive thumbnail' src='"+url+"' width='100%' alt='dokumentasi tidak tersedia'>");
}
</script>	

	
	
	 

<!----------------------------------MODAL-------------------------------------------->					
<div id="modal_dialog" class="modal fade" tabindex="-1" >
    <div class="modal-dialog modal-md"  >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger modal-titlet"></h4>
            </div>
         <center><i class='tgl_dok'></i></center>
            <div class="modal-body" id="isimodal">
                							
            </div>
           <center><span id="tombol"></span></center>
            
            
            </center>
<br>
            
        </div>
    </div>								
</div>
