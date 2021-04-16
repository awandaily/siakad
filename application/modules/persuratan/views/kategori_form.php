
<?php
    
    $id = $_POST["id"];

    if ($id!="") {
        $this->db->where("id_kategori", $id);
        $d = $this->db->get("data_kategori")->row_array();

        $nama_kategori  = $d["nama_kategori"];
        $ket            = $d["keterangan"];
    }
    else{
        $nama_kategori  = "";
        $ket            = "";
    }

?>

<div class="form-group">
    <label>Nama Kategori</label><br>
    <input type="text" class="form-control" name="f[nama_kategori]" autofocus="" required="" value="<?php echo $nama_kategori ?>">
</div>
<div class="form-group">
    <label>Keterangan</label><br>
    <textarea class="form-control" name="f[keterangan]"><?php echo $ket ?></textarea>
</div>
