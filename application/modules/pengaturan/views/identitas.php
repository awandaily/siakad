  	<script>							 
									 
 function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
      $('.image img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>



             <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>IDENTITAS SEKOLAH</h2>
                          
							 
                        </div>
                        <div class="body">
                           <!----->
				 <div  >
                        <div >
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
								
									<th class='thead' >NAMA PENGATURAN </th>
									<th class='thead' >  </th>
									 
								</thead>
								<?php   $i=1;?>
								<tr>
								<td><?php echo $i++;?></td>
								<td>NAMA SEKOLAH</td>
								<td>
								
								 <input type="text" id="val_7" name="val_7" onchange='save_(`7`,`val_7`)' class='form-control' value="<?php echo $this->m_reff->tm_pengaturan(7);?>">
								
								</td>
								</tr>	
								<tr>
								<td><?php echo $i++;?></td>
								<td>LOGGO SEKOLAH</td>
								<td>
								<form name="form" action="<?php echo base_url()?>pengaturan/save_logo" method="post" enctype="multipart/form-data">
								 <input type="file"   class="form-control" name="logo" onchange="this.form.submit()"  >
								  </form>
								</td>
								</tr>
								
								<tr>
								<td><?php echo $i++;?></td>
								<td>ALAMAT SEKOLAH</td>
								<td>
								 <input type="text" id="val_8" name="val_8" onchange='save_(`8`,`val_8`)' name="nama_sekolah" class='form-control' value="<?php echo $this->m_reff->tm_pengaturan(8);?>">
								 
								</td>
								</tr><tr>
								<td><?php echo $i++;?></td>
								<td>ALAMAT SINGKAT SEKOLAH</td>
								<td>
								 <input type="text" id="val_13" name="val_13" onchange='save_(`13`,`val_13`)' name="nama_sekolah" class='form-control' value="<?php echo $this->m_reff->tm_pengaturan(13);?>">
								 
								</td>
								</tr>
								
							 <tr>
								<td><?php echo $i++;?></td>
								<td>TELP SEKOLAH</td>
								<td>
								 <input type="text" id="val_1" name="val_1" onchange='save_(`1`,`val_1`)' name="nama_sekolah" class='form-control' value="<?php echo $this->m_reff->tm_pengaturan(1);?>">
								 
								</td>
								</tr>
								
								 <tr>
								<td><?php echo $i++;?></td>
								<td>EMAIL SEKOLAH</td>
								<td>
								 <input type="text" id="val_2" name="val_2" onchange='save_(`2`,`val_2`)' name="nama_sekolah" class='form-control' value="<?php echo $this->m_reff->tm_pengaturan(2);?>">
								 
								</td>
								</tr>
								
								 <tr>
								<td><?php echo $i++;?></td>
								<td>POTO SEKOLAH</td>
								<td>
								<form name="form" action="<?php echo base_url()?>pengaturan/save_poto" method="post" enctype="multipart/form-data">
								<center>
								<span class="col-md-2 col-xs-12">
								<img height="50px"  src="<?php echo base_url()?>file_upload/img/<?php echo $this->m_reff->tm_pengaturan(11);?>"></span>
								<span class="col-md-10 col-xs-12">
								 <input type="file"   name="logo" onchange="this.form.submit()"   class='form-control' >
								 </span>
								 </form>
								</td>
								</tr>
									 <tr>
								<td><?php echo $i++;?></td>
								<td>KOP SURAT <br> size :2295px - 317px</td>
								<td>
								<form name="form" action="<?php echo base_url()?>pengaturan/save_banner" method="post" enctype="multipart/form-data">
								<center>
								<span class="col-md-8 col-xs-12">
								<img height="50px"  src="<?php echo base_url()?>file_upload/img/<?php echo $this->m_reff->tm_pengaturan(12);?>"></span>
								<span class="col-md-4 col-xs-12">
								 <input type="file"   name="logo" onchange="this.form.submit()"   class='form-control' >
								 </span>
								 </form>
								</td>
								</tr>
								
							 
							  <tr>
								<td><?php echo $i++;?></td>
								<td>KOORDINAT SEKOLAH</td>
								<td>
								    <div class='col-md-6'> 
							 <input type="text" id="val_17" name="val_17" placaholder="Latitude" onchange='save_(`17`,`val_17`)' name="lat" class='form-control' value="<?php echo $this->m_reff->tm_pengaturan(17);?>">
								 	    
								    </div>
								    <div class='col-md-6'> 
							 <input type="text" id="val_18" name="val_18"  placaholder="Longitude" onchange='save_(`18`,`val_18`)' name="lat" class='form-control' value="<?php echo $this->m_reff->tm_pengaturan(18);?>">
								 	    
								    </div>
								
								</td>
								</tr>
								 <tr>
								<td><?php echo $i++;?></td>
								<td>MAKSIMAL JARAK ABSEN (Km)</td>
								<td>
								     
							 <input type="text" id="val_19" name="val_19" placaholder="jarak absen (Km)" onchange='save_(`19`,`val_19`)' name="Jarakabsen"
							 class='form-control' value="<?php echo $this->m_reff->tm_pengaturan(19);?>">
								 	    
								   
								     
								</td>
								</tr>
								
							 </tr>
								 <tr>
								<td><?php echo $i++;?></td>
								<td>Key Firebase</td>
								<td>
								     
							 <input type="text" id="val_20" name="val_20" placaholder="Key Firebase" onchange='save_pengaturan(`20`,`val_20`)' name="Key"
							 class='form-control' value="<?php echo $this->m_reff->pengaturan(20);?>">
								 	    
								   
								     
								</td>
								</tr>
								
								
								
									  <tr>
								<td><?php echo $i++;?></td>
								<td>JAM KERJA</td>
								<td>
								    <div class='col-md-6'> 
							 <input type="text" id="val_4" name="val_4" placaholder="MAsuk" onchange='save_pengaturan(`4`,`val_4`)' name="masuk" class='form-control' value="<?php echo $this->m_reff->pengaturan(4);?>">
								 	    
								    </div>
								    <div class='col-md-6'> 
							 <input type="text" id="val_5" name="val_5"  placaholder="Pulang" onchange='save_pengaturan(`5`,`val_5`)' name="pulang" class='form-control' value="<?php echo $this->m_reff->pengaturan(5);?>">
								 	    
								    </div>
								
								</td>
								</tr>
								
								
									  <tr>
								<td><?php echo $i++;?></td>
								<td>ABSEN KBM </td>
								<td>
								    <div class='col-md-12'> 
						 <?php
						     $array["ya"]="Harus absen sebelum mengajar";
						 	 $array["tidak"]="Tidak harus absen untuk   mengajar";
						 echo form_dropdown("val_21",$array,$this->m_reff->pengaturan(21),"class='form-control' id='val_21'  onchange='save_pengaturan(`21`,`val_21`)' ");
						 ?>
								    </div>
								    
								
								</td>
								</tr>
								
								
									  <tr>
								<td><?php echo $i++;?></td>
								<td>SISTEM REALTIME KBM </td>
								<td>
								    <div class='col-md-12'> 
						 <?php
						     $array["ya"]="Realtime";
						 	 $array["tidak"]="Tidak Realtime";
						 	 $array["costume"]="Disesuaikan (jurusan)";
						 echo form_dropdown("val_22",$array,$this->m_reff->pengaturan(22),"class='form-control' id='val_22'  onchange='save_pengaturan(`22`,`val_22`)' ");
						 ?>
								    </div>
								    
								
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
	  
  
 function save_pengaturan(idpengaturan,idkonten)
	 {	 
	 var idkonten=$("[name='"+idkonten+"']").val();
		 $.ajax({
		 url:"<?php echo base_url()?>pengaturan/save_",
		 data: "tbl=pengaturan&idpengaturan="+idpengaturan+"&idkonten="+idkonten,
		 method:"POST",
		 success: function(data)
            {	 
				 notif_success("<span class='sadow white'><div class='demo-google-material-icon'> <i class='material-icons'>done_all</i> <span class='icon-name'>Tersimpan!</span>");
            }
		});
	 }
    
	
</script>


 