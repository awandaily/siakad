 
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active sound">
                                    <a href="#home_with_icon_title" data-toggle="tab"  class="sound">
                                        <i class="material-icons">account_circle</i> PROFILE
                                    </a>
                                </li>
                                 
                                <li role="presentation" >
                                    <a href="#absensi" data-toggle="tab" class="sound"  >
                                        <i class="material-icons">fingerprint</i>   ABSENSI
                                    </a>
                                </li>
                                <li role="presentation"  class="sound">
                                    <a href="#keuangan" data-toggle="tab"  >
                                        <i class="material-icons">receipt</i> KEUANGAN
                                    </a>
                                </li>
							<!--	<li role="presentation">
                                    <a href="#thumb_up" data-toggle="tab"   class="sound" >
                                        <i class="material-icons">thumbs_up_down</i> CATATAN PENILIAN
                                    </a>
                                </li>-->
							 
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane animated flipInY   active" id="home_with_icon_title">
 
                                    <p>
                                        <div class="col-md-12">
										<div class="col-md-3" style="border:black solid 1px;height:100%"> 
									<center>	<p  class="col-black"><b><?php echo $data->nama;?></b></p>
									
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
                                            <td>GENDER</td>
                                            <td><?php echo $this->m_reff->gofield("tr_jk","nama","where id='".$data->jk."'");?></td>
                                        </tr> 
										<tr>
                                            <td>T/T/L</td>
                                            <td><?php echo $data->tempat_lahir.", ".$this->tanggal->ind($data->tgl_lahir,"/");?></td>
                                        </tr> 
										<tr>
                                            <td>AGAMA </td>
                                            <td><?php echo $data->agama;;?></td>
                                        </tr>
										<tr>
                                            <td>NISN </td>
                                            <td><?php echo $data->nis;?></td>
                                        </tr>
										<tr>
                                            <td>KELAS </td>
                                            <td><?php echo $data->nama_kelas;?></td>
                                        </tr>
                                        <tr>
                                            <td>HP </td>
                                            <td><?php echo $data->hp;?></td>
                                        </tr><tr>
                                            <td>E-MAIL </td>
                                            <td><?php echo $data->email;?></td>
                                        </tr><tr>
                                            <td>TAHUN MASUK </td>
                                            <td><?php echo $data->tahun_masuk;?></td>
                                        </tr>
                                    </tbody>
                                </table>
								






										</div>
										
									
										
										
									<div class="col-md-6 entry">	
										<table>
  <tbody  class="col-black">
  <tr class="bg-teal col-white">
  <td colspan="2"> <b>PROFILE ORANG TUA</b> </td>
  </tr>
                                         <tr>
                                            <td>NAMA BAPAK</td>
                                            <td><?php echo $data->nama_ayah?></td>
                                        </tr>
										<tr>
                                            <td>PEKERJAAN  </td>
                                            <td><?php echo $data->pekerjaan_ayah?></td>
                                        </tr><tr>
                                            <td>NAMA IBU</td>
                                            <td><?php echo $data->nama_ibu;?></td>
                                        </tr> 
										<tr>
                                            <td>PEKERJAAN</td>
                                            <td><?php echo $data->pekerjaan_ibu;?></td>
                                        </tr> 
										<tr>
                                            <td>PENGHASILAN </td>
                                            <td><?php echo $data->penghasilan;;?></td>
                                        </tr>
										<tr>
                                            <td>NO HP ORANG TUA</td>
                                            <td><?php echo $data->hp_ayah."/".$data->hp_ibu;?></td>
                                        </tr> <tr>
                                            <td>ALAMAT</td>
                                            <td><?php echo $data->alamat_ortu;?></td>
                                        </tr> 
									 
										
                                        
                                    </tbody>
 </table>	
 </div>

