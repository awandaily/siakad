 <?php $token=date("His");?>

									
							
							
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="cardx">
                        <div class="header row">
                       
				
				
			 
				 
		 
                       
						  <div class="col-md-12 "  style="padding-bottom:10px" >
                                      <select class="form-control id_mapel" name="mapel" id="id_mapel" style="width:98%;margin-top:-10px" onchange="reload_table()">
						  <option value=""> === FILTER MATA PELAJARAN ===</option>
						  <?php
						  $db=$this->db->query("SELECT * from v_mapel_ajar where id_kelas='".$this->mdl->id_kelas()."' group by id_mapel order by mapel asc ")->result();
						  foreach($db as $val)
						  {
							  echo "<option value='".$val->id_mapel."'>".$val->mapel."</option>";
						  }
						  ?>
						  </select>
                            </div>
					 
							 
							 
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
  	  function hapus(id,akun){
		   alertify.confirm("<center>Hapus ?</center>",function(){
		   $.post("<?php echo site_url("tugas/hapus"); ?>",{id:id},function(){
			   reload_table();
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
						   "sZeroRecords": "Tidak ada tugas",
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
            "url": "<?php echo site_url('tugas/getCatatan');?>",
            "type": "POST",
			"data": function ( data ) {
	 	  data.id_mapel= $('#id_mapel').val(); 
	 	 
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
			$.post("<?php echo site_url("tugas/viewAdd"); ?>",{},function(data){
			 $("#mdl_modal_artikel").modal();
			 $("#viewAdd").html(data);
		      }); 
	 
}
</script>
	 

	
 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>tugas/insert"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TAMBAH TUGAS</h4>
							 
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
 
	 
	 function upload(id,judul,cek,ket,mapel=null)
	 {
	      
	           $(".titit").html(mapel);
	    
	    $.post("<?php echo site_url("tugas/getTugas"); ?>",{id:id},function(data){
	        var data=data.split("::");
		 	   $("#editan").html(data[0]);
			    $("#mdl_modal_edit").modal();
			    $("[name='id_tugas']").val(id);
			    $("#ket").val(data[1]);
			    if(data[0]){
			    $("#fileTugas").html('<span> <i class="material-icons" style="position:absolute;margin-left:-25px;margin-top:-4px">attachment</i><a download="" href="<?php echo base_url();?>file_upload/tugas/'+id+'/'+data[0]+'?download=true" class="col-pink"> File tugas anda  </a></span>');
			    }else{
			        $("#fileTugas").html("");
			    }
			}); 
	 }
   
</script>




 <div class="modal fade" id="mdl_modal_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
	<form  action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url()?>tugas/insert"  method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal titit" ></h4>
							 
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_tugas" >
                              <b>Lampiran file</b><span id="fileTugas" class='pull-right'></span>
                       	  <input type="file" name="file" class="form-control"><br>
                       	  <b>Pembahasan</b>
                         <textarea id="ket" style="min-height:130px" name="f[ket]" class="form-control" placeholder="Isi pembahasan bila perlu..."></textarea> 
					  <center> 	  </center>
							 
 
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

	
 
						
						
						
						
						
						
						
 