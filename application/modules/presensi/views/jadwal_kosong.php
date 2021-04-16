<div class="row clearfix">
    <!-- Task Info -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card" >
            <div class="header">
            	<div class="row">
            		<div class="col-md-6 col-md-6">
	            		<h2>JADWAL KOSONG GURU</h2>
	            	</div>
            		<div class="col-md-2 col-sm-2">
	            		<input type="text" class="form-control tgl" id="src_tgl" />

	            	</div>
                    <div class="col-md-2">
                        <select class="form-control" id="jam">
                            <?php
                                foreach ($jam as $vjam) {
                                    echo "<option value='".$vjam->urut."'>Jam Ke : ".$vjam->urut."</option>";
                                }
                            ?>
                        </select>
                    </div>
	            	<div class="col-md-2 col-sm-2">
	            		<a href="javascript:void(0)" class="btn waves-effect bg-teal" style="float:right" onclick="get_guru()">
	            			<i class="material-icons">search</i> CARI
	            		</a>
	            	</div>
            	</div>
            </div>
            <div class="body" style="min-height: 500px;">
                <div class="row" style="padding: 10px;">
                    <div class="col-md-12">
                        <div class="table-responsive" id="dt"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('.tgl').daterangepicker({
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

    function get_guru(){
        var tgl = $("#src_tgl").val();
        var jam = $("#jam").val();
        if (tgl!=="") {
            /*
            $.post("<?php echo base_url() ?>presensi/getJadwalKosong",{tgl:tgl, jam:jam},function(data){

            });*/

            $.ajax({
                url:"<?php echo base_url() ?>presensi/getJadwalKosong",
                method:"POST",
                cache:false,
                dataType:"json",
                data:{tgl, jam},
                beforeSend:function(){
                    loading("dt");
                },
                success:function(data){

                    var len = data.length;
                    var excel = "<a target='_blank' href='<?php echo base_url() ?>presensi/jadwal_kosong_excel?tgl="+tgl+"&jam="+jam+"' class='btn waves-effect bg-teal' style='float:right'><i class='material-icons'>get_app</i> Download Excel</a><br><br><br>";
                    var dt = excel+"<table class='entry table'>";
                        dt+="<thead>";
                            dt+="<tr>";
                                dt+="<th>Nama Guru</th>";
                                dt+="<th>Jam Ke</th>";
                            dt+="</tr>";
                        dt+="</thead>";
                        dt+="<tbody>";

                            if (len > 0) {
                                for(var i = 0;i < len;i++){
                                    dt+="<tr>";
                                        dt+="<td>"+data[i].nama+"</td>";
                                        dt+="<td align='center'>"+data[i].jam+"</td>";
                                    dt+="</tr>";
                                }
                            }
                            else{
                                dt+="<tr>";
                                    dt+="<td colspan='2' align='center'>TIDAK ADA DATA.</td>";
                                dt+="</tr>";
                            }

                            
                        dt+="</tbody>";
                    dt+="</table>";

                    $("#dt").html(dt);

                },
                complete:function(){
                    unblock("dt");
                }
            });
        }

        
    }
</script> 