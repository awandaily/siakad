<?php 
$jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
$tgl1="01-".$bulan."-".$tahun;
$tgl2=$jml_hari."-".$bulan."-".$tahun;
 
 ?> 


<style>
.tgl_tbl{ width:140px; };
</style>
 <div>
<div class="table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12">
							  <hr>
							  <table class="entry" width="100%">
							  <tr>
							   <th colspan="<?php echo $jml_hari+1;?>"  > <span class="pull-left"> Minggu ke 1</span> <span class="pull-right">   <?php echo $this->tanggal->bulan($bulan);?> - <?php echo $tahun?></span></th>
							  </tr>
							  <tr>
							  <td class="tgl_tbl">Tanggal</td>
									<?php 
									 
									for($i=1;$i<=7;$i++)
									{		$tgl=$tahun."-".$bulan."-0".$i;
										echo "<td>".$this->tanggal->namaHari($tgl)." - ".$i."</td>";
									}
									?>
							  </tr>
							  <tr>
							  <td class="tgl_tbl">Status</td>
									<?php 
									 
									for($i=1;$i<=7;$i++)
									{	     $tgl=$tahun."-".sprintf("%02s", $bulan)."-0".$i;
											 echo $this->mdl->cekKehadiran($noid,$tgl,$i);
										 
									}
									?>
							  </tr>
							  </table>     
 </div>
 						  
       
<div class="table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12">
							  <hr>
							  <table class="entry" width="100%">
							  <tr>
							   <th colspan="<?php echo $jml_hari+1;?>"  > <span class="pull-left"> Minggu ke 2</span> <span class="pull-right">   <?php echo $this->tanggal->bulan($bulan);?> - <?php echo $tahun?></span></th>
							  </tr>
							  <tr>
							  <td class="tgl_tbl">Tanggal</td>
									<?php 
								 
									for($i=8;$i<=14;$i++)
									{
										 $tgl=$tahun."-".sprintf("%02s", $bulan)."-".sprintf("%02s", $i);
											echo "<td>".$this->tanggal->namaHari($tgl)." - ".$i."</td>";
									}
									?>
							  </tr>
							  <tr>
							  <td class="tgl_tbl">Status</td>
									<?php 
									for($i=8;$i<=14;$i++)
									{	  $tgl=$tahun."-".sprintf("%02s", $bulan)."-".sprintf("%02s", $i);
										  echo  $this->mdl->cekKehadiran($noid,$tgl) ;
									}
									?>
							  </tr>
							  </table>     
 </div>
 
 <div class="table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12">
							  <hr>
							  <table class="entry" width="100%">
							  <tr>
							   <th colspan="<?php echo $jml_hari+1;?>" ><span class="pull-left"> Minggu ke 3</span> <span class="pull-right">   <?php echo $this->tanggal->bulan($bulan);?> - <?php echo $tahun?></span></th>
							  </tr>
							  <tr>
							  <td class="tgl_tbl">Tanggal</td>
									<?php 
									 
									for($i=15;$i<=21;$i++)
									{
										 $tgl=$tahun."-".sprintf("%02s", $bulan)."-".sprintf("%02s", $i);
											echo "<td>".$this->tanggal->namaHari($tgl)." - ".$i."</td>";
									}
									?>
							  </tr>
							  <tr>
							  <td class="tgl_tbl">Status</td>
									<?php 
									for($i=15;$i<=21;$i++)
									{
										  $tgl=$tahun."-".sprintf("%02s", $bulan)."-".sprintf("%02s", $i);
										  echo  $this->mdl->cekKehadiran($noid,$tgl) ;
									}
									?>
							  </tr>
							  </table>     
 </div>
 		
		<div class="table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12">
							  <hr>
							  <table class="entry" width="100%">
							  <tr>
							   <th colspan="<?php echo $jml_hari+1;?>" > <span class="pull-left"> Minggu ke 4</span> <span class="pull-right">   <?php echo $this->tanggal->bulan($bulan);?> - <?php echo $tahun?></span></th>
							  </tr>
							  <tr>
							  <td class="tgl_tbl">Tanggal</td>
									<?php 
									 
									for($i=22;$i<=$jml_hari;$i++)
									{
										 $tgl=$tahun."-".sprintf("%02s", $bulan)."-".sprintf("%02s", $i);
											echo "<td>".$this->tanggal->namaHari($tgl)." - ".$i."</td>";
									}
									?>
							  </tr>
							  <tr>
							  <td class="tgl_tbl">Status</td>
									<?php 
									for($i=22;$i<=$jml_hari;$i++)
									{
										 $tgl=$tahun."-".sprintf("%02s", $bulan)."-".sprintf("%02s", $i);
										  echo  $this->mdl->cekKehadiran($noid,$tgl) ;
									}
									?>
							  </tr>
							  </table>     
 </div>
 </div>
 						  
       
	
 		
		<div class="  col-lg-12 col-md-12 col-sm-12 col-xs-12">
<hr>
<b>KETERANGAN SIMBOL : </b>
<p> 
  
 <span class="badge bg-white col-green"><i class="material-icons" style="font-size:15px">brightness_1</i></span> Masuk 
 <span class="badge bg-white col-orange"><i class="material-icons" style="font-size:15px">brightness_1</i></span> Izin 
 <span class="badge bg-white col-red"><i class="material-icons" style="font-size:15px">clear</i></span> Alfa &nbsp;&nbsp;&nbsp;
 <span class="badge bg-red" style="opacity:0.6">&nbsp;&nbsp;&nbsp;</span> Libur 
								
 </p>
</div>					
						
		 
      
<script>
 
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

  function getMapel(noid,tgl,kohar)
  {
	$("#modalMapel").modal("show");  
	$("#isiMapel").html("<img src='<?php echo base_url()?>plug/img/load.gif'/> Mohon Tunggu...");	
    $.ajax({
	 url:link+"absensi/getDataMapel",
     data:"noid="+noid+"&tgl="+tgl+"&kohar="+kohar,
	 method:"POST",
     success: function(data)
            {
				 $("#isiMapel").html(data);		
				 
            }
    });   
  }
 
</script>			



 

<!-- Modal -->
<div class="modal fade" id="modalMapel" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  Kegiatan Belajar Mengajar
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body" id="isiMapel">
                 
            </div>
            
            <!-- Modal Footer -->
            
        </div>
    </div>
</div>					