<?php
	$idmapel=$this->input->post("idMapel");
	$idkelas=$this->input->post("idKelas");
	$idjadwal=$this->input->post("idJadwal");
		$data_jam=$jam=$this->input->post("jam");
		$jam_blok=$this->input->post("jam_blok");	
	 
     $data_jam=$this->input->post("idKelas");
     
     $idguru=$this->mdl->idu();
     
$this->db->where("id_jadwal",$idjadwal);
$this->db->where("tgl",date("Y-m-d"));
$this->db->where("id_guru",$idguru);
$this->db->where("kelas LIKE '%,".$idkelas.",%'");
$data=$this->db->get("data_tugas")->row();
 $awal=isset($data->expired)?($data->expired):"";
  $judul=isset($data->judul)?($data->judul):"";
   $ket=isset($data->ket)?($data->ket):"";
    $id_mapel=isset($data->id_mapel)?($data->id_mapel):"";
    $kelas=",".$idkelas.",";
    $metode=isset($data->metode_pengerjaan)?($data->metode_pengerjaan):"";
?>
<div id="area_modal_artikel">
<form action="javascript:submitFormNoResset('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>kbm/insert_tugas" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id=isset($data->id)?($data->id):"";?>">
<input type="hidden" name="id_kelas" value="<?php echo $idkelas;?>">
<input type="hidden" name="id_mapel" value="<?php echo $idmapel;?>">
<input type="hidden" name="f[id_jadwal]" value="<?php echo $idjadwal;?>">
<input type="hidden" name="f[tgl]" value="<?php echo date('Y-m-d');?>">
									 <div class="row clearfix">
									     <center class='col-teal'><h2>KIRIM TUGAS</h2></center>
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">MATE PELAJARAN</label>
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
									   echo form_dropdown("id_mapel_xx",$array,$id_mapel,"disabled class='form-control show-tick id_kelas' id='id_mapel' onchange='pilihKelasbymapel()'");
									   ?>
                                    
                                </div>
                                        </div>
                                    </div>
                                </div>
						 
									
									
							 <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">KELAS</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                           	<div >
                                           	    
                                           	    
                                           	    
                       <?php        
                $dbkelas=$this->m_reff->clearkomaray($kelas); 
                $select="";
                foreach($dbkelas as $val){
                    $select[]=$val;
                }
    $idm=$idmapel;
    if(!$idm){ echo "<i>Mohon pilih mapel.</i>"; return false;}
     $mapel=$this->m_reff->getMapelSerupa($idm);
     $data=$this->db->query("select * from v_mapel_ajar where id_guru='".$this->mdl->idu()."' and 
     id_mapel IN(".$mapel.") and id_tahun='".$this->m_reff->tahun()."' and id_semester='".$this->m_reff->semester()."' ")->result();
    
     foreach($data as $val){
         $key[$val->id_kelas]=$val->kelas;
     }
     $kelas=$key;
     echo form_dropdown("id_kelas_xx",$kelas,$select,"multiple class='form-control' disabled data-actions-box='true'");
 
		$mobile=$this->m_reff->mobile();
		if(!$mobile)
		 {
      echo "  	 <script>
         $('select').selectpicker();
         </script>";   	    
                      }    
                     
                      $akhir=date("Y-m-d");
      $selisih=$this->tanggal->selisih($akhir,$awal);     
      if(!$awal){
          $selisih="7";
      }
                      ?>             	    
                                           	    
                                           	    
                                           	     
                                
                                </div>
                                        </div>
                                    </div>
                                </div>

									  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Masa Pengerjaan </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="input-group input-group-sm">
                                
                                        <div class="form-line">
                                            <input type="number" style="padding-left:6px" name="hari" class="form-control" value="<?php echo $selisih;?>">
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
                                        <label for="email_address_2" class="col-black">Metode Pengerjaan Siswa </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
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
                                
                                 <input  name="f[metode_pengerjaan]" value="1" id="radio_30" class="with-gap radio-col-teal"  <?php echo $ceked2;?> type="radio">
                                <label for="radio_30">TUGAS DIKUMPULKAN LANGSUNG</label>
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
                                            <div class="form-line" style="border:#9E9E9E solid 1px;padding:7px" >
											  <input type="file" name="file" class='form-contol'  accept="JPG,jpg,JPEG,PNG.png,docx,pdf,pptx,xlsx*">
												 
                                    </div>
                                    </div>
                                    </div>
                                </div>
                                <br>
                                <?php
                                $mobil=$this->m_reff->mobile();
                                if($mobil){
                                    echo '	 <button class="btn bg-teal btn-block" onclick="submitFormNoResset(`modal_artikel`)"><i class="material-icons">save</i> SIMPAN</button>';
                                }else{
                                     echo '	 <center><button class="btn bg-teal " onclick="submitFormNoResset(`modal_artikel`)"><i class="material-icons">save</i> SIMPAN</button></center>';
                                }
                                ?>
								
							 
</form>
 </div>
 
 <script>
      function reload_table(){
     notif("Untuk absen siswa ada di menu riwayat KBM");
     }
 </script>
			 