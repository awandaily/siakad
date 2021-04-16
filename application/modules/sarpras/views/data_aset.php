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
                          <div class="col-md-10 " style="padding-bottom:15px" >     
                            <h2 style='font-size:16px'><b>DATA ASET</b></h2> 
                          </div>
        						      <div class="col-md-2 col-xs-12"  align="center" style="margin-top:20px"> 
            							  
							            </div>
							          </div>

                        <div class="body">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#w-tanah">TANAH</a></li>
                            <li><a data-toggle="tab" href="#w-bangunan">BANGUNAN</a></li>
                            <li><a data-toggle="tab" href="#w-ruangan">RUANGAN</a></li>
                            <li><a data-toggle="tab" href="#w-barang">BARANG</a></li>
                          </ul>
                          <div class="tab-content">

                            <div id="w-tanah" class="tab-pane fade in active">

                              <div class="row">
                                <div class="col-md-2">
                                  <button onclick="add_tanah()" type="button" class="pull-right btn btn-block bg-teal waves-effect">
                                    <i class="material-icons">create</i>
                                   Tambah Data
                                  </button>
                                </div>
                              </div>
                              <div class="table-responsive">
                               <table class="table table-bordered" id="dt-tanah">
                                 <thead>
                                   <th>Action</th>
                                   <th>Nama Tanah</th>
                                   <th>Luas Tanah</th>
                                   <th>Atas Nama</th>
                                 </thead>
                                 <tbody>
                                   
                                 </tbody>
                               </table>
                              </div>

                            </div>
                            <div id="w-bangunan" class="tab-pane fade">
                              
                              <div class="row">
                                <div class="col-md-2">
                                  <button onclick="add_bangunan()" type="button" class="pull-right btn btn-block bg-teal waves-effect">
                                    <i class="material-icons">create</i>
                                   Tambah Data
                                  </button>
                                </div>
                              </div>
                              <div class="table-responsive">
                               <table class="table table-bordered" id="dt-bangunan" style="width: 100%">
                                 <thead>
                                   <th>Action</th>
                                   <th>Nama Bangunan</th>
                                   <th>Tanah</th>
                                   <th>Keterangan</th>
                                 </thead>
                                 <tbody>
                                   
                                 </tbody>
                               </table>
                              </div>

                            </div>
                            <div id="w-ruangan" class="tab-pane fade">
                              <div class="row">
                                <div class="col-md-2">
                                  <button onclick="add_ruangan()" type="button" class="pull-right btn btn-block bg-teal waves-effect">
                                    <i class="material-icons">create</i>
                                   Tambah Data
                                  </button>
                                </div>
                              </div>
                              <div class="table-responsive">
                               <table class="table table-bordered" id="dt-ruangan" style="width: 100%">
                                 <thead>
                                   <th>Action</th>
                                   <th>Nama Ruangan</th>
                                   <th>Bangunan</th>
                                   <th>Keterangan</th>
                                 </thead>
                                 <tbody>
                                   
                                 </tbody>
                               </table>
                              </div>
                            </div>

                            <div id="w-barang" class="tab-pane fade">
                              <div class="row">
                                <div class="col-md-2">
                                  <button onclick="add_barang()" type="button" class="pull-right btn btn-block bg-teal waves-effect">
                                    <i class="material-icons">create</i>
                                    Tambah Data
                                  </button>
                                </div>
                              </div>
                              <div class="table-responsive">
                               <table class="table table-bordered" id="dt-barang" style="width: 100%">
                                 <thead>
                                   <th>Action</th>
                                   <th>Nama Barang</th>
                                   <th>Ruangan</th>
                                   <th>Qty Baik</th>
                                   <th>Qty Rusak</th>
                                   <th>Keterangan</th>
                                 </thead>
                                 <tbody>
                                   
                                 </tbody>
                               </table>
                              </div>
                            </div>

                          </div>

                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
  <script type="text/javascript">
   


	  
	
	  
  var save_method; //for save method string
  var table_tanah;
   // $(document).ready(function() {
  table_tanah = $('#dt-tanah').DataTable({ 
        "searching": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sarpras/getTanah');?>",
            "type": "POST",
     
        },

        //Set column definition initialisation properties.
        "columnDefs": [
          { 
            "targets": [ 0,-1,-2,-3], //last column
            "orderable": false, //set not orderable
          },
        ],
  
    });
    //});

  var table_bangunan;
   // $(document).ready(function() {
  table_bangunan = $('#dt-bangunan').DataTable({ 
        "searching": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sarpras/getBangunan');?>",
            "type": "POST",
     
        },

        //Set column definition initialisation properties.
        "columnDefs": [
          { 
            "targets": [ 0,-1,-2,-3], //last column
            "orderable": false, //set not orderable
          },
        ],
  
    });
    //});

  var table_ruangan;
   // $(document).ready(function() {
  table_ruangan = $('#dt-ruangan').DataTable({ 
        "searching": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sarpras/getRuangan');?>",
            "type": "POST",
     
        },

        //Set column definition initialisation properties.
        "columnDefs": [
          { 
            "targets": [ 0,-1,-2,-3], //last column
            "orderable": false, //set not orderable
          },
        ],
  
    });

  var table_barang;
   // $(document).ready(function() {
  table_barang = $('#dt-barang').DataTable({ 
        "searching": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sarpras/getBarang');?>",
            "type": "POST",
     
        },

        //Set column definition initialisation properties.
        "columnDefs": [
          { 
            "targets": [ 0,-1,-2,-3], //last column
            "orderable": false, //set not orderable
          },
        ],
  
  });
    //}); 
	function reload_table(){
		 table_tanah.ajax.reload();
     table_bangunan.ajax.reload();
     table_ruangan.ajax.reload();
     table_barang.ajax.reload();
	}
	</script>
	
	
	
	
	
