<?php
$this->db->where("id",$id=$this->input->post("id"));
$data=$this->db->get("data_tugas")->row();
 $awal=$data->expired;
  $judul=$data->judul;
   $ket=$data->ket;
     $metode=isset($data->metode_pengerjaan)?($data->metode_pengerjaan):"";
?>
<input type="hidden" name="id" value="<?php echo $data->id;?>">
									 <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Pilih Mapel</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                           	<div   >
                                          <?php 
									   $dbkelas=$this->m_reff->getMapelGuru();
									   $array="";
									   foreach($dbkelas as $val){
										   $array[$val->id_mapel]=$val->nama_tingkat." - ".$val->mapel;
									   }
									   echo form_dropdown("id_mapel",$array,$data->id_mapel,"disabled class='form-control show-tick id_kelas' id='id_mapel' onchange='pilihKelasbymapel()'");
									   ?>
                                    
                                </div>
                                        </div>
                                    </div>
                                </div>
						 
									
									
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
    $idm=$data->id_mapel;
    if(!$idm){ echo "<i>Mohon pilih mapel.</i>"; return false;}
     $mapel=$this->m_reff->getMapelSerupa($idm);
     $data=$this->db->query("select * from v_mapel_ajar where id_guru='".$this->mdl->idu()."' and 
     id_mapel IN(".$mapel.") and id_tahun='".$this->m_reff->tahun()."' and id_semester='".$this->m_reff->semester()."' ")->result();
    // $key[]="==== pilih ====";
     foreach($data as $val){
         $key[$val->id_kelas]=$val->kelas;
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
                                        <label for="email_address_2" class="col-black">Judul Tugas </label>
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
                                        <label for="email_address_2" class="col-black">PENGERJAAN </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <div class="form-group">
                                            <div class="form-line"  >
											   
											   <div class="demo-radio-button">
											       
											          <?php
											       if($metode==1){
											           $ceked2='checked=""';
											            $ceked1='';
											       }else{
											          $ceked1='checked=""';
											            $ceked2='';
											       }
											       ?>
											       
                                <input name="f[metode_pengerjaan]"  value="0" id="radio_31" class="with-gap radio-col-teal" <?php echo $ceked1;?> type="radio">
                                <label for="radio_31">TUGAS DI UPLOAD KE APLIKASI</label>
                                
                                 <input  name="f[metode_pengerjaan]" value="1" id="radio_30" class="with-gap radio-col-teal" <?php echo $ceked2;?> type="radio">
                                <label for="radio_30">TUGAS DIKUMPULKAN LANGSUNG</label>
                                     </div>
											   
											   
                                            </div>
                                        </div>
											
											
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
									<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Lampiran (Opsional) </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        	
												   <div class="form-group">
                                            <div class="form-line"  >
											  <input type="file" name="file" class='form-contol' accept="JPG,jpg,JPEG,PNG.png,docx,pdf,pptx,xlsx*">
												 
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

 

 
			 