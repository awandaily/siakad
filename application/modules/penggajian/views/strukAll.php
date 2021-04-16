<style type="text/css">
.table{
line-height:1px;
width:440px;
}
.table tr td
{
    padding: 2;
  
    background: #FFFFFF;
	font-family:arial;
	 border-bottom:black solid 0.4px;
	font-size:11px;
	 
  
}
.batasAwal{
margin-left:15px;
}
.b{
font-weight:bold;
}
.desc{
	border:solid 1px #AADDAA;
	width:90%;
}
 
                .pemisah{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width: 70mm;font-size:8px;}
                .master{table-layout: fixed;hight: 70mm;font-size:8px;}
              
			   
			   
	.kop{
width:100%;
padding-bottom:10px;
	}	
	
#table{
width:100%;
font-size:8px;
 
}	
#table tr td{
border-bottom:black solid  0.2px ;
}
.bendahara{
 
 size:9px;
}
.garis{
	padding-bottom:0px;
border :black silid 0.5px;
}.header{
background-color:#fbdf93;
font-weight:bold;
padding:5px;
 border-bottom :black silid 0.5px;
 width:365px;
}.header2{
font-size:10px;
font-weight:bold;
}table tr td{ font-size:8px;}
           </style>
<page style='font-size:8px'>
<?php 
   $id_guru=$this->input->get("id");
   $nama_periode=$this->input->get("periode");
	//$koma=explode(",",$id_guru);
	$db=$this->db->query("select * from keu_data_gaji where id_guru IN (".$id_guru.") and nama_periode='".$nama_periode."' ")->result();
   
