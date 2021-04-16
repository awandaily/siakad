<?php

	$id = $_POST["id"];

    $this->db->where("id", $id);
	$d = $this->db->get("data_buku")->row_array();

    $nm     = $d["nama_buku"];
    $png    = $d["pengarang"];
    $pnb    = $d["penerbit"];
    $jml    = $d["jml_halaman"];
    $tag    = $d["tag"];
    $kt     = $d["id_kategori"];
    $rk     = $d["id_rak"];
    $thn    = $d["tahun_perolehan"];
    $asl    = $d["asal_perolehan"];
    $baik   = $d["qty_baik"];
    $rusak  = $d["qty_rusak"];
    $hrg    = $d["harga"];
    $sns    = $d["sinopsis"];
    $kd     = $d["barcode"];


    if ($d["pinjam"] == "1") {
		$pinjam = "<label class='label label-primary'>Bisa Dipinjam</label>";
	}
	else{
		$pinjam = "<label class='label label-danger'>Tidak Bisa Dipinjam</label>";
	}

	if ($d["tag"] != "") {
		$extg = explode(",", $d["tag"]);
		$tg = "";
		for($i=0;$i<count($extg);$i++){
			$tg.="<label class='label label-info'>".$extg[$i]."</label> ";
		}
	}
	else{
		$tg = "";
	}

	if ($d["cover"] != "") {
		$img = $d["cover"];
	}
	else{
		$img = "no_img.jpg";
	}

	
?>

<div class="col-md-12 col-sm-12">
	<center><img src="<?php echo base_url() ?>file_upload/cover/<?php echo $img ?>" class="img-responsive" style="width:140px;"></center>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group" >
		<label>Kode Buku</label><br>
		<?php echo $kd ?>

	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Nama Buku</label><br>
		<?php echo $nm ?>

	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Kategori</label><br>
		<?php echo $this->m_reff->goField("data_kategori", "nama_kategori", " WHERE id_kategori='".$kt."' "); ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Posisi Rak</label><br>
		<?php echo $this->m_reff->goField("data_rak", "nama_rak", " WHERE id_rak='".$rk."' "); ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Pengarang</label><br>
		<?php echo $png ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Penerbit</label><br>
		<?php echo $pnb ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Asal Perolehan</label><br>
		<?php echo $asl ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Tahun Perolehan</label><br>
		<?php echo $thn ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Qty Baik</label><br>
		<?php echo $baik ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Qty Rusak</label><br>
		<?php echo $rusak ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Jumlah Buku</label><br>
		<?php echo $baik+$rusak ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Harga</label><br>
		<?php echo $hrg ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Boleh Dipinjam ?</label><br>
		<?php echo $pinjam ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Jumlah Halaman</label><br>
		<?php echo $d["jml_halaman"] ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Tag</label><br>
		<?php echo $tg; ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12">
	<div class="form-group">
		<label>Banyak dipinjam</label><br>
		<?php echo $this->mdl_buku->dipinjam($kd); ?> Kali
	</div>
	<br>
</div>
<div class="col-md-12 col-sm-12">
	<div class="form-group">
		<label>Sinopsis</label><br>
		<?php echo $sns; ?>
	</div>
	<br>
</div>