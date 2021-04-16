<?php

$db=$this->db->query("SELECT max(nama_kelas) as maxi from v_kelas")->row();

$max=isset($db->maxi)?($db->maxi):"";



$datajurusan=$this->db->get("tr_jurusan")->result();



 



?>



 <div class="row clearfix">

                <!-- Task Info -->

				<a href="#" class="pull-right btn bg-teal waves-effect" style="padding-bottom:10px;margin-right:20px;margin-top:-10px" data-toggle="modal" data-target="#md-mutasi">
					<i class="material-icons">file_download</i> DOWNLOAD MUTASI SISWA
				</a>

				<a href="<?php echo base_url()?>analisis_data/pdf_kompetensi" target="_blank" class="pull-right btn bg-teal waves-effect" style="padding-bottom:10px;margin-right:20px;margin-top:-10px"><i class="material-icons">picture_as_pdf</i> CETAK PDF</a>

                <div class="col-xs-12 col-md-12 col-md-12 col-lg-12">

                    <div class="card" >

					  <div class="body">

					  <div  class="entry2 ">

					  <center  style="border-bottom:black solid 2px; "><b>

					  ANALISIS JUMLAH SISWA <?php echo $this->m_reff->tm_pengaturan(7);?><br>

					  BERDASARKAN KOMPETENSI, JENIS KELAMIN DAN KELAS<br>

					 TAHUN PELAJARAN <?php echo $this->m_reff->nama_tahun();?>

					 </b>

					</center><br>

<?php

 

$max=3;

?>

<div class="table-responsive">

					<table >

					<tr class="bg-teal sadow font-bold" >

					<td rowspan="2"><b>NO</b></td><td rowspan="2"><b>KOMPETENSI</b></td><td rowspan="2"><b>JENIS KELAMIN</b></td>

					<td colspan="<?php echo $max;?>" align="center">

					<b>KELAS</b></td><td rowspan="2"><b>JUMLAH TOTAL</b></td>

					</tr>

					<tr  class="bg-teal sadow">

					<?php

					for($i=1;$i<=$max;$i++){ 

						$dbjur=$this->db->query("select * from tr_tingkat where id='".$i."'")->row();

						$kelas_romawi=strtoupper($dbjur->nama);

						echo "<td><b>".$kelas_romawi."</b></td>";

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

						 <td class='bg-lime'> <font color='black'><?php echo $jmlP+$jmlL; $jmlT=$jmlTotal+$jmlT;?></font></td> 

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

					 <td colspan="6"><b><font color='black'>JUMLAH TOTAL SISWA </font></b></font></td><td><b><font color='black'><?php echo $this->mdl->jmlSiswaGroup("","","");?></font></b></td>

					 </tr>

					</table> 

					</div>

					 

 			

<div class="table-responsive">		

					<table>

					<tr class="bg-teal">

					<td rowspan="2"><b>NO</b></td><td rowspan="2"><b>KELAS</b></td><td colspan="2"><b>JENIS KELAMIN</b></td><td rowspan="2"><b>PINDAH/MUTASI</b></td>

					<td rowspan="2"><b>JML</b></td><td rowspan="2"><b>KET</b></td></tr>

					</tr>

					<tr  class="bg-teal">

					<td><b>L</b></td>

					<td><b>P</b></td>

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

					<td> <?php echo $this->mdl->jmlSiswaGroup("",$x,"","5,3");?>  </td>

					<td><?php echo $this->mdl->jmlSiswaGroup("",$x,"");?></td>

					<td>- </td>

					</tr>

					<?php } ?> 

					<tr>

					<td colspan="2" align="center">TOTAL</td>

					<td><?php echo $this->mdl->jmlSiswaGroup("l","","");?></td>

					<td><?php echo $this->mdl->jmlSiswaGroup("p","","");?></td>

					<td> <?php echo $this->mdl->jmlSiswaGroup("","","","5,3");?>  </td>

					<td><?php echo $this->mdl->jmlSiswaGroup("","","");?></td>

					<td> - </td>

					</tr>

					</table>

					

	 </div>

					  </div>

					  

					  </div>

                    </div >

               </div >

 </div >
<div id="md-mutasi" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Download Mutasi Siswa</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-4">
        		<div class="form-group">
        			<label >Pilih Bulan *</label>
        			<select class="form-control data-thick" id="src_bulan">
        				<?php
        					
        					$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
							$jlh_bln=count($bulan);
							for($c=1; $c<$jlh_bln; $c+=1){
							    echo"<option value='".sprintf("%02d", $c)."'> ".$bulan[$c]." </option>";
							}

        					//base_url() analisis_data/download_mutasi_siswa
        				?>
        			</select>
        		</div>

        	</div>
        	<div class="col-md-4">
        		<div class="form-group">
        			<label >Input Tahun *</label>
        			<input type="text" class="form-control" id="src_tahun">
        		</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-teal waves-effect btn-block" onclick="download_mutasi()"><i class="material-icons" >get_app</i>DOWNLOAD</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	function download_mutasi(){
		var bln = $("#src_bulan").val();
		var thn = $("#src_tahun").val();

		if (bln !=="" && thn !=="") {
			window.open("<?php echo base_url() ?>analisis_data/download_mutasi_siswa?bln="+bln+"&thn="+thn);
		}
		else{
			notif("LENGKAPI SEMUA FORM !");
		}
	}
</script>
