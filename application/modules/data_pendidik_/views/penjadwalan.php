 
 <?php
 $token=date('His');
 ?>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" >
                        <div class="header"> 
						
						 
						
						<h2>PENJADWALAN</h2>
                           
                        </div>
						    <div class="body">
                           <div class="row clearfix">
						   
								  
								
								<div class="col-md-6">
                                    <select class="form-control show-tick" id="id_kelas" data-live-search="true"   onchange="kelasLoad()">
                                       
                                        <option value="">=== JADWAL SEDANG BERLANGSUNG ===</option>
										
										
											<?php 
										   $db=$this->db->get("tr_tingkat")->result();
										   foreach($db as $val){
											   echo "<optgroup label='TINGKAT ".$val->nama."'>";
												 
												   $dbs=$this->db->get_where("v_kelas",array("id_tk"=>$val->id))->result();
												   foreach($dbs as $vals){
													   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
												   }
												  
											   echo "</optgroup>";
										   }
										   ?>
									  
                                    </select>
                                </div> 
								
								<div class="col-md-6">
                                  
                                            <div class="form-line">
                                         <select class="form-control show-tick" id="hari"  onchange="kelasLoad()">
                                      
                                        <option value="1">Hari Senin</option>
                                        <option value="2">Hari Selasa</option>
                                        <option value="3">Hari Rabu</option>
                                        <option value="4">Hari Kamis</option>
                                        <option value="5">Hari Jum'at</option>
                                     
                                    </select>
                                            </div>
                                  <script>
                                  $("#hari").val(<?php echo date("N");?>);
								  </script>
                                    
                                </div>
						 
							 
						    
                           </div>
						  
				 <div id="area_lod">
			            <div id="isi">      
						<center>	<b>JADWAL SEDANG BERLANGSUNG <?php  $jamkenow=$jam=$this->m_reff->jam_aktif();?></b> </center>
							<div class="entry">
							    <div class="table-responsive">
							<table>
							<thead>
							<th>NO</th>
							<th>PENGAJAR</th>
							<th>KELAS</th>
							<th>MAPEL</th>
							<th>STATUS</th>
							</thead>
							<?php
							$no=1;
							$data=$this->db->get("v_kelas")->result();
							foreach($data as $val)
							{	$get=$this->mdl->getkbmnow($val->id,$jam,date('N'));
								$idguru=isset($get->id_guru)?($get->id_guru):"";
								$idmapel=isset($get->id_mapel)?($get->id_mapel):"";
								$idJadwal=isset($get->id)?($get->id):"";
								$cek=$this->mdl->cekKehadiranGuru($idJadwal,$idguru);
								$cekoff=$this->mdl->cekDiliburkan($idJadwal,$idguru);
								if($cek){ 
											 
											$jam_blok=$cek->jam_blok;
										 
											if(strpos($jam_blok,",".$jamkenow.",")===false)
											{
											    if($cek->sumber==1){
											        $masukket="MASUK";$warnamasuk=" bg-teal ";$alasanizin="";
											    }elseif($cek->sumber==2){
											        $masukket="TUGAS";$warnamasuk=" bg-indigo ";$alasanizin="";
											    }else{
											        $masukket="IZIN";$warnamasuk=" bg-deep-orange ";
											        $alasanizin=$cek->izin;
											    }
												$hadir="<span class='col-blue'> $masukket : $alasanizin </span>";
											 
											}else{
												$hadir="<span class='col-red'> DIBLOK </span>";
												 
											} 
										}else{
											$hadir="BLUM ABSEN";
								  }
								
								if($cekoff)
								{
									$hadir="<i>Dinonaktifkan</i>";
								}
								
								
								
								
								echo "<tr>
								<td>".$no++."</td>
								<td>".$this->m_reff->goField("v_pegawai","nama_lengkap","where id='".$idguru."' ")."</td>
								<td>".$val->nama."</td>
								<td>".$this->m_reff->goField("tr_mapel","nama","where id='".$idmapel."' ")."</td>
								<td>".$hadir."</td>
								
								</tr>";
							};?>
							
							</table>
							</div>
							</div>
						</div>						
					</div>						
					</div>	
                           <!----->
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
 
 <script>
 
 

function detail(id,nama)
{ 
	$("#judul_mdl_edit").html(nama);
				   $("#mdl_formSubmit_edit").modal( );
				    $("#formSubmit_edit").attr("url","<?php echo base_url("data_pendidik/detail_pendidik");?>");
				 	    $.post("<?php echo site_url("data_pendidik/detail_pendidik"); ?>",{id:id},function(data){
						   						    $("#edit_isi").html(data);
													});
}							
	 
</script>
	
 
	 
	
	 
 <script>
 kelasLoad();
function kelasLoad()
{			 var kelas=$("#id_kelas").val();
			 var hari=$("#hari").val();
			 loading("area_lod");
			 $.post("<?php echo site_url("data_pendidik/getKelasJadwal"); ?>",{kelas:kelas,hari:hari},function(data){
			 $("#isi").html(data);
			 unblock("area_lod");
		      }); 
}
</script>
	
	
	
	
	
  