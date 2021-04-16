<div  id="lod_rincian" style="margin-top:-10px;min-height:120px">
                                       <table  class="entry" width="100%">
									   <thead class="bg-teal">
									   <tr class="col-white font-weight"><td><b>Biaya</b> </td><td><b> Tagihan</b></td><td> <b>Telah dibayar</b></td> <td> <b>Sisa</b></td> <td> Tgl Bayar</td></tr>
									   </thead>
									   <?php
									     $tombol="";$t=0;$b=0;$s=0;$i=1;
									   $db=$this->db->query("select * from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$id."' order by id asc   ")->result();
									   foreach($db as $db){
										   $i++;
										   $tagihan=$db->tagihan;
										   $bayar=$db->bayar; $telah_bayar=$db->bayar; $sisa_pembayaran="";
										   $sisa=$tagihan-$bayar;
										   $sisa_pembayaran=$sisa;
										   if($sisa==0)
										   {
											      $tombol='<i class="col-teal">'.$this->m_reff->goField('keu_tr_alasanbebas','nama','where id="'.$db->id_alasan.'" ').'</i>';
											   $sisa='<span class="label label-success">Lunas</span>';
											   $sisa_pembayaran=0;
											   if($db->sts==1){
												   $telah_bayar=$db->bayar;
											   $bayar= number_format($bayar,0,",",".");
											   }else{
												   $telah_bayar=0;
											    $bayar='<span class="cursor label bg-pink" onclick="batalbebaskan(`'.$db->id.'`)">'.$db->ket.'</span>';
											   }
										   }elseif($db->bayar<1)
										   { 	$sisa=number_format($sisa,0,",",".");
											   $bayar=$telah_bayar=0;  
											   $tombol="<button class='col-teal' onclick='bebaskan(`".$db->id."`,`".$db->tagihan."`)'> Bebaskan  </button>";
										   }else{
											
											 	$sisa=number_format($sisa,0,",",".");
												$bayar= number_format($bayar,0,",",".");
												$telah_bayar=$db->bayar; 
												
												
												$byr=$this->m_reff->goField('keu_tr_alasanbebas','nama','where id="'.$db->id_alasan.'" ');
											   if(!$byr){ $byr=$this->tanggal->hariLengkap($db->tgl_bayar,"/");  $tombol='<span class="col-black">'.$byr.' 
												<span  class="pull-right waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapusBayar(`'.$db->id_tagihan.'`,`'.$db->tgl_bayar.'`,`'.$db->id_siswa.'`)">  <i class="material-icons col-pink cursor pull-right">delete_forever</i></span></span>';	}else{
											     $tombol='<i class="col-teal">'.$byr.'</i>';
											   }
												
												
										   }
										   if($db->jenis_tagihan==2){
										   $nama_satuan=$db->satuan;
										   }else{
											   $nama_satuan=$this->m_reff->goField("keu_tr_biaya_pokok","nama","where id='".$db->id_tagihan."'");
										   }
									   echo "<tr>
									   <td>".$nama_satuan."</td><td>   ".number_format($tagihan,0,",",".")." </td>
									   <td> ".$bayar."</td> <td> ".$sisa."</td> <td> ".$tombol."</td>
									   </tr>";
									   $t=$tagihan+$t;
									   $b=$telah_bayar+$b;
									   $s=$sisa_pembayaran+$s;
									   }
									   if($i>2){
									     echo "<tr class='bg-grey col-white'>
									   <td><b>TOTAL</b></td><td><b> ".number_format($t,0,",",".")."</b></td><td><b> ".number_format($b,0,",",".")."</b></td> 
									   <td colspan='2'><b> ".number_format($s,0,",",".")."</b></td> 
									   </tr>";
									   }
									   ?>
									   </table>
	</div>
									   
  <script>
   //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
 
 
	  function hapusBayar(id,tgl,idsiswa){
			 
		      alertify.confirm("<center> Batalkan pembayaran pada tanggal <br> "+tgl+" ? </center>",function(){
		  
			$.ajax({
			url:"<?php echo base_url()?>datasi/batalbayar?id="+id+"&tgl="+tgl+"&idsiswa="+idsiswa,
			type: "POST",
			success: function(data)
					{	  
						getDataRincian(`<?php echo $id;?>`,`<?php echo $id_siswa;?>`);
					getAction();
					} 
			});
		   
		   })
	  };
	  
	  
	  function batalbebaskan(id){
			 
		      alertify.confirm("<center> Batalkan Pembebasan Biaya ? </center>",function(){
		  
			$.ajax({
			url:"<?php echo base_url()?>datasi/batalbebaskan?id="+id,
			type: "POST",
			success: function(data)
					{	  
						getDataRincian(`<?php echo $id;?>`,`<?php echo $id_siswa;?>`);
					getAction();
					} 
			});
		   
		   })
	  };
	  
	   function bebaskansss(id,tagihan){
			$("#dlm").val("");
		      alertify.confirm("<center> Bebaskan Tagihan ? </center>",function(){
		    var ket="Dibebaskan";//$("#dlm").val();
			
			$.ajax({
			url:"<?php echo base_url()?>datasi/setbebaskanTagihan?ket="+ket+"&id="+id+"&tagihan="+tagihan,
			type: "POST",
			success: function(data)
					{	  
					getDataRincian(`<?php echo $id;?>`,`<?php echo $id_siswa;?>`);
					getAction();
					} 
			});
		   
		   })
	  };
	  
	  var id_alasan;
	  var tagihan_alasan;
	   function simpan( ){
			 
			var alasan = $("[name='alasan']").val();
			var id = id_alasan;
			var tagihan = tagihan_alasan;
		  
		    var ket=alasan; 
			if(!ket)
			{
				ket="Dibebaskan";
			}
			
			$.ajax({
			url:"<?php echo base_url()?>datasi/setbebaskanTagihan?ket="+ket+"&id="+id+"&tagihan="+tagihan,
			type: "POST",
			success: function(data)
					{	  
					getDataRincian(`<?php echo $id;?>`,`<?php echo $id_siswa;?>`);
					getAction();
					tutupalasan();
					} 
			});
		   
		    
	  };
	  
	  
	   function bebaskan(id,tagihan)
	{
		id_alasan=id;
		tagihan_alasan=tagihan;
		$("#mdl_alasan").modal({backdrop:'false',keyboard:'true'});
		  $('.modal-backdrop').removeClass("modal-backdrop");   
			  
	}
	function tutupalasan()
	{
		$("#mdl_alasan").modal("hide");
		
	}
	$(".select").selectpicker();
	   </script>
                     <div   class="modal fade in" id="mdl_alasan" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content modal-col-green">
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">Alasan dibebeaskan</h4>
                        </div>
                  <div class="modal-body col-black">
                          <!--        <textarea class="form-control" name='alasan' placeholder="Alasan dibebaskan...."></textarea>
						--->	 
						<select class='form-control select' name="alasan">
						<option value="">--- Pilih ----</option>
						<?php
						$dt=$this->db->get("keu_tr_alasanbebas")->result();
						foreach($dt as $val){
						echo "<option value='".$val->id."'>".$val->nama."</option>";
						}
						?>
						</select>
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn-block  waves-effect btn   waves-effect" onclick="simpan()">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
               