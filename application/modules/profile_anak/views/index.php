  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <center>
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35 col-yellow sadow"><center>PROFILE ANAK</center></div> 
                         <center><br><br>
						 <img alt="<?php echo $data->nama;?>" class="img-responsive thumbnail" style="max-height:100px" 
						 src="<?php echo base_url()?>file_upload/siswa/<?php echo str_replace("/","_",$data->tahun_masuk)?>/<?php echo $data->id;?>/<?php echo $data->poto;?>">
					<p style="margin-top:-13px" class='sadow'>	<?php echo $data->nama;?></p>
				 
						</center>
                        </div>
                    </div>
					</center>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35 col-yellow sadow">DATA PROFILE</div>
                            <ul class="dashboard-stat-list">
							<li  class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> GENDER
                                    <span class="pull-right"><b><?php echo $this->m_reff->gofield("tr_jk","nama","where id='".$data->jk."'");?></b>  </b></span>
                                </li>
                                 <li  class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> T/T/L
                                    <span class="pull-right"><b><?php echo $data->tempat_lahir.", ".$this->tanggal->ind($data->tgl_lahir,"/");?></b>  </b></span>
                                </li>
                                <li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> AGAMA
                                    <span class="pull-right"><b><?php echo $data->agama;?></b> </b> </span>
                                </li>
								<li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> NISN
                                    <span class="pull-right"><b><?php echo $data->nisn;?></b> </b> </span>
                                </li>
								<li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> KELAS
                                    <span class="pull-right"><b><?php echo $data->nama_kelas;?></b> </b> </span>
                                </li><li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> HP
                                    <span class="pull-right"><b><?php echo $data->hp;?></b> </b> </span>
                                </li><li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> EMAIL
                                    <span class="pull-right"><b><?php echo $data->email;?></b> </b> </span>
                                </li><li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> TAHUN MASUK
                                    <span class="pull-right"><b><?php echo $data->tahun_masuk;?></b> </b> </span>
                                </li>
								
								
                            </ul>
                        </div>
                    </div>
  </div>
  
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35 col-yellow sadow">PROFILE ORANG TUA</div>
                            <ul class="dashboard-stat-list">
							<li  class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> NAMA AYAH
                                    <span class="pull-right"><b> <?php echo $data->nama_ayah;?> </b>  </b></span>
                                </li>
                                 <li  class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> PEKERJAAN
                                    <span class="pull-right"><b><?php echo $data->pekerjaan_ayah?></b>  </b></span>
                                </li>
                                <li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> NAMA IBU
                                    <span class="pull-right"><b><?php echo $data->nama_ibu;?></b> </b> </span>
                                </li>
								<li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> PEKERJAAN
                                    <span class="pull-right"><b><?php echo $data->pekerjaan_ibu;?></b> </b> </span>
                                </li>
								<li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> PENGHASILAN
                                    <span class="pull-right"><b><?php echo $data->penghasilan;;?></b> </b> </span>
                                </li><li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> TELP
                                    <span class="pull-right"><b><?php echo $data->hp_ayah."/".$data->hp_ibu;?></b> </b> </span>
                                </li><li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> ALAMAT
                                    <span class="pull-right"><b><?php echo $data->alamat_ortu;?></b> </b> </span>
                                </li> 
								
								
                            </ul>
                        </div>
                    </div>
  </div>
  
   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35 col-yellow sadow">RIWAYAT PENDIDIKAN ANAK & DATA WALI </div>
                            <ul class="dashboard-stat-list">
							<li  class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> ASAL SD
                                    <span class="pull-right"><b> <?php echo $data->asal_sd;?> </b>  </b></span>
                                </li>
                                 <li  class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> LULUS
                                    <span class="pull-right"><b><?php echo $data->tahun_lulus_sd;?></b>  </b></span>
                                </li>
                                <li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> ASAL SMP
                                    <span class="pull-right"><b><?php echo $data->asal_smp;?></b> </b> </span>
                                </li>
								<li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> LULUS
                                    <span class="pull-right"><b><?php echo $data->tahun_lulus_smp;?></b> </b> </span>
                                </li>
								<li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> NAMA WALI MURID
                                    <span class="pull-right"><b><?php echo $data->nama_wali;?></b> </b> </span>
                                </li><li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> KONTAK
                                    <span class="pull-right"><b><?php echo $data->hp_wali;?></b> </b> </span>
                                </li><li class='sadow' style='border-bottom:white dashed 1px'>
                                   <b> HUBUNGAN
                                    <span class="pull-right"><b><?php echo $data->hubungan;?></b> </b> </span>
                                </li> 
								
								
                            </ul>
                        </div>
                    </div>
  </div>
  
    
 	