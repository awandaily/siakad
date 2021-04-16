<?php  
    $this->db->where("sts_kelas",1);
	$this->db->order_by("nama", "asc");
	$fk = $this->db->get("v_kelas")->result();
	$opk = "";
	foreach ($fk as $vfk) {
		$opk.="<option value='".$vfk->id."'>".$vfk->nama."</option>";
	}

?>


<div class="row clearfix">
    <!-- Task Info -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card" >
            <div class="header">
            	<div class="row">
            		<div class="col-md-6 col-md-6">
	            		<h2>FORMAT PRESENSI SISWA</h2>
	            	</div>
            		<div class="col-md-4 col-sm-4">
	            		<select class="form-control show-tick" data-live-search="true" id="fkelas">
	            			<option value="">=== PILIH KELAS ===</option>
	            			<?php echo $opk; ?>
	            		</select>
	            	</div>
	            	<div class="col-md-2 col-sm-2">
	            		<a href="javascript:void(0)" class="btn waves-effect bg-teal" style="float:right" onclick="get_kelas()">
	            			<i class="material-icons">search</i> CARI
	            		</a>
	            	</div>
            	</div>
            </div>
            <div class="body" id="frame_1">
            	<iframe src="" style="width: 100%;min-height: 800px;" id="fr"></iframe>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	function get_kelas(){
		//alert("ada");
		loading("frame_1");
		var id = $("#fkelas").val();
		if (id!=="") {
			$("#fr").attr("src", "<?php echo base_url() ?>presensi/format_siswa_pdf?id="+id);
			setTimeout(function(){ unblock("frame_1"); }, 5000);
		}
		else{
			$("#fr").attr("src", "");
		}
		
	}
</script> 