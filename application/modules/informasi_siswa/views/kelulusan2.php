<?php $token=date("His");?>  
  <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						<h2 class="sound">DATA SISWA</h2>
						 
                        </div>
						    <div class="body">
                           <div class="row clearfix">
						   
						 	<div class="col-sm-4 col-black">
                                <select class="form-control show-tick"  
								id="id_kelasf<?php echo $token;?>"   data-live-search="true"  >
                                    <option value="">=== Filter Kelas ===</option>
									
									
										<?php 
									   $db=$this->db->get_where("tr_tingkat",array("id"=>3))->result();
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
                            </div><!--  
							<div class="col-sm-4">
                                <select class="form-control show-tick" id="id_stsdata<?php echo $token;?>" >
                                    <option value="">==== Filter Status ===</option>
                                    <option value="1">Lulus</option>
                                    <option value="2">Tidak Lulus</option>
                                     <option value="3">Tidak ditampilkan</option>
                                     
                                </select>
                            </div> -->
							<div class="col-sm-4">
                               <input type="text" class='form-control' id="searching" placeholder="pencarian.." onchange='reload_table()'>
                            </div> 
                            <div class="col-sm-4">
                               	<select class="form-control show-tick" id="open" onchange='setting_kelulusan(this.value)'>
                                    <option value="0">TUTUP KELULUSAN</option>
                                    <option value="1">BUKA KELULUSAN</option>
                                </select>
                            </div> 
								 
								
							 
						 
						    
                           </div>
						  
				 <div class="cardd" id="area_lod">
			            <div cass="body" >
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable"  style="font-size:12px;width:100%" >
								<thead  class='sadow bg-teal' >	
									<th class='thead' style='width:5%'>NO</th> 
									<th class='thead' style='width:10%'   >KELAS</th>
									<th class='thead' style='width: 35%'>NAMA</th>
									<th class='thead' style='width:10%'>NIS</th>
									<th class='thead' style='width:10%'>STATUS</th>
									<th class='thead' style='width:35%'>ACTION</th>
							    	  
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
				
 
 
	<!-- Modal -->

<div class="modal fade" id="mdl_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal">EDIT STATUS</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row" id="area_status">
                	<div class="col-md-12">
                		<div class="form-group">
                			<label>STATUS</label>
                			<select class="form-control" id="st_select">
                				<option value="0">== PILIH ==</option>
                				<option value="1">LULUS</option>
                				<option value="3">TIDAK LULUS</option>
                				<option value="2">TIDAK DITAMPILKAN</option>
                			</select>
                			<input type="hidden" id="sts_nis">
                		</div>
                		<div class="form-group">
                			<center><button class="btn waves-effect bg-teal" onclick="set_status()">SIMPAN PERUBAHAN</button></center>
                		</div>
                	</div>
                </div>
            </div>
            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="mdl_nilai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal">DATA NILAI</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row" id="area_nilai">
                	<div class="col-md-12">
                		<div class="table-responsive">
                			<table class="table table-bordered">
                				<thead>
                					<tr>
                						<th>No</th>
                						<th>Mata Pelajaran</th>
                						<th>Nilai</th>
                					</tr>
                				</thead>
                				<tbody id="data_nilai">
                					
                				</tbody>	
                			</table>
                		</div>
                	</div>
                </div>
            </div>
            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">

	function setting_kelulusan(v){
		loading("area_lod");
		$.post('<?php echo base_url()?>informasi_siswa/setting_kelulusan', { v:v}, function(data){
			unblock("area_lod");
			if (v == "1") {
				notif("KELULUSAN TELAH DIBUKA");
			}
			else{
				notif("KELULUSAN TELAH DITUTUP");
			}
		});
	}

	function get_nilai(nis){
		loading("area_nilai");
		$.post('<?php echo base_url()?>informasi_siswa/get_nilai_kelulusan', { nis:nis}, function(data){
			unblock("area_nilai");
			$("#data_nilai").html(data);
		});
	}

	function set_nilai(id, v){
		$.post('<?php echo base_url()?>informasi_siswa/set_nilai_kelulusan', { id:id, v:v}, function(data){
			notif("Nilai berhasil di edit");
		});
	}

	function set_status(){
		var nis = $("#sts_nis").val();
		var v = $("#st_select").val();

		loading("area_status");
		$.post('<?php echo base_url()?>informasi_siswa/set_status_kelulusan', { nis:nis, v:v }, function(data){
			notif("Status berhasil di edit.");
			$("#mdl_status").modal("toggle");
			unblock("area_status");
			reload_table();
		});
	}

	function get_status(nis){
		$("#sts_nis").val(nis);
		loading("area_status");
		$.post('<?php echo base_url()?>informasi_siswa/get_status_kelulusan', { nis:nis }, function(data){
			$("#st_select").val(data);
			$("#st_select").trigger("change");
			unblock("area_status");
		});
	}
