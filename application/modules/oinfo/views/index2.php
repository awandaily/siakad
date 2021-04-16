 <?php
 $sms=$this->m_reff->semester();
$tahun=$this->m_reff->tahun();
?>
 
 <div class="row clearfix">
            
 
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-indigo  hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">KEHADIRAN</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">100%</div>
                        </div>
                    </div>
                </div>
				
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink  hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">CATATAN BAIK</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">257</div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-deep-orange hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">CATATAN BURUK</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">257</div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">TAGIHAN</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">257</div>
                        </div>
                    </div>
                </div>
				
				
				
				
				
				
				
				
				
				
				
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">ABSENSI SEMESTER <?php echo $sms;?>  </div>
                            <ul class="dashboard-stat-list">
							<?php
							$data=$this->db->get("tr_sts_kehadiran")->result();
							foreach($data as $val){?>
                                <li style="border-bottom:white dashed 1px">
                                    <?php echo strtoupper($val->nama);?>
                                    <span class="pull-right"><b>12</b>  </span>
                                </li>
							<?php } ?>   
                            </ul>
                        </div>
                    </div>
                </div>
				
				
				
				
				
				  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="entry table-hover dashboard-task-infos" width="100%">
                                    <thead>
                                        <tr>
                                             
                                            <th width="140px">JAM</th>
                                            <th>MATA PELAJARAN</th>
                                            <th>GURU</th>
                                            <th>KEHADIRAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
										<?php
										 
										$jam=date("H:i:s");
										$i=$ha=date("N");
										$id_kelas=$this->m_reff->id_kelas();
										$id_siswa=$this->m_reff->id_siswa();
										 
							 if($ha==1){ $sts="1"; }else{ $sts="0"; };
							  $urut=$val="";
							  $db=$this->db->query("select * from v_jadwal where id_hari='".$ha."' and id_kelas='".$id_kelas."'
							  and id_tahun='".$tahun."' and id_semester='".$sms."'
							  order by jam_awal asc ")->result();
							  foreach($db as $val)
							  {
								  if($ha==$i && $jam>=$val->jam_awal && $jam<=$val->jam_akhir)
								  {
									  $cls="bg-orange col-black";
								  }else{
									  $cls="";
								  }
							 
								  	 $urut=1;
								  if(!$urut)
								  {
									   

								  }else{ 
											 
									  $mapel=isset($val->mapel)?($val->mapel):"";
									  $idguru=isset($val->id_guru)?($val->id_guru):"";
									  $dataguru=$this->db->query("select gelar_depan,nama,gelar_belakang from data_pegawai where id='".$idguru."'")->row();
									  $nama=isset($dataguru->nama)?($dataguru->nama):""; 
									  $gelar_depan=isset($dataguru->gelar_depan)?($dataguru->gelar_depan):"";
									  $gelar_belakang=isset($dataguru->gelar_belakang)?($dataguru->gelar_belakang):"";
									  $id_jadwal=$val->id;
									  $hadir=$this->db->query("select * from tm_absen_siswa where id_siswa='".$id_siswa."' and SUBSTR(tgl,1,10)='".date('Y-m-d')."' and 
									 id_jadwal='".$id_jadwal."' ")->row();
									 $id_sts=isset($hadir->id_sts)?($hadir->id_sts):"";
									 $hadir=$this->mdl->getStsHadir($id_sts);
										$guru=$gelar_depan." ".$nama." ".$gelar_belakang;
										$nama_kelas=isset($base->nama_kelas)?($base->nama_kelas):"";
									  if($mapel)
									  {
									  echo "<tr  '>
									  
									  <td>".$this->mdl->getJamAwal($ha,$val->jam_awal)." - ".$this->mdl->getJamAkhir($ha,$val->jam_akhir)." Wib</td>
									  <td><span class='col-back'>".$mapel."</span> </td>									 
									  <td><span class='col-back'>".$guru."</span> </td>									 
									  <td><span class='col-back'>".$hadir."</span> </td>									 
									  </tr>";
									  }else{
										   
									  }
								  }
							  }
							  ?>
										
										
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
 </div>