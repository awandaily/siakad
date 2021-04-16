<!--
<script src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyA8V020aIxzsnq7PlhFS0a0z50wgIgW7rM" type="text/javascript"></script>
 
 <script type="text/javascript">
    function initialize() {
        var input = document.getElementById('area');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
      //      document.getElementById('city').value = place.name;
            document.getElementById('lat_area').value = place.geometry.location.lat();
            document.getElementById('long_area').value = place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);

        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 
	function getArea()
	{
		var area=$("[name='area']").val();
		if(!area)
		{
			$("[name='lat_area']").val("");
			$("[name='long_area']").val("");
		}
	}
</script>-->

<!--<button class="btn-primary pull-right"  onclick="importData()"> <i class="fa fa-download"></i> Import</button>-->

 <script>
function direct()
{
	window.location.href="<?php echo base_url()?>data_property/add";
}
</script>
 


<div class="row">
    <div class="col-lg-12">

<div class="panel-group accordion" id="accordion">

<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
<i class="fa fa-filter"></i> Filter Pencarian
</a>
</h4>
</div>
<div id="collapseThree" class="panel-collapse collapse">
<div class="panel-body">
<!--------------------------->
<form id="form" action="javascript:getListing()">
  <div class="form-group fg_prov col-md-3" > 
                                        <label class="control-label black b" ></label>
                                        <?php
                                        $ref_type = $this->reff->getProvinsi();
                                        $array_prov[""] = "==== Pilih Provinsi ====";
                                        foreach ($ref_type as $val) {
                                            $array_prov[$val->id] = '[' . $val->id . ']' . ' &nbsp;' . $val->provinsi;
                                        }
                                        $data = $array_prov;
                                        echo form_dropdown('provinsi', $data, '', 'onchange="return cek_prov()"   id="provinsi" class="select2-container" style="width:100%"');
                                        ?>
                                     
                                  
                                 
                                        <label class="control-label black b" ></label>
                                        <span class="dataKab">
										<?php
                                          $kab[""]="==== Pilih ====";
										  $data=$this->reff->getKab(32);
										 foreach ($data as $val) {
												 $kab[$val->id] = '['.$val->id.']'.' &nbsp;'.$val->kabupaten;
												 }
												 $dataKab = $kab;
												echo form_dropdown('kabupaten', $dataKab, "", ' id="kabupaten" class="select2-container" style="width:100%" onchange="return cek_kab()"');     
										echo "<script>	$('#kabupaten').select2();</script>"; ?>
                                        </span>
										
							 
                                        <label class="control-label black b" for="inputError"> </label>
                                        <input type="text" name="area" id="area" onchange="getArea()" placeholder="Area"  class="form-control">
										  <input type="hidden" name="lat_area" id="lat_area" class="form-control col-md-12">
                                        <input type="hidden" name="long_area" id="long_area" class="form-control col-md-12">

                                        
										
                                    
	   <div class="form-group black">
                                        <label class="control-label black b" ></label>
                                        <?php
                                        $ref_type = $this->reff->getTypePro();
                                        $array[""] = "==== Pilih Jenis Properti ====";
                                        foreach ($ref_type as $val) {
                                            $array[$val->id_type] = $val->nama;
                                        }
                                        $data = $array;
                                        echo form_dropdown('jenis_pro', $data, '', '  id="jenis_pro"  class="form-control"  ');
                                        ?>
                                      
                                  
                                      
                                    </div>									
    </div>	
	
	
	 <div class='col-md-3'>
                                     <div class="form-group black fg_tanah col-md-12">
                                    	 
												<label for="kamar_tidur"></label>
											<div class="input-group" style="width:100%">
											
												<input type="number" class="form-control" placeholder="Kamar Tidur" id="kamar_tidur" name="kamar_tidur">
											   <span class="help-block err_tidur"></span>
											</div>
										   
										
										 
												<label for="kamar_mandi"></label>
												<div class="input-group" style="width:100%">
											
												<input type="number" class="form-control" placeholder="Kamar Mandi" id="kamar_mandi" name="kamar_mandi">
											   <span class="help-block"></span>
											</div>
											
									 	<label for="garasi"></label>
												<div class="input-group" style="width:100%">
											
												<input type="number" class="form-control" placeholder="Garasi" id="garasi" name="garasi">
											   <span class="help-block"></span>
											</div>
									 
										
										
										 
												<label for="daya_listrik"></label>
												<div class="input-group" style="width:100%">
											
												<input type="number" class="form-control" placeholder="Daya Listrik" id="daya_listrik" name="daya_listrik">
											   <span class="help-block"></span>
											</div>
										
												
									
									</div>
                                </div>			
	 <div class='col-md-3'>
                                     <div class="form-group black fg_tanah col-md-12">
                                     
										<label for="kamar_mandi"></label>
								
												<div class="input-group">
												<span class="input-group-addon">Rp</span>
												<input type="text" onkeydown="return numbersonly(this, event);" class="form-control" placeholder="Harga Minimal" id="harga_min" name="harga_min">
											  
											</div>  
											
											<label for="harga_max"></label>
											<div class="input-group">
												<span class="input-group-addon">Rp</span>
												<input type="text" onkeydown="return numbersonly(this, event);" class="form-control" placeholder="Harga Maksimal" id="harga_max" name="harga_max">
											</div> 
											
										
									
                                  
                                    
									
                              
                              <label for="sertifikat"></label>
									 <?php
                                        $ref_sert = $this->reff->getSertifikat();
                                        $array_sert[""] = "==== Jenis Sertifikat ====";
                                        foreach ($ref_sert as $val) {
                                            $array_sert[$val->id_sertifikat] = $val->nama;
                                        }
                                        $data = $array_sert;
                                        echo form_dropdown('sertifikat', $data, '', 'id="sertifikat" class="select2-container" style="width:100%"');
                                        ?>
									

									   <label for="agen"></label>
									
									 <?php
                                        $ref_agen = $this->reff->getAgen();
                                        $array_agen[""] = "==== Pilih Agen ====";
                                        foreach ($ref_agen as $val) {
                                            $array_agen[$val->kode_agen] = $val->nama;
                                        }
                                        $data = $array_agen;
                                        echo form_dropdown('agen', $data, '', 'onchange="return cek_agen()"   id="agen" class="select2-container" style="width:100%"');
                                        ?>
									   <span class="help-block err_agen"></span>
									   
									   
											
								 
                                </div>		
						    </div>	 
							
							
							<div class='col-md-3'>
                                     <div class="form-group black fg_tanah col-md-12">
                                    	 
									  <label class="control-label black b" ></label>
                                        <?php                                        
                                        $arrayT[""] = "==== Pilih Tipe Listing ====";
                                        $arrayT["jual"] = "JUAL";
                                        $arrayT["sewa"] = "SEWA";
                                        $data = $arrayT;
                                        echo form_dropdown('type_pro', $data, '', '  id="type_pro"  class="form-control"');
                                        ?>
                                        
										
									
								 
                                        <label for="type_sewa"></label>
									 <?php
                                        $ref_sewa = $this->reff->getSewa();
                                        $array_sewa[""] = "==== Type Sewa ====";
                                        foreach ($ref_sewa as $val) {
                                            $array_sewa[$val->id_sewa] = $val->nama;
                                        }
                                        $data = $array_sewa;
                                        echo form_dropdown('type_sewa', $data, '', 'onchange="return cek_sewa()"   id="sewa" class="form-control" style="width:100%"');
                                        ?>
									 
                              
									<label for="kelengkapan"></label>
									 <?php
                                        $array_l[""] = "==== Kelengkapan Photo ====";
										$array_l["1"] = "Listing terdapat photo";
                                        $array_l["2"] = "Listing tidak Terdapat photo";
                                        $array_l["3"] = "Listing terdapat fetchsheet";
                                        $array_l["4"] = "Listing tidak terdapat fetchsheet";
                                        
                                        $data = $array_l;
                                        echo form_dropdown('kelengkapan', $data, '', 'id="kelengkapan" class="form-control" style="width:100%;margin-top:5px"');
                                        ?>
									

									   <label for="status_penjualan"></label>
									
									 <?php
                                       $array_s[""] = "==== Status Penjualan ====";
                                        $array_s["1"] = "Sold/Rented";
                                        $array_s["0"] = "Sell/Rent";
									    $array_s["2"] = "Cancel";
                                        $data = $array_s;
                                        echo form_dropdown('status_penjualan', $data, '', 'onchange="return cek_agen()"   id="status_penjualan" class="form-control" style="width:100%"');
                                        ?>
									   <span class="help-block err_agen"></span>
									   
									   
											<button class='btn-primary btn btn-block'><i class='fa fa-search'></i> Cari</button>
									
								 
                                </div>		
						    </div>
	
	
