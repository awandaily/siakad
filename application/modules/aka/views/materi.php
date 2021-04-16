
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                       
						    <div class="body">
                           <div class="row clearfix">
						 
                    
                                <div class="col-sm-6">
                                    <select class="form-control show-tick" id="id_mapel">
                                        <option value="">--- Pilih Mata Pelajaran ---</option>
                                       <?php 
									   $dbmepel=$this->mdl->dataMapelAjar();
									   foreach($dbmepel as $val){
										   echo "<option value='".$val->id_mapel."'>".$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."'")."</option>";
									   }
									   ?>
                                    </select>
                                </div>
                            
                                
                           </div>
						  
				 <div class="card" id="area_lod">
			            <div class="body">
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable">
								<thead  class='sadow bg-teal'  style="font-size:12px;width:100%" >			
									<th class='thead' style='max-width:3px'>NO</th>
									<th class='thead' width="100px">DOWNLOAD FILE</th>
									<th class='thead' >TANGGAL</th>
								 
									<th class='thead' width="150px" > MAPEL </th>
									<th class='thead' width="150px" > NAMA MATERI </th>
									
									<th class='thead' width="100px">PENJELASAN</th>
									 
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
	 
   var  dataTable = $('#tabel').DataTable({ 
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
		 "responsive": true,
		 "searching": true,
		 "lengthMenu":
		 [[10 , 30,50,100,200,300,400,500], 
		 [10 , 30,50,100,200,300,400,500]], 
	 
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('aka/data_materi');?>",
            "type": "POST",
			"data": function ( data ) {
						
						 
						  data.id_mapel = $('#id_mapel').val();
						 
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
	   $(document).on('change', '#id_mapel,#id_kelas', function (event, messages) {			   
        
			 dataTable.ajax.reload(null,false);	
		 
		});
		
function tinjau(id)
{			var url="<?php echo base_url();?>kesiswaan/tinjau";
			$.post(url,{id:id},function(data){
				   $("#judul_tinjau").html("TINJAU DATA CBT");
				   $("#isi").html(data);
				   $("#modal_tinjau").modal();
			  });
}

function kirim()
{ $("#formSubmit")[0].reset();
  $("#judul_mdl").html("KIRIM MATERI ");
				   $("#isi").html(data);
				   $("#mdl_formSubmit").modal({backdrop: 'static', keyboard: false});
				    $("#formSubmit").attr("url","<?php echo base_url("kesiswaan/kirimMateri");?>");
					$("#ket_file").html("File Materi");
}

function edit(id,nama=null,id_kelas=null,id_mapel=null,ket=null)
{ $("#formSubmit")[0].reset();
  $("#judul_mdl").html("EDIT KIRIMAN MATERI ");
				   $("#isi").html(data);
				   $("#mdl_formSubmit").modal( );
				     $("#formSubmit").attr("url","<?php echo base_url("kesiswaan/editKirimMateri");?>");
					 $("[name='f[nama]']").val(nama);
					  $("[name='f[id_kelas]']").val(id_kelas);
					  $("[name='f[id_mapel]']").val(id_mapel);
						$("[name='f[ket]']").val(ket);
						$("[name='id']").val(id);
						$("[name='file']").removeAttr("required");
						$("#ket_file").html("Abaikan jika tidak akan ganti file");
}
  function hapus(id,judul=null){
		   alertify.confirm("<center>Hapus  <br> <span class='font-bold'>`"+judul+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("kesiswaan/hapus_materi"); ?>",{id:id},function(){
				notif("Data berhasil dihapus !!");			  
			  reload_table();
		      })
		   })
	  };
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
}
</script>
	
 
	
	  <!-- Modal -->
<div class="modal fade" id="mdl_formSubmit" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="area_formSubmit">
        <div class="modal-content">
		<form id="formSubmit" action="javascript:submitForm('formSubmit')" method="post"  >
                
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" id="judul_mdl">
                   
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="col-md-12 body">    
                 
                 <div class="row">
                                        <div class="form-line">
					                      <input type="text" class="form-control" required placeholder="Nama/Judul Materi" name="f[nama]"/>
                                        </div>
                                    </div><br>
				 <div class="row">
                                        <div class="form-line">  
					                       <select class="form-control show-tick" id="kelas" name="f[id_kelas]" required>
                                        <option value="">--- Pilih Kelas ---</option>
                                         <?php 
									  
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id_kelas."'>".$this->m_reff->goField("v_kelas","nama","where id='".$val->id_kelas."'")."</option>";
									   }
									   ?>
                                    </select>
                                        </div>
                                    </div><br>
				 <div class="row">
                                        <div class="form-line">  
					                      <select class="form-control show-tick" id="mapel" required name="f[id_mapel]">
                                        <option value="">--- Pilih Mata Pelajaran ---</option>
                                       <?php 
									    foreach($dbmepel as $val){
										   echo "<option value='".$val->id_mapel."'>".$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."'")."</option>";
									   }
									   ?>
                                    </select>
                                        </div>
                                    </div>
									
									<br>
				<div class="row">
                                        <div class="form-line"><span id="ket_file"> File Materi</span>
					                      <input type="file" accept="xlsx,docx,pptx,dpf" class="form-control" name="file"  required/>
                                        </div>
                                    </div><br>
									
									<div class="row"> PENJELASAN
                                        <div class="form-line">  
					                     <textarea name="f[ket]" class="form-control"> </textarea>
                                        </div>
                                    </div>
                  <input type="hidden" name="id"/>
                  <?php echo $this->m_reff->setToken();?>
                 
              
                
                
            </div>
            </div>
            <div class="row clearfix"></div>
            <div class="modal-footer">
			  
              <button onclick="submitForm('formSubmit')"  class="pull-right waves-effect btn bg-indigo"><i class="material-icons">assignment</i>KIRIM MATERI</button>
                         
                        </div>
            </form>
        
		</div>
    </div>
</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	  <div class="modal fade" id="modal_tinjau" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document" >
				
	                  <div class="modal-content" > <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title" id="judul_tinjau">  </h4>
			             </div>
                     <div id="isi"></div>
					
				</div>
			 
         </div><!-- /.modal-dialog -->
         </div><!-- /.modal-dialog -->