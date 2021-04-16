<?php
$this->db->where("id",$id);
$db=$this->db->get("data_selling")->row();
?>
<form action="javascript:saveAddSelling()"  id="formJual" class="form-horizontal black" method="post"  enctype="multipart/form-data"  >
<input type="hidden" name="options" value="<?php echo $db->sumber_selling;?>" > 
<input type="hidden" name="options2" value="<?php echo $db->sumber_listing;?>" >
<input type="hidden" name="kode_listing" value="<?php echo $db->kode_listing;?>">
<input type="hidden" name="id" value="<?php echo $id;?>">
<div class="form-group">
<label for="tgl_closing" class="b col-lg-3 control-label">Date of Closing</label>
<div class="col-lg-8">
<input type="text" class="form-control" id="tgl_closing"  name="tgl_closing" value="<?php echo $this->tanggal->ind($db->tgl_closing,"/");?>" >
</div>
<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
<label for="nama" class="b col-lg-3 control-label">Rental price</label>
<div class="col-lg-8">
<input type="text" class="form-control" onkeyup="hitung()" onkeydown="return numbersonly(this, event);" id="hargax" name="hargax"   value="<?php echo number_format($db->harga,0,",",".");?>">
</div>
<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
<label for="tgl_jatuh_tempo" class="b col-lg-3 control-label">Due date</label>
<div class="col-lg-8">
<input type="text" class="form-control" id="tgl_jatuh_tempo"  name="tgl_jatuh_tempo" value="<?php echo $this->reff->getTanggalJatuhTempo($db->kode_listing);?>">
</div>
 
<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>


<?php
//$fee_persen=$db->fee_persen;
$fee_persen=$db->komisi_persen;
//$fee_nominal=$db->fee_nominal;
//$fee_markup=$db->fee_up;
if(1==0)
{
?>
 
<label for="komisi" class="b col-lg-3 control-label">Commission  (Rp)</label>
<div class="col-lg-8">
<input type="text" class="form-control" id="terhitungx" name="terhitungx"   value="<?php echo number_format($kt=$db->fee_nominal,0,",",".");?>">
</div>
 
<?php	
}else{
$terhitung=(($fee_persen*$db->harga)/100);
	?>
 
	<label for="fee_persen" class="col-lg-3 control-label b">Commission  (%)</label>
	<div class="col-lg-8">
	<input type="text" onkeyup="hitung()" class="form-control" style="width:20%" id="komisi_persenx" name="komisi_persenx"   value="<?php echo $fee_persen;?>">
	<input type="text" onkeyup="hitungko()" value="<?php echo number_format($kt=$terhitung,0,",","."); ?>" class="form-control pull-right" style="position:absolute;width:70%;margin-top:-34px;margin-left:80px" id="terhitungx" name="terhitungx"  >
	<input type="hidden" name="jenis_komisi" value="fee_persen">
	</div>
	 
<?php
}?>


<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>

 
 

 <div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
 <!---------------------------------------------------------------->
 <label for="email" class="b col-lg-3 control-label">Listing</label>
<div class="col-lg-8">
<div class="btn-group">
<label class="btn-defauld" onclick="listing(1)">
<input type="radio" name="yy"  value="1"  id="option1" checked> Member of beyond
</label> 
<label class="btn-defauld" style="margin-left:20px"  onclick="listing(2)">
<input type="radio" name="yy"   value="2" id="option2">  Co Broke
</label>
</div>
<span id="abl">
										<?php
                                        $ref_agen = $this->reff->getAgen();
                                        $array_agen[""] = "==== Pilih Agen ====";
                                        foreach ($ref_agen as $val) {
                                            $array_agen[$val->kode_agen] = $val->nama." - ".$val->kode_agen;
                                        }
                                        $data = $array_agen;
                                        echo form_dropdown('listing1', $data, $db->kode_agen, 'onchange="return cek_agen()"   id="sel2" class="black form-control" style="width:100%"');
                                        ?>
</span>				
<span id="all">
 
	
	<input type="text" class="form-control" placeholder="Nama" id="listing2" name="listing2" value="<?php echo $db->kode_agen;?>" >
	
	 