<!--------------------------->

</div>
</div>
<?php
  $useragent=$_SERVER['HTTP_USER_AGENT'];
           
                       if(preg_match('/(android|bb\d+|meego).+mobile|Android|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                    {
                       ?>

<span style="margin-left:10px" class="mbl">
			<label>Filter :<input onkeyup="getListing()" name="area" style="width:140%" class="form-control" placeholder=""  type="search"></label>
		 </span>
<?php }  ;?>
</div>

</form>
	 
	 <div id="listing"></div>
	 
	 
   </div>
 </div>

 <?php echo $this->load->view("js/tabel.phtml");?>
 <script>
 
 
 
 
 getListing();
 function getListing()
	{	
	$("#listing").html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
		$.ajax({
		url:"<?php echo base_url();?>data_property/getListing",
		type: "POST",
		data: $('#form').serialize(),
		success: function(data)
				{	
				$("#listing").html(data);
				},
		});	
	}

 </script>
 
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalDetail" role="dialog">
  <div class="modal-dialog modal-lg">
<div class="modal-content" >
      <div class="modal-body form">
<section class="content">
  <div class="row">
    <div class="col-lg-12 dataDetail">
		<!------------------------->
		<!------------------------->
    </div>
  </div>   <!-- /.row -->
</section><!-- /.content -->
  </div>
   </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  



 <script>
  function saveAdd()
	{	
	if(method=="edit")
	{
		var url="<?php echo base_url();?>data_property/update";
	}else{
		var url="<?php echo base_url();?>data_property/insert";
	}
		$(".load").html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
		$.ajax({
		url:url,
		type: "POST",
		data: $('#formAgen').serialize(),
	//	dataType: "JSON",
		success: function(data)
				{
				if(data==false){ alert("Gagal! Agen sudah ada pada database"); $(".load").html(""); $("[name='group']").focus(); return false;}
				$(".load").html('<font color="green"><i class="fa fa-check-circle fa-fw fa-lg"></i> Berhasil di simpan</font>');
				table.ajax.reload(null,false);
				$("#formAgen")[0].reset();
				//$(".load").html("");
				if(method=="edit")
				{
					$("#modalAdd").modal("hide");
					$(".load").html('');
				}
				},
				
		});
	}
	
	 function hapusP(id)
	  {
	    var tanya=window.confirm("Hapus ?");
		if(tanya==false){ return false;};
	  	$.ajax({
		url:"<?php echo base_url();?>data_property/hapus/"+id,
		type: "POST",
		data:"id="+id,
		success: function(data)
				{
				table.ajax.reload(null,false); //reload datatable ajax 
				},
			});
	  }

</script>	



<script>
function exportData()
{
	window.location.href="<?php echo base_url()?>data_property/export";
}

</script>






 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalImport" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
     
      <div class="modal-body form">
<section class="content">
  <div class="row">
    <div class="col-lg-12">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-download"></i> Import Data  <span class='namaGroup'></span></h4>
      </div>
      <!-- general form elements -->
      <div class="box box-primary black">	   <br>
        Silahkan <a href='<?php echo base_url();?>data_property/downloadFormat'><i class="fa fa-file-excel-o"></i> download format</a> sebelum upload.
          <div class="box-body">                      
            <form role="form" name="uploadfilexl" id="uploadfilexl" action="javascript:void();" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input id="userfile"  name="userfile" type="file" class="form-control">
                  <input  name="idGroup" type="hidden">
                </div>				
                <button type="submit" onclick="javascript:simpanfile();" class="btn btn-primary pull-right">
                    <span class="fa fa-upload"></span>&nbsp;Upload
                </button>
                <div class="form-group">
                    <div class="msg"></div>
                    <div class="hasil"></div>
                </div>
            </form>
          </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>   <!-- /.row -->
</section><!-- /.content -->
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
   <?php echo $this->load->view("js/form.phtml"); ?>
  <script type="text/javascript">
function simpanfile(){
    var userfile=$('#userfile').val();
    $('#uploadfilexl').ajaxForm({
     url:'<?php echo base_url();?>data_property/importData/',
     type: 'post',
     data:{"userfile":userfile},
     beforeSend: function() {
        var percentVal = 'Mengupload 0%';
        $('.msg').html(percentVal);
     },
     uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = 'Mengupload ' + percentComplete + '%';
        $('.msg').html(percentVal);
     },
     beforeSubmit: function() {
      $('.hasil').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Silahkan Tunggu ... ");
     },
     complete: function(xhr) {
        $('.msg').html('');
     }, 
     success: function(resp) {
        $('.hasil').html(resp);
		table.ajax.reload(null,false);
		$("#uploadfilexl")[0].reset();
     },
    });     
};
</script>   



