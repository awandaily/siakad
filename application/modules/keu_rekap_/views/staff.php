<?php $token=date("His");?>  
  <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						
                        
						
						<h2 class="sound">DATA REKAP GURU/STAFF</h2>
                           
                        </div>
						    <div class="body">
                           <div class="row clearfix hide">
						   
						 
						 
								<div class="col-sm-6"  >
                                     <select class="form-control show-tick" id="stsf" onchange="reload_table()">
                                         <option value=""> ==== Status Kepegawaian ====</option>
                                        <option value="1">GTY</option>
                                        <option value="2">GTT</option>
										</select>
                                         
                                </div> 

								<div class="col-sm-6"  >
                                     <select class="form-control show-tick" id="pinjamanf" onchange="reload_table()">
                                         <option value=""> ==== Status pinjaman ====</option>
                                        <option value="1">Lunas</option>
                                        <option value="2">Belum Lunas</option>
										</select>                                         
                                </div> 
							
<!--							<div class="col-sm-2">	
						   <button class="btn bg-blue-grey btn-block" onclick="filter()"><i class="material-icons">filter_list</i>FILTER  </button>
						   </div>--->
								
							 
						 
						    
                           </div>
						  
				 <div id="area_lod">
			            <div  >
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable"  style="font-size:12px;width:100%" >
								<thead  class='sadow bg-teal' >			
									<th class='thead' style='max-width:3px'>NO</th>
									<th class='thead' style='min-width:115px' >NAMA</th>
									<th class='thead' style='min-width:115px' >HUTANG PINJAMAN</th>
									<th class='thead' style='min-width:115px' >JUMLAH SIMPANAN </th>
									<th class='thead' style='min-width:115px' >GAJI POKOK </th>
									<th class='thead' style='min-width:115px' >TUNJANGAN JABATAN </th>
									<th class='thead' style='min-width:115px' >HONOR PEMINA ESKUL </th>
									<th class='thead' style='min-width:115px' >PENAMBAHAN FUNGSIONAL </th>
									<th class='thead' style='min-width:115px' >KEPRAMUKAAN WAJIB </th>
									<th class='thead' style='min-width:115px' >SUVERVISI AKADEMIK </th>
									<th class='thead' style='min-width:45px' > </th> 
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
					 
					  "scrollX": true,
					   "scrollY": 350,
					    scrollCollapse: true,
		 fixedColumns:   true,
		  fixedColumns:   {
            leftColumns: 2
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
                      columns:[ 0,1,2,3,4,5,6,7,8]
                },text:'Download Excell',
							
                    },
					
				 
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('keu_rekap/getDataGuru');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.sts= $('#stsf').val();
						  data.pinjaman = $('#pinjamanf').val();
						 
						 
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
	   
		
function getTagihan(id_kelas,alumni,tagihan)
{			var url="<?php echo base_url();?>keu_rekap/getTagihan";
			$.post(url,{id_kelas:id_kelas,alumni:alumni,tagihan:tagihan},function(data){				  
				   $("#tagihan").html(data);				  
			  });
}
 
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
}
 
</script>
	
 
	 
	 
	 
	<script>
	$('select').selectpicker();
	$(".tmt").inputmask("99/99/9999");  
	$(".thn").inputmask("9999/9999");  
	</script>
	 
 
 
<script>
function edit(id,nama,gp,tj,pe,pf,kw,sa,bpjs)
{
	$("#mdl_modal_edit").modal("show");
	$("[name='id']").val(id);
	$("#gp").val(gp);
	$("#tj").val(tj);
	$("#pe").val(pe);
	$("#pf").val(pf);
	$("#kw").val(kw);
	$("#sa").val(sa);
	$("#bpjs").val(bpjs);
}
</script>
	
	
	
	
	
	
	
	
	<div  class="modal fade in" id="mdl_modal_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
	<form action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url()?>keu_rekap/edit_staf" method="post" enctype="multipart/form-data">
                    <div class="modal-content">  
                        <div class="modal-header">
						 <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                            <h4 class="modal-title col-teal">Edit Gaji/Honor</h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <div  > 
							<input name="id"   type="hidden">
 	 
  
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Gaji Pokok</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input  class="form-control" name="f[gaji_pokok]"  id="gp" type="text" onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Tunjangan Jabatan</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input  class="form-control" name="f[tunjangan_jabatan]"  id="tj" type="text"  onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div><div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Pembina Ektrakurikuler</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input  class="form-control" name="f[pembina_eskul]"  id="pe" type="text"  onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">BPBK</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input  class="form-control" name="f[p_fungsional]"  id="pf" type="text"  onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Suvervisi Akademik</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                         <input  class="form-control" name="f[supervisi_akademik]"  id="sa" type="text"  onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div><div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Potongan BPJS</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                         <input  class="form-control" name="f[bpjs]"  id="bpjs" type="text"  onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
							 	<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Kepramukaan Wajib</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input  class="form-control" name="f[kepramukaan_wajib]"  id="kw" type="text"  onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                 </div>
								
						 
 
                       <div class="modal-footer">
						<span id="msg" class="pull-left"></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        
                                         <button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_edit')"><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</form></div>
				
   </div>
	
	
	
	
	
	
	
	
	
	
	 
	
	
	 