<script>
  function add_tanah(){
    $("#modal_tanah").closest('form').find("input[type=text], textarea, select, input[type=number]").val("");
  	$("#mdl_modal_tanah").modal( );
    $("[name='edit_id']").val("");
  	$("#defaultModalLabel").html("Tambah Data");
  }

  function tanah_edit(id, nama, luas, atas){
  	$("#mdl_modal_tanah").modal();
  	$("#defaultModalLabel").html("Edit Data");
  	$("[name='f[luas_tanah]']").val(luas);
    $("[name='f[atas_nama]']").val(atas);
    $("[name='f[nama_tanah]']").val(nama);
  	$("[name='edit_id']").val(id);
  }

  function tanah_delete(id,artikel){
     alertify.confirm("<center>Hapus  ?</center>",function(){
     $.post("<?php echo site_url("sarpras/tanah_delete"); ?>",{id:id},function(){
       reload_table();
        })
     })
  }

</script>

<script>
  tanah_select("");
  function add_bangunan(){
    $("#modal_bangunan").closest('form').find("input[type=text], textarea, select, input[type=number]").val("");
    tanah_select("");
    $("#mdl_modal_bangunan").modal( );
    $("[name='edit_id_bangunan']").val("");
    $("#mdl_title_bangunan").html("Tambah Data");
  }

  function tanah_select(id){
    $.post("<?php echo site_url("sarpras/tanah_select"); ?>",{id:id},function(data){
       $("#sel_tanah").html(data);
    })
    
  }

  function bangunan_edit(id, nama, tanah, keterangan){
    tanah_select(tanah);
    $("#mdl_modal_bangunan").modal();
    $("#mdl_title_bangunan").html("Edit Data");
    $("[name='f[nama_bangunan]']").val(nama);
    $("[name='f[keterangan]']").val(keterangan);
    $("[name='edit_id_bangunan']").val(id);
  }

  function bangunan_delete(id,artikel){
     alertify.confirm("<center>Hapus  ?</center>",function(){
     $.post("<?php echo site_url("sarpras/bangunan_delete"); ?>",{id:id},function(){
       reload_table();
        })
     })
  }

</script>

<script>
  bangunan_select("");
  function add_ruangan(){
    $("#modal_ruangan").closest('form').find("input[type=text], textarea, select, input[type=number]").val("");
    bangunan_select("");
    $("#mdl_modal_ruangan").modal( );
    $("[name='edit_id_ruangan']").val("");
    $("#mdl_title_bangunan").html("Tambah Data");
  }

  function bangunan_select(id){
    $.post("<?php echo site_url("sarpras/bangunan_select"); ?>",{id:id},function(data){
       $("#sel_bangunan").html(data);
    })
    
  }

  function ruangan_edit(id, nama, tanah, keterangan){
    bangunan_select(tanah);
    $("#mdl_modal_ruangan").modal();
    $("#mdl_title_ruangan").html("Edit Data");
    $("[name='f[nama_ruangan]']").val(nama);
    $("[name='f[keterangan]']").val(keterangan);
    $("[name='edit_id_ruangan']").val(id);
  }

  function ruangan_delete(id,artikel){
     alertify.confirm("<center>Hapus  ?</center>",function(){
     $.post("<?php echo site_url("sarpras/ruangan_delete"); ?>",{id:id},function(){
       reload_table();
        })
     })
  }

