<?php
///$code=$this->m_reff->goField("keu_tm_bayar","code","where id='".$id."'");
$db=$this->db->query("select * from keu_tm_bayar where tgl_bayar='".$tgl."' and id_siswa='".$id_siswa."' ");
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
								 
									<th colspan='2'>  Rincian</th>
									  
									</tr>
									</thead>
						 		<?php
								$data=$db->result();$n=1; $t=0;
								foreach($data as $data)
								{
									  
										$nama=$this->m_reff->namaBiaya($data->id_tagihan);
									 
	 
									$periode=str_replace(":sisa","",$data->periode_spp);
									$periode=str_replace(":lunas","",$periode);
									echo "<tr>
								
									<td colspan='2'>Bayar ".$nama." 
										<br><b> Rp ".number_format($data->nominal_bayar,0,",",".")." </b>
									<br><i>".substr($periode,0,-1)."</i></td>
								 
									
									</tr>
									";
									$t=$data->nominal_bayar+$t;
								}
								?>						 
								 
								 <tr class='bg-greey'>
								 <td   align='right'><b>TOTAL</b></td>
								 <td  ><b>Rp <?php echo number_format($t,0,",","."); ?></b></td>
								 </tr>
								
								</table>
                               </div>
                                
                          
                        </div>
						 
						 
                    </div>
                </div>
            </div>	

			
			 
<?php } ?>			