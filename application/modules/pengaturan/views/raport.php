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
                            <h2>PROFILE   SEKOLAH UNTUK DI RAPORT</h2>
                          
							 
                        </div>
                        <div class="body">
                           <!----->
				 <div  >
                        <div >
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
								
									<th class='thead' >PROFILE </th>
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
								<td><?php echo $i++;    $idt=20;?></td>
								<td>NPSN</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
								</td>
								</tr> 
								
							  	<tr>
								<td><?php echo $i++;    $idt=21;?></td>
								<td>NIS/NSS/NDS</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
								</td>
								</tr> 
								
									<tr>
								<td><?php echo $i++;    $idt=22;?></td>
								<td>Alamat Sekolah Baris 1</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
								</td>
								</tr> 
								
									<tr>
								<td><?php echo $i++;    $idt=23;?></td>
								<td>Alamat Sekolah Baris 2</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
								</td>
								</tr> 
									<tr>
								<td><?php echo $i++;    $idt=24;?></td>
								<td>Alamat Sekolah Baris 3</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
								</td>
								</tr> 
								
									<tr>
								<td><?php echo $i++;    $idt=25;?></td>
								<td>Kelurahan</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
								</td>
								</tr> 
								
									<tr>
								<td><?php echo $i++;    $idt=26;?></td>
								<td>Kecamatan</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
								</td>
								</tr> 
								
									<tr>
								<td><?php echo $i++;    $idt=27;?></td>
								<td>Kab/kota</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
								</td>
								</tr> 
								
									<tr>
								<td><?php echo $i++;    $idt=28;?></td>
								<td>Provinsi</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
								</td>
								</tr> 
								
									<tr>
								<td><?php echo $i++;    $idt=14;?></td>
								<td>Website</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
								</td>
								</tr> 
								
									<tr>
								<td><?php echo $i++;    $idt=2;?></td>
								<td>Email</td>
								<td>
								 <input type="text" id="val_<?php echo $idt;?>" name="val_<?php echo $idt;?>" onchange='save_(`<?php echo $idt;?>`,`val_<?php echo $idt;?>`)'   class='form-control' value="<?php echo $this->m_reff->tm_pengaturan($idt);?>">
								 
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


 