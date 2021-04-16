<?php
    $this->load->model("M_reff");  
    $thn = $this->M_reff->tahun();
    $ajaran = $this->M_reff->goField("tr_tahun_ajaran", "nama", "where id = '".$thn."' ");

    $this->db->where("nama!=", "");
    $this->db->order_by("nama", "asc");
    $aj = $this->db->get("tr_tahun_ajaran")->result();
    $sel_ajaran = "";

    foreach ($aj as $vaj) {
        if ($vaj->id == $thn) {
            $sel = "selected";
        }
        else{
            $sel = "";
        }
        $sel_ajaran.= "
            <option value='".$vaj->nama."' ".$sel.">".$vaj->nama."</option>
        ";
    }

    $hthn = "<th></th>";
    $hthn2 = "";
    $nthn = 1;
    foreach ($qthn as $vthn) {
        
        
        if ($nthn==1) {
             $hthn2.="<th>URAIAN PENERIMAAN DANA</th>";
             $colthn = "2";
        }
        else{
            $hthn2 .= "";
            $colthn = "2";
        }

        $hthn .="
        		<th colspan='".$colthn."'><center>".$vthn->nama."</center></th>";

        $hthn2 .= "
            <th>MASUK DARI SISWA</th>
            <th>TERHUTANG DI SISWA</th>
        ";

        $nthn++;
    }

    $bln = "";
    $bawal = 7;
    $bw = 1;
    for($b=1;$b<=12;$b++){
    	$thn1 = substr($ajaran, 0,4);
        $thn2 = substr($ajaran, 5,8);

        if ($bawal>=13) {
        	$nmb = $thn2."-".sprintf("%02d", $bw);
        	if ( $nmb == date("Y-m")) {
        		$slb = "selected";
        	}
        	else{
        		$slb = "";
        	}

        	$nm = date("F", strtotime($thn2."-".sprintf("%02d", $bw)."-01"));
        	$bln.="<option value='".$thn2."-".sprintf("%02d", $bw)."' ".$slb.">".$nm." ".$thn2."</option>";
        	$bw++;
        }
        else{
        	$nmb = $thn1."-".sprintf("%02d", $bawal);
        	if ($nmb == date("Y-m")) {
        		$slb = "selected";
        	}
        	else{
        		$slb = "";
        	}

        	$nm = date("F", strtotime($thn1."-".sprintf("%02d", $bawal)."-01"));
        	$bln.="<option value='".$thn1."-".sprintf("%02d", $bawal)."' ".$slb.">".$nm." ".$thn1."</option>";
        }
        $bawal++;
    }
    /*
    for($b=1;$b<=12;$b++){
        $nm = date("F", strtotime("2019-".$b."-01"));
        $bnow = date("m");

        if ($bnow == sprintf("%02d",$b)) {
            $bln.="<option value='".sprintf("%02d",$b)."' selected>".$nm." </option>";
        }
        else{
            $bln.="<option value='".sprintf("%02d",$b)."'>".$nm." </option>";
        }
        
    }*/
?>
<div class="row clearfix" style="margin-top:-20px">
    <!-- Task Info -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_formhonor">
        <div class="card" id="floading">
            <div class="header col-md-12">
                <span class="col-md-3 col-xs-12">
                    <span style="float:left">Batas Bulan :</span>
                    <select class="form-control" onchange="get_data()" id="fbln">
                        <option value="">== SETAHUN AJARAN ==</option>
                        <?php echo $bln; ?>
                    </select>
                </span>
                <span class="col-md-3 col-xs-12">
                    <span style="float:left">Tingkat :</span>
                    <select class="form-control" onchange="get_data()" id="ftk">
                        <option value="">== SEMUA TINGKAT ==</option>
                        <option value="1">X</option>
                        <option value="2">XI</option>
                        <option value="3">XII</option>
                    </select>
                </span>
            </div>
            <div class="body">
                <div class="clearfix">&nbsp;</div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        
                    </table>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr id="hthn">
                                <?php echo $hthn; ?>
                            </tr>
                            <tr style="font-size: 12px;" id="hthn2">
                                <?php echo $hthn2 ?>
                            </tr>
                        </thead>
                        <tbody id="dt">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.thn').mask('0000/0000');
    get_data();
    function get_data(){
        var d =  "";
        var t = $("#ftk").val();
        var b = $("#fbln").val();
        loading("floading");
        //alert(d);
        $.post("<?php echo site_url("catatan_keuangan/analisis_data"); ?>",{d:d, t:t, b:b},function(data){
                $("#dt").html(data);
                unblock("floading");
        });
        get_header();
    }

    function get_header(){
    	var t = $("#ftk").val();

    	$.ajax({
    		url:"<?php echo base_url('catatan_keuangan/analisis_header') ?>",
    		dataType:"json",
    		data:{t},
    		type:"POST",
    		success:function(data){
    			var hthn = data[0].hthn;
    			var hthn2 = data[0].hthn2;

    			$("#hthn").html(hthn);
    			$("#hthn2").html(hthn2);
    		}
    	});
    }

</script>
