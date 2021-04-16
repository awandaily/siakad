 <?php 
 $idu=$this->session->userdata("id");
 $info=$this->m_reff->goField("tm_pengaturan","val","where id='1'");
 $sts=$this->m_reff->goField("tm_peserta","sts","where id='".$idu."'");
 $datapeserta=$this->db->query("select * from tm_peserta where id='".$this->session->userdata("id")."'")->row();
 $k_berkas=$this->m_reff->kelengkapan_berkas();
 $k_biodata=$this->m_reff->kelengkapan_biodata();
 
 if($k_berkas=="false")
 {
	 $sts_berkas="BELUM LENGKAP";
 }else{
	 $sts_berkas="LENGKAP";
 } 
 
 if($k_biodata=="false")
 {
	 $sts_biodata="BELUM LENGKAP";
 }else{
	 $sts_biodata="LENGKAP";
 }
 
 
 if($sts==0)
 {
	 $stspendaftaran="BELUM SELESAI";
 }else
 {
	   $stspendaftaran=$this->m_reff->goField("tr_status","nama","where id='".$sts."'");
 }
 ?>
         <div  >
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-teal">
                            <i class="material-icons">assignment_ind</i>
                        </div>
                        <div class="content">
                            <div class="text">STATUS INPUTAN BIODATA</div>
                            <div><b><?php echo $sts_biodata;?></b></div>
							
                        </div>
                    </div>
                </div>
				
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-blue">
                            <i class="material-icons">description</i>
                        </div>
                        <div class="content">
                            <div class="text">STATUS KELENGKAPAN BERKAS</div>
                            <div><b><?php echo $sts_berkas;?></b></div>
                        </div>
                    </div>
                </div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-red">
                            <i class="material-icons">mouse</i>
                        </div>
                        <div class="content">
                            <div class="text">STATUS PENDAFTARAN</div>
                            <div><b><?php 
                            if($sts>1)
                            {
                             
                             if($info==1){ echo $stspendaftaran; }else{ echo "Menunggu Pengumuman";};
                             
                             }else{
                                 echo $stspendaftaran;
                             }?></b></div>
                        </div>
                    </div>
                </div>
               
            </div>
               
 
  
		 
				</i></b>
           <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12  ">
                    <div class="card">
                        <div class="header">
                            <h2>LANGKAH-LANGKAH PENDAFTARAN </h2>
                            
                        </div>
                        <div class="body">
                        1. Lengkapi inputan biodata pada menu <b class="col-blue"><a href="<?php echo base_url()?>data_profile">BIODATA</a>.</b><br>
						2. Upload berkas pada menu <b class="col-blue"><a href="<?php echo base_url()?>data_profile/berkas">UPLOAD BERKAS</a>.</b><br>
						3. Akses menu <b class="col-blue"><a href="<?php echo base_url()?>ajukan">SELESAIKAN PENDAFTRAN</a>.</b>
						<hr>
						
                        </div>
						
                    </div>
              </div> 
			  
			  
           
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                    <div class="card">
                        <div class="header">
                            <h2>PENGUMUMAN</h2>
                        </div>
                        <div class="body">
                             
                             <!---->
							 <?php
							 
							 if($this->m_reff->goField("tm_peserta","alasan","where id='".$idu."'"))
							 {
							      $ket="<i> Keterangan: ".$this->m_reff->goField("tm_peserta","alasan","where id='".$idu."'")."</i>";
							 }else{
							     $ket="";
							 }
							 
							 if($sts<2)
							 {
								 
								  if($this->m_reff->goField("tm_peserta","alasan","where id='".$idu."'") and $sts==0)
							 {
							     echo  $ket="<center><p class='col-red' style='font-size:20px;text-decoration:underline'> ".$this->m_reff->goField("tm_peserta","alasan","where id='".$idu."'")."</p></center>";
							 }else{
							    echo $this->m_reff->goField("tm_pengaturan","val","where id='3'");
							 }
							 
							     
							  }elseif($sts!=3)
							 {  
								   if($info==1){
									echo "<center>Selamat anda dinyatakan <br> <h4 class='col-green'>
									<u>".$this->m_reff->goField("tr_status","nama","where id='".$sts."'")."</u></h4>
									<p class='col-orange'>
									
									 $ket 
									
									</p>
									
									</center>
								<hr>	";
									 $echo=$this->m_reff->goField("tm_pengaturan","val","where id='2'");
									 $loktes=$this->m_reff->goField("admin","lokasi_test","where id_admin='".$datapeserta->madrasah_peminatan."'");
									 $tgltes=$this->m_reff->goField("admin","tgl_test","where id_admin='".$datapeserta->madrasah_peminatan."'");
									 $jamtes=$this->m_reff->goField("admin","jam_test","where id_admin='".$datapeserta->madrasah_peminatan."'");
									  $echo=str_replace("{lokasi_test}",$loktes,$echo);
									  $echo=str_replace("{tgl_test}",$tgltes,$echo);
									echo  $echo=str_replace("{jam_test}",$jamtes,$echo);
									
									if($sts=="2")
						{							
						   echo "<a class='btn btn-block  bg-pink' href='".base_url()."informasi/cetak/?oreg=".$datapeserta->reg."&idu=".$idu."'
									  target='new'>
									<i class='material-icons'>credit_card</i>
									DOWNLOAD KARTU TEST</a>";
						}
									
								  }else{
									  echo $this->m_reff->goField("tm_pengaturan","val","where id='3'");  
								   }
						
							}elseif($sts==3)
							 {  
								   if($info==1){
									echo "<center>Maaf Pendaftaran Anda dinyatakan <br> <h4 class='col-red'><u>TIDAK LULUS </u></h4><p class='col-orange'>
									<i>".$this->m_reff->goField("tm_peserta","alasan","where id='".$idu=$this->session->userdata("id")."'")."</i></p>
									</center><hr>";
									 echo $this->m_reff->goField("tm_pengaturan","val","where id='4'");
								   }else{
									  echo $this->m_reff->goField("tm_pengaturan","val","where id='3'");  
								   }
						   
						   
							}else{?>
							 <?php echo $this->m_reff->goField("tm_pengaturan","val","where id='3'");?> 
							<?php }?>
							  
                                   
                             <!---->
                         
                        </div>
                    </div>
                </div>
                