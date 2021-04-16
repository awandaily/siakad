 <?php
 $db=$this->db->query("select * from v_mitra_pkl where id_pembimbing='".$this->m_reff->idu()."'
										   and id_tahun='".$this->m_reff->tahun()."' group by id_pembimbing,tgl_berangkat,lama")->result();
 ?>
 <div class="table-responsive">
 <table class="entry2" width='100%'>
     <tr class='bg-teal col-white'><td>NO</td><td>NAMA MITRA</td><td>ALAMAT</td><td>TANGGAL PEMBERANGKATAN</td><td>LAMA PKL</td><!--<td>KETERANGAN</td>--></tr>
    <?php
    $no=1;
    foreach($db as $dt)
    {
        $mitra=$this->db->query("select * from tr_mitra where id='".$dt->id_mitra."' ")->row();
        echo "<tr><td>".$no++."</td>
        <td>$mitra->nama</td>
         <td>$mitra->lokasi</td>
          <td>".$this->tanggal->hariLengkap($dt->tgl_berangkat,"/")."</td>
          <td>$dt->lama Bulan</td>
         <!---<td>$mitra->ket</td>--->
        </tr>";
    }
    ?>
     
 </table>
</div>							
 <hr>
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div  >
                        <div class="header row">
                        
						  <div class="col-md-12 col-xs-12 pull-right"  style="padding-bottom:10px" >
                                        <select class="form-control   show-tick fmitra"   id="fmitra" data-live-search="true" onchange='reload_table()' >
                                         										
											<?php 
										   $db=$this->db->query("select * from v_mitra_pkl where id_pembimbing='".$this->m_reff->idu()."'
										   and id_tahun='".$this->m_reff->tahun()."' group by id_pembimbing,tgl_berangkat")->result();
										   foreach($db as $val){
										       $mitra=$this->m_reff->goField("tr_mitra","nama","where id='$val->id_mitra_pkl' ");
											       echo "<option value='".$val->id."'>".$mitra." (keberangkatan: ".$this->tanggal->ind($val->tgl_berangkat,"/").") - ".$val->lama_pkl." Bln</option>";
										   }
										   ?>
									  
                                    </select>   
                            </div>
						 
							 
                        </div>
                       
				 <div class="card"  id="area_lod">
                        <div class="body">
                            <div class="table-responsive">
                               <div id="dataJadwal"></div>
							</div>						
						</div>						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				
  <script>
 //$('select').selectpicker();
 </script>
  <script type="text/javascript">
  	  function hapus(id,akun){
		   alertify.confirm("<center>Hapus catatan ini ?</center>",function(){
		   $.post("<?php echo site_url("kunjungan_pkl/hapus_catatan"); ?>",{id:id},function(){
			   reload_table();
		      })
		   })
	  };
	  
	 reload_table();
	 function reload_table()
	 {
	     var id=$("#fmitra").val();
	     $.post("<?php echo site_url("kunjungan_pkl/getJadwalKunjungan"); ?>",{id:id},function(data){
			  $("#dataJadwal").html(data);
		      });
	 }
     
 
	 
	</script>
	
<script>
 
	 function setOtw(id, nama,sts){	 
	     loading();
		 	 $("#modal_dialog").modal("hide");	  
			 $.post("<?php echo site_url("kunjungan_pkl/setOtw"); ?>",{id:id,sts:sts},function(data){
		 	   $("#getform").html(data);
			    $("#mdl_modal_bukti").modal();
			    $("#defaultModalLabel").html(nama);
			    unblock();
			}); 
	 }
   
</script>	
<div class="modal fade" id="mdl_modal_bukti" tabindex="-1" role="dialog">
    <div class="modal-dialog" id="area_modal_bukti" role="document">

        <form action="javascript:submitForm('modal_bukti')" id="modal_bukti" url="<?php echo base_url()?>kunjungan_pkl/insert" method="post" enctype="multipart/form-data">
            <div class="modal-content"> 
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title col-teal" id="defaultModalLabel">RIWAYAT TANGGAPAN</h4>

                </div>
                <div class="modal-body">
                    <div id="getform"></div>

                    <div class="modal-footer">
                        
                <button class='btn bg-teal btn-block' onclick="submitForm('modal_bukti')"> <i class='material-icons'>save</i> SIMPAN</button>

                      

                    </div>

                </div>
            </div>
 </form>
    </div>
   
</div>	
	
	 
 
   
<script>
 
 
   function showImg(url,nama,tgl,id,otw)
{   
    var tgldb=tgl.split(", ");
    var tgldatabase=tgldb[1];
    $("#tombol").html("<button class='btn   bg-teal' onclick='setOtw(`"+id+"`,`"+nama+"`,`"+otw+"`)'>  <i class='material-icons'>file_upload</i>  Upload ulang</button><br>")
    $(".modal-titlet").html(nama);
    $(".tgl_dok").html(tgl);
    $("#modal_dialog").modal("show");
    $("#isimodal").html("<img class='img-responsive thumbnail' src='"+url+"' width='100%' alt='dokumentasi tidak tersedia'>");
    
    setTimeout(function(){  $("#tgl_pelaksanaan").val(tgldatabase); }, 2000);
   
}
</script>


 

<!----------------------------------MODAL-------------------------------------------->					
<div id="modal_dialog" class="modal fade" tabindex="-1" >
    <div class="modal-dialog modal-md"  >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger modal-titlet"></h4>
            </div>
         <center><i class='tgl_dok'></i></center>
            <div class="modal-body" id="isimodal">
                							
            </div>
           <center><span id="tombol"></span></center>
            
            
            </center>
<br>
            
        </div>
    </div>								
</div>


 
	
 
						
						
						
						
						
						
						
 