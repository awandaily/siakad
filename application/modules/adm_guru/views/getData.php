 <style>
 table tr  {
 border-bottom:black solid 1px;
 }
 </style>
 <?php
   $id_guru=$this->input->post("id_guru");
   $periode=$this->input->post("periode");
   $tgl1=$this->tanggal->range_1($periode,"-");
   $tgl2=$this->tanggal->range_2($periode,"-");
  
 $cek=$this->db->query("select * from keu_data_gaji where id_guru='".$id_guru."' and (tgl1 BETWEEN '".$tgl1."' AND  '".$tgl2."' OR tgl2 BETWEEN '".$tgl1."' AND  '".$tgl2."'  )  ");
 $peri=isset($cek->row()->periode)?($cek->row()->periode):"";
 if($peri!=$periode and $peri)
 {
	 echo "<center><b class='col-pink'> TERDAPAT TANGGAL YANG SUDAH PERNAH DIINPUT PADA DATA PENGGAJIAN SEBELUMNYA DIPERIODE : <br>
	<span class='col-teal'> '".$cek->row()->nama_periode."  ,  ".$cek->row()->periode."'  </span> <br>SILAHKAN TENTUKAN TANGGAL DENGAN BENAR.</b></center>";
		 return true;
 }
 
 if($cek->num_rows())
 {
	 echo '<center>
	 <div>
                                 
                                <a target="_blank" href="'.base_url().'penggajian/struk?periode='.$periode.'&id_guru='.$id_guru.'" class="btn bg-teal" > <i class="material-icons">print</i> Cetak Struk Gaji </a> 
                            </div>
	 </center>';
	 return true;
 }
 $cek=$cek->row();
 ?>
 <div class="row clearfix" style="margin-top:-20px">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_formhonor">
		  <div class="card">
			<div class="body">
		<div class="col-md-6 col-sm-12">
		  
			<table   width="100%">
			<tr>
			<td colspan="8"> <b class="col-teal">PERHITUNGAN KBM NORMAL </b></td>
			</tr>
			
		<?php
		$honor=$this->m_reff->honor($id_guru);
		$totalKBMNormal=""; $i=0;$totalKBMInvalid="";
			$dataTK=$this->db->query("SELECT  id_tk FROM  v_jadwal WHERE id_guru='".$id_guru."' AND id_semester='".$this->mdl->sms()."' and id_tahun='".$this->mdl->tahun()."' GROUP BY id_tk order by id_tk")->result();
			foreach($dataTK as $dbtk){	$i++; $tk=$dbtk->id_tk;?>		
			<tr>
			<td><b>Kelas <?php echo $this->m_reff->goField("tr_tingkat","nama","where id='".$tk."' ")?> </b></td>
			<td>:</td>
			<td><?php     
			$jamMasuk=$this->mdl->jmlJamMengajarNormal($periode,$id_guru,$tk);//jam yang masuk
			$jam=$this->mdl->jmlJamMengajarBuild($periode,$id_guru,$tk);
			if($jamMasuk>0){
			echo	$jam; $persen=100;
			}else{
			echo	$jam;  $persen=30;
			}
			
			?> Jam </td>
			<td>X&nbsp; </td>
			<td>Rp. <?php echo number_format($honor,0,",","."); ?> </td>
			<td>= Rp <?php echo number_format($total=($honor*$jam),0,",","."); ?></td>
			<td>X&nbsp;</td>
			<td> <?php	echo $persen ?>%</td>
			<td>=   Rp <?php echo $total  =number_format($t=(($total/100)*$persen),0,",","."); ?> </td>
			</tr>
<?php 
$blok=$this->mdl->jmlJamMengajarBlok($periode,$id_guru,$tk);	
$totalKBMInvalid=$blok+$totalKBMInvalid;
$totalKBMNormal=$t+$totalKBMNormal;		} 
$totalHargaHonorKBM=$totalKBMNormal-($totalKBMInvalid*$honor);

?>	
			
	<?php
