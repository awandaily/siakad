<?php $database=$this->db->get_where("tm_catatan",array("id"=>$this->input->post("id")))->row();  ?>
<input type="hidden" name="id" value="<?php echo $database->id;?>"> 

<?php  
    if ($database->status_wk == "") {
        $stwk = "<span class='label label-default'>Belum Ditanggapi</span>";
        $twk = "-";
    }
    else{
        if ($database->status_wk == "Open") {
            $stwk = "<span class='label label-info'>Open</span>";
        }
        else{
            $stwk = "<span class='label label-danger'>Close</span>";
        }

        $twk = $database->tanggapan_wk;
    }

    if ($database->status_bp == "") {
        $stbp = "<span class='label label-default'>Belum Ditanggapi</span>";
        $tbp = "-";
    }
    else{
        if ($database->status_bp == "Open") {
            $stbp = "<span class='label label-info'>Open</span>";
        }
        else{
            $stbp = "<span class='label label-danger'>Close</span>";
        }

        $tbp = $database->tanggapan_bp;
    }

    if ($database->status_ks == "") {
        $stks = "<span class='label label-default'>Belum Ditanggapi</span>";
        $tks = "-";
    }
    else{
        if ($database->status_ks == "Open") {
            $stks = "<span class='label label-info'>Open</span>";
        }
        else{
            $stks = "<span class='label label-danger'>Close</span>";
        }

        $tks = $database->tanggapan_ks;
    }
?>

<div class="row clearfix">
    <div class="col-md-12">
        <div class="form-group">
            <label><h4>Wali Kelas</h4></label><br>
            Status <br>
            <?php echo $stwk ?><br>
            <br>
            Tanggapan <br>
            <p><?php echo $twk; ?></p>
        </div>
        <div class="form-group">
            <label><h4>Guru BP</h4></label><br>
            Status <br>
            <?php echo $stbp ?><br>
            <br>
            Tanggapan <br>
            <p><?php echo $tbp; ?></p>
        </div>
        <div class="form-group">
            <label><h4>Kepala Sekolah</h4></label><br>
            Status <br>
            <?php echo $stks ?><br>
            <br>
            Tanggapan <br>
            <p><?php echo $tks; ?></p>
        </div>
    </div>
</div>

<script>
    $('select').selectpicker();
</script>