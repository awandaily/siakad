<div>
    <center><input type="text" name="nis" class='form-control' style='width:200px' placeholder='NIS siswa' onchange='getRisk(this.value)' ></center>
    <br>
</div>










<script>
function getRisk(nis)
{
      loading();
        var url="<?php echo base_url()?>datasi/getRisk";
        $.post(url,{nis:nis},function(data){
			   $("#datarisk").html(data);
			   unblock();
		 });
}
</script>
<script>
    function tagihan_pokok(id_siswa,nama)
    {    $("#isimodal").html("");
        $("#mdl_modal_risk").modal("show");
        $(".modal-title").html("  <b>keu_tagihan_pokok</b>  <span class='col-pink'>"+nama+"</span>");
        var url="<?php echo base_url()?>datasi/getRiskTagihanPokok";
        $.post(url,{id_siswa:id_siswa},function(data){
			   $("#isimodal").html(data);
		 });
    } 
    
      function tagihan_bayar(id_siswa,nama)
    {    $("#isimodal").html("");
        $("#mdl_modal_risk").modal("show");
        $(".modal-title").html("  <b>keu_tagihan_bayar</b> <span class='col-pink'>"+nama+"</span>");
        var url="<?php echo base_url()?>datasi/getRiskTagihanBayar";
        $.post(url,{id_siswa:id_siswa},function(data){
			   $("#isimodal").html(data);
		 });
    } 
    function setTagihanPokok(id,id_siswa,nominal)
    {   
          var url="<?php echo base_url()?>datasi/setTagihanPokok";
        $.post(url,{id:id,id_siswa:id_siswa,nominal:nominal},function(data){
			  notif("Tersimpan");
		 });
    }
    
      function setTglTagihanPokok(id,id_siswa,tgl)
    {
          var url="<?php echo base_url()?>datasi/setTglTagihanPokok";
        $.post(url,{id:id,id_siswa:id_siswa,tgl:tgl},function(data){
			    notif("Tersimpan");
		 });
    }
    
     function setTmBayar(id,id_siswa,nominal)
    {
          var url="<?php echo base_url()?>datasi/setTmBayar";
        $.post(url,{id:id,id_siswa:id_siswa,nominal:nominal},function(data){
			  notif("Tersimpan");
		 });
    }
    
      function setTglTmBayar(id,id_siswa,tgl)
    {
          var url="<?php echo base_url()?>datasi/setTglTmBayar";
        $.post(url,{id:id,id_siswa:id_siswa,tgl:tgl},function(data){
			     notif("Tersimpan");
		 });
    }
    function hapus_bayar(id,id_siswa,tgl)
    {
         alertify.confirm("<center> Yakin Hapus ? </center>",function(){
             
       var url="<?php echo base_url()?>datasi/hapus_bayar_risk";
        $.post(url,{id:id,id_siswa:id_siswa,tgl:tgl},function(data){
			     notif("Tersimpan");
			        $("#mdl_modal_risk").modal("hide");
		 });  
          
         });
    }

</script>




	<div  class="modal fade in" id="mdl_modal_risk" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
	                <div class="modal-content">  
                        <div class="modal-header">
						 <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                            <h4 class="modal-title col-teal"></h4>
							 
                        </div>
                        <div class="modal-body" id="isimodal">
                       	  
                        </div>
								 
 
                       <div class="modal-footer">
						<span id="msg" class="pull-left"></span>
                             
                        </div>

				</div>
				</div>
					 
       		 </div>
				
   </div>

























<div id='datarisk'>
<?php
$data=$this->db->query("select * from v_risk where nominal_pokok!=nominal_bayar limit 10 ")->num_rows();
if(!$data)
{
    echo "<h3>DATA KEUANGAN PADA SISTEM AMAN TIDAK ADA KENDALA</h3><br>
    Dimohon agar selalu memeriksa halaman ini agar jika terjadi ketidak sesuaian dapat segera diatasi. ";
    return false;
}
?>
<table class='entry' width="100%">
<tr class='bg-teal col-white font-bold'>
<td>NO</td>
<td>NIS</td>
<td>NAMA</td>
<td>KELAS</td>
<td>AKUMULASI</td>
<td>RINCIAN</td>
</tr>
<?php
$no=1;
$data=$this->db->query("select * from v_risk where nominal_pokok!=nominal_bayar limit 100 ")->result();
foreach($data as $val)
{
    $get=$this->db->query("select * from data_siswa where id='".$val->id_siswa."' ")->row();
    $kelas=$this->m_reff->goField("v_kelas","nama","where id='".$get->id_kelas."'");
 echo "<tr>
 <td>".$no++."</td>
  <td>".$get->nis."</td>
  <td>".$get->nama."</td>
  <td>".$kelas."</td>
  <td> <button onclick='tagihan_pokok(".$val->id_siswa.",`".$get->nama."`)'>".$val->nominal_pokok."</button></td>
  <td>  <button onclick='tagihan_bayar(".$val->id_siswa.",`".$get->nama."`)'>".$val->nominal_bayar." </button></td>
 </tr>";   
}


?>
</table>

</div>