</script>

<script>
  ruangan_select("");
  function add_barang(){
    $("#modal_barang").closest('form').find("input[type=text], textarea, select, input[type=number]").val("");
    ruangan_select("");
    $("#mdl_modal_barang").modal( );
    $("[name='edit_id_barang']").val("");
    $("#mdl_title_barang").html("Tambah Data");
  }

  function ruangan_select(id){
    $.post("<?php echo site_url("sarpras/ruangan_select"); ?>",{id:id},function(data){
       $("#sel_ruangan").html(data);
    })
    
  }

  function barang_edit(id, nama, ruangan, qty, keterangan, kondisi){
    ruangan_select(ruangan);
    $("#mdl_modal_barang").modal();
    $("#mdl_title_barang").html("Edit Data");
    $("[name='f[nama_barang]']").val(nama);
    $("[name='f[qty]']").val(qty);
    $("[name='f[keterangan]']").val(keterangan);
    $("[name='f[qty_rusak]']").val(kondisi);
    $("[name='edit_id_barang']").val(id);
  }

  function barang_delete(id,artikel){
     alertify.confirm("<center>Hapus  ?</center>",function(){
     $.post("<?php echo site_url("sarpras/barang_delete"); ?>",{id:id},function(){
       reload_table();
        })
     })
  }

</script>

<div class="modal fade" id="mdl_modal_barang" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">   
     <form  action="javascript:submitForm('modal_barang')" id="modal_barang" url="<?php echo base_url()?>sarpras/barang_save "  class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <span  title="tutup"  data-dismiss="modal" class=" pull-right waves-effect"><i class="material-icons">cancel</i></span>
          <div class="modal-header">
              <h4 class="modal-title col-teal" id="mdl_title_barang"></h4>
          </div>
          <div class="modal-body">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                
                <div class="row clearfix">
                                   
                    <div class="col-lg-12 col-md-12" style="margin-left:12px">
                        <div class="form-group">
                            <div class="form-line col-black">
                              Nama Barang
                              <input type='text' name="f[nama_barang]" class="form-control" required=""  />
                              <input type="hidden" name="edit_id_barang">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-line col-black">
                              Nama Ruangan
                              <span id="sel_ruangan"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-line col-black">
                              Qty Kondisi Baik
                              <input type="number" class="form-control" name="f[qty]">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-line col-black">
                              Qty Kondisi Rusak
                              <input type="number" class="form-control" name="f[qty_rusak]">
                            </div>
                        </div>
                        <br>
                        <!--
                        <div class="form-group">
                            <div class="form-line col-black">
                              Kondisi Barang
                              <select class="form-control" name="f[kondisi]">
                                <option value="1">Baik</option>
                                <option value="2">Rusak</option>
                              </select>
                            </div>

                        </div>-->
                        <br>
                        <div class="form-group">
                            <div class="form-line col-black">
                              Keterangan
                              <textarea class="form-control" name="f[keterangan]"></textarea>
                            </div>
                        </div>
                    </div>
                </div><br>
                
                 
                <div class="row clearfix">             
                    <div class="col-lg-12 col-md-12" style="margin-left:-2px">
                        <button  class="btn bg-teal waves-effect btn-block" onclick="submitForm('modal_barang')" >
                          <i class="material-icons">save</i> SIMPAN
                        </button>
                    </div>
                </div><br>
            </div>

            <div class="clearfix"></div>
          </div>
        </div>
      </form>
    </div>
</div>
	 
