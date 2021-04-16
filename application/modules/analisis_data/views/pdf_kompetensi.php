

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

               .tborder td,.tborder  th{word-wrap:break-word;word-break: break-all;border: 0.5px solid #000;padding:10px;font-size:10px;text-align:center}

			   

			   

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

					  ANALISIS JUMLAH SISWA <?php echo $this->m_reff->tm_pengaturan(7);?><br>

					  BERDASARKAN KOMPETENSI, JENIS KELAMIN DAN KELAS<br>

					 TAHUN PELAJARAN <?php echo $this->m_reff->nama_tahun();?>

					 </b></h4>

					</div><br>

					

					<table class="tborder" width="100%" align="center">

					<tr class="bg-teal sadow font-bold" >

					<td rowspan="2" class='bg-teal sadow'><b>NO</b></td><td rowspan="2" class='bg-teal sadow'><b>KOMPETENSI</b></td><td rowspan="2" class='bg-teal sadow'><b>JENIS KELAMIN</b></td>

					<td colspan="<?php echo $max;?>" align="center" class='bg-teal sadow'>

					<b>KELAS</b></td><td rowspan="2" class='bg-teal sadow'><b>JUMLAH TOTAL</b></td>

					</tr>

					<tr  class="bg-teal sadow">

					<?php

					for($i=1;$i<=$max;$i++){ 

						$dbjur=$this->db->query("select * from tr_tingkat where id='".$i."'")->row();

						$kelas_romawi=strtoupper($dbjur->nama);

						echo "<td class='bg-teal sadow'><b>".$kelas_romawi."</b></td>";

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

						$tingkat=$x;

						$jmlLaki=$this->mdl->jmlSiswaGroup($jk,$tingkat,$id_jurusan);

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

						$tingkat=$x;

						$jmlPe=$this->mdl->jmlSiswaGroup($jk,$tingkat,$id_jurusan);

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

							$tingkat=$x;

							$jmlTotal=$this->mdl->jmlSiswaGroup($jk,$tingkat,$id_jurusan);

							if($jmlTotal)

							{

								$isi=$jmlTotal;

							}else{

								$isi="";

							}

							echo "<td  class='bg-lime'><font color='black'>".$isi."</font></td>"; //jml siswa perempuan

							

						}?>

						 <td class='bg-lime'> <font color='black'><?php echo $jmlP; $jmlT=$jmlTotal+$jmlT;?></font></td> 

						 </tr>

					 

					<?php } ?>

					<!-------------->

					<?php

					for($x=1;$x<=$max;$x++){

					$dbjur=$this->db->query("select * from tr_tingkat where id='".$x."'")->row();

						$kelas_romawi=strtoupper($dbjur->nama);	

						?>

					<tr>

					<td colspan="<?php echo ($max+3)?>"> KELAS  <?php echo $kelas_romawi;?></td><td><?php echo $this->mdl->jmlSiswaGroup("",$x,"");?></td>

					</tr>

					<?php } ?> 

					<tr class="bg-lime">

					 <td colspan="6"><b> JUMLAH TOTAL SISWA </b> </td><td><b><font color='black'><?php echo $this->mdl->jmlSiswaGroup("","","");?></font></b></td>

					 </tr>

					</table> 

					 

					 

 			<br/>

 			<br/>

 	

					<table  class="tborder" align="center">

					<tr class="bg-teal">

					<td rowspan="2" class='bg-teal sadow'><b>NO</b></td><td rowspan="2" class='bg-teal sadow'><b>KELAS</b></td><td colspan="2" class='bg-teal sadow'><b>JENIS KELAMIN</b></td><td rowspan="2" class='bg-teal sadow'><b>PINDAH/MUTASI</b></td>

					<td rowspan="2" class='bg-teal sadow'><b>JML</b></td><td rowspan="2" class='bg-teal sadow'><b>KET</b></td></tr>

					 

					<tr  class="bg-teal">

					<td class='bg-teal sadow'><b>L</b></td>

					<td class='bg-teal sadow'><b>P</b></td>

					</tr>

					<?php

					$no=1;

					for($x=1;$x<=$max;$x++){

					$dbjur=$this->db->query("select * from tr_tingkat where id='".$x."'")->row();

						$kelas_romawi=strtoupper($dbjur->nama);	

						$kelas_alias=strtoupper($dbjur->alias);	

						?>

					<tr>

					<td><?php echo $no++?></td>

					<td><?php echo $kelas_romawi?> (<?php echo $kelas_alias;?>)</td>

					<td><?php echo $this->mdl->jmlSiswaGroup("l",$x,"");?></td>

					<td><?php echo $this->mdl->jmlSiswaGroup("p",$x,"");?></td>

					<td><?php echo $this->mdl->jmlSiswaGroup("",$x,"","3,5");?></td>

				 

					<td><?php echo $this->mdl->jmlSiswaGroup("",$x,"");?></td>

					<td>  - </td>

					</tr>

					<?php } ?> 

					<tr>

					<td colspan="2" align="center"><b>TOTAL</b></td>

					<td><b><?php echo $this->mdl->jmlSiswaGroup("l","","");?></b></td>

					<td><b><?php echo $this->mdl->jmlSiswaGroup("p","","");?></b></td>

					<td><b><?php echo $this->mdl->jmlSiswaGroup("","","","3,5");?></b></td>

					 

					<td><b><?php echo $this->mdl->jmlSiswaGroup("","","");?></b></td>

					<td> - </td>

					</tr>

					</table>

					

 

					 

			 

</page>

 