<script src="<?php echo base_url() ?>plug/boostrap/js/select2.min.js"></script>
 <script>
                                   
                                      //nice select boxes
                                      $('#sertifikat').select2();
                                      $('#provinsi').select2();
                                      $('#kabupaten').select2();
                                      $('#hadap').select2();
                                      //$('#sewa').select2();
                                      $('#agen').select2();
                                      $('#owner').select2();
    </script>
 <script>
        $("#provinsi").change(function () {
            var prov = $("#provinsi").val();
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/ajaxGetKab2",
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
    </script>
	
	<script>

	var f=jQuery.noConflict();
function detail(id)
{
			f("#modalDetail").modal("show");
	  f('.dataDetail').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Mohon Tunggu ... ");
	            f.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/getDataDetail",
                data: "id=" + id,
                success: function (data) {
			
                    f(".dataDetail").html(data);
                }
            });
	
}
function importData()
{
	 f('.msg').html('');
	  f('.hasil').html('');
	f("#modalImport").modal("show");
}
function goSewa(id)
{
	 f("#goJualReal").modal("show");
    f(".isireal").html('<button class="btn btn-primary col-md-3" style="margin-left:100px" onclick="goSewaReal(`'+id+'`)">	<b>RENT BY BEYOND &nbsp;&nbsp;</b> </button>	 <button  onclick="soldByOwner(`'+id+'`)" class="btn btn-danger col-md-3" style="margin-left:50px">	<b>RENT BY OWNER</b> </button>');

	
}
function goSewaReal(id)
{	 f("#goJualReal").modal("hide");
	f("#modalSewa").modal("show");
	  f('#kontenSewa').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Mohon Tunggu ... ");
	            f.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/getFormSewa/"+id,
                success: function (data) {
		              f("#kontenSewa").html(data);
                }
            });
}
function goJual(id)
{
    f("#goJualReal").modal("show");
    f(".isireal").html('<button class="btn btn-primary col-md-3" style="margin-left:100px" onclick="goJualreal(`'+id+'`)">	<b>SOLD BY BEYOND &nbsp;&nbsp;</b> </button>	 <button  onclick="soldByOwner(`'+id+'`)" class="btn btn-danger col-md-3" style="margin-left:50px">	<b>SOLD BY OTHER</b> </button>');
}
function soldByOwner(id)
{
 	            var kode=id;
	            f.ajax({
                type: "POST",
                dataType: "html",
				data:$("#formCancel").serialize(),
                url: "<?php echo base_url() ?>data_property/soldByOwner/"+kode,
                success: function (data) {
					f("#modalCancel").modal("hide");
		              table.ajax.reload(null,false);
		              }
    });
      f("#goJualReal").modal("hide");
}
function goJualreal(id)
{   f("#goJualReal").modal("hide");
	f("#modalJual").modal("show");
	  f('#kontenJual').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Mohon Tunggu ... ");
	            f.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/getFormJual/"+id,
                success: function (data) {
		              f("#kontenJual").html(data);
		              }
            });
}