if($i){?>	
			<tr>
			<td colspan="8" align="right"><b>Total&nbsp; </b></td>
			<td>= <b> Rp <?php echo number_format($totalKBMNormal,0,",",".");?></b></td>
			</tr>
<?php }else{ echo "<tr><td><i>- Tidak mengajar - </i> </td></tr>"; $totalKBMNormal=0; } ?>		
		 
			</table>
			
			<br>
				<table   width="100%">
			<tr>
			<td colspan="8"> <b class="col-teal">PERHITUNGAN PENDAPATAN</b></td>
			</tr>
			<tr>
			<td>Gaji Pokok</td>
			<td>:</td>
			<td><?php echo number_format($gp=$this->mdl->gajiPokok($id_guru),0,",",".");?></td>
			</tr>
			
			<tr>
			<td>Tunjangan Jabatan</td>
			<td>:</td>
			<td><?php echo number_format($tj=$this->mdl->tunjanganJabatan($id_guru),0,",",".");?></td>
			</tr>
			
			<tr>
			<td>Wali Kelas</td>
			<td>:</td>
			<td><?php echo number_format($wk=$this->mdl->waliKelas($id_guru),0,",",".");?></td>
			</tr>
			
			<tr>
			<td>Piket</td>
			<td>:</td>
			<td><?php echo number_format($piket=$this->mdl->piket($periode,$id_guru),0,",",".");?></td>
			</tr>
			
			<tr>
			<td>Pembina Ektrakurikuler</td>
			<td>:</td>
			<td><?php echo number_format($pe=$this->mdl->pembinaEskul($id_guru),0,",",".");?></td>
			</tr>
			
			<tr>
			<td>Penambahan Fungsional</td>
			<td>:</td>
			<td><?php echo number_format($pf=$this->mdl->p_fungsional($id_guru),0,",",".");?></td>
			</tr>
			
			<tr>
			<td>Kepramukaan Wajib</td>
			<td>:</td>
			<td><?php echo number_format($kw=$this->mdl->kepramukaan_wajib($id_guru),0,",",".");?></td>
			</tr>
			<tr>
			<td>Honor Mengajar </td>
			<td>:</td>
			<td><?php echo number_format($totalKBMNormal,0,",",".");?></td>
			</tr> <tr>
			<td>Honor Non KBM </td>
			<td>:</td>
			<td><?php
			$honorSelainKBM=$this->mdl->getHonorNonKbm($id_guru,$periode);
			echo number_format($honorSelainKBM,0,",",".");?></td>
			</tr> 
			<?php $totalMasuk=$totalKBMNormal+$kw+$pf+$pe+$piket+$wk+$tj+$gp;?>
			<tr>
			<td   align="right"><b>Total Pemasukan&nbsp; </b></td>
			<td>:</td>
			<td  >   <b  > Rp <?php echo number_format($totalMasuk,0,",",".");?></b></td>
			</tr>
			</table>
			
			
			
			
			</div>
			
			<div class="col-md-6 col-sm-12">
			
			
			
			<!----------------------------->
			 
			<table width="100%">
			
			<tr>
			<td colspan="8"> <b class="col-pink">JAM KBM INVALID </b></td>
			</tr>
			<?php
			$totalKBMNon=""; $i=0;
			$dataTK=$this->db->query("SELECT  id_tk FROM  v_jadwal WHERE id_guru='".$id_guru."' AND id_semester='".$this->mdl->sms()."' and id_tahun='".$this->mdl->tahun()."' GROUP BY id_tk order by id_tk")->result();
			foreach($dataTK as $dbtk){		$tk=$dbtk->id_tk;		$i++;		?>
			<tr>			
			<td><b>Kelas  <?php echo $this->m_reff->goField("tr_tingkat","nama","where id='".$tk."' ")?>  </b></td>
			<td>&nbsp;:&nbsp;</td>
			<td><?php echo $blok=$this->mdl->jmlJamMengajarBlok($periode,$id_guru,$tk);?> Jam </td>
			<td>&nbsp;X&nbsp; </td>
			<td>Rp. <?php echo number_format($honor,0,",","."); ?>  </td>			 
			<td>&nbsp;=   Rp <?php echo number_format($total=($blok*$honor),0,",",".");?> </td>
			</tr>
			<?php $totalKBMNon=$total+$totalKBMNon; } ?>
			<?php if($i){?>
			<tr>
			<td colspan="5" align="right"><b>Total&nbsp; </b></td>
			<td>&nbsp;= <b> Rp <?php echo number_format($totalKBMNon,0,",",".");?></b></td>
			</tr>
			<?php }  else{ echo "<tr><td><i>- Tidak mengajar - </i> </td></tr>"; $totalKBMNon=0;} ?>		
			
			</table>
			
			
			<!----------------------------->
			
			<br>
			<form id="serialize">
				<table   width="100%" >
			<tr>
			<td colspan="8"> <b class="col-pink">PERHITUNGAN POTONGAN </b></td>
			</tr>
			<tr>
			<td>KBM Tidak Valid</td>
			<td>:</td>
			<td >Rp <?php echo number_format($totalKBMNon,0,",",".");?></td>
			</tr>
			<?php
			$datasts=$this->db->get("keu_tr_stssimpanan")->result();
			foreach($datasts as $sim)
			{?>
			<tr>
			<td><?php echo $sim->nama;?></td>
			<td>:</td>
			<td style="padding:1px"><input type="text" id="simpanan<?php echo $sim->id;?>" name="simpanan[p<?php echo $sim->id;?>]" value="<?php echo number_format($sim->val,0,",",".");?>" onkeyup="hitung_pembayaran()" onkeydown="return numbersonly(this, event);"></td>
			</tr>
			
			<?php } ?>
			
			<tr>
			<td>Bayar Pinjaman</td>
			<td>:</td>
			<td style="padding:1px"><input type="text" size="10" value="<?php echo number_format($this->mdl->getNominalCicilan($id_guru),0,",",".");?>" name="bayar_pinjaman" onkeyup="bayarPinjaman()" onkeydown="return numbersonly(this, event);">
			<span class="pull-right"><i id="Npinjaman" jumlah='<?php echo $Npinjaman=$this->mdl->getJumlahPinjaman($id_guru);?>' >Sisa Pinjaman: Rp <?php echo number_format($Npinjaman,0,",",".");?></i></span>
			</td>
			
			</tr>
			
			<tr>
			<td   align="right"><b>Total Potongan&nbsp; </b></td>
			<td>:</td>
			<td  >   <b id="pengeluaran"> </b></td>
			</tr>
			</table>
			<input type="hidden" name="form[gaji_pokok]" value="<?php echo $gp?>">
			<input type="hidden" name="form[tunjangan_jabatan]" value="<?php echo $tj?>">
			<input type="hidden" name="form[wali_kelas]" value="<?php echo $wk?>">
			<input type="hidden" name="form[piket]" value="<?php echo $piket?>">
			<input type="hidden" name="form[pembina_eskul]" value="<?php echo $pe?>">
			<input type="hidden" name="form[p_fungsional]" value="<?php echo $pf?>">
			<input type="hidden" name="form[kepramukaan_wajib]" value="<?php echo $kw?>">
			<input type="hidden" name="form[honor]" value="<?php echo $honorSelainKBM ?>">
		 
		 
			<input type="hidden" name="pemasukan" value="<?php echo $totalMasuk+$honorSelainKBM?>">
			<input type="hidden" name="total_potongan" >
			<input type="hidden" name="total_pembayaran" >
			<input type="hidden" name="potongan" value="<?php echo $totalKBMNon?>">
			<input type="hidden" name="periode" value="<?php echo $periode?>">
			<input type="hidden" name="id_guru" value="<?php echo $id_guru?>">
			</form>
			 
		 <br>
				<table   width="100%">
			<tr>
			<td  > <b class="col-indigo"> TOTAL PEMBAYARAN </b></td>
			<td>:</td>
			<td align="right" class="col-indigo"> <b id="total_pembayaran">  <b></td>
			</tr>
			<tr>
			<td colspan="3" align="center" > - <i id="baca"></i> - </td>
			</tr>
			 
			</table>
			
			
			</div>
				 <button class="  btn btn-block bg-indigo" onclick="simpan()"><i class="material-icons">save</i> SIMPAN </button>
			<div class="clearfix"></div>
			</div>			
		  </div>
	 </div>

 </div>
 <script>
