<?php $token = date("His"); ?>

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div>
	<?php
			$semester = $this->m_reff->semester();
			$tahun_real = $this->m_reff->tahun_asli();
			$tahun_kini = $this->m_reff->tahun();
			if ($tahun_real == $tahun_kini) {
				$idkelas = $this->m_reff->goField("tm_kelas", "id", "where id_wali='" . $this->mdl->idu() . "'");
			} else {

				$getIdSiswa = $this->m_reff->goField("tm_catatan_walikelas", "id_siswa", "where _cid='" . $this->mdl->idu() . "' and id_tahun='" . $tahun_kini . "'   limit 1");
				$idkelas = $this->m_reff->getHisKelas($getIdSiswa);
			}
			?>
		<h4 class="content-title mb-2">DATA NILAI TAHUN AJARAN <?php echo $this->m_reff->tahun_ajaran($tahun_kini); ?></h4>
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
					<?php
					if ($this->m_reff->history_ajaran()) { ?>
						<button onclick="kirim()" class="text-white border-white btn btn-outline-info btn-rounded btn-block"> INPUT NILAI</button>
					<?php } ?>
					</span>
				</div>

			</div>
			<div class="d-flex justify-content-center">
				<div class="">
				
				</div>

			</div>
		</div>
	</div>
</div>
<!-- /breadcrumb -->

