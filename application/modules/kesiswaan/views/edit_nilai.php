<?php
	$sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
	$res=$this->db->get_where("data_nilai",array("id"=>$id))->row();
	$id_kelas=$res->id_kelas;
	$id_kikd=$res->id_kikd;
	$nama_nilai=$res->nama_nilai;
	$k_nilai=$res->id_kategory_nilai;
	$id_mapel=$res->id_mapel;
	$id_semester=$res->id_semester;
	$this->session->set_userdata("code",$res->code);
	if($k_nilai==1)
	{
	$attr=array(
	"id_kikd"=>$res->id_kikd,
	"id_kelas"=>$res->id_kelas,
	"nama_nilai"=>$res->nama_nilai,
	"id_kategory_nilai"=>$res->id_kategory_nilai,
	"id_mapel"=>$res->id_mapel,
	"id_semester"=>$res->id_semester,
	"code"=>$res->code
    );
}else{
    	$attr=array(
 
	"id_kelas"=>$res->id_kelas,
	"nama_nilai"=>$res->nama_nilai,
	"id_kategory_nilai"=>$res->id_kategory_nilai,
	"id_mapel"=>$res->id_mapel,
	"id_semester"=>$res->id_semester,
	"code"=>$res->code
    );
}
 
?> 
  <?php
 $cekmapelglobal=$this->m_reff->goField("tr_mapel","mapel_global","where id='".$id_mapel."'");
 ?>
