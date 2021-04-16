 
<div class="col-md-12">&nbsp;</div>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Ghalery</h2>
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
									<th class='thead' >GAMBAR </th>
									<th class='thead' >JUDUL </th>
									<th class='thead' >KONTEN </th>
									<th class='thead' >KATEGORY </th>
									<th class='thead' width="90px" >STATUS </th>
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
		   $.post("<?php echo site_url("website/hapus_ghalery"); ?>",{id:id},function(){
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
            "url": "<?php echo site_url('website/data_ghalery');?>",
            "type": "POST",
		 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3,-4,-5], //last column
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
                                        <label for="judul"   class="pull-left">Judul </label>
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
								
								
		<div class="col-md-4">
		<center>
		<label>
		 <img  id="blah" src="<?php echo base_url()?>plug/img/sample.png" alt="" height="100px" width="230px" style="padding:5px" />
		 <input type='file' accept=".JPG,.jpg,.png" name="poto" id="imgInp" class="form-control upload"  /></label>
		</center>
		</div>						
		<div class="col-md-8">
		<!-------->
								<!---<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="file"  class="pull-left">Upload File </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" name="file" accept=".Docx,.docx" id="file" class="form-control" placeholder="Judul artikels">
                                            </div>
											<div class="help-info"><i>File Ms.Word (Docx)</i></div>
                                        </div>
                                    </div>
                                </div>--><br>
								<div class="row clearfix"  style="margin-top:5px">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="id_kategory"  class="pull-left">Kategory </label>
                                    </div> 
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-lines">
                                                <select name="f[id_kategory]" id="id_kategory" required class="form-control" style="border:#A9A9A9 solid 1px">
												<option value=''>==== Pilih ====</option>
												<?php $data=$this->m_reff->goResult("tr_kategory_berita","*")->result();
												foreach($data as $data)
												{
													echo "<option value='".$data->id."'>".$data->nama."</option>";
												}
												?>
												</select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix"  style="margin-top:5px">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="id_kategory" class="pull-left">Publikasi </label>
                                    </div> 
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-lines">
                                                <select   name="f[sts]" id="id_kategory" required class="form-control" style="border:#A9A9A9 solid 1px">
												<option value=''>==== Pilih ====</option>
												<option value='3'>Terbitkan</option>
												<option value='2' >Simpan Sebagai Konsep</option>
												</select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								 
							 	 
		<!-------->
		
								
										   
											
                                   
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
		 url:"<?php echo base_url()?>website/edit_ghalery",
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
    CKEDITOR.config.height = 150;
	});
    //CKEditor
   
	CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 150;
</script>











 <div class="modal fade" id="modal_artikel_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
				
				<form  action="javascript:saveModalArtikelUpdate('modal_artikel_update')" id="f_modal_artikel_update" url="<?php echo base_url()?>website/update_artikel_ghalery"  class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Post Artikel Baru </h4>
							 
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
  