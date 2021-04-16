               <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						
                      
						
						
						<h2 class="sound">DATA SISWA</h2>
                              <?php  
                               $semester=$this->m_reff->semester();
                             	$tahun_real=$this->m_reff->tahun_asli();
	                        	$tahun_kini=$this->m_reff->tahun();
                            	if($tahun_real==$tahun_kini){
                            $idkelas=$this->m_reff->goField("tm_kelas","id","where id_wali='".$this->mdl->idu()."'");
	                        	}else{ 
	                        	
	                        	   $getIdSiswa=$this->m_reff->goField("tm_catatan_walikelas","id_siswa","where _cid='".$this->mdl->idu()."' and id_tahun='".$tahun_kini."'  order by RAND() limit 1");
	                         	   $idkelas=$this->m_reff->getHisKelas($getIdSiswa);   
	                        	} 
                             ?>
                           <b class='col-pink'>KELAS :  <?php
                           if($this->m_reff->tahun_sts()=="true"){
                           echo  $this->m_reff->goField("v_kelas","nama","where id_wali='".$this->mdl->idu()."'");
                           }else{
                             echo  $this->m_reff->goField("v_kelas","nama","where id='".$idkelas."'");
                           }?></b>
                         
                          <?php
                        if($this->m_reff->tahun_sts()=="true"){?>
				 	 <button onclick='add()' 
						 class='pull-right col-md-3 col-xs-12  waves-effect bg-teal  btn'>Tambahkan Ektrakurikuler</button>
                 <?php } ?>
						
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
									 
									<th class='thead'  >  EKTRAKURIKULER </th>
								 
								  	
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
                      columns:[ 0,2,3,4]
                },text:' Excell',
							
                    },
					
					 
					{extend: 'colvis',
                        exportOptions: {
                  columns:[ 0,1,2,3,4]
                },text:' Kolom',
							
                    },
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('raport/getDataSiswa_ektra');?>",
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
		
function tinjau(id)
{			var url="<?php echo base_url();?>kesiswaan/tinjau";
			$.post(url,{id:id},function(data){
				   $("#judul_tinjau").html("TINJAU DATA CBT");
				   $("#isi").html(data);
				   $("#modal_tinjau").modal();
			  });
}

 
 


function detail(id)
{ 
	$("#judul_mdl_detail").html("DATA DETAIL SISWA ");
				   $("#mdl_detail").modal( );
				   $.post("<?php echo site_url("welcome/detail_siswa"); ?>",{id:id},function(data){
				   $("#isi_detail").html(data);
	});
}							
											
  function hapus(id,nama=null){
		   alertify.confirm("<center> Hapus ?<br> <span class='font-bold'>`"+nama+"`</span>  </center>",function(){
		   $.post("<?php echo site_url("raport/hapus_ekstra"); ?>",{id:id },function(){
				notif("Data berhasil dihapus !!");			  
			  reload_table();
		      })
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
function add( )
{
	$("#mdl_formSubmit").modal("show");
	 $("#defaultModalLabel").html("Tambah Prestasi ");
	  $("#formSubmit").attr("url","<?php echo base_url("raport/add_ekstra");?>");
						$("[name='id']").val("");
				 	   $("[name='f[id_siswa]']").val("");
				 	   $("[name='f[id_ektra]']").val("");
				 	   $("[name='nilai']").val("");
				 	   $("[name='f[ket]']").val("");
}
function edit(id,id_siswa,id_ektra,nilai,ket)
{ 
	$("#defaultModalLabel").html("Edit Prestasi ");
				   $("#mdl_formSubmit").modal( );
				    $("#formSubmit").attr("url","<?php echo base_url("raport/edit_ekstra");?>");
				 	   $("[name='id']").val(id);
				 	   $("[name='f[id_siswa]']").val(id_siswa);
					     $("[name='f[id_ektra]']").val(id_ektra);
				 	   $("[name='nilai']").val(nilai);
				 	   $("[name='f[ket]']").val(ket);
}
function tutup()
{
	   $("#mdl_formSubmit").modal("hide");
}
</script>
	
 <div class="modal fade" id="mdl_formSubmit" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
					
                        <div class="modal-header">
						<button type="button" onclick="tutup()" class="close" data-dimdiss="modal">
                       <span aria-hidden="true">×</span>
                       <span class="sr-only">Close</span>
                </button>
                            <h4 class="modal-title" id="defaultModalLabel">Tambah Prestasi Siswa</h4>
                        </div>
						<form   action="javascript:submitForm(`formSubmit`)" method="post" id="formSubmit" url="<?php echo base_url()?>raport/add_prestasi" >
	
                        <div class="modal-body">
                          <input type="hidden" name="id">
						  
						  	<label for="email_address" class="col-black">Pilih Siswa</label>
                                <div class="form-group" >
                                    <div class="form-line" >
                                        <?php
														 $idk=$this->mdl->id_kelas();		 		
													$this->db->where("id_kelas",$idk);
											 
													$sts=$this->db->get("data_siswa")->result();
													  $ray="";$ray[""]="=== Pilih ===";
														  foreach($sts as $val)
														  {
															$ray[$val->id]=$val->nama;
														  }
														  echo form_dropdown("f[id_siswa]",$ray,"",'required class="form-control col-md-12 border cursor "  ');	 
														
														?>
                                    </div>
                                </div>
						  
								<label for="ek" class="col-black">Pilih Ektrakurikuler</label>
                                <div class="form-group" >
                                    <div class="form-line" >
                                        <?php
														 
													$sts=$this->db->get("tr_ektrakurikuler")->result();
													  $ray="";$ray[""]="=== Pilih ===";
														  foreach($sts as $val)
														  {
															$ray[$val->id]=$val->nama;
														  }
														  echo form_dropdown("f[id_ektra]",$ray,"",'required id="ek" class="form-control col-md-12 border cursor "  ');	 
														
														?>
                                    </div>
                                </div>
						  
							
								
								<label for="nilai" class="col-black" style="padding-top:10px;">Nilai</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="nilai" class="form-control" required name="nilai" >
                                    </div>
                                </div>
								
                                <label for="ket" class="col-black">Keterangan</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="f[ket]" class="form-control" id="ket"  ></textarea>
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
	 
                                   
	 
	 
	 
	<script>
 //	$('select').selectpicker();
	 
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
	
	
	 