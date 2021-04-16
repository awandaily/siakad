<table class="table table-bordered table-hover table-striped">
<thead class="bg-teal">
<th>KEHADIRAN</th>
<th>JAM KE</th>
<th>MAPEL / GURU</th>
<th>INVAL</th>

</thead>
 <tbody>
                                        
										<?php
									
										$tanggal=$this->tanggal->eng_($tgl,"-");
										$off="";
										  $cekoff=$this->db->query("select * from tm_diliburkan where  substr(tgl,1,10)='".$tanggal."' ")->num_rows();
									 if($cekoff)
									{
										$off="1";
									} 
										$jam=date("H:i:s");
										$i=$ha=date('N', strtotime($tanggal));
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
											
											
											  $id_jadwal=isset($base->id)?($base->id):"";
										   $idguruinval=$this->mdl->idguruinval($tanggal,$id_jadwal,$urut);
											$guruinval=isset($idguruinval->id_guru)?($idguruinval->id_guru):"";
								   
								   
								   
									  $mapel=isset($base->mapel)?($base->mapel):"";
									  $id_mapel=isset($base->id_mapel)?($base->id_mapel):"";
									  $idguru=isset($base->id_guru)?($base->id_guru):"";
										$this->db->where("id!=",$idguru);
									  	$data_pegawai=$this->db->get("data_pegawai")->result();
									  $jam=isset($base->jam)?($base->jam):"";
									
									  $dataguru=$this->db->query("select gelar_depan,nama,gelar_belakang from data_pegawai where id='".$idguru."'")->row();
									  $nama=isset($dataguru->nama)?($dataguru->nama):""; 
									  $gelar_depan=isset($dataguru->gelar_depan)?($dataguru->gelar_depan):"";
									  $gelar_belakang=isset($dataguru->gelar_belakang)?($dataguru->gelar_belakang):"";$opsi="";
									if($guruinval)
									{										
									 $hadir=$this->mdl->cekHadirInval($ha,$id_kelas,$urut,$idguru,$id_jadwal,$id_mapel,$tanggal);
									 if(strpos($hadir,"DIBLOK")===false){
									 	$disabled="";
									 }else{
										$disabled="disabled";
									 }
										
									   $opsi[]="---- tidak ----";
									  foreach($data_pegawai as $vis){
									  $opsi[$vis->id]=$vis->nama;
									  }
									}else{
									 $hadir=$this->mdl->cekHadir($ha,$id_kelas,$urut,$idguru,$id_jadwal,$id_mapel,$tanggal);
										if(strpos($hadir,"BELUM")!==false or strpos($hadir,"izin :")!==false){
																	$disabled="";
																	 $opsi[]="---- tidak ----";
																	  foreach($data_pegawai as $vis){
																	  $opsi[$vis->id]=$vis->nama;
																	  }
										}else{
											$disabled="disabled";
										}
									}										
										$guru=$gelar_depan." ".$nama." ".$gelar_belakang;
										$nama_kelas=isset($base->nama_kelas)?($base->nama_kelas):"";
									  if($mapel)
									  {
								   
										  if($off){$hadir='<i>Off</i>';}
									  echo "<tr class='".$cls." '>
									   <td><span class='col-back'>".$hadir."</span> </td>	
									  <td>".$urut."</td>
									 
									  <td><span class='col-back'>".$mapel."<br></span><span class='col-teal'>".$guru."</span> </td>									 
									  <td>";
									
									  
									  echo form_dropdown("inval",$opsi,$guruinval,"class='form-control select' data-live-search='true' id='inval".$urut."' ".$disabled." onchange='inval(`".$idguru."`,`".$id_jadwal."`,`".$jam."`,`".$tanggal."`,`".$id_mapel."`,`".$urut."`)' "); 									  
									  echo "</td>									 
									 								 
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
<script>
$(".select").selectpicker();
function inval(idguru,idjadwal,jam,tanggal,mapel,urut)
{	var idgurubaru=$("#inval"+urut).val();
	$.post("<?php echo site_url("pd/insertInval"); ?>",{idguru:idguru,idgurubaru:idgurubaru,idjadwal:idjadwal,jam:jam,tanggal:tanggal,mapel:mapel,urut:urut},function(data){
			     kelasLoad();
		      })
	
}
</script>
