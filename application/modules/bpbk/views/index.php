  <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">KEHADIRAN   KELAS X</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $this->mdl->jmlSiswaFinger(1)?>/<?php echo $this->mdl->jmlSiswa(1)?></div>
                        </div>
                    </div>
                </div>
   
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">KEHADIRAN   KELAS XI</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $this->mdl->jmlSiswaFinger(2);?>/<?php echo $this->mdl->jmlSiswa(2)?></div>
                        </div>
                    </div>
                </div>
 
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">KEHADIRAN   KELAS XII</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $this->mdl->jmlSiswaFinger(3);?>/<?php echo $this->mdl->jmlSiswa(3)?></div>
                        </div>
                    </div>
                </div>
 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="laphar">
                    <div class="card">
                        <div class="header">
                            <h2>
                               LAPORAN HARI INI
                               </h2>
                           
                        </div>
                        <div class="body">
                         <?php
						$data=$this->mdl->statusHariIni();$i=0;
						foreach($data as $val){ $i=1;
							?>
                            <div class="media"  style="border-bottom:#747474 dashed 1px;padding-bottom:5px">
                                <div class="media-left">
                                    <a href="javascript:detail(`<?php echo $val->id_siswa; ?>`)">
                                        <img class="media-object  thumbnail" src="<?php echo  $this->m_reff->poto_siswa($val->id_siswa);?>" width="64" height="64">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h6 style='font-size:14px' onclick="detail(`<?php echo $val->id_siswa; ?>`)" class="media-heading col-teal"><?php echo $this->mdl->dataSiswa($val->id_siswa)->nama;?> -
									<span class='col-pink'> <?php echo $this->mdl->dataKelas($this->mdl->dataSiswa($val->id_siswa)->id_kelas)->nama;?></span>
									</h6> 
									<p style='font-size:14px;color:black'><?php echo $val->ket;?></p>
									<p onclick="tanggapi(`<?php echo $val->id;?>`)" style='font-size:12px;color:black;margin-top:-5px' class='waves-effect btn bg-pink btn-xs'>Tindak Lanjuti</p>
									<?php 
									foreach($this->mdl->tanggapan($val->id) as $tanggapan)
									{?>
                                    <div  style="border:#EEE solid 1px;line-height:12px;padding-right:5px;padding-top:5px">
                                        <?php
										if($tanggapan->komentator==1){
										$komentator="Anda";
										}else{
												$komentator="Kepsek";
										}
									
                                       ?>
                                            <p style='font-size:14px;' class='col-teal' align='right'><b><?php echo $komentator;?></b></p>
											 <p style='font-size:14px;color:black;margin-top:-10px'  align='right'>	  	<?php echo $tanggapan->tanggapan;?> </p>
							<?php if($tanggapan->komentator==1){?>
							<span style="margin-top:-10px;">	  
									<a onclick="edit_tanggapan(`<?php echo $tanggapan->id;?>`,`<?php echo $tanggapan->tanggapan;?>`)" style='cursor:pointer;font-size:12px;color:orange'  align='left'><i>&nbsp;	Edit </i></a> <i>|</i>
									<a onclick="hapus_tanggapan(`<?php echo $tanggapan->id;?>`)" style='cursor:pointer;font-size:12px;color:orange'  align='left'><i>	Hapus </i> </a> 
							</span>
									  
                                    </div>
									<?php } } ?>
                                </div>
                            </div>
                        <?php } ?>   
                             
                        </div>
                    </div>
                </div>
            </div>
					<?php   
							if($i=="0"){ echo  "<script>$('#laphar').hide();</script>"; }
							?>	
							
							
							
							
							
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="laphar">
                    <div class="card">
                        <div class="header">
                            <h2> KETIDAK HADIRAN SISWA HARI INI  </h2>
                           
                        </div>
                        <div class="body entry">
							<div class="table-responsive">
							<table>
							<thead>
							<th>NO</th><th>NAMA  & KELAS </th> <th>STATUS</th>
							</thead>
							<?php 
								$tgl=date("Y-m-d");
							$get=$this->mdl->siswa_tidak_hadir()->result();$no=1;
							foreach($get as $val)
							{
								echo "<tr>
								<td>".$no++."</td>
								<td><a href='javascript:vid(0)' onclick='detail(`".$val->id."`)' >".$this->m_reff->goField("data_siswa","nama","where id='".$val->id."'")."
								<br><span class='col-pink'>".$this->m_reff->goField("v_kelas","nama","where id='".$val->id_kelas."'")."</span></a></td>
								<td>".$this->mdl->cekStatusHadirAbsen($val->id,$tgl)."</td>
								</tr>";
							}
							?>
							</table>					
							</div>
						</div>
					</div>
	</div>
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
<script>		
function detail(id)
	{ 
		$("#judul_mdl_detail").html("DATA DETAIL SISWA ");
					   $("#mdl_detail").modal( );
					   $.post("<?php echo site_url("welcome/detail_siswa"); ?>",{id:id},function(data){
					   $("#isi_detail").html(data);
		});
	}		
