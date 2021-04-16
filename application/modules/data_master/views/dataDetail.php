 <style>
   
  .thumbnails  body {
      font: 100%/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
      width: 80%;
      margin: 0 auto;
      padding-top: 3em;
      color: #333;
      background: #eee;
    }
   .thumbnails img {
      max-width: 15%;
      padding: 5px;
      border: 1px solid #ccc;
      height: auto;
      background: #fff;
      box-shadow: 1px 1px 7px rgba(0,0,0,0.1);
    }
 .thumbnails   h1 {
      font-size: 3em;
      line-height: 1;
      margin-bottom: 0.5em;
    }
  .thumbnails  p {
      margin-bottom: 1.5em;
    }
  .thumbnails  ul {
      list-style: none;
      margin-bottom: 1.5em;
    }
     .main-image {
      max-width: 80px;
      margin-bottom: 0.75em;
    }
    .thumbnails li {
      display: inline;
      margin: 0 5px 0 0;
    }
  </style>
  
  
  <style>
.history {
    height:  200px;
    overflow: scroll;
}
.conversation-item{
	width:100%;
}

</style>
<style>
@media (max-width: 600px) {
 .border{
	border:#CCCCCC solid 0.01px;
	color:black;
	 font: 150%/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.conversation-item{
	width:135%;
}
.text{
	font-size:14px;
}
.conversation-user{
	display:none;
}
}

@media (min-width: 600px) {
.hapusmobile{ display:none;}
}

</style>

  
  <?php
$this->db->where("kode_prop",$kode_prop);
$val=$this->db->get("data_property")->row();
$gambarUtama=isset($val->gambar_utama)?($val->gambar_utama):"";
if(!$gambarUtama){
//	echo "<h3><font color='red'>Listing has been remove</font></h3>";
//	return false;
}
			if(!$gambarUtama)
			{$gambarUtama="nopund.jpg";}else{
				$gambarUtama=$val->$gambarUtama;
			}
?>

  <div class="col-md-8">
 
  <div class="main-image" >
    <img  src="<?php echo base_url()?>/file_upload/img/<?php echo $gambarUtama;?>" alt="no-image" class="custom">
 
  </div>  

  <ul class="thumbnails">
<?php

if($val->gambar1)
{?>
		 <li><a target="_blank" href="<?php echo base_url()?>/file_upload/img/<?php echo $val->gambar1;?>"><img src="<?php echo base_url()?>/file_upload/img/<?php echo $val->gambar1;?>" alt="Thumbnails"></a></li>
<?php } ?>

<?php if($val->gambar2)
{?>
		 <li><a target="_blank" href="<?php echo base_url()?>/file_upload/img/<?php echo $val->gambar2;?>"><img src="<?php echo base_url()?>/file_upload/img/<?php echo $val->gambar2;?>" alt="Thumbnails"></a></li>
<?php } ?>

<?php
if($val->gambar3)
{?>
		 <li><a  target="_blank" href="<?php echo base_url()?>/file_upload/img/<?php echo $val->gambar3;?>"><img src="<?php echo base_url()?>/file_upload/img/<?php echo $val->gambar3;?>" alt="Thumbnails"></a></li>
<?php } ?>

<?php if($val->gambar4)
{?>
		 <li><a  target="_blank" href="<?php echo base_url()?>/file_upload/img/<?php echo $val->gambar4;?>"><img src="<?php echo base_url()?>/file_upload/img/<?php echo $val->gambar4;?>" alt="Thumbnails"></a></li>
<?php } ?>

<?php if($val->gambar5)
{?>
		 <li><a target="_blank" href="<?php echo base_url()?>/file_upload/img/<?php echo $val->gambar5;?>"><img src="<?php echo base_url()?>/file_upload/img/<?php echo $val->gambar5;?>" alt="Thumbnails"></a></li>
<?php } ?>
<?php if($val->desain)
{?>
		 <li><a target="_blank" href="<?php echo base_url()?>/file_upload/img/<?php echo $val->desain;?>"><img src="<?php echo base_url()?>/file_upload/img/<?php echo $val->desain;?>" alt="Thumbnails"></a></li>
<?php } ?>

   
  </ul>
</div>



<div class="col-md-4">
<!-------------------------->
 <div class="main-box clearfix">
 <header class="main-box-header clearfix">
 <h2 class="black sadow5">Progress</h2>
</header>
<div class="main-box-bodys clearfixs">
 
<div class='history'  >
 
</div>
 
 
 
</div>
</div>




<!-------------------------->
<div class="conversation-new-message">
<form action="javascript:simpan()" id="formL" >
<div class="form-group">
 <?php
                                        $ref_sert = $this->reff->getTitleListing();
                                        $array_sert[""] = "==== Pilih Katagori Report ====";
                                        foreach ($ref_sert as $vals) {
                                            $array_sert[$vals->id] = $vals->nama;
                                        }
                                        $data = $array_sert;
                                        echo form_dropdown('titleListing', $data, '', 'required id="titleListing" class="form-control" style="width:100%"');
                                        ?>
<textarea class="form-control" rows="2" name="textListing" id="textListing" placeholder="Enter your repport..." required></textarea>
</div>
<div class="clearfix">
<span class="msg pull-left"></span>
<button type="submit"  style="margin-top:-10px"  class="btn btn-success pull-right">Sent Report</button>
</div>
</form>
</div>
</div>
 <div class="clearfix">&nbsp;</div>



<div class="col-lg-12">
<style>
.border{
	border:#CCCCCC solid 0.01px;
	color:black;
	
}
.custom{
	max-width:500px; 
	max-height:300px; 
}
</style>
<style>
@media (max-width: 600px) {
 .border{
	border:#CCCCCC solid 0.01px;
	color:black;
	 font: 150%/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.custom{
	max-width:200px;max-height:250px;
}
}
</style>
<div class="list-group">
<a href="#" class="list-group-item active">
<b>Detail Information : <?php echo $val->kode_prop;?></b> 
 <span class='pull-right'> Entry Date :<?php echo $this->tanggal->ind($val->tgl_masuk_listing,"/"); ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Expired Date :
 <?php echo $this->tanggal->ind($val->tgl_expired,"/"); ?></span> 

</a>



<div class="main-box-body clearfix">
<div class="table-responsive">

<div class="col-md-6 border">Property : <?php echo $this->reff->getNamaJenis($val->jenis_prop); ?> di <?php echo $val->type_jual; ?> 
<span class="pull-right"> <?php  if($val->jenis_listing=="platinum"){ echo "<font color='gold'>PLATINUM</font>"; }else{ echo "GOLD";   };?></span></div>
<div class="col-md-6 border">Price :Rp <?php echo number_format($val->harga+$val->fee_up,0,",","."); ?>  
 
</div>
<?php
$hargaM2="";
if($val->jenis_prop==5)
{
$hargaM2=" - Harga Tanah = ".number_format($val->harga_tanah,0,",",".")." / M<sup>2</sup>  ";
}
?>
 
<div class="col-md-6 border">Vendor :<?php echo $this->reff->getNamaOwner($val->id_owner); ?> </div>
<div class="col-md-6 border">Member :<?php echo $this->reff->getNamaAgenByKode($val->agen);?></div>
<div class="col-md-6 border">Land : <?php echo $val->luas_tanah;?> M<sup>2</sup> <?php echo $hargaM2; ?>

</div>
<div class="col-md-6 border">Building : <?php echo $val->luas_bangunan;?> M<sup>2<sup></div>
<div class="col-md-6 border">KT : <?php echo  $val->kamar_tidur;?></div>
<div class="col-md-6 border">KTP : <?php echo  $val->kamar_tidur_p;?></div>
<div class="col-md-6 border">KM : <?php echo  $val->kamar_mandi;?></div>
<div class="col-md-6 border">KMP : <?php echo  $val->kamar_mandi_p;?></div>
<div class="col-md-6 border">Electricity : <?php echo  $val->daya_listrik;?> Watt</div>
<div class="col-md-6 border">Floor : <?php echo  $val->jml_lantai;?></div>
<div class="col-md-6 border">Status : <?php echo $this->reff->getNamaJenisSertifikat($val->jenis_sertifikat);?></div>
<div class="col-md-6 border">Furniture : <?php echo $this->reff->getNamaFurniture($val->furniture);?></div>
<div class="col-md-6 border">Garage : <?php echo  $val->jml_garasi;?></div>
<div class="col-md-6 border">Carport : <?php echo  $val->jml_carports;?></div>
<div class="col-md-6 border">Compas : <?php echo $this->reff->getNamaHadap($val->hadap);?></div>
<div class="col-md-6 border">Water : <?php echo $this->reff->getNamaAir($val->air);?> </div>


<?php
/*
if($val->type_jual=="sewa")
{?>
<div class="col-md-6 border">Type : <?php echo $this->reff->getNamaTypeSewa($val->type_sewa);?> </div>
<?php }*/ ?>






















<?php
/*
if(  $val->fee_persen)
{
echo '<div class="col-md-6 border">Fee (%) : '.$val->fee_persen.' %</div>';	
}
?><?php
if(  $val->fee_nominal)
{
echo '<div class="col-md-6 border">Markup <i class="fa fa-arrow-up"></i> : '.$val->fee_nominal.' </div>';	
}
?><?php
if(  $val->fee_up)
{
echo '<div class="col-md-6 border">Fee Up : '.number_format($val->fee_up,0,",",".").' </div>';	
}*/
?>



<div class="col-md-12 border"><center>Description</center>  <?php echo $val->desc;?></div>
<?php if($kom=$val->keterangan){?>
<div class="col-md-12 border"><center>Note</center> <?php echo $val->keterangan;?></div>
<?php } ?>
<div class="col-md-12 border"><center>Location</center>  

<?php echo $this->reff->getNamaKab($val->id_kab);?> - <?php echo $val->nama_area;?> - <?php echo $val->alamat_detail;?> <?php if($kom=$val->komplek){ echo "- Komplek : $kom ";}?></div>


</div>
</div>

</div>
</div>
 <center>
<a href="<?php echo base_url()?>data_property/word/?id=<?php echo $val->id_prop;?>" class="btn btn-danger"><i class="fa fa-file-word-o  "></i> Word</a>
</center>

  <script src="<?php echo base_url()?>plug/galery/dist/jquery.simpleGal.js"></script>
 
 
 




<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   $('.thumbnails').simpleGal({
      mainImage: '.custom'
    });
		
	getHistory();
	setTimeout(function(){   $('.history').scrollTop(100000000000000); }, 1000);
	});
	

	function getHistory()
	{		var id="<?php echo $id=$kode_prop; ?>";
			 $('.history').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Mohon Tunggu ... ");
	            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url();?>data_property/getHistory/",
                data: "id=" + id,
                success: function (data) {
			       $(".history").html(data);
				    $('.history').scrollTop(100000000000000);
                }
            });
	}
	
	</script>
	<script>
	function simpan()
	{		
			var title = $("[name='titleListing']").val();
			var text = $("[name='textListing']").val();
			var id="0";
			var kode_listing="<?php echo $id; ?>";
			$('.msg').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Mohon Tunggu ... ");
	            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>data_property/saveReport/",
                data: "id=" + id+"&title="+title+"&text="+text+"&kode_listing="+kode_listing,
                success: function (data) {
					getHistory();
					$("#formL")[0].reset();
		            $(".msg").html("");
                }
            });
	}
	
	function hapus(id)
	{
		        $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url();?>data_property/delHistory/"+id,
                success: function (data) {
			     getHistory();
                }
            });
	}
	
	</script>