</span>	
</div>
<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>

	<label for="fee_persen" class="col-lg-3 control-label b">Commission Total (%)</label>
	<div class="col-lg-8">
	<input type="text" onkeyup="hitungko()" class="form-control" style="width:20%" id="komisi_persen_listingx" name="komisi_persen_listingx" value="<?php echo $db->komisi_persen_listing;?>">
	<input type="text" onkeyup="hitungko()" value="<?php echo number_format($db->nominal_komisi_listing,0,",","."); ?>" class="form-control pull-right" style="position:absolute;width:70%;margin-top:-34px;margin-left:80px" id="terhitung_listingx" name="terhitung_listingx"  >
	<input type="hidden" name="jenis_komisi_listing" value="fee_persen" value="<?php echo $db->sumber_listing;?>">
	</div>
	
	
 <!---------------------------------------------------------------->

	<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
	<!-------------------------------------------------------------->
	<label for="email" class="b col-lg-3 control-label">Selling</label>
<div class="col-lg-8">
<div class="btn-group">
<label class="btn-defauld" onclick="sellingsewa(1)">
<input type="radio" name="xx"   value="1" id="option1" checked> Member of beyond
</label> 
<label class="btn-defauld" style="margin-left:20px"  onclick="sellingsewa(2)">
<input type="radio" name="xx"  value="2" id="option2">  Co Broke
</label>
</div>
<span id="agenBeyond2">
										<?php
                                        $ref_agen = $this->reff->getAgen();
                                        $array_agen[""] = "==== Pilih Agen ====";
                                        foreach ($ref_agen as $val) {
                                            $array_agen[$val->kode_agen] = $val->nama." - ".$val->kode_agen;
                                        }
                                        $data = $array_agen;
                                        echo form_dropdown('selling1', $data, $db->selling, 'onchange="return cek_agen()"   id="sel3" class="black form-control" style="width:100%"');
                                        ?>
</span>				
<span id="agenLain2">
 
	
	<input type="text" class="form-control" placeholder="Nama" id="selling2" name="selling2" value="<?php echo $db->selling;?>" >
	
	 
</span>	
 

</div>
 <div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
 
	<label for="fee_persen" class="col-lg-3 control-label b">Commission Total (%)</label>
	<div class="col-lg-8">
	<input type="text" onkeyup="hitungko()" class="form-control" style="width:20%" id="komisi_persen_selling" name="komisi_persen_sellingx"  value="<?php echo $db->komisi_persen_selling;?>" >
	<input type="text" onkeyup="hitungko()" value="<?php echo  number_format($db->nominal_komisi_selling,0,",",".") ; ?>" class="form-control pull-right" style="position:absolute;width:70%;margin-top:-34px;margin-left:80px" id="terhitung_sellingx" name="terhitung_sellingx"  >
	<input type="hidden" name="jenis_komisi" value="fee_persen">
	</div>
	
	
	<!-------------------------------------------------------------->

 <div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
<label for="nama_buyer" class="b col-lg-3 control-label">Choose Buyer</label>
<div class="col-lg-8">
										<?php
                                        $ref_agen = $this->reff->getCostumer($db->id_pelanggan);
                                        $array_buyyer[""] = "==== Choose Buyer ====";
                                        foreach ($ref_agen as $val) {
                                            $array_buyyer[$val->id_pelanggan] = $val->nama." - ".$val->hp;
                                        }
                                        $data = $array_buyyer;
                                        echo form_dropdown('id_pelanggan', $data, $db->id_pelanggan, 'id="sel4" class="black form-control" style="width:100%"');
                                        ?>


</div>
<!-----
<div class="form-group">
<label for="email" class="b col-lg-3 control-label">Selling</label>
<div class="col-lg-8">
<input type="text" class="form-control" id="email" name="email" required="required">
</div>
</div>
--
<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
<label for="upload" class="b col-lg-3 control-label">Upload Photo File</label>
<div class="input-group col-md-7" >
<input type="file" class="form-control" name="zip" style="margin-left:10px">
<span class="input-group-addon btn btn-primary" onclick="addUpload()">  .Zip </span>
</div>----->
<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
<label for="ket" class="b col-lg-3 control-label">Note </label>
<div class="col-lg-8">
<textarea name="ket" id="ket" class="form-control"><?php echo $db->ket;?></textarea>
</div>
<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
<div class="col-lg-offset-2 col-lg-9">
<span class='load'></span>
<button type="submit" class="btn btn-success pull-right" onclick="saveAddSelling()"><i class='fa fa-save'></i> Save</button>
</div>
</div>
</form>