<div class="modal fade" id="mdl_modal_ruangan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">   
     <form  action="javascript:submitForm('modal_ruangan')" id="modal_ruangan" url="<?php echo base_url()?>sarpras/ruangan_save "  class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <span  title="tutup"  data-dismiss="modal" class=" pull-right waves-effect"><i class="material-icons">cancel</i></span>
          <div class="modal-header">
              <h4 class="modal-title col-teal" id="mdl_title_ruangan"></h4>
          </div>
          <div class="modal-body">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                
                <div class="row clearfix">
                                   
                    <div class="col-lg-12 col-md-12" style="margin-left:12px">
                        <div class="form-group">
                            <div class="form-line col-black">
                              Nama Ruangan
                              <input type='text' name="f[nama_ruangan]" class="form-control" required=""  />
                              <input type="hidden" name="edit_id_ruangan">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-line col-black">
                              Nama Bangunan
                              <span id="sel_bangunan"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-line col-black">
                              Keterangan
                              <textarea class="form-control" name="f[keterangan]"></textarea>
                            </div>
                        </div>
                    </div>
                </div><br>
                
                 
                <div class="row clearfix">             
                    <div class="col-lg-12 col-md-12" style="margin-left:-2px">
                        <button  class="btn bg-teal waves-effect btn-block" onclick="submitForm('modal_ruangan')" >
                          <i class="material-icons">save</i> SIMPAN
                        </button>
                    </div>
                </div><br>
            </div>

            <div class="clearfix"></div>
          </div>
        </div>
      </form>
    </div>
</div>
	
<div class="modal fade" id="mdl_modal_bangunan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">		
	   <form  action="javascript:submitForm('modal_bangunan')" id="modal_bangunan" url="<?php echo base_url()?>sarpras/bangunan_save "  class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <span  title="tutup"  data-dismiss="modal" class=" pull-right waves-effect"><i class="material-icons">cancel</i></span>
          <div class="modal-header">
              <h4 class="modal-title col-teal" id="mdl_title_bangunan"></h4>
          </div>
          <div class="modal-body">
	          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								
								<div class="row clearfix">
                                   
                    <div class="col-lg-12 col-md-12" style="margin-left:12px">
                        <div class="form-group">
                            <div class="form-line col-black">
                              Nama Bangunan
                              <input type='text' name="f[nama_bangunan]" class="form-control" required=""  />
                              <input type="hidden" name="edit_id_bangunan">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-line col-black">
                              Nama Tanah
                              <span id="sel_tanah"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-line col-black">
                              Keterangan
                              <textarea class="form-control" name="f[keterangan]"></textarea>
                            </div>
                        </div>
                    </div>
                </div><br>
								
								 
								<div class="row clearfix">             
                    <div class="col-lg-12 col-md-12" style="margin-left:-2px">
                        <button  class="btn bg-teal waves-effect btn-block" onclick="submitForm('modal_bangunan')" >
                          <i class="material-icons">save</i> SIMPAN
                        </button>
                    </div>
                </div><br>
            </div>

            <div class="clearfix"></div>
				  </div>
				</div>
			</form>
    </div>
</div>

<div class="modal fade" id="mdl_modal_tanah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">   
     <form  action="javascript:submitForm('modal_tanah')" id="modal_tanah" url="<?php echo base_url()?>sarpras/tanah_save"  class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <span  title="tutup"  data-dismiss="modal" class=" pull-right waves-effect"><i class="material-icons">cancel</i></span>
          <div class="modal-header">
              <h4 class="modal-title col-teal" id="defaultModalLabel"></h4>
          </div>
          <div class="modal-body">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                
                <div class="row clearfix">
                                   
                    <div class="col-lg-12 col-md-12" style="margin-left:12px">
                        <div class="form-group">
                            <div class="form-line col-black">
                              Nama Tanah
                              <input type='text' name="f[nama_tanah]" class="form-control" required=""  />
                              <input type="hidden" name="edit_id">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-line col-black">
                              Luas Tanah
                              <input type='text' name="f[luas_tanah]" class="form-control" style="text-align: right;" required="" />
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-line col-black">
                              Atas Nama
                              <input type='text' name="f[atas_nama]" class="form-control" required=""  />
                            </div>
                        </div>
                    </div>
                </div><br>
                
                 
                <div class="row clearfix">             
                    <div class="col-lg-12 col-md-12" style="margin-left:-2px">
                        <button  class="btn bg-teal waves-effect btn-block" onclick="submitForm('modal_tanah')" >
                          <i class="material-icons">save</i> SIMPAN
                        </button>
                    </div>
                </div><br>
            </div>

            <div class="clearfix"></div>
          </div>
        </div>
      </form>
    </div>
</div>
  
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

   
	 
	
	  
	 
</script>


 