  <div class="body">
	  <?php
	  $idu=$this->input->post("id");
	  $dataMapelAjar=$this->m_guru->mapelAjar($idu);
	  $i=0;
	  foreach($dataMapelAjar as $val){
		  if($i==0){ $color="bg-teal"; $i++;}
		  elseif($i==1){ $color="bg-pink"; $i++; }
		  elseif($i==2){ $color="bg-green"; $i++; }
		  elseif($i==3){ $color="bg-blue"; $i++; }
		  elseif($i==4){ $color="bg-orange"; $i++; }
		  elseif($i==5){ $color="bg-red"; $i++; }
		  elseif($i==6){ $color="bg-lime"; $i++; }
		  elseif($i==7){ $color="bg-brown"; $i++; }
		  elseif($i==8){ $color="bg-blue-grey";  $i++;}
		  else{ $color="bg-purple"; $i=0; } 
	 
	  
	  $jmlPertemuanPerMapelPerKelas=$this->m_guru->jmlValidPerMapelPerKelas($idu,$val->id_mapel,$val->id_kelas); //mapelajar
	  $totalJamMengajar=$this->m_guru->totalJamMengajarPerKelasMapel($idu,$val->id);
	  $persentase=str_replace(",",".",$this->m_reff->persentase($jmlPertemuanPerMapelPerKelas,$totalJamMengajar));
		?><span class='<?php echo str_replace("bg","col",$color);?>'  >
						<b>	PROGRESS MENGAJAR : <?php echo $this->m_reff->goField("v_kelas","nama","where id='".$val->id_kelas."'");?> - <?php echo $this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."'");?>
						</b>			<b class="pull-right"><?php echo $jmlPertemuanPerMapelPerKelas;?>/<?php echo $totalJamMengajar;?> Jam</b> </span>
							<div class="progress">  
							
									
                                <div class="progress-bar <?php echo $color;?> progress-bar-striped active" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" 
								style="width: <?php echo number_format($persentase,0,",",".")?>%">
                                    <?php echo $persentase;?> %
							   </div>
                            </div>
	  <?php } ?>					
       </div>
 