<!-- Task Info -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">
		<div class="card-header pb-0">
			<div class="demo-button-group">
				<div class="btn-group pull-right" role="group">
				</div>
			</div>
			<h2></h2>

		</div>
		<div class="body">
			<!--           <div class="row clearfix">
						 <div class="col-md-3">
                                    <select class="form-control idknilai show-tick k_nilai<?php echo $token; ?>" id="k_nilai"  onchange="selectKate()">
                                        <option value="">--- Filter Ujian ---</option>
                                         <?php
											$dbkelas = $this->mdl->dataKategoryNilai();
											foreach ($dbkelas as $val) {
												echo "<option value='" . $val->id . "'>" . $val->nama . "</option>";
											}
											?>
                                    </select>
                                </div>
								
								<div class="col-md-3" >
                                    <select class="form-control show-tick id_kelas<?php echo $token; ?>" id="id_kelas" name='id_kelas' onchange="pilihKelas()">
                                        <option value="">--- Filter Kelas ---</option>
                                         <?php
											$dbkelas = $this->mdl->dataKelasAjar();
											foreach ($dbkelas as $val) {
												echo "<option value='" . $val->id_kelas . "'>" . $this->m_reff->goField("v_kelas", "nama", "where id='" . $val->id_kelas . "'") . "</option>";
											}
											?>
                                    </select>
                                </div>
                    
                                <div class="col-md-3" id="hasilKelas">
                                    <select class="form-control show-tick id_mapel<?php echo $token; ?>"   name='id_mapel'>
                                        <option value="">--- Filter Mata Pelajaran ---</option>
                                       <?php
										$dbmepel = $this->mdl->dataMapelAjar();
										foreach ($dbmepel as $val) {
											echo "<option value='" . $val->id_mapel . "'>" . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $val->id_mapel . "'") . "</option>";
										}
										?>
                                    </select>
                                </div>
								<div class="col-md-3" id="fkikd">
                              <select class="form-control show-tick semester<?php echo $token; ?>" id="semester" >
                                        <option value="">--- Filter KI.KD ---</option>
                                         
                                    </select>
                                </div>
                           </div>--->

			<div id="area_lod">
				<div class="bodys">
					<div class="table-responsive">
						<table id='tabel' class="table table-bordered mg-b-0 text-md-nowrap" width="100%">
							<thead class='bg-gray-300' style="font-size:12px;width:100%">

								<tr class='bg-white'>
									<td colspan="2"> <select class="form-control idknilai show-tick k_nilai<?php echo $token; ?>" id="k_nilai" onchange="selectKate()">
											<option value="">--- Filter Ujian ---</option>
											<?php
											$dbkelas = $this->mdl->dataKategoryNilai();
											foreach ($dbkelas as $val) {
												echo "<option value='" . $val->id . "'>" . $val->nama . "</option>";
											}
											?>
										</select></td>


									<td colspan="2">
										<div>
											<select class="form-control show-tick id_kelas<?php echo $token; ?>" id="id_kelas" name='id_kelas' onchange="pilihKelas()">
												<option value="">--- Filter Kelas ---</option>
												<?php
												$dbkelas = $this->mdl->dataKelasAjar();
												foreach ($dbkelas as $val) {
													echo "<option value='" . $val->id_kelas . "'>" . $this->m_reff->goField("v_kelas", "nama", "where id='" . $val->id_kelas . "'") . "</option>";
												}
												?>
											</select>
										</div>
									</td>


									<td colspan="2">
										<div id="hasilKelas">
											<select class="form-control show-tick id_mapel<?php echo $token; ?>" name='id_mapel'>
												<option value="">--- Filter Mata Pelajaran ---</option>
												<?php
												$dbmepel = $this->mdl->dataMapelAjar();
												foreach ($dbmepel as $val) {
													echo "<option value='" . $val->id_mapel . "'>" . $this->m_reff->goField("tr_mapel", "nama", "where id='" . $val->id_mapel . "'") . "</option>";
												}
												?>
											</select>
										</div>
									</td>


									<td colspan="2">
										<div id="fkikd">
											<select class="form-control show-tick semester<?php echo $token; ?>" id="semester">
												<option value="">--- Filter KI.KD ---</option>

											</select>
										</div>
									</td>
								</tr>


								<th class='thead' style='max-width:30px'>NO</th>
								<th class='thead' style='min-width:125px'>PROCESS</th>
								<th class='thead'>TANGGAL</th>
								<th class='thead'>UJIAN</th>

								<th class='thead' width="50px">KELAS </th>
								<th class='thead' width="150px"> MAPEL </th>

								<th class='thead' width="100px">KIKD</th>
								<th class='thead' width="150px"> KET </th>

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
		"responsive": false,
		"searching": true,
		"lengthMenu": [
			[10, 30, 50, 100, 200, 300, 400, 500],
			[10, 30, 50, 100, 200, 300, 400, 500]
		],


		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": "<?php echo site_url('kesiswaan/data_nilai'); ?>",
			"type": "POST",
			"data": function(data) {

				data.id_kelas = $('#id_kelas').val();
				data.id_mapel = $('#id_mapel').val();
				data.semester = $('#semester').val();
				data.id_kikd = $('#fid_kikd').val();
				data.k_nilai = $('#k_nilai').val();

			},
			beforeSend: function() {
				loading("area_lod");
			},
			complete: function() {
				$('#area_lod').unblock(); 
			},
		},

		//Set column definition initialisation properties.
		"columnDefs": [{
			"targets": [0, -1, -2, -3, -4], //last column
			"orderable": false, //set not orderable
		}, ],

	});



	var x = 0;

	function reload() {
		dataTable.ajax.reload(null, false);

	};

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

	function kirim() {
		$("#formSubmit")[0].reset();
		$("#judul_mdl").html("INPUT NILAI ");
		$("#isi").html("mohon tunggu...");
		$("#mdl_formSubmit").modal({
			backdrop: 'static',
			keyboard: false
		});
		$("#formSubmit").attr("url", "<?php echo base_url("kesiswaan/kirimMateri"); ?>");
		$("#ket_file").html("File Materi");
	}

	function sync() {
		$("#judul_mdlsync").html("INPUT NILAI ");
		$("#modal-title").html("SINKRONISASI NILAI ");
		$("#isisync").html(data);
		$("#mdl_formSubmitsync").modal();
		$("#formSubmitsync").attr("url", "<?php echo base_url("kesiswaan/kirimMateri"); ?>");

	}

	function tutup() {
		$("#mdl_formSubmit").modal("hide");
	}

	function edit(id) {
		$("#mdl_edit_nilai").modal({
			backdrop: 'static',
			keyboard: false
		});
		$.post("<?php echo site_url("kesiswaan/editNilai"); ?>", {
			id: id
		}, function(data) {
			$("#hasilEditNilai").html(data);
		});
	}

	function hapus(id, judul = null, kelas = null) {
		alertify.confirm("<center>Hapus ?  <br> <span><b>" + judul + " </b>Kelas<b> " + kelas + "</b></span>  </center>", function() {
			$.post("<?php echo site_url("kesiswaan/hapus_nilai"); ?>", {
				id: id
			}, function() {
				notif("Data berhasil dihapus !!");
				reload_table();
			})
		})
	};

	function reload_table() {
		dataTable.ajax.reload(null, false);
	}

	function input() {
		var pil = $('[name="kd[]"] option:selected').length;


		loading("mdl_input");
		var kelas = $("[name='f[id_kelas]']").val();
		var mapel = $("[name='f[id_mapel]']").val();
		var kikd = $("[name='kd[]']").val();
		var nama_nilai = $("[name='f[nama_nilai]']").val();
		var k_nilai = $("[name='k_nilai']").val();
		var nama = $("[name='f[nama_nilai]']").val();

		if (pil > 1) {

			notif("Maaf!!<br> Untuk input nilai dengan cara ini hanya boleh pilih 1 KD saja.");
			return false;


		}
		if (pil < 1) {
			if (k_nilai == "1") {
				notif("Maaf!!<br> Silahkan pilih 1 KD Penilaian.");
				return false;
			}

		}

		if (k_nilai != 1) {
			kikd = true;
		}
		if (kelas == "" || mapel == "" || k_nilai == "" || nama == "" || kikd == "") {
			notif("Isi dan pilih inputan terlebih dulu.");
			return false;
		}

		$.post("<?php echo site_url("kesiswaan/getDataSiswa"); ?>", {
			kikd: kikd,
			kelas: kelas,
			mapel: mapel,
			nama_nilai: nama_nilai,
			k_nilai: k_nilai
		}, function(data) {
			$("#isi_mdl_input").html(data);
			$("#mdl_input").modal({
				backdrop: 'static',
				keyboard: false
			});
		});
		unblock("mdl_input");

		$("#formSubmit")[0].reset();
		$("#mdl_formSubmit").modal("hide");
	}

	function pilihKelas() {
		var mapel_un = 0;
		var kelas = $("#id_kelas").val();
		$.post("<?php echo site_url("kesiswaan/getPilihanMapel"); ?>", {
			kelas: kelas,
			mapel_un: mapel_un
		}, function(data) {
			$("#hasilKelas").html(data);
		});
		reload();
	}

	function pilihKelasInput() {
		loading("hasilKelasInput");
		var kelas = $("#kelas").val();
		var mapel_un = $("#mapel_un").val();
		$.post("<?php echo site_url("kesiswaan/getPilihanMapelInput"); ?>", {
			kelas: kelas,
			mapel_un: mapel_un
		}, function(data) {
			$("#hasilKelasInput").html(data);
			unblock("hasilKelasInput");
			getKikd();
		});
	}

	function kategory() {
		var kategory = $("[name='k_nilai']").val();
		$.post("<?php echo site_url("kesiswaan/getPilihanKelasnya"); ?>", {
			kategory: kategory
		}, function(data) {
			$("#hasilK").html(data);
			pilihKelasInput();
			getKikd();
		});
		if (kategory == 2 || kategory == 3) {
			$("#kikd").hide();


		} else {
			$("#kikd").show();


		}
	}

	function selectKate() {
		var kategory = $("#k_nilai").val();
		$.post("<?php echo site_url("kesiswaan/getPilihanClassnya"); ?>", {
			kategory: kategory
		}, function(data) {
			$("#hasilKate").html(data);


			pilihKelas();
		});
	}

	function pilihUjian(kelas) {
		$.post("<?php echo site_url("kesiswaan/getPilihanUjian"); ?>", {
			kelas: kelas
		}, function(data) {
			$("#hasilUjian").html(data);
		});
	}

	function getKikd() {
		loading("kikd");
		var mapel = $("[name='f[id_mapel]']").val();
		var kelas = $("[name='f[id_kelas]']").val();
		$.post("<?php echo site_url("kesiswaan/getKikd"); ?>", {
			mapel: mapel,
			kelas: kelas
		}, function(data) {
			$("#kikd").html(data);
			unblock("kikd");
		});

	}

	function getKikdFilter() {
		var mapel = $("#id_mapel").val();
		var ma = $("#id_kelas").val();
		$.post("<?php echo site_url("kesiswaan/getKikdFilter"); ?>", {
			mapel: mapel,
			ma: ma
		}, function(data) {
			$("#fkikd").html(data);
		});
		reload();
	}

	function close_mdl() {
		$("#mdl_input").modal("hide");
		dataTable.ajax.reload(null, false);
	}

	function close_mdl_edit() {
		$("#mdl_edit_nilai").modal("hide");
		dataTable.ajax.reload(null, false);
	}
