 <div class="row clearfix">
 
 	<?php
$db=$this->mdl->jadwalHari();
foreach($db as $val)
{?>

	  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="bodyd" style="min-height:200px;padding:10px">
						<!---------------------->
						  <span style="font-size:18px"><?php echo $this->m_reff->goField("tr_hari","nama","where id='".$val->hari."'");?></span>
                              <table class="entry" width="100%">
							  <tr>
							  <th>#</th><th>MATA PELAJARAN </th><th>PENGAJAR</th><th>JAM</th>
							  </tr>
							   <?php
							   $no=1; $dataMapel=$this->mdl->dataMapel($val->hari); $stop="";
							   foreach($dataMapel as $data)
							   {
							   if($data->jam_masuk<=date("H:i:s") and $data->jam_keluar>=date("H:i:s") and $stop!="stop" and date("N")==$val->hari)
								{
								  $sty="style='background-color:orange'"; $stop="stop";
								}else{
								   $sty="";
								}		 
								
								 echo "<tr $sty ><td>".$no++."</td>
												 <td>".$this->m_reff->goField("tr_mapel","nama","where id='".$data->id_mapel."'")."</td>
												 <td>".$this->m_reff->goField("data_pegawai","nama","where id='".$data->id_guru."'")."</td>
												 <td>".$data->jam_masuk." - ".$data->jam_keluar."</td>";
												 
							   }
							   ?>
							  </table>
                      
						<!---------------------->
						 
                           </div>
						</div>
         </div>
<?php  } ?>	


	
 </div>
						
						
						
						
						
						
						
 