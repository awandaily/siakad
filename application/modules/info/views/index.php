 
<?php 	$t=date('Y'); ?>
 <div class="alert   bg-primary">
                                <strong>ARTIKEL ANDA YANG DILOMBAKAN :</strong><span class="pull-right"><i><?php echo $this->mdl->artikel_lomba();?> </i></span>
                            </div>
 
                       <!--     <a class="btn btn-block bg-pink waves-effect m-b-15" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false"
                               aria-controls="collapseExample">
                               Statistik Pengunjung 
                            </a>-->
                          
         <div class="row clearfix  ">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">directions_walk</i>
                        </div>
                        <div class="content">
                            <div class="text"> Pengunjung</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_reff->pengunjung($idu=$this->session->userdata("id"));?></div>
							 
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
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_reff->komentar($idu=$this->session->userdata("id"));?> </div>
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
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_reff->suka($idu=$this->session->userdata("id"));?></div>
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
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_reff->tidak_suka($idu=$this->session->userdata("id"));?></div>
                        </div>
                    </div>
                </div>
            </div>
  <?php
	 $data=$this->db->query("select substr(tgl,1,10) as tgl,count(*) as jml from tm_pengunjung  where id_admin='".$idu."' group by substr(tgl,1,10) limit 30 ");
if($data->num_rows()>5)
{
	 ?>
                            <div class="collapse_xx col-md-12  " id="collapseExample_xx">
                                <div class="well">
                                   <div id="container" style="min-width:100%" ></div>
                                </div>
                            </div>
<?php } ?>                

 
<div class="clear clearfix row col-md-12">&nbsp;</div>
	 <!--  <div class="row clearfix hide">
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
     </div>-->
           

 

        

          
		  
		 
				<div class="row clearfix">&nbsp;</div>
        <!--      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hide">
                    <div class="card">
                        <div class="header">
                            <h2>DOKUMENTASI KEGIATAN THN <?php echo $t;?></h2>
                            
                        </div>
                        <div class="body">
                            <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">
                                
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic_2" data-slide-to="0" class=""></li>
                                    <li class="active" data-target="#carousel-example-generic_2" data-slide-to="1"></li>
                                    <li class="" data-target="#carousel-example-generic_2" data-slide-to="2"></li>
                                </ol>
                                
                                <div class="carousel-inner" role="listbox">
                                    <div class="item">
                                        <img src="<?php echo base_url()?>new/images/image-gallery/10.jpg">
                                        <div class="carousel-caption">
                                            <h3>First slide label</h3>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                        </div>
                                    </div>
                                    <div class="item active">
                                        <img src="<?php echo base_url()?>new/images/image-gallery/12.jpg">
                                        <div class="carousel-caption">
                                            <h3>Second slide label</h3>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="<?php echo base_url()?>new/images/image-gallery/19.jpg">
                                        <div class="carousel-caption">
                                            <h3>Third slide label</h3>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                        </div>
                                    </div>
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
              </div>-->
			  
			  
                <div class="row clearfix  ">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>INFORMASI</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                              <?php echo $this->m_reff->goField("pengaturan","val","where id='4'");?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
				
				<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>



<?php
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