 
 
                <div class="row clearfix">
                <!-- Task Info -->
				<div class="col-md-12" > <b>BIAYA INI MERUPAKAN BIAYA AWAL SISWA KETIKA MASUK</b></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
					
                        <div class="header">
						
							<div class="col-md-4" style="margin-top:-9px" >
                                        <select id="ftingkat" class="form-control show-tick "  >
                                        <option value="" >=== Filter Tingkat ===</option>
                                        <option value="1" >Tingkat X</option>
                                        <option value="2" >Tingkat XI</option>
                                        <option value="3" >Tingkat XII</option>
										</select>   
                            </div>
							
							<div class="col-md-4" style="margin-top:-9px" >
                                        <select id="fjurusan" class="form-control show-tick "  >
                                        <option value="" >=== Filter Jurusan ===</option>
										<?php
										$dbs=$this->db->get("tr_jurusan")->result();
										foreach($dbs as $val)
										{
											echo ' <option value="'.$val->id.'" >'.$val->alias.'</option>';
										}?>
										</select>   
                            </div>
							
							<div class="col-md-5 clearfix row">&nbsp;</div>
							
                            <h2> &nbsp;</h2>
                           <button onclick="add()" type="button" class="btn-top btn pull-right bg-teal waves-effect">
                                    <i class="material-icons">create</i>
                                   Tambah  
                           </button>
								
								
								

								
                        </div>
                       
                           <!----->
				 <div class="card" id="area_lod">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >KODE</th>
									<th class='thead' >NAMA BIAYA</th>
									<th class='thead' >NOMINAL BIAYA</th> 
									<th class='thead' >PERULANGAN TAGIHAN</th>
									<th class='thead' >JURUSAN</th>
									<th class='thead' >TINGKAT</th>
									<th class='thead' >BULAN PENAGIHAN</th>
									 <th class='thead' >STATUS GENERATE</th>
								 	<th class='thead' style='min-width:150px' >OPSI</th>
								</thead>
							</table>
							</div>						
						</div>
						
						
						
						
						<br>	<br>	<br>	<br>	<br>	<br>	<br>	<br>	<br>
						
						 <div class="card col-md-12"  >
						  <p>Tombol GENERATE biasanya dilakukan ketika awal masuk ajaran baru karena biaya pada tabel diatas ditujukan untuk siswa baru.</p>      
						        
						  <p>Ketika anda menambahkan biaya baru maka biaya tersebut tidak langsung tersimpan pada tagihan siswa (hanya sebagai draft), 
						    untuk menambahkan pada tagihan siswa anda harus mengklik tombol GENERATE.</p>
						    
						    <p>Jika anda sudah mengklik tombol GENERATE maka data biaya akan ditambahkan ke tagihan siswa, dan jika data biaya dihapus tapi sudah di GENERATE maka
						     biaya tagihan pada siswa tetap ada.</p>
						    
				<?php
				$getjur=$this->db->query("select * from tr_jurusan")->result();
	        foreach($getjur as $get){
	          echo ' <p>   <button class="btn btn-block bg-green" onclick="generate_j(`1`,`'.$get->id.'`)">GENERATE BIAYA   JURUSAN ['.$get->id.'] '.$get->nama.'</button>  </p>';
	        } 
				?>		    
						 <p>   <button class="btn btn-block bg-pink" onclick="generate()">GENERATE BIAYA SEMUA JURUSAN</button>  </p>
						 
						 
						 
				<!--		 <p>   <button class="btn btn-block bg-pink" onclick="batalkan()">BATALKAN BIAYA YANG SUDAH DIGENERATE</button> </p> --->
						    <br>
						    </div>	
						
						
						
						
	<script>
	  function generate_j(idtk,jur){
		   alertify.confirm("<center>Anda akan menambahkan biaya yang sudah tersimpan pada tabel untuk ditagihkan ke siswa ?</center>",function(){
		       loading();
		   $.post("<?php echo site_url("welcome/generate_all/"); ?>/"+idtk+"/"+jur,{kode:"yes"},function(){
			   notif("<b>Berhasil ditambahkan!</b>");
			   unblock();
		      })
		   })
	  };
	  
	  
	  
	     function generate(){
		   alertify.confirm("<center>Anda akan menambahkan biaya yang sudah tersimpan pada tabel untuk ditagihkan ke siswa ?</center>",function(){
		       loading();
		   $.post("<?php echo site_url("welcome/generate_all"); ?>",{kode:"yes"},function(){
			   notif("<b>Berhasil ditambahkan!</b>");
			   unblock();
		      })
		   })
	  };
	  
	     function batalkan(){
		   alertify.confirm("<center>Anda akan menghapus biaya yang sudah ditagihkan ke siswa ? data yang dihapus adalah data yang belum pernah dibayarkan oleh siswa</center>",function(){
		       loading();
		   $.post("<?php echo site_url("welcome/cancel_generate_all"); ?>",{kode:"yes"},function(){
			   notif("<b>Berhasil dihapus!</b>");
			   unblock();
		      })
		   })
	  };
	</script>					
						
						
						
						
						
						
						
						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
  <script type="text/javascript">
  	  function hapus(id,akun){
		   alertify.confirm("<center>Hapus  <br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("keu_set/hapus_tagihan"); ?>",{id:id},function(){
			   reload_table();
		      })
		   })
	  };
	   
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
		 "responsive": true,
		 "searching": true,
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
            "url": "<?php echo site_url('keu_set/getTagihan');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.tingkat= $('#ftingkat').val();
						  data.jurusan= $('#fjurusan').val();
					   
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
	 
	</script>
	
	 <script>
	   $(document).on('change', '#ftingkat,#fjurusan', function (event, messages) {			   
        		reload_table();
		});
		 
	function reload_table()
	{
		  dataTable.ajax.reload(null,false);	
	};
	</script>
	
	
	
