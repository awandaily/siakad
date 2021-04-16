 <?php
 $sms=$this->m_reff->semester();
$tahun=$this->m_reff->tahun();
?>
 
 <div class="row clearfix">
            
 				<!--
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-indigo  hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">KEHADIRAN ANAK</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php   echo $this->mdl->persentaseHadir()?></div>
                        </div>
                    </div>
                </div>
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink  hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">CATATAN ANAK</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $this->mdl->catatan()?></div>
                        </div>
                    </div>
                </div>-->
				 
			<!--	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">TAGIHAN</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">257</div>
                        </div>
                    </div>
                </div>
				-->
				
				
				
				
				
				
				
				
				
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35"><center>TOTAL KETIDAKHADIRAN SISWA</center> </div>
                            <ul class="dashboard-stat-list">
							<?php
							$data=$this->db->get_where("tr_sts_kehadiran",array("id!="=>1))->result();
							foreach($data as $val){?>
                                <li style="border-bottom:white dashed 1px" onclick="cekAbsen('<?php echo $val->id;?>','<?php echo strtoupper($val->nama);?>')">
                                    <?php echo strtoupper($val->nama);?>
                                    <span class="pull-right"><b>
                                    	<?php  
                                    		$nis_siswa = $this->m_reff->goField("data_siswa", "nis", "WHERE ai='".$this->session->userdata("id")."' ");
                                    	?>
                                    	<?php echo $this->m_reff->jmlOffDay($nis_siswa,$val->id)?> Hari</b>
                                    </span>
                                </li>
							<?php } ?>   
                            </ul>
                        </div>
                    </div>
                </div>
				
				
				
				
				
				  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card" id="jadwal">
                        
                        <div class="body"><center><b>JADWAL HARI INI</b></center>
                            <div class="table-responsive">
                                <table class="entry table-hover dashboard-task-infos" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>JAM</th>
                                            <th>MATA PELAJARAN</th>
                                            <th>GURU</th>
                                            <th>KEHADIRAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<!--
                                        <tr class='bg-pink sadow'><td colspan='5' class="font-bold col-white"><center> <?php echo $this->mdl->absen_datang();?></center> </td></tr>-->
										<?php
										 
										$jam=date("H:i:s");
										$i=$ha=date("N");
										$id_kelas=$this->m_reff->id_kelas();
										$id_siswa=$this->m_reff->id_siswa();
										 
							 if($ha==1){ $ha="1"; }elseif($ha==5){$ha=2;}else{ $ha="0"; };
							  $urut=$val="";
							  $db=$this->db->query("select * from tr_jam_ajar where sts='".$ha."' order by jam_mulai asc ")->result();
							  foreach($db as $val)
							  {
								  if($ha==$i && $jam>=$val->jam_mulai && $jam<=$val->jam_akhir)
								  {
									  $cls="bg-orange col-black";
								  }else{
									  $cls="";
								  }
							 
								  	 $urut=$val->urut; $cekin="";
								  if(!$urut)
								  {	$cekin=1;
									   echo "<tr class='font-bold ".$cls."' style='background-color:#ababab'>
									  <td>".$urut."</td>
									  <td>".substr($val->jam_mulai,0,5)."</td>
									  <td colspan='3' >".$val->kegiatan."</td>
									  
									  </tr>";

								  }else{ 
								  	$cekin=1;
											$base=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' 
											and id_tahun='".$tahun."' and id_semester='".$sms."' and id_hari='".$i."'
											and jam like '%,".$urut.",%' ")->row();
									  $mapel=isset($base->mapel)?($base->mapel):"";
									  $idguru=isset($base->id_guru)?($base->id_guru):"";
									  $dataguru=$this->db->query("select gelar_depan,nama,gelar_belakang from data_pegawai where id='".$idguru."'")->row();
									  $nama=isset($dataguru->nama)?($dataguru->nama):""; 
									  $gelar_depan=isset($dataguru->gelar_depan)?($dataguru->gelar_depan):"";
									  $gelar_belakang=isset($dataguru->gelar_belakang)?($dataguru->gelar_belakang):"";
									  $id_jadwal=$this->mdl->getIdJadwal($urut,$id_kelas,$ha);
									  
									 
									  $id_sts=$this->mdl->statusKehadiran($id_siswa,$id_jadwal);
									
									
									 $hadir=$this->mdl->getStsHadir($id_sts);
										$guru=$gelar_depan." ".$nama." ".$gelar_belakang;
										$nama_kelas=isset($base->nama_kelas)?($base->nama_kelas):"";
									  if($mapel)
									  {
									  echo "<tr class='".$cls." '>
									  <td>".$urut."</td>
									  <td>".substr($val->jam_mulai,0,5)."</td>
									  <td><span class='col-back'>".$mapel."</span> </td>									 
									  <td><span class='col-back'>".$guru."</span> </td>									 
									  <td><span class='col-back'>".$hadir."</span> </td>									 
									  </tr>";
									  }else{
										   echo "<tr class=' hide ".$cls." font-bold' >
										  <td>".$urut."</td>
										  <td>".substr($val->jam_mulai,0,5)."</td>
										  <td colspan='3'  > <i class='col-orange'>Kosong</i></td>	 					 
										  </tr>";
									  }
								  }
								  
								   
							  }
							  if(!$cekin)
							  {
								  echo "<script>$('#jadwal').html('<br><center><b>TIDAK ADA JADWAL PELAJARAN</b></center>');</script>";
							  }
							  
							  ?>
										
										<!--
										 <tr class='bg-pink sadow'><td colspan='5' class="font-bold col-white"><center><?php echo $this->mdl->absen_pulang();?></center>  </td></tr>-->
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>
				
				 
 </div>
 
 
 <script>
 function cekAbsen(id,title)
 {		$(".titles").html(title);
	 if(id==1)
	 {
		 alert("Jml HADIR tidak dapat di tampilkan."); return false;
	 }
	 loading();
	  $.post("<?php echo site_url("oinfo/cekAbsen"); ?>",{id:id},function(data){
			   $("#mdl_modal").modal("show");
			   $("#view").html(data);
			     $.unblockUI();
		      })
		   };
 
 </script>
 
 
 
 <div class="modal fade" id="mdl_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" id="area_mdl_modal" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="http://localhost/siakad/guru_instal/insert_kelas"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">DATA ABSEN <span class="titles"></span> </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <div id="view"></div>
								 
				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
		 