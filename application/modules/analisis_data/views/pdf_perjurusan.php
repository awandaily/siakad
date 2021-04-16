
<style type="text/css">
table tr td
{
    padding: 30;
    font-size: 12pt;
    background: #FFFFFF;
	font-family:arial;
  
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
.col-pink{
color:red;
}
.bg-teal{
background-color:green;
color:white;
}
 
                .tborder{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed; font-size:11px;}
               .tborder td,.tborder  th{word-wrap:break-word;word-break: break-all;border: 0.5px solid #000;padding:6px;font-size:10px;text-align:center}
			   
			   
                .thadir{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width: 100mm;font-size:11px;}
               .thadir td,.thadir  th{word-wrap:break-word;word-break: break-all; padding:2px;font-size:10px;text-align:center}
           </style>
<page style='font-size:11px'>
  <?php
$db=$this->db->query("SELECT max(nama_kelas) as maxi from v_kelas")->row();
$max=isset($db->maxi)?($db->maxi):"";

$datajurusan=$this->db->get("tr_jurusan")->result();

 

?>

 
<?php
 
$max=3;
?>
   <div  style="border-bottom:black solid 2px;" align="center">
   <h4><b>
					  ANALISIS JUMLAH SISWA<br>
					  <?php echo $this->m_reff->tm_pengaturan(7);?><br>
					 TAHUN PELAJARAN <?php echo $this->m_reff->nama_tahun();?>
					 </b></h4>
					</div><br>
					
					
					
					
<?php
for($tk=1;$tk<=3;$tk++)
{
	$dbjur=$this->db->query("select * from tr_tingkat where id='".$tk."'")->row();
$kelas_romawi=strtoupper($dbjur->nama);
$kelas_alias=strtoupper($dbjur->alias);
?>
 
						<table class="tborder" width="100%" align="center">
					<tr class="bg-teal sadow font-bold" >
					<td rowspan="2" class="bg-teal"><b>NO</b></td><td rowspan="2" class="bg-teal"><b>KOMPETENSI</b></td>
					<td rowspan="2" class="bg-teal"><b>JENIS KELAMIN</b></td><td colspan="<?php echo $max;?>" align="center" class="bg-teal">
					<b>KELAS SEPULUH</b></td><td rowspan="2" class="bg-teal"><b>JUMLAH TOTAL</b></td>
					</tr>
					<tr  class="bg-teal sadow">
					<?php
					for($i=1;$i<=$max;$i++){ 
					echo "<td class='bg-teal'><b>".$i."</b></td>";
					 } ?>
					</tr>
					<!-------------->
					<?php
					$no=1;
					$jumlahCowok=0;
					$jumlahCewek=0;
					foreach($datajurusan as $val)
					{
					?>
					<tr>
					<td rowspan="3"><?php echo $no++;?></td>
					<td rowspan="3"><?php echo $val->nama;?></td>
					<td>LAKI-LAKI</td>
					<?php 
					$jmlL="0";
					for($x=1;$x<=$max;$x++){
						$jk="l";
						$id_jurusan=$val->id;
						$rombel=$x;
						$idkelas=$this->mdl->getIdkelas($tk,$id_jurusan,$rombel);
						$jmlLaki=$this->mdl->jmlSiswa($jk,$idkelas);
						if($jmlLaki)
						{
							$isi=$jmlLaki;
						}else{
							$isi="";
						}
						echo "<td>".$isi."</td>"; //jml siswa laki-laki
						$jmlL=$jmlLaki+$jmlL;
						
					}?>
					 <td> <?php echo $jmlL;  $jumlahCowok=$jmlL+$jumlahCowok;?></td> </tr>
					 
					 
					 
					 <tr>
					 <td>PEREMPUAN</td>
					<?php 
					$jmlP="0";
					for($x=1;$x<=$max;$x++){
						$jk="p";
						$id_jurusan=$val->id;
						$rombel=$x;
						$idkelas=$this->mdl->getIdkelas($tk,$id_jurusan,$rombel);
						$jmlPe=$this->mdl->jmlSiswa($jk,$idkelas);
						if($jmlPe)
						{
							$isi=$jmlPe;
						}else{
							$isi="";
						}
						
						
						echo "<td>".$isi."</td>"; //jml siswa perempuan
						$jmlP=$jmlPe+$jmlP;
						
					}?>
					 <td> <?php echo $jmlP; $jumlahCewek=$jmlP+$jumlahCewek;?></td> </tr>
					 
					 
					 <tr> <!--============total---------------->
					  <td class="bg-lime"><font color='black'>JUMLAH</font></td>
						  <?php 
						$jmlT="0";
						for($x=1;$x<=$max;$x++){
							$jk="";
							$id_jurusan=$val->id;
							$rombel=$x;
							$idkelas=$this->mdl->getIdkelas($tk,$id_jurusan,$rombel);
							$jmlTotal=$this->mdl->jmlSiswa($jk,$idkelas);
							if($jmlTotal)
							{
								$isi=$jmlTotal;
							}else{
								$isi="";
							}
							echo "<td  class='bg-lime'><font color='black'>".$isi."</font></td>"; //jml siswa perempuan
							
						}?>
						 <td class='bg-lime'> <font color='black'><?php echo $jmlP+$jmlL; $jmlT=$jmlTotal+$jmlT;?></font></td> 
						 </tr>
					 
					<?php } ?>
					<!-------------->
					<tr>
					<td colspan="<?php echo ($max+3)?>">  JUMLAH LAKI-LAKI </td><td><?php echo $jumlahCowok;?></td>
					</tr>
					<tr>
					<td colspan="<?php echo ($max+3)?>">  JUMLAH PEREMPUAN </td><td><?php echo $jumlahCewek;?></td>
					</tr>
					<tr class="bg-lime">
					<td colspan="<?php echo ($max+3)?>"> <b><font color="black">JUMLAH TOTAL SISWA KELAS <?php echo $kelas_romawi; ?> (<?php echo $kelas_alias;?>)</font> </b></td>
					<td><font color="black"><b><?php echo $jumlahCowok+$jumlahCewek;?></b></font></td>
					</tr>
					 
					</table> 
					<br>
					 
<?php } ?>			
 
						<table class="tborder" width="100%" align="center">
					<tr  >
					<td ><b>TOTAL SISWA SELURUHNYA</b></td><td ><b><?php echo $this->mdl->jmlSiswa("","");?></b></td>
					</tr>
					</table>
					
					
					
 
					 
			 
</page>
 