function setBelumLaku(kode,sts)
{
	var tanya = window.confirm("Jadikan setatus belum "+sts+" ?");
	if(tanya==false){ return false;}
	            f.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/setBelumLaku/"+kode,
                success: function (data) {
		              table.ajax.reload(null,false);
		              }
            });
}

function cancel(kode)
{
	f("#modalCancel").modal("show");
	$("[name='kode_cancel']").val(kode);
	/*var tanya = window.confirm("Jadikan setatus cancel ?");
	if(tanya==false){ return false;}
	            f.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/setCancel/"+kode,
                success: function (data) {
		              table.ajax.reload(null,false);
		              }
    });*/
			
}
function saveCancel()
{
	//f("#modalCancel").modal("show");
	//var tanya = window.confirm("Jadikan setatus cancel ?");
	//if(tanya==false){ return false;}
	var kode=f("[name='kode_cancel']").val();
	            f.ajax({
                type: "POST",
                dataType: "html",
				data:$("#formCancel").serialize(),
                url: "<?php echo base_url() ?>data_property/setCancel/"+kode,
                success: function (data) {
					f("#modalCancel").modal("hide");
		              table.ajax.reload(null,false);
		              }
    });
			
}
	</script>
	
  
  
  
  
	
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalCancel" role="dialog">
  <div class="modal-dialog">
 
<div class="modal-content">
     
      <div class="modal-body form">
   <form action="javascript:saveCancel()" id="formCancel">
<section class="content">
  <div class="row">
    <div class="col-lg-12">
	
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-info-circle"></i><span class='title'> Alasan cancel</span></h4>
      </div>
	<br>
