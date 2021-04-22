 <!-- breadcrumb -->
 <div class="breadcrumb-header justify-content-between">
 	<br>

 </div>
 </div>
 <!-- /breadcrumb -->

 <?php
	$token = date('His');
	?>

 <!-- Task Info -->
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 	<div class="card">
 		<div class="header">
 			<h2>DATA REKAP INPUT NILAI PENDIDIK</h2>
 		</div>
 		<div class="body">


 			<div id="area_lod">
 				<div>
 					<div class="table-responsive">
 						<table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable">
 							<thead class='sadow bg-teal' style="font-size:12px;width:100%">
 								<th class='thead' style='max-width:3px'>NO</th>
 								<th class='thead'>NAMA</th>

 								<th class='thead'>INPUT ULANGAN HARIAN</th>
 								<th class='thead'>INPUT UTS</th>
 								<th class='thead'>INPUT UAS</th>

 							</thead>
 						</table>
 					</div>
 				</div>
 			</div>

 		</div>
 	</div>
 </div>
 <!-- #END# Task Info -->




 <script type="text/javascript">
 	var dataTable = $('#tabel').DataTable({
 		scrollY: 433,
 		"fixedHeader": true,
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
 			[10, 30, 50, 100, 200, 300, 400, 500],
 			[10, 30, 50, 100, 200, 300, 400, 500]
 		],
 		/*
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]
                },text:'Export Excell',
							
                    },
					
			/*		{
					extend: 'pdf',
                        exportOptions: {
                     columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:'  Pdf',
							
                    },{
					extend: 'print',
                        exportOptions: {
                    columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:'  Print',
							
                    },
					{extend: 'colvis',
                        exportOptions: {
                  columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:' Kolom',
							
                    },
					 
					
        ],*/

 		// Load data for the table's content from an Ajax source
 		"ajax": {
 			"url": "<?php echo site_url('data_pendidik/data_input_nilai'); ?>",
 			"type": "POST",
 			"data": function(data) {

 				//data.id_kelas = $('#id_kelas').val();						 
 			},
 			beforeSend: function() {
 				loading("area_lod");
 			},
 			complete: function() {
 				unblock('area_lod');
 			},

 		},



 	});



 	var x = 0;
 	$(document).on('change', '#id_mapel,#id_kelas,#gender,#sts,#jabatan,#aktifasi', function(event, messages) {

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
 		$("#formSubmit")[0].reset();
 		$("#judul_mdl").html("IMPORT DATA GURU ");
 		$("#isi").html(data);
 		$("#mdl_formSubmit").modal();
 		$("#formSubmit").attr("url", "<?php echo base_url("master/import_data_guru"); ?>");
 		$("#ket_file").html("Cari File");
 	}


 	function input() {
 		$("#formSubmit_input")[0].reset();
 		$("#judul_mdl_input").html("INPUT DATA GURU ");
 		$("#mdl_formSubmit_input").modal();
 		$("#formSubmit_input").attr("url", "<?php echo base_url("master/input_data_guru"); ?>");
 		$("#ket_file").html("Cari Photo");
 	}

 	function detail(id, nama) {
 		$("#judul_mdl_edit").html(nama);
 		$("#mdl_formSubmit_edit").modal();
 		$("#formSubmit_edit").attr("url", "<?php echo base_url("data_pendidik/detail_pendidik"); ?>");
 		$.post("<?php echo site_url("data_pendidik/detail_pendidik"); ?>", {
 			id: id
 		}, function(data) {
 			$("#edit_isi").html(data);
 		});
 	}

 	function hapus(id, judul = null) {
 		alertify.confirm("<center>Menghapus akan membersihkan data terkait guru:<br> <span class='font-bold'>`" + judul + "`</span> <br>Yakin Hapus ? </center>", function() {
 			$.post("<?php echo site_url("master/hapus_pendidik"); ?>", {
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
 <div class="modal fade" id="mdl_formSubmit_input" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg" id="area_formSubmit_input">
 		<div class="modal-content">
 			<form id="formSubmit_input" action="javascript:submitForm('formSubmit_input')" method="post">

 				<!-- Modal Header -->
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal">
 						<span aria-hidden="true">&times;</span>
 						<span class="sr-only">Close</span>
 					</button>
 					<h4 class="modal-title col-teal" id="judul_mdl_input">

 					</h4>
 				</div>

 				<!-- Modal Body -->
 				<div class=" ">
 					<br>

 					<div class="col-md-12">

 						<div class="col-md-4">
 							<b>GELAR DEPAN</b>
 							<div class="input-group">

 								<div class="form-line">
 									<input class="form-control" placeholder="Gelar depan" name="f[gelar_depan]" type="text">
 								</div>
 							</div>
 						</div>

 						<div class="col-md-4">
 							<b>NAMA LENGKAP</b>
 							<div class="input-group">

 								<div class="form-line">
 									<input class="form-control" required placeholder="Nama lengkap" name="f[nama]" type="text">
 								</div>
 							</div>
 						</div>

 						<div class="col-md-4">
 							<b>GELAR BELAKANG</b>
 							<div class="input-group">

 								<div class="form-line">
 									<input class="form-control" placeholder="Gelar belakang" name="f[gelar_belakang]" type="text">
 								</div>
 							</div>
 						</div>

 						<div class="col-md-4">
 							<b>NIP /ID SISTEM</b>
 							<div class="input-group">
 								<span class="input-group-addon">
 									<i class="material-icons">credit_card</i>
 								</span>
 								<div class="form-line">
 									<input class="form-control" required placeholder="Nomor NIP" name="nip" type="text">
 								</div>
 							</div>
 						</div>

 						<div class="col-md-4">
 							<b>NUPTK</b>
 							<div class="input-group">
 								<span class="input-group-addon">
 									<i class="material-icons">credit_card</i>
 								</span>
 								<div class="form-line">
 									<input class="form-control" placeholder="Nomor NUPTK" name="f[nuptk]" type="text">
 								</div>
 							</div>
 						</div>

 						<div class="col-md-4">
 							<b>NOMOR HP</b>
 							<div class="input-group">
 								<span class="input-group-addon">
 									<i class="material-icons">phone_iphone</i>
 								</span>
 								<div class="form-line">
 									<input class="form-control" value="08" onkeydown="return nomor(this, event);" required placeholder="Nomor Hp" name="hp" type="text">
 								</div>
 							</div>
 						</div>

 						<div class="col-md-4">
 							<b>E-mail</b>
 							<div class="input-group">
 								<span class="input-group-addon">
 									<i class="material-icons">email</i>
 								</span>
 								<div class="form-line">
 									<input class="form-control" placeholder="email" name="f[email]" type="email">
 								</div>
 							</div>
 						</div>

 						<div class="col-md-4">
 							<b>ALAMAT</b>
 							<div class="input-group">
 								<span class="input-group-addon">
 									<i class="material-icons">home</i>
 								</span>
 								<div class="form-line">
 									<input class="form-control" placeholder="Alamat" name="f[alamat]" type="text">
 								</div>
 							</div>
 						</div>

 						<div class="col-md-4">

 							<b>TMT</b>
 							<div class="input-group">
 								<span class="input-group-addon">
 									<i class="material-icons">date_range</i>
 								</span>
 								<div class="form-line">
 									<input class="form-control tmt" placeholder="contoh: 30/07/2016" name="tmt" type="text">
 								</div>
 							</div>

 						</div>



 						<div class="col-md-4">
 							<div class="form-group form-float">
 								<b> JENIS KELAMIN </b>
 								<select class="selectpicker show-tick" required name="f[jk]">
 									<option>=== Pilih === </option>
 									<option value="l">Laki-laki</option>
 									<option value="p">Perempuan</option>
 								</select>
 							</div>

 						</div>

 						<div class="col-md-4">
 							<div class="form-group form-float">
 								<b> STATUS KEPEGAWAIAN</b>
 								<select class="selectpicker show-tick" required name="f[sts_kepegawaian]">
 									<option>=== Pilih === </option>
 									<?php
										$sts = $this->db->get("tr_sts_pegawai")->result();
										foreach ($sts as $val) {
											echo " <option value='" . $val->id . "'>" . $val->nama . "</option>";
										}
										?>

 								</select>
 							</div>

 						</div>





 						<div class="col-md-4">
 							<div class="form-group form-float">
 								<b> Ijazah</b>
 								<select class="selectpicker show-tick" name="f[id_ijazah]">
 									<option>=== Pilih === </option>
 									<?php
										$sts = $this->db->get("tr_ijazah")->result();
										foreach ($sts as $val) {
											echo " <option value='" . $val->id . "' >" . $val->nama . "</option>";
										}
										?>
 								</select>
 							</div>
 						</div>


 						<div class="col-md-4">

 							<b>TEMPAT LAHIR</b>

 							<div class="input-group">
 								<span class="input-group-addon">
 									<i class="material-icons">home</i>
 								</span>
 								<div class="form-line">
 									<input class="form-control" placeholder="Tempat lahir" name="f[tempat_lahir]" type="teks">
 								</div>
 							</div>

 						</div>
 						<div class="col-md-4">

 							<b>TANGGAL LAHIR</b>
 							<div class="input-group">
 								<span class="input-group-addon">
 									<i class="material-icons">date_range</i>
 								</span>
 								<div class="form-line">
 									<input class="form-control tmt" placeholder="contoh:30/01/1995" name="tgl_lahir" type="teks">
 								</div>
 							</div>

 						</div>

 						<div class="col-md-4">

 							<b>JABATAN</b>
 							<div class="input-group">
 								<span class="input-group-addon">
 									<i class="material-icons">date_range</i>
 								</span>
 								<div class="form-line">
 									<select class="selectpicker show-tick" name="f[id_jabatan]">
 										<option>=== Pilih === </option>
 										<?php
											$sts = $this->db->get("tr_jabatan")->result();
											foreach ($sts as $val) {
												echo " <option value='" . $val->id . "' >" . $val->nama . "</option>";
											}
											?>
 									</select>
 								</div>
 							</div>

 						</div>
 						<div class="row clearfix"></div>

 						<div class="row clearfix col-md-9">
 							<div class="col-lg-4 col-md-4  form-control-label">
 								<label for="email_address_2" class="col-black">UPLOAD FOTO</label>
 							</div>
 							<div class="col-lg-8 col-md-8  ">
 								<div class="form-group">
 									<div class="form-line">
 										<input class="form-control" name="file" type="file">
 									</div>
 								</div>
 							</div>
 						</div>



 						<div class="col-md-3">
 							<button onclick="submitForm('formSubmit_input')" class=" btn-block aves-effect btn bg-teal"><i class="material-icons">save</i> SIMPAN</button>
 						</div>


 						<div class="row clearfix"></div>

 					</div>





 				</div>
 				<div class="row clearfix"></div>
 				<div class="modal-footer">



 				</div>
 			</form>

 		</div>
 	</div>
 </div>




 <!-- Modal -->
 <div class="modal fade" id="mdl_formSubmit_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg" id="area_formSubmit_edit">
 		<div class="modal-content">
 			<form id="formSubmit_edit" action="javascript:submitForm('formSubmit_edit')" method="post">

 				<!-- Modal Header -->
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal">
 						<span aria-hidden="true">&times;</span>
 						<span class="sr-only">Close</span>
 					</button>
 					<h4 class="modal-title col-teal" id="judul_mdl_edit"> </h4>
 				</div>

 				<!-- Modal Body -->
 				<div id="edit_isi"></div>
 				<div class="row clearfix"></div>
 				<div class="modal-footer">


 				</div>
 			</form>

 		</div>
 	</div>
 </div>




 <script>
 	$('select').selectpicker();
 	$(".tmt").inputmask("99/99/9999");
 </script>

 <script>
 	$(document).ready(function() {
 		$(".tmt").inputmask("99/99/9999");
 	});
 </script>



 <script>
 	function sudah(id) {

 		alertify.confirm("<center>Dengan meresset maka data instalasi akan dibersihkan!<br> Jika hanya <i class='col-orange'>Edit Penamaan</i>,<i class='col-orange'>Atur Jam Mengajar</i> , Akun tidak perlu di resset!<br> <b class='col-pink'> Yakin akan mereset ? </b> </center>", function() {
 			$.post("<?php echo base_url() ?>master/buka_akun/", {
 				id: id
 			}, function() {
 				reload_table();
 			})
 		})

 	}
 </script>


 <script>
 	function kelas(id, title) {
 		$(".titles").html(title);
 		loading();
 		$.post("<?php echo site_url("data_pendidik/cekKelas"); ?>", {
 			id: id
 		}, function(data) {
 			$("#mdl_modal").modal("show");
 			$("#view").html(data);
 			$.unblockUI();
 		})
 	};


 	function persentase(id, title) {
 		$(".titles").html(title);
 		loading();
 		$.post("<?php echo site_url("data_pendidik/persentase"); ?>", {
 			id: id
 		}, function(data) {
 			$("#mdl_modal").modal("show");
 			$("#view").html(data);
 			$.unblockUI();
 		})
 	};


 	function tdk_masuk(id, title) {
 		$(".titles").html(title);
 		loading();
 		$.post("<?php echo site_url("data_pendidik/cekTidakMasuk"); ?>", {
 			id: id
 		}, function(data) {
 			$("#mdl_modal").modal("show");
 			$("#view").html(data);
 			$.unblockUI();
 		})
 	};
 </script>



 <div class="modal fade" id="mdl_modal" role="dialog">
 	<div class="modal-dialog modal-lg" id="area_mdl_modal" role="document">

 		<form action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="http://localhost/siakad/guru_instal/insert_kelas" method="post" enctype="multipart/form-data">
 			<div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
 				<div class="modal-header">
 					<h4 class="modal-title col-teal" id="defaultModalLabel"> <span class="titles"></span> </h4>

 				</div>
 				<div class="modal-body">

 					<div id="view" class="table-responsive"></div>

 				</div>
 			</div>


 	</div>
 	</form>
 </div><!-- /.modal-dialog -->
 <div id="md-kikd" class="modal fade" role="dialog">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" onclick="md_close('md-kikd')">&times;</button>
 				<h4 class="modal-title">Detail Jumlah KIKD <span id="lkelas"></span></h4>
 			</div>
 			<div class="modal-body">
 				<div class="table-responsive">
 					<table class="entry">
 						<thead class=" bg-teal">
 							<tr style="color:white;font-weight: bold;">
 								<td>NO</td>
 								<td>KD3</td>
 								<td>KD3:KB</td>
 								<td>KD3:DESKRIPSI</td>
 								<td>KD4</td>
 								<td>KD4:KB</td>
 								<td>KD4:DESKRIPSI</td>
 							</tr>
 						</thead>
 						<tbody id="dt-kikd"></tbody>
 					</table>
 				</div>
 			</div>
 		</div>

 	</div>
 </div>

 <div id="md-pertemuan" class="modal fade" role="dialog">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" onclick="md_close('md-pertemuan')">&times;</button>
 				<h4 class="modal-title">Detail Jumlah Pertemuan</h4>
 			</div>
 			<div class="modal-body">
 				<div class="table-responsive">
 					<table class="entry" width="100%">
 						<thead class=" bg-teal">
 							<tr style="color:white;font-weight: bold;">
 								<td>NO</td>
 								<td>TGL</td>
 								<td>KD.NO</td>
 								<td>PEMBAHASAN</td>
 							</tr>
 						</thead>
 						<tbody id="dt-pertemuan"></tbody>
 					</table>
 				</div>
 			</div>
 		</div>

 	</div>
 </div>