<?php
$tahun=$this->m_reff->tahun();
$sms=$this->m_reff->semester();
$this->db->where("id_tahun",$tahun);
$this->db->where("id_semester",$sms);
$data=$this->db->get_where("v_mapel_ajar",array("id"=>$id))->row();
?>
<style>
#tabul td{
border:black solid 1px;
color:black;
}
</style>

<table class="table table-bordered" id="tabul">
<tr class="bg-teal  col-white">
<td   style='color:white'><b>Senin</b></td>
<td   style='color:white'><b>Selasa</b></td>
<td   style='color:white'><b>Rabu</b></td>
<td   style='color:white'><b>Kamis</b></td>
<td   style='color:white'><b>Jum'at</b></td>
 
</tr>
<?php 
$jmljam=10;
for($i=1;$i<=$jmljam;$i++){ 
    
$cek=$this->mdl->cekJadwalAh(1,$i,$data->id_kelas,$data->id_mapel); //idhari,jam
 
$cek=explode("::",$cek);
 
if($cek[0]=="sendiri" and $data->id_mapel==$cek[1] and $data->id_kelas==$cek[3])
{
	$class="chk-col-pink"; $status="checked";
}elseif($cek[0]=="sendiri" and $data->id_mapel!=$cek[1])
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}elseif($cek[0]=="lain")
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}else{
	$class="chk-col-pink"; $status=" ";
}





$namaguru=$this->m_reff->goField("data_pegawai","nama","where id='".$cek[2]."'");
$namamapel=$this->m_reff->goField("tr_mapel","nama","where id='".$cek[1]."'");

if($i==1){ //ini adalah hari senin maka jika jam 1 upcara
    	$class="chk-col-pink"; $status="disabled='disabled'";
    	$namaguru="UPACARA";$namamapel="";
}

?>
<tr>

<td>Jam ke <?php echo $i ?>  		
<span class="pull-right"  data-placement="top" data-original-title="<?php echo $namaguru;?>  <?php echo $namamapel;?>" data-toggle="tooltip"> 
<input type="checkbox"   class="filled-in <?php echo $class?>" <?php echo $status;?>  onclick="ceklis(`senin`,<?php echo $i;?>,1)" id="senin<?php echo $i;?>" name="senin[]" value="<?php echo $i?>"/>
  <label for="senin<?php echo $i;?>">&nbsp;</label></span>
 </td>
 <?php
 $cek=$this->mdl->cekJadwalAh(2,$i,$data->id_kelas,$data->id_mapel); //idhari,jam
 $cek=explode("::",$cek);
if($cek[0]=="sendiri" and $data->id_mapel==$cek[1] and $data->id_kelas==$cek[3])
{
	$class="chk-col-pink"; $status="checked";
}elseif($cek[0]=="sendiri" and $data->id_mapel!=$cek[1])
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}elseif($cek[0]=="lain")
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}else{
	$class="chk-col-pink"; $status=" ";
}
$namaguru=$this->m_reff->goField("data_pegawai","nama","where id='".$cek[2]."'");$namamapel=$this->m_reff->goField("tr_mapel","nama","where id='".$cek[1]."'");
?>
 <td>Jam ke <?php echo $i ?>  	
<span class="pull-right"   data-placement="top" data-original-title="<?php echo $namaguru;?>   <?php echo $namamapel;?>" data-toggle="tooltip"> 
<input type="checkbox" id="selasa<?php echo $i;?>"  class="filled-in <?php echo $class?>" <?php echo $status;?>   onclick="ceklis('selasa',<?php echo $i;?>,2)" name="selasa[]" value="<?php echo $i?>" />
  <label for="selasa<?php echo $i;?>">&nbsp;</label></span>
 </td>
 <?php
 $cek=$this->mdl->cekJadwalAh(3,$i,$data->id_kelas,$data->id_mapel); //idhari,jam
 $cek=explode("::",$cek);