</script>

<div class="modal fade" id="mdl_detail" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
		          
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" id="judul_mdl_detail">  </h4>
            </div>
            
            <!-- Modal Body -->
			<div class="col-md-12 modal-body">
				<div id="isi_detail"></div>
				</div>
				
				
            <div class="row clearfix"></div>
            <div class="modal-footer">
			  
                         
                        </div>
          
        
		</div>
    </div>
</div>
	
	<style>
	    .ajs-buttons{
	        display: none;
	    }
	</style>
	 
	<script type="text/javascript">
	
	/*======================================================================================*/	
  $("#ekse").hide();
function pilih(){
	     var atLeastOneIsChecked = $('input[name="datatable[]"]:checked').length;
	   if(atLeastOneIsChecked>0){
	       $("#ekse").show();
	   }else{
	       $("#ekse").hide(); 
	   }
	};

  	$("#md_checkbox").click(function(){
		//  var pilihsemua = document.getElementById("md_checkbox").checked;  
					$(".pilih").prop("checked", "checked");
					$(".pilihsemua").val("no");
                    konfirmasicek(); 
	});
	 
	 function konfirmasicek(){
	   
	     	  alertify.confirm("<center style='line-height:2px'> <button class='bg-green btn' onclick='eksekusi(1)'>LULUS</button><br><br><button  onclick='eksekusi(2)' class='bg-pink btn'>TIDAK LULUS</button><br><br><button  onclick='eksekusi(0)' class='bg-blue-grey btn'>TIDAK DIINFORMASIKAN</button></center>",function(){
	     	      
	     	  }).set('oncancel', function(closeEvent){ 	$("#md_checkbox").attr("checked",false);	}) ;		
	 }
	 
	 
	 function eksekusi(id){
 
		 var value=get_value();
		  $.post('<?php echo base_url()?>informasi_siswa/setUn', { value:value,pilih:id }, function(data){ 
							notif("Tersimpan"); 
						reload_table();
						alertify.confirm().close(); 
			  });
	   
	     
	       $("#md_checkbox").attr("checked",false); 
	 }
	 
	 function get_value_uncheck()
  {
	  var values = new Array();
		 
			$("input[name='c[]']:checkbox:not(:checked)").each(function () {
			   values.push( $(this).val());
			});
			return values; 
	}
	
	 function get_value()
		{
			  var values = new Array();
			 $.each($("input[name='datatable[]']:checked"), function() {
			values.push($(this).val());
			});
			return values;
		}
	/*======================================================================================*/
	 </script>
	 <script>
	 function setinfo(){
	     var id=$("[name='setinfo']").val();
	     loading();
	     	var url="<?php echo base_url();?>informasi_siswa/setinfo";
			$.post(url,{id:id},function(data){
				  unblock();
			  });
	 }
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
		 "responsive": false,
		 "searching": false,
		 "lengthMenu":
		 [[10 , 30,50,100,200,300,400,500,1000,2000], 
		 [10 , 30,50,100,200,300,400,500,1000,2000]], 
	  dom: 'Blfrtip',

		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
		/*	 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 1,2,3,4,5,6]
                },text:' Excell',
							
                    },*/
					 
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('informasi_siswa/data_siswa2');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.id_kelas= $('#id_kelasf<?php echo $token;?>').val();
						  data.gender = $('#genderf<?php echo $token;?>').val();
						  data.aktifasi = $('#aktifasif<?php echo $token;?>').val();
						  data.id_agama = $('#id_agamaf<?php echo $token;?>').val();
						  data.id_tahun_masuk = $('#id_tahun_masukf<?php echo $token;?>').val();
						  data.id_pekerjaan_ayah = $('#id_pekerjaan_ayahf<?php echo $token;?>').val();
						  data.id_pekerjaan_ibu = $('#id_pekerjaan_ibuf<?php echo $token;?>').val();
						  data.id_penghasilan = $('#id_penghasilanf<?php echo $token;?>').val();
						  data.id_status_ayah = $('#id_status_ayahf<?php echo $token;?>').val();
						  data.id_status_ibu = $('#id_status_ibuf<?php echo $token;?>').val();
						  data.searching = $('#searching').val();
						  data.id_stsdata = $('#id_stsdata<?php echo $token;?>').val();
						 
		 },
		   beforeSend: function() {
               loading("area_lod");
                $("#md_checkbox").attr("checked",false); 
            },
			complete: function() {
              unblock('area_lod');
               $("#md_checkbox").attr("checked",false); 
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
	   $(document).on('change', '#id_stsdata<?php echo $token;?>,#id_tahun_masukf<?php echo $token;?>,#id_kelasf<?php echo $token;?>,#genderf<?php echo $token;?>,#aktifasif<?php echo $token;?>,#id_status_ibuf<?php echo $token;?>,#id_status_ayahf<?php echo $token;?>,#id_penghasilanf<?php echo $token;?>,#id_pekerjaan_ibuf<?php echo $token;?>,#id_pekerjaan_ayahf<?php echo $token;?>', function (event, messages) {			   
        
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

function import_data()
{ $("#formSubmitDown")[0].reset();
  $("#judul_mdl").html("IMPORT DATA   ");
				   $("#isi").html(data);
				   $("#mdl_formSubmitDown").modal( );
				    $("#formSubmitDown").attr("url","<?php echo base_url("informasi_siswa/import_data_siswa");?>");
					$("#ket_file").html("Cari File");
}


function input()
{ 
  $("#formSubmit_input")[0].reset();
  $("#judul_mdl_input").html("INPUT DATA SISWA ");
				   $("#mdl_formSubmit_input").modal( );
				    $("#formSubmit_input").attr("url","<?php echo base_url("informasi_siswa/input_data_siswa");?>");
					$("#ket_file").html("Cari Photo");
}

function edit(id)
{ 
	$("#judul_mdl_edit").html("EDIT DATA SISWA ");
				   $("#mdl_formSubmit_edit").modal( );
				    $("#formSubmit_edit").attr("url","<?php echo base_url("informasi_siswa/input_data_siswa");?>");
				 	    $.post("<?php echo site_url("informasi_siswa/edit_data_siswa"); ?>",{id:id},function(data){
						   						    $("#edit_isi").html(data);
													});
}
function ket_un(id,tbl)
{
    var val=$("[name='ket_un"+id+"']").val();
    loading();
     $.post("<?php echo site_url("informasi_siswa/ket_un"); ?>",{id:id,val:val,tbl:tbl},function(data){
         notif("Tersimpan...");
				   unblock();
            });
}

function detail(id)
{ 
	$("#judul_mdl_detail").html("DATA DETAIL SISWA ");
				   $("#mdl_detail").modal( );
				   $.post("<?php echo site_url("welcome/detail_siswa"); ?>",{id:id},function(data){
				   $("#isi_detail").html(data);
	});
}							
											
  function hapus(id,nis,judul=null){
		   alertify.confirm("<center>Menghapus akan membersihkan data terkait siswa:<br> <span class='font-bold'>`"+judul+"`</span> <br>Yakin Hapus ? </center>",function(){
		   $.post("<?php echo site_url("informasi_siswa/hapus_siswa"); ?>",{id:id},function(){
			   
				notif("Data berhasil dihapus !!");			  
			  reload_table();
		      })
		   })
	  };

  function aktifasi(id,judul=null){
	  if(judul==1)
	  {
		  juduls="NON AKTIFKAN GURU INI ?";
	  }else{
		   juduls="AKTIFKAN GURU INI ?";
	  }
		   alertify.confirm("<center>  <span class='font-bold'>`"+juduls+"`</span> </center>",function(){
		   $.post("<?php echo site_url("informasi_siswa/aktifasi_pendidik"); ?>",{id:id,sts:judul},function(){
				notif("Data berhasil dihapus !!");			  
			  reload_table();
		      })
		   })
	  };
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
}
function filter()
{
				 
				  $("#mdl_filter").modal();
				  
}
</script>
 


	
	 
	 
	<script>
	$('select').selectpicker();
	$(".tmt").inputmask("99/99/9999");  
	$(".thn").inputmask("9999/9999");  
	</script>
	
<script>
  $(document).ready(function(){
  $(".tmt").inputmask("99/99/9999");  
$(".thn").inputmask("9999/9999");  
});
</script>
	
 
	
	
	  <!-- Modal -->
<div class="modal fade" id="mdl_formSubmitDown" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="area_formSubmitDown">
        <div class="modal-content">
		<form id="formSubmitDown" action="javascript:submitForm('formSubmitDown')" method="post"  >
                
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
       <center>				  <a class="sound" href="<?php echo base_url()?>informasi_siswa/download_format_siswa">Download Format  Upload</a> </center>		
				  	
				<div class="row">
				
                                        <div class="form-line"><span id="ket_file">  </span>
					                      <input type="file" accept="xlsx" class="form-control" name="file"  required/>
                                        </div>
                                    </div><br>
					 
                  
            </div>
            </div>
            <div class="row clearfix"></div>
            <div class="modal-footer">
			  
              <button onclick="submitForm('formSubmitDown')"  class="pull-right waves-effect btn bg-teal"><i class="material-icons">cloud_upload</i> UPLOAD</button>
                         
                        </div>
            </form>
        
		</div>
    </div>
</div>
	 