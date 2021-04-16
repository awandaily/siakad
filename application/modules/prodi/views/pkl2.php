<?php $token=date("His");?>  
  <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						 
						
						<h2 class="sound">DATA SISWA KELAS XII (DUA BELAS)</h2>
                           
                        </div>
						    <div class="body">
                           <div class="row clearfix">
						   
						 <div class="col-sm-4 col-black">
                                    <select class="form-control show-tick" data-actions-box="true" onchange="reload_table()" id="id_kelasf<?php echo $token;?>" data-selected-text-format="count" multiple >
                                       
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
                                </div> 
						
						
								
								<div class="col-sm-4">
                                    <select class="form-control show-tick" onchange="reload_table()"  id="genderf<?php echo $token;?>">
                                        <option value="">=== Pilih Gender ===</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                         
                                    </select>
                                </div> 
								
								<div class="col-sm-4">
                                     <select class="form-control show-tick"   onchange="reload_table()"  id="mitraf<?php echo $token;?>" >
                                        <option value="" selected>=== Pilih Mitra PKL ===</option>
										
										
											<?php 
											$tahun=$this->m_reff->tahun();
											$sms=$this->m_reff->semester();
											$this->db->order_by("nama","ASC");
										    $db=$this->db->get_where("tr_mitra")->result();
										     foreach($db as $vals){
													   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
												   }
										   ?>
									  
                                    </select>
                                </div> 
								
								
								<div class="col-sm-6">
                                    <select class="form-control show-tick" onchange="reload_table()"  id="statusf<?php echo $token;?>">
                                        <option value="">=== Pilih Status Penempatan ===</option>
                                        <option value="1">Sudah ditempatkan</option>
                                        <option value="2">Belum ditempatkan</option>
                                         
                                    </select>
                                </div> 
								
								<div class="col-sm-6">
								<input type="text" id="cari" class="form-control"  onchange="reload_table()" placeholder="Pencarian nama ...">
								</div>
								
								
							 
						 
						    
                           </div>
						  
				 <div   id="area_lod">
			            <div  >
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable"  style="font-size:12px;width:100%" >
								<thead  class='sadow bg-teal' >			
									<th class='thead' style='max-width:3px'>NO</th>
									<th class='thead' style='min-width:125px'   >NAMA</th>
									<th class='thead' >GENDER</th>
									<th class='thead' >KELAS</th>
									<th class='thead' >TEMPAT PKL</th>
									<th class='thead' >TEMPAT PKL</th>
									<th class='thead' >LAMA (bulan)</th>
									 
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
		 "searching": false,
		 "lengthMenu":
		 [[10 , 30,50,100,200,300,400,500,1000,2000], 
		 [10 , 30,50,100,200,300,400,500,1000,2000]], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1,2,3,5,6]
                },text:' Export Excell',
							
                    },
					
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('prodi/data_siswa');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.cari= $('#cari').val();
						  data.id_kelas= $('#id_kelasf<?php echo $token;?>').val();
						  data.gender = $('#genderf<?php echo $token;?>').val();
						  data.mitra = $('#mitraf<?php echo $token;?>').val();
						   data.status = $('#statusf<?php echo $token;?>').val();
						  data.jenis_pkl = 3;
					 
						 
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
		 { "visible": false, "targets": 5 }
        ],
	
      });
     	  
	 
	 
    
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
}
 

 
 $('select').selectpicker();
 
 function set(id)
 {
	 var mitra=$("[name='id_mitra"+id+"']").val();
	 var jam=$("[name='jam"+id+"']").val();
	 $.ajax({
		 url:"<?php echo site_url("prodi/setMitra"); ?>",
		 data: {id_siswa:id,id_mitra:mitra,id_jam:jam,jenis_pkl:2},
		 method:"POST",
		 dataType:"JSON",
		 success: function(data)
				{ 	 	   
				 
		           if(data['report']=="overload")
				   {
					   notif("Maaf! Quota sudah penuh untuk mitra tersebut.");
				   }
			      reload_table();
				}
	 
            });
 }
 </script>

	 
	
	 
	
	 
	  
	
	
	 