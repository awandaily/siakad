 <?php $token=date("His");
 if($this->m_reff->mobile())
 {
	 $css='style="margin-top:-10px"';
 }else{
	 $css='style="margin-top:-20px"';
 }
 ?>
 
							
 
                <div class="row clearfix" <?php echo $css;?>>
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header row">
                          
                         	 <div class="btn-group pull-right" role="group">
                         <button onclick="import_data()" class="btn bg-teal waves-effect"><i class="material-icons">file_download</i>IMPORT DATA MITRA</button>
                         <button onclick="add()" class="  waves-effect btn bg-blue-grey"><i class="material-icons">add_circle</i> INPUT DATA MITRA </button>
                           <button onclick="import_data_quota()" class="btn bg-purple waves-effect"><i class="material-icons">file_download</i>IMPORT DATA QUOTA</button>
                     </div>
							  
                          
							 
                        </div>
                       
						<div class="card">
	                        <div class="body">
	                            <div class="table-responsive">
	                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
									<thead  class='sadow bg-teal'>
										<tr>			
											<th class='thead'>EDIT | HAPUS</th>
									<!--	<th class='thead'  width='15px'>&nbsp;NO</th>-->
											<th class='thead' >KODE</th>
											<th class='thead' width="30%">NAMA MITRA</th>
											<th class='thead' > LOKASI/ALAMAT</th>
											<th class='thead' > JENIS KERJASAMA</th>
											<th class='thead' > BUJUR</th>
											<th class='thead' > LINTANG</th>
											<th class='thead' > TELP KANTOR</th>
											<th class='thead' > EMAIL</th>
											<th class='thead' > WEBSITE</th>
											<th class='thead' > FAX</th>
											<th class='thead' > BIDANG USAHA</th>
											<th class='thead' > NAMA CONTACT PERSON</th>
											<th class='thead' > TELP CONTACT PERSON</th>
											<th class='thead' > JABATAN CONTACT PERSON</th>
											<th class='thead' >KETERANGAN</th>
										</tr>
									 
									</thead>
								</table>
								</div>						
							</div>						
						</div>	
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				
  <script>
 $('select').selectpicker();
 </script>
  <script type="text/javascript">
  	  function hapus(id,akun){
		   alertify.confirm("<center>Hapus ?</center>",function(){
		   $.post("<?php echo site_url("humas/hapus_mitra"); ?>",{id:id},function(){
			   reload_table();
		      })
		   })
	  };
	  
	
	  
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
						 "sInfoEmpty": "Tidak ada data yang di tampilkan",
						   "sZeroRecords": "Data tidak tersedia",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": true,
		 "lengthMenu":
		 [[10,20, ,30,50,100], 
		 [10,20 ,30,50,100], ], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,2,3 ]
                },text:' Excell',
							
                    },
					 
					{extend: 'colvis',
                        exportOptions: {
                  columns:[ 0,2,3 ]
                },text:' Kolom',
							
                    },
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('humas/getData');?>",
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
	function reload_table()
	{
		 dataTable.ajax.reload(null,false);	
	};
	 $(document).on('change', '.fkelas<?php echo $token;?>,.fidjenis<?php echo $token;?>,.fke_bp<?php echo $token;?>', function (event, messages) {			   
        reload_table();		 
		});
	</script>
	
	
	
	
	
	
	
	
	
	
	
	
	

	  <!-- Modal -->
<div class="modal fade" id="mdl_formSubmitDown" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="area_formSubmitDown">
        <div class="modal-content">
		<form id="formSubmitDown" action="javascript:submitForm('formSubmitDown')" method="post"  >
                
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" id="judul_mdl">
                   
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="col-md-12 body">    
       <center>				  <a class="sound" id="downfor" href="<?php echo base_url()?>humas/download_format_mitra">Download Format Upload</a> </center>		
				  	
				<div class="row">
				
                                        <div class="form-line"><span id="ket_file">  </span>
					                      <input type="file" accept="xlsx" class="form-control" name="file"  required/>
                                        </div>
                                    </div><br>
					 
                  
            </div>
            </div>
            <div class="row clearfix"></div>
            <div class="modal-footer">
			  
              <button onclick="submitForm('formSubmitDown')"  class="pull-right waves-effect btn bg-teal"><i class="material-icons">cloud_upload</i> UPLOAD</button>
                         
                        </div>
            </form>
        
		</div>
    </div>