<!--
<form action="javascript:saveAddSelling()"  id="formJual" class="form-horizontal black" method="post"  enctype="multipart/form-data"  >
<input type="hidden" name="options2" value="<?php echo $db->sumber_selling;?>">
<input type="hidden" name="kode_listing" value="<?php echo $db->kode_listing;?>">
<input type="hidden" name="id" value="<?php echo $db->id;?>">
<div class="form-group">
<label for="tgl_closing" class="b col-lg-3 control-label">Tanggal Closing</label>
<div class="col-lg-8">
<input type="text" class="form-control" id="tgl_closing"  name="tgl_closing" value="<?php echo $this->tanggal->ind($db->tgl_closing,"/");?>" >
</div>
</div>


<div class="form-group">
<label for="nama" class="b col-lg-3 control-label">Harga Sewa</label>
<div class="col-lg-8">
<input type="text" class="form-control" onkeydown="return numbersonly(this, event);" id="harga" name="harga"   value="<?php echo number_format($db->harga,0,",",".");?>">
</div>
</div>

<div class="form-group">
<label for="tgl_jatuh_tempo" class="b col-lg-3 control-label">Tanggal Jatuh Tempo</label>
<div class="col-lg-8">
<input type="text" class="form-control" id="tgl_jatuh_tempo"  name="tgl_jatuh_tempo" value="<?php echo $this->reff->getTanggalJatuhTempo($db->kode_listing);?>">
</div>
</div>



<?php

$komisi=$db->komisi_persen;
if(!$komisi)
{
?>
<div class="form-group">
<label for="komisi" class="b col-lg-3 control-label">Total Komisi (Rp)</label>
<div class="col-lg-8">
<input type="text" class="form-control" id="terhitung" name="terhitung"   value="<?php echo number_format($db->total_komisi,0,",",".");?>">
</div>
</div>
<?php	
}else{
$terhitung=(($komisi*$db->harga)/100);
	?>
	<div class="form-group">
	<label for="fee_persen" class="col-lg-3 control-label b">Total Komisi (%)</label>
	<div class="col-lg-8">
	<input type="text" onkeyup="hitung()" class="form-control" style="width:20%" id="komisi_persen" name="komisi_persen"   value="<?php echo $komisi;?>">
	<input type="text" value="<?php echo number_format($terhitung,0,",","."); ?>" class="form-control pull-right" style="position:absolute;width:70%;margin-top:-34px;margin-left:80px" id="terhitung" name="terhitung"  >
	<input type="hidden" name="jenis_komisi" value="fee_persen">
	</div>
	</div>
<?php
}?>



 

<div class="form-group">
<label for="email" class="b col-lg-3 control-label">Selling</label>
<div class="col-lg-8">
<div class="btn-group">
<label class="btn-defauld" onclick="selling(1)">
<input type="radio" name="x2"   value="1" id="option1" checked> Agen Beyond
</label> 
<label class="btn-defauld" style="margin-left:20px"  onclick="selling(2)">
<input type="radio"  name="x2"  value="2" id="option2"> Pihak Lain
</label>
</div>
<span id="agenBeyond2">
										<?php
                                        $ref_agen = $this->reff->getAgen();
                                        $array_agen[""] = "==== Pilih Agen ====";
                                        foreach ($ref_agen as $val) {
                                            $array_agen[$val->kode_agen] = $val->nama." - ".$val->kode_agen;
                                        }
                                        $data = $array_agen;
                                        echo form_dropdown('selling1', $data, $db->selling, 'onchange="return cek_agen()"   id="sel2" class="black form-control" style="width:100%"');
                                        ?>
</span>				
<span id="agenLain2">
 
	
	<input type="text" class="form-control" placeholder="Nama" id="selling2" name="selling2" value="<?php echo  $db->selling;?>" >
	
	 
</span>	


</div>
</div>
<!-----
<div class="form-group">
<label for="email" class="b col-lg-3 control-label">Selling</label>
<div class="col-lg-8">
<input type="text" class="form-control" id="email" name="email" required="required">
</div>
</div>
------->
<!--
<div class="form-group">
<label for="nama_buyer" class="b col-lg-3 control-label">Pilih Penyewa</label>
<div class="col-lg-8">
										<?php
                                        $ref_agen = $this->reff->getCostumer($db->kode_agen);
                                        $array_buyyer[""] = "==== Pilih Penyewa ====";
                                        foreach ($ref_agen as $val) {
                                            $array_buyyer[$val->id_pelanggan] = $val->nama." - ".$val->hp;
                                        }
                                        $data = $array_buyyer;
                                        echo form_dropdown('id_pelanggan', $data, $db->id_pelanggan, 'id="sel3" class="black form-control" style="width:100%"');
                                        ?>


