
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DATA EKSTRAKULIKULER YANG DIIKUTI </h2>
								
                        </div>

				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >NAMA ESKTRAKULIKULER </th>
						 			<th class='thead' >PEMBINA </th>
								</thead>
							</table>
							</div>						
						</div>						
					</div>	
                    </div>
                </div>
				
 
  <script type="text/javascript">

    var save_method; //for save method string
    var table;
   // $(document).ready(function() {
      table = $('#table').DataTable({ 
	 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "searching":false,
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('eskul_siswa/data');?>",
            "type": "POST",
		 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
    //}); 
	function reload_table()
	{
		 table.ajax.reload();
	};
	</script>
	
	
	
	
