 <?php $cek=$this->mdl->cektahap(1);
 if(!$cek){
 echo "<div class='card'><center><h4> <br>TAHAP 1 BELUM SELESAI !! </h4> Mohon untuk menyelesaikan tahap 1 terlebih dahulu.</center></div>";
 return false;
 }
  
  $cek=$this->mdl->cektahap(2);
 if(!$cek){ ?>
 <center style="margin-top:-20px">
 <a href="javascript:selesai('<?php echo base_url()?>guru_instal/beres/2')"   type="button" class="btn bg-green waves-effect sadow"> <b>JIKA TAHAPAN INI SUDAH SELESAI MOHON KLIK DISINI </b></a>
   </center>  
     
   
	<br>
 <?php  } ?>    
 
 
<script>
 function selesai(url){
		   alertify.confirm("<center> Yakin tahap ini sudah selesai ? <br> Setelah ini anda tidak dapat merubah kembali ditahap ini. </center>",function(){
		   $.post(url,function(){
			  window.location.href="<?php echo base_url()?>guru_instal/tahap3";
		      })
		   })
	  };
	   
 </script>    
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header row"  >
                          <div class="col-md-6"  style="padding-bottom:20px">   <h2>LANGKAH 2 .::. Input KI.KD</h2>
							 </div>
							 <div class="col-md-4" style="margin-top:-9px;padding-bottom:15px" >
                                        <select id="mapelajar" class="form-control show-tick " onchange="reload_table()" >
                                        <option value="" >=== Filter Mapel / Tingkat ===</option>
										
										
											<?php 
										   $db=$this->mdl->mapelAjarGroup();
										   foreach($db as $val){
											       echo "<option value='".$val->id."'>".$val->mapel." / Tingkat :".$val->nama_tingkat."</option>";
										   }
										   ?>
									  
                                    </select>   
                            </div>
							<?php //	if(!$cek){?>
						 <div class="col-md-2" style="margin-top:20px">
                           <button onclick="add()" type="button" class="btn-top btn-block btn pull-right bg-teal waves-effect">
                                    <i class="material-icons">create</i>
                                   Tambah  
                           </button>
						 </div>
							<?php // } ?>
                        </div>
                       
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' style="min-width:80px">EDIT | HAPUS</th>
									<th class='thead' >MAPEL / TINGKAT</th>
									<th class='thead' >KD3</th>
									<th class='thead' >KD3:KB</th>
									<th class='thead' >KD3:DESKRIPSI</th>
									<th class='thead' >KD4</th>
									<th class='thead' >KD4:KB</th>
									<th class='thead' >KD4:DESKRIPSI</th>
								 	 
								 	
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
			   
			   $.ajax({ 
					type: 'POST', 
					url: '<?php echo site_url("guru_instal/hapus_kikd"); ?>', 
					data: {id:id,code:code}, 
					dataType: 'json',
					success: function (data) {
						if(data['hasil']==false)
						{
							notif("Maaf tidak dapat dihapus karena KIKD ini telah terisi materi!<br>Silahkan hapus dahulu data materi pada tahap 3.");
						} 
							reload_table();
						 
						
					}
				});
			   
		    
			  
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
		 "responsive": true,
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
                      columns:[ 2,3,4,5,6,7,8]
                },text:'Download Excell',
							
                    },
					
					 
				 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('guru_instal/kikd');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.mapelajar= $('#mapelajar').val();
					   
		 },
		   beforelabel: function() {
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
	   
		 
	function reload_table()
	{
		  dataTable.ajax.reload(null,false);	
		//  carikan();
	};
	</script>
	
	
  <script>
  function pilmapel()
 {
	$.post("<?php echo site_url("guru_instal/getMapelAjar"); ?>",function(data){
			  $("#data_mapel").html(data);
		      }); 
 }
 </script>
	
	
<script>
function add()
{
	$("#mdl_modal_artikel").modal( );
	
	 $("#addKikd").html("<center><div class='btn bg-blue-grey' onclick='add_input()'><i class='material-icons'>exit_to_app</i> INPUT SATUAN </div> &nbsp; <div class='btn bg-teal'  onclick='add_file()'><i class='material-icons'>note_add</i> IMPORT DARI FILE MS.Excell </div></center>");
 
}
function add_file()
{
     $.post("<?php echo site_url("guru_instal/addKikd_file"); ?>",function(data){
			  $("#addKikd").html(data);
		      }); 
}
function add_input()
{
     $.post("<?php echo site_url("guru_instal/addKikd"); ?>",function(data){
			  $("#addKikd").html(data);
		      }); 
}
</script>
	 

	
 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitFormKikd('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>guru_instal/insert_kikd"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TAMBAH DATA KI.KD  </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	  <div id="addKikd">
					   	<center>
					   	      <div class='btn bg-blue-grey' onclick="add_input()"><i class="material-icons">exit_to_app</i> INPUT SATUAN </div>
					   	       <div class='btn bg-teal'  onclick="add_file()"><i class="material-icons">note_add</i> IMPORT DARI FILE MS.Excell </div>
					   	</center>    
					   	  </div>
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
					<!--	  
                            <div class="btn-group" role="group" aria-label="Default button group">
                                  
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitFormKikd('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>-->
                             
                        </div>

				</div>
				</div>
					 
       		</form>
				</div>
				
         </div><!-- /.modal-dialog -->
       
  
   <script>
 function edit(id,nama)
	 {	 	
			 $.post("<?php echo site_url("guru_instal/editkikd"); ?>",{id:id},function(data){
		 	   $("#editMateri").html(data);
			    $("#mdl_modal_edit").modal();
			}); 
				
	  }
 
</script>

 									
 <script>
 $('.select').selectpicker();
  function rpp()
 {
	 notif("Maaf!! Fiture ini masih sedang dikerjakan silahkan dilewat dulu.");
 }
 </script>
				
 <div class="modal fade" id="mdl_modal_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" id="area_modal_edit" role="document">
				   
			<div id="editMateri"></div>
			  
		  </div>
		 </div>
	 		
						
						
						
						
						
 