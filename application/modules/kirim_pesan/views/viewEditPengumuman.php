<?php
$this->db->where("id",$id=$this->input->post("id"));
$data=$this->db->get("data_pengumuman")->row();
 $awal=$data->expired;
  $judul=$data->judul;
   $ket=$data->ket;
?>
<input type="hidden" name="id" value="<?php echo $data->id;?>">
								 
									
									
							 <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Pilih Kelas</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                           	<div >
                                           	    
                                           	    
                                           	    
                       <?php        
                $kelas=$this->m_reff->clearkomaray($data->kelas); 
                $select="";
                foreach($kelas as $val){
                    $select[]=$val;
                }
    
    
     $data=$this->mdl->dataKelasAjar();
    // $key[]="==== pilih ====";
    $key="";
     foreach($data as $val){
         $key[$val->id_kelas]=$val->nama_kelas;
     }
     $kelas=$key;
     echo form_dropdown("id_kelas[]",$kelas,$select,"multiple class='form-control' data-actions-box='true'");
 
		$mobile=$this->m_reff->mobile();
		if(!$mobile)
		 {
      echo "  	 <script>
         $('select').selectpicker();
         </script>";   	    
                      }    
                     
                      $akhir=date("Y-m-d");
      $selisih=$this->tanggal->selisih($akhir,$awal);              
                      ?>             	    
                                           	    
                                           	    
                                           	     
                                
                                </div>
                                        </div>
                                    </div>
                                </div>

									  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Masa Berlaku</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="input-group input-group-sm">
                                
                                        <div class="form-line">
                                            <input type="number" name="hari" class="form-control" value="<?php echo $selisih;?>">
                                        </div>
                                        <span class="input-group-addon">Hari</span>
                                    </div>
                                    </div>
                                    
                                     
                                </div>

							 
					 
								
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Judul Informasi </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <input type="text" class="form-control" required name="f[judul]" value="<?php echo $judul;?>"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Keterangan </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <textarea class="form-control" required name="f[ket]"><?php echo $ket;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
									<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Upload File (Opsional) </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        	
												   <div class="form-group">
                                            <div class="form-line"  >
											  <input type="file" name="file" class='form-contol' accept="JPG,jpg,JPEG,PNG.png,docx,pdf,pptx,xlsx,zip,rar,RAR,ZIP">
												 
                                    </div>
                                    </div>
                                    </div>
                                </div>
									 
									 <script>
  function pilsiswa()
 {
	  var idk=$("[name='f[id_kelas]']").val();
			$.post("<?php echo site_url("kirim_tugas/getSiswa"); ?>",{idk:idk},function(data){
			  $("#data_siswa").html(data);
		      }); 
 }
 function pilihKelasbymapel()
 {
     var idm=$("[name='id_mapel']").val();
			$.post("<?php echo site_url("kirim_tugas/getKelasByMapel"); ?>",{idm:idm},function(data){
			  $("#pilihKelas").html(data);
		      }); 
 }
 
 </script>
		
		<?php
		$mobile=$this->m_reff->mobile();
		if(!$mobile)
		{?>
	 <script>
 $('select').selectpicker();
 </script>
			 	    
<?php		}
?>

 

 
			 