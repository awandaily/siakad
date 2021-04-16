<?php
///$code=$this->m_reff->goField("keu_tm_bayar","code","where id='".$id."'");
$db=$this->db->query("select * from keu_tm_bayar where id_siswa='".$id_siswa."' and tgl_bayar='".$tgl_bayar."'  ");
if($db->num_rows())
{
?>


<div class="row clearfix" id="area_loding_riwayat">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div  >
                       
                        <div class="body" id="area_formbayar">
                                <div class="row clearfix"> 
								<table class="entry" width="100%">
								<thead>
								<tr>
								 <th>No</th>
									
									<th>Untuk Pembayaran</th>
									<th>Nominal</th>
									<th>Periode Pembayaran</th>
								 
									</tr>
									</thead>
						 		<?php
								$data=$db->result();$n=1; $t=0;
								foreach($data as $data)
								{
									$periode=str_replace(":sisa","",$data->periode_spp);
									$periode=str_replace(":lunas","",$periode);
									echo "<tr><td>".$n++."</td>
								
									<td>".$this->mdl->namaBiaya($data->id_tagihan)."</td>
										<td align='right'>".number_format($data->nominal_bayar,0,",",".")."</td>
									<td>".substr($periode,0,-1)."</td>
								 
									
									</tr>
									";
									$t=$data->nominal_bayar+$t;
								}
								?>						 
								 
								 <tr class='bg-greey'>
								 <td colspan="2" align='right'><b>TOTAL</b></td>
								 <td colspan="2"><b>Rp <?php echo number_format($t,0,",","."); ?></b></td>
								 </tr>
								
								</table>
                               </div>
                                
                          
                        </div>
						<br>
						
						 <a target='new' href='<?php echo base_url()?>datasi/kwitansi_pertnggal?id_siswa=<?php echo $id_siswa?>&tgl=<?php echo $data->tgl_bayar;?>' class='btn-block btn-mini btn bg-primary'><i class="material-icons">print</i> Cetak Kwitansi</a>
						
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