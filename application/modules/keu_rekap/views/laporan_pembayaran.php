<div class="card">
	<div class="header">
        <h2>LAPORAN PEMBAYARAN SISWA</h2>
    </div>
    <div class="body">
    	<form method="post" id="form-siswa">

	    	<div class="row" style="padding: 10px;">
	    		<div class="col-md-4 col-sm-12">
	    			<select class="form-control show-tick" id="src_kelas" data-live-search="true" onchange="getSiswa(this.value)" name="kelas" required="">
	    				<option value="">-- PILIH TINGKAT --</option>
	    				<?php 
						   $db=$this->db->get("tr_tingkat")->result();
						   foreach($db as $val){
							   echo "<option value='".$val->id."'>".$val->nama."</option>";
						   }
					   ?>
	    			</select>
	    		</div>

	    		<div class="col-md-4 col-sm-12" id="fsiswa">
	    			<input class="form-control tgl-range" id="tgl">
	    		</div>

	    		<div class="col-md-4 col-sm-12">
	    			<button class="btn bg-teal waves-effect" type="submit"><i class="material-icons">search</i> TAMPILKAN</button>
	    		</div>

	    	</div>
    	</form>
    	<hr>
    	<div class="row" style="padding: 10px;">
    		<div class="col-md-12" id="dt"></div>
    	</div>
    </div>
</div>

<script type="text/javascript">
	var start = moment().startOf('month');
	var end = moment().endOf('month'); 	
	$(".tgl-range").daterangepicker({
	    startDate: start,
	    endDate: end,
	    ranges: {
	        'Hari ini': [moment(), moment()],
	        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	        '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
	        '30 hari terakhir': [moment().subtract(30, 'days'), moment()],
	        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
	        'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	    }, "locale": {
	        "format": "DD/MM/YYYY",
	        "separator": " - ",
	        "applyLabel": "Apply",
	        "cancelLabel": "Cancel",
	        "fromLabel": "From",
	        "toLabel": "To",
	        "customRangeLabel": "Custom",
	        "weekLabel": "W",
	        "firstDay": 1
	    },
	});


	$("#form-siswa").on("submit",(function(e){
		e.preventDefault();
		var kelas 	= $("#src_kelas").val();
		var tgl 	= $("#tgl").val();
		loading("dt")
		$.post("<?php echo site_url("keu_rekap/getBayar"); ?>",{idkelas:kelas, tgl:tgl},function(data){
		    unblock("dt");
		    $("#dt").html(data);
		});

		//$("#fspp").show();
	}));

</script>