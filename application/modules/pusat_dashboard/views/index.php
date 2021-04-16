 <div class="row clearfix">
 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-pink">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL PENDAFTAR</div>
                            <div class="number"><?php echo $this->mdl->t_peserta();?> </div>
							 
                        </div>
						
                    </div>
					 
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-blue">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">KEPALA MADRASAH</div>
                            <div class="number"><?php  echo $this->mdl->t_peserta(1);?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-light-blue">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">GURU</div>
                            <div class="number"><?php  echo $this->mdl->t_peserta(2);?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-cyan">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">PEMBINA ASRAMA</div>
                            <div class="number"><?php  echo $this->mdl->t_peserta(3);?></div>
                        </div>
                    </div>
                </div>
 </div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <div id="datamad" height="100px"></div>      
      </div>
	 <div class="col-md-12">&nbsp;</div>
	  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     
                             <div id="datajk"></div>
                        
      </div> 
   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     
                             <div id="posisi_peminatan"  ></div>
                        
    </div>

 
 
 			


<?php
 
 $data=$this->db->get("tr_jk")->result();
 $datajk="";
 foreach($data as $data)
 {
	 $datajk.="{ name: '".$data->nama."', y: ".$this->mdl->t_peserta("","",$data->id)." },";
 }
 
 ?>
 
 
<?php
 
 $data=$this->db->get("tr_kategory")->result();
 $dataposisi="";
 foreach($data as $data)
 {
	 $dataposisi.="{ name: '".$data->nama."', y: ".$this->mdl->t_peserta($data->id)." },";
 }
 
 ?>
 
 <?php
 
 $this->db->where("level",15);
  $this->db->where("tampil",1);
 $data=$this->db->get("admin")->result();
 $datamad="";
 foreach($data as $data)
 {
	 $datamad.="{ name: '".$data->owner."', y: ".$this->mdl->t_peserta(null,$data->id_admin)." },";
 }
 
 ?>

<script>
// Make monochrome colors
var pieColors = (function () {
    var colors = [],
        base = Highcharts.getOptions().colors[0],
        i;

    for (i = 0; i < 10; i += 1) {
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
    }
    return colors;
}());

// Build the chart
Highcharts.chart('posisi_peminatan', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text:"  POSISI PEMINATAN",
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b><br>{point.percentage} %',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            }
        }
    },
    series: [{
        name: 'Persentase',
        data: [
		<?php echo $dataposisi; ?>
                       
        ]
    }]
});
</script>













<script>
Highcharts.chart('datamad', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'KLASIFIKASI MADRASAH'
    },
    
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Pendaftar'
        },
      
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: '<b>total:{point.y}</b>'
    },
    series: [{
        name: 'Population',
        data: [
            <?php echo $datamad;?>
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
</script>


 
<script>
// Make monochrome colors
var pieColors = (function () {
    var colors = [],
        base = Highcharts.getOptions().colors[0],
        i;

    for (i = 0; i < 10; i += 1) {
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
    }
    return colors;
}());





// Build the chart
Highcharts.chart('datajk', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text:"  BERDASARKAN GENDER",
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b><br>{point.percentage} %',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            }
        }
    },
    series: [{
        name: 'Persentase',
        data: [
		<?php  echo $datajk; ?>
                       
        ]
    }]
});
</script>
  