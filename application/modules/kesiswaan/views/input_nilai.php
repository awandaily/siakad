 <?php
 $cekmapelglobal=$this->m_reff->goField("tr_mapel","mapel_global","where id='".$id_mapel."'");
 $this->session->userdata("code");
 $token=date("dHis");
 ?>
 <div class="scroll">
                <table class="entry table-hover" width="100%" >
										<tr class="bg-blue">
											<th width="10px">NO</th>
											<th>NAMA SISWA</th>
										 
											<?php
											 if($k_nilai==1){?>
											<th  ><center>  NILAI PENGETAHUAN (KD)</center></th>
											<th  ><center>  NILAI KETERAMPILAN (KI)</center></th>
											 <?php }else {?>
											 <th  ><center>  NILAI </center></th>
											 <?php } ?>
										</tr>	
								<?php
								$data=$this->m_reff->getDataSiswa($id_kelas); $no=1;
									if($k_nilai==1){ 
											foreach($data as $val)
											{
											
											if($cekmapelglobal==2 AND $val->id_agama>1)
											{	echo "<tr>
												<td>".$no++."</td>
												<td>".$val->nama."</td>
												<td><i>non-muslim</i></td>
												<td><i>non-muslim</i></td>
												 </tr>"; 
												
											}else{
												echo "<tr>
												<td>".$no++."</td>
												<td>".$val->nama."</td>
												<td><input maxlength='4' type='text' name='nilai' onchange='setNilai(".$no.")' id='id".$no.$token."' mapel='".$id_mapel."' kelas='".$val->id_kelas."' id_siswa='".$val->id."' ></td>
												<td><input maxlength='4' type='text' name='nilai_ki' onchange='setNilaiKi(".$no.")' id='idk".$no.$token."' mapel='".$id_mapel."' kelas='".$val->id_kelas."' id_siswa='".$val->id."' ></td>
												</tr>"; 
											}												
												
												
											
											}
									}else{
											 foreach($data as $val)
											{
												if($cekmapelglobal==2 AND $val->id_agama>1)
											{
												echo "<tr>
												<td>".$no++."</td>
												<td>".$val->nama."</td>
												<td><i>non-muslim</i></td>
												 
												 </tr>";
											}else{
												echo "<tr>
												<td>".$no++."</td>
												<td>".$val->nama."</td>
												<td><input maxlength='4' type='text' name='nilai' onchange='setNilai(".$no.")' id='id".$no.$token."' mapel='".$id_mapel."' kelas='".$val->id_kelas."' id_siswa='".$val->id."' ></td>
											 	</tr>"; 
											}
											
											
											
											}

									}
								?>
										<tr>
										</tr>										
										
				 </table>
				 <br>
  </div>  			 
  
 <script> 
 function setNilai(no)
 {   
	 var id_kelas=$("#id"+no+"<?php echo $token; ?>").attr("kelas");
	 var id_mapel=$("#id"+no+"<?php echo $token; ?>").attr("mapel");
	 var id_kikd="<?php echo $id_kikd;?>";
	 var id_siswa=$("#id"+no+"<?php echo $token; ?>").attr("id_siswa");
	 var nilai=$("#id"+no+"<?php echo $token; ?>").val();
	 var nama_nilai="<?php echo $nama_nilai;?>";
	 var k_nilai="<?php echo $k_nilai;?>";
			  $.post("<?php echo site_url("kesiswaan/insertNilai"); ?>",{id_kikd:id_kikd,k_nilai:k_nilai,nama_nilai:nama_nilai,id_siswa:id_siswa,id_mapel:id_mapel,id_kelas:id_kelas,nilai:nilai},function(){
					 
		      });
 }
 function setNilaiKi(no)
 {    
	 var id_kelas=$("#id"+no+"<?php echo $token; ?>").attr("kelas");
	 var id_mapel=$("#id"+no+"<?php echo $token; ?>").attr("mapel");
	 var id_kikd="<?php echo $id_kikd;?>";
	 var id_siswa=$("#id"+no+"<?php echo $token; ?>").attr("id_siswa");
	 var nilai=$("#idk"+no+"<?php echo $token; ?>").val();
	 var nama_nilai="<?php echo $nama_nilai;?>";
	 var k_nilai="<?php echo $k_nilai;?>";
			  $.post("<?php echo site_url("kesiswaan/insertNilaiKi"); ?>",{id_kikd:id_kikd,k_nilai:k_nilai,nama_nilai:nama_nilai,id_siswa:id_siswa,id_mapel:id_mapel,id_kelas:id_kelas,nilai:nilai},function(){
					 
		      });
 }
 </script> 