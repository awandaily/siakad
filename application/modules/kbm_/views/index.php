 <style>
@media (max-width: 867px) {
	.clasmo{
	margin-top:-20px;
	}.clasmo2{
	margin-top:-30px;
	} .clasmo3{
	margin-top:-50px;
	}.clasmo25{
	margin-top:-35px;
	} .clasmo4{
	margin-top:-70px;
	} .center{
	text-align:center;
	}
}
select option[value="create"] { /* value not val */
    background: black;
	color:white;
	text-align:right;
	cursor:pointer;
	font-weight:bold;
	font-style: italic;
}
</style>

<div class="row clearfix">
<div class=" col-sm-12 col-md-12 col-lg-12">
 <div id="view"></div>
</div>
</div>


<?php

$datalibur=$this->db->query("select * from tm_jadwal_libur where start<='".date('Y-m-d')."' and end>='".date('Y-m-d')."' ")->row();
$namaLibur=isset($datalibur->nama)?($datalibur->nama):"";
if($namaLibur)
{
	echo "<div class='card'><br><center> Hari ini KBM diliburkan<br> <i class='col-deep-orange'> ".$namaLibur." </i></center></div>";
				return false;
}











$ha=date("N");
if($ha==1)
{
	$ss=1;
}else{
	$ss=0;
}
$data=$this->db->query("select urut from tr_jam_ajar where sts='".$ss."' AND  '".date("H:i:s")."'<=jam_akhir order by jam_akhir asc limit 1 ")->row();
 $id_jam=isset($data->urut)?($data->urut):"";
$db=$this->mdl->getKelasIni($id_jam); //v_jadwal
 $data_jam=isset($db->jam)?($db->jam):"";
 
 $jamkenow= isset($data->urut)?($data->urut):"0";
 
 $jamkenow=(string)$jamkenow;
 $posisi=strpos($data_jam,$jamkenow);
 
  $jam_blok=substr($data_jam ,0, $posisi);
  if($jam_blok==",")
  {
	  $jam_blok="";
  }
 
$id_jadwal=isset($db->id)?($db->id):"";
 $kelas=isset($db->nama_kelas)?($db->nama_kelas):"";
 $id_kelas=isset($db->id_kelas)?($db->id_kelas):"";
  $id_mapel=isset($db->id_mapel)?($db->id_mapel):"";
 $mapel=isset($db->mapel)?($db->mapel):"";
 
 
 $data=$this->db->query("select * from tr_semester where sts=1")->row();
			$smsini=isset($data->id)?($data->id):"";
			 $sms=$this->m_reff->semester();
			 if($smsini!=$sms){
			 	echo "<div class='card'><br><center><i>Anda sedang melihat history semester sebelumnya<br> Untuk melakukan KBM Silahkan pilih semester saat ini</i></center></div>";
				return false;
			 }
				 
 $ids=$this->m_reff->goField("data_pegawai","nip","where id='".$this->mdl->idu()."' ");
 $cekfinger=1;//$this->mdl->cekfinger($ids);
 if(!$cekfinger)
{
	echo "<div class='card'><br><center><i>Anda belum melakukan fingerprint</i></center></div>";
	return false;
}
 
if(!$mapel)
{
	echo "<div class='card'><br><center><i>Tidak Ada Jam Mengajar</i></center></div>";
	return false;
}

