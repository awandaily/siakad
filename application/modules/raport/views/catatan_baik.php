 <?php $token=date("His");?>
 
							
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_loding">
                    <div class="card">
                        <div class="header">
                         <div class="col-md-3"  >     <h2 style='font-size:16px'>Catatan Siswa</h2> </div>
						  
							<div class="col-md-4" style="margin-top:-9px" >
                                          
									
									<?php 
										$ray="";
										$ray[]="=== Filter Jenis Catatan ===";
										$data=$this->db->get("tr_jenis_catatan")->result();
										foreach($data as $val){
											$ray[$val->id]=$val->nama;
										}
										$dataray=$ray;
										echo form_dropdown("f[id_jenis]",$dataray,"","class='form-control show-tick fidjenis".$token."' id='fid_jenis' ");?>
                            </div>
							<div class="col-md-5" style="margin-top:-9px" >
                                          
									
									<?php 
										$ray="";
										$ray['']="  == Terusan ==  ";
										 
											
											$ray["1"]=" Guru Bp";
											$ray["2"]=" Orang Tua";
											$ray["3"]=" Tidak diteruskan";
											 
										$dataray=$ray;
										echo form_dropdown("f[ke_bp]",$dataray,"","class='form-control show-tick fke_bp".$token."' id='fke_bp' ");?>
                            </div>
							 <br>
                        </div>
                       
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='tablex' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'>			
									<th class='thead'  width='15px'>&nbsp;NO</th>
									<th class='thead'  width='15px'>TANGGAL</th>
									<th class='thead'>PELAPOR</th>
									
									<th class='thead' >NAMA SISWA</th>
								 
									<th class='thead' >JENIS CATATAN</th>
									<th class='thead' >KETERANGAN</th>
								 	
								</thead>
							</table>
							</div>						
						</div>						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				
  <script>
 $('select').selectpicker();
 </script>
  <script type="text/javascript">
  	   
  var  dataTablex = $('#tablex').DataTable({ 
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
		 "searching": false,
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
            "url": "<?php echo site_url('raport/getCatatan');?>",
            "type": "POST",
			"data": function ( data ) {
			  
			  data.id_jenis= $('#fid_jenis').val(); 
			  data.ke_bp= $('#fke_bp').val(); 
			   data.id_siswa =<?php echo $id_siswa?>;
		 },
		   beforeSend: function() {
               loading("area_loding");
            },
			complete: function() {
              unblock('area_loding');
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
	function reload_tablex()
	{
		 dataTablex.ajax.reload(null,false);	
	};
	 $(document).on('change', '.fkelas<?php echo $token;?>,.fidjenis<?php echo $token;?>,.fke_bp<?php echo $token;?>', function (event, messages) {			   
        reload_tablex();		 
		});
	</script>
	
	
	
	
	 

	 