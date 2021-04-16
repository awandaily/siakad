  
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DATA GROUP KELAS</h2>
                           <button onclick="add()" type="button" class="btn-top btn pull-right bg-teal waves-effect">
                                    <i class="material-icons">create</i>
                                   Tambah
                           </button>
								
                        </div>
                       
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >Nama </th>
						 
								 	<th class='thead' >OPSI</th>
								</thead>
							</table>
							</div>						
						</div>						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
  <script type="text/javascript">
  	  function hapus(id,akun){
		   alertify.confirm("<center>Hapus  <br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("eskul_anggota/hapus/eskul_group"); ?>",{id:id},function(){
			   reload_table();
		      })
		   })
	  };
	  
	
	  
      var save_method; //for save method string
    var table;
   // $(document).ready(function() {
      table = $('#table').DataTable({ 
	 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('eskul_anggota/data/eskul_group');?>",
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
	
	
	
	
	
<script>
function add()
{
	$("#modal_artikel").modal();
	$("#f_modal_artikel")[0].reset();
	$("form").attr('url',"<?php echo base_url()?>eskul_anggota/insert/eskul_group");
 
}
</script>
	 

	
 <div class="modal fade" id="modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog  " role="document">
				
	<form  action="javascript:saveModal('modal_artikel')" id="f_modal_artikel" url="<?php echo base_url()?>profile/insert"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-indigo" id="defaultModalLabel">Data Group Kelas </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					  
                         <input type="hidden" readonly name="id_" >
                                   
							 
								
								<div class="form-group form-float">
								 <label class="form-label" style="margin-top:-5px">Nama Group Kelas</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[nama]"   required>
                                       
                                    </div>
                                </div>
									*Group kelas merupakan kelompok ektrakurikuler yang penjadwalannya beda hari. 
			 
					 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="saveModal('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
       
   <script>
 function edit(id,nama)
	 {	 
		 			
			 	$("[name='id']").val(id);
			 	$("[name='id_']").val(id);
			 	$("[name='f[nama]']").val(nama);
				$("#modal_artikel").modal();
				$("form").attr('url',"<?php echo base_url()?>eskul_anggota/update/eskul_group");
	 }
	 
    //CKEditor
    //CKEDITOR.replace('ckeditor');
 //   CKEDITOR.config.height = 300;
	
</script>







 