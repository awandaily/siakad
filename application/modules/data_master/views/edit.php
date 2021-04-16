<?php $id=$this->uri->segment("3");
$dataval=$this->reff->getDataProperty($id);
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>plug/boostrap/css/compiled/wizard.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>plug/typehead/typehead.css">
<style>
    #map {
        height: 300px;
    }

</style>
<style>
	.hilang{
		position:absolute;
		margin-top:-92000px;
	}
	</style>
<input type="hidden" name="count" value="1">

<?php
if($dataval->lat_area)
{
	$lat=$dataval->lat_area;
}else{
	$lat="-6.917463899999999";
}
?><?php
if($dataval->long_area)
{
	$long=$dataval->lat_area;
}else{
	$long="107.61912280000001";
}
?>

<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: <?php echo $lat; ?>, lng: <?php echo $long; ?>},
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

                document.getElementById('lat_area').value = place.geometry.location.lat();
                document.getElementById('long_area').value = place.geometry.location.lng();


                    var input = document.getElementById('alamat_detail');
           var autocomplete = new google.maps.places.Autocomplete(input);
           google.maps.event.addListener(autocomplete, 'place_changed', function () {
               var place = autocomplete.getPlace();
               // document.getElementById('city').value = place.name;
               document.getElementById('lat').value = place.geometry.location.lat();
               document.getElementById('long').value = place.geometry.location.lng();
               //alert("This function is working!");
               //alert(place.name);
               // alert(place.address_components[0].long_name);

           });


                /*
                 var bandung = new google.maps.LatLng(-6.917463899999999);
                 var cimahi = new google.maps.LatLng(-6.884082,107.541304);
                 var soreang = new google.maps.LatLng(-7.025202,107.525908);
                 var btscoverage = new google.maps.Polygon({
                 path: [bandung, cimahi, soreang],
                 strokeColor: "#0000F7",
                 strokeOpacity: 0.8,
                 strokeWeight: 2,
                 fillColor: "#0000F7",
                 fillOpacity: 0.3
                 });
                 btscoverage.setMap(map);
                 */

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);

           
        });
    }




</script>
<script  src="https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyChmzyUaK6RZopwMAMlE49VgRa9CQsEkFY&callback=initAutocomplete" defer type="text/javascript"></script>



<?php echo $this->load->view("js"); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix" >
            <br>
			<form id="form" action="javascript:updateListing()" method="post">
            <!----------------------------------------------------------------------------------------------------------------------------->		
            <div class="main-box-body clearfix">
                <div id="myWizard" class="wizard">
                    <div class="wizard-inner">
                        <ul class="steps">
                            <li id="step1" class="active"><span class="badge  badge1 badge-primary">1</span>Step 1<span class="chevron"></span></li>
                            <li id="step2"><span class="badge badge2 ">2</span>Step 2<span class="chevron"></span></li>
                            <li id="step3"><span class="badge badge3">3</span>Step 3<span class="chevron"></span></li>
                            <li id="step4"><span class="badge badge4">4</span>Step 4<span class="chevron"></span></li>
							<span class="info" style="position:absolute;margin-left:20px;margin-top:7px"> <?php echo $this->session->flashdata("info");?>	</span>
                        </ul>
                        <div class="actions">
                            <button type="button" class="btn btn-default btn-mini btn-prev" onclick="return back()"> <i class="icon-arrow-left"></i>Prev</button>
                            <button type="button" class="lanjut btn btn-success btn-mini" onclick="return cek()"  >Next<i class="icon-arrow-right"></i></button>
                            <button class="save hilang  btn btn-danger btn-mini" onclick="updateListing()">Save<i class="icon-arrow-right"></i></button>
							
                        </div>
                    </div>
                    <div class="step-content">
                        <!------------------------------------------------------------------------------------------------------------------------------>					
             
                            <br/>
                            <div class='step1'>
						<div class="col-md-6">	
                                <div class="form-group fg_kode_list black">

                                    <div class="form-group black">
                                        <label class="control-label black b" >Kode Listing</label>  
                                       <input type='text' value="<?php echo $this->reff->getKodePropById($id);?>" id="kode" onchange="cek_kode_list()" name='kode' class='form-control'>
                                        <span class="help-block err_kode_list "></span>
                                    </div>
                                </div>
								
									<div class="form-group fg_type_pro black">

                                    <div class="form-group black">
                                        <label class="control-label black b" >Pilih Type Properti</label>
                                        <?php
                                        $ref_type = $this->reff->getTypePro();
                                        $array[""] = "==== choose ====";
                                        foreach ($ref_type as $val) {
                                            $array[$val->id_type] = $val->nama;
                                        }
                                        $data = $array;
                                        echo form_dropdown('type_pro', $data, $dataval->jenis_prop, '  id="type_pro"  class="form-control" onchange="cek_type_pro()"');
                                        ?>
                                        <span class="help-block err_type_pro"></span>
                                    </div>
                                </div>

								
								
								
							<!--	<div class="form-group fg_pemilik black">

                                    <div class="form-group black">
                                        <label class="control-label black b" >Pemilik Property</label>  <a href="#" onclick="addOwner()" class="pull-right"> <i class='fa fa-plus-circle'></i> Tambah data owner</a>
									<span class='dataOwner'>                                    
									<?php
                                        $ref_type = $this->reff->getOwner();
                                        $array_pemilik[""] = "==== choose ====";
                                        foreach ($ref_type as $val) {
                                            $array_pemilik[$val->id_owner] = $val->nama;
                                        }
                                        $data = $array_pemilik;
                                        echo form_dropdown('owner', $data, $dataval->id_owner, '  id="owner" style="width:100%"');
                                        ?>
										</span>										
                                        <span class="help-block err_pemilik"></span>
                                    </div>
                                </div>-->
									<div>
								  <div class="form-group fg_owner black">
									<?php $agens=$this->reff->getDataOwnerById($dataval->id_owner);?>
                                    <div class="form-group black">
                                        <label class="control-label black b" >Vendor</label>  
                                       <input type='text' id="nama_own"  autocomplete="off" onkeyup="cek_data_owner()" onchange="cek_data_owner()"  name='nama_own' class='form-control' value="<?php echo  isset($agens->nama)?($agens->nama):"";?>">
									   <input type="hidden" id="id_own" name="id_own" value="<?php echo  isset($agens->id_owner)?($agens->id_owner):"";?>">
                                        <span class="help-block err_kode_list "></span>
                                    </div>
									<?php
									$jk=isset($agens->jk)?($agens->jk):"";
									$jkl="";$jkp="";
									if($jk=="l")
									{
										$jkl="selected";
									}elseif($jk=="p"){
										$jkp="selected";
									}
									?>
									 <div class="form-group black" style="margin-top:-15px">
                                        <label class="control-label black b" >Gender</label>  
                                       <select name="jk_own" class="form-control">
                                       <option value="0" >===== choose =====</option>
                                       <option value="l" <?php echo $jkl;?>>Mr.</option>
                                       <option  value="2" <?php echo $jkp;?>>Mrs.</option>
									   </select>
                                        <span class="help-block err_kode_list "></span>
                                    </div>
									
									<div class="form-group black" style="margin-top:-15px">
                                        <label class="control-label black b" >Hp 1</label>  
                                       <input type='text' id="hp1_own" name='hp1_own' value="<?php echo  isset($agens->hp)?($agens->hp):"";?>" class='form-control' onchange="cek_duplikat_owner()">
                                        <span class="help-block err_kode_list "></span>
                                    </div>
									<div class="form-group black" style="margin-top:-15px">
                                        <label class="control-label black b" >Hp 2</label>  
                                       <input type='text' id="hp2_own" name='hp2_own' value="<?php echo  isset($agens->hp2)?($agens->hp2):"";?>" class='form-control'  onchange="cek_duplikat_owner()">
                                        <span class="help-block err_kode_list "></span>
                                    </div>
									<div class="form-group black" style="margin-top:-15px">
                                        <label class="control-label black b" >E-mail</label>  
                                       <input type='text' id="email_own" name='email_own' class='form-control'  value="<?php echo  isset($agens->email)?($agens->email):"";?>" onchange="cek_duplikat_owner()">
                                        <span class="help-block err_kode_list "></span>
                                    </div>
									<div class="form-group black" style="margin-top:-15px">
                                        <label class="control-label black b" >Adress</label>  
                                       <textarea name="alamat_own" class="form-control"   onchange="cek_duplikat_owner()"><?php echo  isset($agens->alamat)?($agens->alamat):"";?></textarea>
                                        <span class="help-block err_kode_list "></span>
                                    </div>
                                </div>
								</div>
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								

