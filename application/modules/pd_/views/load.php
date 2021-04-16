<?php
 $datalibur=$this->db->query("select * from tm_jadwal_libur where start<='".date('Y-m-d')."' and end>='".date('Y-m-d')."' ")->row();
$namaLibur=isset($datalibur->nama)?($datalibur->nama):"";
if($namaLibur)
{
	echo "<div ><br><center> Hari ini KBM diliburkan<br> <i class='col-deep-orange'> ".$namaLibur." </i></center></div>";
				return false;
}



 $cekoff=$this->db->query("select * from tm_diliburkan where  substr(tgl,1,10)='".date('Y-m-d')."' ")->num_rows();
 if($cekoff)
{
	echo "<div  ><br><center><i>Pembelajaran di non-aktifkan</i><br>
	<button class='bg-pink btn waves-effect' onclick='batalkan()'>Batalkan Penonaktifan   </button>
	</center></div>";
	return false;
}
 $sms=$this->m_reff->semester();
$tahun=$this->m_reff->tahun();
$ha=date("N");
if($ha==1)
{
	$ss=1;
}else{
	$ss=0;
}
$data=$this->db->query("select urut from tr_jam_ajar where sts='".$ss."' AND  '".date("H:i:s")."'<=jam_akhir order by jam_akhir asc limit 1 ")->row();
  
 $jamkenow= isset($data->urut)?($data->urut):"0";
 if(!$jamkenow)
 {
	 echo "<i>Tidak ada kegiatan belajar mengajar</i>";
	 return false;
 }
 

?>
 
			 

			 <center><b>JADWAL PEMBELAJARAN JAM KE <?php echo $jamkenow?> </b></center>
                            <div class="table-responsive">
                                <table class="entry table-hover dashboard-task-infos" width="100%">
                                    <thead>
                                        <tr>
                                               <th>STATUS GURU</th>
			                                <th>KELAS/MAPEL/GURU</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
										<?php
										 	$sms=$this->m_reff->semester();
											$tahun=$this->m_reff->tahun();
										$jam=date("H:i:s");
										$i=$ha=date("N");
										$id_kelas=$this->m_reff->id_kelas();
										$id_siswa=$this->m_reff->id_siswa();
										 
							 if($ha==1){ $sts="1"; }else{ $sts="0"; };
							   $val="";$urut=1;
							   $id_jam="";
							  $db=$this->db->query("select * from v_jadwal where id_tahun='".$tahun."' and jam like '%,".$jamkenow.",%'
							  and id_semester='".$sms."' and id_hari='".$ha."'  order by nama_kelas asc ")->result();
							  foreach($db as $val)
							  {
										$cek=$this->mdl->cekKehadiranGuru($val->id,$val->id_guru);
									    $cls="col-black";
										if($cek){
												 
											$jam_ada=$cek->jam;
											$jam_blok=$cek->jam_blok;
										 
											if(strpos($jam_blok,",".$jamkenow.",")===false)
											{
											    if($cek->sumber==1){
											        $masukket="MASUK";$warnamasuk=" bg-teal ";$alasanizin="";
											    }elseif($cek->sumber==2){
											        $masukket="TUGAS";$warnamasuk=" bg-indigo ";$alasanizin="";
											    } elseif($cek->sumber==4){
											        $masukket="DIBLOK SYSTEM";$warnamasuk=" bg-red ";$alasanizin="";
											    }elseif($cek->sumber==5){
											        $masukket="PKL";$warnamasuk=" bg-deep-orange ";$alasanizin="";
											    }else{
											        $masukket="IZIN";$warnamasuk=" bg-deep-orange ";
											        $alasanizin=br()."<i class='pull-right'>".$cek->izin."</i>";
											    }
												$hadir="<button onclick='blok(`".$val->id_guru."`,`".$val->id_kelas."`,`".$val->id."`,`".$id_jam."`,`".$jamkenow."`)' class='btn $warnamasuk waves-effect'> <i class='material-icons'>lock_open</i> $masukket </button>$alasanizin";
											 
											}else{
											    
											     if($data->sumber=="4")
                                    			   {
                                    			 	  $hadir="<button onclick='unblok(`".$val->id_guru."`,`".$val->id_kelas."`,`".$val->id."`,` `,`".$id_jam."`,`".$jamkenow."`)' class='btn bg-pink waves-effect'> <i class='material-icons'>pan_tool</i> TIDAK MASUK </button>";
                                    			   }else{
                                    		  	$hadir="<button onclick='unblok(`".$val->id_guru."`,`".$val->id_kelas."`,`".$val->id."`,`".$id_jam."`,`".$jamkenow."`)' class='btn bg-pink waves-effect'> <i class='material-icons'>pan_tool</i> DIBLOK </button>";
                                    			   }
											}
											
											
											 
										}else{
										    
										    $cekizinharian=$this->mdl->cekIzinHarian(date('Y-m-d'),$val->id_guru);
                                            $cekinval=$this->mdl->cekInval(date('Y-m-d'),$val->id,$val->id_guru);
                                            if($cekinval){
                                                $namaguru=$guru=$this->m_reff->goField("data_pegawai","nama","where id='".$cekinval->id_guru."' ");
                                            $hadir= "<span class='col-orange'>   Diinval oleh ".$namaguru." </span> ";
                                          
                                            }elseif($cekizinharian){
                                               
                                           $hadir= " <span class='col-orange'>  Izin ".$cekizinharian->ket." </span> ";
                                            
                                            }else{
											$hadir="<button onclick='absenkan(`".$val->id_guru."`,`".$val->id_kelas."`,`".$val->id."`,`".$val->jam."`,`".$jamkenow."`,`".$val->id_mapel."`)' class='btn bg-blue waves-effect'>   BLUM ABSEN </button>";
                                            }
										}
									  echo "<tr class='".$cls." '>
									  <td><span class='col-back'>".$hadir."</span> </td>	
									   
									  <td><span class='col-teal'>".$val->nama_kelas."</span><br>
									  <span class='col-pink'>".$val->mapel."</span><br>
									  <span class='col-indigo'>".$this->m_reff->goField("data_pegawai","nama","where id='".$val->id_guru."'")."</span> </td>									 
									 						 
									  </tr>";
									   
								   
							  }
							  ?>
										
										
										
                                    </tbody>
                                </table>
                            </div>
	 