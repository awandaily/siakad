<?php $token=date("His");?>  
  <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						
                        
						
						<h2 class="sound">REKAP TAGIHAN PERKELAS</h2>
                           
                        </div>
						    <div class="body">
                           <div class="row clearfix">
						   
						     <div class="col-sm-3 col-black">
                                    <select class="form-control show-tick"   id="id_tkf"   data-live-search="true" onchange="reload_table()">
                                        <option value="">=== Pilih Tingkat ===</option>
										<option value="1">X (Sepuluh)</option>
										<option value="2">XI (Sebelas)</option>
										<option value="3">XII (Dua Belas)</option>
										 
                                    </select>
                                </div> 
						
						
								<div class="col-sm-3 col-black">
                                    <select class="form-control show-tick"   id="id_jurusanf"   data-live-search="true" onchange="reload_table()">
                                        <option value="">=== Pilih Jurusan ===</option>
									<?php
									$data=$this->db->get("tr_jurusan")->result();
									foreach($data as $val)
									{
									   echo '<option value="'.$val->id.'">'.$val->nama.'</option>'; 
									}
									
									?>
									
										 
                                    </select>
                                </div> 
							  
								
								<div class="col-sm-3" id="tagihan">
                                    <select class="form-control show-tick" id="tagihanf">
                                        
                                       
                                                                              
                                    </select>
                                </div> 
								 
							
<!--							<div class="col-sm-2">	
						   <button class="btn bg-blue-grey btn-block" onclick="filter()"><i class="material-icons">filter_list</i>FILTER  </button>
						   </div>--->
								
							 
						 
						    
                           </div>
						  
				 <div id="area_lod">
			            <div  >
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable"  style="font-size:12px;width:100%" >
								<thead  class='sadow bg-teal' >			
									<th class='thead' style='max-width:3px'>NO</th>
									<th class='thead' style='min-width:115px' >KELAS</th>
									<th class='thead' style='min-width:115px' >WALI KELAS</th>
									<th class='thead' style='min-width:115px' >TOTAL TAGIHAN</th>
									<th class='thead' style='min-width:115px' >TOTAL BAYAR</th>
									<th class='thead' style='min-width:115px' >SISA TAGIHAN </th>
									
								 
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
    "scrollX": true,
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
		 "searching": true,
		 "lengthMenu":
		 [[10 , 30,50,100,200,300,400,500,1000,2000], 
		 [10 , 30,50,100,200,300,400,500,1000,2000]], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1,2,3,4,5]
                },text:'Download Excell',
							
                    },
					
				 
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('keu_rekap/getDataKelas');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.id_tk= $('#id_tkf').val();
						  data.id_jurusan = $('#id_jurusanf').val();
						  data.tagihan = $('#tagihanf').val();
						  
						 
						 
		 },
		   beforeSend: function() {
               loading("area_lod");
            },
			complete: function() {
              unblock('area_lod');
			  	  var id_kelas= $('#id_kelasf').val();
				  var alumni = $('#alumnif').val();						 
				  var tagihan = $('#tagihanf').val();						 
				  getTagihan(id_kelas,alumni,tagihan);
            },
			
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3,-4 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
     	  
	 
		var x=0; 
	   
		
function getTagihan(id_kelas,alumni,tagihan)
{			var url="<?php echo base_url();?>keu_rekap/getTagihan";
			$.post(url,{id_kelas:id_kelas,alumni:alumni,tagihan:tagihan},function(data){				  
				   $("#tagihan").html(data);				  
			  });
}
 
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
}
 
</script>
	
 
	 
	 
	 
	<script>
	$('select').selectpicker();
	$(".tmt").inputmask("99/99/9999");  
	$(".thn").inputmask("9999/9999");  
	</script>
	 
 
	
	
	 