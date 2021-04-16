<?php
$this->db->where("id",$id);
$data=$this->db->get("keu_data_pengeluaran")->row();
$kode_kategori=$this->m_reff->goField("keu_tr_pengeluaran",'kode_kategori',"where kode='".$data->kode."' ");
?>
 <div> 
							<input name="id"   type="hidden" value="<?php echo $id;?>">
 	 
  
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">Kategori Pengeluaran</label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                          <?php
										  $data_tr=$this->db->get("keu_tr_kategori_pengeluaran")->result();
										  $opsi="";
										  $opsi[]="==== Pilih ====";
										  foreach($data_tr as $val)
										  {
											   $opsi[$val->kode]=$val->kode.". ".$val->nama;
										  }
										  echo form_dropdown("id_kategory",$opsi,$kode_kategori,"class='form-control select' onchange='getEPengeluaran()' ");
										  ?>
                                        
                                            
                                        </div>
                                    </div>
                                </div>	
								
								
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">Pilih Pengeluaran</label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group" id="Edata_pengeluaran">
                                          <?php
										  $this->db->where("kode_kategori",$kode_kategori);
										  $data_tr=$this->db->get("keu_tr_pengeluaran")->result();
										  $opsi="";
										  $opsi[]="==== Pilih ====";
										  foreach($data_tr as $val)
										  {
											   $opsi[$val->kode]=$val->kode.". ".$val->nama;
										  }
										  echo form_dropdown("f[kode]",$opsi,$data->kode,"class='form-control select' onchange='getEPengeluaran()' data-live-search='true'");
										  ?>
                                        
                                            
                                        </div>
                                    </div>
                                </div>	
								
								 
							 
								 <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black"> Jumlah/Nominal  </label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input  class="form-control" name="nominal" value="<?php echo number_format($data->nominal,0,",",".");?>" id="nominal" type="text" required onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								  <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black"> Tanggal  </label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input  class="form-control" name="tgl" value="<?php echo $this->tanggal->ind($data->tgl,"/");?>" id="tglE" type="text" required onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								  <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black"> Keterangan  </label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <textarea  class="form-control" name="f[ket]" ><?php echo $data->ket;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
						 
                 </div>
<script>				 
$(".select").selectpicker();
 
  function getEPengeluaran()
{	var id=$("[name='id_kategory']").val();
	$.post("<?php echo site_url("catatan_keuangan/getTrPengeluaran"); ?>",{id:id},function(data){
		$("#Edata_pengeluaran").html(data);	
	 });
}
</script>	

<script>			 

$('#tglE').daterangepicker({
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
    "startDate": "<?php echo $this->tanggal->ind($data->tgl,"/")?>",
   
});
</script>			 