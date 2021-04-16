 <div class="modal-body"> 
   <div class="row clearfix  " style="min-height:200px">
<?php
$status_t=$this->mdl->getDataKonfirmasi($id)->result();
 ?>
   <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" align="justify" style="scrol" >
	 <div class="table-responsive">
	 <table class="entry" width="100%">
	<tr class="bg-teal col-white">
	<td>#</td>  <td>METHODE PEMBAYARAN</td><td> PENYETOR</td><td>ARSIP </td>
	</tr>
	<?php $no=1; $polder=$this->mdl->tahun();
	foreach($status_t as $db)
	{
		 
		echo "<tr>
		<td>".$no++."</td>
		 
		<td>".$this->m_reff->goField("tr_methode_bayar","nama","where id='".$db->id_methode_bayar."'")."</td>
	 	<td align='left'>".$db->an."</td>
		<td><a href='".base_url()."file_upload/".$polder."/trf/".$db->bukti_trf."' target='new'>Lihat Bukti Transfer</a></td>
		</tr>";
	}
	?>
	 </table>		
   </div> 
   </div> 
 </div>
 </div>
	 