<div class="table-responsive"> <table class="entry table-hover" width="100%">
										<tr class="bg-blue">
											<th width="10px">NO</th>
											<th>BULAN</th>
											<th width="100px" align="center"><center>TOTAL JAM</center></th>
											<th width="100px" align="center"><center>VALID</center></th>
											<th width="100px"><center>  FREE</center></th>
											<th width="100px"><center>  INVALID</center></th>
											<th width="100px"><center>  TOTAL   VALID</center></th>
											<th width="100px"><center>  PERSENTASE</center></th>
											
											  <?php
											   $thn_ini=$this->m_reff->tahun();
											     $sms=$this->m_reff->semester();
  $tahun_1=$this->m_reff->goField("tr_tahun_ajaran","nama","where id='".$thn_ini."'");
  $awal_bulan=$this->m_reff->goField("tr_semester","tgl_mulai","where id='".$sms."'");
  $bln_ini=date("Y-m");
												  if($sms==2)
												  {
												    $tahun_awal=substr($tahun_1,5,4);
												  }else{
												    $tahun_awal=substr($tahun_1,0,4);
												  }
												  
	 $awal_bulan=substr($awal_bulan,0,2);
	 $bln=number_format($awal_bulan,0);
	  
	 $ym=$tahun_awal."-".$awal_bulan;
	 	 
			 
	 ?>
	 
										</tr>
										<?php 
										//$tahun=$this->m_reff->goField("tr_tahun_ajaran","nama","where id='".$tahun."'");
										$thn_ini=date("Y"); 
										 
										$row=5; 
										for($i=0;$i<=$row;$i++)
										{
										$kode=$this->tanggal->tambahBln($ym,$i);//Y-m
										$a=$this->mdl->jmlMasukJam($kode);
										$b=$this->mdl->jmlFreeJam($kode);
										$c=$this->mdl->jmlBlokJam($kode);
										$totalValid=($a+$b);
										$totalJam=($a+$c);
										if($totalJam==0)
										{
											$persen="-";
										}else{
											$persen=number_format((($totalValid/$totalJam)*100),0,",",".")." %";
										}
										echo "<tr class='col-black'>
										<td>".($i+1)."</td>
										<td>".$this->tanggal->bulan(substr($kode,5,2)). " - ".substr($kode,0,4)."</td>
										<td align='center'>".$totalJam."</td>
										<td align='center'>".$a."</td>
										<td align='center'>".$b."</td>
										<td align='center'>".$c."</td>
										<td align='center'><b>".$totalValid."</b></td>
										<td align='center'><b>".$persen."</b> </td>
										</tr> ";
										} 
										 
										?>
										
										</table>
										</div>