</script>

<div class="modal fade" id="mdl_edit_nilai" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">

		<div class="modal-content"> <span title="tutup" onclick="close_mdl_edit()" class="pull-right waves-effect"><i class="material-icons">cancel</i> </span>
			<div class="modal-header">
				<h4 class="modal-title col-teal"> EDIT DATA NILAI </h4>
			</div>
			<div class="modal-body">

				<div id="hasilEditNilai"> </div>

			</div>
		</div>

	</div><!-- /.modal-dialog -->
</div><!-- /.modal-dialog -->



<div class="modal fade" id="mdl_input" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">

		<div class="modal-content"> <span title="tutup" onclick="close_mdl()" class="pull-right waves-effect"><i class="material-icons">cancel</i> </span>
			<div class="modal-header">
				<h4 class="modal-title col-teal"> INPUT NILAI </h4>
			</div>
			<div class="modal-body">

				<div id="isi_mdl_input"> </div>

			</div>
		</div>

	</div><!-- /.modal-dialog -->
</div><!-- /.modal-dialog -->



<!-- Modal -->
<div class="modal fade" id="mdl_formSubmit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" id="area_formSubmit">
		<div class="modal-content">
			<form id="formSubmit" action="javascript:submitForm('formSubmit')" method="post">

				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" onclick="tutup()" class="close" data-dimdiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title col-teal" id="judul_mdl">

					</h4>
				</div>

				<!-- Modal Body -->
				<div class="modal-body">
					<div class="col-md-12 body">

						<div class="row">

							<div class="col-md-12 " id="hasilUjian" style="padding-bottom:15px">
								<label> Pilih Ujian</label>
								<select class="form-control show-tick" name="k_nilai" onchange="kategory()">
									<option value="">--- Pilih Ujian ---</option>
									<?php
									$k_nilai = $this->mdl->dataKategoryNilai();
									foreach ($k_nilai as $val) {
										if ($this->m_reff->semester() == 2 and $val->id == 3) {
											$n = "UKK";
										} else {
											$n = $val->nama;
										}
										echo "<option value='" . $val->id . "'>" . $n . "</option>";
									}
									?>
								</select>
							</div>
							<div class="col-md-12">
								<label> Pilih Kelas</label>
								<select class="form-control show-tick" id="kelas" name="f[id_kelas]" required onchange="pilihKelasInput()">
									<option value="">--- Pilih Kelas ---</option>
									<?php

									foreach ($dbkelas as $val) {
										echo "<option value='" . $val->id_kelas . "'>" . $this->m_reff->goField("v_kelas", "nama", "where id='" . $val->id_kelas . "'") . "</option>";
									}
									?>
								</select>

							</div>
						</div><br>
						<div class="row">



							<div id="hasilKelasInput" style="padding-bottom:15px">
								<div class="col-md-12">
									<label> Pilih Mata Pelajaran</label>
									<select class="col-md-12 form-control show-tick" id="mapel" required name="f[id_mapel]">
										<option value="">--- Pilih Mata Pelajaran ---</option>
										<!--
									    foreach($dbmepel as $val){
										   echo "<option value='".$val->id_mapel."'>".$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."'")."</option>";
									   
									   ?>-->
									</select>
								</div>

							</div>
							<br>
							<div class="col-md-12" id='kikd'>
								<label><br> Pilih KD Penilaian</label>
								<select class="form-control show-tick" required name="f[id_kikd]">
									<option value="">--- Pilih KI.KD ---</option>

									<!--   foreach($dbmepel as $val){
										   echo "<option value='".$val->id_mapel."'>".$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."'")."</option>";
									   }-->

								</select>
							</div>
							<div class="clearfix row col-md-12">&nbsp;</div>
							<div class="col-md-12">
								<label>Keterangan Nilai</label>
								<input type="text" class="form-control" required placeholder="Wajib diisi (contoh: Praktek ke-1 ) " name="f[nama_nilai]" />

								<!--  <span class="col-black">Keterangan nilai tidak boleh sama jika masih dalam 1 KD yg pernah diinput</span>--->
							</div>
						</div>

						<br>

						<div class="row" align="center">
							<div class="demo-button-groups">
								<div class="btn-group" role="group">
									<button type="button" onclick="import_data()" class="btn bg-teal waves-effect waves-light">IMPORT Ms.Excell</button>
									<button type="button" onclick="input()" class="btn bg-blue-grey waves-effect waves-light">INPUT LANGSUNG</button>
								</div>

							</div>
						</div><br>

					</div>
				</div>
				<div class="row clearfix"></div>

			</form>

		</div>
	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="mdl_formSubmitsync" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" id="area_formSubmitsync">
		<div class="modal-content">
			<form id="formSubmit" action="javascript:submitForm('formSubmitsync')" method="post">

				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title col-teal" id="judul_mdlsync">

					</h4>
				</div>

				<!-- Modal Body -->
				<div class="modal-body">
					<div class="col-md-12 body">

						<div class="row">

							<div class="col-md-12 " id="hasilUjian" style="padding-bottom:15px">
								<select class="form-control show-tick" name="k_nilai" onchange="kategory()">
									<option value="">--- Pilih Ujian ---</option>
									<?php
									$k_nilai = $this->mdl->dataKategoryNilai();
									foreach ($k_nilai as $val) {
										echo "<option value='" . $val->id . "'>" . $val->nama . "</option>";
									}
									?>
								</select>
							</div>
							<div class="col-md-12">

								<select class="form-control show-tick" id="kelas" name="f[id_kelas]" required onchange="pilihKelasInput()">
									<option value="">--- Pilih Kelas ---</option>
									<?php

									foreach ($dbkelas as $val) {
										echo "<option value='" . $val->id_kelas . "'>" . $this->m_reff->goField("v_kelas", "nama", "where id='" . $val->id_kelas . "'") . "</option>";
									}
									?>
								</select>

							</div>
						</div><br>
						<div class="row">



							<div class="col-md-12" id="hasilKelasInput" style="padding-bottom:15px">

								<select class="form-control show-tick" id="mapel" required name="f[id_mapel]">
									<option value="">--- Pilih Mata Pelajaran ---</option>
									<!--
									    foreach($dbmepel as $val){
										   echo "<option value='".$val->id_mapel."'>".$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."'")."</option>";
									   
									   ?>-->
								</select>

							</div>

							<div class="col-md-12" id='kikd'>
								<select class="form-control show-tick" required name="f[id_kikd]">
									<option value="">--- Pilih KI.KD ---</option>

									<!--   foreach($dbmepel as $val){
										   echo "<option value='".$val->id_mapel."'>".$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."'")."</option>";
									   }-->

								</select>
							</div>
							<div class="clearfix row col-md-12">&nbsp;</div>
							<div class="col-md-12">
								<input type="text" class="form-control" required placeholder="Keterangan" name="f[nama_nilai]" />
							</div>
						</div>

						<br>

						<div class="row" align="center">
							<div class="demo-button-groups">
								<div class="btn-group" role="group">
									<button type="button" onclick="input()" class="btn bg-blue-grey waves-effect waves-light">SINKRONISASI SEKARANG</button>
								</div>
							</div>
						</div><br>

					</div>
				</div>
				<div class="row clearfix"></div>

			</form>

		</div>
	</div>
