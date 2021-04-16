
                                       <table  class="entry" width="100%">
									   <thead class="bg-teal">
									   <tr class="col-white font-weight"><td>Periode </td><td> Tagihan</td><td> Telah dibayar</td> <td> Sisa</td> <td> Tgl Bayar</td></tr>
									   </thead>
									   <?php
									   $id=$this->input->post("kode");
									   $tombol="";
									   $db=$this->db->query("select * from keu_tagihan_pokok where id_siswa='".$id_siswa."' and id_tagihan='".$id."' order by id asc limit ".$limit.",12 ")->result();
									   foreach($db as $db){
										   $tagihan=$db->tagihan;
										   $bayar=$db->bayar;
										   $sisa=$tagihan-$bayar;
										   if($sisa==0)
										   {
											   $sisa='<span class="label label-success">Lunas</span>';
											   if($db->sts==1){
											   $bayar= number_format($bayar,0,",",".");
											   }else{
											    $bayar='<span class="cursor label bg-pink" onclick="batalbebaskan(`'.$db->id.'`)">'.$db->ket.'</span>';
											   }
											   $byr=$this->m_reff->goField('keu_tr_alasanbebas','nama','where id="'.$db->id_alasan.'" ');
											   if(!$byr){ $byr=$this->tanggal->hariLengkap($db->tgl_bayar,"/");  $tombol='<span class="col-black">'.$byr.' 
												<span  class="pull-right waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapusBayar(`'.$db->id_tagihan.'`,`'.$db->tgl_bayar.'`,`'.$db->id_siswa.'`)">  <i class="material-icons col-pink cursor pull-right">delete_forever</i></span></span>';	}else{
											     $tombol='<i class="col-teal">'.$byr.'</i>';
											   }
											  
										   }elseif($bayar<1)
										   {
											   $bayar='-';	$sisa=number_format($sisa,0,",",".");
											   $tombol="<button class='col-teal' onclick='bebaskan(`".$db->id."`,`".$db->tagihan."`)'> Bebaskan</button>";
										   }else{
												$sisa=number_format($sisa,0,",",".");
												$bayar= number_format($bayar,0,",",".");
												
												$byr=$this->m_reff->goField('keu_tr_alasanbebas','nama','where id="'.$db->id_alasan.'" ');
											   if(!$byr){ $byr=$this->tanggal->hariLengkap($db->tgl_bayar,"/");  $tombol='<span class="col-black">'.$byr.' 
												<span  class="pull-right waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapusBayar(`'.$db->id_tagihan.'`,`'.$db->tgl_bayar.'`,`'.$db->id_siswa.'`)">  <i class="material-icons col-pink cursor pull-right">delete_forever</i></span></span>';	}else{
											     $tombol='<i class="col-teal">'.$byr.'</i>';
											   }
												
												
												 
										   }
									   echo "<tr>
									   <td>".$db->satuan." <br> <i class='col-indigo'> Tgl tagihan:".$this->tanggal->ind($db->tgl_tagihan,"/")."</i></td><td> ".number_format($tagihan,0,",",".")."</td><td> ".$bayar."</td> <td> ".$sisa."</td> <td> ".$tombol."</td>
									   </tr>";
									   }
									   ?>
									   </table>
									   
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
					getDataSpp(`<?php echo $limit;?>`,`<?php echo $id_siswa;?>`,`<?php echo $konten;?>`);
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
					getDataSpp(`<?php echo $limit;?>`,`<?php echo $id_siswa;?>`,`<?php echo $konten;?>`);
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
					getDataSpp(`<?php echo $limit;?>`,`<?php echo $id_siswa;?>`,`<?php echo $konten;?>`);
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
                   

  

				   