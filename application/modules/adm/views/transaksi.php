
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Catatan Pembayaran</h2>
                          
							 
                        </div>
						 
                         
			               <div class="body table-responsive">
                          
                             <table id='tabel' class="tabel black table-bordered table-striped table-hover dataTable">
								<thead  class='sadow bg-teal'  style="font-size:12px;width:100%" >			
									<th class='thead' >#</th>
									<th class='thead'  >TANGGAL </th>
									<th class='thead' >  TAGIHAN  </th>
									<th class='thead' >JUMLAH BAYAR (Rp) </th>
									<th class='thead' >STATUS </th>
									<th class='thead' >  </th>
									 
									 
									</thead>
							</table>
						 					
						</div>						
				  
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
 
	
	<script type="text/javascript">
	 
   var  dataTable = $('#tabel').DataTable({ 
      scrollCollapse: true,
      
        searching:      false,
      
       
		 "lengthChange": false,
        "processing": false, //Feature control the processing indicator.
		"language": {
						"sSearch": "Pencarian",
						"processing": ' <span class="sr-only">Loading...</span> <br><b style="color:orange;background:white">Proses menampilkan data<br> Mohon Menunggu..</b>',
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
		 "responsive": false,
		 "searching": true,
		"lengthMenu":
		 [[10 , 30,50,100,200,300,400,500], 
		 [10 , 30,50,100,200,300,400,500]], 
         dom: 'Blfrtip',
 
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
		 
			 {
					extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4 ]
                },text:'Export Excell',
							
                    },
					
					{
					extend: 'pdf',
                        exportOptions: {
                     columns: [ 0, 1, 2,3,4 ]
                },text:'Export  Pdf',
							
                    }, 
					 
					
        ],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('adm/data_transaksi');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.pilihan = $('#pilihan').val();
						 
		 },
		 beforeSend: function() {
               loading("tabel");
            },
			complete: function() {
              unblock('tabel');
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
    
	 
	   $(document).on('change', '#pilihan', function (event, messages) {			
			  dataTable.ajax.reload(null,false);	   
        });
function reload_table()
{
	 dataTable.ajax.reload(null,false);	   
}	
function lihat(id,nama)
{			var url="<?php echo base_url();?>adm/lihat_catatan_bayar";
			$.post(url,{id:id,nama:nama},function(data){
				   $("#judul_tinjau").html("DETAIL PEMBAYARAN");
				   $("#isi").html(data);
				   $("#mdl_formSubmit").modal();
			  });
}


</script>
	
	  <div class="modal fade" id="mdl_formSubmit" tabindex="-1" role="dialog">
                <div class="modal-dialog " role="document" >
				
	                  <div class="modal-content" > <span  title="tutup"  data-dismiss="modal" class="   
					  pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="judul_tinjau">  </h4>
			             </div>
                     <div id="isi"></div>
					
				</div>
			 
         </div><!-- /.modal-dialog -->
         </div><!-- /.modal-dialog -->