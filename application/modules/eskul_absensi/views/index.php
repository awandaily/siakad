<div class="row clearfix">
               <?php
 //$cekfinger=$this->mdl->cekfinger();
 //if(!$cekfinger)
//{
//	echo "<div class='col-md-12'> ";
//	echo "<div class='card col-md-12'><br><center><i>Anda belum melakukan fingerprint <br> Silahkan untuk melakukan fingerprint terlebih dahulu</i></center></div></div>";
//	return false;
//}
 
			   ?>
              					<?php
									$data=$this->db->get_where("eskul_group",array("id_eskul"=>$this->mdl->ids()))->result();$no=1;
									foreach($data as $val){?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="info-box bg-teal menuclick hover-expand-effect cursor" href="<?php echo base_url()?>eskul_absensi/absen/<?php echo $val->id?>" onclick="absen(`<?php echo $val->id?>`)">
                        <div class="icon">
                            <i class="material-icons">fingerprint</i>
                        </div>
                        <div class="content">
                            <div class="text">ABSEN KEHADIRAN</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">
							<?php echo $val->nama;?></div>
                        </div>
                    </div>
                </div>
									<?php } ?>
                                    

  </div>					
						
						
						
 