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
                            <h2>Pengaturan</h2>
                          
							 
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
								
								<tr>
								<td>1</td>
								<td>Kartu Ujian Siswa</td>
								<td>
								<?php
								$ray[0]="Tidak ditampilkan";
									$ray[1]="Ditampilkan";
								echo form_dropdown("val_19",$ray,$this->m_reff->pengaturan(19),"class='form-control' onchange='save_(`19`,`val_19`)' id='val_19' name='val_19'");
								?>
							
								
								</td>
								</tr>	
									<tr>
								<td>2</td>
								<td>Informasi Kelulusan Siswa kelas XII</td>
								<td>
								<?php
								$ray[0]="Tidak ditampilkan";
									$ray[1]="Ditampilkan";
								echo form_dropdown("val_18",$ray,$this->m_reff->pengaturan(18),"class='form-control' onchange='save_(`18`,`val_18`)' id='val_18' name='val_18'");
								?>
							
								
								</td>
								</tr>
						 	<tr>
								<td>2</td>
								<td>Kop Surat Kelulusan</td>
								<td>
								    <img height="50px" src="<?php echo base_url()?>file_upload/img/<?php echo $this->m_reff->pengaturan(11)?>"><br>
								<form name="form" action="<?php echo base_url()?>pengaturan/save_kelulusan" method="post" enctype="multipart/form-data">
								 <input type="file"   class="form-control" name="logo" onchange="this.form.submit()"  >
								  </form>
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
		 data: "idpengaturan="+idpengaturan+"&idkonten="+idkonten+"&tbl=pengaturan",
		 method:"POST",
		 success: function(data)
            {	 
				 notif_success("<span class='sadow white'><div class='demo-google-material-icon'> <i class='material-icons'>done_all</i> <span class='icon-name'>Tersimpan!</span>");
            }
		});
	 }
	  
 
    
	
</script>


 