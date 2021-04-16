 <?php
 $sms=$this->m_reff->semester();
$tahun=$this->m_reff->tahun();
?>
 
 <div class="row clearfix">
            
 
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-indigo  hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">KEHADIRAN </div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php   echo $this->mdl->persentaseHadir()?></div>
                        </div>
                    </div>
                </div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"  onclick="cekAbsen('2','SAKIT')">
                    <div class="info-box bg-teal  hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">SAKIT</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
							<?php echo $this->mdl->jmlKehadiran(2)?></div>
                        </div>
                    </div>
                </div>
				 
		 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"   onclick="cekAbsen('3','IZIN')">
                    <div class="info-box bg-orange  hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">IZIN</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
							<?php echo $this->mdl->jmlKehadiran(3)?></div>
                        </div>
                    </div>
                </div>
				 
		  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"   onclick="cekAbsen('4','ALFA')">
                    <div class="info-box bg-green  hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">ALFA</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
							<?php echo $this->mdl->jmlKehadiran(4)?></div>
                        </div>
                    </div>
                </div>
				 
		 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"   onclick="cekAbsen('5','DISPEN')">
                    <div class="info-box bg-pink  hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">DISPEN</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
							  <?php echo $this->mdl->jmlKehadiran(5)?></div>
                        </div>
                    </div>
                </div>
				 
		  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"   onclick="cekAbsen('6','BOLOS')">
                    <div class="info-box bg-blue  hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">BOLOS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
							<?php echo $this->mdl->jmlKehadiran(6)?></div>
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
	  $.post("<?php echo site_url("dsh/cekAbsen"); ?>",{id:id},function(data){
			   $("#mdl_modal").modal("show");
			   $("#view").html(data);
			     $.unblockUI();
		      })
		   };
 
 </script>
 		
			 
				 	
						
			<!---------------------------------->	
 <div  >
 
 	<?php
	$token=date('His');
	 
	$id_tahun=$this->m_reff->tahun();
	$id_semester=$this->m_reff->semester();
for($i=1;$i<=5;$i++)
{
 if($i==5)
{
	$sts=2;
}
elseif($i==1)
{
	$sts=1;
}else{
	$sts=0;
}
$jam=date("H:i:s");
$ha=date("N");

	?>

	  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="bodyd" style=" padding:10px">
						<!---------------------->
						  <span style="font-size:18px"><?php echo $this->m_reff->goField("tr_hari","nama","where id='".$i."'");?></span>
                              <table class="entry2" width="100%">
							  <tr  style='font-size:12px'>
							  <th>JAM KE </th><th>  MULAI</th><th>MAPEL/GURU</th>
							  </tr>
							  <?php
							  $urut=$val="";
							  $db=$this->db->query("select * from tr_jam_ajar where sts='".$sts."' order by jam_mulai asc ")->result();
							  foreach($db as $val)
							  {
								  if($ha==$i && $jam>=$val->jam_mulai && $jam<=$val->jam_akhir)
								  {
									  $cls="bg-orange col-black";
								  }else{
									  $cls="";
								  }
							 
								  	 $urut=$val->urut;
								  if(!$urut)
								  {
									   echo "<tr class='font-bold ".$cls."' style='background-color:#ababab'>
									  <td>".$urut."</td>
									   
									  <td colspan='3' class='col-white'>  ".substr($val->jam_mulai,0,5)." ".$val->kegiatan."</td>
									  </tr>";

								  }else{ 
											$base=$this->db->query("select * from v_jadwal where  
											  id_tahun='".$id_tahun."' and id_semester='".$id_semester."' and id_hari='".$i."' and id_kelas='".$this->mdl->id_kelas()."'
											and jam like '%,".$urut.",%' ")->row();
									  $mapel=isset($base->mapel)?($base->mapel):"";
									  $nama_kelas=isset($base->nama_kelas)?($base->nama_kelas):"";
									  if($mapel)
									  {
									  echo "<tr class='".$cls." '>
									  <td>".$urut."</td>
									  <td>".substr($val->jam_mulai,0,5)."</td>
									   <td><span class='col-teal'>".$mapel."</span>  	<br>
									  
									   ".$this->m_reff->nama_guru($base->id_guru)."</td>
																 
									  </tr>";
									  }else{
										   echo "<tr class='  ".$cls." font-bold' >
										  <td>".$urut."</td>
										  <td>".substr($val->jam_mulai,0,5)."</td>
										  <td colspan='2'>  <i class='col-orange'>Kosong</i> </td>						 
										  </tr>";
									  }
								  }
							  }
							  ?>
							  </table>
                      
						<!---------------------->
						 
                           </div>
						</div>
         </div>
<?php  } ?>	


	
 </div>
						
							
			<!---------------------------------->			
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
                        </div>
				
				 
 </div>
 
  
 
 
 
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
		 