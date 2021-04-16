 
<script src="<?php echo base_url();?>plug/boostrap/js/jquery.maskedinput.min.js"></script>  
<script>
$("#tgl_closing").mask("99/99/9999");
</script>


 
 <?php
$this->db->where("id",$id);
$db=$this->db->get("data_selling")->row();
?>
  
 
<form action="javascript:saveAddSelling()"  id="formEditJual" class="form-horizontal black" method="post"  enctype="multipart/form-data"  >
<input type="hidden" name="options"  >
<input type="hidden" name="options2"  >
<input type="hidden" name="kode_listing" value="<?php echo $db->kode_listing;?>">
<input type="hidden" name="kode_agen" value="<?php echo $db->kode_agen;?>">
<input type="hidden" name="id" value="<?php echo $id;?>">
<div class="form-group">
<label for="tgl_closing" class="b col-lg-3 control-label">Date of Closing</label>
<div class="col-lg-8">
<input type="text" class="form-control" id="tgl_closing"  name="tgl_closing" value="<?php echo $this->tanggal->ind($db->tgl_closing,"/");?>" >
</div>
<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>

<label for="nama" class="b col-lg-3 control-label">Selling price </label>
 
<div class="col-lg-5">
<input type="text" class="form-control" onkeyup="hitung()" onkeydown="return numbersonly(this, event);" id="harga" name="harga"   value="<?php echo number_format($db->harga ,0,",",".");?>">

</div>
 
<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>

<?php
$komisi=$db->komisi_persen;
if(!$komisi)
{
?>
 
<label for="komisi" class="b col-lg-3 control-label"> Commission Total (Rp)</label>
<div class="col-lg-8">
<input type="text" class="form-control" id="terhitung" onkeyup="hitungko()" name="terhitung"   value="<?php echo number_format($db->total_komisi,0,",",".");?>">

</div>
 
<?php	
}else{
$terhitung=(($komisi*$db->harga)/100);
	?>
	 
	<label for="fee_persen" class="col-lg-3 control-label b">Commission Total (%)</label>
	<div class="col-lg-8">
	<input type="text" onkeyup="hitung()" class="form-control" style="width:20%" id="komisi_persen" name="komisi_persen"   value="<?php echo $komisi;?>">
	<input type="text" onkeyup="hitungko()" value="<?php echo number_format($kt=$terhitung,0,",","."); ?>" class="form-control pull-right" style="position:absolute;width:70%;margin-top:-34px;margin-left:80px" id="terhitung" name="terhitung"  >
	<input type="hidden" name="jenis_komisi" value="fee_persen">
	</div>
	 
<?php
}?>



<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
<!------------------------------------------------------------------------------------------>

	<!-------------->
	<label for="email" class="b col-lg-3 control-label">Listing</label>
<div class="col-lg-8">
<div class="btn-group">
<label class="btn-defauld" onclick="listing(1)">
<input type="radio" name="y"    id="option1" value="1" checked> Member of beyond
</label> 
<label class="btn-defauld" style="margin-left:20px"  onclick="listing(2)">
<input type="radio" name="y"   id="option2" value="2"> Co Broke
</label>
</div>
<span id="agenBeyondLlisting">
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
<span id="agenLainListing">
 
	
	<input type="text" class="form-control" placeholder="Nama" id="listing2" name="listing2" value="<?php echo  $db->kode_agen ; ?>"  >
	
	 
</span>	
</div>
     <div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>

	<label for="fee_persen" class="col-lg-3 control-label b">Commission   (%)</label>
	<div class="col-lg-8">
	<input type="text" onkeyup="hitungko()" class="form-control" style="width:20%" id="komisi_persen_listing" name="komisi_persen_listing"   value="<?php echo  number_format($db->komisi_persen_listing,0,",",".") ; ?>">
	<input type="text" onkeyup="hitungko()" value="<?php echo  number_format($db->nominal_komisi_listing,0,",",".") ; ?>" class="form-control pull-right" style="position:absolute;width:70%;margin-top:-34px;margin-left:80px" id="terhitung_listing" name="terhitung_listing"  >
	<input type="hidden" name="jenis_komisi_listing" value="fee_persen" >
	</div>
	
	<div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
