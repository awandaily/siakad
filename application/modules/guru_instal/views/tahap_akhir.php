 <?php $cek=$this->mdl->cektahap(4);
 if(!$cek){
 echo "<div class='card'><center><h4> <br>TAHAP 4 BELUM SELESAI !! </h4> Mohon untuk menyelesaikan tahap 4 terlebih dahulu.</center></div>";
 return false;
 }
 ?>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Tahapan Akhir </h2>
                          
                        </div>
                       
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div>
                                Ini merupakan tahap akhir dimana semua proses bahan ajar untuk semester saat ini sudah dianggap selesai.
                              <br>
                                
                                <br>
						<center>	<button onclick="final()" class="btn  bg-indigo waves-effect">YA !! SUDAH SELESAI.</button>
						</center>
							</div>						
						</div>						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
  <script type="text/javascript">
  	  function final(){
		   
		   $.post("<?php echo site_url("guru_instal/finalin"); ?>",{},function(data){
			   if(data=="true")
			   {
				   notif("Pengaturan berhasil disimpan!!<br>");
				   window.location.href="<?php echo base_url()?>/jadwal";
			   }else{
				    notif("Gagal disimpan!!<br> Silahkakn periksa kembali data penjadwalan mengajar anda.");
			   }
			   
		      })
		 
	  };
	  
	</script>