 

<div class="col-md-12">&nbsp;</div>

                <div class="row clearfix">

                <!-- Task Info -->

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="card">

                        <div class="header">
                            <h2>ABSEN PEMBINA EKTRAKURIKULER</h2>
                        </div>


                       


						<div class="card">

	                        <div class="body">
	                        	<div class="row">
	                        		<div class="col-md-3">
	                        			<select class="form-control show-tick" id="src_eskul" data-live-search="true"  onchange="reload_table()">
	                                        <option value="">=== Filter Ekstrakulikuler ===</option>
	                                        <?php
	                                        	foreach ($eskul as $veskul) {
	                                        		echo "<option value='".$veskul->id."'>".$veskul->nama."</option>";
	                                        	}
	                                        ?>
                                        </select>
	                        		</div>
	                        	</div>
	                            <div class="table-responsive">
		                            <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
										<thead  class='sadow bg-blue'>			
											<tr>
												<th width="20%">TANGGAL</th>
												<th>PEMBINA</th>
												<th width="20%">EKSTRAKULIKULER</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>

								</div>						

							</div>						

						</div>	


                    

                    </div>

                </div>

                <!-- #END# Task Info -->

				

 

<script type="text/javascript">
	  

    var save_method; //for save method string

    var table;

   // $(document).ready(function() {

      table = $('#table').DataTable({ 

	 
      	"searching":false,
        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

        

        // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('eskul/data_absen_pembina');?>",
            "type": "POST",
            "data": function (data) {
			  	data.src_eskul= $('#src_eskul').val(); 
			}
        },



        //Set column definition initialisation properties.

        "columnDefs": [

        { 

          "targets": [0], //last column

          "orderable": false, //set not orderable

        },

        ],

	

      });

    //}); 

	function reload_table(){
		table.ajax.reload();
	}
</script>

