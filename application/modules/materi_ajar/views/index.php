<?php $token=date("His");?>
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header">    <h2>MATERI </h2> 
					 
                        </div>
					  <div  >
                          <select class="form-control id_mapel<?php echo $token;?>" name="mapel" id="id_mapel" onchange="reload_table()">
						  <option value=""> === FILTER MATA PELAJARAN ===</option>
						  <?php
						  $db=$this->db->query("SELECT * from v_mapel_ajar where id_kelas='".$this->mdl->id_kelas()."' group by id_mapel order by mapel asc")->result();
						  foreach($db as $val)
						  {
							  echo "<option value='".$val->id_mapel."'>".$val->mapel."</option>";
						  }
						  ?>
						  </select>
						  
				 <div   id="area_lod">
			            <div class="body">
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable">
								<thead  class='sadow bg-teal'  style="font-size:12px;width:100%" >			
									<th class='thead' style='max-width:3px'>NO</th>
								 
								 
									<th class='thead' >MATERI</th>
									
							 
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
				
 				
  <script>
 $('select').selectpicker();
 </script>
 
	 
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
		 "searching": true,
		 "lengthMenu":
		 [[10 , 20,30], 
		 [10 , 20,30]], 
	 
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('materi_ajar/getMateri');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.id_kelas = $('#id_kelas').val();
						  data.id_mapel = $('#id_mapel').val();
						  data.semester = $('#semester').val();
						  data.id_kikd = $('#fid_kikd').val();
						  data.k_nilai = $('#k_nilai').val();
						 
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
    
	//	$(document).on('change', '.id_mapel<?php echo $token;?>', function (event, messages) {			   
     //   reload_table();		 
	//	});
		
		
	 
		var x=0; 
	   function reload()
	   {	   
			 dataTable.ajax.reload(null,false);	
		 
		};
		
 
 
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
}
  
 
</script>
	 