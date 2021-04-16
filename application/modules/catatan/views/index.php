 <?php $token = date("His"); ?>
 <!-- breadcrumb -->
 <div class="breadcrumb-header justify-content-between">
 	<div>
 		<h4 class="content-title mb-2">Hi, Ini Catatan Pengaduan</h4>
 		<nav aria-label="breadcrumb">
 			<ol class="breadcrumb">
 				<li class="breadcrumb-item"><a href="#">Aksi</a></li>
 				<li class="breadcrumb-item active" aria-current="page"> Pengaduan</li>
 			</ol>
 		</nav>
 	</div>

 </div>
 <!-- /breadcrumb -->




 <!-- Task Info -->
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 	<div class="card">
 		<div class="header row">
 			<div class="col-md-4 " style="padding-bottom:15px">
 				<h2 style='font-size:16px'><b> PENGADUAN</b></h2>
 			</div>
 			<div class="col-md-4  " style="padding-bottom:10px">
 				<select class="form-control   show-tick fkelas<?php echo $token; ?>" id="fkelas" data-live-search="true">
 					<option value="">=== Filter Kelas ===</option>

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
 			<div class="col-md-4 " style="padding-bottom:15px">
 				<button onclick="tambah()" type="button" class="btn-top btn  bg-teal waves-effect">
 					<i class="material-icons">create</i>
 					KIRIM PENGADUAN
 				</button>
 			</div>
 			<!--	<div class="col-md-3"   style="padding-bottom:10px">
                                          
									
								 
										$ray="";
										$ray[]="=== Filter Jenis Catatan ===";
										$data=$this->db->get("tr_jenis_catatan")->result();
										foreach($data as $val){
											$ray[$val->id]=$val->nama;
										}
										$dataray=$ray;
										echo form_dropdown("f[id_jenis]",$dataray,"","class='form-control show-tick fidjenis".$token."' id='fid_jenis' ");?>
                            </div>-->
 			<!--
							<div class="col-md-4"   >
                                          
									
									<?php
									$ray = "";
									$ray[''] = "  == Filter Terusan ==  ";


									$ray["1"] = " Guru Bp";
									$ray["2"] = " Orang Tua";
									$ray["3"] = " Siswa";
									$ray["4"] = " Tidak diteruskan";

									$dataray = $ray;
									echo form_dropdown("f[ke_bp]", $dataray, "", "class='form-control show-tick fke_bp" . $token . "' id='fke_bp' "); ?>
                            </div>-->

 		</div>

 		<div class="card">
 			<div class="body">
 				<div class="table-responsive">
 					<table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
 						<thead class='sadow bg-teal'>
 							<th class='thead'>EDIT | HAPUS</th>
 							<th class='thead' width='15px'>&nbsp;NO</th>
 							<th class='thead'>NAMA SISWA</th>
 							<th class='thead'> KELAS</th>
 							<!--	<th class='thead' >JENIS CATATAN</th>-->
 							<th class='thead'>KETERANGAN</th>
 							<th class='thead'>BUKTI</th>

 						</thead>
 					</table>
 				</div>
 			</div>
 		</div>
 		<!----->

 	</div>
 </div>
 <!-- #END# Task Info -->

 <script>
 	//$('select').selectpicker();
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
 			[5, 10, 30, 50, 100],
 			[5, 10, 30, 50, 100],
 		],
 		dom: 'Blfrtip',
 		buttons: [
 			// 'copy', 'csv', 'excel', 'pdf', 'print'

 			{
 				extend: 'excel',
 				exportOptions: {
 					columns: [0, 2, 3]
 				},
 				text: ' Excell',

 			},

 			{
 				extend: 'colvis',
 				exportOptions: {
 					columns: [0, 2, 3]
 				},
 				text: ' Kolom',

 			},


 		],

 		// Load data for the table's content from an Ajax source
 		"ajax": {
 			"url": "<?php echo site_url('catatan/getCatatan'); ?>",
 			"type": "POST",
 			"data": function(data) {
 				data.id_kelas = $('#fkelas').val();
 				data.id_jenis = $('#fid_jenis').val();
 				data.ke_bp = $('#fke_bp').val();
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

 <script>
 	function tanggapi(id, nama) {

 		$.post("<?php echo site_url("catatan/viewTanggapi"); ?>", {
 			id: id
 		}, function(data) {
 			$("#f-tanggapi").html(data);
 			$("#md-tanggapi").modal();
 		});
 	}
 </script>
 <div class="modal fade" id="md-tanggapi" tabindex="-1" role="dialog">
 	<div class="modal-dialog" id="area_modal_artikel" role="document">

 		<form action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url() ?>catatan/insert_catatan" method="post" enctype="multipart/form-data">
 			<div class="modal-content"> <span title="tutup" data-dismiss="modal" class="pull-right waves-effect"><i class="material-icons">cancel</i> </span>
 				<div class="modal-header">
 					<h4 class="modal-title col-teal" id="defaultModalLabel">RIWAYAT TANGGAPAN</h4>

 				</div>
 				<div class="modal-body">
 					<div id="f-tanggapi"></div>

 					<div class="modal-footer">
 						<span id="msg" class='pull-left'></span>
 						<div class="btn-group" role="group" aria-label="Default button group">


 						</div>

 					</div>

 				</div>
 			</div>

 	</div>
 	</form>
 </div>


 <script>
 	function tambah() {
 		$.post("<?php echo site_url("catatan/viewAdd"); ?>", function(data) {
 			$("#mdl_modal_artikel_tambah").modal();
 			$("#viewAddTambah").html(data);
 		});

 	}
 </script>



 <div class="modal fade" id="mdl_modal_artikel_tambah" tabindex="-1" role="dialog">
 	<div class="modal-dialog" id="area_modal_artikel_tambah" role="document">

 		<form action="javascript:submitForm('modal_artikel_tambah')" id="modal_artikel_tambah" url="<?php echo base_url() ?>catatan/insert_catatan" method="post" enctype="multipart/form-data">
 			<div class="modal-content"> <span title="tutup" data-dismiss="modal" class="pull-right waves-effect"><i class="material-icons">cancel</i> </span>
 				<div class="modal-header">
 					<h4 class="modal-title col-teal" id="defaultModalLabel">TAMBAHKAN CATATAN</h4>

 				</div>
 				<div class="modal-body">
 					<div id="viewAddTambah">

 					</div>

 					<div class="modal-footer">
 						<span id="msg" class='pull-left'></span>
 						<div class="btn-group" role="group" aria-label="Default button group">


 							<button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel_tambah')">
 								<i class="material-icons">save</i> SIMPAN
 							</button>
 						</div>

 					</div>

 				</div>
 			</div>

 	</div>
 	</form>
 </div>
 <!-- /.modal-dialog -->


 <script>
 	function edit(id) {

 		$.post("<?php echo site_url("catatan/viewEdit"); ?>", {
 			id: id
 		}, function(data) {
 			$("#editan").html(data);
 			$("#mdl_modal_edit").modal();
 		});
 	}
 </script>




 <div class="modal fade" id="mdl_modal_edit" tabindex="-1" role="dialog">
 	<div class="modal-dialog" id="area_modal_edit" role="document">

 		<form action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url() ?>catatan/update_catatan" method="post" enctype="multipart/form-data">
 			<div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
 				<div class="modal-header">
 					<h4 class="modal-title col-teal">Edit Catatan</h4>

 				</div>
 				<div class="modal-body">

 					<div id="editan"></div>


 					<div class="modal-footer">
 						<span id="msg" class='pull-left'></span>
 						<div class="btn-group" role="group" aria-label="Default button group">

 							<!--         <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                --> <button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_edit')"><i class="material-icons">save</i> SIMPAN</button>
 						</div>

 					</div>

 				</div>
 			</div>


 	</div>
 	</form>
 </div><!-- /.modal-dialog -->