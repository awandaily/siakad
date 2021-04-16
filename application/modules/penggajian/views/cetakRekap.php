<style type="text/css">
.table{
margin-top:10px;
width:470px;
line-height:1px;

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
 
                .tborder{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width: 330mm;font-size:11px;}
               .tborder td,.tborder  th{word-wrap:break-word;word-break: break-all;border: 1px solid #000;padding:2px;font-size:9px;text-align:center}
			   
			   
                .thadir{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width: 100mm;font-size:11px;}
               .thadir td,.thadir  th{word-wrap:break-word;word-break: break-all; padding:2px;font-size:10px;text-align:center}
			   
			   
	.kop{
width:100%;
padding-bottom:10px;
	}	
	
#table{
width:100%;
font-size:11px;
 
}	
#table tr td{
border-bottom:black solid  0.2px ;
}
.bendahara{
 
font-size:10;
}
.garis{
	padding-bottom:10px;
border :black silid 0.5px;
}.header{
background-color:#fbdf93;
font-weight:bold;
padding:5px;
 border-bottom :black silid 0.5px;
 width:390px;
}.header2{
font-size:10px;
font-weight:bold;
}table tr td{ font-size:8px;}
</style>
<page style='font-size:8px'>
<?php
$id_guru=$this->input->get("id");
   $nama_periode=$this->input->get("periode");
   ?>
 <p align="center"><b>PERIODE BULAN <?php echo strtoupper($nama_periode)?> </b></p>
  
<table  class="tborder">
<tr style="background-color:yellow">
<th align="center" rowspan="2">NO</th>
<th align="center" rowspan="2">NAMA GURU</th>
<th align="center" rowspan="2">TOTAL JAM</th>
<th align="center" rowspan="2">HONOR KBM</th>
<th align="center" rowspan="2">KBM INVAL</th>
<th align="center" rowspan="2">GAJI POKOK</th>
<th align="center" rowspan="2">PENAMBAHAN<br>FUNGSIONAL</th>
<th align="center" rowspan="2">TUNJANGAN<br>JABATAN  </th>
<th align="center" rowspan="2">TUNJANGAN<br>WALI KELAS  </th>
<th align="center" rowspan="2">SUPERVISI<br>AKADEMIK </th>
<th align="center" rowspan="2">EKTRAKURIKULER </th>
<th align="center" rowspan="2">HONOR NON-KBM </th>
<th align="center" rowspan="2">PIKET</th>
<th align="center" colspan="4">POTONGAN</th>
<th align="center" rowspan="2">TOTAL JUMLAH</th>
</tr>
<tr style="background-color:yellow">
<th align="center">KBM INVALID</th>
<th align="center">BPJS</th>
<th align="center">  SIMPANAN </th>
<th align="center">  PINJAMAN </th>
</tr>


<?php 
   
	 $no=1;
	 $this->db->where("nama_periode",$nama_periode);
	 $this->db->where("id_guru IN (".$id_guru.") ");
$data=$this->db->get("keu_data_gaji")->result();	
$honor_kbm_normal=$jml_jam_total="";
$gaji_pokok="";
$p_fungsional="";
$tunjangan_jabatan="";
$wali_kelas="";
$supervisi_akademik="";
$pembina_eskul="";
$honor="";
$inval="";
$piket="";
$bpjs="";
$cicilan="";
$getTotalSimpanan="";
$gaji="";
$kbm_invalid="";
	foreach($data as $val){
	?>
<tr>
<td align="center"><?php echo $no++;?></td>
<td align="left"><?php echo $val->nama_penerima;?></td>
<td align="center"><?php echo $val->jml_jam_total;				$jml_jam_total+=$val->jml_jam_total;	?></td>
<td align="center"><?php echo number_format($val->honor_kbm_normal,0,",",".");		$honor_kbm_normal+=$val->honor_kbm_normal;		?></td>
<td align="center"><?php echo number_format($val->inval,0,",",".");		$inval+=$val->inval;		?></td>
<td align="center"><?php echo number_format($val->gaji_pokok,0,",",".");			$gaji_pokok+=$val->gaji_pokok;?></td>
<td align="center"><?php echo number_format($val->p_fungsional,0,",",".");			$p_fungsional+=$val->p_fungsional;?></td>
<td align="center"><?php echo number_format($val->tunjangan_jabatan,0,",",".");		$tunjangan_jabatan+=$val->tunjangan_jabatan;		?></td>
<td align="center"><?php echo number_format($val->wali_kelas,0,",",".");			$wali_kelas+=$val->wali_kelas;			?></td>
<td align="center"><?php echo number_format($val->supervisi_akademik,0,",",".");	$supervisi_akademik+=$val->supervisi_akademik;			?></td>
<td align="center"><?php echo number_format($val->pembina_eskul,0,",",".");			$pembina_eskul+=$val->pembina_eskul;		?></td>
<td align="center"><?php echo number_format($val->honor,0,",",".");					$honor+=$val->honor;		?></td>
<td align="center"><?php echo number_format($val->piket,0,",",".");					$piket+=$val->piket;		?></td>

<td align="center"><?php echo number_format($val->kbm_invalid,0,",",".");			$kbm_invalid+=$val->kbm_invalid;	?></td>
<td align="center"><?php echo number_format($val->bpjs,0,",",".");					$bpjs+=$val->bpjs;		?></td> 
<td align="center"><?php echo number_format($o=$this->mdl->getTotalSimpanan($val->id_guru,$val->periode),0,",",".");			$getTotalSimpanan+=$o;?></td> 
<td align="center"><?php echo number_format($val->cicilan,0,",",".");				$cicilan+=$val->cicilan;?></td> 
<td align="right">Rp <?php echo number_format($val->gaji_asli,0,",",".");				$gaji+=$val->gaji_asli;?></td>
</tr>		
		
		
		
		
<?php	}  ?>

<tr>
<th align="center" colspan="2"><b>TOTAL JUMLAH</b></th>
<th align="center"><?php echo $jml_jam_total;?></th>
<th align="center"><?php echo number_format($honor_kbm_normal,0,",",".");?></th>
<th align="center"><?php echo number_format($inval,0,",",".");?></th>
<th align="center"><?php echo number_format($gaji_pokok,0,",",".");?></th>
<th align="center"><?php echo number_format($p_fungsional,0,",",".");?></th>
<th align="center"><?php echo number_format($tunjangan_jabatan,0,",",".");?></th>
<th align="center"><?php echo number_format($wali_kelas,0,",",".");?></th>
<th align="center"><?php echo number_format($supervisi_akademik,0,",",".");?></th>
<th align="center"><?php echo number_format($pembina_eskul,0,",",".");?></th>
<th align="center"><?php echo number_format($honor,0,",",".");?></th>
<th align="center"><?php echo number_format($piket,0,",",".");?></th>

<th align="center"><?php echo number_format($kbm_invalid,0,",",".");?></th>
<th align="center"><?php echo number_format($bpjs,0,",",".");?></th> 
<th align="center"><?php echo number_format($getTotalSimpanan,0,",",".");?></th> 
<th align="center"><?php echo number_format($cicilan,0,",",".");?></th> 

 
<th align="right">Rp <?php echo number_format($gaji,0,",",".");?></th>
</tr>		
</table>
</page>