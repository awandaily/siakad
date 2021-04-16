               <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						
                      
						
						
						<h2 class="sound">DATA SISWA</h2>
                             <?php   $idkelas=$this->m_reff->goField("tm_kelas","id","where id_wali='".$this->mdl->idu()."'");?>
                           <b class='col-pink'>KELAS :  <?php echo  $this->m_reff->goField("v_kelas","nama","where id_wali='".$this->mdl->idu()."'");?></b>
                        </div>
						    <div class="body">
                           <div class="row clearfix">
						 
						
								
								<div class="col-sm-5">
                                    <select class="form-control show-tick" id="genderf">
                                        <option value="">=== Filter Gender ===</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                         
                                    </select>
                                </div> 
								
								 <div class="col-sm-5">
                                         <select class="form-control show-tick" id="id_agamaf">
                                        <option value="">=== Filter Agama ===</option>
                                         <?php 
									   $dbkelas=$this->db->get("tr_agama")->result();
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>
                                       </select>
                                    </div>    
								
								
								
								
								
								<div class="col-sm-2">	
						   <button class="btn bg-blue-grey btn-block" onclick="filter()"><i class="material-icons">filter_list</i>FILTER  </button>
						   </div>
								
							 
						 
						    
                           </div>
						  
				 <div id="area_lod">
			            <div class="bodys">
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable"  style="font-size:12px;width:100%" >
								<thead  class='sadow bg-teal' >			
									<th class='thead' style='max-width:3px'>NO</th>
									<th class='thead'   >DETAIL</th>
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
    scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
		 fixedColumns:   true,
		  fixedColumns:   {
            leftColumns: 3
        },
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
		 [[5,10,15,20,50], [5,10,15,20,50]  ], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]
                },text:' Excell',
							
                    },
					
					 
					{extend: 'colvis',
                        exportOptions: {
                  columns:[ 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]
                },text:' Kolom',
							
                    },
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('raport/getDataSiswa');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.id_kelas=<?php echo $idkelas;?>;
						  data.gender = $('#genderf').val();
						  data.aktifasi = $('#aktifasif').val();
						  data.id_agama = $('#id_agamaf').val();
						  data.id_tahun_masuk = $('#id_tahun_masukf').val();
						  data.id_pekerjaan_ayah = $('#id_pekerjaan_ayahf').val();
						  data.id_pekerjaan_ibu = $('#id_pekerjaan_ibuf').val();
						  data.id_penghasilan = $('#id_penghasilanf').val();
						  data.id_status_ayah = $('#id_status_ayahf').val();
						  data.id_status_ibu = $('#id_status_ibuf').val();
						 
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
	   $(document).on('change', '#id_agamaf,#id_tahun_masukf,#id_kelasf,#genderf,#aktifasif,#id_status_ibuf,#id_status_ayahf,#id_penghasilanf,#id_pekerjaan_ibuf,#id_pekerjaan_ayahf', function (event, messages) {			   
        
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
				    $("#formSubmitDown").attr("url","<?php echo base_url("raport/import_data_siswa");?>");
					$("#ket_file").html("Cari File");
}


function input()
{ 
  $("#formSubmit_input")[0].reset();
  $("#judul_mdl_input").html("INPUT DATA SISWA ");
				   $("#mdl_formSubmit_input").modal( );
				    $("#formSubmit_input").attr("url","<?php echo base_url("raport/input_data_siswa");?>");
					$("#ket_file").html("Cari Photo");
}

function edit(id)
{ 
	$("#judul_mdl_edit").html("EDIT DATA SISWA ");
				   $("#mdl_formSubmit_edit").modal( );
				    $("#formSubmit_edit").attr("url","<?php echo base_url("raport/input_data_siswa");?>");
				 	    $.post("<?php echo site_url("raport/edit_data_siswa"); ?>",{id:id},function(data){
						   						    $("#edit_isi").html(data);
													});
}
function detail(id)
{ 
	$("#judul_mdl_detail").html("DATA DETAIL SISWA ");
				   $("#mdl_detail").modal( );
				   $.post("<?php echo site_url("raport/detail_siswa"); ?>",{id:id},function(data){
				   $("#isi_detail").html(data);
	});
}							
											
  function hapus(id,nis,judul=null){
		   alertify.confirm("<center>Menghapus akan membersihkan data terkait siswa:<br> <span class='font-bold'>`"+judul+"`</span> <br>Yakin Hapus ? </center>",function(){
		   $.post("<?php echo site_url("raport/hapus_siswa"); ?>",{id:id,nis:nis},function(){
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
		   $.post("<?php echo site_url("raport/aktifasi_pendidik"); ?>",{id:id,sts:judul},function(){
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
                                        <label for="email_address_2" class="col-black">PEKERJAAN AYAH</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                         <select class="form-control show-tick" id="id_pekerjaan_ayahf">
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
                                         <select class="form-control show-tick" id="id_pekerjaan_ibuf">
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
                                         <select class="form-control show-tick" id="id_penghasilanf">
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
                                         <select class="form-control show-tick" id="id_status_ayahf">
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
                                         <select class="form-control show-tick" id="id_status_ibuf">
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
                                       <select class="form-control show-tick" id="aktifasif"  >
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
<div class="modal fade" id="mdl_formSubmit_edit" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="area_formSubmit_edit">
        <div class="modal-content">
		
                
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" id="judul_mdl_edit">  </h4>
            </div>
            
            <!-- Modal Body -->
			<div class="col-md-12">
			<div class="body">
			<form id="formSubmit_edit" action="javascript:submitForm('formSubmit_edit')" method="post"  >
				<div id="edit_isi"></div>
				
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
	
 
	
	
	 