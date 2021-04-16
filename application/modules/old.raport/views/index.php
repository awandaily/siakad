
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DATA CBT</h2>
                          
							 
                        </div>
						 
                        <div class="body">
                           
						  
				 <div class="card">
			            <div class="body">
                            <div class="table-responsive">
                             <table id='tabel' class="tabel black table-bordered  table-hover dataTable">
								<thead  class='sadow bg-teal'  style="font-size:12px;width:100%" >			
									<th class='thead' style='max-width:3px'>NO</th>
								
									<th class='thead' >NAMA TEST</th>
									<th class='thead' width="50px">KELAS </th>
									<th class='thead' width="150px" > TANGGAL PENGERJAAN </th>
									<th class='thead' width="150px" > WAKTU PENGERJAAN </th>
									<th class='thead' width="100px">STATUS</th>
										<th class='thead' >TINJAU</th>
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
	 
        "processing": true, //Feature control the processing indicator.
		"language": {
						"processing": ' <span class="sr-only">Loading...</span> <br><b style="color:#;background:white">Proses menampilkan data<br> Mohon Menunggu..</b>',
						  "oPaginate": {
							"sFirst": "Halaman Pertama",
							"sLast": "Halaman Terakhir",
							 "sNext": "Selanjutnya",
							 "sPrevious": "Sebelumnya"
							 },
						"sInfo": "Total :  _TOTAL_ , Halaman (_START_ - _END_)",
						 "sInfoEmpty": "Tidak ada data yang di tampilkan",
						   "sZeroRecords": "Data tidak tersedia",
						  
				    },
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": true,
		 "searching": true,
		 "lengthMenu":
		 [[15, 50,100,200,300,500,1000, 800000000], 
		 [15, 50,100,200,300,500,1000,"All"]],
         dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
		 
			 {
					extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4 ]
                },text:' Export Excell',
							
                    },
					
					{
					extend: 'pdf',
                        exportOptions: {
                     columns: [ 0, 1, 2,3,4 ]
                },text:'  Pdf',
							
                    }, 
					{extend: 'colvis',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4 ]
                },text:' Kolom',
							
                    },
					 
					
        ],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('kesiswaan/data_cbt');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.id_madrasah = $('#id_madrasah').val();
						  data.jk = $('#jk').val();
						  data.posisi = $('#posisi').val();
						  data.mapel = $('#mapel').val();
						  data.status_kelulusan = $('#status_kelulusan').val();
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
    
 
	 
	
	   $(document).on('change', '#id_madrasah,#jk,#posisi,#mapel,#status_kelulusan', function (event, messages) {			
			  dataTable.ajax.reload(null,false);	   
        });
		
function tinjau(id)
{			var url="<?php echo base_url();?>kesiswaan/tinjau";
			$.post(url,{id:id},function(data){
				   $("#judul_tinjau").html("TINJAU DATA CBT");
				   $("#isi").html(data);
				   $("#modal_tinjau").modal();
			  });
}


</script>
	
	  <div class="modal fade" id="modal_tinjau" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document" >
				
	                  <div class="modal-content" > <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title" id="judul_tinjau">  </h4>
			             </div>
                     <div id="isi"></div>
					
				</div>
			 
         </div><!-- /.modal-dialog -->
         </div><!-- /.modal-dialog -->