 <div class="modal-body" id="area_formSubmit"> 
<?php
$status_t=$this->mdl->getKonfirmasi($id)->row();
if($status_t->sts=="2")
{
	echo "<pre><h4> Mohon menunggu!
 Pembayaran anda sedang diproses...</h4> </pre>";
	return true;
}?>
   <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" align="justify" style="scrol" >
							  <div class="row clearfix  " style="margin-top:-20px;min-height:300px">
                                 <!---->
								 
                        
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
							 <li role="presentation"   class="tab1 active">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">mouse</i> NO.REKENING PEMBAYARAN
                                    </a>
                                </li>
                                <li role="presentation" class="tab2">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons"> beenhere</i>KONFIRMASI PEMBAYARAN 
                                    </a>
                                </li>
                               
                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title">
                                    
                                    <p>
									 
									<!-------------------------->
									  
                        <div class="body">
 
                                   <p>
								  <form id="formSubmit" action="javascript:submitForm('formSubmit')" method="post" url="<?php echo base_url("adm/insKonfirmasi");?>">
                     
                                       <table class="table table-striped" style='color:black'>
									   <tr><td> Jumlah Transfer </td><td>:</td><td> <input type="text" required class="form-control" onkeydown="return numbersonly(this, event);" name="nominal"></td></tr>
									   <tr><td> Bank </td><td>:</td><td>
									   <select name='f[id_bank]' class="form-control" required>
									   <option value=""> === Pilih ===</option>
									   <?php $db=$this->mdl->getBank();
									   foreach($db as $val)
									   {
										   echo "<option value='".$val->id."'>".$val->nama."</option>";
									   }
									   ?>
									   </select>
									   </td></tr>
									   <tr><td> No.Rekening </td><td>:</td><td> <input required type="text" onkeydown="return nomor(this, event);" class="form-control" name="f[no_rek]"></td></tr>
									   <tr><td> Atas Nama </td><td>:</td><td> <input required type="text" class="form-control" name="f[an]"></td></tr>
									   <tr><td> Tanggal Transfer </td><td>:</td><td> <input required type="text" class="form-control datepicker" name="tgl_trf" 
									   value="<?php echo date("d/m/Y")?>"></td></tr>
									   <tr><td> Upload bukti Transfer </td><td>:</td><td> <input type="file" required class="form-control" name="bukti_trf"  ></td></tr>
									   <tr><td> Untuk Pembayaran </td><td>:</td><td class='col-pink'> <?php echo strip_tags($nama);?></td></tr>
									    <tr><td> Tambahkan Keterangan </td><td>:</td><td> <input   type="text" class="form-control" name="f[ket]"></td></tr>
									    <tr><td colspan="3" align="center">
										<button  onclick="submitForm('formSubmit')" class="btn bg-teal waves-effect">
											<i class="material-icons">save</i>
											<span width="200px">SIMPAN</span>
										</button></td></tr>
									   </table>
									    <?php echo $this->m_reff->setToken();?>
										<input type='hidden' name='f[id_tagihan]' value='<?php echo $id;?>'>
										
									 </form>  
                                    </p>
                        </div>
              
           
									<!-------------------------->
 
									</pre>
                       
                                    </p>
                                </div>
								
								
                                <div role="tabpanel" class="tab-pane fade  in active" id="profile_with_icon_title">
                                    <p>
										  <b class="col-teal">Silahkan Melakukan Transfer Ke Rekening Dibawah Ini:</b>
<pre><h4><?php echo $this->m_reff->goField("pengaturan","val","where id=3");?></h4></pre>
  <b class="col-teal">Setelah Transfer Mohon Melakukan Konfirmasi Pada Tab Konfirmasi Atau  
  <a onclick="tabkonfirm()" class="col-pink" href="#home_with_icon_title" data-toggle="tab">Klik Disini.</a> </b>
                                    </p>
                                </div>
                                
								
                            </div>
                           
                                 <!---->
                                </div> 
   </div> 
 
 
<div class="clearfix"></div>
 
 
						
						 </div>
						 
<script>
function tabkonfirm()
{
	$(".tab1").removeClass("active");
	$(".tab2").addClass("active");
}	
  $('.datepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: false,
        weekStart: 1,
        time: false
    });
</script>				 

 