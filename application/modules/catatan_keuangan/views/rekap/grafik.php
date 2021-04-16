<?php
	$tgl=$tanggal;
	$awal=$this->tanggal->rangeindo($tgl,0);
	$akhir=$this->tanggal->rangeindo($tgl,1);
	
	$db=$this->rekap->dataPemasukan($tgl,$grafik,$tipe);
	$tgldb="";$list="";$desc="";$gal="";
	foreach($db as $datax)
	{
	////
	if($grafik=="gdetail"){
	$gal=$this->tanggal->ind(substr($datax->tgl,0,10),"/"); $desc="Data Detail";}
	
	if($grafik=="gh"){
	$gal=$this->tanggal->ind(substr($datax->tgl,0,10),"/"); $desc="Grafik Perhari";}
	
	if($grafik=="gm"){
	$gal=$datax->tgl; $desc="Grafik Perminggu";}
	
	if($grafik=="gb"){
	$_tgl_=explode("-",$datax->tgl);  $gal=$this->konversi->bulan($_tgl_[0])."-".$_tgl_[1]; $desc="Grafik Perbulan";}
	
	if($grafik=="gt"){
	$gal=$datax->tgl;  $desc="Grafik Pertahun"; }
	//////
	
	$tgldb.="'".$gal."',";
	$list.=$datax->nominal.",";
	}
	
	
?>

<!DOCTYPE HTML>
<html>

	<body>


<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



		<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'area',
        spacingBottom: 30
    },
    title: {
        text: 'Total Rp <?php echo $this->rekap->totalPemasukanPeriode($awal,$akhir); ?>'
    },
    subtitle: {
        text: ' Tanggal: <?php echo $tgl;?>',
        floating: true,
        align: 'right',
        verticalAlign: 'bottom',
        y: 15
    },
    
    xAxis: {
        categories: [<?php echo $tgldb; ?>]
    },
    yAxis: {
        title: {
              text: ''
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.x + ': ' + this.y;
        }
    },
   	
    credits: {
        enabled: true
    },
    series: [ {
        name: "<?php echo $desc; ?>",
        data: [<?php echo  $list; ?>]
    }]
});
		</script>
	</body>
</html>