if($cek[0]=="sendiri" and $data->id_mapel==$cek[1] and $data->id_kelas==$cek[3])
{
	$class="chk-col-pink"; $status="checked";
}elseif($cek[0]=="sendiri" and $data->id_mapel!=$cek[1])
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}elseif($cek[0]=="lain")
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}else{
	$class="chk-col-pink"; $status=" ";
}$namaguru=$this->m_reff->goField("data_pegawai","nama","where id='".$cek[2]."'");$namamapel=$this->m_reff->goField("tr_mapel","nama","where id='".$cek[1]."'");
?>
 <td>Jam ke <?php echo $i ?> 
<span class="pull-right"   data-placement="top" data-original-title="<?php echo $namaguru;?>   <?php echo $namamapel;?> " data-toggle="tooltip"> 
<input type="checkbox" id="rabu<?php echo $i;?>" class="filled-in <?php echo $class?>" <?php echo $status;?>   onclick="ceklis(`rabu`,<?php echo $i;?>,3)" name="rabu[]"  value="<?php echo $i?>"/>
  <label for="rabu<?php echo $i;?>">&nbsp;</label></span>
 </td>
  <?php
 $cek=$this->mdl->cekJadwalAh(4,$i,$data->id_kelas,$data->id_mapel); //idhari,jam
 $cek=explode("::",$cek);
if($cek[0]=="sendiri" and $data->id_mapel==$cek[1] and $data->id_kelas==$cek[3])
{
	$class="chk-col-pink"; $status="checked";
}elseif($cek[0]=="sendiri" and $data->id_mapel!=$cek[1])
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}elseif($cek[0]=="lain")
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}else{
	$class="chk-col-pink"; $status=" ";
}$namaguru=$this->m_reff->goField("data_pegawai","nama","where id='".$cek[2]."'");$namamapel=$this->m_reff->goField("tr_mapel","nama","where id='".$cek[1]."'");
?>
 <td>Jam ke <?php echo $i ?>  	
<span class="pull-right"   data-placement="top" data-original-title="<?php echo $namaguru;?> <?php echo $namamapel;?>" data-toggle="tooltip"> 
<input type="checkbox" id="kamis<?php echo $i;?>" class="filled-in <?php echo $class?>" <?php echo $status;?>   onclick="ceklis(`kamis`,<?php echo $i;?>,4)" name="kamis[]" value="<?php echo $i?>" />
  <label for="kamis<?php echo $i;?>">&nbsp;</label></span>
 </td>
  <?php
 $cek=$this->mdl->cekJadwalAh(5,$i,$data->id_kelas,$data->id_mapel); //idhari,jam
 $cek=explode("::",$cek);
if($cek[0]=="sendiri" and $data->id_mapel==$cek[1] and $data->id_kelas==$cek[3])
{
	$class="chk-col-pink"; $status="checked";
}elseif($cek[0]=="sendiri" and $data->id_mapel!=$cek[1])
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}elseif($cek[0]=="lain")
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}else{
	$class="chk-col-pink"; $status=" ";
}$namaguru=$this->m_reff->goField("data_pegawai","nama","where id='".$cek[2]."'");$namamapel=$this->m_reff->goField("tr_mapel","nama","where id='".$cek[1]."'");
?>
 <td>Jam ke <?php echo $i ?>  	
<span class="pull-right"   data-placement="top" data-original-title="<?php echo $namaguru;?> <?php echo $namamapel;?>" data-toggle="tooltip"> 
<input type="checkbox" id="jumat<?php echo $i;?>" class="filled-in <?php echo $class?>" <?php echo $status;?>   onclick="ceklis(`jumat`,<?php echo $i;?>,5)" name="jumat[]" value="<?php echo $i?>" />
  <label for="jumat<?php echo $i;?>">&nbsp;</label></span>
 </td>
  <?php
 /*$cek=$this->mdl->cekJadwalAh(6,$i,$data->id_kelas,$data->id_mapel); //idhari,jam
 $cek=explode("::",$cek);
if($cek[0]=="sendiri" and $data->id_mapel==$cek[1])
{
	$class="chk-col-pink"; $status="checked";
}elseif($cek[0]=="sendiri" and $data->id_mapel!=$cek[1])
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}elseif($cek[0]=="lain")
{
	$class="chk-col-grey"; $status="disabled='disabled'";
}else{
	$class="chk-col-pink"; $status=" ";
}$namaguru=$this->m_reff->goField("data_pegawai","nama","where id='".$cek[2]."'"); */
?>
 <!--<td>Jam ke <?php echo $i ?>  
