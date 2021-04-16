  <?php   $dp=$this->m_reff->dataProfileSiswa($this->session->userdata("id")); ?>
  <div class="row clearfix">
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="body card"><center>
                       <?php 
                       if($dp->sts_un==1){
                           echo "<br><h4> SELAMAT ATAS KELULUSANNYA</h4> 
                          <a href='".base_url()."informasi_siswa/download_surat?id=".$dp->id."&api.whatsapp.com'> Download Surat Kelulusan</a><br>
                           ";
                       }elseif($dp->sts_un==2){
                             echo "<h4>MOHON MAAF ANDA DINYATAKAN TIDAK LULUS</h4>";
                       }else{
                            echo $dp->ket_un;
                       }
                       ?>
                       </center>
            </div>
     </div>
  </div>