 <?php $token=date("His");?>
 
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header row">
                         <div class="col-md-3 " style="padding-bottom:15px" >    
						 <h2 style='font-size:16px'><b>PESAN MASUK</b></h2> </div>
						   
							 
                        </div>
                       
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:14px;width:100%">
								<thead  class='sadow bg-teal'>			
									 
									<th class='thead'  width='15px'>&nbsp;NO</th>
									 
									<th class='thead' >PESAN</th>								 	
								</thead>
							</table>
							</div>						
						</div>						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				
  <script>
 $('select').selectpicker();
 </script>
  <script type="text/javascript">
   
	
	  
      var save_method; //for save method string
    var table;
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
						"sInfo": "Total :  _TOTAL_ , Halaman (_START_ - _END_)",
						 "sInfoEmpty": "Tidak ada pesan yang di tampilkan",
						   "sZeroRecords": "Belum ada pesan",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": true,
		 "lengthMenu":
		 [[5,10 ,30,50,100], 
		 [5,10 ,30,50,100], ], 
	    
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('dsh/getPesan');?>",
            "type": "POST",
			"data": function ( data ) {
			  data.id_kelas= $('#fkelas').val(); 
			  data.id_jenis= $('#fid_jenis').val(); 
			  data.ke_bp= $('#fke_bp').val(); 
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
	function reload_table()
	{
		 dataTable.ajax.reload(null,false);	
	};
	  
	</script>
	
	
	
	
	 

 