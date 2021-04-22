 <!-- breadcrumb -->
 <div class="breadcrumb-header justify-content-between">
 	<br>

 </div>
 </div>
 <!-- /breadcrumb -->

 <?php $token = date("His"); ?>

 <!-- Task Info -->
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 	<div class="card">
 		<div class="header">






 			<h2 class="sound">MIGRASI DATA SISWA</h2>

 		</div>
 		<div class="body">


 			<div class="col-sm-4 col-black">
 				<select class="form-control show-tick" id="id_kelasf<?php echo $token; ?>" name="kelas_lama" data-live-search="true">


 					<?php
						$db = $this->db->get("tr_tingkat")->result();
						foreach ($db as $val) {
							echo "<optgroup label='TINGKAT " . $val->nama . "'>";

							$dbs = $this->db->get_where("v_kelas", array("id_tk" => $val->id))->result();
							foreach ($dbs as $vals) {
								echo "<option value='" . $vals->id . "'>" . $vals->nama . "</option>";
							}

							echo "</optgroup>";
						}
						?>

 				</select>
 			</div>



 			<!--	<div class="col-sm-2">
                                    <select class="form-control show-tick" id="genderf<?php echo $token; ?>" >
                                        <option value="">Gender</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                         
                                    </select>
                                </div> -->
 			<div class="col-sm-6">
 				<input type="text" class='form-control' id="searching" placeholder="pencarian.." onchange='reload_table()'>
 			</div>
 			<div class="col-sm-2">
 				<button class="btn bg-blue-grey btn-block" onclick="migrasikan()">
 					<i class="material-icons">cached</i>MIGRASIKAN</button>
 			</div>




 		</div>
 		<form action="#" name="delcheck" id="delcheck" class="form-horizontal" method="post">
 			<div class="cardd" id="area_lod">
 				<div cass="body">
 					<div class="table-responsive">
 						<table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
 							<thead class='sadow bg-teal'>
 								<th class='thead' style='max-width:3px'>NO</th>
 								<th class='thead' style='max-width:13px'>
 									<input type="checkbox" id="md_checkbox" value="ya" class="pilihsemua filled-in chk-col-red" />
 									<label for="md_checkbox" class="col-white">&nbsp;</label>


 								</th>

 								<th class='thead' style='min-width:125px'>NAMA</th>
 								<th class='thead'>KELAS</th>


 							</thead>
 						</table>
 					</div>
 				</div>
 			</div>
 		</form>
 		<!----->
 	</div>
 </div>
 </div>
 <!-- #END# Task Info -->


 <script>
 	$(".btnhapus").hide();
 	$(".pilihsemua").click(function() {

 		if ($(".pilihsemua").val() == "ya") {
 			$(".pilih").prop("checked", "checked");
 			$(".pilihsemua").val("no");
 			$(".btnhapus").show();
 		} else {
 			$(".pilih").removeAttr("checked");
 			$(".pilihsemua").val("ya");
 			$(".btnhapus").hide();
 		}

 	});

 	function pilcek() {
 		$(".btnhapus").show();
 		$(".pilihsemua").removeAttr("checked");
 		$(".pilihsemua").val("ya");

 	};
 </script>
 <script>
 	function migrasikan() {
 		var t = $('[name="hapus[]"]:checked').length;
 		if (t < 1) {
 			alert("mohon pilih siswa terlebih dulu.");
 			return false;
 		} else {
 			$("#mdl_migrasi").modal("show");
 			var kelas = $("#id_kelasf<?php echo $token; ?>").val();

 			$.post("<?php echo site_url("master/ajax_migrasi"); ?>", {
 				id_kelas: kelas
 			}, function(data) {
 				$("#ajax_migrasi").html(data);
 			});
 		}
 	}
 </script>
 <script type="text/javascript">
 	var dataTable = $('#tabel').DataTable({
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
 		"searching": false,
 		"lengthMenu": [
 			[40, 50, 100, 200, 300, 400, 500, 1000, 2000],
 			[40, 50, 100, 200, 300, 400, 500, 1000, 2000]
 		],

 		// Load data for the table's content from an Ajax source
 		"ajax": {
 			"url": "<?php echo site_url('master/data_migrasi'); ?>",
 			"type": "POST",
 			"data": function(data) {

 				data.id_kelas = $('#id_kelasf<?php echo $token; ?>').val();
 				data.gender = $('#genderf<?php echo $token; ?>').val();
 				data.aktifasi = $('#aktifasif<?php echo $token; ?>').val();
 				data.id_agama = $('#id_agamaf<?php echo $token; ?>').val();
 				data.id_tahun_masuk = $('#id_tahun_masukf<?php echo $token; ?>').val();
 				data.id_pekerjaan_ayah = $('#id_pekerjaan_ayahf<?php echo $token; ?>').val();
 				data.id_pekerjaan_ibu = $('#id_pekerjaan_ibuf<?php echo $token; ?>').val();
 				data.id_penghasilan = $('#id_penghasilanf<?php echo $token; ?>').val();
 				data.id_status_ayah = $('#id_status_ayahf<?php echo $token; ?>').val();
 				data.id_status_ibu = $('#id_status_ibuf<?php echo $token; ?>').val();
 				data.searching = $('#searching').val();

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


 	var x = 0;
 	$(document).on('change', '#id_agamaf<?php echo $token; ?>,#id_tahun_masukf<?php echo $token; ?>,#id_kelasf<?php echo $token; ?>,#genderf<?php echo $token; ?>,#aktifasif<?php echo $token; ?>,#id_status_ibuf<?php echo $token; ?>,#id_status_ayahf<?php echo $token; ?>,#id_penghasilanf<?php echo $token; ?>,#id_pekerjaan_ibuf<?php echo $token; ?>,#id_pekerjaan_ayahf<?php echo $token; ?>', function(event, messages) {

 		dataTable.ajax.reload(null, false);

 	});

 	function tinjau(id) {
 		var url = "<?php echo base_url(); ?>kesiswaan/tinjau";
 		$.post(url, {
 			id: id
 		}, function(data) {
 			$("#judul_tinjau").html("TINJAU DATA CBT");
 			$("#isi").html(data);
 			$("#modal_tinjau").modal();
 		});
 	}

 	function import_data() {
 		$("#formSubmitDown")[0].reset();
 		$("#judul_mdl").html("IMPORT DATA SISWA ");
 		$("#isi").html(data);
 		$("#mdl_formSubmitDown").modal();
 		$("#formSubmitDown").attr("url", "<?php echo base_url("master/import_data_siswa"); ?>");
 		$("#ket_file").html("Cari File");
 	}


 	function input() {
 		$("#formSubmit_input")[0].reset();
 		$("#judul_mdl_input").html("INPUT DATA SISWA ");
 		$("#mdl_formSubmit_input").modal();
 		$("#formSubmit_input").attr("url", "<?php echo base_url("master/input_data_siswa"); ?>");
 		$("#ket_file").html("Cari Photo");
 	}

 	function edit(id) {
 		$("#judul_mdl_edit").html("EDIT DATA SISWA ");
 		$("#mdl_formSubmit_edit").modal();
 		$("#formSubmit_edit").attr("url", "<?php echo base_url("master/input_data_siswa"); ?>");
 		$.post("<?php echo site_url("master/edit_data_siswa"); ?>", {
 			id: id
 		}, function(data) {
 			$("#edit_isi").html(data);
 		});
 	}

 	function detail(id) {
 		$("#judul_mdl_detail").html("DATA DETAIL SISWA ");
 		$("#mdl_detail").modal();
 		$.post("<?php echo site_url("master/detail_siswa"); ?>", {
 			id: id
 		}, function(data) {
 			$("#isi_detail").html(data);
 		});
 	}

 	function hapus(id, nis, judul = null) {
 		alertify.confirm("<center>Menghapus akan membersihkan data terkait siswa:<br> <span class='font-bold'>`" + judul + "`</span> <br>Yakin Hapus ? </center>", function() {
 			$.post("<?php echo site_url("master/hapus_siswa"); ?>", {
 				id: id
 			}, function() {

 				notif("Data berhasil dihapus !!");
 				reload_table();
 			})
 		})
 	};

 	function aktifasi(id, judul = null) {
 		if (judul == 1) {
 			juduls = "NON AKTIFKAN GURU INI ?";
 		} else {
 			juduls = "AKTIFKAN GURU INI ?";
 		}
 		alertify.confirm("<center>  <span class='font-bold'>`" + juduls + "`</span> </center>", function() {
 			$.post("<?php echo site_url("master/aktifasi_pendidik"); ?>", {
 				id: id,
 				sts: judul
 			}, function() {
 				notif("Data berhasil dihapus !!");
 				reload_table();
 			})
 		})
 	};

 	function reload_table() {
 		dataTable.ajax.reload(null, false);
 	}

 	function filter() {

 		$("#mdl_filter").modal();

 	}
 </script>



 <!-- Modal -->
 <div class="modal fade" id="mdl_migrasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 	<div class="modal-dialog" id="area_formSubmit">
 		<div class="modal-content">

 			<!-- Modal Header -->
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal">
 					<span aria-hidden="true">&times;</span>
 					<span class="sr-only">Close</span>
 				</button>
 				<h4 class="modal-title col-teal"> MIGRASKAN DATA SISWA </h4>
 			</div>

 			<!-- Modal Body -->
 			<div class="modal-body">
 				<div class="col-md-12 body">


 					<div class="row clearfix">
 						<div class="col-lg-4 col-md-4  form-control-label">
 							<label for="email_address_2" class="col-black">PILIH KELAS BARU</label>
 						</div>
 						<div class="col-lg-8 col-md-8  ">
 							<div class="form-group">
 								<div class="form-line" id='ajax_migrasi'>

 								</div>
 							</div>
 						</div>
 					</div>
 					<br>
 					<center>
 						<button class='btn bg-teal btn-block' onclick="go_migrasi()">SIMPAN</button>
 					</center>




 				</div>
 			</div>
 			<div class="row clearfix"></div>
 			<div class="modal-footer">


 			</div>


 		</div>
 	</div>
 </div>

 <script>
 	function get_siswa() {
 		var values = new Array();
 		$.each($("input[name='hapus[]']:checked"), function() {
 			values.push($(this).val());
 		});
 		return "&siswa=" + values;
 	}


 	function go_migrasi() {
 		var kelas = $("[name='kelas_baru']").val();
 		var kelas_lama = $("[name='kelas_lama']").val();
 		var siswa = get_siswa();
 		$.ajax({
 			url: "<?php echo base_url() ?>master/go_migrasi",
 			data: "kelas_lama=" + kelas_lama + "&id_kelas=" + kelas + siswa,
 			method: "POST",
 			dataType: "JSON",

 			success: function(data) {
 				if (data['hasil'] == "false") {
 					notif("<b><span class='col-pink'>Gagal!</span> Mohon pindahkan dulu siswa yang ada dikelas tujuan.<b>");
 					return false;
 				}
 				$("#mdl_migrasi").modal("hide");
 				notif("berhasil dipindahkan");
 				reload_table();
 			}
 		});
 	}
 </script>