</div>
<div class="col-md-6">
                                <div class="form-group black fg_type_list black" >
                                    <label class="control-label black b">Type  </label>
                                    <br>
									<?php
									$disewa="";$dijual="";$dijual2="";$disewa2="";
									if($dataval->type_jual=="sewa")
									{
										$disewa="checked"; $disewa2="active";
									}else{
										$dijual="checked"; $dijual2="active";
									}
									
									$gold="";$platinum="";$gold2="";$platinum2="";
									if($dataval->jenis_listing=="gold")
									{
										$gold="checked"; $gold2="active";
									}else{
										$platinum="checked"; $platinum2="active";
									}
									?>
					
                                    <div class="btn-group" data-toggle="buttons" onchange="return cek_type_list()" >
                                        <label class="btn btn-default <?php echo $disewa2;?>">
                                            <input type="radio" name="type_list" <?php echo $disewa; ?> id="type_list" value='sewa' > RENT
                                        </label>
                                        <label class="btn btn-default  <?php echo $dijual2;?>">
                                            <input type="radio" name="type_list" <?php echo $dijual; ?>  id="type_list" value='jual'> SELL
                                        </label>
                                        <span class="help-block err_type_list"></span>
                                    </div>
                                </div>
								
								
								
								<div class="form-group black fg_jenis_list black" >
                                    <label class="control-label black b">Status </label>
                                    <br>
                                    <div class="btn-group" data-toggle="buttons" onchange="return cek_jenis_list()" >
                                        <label class="btn btn-default <?php echo $platinum2; ?> ">
                                            <input type="radio" <?php echo $platinum; ?> name="jenis_list" id="jenis_list" value='platinum' > PLATINUM
                                        </label>
                                        <label class="btn btn-default <?php echo $gold2; ?> ">
                                            <input type="radio" name="jenis_list" id="jenis_list"  <?php echo $gold; ?> value='gold'>GOLD
                                        </label>
                                        <span class="help-block err_jenis_list"></span>
                                    </div>
                                </div>

                                <div class="form-group black fg_desc" onchange="return cek_desc()">
                                    <label class="control-label black b" for="inputError">Description</label>
                                    <textarea onkeyup="cek_desc()" style="height:200px" name='desc' id="desc" class="form-control" placeholder="Tulis deskripsi property disini"><?php echo $dataval->desc; ?></textarea>
                                    <span class="help-block err_desc"></span>
                                </div>

                            </div>							
                        </div>							


                            <!------------------------------------------------------------------------------------------------------------------------------>							
                            <div class='step2 hilang'>
                                <div class='col-md-4'>
                                    <div class="form-group fg_prov col-md-12" > 
                                        <label class="control-label black b" >PROVINCE</label>
                                        <?php
                                        $ref_type = $this->reff->getProvinsi();
                                        $array_prov[""] = "==== choose ====";
                                        foreach ($ref_type as $val) {
                                            $array_prov[$val->id] = '[' . $val->id . ']' . ' &nbsp;' . $val->provinsi;
                                        }
                                        $data = $array_prov;
                                        echo form_dropdown('provinsi', $data, $dataval->id_prov, 'onchange="return cek_prov()"   id="provinsi" class="select2-container" style="width:100%"');
                                        ?>
                                        <span class="help-block err_prov"></span>
                                    </div>

                                    <div class="form-group fg_kab col-md-12"   style='margin-top:-20px'>
                                        <label class="control-label black b" >City</label>
                                        <span class="dataKab">
                                           <!-------------------->
										   <?php
										 	$data=$this->reff->getKab($dataval->id_prov);
											if($data)
											{
												$kab[""]="==== choose ====";
											 foreach ($data as $val) {
													 $kab[$val->id] = '['.$val->id.']'.' &nbsp;'.$val->kabupaten;
													 }
													 $dataKab = $kab;
													echo form_dropdown('kabupaten', $dataKab, $dataval->id_kab, 'required id="kabupaten" class="select2-container" style="width:100%" onchange="return cek_kab()"');     
											echo "<script>	$('#kabupaten').select2();</script>";
											}
										   ?>
                                           <!-------------------->
                                        </span>
                                        <span class="help-block err_kab"></span>
                                    </div>

                                  
                                   <div class="form-group black  col-md-12"  style='margin-top:-14px'>
                                        <label class="control-label black b" for="inputError">Distric</label>
                                        <input type="text" name="area_listing" value="<?php echo $dataval->area_listing;?>" id="area_listing"  placeholder=""  class="form-control col-md-12">
                                       <span class="help-block  "></span>
                                    </div>	

                                    <div class="form-group black fg_area col-md-12"  style='margin-top:-14px'>
                                        <label class="control-label black b" for="inputError">Location</label>
                                        <input type="text"  value="<?php echo $dataval->nama_area;?>"  name="area" id="area" onkeyup="return cek_area()" placeholder=""  class="form-control col-md-12">
                                        <input type="hidden" name="lat_area" value="<?php echo $dataval->lat_area;?>"  id="lat_area" class="form-control col-md-12">
                                        <input type="hidden" name="long_area"  value="<?php echo $dataval->long_area;?>"  id="long_area" class="form-control col-md-12">
                                        <span class="help-block err_area"></span>
                                    </div>	

                                    <div class="form-group black fg_alamat col-md-12" style="margin-top:-10px">
                                        <label class="control-label black b" for="alamat_detail">Address</label>
                                        <input type="text"  value="<?php echo $dataval->alamat_detail;?>"  name="alamat_detail" id="alamat_detail"  onkeyup="return cek_alamat(`edit`)" class="form-control col-md-12">
                                        <input type="hidden" name="lat"  value="<?php echo $dataval->lat_detail;?>"  id="lat" class="form-control col-md-12">
                                        <input type="hidden" name="long"  value="<?php echo $dataval->long_detail;?>"  id="long" class="form-control col-md-12">
                                        <span class="help-block err_alamat"></span>
                                    </div>	
  <div class="form-group black fg_kom col-md-12"  style='margin-top:-20px'>
                                        <label class="control-label black b" for="inputError">Cluster</label>
                                        <input type="text"  name="nama_komplek" value="<?php echo $dataval->komplek;?>"  autocomplete="off" onkeyup="return cek_komplek()" id="nama_komplek" class="form-control typeahead" style="width:100%" >
                                        <span class="help-block err_kom"></span>
                                    </div>	
                                </div>							
                                <div class="col-md-5">
                                    <div id="map"></div>
                                </div>							




                            </div>
                      
                            <!--------------------------------------------------------------------------------------------------------------------------------->		
                            
                            <!------------------------------------------------------------------------------------------------------------------------------>							
                            <div class='step3 hilang'>
							
                                <div class='col-md-3'>
                                     <div class="form-group black fg_tanah col-md-12">
                                    	<label for="luas_tanah">Land</label>
										<div class="input-group">
										<input  value="<?php echo $dataval->luas_tanah;?>"  type="text" class="form-control" id="luas_tanah" onchange="cek_tanah()" name="luas_tanah">
										<span class="input-group-addon">M<sup>2</sup></span>
										</div>  <span class="help-block err_tanah"></span>
                                    </div>	
                                </div>		
							
							
							
								  <div class='col-md-3 harga_tanah_lb'>
                                     <div class="form-group black fg_htanah col-md-12">
                                    	<label for="harga_tanah">Harga Tanah/M<sup>2</sup></label>
										<div class="input-group">
										<input type="text" value="<?php echo number_format($dataval->harga_tanah,0,",",".");?>" class="form-control" id="harga_tanah" onkeyup="kalkulasi()" onkeydown="return numbersonly(this, event)" name="harga_tanah">
										<span class="input-group-addon">M<sup>2</sup></span>
										</div>  <span class="help-block err_htanah"></span>
                                    </div>	
                                </div>	
						
			
								<div class='col-md-3' id="luas_bangunan_lb">
                                     <div class="form-group black fg_bangunan col-md-12">
                                    	<label for="luas_bangunan">Building</label>
										<div class="input-group">
										<input type="text"  value="<?php echo $dataval->luas_bangunan;?>"  class="form-control" id="luas_bangunan"  onchange="cek_bangunan()" name="luas_bangunan">
										<span class="input-group-addon">M<sup>2</sup></span>
										
										</div><span class="help-block err_bangunan"></span>
                                    </div>	
                                </div>		
								 
								
								 
										<input type="hidden" value="<?php echo $dataval->tahun_dibangun;?>"  class="form-control" id="tahun_dibangun" name="tahun_dibangun" >
									  
								
								<div class='col-md-3'>
                                     <div class="form-group black fg_tidur col-md-12">
                                    	<label for="kamar_tidur">KT</label>
										<div class="input-group" style="width:100%">
									
										<input type="number" value="<?php echo $dataval->kamar_tidur;?>"  class="form-control" id="kamar_tidur" name="kamar_tidur">
									   <span class="help-block err_tidur"></span>
									</div>
                                    </div>	
                                </div>		
								
								
								<div class='col-md-3'>
                                     <div class="form-group black fg_harga col-md-12">
                                    	<label for="harga"><span class="title_harga">Price</span></label>
										<div class="input-group">
										<span class="input-group-addon">Rp</span>
										<input type="text" class="form-control"  value="<?php echo number_format($dataval->harga,0,",","."); ?>"  onchange="cek_harga()" onkeydown="return numbersonly(this, event);" id="harga" name="harga">
									  
									</div> <span class="help-block err_harga"></span>
                                    </div>	
                                </div>		
								
							 
								
								<div class='col-md-3'>
                                     <div class="form-group black fg_mandi col-md-12">
                                    	<label for="kamar_mandi">KM</label>
										<div class="input-group" style="width:100%">
									
										<input type="number"  value="<?php echo $dataval->kamar_mandi;?>" class="form-control" id="kamar_mandi" name="kamar_mandi">
									   <span class="help-block err_mandi"></span>
									</div>
                                    </div>	
                                </div>		
								
								<div class='col-md-3'>
                                     <div class="form-group black fg_tidur_p col-md-12">
                                    	<label for="kamar_tidur_pembantu">KTP</label>
										<div class="input-group" style="width:100%">
									
										<input type="number" class="form-control"  value="<?php echo $dataval->kamar_tidur_p;?>" id="kamar_tidur_pembantu" name="kamar_tidur_pembantu">
									   <span class="help-block err_tidur_p"></span>
									</div>
                                    </div>	
                                </div>		
								
								
								<div class='col-md-3'>
                                     <div class="form-group black fg_mandi_p col-md-12">
                                    	<label for="kamar_mandi_pembantu">KMP</label>
										<div class="input-group" style="width:100%">
										<input type="number" class="form-control"  value="<?php echo $dataval->kamar_mandi_p;?>" id="kamar_mandi_pembantu" name="kamar_mandi_pembantu">
									   <span class="help-block err_mandi_p"></span>
									</div>
                                    </div>	
                                </div>		

								<div class='col-md-3'>
                                     <div class="form-group black fg_lantai">
                                    	<label for="lantai">Floor</label>
										<div class="input-group" style="width:100%">
										
										<input type="text" class="form-control"  value="<?php echo $dataval->jml_lantai;?>" id="jumlah_lantai" name="jumlah_lantai" >
									   <span class="help-block err_lantai"></span>
									</div>
                                    </div>	
                                </div>		
								
								<div class='col-md-3'>
                                     <div class="form-group black fg_garasi">
                                    	<label for="garasi">Garage</label>
										<div class="input-group" style="width:100%">
										<input type="number" class="form-control"  value="<?php echo $dataval->jml_garasi;?>" id="garasi" name="garasi" >
									   <span class="help-block err_garasi"></span>
									</div>
                                    </div>	
                                </div>		
								

								<div class='col-md-3'>
                                     <div class="form-group black fg_carports">
                                    	<label for="carports">Carport</label>
										<div class="input-group" style="width:100%">
										<input type="number" class="form-control"  value="<?php echo $dataval->jml_carports;?>" id="carports" name="carports" >
									   <span class="help-block err_carports"></span>
									</div>
                                    </div>	
                                </div>		
								
								<div class='col-md-3'>
                                     <div class="form-group black fg_listrik">
                                    	<label for="listrik">Electricity</label>
										<div class="input-group" style="width:100%">
										<input type="number" class="form-control"  value="<?php echo $dataval->daya_listrik;?>" id="daya_listrik" name="daya_listrik" >
									   <span class="help-block err_listrik"></span>
									</div>
                                    </div>	
                                </div>		
								
								
								<div class='col-md-3'>
                                     <div class="form-group black ">
                                    	<label for="agen">Furniture</label>
										<div class="input-group" style="width:100%">
									 <?php
                                        $ref_agen = $this->reff->getFurniture();
                                        $array_fur[""] = "==== choose ====";
                                        foreach ($ref_agen as $val) {
                                            $array_fur[$val->id] = $val->nama;
                                        }
                                        $data = $array_fur;
                                        echo form_dropdown('furniture', $data, $dataval->furniture, '  id="sel2" class="select2-container" style="width:100%"');
                                        ?>
									   <span class="help-block "></span>
									</div>
                                    </div>	
                                </div>		
								
								<div class='col-md-3'>
                                     <div class="form-group black ">
                                    	<label for="agen">Water</label>
										<div class="input-group" style="width:100%">
									 <?php
                                        $ref_air = $this->reff->getAir();
                                        $array_air[""] = "==== choose ====";
                                        foreach ($ref_air as $val) {
                                            $array_air[$val->id] = $val->nama;
                                        }
                                        $data = $array_air;
                                        echo form_dropdown('air', $data, $dataval->air, '  id="sel3" class="select2-container" style="width:100%"');
                                        ?>
									   <span class="help-block "></span>
									</div>
                                    </div>	
                                </div>		
								
								
								
								
								
								<div class='col-md-3'>
                                     <div class="form-group black fg_hadap">
                                    	<label for="hadap">Compas</label>
										<div class="input-group" style="width:100%">
									 <?php
                                        $ref_type = $this->reff->getHadap();
                                        $array_ma[""] = "==== choose ====";
                                        foreach ($ref_type as $val) {
                                            $array_ma[$val->id_hadap] = $val->nama;
                                        }
                                        $data = $array_ma;
                                        echo form_dropdown('hadap', $data, $dataval->hadap, 'onchange="return cek_hadap()"   id="hadap" class="select2-container" style="width:100%"');
                                        ?>
									<!--   <span class="help-block err_hadap"></span>-->
									</div>
                                    </div>	
                                </div>		
									
								
									<div class='col-md-3'>
                                     <div class="form-group black fg_agen">
                                    	<label for="agen">Member</label>
										<div class="input-group" style="width:100%">
									 <?php
                                        $ref_agen = $this->reff->getAgen();
                                        $array_agen[""] = "==== choose ====";
                                        foreach ($ref_agen as $val) {
                                            $array_agen[$val->kode_agen] = $val->nama;
                                        }
                                        $data = $array_agen;
                                        echo form_dropdown('agen', $data, $dataval->agen, 'onchange="return cek_agen()"   id="agen" class="select2-container" style="width:100%"');
                                        ?>
									   <span class="help-block err_agen"></span>
									</div>
                                    </div>	
                                </div>		

								
								
								
						
								
								<div class='col-md-3'>
                                     <div class="form-group black fg_sertifikat">
                                    	<label for="sertifikat">Status</label>
										<div class="input-group" style="width:100%">
									 <?php
                                        $ref_sert = $this->reff->getSertifikat();
                                        $array_sert[""] = "==== choose ====";
                                        foreach ($ref_sert as $val) {
                                            $array_sert[$val->id_sertifikat] = $val->nama;
                                        }
                                        $data = $array_sert;
                                        echo form_dropdown('sertifikat', $data, $dataval->jenis_sertifikat, 'id="sertifikat" class="select2-container" style="width:100%"');
                                        ?>
									   <span class="help-block err_sertifikat"></span>
									</div>
                                    </div>	
                                </div>		
								
										
								
									
									
							
							
							<!----
							
								<div class='col-md-3'>
                                     <div class="form-group black fg_sewa">
                                    	<label for="sewa">Type Sewa</label>
										<div class="input-group" style="width:100%">
									 <?php
                                        $ref_sewa = $this->reff->getSewa();
                                        $array_sewa[""] = "==== choose ====";
                                        foreach ($ref_sewa as $val) {
                                            $array_sewa[$val->id_sewa] = $val->nama;
                                        }
                                        $data = $array_sewa;
                                        echo form_dropdown('type_sewa', $data, $dataval->type_sewa, 'onchange="return cek_sewa()"   id="sewa" class="select2-container" style="width:100%"');
                                        ?>
									   <span class="help-block err_sewa"></span>
									</div>
                                    </div>	
                                </div>		--->
									
							
							
							<div class='col-md-3'>
                                     <div class="form-group black">
                                    	<label for="agen">Entry Date</label>
										<div class="input-group" style="width:100%">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control"  onchange="goExpired()" value="<?php echo $this->tanggal->ind($dataval->tgl_masuk_listing,"/");?>" name="tgl_masuk_listing" id="maskedDate">
										<span class="help-block"></span>
									</div>
                                    </div>	
                                </div>		
							
							 
																
								<div class='col-md-3'>
                                     <div class="form-group black">
                                    	<label for="agen">Expired Date</label>
										<div class="input-group" style="width:100%">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control"  value="<?php echo $this->tanggal->ind($dataval->tgl_expired,"/");?>" name="tgl_expired" id="maskedDate2">
										<span class="help-block"></span>
									</div>
                                    </div>	
                                </div>		
								
							<!--------------------------->
									<?php
								  $media=$dataval->media_promosi;
				 			 	 $iklan=strpos($media,"1");
				 				   $spanduk=strpos($media,"2");
								
								$ciklan="";
								$cspanduk="";
								if($iklan!== FALSE)
								{
									$ciklan="checked";
								}
								
								if($spanduk!== FALSE)
								{
									$cspanduk="checked";
								}								
								?>
							  	<div class='col-md-3'>
										<div class="form-group black">
										<label class="black">Media Promosi</label>
										<br/>
										<div class="checkbox-nice checkbox-inline">
										<input type="checkbox" id="checkbox-inl-1" <?php echo $ciklan; ?> name="media_iklan" value="1"/>
										<label for="checkbox-inl-1">
										Iklan
										</label>
										</div>
										<div class="checkbox-nice checkbox-inline">
										<input type="checkbox" id="checkbox-inl-2"  <?php echo $cspanduk; ?> name="media_spanduk" value="2"/>
										<label for="checkbox-inl-2">
										Spanduk
										</label>
										</div>
										 
										</div>


								 </div>
							<!------------------------------------------>
								<div class='col-md-3'>
									<div class="form-group">
										
										<div class="btn-group">
										<label class="btn-defauld" onclick="selling(1)">
										<input type="radio" name="options" id="option1" checked> Fee   (%)
										</label> 
										<label class="btn-defauld" style="margin-left:20px"  onclick="selling(2)">
										<input type="radio" name="options" id="option2">  Markup <i class="fa fa-arrow-up"></i>
										</label>
										</div>
										<span id="agenBeyond">
																			<div class='col-md-12'>
																				 <div class="form-group black">
																					 
																					<div class="input-group" style="width:100%">
																					<input type="text" class="form-control"  value="<?php echo $dataval->fee_persen;?>"  onkeydown="return numbersonly(this, event)" name="fee_persen" id="fee_persen">
																					<span class="input-group-addon">%</span>
																			
																				</div>
																				</div>	
																			</div>		
										</span>				
										<span id="agenLain">
										 
											
								<div class='col-md-12'>
                                     <div class="form-group black">
                                     
										<div class="input-group" style="width:100%">
										<span class="input-group-addon">Rp</span>
										<input type="text" class="form-control" onkeydown="return numbersonly(this, event)" name="fee_up"  value="<?php echo $dataval->fee_up;?>" id="fee_up">
										<span class="help-block"></span>
									</div>
                                    </div>	
                                </div>	
											 
										</span>	

										</div>
								</div>
								<script>
								selling(1);
								function selling(id)
								{
									if(id==1)
									{
										$("#agenBeyond").show();
										$("#agenLain").hide();
									}else{
										$("#agenBeyond").hide();
										$("#agenLain").show();
									}
								}
								</script>
								<!------------------------------------------>
							

							
							
							
							
							
							
								 
								<div class='col-md-12'>
								
							   <div class="form-group black fg_ket" >
                                    <label class="control-label black " for="inputError">Keterangan</label>
                                    <textarea style="height:200px" name='keterangan' id="keterangan" class="form-control" placeholder="Tulis keterangan tambahan disini"><?php echo $dataval->keterangan;?></textarea>
                                    <span class="help-block err_ket"></span>
                                </div>
                                </div>
                                </div>
								
                         
                            <!--------------------------------------------------------------------------------------------------------------------------------->		
                           
                            <!--------------------------------------------------------------------------------------------------------------------------------->		
                           
