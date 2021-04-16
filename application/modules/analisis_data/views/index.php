<?php
//$db=$this->db->query("SELECT max(nama_kelas) as maxi from v_kelas")->row();
$max=4;//isset($db->maxi)?($db->maxi):"";

$datajurusan=$this->db->get("tr_jurusan")->result();

 

?>

 <div class="row clearfix">
                <!-- Task Info -->
			 <a href="<?php echo base_url()?>analisis_data/pdf_perjurusan" target="_blank" class="pull-right btn bg-teal waves-effect" style="padding-bottom:10px;margin-right:20px;margin-top:-10px"><i class="material-icons">picture_as_pdf</i> CETAK PDF</a>
                <div class="col-xs-12 col-md-12 col-md-12 col-lg-12">
                    <div class="card" >
					  <div class="body">
					  <div  class="entry2 ">
					  <center  style="border-bottom:black solid 2px; "><b>
					  ANALISIS JUMLAH SISWA<br>
					  <?php echo $this->m_reff->tm_pengaturan(7);?><br>
					 TAHUN PELAJARAN <?php echo $this->m_reff->nama_tahun();?>
					 </b>
					</center><br>
<?php

for($tk=1;$tk<=3;$tk++)
{
	$dbjur=$this->db->query("select * from tr_tingkat where id='".$tk."'")->row();
$kelas_romawi=strtoupper($dbjur->nama);
$kelas_alias=strtoupper($dbjur->alias);
?>
<div class="table-responsive">
					<table >
					<tr class="bg-teal sadow font-bold" >
					<td rowspan="2"><b>NO</b></td><td rowspan="2"><b>KOMPETENSI</b></td><td rowspan="2"><b>JENIS KELAMIN</b></td><td colspan="<?php echo $max;?>" align="center">
					<b>KELAS SEPULUH</b></td><td rowspan="2"><b>JUMLAH TOTAL</b></td>
					</tr>
					<tr  class="bg-teal sadow">
					<?php
					for($i=1;$i<=$max;$i++){ 
					echo "<td><b>".$i."</b></td>";
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
					$max=$this->db->query("SELECT distinct(nama_kelas) as maxi from v_kelas where id_tk='1'")->result();
					foreach($max as $max){
					    $x=$max->maxi;
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
					$max=$this->db->query("SELECT distinct(nama_kelas) as maxi from v_kelas where id_tk='1'")->result();
					foreach($max as $max){
					    $x=$max->maxi;
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
						$jmlT="0";$jmlTotal=0;
						$max=$this->db->query("SELECT distinct(nama_kelas) as maxi from v_kelas where id_tk='1'")->result();
					foreach($max as $max){
					    $x=$max->maxi;
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
					</div>
					 
<?php } ?>			
<div class="table-responsive">		
					<table>
					<tr class="bg-pink">
					<td><b>TOTAL SISWA SELURUHNYA</b></td><td><b><?php echo $this->mdl->jmlSiswa("","");?></b></td>
					</tr>
					</table>
					
	 </div>
					  </div>
					  
					  </div>
                    </div >
               </div >
 </div >