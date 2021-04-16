 <div class="modal-body"> 
   <div class="row clearfix  " style="min-height:200px">
<?php
$status_t=$this->mdl->getDataKonfirmasi($id)->row();
 ?>
   <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" align="justify" style="scrol" >
	 <div class="table-responsive">
	 <table class="entry" width="100%">
	<tr class="bg-teal col-white">
	  <td>METHODE PEMBAYARAN</td><td> PENYETOR</td><td>ARSIP </td>
	</tr>
	<?php $no=1; $polder=$this->mdl->tahun();
 
		 
		echo "<tr>
	 
		 
		<td>".$this->m_reff->goField("tr_methode_bayar","nama","where id='".$status_t->id_methode_bayar."'")."</td>
	 	<td align='left'>".$status_t->an."</td>
		<td><a href='".base_url()."file_upload/".$polder."/trf/".$status_t->bukti_trf."' target='new'>Lihat Bukti Transfer</a></td>
		</tr>";
 
	?>
	 </table>		
   </div> 
   </div> 
 </div>
 </div>
	 