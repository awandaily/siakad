<?php $database=$this->db->get_where("tm_catatan_siswa",array("id"=>$this->input->post("id")))->row();  ?>		
<input type="hidden" name="id" value="<?php echo $database->id;?>"> 

<?php  
	
	$guru = $database->id_guru;
	if ($guru!=0) {
		$c1 = "checked";
		$c2 = "";
	}
	else{
		$c1 = "";
		$c2 = "checked";
	}

	$privacy = $database->privacy;
	if ($privacy!=2) {
		$p1 = "checked";
		$p2 = "";
	}
	else{
		$p1 = "";
		$p2 = "checked";
	}

?>

<div class="row clearfix">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">KEPADA</label>
    </div>
    <div class="col-lg-8 col-md-8  ">
        <div class="form-group">
            <div class="form-line">
                <input id="md_checkbox_222" class="filled-in chk-col-red" name='f[id_jenis]' value='1' type="radio" <?php echo $c1 ?>>
                <label for="md_checkbox_222" class='col-black'>Pegawai&nbsp;&nbsp;&nbsp;</label>

                <input id="md_checkbox_211" class="filled-in chk-col-red" name='f[id_jenis]' value='2' type="radio" <?php echo $c2 ?>>
                <label for="md_checkbox_211" class='col-black'>Sekolah&nbsp;&nbsp;&nbsp;</label>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

	var g = "<?php echo $guru ?>";

	if (g !== "0") {
		$("#row_pegawai").show();
	}
	else{
		$("#row_pegawai").hide();
		$("#id_guru").val("");
		$("#id_guru").trigger("change");

	}


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

<div class="row clearfix " id="row_pegawai">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">NAMA PEGAWAI</label>
    </div>
    <div class="col-lg-8 col-md-8  ">
        <div class="form-group">
            <div class="form-line" id="data_pegawai">
                <select class="form-control show-tick" data-live-search="true" name="f[id_guru]" id="id_guru">
                    <option value="">=== Pilih ===</option>
                    <?php 
                    	$this->db->order_by("nama", "ASC");
                    	$pg = $this->db->get("data_pegawai")->result();
                    	foreach ($pg as $vpg) {
                    		if ($vpg->nip == $guru) {
                    			echo "<option value='".$vpg->nip."' selected>".$vpg->nama."</option>";	
                    		}
                    		else{
                    			echo "<option value='".$vpg->nip."'>".$vpg->nama."</option>";
                    		}

                    		
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
                <input id="p1" class="filled-in chk-col-red" name='f[privacy]' value='1' type="radio" <?php echo $p1 ?>>
                <label for="p1" class='col-black'>Tampilkan&nbsp;&nbsp;&nbsp;</label>

                <input id="p2" class="filled-in chk-col-red" name='f[privacy]' value='2' type="radio" <?php echo $p2 ?>>
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
                <textarea class="form-control" required name="f[ket]"><?php echo $database->ket ?></textarea>
            </div>
        </div>
    </div>
</div>

<script>

</script>

<script>
    $('select').selectpicker();
</script>