<span class="pull-right"> 
<input type="checkbox" id="sabtu<?php echo $i;?>" class="filled-in <?php echo $class?>" <?php echo $status;?>   onclick="ceklis(`sabtu`,<?php echo $i;?>,6)" name="sabtu[]"  value="<?php echo $i?>"/>
  <label for="sabtu<?php echo $i;?>">&nbsp;</label></span>
 </td>-->
 
</tr>
<?php } ?>
 
</table>

<script>
 $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
	
	
var jmljam ="<?php echo $jmljam; ?>";
var id_mapel ="<?php echo $data->id_mapel; ?>";
var id_kelas ="<?php echo $data->id_kelas; ?>";
function ceklis(hari,no,kodeHari)
{	 
		     
		  setNilai(hari,kodeHari,no)
				
}
 
function setNilai(hari,id_hari,no)
{
	   var values = new Array();
			 $.each($("input[name='"+hari+"[]']:checked"), function() {
			 values.push($(this).val());
			 });
			 
	 var values_all = new Array();
			 $.each($(".chk-col-pink:checked"), function() {
			 values_all.push($(this).val());
			 });
			 
			 
		var link ="<?php echo base_url()?>guru_instal/setJadwal";
		 $.ajax({
		 url:link,
		 data: {jam_select:no,id_mapel:id_mapel,id_hari:id_hari,id_kelas:id_kelas,jam:values,jam_all:values_all},
		 method:"POST",
		 dataType:"JSON",
		 success: function(data)
		 { 	 
			 if(data["gagal"]==true)
			 {
				  $("#"+hari+no).prop('checked', false);
				 notif("<b>Gagal  !!</b><br>Baru saja dijam tersebut sudah ada yang ngisi !!");
				
			 }else if(data["jml_jam"]==false)
			 {
				  $("#"+hari+no).prop('checked', false);
				 notif("<b>Gagal  !!</b><br>Jumlah jam melebihi ketentuan.");
				
			 }else if(data["runing"]==false)
			 {
				  $("#"+hari+no).prop('checked', false);
				 notif("<b>Gagal  !!</b><br>Jadwal tidak dapat diubah karena KBM sudah dimulai untuk mapel ini.");
				
			 }
			 reload_table();
		 }
		});
}

function cekJadwal(hari,id_hari)
{
			var values = new Array();
			 $.each($("input[name='"+hari+"[]']:checked"), function() {
			 values.push($(this).val());
			 });
			 
		 var link ="<?php echo base_url()?>guru_instal/cekJadwal";
		 $.ajax({
		 url:link,
		 data: {id_mapel:id_mapel,id_hari:id_hari,id_kelas:id_kelas,jam:values},
		 method:"POST",
		 dataType:"JSON",
		 success: function(data)
				{ 	 
						 if(data["validasi"]==true)
						{
							setNilai(hari,id_hari);
							reload_table();
						}else if(data["validasi"]==false){
							notif("Tidak dapat ditambahkan !!<br>Pemilihan jam mengajar tidak boleh melintasi jam mengajar yang sudah dipilih mapel lain. ");
							setDisabled(hari,id_hari,values);
						}else{
							alert("Eror 001!<br>Mohon hubungi administrator!");
						}				
				}
		});     
}

function setDisabled(hari,id_hari,values)
{  
	var str=""+values+"";
	var res = str.split(",");
	var jml = res.length;
	var first = res[0];
	var last = res[(jml-1)];
	 
	for(x=first;x<=<?php echo $jmljam; ?>;x++)
	{
		 var id=hari+""+x;
		$("#"+id).prop('checked', false);
	}

}
</script>