    
						<center>	<b>JADWAL SEDANG BERLANGSUNG <?php  $jamkenow=$jam=$this->m_reff->jam_aktif();?></b> </center>
							<div class="entry">
						    <div class="table-responsive">
							<table>
							<thead>
							<th>NO</th>
							<th>PENGAJAR</th>
							<th>KELAS</th>
							<th>MAPEL</th>
							<th>STATUS</th>
							</thead>
							<?php
							$no=1;
							$data=$this->db->get("v_kelas")->result();
							foreach($data as $val)
							{	$get=$this->mdl->getkbmnow($val->id,$jam,date('N'));
								$idguru=isset($get->id_guru)?($get->id_guru):"";
								$idmapel=isset($get->id_mapel)?($get->id_mapel):"";
								$idJadwal=isset($get->id)?($get->id):"";
								$cek=$this->mdl->cekKehadiranGuru($idJadwal,$idguru);
								$cekoff=$this->mdl->cekDiliburkan($idJadwal,$idguru);
								if($cek){ 
											 
											$jam_blok=$cek->jam_blok;
										 
											if(strpos($jam_blok,",".$jamkenow.",")===false)
											{
											     if($cek->sumber==1){
											        $masukket="MASUK";$warnamasuk=" col-teal ";$alasanizin="";
											    }elseif($cek->sumber==2){
											        $masukket="TUGAS";$warnamasuk=" col-indigo ";$alasanizin="";
											    }else{
											        $masukket="IZIN";$warnamasuk=" col-deep-orange ";
											        $alasanizin=$cek->izin;
											    }
												$hadir="<span class='$warnamasuk'> $masukket:$alasanizin </span>";
											 
											}else{
												$hadir="<span class='col-red'> DIBLOK </span>";
												 
											} 
										}else{
											$hadir="BLUM ABSEN";
								  }
								
								if($cekoff)
								{
									$hadir="<i>Dinonaktifkan</i>";
								}
								
								
								
								
								echo "<tr>
								<td>".$no++."</td>
								<td>".$this->m_reff->goField("v_pegawai","nama_lengkap","where id='".$idguru."' ")."</td>
								<td>".$val->nama."</td>
								<td>".$this->m_reff->goField("tr_mapel","nama","where id='".$idmapel."' ")."</td>
								<td>".$hadir."</td>
								
								</tr>";
							};?>
							
							</table>
							</div>
							</div>
						 