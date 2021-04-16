  <?php
if($this->m_reff->jmlArtikel()>1)
{?>
  <div class="row clearfix">
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                   <button class="btn  btn-lg btn-info btn-block waves-effect" type="button">Proses verifikasi <span class="badge"><?php echo $this->m_reff->jmlArtikel(1);?> </span></button>   </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <button class="btn btn-info btn-lg btn-block waves-effect" type="button">Diterbitkan <span class="badge"><?php echo $this->m_reff->jmlArtikel(3);?></span></button>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <button class="btn btn-info btn-lg btn-block waves-effect" type="button">Konsep <span class="badge"><?php echo $this->m_reff->jmlArtikel(2);?></span></button>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <button class="btn btn-info btn-lg btn-block waves-effect" type="button">Ditolak <span class="badge"><?php echo $this->m_reff->jmlArtikel(4);?></span></button>
                                </div>
                            </div>
<?php }?>
<div class="col-md-12">&nbsp;</div>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DATA PESERTA</h2>
                           <button onclick="add()" type="button" class="btn-top btn pull-right btn-primary waves-effect">
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
									<th class='thead' >Photo </th>
									<th class='thead' >Nama </th>
									<th class='thead' >Jk </th>
							 		<th class='thead'  > Telp</th>
									<th class='thead'  >Email </th>
									<th class='thead'  >Alamat </th>
									<th class='thead' > Tanggal Registrasi</th>
									<th class='thead'   >Kategory </th>
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
		   alertify.confirm("<center>Hapus akun :<br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("data_peserta/hapus"); ?>",{id:id},function(){
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
            "url": "<?php echo site_url('data_peserta/data');?>",
            "type": "POST",
		 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3,-4,-5,-6,-7,-8,-9 ], //last column
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
	$("#blah").attr('src',"");
 	$("form").attr('url',"<?php echo base_url()?>profile/insert");
}
</script>
	 

	
 <div class="modal fade" id="modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog  " role="document">
				
	<form  action="javascript:save_profile_modal('modal_artikel')" id="f_modal_artikel" url="<?php echo base_url()?>profile/insert"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-indigo" id="defaultModalLabel">Tambah Data Peserta </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
							<center>  <label>
					   <div style="max-width:200px">  
								<b>	PHOTO PROFILE</b><br>				   
                                  <img  id="blah"  alt="" height="100px" />
								  <input type='file' accept=".JPG,.jpg,.png" name="poto" id="imgInp" class="form-control upload"  />
							</div>	 
							 </label>
						</center>
								<hr>
								
								<div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[owner]"   required>
                                        <input type="hidden" class="form-control" name="id_admin" >
                                        <label class="form-label">Nama</label>
                                    </div>
                                </div>
								
								 <div class="form-group form-float">
                                   <span class="card-inside-titles col-md-3"   >Jenis Kelamin</span>
								 <span style="margin-left:14px">
									<input name="f[jk]" type="radio" id="radio_1" value="l"  />
									<label for="radio_1">laki-laki</label>
									<input name="f[jk]" type="radio" id="radio_2" value="p"  />
									<label for="radio_2">Perempuan</label>
								 </span>
							    </div>
							 
							 
                              <div class="col-md-3 " style="margin-top:-10px">      
							  <span class="card-inside-titles">Kategory</span></div> 
							  <div class="col-md-9"  style="margin-top:-20px">
                                    
                              			<?php
										$kategory[""]="=== pilih ===";
										$data_penulis=$this->db->get("tr_kategory_penulis")->result();
										foreach($data_penulis as $val)
										{
											$kategory[$val->id]=$val->nama;
										}
											$default=$kategory;
										 
										echo form_dropdown("f[id_kategory_penulis]",$default,"",'class="form-control col-md-12" required');
										?>
                                   
                                </div> <hr>
                          <div class="col-md-12 row clearfix">&nbsp;</div>
						  <hr>
						   <div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[telp]"   required>
                                        <label class="form-label">Telpon</label>
                                    </div>
                                </div>
								
								<div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[email]"   required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
									 
			 
					<div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <textarea type="text" class="form-control" name="f[alamat]"  required> </textarea>
                                        <label class="form-label">Alamat Lengkap</label>
                                    </div>
                                </div>
								
								<div class="form-group form-float success">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[username]"   required>
                                        <label class="form-label">Username</label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="password" value="" >
                                        <label class="form-label">Password baru</label>
                                    </div>
                                </div>
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="save_profile_modal('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
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

 function edit(id)
	 {	loading();
		 $.ajax({
		 url:"<?php echo base_url()?>data_peserta/edit",
		 data: {id:id},
		 method:"POST",
		 dataType: "JSON",
		 success: function(data)
            {	$.unblockUI();
			 	$("[name='f[owner]']").val(data.owner);
			 	$("[name='id_admin']").val(data.id_admin);
			 	$("[name='f[id_kategory_penulis]']").val(data.id_kategory_penulis);
			 	$("[name='f[telp]']").val(data.telp);
			 	$("[name='f[email]']").val(data.email);
			 	$("[name='f[alamat]']").val(data.alamat);
			 	$("[name='f[username]']").val(data.username);
			    $('input:radio[name="f[jk]"][value='+data.jk+']')[0].checked = true;
				$("#modal_artikel").modal({backdrop: 'static',drugged:true, keyboard: false});
				$("#blah").attr('src',"<?php echo base_url()?>file_upload/dp/"+data.poto);
 				$("form").attr('url',"<?php echo base_url()?>profile/update");
		 
            }
		});
	 }
	 
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;
	
</script>







 