  <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">SISWA KELAS X</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $x=$this->mdl->jmlSiswa(1); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">SISWA KELAS XI</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $xi=$this->mdl->jmlSiswa(2); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">SISWA KELAS XII</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php echo $xii=$this->mdl->jmlSiswa(3); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?php echo $this->mdl->jmlSiswaTotal(); ?></div>
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			
			
			
			
			
	<div class="col-md-6">		
			<div id="container" style="margin: 0 auto"></div>
	</div>	
	<div class="col-md-6">		
			<div id="jurusan" style="margin: 0 auto"></div>
	</div>	


		<script type="text/javascript">

 

    // Build the chart
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'PRESENTASI SISWA BERDASARKAN TINGKATAN'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [ {
                name: 'X ',
                y: <?php echo $x;?>,
                
            }, {
                name: 'XI',
                y: <?php echo $xi;?>
            }, {
                name: 'XII',
                y: <?php echo $xii;?>
            } ]
        }]
    });
 
		</script>
		
		
		
		
		<?php
		$jurusan1=$this->mdl->jmlJurusan(1);
		$jurusan2=$this->mdl->jmlJurusan(2);
		$jurusan3=$this->mdl->jmlJurusan(3);
		?>
		
		<script type="text/javascript">

 

    // Build the chart
    Highcharts.chart('jurusan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'PRESENTASI SISWA BERDASARKAN JURUSAN'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $data=$this->db->get("tr_jurusan")->result();
            foreach($data as $val){?>
                
                {
                name: '<?php echo $val->nama;?>',
                y: <?php echo $this->mdl->jmlJurusan($val->id);?>,
                },
           
            <?php } ?>,
             ]
        }]
    });
 
		</script>
	
	
	
	
	
	
	
	
	
	
	<?php
$db=$this->db->query("SELECT max(nama_kelas) as maxi from v_kelas")->row();
$max=isset($db->maxi)?($db->maxi):"";

$datajurusan=$this->db->get("tr_jurusan")->result();

 

?>
<div class="row clearfix col-md-12">&nbsp;</div>
 <div class="row clearfix hide">
                <!-- Task Info -->
				  <div class="col-xs-12 col-md-12 col-md-12 col-lg-12">
                    <div class="card" >
					  <div class="body">
					  <div  class="entry2 ">
					  <center  style="border-bottom:black solid 2px; "><b>
					  ANALISIS JUMLAH SISWA<br>
					  <?php echo $this->m_reff->goField("tm_pengaturan","val","where id='7'");?><br>
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
					for($x=1;$x<=$max;$x++){
						$jk="l";
						$id_jurusan=$val->id;
						$rombel=$x;
						$idkelas=$this->mdl_analisis->getIdkelas($tk,$id_jurusan,$rombel);
						$jmlLaki=$this->mdl_analisis->jmlSiswa($jk,$idkelas);
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
						$idkelas=$this->mdl_analisis->getIdkelas($tk,$id_jurusan,$rombel);
						$jmlPe=$this->mdl_analisis->jmlSiswa($jk,$idkelas);
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
							$idkelas=$this->mdl_analisis->getIdkelas($tk,$id_jurusan,$rombel);
							$jmlTotal=$this->mdl_analisis->jmlSiswa($jk,$idkelas);
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
					<td><b>TOTAL SISWA SELURUHNYA</b></td><td><b><?php echo $this->mdl_analisis->jmlSiswa("","");?></b></td>
					</tr>
					</table>
					
	 </div>
					  </div>
					  
					  </div>
                    </div >
               </div >
 </div >