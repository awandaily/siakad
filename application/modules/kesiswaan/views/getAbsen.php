 <?php 
$mapelajar=$this->input->get_post("kelas");
$datamapelajar=$this->db->get_where("v_mapel_ajar",array("id"=>$mapelajar))->row();
$idkelas=isset($datamapelajar->id_kelas)?($datamapelajar->id_kelas):"";
if(!$idkelas) { echo "<i>Silahkan Pilih Kelas</i>..."; return false;};
$idmapel=$datamapelajar->id_mapel;
  $datax=$this->db->get_where("tr_sts_kehadiran");
  $jmlkikd=$datax->num_rows();
  $sms=$this->m_reff->semester();//$this->input->get_post("sms");
  if($sms==2) //jika genap
  {
	  $nama_ujian="UAS";
	  $id_kate=3;
  }elseif($sms==1){
	   $nama_ujian="UTS";
	  $id_kate=2;
  }
 ?> <div class="table-responsive">
  <span class="col-md-2 pull-right">
		 	<a href='<?php echo base_url() ?>kesiswaan/download_absenmapel/?idkelas=<?php echo $idkelas;?>&idmapel=<?php echo $idmapel;?>' class="waves-effect btn bg-teal btn-block">Download</a>

</span>

                               <table id='tables' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								 
								<tr><th class='bg-teal sadow' rowspan="2" width='15px'>&nbsp;NO</th>
									<th class='bg-teal sadow' rowspan="2" >NAMA SISWA</th>
									<th class='bg-teal sadow' rowspan="2" > NIS</th>
									<th   class='sadow bg-teal' align="center" colspan="<?php echo $jmlkikd+1;?>"><center>KEHADIRAN</center></th>
									 
								 
								</tr>
								<tr  class='sadow bg-teal'>			
									
									
									 <?php
									
									 foreach($datax->result() as $data)
									 {
										 echo "<th class='thead' > ".$data->nama."</th>";
									 }
									 ?>
								   <th class='thead' >Persentase</th> 
								 
								 	 
									
								 	  
									
								</tr>
								<?php
								$no=1;
								$datakelas=$this->mdl->dataSiswa($idkelas); 
								foreach($datakelas as $val)
								{
									echo "<tr>
									<td>".$no++."</td>
									<td>".$val->nama."</td>
									<td>".$val->nis."</td>";
									$tatapmuka=0;
									 foreach($datax->result() as $data)
									 {
										 
										 
											  $class="font-bold";
										 
										 echo "<td class='".$class."'> ".$jml= $this->mdl->kehadiran($val->id,$idmapel,$sms,$data->id)."</td>";
										 $tatapmuka=$jml+$tatapmuka;
									 }
										if($tatapmuka){
										$tot=(($this->mdl->kehadiran($val->id,$idmapel,$sms,1)/$tatapmuka)*100);
										}else{
										$tot=0;	
										}
										 echo "<td class='font-bold'> ". $tot." %</td>"; 
									  
									 	  
								echo " </tr>";
								}
								
								?>
								 
								
							</table>
							</div>		
							
						 