foreach($db as $db)	
{
   $id_guru=$db->id_guru;
  
   
   $dataTK=$this->db->query("SELECT  id_tk FROM  v_jadwal WHERE id_guru='".$id_guru."' AND id_semester='".$db->id_semester."' and id_tahun='".$db->id_tahun."' GROUP BY id_tk order by id_tk");
 	$periode=$db->periode;
	$tgl_dibayarkan=isset($db->tgl_dibayarkan)?($db->tgl_dibayarkan):"";		
?>

<table class="master">
<tr>
<td class="pemisah">


<div class='garis'>
 <div align="center" class="header">
 <?php $g=""; ?>
 <?php echo $this->m_reff->tm_pengaturan(7)?><br>
 <?php echo $this->m_reff->tm_pengaturan(8)?> 
 </div>
 
 <p align="center" class="header2">STRUK HONOR STAFF & MENGAJAR GURU<br>
 BULAN <?php echo strtoupper($nama_periode)?><br>
 ( <?php echo $periode;?> )
 </p>
 
 

 <table       border="0"  cellspacing="0" class='table'  >
 <tr style="border-bottom:none">
 <td align="left" style="table-layout:fixed;"  ><b> NAMA</b> </td>
 <td  ><b>: <?php echo $this->m_reff->goField("v_pegawai","nama","where id='".$id_guru."' ")?></b></td>
 
 </tr>
 
 

 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 1 Gaji Pokok </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($a=$db->gaji_pokok,0,",",".");?> </td>
 </tr>
 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 2 Tunjangan Jabatan </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($b=$db->tunjangan_jabatan,0,",",".");?> </td>
 </tr>
 
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 3 Wali Kelas </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($c=$db->wali_kelas,0,",",".");?> </td>
 </tr>
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 4 Piket </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($d=$db->piket,0,",",".");?> </td>
 </tr>
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 5 Pembina Ektrakurikuler </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($e=$db->pembina_eskul,0,",",".");?> </td>
 </tr>
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 6 BPBK</b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($f=$db->p_fungsional,0,",",".");?> </td>
 </tr>  
 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 7 Kepramukaan Wajib </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($g=$db->kepramukaan_wajib,0,",",".");?>  </td>
 </tr> 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 8 Supervisi Akademik </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($h=$db->supervisi_akademik,0,",",".");?>  </td>
 </tr>
 <!---
<tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 8 Honor KBM   </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp   echo number_format($h=$db->kepramukaan_wajib,0,",",".");?>  </td>
 </tr>

--->
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 45%;">  <b> 9 Honor KBM Inval </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php 
			$inval=$db->inval;
 echo number_format($j=$inval,0,",",".");?> </td>
 </tr> 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 10 Honor Non KBM </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($i=$db->honor,0,",",".");?> </td>
 </tr> <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b>Total </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;"><b>: Rp  <?php echo number_format($a+$b+$c+$d+$e+$f+$g+$h+$i+$j,0,",",".");?></b> </td>
 </tr>
 
 </table>

 
 
 
 <?php
  if($dataTK->num_rows())
 {
	 ?>
  <table   border="0"  cellspacing="0" class='table'  >
 <tr>
			<td colspan="10" style="table-layout:fixed;width: 85%;border:none" > <b class="col-pink">PERHITUNGAN KBM  </b></td>
			</tr>
 <?php
		$honor=$db->honor_kbm;
		$totalKBMNormal=""; $i=0; $totalKBMInvalid="";
			foreach($dataTK->result() as $dbtk){	$i++; $tk=$dbtk->id_tk;?>		
			<tr>
			<td><b>Kelas <?php echo $this->m_reff->goField("tr_tingkat","nama","where id='".$tk."' ")?> </b></td>
			<td>:</td>
			<td><?php     
			$jamMasuk=$this->mdl->jmlJamMengajarNormal($periode,$id_guru,$tk);//jam yang masuk
			$jam=$this->mdl->jmlJamMengajarBuild($periode,$id_guru,$tk);
			if($jamMasuk>0){
			echo	$jam; $persen=100;
			}else{
			echo	$jam;$persen=30;
			}
			
			?> Jam </td>
			<td>X&nbsp; </td>
			<td>Rp. <?php echo number_format($honor,0,",","."); ?> </td>
			<td>= Rp <?php echo number_format($total=($honor*$jam),0,",","."); ?></td>
			<td>X&nbsp;</td>
			<td> <?php	echo $persen ?>%</td>
			<td> = &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
			<td align='right'>    <?php echo $total  =number_format($t=(($total/100)*$persen),0,",","."); ?> </td>
			</tr>
<?php 
$blok=$this->mdl->jmlJamMengajarBlok($periode,$id_guru,$tk);	
$totalKBMInvalid=$blok+$totalKBMInvalid;
$totalKBMNormal=$t+$totalKBMNormal;		} 
	$totalHargaHonorKBM=$totalKBMNormal-($totalKBMInvalid*$honor);

?>	

	<?php
if($i){?>	
			<tr style="border-bottom:none">
			<td colspan="9" align="left"><b>Total&nbsp;</b>  </td>
			<td align='right'><b>  Rp&nbsp;&nbsp; <?php echo number_format($totalKBMNormal,0,",",".");?></b></td>
			</tr>
<?php }else{?>
<tr><td colspan="10" ><i> - Tidak mengajar</i></td></tr>
<?php } ?>
 </table>
 
 
 
 
 
 <table  border="0"  cellspacing="0" class="table" >
   
			<tr>
			<td colspan="10" style="table-layout:fixed;width: 85%;border:none" > <b class="col-pink">PERHITUNGAN KBM INVALID </b></td>
			</tr>
			<?php
			$totalKBMNon=""; $i=0;
			$dataTKs=$this->db->query("SELECT  id_tk FROM  v_jadwal WHERE id_guru='".$id_guru."' AND id_semester='".$this->mdl->sms()."' and id_tahun='".$this->mdl->tahun()."' GROUP BY id_tk order by id_tk")->result();
			foreach($dataTKs as $dbtk){		$tk=$dbtk->id_tk;		$i++;		?>
			<tr>			
			<td><b>Kelas  <?php echo $this->m_reff->goField("tr_tingkat","nama","where id='".$tk."' ")?>  </b></td>
			<td>&nbsp;:&nbsp;</td>
			<td><?php echo $blok=$this->mdl->jmlJamMengajarBlok($periode,$id_guru,$tk);?> Jam </td>
			<td>&nbsp;X&nbsp; </td>
			<td>Rp. <?php echo number_format($honor,0,",","."); ?>  </td>	
				<td> = &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
			<td align="right"> <?php echo number_format($total=($blok*$honor),0,",",".");?> </td>
			</tr>
			<?php $totalKBMNon=$total+$totalKBMNon; } ?>
			<?php if($i){?>
			<tr>
			<td colspan="6" align="left"><b> Total &nbsp; </b></td>
			<td  align="right"><b> ( Rp &nbsp; <?php echo number_format($totalKBMNon,0,",",".");?> )</b></td>
			</tr>
			<?php }  else{ echo "<tr><td><i>- Tidak mengajar - </i> </td></tr>"; $totalKBMNon=0;} ?>		
			
			</table>

 
 
 <?php  
 }?>
 
 <br>
 
 <table       border="0"  cellspacing="0" class="table" >
 <tr>
 <td colspan="2" align="left" style="table-layout:fixed;"  ><b> KOPERASI</b> </td>
 
 </tr>
 <?php
 $data=$this->db->query("select kategory,sum(nominal) as nominal from keu_simpanan where id_guru='".$id_guru."' and periode='".$periode."'  group by kategory order by kategory asc ")->result();
 $i="a";$t=0;
 foreach($data as $val)
 {?>
<tr>
<td style='max-width:3px'> &nbsp;<?php echo $i++ ?>. <?php echo $this->m_reff->goField("keu_tr_stssimpanan","nama","where id='".$val->kategory."'");?></td>
<td>: Rp <?php echo number_format($val->nominal,0,",",".") ?></td>
</tr>	 
 <?php $t=$val->nominal+$t;} ?>
 
 
 
 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">&nbsp;<?php echo $i ?>. Potongan Pinjaman  </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($db->cicilan,0,",",".");?> </td>
 </tr> 
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 45%;">&nbsp;BPJS  </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($db->bpjs,0,",",".");?> </td>
 </tr> 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;" align='left'>&nbsp;<b>Total</b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;"><b>: ( Rp  <?php echo number_format($db->cicilan+$db->bpjs+$t,0,",",".");?> ) </b></td>
 </tr>
 </table>
 
 <br>
 <table       border="0"  cellspacing="0"   >
  <tr>
  <td align="left" style="table-layout:fixed;width: 45%;" align="right">&nbsp; JUMLAH PEMASUKAN  </td>
  <td style="table-layout:fixed;width: 20%;" align="right">Rp</td>
 <td align="right" style="table-layout:fixed;width:20%;" align="right">     <?php echo number_format($db->jml_pemasukan,0,",",".");?>  </td>
 </tr><tr >
  <td align="left" style="table-layout:fixed;width: 45%;" align="right">&nbsp; JUMLAH POTONGAN </td>   <td style="table-layout:fixed;width: 20%;" align="right">Rp</td>
 <td align="right" style="table-layout:fixed;width: 20%;" align="right">     <?php echo number_format($db->jml_potongan,0,",",".");?>  </td>
 </tr><tr>
  <td align="left" style="table-layout:fixed;width: 45%;" align="right">&nbsp;<b>TOTAL PEMBAYARAN</b> </td>   <td style="table-layout:fixed;width: 20%;" align="right">Rp</td>
 <td align="right" style="table-layout:fixed;width: 20%;"  align="right"><b> <?php echo number_format(($db->jml_pemasukan-$db->jml_potongan),0,",",".");?></b></td>
 </tr>
 </table>
 
 <table  border="0"  cellspacing="0" >
 <tr>
 <td style="table-layout:fixed;width: 30%;" >
 <div align="center" class="bendahara">
  Subang, <?php if($tgl_dibayarkan){
	  echo $this->tanggal->ind($tgl_dibayarkan,"/");
  }else{
	    echo $this->tanggal->ind(date('Y-m-d'),"/");
  };?> <br>
  Bendahara, <br>
 <br>
 <br>
 <br>
 

<b>( <?php echo $this->m_reff->goField("admin","owner","where id_admin='".$this->mdl->idu()."'");?> ) </b><br>
 </div>
 
</td>
 
</tr>
</table>
  </div> 
</td>
<td  class="pemisah">
<!---------------------------------------->


<?php

 //  $db=$this->db->query("select * from keu_data_gaji where id_guru='".$id_guru."' and nama_periode='".$nama_periode."' ")->row();
 //  $dataTK=$this->db->query("SELECT  id_tk FROM  v_jadwal WHERE id_guru='".$id_guru."' AND id_semester='".$db->id_semester."' and id_tahun='".$db->id_tahun."' GROUP BY id_tk order by id_tk");
 //	$periode=$db->periode;		
?>


<div class='garis' style="margin-left:10px">
 <div align="center" class="header">
 <?php $g=""; ?>
 <?php echo $this->m_reff->tm_pengaturan(7)?><br>
 <?php echo $this->m_reff->tm_pengaturan(8)?> 
 </div>
 
 <p align="center" class="header2">STRUK HONOR STAFF & MENGAJAR GURU<br>
 BULAN <?php echo strtoupper($nama_periode)?><br>
 ( <?php echo $periode;?> )
 </p>
 
 

 <table       border="0"  cellspacing="0" class='table'>
 <tr style="border-bottom:none">
 <td align="left" style="table-layout:fixed;"  ><b> NAMA</b> </td>
 <td  ><b>: <?php echo $this->m_reff->goField("v_pegawai","nama","where id='".$id_guru."' ")?></b></td>
 
 </tr>
 
 

 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 1 Gaji Pokok </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($a=$db->gaji_pokok,0,",",".");?> </td>
 </tr>
 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 2 Tunjangan Jabatan </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($b=$db->tunjangan_jabatan,0,",",".");?> </td>
 </tr>
 
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 3 Wali Kelas </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($c=$db->wali_kelas,0,",",".");?> </td>
 </tr>
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 4 Piket </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($d=$db->piket,0,",",".");?> </td>
 </tr>
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 5 Pembina Ektrakurikuler </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($e=$db->pembina_eskul,0,",",".");?> </td>
 </tr>
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 6 BPBK </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($f=$db->p_fungsional,0,",",".");?> </td>
 </tr>  
 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 7 Kepramukaan Wajib </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($g=$db->kepramukaan_wajib,0,",",".");?>  </td>
 </tr> 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 8 Supervisi Akademik </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($h=$db->supervisi_akademik,0,",",".");?>  </td>
 </tr>
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 45%;">  <b> 9 Honor KBM Inval </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php 
			$inval=$db->inval;
 echo number_format($j=$inval,0,",",".");?> </td>
 </tr> 
 <!---
<tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 8 Honor KBM   </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp   echo number_format($h=$db->kepramukaan_wajib,0,",",".");?>  </td>
 </tr>

--->
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b> 10 Honor Non KBM </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($i=$db->honor,0,",",".");?> </td>
 </tr> <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">  <b>Total </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;"><b>: Rp  <?php echo number_format($a+$b+$c+$d+$e+$f+$g+$h+$i+$j,0,",",".");?></b> </td>
 </tr>
 
 </table>

 
 
 
 <?php
  if($dataTK->num_rows())
 {
	 ?>
  <table   border="0"  cellspacing="0" class='table'  >
 <tr>
			<td colspan="10" style="table-layout:fixed;width: 85%;border:none" > <b class="col-pink">PERHITUNGAN KBM  </b></td>
			</tr>
 <?php
		$honor=$db->honor_kbm;
		$totalKBMNormal=""; $i=0; $totalKBMInvalid="";
			foreach($dataTK->result() as $dbtk){	$i++; $tk=$dbtk->id_tk;?>		
			<tr>
			<td><b>Kelas <?php echo $this->m_reff->goField("tr_tingkat","nama","where id='".$tk."' ")?> </b></td>
			<td>:</td>
			<td><?php     
			$jamMasuk=$this->mdl->jmlJamMengajarNormal($periode,$id_guru,$tk);//jam yang masuk
			$jam=$this->mdl->jmlJamMengajarBuild($periode,$id_guru,$tk);
			if($jamMasuk>0){
			echo	$jam; $persen=100;
			}else{
			echo	$jam;$persen=30;
			}
			
			?> Jam </td>
			<td>X&nbsp; </td>
			<td>Rp. <?php echo number_format($honor,0,",","."); ?> </td>
			<td>= Rp <?php echo number_format($total=($honor*$jam),0,",","."); ?></td>
			<td>X&nbsp;</td>
			<td> <?php	echo $persen ?>%</td>
			<td> = &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
			<td align='right'>    <?php echo $total  =number_format($t=(($total/100)*$persen),0,",","."); ?> </td>
			</tr>
<?php 
$blok=$this->mdl->jmlJamMengajarBlok($periode,$id_guru,$tk);	
$totalKBMInvalid=$blok+$totalKBMInvalid;
$totalKBMNormal=$t+$totalKBMNormal;		} 
	$totalHargaHonorKBM=$totalKBMNormal-($totalKBMInvalid*$honor);

?>	

	<?php
if($i){?>	
			<tr style="border-bottom:none">
			<td colspan="9" align="left"><b>Total&nbsp;</b>  </td>
			<td align='right'><b>  Rp&nbsp;&nbsp; <?php echo number_format($totalKBMNormal,0,",",".");?></b></td>
			</tr>
<?php }else{?>
<tr><td colspan="10" ><i> - Tidak mengajar</i></td></tr>
<?php } ?>
 </table>
 
 
 
 
 
 <table  border="0"  cellspacing="0" class="table" >
   
			<tr>
			<td colspan="10" style="table-layout:fixed;width: 85%;border:none" > <b class="col-pink">PERHITUNGAN KBM INVALID </b></td>
			</tr>
			<?php
			$totalKBMNon=""; $i=0;
			$dataTK=$this->db->query("SELECT  id_tk FROM  v_jadwal WHERE id_guru='".$id_guru."' AND id_semester='".$this->mdl->sms()."' and id_tahun='".$this->mdl->tahun()."' GROUP BY id_tk order by id_tk")->result();
			foreach($dataTK as $dbtk){		$tk=$dbtk->id_tk;		$i++;		?>
			<tr>			
			<td><b>Kelas  <?php echo $this->m_reff->goField("tr_tingkat","nama","where id='".$tk."' ")?>  </b></td>
			<td>&nbsp;:&nbsp;</td>
			<td><?php echo $blok=$this->mdl->jmlJamMengajarBlok($periode,$id_guru,$tk);?> Jam </td>
			<td>&nbsp;X&nbsp; </td>
			<td>Rp. <?php echo number_format($honor,0,",","."); ?>  </td>	
				<td> = &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp</td>
			<td align="right"> <?php echo number_format($total=($blok*$honor),0,",",".");?> </td>
			</tr>
			<?php $totalKBMNon=$total+$totalKBMNon; } ?>
			<?php if($i){?>
			<tr>
			<td colspan="6" align="left"><b> Total &nbsp; </b></td>
			<td  align="right"><b> ( Rp &nbsp; <?php echo number_format($totalKBMNon,0,",",".");?> )</b></td>
			</tr>
			<?php }  else{ echo "<tr><td><i>- Tidak mengajar - </i> </td></tr>"; $totalKBMNon=0;} ?>		
			
			</table>

 
 
 <?php  
 }?>
 
 <br>
 
 <table       border="0"  cellspacing="0" class="table" >
 <tr>
 <td colspan="2" align="left" style="table-layout:fixed;"  ><b> KOPERASI</b> </td>
 
 </tr>
 <?php
 $data=$this->db->query("select kategory,sum(nominal) as nominal from keu_simpanan where id_guru='".$id_guru."' and periode='".$periode."'  group by kategory order by kategory asc ")->result();
 $i="a";$t=0;
 foreach($data as $val)
 {?>
<tr>
<td style='max-width:3px'> &nbsp;<?php echo $i++ ?>. <?php echo $this->m_reff->goField("keu_tr_stssimpanan","nama","where id='".$val->kategory."'");?></td>
<td>: Rp <?php echo number_format($val->nominal,0,",",".") ?></td>
</tr>	 
 <?php $t=$val->nominal+$t;} ?>
 
 
 
 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;">&nbsp;<?php echo $i ?>. Potongan Pinjaman  </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($db->cicilan,0,",",".");?> </td>
 </tr> 
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 45%;">&nbsp;BPJS  </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;">: Rp  <?php echo number_format($db->bpjs,0,",",".");?> </td>
 </tr> 
 <tr>
 
 <td align="left" style="table-layout:fixed;width: 48%;" align='left'>&nbsp;<b>Total</b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;"><b>: ( Rp  <?php echo number_format($db->cicilan+$db->bpjs+$t,0,",",".");?> ) </b></td>
 </tr>
 </table>
 
 <br>
 <table       border="0"  cellspacing="0"   >
  <tr>
  <td align="left" style="table-layout:fixed;width: 45%;" align="right">&nbsp; JUMLAH PEMASUKAN  </td>
  <td style="table-layout:fixed;width: 20%;" align="right">Rp</td>
 <td align="right" style="table-layout:fixed;width:20%;" align="right">     <?php echo number_format($db->jml_pemasukan,0,",",".");?>  </td>
 </tr><tr >
  <td align="left" style="table-layout:fixed;width: 45%;" align="right">&nbsp; JUMLAH POTONGAN </td>   <td style="table-layout:fixed;width: 20%;" align="right">Rp</td>
 <td align="right" style="table-layout:fixed;width: 20%;" align="right">     <?php echo number_format($db->jml_potongan,0,",",".");?>  </td>
 </tr><tr>
  <td align="left" style="table-layout:fixed;width: 45%;" align="right">&nbsp;<b>TOTAL PEMBAYARAN</b> </td>   <td style="table-layout:fixed;width: 20%;" align="right">Rp</td>
 <td align="right" style="table-layout:fixed;width: 20%;"  align="right"><b> <?php echo number_format(($db->jml_pemasukan-$db->jml_potongan),0,",",".");?></b></td>
 </tr>
 </table>
 
 <table  border="0"  cellspacing="0" >
 <tr>
 <td style="table-layout:fixed;width: 150px;" >
  <div align="center" class="bendahara"  >
   Subang,<?php if($tgl_dibayarkan){
	  echo $this->tanggal->ind($tgl_dibayarkan,"/");
  }else{
	    echo $this->tanggal->ind(date('Y-m-d'),"/");
  };?> <br>
  Penerima, <br>
 <br>
 <br>
 <br>
 

<b>( <?php echo $this->m_reff->goField("v_pegawai","nama","where id='".$id_guru."' ")?> ) </b><br>
 </div>
 
</td>
 
</tr>
</table>

  </div> 

















<!---------------------------------------->
</td>
</tr>
</table>
 
  
 

 
<?php } ?>
</page>