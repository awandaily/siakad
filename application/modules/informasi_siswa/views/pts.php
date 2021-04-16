<div class="row clearfix">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="frame_1">
		<div class="card">
			<div class="header row">

				<div class="col-md-3">
					<h4>FORMAT PTS/PAS SISWA</h4>
				</div>

			</div>
			<div class="body" >
				<br>
				<div class="col-md-12">
					<div class="col-md-3">
						<select class="form-control show-tick" id="fjenis">
	                        <option value="">=== Pilih Jenis Ujian ===</option>
							<option value="PTS">PTS</option>
							<option value="PAS">PAS</option>
							<option value="PRAUJIKOM">PRAUJIKOM</option>
						</select>
					</div>
					<div class="col-md-3">
						Cari Berdasarkan ?<br>
						<span class="size">
							<input type="radio" value="1" checked="" class="filled-in chk-col-pink" id="id4" name="cari">
							<label for="id4">Per Kelas</label> 
						</span>
						<span class="size">
							<input type="radio" value="2" class="filled-in chk-col-pink" id="id1" name="cari">
							<label for="id1">Per Siswa</label> 
						</span>
					</div>
					<div class="col-md-4">
						<div id="wkelas">
							<select class="form-control show-tick" id="fkelas" data-live-search="true" >
		                        <option value="">=== Pilih Kelas ===</option>
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
						<div id="wsiswa" style="display: none">
							<select name='idsiswa[]' id='idsiswa' multiple='' class='form-control show-tick' data-live-search='true' data-actions-box='true'>
								<?php

									$this->db->order_by("nama", "asc");
									$this->db->where_in("id_sts_data", array("1", "4"));
									$d = $this->db->get("v_siswa")->result();
									$n = 1;
									foreach ($d as $v) {
										echo "<option value='".$v->id."'>".$v->nama." - ".$v->nama_kelas."</option>";

										$n++;
									}


								?>
							</select>
						</div>
						
					</div>

				</div>
				<div class="col-md-12">
					<div class="col-md-4">
						Bulan & Tahun Kartu : <br>
						<input type="text" placeholder="Ex : Februari 2020" class="form-control" id="bln" name="bln">
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-1">
						<button class="btn waves-effect bg-teal" onclick="get_kelas()"><i class="material-icons">print</i> Print</button>
					</div>
					<!--
					<div class="col-md-2">
						
						<button onclick="download_word()" class="btn waves-effect bg-teal"><i class="material-icons">file_download</i> Download Word</button>
					</div>-->
				</div>
				<iframe src="" style="width: 100%;height: 700px;" id="fr"></iframe>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
//$('#idsiswa').selectpicker();


/*
$(document).ready(function(){
});*/

	$("input[name='cari']").click(function(){
		var cari = $("input[name='cari']:checked").val();
		if (cari == "2") {
			$("#wsiswa").fadeIn();
			$("#wkelas").hide();
			$('#idsiswa').selectpicker();
		}
		else{
			$("#wsiswa").hide();
			$("#wkelas").fadeIn();
		}
	});

	function get_siswa(id){

		if (id!=="") {

			$.post('<?php echo base_url()?>informasi_siswa/get_siswa', { idkelas:id }, function(data){
				$("#sel_siswa").html(data);
				$('#idsiswa').selectpicker();

		  	});
		}
		else{
			$("#sel_siswa").html("");
		}

	}


	function download_word(){
		//alert("ada");
		
		var id 		= $("#fkelas").val();
		var jenis 	= $("#fjenis").val();
		var bln 	= $("#bln").val();
		if (id!=="" && jenis!=="") {
			window.open("<?php echo base_url() ?>informasi_siswa/pts_format_word?id="+id+"&jenis="+jenis+"&bln="+bln, '_blank');
		}
		else{
			alert("Lengkapi form Kelas dan Jenis !");
			
		}
		
	}


	function get_kelas(){
		//alert("ada");
		var cari 	= $("input[name='cari']:checked").val();
		var bln 	= $("#bln").val();

		if (cari=="2") {
			var id 		= $("#idsiswa").val();
		}
		else{
			var id 		= $("#fkelas").val();
		}

		var jenis 	= $("#fjenis").val();
		if (id!=="" && jenis!=="") {
			loading("frame_1");
			$("#fr").attr("src", "<?php echo base_url() ?>informasi_siswa/pts_format?id="+id+"&jenis="+jenis+"&cari="+cari+"&bln="+bln);
			setTimeout(function(){ unblock("frame_1"); }, 45000);
		}
		else{
			alert("Lengkapi form Kelas dan Jenis !");
			$("#fr").attr("src", "");
		}
		
	}
</script> 