<center>
	 <div class='col-md-12'>
										<div class="form-group black">
										 <input type="hidden" name="kode_cancel">
										 
										<input type="hidden" id="radio-inl-1"  name="pilih_cancel" value="1"/>
									 
										</div>
										<div class="form-group">
										<label for="ket" class="black"><b>Keterangan</b> </label>
										<textarea class="form-control" id="ket_cancel" name="ket_cancel" rows="3"></textarea>
										</div>
									<button class="btn btn-sm btn-danger"><i class="fa fa-save"></i> Simpan</button>

</center>

    </div>
  </div>   <!-- /.row -->

</section><!-- /.content -->
</form>
  </div>
   </div><!-- /.modal-content -->
		

      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
 
  
  
  
	
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalJual" role="dialog">

<div id="kontenJual">
</div>


    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  


	
	
	
	
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalSewa" role="dialog">
  <div class="modal-dialog">
 
<div class="modal-content">
     
      <div class="modal-body form">
   
<section class="content">
  <div class="row">
    <div class="col-lg-12">
	
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-plus-circle"></i><span class='title'> Form </span></h4>
      </div>
	<br>
<div id="kontenSewa">
</div>


    </div>
  </div>   <!-- /.row -->

</section><!-- /.content -->
  </div>
   </div><!-- /.modal-content -->
		

      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
  
  
    
  
 <!-- Bootstrap modal -->
  <div class="modal fade" id="goJualReal" role="dialog">
  <div class="modal-dialog">
 
<div class="modal-content">
     
      <div class="modal-body form">
   <form action="#" >
<section class="content">
  <div class="row">
    <div class="col-lg-12">
	
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-info-circle"></i><span class='title'> Choose Please</span></h4>
      </div>
	<br>
<center>
	 
									 
										 
									<center>
									 <span class="isireal"></span>
								    </center> 
								
										
									 
								 
</center>

    </div>
  </div>   <!-- /.row -->

</section><!-- /.content -->
</form>
  </div>
   </div><!-- /.modal-content -->
		

      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
  
  
  
  
  
  
  
  
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalNetwork" role="dialog">
  <div class="modal-dialog modal-sm">
    <form action="javascript:saveNetwork()" id="formNetwork">
<div class="modal-content">
     
      <div class="modal-body form">

<section class="content">
  <div class="row">
    <div class="col-lg-12">
	
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-info-circle"></i><span class='title'> Choose Network </span></h4>
      </div>
	<br>
<center>
 
	  <span class="kontenDetailNetwork"></span>
							 
</center>

    </div>
  </div>   <!-- /.row -->

</section><!-- /.content -->

  </div> <div class="modal-footer">
  <span class="msgnet pull-left"></span>
          <button type="button" class="btn btn-primary" onclick="saveNetwork()" ><i class="fa fa-save"></i> save</button>
        </div>
   </div><!-- /.modal-content -->
	</form>	

      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
  
  
  
  
  
  
  
  
  
  
 <div class="modal fade" id="modalDetailVendor" role="dialog" >
  <div class="modal-dialog modal-lg">

<div class="modal-content" >
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-info-circle"></i> Informasi Detail</h4>
      </div>
	  <!----------------------------------------------->
	 <div id="kontenDetailVendor"></div>
	  <!----------------------------------------------->
</div>	  
</div>	  
</div>	  
  
  
  

  <script>
 
	 function saveNetwork()
	  {
		  f(".msgnet").html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");

			 	f.ajax({
				url:"<?php echo base_url();?>data_property/saveNetwork/",
				data: $('#formNetwork').serialize(),
				success: function(data)
						{			
						f(".msgnet").html("");
						f(".kontenDetailNetwork").html(data);
					    f("#modalNetwork").modal("hide");
				},
			});
		 
		
	  }
	  
	  function setNetwork(id)
	  {
	//	getAkun();
		  f("#modalNetwork").modal("show");
			 	f.ajax({
				url:"<?php echo base_url();?>data_property/setNetwork/"+id,
				success: function(data)
						{			
						f(".kontenDetailNetwork").html(data);
				},
			});
		 
		
	  }
</script>   
  

  <script>
//var f=jQuery.noConflict();
	 function detailVendor(id)
	  {
	//	getAkun();
		  f("#modalDetailVendor").modal("show");
			 	f.ajax({
				url:"<?php echo base_url();?>data_owner/getDetail/"+id,
				success: function(data)
						{			
						f("#kontenDetailVendor").html(data);
				},
			});
		 
		
	  }
</script> 

