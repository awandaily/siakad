

  <?php
if($this->m_reff->jmlArtikel()>1)
{?>
  <div class="row clearfix">
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                   <button id="btn1" onclick="setTable('1','btn1')" class="btn btnx btn-lg btn-default btn-block waves-effect" type="button">Proses verifikasi <span class="badge sts1"><?php echo $this->m_reff->jmlArtikel(1);?> </span></button>   </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <button id="btn3" onclick="setTable('3','btn3')" class="btn btnx btn-default btn-lg btn-block waves-effect" type="button">Diterbitkan <span class="badge sts3"><?php echo $this->m_reff->jmlArtikel(3);?></span></button>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <button id="btn2" onclick="setTable('2','btn2')" class="btn btnx btn-default btn-lg btn-block waves-effect" type="button">Konsep <span class="badge sts2"><?php echo $this->m_reff->jmlArtikel(2);?></span></button>
                                </div>
                                <div  class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <button id="btn4" onclick="setTable('4','btn4')" class="btn btnx btn-default btn-lg btn-block waves-effect" type="button">Ditolak <span class="badge sts4"><?php echo $this->m_reff->jmlArtikel(4);?></span></button>
                                </div>
                            </div>
<?php }?>
<div class="col-md-12">&nbsp;</div>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DATA POSTING</h2>
                           <button onclick="add()" type="button" class="btn-top btn pull-right btn-primary waves-effect">
                                    <i class="material-icons">create</i>
                                   BUAT BARU
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
									<th class='thead' >JUDUL </th>
									<th class='thead' >KATEGORY </th>
							 
									<th class='thead' style="max-width:5px"><i class="material-icons">star_rate</i> </th>
									<th class='thead' style="max-width:5px"><i class="material-icons">speaker_notes</i> </th>
									<th class='thead' style="max-width:5px"><i class="material-icons">thumb_up</i> </th>
									<th class='thead' style="max-width:5px"><i class="material-icons">thumb_down</i> </th>
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
		   $.post("<?php echo site_url("posting/hapus"); ?>",{id:id},function(){
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
            "url": "<?php echo site_url('posting/data');?>",
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
		 setCountTable();
	};
	</script>
	
	
	
	
	
<script>
var sts;
function add()
{	$("#f_modal_artikel")[0].reset();
	$("#modal_artikel").modal({backdrop: 'static',drugged:true, keyboard: false});
	 $("#set_artikel").hide(); 
}
</script>
	 

	
 <div class="modal fade" id="modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
				
	<form  action="javascript:saveModalArtikel('modal_artikel')" id="f_modal_artikel" url="<?php echo base_url()?>posting/save_artikel"  class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Post Artikel Baru </h4>
							 
                        </div>
                        <div class="modal-body">
                       	   
				 
	 
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="judul"   class="pull-left">Judul Artikel</label>
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
                                    <textarea id="ckeditor" name="f[konten]"></textarea>
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
												<?php $data=$this->m_reff->goResult("tr_kategory","*")->result();
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
                                                <select onchange="publikasi()" name="f[sts]" id="id_kategory" required class="form-control" style="border:#A9A9A9 solid 1px">
												<option value=''>==== Pilih ====</option>
												<option value='1'>Terbitkan</option>
												<option value='2' >Simpan Sebagai Konsep</option>
												</select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								 
							 	 <div class="row clearfix" id="set_artikel"  style="margin-top:5px">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="id_kategory" class="pull-left">Set artikel </label>
                                    </div> 
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-lines">
                                               
											   <div class="demo-radio-button" style="margin-top:5px">
                                <input name="group1" id="radio_1"   value="1" name="f[dilombakan]" type="radio">
                                <label for="radio_1">Ajukan untuk dilombakan</label>
                                <input name="group1" id="radio_2" name="f[dilombakan]"  value="0" type="radio" checked>
                                <label for="radio_2">Tidak untuk dilombakan</label>
                               
                               
                            </div>
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
 function publikasi(id=null)
 {
	  $.post("<?php echo site_url("posting/calc/"); ?>/"+sts,function(data){
			if(data=="true")
			{
				var p=$("[name='f[sts]']").val();
				if(p=="1"){ $("#set_artikel").show();   }else{ $("#set_artikel").hide();   }
 
				var p=$("#sts").val();
				if(p=="1"){  $("#set_artikel2").show(); }else{  ; $("#set_artikel2").hide(); }
			}else{
				$("#set_artikel").hide(); 
				$("#set_artikel2").hide(); 
			}
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

function setTable(sts,btn)
  {	   $(".btnx").removeClass("btn-primary");
   	   $(".btnx").addClass("btn-default");
	   $("#"+btn).removeClass("btn-default");
				$.post("<?php echo base_url();?>posting/set_table",{id:sts},function(){
			    $("#"+btn).addClass("btn-primary");
				setCountTable();
				reload_table();
		});
  }

   function setCountTable()
  {
	  var link="<?php echo base_url();?>posting/count_table";
	  $.ajax({
		 url:link,
		 method:"POST",
		 dataType:"JSON",
		 success: function(data)
				{ 	 
				  $(".sts1").html(data.ke1);
				  $(".sts2").html(data.ke2);
				  $(".sts3").html(data.ke3);
				  $(".sts4").html(data.ke4);
	 			}
	  });
  }

 function edit(id,dilombakan)
	 {	loading();
		sts=dilombakan;
		 $.ajax({
		 url:"<?php echo base_url()?>posting/edit",
		 data: {id:id},
		 method:"POST",
		// dataType: "JSON",
		 success: function(data)
            {	$.unblockUI();
			//	$("[name='f[judul]']").val(data["judul"]);
				$("#isi").html(data);
				$("#modal_artikel_edit").modal({backdrop: 'static',drugged:true, keyboard: false});
				publikasi(dilombakan);
            }
		});
	 }
	 
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;
	
</script>











 <div class="modal fade" id="modal_artikel_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
				
	<form  action="javascript:saveModalArtikelUpdate('modal_artikel_update')" id="f_modal_artikel_update" url="<?php echo base_url()?>posting/update_artikel"  class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Edit Artikel  </h4>
							 
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
  