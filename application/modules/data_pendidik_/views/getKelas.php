<table class="table table-bordered table-hover table-striped">
<thead class="bg-teal">
 
<th>JAM KE</th>
<th>MAPEL</th>
<th>GURU</th>

</thead>
 <tbody>
                                        
										<?php
										$off="";
										  $cekoff=$this->db->query("select * from tm_diliburkan where  substr(tgl,1,10)='".date('Y-m-d')."' ")->num_rows();
									 if($cekoff)
									{
										$off="1";
									} 
										$jam=date("H:i:s");
										$i=$ha=$id_hari;
										 $tahun=$this->m_reff->tahun();
										 $sms=$this->m_reff->semester();
							 if($ha==1){ $sts="1"; }else{ $sts="0"; };
							  $urut=$val="";
							  $db=$this->db->query("select * from tr_jam_ajar where sts='".$sts."' order by jam_mulai asc ")->result();
							  foreach($db as $val)
							  {
								  if($ha==$i && $jam>=$val->jam_mulai && $jam<=$val->jam_akhir)
								  {
									  $cls="bg-orange col-black";
								  }else{
									  $cls="";
								  }
							 
								  	 $urut=$val->urut;
								  if(!$urut)
								  {
									   echo "<tr class='font-bold ".$cls."'  >
									  <td>".$urut."</td>
									 
									  <td colspan='3' >".$val->kegiatan."</td>
									  
									  </tr>";

								  }else{ 
											$base=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' 
											and id_tahun='".$tahun."' and id_semester='".$sms."' and id_hari='".$i."'
											and jam like '%,".$urut.",%' ")->row();
									  $mapel=isset($base->mapel)?($base->mapel):"";
									  $id_mapel=isset($base->id_mapel)?($base->id_mapel):"";
									  $idguru=isset($base->id_guru)?($base->id_guru):"";
									  $id_jadwal=isset($base->id)?($base->id):"";
									  $dataguru=$this->db->query("select gelar_depan,nama,gelar_belakang from data_pegawai where id='".$idguru."'")->row();
									  $nama=isset($dataguru->nama)?($dataguru->nama):""; 
									  $gelar_depan=isset($dataguru->gelar_depan)?($dataguru->gelar_depan):"";
									  $gelar_belakang=isset($dataguru->gelar_belakang)?($dataguru->gelar_belakang):"";
									   
									 
										$guru=$gelar_depan." ".$nama." ".$gelar_belakang;
										$nama_kelas=isset($base->nama_kelas)?($base->nama_kelas):"";
									  if($mapel)
									  {
										 
									  echo "<tr class='".$cls." '>
									 
									  <td>".$urut."</td>
									 
									  <td><span class='col-back'>".$mapel."</span> </td>									 
									  <td><span class='col-back'>".$guru."</span> </td>									 
									 								 
									  </tr>";
									  }else{
										   echo "<tr class=' hide ".$cls." font-bold' >
										  <td>".$urut."</td>
										  <td>".substr($val->jam_mulai,0,5)."</td>
										  <td colspan='3'  > <i class='col-orange'>Kosong</i></td>	 					 
										  </tr>";
									  }
								  }
							  }
							  ?>
									 	
										
                                    </tbody>
</table>

