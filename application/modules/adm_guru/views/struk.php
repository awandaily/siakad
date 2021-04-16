<?php 
 //  $id=$this->input->get("id");
   $id_guru=$this->input->get("id_guru");
   $periode=$this->input->get("periode");
   $tgl1=$this->tanggal->range_1($periode,"-");
   $tgl2=$this->tanggal->range_2($periode,"-");
   $tgl=$this->tanggal->indBulan($tgl2," ");
   $nama_periode=substr($tgl,3,50);
   $db=$this->db->query("select * from keu_data_gaji where id_guru='".$id_guru."' and periode='".$periode."' ")->row();
   
   $dataTK=$this->db->query("SELECT  id_tk FROM  v_jadwal WHERE id_guru='".$id_guru."' AND
   id_semester='".$db->id_semester."' and id_tahun='".$db->id_tahun."' GROUP BY id_tk order by id_tk");
			
?>
 
<page style='font-size:12px;color:black' >
<div   class='garis'>
 
 
 <center style="font-size:17px"><b> Rp <?php echo number_format(($db->jml_pemasukan-$db->jml_potongan),0,",",".");?></b></center>

 <table       border="0"  cellspacing="0"   class="table-bordered" width="100%" >
 
 
 

 <tr>
 
 <td align="left"  >  <b> 1 Gaji Pokok </b> </td>
 
 <td align="left"  >:   <?php echo number_format($a=$db->gaji_pokok,0,",",".");?> </td>
 </tr>
 
 <tr>
 
 <td align="left"  >  <b> 2 Tunjangan Jabatan </b> </td>
 
 <td align="left"  >:   <?php echo number_format($b=$db->tunjangan_jabatan,0,",",".");?> </td>
 </tr>
 
  <tr>
 
 <td align="left" >  <b> 3 Wali Kelas </b> </td>
 
 <td align="left"  >:   <?php echo number_format($c=$db->wali_kelas,0,",",".");?> </td>
 </tr>
  <tr>
 
 <td align="left"  >  <b> 4 Piket </b> </td>
 
 <td align="left"  >:   <?php echo number_format($d=$db->piket,0,",",".");?> </td>
 </tr>
  <tr>
 
 <td align="left"  >  <b> 5 Pembina Ektrakurikuler </b> </td>
 
 <td align="left"  >:   <?php echo number_format($e=$db->pembina_eskul,0,",",".");?> </td>
 </tr>
  <tr>
 
 <td align="left"  >  <b> 6 BPBK </b> </td>
 
 <td align="left"  >:   <?php echo number_format($f=$db->p_fungsional,0,",",".");?> </td>
 </tr>  
 
  <tr>
 
 <td align="left" style="table-layout:fixed;width: 55%;">  <b> 7 Kepramukaan Wajib </b> </td>
 
 <td align="left" style="table-layout:fixed;width: 30%;"><?php  number_format($g=$db->kepramukaan_wajib,0,",","."); ?>  </td>
 </tr>   <tr>
 
 <td align="left"  >  <b> 8 Supervisi Akademik </b> </td>
 
 <td align="left"  >:   <?php echo number_format($k=$db->supervisi_akademik,0,",",".");?> </td>
 </tr> <tr>
 
 <td align="left"  >  <b> 9 Honor KBM Inval </b> </td>
 
 <td align="left"  >:   <?php echo number_format($j=$db->inval,0,",",".");?> </td>
 </tr>  <tr>
 
 <td align="left"  >  <b> 10 Honor Non KBM </b> </td>
 
 <td align="left"  >:   <?php echo number_format($h=$db->honor,0,",",".");?> </td>
 </tr> <tr>
 
 <td align="left"  >  <b>Total </b> </td>
 
 <td align="left"  ><b>Rp   <?php echo number_format($a+$b+$c+$d+$e+$f+$g+$h+$j+$k,0,",",".");?></b> </td>
 </tr>
 
 </table>

 
 
 
 <?php
  if($dataTK->num_rows())
 {
	 ?>
  <table   border="0"  cellspacing="0"  class="table-bordered" width="100%" >
 <tr>
			<td colspan="10"  > <b class="col-pink">PERHITUNGAN KBM  </b></td>
			</tr>
 <?php
		$honor=$db->honor_kbm;
		$totalKBMNormal=""; $i=0;  $totalKBMInvalid="";
			foreach($dataTK->result() as $dbtk){	$i++; $tk=$dbtk->id_tk;?>		
			<tr>
			<td><b>Kelas <?php echo $this->m_reff->goField("tr_tingkat","nama","where id='".$tk."' ")?> </b> 
			  </td>
			<td><?php     
			$jamMasuk=$this->mdl->jmlJamMengajarNormal($periode,$id_guru,$tk);//jam yang masuk
			$jam=$this->mdl->jmlJamMengajarBuild($periode,$id_guru,$tk);
			if($jamMasuk>0){
			echo	$jam; $persen=100;
			}else{
			echo	$jam; $persen=30;
			}
			
			?> Jam  
			 &nbsp;<b>X</b>&nbsp;  
			 <?php echo number_format($honor,0,",","."); ?> 
			 =  <?php echo number_format($total=($honor*$jam),0,",","."); ?> 
			 <b>X</b>&nbsp; 
			  <?php	echo $persen ?>% 
			<br> =  
			  Rp <?php echo $total  =number_format($t=(($total/100)*$persen),0,",","."); ?> </td>
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
			<td   align="left"><b>Total&nbsp;</b>  </td>
			<td ><b> Rp   <?php echo number_format($totalKBMNormal,0,",",".");?></b></td>
			</tr>
<?php }else{?>
<tr><td colspan="10" ><i> - Tidak mengajar</i></td></tr>
<?php } ?>
 </table>
 
 
 
 
 
 <table  border="0"  cellspacing="0" class="table-bordered" width="100%">
   
			<tr>
			<td colspan="10"   > <b class="col-pink">PERHITUNGAN KBM INVALID </b></td>
			</tr>
			<?php
			$totalKBMNon=""; $i=0;
			$dataTK=$this->db->query("SELECT  id_tk FROM  v_jadwal WHERE id_guru='".$id_guru."' AND id_semester='".$this->mdl->sms()."' and id_tahun='".$this->mdl->tahun()."' GROUP BY id_tk order by id_tk")->result();
			foreach($dataTK as $dbtk){		$tk=$dbtk->id_tk;		$i++;		?>
			<tr>			
			<td><b>Kelas  <?php echo $this->m_reff->goField("tr_tingkat","nama","where id='".$tk."' ")?>  </b> 
			 &nbsp; </td>
			<td><?php echo $blok=$this->mdl->jmlJamMengajarBlok($periode,$id_guru,$tk);?> Jam  
			 &nbsp;<b>X</b>&nbsp; 
			  <?php echo number_format($honor,0,",","."); ?>  
				<br>=  
			Rp  <?php echo number_format($total=($blok*$honor),0,",",".");?> </td>
			</tr>
			<?php $totalKBMNon=$total+$totalKBMNon; } ?>
			<?php if($i){?>
			<tr>
			<td  align="left"><b> Total &nbsp; </b></td>
			<td  ><b> ( Rp &nbsp; <?php echo number_format($totalKBMNon,0,",",".");?> )</b></td>
			</tr>
			<?php }  else{ echo "<tr><td><i>- Tidak mengajar - </i> </td></tr>"; $totalKBMNon=0;} ?>		
			
			</table>

 
 
 <?php  
 }?>
 
 <br>
 
 <table       border="0"  cellspacing="0" class="table-bordered" width="100%">
 <tr>
 <td colspan="2" align="left"   ><b> KOPERASI</b> </td>
 
 </tr>
 <?php
 $data=$this->db->query("select kategory,sum(nominal) as nominal from keu_simpanan where id_guru='".$id_guru."' and periode='".$periode."'  group by kategory order by kategory asc ")->result();
 $i="a";$t=0;
 foreach($data as $val)
 {?>
<tr>
<td style='max-width:3px'> &nbsp;<?php echo $i++ ?>. <?php echo $this->m_reff->goField("keu_tr_stssimpanan","nama","where id='".$val->kategory."'");?></td>
<td>:  <?php echo number_format($val->nominal,0,",",".") ?></td>
</tr>	 
 <?php $t=$val->nominal+$t;} ?>
 
 
 
 
 <tr>
 
 <td align="left"  >&nbsp;<?php echo $i ?>. Potongan Pinjaman  </td>
 
 <td align="left" >:   <?php echo number_format($db->cicilan,0,",",".");?> </td>
 </tr>  
 
 <tr>
 
 <td align="left"  >&nbsp; BPJS  </td>
 
 <td align="left" >:   <?php echo number_format($db->bpjs,0,",",".");?> </td>
 </tr> 
 
 <tr>
 
 <td align="left"   align='left'>&nbsp;<b>Total</b> </td>
 
 <td align="left"  ><b>: (   <?php echo number_format($db->cicilan+$db->bpjs+$t,0,",",".");?> ) </b></td>
 </tr>
 </table>
 
 <br>
 <table       border="0"  cellspacing="0" class="table-bordered" width="100%" >
  <tr>
  <td align="left"   align="right">&nbsp; JUMLAH PEMASUKAN  </td>
 
 <td align="right"   align="right">     <?php echo number_format($db->jml_pemasukan,0,",",".");?>  </td>
 </tr><tr >
  <td align="left"   align="right">&nbsp; JUMLAH POTONGAN </td>   
 <td align="right"   align="right">     <?php echo number_format($db->jml_potongan,0,",",".");?>  </td>
 </tr><tr>
  <td align="left"   align="right">&nbsp;<b>TOTAL PEMBAYARAN</b> </td>   
 <td align="right"    align="right"><b> Rp <?php echo number_format(($db->jml_pemasukan-$db->jml_potongan),0,",",".");?></b></td>
 </tr>
 </table>
  
 
  
 </div>  
</page>
 
