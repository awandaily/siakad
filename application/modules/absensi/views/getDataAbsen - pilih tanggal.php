<?php $selisih=1+$this->tanggal->selisih($tgl1,$tgl2); ?> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	   
							  <table class="entry" width="100%">
							  <tr>
							   <th colspan="<?php echo $selisih+1;?>" align="center"> <center>PERIODE TANGGAL <?php echo $start?> s.d <?php echo $end?></center></th>
							  </tr>
							  <tr>
							  <td>Tanggal</td>
									<?php 
									for($i=1;$i<=$selisih;$i++)
									{
										echo "<td>1</td>";
									}
									?>
							  </tr>
							  <tr>
							  <td>Absen</td>
									<?php 
									for($i=1;$i<=$selisih;$i++)
									{
										echo "<td>1</td>";
									}
									?>
							  </tr>
							  </table>  
         </div>
	
 			
						
						
		 