 
                            <!-- Nav tabs -->
                         
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane animated flipInY   active" id="home_with_icon_title">
 
                                    <p>
                                        <div class="col-md-12">
										<div class="col-md-3"  > 
									<center>	 
									
									<?php
									$link=$this->m_reff->poto_siswa($data->id);
									?>														
										<img  alt="<?php echo $data->nama;?>" 
										class="img-responsive thumbnail" width="100%" style="max-height:190px" 
										src="<?php echo $link;?>">
	
										</div>
									</center>
									<div class="col-md-9 entry"> 



								<table class="table-hover">
                                    
                                    <tbody class="col-black">
									<tr class="bg-teal col-white">
  <td colspan="2"> <b>DATA PROFILE</b> </td>
  </tr>
                                         <tr>
                                            <td>NAMA</td>
                                            <td><?php echo $data->nama_lengkap;?></td>
                                        </tr> <tr>
                                            <td>GENDER</td>
                                            <td><?php echo $this->m_reff->gofield("tr_jk","nama","where id='".$data->jk."'");?></td>
                                        </tr> 
										<tr>
                                            <td>T/T/L</td>
                                            <td><?php echo $data->tempat_lahir.", ".$this->tanggal->ind($data->tgl_lahir,"/");?></td>
                                        </tr> 
										<tr>
                                            <td>AGAMA </td>
                                            <td><?php echo $this->m_reff->gofield("tr_agama","nama","where id='".$data->id_agama."'");?></td>
                                        </tr>
										<tr>
                                            <td>ID/NIP </td>
                                            <td><?php echo $data->nip;?></td>
                                        </tr>
										<tr>
                                            <td>HP </td>
                                            <td><?php echo $data->hp;?></td>
                                        </tr>
                                       <tr>
                                            <td>E-MAIL </td>
                                            <td><?php echo $data->email;?></td>
                                        </tr> 
                                    </tbody>
                                </table>
								






										</div>
										
									
										
										
 <div class="col-md-12 entry">	
 <table>
  <tbody  class="col-black">
  <tr class="bg-teal col-white">
  <td colspan="2"> <b>DATA PROFILE </b> </td>
  </tr>
                                         <tr>
                                            <td>ALAMAT</td>
                                            <td><?php echo $data->alamat?></td>
                                        </tr>
										<tr>
                                            <td>TMT  </td>
                                            <td><?php echo $this->tanggal->ind($data->tmt,"-")?></td>
                                        </tr><tr>
                                            <td>STATUS KEPEGAWAIAN</td>
                                            <td><?php echo $data->sts_kepegawaian;?></td>
                                        </tr> 
										<tr>
                                            <td>IJAZAH</td>
                                            <td><?php echo $this->m_reff->gofield("tr_ijazah","nama","where id='".$data->id_ijazah."'");?></td>
                                        </tr> 
										 
										<tr>
                                            <td>JABATAN</td>
                                            <td><?php echo $this->m_reff->gofield("tr_jabatan","nama","where id='".$data->id_jabatan."'");?></td>
                                        </tr>  
                                    </tbody>
 </table>	
 </div>
 
	
	</div>
										
                                    </p>
                                </div>
                              
                              
							
           