$cekoff=$this->db->query("select * from tm_diliburkan where  substr(tgl,1,10)='".date('Y-m-d')."' ")->num_rows();
 if($cekoff)
{
	echo "<div class='card'><br><center><i>Pembelajaran di non-aktifkan</i></center></div>";
	return false;
}
$vis=$this->db->query("select * from tm_absen_guru where id_jadwal='".$id_jadwal."'
 and id_mapel='".$id_mapel."' and id_guru='".$this->mdl->idu()."' and substr(tgl,1,10)='".date('Y-m-d')."'")->row();
$id_materi=isset($vis->id_materi)?($vis->id_materi):"";
 $jam_diblok=isset($vis->jam_blok)?($vis->jam_blok):"";
$databasekikd=$this->db->query("select id_kikd from v_materi where id='".$id_materi."' and id_guru='".$this->mdl->idu()."'")->row();
$id_kikd=isset($databasekikd->id_kikd)?($databasekikd->id_kikd):"";
$cpembelajaran=isset($vis->cpembelajaran)?($vis->cpembelajaran):"0";
if($cpembelajaran==0){
  $cpembelajaran="-";
}

 
 
if(strpos($jam_diblok,$jamkenow)!==false)
{
	echo "<div class='card font-bold col-pink' style='padding:10px'> <center> ABSEN ANDA TELAH DIBLOK  DI JAM PELAJARAN SEKARANG !! </center></div>";
	return false;
}


?>

  <!-- Tahun Ajaran <?php echo $this->m_reff->tahun_ajaran();?> - Semester <?php echo $this->m_reff->semester();?>  Task Info -->
  <div class="row clearfix">
             
			  
                <div class=" col-sm-12 col-md-12 col-lg-12">
                    <div class="card" id="area_load"><br>
                       <center><b class='col-teal'> JADWAL MENGAJAR SEKARANG</b></center>
                      
                        <div class="bodys">

 <div class="col-md-12">					
	<p> <span class="col-md-3 center  font-bold row">MENGAJAR DI</span>
	<span class="col-md-9 ">: <?php echo $kelas; ?></span>  </p>
  
	<p class="clasmo"> <span class="col-md-3   font-bold row">MAPEL </span>
	<span class="col-md-9   ">: <?php echo $mapel; ?></span> </p>
 <p class="clasmo"> 
	 <span class="col-md-3   font-bold row">KIKD </span>
 
	<div class="col-md-9 clasmo25" >  
	  <span class="col-md-9">
		<?php 
		$tahun=$this->m_reff->tahun();
		$sms=$this->m_reff->semester();
		//$this->db->where("id_tahun",$tahun);
		//$this->db->where("id_semester",$sms);
		//$this->db->where("id_guru",$this->mdl->idu());
		//$this->db->where("id_mapel",$id_mapel);
		//$this->db->where("id_kelas",$id_kelas);
		//$this->db->where("kd3_kb>",0);
		//$this->db->group_by("code");
		$dtkikd=$this->db->query("SELECT * FROM `v_kikd` WHERE `id_tahun` = '".$tahun."' AND `id_semester` = '".$sms."' AND `id_guru` = '".$this->mdl->idu()."' 
		AND `id_mapel` = '".$id_mapel."' AND `id_kelas` = '".$id_kelas."' AND `kd3_kb` >0 ORDER BY CAST(SUBSTR(kd3_no  , 3  , 5) AS SIGNED INTEGER) ASC");
		//$dtkikd=$this->db->get("v_kikd");
		$ray="";
		if(!$vis)
		{
		$ray[""]="=== Pilih KI.KD ===";
		} 
	 
		$val="";
		foreach($dtkikd->result() as $val)
		{
			$ray[$val->id]=$val->kd3_no." - ".$val->kd3_desc." __ ".$val->kd4_no." - ".$val->kd4_desc;
		}
		$datakikd=$ray;
		echo form_dropdown("kikd",$datakikd,$id_kikd,"class='form-control' style=' width:100%' onchange='ambilMateri()'");?>
		</span>
		<div class="col-md-3 " style="padding:10px"  onclick="history_mengajar()" ><center>
		  <a href="javascript:history_mengajar()"> <u>  History Mengajar Minggu Lalu</u></a> </center>
		 </div>
	</div>
		</p>
		
			
		 
 <div class="col-md-12 clasmo3 ">&nbsp;</div>		
		 <span class="col-md-3 clasmo3 font-bold row">MATERI AJAR </span>
		<span class="col-md-9  "  > 
			<span class="col-md-9 ">  	<span  id="dataMateri" >
			<div class="progress-bar bg-cyan progress-bar-striped active" role="progressbar" 
			aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                   Loading...
                                </div>
			</span>
		 </span> 
		</span> 		
</div>		

<div class="col-md-12  clearfix "  > <span id="menu" ><br><div class="progress-bar bg-cyan progress-bar-striped active" role="progressbar" 
			aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                   Loading...
                                </div></span></div>				
						
  
							
						</div>						
				 
                           <!----->
                 <div class="col-md-12">&nbsp;</div>  
				 &nbsp;
                    </div>
                </div>
  </div>
  <?php
  $mobile=$this->m_reff->mobile();
  if($mobile){?>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
 
 <script>
 function tulis()
 {
	    $('html,body').animate({ scrollTop: 1000 }, 'slow');
 }

 </script>
  <?php } ?>
<script>	

 
	 $("#menu").hide();
 
  setTimeout(function(){ ambilMateri();   }, 1000);
  
	  setTimeout(function(){
	 var idmateri=$("[name='id_materi']").val();
	 
	if(idmateri>0){
	 $("#menu").show();
	 ready();
	}
	 }, 3000);
function ambilMateri()
{		var loading="<img src='<?php echo base_url()?>plug/img/load.gif'> Mohon tunggu...";
	 
	var kikd=$("[name='kikd']").val();
	var idkelas="<?php echo $id_kelas;?>";
	var idmapel="<?php echo $id_mapel;?>";
	if(kikd){
		blok("area_load");
	 $.post("<?php echo site_url("kbm/cekMateri"); ?>",{kikd:kikd,idkelas:idkelas,idmapel:idmapel},function(data){
					unblock("area_load");
			if(data<1)
			 {
				 $("[name='kikd']").val("")
				 notif(" Maaf KIKD sebelumnya belum tuntas !!  Mohon untuk memberikan nilai untuk KIKD sbelumnya.");
				 return false;
				
			 } 
			   
	 }); 
	}
	
	 	  $.ajax({
			  url:"<?php echo site_url("kbm/getDropdownMateri"); ?>",
			  method:"POST",
			  data:"kikd="+kikd+"&idkelas="+idkelas+"&idmapel="+idmapel,
			  dataType:"json",
			  success: function(data){
				$("#dataMateri").html(data["menu"]);
				if(data["status"])
				{
					 $("#menu").show();
				}
			  }
			});
			  
			  
			  
			  
			  
			 		     
 }
  function history_mengajar()
 {
	 	var id_jadwal="<?php echo $id_jadwal;?>";
	 	var id_mapel="<?php echo $id_mapel;?>";
	 	var id_kelas="<?php echo $id_kelas;?>";
		blok();
		$("#mdl_modal_history").modal("show");
			$.post("<?php echo site_url("kbm/getHistory"); ?>",{id_kelas:id_kelas,id_mapel:id_mapel,id_jadwal:id_jadwal},function(data){
			  $("#viewH").html(data);
			   unblock();
		     }); 
 }
 function ready()
{
var kikd=$("[name='kikd']").val();	
if(!kikd)
{	notif("SIlahkan pilih KIKD");
	return false;
}

	var id_materi=$("[name='id_materi']").val();
	var id_jadwal="<?php echo $id_jadwal;?>";
	var cat='<?php echo $cpembelajaran;?>';
	if(id_materi!="create")
	{
	
		//blok("area_load");
 			  $.post("<?php echo site_url("kbm/getMenuKbm"); ?>",{id_jadwal:id_jadwal,id_materi:id_materi,idkelas:<?php echo $id_kelas?>,cat:cat},function(data){
			  $("#menu").html(data);
		//	  unblock("area_load");
			  masuk(id_materi);
		      }); 
	}else{
		$("#menu").hide();
		var idkikd=$("[name='kikd']").val();
		if(idkikd!=null)
		{
			inputMateri();
			$("[name='id_materi']").val(0);
		}
	}
 }
 
 function masuk(id_materi)
 {	var kikd="<?php echo $id_kikd; ?>";
	var mapel="<?php echo $id_mapel; ?>";
	var jam="<?php echo $data_jam?>";
	var jam_blok="<?php echo $jam_blok?>";
	var id_jadwal="<?php echo $id_jadwal?>";
	 $.post("<?php echo site_url("kbm/guruMasuk"); ?>",{id_mapel:mapel,id_kikd:kikd,id_materi:id_materi,id_kelas:<?php echo $id_kelas?>,jam:jam,jam_blok:jam_blok,id_jadwal:id_jadwal},function(data){
		 $("#menu").show();
	     }); 
 }
 </script>	
 <script>	
 
 function catt()
 {	
 var id_jadwal="<?php echo $id_jadwal?>";
 var catt=$("[name='catatan']").val();
 	 $.post("<?php echo site_url("kbm/insertCatatan"); ?>",{catt:catt,id_jadwal:id_jadwal},function(data){
		 alertify.set('notifier','position', 'bottom-right');
		 alertify.warning("<b  > <i class='material-icons'>done_all</i> <span style='margin-top:2px;position:absolute'> &nbsp;Tersimpan !!</span></b>");
		 $('html,body').animate({ scrollTop: 0 }, 'slow');
     }); 
 }
 function absen(idkelas,idjadwal)
 {	 

	 
			$.post("<?php echo site_url("kbm/getDataSiswa"); ?>",{idkelas:idkelas,idjadwal:idjadwal},function(data){
			  $("#view").html(data);
			  // unblock();
			  
			   $('html,body').animate({ scrollTop: 0 }, 'slow');
		      }); 
 }
 
function inputMateri()
{
	$("#mdl_add_materi").modal("show");
	var id=$("[name='kikd']").val();
	$("[name='id_kikd_add']").val(id);
}

</script>			 



 <div class="modal fade" id="mdl_modal_history" tabindex="-1" role="dialog" >
                <div class="modal-dialog" id="area_mdl_modal" role="document">
				
			 
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">History mengajar minggu lalu </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <div id="viewH"></div>
							 
						</div>
					</div>
					  
				</div>
			 
         </div><!-- /.modal-dialog -->
		 
		 
	

 <div class="modal fade" id="mdl_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" id="area_mdl_modal" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url=""   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">Absen siswa kelas <?php echo $kelas;?> <span class="titles"></span> </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <div id="data_siswa"></div>
									
							 
 
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
		 
		 
		 
		 
		 
		 
		 
<script>
function kirimCatatan(id_siswa,id_kelas,desc_nama)
{
			$("#mdl_modal_catatan").modal();		
			 $("#desc_id_siswa").val(id_siswa);
			 $("#desc_id_kelas").val(id_kelas);
			 $("#desc_catatan").val("");
			 $(".desc_nama").html(desc_nama);
}
 </script>
		 
		 
		 	
 <div class="modal fade" id="mdl_modal_catatan" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitForm('modal_catatan')" id="modal_catatan" url="<?php echo base_url()?>kbm/kirim_catatan"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">KIRIM CATATAN UNTUK <span class='col-pink desc_nama'></span></h4>
							 
                        </div>
                        <div class="modal-body">
                       	 	<div class="row clearfix">
                                   
                                    <div class="col-lg-12 col-md-12 col-xs-12 ">
                                        <div class="form-groups">
                                            <div class="form-line"  >
											  <textarea class="form-control" required name="f[ket]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
								
								<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-xs-12 form-control-label">
                                        <label for="email_address_2" class="col-black pull-left">Teruskan Ke   </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        	
												   <div class="form-group">
                                            <div class="form-line"  >
											 
												<input id="md_checkbox_22" class="filled-in chk-col-red" name='t[]'  value='1' type="checkbox">
												<label for="md_checkbox_22" class='col-black'>Guru BP&nbsp;&nbsp;&nbsp;</label>
												<input id="md_checkbox_23" class="filled-in chk-col-red" name='t[]' value='2' type="checkbox">
												<label for="md_checkbox_23"  class='col-black'>Orang Tua&nbsp;&nbsp;&nbsp;</label>
												<input id="md_checkbox_24" class="filled-in chk-col-red" name='t[]' value='3' type="checkbox">
												<label for="md_checkbox_24"  class='col-black'>Siswa&nbsp;&nbsp;&nbsp;</label>
												 
                                    </div>
                                    </div>
                                    </div>
                                </div>
								<input type='hidden' name='f[id_siswa]' id='desc_id_siswa'>
								<input type='hidden' name='f[id_kelas]' id='desc_id_kelas'>
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_catatan')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
		 
		 
	 	
 <div class="modal fade" id="mdl_add_materi" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitForm_add_materi('add_materi')" id="add_materi" url="<?php echo base_url()?>guru_instal/input_materi_baru"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">Tambah Materi Baru <span class='col-pink desc_nama'></span></h4>
							 
                        </div>
                        <div class="modal-body">
                       	 	<div class="row clearfix">
                                   <input type="hidden" name="id_kikd_add" >
                                    <div class="col-lg-12 col-md-12 col-xs-12 ">
                                        <div class="form-groups">
                                            <div class="form-line"  >
											  <textarea class="form-control" required name="materi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
								
							 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                     
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm_add_materi('add_materi')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
		 
		 
	<script>
	function submitForm_add_materi(id)
{		
		var form = $("#"+id);
		var link = $(form).attr("url");
	 
		$(form).ajaxForm({
		 url:link,
		 data: $(form).serialize(),
		 method:"POST",
		 dataType:"JSON",
		 beforeSend: function() {
               loading("area_"+id);
            },
		 success: function(data)
				{ 	   unblock("area_"+id); 	
					if(data["hp"]==false)
					{	  
							notif("<b>Gagal  !!</b><br>- Kolom HP ada yang belum diisi.");
					}else if(data["jadwal_duplicate"]==true)
					{	  
							notif("<b>Gagal  !!</b><br>- Sudah diinput.");
					}else if(data["mapel_duplicate"]==true)
					{	  
							notif("<b>Gagal  !!</b><br>- Nama Mapel sudah ada.");
					}else if(data["rombel_duplicate"]==true)
					{	  
							notif("<b>Gagal  !!</b><br>- Nama Rombel sudah ada.");
					}else if(data["nip_duplicate"]==true)
					{	  
							notif("<b>Gagal  !!</b><br>- NIP sudah terdaftar pada database.");
					}else if(data["nis_duplicate"]==true)
					{	  
							notif("<b>Gagal  !!</b><br>- NISN sudah terdaftar pada database.");
					}else if(data["nip"]==false)
					{	  
							notif("<b>Gagal  !!</b><br>- Kolom NIP ada yang belum diisi.");
					}else if(data["nis"]==false)
					{	  
							notif("<b>Gagal  !!</b><br>- Kolom NISN ada yang belum diisi.");
					}else if(data["id_kelas"]==false)
					{	  
							notif("<b>Gagal  !!</b><br>- Kolom ID KELAS salah pengisian.");
					}else if(data["id_tahun_masuk"]==false)
					{	  
							notif("<b>Gagal  !!</b><br>- Kolom ID TAHUN MASUK salah pengisian.");
					}else if(data["size"]==false)
					{	  
							notif("<b>Gagal  !!</b><br>- Upload File Maksimal "+data["maxsize"]+"MB.");
					}else if(data["file"]==false)
					{	  
							notif("<b>Gagal  !!</b><br>- File yang diizinkan adalah "+data["type_file"]+".");
					}else if(data["token"]==false)
					{
						notif_error("<span class='col-white'><b>Gagal!</b>  Silahkan coba lagi.</span>");
						$("#mdl_"+id).modal("hide");
					}else if(data["import_data"]==true)
					{
						$("#"+id)[0].reset();
						  $("#mdl_"+id).modal("hide"); 
						  reload_table();
						notif_success("<span class='sadow white'><div class='demo-google-material-icon'> <i class='material-icons'>done_all</i> <span class='icon-name'>Berhasil disimpan</span><br> - Ditambahkan "+data['data_insert']+" data<br> - Diperbaharui "+data['data_edit']+" data</div></span>");
					 		
						$("#mdl_"+id).modal("hide");
					}else{
					  $("#"+id)[0].reset();
					  $("#mdl_"+id).modal("hide"); 
					  
					  berhasil_disimpan();
					 ambilMateri();		
					  $("#mdl_"+id).modal("hide");
					}
					 			
				}
		});     
};
 
	</script>