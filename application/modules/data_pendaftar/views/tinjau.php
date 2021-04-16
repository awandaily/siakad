 <div class="modal-body"> 

   <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" align="justify" style="scrol" >
							  <div class="row clearfix scroll" style="margin-top:-20px">
                                 <!---->
								 
                        
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">account_box</i> BERKAS
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">face</i> BIODATA
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#messages_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">email</i> PROFIL PEKERJAAN
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#settings_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">home</i> PEMINATAN
                                    </a>
                                </li>
								<li role="presentation">
                                    <a href="#settings_with_icon_title2" data-toggle="tab">
                                        <i class="material-icons">info</i> STATUS PENDAFTARN
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                                    
                                    <p>
                                       <div class="demo-gallery" >
										<ul id="lightgallery" class="list-unstyled row" style="width:100%">
						<?php
						 $this->db->where("id_persyaratan",$data->posisi_peminatan);
						 $dataray=$this->db->get("tm_upload")->result(); 
						 foreach($dataray as $val)
						 {	
						 $file=$this->m_reff->goField("tm_data_upload","nama_file","where id_persyaratan='".$val->id_persyaratan."' 
						and id_upload='".$val->id."' and id_admin='".$data->id."' ");
						
						?>	<li class="col-xs-6 col-sm-4 col-md-3"  
									 data-src="<?php echo base_url()?>file_upload/peserta/<?php echo sprintf("%06s",$data->id);?>/<?php echo $file;?>" 
									 data-sub-html=" 
									 <h2><?php echo $val->nama;?></h2>">
										<a href="">
											<img width="400px" class="img-responsive thumbnail" 
											src="<?php echo base_url()?>file_upload/peserta/<?php echo sprintf("%06s",$data->id);?>/<?php echo $file;?>">
										</a>
									</li>
						 <?php } ?>	
										</ul>
										</div>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                    <p>
                                       <table class="table table-striped" style='color:black'>
									   <tr><td>Nama Lengkap</td><td>:</td><td><?php echo $data->nama?></td></tr>
									   <tr><td>Jenis Kelamin</td><td>:</td><td><?php echo $this->m_reff->goField("tr_jk","nama","where id='".$data->jk."'");?></td></tr>
									   <tr><td>Hp</td><td>:</td><td><?php echo $data->hp?></td></tr>
									   <tr><td>E-mail</td><td>:</td><td><?php echo $data->email?></td></tr>
									   <tr><td>T/T/L</td><td>:</td><td><?php echo $data->tempat_lahir?>, <?php echo $this->tanggal->ind($data->tgl_lahir,"/");?></td></tr>
									  <tr><td>Provinsi</td><td>:</td><td><?php echo $this->m_reff->goField("provinsi","nama","where id_prov='".$data->idprov."'");?></td></tr>
									   <tr><td>Kab/Kota</td><td>:</td><td><?php echo $this->m_reff->goField("kabupaten","nama","where  id_prov='".$data->idprov."' AND id_kab='".$data->idkab."' ");?></td></tr>
									   <tr><td>Kecamatan</td><td>:</td><td><?php echo $this->m_reff->goField("kecamatan","nama","where  id_kab='".$data->idkab."' and id_kec='".$data->idkec."'  ");?></td></tr>
									   <tr><td>Keluruhan</td><td>:</td><td><?php echo $this->m_reff->goField("kelurahan","nama","where  id_kec='".$data->idkec."' and id_kel='".$data->idkel."' ");?></td></tr>
									  <tr><td>Alamat</td><td>:</td><td><?php echo $data->alamat_peserta;?></td></tr>
									  </table>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                              
                                    <p>
                                       <table class="table table-striped" style='color:black'>
									   <tr><td>Tempat Tugas</td><td>:</td><td><?php echo $data->tempat_tugas?></td></tr>
									   <tr><td>Jabatan</td><td>:</td><td><?php echo $this->m_reff->goField("tr_kategory","nama","where id='".$data->jabatan."'")?></td></tr>
									   <tr><td>Mapel Yang Diampu</td><td>:</td><td><?php echo $data->mapel_yg_diampu;?></td></tr>
									   </table>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                                    <p>
                                       <table class="table table-striped" style='color:black'>
									   <tr><td>Madrasah Peminatan</td><td>:</td><td><?php echo $this->m_reff->goField("admin","owner","where id_admin='".$data->madrasah_peminatan."'")?></td></tr>
									   <tr><td>Posisi Peminatan</td><td>:</td><td><?php echo $this->m_reff->goField("tr_kategory","nama","where id='".$data->posisi_peminatan."'")?></td></tr>
									  </table>
                                    </p>
                                </div>

								<div role="tabpanel2" class="tab-pane fade" id="settings_with_icon_title2">
                                    <p>
                                       <table class="table table-striped" style='color:black'>
									   <tr><td>STATUS  PENDAFTARAN</td><td>:</td><td><?php echo $this->m_reff->goField("tr_status","nama","where id='".$data->sts."'")?></td></tr>
									   <tr><td>KETERANGAN</td><td>:</td><td><?php echo $data->alasan;?></td></tr>
									  </table>
								 
									  <?php 
									  $level=$this->session->userdata("level");
									  if($level=="admin")
									  {
										     $ps=$data->alias;
											 $ps=substr($ps,0,-2);
											 $ps=substr($ps,2);
										  ?>
										  
						<div class="col-md-6 col-md-offset-3 card">
						<center><b><h4>DATA AKUN</h4></b></center>
					 
						<hr>
						<form id="f_formSubmit" action="javascript:save_profile('formSubmit')" method="post" url="<?php echo base_url("profile/updatePeserta");?>">
                       <center>   
					 
							  
						  
								<div class="form-group form-float success">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="f[username]" value="<?php echo $data->username;?>" required>
                                        <label class="form-label">Username</label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" name="password" value="<?php echo $ps;?>" >
                                        <input type="hidden"  name="id" value="<?php echo $data->id;?>" >
                                        <label class="form-label">Password baru</label>
                                    </div>
                                </div>
<center>
								<div class="form-group form-float">
                                     
                                        <button onclick="save_profile('formSubmit')" class="btn btn-primary" ><i class="material-icons">save</i> Simpan</button>
                                    <span class="pull-right" id="msg"></span>
                                    
                                </div>
        </center>                         
                            </form>
							</div>
										  
									<?php  }
									  ?>
                                    </p>
                                </div>
								
                            </div>
                           
                                 <!---->
                                </div> 
   </div> 
 
 
<div class="clearfix"></div>
<!--
    <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                         <button  class="btn bg-red waves-effect" onclick="saveModalArtikel('modal_artikel')" ><i class="material-icons">delete_forever</i> Hapus</button>
                                         <button  class="btn bg-teal waves-effect" onclick="saveModalArtikel('modal_artikel')" ><i class="material-icons">pan_tool</i> Tolak</button>
                                         <button  class="btn bg-pink waves-effect" onclick="saveModalArtikel('modal_artikel')" ><i class="material-icons">near_me</i> Terbitkan</button>
                                    </div>
                        </div>-->
						
						 </div>
						 
						 
<script type="text/javascript">
            $('#lightgallery').lightGallery();
			
		 
			 
</script>						 