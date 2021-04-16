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


 

$id_hari=$ha=date("N"); 
  
 $kelas=$this->m_reff->goField("v_kelas","nama","where id='".$id_kelas."'");
  $mapel=$this->m_reff->goField("tr_mapel","nama","where id='".$id_mapel."'");
 
  

$cekoff=$this->db->query("select * from tm_diliburkan where  substr(tgl,1,10)='".date('Y-m-d')."' ")->num_rows();
 if($cekoff)
{
	echo "<div class='card'><br><center><i>Pembelajaran di non-aktifkan</i></center></div>";
	return false;
}



$vis=$this->db->query("select * from tm_absen_guru where id_jadwal='".$id_jadwal."'
 and id_mapel='".$id_mapel."' and id_guru='".$this->mdl->idu()."' and substr(tgl,1,10)='".date('Y-m-d')."'")->row();

    $cpembelajaran=isset($vis->cpembelajaran)?($vis->cpembelajaran):"";
  
  $sumber=isset($vis->sumber)?($vis->sumber):"";
  $id_kikd=isset($vis->id_kikd)?($vis->id_kikd):"";
 $visizin=$this->db->query("select * from tm_absen_guru where id_guru='".$this->mdl->idu()."' and substr(tgl,1,10)='".date('Y-m-d')."' limit 1")->row();
   $izin=isset($visizin->izin)?($visizin->izin):"";
 if($sumber==3){
     $izin="<font color='yellow' size='3'>Anda sedang izin mengajar!</font>";
      $dataIzin=true;
 }else{
     $izin="Tidak KBM, tidak Kirim tugas karena suatu hal";
       $dataIzin=false;
 }
 
//if(strpos($jam_diblok,$jamkenow)!==false)
//{
//	echo "<div class='card font-bold col-pink' style='padding:10px'> <center> ABSEN ANDA TELAH DIBLOK  DI JAM PELAJARAN SEKARANG !! </center></div>";
//	return false;
//}


?>
		<?php
if($sumber==1){?>	 
  <!-- Tahun Ajaran <?php echo $this->m_reff->tahun_ajaran();?> - Semester <?php echo $this->m_reff->semester();?>  Task Info -->
  <div class="row clearfix" style="margin-top:-40px">
             
 
                <div class=" col-sm-12 col-md-12 col-lg-12">
                    <div class="cardx" id="area_load"><br>
                       <center><b class='col-teal'> JADWAL MENGAJAR HARI INI</b></center>
                      
                      
                       
                      
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
		//$this->db->where("id_mapel",$idMapel);
		//$this->db->where("id_kelas",$idKelas);
		//$this->db->where("kd3_kb>",0);
		//$this->db->group_by("code");
		$dtkikd=$this->db->query("SELECT * FROM `v_kikd` WHERE `id_tahun` = '".$tahun."' AND `id_semester` = '".$sms."' AND `id_guru` = '".$this->mdl->idu()."' 
		AND `id_mapel` = '".$id_mapel."' AND `id_kelas` = '".$id_kelas."' AND `kd3_kb` >0 ORDER BY CAST(SUBSTR(kd3_no  , 3  , 5) AS SIGNED INTEGER) ASC");
		//$dtkikd=$this->db->get("v_kikd");
	if(!$dtkikd->num_rows()){
		    $id_guru=$this->mdl->idu();
		     $this->m_reff->isi_kikd($tahun,$sms,$id_kelas,$id_mapel,$id_guru);
	          echo "<script>getKontenKBM()</script>";
		}
		$ray="";
	 
		$ray[""]="=== Pilih KI.KD ===";
		$val="";
		foreach($dtkikd->result() as $val)
		{
			$ray[$val->id]=$val->kd3_no." - ".$val->kd3_desc." __ ".$val->kd4_no." - ".$val->kd4_desc;
		}
		$datakikd=$ray;
		echo form_dropdown("kikd",$datakikd,$id_kikd,"class='form-control' style=' width:100%' onchange='insertMateriAnyar()' ");?>
                             
                         </td>
                         <tr>
                             <td><b>Isi Pembahasan</b>	
                             <textarea name='materi' class='form-control ' placeholder="Pembahasan..." onchange='insertMateriAnyar()'><?php echo $cpembelajaran;?></textarea>
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
  <script>
 setTimeout(function(){  insertMateriAnyar(); }, 300);
   
  </script>
  	<?php } ?> <!--- end if sumber--->	
  
  <div id="dataPiihanSumber">   </div>
  
  <?php
  if(!$sumber or $sumber==3  or $sumber==4){?>
  
  <div id="sumber">
  
  <center><b>SILAHKAN PILIH SESUAI KONDISI</b></center><br>
  <div class="info-box bg-teal hover-expand-effect" onclick="xxxxx(`1`)">
                        <div class="icon">
                            <i class="material-icons">contacts</i>
                        </div>
                        <div class="content">
                            <div class="text">Melaksanakan KBM, Mengabsen Siswa</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">MENGAJAR</div>
                        </div>
    </div>
    
    <div class="info-box bg-brown hover-expand-effect"  onclick="xxxxx(`2`)">
                        <div class="icon">
                            <i class="material-icons">import_contacts</i>
                        </div>
                        <div class="content">
                            <div class="text">Kirim tugas karena tidak bisa KBM</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">KIRIM TUGAS</div>
                        </div>
    </div>
  
   <!---  <textarea name="f[izin]" class="form-control"  placeholder="Alasan izin mengajar" style="min-height:80px"></textarea>-->
  
  
  
    <div class="info-box bg-blue-grey hover-expand-effect"  onclick="xxxxx(`3`)">
                        <div class="icon">
                            <i class="material-icons">live_help</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:11px"><?php echo $izin;?></div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">IZIN MENGAJAR</div>
                        </div>
    </div> 
  
  
  <!--<center><a href='<?php echo $this->m_reff->tutorial(1)?>'><b>Anda Belum Mengerti ? klik disini. (youtube) </b></a></center>-->
   </div>
   
   
     
	
	
	
   <?php }else{ ?>
   
   
   
   <?php } ?>
  
   
   
   
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
 <?php } ?>
 
 
 
 
 <script>

      function insertMateriAnyar()
 {  
     var id_kikd=$("[name='kikd']").val();
       var materi=""
         var id_materi="";
    var id_jadwal="<?php echo $id_jadwal;?>";
			$.post("<?php echo site_url("kbm/insertMateriBaru"); ?>",{id_kikd:id_kikd,materi:materi,id_jadwal:id_jadwal,id_materi:id_materi},function(data){
			   $("[name='id_materi']").val();
			   	masuk(data);	
		     }); 
 }
  
    
       function xxxxx(id)
       { 
             var idkelas="<?php echo $id_kelas ?>";
            var jam="<?php echo $data_jam?>";
            var izin="<?php echo $dataIzin ?>";
           var msg;
           if(id==1){
               msg="Anda akan melaksanakan KBM seperti biasa : mengisi agenda dan mengabsen siswa.";
           }else if(id==2){
               msg="Anda tidak akan melaksanakan KBM, tapi akan digantikan dengan KIRIM TUGAS ke siswa ?";
           }else {
               msg="Anda akan IZIN MENGAJAR tidak bisa melaksanakan KBM juga tidak bisa KIRIM TUGAS karena suatu hal ? ";
           }
            alertify.confirm("<center>"+msg+"</center>",function(){
                loadkonten();
		   $.post("<?php echo base_url()?>kbm/addSumber",{id:id,idMapel:<?php echo $id_mapel;?>,idJadwal:<?php echo $id_jadwal;?>,idKelas:idkelas,jam:jam,izin:izin},function(){ 
		       if(id==1){
		         getKontenKBM();
		       }else 
		       {
		             getSumber(id);
		       }
		
			  unloadkonten();
			     $("#sumber").html("<br><br>");
		      })
		   })
		
       }
       
              
 function getKontenKBM()
 {   var idkelas="<?php echo $id_kelas ?>";
            var jam="<?php echo $data_jam?>";
            var izin="<?php echo $dataIzin ?>";
      $.post("<?php echo base_url()?>kbm/awalmula",{ajax:"yes",idMapel:<?php echo $id_mapel;?>,idJadwal:<?php echo $id_jadwal;?>,idKelas:idkelas,jam:jam},function(data){  
		           $(".content").html(data);
		      });
 }
 
  function masuk()
 {	var kikd=$("[name='kikd']").val();
	var mapel="<?php echo $id_mapel; ?>";
	var jam="<?php echo $data_jam?>";
	var jam_blok=null;
	var id_jadwal="<?php echo $id_jadwal?>";
	var materi=$("[name='materi']").val();
	 $.post("<?php echo site_url("kbm/guruMasuk"); ?>",{materi:materi,id_mapel:mapel,id_kikd:kikd,id_materi:null,id_kelas:<?php echo $id_kelas?>,jam:jam,jam_blok:jam_blok,id_jadwal:id_jadwal},function(data){
		 $("#menu").show();
		 ready();
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
	
		 blok("area_load");
 			  $.post("<?php echo site_url("kbm/getMenuKbm"); ?>",{id_jadwal:id_jadwal,id_materi:id_materi,idkelas:<?php echo $id_kelas?>,cat:cat},function(data){
			  $("#menu").html(data);
	 	  unblock("area_load"); 
		      }); 
	}
 }
 
  function absenSiswaReady(idkelas,idjadwal)
 {	 

	 loadkonten();
			$.post("<?php echo site_url("kbm/getDataSiswa"); ?>",{idkelas:idkelas,idjadwal:idjadwal},function(data){
			  $("#view").html(data);
			  // unblock();
			  unloadkonten();
			   $('html,body').animate({ scrollTop: 0 }, 'slow');
		      }); 
 }
    function getBahanAjar(idjadwal)
 {$("#defaultModalLabel").html("Bahan Ajar");
     var id_jadwal="<?php echo $id_jadwal;?>";
	 	var id_mapel="<?php echo $id_mapel;?>";
	 	var id_kelas="<?php echo $id_kelas;?>";
		blok();
		$("#mdl_modal_history").modal("show");
			$.post("<?php echo site_url("kbm/getBahanAjar"); ?>",{id_kelas:id_kelas,id_mapel:id_mapel,id_jadwal:id_jadwal},function(data){
			  $("#viewH").html(data);
			   unblock();
		     }); 
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
		 
 