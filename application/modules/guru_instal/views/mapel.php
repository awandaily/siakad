 
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>LANGKAH 2 :: Menentukan Mapel </h2>
                           <button onclick="add()" type="button" class="btn-top btn pull-right btn-primary waves-effect">
                                    <i class="material-icons">create</i>
                                   Tambah Mapel
                           </button>
								
                        </div>
                       
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >KELAS </th>
									<th class='thead' >MATA PELAJARAN </th>
									 
								 	<th class='thead' style="min-width:50px">OPSI</th>
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
		   $.post("<?php echo site_url("guru_instal/hapus_mapel"); ?>",{id:id},function(){
			   reload_table();
		      })
		   })
	  };
	  
	
	  
      var save_method; //for save method string
    var table;
   // $(document).ready(function() {
      table = $('#table').DataTable({ 
		"paging":   false,
        "ordering": false,
        "info":     false,
        "search":     false,
		"bFilter": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('guru_instal/mapel');?>",
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
	$("#mdl_modal_artikel").modal( );
	$("#modal_artikel")[0].reset();
	 
}
</script>
	 

	
 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>guru_instal/insert_mapel"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TAMBAH MAPEL YANG DIAMPU  </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 
								
							  <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">PILIH KELAS</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                        <select class="form-control show-tick"  name="id_kelas" data-live-search="true">
                                        <option value="">=== Pilih Kelas ===</option>
										
										
											<?php 
										   $db=$this->db->query("select * from tr_kelas_ampu where id_guru='".$this->mdl->idu()."' and id_semester='".$this->m_reff->semester()."' and id_tahun='".$this->m_reff->tahun()."' ")->result();
										   foreach($db as $val){   
													   echo "<option value='".$val->id."'>".$this->m_reff->goField("tr_mapel","nama","where id='".$val->id."'")."</option>";
										   }
										   ?>
									  
                                    </select>  
                                            </div>
                                        </div>
                                    </div>
                                </div>

							 
								
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">PILIH MAPEL</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <select class="form-control show-tick" id="id_mapel">
                                        <option value="">--- Pilih ---</option>
                                        </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								 
									
									
									  <script>
	 						 
							$('select').selectpicker();
						 
							</script>
			 
					 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
       
  
 <script>
  function pilmapel()
 {
	  var idj=$("#id_jurusan").val();
	 var idtk=$("#id_tk").val();
			$.post("<?php echo site_url("guru_instal/getMapel"); ?>",{idj:idj,idtk:idtk},function(data){
			  $("#data_mapel").html(data);
		      }); 
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

 function edit(id,nama)
	 {	 
		 			
			 	$("[name='id']").val(id);
			 	$("[name='id_']").val(id);
			 	$("[name='f[nama]']").val(nama);
				$("#modal_artikel").modal({backdrop: 'static',drugged:true, keyboard: false});
				$("form").attr('url',"<?php echo base_url()?>guru_instal/update/tr_kategory");
	 }
	 
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;
	
</script>







 
	
 
						
						
						
						
						
						
						
 