 
<div class="col-md-12">&nbsp;</div>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Informasi Peraturan</h2>
                           <button onclick="add()" type="button" class="btn-top btn pull-right btn-primary waves-effect">
                                    <i class="material-icons">create</i>
                                 Tambah
                                </button>
								
                        </div>
                        <div class="body">
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >NAMA PERATURAN </th>
									<th class='thead' >KONTEN </th>
								 
									<th class='thead' width="80px" >TANGGAL</th>
							 		<th width="80px">OPSI</th>
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
  	  function hapus(id,artikel){
		   alertify.confirm("<center>Hapus artikel :<br> <span class='font-bold col-pink'>`"+artikel+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("website/hapus_peraturan"); ?>",{id:id},function(){
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
            "url": "<?php echo site_url('website/data_peraturan');?>",
            "type": "POST",
		 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3,-4], //last column
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
	$("#modal_artikel").modal({backdrop: 'static',drugged:true, keyboard: false});
}
</script>
	 

	
 <div class="modal fade" id="modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
				
	<form  action="javascript:saveModalArtikel('modal_artikel')" id="f_modal_artikel" url="<?php echo base_url()?>website/save_ghalery"  class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah Baru </h4>
							 
                        </div>
                        <div class="modal-body">
                       	   
				 
	 
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="judul"   class="pull-left">Nama Peraturan</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input style="border:#A9A9A9 solid 1px" type="text" name="f[judul]" id="judul" class="form-control " required placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
								
								<div class="row clearfix">
                                    <textarea id="ckeditor" name="f[konten]">Isi Konten</textarea>
                                </div>
								
								
						
		<div class="col-md-8">
		 
								
										   
											
                                   
                                </div> 
								 
								 
							 
								 
                                   
								 
									 
   </div>

<div class="clearfix"></div>
                      

				</div>
					  <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  class="btn bg-teal waves-effect" onclick="saveModalArtikel('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
         </div><!-- /.modal-dialog -->
  
 <script>
  $("#set_artikel").hide();
 function publikasi()
 {
	 var p=$("[name='f[sts]']").val();
 if(p=="1"){ $("#set_artikel").show(); }else{ $("#set_artikel").hide(); }
 }
 </script>
 
<script>
 function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
     }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

 function edit(id)
	 {	loading();
		 $.ajax({
		 url:"<?php echo base_url()?>website/edit_peraturan",
		 data: {id:id},
		 method:"POST",
		// dataType: "JSON",
		 success: function(data)
            {	$.unblockUI();
			//	$("[name='f[judul]']").val(data["judul"]);
				$("#isi").html(data);
				$("#modal_artikel_edit").modal({backdrop: 'static',drugged:true, keyboard: false});
				
            }
		});
	 }
	 
	 $( document ).ready(function() {
	CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 250;
	});
    //CKEditor
   
	CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 250;
</script>











 <div class="modal fade" id="modal_artikel_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
				
				<form  action="javascript:saveModalArtikelUpdate('modal_artikel_update')" id="f_modal_artikel_update" url="<?php echo base_url()?>website/update_peraturan"  class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Peraturan  </h4>
							 
                        </div>
                        <div class="modal-body"> <div id="isi"></div> </div>
					  <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  class="btn bg-teal waves-effect" onclick="saveModalArtikelUpdate('modal_artikel_update')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                        </div>
				</div>
				</form>
         </div><!-- /.modal-dialog -->
         </div><!-- /.modal-dialog -->
  