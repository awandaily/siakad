 			  
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
						<button onclick="kirim()" class="pull-right waves-effect btn bg-indigo"><i class="material-icons">input</i> INPUT TAGIHAN</button>
                            <h2>Data Tagihan</h2>
                          
							 
                        </div>
						 
                        <div class="body" id="area_lod">
                       
                           
                             <table id='tabel' class="tabel black table-bordered  table-hover dataTable">
								<thead  class='sadow bg-teal'  style="font-size:12px;width:100%" >			
									<th class='thead' style='max-width:3px'>NO</th>
									<th class='thead' style='max-width:80px'>BAYAR  </th>
									<th class='thead' >TAGIHAN</th>
									<th class='thead' width="100px">TOTAL TAGIHAN (Rp) </th>
									<th class='thead' width="100px">TELAH DIBAYAR (Rp) </th>
									<th class='thead' width="100px">SISA TAGIHAN (Rp) </th>
									<th class='thead' width="120px">STATUS PEMBAYARAN</th>
									<th class='thead'  > KETERANGAN </th>
									</thead>
							</table>
					 					
						 
                           <!----->
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
 
	
	<script type="text/javascript">
	 
   var  dataTable = $('#tabel').DataTable({ 
		 "lengthChange": false,
        "processing": false, //Feature control the processing indicator.
		"language": {
					 "sSearch": "Pencarian",
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
		 [[10 , 30,50,100,200,300,400,500], 
		 [10 , 30,50,100,200,300,400,500]], 
		buttons: [
         
        ],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('datasi/data_tagihan');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.pilihan = $('#pilihan').val();
						 
		 },
		   beforeSend: function() {
               loading("tabel");
            },
			complete: function() {
              unblock('tabel');
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
    
	 
	   $(document).on('change', '#pilihan', function (event, messages) {			
			  dataTable.ajax.reload(null,false);	   
        });
function reload_table()
{
	 dataTable.ajax.reload(null,false);	   
}	
 
function kirim()
{ $("#formSubmit")[0].reset();
  $("#judul_mdl").html("INPUT NILAI ");
				 //  $("#isi").html(data);
				   $("#mdl_formSubmit").modal();
				    $("#formSubmit").attr("url","<?php echo base_url("kesiswaan/kirimMateri");?>");
					$("#ket_file").html("File Materi");
}
</script>
	
	  <div class="modal fade" id="mdl_formSubmit" tabindex="-1" role="dialog">
                <div class="modal-dialog " role="document" >
				
	                  <div class="modal-content" > <span  title="tutup"  data-dismiss="modal" class="   
					  pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title" id="judul_tinjau">  INPUT TAGIHAN</h4>
			             </div>
                     <div class="modal-body">
					 <form id="formSubmit">
							
                                <div class="form-groups">
									<label for="" class="col-black">PILIH TINGKAT</label>
                                    <div class="form-line">
                                     <select class="form-control show-tick" id="tingkat" name="f[id_tingkat]"   onchange="pilihJurusan()"  >
                                        <option value="">=== SEMUA TINGKAT ===</option>
                                        <option value="1">Kelas 1</option>
                                        <option value="2">Kelas 2</option>
                                        <option value="3">Kelas 3</option>  
									</select>
                                    </div>
                                </div>
					   
							 <div class="form-groups">
									<label for="" class="col-black">PILIH JURUSAN</label>
                                    <div class="form-line">
                                     <select class="form-control show-tick" id="jurusan" name="f[id_jurusan]"   onchange="pilihJurusan()">
                                        <option value="">=== SEMUA JURUSAN ===</option>
                                     <?php $jur=$this->db->get("tr_jurusan")->result();
									 foreach($jur as $jur)
									 {
										 echo "<option value='".$jur->id."'>".$jur->alias."</option>";
									 }
									 ?>
									</select>
                                    </div>
                                </div>
						<div id="isiJurusan"></div>
						
						
						</div>
								
					  <hr>
								<div class="form-groups">
									<label for="" class="col-black">Nama Tagihan</label>
                                    <div class="form-line">
                                     <input type="text" name="f[nama]"   class="form-control">
                                    </div>
                                </div>
								<div class="form-groups">
									<label for="" class="col-black">Jumlah Tagihan</label>
                                    <div class="form-line">
                                     <input type="text" name="f[nominal]"   class="form-control">
                                    </div>
                                </div><div class="form-groups">
									<label for="" class="col-black">Keterangan</label>
                                    <div class="form-line">
                                     <textarea name="f[ket]"   class="form-control"></textarea>
                                    </div>
                                </div>
					     
					 
					 </form>				 
					 </div>
					
				</div>
			 
				</div><!-- /.modal-dialog -->
     </div><!-- /.modal-dialog -->
	 
	 <script>
	 function pilihJurusan()
	 {		var id=$("[name='f[id_jurusan]']").val();
	 		var idt=$("[name='f[id_tingkat]']").val();
		   $.post("<?php echo base_url();?>datasi/getKelasperJurusan",{jurusan:id,tingkat:idt},function(data){
				$("#isiJurusan").html(data);
		      });
	 }
	 </script>