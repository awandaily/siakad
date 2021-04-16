<?php $token=date("His");?>  
  <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						 
						
						<h2 class="sound"> 
						
						 <button onclick="import_data()" class=" btn pull-right  bg-teal waves-effect" style="margin-top:-5px"><i class="material-icons">file_download</i>IMPORT DATA SISWA PKL</button></h2>
                           <br>
                        </div>
						    <div class="body">
                           <div class="row clearfix">
						   
						 <div class="col-sm-4 col-black">
                                    <select class="form-control show-tick" data-actions-box="true" onchange="reload_table()" id="id_kelasf<?php echo $token;?>" data-selected-text-format="count" multiple >
                                       
											<?php 
												$idjabatan = $this->m_reff->goField("data_pegawai", "id_jabatan", "WHERE id='".$this->mdl->idu()."' ");
	                                        	$idjurusan = $this->m_reff->goField("tr_jurusan", "id", "WHERE id_jabatan='".$idjabatan."' ");
		                                         $akses=$this->m_reff->goField("data_pegawai","multiakun","where id='".$this->mdl->idu()."' ");
										   $db=$this->db->get_where("tr_tingkat",array("id"=>2))->result();
										   foreach($db as $val){
											   echo "<optgroup label='TINGKAT ".$val->nama."'>";
											   if(strpos($akses,"5")!==false){
											          $this->db->where("id_jurusan",$idjurusan);
											   }
												         
												   $dbs=$this->db->get_where("v_kelas",array("id_tk"=>$val->id))->result();
												   foreach($dbs as $vals){
													   echo "<option selected value='".$vals->id."'>".$vals->nama."</option>";
												   }
												  
											   echo "</optgroup>";
										   }
										   ?>
									  
                                    </select>
                                </div> 
						
						
								
								<div class="col-sm-4">
                                    <select class="form-control show-tick" onchange="reload_table()"  id="genderf<?php echo $token;?>">
                                        <option value="">=== Filter Gender ===</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                         
                                    </select>
                                </div> 
								
								<div class="col-sm-4">
                                     <select class="form-control show-tick"   onchange="reload_table()"  id="mitraf<?php echo $token;?>" data-live-search="true">
                                        <option value="" selected>=== Filter Mitra PKL ===</option>
										
										
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
								
								
								<div class="col-sm-4">
                                    <select class="form-control show-tick" onchange="reload_table()"  id="statusf<?php echo $token;?>">
                                        <option value="">=== Filter Status Penempatan ===</option>
                                        <option value="1">Sudah ditempatkan</option>
                                        <option value="2">Belum ditempatkan</option>
                                         
                                    </select>
                                </div> 
									<div class="col-sm-4">
								<select class="form-control show-tick"   onchange="reload_table()"  id="id_pembimbing" data-live-search="true" >
                                        <option value="" selected>=== Filter pembimbing ===</option>
										 
											<?php 
											 
										    $db=$this->db->get_where("v_pegawai")->result();
										     foreach($db as $vals){
													   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
												   }
										   ?>
									  
                                    </select>
								</div>
								<div class="col-sm-4">
								<input type="text" id="cari" class="form-control"  onchange="reload_table()" placeholder="Pencarian nama ...">
								</div>
								
								
							 
						 
						    
                           </div>
						  
				 <div   id="area_lod">
			            <div  >
                            <div class="">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable"  style="font-size:12px;width:100%" >
								<thead  class='sadow bg-teal' >			
									<th class='thead' style='max-width:3px'>NO</th>
									<th class='thead' style='min-width:125px'   >NAMA</th> 
									<th class='thead' style='min-width:215px' >TEMPAT PKL</th>  
									<th class='thead' >PEMBIMBING</th>
								    <th class='thead' >DESKRIPSI</th>
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
						  data.jenis_pkl = 2;
						    data.id_pembimbing = $('#id_pembimbing').val();
					 
						 
		 },
		   beforeSend: function() {
               loading("area_lod");
            },
			complete: function() {
              unblock('area_lod');
		//	  amankan();
            },
			
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3,-4 ], //last column
          "orderable": false, //set not orderable
        },
		// { "visible": false, "targets": 5 }
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
		 data: {id_siswa:id,id_mitra:mitra,id_jam:jam,jenis_pkl:1},
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
		//	amankan();
 }
 function setpembimbing(id)
 {
      
	 var id_pembimbing=$("[name='id_pembimbing"+id+"']").val();
	 $.ajax({
		 url:"<?php echo site_url("prodi/setPembimbing"); ?>",
		 data: {id_siswa:id,id_pembimbing:id_pembimbing},
		 method:"POST",
		 dataType:"JSON",
		 success: function(data)
				{ 	 	   
				 
		            notif("<b>Tersimpan!!</b>");
			    //  reload_table();
				}
	 
            });
 }
  function setOtw(id)
 {
       var jam=$("[name='jam"+id+"']").val();
       if(!jam){
           $("[name='otw"+id+"']").val("");
           notif("Mohon isi <b>LAMA PKL</b> terlebih dahulu.");
           $("[name='jam"+id+"']").focus();
           return false;
       }
	 var tgl=$("[name='otw"+id+"']").val();
	 $.ajax({
		 url:"<?php echo site_url("prodi/setOtw"); ?>",
		 data: {id_siswa:id,tgl:tgl},
		 method:"POST",
		 dataType:"JSON",
		 success: function(data)
				{ 	 	   
				 if(data['report']==false)
				   {
					   notif("Maaf! Mohon input ulang LAMA PKL siswa.");
					   return false;
				   }
		            notif("<b>Tersimpan!!</b>");
			    //  reload_table();
				}
	 
            });
 }
 
 function import_data()
{
       $("#formSubmitDown")[0].reset();
  $("#judul_mdl").html("IMPORT DATA SISWA PKL ");
				   $("#isi").html(data);
				   $("#mdl_formSubmitDown").modal( );
				    $("#formSubmitDown").attr("url","<?php echo base_url()?>prodi/import_data");
				    $("#downfor").prop("href","<?php echo base_url()?>prodi/download_format_quota");
}
 </script>

	 
	
	 
	
	 
	  
	  <!-- Modal -->
<div class="modal fade" id="mdl_formSubmitDown" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="area_formSubmitDown">
        <div class="modal-content">
		<form id="formSubmitDown" action="javascript:submitForm('formSubmitDown')" method="post"  >
                
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" id="judul_mdl">
                   
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="col-md-12 body">    
       <center>		
       <b>Silahkan download rombel dibawah ini</b>
       <?php
       $data=$this->db->query("select * from v_kelas where id_tk=2 order by nama asc")->result();
       $bg="bg-grey col-white";$jur="";
       foreach($data as $val)
       { 
         echo '  <a  class="'.$bg.' btn btn-block btn-hover"   href="'.base_url().'prodi/download_format/'.$val->id.'"><b>'.$val->nama.'</b></a>  	';  
       }
       ?><br>
       
      			  	
				<div class="row">
				
                                        <div class="form-line"><span id="ket_file">  </span>
					                      <input type="file" accept="xlsx" class="form-control" name="file"  required/>
                                        </div>
                                    </div><br>
					 
                  
            </div>
            </div>
            <div class="row clearfix"></div>
            <div class="modal-footer">
			  
              <button onclick="submitForm('formSubmitDown')"  class="pull-right waves-effect btn bg-teal"><i class="material-icons">cloud_upload</i> UPLOAD</button>
                         
                        </div>
            </form>
        
		</div>
    </div>
</div>
	
		
	
	
	
	
	
	
	
	
	 