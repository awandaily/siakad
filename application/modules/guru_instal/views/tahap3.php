 <?php $cek=$this->mdl->cektahap(2);
 if(!$cek){
 echo "<div class='card'><center><h4> <br>TAHAP 2 BELUM SELESAI !! </h4> Mohon untuk menyelesaikan tahap 2 terlebih dahulu.</center></div>";
 return false;
 }
  
  $cek=$this->mdl->cektahap(3);
 if(!$cek){ ?>
 <center style="margin-top:-20px">
 <a href="javascript:selesai('<?php echo base_url()?>guru_instal/beres/3')"   type="button" class="btn bg-green waves-effect sadow"> <b>JIKA TAHAPAN INI SUDAH SELESAI MOHON KLIK DISINI </b></a>
   <br>
   <br>
<p class='col-red font-bold   '>   Tahapan ini bisa ditambahkan ketika proses KBM sedang berlangsung (tidak harus sekarang)</p>
   </center>  
   
	 
 <?php  } ?>    
<script>
 function selesai(url){
		   alertify.confirm("<center> Yakin tahap ini sudah selesai ? <br> Setelah ini anda tidak dapat merubah kembali ditahap ini. </center>",function(){
		   $.post(url,function(){
			  window.location.href="<?php echo base_url()?>guru_instal/tahap4";
		      })
		   })
	  };
	   
 </script>   
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
						 <div class="col-md-6" style="padding-bottom:20px" > 
                            <h2>LANGKAH 3 .::. Input Materi Pembelajaran</h2></div>
							
							 <div class="col-md-4" style="margin-top:-9px;padding-bottom:15px" >
                                        <select id="mapelajar" class="form-control show-tick "   >
                                        <option value="" >=== Filter Mapel / Tingkat ===</option>
										
										
											<?php 
										   $db=$this->mdl->mapelAjarGroup();
										   foreach($db as $val){
											       echo "<option value='".$val->id."'>".$val->mapel." / Tingkat :".$val->nama_tingkat."</option>";
										   }
										   ?>
									  
                                    </select>   
                            </div>
									
							<div class="col-md-2" style="margin-top:20px">
                           <button onclick="add()" type="button" class="btn-top btn-block btn pull-right bg-teal waves-effect">
                                    <i class="material-icons">create</i>
                                   Tambah  
                           </button>
							</div>

							 <br>
                        </div>
                       
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' style="min-width:80px">EDIT | HAPUS </th>
									<th class='thead' >MAPEL - Tingkat</th>
									<th class='thead' >KD</th>
									<th class='thead' >MATERI</th>
								<!--	<th class='thead' >FILE MATERI</th>				-->			 
								 	
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
  	  function hapus(id,akun,code){
		   alertify.confirm("<center>Hapus  <br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("guru_instal/hapus_pembelajaran"); ?>",{id:id,code:code},function(){
			   reload_table();
		      })
		   })
	  };
	   function hapusBahan(id,akun,sumber,idmateri,code){
		   alertify.confirm("<center>Hapus  <br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("guru_instal/hapus_bahan"); ?>",{id:id,sumber:sumber,code:code},function(){
			   dataMateri(idmateri);
		      })
		   })
	  };
	  
	
	  
       var  dataTable = $('#table').DataTable({ 
		"paging": true,
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
						"sInfo": "Total :  _TOTAL_ , Halaman (_START_ - _END_)",
						 "sInfoEmpty": "Tidak ada data yang di tampilkan",
						   "sZeroRecords": "Data tidak tersedia",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": true,
		 "lengthMenu":
		 [[10 , 30,50,100,200,300,400,500], 
		 [10 , 30,50,100,200,300,400,500]], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:' Excell',
							
                    },
					
					 
					{extend: 'colvis',
                        exportOptions: {
                  columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:' Kolom',
							
                    },
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('guru_instal/pembelajaran');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.mapelajar= $('#mapelajar').val();
					   
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
          "targets": [ 0,-1,-2,-3,-4 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
     	  var x=0; 
	 </script>
	 <script>
		
	   $(document).on('change', '#mapelajar', function (event, messages) {			   
        		reload_table();
		});
		 
	function reload_table()
	{
		  dataTable.ajax.reload(null,false);	
	};
	function reload_table2()
	{
		  dataTable.ajax.reload(null,false);	
	};
	</script>
	
	
  <script>
  function pilkikd()
 {
	 var id_mapel_ajar=$("#id_mapel_ajar").val();
	$.post("<?php echo site_url("guru_instal/getKikd"); ?>",{id:id_mapel_ajar},function(data){
			  $("#data_kikd").html(data);
		      }); 
 }
 function pilkikd2(val)
 {
	 var id_mapel_ajar=$("#id_mapel_ajar2").val();
	$.post("<?php echo site_url("guru_instal/getKikdDisabled"); ?>",{id:id_mapel_ajar,val:val},function(data){
			  $("#data_kikd2").html(data);
		      }); 
 }
 
 function dataMateri(id)
 {
	$.post("<?php echo site_url("guru_instal/dataMateri"); ?>",{id:id},function(data){
			  $("#dataMateri").html(data);
	 }); 
 }
 
 </script>
	
	
<script>
function add()
{
	$.post("<?php echo site_url("guru_instal/addMateri"); ?>" ,function(data){
			  $("#addMateri").html(data);
	 }); 
	$("#mdl_modal_artikel").modal( );
	$("#modal_artikel")[0].reset();
	 
}
function addMateri(id,idkikd,code)
 {
	 $("[name='link']").prop("required",true);
	 $("[name='upload']").prop("required",false);

	 dataMateri(id);
	 $("#upload").hide();
	 $("[name='idadd']").val(id);
	 $("[name='code']").val(code);
	 $("[name='idkikd']").val(idkikd);
	 $("#link").show();
	$("#mdl_modal_materi").modal();
	$("#modal_materi")[0].reset();
 }
</script>
	 

	
 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>guru_instal/insert_materi"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TAMBAH MATERI PEMBELAJARAN  </h4>
							
                        </div>
                        <div class="modal-body">
                       <div id="addMateri"></div>
									 
                       </div>

							  	
									
 <script>
 $('.select').selectpicker();
 </script>
			 
				<center class='col-pink'>	Tahapan ini bisa ditambahkan ketika proses KBM sedang berlangsung (tidak harus sekarang) </center>
 
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
       
  





 <div class="modal fade" id="mdl_modal_materi" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" id="area_modal_materi" role="document">
				
	<form  action="javascript:submitFormMateri('modal_materi')" id="modal_materi" url="<?php echo base_url()?>guru_instal/insert_materi_ajar"  
	method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TAMBAH FILE  </h4>
							  <input type="hidden" name="idadd">
							  <input type="hidden" name="idkikd">
							  <input type="hidden" name="code">
                        </div>
                        <div class="modal-body">
                       	   
						 <div class="col-md-6">
						 <div class="col-md-12">
                                        <b>Nama File</b>
                                        <div class="input-group">
                                           
                                            <div class="form-line">
                                                <input type="text" class="form-control" required name="f[nama]">
                                            </div>
                                        </div>
                         </div>

						 <div class="col-md-12">
                                        <b>File Di Upload Dari </b>
                                        <div class="input-group">
                                             
                                            <div class="form-line">
                                              <div class="demo-radio-button">
													<input name="sumber" type="radio" value="1" id="radio_1" checked />
													<label for="radio_1">LINK URL</label>
													<input name="sumber" type="radio" value="2" id="radio_2" />
													<label for="radio_2">Komputer</label>
											  </div>		
                                            </div>
                                        </div>
                         </div>
						  <div class="col-md-12" id="link">
                                        <b>LINK URL</b>
                                        <div class="input-group">
                                           
                                            <div class="form-line">
                                                <input type="text" class="form-control"   name="link" placeholder="http://linkupload...">
                                            </div>
                                        </div>
                         </div>
						 <div class="col-md-12" id="upload">
                                        <b>Upload</b>
                                        <div class="input-group">
                                           
                                            <div class="form-line">
                                                <input type="file" class="form-control"   name="upload">
                                            </div>
                                        </div>
                         </div>
						 <div class="btn-group pull-right" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitFormMateri('modal_materi')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
						 
						 </div>  
						 <div class="col-md-6 entry" id="dataMateri">
							
						 </div>  
								
							  
									 
                       </div>

						  
						 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
       
  


<script>
$("#upload").hide();
$("#radio_1").click(function(){
$("#link").show();
$("[name='link']").prop("required",true);
$("[name='upload']").prop("required",false);
$("#upload").hide();

$("[name='upload']").val("");

});

$("#radio_2").click(function(){
$("#upload").show();
$("#link").hide();

$("[name='link']").prop("required",false);
$("[name='upload']").prop("required",true);

});
</script>

 
	
  <script>
 function edit(id,nama)
	 {	 	
			 $.post("<?php echo site_url("guru_instal/editMateri"); ?>",{id:id},function(data){
		 	   $("#editMateri").html(data);
			    $("#mdl_modal_edit").modal();
			}); 
				
	  }
 
</script>
						
						
						
						
		
 <div class="modal fade" id="mdl_modal_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
					<form  action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url()?>guru_instal/update_materi"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                   
			<div id="editMateri"></div>
			 <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_edit')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
			 </form>
		  </div>
		 </div>
	 