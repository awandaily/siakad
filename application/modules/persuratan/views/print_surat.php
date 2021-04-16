 <?php
 	$token=date('His');
 ?>

<?php
    $surat = "";
    foreach ($dt as $v) {
        $surat.="<option value='".$v->id."'>".$v->nama_surat."</option>";
    }
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	 	<div class="card" >
            <div class="header" style="padding: 20px;">
            	<div class="row">
                    <div class="col-sm-4">
                        <h2 style="padding-top: 10px;">PRINT SURAT</h2>
                    </div>
                       
                </div>
            </div>

            <div class="body" >
                <div class="row" style="padding: 20px;">
                    <div class="col-sm-6">
                        <select class="form-control show-tick" id="surat" data-live-search="true">
                            <option value="">== PILIH SURAT ==</option>
                            <?php echo $surat ?>
                        </select>        
                    </div>
                    <div class="col-sm-6">
                        <button class="btn-block aves-effect btn bg-teal" style="width: 110px;" onclick="search()">
                            <i class="material-icons">search</i> PREVIEW
                        </button>
                    </div>
                    <div class="col-md-12" id="surat-form"></div>
            	</div>
            </div>
        </div>
	</div>
</div>

<script type="text/javascript">
    function search(){
        loading("surat-form");
        var id = $("#surat").val();
        $.post("<?php echo base_url() ?>persuratan/getForm", {id:id}, function(data){
            $("#surat-form").html(data);
            

            //load select
            //setTimeout(function(){  }, 3000);
            getSiswa();
            getPegawai();
            unblock("surat-form");
        });



    }

    function getPegawai(){
        $.post("<?php echo base_url() ?>persuratan/getPegawai", {id:""}, function(data){
            $("#sel_pegawai").html(data);
            $(".show-tick").selectpicker();
        });
    }

    function getSiswa(){
        $.post("<?php echo base_url() ?>persuratan/getSiswa", {id:""}, function(data){
            $("#sel_siswa").html(data);
            $(".show-tick").selectpicker();
        });
    }

</script>

                           