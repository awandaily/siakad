
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header">  
                            <h2>DATA NILAI  </h2>
                           
                        </div>
						    <div class="body">
                           <div class="row clearfix">
						   
						   	<div class="col-sm-3" id="hasilKate">
                                         
                                      <?php
											
											$data=$this->mdl->getRepatTahun();
											$array=""; $t=1;
											foreach($data as $val)
											{
											$array[$val->id]="Kelas  ".$t++;
											$thn_ini=$val->id;
											}
											
											$data=$array;
											echo form_dropdown("tahun",$data,$thn_ini,"class='form-control' id='id_tahun'");
											?>
                                     
                                </div>
								
								<div class="col-sm-3">
                              <select class="form-control show-tick" id="semester" >
                                        <option value="">--- Pilih Semester ---</option>
                                        <?php
										$dbs=$this->db->get("tr_semester")->result();
										foreach($dbs as $s)
										{
											echo '<option value="'.$s->id.'">'.$s->nama.'</option>';
										}
										?>
										 
                                    </select>
                                </div>
								
						 <div class="col-sm-3">
                                    <select class="form-control show-tick" id="k_nilai"  >
                                        <option value="">--- Pilih Kategory Nilai ---</option>
                                         <?php 
									   $dbkelas=$this->mdl->dataKategoryNilai();
									   foreach($dbkelas as $val){
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>
                                    </select>
                                </div>
								
							
                    
                                <div class="col-sm-3" id="hasilKelas">
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
									<th class='thead' >TAHUN AJARAN</th>
									<th class='thead'>SEMESTER</th>
									<th class='thead'  >  TES/UJIAN </th>
									<th class='thead'   > MAPEL </th>
									<th class='thead'   > NILAI </th>
									<th class='thead'   > KET </th>
								
							 
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
		 [[10 , 30,50,100,200,300,400,500], 
		 [10 , 30,50,100,200,300,400,500]], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
		 
			 {
					extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5 ]
                },text:' Download Excell',
							
                    },
					
					{
					extend: 'pdf',
                        exportOptions: {
                     columns: [ 0, 1, 2,3,4,5 ]
                },text:'Download  Pdf',
							
                    }, 
				  
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('aka/data_nilai');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.id_tahun = $('#id_tahun').val();
						  data.id_mapel = $('#id_mapel').val();
						  data.semester = $('#semester').val();
						  data.k_nilai = $('#k_nilai').val();
						 
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
	   $(document).on('change', '#id_mapel,#id_tahun,#semester,#k_nilai', function (event, messages) {			   
        
			 dataTable.ajax.reload(null,false);	
		 
		});
		
 
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
}
 
 
</script>
 
 
	 