

<div class="card">
	<div class="header">
        <h2>EDIT BESARAN SPP</h2>
    </div>
    <div class="body">
    	<form method="post" id="form-siswa">

	    	<div class="row" style="padding: 10px;">
	    		<div class="col-md-4 col-sm-12">
	    			<select class="form-control show-tick" id="src_kelas" data-live-search="true" onchange="getSiswa(this.value)" name="kelas" required="">
	    				<option value="">-- PILIH KELAS --</option>
	    				<?php 
						   $db=$this->db->get("tr_tingkat")->result();
						   foreach($db as $val){
							   echo "<optgroup label='TINGKAT ".$val->nama."'>";
								    $this->db->order_by("nama","ASC");
								   	$dbs=$this->db->get_where("v_kelas",array("id_tk"=>$val->id))->result();
								   	foreach($dbs as $vals){
								       $jmlL=$this->db->query("SELECT * from data_siswa where id_kelas='".$vals->id."' and jk='l' and id_sts_data IN('1', '4') ")->num_rows();
								         $jmlP=$this->db->query("SELECT * from data_siswa where id_kelas='".$vals->id."' and jk='p' and id_sts_data IN('1', '4')")->num_rows();
									   echo "<option value='".$vals->id."'>[$vals->id] ".$vals->nama." (L=".$jmlL.",P=".$jmlP.",T=".($jmlL+$jmlP).") </option>";
								   	}
								  
							   echo "</optgroup>";
						   }
					   ?>
	    			</select>
	    		</div>

	    		<div class="col-md-4 col-sm-12" id="fsiswa">
	    			<select class="form-control show-tick" id="src_siswa" data-live-search="true" required="" name="siswa">
	    				<option value="">-- PILIH SISWA --</option>
	    			</select>
	    		</div>

	    		<div class="col-md-4 col-sm-12">
	    			<button class="btn bg-teal waves-effect" type="submit"><i class="material-icons">search</i> CARI</button>
	    		</div>

	    	</div>
    	</form>
    	<hr>
    	<div class="row" style="padding: 10px;display: none;" id="fspp">
    		<div class="col-md-12 col-sm-12">
    			<table class="table table-bordered " id="tbl-siswa">
    				<thead>
    					<tr class="bg-teal">
    						<th width="5%">No</th>
    						<th>Nama Siswa</th>
    					</tr>
    				</thead>
    				<tbody id="dt-siswa">
    					
    				</tbody>
    			</table>
    		</div>
    		<form method="POST" id="form-spp">
	    		<div class="col-md-4 col-sm-12">
	    			<label>Tentukan Tanggal Tagihan Awal</label><br>
	    			<input class="form-control tgl" name="awal" id="awal" required="">
	    		</div>
	    		<div class="col-md-4 col-sm-12">
	    			<label>Tentukan Tanggal Tagihan Akhir</label><br>
	    			<input class="form-control tgl" name="akhir" id="akhir" required="">
	    		</div>
	    		<div class="col-md-4 col-sm-12">
	    			<label>Nominal SPP Baru</label><br>
	    			<input class="form-control" name="baru" id="baru" required="" onkeydown="return numbersonly(this, event);">
	    		</div>
	    		<div class="col-md-12 col-sm-12">
	    			<button class="btn bg-teal waves-effect btn-block" type="submit"><i class="material-icons">save</i> PROSES</button>
	    		</div>
    		</form>
    	</div>
    </div>
</div>

<script type="text/javascript">
	
	$("#form-spp").on("submit",(function(e){
		e.preventDefault();
		var siswa = $("#src_siswa").val();
		var awal  = $("#awal").val();
		var akhir = $("#akhir").val();
		var baru  = $("#baru").val();
		loading("fspp");
		$.post("<?php echo site_url("keu_set/updateSpp"); ?>",{siswa:siswa, awal:awal, akhir:akhir, baru:baru},function(data){
		    unblock("fspp");
		    notif("SPP Berhasil diubah.");
		});
	}));

	$("#form-siswa").on("submit",(function(e){
		e.preventDefault();
		var siswa = $("#src_siswa").val();
		loading("tbl-siswa")
		$.post("<?php echo site_url("keu_set/getNamaSiswa"); ?>",{siswa:siswa},function(data){
		    unblock("tbl-siswa");
		    $("#dt-siswa").html(data);
		});

		$("#fspp").show();
	}));

	function getSiswa(v){

		$.post("<?php echo site_url("keu_set/getSiswa"); ?>",{id_kelas:v},function(data){
		    $("#fsiswa").html(data);
		    $("#src_siswa").selectpicker();
		});

	}

	$('.tgl').daterangepicker({
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
	            "M",
	            "S",
	            "S",
	            "R",
	            "K",
	            "J",
	            "S"
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
	    "startDate": "<?php echo date("d/m/Y")?>",
	   
	});
	$(".show-tick").selectpicker();

</script>