</div>





<script>
	function import_data() {
		var id_mapel = $("[name='f[id_mapel]']").val();
		var k_nilai = $("[name='k_nilai']").val();
		var kikd = $("[name='kd[]']").val();
		var ket = $("[name='f[nama_nilai]']").val();
		var id_kelas = $("[name='f[id_kelas]']").val();
		if (k_nilai != 1) {
			kikd = true;
		}
		var pil = $('[name="kd[]"] option:selected').length;
		if (pil < 1) {
			if (k_nilai == "1") {
				notif("Maaf!!<br> Silahkan pilih KD terlebih dahulu.");
				return false;
			}

		}

		if (id_kelas == "" || id_mapel == "" || k_nilai == "" || ket == "" || kikd == "") {
			notif("Isi dan pilih inputan terlebih dulu.");
			return false;
		} else {
			tutup();
		}


		$("#formSubmitDown")[0].reset();
		$("#judul_mdl").html("IMPORT DATA NILAI ");
		$("#isi").html(data);
		$("#mdl_formSubmitDown").modal();
		if (k_nilai == 1) {
			$("#formSubmitDown").attr("url", "<?php echo base_url(); ?>kesiswaan/import_data_nilai_multi?k_nilai=" + k_nilai + "&id_mapel=" + id_mapel + "&kikd=" + kikd + "&ket=" + ket + "&id_kelas=" + id_kelas);
		} else {
			$("#formSubmitDown").attr("url", "<?php echo base_url(); ?>kesiswaan/import_data_nilai?k_nilai=" + k_nilai + "&id_mapel=" + id_mapel + "&kikd=" + kikd + "&ket=" + ket + "&id_kelas=" + id_kelas);

		}
		$("#ket_file").html("Cari File");
	}

	function downloadForm() {


		var id_mapel = $("#mapel").val();
		var kelas = $("#kelas").val();
		var sts = $("[name='k_nilai']").val();
		window.open("<?php echo base_url() ?>kesiswaan/download_format_nilai?ujian=" + sts + "&id_kelas=" + kelas + "&id_mapel=" + id_mapel, "_blank");
	}
</script>






<!-- Modal -->
<div class="modal fade" id="mdl_formSubmitDown" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" id="area_formSubmitDown">
		<div class="modal-content ">
			<form id="formSubmitDown" action="javascript:submitForm('formSubmitDown')" method="post">

				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title col-teal" id="judul_mdl">
						IMPORT DATA NILAI
					</h4>
				</div>

				<!-- Modal Body -->
				<div class="modal-body">
					<div class="col-md-12 body">
						<center> <span class="sound col-blue cursor" target='_blank' onclick="downloadForm()">Download Format Upload</span> </center>

						<div class="row">

							<div class="form-line"><span id="ket_file"> </span>
								<input type="file" accept="xlsx" class="form-control" name="file" required />
							</div>
						</div><br>


					</div>
				</div>
				<div class="row clearfix"></div>
				<div class="modal-footer">

					<button onclick="submitForm('formSubmitDown')" class="pull-right waves-effect btn bg-teal"><i class="material-icons">cloud_upload</i> UPLOAD</button>

				</div>
			</form>

		</div>
	</div>
</div>