<style>
.upload{
border:#DCDCDC dashed 1px;
}
label{
color:black;}
</style>
<?php
  $k_biodata=$this->m_reff->kelengkapan_biodata();
   $k_berkas=$this->m_reff->kelengkapan_berkas();

?>
<?php $sts=$this->m_reff->goField("tm_peserta","sts","where id='".$this->session->userdata("id")."'");	  ?> 
              <!-- Validation Stats -->
            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card"  >
                        <div class="header">
                            <h2>
							<?php 
							
							if($sts!=1)
							{?>
                              STATUS PENDAFTARAN
							<?php }else{?> ANDA TELAH MENYELASIKAN PENDAFTARAN <?php } ?>
                            </h2>
                            
                        </div>
                        <div class="body">
					<?php	if($sts==0)
							{?>
                           <b>PERINGATAN :</b><br>
						   1. Silahkan cek ulang data dan berkas yang anda upload dan pastikan sudah sesuai.<br>
						   2. Jika anda sudah yakin dengan data anda silahkan klik tombol <b>SELESAIKAN PENDAFTARAN</b> dibawah ini.<br>
						   3. Data anda tidak dapat diedit/ubah setelah anda mengklik tombol <b>SELESAIKAN PENDAFTARAN</b>.<br>
						   4. Dihimbau agar selalu memeriksa akun anda secara rutin karena bisa saja panitia membatalkan pengajuan anda tanpa pemberitahuan.<br>
						   <?php }?>
						   
						   <center>
						   <?php 
							
							if($sts==0){?>
							<hr>
							<button id="tombol1" onclick="ajukan()" type="button" class="btn btn-primary  waves-effect">
											<i class="material-icons">assignment_returned</i>
											<span>SELESAIKAN PENDAFTARAN SEKARANG</span>
										</button>
							<?php } else{?>
									<button  id="tombol2"  href="<?php echo base_url()?>informasi" type="button" class="menuclick btn btn-success  waves-effect">
											<i class="material-icons">offline_pin</i>
											<span>ANDA TELAH MENYELASIKAN PENDAFTRAN, UNTUK INFORMASI SELENGKAPNYA MOHON AKSES MENU INFORMASI </span>
										</button>
							<?php } ?>

										
										
										
							</center>	
                        </div>
                    </div>
                </div>
            </div>               				
 
		  

<script>
  function ajukan()
  {
      if(<?php echo $k_biodata ?>==false)
      {
            notif("<center>Anda belum dapat mengajukan permohonan dikarenakan inputan biodata anda belum lengkap.</center>");
        //  setTimeout(function(){  window.location.href="<?php echo base_url()?>data_profile/index";  },9000);
      }else if(<?php echo $k_berkas ?>==false)
      {
         notif("<center>Anda belum dapat mengajukan permohonan dikarenakan upload persyaratan anda belum lengkap.</center>");
      //   setTimeout(function(){  window.location.href="<?php echo base_url()?>data_profile/berkas"; },9000);
      }else{
          go_ajukan();
      }
  }
  
  function go_ajukan(){
		   alertify.confirm("<center>Setelah ini  anda tidak dapat merubah kembali data anda.<br> <span class='font-bold col-pink'>SELESAIKAN PENDAFTARAN?</center>",function(){
		   $.post("<?php echo site_url("ajukan/update"); ?>",function(){
			   $("#tombol1").hide();
			   $("#tombol2").show();
			   notif("Data anda telah terkirim!");
		      })
		   })
	  };

</script>
 