function tanggapi(id)
{
			 $("#mdl_modal_artikel").modal();		
			 $("#id_catatan").val(id);
			 $("[name='f[tanggapan]").val("");
}
function edit_tanggapan(id,teks)
{
			 $("#mdl_modal_tanggapan").modal();		
			 $("#id").val(id);
			 $("[name='f[tanggapan]").val(teks);
}
 function hapus_tanggapan(id){
		   alertify.confirm("<center>Hapus tanggapan ini ?</center>",function(){
		   $.post("<?php echo site_url("bpbk/hapus_bpbk"); ?>",{id:id},function(){
			   reload_table();
		      })
		   })
	  };
</script>		


	
	<!-- Modal -->
<div class="modal fade" id="mdl_detail" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
		          
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" id="judul_mdl_detail">  </h4>
            </div>
            
            <!-- Modal Body -->
			<div class="col-md-12 modal-body">
				<div id="isi_detail"></div>
				</div>
				
				
            <div class="row clearfix"></div>
            <div class="modal-footer">
			  
                         
                        </div>
          
        
		</div>
    </div>
</div>
	
 
	 



 <div class="modal fade" id="mdl_modal_tanggapan" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_tanggapan" role="document">
				
	<form  action="javascript:submitForm('modal_tanggapan')" id="modal_tanggapan" url="<?php echo base_url()?>bpbk/update_tanggapan"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TINDAK LANJUT</h4>
							 
                        </div>
                        <div class="modal-body">
                       	 	<div class="row clearfix">
                                   
                                    <div class="col-lg-12 col-md-12 col-xs-12 ">
                                        <div class="form-groups">
                                            <div class="form-line"  >
											  <textarea class="form-control" required name="f[tanggapan]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<input type='hidden' name='id' id='id'>
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                  <!--      <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                  --->       <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_tanggapan')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
		 
		 
       	

 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>bpbk/insert_tanggapan"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TINDAK LANJUT</h4>
							 
                        </div>
                        <div class="modal-body">
                       	 	<div class="row clearfix">
                                   
                                    <div class="col-lg-12 col-md-12 col-xs-12 ">
                                        <div class="form-groups">
                                            <div class="form-line"  >
											  <textarea class="form-control" required name="f[tanggapan]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<input type='hidden' name='f[id_catatan]' id='id_catatan'>
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
		 
		 
		 <script type="text/javascript">
			function reload_table() {
			setTimeout(function(){ 
					loadhal();
					}, 500);
				  
		  }
		  function loadhal()
		  {
			    var url = "<?php echo base_url()?>bpbk/status";
			  $.post(url,{ajax:"yes"},function(data){
					  $(".content").html(data);
			  });
		  }
		  
		//  setInterval(function(){ 
			//		loadhal();  
		//			}, 60000);
	 </script> 
       	