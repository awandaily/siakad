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
						   
						 <div class="col-sm-6 col-black">
                                    <select class="form-control show-tick"   id="id_kelasf<?php echo $token;?>" multiple data-live-search="true">
                                        <option value="">=== Pilih Kelas ===</option>
										
										
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
						
						
								
								<div class="col-sm-4">
                                    <select class="form-control show-tick" id="genderf<?php echo $token;?>">
                                        <option value="">=== Pilih Gender ===</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                         
                                    </select>
                                </div> 
								<div class="col-sm-2">	
						   <button class="btn bg-blue-grey btn-block" onclick="filter()"><i class="material-icons">filter_list</i>FILTER  </button>
						   </div>
								
							 
						 
						    
                           </div>
						  
				 <div class="card" id="area_lod">
			            <div class="body">
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable"  style="font-size:12px;width:100%" >
								<thead  class='sadow bg-teal' >			
									<th class='thead' style='max-width:3px'>NO</th>
								  
									<th class='thead' style='min-width:125px'   >NAMA</th>
									<th class='thead' >GENDER</th>
									<th class='thead' >T/T/L</th>
									<th class='thead' >AGAMA</th>
									<th class='thead' >NIS</th>
									<th class='thead' >NISN</th>
									<th class='thead' >NIK</th>
									<th class='thead' >TINGKAT</th>
									<th class='thead' >JURUSAN</th>
									<th class='thead' >KELAS</th>
									<th class='thead' >  MASUK</th> 
									<th class='thead'  > HP </th>
									<th class='thead'  > EMAIL </th>
									<th class='thead'  > ALAMAT </th>
									<th class='thead'  >   ASAL SD </th>
									<th class='thead'  >TAHUN LULUS SD </th>
									<th class='thead'  >   ASAL SMP </th>
									<th class='thead'  > TAHUN LULUS SMP </th>
									
									<th class='thead'  > NAMA AYAH </th>
									<th class='thead'  > NAMA IBU </th>
									<th class='thead'  > NO.HP AYAH </th>
									<th class='thead'  > NO.HP IBU </th>
									<th class='thead'  > STATUS AYAH </th>
									<th class='thead'  > STATUS IBU </th>
									<th class='thead'  > PEKERJAAN AYAH </th>
									<th class='thead'  > PEKERJAAN IBU </th>
									<th class='thead'  > ALAMAT ORANG TUA </th>
								 
									<th class='thead'  > NAMA WALI MURID  </th>
									<th class='thead'  > NO.HP WALI  </th>
									<th class='thead'  > HUBUNGAN  </th>
								  	
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
		 "responsive": false,
		 "searching": true,
		 "lengthMenu":
		 [[10 , 30,50,100,200,300,400,500,1000,2000], 
		 [10 , 30,50,100,200,300,400,500,1000,2000]], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:' Excell',
							
                    },
					
					{
					extend: 'pdf',
                        exportOptions: {
                     columns:[ 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:'  Pdf',
							
                    },{
					extend: 'print',
                        exportOptions: {
                    columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:'  Print',
							
                    },
					{extend: 'colvis',
                        exportOptions: {
                  columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:' Kolom',
							
                    },
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('kepsek/data_siswa');?>",
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
	   $(document).on('change', '#id_agamaf<?php echo $token;?>,#id_tahun_masukf<?php echo $token;?>,#id_kelasf<?php echo $token;?>,#genderf<?php echo $token;?>,#aktifasif<?php echo $token;?>,#id_status_ibuf<?php echo $token;?>,#id_status_ayahf<?php echo $token;?>,#id_penghasilanf<?php echo $token;?>,#id_pekerjaan_ibuf<?php echo $token;?>,#id_pekerjaan_ayahf<?php echo $token;?>', function (event, messages) {			   
        
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
  $("#judul_mdl").html("IMPORT DATA SISWA ");
				   $("#isi").html(data);
				   $("#mdl_formSubmitDown").modal( );
				    $("#formSubmitDown").attr("url","<?php echo base_url("kepsek/import_data_siswa");?>");
					$("#ket_file").html("Cari File");
}


function input()
{ 
  $("#formSubmit_input")[0].reset();
  $("#judul_mdl_input").html("INPUT DATA SISWA ");
				   $("#mdl_formSubmit_input").modal( );
				    $("#formSubmit_input").attr("url","<?php echo base_url("kepsek/input_data_siswa");?>");
					$("#ket_file").html("Cari Photo");
}

function edit(id)
{ 
	$("#judul_mdl_edit").html("EDIT DATA SISWA ");
				   $("#mdl_formSubmit_edit").modal( );
				    $("#formSubmit_edit").attr("url","<?php echo base_url("kepsek/input_data_siswa");?>");
				 	    $.post("<?php echo site_url("kepsek/edit_data_siswa"); ?>",{id:id},function(data){
						   						    $("#edit_isi").html(data);
													});
}
function detail(id)
{ 
	$("#judul_mdl_detail").html("DATA DETAIL SISWA ");
				   $("#mdl_detail").modal( );
				   $.post("<?php echo site_url("kepsek/detail_siswa"); ?>",{id:id},function(data){
				   $("#isi_detail").html(data);
	});
}							
											
  function hapus(id,nis,judul=null){
		   alertify.confirm("<center>Menghapus akan membersihkan data terkait siswa:<br> <span class='font-bold'>`"+judul+"`</span> <br>Yakin Hapus ? </center>",function(){
		   $.post("<?php echo site_url("kepsek/hapus_siswa"); ?>",{id:id},function(){
			   
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
		   $.post("<?php echo site_url("kepsek/aktifasi_pendidik"); ?>",{id:id,sts:judul},function(){
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
	
 
	
	  <!-- Modal -->
<div class="modal fade" id="mdl_filter" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="area_formSubmit">
        <div class="modal-content">
	 
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" > FILTER PENCARIAN </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="col-md-12 body">    
      
			<form class="form-horizontal">
			
			 
			
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">TAHUN MASUK</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                         <select class="form-control show-tick" id="id_tahun_masukf<?php echo $token;?>">
                                        <option value="">--- Pilih ---</option>
                                         <?php 
									   $dbkelas=$this->db->query("select * from tr_tahun_ajaran order by id desc limit 3")->result();
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>
                                       </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">AGAMA</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                         <select class="form-control show-tick" id="id_agamaf<?php echo $token;?>">
                                        <option value="">--- Pilih ---</option>
                                         <?php 
									   $dbkelas=$this->db->get("tr_agama")->result();
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>
                                       </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">PEKERJAAN AYAH</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                         <select class="form-control show-tick" id="id_pekerjaan_ayahf<?php echo $token;?>">
                                        <option value="">--- Pilih ---</option>
                                         <?php 
									   $dbkelas=$this->db->get("tr_pekerjaan")->result();
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>
                                       </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">PEKERJAAN IBU</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                         <select class="form-control show-tick" id="id_pekerjaan_ibuf<?php echo $token;?>">
                                        <option value="">--- Pilih ---</option>
                                         <?php 
									   $dbkelas=$this->db->get("tr_pekerjaan")->result();
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>
                                       </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">PENGHASILAN</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                         <select class="form-control show-tick" id="id_penghasilanf<?php echo $token;?>">
                                        <option value="">--- Pilih ---</option>
                                         <?php 
									   $dbkelas=$this->db->get("tr_penghasilan")->result();
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>
                                       </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">STATUS AYAH</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                         <select class="form-control show-tick" id="id_status_ayahf<?php echo $token;?>">
                                        <option value="">--- Pilih ---</option>
                                        <?php 
									   $dbkelas=$this->db->get("tr_status_hidup")->result();
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>                                         
                                       </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">STATUS IBU</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                         <select class="form-control show-tick" id="id_status_ibuf<?php echo $token;?>">
                                        <option value="">--- Pilih ---</option>
                                        <?php 
									   $dbkelas=$this->db->get("tr_status_hidup")->result();
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>                                         
                                       </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
 
								   
								 <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">STATUS AKTIFASI</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                       <select class="form-control show-tick" id="aktifasif<?php echo $token;?>" data-live-search="true">
                                        <option value="1" selected>AKTIF</option>
                                        <option value="2" >NON-AKTIF/BLOKIR</option>
                                       
                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
								
								
								
								
								
			</form>					
	  
	  
                  
            </div>
            </div>
            <div class="row clearfix"></div>
            <div class="modal-footer">
			  
                         
                        </div>
            
        
		</div>
    </div>
</div>
	
	
	
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
       <center>				  <a class="sound" href="<?php echo base_url()?>kepsek/download_format_siswa">Download Format  Upload</a> </center>		
				  	
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
	
	
	
	
	
	
	
	
	
 
			      
                 

	<!-- Modal -->
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
	
 
	
	
	 