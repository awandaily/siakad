    <?php   $datawali=$this->mdl->data_wali(); ?>
	  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35 col-yellow sadow"><center>WALI KELAS</center></div> 
                         <center><br><br>
						 <img class="img-responsive thumbnail" style="max-height:100px" 
						 src="<?php echo base_url()?>file_upload/dp/<?php echo $datawali->poto; ?>">
					<p style="margin-top:-13px" class='sadow'>	<?php echo $datawali->gelar_depan; ?> <?php echo $datawali->nama; ?> <?php echo $datawali->gelar_belakang; ?></p>
					<p style="margin-top:-10px" class='sadow'>	Telp.<?php echo $datawali->hp; ?> </p>
						</center>
                        </div>
                    </div>
  </div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35 col-yellow sadow">KONTAK SEKOLAH</div>
                            <ul class="dashboard-stat-list">
							<li  class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> TELP  WALI KELAS  
                                    <span class="pull-right"><b><?php echo $datawali->hp; ?></b>  </b></span>
                                </li>
                                 <li  class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> TELP KEPALA SEKOLAH 
                                    <span class="pull-right"><b><?php echo $this->m_reff->goField("tm_pengaturan","val","where id='3'");?></b>  </b></span>
                                </li>
                                <li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> TELP KANTOR
                                    <span class="pull-right"><b><?php echo $this->m_reff->goField("tm_pengaturan","val","where id='1'");?></b> </b> </span>
                                </li>
								<li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> E-MAIL
                                    <span class="pull-right"><b><?php echo $this->m_reff->goField("tm_pengaturan","val","where id='2'");?></b> </b> </span>
                                </li>
								
								
                            </ul>
                        </div>
                    </div>
  </div>


					
					
					<?php $token=date("His");?>
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header">    <h2>LIST DATA GURU </h2> 
						  
                        </div>
						    <div  >
                          
						  
				 <div   id="area_lod">
			            <div class="body">
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable">
								<thead  class='sadow bg-teal'  style="font-size:12px;width:100%" >			
									<th class='thead' style='max-width:3px'>NO</th>
								 	<th class='thead' >NAMA GURU</th>
								 
									<th class='thead' >TELP</th>
									<th class='thead' >EMAIL</th>
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
		 "searching": true,
		 "lengthMenu":
		 [[10 , 20,30], 
		 [10 , 20,30]], 
	 
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('oinfo/getGuru');?>",
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
          "targets": [ 0,-1,-2,-3,-4 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
    
 
	 
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
	 