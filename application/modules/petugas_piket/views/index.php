 <script>
 	$('select').selectpicker();

 	function setPetugas(hari) {
 		loading();
 		var id_guru = $("#nama" + hari).val();
 		$.post("<?php echo site_url("petugas_piket/set"); ?>", {
 			id_guru: id_guru,
 			hari: hari
 		}, function(data) {
 			unblock();
 			notif("Berhasil di simpan!");
 		})
 	}
 </script>




 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 	<?php
		for ($i = 1; $i <= 5; $i++) { ?>

 		<div class="col-lg-12 col-md-12 col-xs-12 card "><br>
 			<center class='col-teal font-bold'><?php echo strtoupper($this->tanggal->nama_hari($i)) ?> </center>
 			<div class="form-group">
 				<div class="form-line">
 					<?php
						$value = $this->m_reff->goField("tr_jadwal_piket", "id_guru", "where id_hari='" . $i . "' ");
						$db = $this->db->get_where("data_pegawai")->result();
						$ray = array();
						$ray[""] = " ==== Pilih ====";
						foreach ($db as $val) {
							$ray[$val->id] = $val->nama . ' - Nip. ' . $val->nip;
						}
						$dataray = $ray;
						echo form_dropdown("id_guru", $dataray, $value, 'class="form-control show-tick" id="nama' . $i . '" onchange="setPetugas(`' . $i . '`)" data-live-search="true"');
						?>
 				</div><br>
 			</div>

 		</div>
 	<?php } ?>

 </div>