<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div>
		<h4 class="content-title mb-2">Absensi Harian Siswa </h4>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
			</ol>
		</nav>
	</div>
	<div class="d-flex my-auto">
		<div class=" d-flex right-page">
			<div class="d-flex justify-content-center mr-5">
				<div class="">
					<span class="d-block">
						<span class="label ">Jumlah Nilai</span>
					</span>
					<span class="value">
						Kosong
					</span>
				</div>

			</div>
			<div class="d-flex justify-content-center">
				<div class="">
					<span class="d-block">
						<span class="label">Nilai Murid</span>
					</span>
					<span class="value">
						Kosong
					</span>
				</div>

			</div>
		</div>
	</div>
</div>
<!-- /breadcrumb -->
<div class="col-md-12 col-xl-12">
							<div class="card overflow-hidden review-project">
		<div class="card">
			<div class="body">
				<div class="table-responsive">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="laphar">
	<div>
		<div class="body entry">
			<div class="row clearfix">
				<div class="col-md-3 col-md-12">
					<div class="form-line">
						<label>Pencarian Tanggal : </label>
						<input required type="text" id="tgl" autocomplete="off" name="tgl" class="form-control cursor" onchange="load_absen()">
					</div>
				</div>
			</div>
		</div>

	</div>

	<div id="dt" style="margin-top:10px"></div>
</div>



<script>
	//load
	//setTimeout(load_absen(), 10000);

	$('#tgl').daterangepicker({
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

	function load_absen() {
		var tgl = $("#tgl").val();
		loading("dt");
		$.post("<?php echo site_url("walikelas/get_absen"); ?>", {
			tgl: tgl
		}, function(data) {
			$("#dt").html(data);
			unblock(dt);
		});
	}

	function detail(id) {
		$("#judul_mdl_detail").html("DATA DETAIL SISWA ");
		$("#mdl_detail").modal();
		$.post("<?php echo site_url("welcome/detail_siswa"); ?>", {
			id: id
		}, function(data) {
			$("#isi_detail").html(data);
		});
	}

	function tanggapi(id) {
		$("#mdl_modal_artikel").modal();
		$("#id_catatan").val(id);
		$("[name='f[tanggapan]").val("");
	}

	function edit_tanggapan(id, teks) {
		$("#mdl_modal_tanggapan").modal();
		$("#id").val(id);
		$("[name='f[tanggapan]").val(teks);
	}

	function hapus_tanggapan(id) {
		alertify.confirm("<center>Hapus tanggapan ini ?</center>", function() {
			$.post("<?php echo site_url("walikelas/hapus_walikelas"); ?>", {
				id: id
			}, function() {
				reload_table();
			})
		})
	};
</script>



<!-- Modal -->
<div class="modal fade" id="mdl_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title col-teal" id="judul_mdl_detail"> </h4>
			</div>

			<!-- Modal Body -->
			<div class="col-md-12 modal-body">
				<div id="isi_detail"></div>
			</div>


			<div class="row clearfix"></div>
			<div class="modal-footer">


			</div>


		</div>
	</div>
</div>






<div class="modal fade" id="mdl_modal_tanggapan" tabindex="-1" role="dialog">
	<div class="modal-dialog" id="area_modal_tanggapan" role="document">

		<form action="javascript:submitForm('modal_tanggapan')" id="modal_tanggapan" url="<?php echo base_url() ?>walikelas/update_tanggapan" method="post" enctype="multipart/form-data">
			<div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
				<div class="modal-header">
					<h4 class="modal-title col-teal" id="defaultModalLabel">TINDAK LANJUT</h4>

				</div>
				<div class="modal-body">
					<div class="row clearfix">

						<div class="col-lg-12 col-md-12 col-xs-12 ">
							<div class="form-groups">
								<div class="form-line">
									<textarea class="form-control" required name="f[tanggapan]"></textarea>
								</div>
							</div>
						</div>
					</div>
					<input type='hidden' name='id' id='id'>

					<div class="modal-footer">
						<span id="msg" class='pull-left'></span>
						<div class="btn-group" role="group" aria-label="Default button group">

							<!--      <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                  ---> <button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_tanggapan')"><i class="material-icons">save</i> SIMPAN</button>
						</div>

					</div>

				</div>
			</div>


	</div>
	</form>
</div><!-- /.modal-dialog -->




<div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
	<div class="modal-dialog" id="area_modal_artikel" role="document">

		<form action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url() ?>walikelas/insert_tanggapan" method="post" enctype="multipart/form-data">
			<div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
				<div class="modal-header">
					<h4 class="modal-title col-teal" id="defaultModalLabel">TINDAK LANJUT</h4>

				</div>
				<div class="modal-body">
					<div class="row clearfix">

						<div class="col-lg-12 col-md-12 col-xs-12 ">
							<div class="form-groups">
								<div class="form-line">
									<textarea class="form-control" required name="f[tanggapan]"></textarea>
								</div>
							</div>
						</div>
					</div>
					<input type='hidden' name='f[id_catatan]' id='id_catatan'>

					<div class="modal-footer">
						<span id="msg" class='pull-left'></span>
						<div class="btn-group" role="group" aria-label="Default button group">

							<button title="tutup" data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
							<button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel')"><i class="material-icons">save</i> SIMPAN</button>
						</div>

					</div>

				</div>
			</div>


	</div>
	</form>
</div><!-- /.modal-dialog -->


<script type="text/javascript">
	function reload_table() {
		setTimeout(function() {
			loadhal();
		}, 500);

	}

	function loadhal() {
		var url = "<?php echo base_url() ?>walikelas/status";
		$.post(url, {
			ajax: "yes"
		}, function(data) {
			$(".content").html(data);
		});
	}

	//  setInterval(function(){ 
	//		loadhal();  
	//			}, 60000);
</script>