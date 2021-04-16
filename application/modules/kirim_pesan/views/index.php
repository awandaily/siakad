 <?php $token=date("His");?>

									
							
							
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="cardx">
                        <div class="header row">
                       
				
				
			 
				 <div class="col-md-4 pull-right"  align="center" ><br> 
				<button onclick="add()" type="button" class="btn-top btn btn-block bg-teal waves-effect">
										<i class="material-icons">add_circle</i>
									  KIRIM PENGUMUMAN
							   </button></div>
		 
                       
						   
					 
					<!---		<div class="col-md-8"   >
                                          
								<div id="dataKelas">	
									<?php 
										$ray="";
										$ray['']="  === pilih guru ===  "; 
										$data=$this->mdl->dataGuru();
										foreach($data as $get)
										{
										    $ray[$get->id]=$get->nama;
										}
										$dataray=$ray;
										echo form_dropdown("fkelas",$dataray,"","class='form-control show-tick  '  onchange='reload_table()' ");?>
										</div>
                            </div>--->
							 
                        </div>
                       
                           <!----->
				 <div class="cardx" id="area_lod">
                        <div class="bodyx">
                            <div class="table-responsive">
                               <table id='table' class="e" style="font-size:12px;width:100%">
								<thead  class='sadow  bg-white col-teal'>			
									<th class='thead'>   </th>
								 
								 	
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
  	  function hapus(kode,akun){
		   alertify.confirm("<center>"+akun+"<br>Hapus ?</center>",function(){
		       loading();
		   $.post("<?php echo site_url("kirim_pesan/hapus_pengumuman"); ?>",{kode:kode},function(){
			   reload_table();
			    unblock();
		      })
		   })
	  };
	  
	
	  
      var save_method; //for save method string
    var table;
  var  dataTable = $('#table').DataTable({ 
		"paging": false,
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
						"sInfo": "Total :  _TOTAL_ Data",
						 "sInfoEmpty": "",
						   "sZeroRecords": "Data tidak tersedia",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": false,
		 "lengthMenu":
		 [[500,10 ,30,50,100], 
		 [500,10 ,30,50,100], ], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
	//		 {
				 
				 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('kirim_pesan/getPengumuman');?>",
            "type": "POST",
			"data": function ( data ) {
	 	  data.id_mapel= $('#id_mapel_by').val(); 
	 	  data.id_kelas= $('#id_kelas').val(); 
		//	  data.ke_bp= $('#fke_bp').val(); 
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
          "targets": [ 0], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
	function reload_table()
	{
		 dataTable.ajax.reload(null,false);	
	};

	</script>
	
	
	
	
	
<script>
function add()
{
			$.post("<?php echo site_url("kirim_pesan/viewAddPengumuman"); ?>",{},function(data){
			 $("#mdl_modal_artikel").modal();
			 $("#viewAdd").html(data);
		      }); 
	 
}
</script>
	 

	
 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>kirim_pesan/insert_pengumuman"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TAMBAH PESAN</h4>
							 
                        </div>
                        <div class="modal-body">
                       	   <div id="viewAdd"></div>
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                  <!--      <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                   -->      <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                     </div>
                          <?php
                          $mobile=$this->m_reff->mobile();
                          if($mobile){?>
                          <br><br><br><br><br><br>   
                               <br><br><br><br><br><br>   <br>
                               <?php } ?>
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
       
   
<script>
 
	 function edit(id,nama)
	 {	 
		 		  loading();
			 $.post("<?php echo site_url("kirim_pesan/viewEditPengumuman"); ?>",{id:id},function(data){
		 	   $("#editan").html(data);
		 	     $(".tit").html(nama);
		 	       unblock(); 
			    $("#mdl_modal_edit").modal();
			}); 
	 }
   
</script>




 <div class="modal fade" id="mdl_modal_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
	<form  action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url()?>kirim_pesan/update_pengumuman"  method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal tit" >Edit Catatan</h4>
							 
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

		 
<script>
    
 
 
function lihat(kode,judul)
{ 
    $("#tititel").html(judul);    
    $("#periksa").html("Loading...");
   $.post("<?php echo site_url("kirim_pesan/lihat"); ?>",{kode:kode},function(data){
		 	   $("#periksa").html(data);
			    $("#mdl_lihat").modal("show");
			    
			});  
}
</script>
 
	
 
				 <div class="modal fade" id="mdl_lihat" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
                      <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="tititel"></h4>
							 
                        </div>
                        <div class="modal-body" >
                       	  
					   	 <div id="periksa"></div>
							 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                               <!--         <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                      <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_edit')" ><i class="material-icons">save</i> SIMPAN</button>
                                -->       </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
			 
   </div><!-- /.modal-dialog --> 		
						
						
						
						
						
						
 