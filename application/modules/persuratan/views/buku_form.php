
<?php
    
    $id = $_POST["id"];

    if ($id!="") {
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
            $slc_pinjam1 = "selected";
            $slc_pinjam2 = "";
        }
        else{
            $slc_pinjam1 = "";
            $slc_pinjam2 = "selected";
        }
    }
    else{
        $nm     = "";
        $png    = "";
        $pnb    = "";
        $jml    = "";
        $tag    = "";
        $kt     = "";
        $rk     = "";
        $thn    = "";
        $asl    = "";
        $baik   = "";
        $rusak  = "";
        $hrg    = "";
        $sns    = "";
        $kd     = "";

        $slc_pinjam1 = "";
        $slc_pinjam2 = "";

    }



    $this->db->where("_del", "0");
    $this->db->order_by("nama_kategori", "asc");
    $qk = $this->db->get("data_kategori")->result();
    $sel_kategori = "";
    foreach ($qk as $vqk) {
        if ($kt == $vqk->id_kategori) {
            $sel_kategori.="<option value='".$vqk->id_kategori."' selected>".$vqk->nama_kategori."</option>";
        }
        else{
            $sel_kategori.="<option value='".$vqk->id_kategori."'>".$vqk->nama_kategori."</option>";
        }
        
    }

    $this->db->where("_del", "0");
    $this->db->where("penyimpanan", "1");
    $this->db->order_by("nama_rak", "asc");
    $qr = $this->db->get("data_rak")->result();
    $sel_rak = "";
    foreach ($qr as $vqr) {
        if ($rk == $vqr->id_rak) {
            $sel_rak.="<option value='".$vqr->id_rak."' selected>".$vqr->nama_rak."</option>";
        }
        else{
            $sel_rak.="<option value='".$vqr->id_rak."'>".$vqr->nama_rak."</option>";
        }
        
    }

?>

<style type="text/css">
    .bootstrap-tagsinput{
        border: 1px solid #ccc !important;
        border-radius: 0px;
    }
</style>
<div class="col-md-6 col-sm-12">
    <div class="form-group">
        <label>Cover</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <br>
</div>
<div class="col-md-6 col-sm-12">
    <div class="form-group">
        <label>Kode Buku</label>
        <input type="text" class="form-control" name="f[barcode]" required="" value="<?php echo $kd ?>">
    </div>
    <br>
</div>
<div class="col-md-6 col-sm-12">
    <div class="form-group">
        <label>Nama Buku</label><br>
        <input type="text" class="form-control" name="f[nama_buku]" autofocus="" required="" value="<?php echo $nm ?>">
    </div>
    <br>
    <div class="form-group">
        <label>Kategori</label><br>
        <select class="form-control show-tick" data-live-search="true" name="f[id_kategori]" required="">
            <option value="">== PILIH KATEGORI ==</option>
            <?php echo $sel_kategori; ?>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label>Penerbit</label><br>
        <input type="text" class="form-control" name="f[penerbit]" value="<?php echo $pnb ?>">
    </div>
    <br>
    <div class="form-group">
        <label>Asal Perolehan</label><br>
        <input type="text" class="form-control" name="f[asal_perolehan]" value="<?php echo $asl ?>">
    </div>
    <br>
    <div class="form-group">
        <label>Qty Baik</label><br>
        <input type="number" class="form-control" name="f[qty_baik]" value="<?php echo $baik ?>">
    </div>
    <br>
    <div class="form-group">
        <label>Tag</label><br>
        <input type="text" class="form-control" data-role="tagsinput" id='tags' name="f[tag]" value="<?php echo $tag ?>" placeholder="Contoh : Kecantikan">
    </div>
    <br>
    <div class="form-group">
        <label>Bisa dipinjam ?</label><br>
        <select name="f[pinjam]" class="form-control">
            <option value="1" <?php echo $slc_pinjam1; ?>>Bisa</option>
            <option value="0" <?php echo $slc_pinjam2; ?>>Tidak bisa</option>
        </select>
    </div>
    <br>
</div>



<div class="col-md-6 col-sm-12">
    <div class="form-group">
        <label>Posisi</label><br>
        <select class="form-control show-tick" data-live-search="true" name="f[id_rak]" required="">
            <option value="">== PILIH POSISI ==</option>
            <?php echo $sel_rak; ?>
        </select>
    </div>
    <br>
    <div class="form-group">
        <label>Pengarang</label><br>
        <input type="text" class="form-control" name="f[pengarang]"  value="<?php echo $png ?>">
    </div>
    <br>
    <div class="form-group">
        <label>Jumlah Halaman</label><br>
        <input type="number" class="form-control" name="f[jml_halaman]"  value="<?php echo $jml ?>">
    </div>
    <br>
    <div class="form-group">
        <label>Tahun Perolehan</label><br>
        <input type="text" class="form-control" name="f[tahun_perolehan]" value="<?php echo $thn ?>">
    </div>
    <br>
    <div class="form-group">
        <label>Qty Rusak</label><br>
        <input type="number" class="form-control" name="f[qty_rusak]" value="<?php echo $rusak ?>">
    </div>
    <br>
    <div class="form-group">
        <label>Harga</label><br>
        <input type="number" class="form-control" name="f[harga]" value="<?php echo $hrg ?>">
    </div>
   
</div>

<div class="col-md-12 col-sm-12">
    <div class="form-group">
        <label>Sinopsis</label>
        <textarea class="form-control" name="f[sinopsis]" style="height: 200px;resize: none"><?php echo $sns ?></textarea>
    </div>
</div>

<script type="text/javascript">
    $("#tags").tagsinput();
</script>



