 <table class="entry table-hover" width="100%">
										<tr class="bg-blue">
											<th width="10px">NO</th>
											<th>BULAN</th>
											<th width="100px" align="center"><center>  MASUK</center></th>
											<th width="100px"><center>  IZIN</center></th>
											<th width="100px"><center>  ALFA</center></th>
										</tr>
										
										
										
										
																				  <?php
  $tahun_1=$this->m_reff->goField("tr_tahun_ajaran","nama","where id='".$tahun."'");
  $awal_bulan=$this->m_reff->goField("tr_tahun_ajaran","tgl_pindah","where id='".$tahun."'");
  $bln_ini=date("Y-m");
	 $awal_bulan=substr($awal_bulan,5,2);
	 $bln=number_format($awal_bulan,0);
	 $tahun_awal=substr($tahun_1,0,4);
	 $ym=$tahun_awal."-".$awal_bulan;
	 	 
			 
	 ?>
		
		
		
										<?php 
										$tahun=$this->m_reff->goField("tr_tahun_ajaran","nama","where id='".$tahun."'");
										$thn_ini=date("Y"); 
										//if($thn_ini==substr($tahun,0,4))
									//	{	$row=date("m");	}else{	$row=11;   } 
										$row=11; 
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