<?php 
$sms=$this->m_reff->semester();
$tahun=$this->m_reff->tahun();
$jumlahMapel=0;

 $id_kelas=$this->input->get_post("kelas");
  $sms=$this->m_reff->semester();
  $tahun=$this->m_reff->tahun();
?>

 <?php  
                               $semester=$this->m_reff->semester();
                             	$tahun_real=$this->m_reff->tahun_asli();
	                        	$tahun_kini=$this->m_reff->tahun();
                            	if($tahun_real==$tahun_kini){
                            $id_kelas=$this->m_reff->goField("tm_kelas","id","where id_wali='".$this->mdl->idu()."'");
	                        	}else{ 
	                        	
	                        	   $getIdSiswa=$this->m_reff->goField("tm_catatan_walikelas","id_siswa","where _cid='".$this->mdl->idu()."' and id_tahun='".$tahun_kini."'  order by RAND() limit 1");
	                         	   $id_kelas=$this->m_reff->getHisKelas($getIdSiswa);   
	                        	} 
                             ?>
 
		   
		    
 <?php 

   
  
   
  $mapel=$this->db->query("select * from v_mapel_ajar where id_kelas='".$id_kelas."' and id_semester='".$sms."' 
  and id_tahun='".$tahun."' group by id_mapel  ");
  if(!$mapel->num_rows())
  {
	  echo "<b>Tidak ada data</b>"; return false;
  }
	  
 ?>
  
 
 <div class="pull-left col-md-10 col-sx-12">
 <b>KELAS : </b><?php echo $mapel->row()->kelas;?><br>
 <b>SEMESTER : </b><?php echo $sms;?> (<?php echo $this->m_reff->alias_semester($sms);?>)<br>
 <b>TAHUN PELAJARAN : </b><?php echo $this->m_reff->tahun_ajaran($this->m_reff->tahun());?>
 </div>
 
                              <table class="tborder"  width="100%"   cellspacing="0" border="1">
								<tr><th class='bg-teal sadow'  style='background-color:#009688;color:white;font-weight:bold' rowspan="3" width='24px'>&nbsp;NO</th>
								<th class='bg-teal sadow'   style='background-color:#009688;color:white;font-weight:bold' rowspan="3" width="65px" > NISN</th>
								<th class='bg-teal sadow'   style='background-color:#009688;color:white;font-weight:bold' rowspan="3" width="170px" >NAMA PESERTA DIDIK</th>
								<th class='bg-teal sadow'  style='background-color:#009688;color:white;font-weight:bold'  rowspan="3" >JK</th>
								<th class='sadow  bg-green'  style="background-color:#4CAF50;color:yellow;font-weight:bold" align="center" colspan="<?php echo ($mapel->num_rows()*3);?>">MATA PELAJARAN</th>
								 <th class='bg-teal   sadow' rowspan="4"    style='background-color:#009688;color:white;font-weight:bold'  > RATA- RATA </th>
								<th class='bg-pink sadow' rowspan="4"  style='background-color:pink'  > NILAI AKHIR </th>
								<th class='bg-teal sadow' rowspan="4"  style='background-color:#009688;color:white;font-weight:bold'   >NILAI EKSKUL</th>
								<th class='bg-teal sadow'   colspan="3"   style='background-color:#009688;color:white;font-weight:bold'  >KEHADIRAN</th>
								<th class='bg-green sadow' rowspan="4"  style='background-color:#4CAF50'   >TOTAL</th>
								</tr>
								
								<tr>
								<?php $urut=1; $urutan=""; $spk="";
								foreach($mapel->result() as $val)
								{
									echo "<td colspan='3'   class='bg-green sadow font-bold' style='background-color:#4CAF50;color:yellow;font-weight:bold'><b>".$val->mapel."</b></td>";
									$urutan.="<td colspan='3' class='bg-teal'   style='background-color:#009688;color:white;font-weight:bold'  > ".$urut++."</td>";
									$spk.="<td class='sadow font-bold bg-green' style='background-color:#4CAF50;color:yellow;font-weight:bold'>S</td>
									<td class='sadow font-bold bg-green' style='background-color:#4CAF50;color:yellow;font-weight:bold'>P</td>
									<td class='sadow font-bold bg-green'  style='background-color:#4CAF50;color:yellow;font-weight:bold' >K</td>";
								}
								 $dbhadir=$this->db->get_where("tr_sts_kehadiran",array("sts_tampil"=>1))->result();
								echo " ";
								foreach($dbhadir as $var)
								{
									echo '<td rowspan="3" class="sadow font-bold bg-green" style="background-color:#4CAF50;color:yellow;font-weight:bold" ><b>'.$var->alias.'</b></td>';
								}
							 
								echo "</tr>";
								echo "<tr>";
								echo $urutan;
								echo "</tr>";
								echo '<tr>	 <td colspan="4" class="sadow font-bold bg-green" style="background-color:#4CAF50;color:yellow;font-weight:bold">ASPEK YANG DINILAI</td>  ';
								 
								echo $spk;
								?>	 
								</tr>
								 
								
								 
								<?php
								
								
								 if($this->m_reff->tahun_sts()=="true"){
     $query="select * from data_siswa where id_kelas='".$id_kelas."' and ( id_sts_data!='2' and id_sts_data!='3' and id_sts_data!='5') order by nama asc";
	     }else{
	         
	       
	        $id_tk=$this->m_reff->goField("tm_kelas","id_tk","where id='".$id_kelas."' "); 
	                $tahun=$this->m_reff->tahun(); 
                
    $query="select * from data_siswa where  id_tahun_$id_tk=$tahun and id_kelas_$id_tk=$id_kelas order by nama asc";            	
	     }
	     
	     
	     
								$no=1;
								//$this->db->limit("2");
								$datakelas=$this->db->query($query)->result();
								foreach($datakelas as $val)
								{
								$agama=$val->id_agama;	
									
									?>
									
								<?php echo "<tr>";?>	
									<?php echo "<td>".$no++."</td>";?>	
									<?php echo "<td>".$val->nisn."</td>";?>	
									<?php echo "<td style='text-align:left'>".$val->nama."</td>";?>	
									<?php echo "<td>".strtoupper($val->jk)."</td>"; 	
									$jumlahMapel=$nilaiSikap=$nilaiKeterampilan=$nilaiPengetahuan=0;
									foreach($mapel->result() as $value)
									{	
									
									 
										
						       if($value->mapel_global==2 and $agama>1)
								{
									 if($value->k_mapel=="A")
									 {
										 $jumlahMapel++;
										 
										echo "<td><i class='col-indigo' title='non-muslim' style='color:blue'><b>".$ns=$this->mdl->getNsNonMuslim($val->id)."</b></i></td>";
										echo "<td><i class='col-indigo' title='non-muslim'  style='color:blue'><b>".$n2=$this->mdl->getNpNonMuslim($val->id)."</b></i></td>";
										echo "<td><i class='col-indigo' title='non-muslim'  style='color:blue'><b>".$n3=$this->mdl->getNkNonMuslim($val->id)."</b></i></td>";
										 
									 $nilaiSikap=$ns+$nilaiSikap;
									$nilaiPengetahuan=$n2+$nilaiPengetahuan;
									$nilaiKeterampilan=$n3+$nilaiKeterampilan;
										 
										 
									 }else{
										echo "<td colspan='3'><i class='col-pink'  style='color:orange'>non-muslim</i></td>";
									 }
									 
									  
									 
									
								}else{
								
								$jumlahMapel++;
										$n2=$this->mdl->getNilaiRataPengetahuanLegger($val->id,$value->id_mapel,$sms,$value->id_guru);
										$n3=$this->mdl->getNilaiRataKeterampilanLegger($val->id,$value->id_mapel,$sms,$value->id_guru);
										$nKBPengetahuan=$this->mdl->getNilaiKBPengetahuan($value->id_mapel,$value->id_guru);
										$nKBKeterampilan=$this->mdl->getNilaiKBKeterampilan($value->id_mapel,$value->id_guru);
										if($nKBPengetahuan>$n2){
											$class="style='color:red;mso-number-format:\@;' ";
										}else{
											$class="";
										}
										
										if($nKBKeterampilan>$n3){
										$class2="style='color:red;font-weight:bold;mso-number-format:\@;' ";
										}else{
											$class2="";
										}
										$ns=$this->mdl->getNilaiRataSikap($val->id,$value->id_mapel,$sms,$value->id_guru);
										echo "<td><span >".str_replace(".",",",$ns)."</span></td>";
										echo "<td ".$class."  >  ".str_replace(".",",",$n2)." </td>";
										echo "<td><span ".$class2." title='".$nKBKeterampilan."' >".str_replace(".",",",$n3)."</span></td>";
									$nilaiSikap=$ns+$nilaiSikap;
									$nilaiPengetahuan=$n2+$nilaiPengetahuan;
									$nilaiKeterampilan=$n3+$nilaiKeterampilan;
								
								} 
									}	
									 
									 
										$a[$val->id]=array($nilaiSikap,$nilaiPengetahuan,$nilaiKeterampilan,$jumlahMapel);
									$eskul=$this->mdl->getNilaiEskul($val->id,$sms);
									$nilaipeng=$this->mdl->NilaiMinKehadiran($val->id,$sms);
									$jumlah=(($nilaiSikap+$a[$val->id][0]
									+
									$nilaiPengetahuan+$a[$val->id][1]
									+
									$nilaiKeterampilan+$a[$val->id][2]
									)/3);
									 $ok=($jumlah/($jumlahMapel+$a[$val->id][3]));
									
									echo "<td>".str_replace(".",",",number_format($ok,2))."</td>"; //murni
									echo "<td>".str_replace(".",",",number_format(($ok+$eskul)-$nilaipeng,2))."</td>";
									echo "<td>
									". str_replace(".",",",$eskul)."
									</td>";
									
									echo "<td>".str_replace(".",",",$this->mdl->getJmlKehadiran($val->id,$sms,2))."</td>";
									echo "<td>".str_replace(".",",",$this->mdl->getJmlKehadiran($val->id,$sms,3))."</td>";
									echo "<td>".str_replace(".",",",$this->mdl->getJmlKehadiran($val->id,$sms,4))."</td>";
									echo "<td>".str_replace(".",",",$nilaipeng)."</td>";
									
									  echo "</tr>"; 
								  }	
								
								
								
								?> 
							</table>
							 
			 
  				 
		 
 
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=legger.xls");
?>
