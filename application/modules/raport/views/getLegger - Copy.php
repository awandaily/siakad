 
 <?php 
 $id_kelas=$this->input->get_post("kelas");
 
 // $sms=$this->input->get_post("sms");
  $sms=$this->m_reff->semester();
   
  $mapel=$this->db->query("select * from v_mapel_ajar where id_kelas='".$id_kelas."' and id_semester='".$sms."' ");
  if(!$mapel->num_rows())
  {
	  echo "<b>Tidak ada data</b>"; return false;
  }
	  
 ?>
 <div class="table-responsive">
 
 <div class="pull-left col-md-10 col-sx-12">
 <b>KELAS : </b><?php echo $mapel->row()->kelas;?><br>
 <b>SEMESTER : </b><?php echo $sms;?> (<?php echo $this->m_reff->alias_semester($sms);?>)<br>
 <b>TAHUN PELAJARAN : </b><?php echo $this->m_reff->tahun_ajaran();?>
 </div>
 <div class="col-md-2 col-sx-12">
							<a target="_blank" href="<?php echo base_url()?>raport/download_legger?kelas=<?php echo $id_kelas?>"   class="waves-effect btn bg-teal btn-block">Download</a>
</div>
</span>                                <table id='tables' class="tabel black table-bordered table-striped table-hover dataTable" style="font-size:12px;width:100%">
								<tr><th class='bg-teal sadow' rowspan="3" width='15px'>&nbsp;NO</th>
								<th class='bg-teal sadow' rowspan="3" > NISN</th>
								<th class='bg-teal sadow' rowspan="3" >NAMA PESERTA DIDIK</th>
								<th class='bg-teal sadow' rowspan="3" >JK</th>
								<th class='sadow  bg-green' align="center" colspan="<?php echo ($mapel->num_rows()*3);?>"><center>MATA PELAJARAN</center></th>
								<th class='bg-teal   sadow' rowspan="4" ><center> RATA- RATA </center></th>
								<th class='bg-pink sadow' rowspan="4" > NILAI AKHIR </th>
								<th class='bg-teal sadow' rowspan="4" >NILAI EKSKUL</th>
								<th class='bg-teal sadow'   colspan="3"><center>KEHADIRAN</center></th>
								<th class='bg-green sadow' rowspan="4"  >TOTAL</th>
								 
								</tr>
								
								<tr>
								<?php $urut=1; $urutan=""; $spk="";
								foreach($mapel->result() as $val)
								{
									echo "<td colspan='3' class='bg-green sadow font-bold'><center>".$val->mapel."</center></td>";
									$urutan.="<td colspan='3' class='bg-teal'> <center>".$urut++."</center></td>";
									$spk.="<td class='sadow font-bold bg-green'>S</td><td class='sadow font-bold bg-green'>P</td><td class='sadow font-bold bg-green'>K</td>";
								}
								$dbhadir=$this->db->get_where("tr_sts_kehadiran",array("sts_tampil"=>1))->result();
								echo " ";
								foreach($dbhadir as $var)
								{
									echo '<td rowspan="3" class="sadow font-bold bg-green">'.$var->alias.'</td>';
								}
								echo "</tr>";
								echo "<tr>";
								echo $urutan;
								echo "</tr>";
								echo '<tr>	 <td colspan="4" class="sadow font-bold bg-green"><center>ASPEK YANG DINILAI</center></td>  ';
								 
								echo $spk;
								?>	 
								</tr>
								
								 
								<?php
								$no=1;
								$datakelas=$this->db->get_where("data_siswa",array("id_kelas"=>$id_kelas))->result();
								foreach($datakelas as $val)
								{?>
									
								<?php echo "<tr>";?>	
									<?php echo "<td>".$no++."</td>";?>	
									<?php echo "<td>".$val->nisn."</td>";?>	
									<?php echo "<td align='left'>".$val->nama."</td>";?>	
									<?php echo "<td>".strtoupper($val->jk)."</td>";?>	
									
									<?php
									foreach($mapel->result() as $value)
									{	$n2=$this->mdl->getNilaiRataPengetahuan($val->id,$value->id_mapel,$sms);
										$n3=$this->mdl->getNilaiRataKeterampilan($val->id,$value->id_mapel,$sms);
										$nKBPengetahuan=$this->mdl->getNilaiKBPengetahuan($value->id_mapel);
										$nKBKeterampilan=$this->mdl->getNilaiKBKeterampilan($value->id_mapel);
										if($nKBPengetahuan>$n2){
											$class="col-pink font-bold";
										}else{
											$class="";
										}
										
										if($nKBKeterampilan>$n3){
											$class2="col-pink font-bold";
										}else{
											$class2="";
										}
										echo "<td>".$n1=$this->mdl->getNilaiRataSikap($val->id,$value->id_mapel,$sms)."</td>";
										
										echo "<td title='".$nKBPengetahuan."' class='".$class."'>".$n2."</td>";
										echo "<td  title='".$nKBKeterampilan."'  class='".$class2."'>".$n3."</td>";
										
									}	
									echo "<td><center>".$this->mdl->getNilaiRataRata($val->id,$sms)."</center></td>"; //murni
									echo "<td><center>".$this->mdl->getNilaiAkhir($val->id,$sms)."</center></td>";
									echo "<td><center>
									". $this->mdl->getNilaiEskul($val->id,$sms)."
									</center></td>";
									
									echo "<td><center>".$this->mdl->getJmlKehadiran($val->id,$sms,2)."</center></td>";
									echo "<td><center>".$this->mdl->getJmlKehadiran($val->id,$sms,3)."</center></td>";
									echo "<td><center>".$this->mdl->getJmlKehadiran($val->id,$sms,4)."</center></td>";
									echo "<td><center>".$this->mdl->NilaiMinKehadiran($val->id,$sms)."</center></td>";
									
									?>	
								<?php echo "</tr>";?>	
									
									
								<?php }	?>
							 
								
								
							</table>
							</div>		
							
	<script>					 
	function setNilai(idsiswa)
	{	  var sms="<?php echo $sms;?>";
		var nilai=$("[name='eskul"+idsiswa+"']").val();
		  $.post("<?php echo site_url("raport/setNilaiEskul"); ?>",{sms:sms,idsiswa:idsiswa,nilai:nilai},function(data){
			      getNilai();
		      });
	}
	</script>					 