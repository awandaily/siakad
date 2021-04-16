 
<div class="col-md-12">&nbsp;</div>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DATA REFERNSI EKTRAKURIKULER</h2>
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
									<th class='thead' >EKTRAKURIKULER  </th>
									<th class='thead' >PEMBINA</th>
								<!--	<th class='thead' >NAMA PEMBINA</th> -->
									<th class='thead' >HONOR/PERTEMUAN</th>
									<th class='thead' >HONOR MAKSIMAL SEBULAN</th> 
							<!---	<th class='thead' >USERNAME</th> 
							 		<th class='thead' >PASSWORD</th> --->
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
		   $.post("<?php echo site_url("referensi/hapus/tr_ektrakurikuler"); ?>",{id:id},function(){
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
            "url": "<?php echo site_url('referensi/data/tr_ektrakurikuler');?>",
            "type": "POST",
		 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3 ], //last column
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
	$("#f_modal_artikel")[0].reset();
	$("form").attr('url',"<?php echo base_url()?>referensi/insert/tr_ektrakurikuler");
 
}
</script>
	 

	
 <div class="modal fade" id="modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog  " role="document">
				
	<form  action="javascript:saveModal('modal_artikel')" id="f_modal_artikel" url="<?php echo base_url()?>profile/insert"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-indigo" id="defaultModalLabel">Data Referensi </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					  
                         <input type="hidden" readonly name="id_" >
                                   
							 
								
								<div class="form-group form-float">
								<label class="form-label">Nama Ektrakurikuler</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[nama]"   required>
                                        
                                    </div>
                                </div>
								 
								<div class="form-group form-float">
								 <label class="form-label"> Pembina</label>
                                    <div class="form-line focused success">
                                      
                                       <?php 
									    
									   $this->db->order_by("nama","ASC");
									   $this->db->where("nip!=","");
									   $dt=$this->db->get("data_pegawai")->result();
									     $opsi[""]="---- pilih ----";
									   foreach($dt as $op)
									   {
										   $opsi[$op->nip]=$op->nama;
									   }
									   echo form_dropdown("f[kode]",$opsi,"","class='form-control' required");
									   ?>
                                    </div>
                                </div>
								
						<!---		<div class="form-group form-float">
								 <label class="form-label">Nama pembina</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[pembina]"   required>
                                       
                                    </div>
                                </div>--->
									 <div class="form-group form-float">
								 <label class="form-label">Honor  Pertemuan</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[honor]"   required>
                                       
                                    </div>
                                </div>
									  <div class="form-group form-float">
								 <label class="form-label">Honor  Maksimal sebulan</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[honor_maksimal]"   required>
                                       
                                    </div>
                                </div>
					<!---				  <div class="form-group form-float">
								 <label class="form-label">Username</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[username]"   required>
                                       
                                    </div>
                                </div>
									  <div class="form-group form-float">
								 <label class="form-label">Password</label>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[password]"   required>
                                       
                                    </div>
                                </div>--->
									 
			 
					 
 
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

 function edit(id,nama,kode,pembina,honor,maksimal,user,pass)
	 {	 
		 			
			 	$("[name='id']").val(id);
			 	$("[name='id_']").val(id);
			 	$("[name='f[nama]']").val(nama);
			 	$("[name='f[kode]']").val(kode);
			 	$("[name='f[pembina]']").val(pembina);
			 	$("[name='f[honor]']").val(honor);
			 	$("[name='f[honor_maksimal]']").val(maksimal);
			 	$("[name='f[username]']").val(user);
			 	$("[name='f[password]']").val(pass);
				$("#modal_artikel").modal();
				$("form").attr('url',"<?php echo base_url()?>referensi/update/tr_ektrakurikuler");
	 }
	 
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;
	
</script>







 