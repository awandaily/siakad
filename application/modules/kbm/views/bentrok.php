<div class="row clearfix">
<div class=" col-sm-12 col-md-12 col-lg-12">
 <div id="view"></div>
</div>
</div>

<?php
//	$sumber=$this->input->post("id");
	$id_mapel=$this->input->post("idMapel");
	$id_kelas=$this->input->post("idKelas");
	$id_jadwal=$this->input->post("idJadwal");
		$data_jam=$jam=$this->input->post("jam");
		$jam_blok=$this->input->post("jam_blok");	
	 $kelas=$this->m_reff->goField("v_kelas","nama","where id='".$id_kelas."'");
     $mapel=$this->m_reff->goField("tr_mapel","nama","where id='".$id_mapel."'");
     $data_jam=$this->input->post("idKelas");
     
     $vis=$this->db->query("select * from tm_absen_guru where id_jadwal='".$id_jadwal."'
 and id_mapel='".$id_mapel."' and id_guru='".$this->mdl->idu()."' and substr(tgl,1,10)='".date('Y-m-d')."'")->row();
$id_materi=isset($vis->id_materi)?($vis->id_materi):"";
 $jam_blok=isset($vis->jam_blok)?($vis->jam_blok):"";

 
$id_kikd=isset($vis->id_kikd)?($vis->id_kikd):"";
$cpembelajaran=isset($vis->cpembelajaran)?($vis->cpembelajaran):"0";
if($cpembelajaran=="0"){
  $cpembelajaran="-";
}

   $sumber=isset($vis->sumber)?($vis->sumber):"";
     
     if($vis){
         $data_jam=$jam=$vis->jam;
         $jam_blok=$vis->jam_blok;
          $sumber=$sumber;
     }else{
         $sumber=$this->input->post("id");
     }
     
     
     
if($sumber==1){?>	 
  <!-- Tahun Ajaran <?php echo $this->m_reff->tahun_ajaran();?> - Semester <?php echo $this->m_reff->semester();?>  Task Info -->
  <div class="row clearfix" style="margin-top:-40px">
             
 
                <div class=" col-sm-12 col-md-12 col-lg-12">
                    <div class="cardx" id="area_load"><br>
                       <center><b class='col-teal'> JADWAL MENGAJAR SEKARANG</b></center>
                       
                        <div class="bodys">
                             
                 <table class=" " width="100%">
                     <tr>
                         <td colspan="2" style='border-bottom:black solid 1px'><center> <b><?php echo $kelas; ?> : <?php echo $mapel; ?></b>  </center></td>
                     </tr>
                     <tr>
                         <td><b>Pilih KD</b>    
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
		echo form_dropdown("kikd",$datakikd,$id_kikd,"class='form-control' style=' width:100%' onchange='pindahInputanBentrok()' ");?>
                             
                         </td>
                         <tr>
                             <td><b>Isi Pembahasan</b>	<textarea name='materi' class='form-control ' placeholder="Pembahasan..." onchange='insertMateriBaruBentrok()'><?php echo $cpembelajaran;?></textarea>
		 <input type="hidden" name="id_materi"></td>
                         </tr>
                     </tr>
                     <tr>
                         <td><center><a class='col-purple' href='javascript:history_mengajar()'>HISTORY MENGAJAR MINGGU LALU</a></center></td>
                     </tr>
                 </table>
                 
                 
                  
                 
                <br> 

  
<div class="  clearfix "  > <span id="menu" >
    <button onclick="hokabsen()" class="btn btn-block bg-teal sadow"><i class="material-icons">save</i> SIMPAN</button>
    <br><div class="progress-bar bg-cyan progress-bar-striped active" role="progressbar" 
			aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                 
                                </div></span></div>				
						
  
							
						</div>		
						
						
						
						 
				 
                           <!----->
                 <div class="col-md-12">&nbsp;</div>  
				 &nbsp;
                    </div>
                </div>
                
                
  </div>
  	<?php } ?> <!--- end if sumber--->	
  	
  	
  	
  	
  	
  	
  	<?php
  	
  if($sumber==2){ 	
  
  $this->load->view("kirim_tugas_bentrok");
  
  }
 
  if($sumber==3){ 	
  
  $this->load->view("form_izin_bentrok");
  
  }
  
  if($sumber==5){ 	
  
   echo "<center><h3 class='col-pink'>SISWA SEDANG MELAKSANAKAN PKL</h3></center>";
  
  }
  
  ?>
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	<script>
  	 function insertMateriBaruBentrok()
 {  var id_kikd=$("[name='kikd']").val();
       var materi=$("[name='materi']").val();
         var id_materi=$("[name='id_materi']").val();
    var id_jadwal="<?php echo $id_jadwal;?>";
			$.post("<?php echo site_url("kbm/insertMateriBaru"); ?>",{id_kikd:id_kikd,materi:materi,id_jadwal:id_jadwal,id_materi:id_materi},function(data){
			   $("[name='id_materi']").val(data);
			   	masuk(data);	
		     }); 
     
 }
 function masuk(id_materi)
 {	var kikd=$("[name='kikd']").val();
	var mapel="<?php echo $id_mapel; ?>";
	var jam="<?php echo $data_jam?>";
	var jam_blok="<?php echo $jam_blok?>";
	var id_jadwal="<?php echo $id_jadwal?>";
	var materi=$("[name='materi']").val();
	 $.post("<?php echo site_url("kbm/guruMasuk"); ?>",{materi:materi,id_mapel:mapel,id_kikd:kikd,id_materi:id_materi,id_kelas:<?php echo $id_kelas?>,jam:jam,jam_blok:jam_blok,id_jadwal:id_jadwal},function(data){
		 $("#menu").show();
		 ready();
	     }); 
 }
 
 
 
 function ready()
{
var kikd=$("[name='kikd']").val();	
if(!kikd)
{	
    <?php if($sumber==1){?>
    notif("Silahkan pilih KIKD"); 
	<?php } ?>
		return false;
}

	var id_materi=$("[name='id_materi']").val();
	var id_jadwal="<?php echo $id_jadwal;?>";
	var cat='<?php echo $cpembelajaran;?>';
	if(id_materi!="create")
	{
	
		 blok("area_load");
 			  $.post("<?php echo site_url("kbm/getMenuKbm"); ?>",{id_jadwal:id_jadwal,id_materi:id_materi,idkelas:<?php echo $id_kelas?>,cat:cat},function(data){
			  $("#menu").html(data);
	 	  unblock("area_load");
		//	  masuk(id_materi);
		      }); 
	}else{
	//	$("#menu").hide();
		var idkikd=$("[name='kikd']").val();
		if(idkikd!=null)
		{
			inputMateri();
			$("[name='id_materi']").val(0);
		}
	}
 }
 
 
  function pindahInputanBentrok()
 {
   
     insertMateriBaruBentrok();
       $("[name='materi']").focus();
 }
 
 
 
 
 
 
  	 function history_mengajar()
 {      $("#defaultModalLabel").html("History Mengajar");
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
         
         <?php
         if($vis){
             echo "<script>ready()</script>";
         }
         ?>
		 