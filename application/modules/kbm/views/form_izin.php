  <?php
  
 $visizin=$this->db->query("select * from tm_absen_guru where id_guru='".$this->mdl->idu()."' and substr(tgl,1,10)='".date('Y-m-d')."' and sumber='3' limit 1")->row();
   $izin=isset($visizin->izin)?($visizin->izin):"";
 
  ?>
  <div id="area_modal_artikel">
<form action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>kbm/insert_izin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="f[id_jadwal]" value="<?php echo $idjadwal;?>">
    <center class='col-teal'><h3>IZIN MENGAJAR</h3>
   <textarea id="izin" name="f[izin]" class="form-control" required placeholder="Tulis keterangan mengapa anda izin..." style="min-height:120px"><?php echo $izin;?></textarea>
  <!-- <div class="clearfix"><br></div>
   
   
   <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">Berlaku Izin </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
										<?php
  /* $array[1]="Hanya untuk jadwal saat ini saja";
    $array[2]="Untuk semua jadwal hari ini";
    $array=$array;
   echo form_dropdown("masa",$array,"","class='form-control'"); */
   ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
   --->
   
    
   <div class="clearfix"></div>
   <br>
    <?php
                                $mobil=$this->m_reff->mobile();
                                if($mobil){
                                    echo '	 <button class="btn bg-teal btn-block" onclick="submitForm(`modal_artikel`)"><i class="material-icons">save</i> SIMPAN</button>';
                                }else{
                                     echo '	 <center><button class="btn bg-teal " onclick="submitForm(`modal_artikel`)"><i class="material-icons">save</i> SIMPAN</button></center>';
                                }
                                ?>
   </center>
   
    </div>
    
    <script>
    $("#izin").focus();
        function reload_table()
        {
          getSumber(3);   
        }
    </script>