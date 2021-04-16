   <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>plug/editor/jquery-te-1.4.0.css">
<script type="text/javascript" src="<?php echo base_url(); ?>plug/editor/jquery-te-1.4.0.min.js" charset="utf-8"></script>

             <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pengaturan</h2>
                          
							 
                        </div>
                        <div class="body">
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
								
									<th class='thead' >NAMA PENGATURAN </th>
									<th class='thead' >SETING </th>
									 
								</thead>
								
								<tr>
								<td>1</td>
								<td>INFORMASI KELULUSAN SELEKSI BERKAS</td>
								<td>
								 
								<?php
								$dataray="";
								 
									$dataray[1]="DITAMPILKAN";
									$dataray[0]="TIDAK DITAMPILKAN";
									$array=$dataray;
								echo form_dropdown("val_1",$array,$this->m_reff->goField("tm_pengaturan","val","where id='1' "),"class='form-control' onchange='save_(`1`,`val_1`)' ");
								?>
								</td>
								</tr>
								
								<tr>
								<td>2</td>
								<td>INFORMASI TAMBAHN UNTUK PENDAFTAR YANG LULUS</td>
								<td>
								 
								<textarea id="val_2" name="val_2" onchange='save_(`2`,`val_2`)'><?php echo $this->m_reff->goField("tm_pengaturan","val","where id='2' ");?></textarea>
								<button onclick='save_(`2`,`val_2`)' class="btn btn-block btn-primary">SIMPAN</button>
								</td>
								</tr>
								
								<tr>
								<td>3</td>
								<td>INFORMASI HALAMAN PENDAFTAR SEBELUM KELULUSAN DI INFORMASIKAN</td>
								<td>
								 
								<textarea id="val_3" name="val_3" onchange='save_(`3`,`val_3`)'><?php echo $this->m_reff->goField("tm_pengaturan","val","where id='3' ");?></textarea>
								<button onclick='save_(`3`,`val_3`)' class="btn btn-block btn-primary">SIMPAN</button>
								</td>
								</tr>
								
								<tr>
								<td>4</td>
								<td>INFORMASI BAGI YANG TIDAK LULUS</td>
								<td>
								 
								<textarea id="val_4" name="val_4" onchange='save_(`4`,`val_4`)'><?php echo $this->m_reff->goField("tm_pengaturan","val","where id='4' ");?></textarea>
								<button onclick='save_(`4`,`val_4`)' class="btn btn-block btn-primary">SIMPAN</button>
								</td>
								</tr>
								
							</table>
							</div>						
						</div>						
					</div>	
                           <!----->
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
  
	
 

	
 
   
<script>
  $('#val_2').jqte();
  $('#val_3').jqte();
  $('#val_4').jqte();
 
 function save_(idpengaturan,idkonten)
	 {	 
	 var idkonten=$("[name='"+idkonten+"']").val();
		 $.ajax({
		 url:"<?php echo base_url()?>pengaturan/save_",
		 data: "idpengaturan="+idpengaturan+"&idkonten="+idkonten,
		 method:"POST",
		 success: function(data)
            {	 
				 notif_success("<span class='sadow white'><div class='demo-google-material-icon'> <i class='material-icons'>done_all</i> <span class='icon-name'>Tersimpan!</span>");
            }
		});
	 }
	 
    
	
</script>


 