<div class='step4 hilang'>
<!------------------------>


	<link rel="stylesheet" href="<?php echo base_url()?>plug/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
	
	<?php
	$set1="";
	$set2="";
	$set3="";
	$set4="";
	$set5="";
	if($dataval->gambar_utama=="gambar1")
	{
		$set1="checked='checked'";
	}
	if($dataval->gambar_utama=="gambar2")
	{
		$set2="checked='checked'";
	}
	if($dataval->gambar_utama=="gambar3")
	{
		$set3="checked='checked'";
	}
	if($dataval->gambar_utama=="gambar4")
	{
		$set4="checked='checked'";
	}
	if($dataval->gambar_utama=="gambar5")
	{
		$set5="checked='checked'";
	}
	?>
	
	<!------------------------->
														<div class="col-sm-4">
											<div class="widget-box">
												<div class="widget-body">
													<div class="widget-main">
														<div class="form-group">
															<div class="col-xs-12">
															<label>
															<img style='max-width:250px' alt='gambar belum diupload' src="<?php echo base_url()?>file_upload/img/<?php echo $dataval->gambar1;?>">;
																<input  type="file"   name="upload1" />
																</label>
															</div>
														</div>
														<label  style="padding-left:10px;black">
															<input <?php echo $set1;?> type="radio" value="gambar1" name="set" id="set"  />
															<span class="lbl black"> Set gambar utama</span>
														</label>
													
											
												</div>
											</div>
											</div>
										</div>
		<!------------------------->
		<!------------------------->
														<div class="col-sm-4">
											<div class="widget-box">
												<div class="widget-body">
													<div class="widget-main">
														<div class="form-group">
															<div class="col-xs-12">
																<label>
															<img style='max-width:250px' alt='gambar belum diupload' src="<?php echo base_url()?>file_upload/img/<?php echo $dataval->gambar2;?>">;
																<input  type="file"   name="upload2" />
																</label>
															</div>
														</div>
														<label  style="padding-left:10px;black">
															<input <?php echo $set2;?>  type="radio" value="gambar2" name="set" id="set"  />
															<span class="lbl black"> Set gambar utama</span>
														</label>
													
											
												</div>
											</div>
											</div>
										</div>
		<!------------------------->
		<!------------------------->
											<div class="col-sm-4">
											<div class="widget-box">
												<div class="widget-body">
													<div class="widget-main">
														<div class="form-group">
															<div class="col-xs-12">
																<label>
															<img style='max-width:250px' alt='gambar belum diupload' src="<?php echo base_url()?>file_upload/img/<?php echo $dataval->gambar3;?>">;
																<input  type="file"   name="upload3" />
																</label>
															</div>
														</div>
														<label  style="padding-left:10px;black">
															<input  <?php echo $set3;?> type="radio" value="gambar3" name="set" id="set"  />
															<span class="lbl black"> Set gambar utama</span>
														</label>
													
											
												</div>
											</div>
											</div>
										</div>
		<!------------------------->
		<!------------------------->
		<!------------------------->
										<div class="col-sm-4">
											<div class="widget-box">
												<div class="widget-body">
													<div class="widget-main">
														<div class="form-group">
															<div class="col-xs-12">
																<label>
															<img style='max-width:250px' alt='gambar belum diupload' src="<?php echo base_url()?>file_upload/img/<?php echo $dataval->gambar4;?>">;
																<input  type="file"   name="upload4" />
																</label>
															</div>
														</div>
														<label  style="padding-left:10px;black">
															<input  <?php echo $set4;?> type="radio" name="set" id="set" value="gambar4"  />
															<span class="lbl black"> Set gambar utama</span>
														</label>
													
											
												</div>
											</div>
											</div>
										</div>
		<!------------------------->
		<!------------------------->
										<div class="col-sm-4">
											<div class="widget-box">
												<div class="widget-body">
													<div class="widget-main">
														<div class="form-group">
															<div class="col-xs-12">
																<label>
															<img style='max-width:250px' alt='gambar belum diupload' src="<?php echo base_url()?>file_upload/img/<?php echo $dataval->gambar5;?>">
																<input  type="file"   name="upload5" />
																</label>
															</div>
														</div>
														<label  style="padding-left:10px;black">
															<input <?php echo $set5;?>  type="radio" value="gambar5" name="set" id="set"  />
															<span class="lbl black"> Set gambar utama</span>
														</label>
													
											
												</div>
											</div>
											</div>
										</div>
		<!------------------------->
		<!------------------------->
										<div class="col-sm-4">
											<div class="widget-box">
												<div class="widget-body">
													<div class="widget-main">
														<div class="form-group">
															<div class="col-xs-12">
															<label>
															<img style='max-width:250px;max-height:250px' alt='gambar belum diupload' src="<?php echo base_url()?>file_upload/img/<?php echo $dataval->desain;?>">
															<input  type="file"   name="upload6" />
															</label>
															</div>
														</div>
														<label  style="padding-left:10px;black">
															 
															<span class="lbl black"> <b>Gambar Factsheet</b></span>
														</label>
													
											
												</div>
											</div>
											</div>
										</div>
		<!------------------------->
	


		<script src="<?php echo base_url()?>plug/assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url()?>plug/assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url()?>plug/assets/js/ace.min.js"></script>

		<script type="text/javascript">
			jQuery(function($) {
					$('#upload1').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'fit'//large | fit
					,
					preview_error : function(filename, error_code) {

					}
			
				}).on('change', function(){
				});
				
				$('#upload2').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'fit'//large | fit
					,
					preview_error : function(filename, error_code) {

					}
			
				}).on('change', function(){
				});
				
				$('#upload3').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'fit'//large | fit
					,
					preview_error : function(filename, error_code) {

					}
			
				}).on('change', function(){
				});
				
				$('#upload4').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'fit'//large | fit
					,
					preview_error : function(filename, error_code) {

					}
			
				}).on('change', function(){
				});
				
				$('#upload5').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'fit'//large | fit
					,
					preview_error : function(filename, error_code) {

					}
			
				}).on('change', function(){
				});
				$('#upload6').ace_file_input({
					style:'well',
					btn_choose:'Upload Gambar Fatcsheet',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'fit'//large | fit
					,
					preview_error : function(filename, error_code) {

					}
			
				}).on('change', function(){
				});
				
				
			});
		</script>