<div class="main-content-body">
					<div class="row row-sm">
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
							<div class="card  overflow-hidden project-card">
								<div class="card-body">
								<?php 
                                   //       echo $this->m_reff->goField("tr_kategory_nilai","nama","where id='".$k_nilai."'");
									//   $dbk=$this->mdl->dataKategoryNilai();
									//   foreach($dbk as $val){
								//		 $ar[$val->id]=$val->nama;
								//	   }
								//	   $datar=$ar;
								//	    form_dropdown("id_kategory_nilai",$datar,$k_nilai,"class='form-control show-tick' disabled onchange='setK()' ");
									   ?>
            <input type="hidden" name="id_kategory_nilai" value="<?php echo $k_nilai;?>">

            <?php
						if($k_nilai==1){?>

                <?php  
                            //  echo $this->m_reff->goField("tm_kikd","CONCAT(kd3_no,' - ',kd4_no)","where id='".$id_kikd."'");              
//	$mapel_ajar=$this->m_reff->goField("tm_mapel_ajar","id","where id_mapel='".$id_mapel."' and id_kelas='".$id_kelas."' and id_guru='".$this->mdl->idu()."' and id_semester='".$sms."' and id_tahun='".$tahun."' ");

//	  $dbk=$this->db->query("SELECT * from tm_kikd where id_mapel_ajar='".$mapel_ajar."' 
//	  and id_guru='".$this->mdl->idu()."' and id_semester='".$sms."' and id_tahun='".$tahun."'
	//			 ORDER BY CAST(SUBSTR(kd3_no,3,3) AS SIGNED INTEGER),id ASC  ")->result();
	//								   $ar="";
	//							   foreach($dbk as $val){
		//								 $ar[$val->id]=$val->kd3_no." - ".$val->kd3_desc." | ".$val->kd4_no." - ".$val->kd4_desc;
		//							   }
		//							   $datar=$ar;
		//							echo   form_dropdown("id_kikd",$datar,$id_kikd,"class='form-control show-tick' disabled readonly onchange='setK()' ");
									   ?>
                    <input type="hidden" name="id_kikd" value="<?php echo $id_kikd;?>">

                    <?php } ?>

                        <input type="hidden" class='form-control' name="nama_nilai" value="<?php echo $nama_nilai;?>" onchange="setNama()">

                        <table width="100%" class='entry'>
                            <tr>
                                <td>
                                    <span class="col-teal">Kategory   </span></td>
                                <td> <span class="col-black"> <?php 
							 if($id_semester==2 and $k_nilai==3){
							     $n="UKK";
							 }else{
							     $n=$this->m_reff->goField("tr_kategory_nilai","nama","where id='".$k_nilai."'");
							 }

							 echo $n;?></span></td>
                            </tr>
                            <?php	if($k_nilai==1){?>
                                <tr>
                                    <td>
                                        <span class="col-teal">KD.KI </span></td>
                                    <td> <span class="col-black"> <?php echo $this->m_reff->goField("tm_kikd","CONCAT(kd3_no,' - ',kd4_no)","where id='".$id_kikd."'"); ?></span></td>
                                </tr>
                                <?php } ?>
                                    
                                    <tr>
                                        <td>
                                            <span class="col-teal">KELAS </span></td>
                                        <td>
                                            <?php echo $this->m_reff->namaKelas($id_kelas);?>
                                                </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="col-teal">MAPEL</span></td>
                                        <td>
                                            <?php echo $this->m_reff->namaMapel($id_mapel);?>
                                                </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><span class="col-teal">SEMESTER</span></td>
                                        <td>
                                            <?php echo $this->m_reff->namaSemester($id_semester);?>
                                                </span>
                                        </td>
                                    </tr>

                        </table>
                        <hr>
                        <div class="row">
                        	<div class="col-md-12">
	                        	<div class="form-group">
	                        		<label>KETERANGAN</label><br>
	                        		<textarea name="" class="form-control" style="resize: none;height: 200px;" onchange="setKet(this.value, '<?php echo $res->code ?>')"><?php echo $nama_nilai;?></textarea>
	                        	</div>
	                        </div>
                        </div>
								</div>
							</div>
						</div>
						<div class="col-xl-8 col-lg-6 col-md-6 col-sm-12">
							<div class="card overflow-hidden project-card">
								<div class="card-body">
									<div class="d-flex">
									<table class="table table-bordered">
									<tr class="bg-blue">
										<th width="10px">NO</th>
										<th>NAMA SISWA</th>
										<?php
											if($k_nilai==1){?>
											<th>
												<center> NILAI PENGETAHUAN (KD)</center>
											</th>
											<th>
												<center> NILAI KETERAMPILAN (KI)</center>
											</th>
											<?php }else {?>
												<th>
													<center> NILAI </center>
												</th>
												<?php } ?>
									</tr>
            <?php
								$data=$this->mdl->dataSiswa($id_kelas); $no=1;
								if($k_nilai==1){ 
								foreach($data as $val)
								{

									if($cekmapelglobal==1 OR $val->id_agama<2)
									 {
												echo "<tr  > 
												<td>".$no++."</td>
												<td>".$val->nama."</td>
												<td><input maxlength='4' value='".$this->mdl_nilai->getNilaiSiswa($attr,$val->id)."' type='text' name='nilai' onchange='setNilai(".$no.")' id='id".$no."' mapel='".$id_mapel."' kelas='".$val->id_kelas."' id_siswa='".$val->id."' ></td>
												<td><input maxlength='4' value='".$this->mdl_nilai->getNilaiSiswaKi($attr,$val->id)."' type='text' name='nilai_ki' onchange='setNilaiKi(".$no.")' id='idk".$no."' mapel='".$id_mapel."' kelas='".$val->id_kelas."' id_siswa='".$val->id."' ></td>
												</tr>"; 
									 }else{
									 echo "<tr  > 
												<td>".$no++."</td>
												<td>".$val->nama."</td>
												<td><i>Non-muslim</i></td>
												<td><i>Non-muslim</i></td>
												 </tr>"; 
									 }
								}
						}else{
								foreach($data as $val)
								{
									if($cekmapelglobal==1 OR $val->id_agama<2)
									 {
									echo "<tr  > 
									<td>".$no++."</td>
									<td>".$val->nama."</td>

									<td><input maxlength='4' value='".$this->mdl_nilai->getNilaiSiswa($attr,$val->id)."' type='text' name='nilai' onchange='setNilai(".$no.")' id='id".$no."' mapel='".$id_mapel."' kelas='".$val->id_kelas."' id_siswa='".$val->id."' ></td>
									 </tr>"; 
									 }else{
									  echo "<tr  > 
												<td>".$no++."</td>
												<td>".$val->nama."</td>
												<td><i>Non-muslim</i></td>

												 </tr>"; 
									 }
								}

						}
								?>
                <tr>
                </tr>

        </table>
		</th>
      </tr>
    </thead>
  </table>	
								</div>
							</div>
						</div>
				</div>
				</div>

<table class="table table-bordered">
    <thead>	
      <tr>
        <th>
		
		</th>
        <th>
		jjjj
		</th>
      </tr>
	  <tr>
        <th>
		2
		</th>
		<th>
		
