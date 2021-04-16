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
                        			 <div id="area_lod">
			            <div class="bodys">
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable"  style="font-size:12px;width:100%" >
								<thead  class='sadow bg-teal' >			
									<th class='thead' style='max-width:3px'>NO</th>
								 
									<th class='thead' style='min-width:125px'   >NAMA</th>
								 
									<th class='thead' >NIS</th>
									 <?php 
									 $dataabsen=$this->db->get_where("tr_sts_kehadiran",array("sts_tampil"=>1))->result();
									 foreach( $dataabsen as $val)
									 { echo "	<th class='thead'  >  ".strtoupper($val->nama)." </th>";
									 }
									 ?>
								 
								  	
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
		 [[5,10,15,20,50], [5,10,15,20,50]  ], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 1,2,3,4,5]
                },text:' Excell',
							
                    },
					
					 
					{extend: 'colvis',
                        exportOptions: {
                  columns:[ 0,1,2,3,4,5]
                },text:' Kolom',
							
                    },
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('raport/getDataSiswa_kh');?>",
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
		
 


function detail(id)
{ 
	$("#judul_mdl_detail").html("DATA DETAIL SISWA ");
				   $("#mdl_detail").modal( );
				   $.post("<?php echo site_url("raport/detail_siswa"); ?>",{id:id},function(data){
				   $("#isi_detail").html(data);
	});
}							
											
  

	  function setNilai(nama,id_siswa){
		  
		    var jml = $("[name='jml"+nama+"_"+id_siswa+"']").val();
		 
		   $.post("<?php echo site_url("raport/update_kh"); ?>",{jml:jml,absen:nama,id_siswa:id_siswa },function(){
				notif("Data berhasil disimpan !!");			  
			  
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
	
	
	 