	 <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>plug/typehead/typehead.css">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cards">
                      
                        <div class="body">
                            <form id="wizard_with_validation" method="POST"   target="<?php echo base_url()?>agenda/createEvent">
                                <h3>STEP 1</h3>
                                <fieldset>
								
								  <?php echo $this->form->input("f[nama]",'Judul Kegiatan','','','focus'); ?>
								  <?php echo $this->form->input("f[anggaran]",'Alokasi Anggaran','','','focus'); ?>
								 
								   <div class="col-md-3" style="text-align:left;margin-top:6px" >   Yang menyelengarakan  </div> 
								   <div class="col-md-9">
                                		<?php
										$p=array();
										$data=$this->m_reff->goFieldResult("admin","*","where level=4");
										$p[""]="==== Pilih ====";	
										foreach($data as $data)
										{
										$p[$data->id_admin]=$data->nama_bagian;	
										}
										$array=$p;
										echo form_dropdown("f[id_user]",$array,'','class="form-control   "');
										?>
                                   </div>
								   <div class="clearfix">&nbsp;</div>
								  <?php echo $this->form->textarea("f[ket]",'Deskripsi Kegiatan','','  style="height:150px"'); ?>
								 
								 
                                </fieldset>

                                <h3>STEP 2</h3>
                                <fieldset>
								<div class="col-md-6 col-xs-12">
                                      <?php echo $this->form->input("f[tgl_mulai]",'Tanggal Mulai Kegiatan','','required readonly','focus'); ?>
								</div>
								<div class="col-md-6 col-xs-12">
								 
							            <?php
										$p="";
										for($i=1;$i<=10;$i++)
										{
										$p[$i]="Kegiatan : ".$i." Hari  ";	
										}
										$array=$p;
										echo form_dropdown("f[durasi]",$array,'1','class="form-control" onchange=tglAkhir()');
										?>
								</div>
								<div class="row clearfix"></div>
								<div class="row clearfix"><br></div>
								<div class="col-md-6 col-xs-12">
                                      <?php echo $this->form->input("f[tgl_akhir]",'Tanggal Akhir Kegiatan','','required readonly "  ','focus'); ?>
								</div>
								<div class="col-md-6 col-xs-12">
                                      <?php echo $this->form->input("f[tempat_kegiatan]",'Tempat kegitan','',' id="area" style="z-index:898989899"','focus'); ?>
								</div>
								
								<div class="col-md-12 col-xs-12">
                                
							
								<div class="col-md-7"  >
								 
							 
								<div id="map" style="width:100%; height:200px;"></div>
								</div>
								
										<div class="col-md-5 col-xs-12">
											  <?php echo $this->form->input("f[latitude]",'Latitude','','id="latitude"','focus'); ?>
										</div>
										<div class="col-md-5 col-xs-12">
											<?php echo $this->form->input("f[longitude]",'Longitude','','id="longitude"','focus'); ?>
										</div>
										 <div class="col-md-5 col-xs-12">
											<?php echo $this->form->input("f[lokasi]",'Kota','','id="lokasi"','focus'); ?>
										</div> 
								
								
								</div>
						
								</fieldset>
								<h3>STEP 3</h3>
                                <fieldset>
								
								<div class="col-md-4 col-xs-12">
									<?php echo $this->form->cekbox("f[peserta]",'INPUT DATA PESERTA','','onchange="formPeserta()"'); ?>
									<div id="form_peserta">
                                		<?php
										$p=array();
										$data=$this->m_reff->getDataForm();
										$p[""]="==== Pilih ====";	
										foreach($data as $data)
										{
										$p[$data->id]=$data->nama;	
										}
										$array=$p;
										echo form_dropdown("f[id_form_peserta]",$array,'','class="form-control"');
										?>
                                   </div>
								   <div class="clearfix row"><br/></div>
								    <?php echo $this->form->cekbox("f[reg_peserta]",'REGISTRASI ONLINE PESERTA','',''); ?>
								 </div>
								<div class="col-md-4 col-xs-12">
									 <?php echo $this->form->cekbox("f[panitia]",'INPUT DATA PANITIA','','onchange="formPeserta()"'); ?>
									 <div id="form_panitia">
                                		<?php
										$p=array();
										$data=$this->m_reff->getDataForm();
										$p[""]="==== Pilih ====";	
										foreach($data as $data)
										{
										$p[$data->id]=$data->nama;	
										}
										$array=$p;
										echo form_dropdown("f[id_form_panitia]",$array,'','class="form-control"');
										?>
                                   </div>
								    <div class="clearfix row"><br/></div>
								    <?php echo $this->form->cekbox("f[reg_panitia]",'REGISTRASI ONLINE PESERTA','',''); ?>
								 </div>
								 
							 
								 <div class="col-md-4 col-xs-12">
									 <?php echo $this->form->cekbox("f[narasumber]",'INPUT DATA PANITIA','','onchange="formPeserta()"'); ?>
									  <div id="form_narasumber">
                                		<?php
										$p=array();
										$data=$this->m_reff->getDataForm();
										$p[""]="==== Pilih ====";	
										foreach($data as $data)
										{
										$p[$data->id]=$data->nama;	
										}
										$array=$p;
										echo form_dropdown("f[id_form_narasumber]",$array,'','class="form-control"');
										?>
                                   </div>
								    <div class="clearfix row"><br/></div>
								    <?php echo $this->form->cekbox("f[reg_narasumber]",'REGISTRASI ONLINE NARASUMBER','',''); ?>
								 </div>
								 
								 
								 
                                </fieldset>
								 </form>
								</div>
							
 <script>
 $("#form_peserta").hide();
 $("#form_panitia").hide();
 $("#form_narasumber").hide();
function formPeserta()
{
	if($("[name='f[peserta]']").is(':checked'))
		$("#form_peserta").show();
	else
		$("#form_peserta").hide();
	
	if($("[name='f[panitia]']").is(':checked'))
		$("#form_panitia").show();
	else
		$("#form_panitia").hide();
	
	if($("[name='f[narasumber]']").is(':checked'))
		$("#form_narasumber").show();
	else
		$("#form_narasumber").hide();
}

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -6.917463899999999, lng: 107.61912280000001},
            zoom: 13,
            mapTypeId: 'roadmap'
        });


        // Create the search box and link it to the UI element.
        var input = document.getElementById('area');
        var searchBox = new google.maps.places.SearchBox(input);
        //   map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());

        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();


                    var input = document.getElementById('alamat_detail');
           var autocomplete = new google.maps.places.Autocomplete(input);
           google.maps.event.addListener(autocomplete, 'place_changed', function () {
               var place = autocomplete.getPlace();
                document.getElementById('lokasi').value = place.name;
               document.getElementById('latitude').value = place.geometry.location.lat();
               document.getElementById('longitude').value = place.geometry.location.lng();
               //alert("This function is working!");
               //alert(place.name);
               // alert(place.address_components[0].long_name);

           });
 

                if (place.geometry.viewport) {
                   
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);

           
        });
    }




</script>

  
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAX0wS9-ukhrGoZwXjBlsPLrnjXXBFNqrQ&libraries=places&callback=initAutocomplete" async defer></script>

