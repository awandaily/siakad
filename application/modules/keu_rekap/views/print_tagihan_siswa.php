
<style type="text/css">
	.bs-searchbox{
		margin-left: 30px;
	}
	.dropdown-menu .inner{
		margin-left: 30px !important;
	}
</style>


<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card" >
            <div class="header">
            	<h2 class="sound">PRINT TAGIHAN SISWA</h2>
            </div>
            <div class="body" >
            	<div class="row" style="padding: 10px;">
            		<div class="col-md-4">
            			Pilih Kelas telebih dahulu : <br/>
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
            		<div class="col-md-4">
            			Sampai Tagihan Tanggal : <br/>
            			<input type="text" class="form-control" id="tgl">
            		</div>
            		<div class="col-md-4">
            			<span style="color:white">Sampai Tagihan Tanggal : </span><br/>
            			<button class="btn waves-effect bg-teal" onclick="printTagihan()"><i class="material-icons">print</i> Print</button>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>     

<script type="text/javascript">

function printTagihan(){

	var id_kelas 	= $("#fkelas").val();
	var tgl 		= $("#tgl").val();

	if (id_kelas!=="" && tgl !=="") {
		window.open("<?php echo base_url() ?>keu_rekap/print_tagihan_siswa_pdf?id_kelas="+id_kelas+"&tgl="+tgl, '_blank');
	}


}

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
	            "M",
	            "S",
	            "S",
	            "R",
	            "K",
	            "J",
	            "S"
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
	    "startDate": "<?php echo date("d/m/Y")?>",
	   
	});
</script>