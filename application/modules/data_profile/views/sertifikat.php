 <?php $sts=$this->m_reff->goField("tm_peserta","sts","where id='".$this->session->userdata("id")."'");	?>

    <?php
    if($sts==0)
    { 
    $class="";
      }else{ 
      $class="hide";
     }?>
<div class="col-md-12">&nbsp;</div>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>SERTIFIKAT TAMBAHAN JIKA MEMILIKI </h2>
                           <button onclick="add()" type="button" class="btn-top <?php echo $class;?> btn pull-right btn-primary waves-effect">
                                    <i class="material-icons">create</i>
                                 Upload Baru
                                </button>
								
                        </div>
                        <div class="body">
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='tables' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >SERTIFKAT </th>
									<th class='thead' >NAMA SERTIFIKAT </th>
									<th class='thead' >KETERANGAN </th>
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
		   alertify.confirm("<center>Hapus  :<br> <span class='font-bold col-pink'>`"+artikel+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("data_profile/hapus_sertifikat"); ?>",{id:id},function(){
			   reload_table();
		      })
		   })
	  };
	  
	
	  
      var save_method; //for save method string
    var tabless;
   // $(document).ready(function() {
      tabless = $('#tables').DataTable({ 
	 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('data_profile/data_sertifikat');?>",
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
		 tabless.ajax.reload();
	};
	</script>
	
	
	
	
	
<script>
function add()
{
	$("#modal_artikel").modal({backdrop: 'static',drugged:true, keyboard: false});
}
</script>
	 

	
 <div class="modal fade" id="modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog " role="document">
				
	<form  action="javascript:saveModalArtikel('modal_artikel')" id="f_modal_artikel" url="<?php echo base_url()?>data_profile/save_sertifikat"  class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah Baru </h4>
							 
                        </div>
                        <div class="modal-body">
                       	   
				 
	 
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="nama"   class="pull-left">Nama Sertifkat </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input style="border:#A9A9A9 solid 1px;padding-left:5px" type="text" name="f[nama]" id="nama" class="form-control " required placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
								
							<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="file"   class="pull-left">File Sertifikat </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <input style="border:#A9A9A9 solid 1px" type="file" name="file" id="file" class="form-control " required placeholder="">
                                                <span class="pull-right" style="font-size:11px">Format JPG Max.2Mb</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
							<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="file"   class="pull-left">Keterangan</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"> 
                                                <textarea style="border:#A9A9A9 solid 1px;padding-left:5px;height:120px" type="f[ket]" name="f[ket]"   class="form-control"></textarea>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div><br>		
								
	  
							 	 
                                   
								 
									 
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
		 url:"<?php echo base_url()?>data_profile/edit_sertifikat",
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
	 
  
</script>








 