<div class="row clearfix">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">PILIH KELAS</label>
    </div>
    <div class="col-lg-8 col-md-8  ">
        <div class="form-group">
            <div class="form-line">
                <select class="form-control show-tick" required name="f[id_kelas]" data-live-search="true" onchange="pilsiswa()">
                    <option value="">=== Pilih ===</option>

                    <?php 
										   $db=$this->db->get("tr_tingkat")->result();
										   foreach($db as $val){
											   echo "<optgroup label='TINGKAT ".$val->nama."'>";

												   $dbs=$this->db->get_where("v_kelas",array("id_tk"=>$val->id))->result();
												   foreach($dbs as $vals){
													   echo "<option value='".$vals->id."'>".$vals->nama."</option>";
												   }

											   echo "</optgroup>";
										   }
										   ?>

                </select>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">NAMA SISWA</label>
    </div>
    <div class="col-lg-8 col-md-8  ">
        <div class="form-group">
            <div class="form-line" id="data_siswa">
                <select class="form-control" required>
                    <option>=== Pilih ===</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!--		<div class="row clearfix">
                                    <div class="col-lg-3 col-md-3  form-control-label">
                                        <label for="email_address_2" class="col-black">JENIS CATATAN</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">

										$ray="";
										$ray[]="=== Pilih ===";
										$data=$this->db->get("tr_jenis_catatan")->result();
										foreach($data as $val){
											$ray[$val->id]=$val->nama;
										}
										$dataray=$ray;
										echo form_dropdown("f[id_jenis]",$dataray,"","class='form-control show-tick' id='id_mapel' ");?>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

<div class="row clearfix">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">TERUSKAN KE </label>
    </div>
    <div class="col-lg-8 col-md-8  ">

        <div class="form-group">
            <div class="form-line">
                <input id="md_checkbox_20" class="filled-in chk-col-red" value='' type="checkbox" checked="" disabled="">
                <label for="md_checkbox_20" class='col-black'>Wali Kelas&nbsp;&nbsp;&nbsp;</label>
                <input id="md_checkbox_23" class="filled-in chk-col-red" name='t[]' value='2' type="checkbox">
                <label for="md_checkbox_23" class='col-black'>Orang Tua&nbsp;&nbsp;&nbsp;</label>
                <input id="md_checkbox_24" class="filled-in chk-col-red" name='t[]' value='3' type="checkbox">
                <label for="md_checkbox_24" class='col-black'>Siswa&nbsp;&nbsp;&nbsp;</label>

            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">KETERANGAN </label>
    </div>
    <div class="col-lg-8 col-md-8  ">
        <div class="form-group">
            <div class="form-line">
                <textarea class="form-control" required name="f[ket]"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">UPLOAD BUKTI </label>
    </div>
    <div class="col-lg-8 col-md-8  ">
        <div class="form-group">
            <div class="form-line">
                <input type="file" name="bukti" class="form-control" />
            </div>
        </div>
    </div>
</div>

<script>
    function pilsiswa() {
        var idk = $("[name='f[id_kelas]']").val();
        $.post("<?php echo site_url("catatan/getSiswa "); ?>", {
                idk: idk
            },
            function(data) {
                $("#data_siswa").html(data);
            });
    }
</script>

<script>
    //$('select').selectpicker();
</script>