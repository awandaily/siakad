 <?php 
 $id_siswa=$this->input->post("nama");
 //$datasiswa=$this->db->query("select * from v_siswa where id='".$id_siswa."' ")->row();
 //$jr=isset($datasiswa->id_jurusan)?($datasiswa->id_jurusan):"";
 if(!$id_siswa){
 return false;
 }
  
 ?>
 <div class="row clearfix" id="area_loding">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                FORM PEMBAYARAN  
                            </h2>
                           
                        </div>
                        <div class="body" id="area_formbayar">
                                <div class="row clearfix"><br><br>
							
							
						
							<div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-control-label">
                                        <label class='col-indigo'  >Tanggal Bayar</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group " id='tgl_pembayaran'>
                                             
											 
                                                <input type="text" required  name="tgl_bayar" value="<?php echo date('d-m-Y');?>"
												class="form-control form_pembayaran" placeholder="Input Nominal Bayar"   >
										  
										 
										  
                                        </div>
											
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
                                    <input type="checkbox" onchange='sesuai_tgl()' id="remember_me"  name='tgl_sesuai'  class="filled-in" value="ya">
                                    <label for="remember_me" >Sesuai Tanggal Tagihan</label>
                                    </div>
									 
							 </div>		
							<script>
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
							
							
							
							<?php
							$db=$this->db->query("SELECT * FROM keu_tagihan_pokok where id_siswa='".$id_siswa."' GROUP BY id_tagihan,jenis_tagihan")->result();		
							foreach($db as $db){
							?>					

								 
							
							<div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-control-label" >
                                        
                                        <label  ><?php echo $nama=$this->mdl->namaBiaya($db->id_tagihan,$db->jenis_tagihan);?></label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group ">
                                             
											 
                                                <input type="text" tagihan="<?php echo $this->mdl->sisaTagihan($id_siswa,$db->id_tagihan);?>" onchange="cekbayar(`<?php echo $db->id_tagihan?>`)" name="f[<?php echo $db->id_tagihan;?>]" 
												class="form-control form_pembayaran" placeholder="Input Nominal Bayar" onkeyup="cekbayar(`<?php echo $db->id_tagihan?>`)" onkeydown="return numbersonly(this, event);">
										  
										 
										  
                                        </div>
											
                                    </div>
									<div class="col-md-4 col-sm-12 hoverline cursor col-blue" onclick="detailTagihan(`<?php echo $db->id_tagihan;?>`,`<?php echo $nama;?>`)"> Sisa Tagihan <b class='col-pink'> Rp <?php echo number_format($this->mdl->sisaTagihan($id_siswa,$db->id_tagihan),0,",",".");?></b>
								<!--	<input type="hidden"  value=" " name="tagihan >">--->
									</div>
							 </div>
                               
							<?php } ?>	
								
                               </div>
                          <div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-5" >
                                        <button onclick="submitFormNoResset('formbayar')"  class="col-md-6 btn bg-teal m-t-15 waves-effect">SIMPAN PEMBAYARAN</button>
                                    </div>
                                </div>
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





<?php
$db=$this->db->query("select * from keu_tm_bayar where substr(_ctime,1,10)='".date('Y-m-d')."' and id_siswa='".$id_siswa."'  ");
if($db->num_rows())
{
	
?>


<div class="row clearfix" id="area_loding_riwayat">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                 Transaksi Hari Ini   <a target='_blank' href='<?php echo base_url()?>datasi/kwitansi?id_siswa=<?php echo $id_siswa?>&tgl=<?php echo date('Y-m-d');?>' class='pull-right btn bg-primary'><i class="material-icons">print</i> Cetak Kwitansi</a>
                            </h2>
                           
                        </div>
                        <div class="body" id="area_formbayar">
                                <div class="row clearfix"> <center>
								<table class="entry" width="95%">
								<thead>
								<tr>
								 <th>No</th>
									<th>Tanggal Input</th>
									<th>Tanggal Bayar</th>
									<th>Untuk Pembayaran</th>
									<th>Nominal</th>
									<th>Periode Pembayaran</th>
									<th>Hapus</th>
									</tr>
									</thead>
						 		<?php
								$data=$db->result();$n=1; $t=0;
								foreach($data as $data)
								{
									$periode=str_replace(":sisa","",$data->periode_spp);
									$periode=str_replace(":lunas","",$periode);
									echo "<tr><td>".$n++."</td>
								
								    <td>hari ini</td>
								    <td>".$this->tanggal->ind(substr($data->tgl_bayar,0,10),"/")."</td>
								 
									<td>".$this->mdl->namaBiaya($data->id_tagihan)."</td>
										<td align='right'>".number_format($data->nominal_bayar,0,",",".")."</td>
									<td>".substr($periode,0,-1)."</td>
									<td><a class='btn btn-mini waves-effect bg-pink' href='javascript:hapus(`".$data->id."`)'>Hapus</a></td>
									
									</tr>
									";
									$t=$data->nominal_bayar+$t;
								}
								?>						 
								 
								 <tr class='bg-greey'>
								 <td colspan="5" align='right'><b>TOTAL</b></td>
								 <td colspan="5"><b>Rp <?php echo number_format($t,0,",","."); ?></b></td>
								 </tr>
								
								</table>
								</center>
                               </div>
                                
                          
                        </div>
                    </div>
                </div>
            </div>	

			
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
<?php } ?>			



 

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