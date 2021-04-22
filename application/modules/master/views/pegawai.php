  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
  	<br>

  </div>
  </div>
  <!-- /breadcrumb -->

  <?php
	$token = date('His');
	?>
  <div class="row clearfix">
  	<!-- Task Info -->
  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  		<div class="card">
  			<div class="header">



  				<div class="btn-group pull-right" role="group">
  					<button onclick="import_data()" class="btn bg-teal waves-effect"><i class="material-icons">file_download</i>IMPORT DATA</button>
  					<button onclick="input()" class="pull-right waves-effect btn bg-blue-grey"><i class="material-icons">person_add</i> INPUT </button>
  				</div>


  				<h2>DATA PEGAWAI</h2>

  			</div>
  			<div class="body">
  				<div class="row clearfix">

  					<div class="col-sm-3">
  						<select class="form-control show-tick" id="jabatan" data-live-search="true">
  							<option value="">=== Pilih Jabatan ===</option>
  							<?php
								$db = $this->db->get("tr_jabatan")->result();
								foreach ($db as $val) {
									echo "<option value='" . $val->id . "'>" . $val->nama . "</option>";
								}
								?>
  						</select>
  					</div>



  					<div class="col-sm-3">
  						<select class="form-control show-tick" id="gender">
  							<option value="">=== Pilih Gender ===</option>
  							<option value="l">Laki-laki</option>
  							<option value="p">Perempuan</option>

  						</select>
  					</div>


  					<div class="col-sm-4">
  						<select class="form-control show-tick" id="id_mapel" data-live-search="true">
  							<option value="">=== Pilih Mapel Yang Diampu ===</option>
  							<?php
								$dbmepel = $this->mdl->dataMapel();
								foreach ($dbmepel as $val) {
									echo "<option value='" . $val->id_mapel . "'>" . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $val->id_mapel . "'") . "</option>";
								}
								?>
  						</select>
  					</div>

  					<div class="col-sm-2">
  						<button class="btn bg-blue-grey btn-block" onclick="filter()"><i class="material-icons">filter_list</i>FILTER </button>
  					</div>


  				</div>

  				<div class="card" id="area_lod">
  					<div class="body">
  						<div class="table-responsive">
  							<table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable">
  								<thead class='sadow bg-teal' style="font-size:12px;width:100%">
  									<th class='thead' style='max-width:3px'>NO</th>
  									<!--	<th class='thead' style='max-width:3px'>INSTAL</th>
								-->
  									<th class='thead'>PHOTO</th>
  									<th class='thead'>NAMA</th>
  									<th class='thead'>GENDER</th>
  									<th class='thead'>JABATAN</th>
  									<th class='thead'>TMT</th>
  									<th class='thead'>PANGKAT/GOL</th>
  									<th class='thead'> KODE SISTEM </th>
  									<th class='thead'> NIP </th>
  									<th class='thead'> NUPTK </th>
  									<th class='thead'> HP </th>
  									<th class='thead'> EMAIL </th>
  									<th class='thead'> ALAMAT </th>
  									<th class='thead'>GURU KELAS</th>
  									<!--		<th class='thead'> MAPEL AJAR</th>-->

  									<th class='thead'>TEMPAT LAHIR</th>
  									<th class='thead'>TANGGAL LAHIR</th>
  									<th class='thead'>IJAZAH</th>
  									<th class='thead'>STATUS PEGAWAIAN</th>
  									<th class='thead'>AKTIFASI</th>
  									<th class='thead' style='min-width:135px'>PROCESS</th>

  								</thead>
  							</table>
  						</div>
  					</div>
  				</div>
  				<!----->
  			</div>
  		</div>
  	</div>
  	<!-- #END# Task Info -->




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
  			"responsive": true,
  			"searching": true,
  			"lengthMenu": [
  				[10, 30, 50, 100, 200, 300, 400, 500],
  				[10, 30, 50, 100, 200, 300, 400, 500]
  			],
  			dom: 'Blfrtip',
  			buttons: [
  				// 'copy', 'csv', 'excel', 'pdf', 'print'

  				{
  					extend: 'excel',
  					exportOptions: {
  						columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
  					},
  					text: 'Download Excell',

  				},

  				/*			{
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
					 */

  			],

  			// Load data for the table's content from an Ajax source
  			"ajax": {
  				"url": "<?php echo site_url('master/data_pegawai'); ?>",
  				"type": "POST",
  				"data": function(data) {

  					data.id_kelas = $('#id_kelas').val();
  					data.id_mapel = $('#id_mapel').val();
  					data.sts = $('#sts').val();
  					data.gender = $('#gender').val();

  					data.jabatan = $('#jabatan').val();
  					data.aktifasi = $('#aktifasi').val();
  					data.pangkat = $('#pangkat').val();

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

  		function edit(id) {
  			$("#judul_mdl_edit").html("EDIT DATA GURU ");
  			$("#mdl_formSubmit_edit").modal();
  			$("#formSubmit_edit").attr("url", "<?php echo base_url("master/update_data_guru"); ?>");
  			$.post("<?php echo site_url("master/edit_data_guru"); ?>", {
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
  	<div class="modal fade" id="mdl_filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog" id="area_formSubmit">
  			<div class="modal-content">

  				<!-- Modal Header -->
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal">
  						<span aria-hidden="true">&times;</span>
  						<span class="sr-only">Close</span>
  					</button>
  					<h4 class="modal-title col-teal"> FILTER PENCARIAN </h4>
  				</div>

  				<!-- Modal Body -->
  				<div class="modal-body">
  					<div class="col-md-12 body">

  						<form class="form-horizontal">



  							<div class="row clearfix">
  								<div class="col-lg-4 col-md-4  form-control-label">
  									<label for="email_address_2" class="col-black">Status Kepegawaian</label>
  								</div>
  								<div class="col-lg-8 col-md-8  ">
  									<div class="form-group">
  										<div class="form-line">
  											<select class="form-control show-tick" id="sts">
  												<option value="">--- Pilih ---</option>
  												<?php
													$dbkelas = $this->mdl->dataStatusKepegawaian();
													foreach ($dbkelas as $val) {
														echo "<option value='" . $val->id . "'>" . $val->nama . "</option>";
													}
													?>
  											</select>
  										</div>
  									</div>
  								</div>
  							</div>


  							<div class="row clearfix">
  								<div class="col-lg-4 col-md-4  form-control-label">
  									<label for="email_address_2" class="col-black">Pangkat/Golongan</label>
  								</div>
  								<div class="col-lg-8 col-md-8  ">
  									<div class="form-group">
  										<div class="form-line">
  											<select class="form-control show-tick" id="pangkat" data-live-search="true">
  												<option value="">--- Pilih ---</option>
  												<?php
													$db = $this->db->get("tr_pangkat")->result();
													foreach ($db as $val) {
														echo "<option value='" . $val->id . "'>" . $val->nama . "</option>";
													}
													?>
  											</select>
  										</div>
  									</div>
  								</div>
  							</div>



  							<div class="row clearfix">
  								<div class="col-lg-4 col-md-4  form-control-label">
  									<label for="email_address_2" class="col-black">Wali Kelas Dari</label>
  								</div>
  								<div class="col-lg-8 col-md-8  ">
  									<div class="form-group">
  										<div class="form-line">
  											<select class="form-control show-tick" id="id_kelas" data-live-search="true">

  												<option value="">=== Pilih Kelas ===</option>


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
  									</div>
  								</div>
  							</div>

  							<div class="row clearfix">
  								<div class="col-lg-4 col-md-4  form-control-label">
  									<label for="email_address_2" class="col-black">Status Aktifasi</label>
  								</div>
  								<div class="col-lg-8 col-md-8  ">
  									<div class="form-group">
  										<div class="form-line">
  											<select class="form-control show-tick" id="aktifasi" data-live-search="true">
  												<option value="1" selected>AKTIF</option>
  												<option value="2">NON-AKTIF</option>

  											</select>
  										</div>
  									</div>
  								</div>
  							</div>







  						</form>



  					</div>
  				</div>
  				<div class="row clearfix"></div>
  				<div class="modal-footer">


  				</div>


  			</div>
  		</div>
  	</div>



  	<!-- Modal -->
  	<div class="modal fade" id="mdl_formSubmit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog" id="area_formSubmit">
  			<div class="modal-content">
  				<form id="formSubmit" action="javascript:submitForm('formSubmit')" method="post">

  					<!-- Modal Header -->
  					<div class="modal-header">
  						<button type="button" class="close" data-dismiss="modal">
  							<span aria-hidden="true">&times;</span>
  							<span class="sr-only">Close</span>
  						</button>
  						<h4 class="modal-title col-teal" id="judul_mdl">

  						</h4>
  					</div>

  					<!-- Modal Body -->
  					<div class="modal-body">
  						<div class="col-md-12 body">
  							<center> <a href="<?php echo base_url() ?>master/download_format_guru">Download Format Upload</a> </center>

  							<div class="row">

  								<div class="form-line"><span id="ket_file"> </span>
  									<input type="file" accept="xlsx" class="form-control" name="file" required />
  								</div>
  							</div><br>


  						</div>
  					</div>
  					<div class="row clearfix"></div>
  					<div class="modal-footer">

  						<button onclick="submitForm('formSubmit')" class="pull-right waves-effect btn bg-teal"><i class="material-icons">cloud_upload</i> UPLOAD</button>

  					</div>
  				</form>

  			</div>
  		</div>
  	</div>














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
  								<b>ID SISTEM</b>
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
  								<b>NIP</b>
  								<div class="input-group">
  									<span class="input-group-addon">
  										<i class="material-icons">credit_card</i>
  									</span>
  									<div class="form-line">
  										<input class="form-control" placeholder="Nomor NIP" name="f[nip_asli]" type="text">
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


  							<div class="col-md-6">

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
  							<div class="col-md-6">

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

  							<div class="col-md-6">

  								<b>JABATAN</b>
  								<div class="input-group">
  									<span class="input-group-addon">
  										<i class="material-icons">date_range</i>
  									</span>
  									<div class="form-line">
  										<select class="selectpicker col-md-12  show-tick" onchange="PilihJabatanAdd()" id="jabatanAdd" required name="f[id_jabatan]">
  											<option value="">=== Pilih === </option>
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
  							<div class="col-md-6">

  								<b>SERTIFIKASI PENDIDIK</b>
  								<div class="input-group">
  									<span class="input-group-addon">
  										<i class="material-icons">school</i>
  									</span>
  									<div class="form-line">
  										<?php

											$dataray = array();
											$dataray[""] = "=== Pilih ===";
											$dataray["ya"] = "YA";
											$dataray["tidak"] = "TIDAK";

											echo form_dropdown("f[sertifikasi]", $dataray, "", 'id="sertifikasi" class="col-md-12 selectpicker show-tick"  ');
											?>
  									</div>
  								</div>

  							</div>
  							<div class="row clearfix"></div>
  							<!--	
									 <div class="row clearfix col-md-9">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">UPLOAD FOTO</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                                   <input  class="form-control"  name="file" type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								--->





  							<div class="row clearfix"></div>
  							<div class="col-md-12">
  								<center> <b>HAK AKSES<b><br>
  											<div class="demo-checkbox">

  												<input id="basic_checkbox_1" name="n[]" class="filled-in" type="checkbox" value="1">
  												<label for="basic_checkbox_1" style='text-align:left'>KURIKULUM</label>



  												<input id="basic_checkbox_2" name="n[]" class="filled-in" type="checkbox" value="2">
  												<label for="basic_checkbox_2" style='text-align:left'>KESISWAAN</label>


  												<input id="basic_checkbox_3" name="n[]" class="filled-in" type="checkbox" value="3">
  												<label for="basic_checkbox_3" style='text-align:left'>BPBK</label>



  												<input id="basic_checkbox_4" name="n[]" class="filled-in" type="checkbox" value="4">
  												<label for="basic_checkbox_4" style='text-align:left'>HUMAS</label>


  												<br>

  												<input id="basic_checkbox_5" name="n[]" class="filled-in" type="checkbox" value="5">
  												<label for="basic_checkbox_5" style='text-align:left'>PRODI</label>


  												<span id="basic_checkbox_6_">

  													<input id="basic_checkbox_6" name="n[]" class="filled-in" type="checkbox" value="6">
  													<label for="basic_checkbox_6" style='text-align:left'>MENGAJAR</label>

  												</span>

  												<span id="basic_checkbox_7_">

  													<input id="basic_checkbox_7" name="n[]" class="filled-in" type="checkbox" value="7">
  													<label for="basic_checkbox_7" style='text-align:left'>M.MUTU</label>

  												</span>


  												<span id="basic_checkbox_8_">

  													<input id="basic_checkbox_8" name="n[]" class="filled-in" type="checkbox" value="8">
  													<label for="basic_checkbox_8" style='text-align:left'>SDM</label>

  												</span>

  												<span id="basic_checkbox_9_">

  													<input id="basic_checkbox_9" name="n[]" class="filled-in" type="checkbox" value="9">
  													<label for="basic_checkbox_9" style='text-align:left'>SARPRAS</label>

  												</span>


  												<script>
  													PilihJabatanAdd();

  													function PilihJabatanAdd() {
  														var jab = $("#jabatanAdd").val();

  														if (jab == 3) {
  															$("#basic_checkbox_6_").hide();
  														} else {
  															$("#basic_checkbox_6_").show();
  														}

  													}
  												</script>

  											</div>
  								</center>
  							</div>













  							<div class="col-md-12">
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