<!------------------------>
</div>




</div>
						
                        </div>
	
                    </div>
					<input type="hidden" value='<?php echo $id;?>' name="id_property">
					</form>
                </div>
            </div>
        </div>

    <script src="<?php echo base_url() ?>plug/boostrap/js/select2.min.js"></script>
    <script>
                                      $("document").ready(function () {
                                        //  $(".step1").show();
                                       //   $(".step1").addClass("hilang");
                                          $(".step2").addClass("hilang");
                                          $(".step4").addClass("hilang");
                                         $(".step3").addClass("hilang");
                                          $(".step5").addClass("hilang");
                                      });

                                      //nice select boxes
                                      $('#sertifikat').select2();
                                      $('#provinsi').select2();
                                      $('#kabupaten').select2();
                                      $('#hadap').select2();
                                      $('#sewa').select2();
                                      $('#agen').select2();
                                      $('#owner').select2();
                                    
    </script>

    <script>
        $("#provinsi").change(function () {
            var prov = $("#provinsi").val();
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/ajaxGetKab",
                data: "prov=" + prov,
                success: function (data) {
                    $(".dataKab").html(data);
                }
            });

        });
		
	function loadkab(){
            var prov = "32";
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/ajaxGetKab",
                data: "def=3273&prov=" + prov,
                success: function (data) {
                    $(".dataKab").html(data);
                }
            });

        };
    </script>
    <script src="<?php echo base_url() ?>plug/typehead/typehead.js"></script>
    <script>
        $('input.typeahead').typeahead({
            source: function (query, process) {
                var kab = $("#kabupaten").val();
                return $.get('<?php echo base_url() ?>data_property/getKomplek/' + kab, {query: query}, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });
		function addOwner()
		{
			$("#modalOwner").modal("show");
		}
    </script>
	
	

   
  
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalOwner" role="dialog">
  <div class="modal-dialog">
 
<div class="modal-content">
     
      <div class="modal-body form">
   
<section class="content">
  <div class="row">
    <div class="col-lg-12">
	
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-plus-circle"></i><span class='title'> Tambah Data Owner</span></h4>
      </div>
	<br>

<form action="javascript:saveAdd()" name="formAgen" id="formAgen" class="form-horizontal black" method="post" >
<div class="form-group">
<label for="nama" class="b col-lg-2 control-label">Nama</label>
<div class="col-lg-9">
<input type="text" class="form-control" id="nama" name="nama" required="required" >
<input type="hidden" id="id_owner" name="id_owner">
</div>
</div>

<div class="form-group">
<label for="hp" class="col-lg-2 control-label b">Hp</label>
<div class="col-lg-9">
<input type="text" class="form-control" id="hp" name="hp" required="required">
</div>
</div>


<div class="form-group">
<label for="hp" class="col-lg-2 control-label b">Hp2</label>
<div class="col-lg-9">
<input type="text" class="form-control" id="hp2" name="hp2" required="required">
</div>
</div>


<div class="form-group">
<label for="email" class="b col-lg-2 control-label">E-mail</label>
<div class="col-lg-9">
<input type="text" class="form-control" id="email" name="email" required="required">
</div>
</div>

<div class="form-group">
<label for="alamat" class="b col-lg-2 control-label">ALamat</label>
<div class="col-lg-9">
<textarea name="alamat" id="alamat" class="form-control"></textarea>
</div>
</div>


<div class="form-group">
<div class="col-lg-offset-2 col-lg-9">
<span class='load'></span>
<button type="submit" class="btn btn-success pull-right"><i class='fa fa-save'></i> Simpan</button>
</div>
</div>
</form>
    </div>
  </div>   <!-- /.row -->

</section><!-- /.content -->
  </div>
   </div><!-- /.modal-content -->
		

      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
	
 <script>
 function reloadDataOwner()
 {	
	  	$.ajax({
		url:"<?php echo base_url();?>data_owner/getDataOwner/",
		type: "POST",
		success: function(data)
				{
				$(".dataOwner").html(data);		
				},
			});		
 }
 </script>
 <script>
  function saveAdd()
	{	
		var url="<?php echo base_url();?>data_owner/insert";
		$(".load").html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
		$.ajax({
		url:url,
		type: "POST",
		data: $('#formAgen').serialize(),
	//	dataType: "JSON",
		success: function(data)
				{
				if(data==false){ alert("Gagal! Data Owner sudah ada pada database"); $(".load").html(""); $("[name='group']").focus(); return false;}
				$(".load").html('<font color="green"><i class="fa fa-check-circle fa-fw fa-lg"></i> Berhasil di simpan</font>');
				reloadDataOwner();
				$("#formAgen")[0].reset();
				//$(".load").html("");
				
					$("#modalOwner").modal("hide");
					$(".load").html('');
				
				},
				
		});
	}
	
	function cek_data_owner()
	{
		var nama=$("[name='nama_own']").val();
		$.ajax({
		url:"<?php echo base_url();?>data_owner/getDataOwnerByName/",
		dataType: "JSON",
		type:"POST",
		data:"nama="+nama,
		success: function(data)
				{
					
					if(data)
					{
				$("[name='hp1_own']").val(data.hp);	
				$("[name='hp2_own']").val(data.hp2);	
				$("[name='email_own']").val(data.email);	
				$("[name='alamat_own']").val(data.alamat);	
				$("[name='jk_own']").val(data.jk);	
				$("[name='id_own']").val(data.id_owner);	
					}else{
						$("[name='hp1_own']").val("");	
				$("[name='hp2_own']").val("");	
				$("[name='email_own']").val("");	
				$("[name='alamat_own']").val("");	
				$("[name='jk_own']").val("");	
				$("[name='id_own']").val("");	
					}
				},
			});		
	}
</script>	

<script>
function goExpired(){
			 var type_list=$('input[name=jenis_list]:checked').val();
			 var tgl=$("[name='tgl_masuk_listing']").val();
			 if(type_list=="platinum")
			 {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url() ?>data_property/goExpired/",
					data:"tgl="+tgl,
					success: function (data) {
						$("[name='tgl_expired']").val(data);
					}
				});
			 }
        };
		
