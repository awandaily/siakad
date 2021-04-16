
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsbzuJDUEOoq-jS1HO-LUXW4qo0gW9FNs&amp;sensor=false"></script>
      <script src="<?php echo base_url()?>plug/js/gmap3.js"></script>
   
			
                <div class="row">
                <div id="col_map" class="col-xs-12 col-md-12">
                    <h3 class="widget-title">
                       <span class="light">Sebaran </span>MAN IC
                    </h3>
                </div>
                </div>
               
               <div class="row">
               <div id="col_map" class="col-xs-12 col-md-12">
    				<div id="mappage" style="width:100%;height:500px;box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.44);"></div>
    				</div>
    			</div>   
    			</div>
    			
    			<br><br>
				<style>
				.tc{background:#25B0EC;vertical-align:center;height:30px;color:#ffffff;}
				</style>
                <script>
				$(document).ready(function(){
					$("#mappage").gmap3({
					  map:{
						options:{
							center:[-2.5139291,115.5082764],
							zoom: 5,
							mapTypeId: google.maps.MapTypeId.MAP,
							mapTypeControl: true,
							mapTypeControlOptions: {
							  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
							},
							navigationControl: true,
							scrollwheel: true,
							streetViewControl: true
						}
					  },
					  marker:{
						values:[{latLng:[-7.717050, 112.978498], data:"<h4>MAN IC Pasuruan</h4><h5>Provinsi Jawa Timur</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>1</center></td></tr><tr><td>Guru</td><td>:</td><td><center>19</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>2</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-5.211659, 119.648263], data:"<h4>MAN IC Gowa</h4><h5>Provinsi Sulawesi Selatan</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>1</center></td></tr><tr><td>Guru</td><td>:</td><td><center>19</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>2</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						],
						options:{
						  draggable: false
						},
						events:{
						  click: function(marker, event, context){
							var map = $(this).gmap3("get"),
							  infowindow = $(this).gmap3({get:{name:"infowindow"}});
							if (infowindow){
							  infowindow.open(map, marker);
							  infowindow.setContent(context.data);
							} else {
							  $(this).gmap3({
								infowindow:{
								  anchor:marker, 
								  options:{content: context.data}
								}
							  });
							}
						  },
						  function(){
							var infowindow = $(this).gmap3({get:{name:"infowindow"}});
							if (infowindow){
							  infowindow.close();
							}
						  }
						}
					  }
					});

				});
				</script>
               


         </div>
      </div>
	  
	  
	  <!-- {latLng:[-0.796314, 119.888368], data:"<h4>MAN IC Kota Palu</h4><h5>Provinsi Sulawesi Tengah</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>12</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>3</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[4.969542, 97.739207], data:"<h4>MAN IC Aceh Timur</h4><h5>Provinsi Aceh</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>14</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>1</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[1.178926, 104.079577], data:"<h4>MAN IC Kota Batam</h4><h5>Provinsi Kepulauan Riau</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>11</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>2</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[1.563358, 99.289069], data:"<h4>MAN IC Tapanuli Selatan</h4><h5>Provinsi Sumatera Utara</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>9</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>3</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-0.651972, 100.254455], data:"<h4>MAN IC Padang Pariaman</h4><h5>Provinsi Sumatera Barat</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>9</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>3</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-6.915540, 109.645404], data:"<h4>MAN IC Pekalongan</h4><h5>Provinsi Jawa Tengah</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>8</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>2</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[0.840176, 127.663653], data:"<h4>MAN IC Halmahera Barat</h4><h5>Provinsi Maluku Utara</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>7</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>2</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[1.337395, 109.277585], data:"<h4>MAN IC Sambas</h4><h5>Provinsi Kalimantan Barat</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>7</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>2</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-4.065997, 122.492442], data:"<h4>MAN IC Kendari</h4><h5>Provinsi Sulawesi Tenggara</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>7</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>1</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-3.694245, 102.403101], data:"<h4>MAN IC Bengkulu Tengah</h4><h5>Provinsi Bengkulu</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>5</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>2</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-8.692890, 116.457013], data:"<h4>MAN IC Lombok Timur</h4><h5>Provinsi Nusa Tenggara Barat</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>5</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>2</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-1.054714, 131.288135], data:"<h4>MAN IC Sorong</h4><h5>Provinsi Papua Barat</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>5</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>1</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-1.857902, 116.162378], data:"<h4>MAN IC Paser</h4><h5>Provinsi Kalimantan Timur</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>3</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>3</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[0.685631, 101.564379], data:"<h4>MAN IC Siak</h4><h5>Provinsi Riau</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>5</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>1</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-3.743976, 114.764231], data:"<h4>MAN IC Tanah Laut</h4><h5>Provinsi Kalimantan Selatan</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>4</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>1</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-2.327526, 106.177517], data:"<h4>MAN IC Bangka Tengah</h4><h5>Provinsi Kep. Bangka Belitung</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>4</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>0</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-3.497178, 104.806952], data:"<h4>MAN IC Ogan Komering Ilir</h4><h5>Provinsi Sumatera Selatan</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>2</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>2</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},
						{latLng:[-6.325710, 106.681205], data:"<h4>MAN IC Serpong</h4><h5>Provinsi Banten</h5><table class='table table-bordered table-sm' width='300px'><thead><tr class='tc'><td colspan='2'><center><b>Kebutuhan</b></center></td><td><center><b>Jumlah</b></center></td></tr></thead><tbody><tr><td width='120px'>Kepala Madrasah</td><td>:</td><td><center>0</center></td></tr><tr><td>Guru</td><td>:</td><td><center>0</center></td></tr><tr><td>Pembina Asrama</td><td>:</td><td><center>1</center></td></tr></tbody></table>", options:{icon: "<?php echo base_url()?>plug/img/markermanic.png"}},-->