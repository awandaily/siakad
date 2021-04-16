 <br> <div style="margin-top:-5px" class="col-md-3 col-xs-12 pull-right"  >
							   <button onclick="copy()" type="button" class="btn-top btn btn-block pull-right bg-primary sadows waves-effect sadow">
										<i class="material-icons">autorenew</i>
									   Copy dari semester sebelumnya
							   </button>
									
							</div> 
							
							
							
							<?php  
  
  $cek=1;//$this->mdl->cektahap(2);
 if(!$cek){ ?>
 <center style="margin-top:-20px">
 <a href="javascript:selesai('<?php echo base_url()?>guru_instal/beres/1')"   type="button" class="btn bg-green waves-effect sadow"> <b>JIKA TAHAPAN INI SUDAH SELESAI MOHON KLIK DISINI </b></a>
   </center>  
   
   
    <div style="margin-top:-5px" class="col-md-3 col-xs-12 pull-right"  >
							   <button onclick="copy()" type="button" class="btn-top btn btn-block pull-right bg-primary sadows waves-effect sadow">
										<i class="material-icons">autorenew</i>
									   Copy dari semester sebelumnya
							   </button>
									
							</div> 
   
   
	<br>
 <?php  } ?> 
<script>
 function copy(){
	 var url="<?php echo base_url()?>guru_instal/copas_tahap1";
		   alertify.confirm("<center>Anda akan  mengcopy data kelas mengajar semester sebelumnya ke semester saat ini ? </center>",function(){
		   $.post(url,function(data){
			   if(data=="false")
			   {
				   notif("Data untuk semester sekarang telah diisi... Anda tidak dapat mengkopinya");
				   return false;
			   }
				reload_table();
		      })
		   })
	  };
	   
 </script>  