</div>
	
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<script>
function import_data_quota()
{
       $("#formSubmitDown")[0].reset();
  $("#judul_mdl").html("IMPORT DATA QUOTA ");
				   $("#isi").html(data);
				   $("#mdl_formSubmitDown").modal( );
				    $("#formSubmitDown").attr("url","<?php echo base_url()?>humas/import_data_quota");
				    $("#downfor").prop("href","<?php echo base_url()?>humas/download_format_quota");
}
function import_data()
{
    $("#formSubmitDown")[0].reset();
  $("#judul_mdl").html("IMPORT DATA MITRA ");
				   $("#isi").html(data);
				   $("#mdl_formSubmitDown").modal( );
				    $("#formSubmitDown").attr("url","<?php echo base_url()?>humas/import_data_mitra");
				   $("#downfor").prop("href","<?php echo base_url()?>humas/download_format_mitra");
}
	function add_mou(id){
		$.post("<?php echo site_url("humas/viewMOU"); ?>",{id:id},function(data){
		 	$("#mdl_mou").modal();
		 	$("#dtmou").html(data);
		 	$("#mou_id_pembimbing").selectpicker();
	    });
	    dataMou(id);
	}
 	function dataMou(id){
		$.post("<?php echo site_url("humas/dataMou"); ?>",{id:id},function(data){
		  $("#tb-mou").html(data);
	 	}); 
 	}
 	function submitFormMou(id){		
			var form = $("#"+id);
			/*
			var idadd = $(form).attr("idadd");*/
			var link = $(form).attr("url");
		 
			$(form).ajaxForm({
			 url:link,
			 data: $(form).serialize(),
			 method:"POST",
			 dataType:"JSON",
			 beforeSend: function() {
	               loading("area_"+id);
	            },
			 success: function(data)
					{ 	   unblock("area_"+id); 	
						
						if(data["size"]==false)
						{	  
								notif("<b>Gagal  !!</b><br>- Upload File Maksimal "+data["maxsize"]+"MB.");
						}else if(data["file"]==false)
						{	  
								notif("<b>Gagal  !!</b><br>- File yang diizinkan adalah "+data["type_file"]+".");
						}else{
						
						  $("#"+id)[0].reset();
						  dataMou(data);
						  berhasil_disimpan();
						  reload_table();
						  /*
						   $("[name='quta']").prop("required",true);
						   $("[name='mou']").prop("required",false);
						   */
						}
					 
							
					}
			});     
	};
   	function hapusBahan(id,sumber,idmitra, akun){
	   alertify.confirm("<center>Hapus  <br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
	   	$.post("<?php echo site_url("humas/hapus_bahan2"); ?>",{id:id,sumber:sumber},function(){
		   dataMou(idmitra);
	    })
	   })
	};
</script>	
<div class="modal fade" id="mdl_mou" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" id="area_modal_mou" role="document" style="width:90%">

        <form action="javascript:submitFormMou('modal_mou')" id="modal_mou" url="<?php echo base_url()?>humas/upload_mou" method="post" enctype="multipart/form-data">
            <div class="modal-content"> 
            	<span title="tutup" data-dismiss="modal" class=" pull-right waves-effect">
            		<i class="material-icons">cancel</i> 
            	</span>
	            <div class="modal-header">
	                <h4 class="modal-title col-teal">Data MOU</h4>

	            </div>
	            <div class="modal-body ">

	                <div id="dtmou"></div>

	                <div class="modal-footer">
	                    <span id="msg" class='pull-left'></span>
	                    <div class="btn-group" role="group" aria-label="Default button group">

	                        <!--         <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
	                            -->
	                        <button id="submit" class="btn bg-teal waves-effect" onclick="submitFormMou('modal_mou')">
	                        	<i class="material-icons">save</i> SIMPAN
	                        </button>
	                    </div>
	                </div>

	                <hr>
	                <!--
	                <div class="table-responsive">
                       <table id='tb-mou' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
							<thead  class='sadow bg-teal'>			
								<th class="thead">TAHUN / SEMESTER</th>
								<th class="thead">MOU</th>
								<th class="thead">ACTION</th>
							</thead>
						</table>
					</div>-->
					<div id="tb-mou"></div>


	            </div>
            </div>

    </div>
    </form>
</div>
<!-- /.modal-dialog -->
	
	
<script>
	function add()
	{
				$.post("<?php echo site_url("humas/viewAdd"); ?>",{},function(data){
				 $("#mdl_modal_artikel").modal();
				 $("#viewAdd").html(data);
			      }); 
		 
	}
</script>
	 

	
 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>humas/insert_mitra"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TAMBAHKAN DATA MITRA</h4>
							 
                        </div>
                        <div class="modal-body">
                       	   <div id="viewAdd"></div>
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                  <!--      <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                   -->      <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
       
   
<script>
 
	 function edit(id)
	 {	 
		 		  
			 $.post("<?php echo site_url("humas/viewEdit"); ?>",{id:id},function(data){
		 	   $("#editan").html(data);
			    $("#mdl_modal_edit").modal();
			}); 
	 }
   
</script>




 <div class="modal fade" id="mdl_modal_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" id="area_modal_edit" role="document">
				
	<form  action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url()?>humas/update_mitra"  method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" >Edit Data</h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <div id="editan"></div>
							 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                               <!--         <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                -->         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_edit')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
   </div><!-- /.modal-dialog --> 

		 



 
	
 
						
						
						
						
						
						
						
 