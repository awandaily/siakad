 <?php
 
 $id=$this->input->get_post("id");
 $sts=$this->input->get_post("sts");
 $data=$this->db->query("select * from v_mitra_pkl where id='".$id."' ")->row();
 ?>
 <input type="hidden" name="sts" value="<?php echo $sts;?>">
 <input type="hidden" name="id_pembimbing" value="<?php echo $data->id_pembimbing;?>">
 <input type="hidden" name="tgl_berangkat" value="<?php echo $data->tgl_berangkat;?>">
 <input type="hidden" name="id_mitra" value="<?php echo $data->id_mitra;?>">
 <input type="hidden" name="id" value="<?php echo $id;?>">
 
  
<div class="row clearfix">
    
        
    
    <div class="col-lg-12 col-md-12  ">
        <label for="email_address_2" class="col-black">  PELAKSANAAN </label>
        <div class="form-group">
            <div class="form-line">
                <input type='text' class="form-control" required name="tgl_pelaksanaan" id="tgl_pelaksanaan">
                </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    
    <div class="col-lg-12 col-md-12  ">
         <label for="email_address_2" class="col-black">UPLOAD PHOTO </label>
        <div class="form-group">
            <div class="form-line">
                <input type="file" name="bukti" required class="form-control" />
            </div>
        </div>
    </div>
</div>
<!--
<div class="row clearfix">
    <div class="col-lg-3 col-md-3  form-control-label">
        <label for="email_address_2" class="col-black">KETERANGAN </label>
    </div>
    <div class="col-lg-8 col-md-8  ">
        <div class="form-group">
            <div class="form-line">
                <textarea class="form-control" required name="f[ket]"></textarea>
            </div>
        </div>
    </div>
</div>
 
 --->
  
     
<script> 
$('[name="tgl_pelaksanaan"]').daterangepicker({
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
 </script>
 