<?php $token=date("His");
$nilai_merah="";

?>
  <?php	$datasiswa=$this->m_reff->dataProfileSiswa(); 
  ?>
 <?php   $pass=substr($datasiswa->alias,2);?>



<?php
									$tr="";
									$sms=$this->m_reff->semester(); $tahun=$this->m_reff->tahun();
									$mapel=$this->db->query("select * from v_mapel_ajar where id_kelas='".$this->mdl->id_kelas()."'
									and id_semester='".$sms."' and id_tahun='".$tahun."' group by id_mapel");
									$agama=$this->mdl->id_agama();
									$id_siswa=$this->mdl->idu();
									foreach($mapel->result() as $value)
									{
										
								if($value->mapel_global==2 and $agama>1)
								{
									 if($value->k_mapel=="A")
									 { 
										 $s = "<span class='col-indigo' title='non-muslim'><b>".$this->mdl->getNsNonMuslim($id_siswa)."</b></span>";
										 $p = "<span class='col-indigo' title='non-muslim'><b>".$this->mdl->getNpNonMuslim($id_siswa)."</b></span>";
										 $k = "<span class='col-indigo' title='non-muslim'><b>".$this->mdl->getNkNonMuslim($id_siswa)."</b></span>";
									  
									 $tr.="<tr><td><p  class='col-indigo'>".$value->mapel."</p>
										<p>Nilai Pengetahuan : ".$p." | Nilai Keterampilan : ".$k." </p>
										</td></tr>"; 
									 } 
									 
									  
									 
									
								}else{
										$id_guru=$this->mdl->id_guru($value->id_mapel);
										$p=$this->mdl->getNilaiRataPengetahuanLegger($id_siswa,$value->id_mapel,$sms,$id_guru);
										$k=$this->mdl->getNilaiRataKeterampilanLegger($id_siswa,$value->id_mapel,$sms,$id_guru);
										$nKBPengetahuan=$this->mdl->getNilaiKBPengetahuan($value->id_mapel,$id_guru);
										$nKBKeterampilan=$this->mdl->getNilaiKBKeterampilan($value->id_mapel,$id_guru);
										if($nKBPengetahuan>$p){
											$class="col-pink ";
											$nilai_merah=1;
										}else{
											$class="";
										}
										
										if($nKBKeterampilan>$k){
											$class2="col-pink ";
											$nilai_merah=1;
										}else{
											$class2="";
										}
										$s=$this->mdl->getNilaiRataSikap($id_siswa,$value->id_mapel,$sms,$id_guru);
										 
										$tr.="<tr><td ><p class='size col-indigo'  title='".$nKBPengetahuan."'>".$value->mapel."</p>
										<p  > <span  class='size ".$class."'  title='".$nKBPengetahuan."' >Nilai Pengetahuan: ".$p."</span> |
										<span   title='".$nKBKeterampilan."' class='size ".$class2."'>Nilai Keterampilan: ".$k." </span>  </p>
										</td></tr>"; 
								}  
									} 
?>










 
                <div class="">
                <!-- Task Info -->
                <div >
                    <div class="card" >
                         
					 <center style='color:red'>
                         <?php
						 if($nilai_merah){
								echo "KARTU UJIAN TIDAK KELUAR ".br();
								echo "ANDA MASIH MEMILIKI NILAI DIBAWAH KKM".br();
								echo "MOHON HUBUNGI GURU YANG BERSANGKUTAN AGAR DAPAT MENGIKUTI UJIAN";
								 $this->m_reff->sts_ujian($datasiswa->id,0);
						 }else{?>
						 <div style="border;3px;color:green;font-weight:bold">
						 <table width="100%" class="entry">
						 <tr>
						 <td colspan="2" align="center" class='col-teal bg-grey'><center>
						 <img src="<?php echo base_url()?>file_upload/img/<?php echo $this->m_reff->tm_pengaturan(10);?>" width='40px' align="left">
						<h5 style="font-size:16px" class='sadow'><?php echo $this->m_reff->tm_pengaturan(7);?></h5></center>
						 </td>
						 </tr>
						 <tr>
						 <td colspan='2' align="center"><b>KARTU UJIAN</b></td>
						 </tr>
						 <tr>
						 <td>Nama</td><td> <?php echo $datasiswa->nama;?></td>
						 </tr> <tr>
						 <td>Kelas</td><td> <?php echo $this->m_reff->goField("v_kelas","nama","where id='".$datasiswa->id_kelas."'");?></td>
						 </tr>
						 <tr>
						 <td>Username</td><td> <?php echo $datasiswa->username;?></td>
						 </tr>
						 <tr>
						 <td>Password</td><td> <?php echo substr($pass,0,-2);?></td>
						 </tr>
						 </table>
						 </div>
						 <?php 
						 $this->m_reff->sts_ujian($datasiswa->id,1);
						 } ?>
					</center>	  
					</div>
					
				 <div   id="area_lod" class="card">
			            <div class="body">
						<center><b>  REKAP NILAI</b></center>
                            <div class="table-responsive">
                             <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable">
								<thead  class='sadow bg-teal'  style="font-size:12px;width:100%" >			
								 
									<th class='thead' >MATA PELAJARAN</th>  
							 		</thead>
								<?php
								echo $tr;
								?>
							</table>
							</div>						
						</div>						
					</div>	
					
					
					
					
                           <!----->
                        </div>
                    </div>
             
                <!-- #END# Task Info -->
				
 		 
 <script>
 var nilai_merah="<?php echo $nilai_merah;?>";
 if(nilai_merah==1)
 {
	 $("#nilai_merah").show();
 }
</script>
	 