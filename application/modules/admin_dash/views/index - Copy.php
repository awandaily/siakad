 
         <div class="row clearfix  col-md-12">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">directions_walk</i>
                        </div>
                        <div class="content">
                            <div class="text"> Pengunjung</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_reff->pengunjung();?></div>
							 
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">chat</i>
                        </div>
                        <div class="content">
                            <div class="text">Komentar</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_reff->komentar();?> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">thumb_up</i>
                        </div>
                        <div class="content">
                            <div class="text">Suka</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_reff->suka();?></div>
                        </div>
                    </div>
                </div>
				
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">thumb_down</i>
                        </div>
                        <div class="content">
                            <div class="text">Tidak Suka</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_reff->tidak_suka( );?></div>
                        </div>
                    </div>
                </div>
            </div>
  <?php
	 $data=$this->db->query("select substr(tgl,1,10) as tgl,count(*) as jml from tm_pengunjung    group by substr(tgl,1,10) limit 30 ");
if($data->num_rows()>5)
{
	 ?>
                            <div class="collapse_xx col-md-12  " id="collapseExample_xx">
                                <div class="well">
                                   <div id="container" style="min-width:100%" ></div>
                                </div>
                            </div>
<?php } ?>                

 
  <div class="row clearfix col-md-12">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-4">
                        <div class="icon">
                            <i class="material-icons col-red">directions_walk</i>
                        </div>
                        <div class="content">
                            <div class="text">Pengunjung</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
				
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-4">
                        <div class="icon">
                            <i class="material-icons col-indigo"> chat</i>
                        </div>
                        <div class="content">
                            <div class="text">Komentar</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
				
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-4">
                        <div class="icon">
                            <i class="material-icons col-purple">thumb_up</i>
                        </div>
                        <div class="content">
                            <div class="text">Suka</div>
                            <div class="number count-to" data-from="0" data-to="117" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_reff->suka($idu=$this->session->userdata("id"));?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-4">
                        <div class="icon">
                            <i class="material-icons col-deep-purple">thumb_down</i>
                        </div>
                        <div class="content">
                            <div class="text">Tidak Suka</div>
                            <div class="number count-to" data-from="0" data-to="1432" data-speed="1500" data-fresh-interval="20"><?php echo $this->m_reff->tidak_suka($idu=$this->session->userdata("id"));?></div>
                        </div>
                    </div>
                </div>
     </div> 
           

 

        

          
		  
		 
				
           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  ">
                    <div class="card">
                        <div class="header">
                            <h2>Terpopular </h2>
                            
                        </div>
                        <div class="body">
                            <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">
										<?php
										$this->db->order_by("point","desc");
										$this->db->limit(10);
										$data=$this->db->get("ratting")->result();
										?>
                                <ol class="carousel-indicators">
								<?php
										$i=0;
										foreach($data as $val)
										{
										 if($i==0){ $class="active"; }else{ $class=""; };
											?>
                                   
                                    <li class="<?php echo $class;?>" data-target="#carousel-example-generic_2" data-slide-to="<?php echo $i;?>"></li>
                                   
										<?php $i++; } ?>
                                </ol>
                                
                                <div class="carousel-inner" role="listbox">
								  <?php 
									
										$i=1;
										foreach($data as $data)
										{ 
											if($i==1){	$active="active";	}else{	$active="";	}
										?>
										
										<div class="item <?php echo $active;?>">
                                        <img width="100%" style="max-height:200px" src="<?php echo base_url()?>file_upload/thumbnail/<?php echo $data->thumbnail;?>">
                                        <div class="carousel-caption">
                                            <h3  ><?php echo $data->judul; ?></h3>
                                            <p> 
										 
											<i class="material-icons">chat</i> <span class="icon-name"><?php echo $data->komentar;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<i class="material-icons">thumb_up</i> <span class="icon-name"><?php echo $data->suka;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<i class="material-icons">thumb_down</i> <span class="icon-name"><?php echo $data->tidak;?></span>
											 
											
											</p>
                                        </div>
                                        </div>
										
										<?php $i++; }	?>	
                                     
                                </div>
                               
                                <a class="left carousel-control" href="#carousel-example-generic_2" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic_2" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
              </div> 
			  
			  
           
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>POINT TERTINGGI</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                             <!---->
							  
                                   <ul class="list-group">
                               
                                      
                                        <?php $data="";
										$this->db->order_by("nilai","DESC");
										$this->db->limit(10);
										$data=$this->db->get("ratting")->result();
										foreach($data as $data)
										{
											if($data->nilai){ $nilai=$data->nilai;}else{ $nilai=0;}
											echo ' <li class="list-group-item"><a target="_blank" href="#">'.$data->judul.'</a> <span class="badge bg-pink">
											'. $nilai .'</span></li>';
										}
										?>	
                                   </ul>
                             <!---->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info 
				
				<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


 
/*
$data_statistik="";
foreach($data->result() as $data)
{
	$data_statistik.="['".$this->tanggal->ind($data->tgl,"/")."', ".$data->jml."],";
}
?>

		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistik Pengunjung Perhari'
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
            text: 'jumlah'
        }
    },
    legend: {
        enabled: false
    },
   
    series: [{
        name: 'Pengunjung',
        data: [
		<?php echo $data_statistik;?>             
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
         
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
		</script>