</div>
<div class="col-md-12">
    <div class="body">

        <?php 
                                   //       echo $this->m_reff->goField("tr_kategory_nilai","nama","where id='".$k_nilai."'");
									//   $dbk=$this->mdl->dataKategoryNilai();
									//   foreach($dbk as $val){
								//		 $ar[$val->id]=$val->nama;
								//	   }
								//	   $datar=$ar;
								//	    form_dropdown("id_kategory_nilai",$datar,$k_nilai,"class='form-control show-tick' disabled onchange='setK()' ");
									   ?>
            <input type="hidden" name="id_kategory_nilai" value="<?php echo $k_nilai;?>">

            <?php
						if($k_nilai==1){?>

                <?php  
                            //  echo $this->m_reff->goField("tm_kikd","CONCAT(kd3_no,' - ',kd4_no)","where id='".$id_kikd."'");              
//	$mapel_ajar=$this->m_reff->goField("tm_mapel_ajar","id","where id_mapel='".$id_mapel."' and id_kelas='".$id_kelas."' and id_guru='".$this->mdl->idu()."' and id_semester='".$sms."' and id_tahun='".$tahun."' ");

//	  $dbk=$this->db->query("SELECT * from tm_kikd where id_mapel_ajar='".$mapel_ajar."' 
//	  and id_guru='".$this->mdl->idu()."' and id_semester='".$sms."' and id_tahun='".$tahun."'
	//			 ORDER BY CAST(SUBSTR(kd3_no,3,3) AS SIGNED INTEGER),id ASC  ")->result();
	//								   $ar="";
	//							   foreach($dbk as $val){
		//								 $ar[$val->id]=$val->kd3_no." - ".$val->kd3_desc." | ".$val->kd4_no." - ".$val->kd4_desc;
		//							   }
		//							   $datar=$ar;
		//							echo   form_dropdown("id_kikd",$datar,$id_kikd,"class='form-control show-tick' disabled readonly onchange='setK()' ");
									   ?>
                    <input type="hidden" name="id_kikd" value="<?php echo $id_kikd;?>">

                    <?php } ?>

                        <input type="hidden" class='form-control' name="nama_nilai" value="<?php echo $nama_nilai;?>" onchange="setNama()">

                        <table width="100%" class='entry'>
                            <tr>
                                <td>
                                    <span class="col-teal">Kategory   </span></td>
                                <td> <span class="col-black"> <?php 
							 if($id_semester==2 and $k_nilai==3){
							     $n="UKK";
							 }else{
							     $n=$this->m_reff->goField("tr_kategory_nilai","nama","where id='".$k_nilai."'");
							 }

							 echo $n;?></span></td>
                            </tr>
                            <?php	if($k_nilai==1){?>
                                <tr>
                                    <td>
                                        <span class="col-teal">KD.KI </span></td>
                                    <td> <span class="col-black"> <?php echo $this->m_reff->goField("tm_kikd","CONCAT(kd3_no,' - ',kd4_no)","where id='".$id_kikd."'"); ?></span></td>
                                </tr>
                                <?php } ?>
                                    
                                    <tr>
                                        <td>
                                            <span class="col-teal">KELAS </span></td>
                                        <td>
                                            <?php echo $this->m_reff->namaKelas($id_kelas);?>
                                                </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="col-teal">MAPEL</span></td>
                                        <td>
                                            <?php echo $this->m_reff->namaMapel($id_mapel);?>
                                                </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><span class="col-teal">SEMESTER</span></td>
                                        <td>
                                            <?php echo $this->m_reff->namaSemester($id_semester);?>
                                                </span>
                                        </td>
                                    </tr>

                        </table>
                        <hr>
                        <div class="row">
                        	<div class="col-md-12">
	                        	<div class="form-group">
	                        		<label>KETERANGAN</label><br>
	                        		<textarea name="" class="form-control" style="resize: none;height: 200px;" onchange="setKet(this.value, '<?php echo $res->code ?>')"><?php echo $nama_nilai;?></textarea>
	                        	</div>
	                        </div>
                        </div>
    </div>
</div>

