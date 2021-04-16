
<style>
label {
  display: block;
  padding: 1px;
  position: relative;
 font-weight:normal;
}
label input {
  display: none;
}
label span {
  border: 1px solid #ccc; 
  width: 25px; height: 25px;
  position: absolute;
  overflow: hidden;
  <?php
  if($this->m_reff->mobile())
  {?>
  line-height: 2;
  <?php }else{?>
  line-height: 1.7;
  <?php } ?>
  text-align: center;
  border-radius: 100%;
  font-size: 10pt;
  left: 0; 
  top: 40%;
  color:black;
  
   font-weight:bold;
}
input:checked + span { /*Checked Controller*/
  background: #009688;
  border-color: black;
  color:white;
   font-weight:bold;
}
 
</style>

<style>
.asiss{
	border-bottom:black solid 1px;padding:5px;padding-left:13px;
	cursor:pointer;
}
 
</style>
<?php
$token=date('His');
 
 $idjadwal=$this->input->post("id_jadwal");
 $idkelas=$this->input->post("id_kelas");
 $idmapel=$this->input->post("mapel");
 $datasts=$this->db->get_where("tr_sts_kehadiran")->result();
?>
 
 <div>
                       
                        <div class="body table-responsive">
<table class="entry table-border table-hover " id="view" width="100%">
 <tr>
 
 <th>NO</th>
 <th>NAMA</th>
 <?php
 $tgl=$this->input->post("tgl");
 foreach($datasts as $sts)
 {?>
 <th width="20px"><?php echo $sts->alias;?></th>
 <?php } ?>
 </tr>

<?php
 $id_kelas=$this->input->post("id_kelas");
 $no=1;
$this->db->order_by("nama","asc");
//$this->db->where("substr(tgl,1,10)",$tgl);
$this->db->where("id_kelas",$id_kelas);
$siswa=$this->db->get("data_siswa")->result();
$no=1;
foreach($siswa as $val)
{	$ids=$val->id;
	$nama=$this->m_reff->goField("data_siswa","nama","where id='".$val->id."'");
	$nama=strtolower($nama);
	$nama=ucwords($nama);
?>
<tr>
 
<td>
 <?php echo $no++;?>  
 </td><td>
 <?php echo $nama;?>  
 </td>
 <?php

 foreach($datasts as $sts)
 {
	 
	$stscek=$this->mdl->cekStsHadirSiswa($idjadwal,$val->id,substr($tgl,0,10));
	 if($sts->id==$stscek)
	 {
		$absen="checked";
	 }else{
		 $absen="";
	 }
	 
	 if($sts->id==1){
		 $namaabsen="Masuk";$abjad="M";
	 }elseif($sts->id==2){
		 $namaabsen="Sakit";$abjad="S";
	 }elseif($sts->id==3){
		 $namaabsen="Izin";$abjad="I";
	 }elseif($sts->id==4){
		 $namaabsen="Alfa";$abjad="A";
	 }elseif($sts->id==5){
		 $namaabsen="Dispen";$abjad="D";
	 }elseif($sts->id==6){
		 $namaabsen="Bolos";$abjad="B";
	 }
	 
	 
	 
	?> 
	  <td align="center" data-toggle='tooltipxx' 
		  data-original-title='<?php echo $namaabsen;?>'
			  data-placement='top'> 
			 	<label class="cursor">
		<input onclick='simpanAbsensidonkah()' type="radio" value="<?php echo $sts->id;?>"  <?php echo $absen?> class="filled-in chk-col-pink absen<?php echo $token;?>"    
		  idsiswa="<?php echo $val->id;?>" chek="<?php echo $stscek?>" absen="<?php echo $sts->id;?>"  id="<?php echo $ids; ?>id<?php echo $sts->id; ?>" 
		  name="f[id<?php echo $ids; ?>]"  />
		  <span for="<?php echo $ids; ?>id<?php echo $sts->id; ?>"><?php echo $abjad;?></span> 
		  </label>
		<label for="<?php echo $ids; ?>id<?php echo $sts->id; ?>">&nbsp;</label> 
 </td>  
 
 
  
 <?php }
 ?>
 
  </tr>
<?php } ?>


 </table>
 </div>
        </div>
                  
            <script> 
	function simpanAbsensidonkah(){
			   var idabsen=$(this).attr("absen");
			   var idsiswa=$(this).attr("idsiswa");
			   var idjadwal="<?php echo $idjadwal?>";
			   var idmapel="<?php echo $idmapel?>";
			   var tgl="<?php echo $tgl?>";
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
			 
		  $.post("<?php echo site_url("kbm/siswaMasuk"); ?>",{tgl:tgl,dispen:dispen,hadir:hadir,sakit:sakit,izin:izin,alfa:alfa,bolos:bolos,idabsen:idabsen,idsiswa:idsiswa,idjadwal:idjadwal,idmapel:idmapel},function(data){
		// return fase;
		      }); 
  };
  
   
  
 </script>  
  