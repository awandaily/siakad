 
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
						
							<div class="col-md-4" style="margin-top:-9px" >
                                        <select id="ftingkat" class="form-control show-tick "  >
                                        <option value="" >=== Filter Tingkat ===</option>
                                        <option value="1" >Tingkat X</option>
                                        <option value="2" >Tingkat XI</option>
                                        <option value="3" >Tingkat XII</option>
										</select>   
                            </div>
							
							<div class="col-md-4" style="margin-top:-9px" >
                                        <select id="fjurusan" class="form-control show-tick "  >
                                        <option value="" >=== Filter Jurusan ===</option>
										<?php
										$dbs=$this->db->get("tr_jurusan")->result();
										foreach($dbs as $val)
										{
											echo ' <option value="'.$val->id.'" >'.$val->alias.'</option>';
										}?>
										</select>   
                            </div>
							
							<div class="col-md-5 clearfix row">&nbsp;</div>
							
                            <h2> &nbsp;</h2>
                    <!---       <button onclick="add()" type="button" class="btn-top btn pull-right bg-teal waves-effect">
                                    <i class="material-icons">create</i>
                                   Tambah  
                           </button>
								--->
								
								

								
                        </div>
                       
                           <!----->
				 <div class="card" id="area_lod">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >KODE</th>
									<th class='thead' >TINGKAT</th>
									<th class='thead' >JURUSAN</th>
									<th class='thead' >NAMA ROMBEL</th>
									<th class='thead' >WALI KELAS</th>
									<th class='thead' >STATUS KELAS</th>
									 
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
				
 
  <script type="text/javascript">
  	function upd_sts(id){
	 
	    var mode = document.getElementById("idsts"+id).checked;
	    $.post("<?php echo site_url("referensi/update_status_kelas"); ?>",{id:id,mode:mode},function(){
				 
		});
	}
  	  function hapus(id,akun){
		   alertify.confirm("<center>Hapus  <br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("referensi/hapus_kelas"); ?>",{id:id},function(){
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
		 "responsive": true,
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
            "url": "<?php echo site_url('referensi/getRombel');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.tingkat= $('#ftingkat').val();
						  data.jurusan= $('#fjurusan').val();
					   
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
	   $(document).on('change', '#ftingkat,#fjurusan', function (event, messages) {			   
        		reload_table();
		});
		 
	function reload_table()
	{
		  dataTable.ajax.reload(null,false);	
	};
	</script>
	
	
	
<script>
function add()
{
	 $("#mdl_modal_artikel").modal( );
	 $("#modal_artikel")[0].reset();
	  
	 $("#defaultModalLabel").html("Tambah Rombel");
}

 function edit(id,tk,jur,rom,wali)
	 {	 
		 		  
			 $.post("<?php echo site_url("referensi/editRombel"); ?>",{id:id,id_tk:tk,id_jurusan:jur,nama:rom,id_wali:wali},function(data){
		 	   $("#editRombel").html(data);
			    $("#mdl_modal_edit").modal();
			}); 
	 }
</script>
	 

	
 <div class="modal fade" id="mdl_modal_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
	<form  action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url()?>referensi/update_rombel"  method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" >Edit Rombel</h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <div id="editRombel"></div>
							 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_edit')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
   </div><!-- /.modal-dialog --> 

		 
		 
		 
		 
		 
		 
		 
		 
	
 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitFormNoResset('modal_artikel')" id="modal_artikel"  url="<?php echo base_url()?>referensi/add_kelas" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel"></h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <input type="hidden" name="id">
									
							  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">PILIH TINGKAT</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                      <select id="tingkat" name='f[id_tk]' class="form-control show-tick "  >
                                        <option value="" >=== Pilih ===</option>
                                        <option value="1" >Tingkat X</option>
                                        <option value="2" >Tingkat XI</option>
                                        <option value="3" >Tingkat XII</option>
										</select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>

							 
								
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">PILIH JURUSAN</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <select id="jurusan" name='f[id_jurusan]' class="form-control show-tick "  >
                                        <option value="" >=== Pilih ===</option>
										<?php
										$dbs=$this->db->get("tr_jurusan")->result();
										foreach($dbs as $val)
										{
											echo ' <option value="'.$val->id.'" >'.$val->alias.'</option>';
										}?>
										</select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">NAMA ROMBEL</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input type="text"   class="form-control" name='f[nama]'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
									
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black"> WALI KELAS</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <select   id="jurusan" name='f[id_wali]' class="form-control show-tick " data-live-search="true" >
                                        <option value="" >=== Pilih ===</option>
										<?php
										$dbs=$this->db->get("data_pegawai")->result();
										foreach($dbs as $val)
										{
											echo ' <option value="'.$val->id.'" >'.$val->nama.' - Nip. '.$val->nip.'</option>';
										}?>
										</select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
									
									
									
									 <script>
  function pilmapel()
 {
	  var idk=$("[name='id_kelas']").val();
			$.post("<?php echo site_url("referensi/getMapel"); ?>",{idk:idk},function(data){
			  $("#data_mapel").html(data);
		      }); 
 }
 </script>
									
									
 <script>
 //$('select').selectpicker();
 </script>
			 
					 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitFormNoResset('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
       
   