<div class="col-md-6 entry">	 
 <table>
  <tbody  class="col-black"><tr class="bg-teal col-white">
  <td colspan="2"> <b>RIWAYAT PENDIDIKAN & DATA WALI   </b> </td>
  </tr>
										
                                         <tr>
                                            <td>ASAL SD</td>
                                            <td><?php echo $data->asal_sd;?></td>
                                        </tr> 
										<tr>
                                            <td>LULUS</td>
                                            <td><?php echo $data->tahun_lulus_sd;?></td>
                                        </tr> 
										<tr>
                                            <td>ASAL SMP</td>
                                            <td><?php echo $data->asal_smp;?></td>
                                        </tr> 
										<tr>
                                            <td>LULUS</td>
                                            <td><?php echo $data->tahun_lulus_smp;?></td>
                                        </tr> 
										 <tr>
                                            <td>NAMA WALI MURID</td>
                                            <td><?php echo $data->nama_wali;?></td>
                                        </tr>
										<tr>
                                            <td>KONTAK</td>
                                            <td><?php echo $data->hp_wali;?></td>
                                        </tr>
										<tr>
                                            <td>HUBUNGAN</td>
                                            <td><?php echo $data->hubungan;?></td>
                                        </tr>
										
                                        
                                    </tbody>
 </table>								
	</div>
	
	
	</div>
										
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane animated flipInX" id="absensi">
                                    
                                    <p>
									

									<div class="col-md-12">
                                       <!------------------>
									     <div class="table-responsive">
									    <table class="entry table-hover" width="100%">
										<tr class="bg-blue">
										 
											<th>BULAN</th>
											<?php
											$db=$this->db->get_where("tr_sts_kehadiran",array("id!="=>1))->result();
											foreach($db as $val)
											{
												echo '<th width="100px" align="center"><center>  '.$val->nama.'</center></th>';
											}
											?>
										
											 
										</tr>
									  <?php
									  $tahun=$this->m_reff->tahun();
									  $sms=$this->m_reff->semester();
										   $dt=$this->db->query("SELECT DISTINCT(SUBSTR(tgl,1,7)) AS bln FROM tm_absen_siswa
										   where id_tahun='".$tahun."' and id_semester='".$sms."' ")->result();
											foreach($dt as $val)
											{
												echo "<tr>
												<td>".$this->tanggal->bulanThn($val->bln)."</td>";
											 
												foreach($db as $vals)
												{
													echo '<td  align="center"><center>  '.$this->mdl_siswa->kehadiranGroup($data->id,$vals->id,$val->bln).'</center></td>';
												}
												echo "</tr>";
											}												
										 ?>
		  
										 
										</table>
										</div>
										</div>
                                       <!------------------>
                                    </p>
                                </div>
                               
                                <div role="tabpanel" class="tab-pane animated zoomIn" id="keuangan">
                                    <p>
                                      <!-------------------------->
									  
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="body entry">
                          <div class="table-responsive">
                             <table class="entry table-hover" width="100%">
									 <tr class="bg-blue">
									<th class='thead' >NO</th>
									 
									<th class='thead' >TAGIHAN</th>
									<th class='thead'  >TOTAL TAGIHAN (Rp) </th>
									<th class='thead'  >TELAH DIBAYAR (Rp) </th>
									<th class='thead' >SISA TAGIHAN (Rp) </th>
									<th class='thead'  >STATUS PEMBAYARAN</th>
					 
									</tr>
									<?php
									/*$no=1;
									foreach($this->mdl_siswa->getTagihan($data->nis) as $dataDB)
									{?>
									<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $dataDB->nama_tagihan;?></td>
									<td><?php echo number_format($dataDB->nominal,0,",",".");?></td>
									<td><?php echo number_format($t=$this->mdl_siswa->telahDibayar($dataDB->id),0,",",".");?></td>
									<td><?php echo number_format($dataDB->nominal-$t,0,",",".");?></td>
									<td><?php echo $this->m_reff->goField("tr_sts_tagihan","nama","where id='".$dataDB->sts."'");?></td>
						 
									</tr>
									<?php }
									if($no<2)
									{
										echo "<tr><td colspan='6' align='center'><i> Tidak ada tagihan </i></td></tr>";
									}*/
									
									?>
							</table>
					 					
						 
                           <!----->
                        </div>
                        </div>
                   
                </div>
                <!-- #END# Task Info -->
				 
                                      <!-------------------------->
                                    </p>
                                </div>
                            </div>
							
							
               <!--        <div role="tabpanel" class="tab-pane  animated zoomIn" id="thumb_up">
                                    <p>
                                      <!------------------------ 
									  
 
                <div class="row clearfix">
                <!-- Task Info  
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                        <div class="body entry">
                         
						 $idsiswa["id_siswa"]=$data->id;
						 $this->load->view("catatan_baik",$idsiswa);?>
                        </div>
                   
                </div>
                <!-- #END# Task Info  
				 
                                      <!------------------------ 
                                    </p>
                                </div>
                            </div>  -->

 	