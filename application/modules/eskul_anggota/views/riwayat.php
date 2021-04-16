<?php 
$this->db->where("kode",$this->mdl->kode());
$this->db->where("id_eskul",$this->mdl->ids());
$data=$this->db->get("eskul_group")->num_rows();
if(!$data){ echo "Anda belum menambahkan Group Kelas.";return false;} 
$token=date("His");?>  
  <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						
                         
						
						<h2 class="sound">DATA PERTEMUAN</h2>
                           
                        </div>
						    <div class="body">
                          
				 <div class="cardd" id="area_lod">
			            <div cass="body" >
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable"  style="font-size:12px;width:100%" >
								<thead  class='sadow bg-teal' >			
									<th class='thead' style='max-width:3px'>NO</th>
							 
									<th class='thead'><center>TANGGGAL</center></th>
									<th class='thead'><center>  HADIR</center></th>
									<th class='thead'><center>  TIDAK HADIR</center></th>
								 
								 
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
		 scrollY:        400,
		deferRender:    true,
		scroller:       true,
		 "lengthMenu":
		 [[10 , 30,50,100,200,300,400,500,1000,2000], 
		 [10 , 30,50,100,200,300,400,500,1000,2000]], 
	   dom: 'Blfrtip',
	   scrollY: 370,
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			  
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('eskul_anggota/data_pertemuan');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.id_kelas= $('#id_kelasf<?php echo $token;?>').val();
						  data.gender = $('#genderf<?php echo $token;?>').val();
						  data.group = $('#groupf<?php echo $token;?>').val(); 
						  data.searching = $('#searching').val();
						 
						 
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
          "targets": [ 0,-1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
     	  
	 
		var x=0; 
	   $(document).on('change', '#groupf<?php echo $token;?>,#id_tahun_masukf<?php echo $token;?>,#id_kelasf<?php echo $token;?>,#genderf<?php echo $token;?>,#aktifasif<?php echo $token;?>,#id_status_ibuf<?php echo $token;?>,#id_status_ayahf<?php echo $token;?>,#id_penghasilanf<?php echo $token;?>,#id_pekerjaan_ibuf<?php echo $token;?>,#id_pekerjaan_ayahf<?php echo $token;?>', function (event, messages) {			   
        
			 dataTable.ajax.reload(null,false);	
		 
		});
		
function setNilai(idsiswa,idtbl,nama,nilai,ket)
{			 
				   $("#judul_tinjau").html("INPUT NILAI");
				  $("#defaultModalLabel").html(nama);
				   $("#mdl_formSubmit").modal();
				   $("[name='id']").val(idsiswa);
				   $("[name='nilai']").val(nilai);
				   $("[name='f[ket]']").val(ket);
			  
}
 
 			
 									
  
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
	$('.select').selectpicker();
	$(".tmt").inputmask("99/99/9999");  
	$(".thn").inputmask("9999/9999");  
	</script>
	
 
	
 
	<div class="modal fade" id="mdl_formSubmit" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
					
                        <div class="modal-header">
						<button type="button"  class="close" data-dismiss="modal">
                       <span aria-hidden="true">×</span>
                       <span class="sr-only">Close</span>
                </button>
                            <h4 class="modal-title" id="defaultModalLabel"></h4>
                        </div>
						<form   action="javascript:submitForm(`formSubmit`)" method="post" id="formSubmit" url="<?php echo base_url()?>eskul_anggota/inputNilai" >
	
                        <div class="modal-body">
                          <input type="hidden" name="id">
						   
								<label for="nilai" class="col-black" style="padding-top:10px;">Nilai</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="nilai" class="form-control" required name="nilai" >
                                    </div>
                                </div>
								
                                <label for="ket" class="col-black">Keterangan</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="f[ket]" class="form-control" id="ket" required placeholder='contoh: Aktif dalam kegiatan' ></textarea>
                                    </div>
                                </div>

                            
						  
                        </div>
                        <div class="modal-footer">
                            <button onclick="submitForm(`formSubmit`)"   class="waves-effect btn col-white   bg-teal "><i class="material-icons">save</i> SIMPAN</button>
                             
                        </div>
						</form>
                    </div>
                </div>
            </div>

	
	 