<!---------------------------------------------------------------------------------->
<label for="email" class="b col-lg-3 control-label">Selling</label>
<div class="col-lg-8">
<div class="btn-group">
<label class="btn-defauld" onclick="selling(1)">
<input type="radio" name="x"    id="option1" value="1" checked> Member of beyond
</label> 
<label class="btn-defauld" style="margin-left:20px"  onclick="selling(2)" value="2">
<input type="radio" name="x"   id="option2" value="2">  Co Broke
</label>
</div>
<span id="agenBeyond">
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
<span id="agenLain">
 
	
	<input type="text" class="form-control" placeholder="Nama" id="selling2" name="selling2" value="<?php echo $db->selling; ?>" >
	
	 
</span>	
</div>
 <div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
 
	<label for="fee_persen" class="col-lg-3 control-label b">Commission   (%)</label>
	<div class="col-lg-8">
	<input type="text" onkeyup="hitungko()" class="form-control" style="width:20%" id="komisi_persen_selling" name="komisi_persen_selling"   value="<?php echo  number_format($db->komisi_persen_selling,0,",",".") ; ?>">
	<input type="text" onkeyup="hitungko()" value="<?php echo  number_format($db->nominal_komisi_selling,0,",",".") ; ?>" class="form-control pull-right" style="position:absolute;width:70%;margin-top:-34px;margin-left:80px" id="terhitung_selling" name="terhitung_selling"  >
	<input type="hidden" name="jenis_komisi" value="fee_persen">
	</div>
<!-------------------------------------------------------------------------------------->
   <div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
<label for="nama_buyer" class="b col-lg-3 control-label">Choose Buyer</label>
<div class="col-lg-8">
										<?php
                                        $ref_agen = $this->reff->getCostumer($val->kode_agen);
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
-------
<div class="form-group">
<label for="upload" class="b col-lg-3 control-label">Upload Berkas Photo </label>
<div class="input-group col-md-7">
<input type="file" class="form-control" name="zip">
<span class="input-group-addon btn btn-primary" onclick="addUpload()">  .Zip </span>
</div>
</div>
-->
   <div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
 
<label for="ket" class="b col-lg-3 control-label">Note</label>
<div class="col-lg-8">
<textarea name="ket" id="ket" class="form-control"><?php echo $db->ket; ?></textarea>
</div>
  <div class="cleafix col-md-12 col-sx-12" style="height:5px">&nbsp;</div>
<div class="col-lg-offset-2 col-lg-9">
<span class='load'></span>
<button type="submit" class="btn btn-success pull-right"  ><i class='fa fa-save'></i> Save</button>
</div>
</div>
</form>

   

<script>
selling(<?php echo $db->sumber_selling;?>);
listing(<?php echo $db->sumber_listing;?>);
 $('input:radio[name=x][value=<?php echo $db->sumber_selling;?>]')[0].checked = true; 
 $('input:radio[name=y][value=<?php echo $db->sumber_listing;?>]')[0].checked = true; 
 
$("[name='options']").val(id);
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

function selling(id)
{ $("[name='options']").val(id);
	if(id==1)
	{
		$("#agenBeyond").show();
		$("#agenLain").hide();
	}else{
		$("#agenBeyond").hide();
		$("#agenLain").show();
	}
}
function listing(id)
{ $("[name='options2']").val(id);
	if(id==1)
	{
		$("#agenBeyondLlisting").show();
		$("#agenLainListing").hide();
	}else{
		$("#agenBeyondLlisting").hide();
		$("#agenLainListing").show();
	}
}
function hitung()
{	
	var harga = $("[name='harga']").val();
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
	var komisi=$("[name='komisi_persen']").val();
	var terhitung=((komisi*harga)/100);
	$("[name='terhitung']").val(terhitung);
	hitungko();
}


function hitungko()
{	
	var harga = $("[name='terhitung']").val();
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
	var komisi=$("[name='komisi_persen_listing']").val();
	var terhitung=((komisi*harga)/100);
	$("[name='terhitung_selling']").val(harga-terhitung);
	$("[name='terhitung_listing']").val(terhitung);
	 $("[name='komisi_persen_selling']").val(100-komisi);
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
 
function saveAddSelling()
	{	
		var url="<?php echo base_url();?>data_property/UpdateSelling";
		$(".load").html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
		$.ajax({
		url:url,
		type: "post",
		data: $('#formEditJual').serialize(),
	//	dataType: "JSON",
		success: function(data)
				{
							closemodal("modalJual");
						 	table.ajax.reload(null,false); //reload datatable ajax 
				},
				
		});
	}
</script>


 