<?php $database=$this->db->get_where("tm_catatan",array("id"=>$this->input->post("id")))->row();  ?>
<input type="hidden" name="id" value="<?php echo $database->id;?>"> 

<?php  
    if ($database->status_wk == "") {
        $stwk = "<span class='label label-default'>Belum Ditanggapi</span>";
        $twk = "-";
        $nm_wk = "";
    }
    else{
        if ($database->status_wk == "Open") {
            $stwk = "<span class='label label-info'>Open</span>";
        }
        else{
            $stwk = "<span class='label label-danger'>Close</span>";
        }

        if ($database->id_wk == "") {
            $nm_wk = "";
        }
        else{
            $nm_wk = " - ".$this->m_reff->goField('data_pegawai', 'nama', 'where id="'.$database->id_wk.'" ')
                    ." ".$this->m_reff->goField('data_pegawai', 'gelar_belakang', 'where id="'.$database->id_wk.'" ');
        }

        $twk = $database->tanggapan_wk;
    }

    if ($database->status_pr == "") {
        $stpr = "<span class='label label-default'>Belum Ditanggapi</span>";
        $tpr = "-";
        $nm_pr = "";
    }
    else{
        if ($database->status_pr == "Open") {
            $stpr = "<span class='label label-info'>Open</span>";
        }
        else{
            $stpr = "<span class='label label-danger'>Close</span>";
        }

        if ($database->id_pr == "") {
            $nm_pr = "";
        }
        else{
            $nm_pr = " - ".$this->m_reff->goField('data_pegawai', 'nama', 'where id="'.$database->id_pr.'" ')
                    ." ".$this->m_reff->goField('data_pegawai', 'gelar_belakang', 'where id="'.$database->id_pr.'" ');
        }

        $tpr = $database->tanggapan_pr;
    }

    if ($database->status_bp == "") {
        $stbp = "<span class='label label-default'>Belum Ditanggapi</span>";
        $tbp = "-";
        $nm_bp = "";
    }
    else{
        if ($database->status_bp == "Open") {
            $stbp = "<span class='label label-info'>Open</span>";
        }
        else{
            $stbp = "<span class='label label-danger'>Close</span>";
        }

        if ($database->id_bp == "") {
            $nm_bp = "";
        }
        else{
            $nm_bp = " - ".$this->m_reff->goField('data_pegawai', 'nama', 'where id="'.$database->id_bp.'" ')
                    ." ".$this->m_reff->goField('data_pegawai', 'gelar_belakang', 'where id="'.$database->id_bp.'" ');
        }

        $tbp = $database->tanggapan_bp;
    }

    if ($database->status_kes == "") {
        $stkes = "<span class='label label-default'>Belum Ditanggapi</span>";
        $tkes = "-";
        $nm_kes = "";
    }
    else{
        if ($database->status_kes == "Open") {
            $stkes = "<span class='label label-info'>Open</span>";
        }
        else{
            $stkes = "<span class='label label-danger'>Close</span>";
        }

        if ($database->id_kes == "") {
            $nm_kes = "";
        }
        else{
            $nm_kes = " - ".$this->m_reff->goField('data_pegawai', 'nama', 'where id="'.$database->id_kes.'" ')
                    ." ".$this->m_reff->goField('data_pegawai', 'gelar_belakang', 'where id="'.$database->id_kes.'" ');
        }

        $tkes = $database->tanggapan_kes;
    }

    if ($database->status_ks == "") {
        $stks = "<span class='label label-default'>Belum Ditanggapi</span>";
        $tks = "-";
        $nm_ks = "";
    }
    else{
        if ($database->status_ks == "Open") {
            $stks = "<span class='label label-info'>Open</span>";
        }
        else{
            $stks = "<span class='label label-danger'>Close</span>";
        }

        if ($database->id_ks == "") {
            $nm_ks = "";
        }
        else{
            $nm_ks = " - ".$this->m_reff->goField('data_pegawai', 'nama', 'where id="'.$database->id_ks.'" ')
                    ." ".$this->m_reff->goField('data_pegawai', 'gelar_belakang', 'where id="'.$database->id_ks.'" ');
        }

        $tks = $database->tanggapan_ks;
    }
?>

<div class="row clearfix">
    <div class="col-md-12">
        <div class="form-group">
            <label><h4>Wali Kelas <?php echo $nm_wk; ?></h4></label><br>
            Status <br>
            <?php echo $stwk ?><br>
            <br>
            Tanggapan : <br>
            <p><i><?php echo $twk; ?></i></p>
        </div>
        <hr>
        <div class="form-group">
            <label><h4>Kaprodi <?php echo $nm_pr; ?></h4></label><br>
            Status <br>
            <?php echo $stpr ?><br>
            <br>
            Tanggapan : <br>
            <p><i><?php echo $tpr; ?></i></p>
        </div>
        <hr>
        <div class="form-group">
            <label><h4>Guru BP <?php echo $nm_bp; ?></h4></label><br>
            Status <br>
            <?php echo $stbp ?><br>
            <br>
            Tanggapan : <br>
            <p><i><?php echo $tbp; ?></i></p>
        </div>
        <hr>
        <div class="form-group">
            <label><h4>Wakil Kepala Sekolah Bidang Kesiswaan <?php echo $nm_kes; ?></h4></label><br>
            Status <br>
            <?php echo $stkes ?><br>
            <br>
            Tanggapan : <br>
            <p><i><?php echo $tkes; ?></i></p>
        </div>
        <hr>
        <div class="form-group">
            <label><h4>Kepala Sekolah</h4></label><br>
            Status <br>
            <?php echo $stks ?><br>
            <br>
            Tanggapan : <br>
            <p><i><?php echo $tks; ?></i></p>
        </div>
    </div>
</div>

<script>
    $('select').selectpicker();
</script>