</script>		

<script>
        $('#nama_own').typeahead({
	          source: function (query, process) {
				  var kab="";
               return $.get('<?php echo base_url() ?>data_property/getOwn/'+kab,{query: query}, function (data) {
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });
		 
    </script>
	
	
	
<script type="text/javascript" src="<?php echo base_url()?>plug/tinymce/tinymce.min.js"></script>
  
         
<script>
    tinymce.init({
selector: "#keterangan",
theme: "modern",
  plugins: [
      "preview wordcount, advlist, autolink, lists,code, link,image, charmap, print, preview, anchor, pagebreak searchreplace wordcount, visualblocks, visualchars, fullscreen, insertdatetime, media, nonbreaking, save, table, contextmenu, directionality, emoticons, paste, textcolor, colorpicker, textpattern,"
  ],
 toolbar: "undo redo | fontselect fontsizeselect | styleselect | bold italic  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blockquote | forecolor backcolor emoticons | table | link image media | preview wordcount fullscreen",
   convert_urls: false,
  theme_advanced_font_sizes : "8px,10px,12px,14px,16px,18px,20px,24px,32px,36px",
  theme_advanced_fonts : "Arial=arial,helvetica,sans-serif;"+
                         "Arial Black=arial black,avant garde;"+
                         "Book Antiqua=book antiqua,palatino;"+
                         "Comic Sans MS=comic sans ms,sans-serif;"+
                         "Courier New=courier new,courier;"+
                         "Century Gothic=century_gothic;"+
                         "Georgia=georgia,palatino;"+
                         "Gill Sans MT=gill_sans_mt;"+
                         "Gill Sans MT Bold=gill_sans_mt_bold;"+
                         "Gill Sans MT BoldItalic=gill_sans_mt_bold_italic;"+
                         "Gill Sans MT Italic=gill_sans_mt_italic;"+
                         "Helvetica=helvetica;"+
                         "Impact=impact,chicago;"+
                         "Iskola Pota=iskoola_pota;"+
                         "Iskola Pota Bold=iskoola_pota_bold;"+
                         "Symbol=symbol;"+
                         "Tahoma=tahoma,arial,helvetica,sans-serif;"+
                         "Terminal=terminal,monaco;"+
                         "Times New Roman=times new roman,times;"+
                         "Trebuchet MS=trebuchet ms,geneva;"+
                         "Verdana=verdana,geneva",
 file_browser_callback: function(field, url, type, win) {
        tinyMCE.activeEditor.windowManager.open({
            file: '<?php echo base_url()?>plug/tinymce/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,// sesuikan direktory KCfinder
            title: 'Upload FIle',
            width: 900,
            height: 450,
            inline: true,
            close_previous: false
        }, {
            window: win,
            input: field
        });
        return false;
    }
});
</script>