<div class="col-md-8" style="border-left:#9E9E9E solid 1px;margin-top:-20px">
    <div class="scroll">
        <table class="entry table-hover" width="100%">
            <tr class="bg-blue">
                <th width="10px">NO</th>
                <th>NAMA SISWA</th>
                <?php
					if($k_nilai==1){?>
                    <th>
                        <center> NILAI PENGETAHUAN (KD)</center>
                    </th>
                    <th>
                        <center> NILAI KETERAMPILAN (KI)</center>
                    </th>
                    <?php }else {?>
                        <th>
                            <center> NILAI </center>
                        </th>
                        <?php } ?>
            </tr>
            <?php
								$data=$this->mdl->dataSiswa($id_kelas); $no=1;
								if($k_nilai==1){ 
								foreach($data as $val)
								{

									if($cekmapelglobal==1 OR $val->id_agama<2)
									 {
												echo "<tr  > 
												<td>".$no++."</td>
												<td>".$val->nama."</td>
												<td><input maxlength='4' value='".$this->mdl_nilai->getNilaiSiswa($attr,$val->id)."' type='text' name='nilai' onchange='setNilai(".$no.")' id='id".$no."' mapel='".$id_mapel."' kelas='".$val->id_kelas."' id_siswa='".$val->id."' ></td>
												<td><input maxlength='4' value='".$this->mdl_nilai->getNilaiSiswaKi($attr,$val->id)."' type='text' name='nilai_ki' onchange='setNilaiKi(".$no.")' id='idk".$no."' mapel='".$id_mapel."' kelas='".$val->id_kelas."' id_siswa='".$val->id."' ></td>
												</tr>"; 
									 }else{
									 echo "<tr  > 
												<td>".$no++."</td>
												<td>".$val->nama."</td>
												<td><i>Non-muslim</i></td>
												<td><i>Non-muslim</i></td>
												 </tr>"; 
									 }
								}
						}else{
								foreach($data as $val)
								{
									if($cekmapelglobal==1 OR $val->id_agama<2)
									 {
									echo "<tr  > 
									<td>".$no++."</td>
									<td>".$val->nama."</td>

									<td><input maxlength='4' value='".$this->mdl_nilai->getNilaiSiswa($attr,$val->id)."' type='text' name='nilai' onchange='setNilai(".$no.")' id='id".$no."' mapel='".$id_mapel."' kelas='".$val->id_kelas."' id_siswa='".$val->id."' ></td>
									 </tr>"; 
									 }else{
									  echo "<tr  > 
												<td>".$no++."</td>
												<td>".$val->nama."</td>
												<td><i>Non-muslim</i></td>

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
</div>

<div class="row clearfix">&nbsp;</div>
<input type="hidden" name="namanilai" value="<?php echo $nama_nilai;?>">
<input type="hidden" name="knilai" value="<?php echo $k_nilai;?>">

 <script>

 	function setKet(ket, code){
		$.post("<?php echo site_url("kesiswaan/setKet"); ?>",{ket:ket, code:code},function(){
				//$("[name='namanilai']").val(nama);	 
		});
 	}

 function setNama()
 {	 var id_kikd=$("[name='id_kikd']").val();
	 var id_kelas="<?php echo $id_kelas;?>";
	 var id_mapel="<?php echo $id_mapel;?>";
	 var nama_nilai=$("[name='namanilai']").val();
	 var id_sms="<?php echo $id_semester;?>";
	 var nama=$("[name='nama_nilai']").val();
	 var k_nilai=$("[name='knilai']").val();
			$.post("<?php echo site_url("kesiswaan/updateSetNamaNilai"); ?>",{id_kikd:id_kikd,nama:nama,id_sms:id_sms,k_nilai:k_nilai,nama_nilai:nama_nilai,id_mapel:id_mapel,id_kelas:id_kelas},function(){
					$("[name='namanilai']").val(nama);	 
			});
 } 
 
 function setK()
 {
	 var id="<?php echo $id;?>";
	 var id_kelas="<?php echo $id_kelas;?>";
	 var id_mapel="<?php echo $id_mapel;?>";
	 var nama_nilai=$("[name='namanilai']").val();
	 var id_sms="<?php echo $id_semester;?>";
	 var ka_nilai=$("[name='id_kategory_nilai']").val();
	 var id_kikd=$("[name='id_kikd']").val();
	 var k_nilai=$("[name='knilai']").val();
	 var idkikdawal="<?php echo $id_kikd;?>";
			  $.post("<?php echo site_url("kesiswaan/updateSetKaNilai"); ?>",{idkikdawal:idkikdawal,id_kikd:id_kikd,ka_nilai:ka_nilai,id_sms:id_sms,k_nilai:k_nilai,nama_nilai:nama_nilai,id_mapel:id_mapel,id_kelas:id_kelas},function(){
					$("[name='knilai']").val(ka_nilai);	 
		      });
 } 
 
 function setNilai(no)
 {
	 var id_kelas=$("#id"+no).attr("kelas");
	 var id_mapel=$("#id"+no).attr("mapel");
	 var id_siswa=$("#id"+no).attr("id_siswa");
	 var nilai=$("#id"+no).val();
	 var nama_nilai=$("[name='nama_nilai']").val();
	 var id_kikd=$("[name='id_kikd']").val();
	 var k_nilai=$("[name='id_kategory_nilai']").val();
			  $.post("<?php echo site_url("kesiswaan/insertNilai"); ?>",{id_kikd:id_kikd,k_nilai:k_nilai,nama_nilai:nama_nilai,id_siswa:id_siswa,id_mapel:id_mapel,id_kelas:id_kelas,nilai:nilai},function(){
					 
		      });
 } 
 
 function setNilaiKi(no)
 {
	 var id_kelas=$("#id"+no).attr("kelas");
	 var id_mapel=$("#id"+no).attr("mapel");
	 var id_siswa=$("#id"+no).attr("id_siswa");
	 var nilai=$("#idk"+no).val();
	 var nama_nilai=$("[name='nama_nilai']").val();
	 var id_kikd=$("[name='id_kikd']").val();
	 var k_nilai=$("[name='id_kategory_nilai']").val();
			  $.post("<?php echo site_url("kesiswaan/insertNilaiKi"); ?>",{id_kikd:id_kikd,k_nilai:k_nilai,nama_nilai:nama_nilai,id_siswa:id_siswa,id_mapel:id_mapel,id_kelas:id_kelas,nilai:nilai},function(){
					 
		      });
 }
 </script> 