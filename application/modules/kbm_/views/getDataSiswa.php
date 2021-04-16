<style>
.asiss{
	border-bottom:black solid 1px;padding:5px;padding-left:13px;
	cursor:pointer;
}
 
</style>
<?php
$token=date('His');
 $id_kelas=$this->input->post("idkelas");
 $idjadwal=$this->input->post("idjadwal");
 $idmapel=$this->m_reff->goField("v_jadwal","id_mapel","where id='".$idjadwal."'");
 $datasts=$this->db->get_where("tr_sts_kehadiran")->result();
?>
 
 <div class="card">
                        <div class="header">
                            <h2 style="font-size:14px">
                                DATA SISWA
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="#" onclick="tutup()" class="dropdown-toggle"  >
                                       <i class="material-icons">clear</i>
                                    </a>
                                   
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
<table class="entry table-border table-hover " id="view" width="100%">
 <tr>
 
 <th>NAMA</th>
 <?php
 foreach($datasts as $sts)
 {?>
 <th width="20px"><?php echo $sts->alias;?></th>
 <?php } ?>
 
 </tr>

<?php
$this->db->order_by("nama","asc");
$this->db->where("id_kelas",$id_kelas);
$this->db->where("id_tahun_keluar",null);
$siswa=$this->db->get("v_siswa")->result();
$no=1;
foreach($siswa as $val)
{	$ids=$val->id;	$noid=$val->nis;
	$nama=strtolower($val->nama);
	$nama="<span class='hoverline col-blue cursor'>".ucwords($nama)."</span>";
?>
<tr>
 
<td>
<?php
$stscek=$this->mdl->cekStsHadirSiswa($idjadwal,$val->id);
 	 
  echo "<span style='cursor:pointer' class='linehover' onclick='kirimCatatan(`".$val->id."`,`".$val->id_kelas."`,`".$val->nama."`)'>".$nama."</span>";?>  
 
 </td>
 <?php
 $urut=1;$absen="";
 foreach($datasts as $sts)
 {
	 $cekfinger=$this->mdl->cekfinger($noid);
	 if($cekfinger)
	 {
		 $stscek=1;
	 }
	 if($sts->id==$stscek)
	 {
		$absen="checked";
	 }else{
		 $absen="";
	 }
	 
	 if($sts->id==1){
		 $namaabsen="Masuk";
	 }elseif($sts->id==2){
		 $namaabsen="Sakit";
	 }elseif($sts->id==3){
		 $namaabsen="Izin";
	 }elseif($sts->id==4){
		 $namaabsen="Alfa";
	 }elseif($sts->id==5){
		 $namaabsen="Dispen";
	 }elseif($sts->id==6){
		 $namaabsen="Bolos";
	 }
	  
	?>
  <td align="center" data-toggle='tooltip' 
		  data-original-title='<?php echo $namaabsen;?>'
			  data-placement='top'> 
		<input type="radio" value="<?php echo $sts->id;?>"  <?php echo $absen?> class="filled-in chk-col-pink absen<?php echo $token;?>"    
		  idsiswa="<?php echo $val->id;?>" chek="<?php echo $stscek?>" absen="<?php echo $sts->id;?>"  id="<?php echo $ids; ?>id<?php echo $sts->id; ?>" 
		  name="f[id<?php echo $ids; ?>]"  />
		<label for="<?php echo $ids; ?>id<?php echo $sts->id; ?>">&nbsp;</label> 
 </td>  

 <?php }
 ?>
 
  </tr>
<?php } ?>


 </table>
 </div><center>
 <p class='col-teal' onclick='tutup()' style='cursor:pointer' ><i class="material-icons">save</i> <b style="margin-top:3px;position:absolute"> SIMPAN </b></p></center> 
        </div>
                  
				  
	<script>
	 $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
 
setTimeout(function(){ simpan(); }, 1000);
	function simpan()
	{
			 
			   var idjadwal="<?php echo $idjadwal?>";
			   var idmapel="<?php echo $idmapel?>";
		  
					var hadir="";
					var sakit="";
					var izin="";
					var alfa="";
					var bolos="";
					var dispen="";
				$('input:radio').each(function() {
				if($(this).is(':checked')) {
					 var idabsen=$(this).attr("absen");
					 var idsiswa=$(this).attr("idsiswa");
					
				
					 if(idabsen==1)
					{
						  hadir=","+idsiswa+hadir;
					}
					if(idabsen==2)
					{
						  sakit=","+idsiswa+sakit;
					}	
					if(idabsen==3)
					{
						  izin=","+idsiswa+izin;
					}	
					if(idabsen==4)
					{
						  alfa=","+idsiswa+alfa;
					}
					if(idabsen==5)
					{
						  bolos=","+idsiswa+bolos;
					}
					if(idabsen==6)
					{
						  dispen=","+idsiswa+dispen;
					}					
					  
			  }			  
			 
			  
			});
			 
		  $.post("<?php echo site_url("kbm/siswaMasuk"); ?>",{dispen:dispen,hadir:hadir,sakit:sakit,izin:izin,alfa:alfa,bolos:bolos,idjadwal:idjadwal,idmapel:idmapel},function(data){
			 // notif("<b class='col-teal'> <i class='material-icons'>done_all</i> <span style='margin-top:2px;position:absolute'> &nbsp;Tersimpan !!</span></b>");
	 
		      }); 
		  
	}
	</script>			  
                 
 	 <script>
	 
  //$(document).on("click",".absen<?php echo $token;?>",function (event, messages) {
function simpanAbsen(){	 
			   var idabsen=$(this).attr("absen");
			   var idsiswa=$(this).attr("idsiswa");
			   var idjadwal="<?php echo $idjadwal?>";
			   var idmapel="<?php echo $idmapel?>";
		  
					var hadir="";
					var sakit="";
					var izin="";
					var alfa="";
					var bolos="";
					var dispen="";
				$('input:radio').each(function() {
				if($(this).is(':checked')) {
					var idabsen=$(this).attr("absen");
					var idsiswa=$(this).attr("idsiswa");
					
				
					if(idabsen==1)
					{
						  hadir=","+idsiswa+hadir;
					}
					if(idabsen==2)
					{
						  sakit=","+idsiswa+sakit;
					}	
					if(idabsen==3)
					{
						  izin=","+idsiswa+izin;
					}	
					if(idabsen==4)
					{
						  alfa=","+idsiswa+alfa;
					}
					if(idabsen==5)
					{
						  bolos=","+idsiswa+bolos;
					}
					if(idabsen==6)
					{
						  dispen=","+idsiswa+dispen;
					}					
					  
			  }else{
			  }				  
			 
			  
			});
			 
		  $.post("<?php echo site_url("kbm/siswaMasuk"); ?>",{dispen:dispen,hadir:hadir,sakit:sakit,izin:izin,alfa:alfa,bolos:bolos,idabsen:idabsen,idsiswa:idsiswa,idjadwal:idjadwal,idmapel:idmapel},function(data){
			 // notif("<b class='col-teal'> <i class='material-icons'>done_all</i> <span style='margin-top:2px;position:absolute'> &nbsp;Tersimpan !!</span></b>");
		//	unblock("view");
		
		      }); 
		 
  //});
  }
  
  
  
   function tutup()
 {
	    simpan();
	  $("#view").html("");
	
 }
 
 </script>
