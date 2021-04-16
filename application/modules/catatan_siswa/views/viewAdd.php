<div class="row clearfix">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">KEPADA</label>
    </div>
    <div class="col-lg-8 col-md-8  ">
        <div class="form-group">
            <div class="form-line">
                <input id="md_checkbox_22" class="filled-in chk-col-red" name='f[id_jenis]' value='1' type="radio" checked>
                <label for="md_checkbox_22" class='col-black'>Pegawai&nbsp;&nbsp;&nbsp;</label>

                <input id="md_checkbox_21" class="filled-in chk-col-red" name='f[id_jenis]' value='2' type="radio">
                <label for="md_checkbox_21" class='col-black'>Sekolah&nbsp;&nbsp;&nbsp;</label>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$("input[name='f[id_jenis]']").click(function(){
		var inp_jenis = $("input[name='f[id_jenis]']:checked").val();
		//alert(inp_jenis);
		if (inp_jenis=="1") {
			$("#row_pegawai").show();
		}
		else{
			$("#row_pegawai").hide();
            $("#id_guru").val("");
            $("#id_guru").trigger("change");

		}
	});
</script>

<div class="row clearfix" id="row_pegawai">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">NAMA PEGAWAI</label>
    </div>
    <div class="col-lg-8 col-md-8  ">
        <div class="form-group">
            <div class="form-line" id="data_pegawai">
                <select class="form-control show-tick" data-live-search="true" name="f[id_guru]" id="id_guru">
                    <option>=== Pilih ===</option>
                    <?php 
                    	$this->db->order_by("nama", "ASC");
                    	$pg = $this->db->get("data_pegawai")->result();
                    	foreach ($pg as $vpg) {
                    		echo "<option value='".$vpg->nip."'>".$vpg->nama."</option>";
                    	}
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">IDENTITAS </label>
    </div>
    <div class="col-lg-8 col-md-8  ">
        <div class="form-group">
            <div class="form-line">
                <input id="p1" class="filled-in chk-col-red" name='f[privacy]' value='1' type="radio" checked>
                <label for="p1" class='col-black'>Tampilkan&nbsp;&nbsp;&nbsp;</label>

                <input id="p2" class="filled-in chk-col-red" name='f[privacy]' value='2' type="radio">
                <label for="p2" class='col-black'>Sembunyikan&nbsp;&nbsp;&nbsp;</label>
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

<script>

</script>

<script>
    $('select').selectpicker();
</script>