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
	?> 
	 
  <td align="center"> 
		<input onclick="simpanAbsensidonk()" type="radio"    value="<?php echo $sts->id;?>" <?php echo $absen;?> class="filled-in chk-col-pink absen<?php echo $token;?>"    
		  idsiswa="<?php echo $val->id;?>" absen="<?php echo $sts->id;?>"  id="<?php echo $ids; ?>id<?php echo $sts->id; ?>" name="id<?php echo $ids; ?>"  />
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
  //$(document).on("click",".absen<?php echo $token;?>",function (event, messages) {
	//  blok("view");
	function simpanAbsensidonk(){
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
  