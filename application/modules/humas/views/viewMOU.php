<?php $database=$this->db->get_where("tr_mitra",array("id"=>$this->input->post("id")))->row();  ?>




<?php

    $this->db->order_by("nama", "asc");
    $qp = $this->db->get("data_pegawai")->result();

    $sel_pegawai = "<option value=''>== PILIH ==</option>";
    foreach ($qp as $p) {
        $sel_pegawai .= "<option value='".$p->id."'>".$p->nama."</option>";
    }

?>




<input type="hidden" name="id" value="<?php echo $database->id;?>"> 
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label for="f[mou]">Upload File MOU</label>
                <div class="form-line">
                    <input type="file" class="form-control"   name="mou" />
                </div>
            </div>
            <div class="form-group">
                <label for="f[no_mou]">No. MOU</label>
                <div class="form-line">
                    <input type="text" class="form-control"  name="f[no_mou]" />
                </div>
            </div>
            <div class="form-group">
                <label for="f[judul_mou]">Judul MOU</label>
                <div class="form-line">
                    <input type="text" class="form-control"  name="f[judul_mou]" />
                </div>
            </div>
            <div class="form-group">
                <label for="f[judul_mou]">Tgl Awal MOU</label>
                <div class="form-line">
                    <input type="text" class="form-control"  name="f[tgl_awal_mou]" id="tgl_awal_mou" />
                </div>
            </div>
            <div class="form-group">
                <label for="f[judul_mou]">Tgl Akhir MOU</label>
                <div class="form-line">
                    <input type="text" class="form-control"  name="f[tgl_akhir_mou]" id="tgl_akhir_mou" />
                </div>
            </div>
            <div class="form-group">
                <label for="f[mou]">Quota</label>
                <div class="form-line">
                    <input type="text" class="form-control" required name="f[quota]" />
                </div>
            </div>
            <div class="form-group">
                <label for="f[mou]">Lama PKL (Bulan)</label>
                <div class="form-line">
                    <input type="number" class="form-control" required name="f[lama_pkl]" />
                </div>
            </div>
            <div class="form-group">
                <label for="f[mou]">Tanggal Pemberangkatan</label>
                <div class="form-line">
                    <input type="text" class="form-control" id="tgl_berangkat" name="tgl_berangkat" required />
                </div>
            </div>
            <div class="form-group">
                <label for="f[mou]">Pembimbing</label>
                <div class="form-line">
                    <select class="form-control show-tick" data-live-search="true" name="f[id_pembimbing]" id="mou_id_pembimbing">
                        <?php echo $sel_pegawai ?>
                    </select>
                </div>
            </div>
        <!--     <div class="form-group">
                <label for="f[mou]">Ket</label>
                <div class="form-line">
                    <textarea type="text" class="form-control" name="f[ket]" ></textarea>
                </div>
            </div>--->
        </div>
    </div>
<script type="text/javascript">
    $('#tgl_berangkat').daterangepicker({
        //maxDate: new Date(),
        "singleDatePicker": true,
        "showDropdowns": true,
        "dateLimit": {
            "days": 7
        },
        "autoApply": false,
        "drops": "down",
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "MIN",
                "SEN",
                "SEL",
                "RAB",
                "KAM",
                "JUM",
                "SAB"
            ],
            "monthNames": [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Augustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ],
            "firstDay": 1
        },
        "showCustomRangeLabel": false,
        "startDate": "<?php echo date("d/m/Y") ?>",   
    });

    $('#tgl_akhir_mou').daterangepicker({
        //maxDate: new Date(),
        "singleDatePicker": true,
        "showDropdowns": true,
        "dateLimit": {
            "days": 7
        },
        "autoApply": false,
        "drops": "down",
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "MIN",
                "SEN",
                "SEL",
                "RAB",
                "KAM",
                "JUM",
                "SAB"
            ],
            "monthNames": [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Augustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ],
            "firstDay": 1
        },
        "showCustomRangeLabel": false,
        "startDate": "<?php echo date("d/m/Y") ?>",   
    });

    $('#tgl_awal_mou').daterangepicker({
        //maxDate: new Date(),
        "singleDatePicker": true,
        "showDropdowns": true,
        "dateLimit": {
            "days": 7
        },
        "autoApply": false,
        "drops": "down",
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "MIN",
                "SEN",
                "SEL",
                "RAB",
                "KAM",
                "JUM",
                "SAB"
            ],
            "monthNames": [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Augustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ],
            "firstDay": 1
        },
        "showCustomRangeLabel": false,
        "startDate": "<?php echo date("d/m/Y") ?>",   
    });

    function toTglSys(v){
        //02-12-1996
        //0123456789

        var tgl = v.substr(0,2);
        var bln = v.substr(3,2);
        var thn = v.substr(6,4);

        var value = thn+"-"+bln+"-"+tgl;

        return value;
    }
</script>
