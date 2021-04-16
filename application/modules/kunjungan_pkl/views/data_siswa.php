 
							
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class=" ">
                        <div class="header row">
                        
						  <div class="col-md-12 col-xs-12 pull-right"  style="padding-bottom:10px" >
                                        <select class="form-control   show-tick fmitra"   id="fmitra" data-live-search="true" onchange='reload_table()' >
                                         										
											<?php 
										   $db=$this->db->query("select * from v_mitra_pkl where id_pembimbing='".$this->m_reff->idu()."'
										   and id_tahun='".$this->m_reff->tahun()."' group by id_pembimbing,tgl_berangkat")->result();
										   foreach($db as $val){
										       $mitra=$this->m_reff->goField("tr_mitra","nama","where id='$val->id_mitra_pkl' ");
											       echo "<option value='".$val->id."'>".$mitra." (keberangkatan: ".$this->tanggal->ind($val->tgl_berangkat,"/").") - ".$val->lama_pkl." Bln</option>";
										   }
										   ?>
									  
                                    </select>   
                            </div>
						 
							 
                        </div>
                       
				 <div class="card"  id="area_lod">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'> 
									<th class='thead'  width='15px'>&nbsp;NO</th>
									<th class='thead' >NAMA SISWA</th>
									<th class='thead' > KELAS</th>  
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
 //$('select').selectpicker();
 </script>
  <script type="text/javascript">
  	  
	
	  
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
		 "responsive": false,
		 "searching": false,
		 "lengthMenu":
		 [ [10,30,50,100], 
		 [10,30,50,100], ], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1,2 ]
                },text:'Download Excell',
							
                    },
					 
				 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('kunjungan_pkl/getMitra');?>",
            "type": "POST",
			"data": function ( data ) {
			  data.id_mitra= $('#fmitra').val(); 
			  
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
          "targets": [ 0,-1,-2 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
	function reload_table()
	{
		 dataTable.ajax.reload(null,false);	
	};
	 
	</script>
  
	 		
						
						
						
						
 