<script>
 function selesai(url){
		   alertify.confirm("<center> Yakin tahap ini sudah selesai ? <br> Setelah ini anda tidak dapat merubah kembali ditahap ini. </center>",function(){
		   $.post(url,function(){
			  window.location.href="<?php echo base_url()?>guru_instal/tahap2";
		      })
		   })
	  };
	   
 </script>  
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header row">
                         <div class="col-md-6" style="padding-bottom:20px"  >     <h2 style='font-size:16px'>LANGKAH 1 :: Menentukan Kelas dan Mapel yang diampu</h2> </div>
						  <div class="col-md-4 hide col-xs-12"  style="padding-bottom:15px"  >
                                        <select class="form-control show-tick"   id="fkelas" data-live-search="true"  >
                                        <option value="">=== Filter Kelas ===</option>
										
										
											<?php 
										   $db=$this->db->get("tr_tingkat")->result();
										   foreach($db as $val){
											   echo "<optgroup label='TINGKAT ".$val->nama."'>";
												 
												   $dbs=$this->db->get_where("v_kelas",array("id_tk"=>$val->id))->result();
												   foreach($dbs as $vals){
													   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
												   }
												  
											   echo "</optgroup>";
										   }
										   ?>
									  
                                    </select>   
                            </div>
						 
						 
							 <div class="col-md-2 col-xs-12 pull-right" style="margin-top:20px">
							   <button onclick="add()" type="button" class="btn-top btn btn-block pull-right bg-teal waves-effect">
										<i class="material-icons">create</i>
									   Tambah  
							   </button>
									
							</div> 
						 
                        </div>
                       
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >KELAS</th>
									<th class='thead' >MATA PELAJARAN</th>
									<th class='thead' >JML JAM / MINGGU</th>
									<th class='thead' >FILE RPP</th>
									 	<th class='thead' >FILE MATERI</th>
								 	<th class='thead'  >OPSI</th>
								</thead>
							</table>
							</div>						
						</div>						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				
				
				
				
				
				
				

 <div class="modal fade" id="mdl_modal_materi" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" id="area_modal_materi" role="document">
				
	<form  action="javascript:submitFormMateri('modal_materi')" id="modal_materi" url="<?php echo base_url()?>guru_instal/insert_materi_ajar2"  
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
  <script type="text/javascript">
   function hapusBahan(id,akun,sumber,idmateri,code){
		   alertify.confirm("<center>Hapus  <br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("guru_instal/hapus_bahan2"); ?>",{id:id,sumber:sumber,code:code},function(){
			   dataMateri(idmateri);
		      })
		   })
	  };
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
 
 function dataMateri(id)
 {
	$.post("<?php echo site_url("guru_instal/dataMateri2"); ?>",{id:id},function(data){
			  $("#dataMateri").html(data);
	 }); 
 }
 
 
 
  	  function hapus(id,akun,idkelas,idmapel){
		   alertify.confirm("<center>Hapus  <br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("guru_instal/hapus_kelas"); ?>",{id:id,idkelas:idkelas,idmapel:idmapel},function(){
			   reload_table();
		      })
		   })
	  };
	  
	
	  
      var save_method; //for save method string
    var table;
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
		 [[5,10 ,30,50,100], 
		 [5,10 ,30,50,100], ], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,2,3 ]
                },text:' Excell',
							
                    },
					 
					{extend: 'colvis',
                        exportOptions: {
                  columns:[ 0,2,3 ]
                },text:' Kolom',
							
                    },
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('guru_instal/kelas');?>",
            "type": "POST",
			"data": function ( data ) {
			  data.kelas= $('#fkelas').val(); 
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
	function reload_table()
	{
		 dataTable.ajax.reload(null,false);	
		 $("#link").show();
		  $("#upload").hide();
	};
	 $(document).on('change', '#fkelas', function (event, messages) {			   
        
			 dataTable.ajax.reload(null,false);	
		 
		});
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
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>guru_instal/insert_kelas"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TAMBAH KELAS  & MAPEL SESUAI YANG DIAMPU</h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	  		
									
									  <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">PILIH KELAS</label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                        <select class="form-control show-tick" required name="id_kelas" data-live-search="true" onchange="pilmapel()">
                                        <option value="">=== Pilih Kelas ===</option>
										
										
											<?php 
										   $db=$this->db->get("tr_tingkat")->result();
										   foreach($db as $val){
											   echo "<optgroup label='TINGKAT ".$val->nama."'>";
												 $this->db->order_by("nama","ASC");
												   $dbs=$this->db->get_where("v_kelas",array("id_tk"=>$val->id))->result();
												   foreach($dbs as $vals){
													   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
												   }
												  
											   echo "</optgroup>";
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
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <select class="form-control show-tick" id="id_mapel">
                                        <option value="">--- Pilih ---</option>
                                        </select>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">JML JAM / Minggu</label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <select class="form-control show-tick" required name="jml_jam" data-live-search="true">
												<option value="">--- Pilih ---</option>
												<?php for($i=1;$i<=50;$i++){
													echo '<option value="'.$i.'">'.$i.'</option>';
												}?>
												
												</select>
                                            </div>
                                        </div>
                                    </div>
                                    
                             	<div class="row clearfix">
                             	             <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">TOTAL JAM 1 SEMESTER</label>
                                    </div>
                                     <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <input type="text"  onkeydown="return nomor(this, event);" placeholder="Total jam dalam satu semester" class="form-control show-tick" required name="total_jam" style="margin-left:4px;width:310px" > 
                                            </div>
                                        </div>
                                    </div>
								</div>		
									
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">Upload File RPP</label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											 <input type="file"   name="upload" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
									
									
									
									 <script>
  function pilmapel()
 {
	  var idk=$("[name='id_kelas']").val();
			$.post("<?php echo site_url("guru_instal/getMapel"); ?>",{idk:idk},function(data){
			  $("#data_mapel").html(data);
		      }); 
 }
 </script>
									
									
 <script>
 $('sselect').selectpicker();
 </script>
			 
					 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                       
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
       
   
<script>
 
	 function edit(id,kelas,mapel,jam,jmljam)
	 {	 
		 		  
			 $.post("<?php echo site_url("guru_instal/editMapelAjar"); ?>",{id:id,kelas:kelas,mapel:mapel,jam:jam,jmljam:jmljam},function(data){
		 	   $("#editan").html(data);
			    $("#mdl_modal_edit").modal();
			}); 
	 }
   
</script>




 <div class="modal fade" id="mdl_modal_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
	<form  action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url()?>guru_instal/update_mapelajar"  method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" >Edit Data</h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <div id="editan"></div>
							 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                      
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_edit')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
   </div><!-- /.modal-dialog --> 

		 



 
	
 
						
						
						
						
						
						
						
 