<?php
 $id=$this->input->post("id");
  $id_siswa=$this->input->post("nama");
 $nama_tagihan=$this->mdl->namaBiaya($id);

if(strtolower($nama_tagihan)=="spp")
{
 ?>

<div class="body" id="lod_spp" style="margin-top:-10px">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active" onclick="getDataSpp(`0`,`<?php echo $id_siswa?>`,`home`)"><a href="#home" data-toggle="tab">TINGKAT X</a></li>
                                <li role="presentation" onclick="getDataSpp(`12`,`<?php echo $id_siswa?>`,`profile`)"><a href="#profile" data-toggle="tab">TINGKAT XI</a></li>
                                <li role="presentation" onclick="getDataSpp(`24`,`<?php echo $id_siswa?>`,`messages`)"><a href="#messages" data-toggle="tab">TINGKAT XII</a></li>
                       
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    
                                    <p class="entry">
                                    
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                    
                                    
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages">
                                     
                                     
                                </div>
                               
                            </div>
  </div>

 <script> 
 getDataSpp(0,`<?php echo $id_siswa;?>`,`home`);
	function getDataSpp(limit,id_siswa,isi)
	{	 loading("lod_spp"); 
	var kode="<?php echo $id;?>";
		 $.post("<?php echo site_url("datasi/getDataSpp"); ?>",{kode:kode,limit:limit,id_siswa:id_siswa,konten:isi},function(data){
			$("#"+isi).html(data);
	 		unblock("lod_spp");
		 });
	}
 </script>
  
  
<?php }else{ ?>
<div id="isirincian"></div>

 <script> 
 getDataRincian(`<?php echo $id;?>`,`<?php echo $id_siswa;?>`);
	function getDataRincian(id,id_siswa)
	{	loading("lod_rincian");
		 $.post("<?php echo site_url("datasi/getDataRincian"); ?>",{id_siswa:id_siswa,id:id},function(data){
			$("#isirincian").html(data);
			unblock("lod_rincian");
		 });
	}
 </script>

<?php } ?>