</div>
</div>
<div class="form-group">
<label for="upload" class="b col-lg-3 control-label">Upload Ulang Berkas </label>
<div class="input-group col-md-7">
<input type="file" class="form-control" name="zip">
<span class="input-group-addon btn btn-primary" onclick="addUpload()">  .Zip </span>
</div>
</div>


<div class="form-group">
<label for="alamat" class="b col-lg-3 control-label">Keterangan </label>
<div class="col-lg-8">
<textarea name="ket" id="ket" class="form-control"><?php echo $db->ket;?></textarea>
</div>
</div>


<div class="form-group">
<div class="col-lg-offset-2 col-lg-9">
<span class='load'></span>
<button type="submit" class="btn btn-success pull-right" onclick="saveAddSelling()"><i class='fa fa-save'></i> Simpan</button>
</div>
</div>
</form>-->


<script>
var i=1;

function addUpload()
{ 	
if(i>=15){ return false;}
	var frm=i+1;
	var data="<div class='form-group form"+frm+"'><label for='upload' class='b col-lg-3 control-label'>Upload Photo</label><div class='input-group col-md-7'><input type='file' class='form-control' name='upload[]'><span class='input-group-addon btn btn-primary' onclick='delUpload(`"+frm+"`)'> <i class='fa fa-trash'></i> </span></div></div><span id='formtambahan"+frm+"'></span>";
	$('#formtambahan'+i).html(data);
	 i++;
	
}
function delUpload(id)
{
	$('.form'+id).hide();
}


sellingsewa(<?php echo $db->sumber_selling;?>);
listing(<?php echo $db->sumber_listing;?>);
 $('input:radio[name=xx][value=<?php echo $db->sumber_selling;?>]')[0].checked = true; 
 $('input:radio[name=yy][value=<?php echo $db->sumber_listing;?>]')[0].checked = true; 

 
 
function sellingsewa(id)
{	$("[name='options']").val(id);
	if(id==1)
	{
		$("#agenBeyond2").show();
		$("#agenLain2").hide();
	}else{
		$("#agenBeyond2").hide();
		$("#agenLain2").show();
	}
}
 
function listing(id)
{ 	

	$("[name='options2']").val(id);
	if(id==1)
	{ 
		$("#abl").show();
		$("#all").hide();
	}else{
		$("#abl").hide();
		$("#all").show();
	}
}









function cek_agen()
{
	$("[name='selling2']").val("");
}

function hitung()
{	
	var harga = $("[name='hargax']").val();
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var komisi=$("[name='komisi_persenx']").val();
	var terhitung=((komisi*harga)/100);
	$("[name='terhitungx']").val(terhitung);
	hitungko();
}

function hitungko()
{	
	var harga = $("[name='terhitungx']").val();
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var harga = harga.replace(".", "");
	var komisi=$("[name='komisi_persen_listingx']").val();
	var terhitung=((komisi*harga)/100);
	$("[name='terhitung_sellingx']").val(harga-terhitung);
	$("[name='terhitung_listingx']").val(terhitung);
	 $("[name='komisi_persen_sellingx']").val(100-komisi);
}

  /*function saveAddSelling()
	{	
		var url="<?php echo base_url();?>data_property/insertSelling";
		$(".load").html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
		$("#formSewa").ajaxForm({
		url:url,
		type: "POST",
		data: $('#formSewa').serialize(),
		success: function(data)
				{
				$("#modalSewa").modal("show");		
				},
				
		});
	}*/
</script>	


<?php echo $this->load->view("js/form.phtml"); ?>
<script>
function saveAddSelling()
	{	
		var url="<?php echo base_url();?>data_property/UpdateSellingSewa";
		$(".load").html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
		$("#formJual").ajaxForm({
		url:url,
		type: "post",
		data: $('#formJual').serialize(),
	//	dataType: "JSON",
		success: function(data)
				{
						  closemodal("modalSewa");
						  table.ajax.reload(null,false); //reload datatable ajax 
				},
				
		});
	}
</script>

<script src="<?php echo base_url();?>plug/boostrap/js/jquery.maskedinput.min.js"></script>  
<script>
$("#tgl_closing").mask("99/99/9999");
$("#tgl_jatuh_tempo").mask("99/99/9999");
</script>



<script src="<?php echo base_url() ?>plug/boostrap/js/select2.min.js"></script>
    <script>
                                      $("document").ready(function () {
                                 //     alert();
                                      //nice select boxes
                                      $('#sel2').select2();
                                      $('#sel3').select2();
                                      $('#sel4').select2();
                                      
									  });
    </script>