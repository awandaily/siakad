
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DATA PENDAFTAR</h2>
                          
							 
                        </div>
						<br>
						<div class="col-md-3" >
							   <select id="id_madrasah" style="margin-left:4px" class="form-control">
							   <option value="">=== Seluruh Madrasah ===</option>
							  <?php $getmad=$this->m_reff->getmad();
							  foreach($getmad as $val)
							  {
								  echo '  <option value="'.$val->id_admin.'">'.$val->owner.'</option>';
							  }
							  ?>
							   </select>
						</div>
						<div class="col-md-3">
							    
							   <?php 
							   $db=$this->db->get("tr_kategory")->result();
							   $array[""]="=== Pilihan Peminatan ===";
							   foreach($db as $val)
							   {
								   $array[$val->id]=$val->nama;
							   }
							   $data=$array;
							   echo form_dropdown("posisi",$data,"","class='form-control' id='posisi'");?>
						</div>
						<div class="col-md-2">
							    
							   <?php 
							   $db=$this->db->query("select * from tr_mapel")->result();
							    $array="";
							    $array[""]="=== Mapel ===";
							   foreach($db as $val)
							   {
								   $array[$val->id]=$val->nama;
							   }
							   $data=$array;
							   echo form_dropdown("mapel",$data,"","class='form-control' id='mapel'");?>
						</div>
						<div class="col-md-2">
							   <select class="form-control" id="jk">
							   <option value=""> === Gender === </option>
							   <option value="l">Laki-laki</option>
							   <option value="p">Perempuan</option>
							   </select>
						</div>
						<div class="col-md-2">
							   <select class="form-control" id="status_kelulusan">
							   <option value=""> === Status === </option>
							   <option value="2">LULUS BERKAS</option>
							   <option value="3">TIDAK LULUS</option>
							   </select>
						</div>
						
						
						
						   <br>
                        <div class="body">
                           
						  
				 <div class="card">
			            <div class="body">
                            <div class="table-responsive">
                               <table id='tabel' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
								
									<th class='thead' >LIHAT</th>
									<th class='thead' >NAMA PENDAFTAR </th>
									<th class='thead' >JENIS KELAMIN </th>
									<th class='thead' >PEMINATAN</th>
									<th class='thead' >HP</th>
									<th class='thead' >T/T/L</th>
									<th class='thead' >TEMPAT TUGAS</th>
									<th class='thead' >JABATAN</th>
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
	 
        "processing": true, //Feature control the processing indicator.
		"language": {
						"processing": ' <span class="sr-only">Loading...</span> <br><b style="color:#;background:white">Proses menampilkan data<br> Mohon Menunggu..</b>',
						  "oPaginate": {
							"sFirst": "Halaman Pertama",
							"sLast": "Halaman Terakhir",
							 "sNext": "Selanjutnya",
							 "sPrevious": "Sebelumnya"
							 },
						"sInfo": "Total :  _TOTAL_ , Halaman (_START_ - _END_)",
						 "sInfoEmpty": "Tidak ada data yang di tampilkan",
						   "sZeroRecords": "Data tidak tersedia",
						  
				    },
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": true,
		 "searching": true,
		 "lengthMenu":
		 [[15, 50,100,200,300,500,1000, 800000000], 
		 [15, 50,100,200,300,500,1000,"All"]],
         dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			{
                        extend: 'copy',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5,6 ]
                },
				text:'  Copy',
							
                    },
			 {
					extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5,6 ]
                },text:' Excell',
							
                    },
					
					{
					extend: 'pdf',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5,6 ]
                },text:'  Pdf',
							
                    },{
					extend: 'print',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5,6 ]
                },text:'  Print',
							
                    },
					{extend: 'colvis',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5,6 ]
                },text:' Kolom',
							
                    },
					 
					
        ],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('data_pendaftar/data');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.id_madrasah = $('#id_madrasah').val();
						  data.jk = $('#jk').val();
						  data.posisi = $('#posisi').val();
						  data.mapel = $('#mapel').val();
						  data.status_kelulusan = $('#status_kelulusan').val();
		 },
		 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3,-4,-5,-6,-7,-8,-9 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
    
 
	 
	
	   $(document).on('change', '#id_madrasah,#jk,#posisi,#mapel,#status_kelulusan', function (event, messages) {			
			  dataTable.ajax.reload(null,false);	   
        });
		
function tinjau(id)
{			var url="<?php echo base_url();?>data_pendaftar/tinjau";
			$.post(url,{id:id},function(data){
				   $("#judul_tinjau").html("TINJAU DATA PESERTA");
				   $("#isi").html(data);
				   $("#modal_tinjau").modal();
			  });
}


</script>
	
	  <div class="modal fade" id="modal_tinjau" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
				
	                  <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title" id="judul_tinjau">  </h4>
			             </div>
                     <div id="isi"></div>
					
				</div>
			 
         </div><!-- /.modal-dialog -->
         </div><!-- /.modal-dialog -->