<script>
function add()
{
	 $("#mdl_modal_artikel").modal( );
	 $("#modal_artikel")[0].reset();
	  
	 $("#defaultModalLabel").html("Tambah Tagihan");
}

 function edit(id,tk,jur,rom,wali)
	 {	 
		 		  
			 $.post("<?php echo site_url("keu_set/editTagihan"); ?>",{id:id,id_tk:tk,id_jurusan:jur,nama:rom,id_wali:wali},function(data){
		 	   $("#editTagihan").html(data);
			    $("#mdl_modal_edit").modal();
			}); 
	 }
</script>
	 

	
 <div class="modal fade" id="mdl_modal_edit" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
	<form  action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url()?>keu_set/update_tagihan"  method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" >Edit Tagihan</h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <div id="editTagihan"></div>
							 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_edit')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
   </div><!-- /.modal-dialog --> 

		 
		 
		 
		 
		 
		 
		 
		 
	
 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel"  url="<?php echo base_url()?>keu_set/add_biaya" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel"></h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <input type="hidden" name="id">
								<div class="row clearfix">
									<div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">KODE TAGIHAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                         <input type="text" required class="form-control" name='kode'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
									<div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">NAMA TAGIHAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                         <input type="text" required class="form-control" name='f[nama_biaya]'>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
								<div class="row clearfix">
									<div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">NOMINAL TAGIHAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                         <input type="text" required class="form-control" name='nominal' onkeydown="return numbersonly(this, event);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								  <div class="row clearfix">
                                    <div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">JENIS PERULANGAN TAGIHAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                      <select id="kelipatan" name='kelipatan' class="form-control show-tick " required onclick="setPerulangan()" >
                                        <option value="" >=== Pilih ===</option>
                                        <option value="1" >Hanya sekali</option>
                                        <option value="36" >Setiap Bulan dari awal masuk sd lulus</option>
                                        <option value="6" >Setiap Semester dari awal masuk hingga lulus</option>
                                        <option value="4" >Setiap Semester dari awal masuk hingga tingkat XI (sebelas)</option>
                                       
                                        </select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<script>
								function setPerulangan()
								{
									var per=$('[name="kelipatan"]').val();
									if(per=="36" || per=="6" || per=="4")
									{
										$("#bln_penagihan").val("07");
										$("#tingkat").val("1");
									}
								}
								</script>
								
							   <div class="row clearfix">
                                    <div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">DITAGIH PADA BULAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                      <select id="bln_penagihan" name='f[bln_penagihan]' required  class="form-control show-tick "  >
                                        <option value="" >=== Pilih ===</option>
                                        <option value="01" >[01] JANUARI (Awal semester Genap)</option>
                                        <option value="02" >[02] FEBRUARI</option>
                                        <option value="03" >[03] MARET</option>
                                        <option value="04" >[04] APRIL</option>
                                        <option value="05" >[05] MEI</option>
                                        <option value="06" >[06] JUNI</option>
                                        <option value="07" >[07] JULI (Awal semester ganjil)</option>
                                        <option value="08" >[08] AGUSTUS</option>
                                        <option value="09" >[09] SEPTEMBER</option>
                                        <option value="10" >[10] OKTOBER</option>
                                        <option value="11" >[11] NOVEMBER</option>
                                        <option value="12" >[12] DESEMBER</option>
                                        </select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>

								
								
							  <div class="row clearfix">
                                    <div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">TAGIHAN UNTUK TINGKAT</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                      <select id="tingkat" name='id_tk' class="form-control show-tick "  >
                                        <option value="0" >=== Pilih ===</option>
                                        <option value="1" >Tingkat X (Sepuluh)</option>
                                        <option value="2" >Tingkat XI (Sebelas)</option>
                                        <option value="3" >Tingkat XII (Dua belas)</option>
										</select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>

							 
								
								<div class="row clearfix">
                                    <div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">TAGIHAN UNTUK JURUSAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <select id="jurusan" name='id_jurusan' class="form-control show-tick "  >
                                        <option value="0" >=== Pilih ===</option>
										<?php
										$dbs=$this->db->get("tr_jurusan")->result();
										foreach($dbs as $val)
										{
											echo ' <option value="'.$val->id.'" >'.$val->alias.'</option>';
										}?>
										</select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
								
							 
									 <div class="row clearfix">
                                    <div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">STS GENERATE</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                      <select id="sts" name='f[sts]' class="form-control show-tick " required onclick="setPerulangan()" >
                                         
                                        <option value="1" >Aktif</option>
                                         <option value="2" >Tidak aktif</option>
                                        </select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
									
							 
  						
 
			 
					 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
       
   