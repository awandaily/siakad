<?php $token = date("His"); ?>

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div>
		<h4 class="content-title mb-2">Hi, Ini Rekap Absen Tiap Pertemuan </h4>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Walikelas</a></li>
				<li class="breadcrumb-item active" aria-current="page"> Rekap Absen Tiap Pertemuan</li>
			</ol>
		</nav>
	</div>

</div>
<!-- /breadcrumb -->


<!-- Task Info -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="card">
		<div class="header row">
			<div class="col-md-12">
				<h2 style='font-size:16px'><b>Ketidakhadiran Siswa Perhari</b></h2>
			</div>


		</div>

		<!----->
		<div class="card">
			<div class="body">
				<div class="table-responsive">
					<table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
						<thead class='sadow bg-teal'>
							<th class='thead'>NO</th>
							<th class='thead'>SISWA</th>

							<th class='thead'>TOTAL</th>

							<?php
							$this->db->where("id!=", 1);
							$data = $this->db->get("tr_sts_kehadiran")->result();
							foreach ($data as $db) { ?>
								<th class='thead'><?php echo strtoupper($db->alias) ?></th>
							<?php } ?>


						</thead>
					</table>
				</div>
			</div>
		</div>
		<!----->

	</div>
</div>
<!-- #END# Task Info -->



<div class="modal fade" id="mdl_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" id="area_mdl_modal" role="document">

		<form action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="#" method="post" enctype="multipart/form-data">
			<div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
				<div class="modal-header">
					<h4 class="modal-title col-teal" id="defaultModalLabel">DATA ABSEN <span class="titles"></span> </h4>

				</div>
				<div class="modal-body">

					<div id="view"></div>

				</div>
			</div>


	</div>
	</form>
</div><!-- /.modal-dialog -->


<script>
	function cekAbsenPerhari(id, title, absen) {
		$(".titles").html(title);
		loading();
		$.post("<?php echo site_url("walikelas/cekAbsenPerhari"); ?>", {
			id: id,
			kriteria: absen
		}, function(data) {
			$("#mdl_modal").modal("show");
			$("#view").html(data);
			$.unblockUI();
		})
	};
</script>

<script>
	function detail(id) {
		$("#judul_mdl_detail").html("DATA DETAIL SISWA ");
		$("#mdl_detail").modal();
		$.post("<?php echo site_url("welcome/detail_siswa"); ?>", {
			id: id
		}, function(data) {
			$("#isi_detail").html(data);
		});
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

	function tanggapi(id) {
		$("#mdl_modal_artikel").modal();
		$("#id_catatan").val(id);
		$("[name='f[tanggapan]").val("");
	}
</script>
<script>
	$('select').selectpicker();
</script>
<script type="text/javascript">
	function hapus(id, akun) {
		alertify.confirm("<center>Hapus catatan ini ?</center>", function() {
			$.post("<?php echo site_url("catatan/hapus_catatan"); ?>", {
				id: id
			}, function() {
				reload_table();
			})
		})
	};



	var save_method; //for save method string
	var table;
	var dataTable = $('#table').DataTable({
		"paging": true,
		"processing": false, //Feature control the processing indicator.
		"language": {
			"sSearch": "Pencarian",
			"processing": ' <span class="sr-only dataTables_processing">Loading...</span> <br><b style="color:black;background:white">Proses menampilkan data<br> Mohon Menunggu..</b>',
			"oPaginate": {
				"sFirst": "Hal Pertama",
				"sLast": "Hal Terakhir",
				"sNext": "Selanjutnya",
				"sPrevious": "Sebelumnya"
			},
			"sInfo": "Total :  _TOTAL_ , Halaman (_START_ - _END_)",
			"sInfoEmpty": "Tidak ada data yang di tampilkan",
			"sZeroRecords": "Data tidak tersedia",
			"lengthMenu": "Tampil _MENU_ Baris",
		},


		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"responsive": false,
		"searching": true,
		"lengthMenu": [
			[10, 30, 50, 100],
			[10, 30, 50, 100],
		],
		dom: 'Blfrtip',
		buttons: [
			// 'copy', 'csv', 'excel', 'pdf', 'print'

			{
				extend: 'excel',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5, 6, 7]
				},
				text: 'Download Excell',

			},




		],

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": "<?php echo site_url('walikelas/getAbsenPerhari'); ?>",
			"type": "POST",
			"data": function(data) {
				data.id_kelas = $('#fkelas').val();
				//  data.id_jenis= $('#fid_jenis').val(); 
				//  data.ke_bp= $('#fke_bp').val(); 
			},
			beforeSend: function() {
				loading("area_lod");
			},
			complete: function() {
				unblock('area_lod');
			},

		},

		//Set column definition initialisation properties.
		"columnDefs": [{
			"targets": [0, -1, -2, -3, -4], //last column
			"orderable": false, //set not orderable
		}, ],

	});

	function reload_table() {
		dataTable.ajax.reload(null, false);
	};
	$(document).on('change', '.fkelas<?php echo $token; ?>,.fidjenis<?php echo $token; ?>,.fke_bp<?php echo $token; ?>', function(event, messages) {
		reload_table();
	});
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

							<!--      <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                   ---> <button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel')"><i class="material-icons">save</i> SIMPAN</button>
						</div>

					</div>

				</div>
			</div>


	</div>
	</form>
</div><!-- /.modal-dialog -->