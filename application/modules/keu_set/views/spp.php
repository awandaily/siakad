 
 <div class="row clearfix" id="area_loding">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Kenaiakan Besaran SPP
                            </h2>
                           <small> Ini akan merubah besaran SPP yang sudah ditagihankan ke siswa dan yang belum pernah dibayar oleh siswa.</small>
                        </div>
                        <div class="body" id="area_formbayar">
                                <div class="row clearfix"><br><br>
						<form url="<?php echo base_url()?>keu_set/setBesaranSpp" id="formbayar" action="javascript:submitForm('formbayar')" method="post">
              
						
							<div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-control-label">
                                        <label class='col-black'  >Tanggal Perubahan Tagihan SPP</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group " id='tgl_pembayaran'>
                                             
											 
                                                <input type="text" required  name="tgl_bayar" value="<?php echo date('d-m-Y');?>"
												class="form-control form_pembayaran" placeholder="Input Nominal Bayar"   >
										  
										 
										  
                                        </div>
											
                                    </div>
                             <!--       <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
                                    <input type="checkbox" onchange='sesuai_tgl()' id="remember_me"  name='tgl_sesuai'  class="filled-in" value="ya">
                                    <label for="remember_me" >Semua tagihan spp yang belum dibayar</label>
                                    </div>--->
									 
							 </div>	
							 
							 
							<div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-control-label">
                                        <label class='col-black'  >Jurusan </label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group " id='tgl_pembayaran'> 
                                               <?php
                                               $this->db->order_by("nama","asc");
                                               $dt=$this->db->get("tr_jurusan")->result();
                                               foreach($dt as $v)
                                               {
                                                   $j[$v->id]=$v->nama;
                                               }
                                               echo form_dropdown("jurusan[]",$j,""," multiple class='form-control select' data-actions-box='true'");
                                               ?>
										   
                                        </div>
								   </div>
                                    
							 </div>	
							 
							 
							 	<div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-control-label">
                                        <label class='col-black'  >Nominal SPP baru </label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group "  > 
                                            <input type="text" name="nominal" onkeydown="return numbersonly(this, event);" class='form-control'>
                                        </div>
								   </div>
                                    
							 </div>	
							 
							<script>
							$(".select").selectpicker();
							    function sesuai_tgl()
							    {
							        var sesuai=$("#remember_me:checked").val();
							       
							        if(sesuai=="ya"){
							            $("#tgl_pembayaran").hide();
							             
							        }else{
							              $("#tgl_pembayaran").show();
							        }
							    }
							</script>
							
							
							 
                          <div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-5" >
                                        <button onclick="submitFormNoResset('formbayar')"  class="col-md-6 btn bg-teal m-t-15 waves-effect">SIMPAN PERUBAHAN</button>
                                    </div>
                                </div>
                                </form>
                          <br>
                        </div>
                    </div>
                </div>
            </div>
			
<script>			 
function cekbayar(id)
{

	  var tagihan = $("[name='f["+id+"]']").attr("tagihan");
	  var input = $("[name='f["+id+"]']").val();
	 var input = input.split('.').join("");
	 var tagihan = Number(tagihan);
	 var input = Number(input);
	 if(input>tagihan)
	 {
		 notif("Maaf!! Nominal bayar yang anda input lebih besar dari pada jumlah tagihan.");
		 	$("[name='f["+id+"]']").val("");
	 }
}
</script>		



 
			
			<script>
			function hapus(id){
		     alertify.confirm("<center> Hapus ? </center>",function(){
				loading("area_loding_riwayat");
			$.ajax({
			url:"<?php echo base_url()?>datasi/cancelBayar",
			data:"id="+id,
			type: "POST",
			success: function(data)
					{	  
					 
					getAction();
					unblok("area_loding_riwayat");
					} 
			});
		   
		   })
	  };
			</script>
 		



 

<script> 
$('[name="tgl_bayar"]').daterangepicker({
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