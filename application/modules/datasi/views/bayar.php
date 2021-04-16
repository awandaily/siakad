	
	<?php
		$op = $this->m_reff->goField("admin", "keu_operator", "WHERE id_admin='".$this->session->userdata("id")."' ");

		switch ($op) {
			case '1':
				$label_tk = "TINGKAT X";
			break;
			case '2':
				$label_tk = "TINGKAT XI";
			break;
			case '3':
				$label_tk = "TINGKAT XII";
			break;
			case 'All':
				$label_tk = "SEMUA TINGKAT";
			break;
			
			default:
				$label_tk = "";
			break;
		}
	?>


   <div   class="modal fade in" id="mdl_alasan" tabindex="-1" role="dialog" style="z-index:999999999">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content modal-col-green">
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">Alasan dibebeaskan</h4>
                        </div>
                  <div class="modal-body col-black">
                          <!--        <textarea class="form-control" name='alasan' placeholder="Alasan dibebaskan...."></textarea>
						--->	 
						<select class='form-control select' name="alasan">
						<option value="">--- Pilih ----</option>
					<!--	<option value='sudah_bayar'>TELAH DIBAYAR (SESUAI TGL TAGIHAN) </option>--->
						<?php
						$dt=$this->db->get("keu_tr_alasanbebas")->result();
						foreach($dt as $val){
						echo "<option value='".$val->id."'>".$val->nama."</option>";
						}
						?>
						</select>
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn-block  waves-effect btn   waves-effect" onclick="simpan()">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
			
			
			<div class="row clearfix" style="margin-top:-20px">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="form-horizontal" id="formbayar"  action="javascript:submitForm('formbayar')"   url="<?php echo base_url()?>datasi/bayaran"  method="post" >
                     
                    <div class="card">
					     
                        <div class="header">
						  <h2>INPUT DATA PEMBAYARAN <?php echo $label_tk ?></h2>
                           <span class='pull-right cursor col-indigo' onclick="importFile()"> IMPORT PEMBAYARAN</span>
                        </div>
						 
                      
                       
                             <div class="body" id="area_lod">
							  <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Input NIS/NISN </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input type="text" id="nis" class="form-control" onclick="resset()" onchange="getNIS()" placeholder="Input kemudian Enter">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Pilih Kelas</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                              
											  
											  <select class="form-control select show-tick" id="id_kelas" data-live-search="true"   onchange="kelasLoad()">
                                       
											<option value="">=== PILIH ===</option>
										 	<?php 
										   $db=$this->db->get("tr_tingkat")->result();
										   foreach($db as $val){

										   		if ($op == $val->id) {
										   			echo "<optgroup label='TINGKAT ".$val->nama."'>";
												    $this->db->order_by("nama","asc");
													   $dbs=$this->db->get_where("v_kelas",array("id_tk"=>$val->id))->result();
													   foreach($dbs as $vals){
														   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
													   }
													  
												   echo "</optgroup>";
										   		}
										   		elseif($op == "All"){
										   			echo "<optgroup label='TINGKAT ".$val->nama."'>";
												   $this->db->order_by("nama","asc");
													   $dbs=$this->db->get_where("v_kelas",array("id_tk"=>$val->id))->result();
													   foreach($dbs as $vals){
														   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
													   }
													  
												   echo "</optgroup>";
										   		}


											   
										   }
										   ?>
									  
											</select>
											   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
								
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Pilih Nama </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line" id="getNama">
                                                <input type="text" id="nama" class="form-control" disabled placeholder="Silahkan pilih kelas terlebih dahulu">
                                            </div>
                                        </div>
                                    </div>
                                </div>
						 
					 
                            
					 				
						 
                           <!----->
                        </div>
                    </div>
					<div id="tagihan">  </div>	
					  </form>
                </div>
				
				
  </div>
                <!-- #END# Task Info -->
				
 <script>
 $(".select").selectpicker();
 function resset()
 {
	// var nisawal=$("#nis").val();
	 $("#formbayar")[0].reset();
	 
	//  $("#nis").val(nisawal);
 }
 function reload_table()
 {
	 getAction();
	 
	 
 }
 function getAction()
 {	 
     	$("#tagihan").html("Loading...");
 loading("area_lod");
 var nama=$("[name='nama']").val();
	 var id=$("#id_kelas").val();
	$.post("<?php echo site_url("datasi/getFormBayar"); ?>",{id:id,nama:nama},function(data){
		$("#tagihan").html(data);
	 	unblock("area_lod");
	 window.scrollTo(0,document.body.scrollHeight);  
	});
 }
 
 function kelasLoad()
 {
		$("#tagihan").html("Loading...");
	 var id=$("#id_kelas").val();
	 $.post("<?php echo site_url("datasi/getNamaSiswa"); ?>",{id:id},function(data){
		$("#getNama").html(data);
		getAction();
	 });
 }
 function getNIS()
 {
	
	 var id=$("#nis").val();
	 if(id==null)
	 {
		  notif("Input NIS/NISN");
			 return false;
	 }
	 $.post("<?php echo site_url("datasi/getNamaSiswaByNis"); ?>",{id:id},function(data){
		 if(data=="no")
		 {
			 $("[name='nama']").val(0);
			 notif("Tidak ditemukan!");
			 return false;
		 }
	 
		$("#getNama").html(data);
	 });
 }
  </script>
  <script>
  
function detailTagihan(id,nama_biaya)
{	loading("area_loding");
	$("#defaultModal").modal();
	 var nama=$("[name='nama']").val();
	 $.post("<?php echo site_url("datasi/detailTagihan"); ?>",{id:id,nama:nama},function(data){
		$("#isitagihan").html(data);
		$("#defaultModalLabel").html(nama_biaya);
		unblock("area_loding");
	 });
}
 </script>  <script>
  
function importFile(id,nama_biaya)
{				 $("#formSubmitDown")[0].reset();
				$("#judul_mdl").html("IMPORT DATA PEMBAYARAN ");
				   $("#isi").html(data);
				   $("#mdl_formSubmitDown").modal( );
				    $("#formSubmitDown").attr("url","<?php echo base_url("datasi/import_pembayaran");?>");
					$("#ket_file").html("Cari File");
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
       <center>				  <a class="sound" href="<?php echo base_url()?>form-bayar.xlsx">Download Format  Upload</a> </center>		
				  	
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
	
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 <div   class="modal fade in" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel"></h4>
                        </div>
                        <div class="modal-body col-black" id="isitagihan">
                            
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>
  