setTimeout( function() {	hitung_pembayaran();			},300);
 function bayarPinjaman()
 {
	 var bayar_pinjaman=$("[name='bayar_pinjaman").val();
	 var Npinjaman=$("#Npinjaman").attr("jumlah");
	var  bayar_pinjaman = bayar_pinjaman.split('.').join("");
	var bayar_pinjaman=Number(bayar_pinjaman);
	   if(bayar_pinjaman>Npinjaman)
	   {
		   notif("Nominal cicilan lebih besar dari pada pinjaman.");
		 $("[name='bayar_pinjaman").val(0);
		   hitung_pembayaran();
		 return false;
	   }
	   hitung_pembayaran();
 }


 function hitung_pembayaran()
 {
 		
	$.ajax({
			url:"<?php echo base_url()?>penggajian/hitung",
			data:$("#serialize").serialize(),
			type: "POST",
		 	dataType: "JSON",
			success: function(data)
					{	   
						$("#total_pembayaran").html("Rp "+data["nominal"]); 
						$("[name='total_pembayaran']").val(data["nominal_asli"]); 
						$("[name='total_potongan']").val(data["potongan_asli"]); 
						$("#pengeluaran").html("Rp "+data["potongan"]); 
						$("#baca").html(data["baca"]); 
					}
			});
	   
 }
 function simpan()
 {
	  alertify.confirm("<center><span class='col-black'> Simpan Data Penggajian </span><br>   ? </center>",function(){
		  
		  $.ajax({
			url:"<?php echo base_url()?>penggajian/simpanPenggajian",
			data:$("#serialize").serialize(),
			type: "POST",
		 	dataType: "JSON",
			success: function(data)
					{	   
					var dataget='<center><div><a target="_blank" href="<?php echo base_url(); ?>penggajian/struk?periode=<?php echo $periode; ?>&id_guru=<?php echo $id_guru?> " class="btn bg-teal" > <i class="material-icons">print</i> Cetak Struk Gaji </a>  </div> </center>';
					$("#dataget").html(dataget); 
						 
					}
			});
		  
		  
	  });
 }
 </script>