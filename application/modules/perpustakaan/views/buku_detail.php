<?php
	$this->perpus = $this->load->database("perpus",TRUE);

	$id = $_POST["id"];

    $this->perpus->where("id", $id);
	$d = $this->perpus->get("v_buku")->row_array();

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
    $hrg    = number_format($d["harga"], 0, ',', '.');
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
		$img = "no_img2.jpg";
	}

	
?>

<div class="col-md-12 col-sm-12">
	<center><img src="<?php echo base_url() ?>perpus/file_upload/cover/<?php echo $img ?>" class="img-responsive" style="width:140px;"></center>
	<br>
</div>
<div class="col-md-6 col-sm-12 col-xs-6">
	<div class="form-group" >
		<label>Kode Buku</label><br>
		<?php echo $kd ?>

	</div>
	<br>
</div>
<div class="col-md-6 col-sm-12 col-xs-6">
	<div class="form-group">
		<label>Nama Buku</label><br>
		<?php echo $nm ?>

	</div>
	<br>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
	<div class="form-group">
		<label>Kategori</label><br>
		<?php echo $this->m_reff->goField("data_kategori", "nama_kategori", " WHERE id_kategori='".$kt."' ", "perpus"); ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
	<div class="form-group">
		<label>Posisi Rak</label><br>
		<?php echo $this->m_reff->goField("data_rak", "nama_rak", " WHERE id_rak='".$rk."' ", "perpus"); ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
	<div class="form-group">
		<label>Pengarang</label><br>
		<?php echo $png ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
	<div class="form-group">
		<label>Penerbit</label><br>
		<?php echo $pnb ?>
	</div>
	<br>
</div>

<div class="col-md-6 col-sm-6 col-xs-6">
	<div class="form-group">
		<label>Stok Tersedia</label><br>
		<?php echo $d["stok"] ?> Pcs
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
	<div class="form-group">
		<label>Boleh Dipinjam ?</label><br>
		<?php echo $pinjam ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
	<div class="form-group">
		<label>Jumlah Halaman</label><br>
		<?php echo $d["jml_halaman"] ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
	<div class="form-group">
		<label>Tag</label><br>
		<?php echo $tg; ?>
	</div>
	<br>
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
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