 <?php $i = 0;
  $dp = $this->m_reff->dataProfileSiswa($this->session->userdata("id")); ?>
 <div class="row clearfix" style="margin-top:-10px">
   <!-- Task Info -->
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     <div>


       <?php
        $idkelas = $dp->id_kelas;
        $pub = $this->m_reff->pengaturan(18);
        $id_tk = $this->m_reff->goField("tm_kelas", "id_tk", "where id='" . $idkelas . "'");
        if ($id_tk == 3 and $pub == 1) {
          $i = 1;
        ?>

         <center><b>INFORMASI KELULUSAN</b><br>
           <?php
            if ($dp->sts_un == 1) {
              echo "<br><h4> SELAMAT ATAS KELULUSANNYA</h4> 
                          <a href='" . base_url() . "informasi_siswa/download_surat?id=" . $dp->id . "&api.whatsapp.com'> Download Surat Kelulusan</a><br>
                           ";
            } elseif ($dp->sts_un == 2) {
              echo "<h4>MOHON MAAF ANDA DINYATAKAN TIDAK LULUS</h4>";
            } else {
              echo $dp->ket_un;
            }
            ?>
         </center>

       <?php } ?>



       <?php
        $this->db->order_by("_ctime", "DESC");
        $this->db->where("expired>=", date('Y-m-d'));
        $this->db->or_where("kelas", "all");
        $this->db->where("kelas LIKE '%," . $this->mdl->id_kelas() . ",%' ");
        $data = $this->db->get("data_pengumuman")->result();
        foreach ($data as $val) {
          $i = 1;
          if ($val->file) {
            $file = '<ol class="breadcrumb breadcrumb-col-teal">
                                <li> <i class="material-icons">attachment</i> 
		    <a download="" href="' . base_url() . 'file_upload/pengumuman/' . $val->file . '?download=true" class="col-pink">   Download lampiran </a></li>
                                 
                                
                            </ol>';
          } else {
            $file = "";
          }
          if ($val->kelas == "all") {
            $nama = "";
          } else {
            if ($val->id_guru == "0") {
              $xguru = "ADMIN SISMASTER";
            } else {
              $xguru = $this->m_reff->goField("v_pegawai", "nama_lengkap", "where id='" . $val->id_guru . "' ");
            }
            $nama = ' <span class="col-orange font-bold">' . $xguru . '</span>';
          }
          echo '<div class="card" style="border:black solid 1px">
                        <div class="header bg-white">
                        <b style="font-size:14px" class="col-teal"> ' . $val->judul . '</b> <br>
                       ' . $nama . '
                        </div>
                        <div class="bodyx" style="padding:10px">
                       ' . $val->ket . $file . '
                        </div>
        
               
                    </div>';
        }
        ?>




       <?php
        if ($i < 1) {
          echo "<center><b>Tidak ada Pengumuman.</b></center>";
        }
        ?>


     </div>
   </div>

   <?php
    $this->db->where("kode", "lnd");
    $x = $this->db->get("kelulusan_setting")->row_array();

    $this->db->where("nis", $this->session->userdata("id"));
    $l = $this->db->get("kelulusan")->row_array();

    $xx = isset($x['open_kelulusan']) ? ($x['open_kelulusan']) : 0;
    $ll = isset($l['status']) ? ($l['status']) : 0;


    if ($xx == "1") {
      if ($ll == "2") {
        $link = "<center><h2 style='color:red'>KELULUSAN ANDA DITAHAN, SILAHKAN HUBUNGI PIHAK SEKOLAH</h2></center>";
      } else {
        $link = "<center><a target='_blank' href='" . base_url() . "informasi_siswa/print_kelulusan/" . $ll . 'nis' . "' class='btn bg-teal waves-effect'>DOWNLOAD SURAT KELULUSAN</a></center>";
      }
    } else {
      $link = "<center><h2>KELULUSAN BELUM DIBUKA</h2></center>";
    }

    ?>


 </div>

 <div class="row">
   <div class="col-md-12">
     <div class="card" style="border:black solid 1px">
       <div class="header bg-white">
         <b style="font-size:14px" class="col-teal">PENGUMUMAN KELULUSAN TAHUN 2019/2020</b><br />
         Silahkan klik link download berikut untuk Surat Kelulusan Anda.
       </div>
       <div class="bodyx" style="padding:10px">
         <?php echo $link; ?>
       </div>
     </div>
   </div>
 </div>