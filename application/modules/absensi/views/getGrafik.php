 <table class="entry table-hover" width="100%">
										<tr class="bg-blue">
											<th width="10px">NO</th>
											<th>BULAN</th>
											<th width="100px" align="center"><center>  MASUK</center></th>
											<th width="100px"><center>  IZIN</center></th>
											<th width="100px"><center>  ALFA</center></th>
											
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
										$tahun=$this->m_reff->goField("tr_tahun_ajaran","nama","where id='".$tahun."'");
										$thn_ini=date("Y"); 
										 
										$row=5; 
										for($i=0;$i<=$row;$i++)
										{
										$kode=$this->tanggal->tambahBln($ym,$i);//Y-m
										echo "<tr class='col-black'>
										<td>".($i+1)."</td>
										<td>".$this->tanggal->bulan(substr($kode,5,2)). " - ".substr($kode,0,4)."</td>
										<td align='center'>".$this->mdl->jmlMasuk($kode)."</td>
										<td align='center'>".$this->mdl->jmlIzin($kode)."</td>
										<td align='center'>".$this->mdl->jmlAlfa(substr($kode,0,4),substr($kode,5,2))."</td>
										</tr> ";
										} 
										 
										?>
										
										</table>