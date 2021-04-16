<?php $sts=$this->m_reff->goField("tm_peserta","sts","where id='".$this->session->userdata("id")."'");	?>

    <?php
    if($sts==0)
    {?>
<div><b>INFORMASI :</b><br>
1. Silahkan upload berkas anda dengan mengklik tombol <i class="col-red">upload</i>.<br>
2. Untuk mengganti file yang sudah terupload silahan klik kembali tombol <i class="col-red"> Upload</i>.<br>
</div>

<?php }else{?>

             <div class="card">
                        <div class="body  bg-pink">
                           Anda telah menyelesaikan pendaftaran dan selama proses verifikasi anda tidak dapat merubahnya.
                        </div>
                    </div>
          


<?php } ?>

<?php $data=$this->mdl->dataProfile();?> 
              <!-- Validation Stats -->
            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card"  >
                        <div class="header">
                            <h2>
                               UPLOAD BERKAS PERSYARATAN ( SCAND )
                            </h2>
                            
                        </div> </div>
                        <div class="body">
                             
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					 
		
						 <!--------------->
					
					  <?php 
					   $sts_verifikasi=$this->m_reff->goField("tm_peserta","sts","where id='".$idu=$this->session->userdata("id")."'");
						 $this->db->where("id_persyaratan",$data->posisi_peminatan);
						 $data=$this->db->get("tm_upload")->result();$i=1;$idu=$this->session->userdata("id");$sts=1;
						 foreach($data as $data)
						 {
						     $nama="nama".str_replace(" ","_",substr($data->id,0,10));
			if($data->required==0)
			{
			$required="<i class='pull-right'>opsional.</i>";    
			}else{
			 $required="<i class='pull-right'>wajib diisi.</i>";       
			}
			
			
			$file=$this->m_reff->goField("tm_data_upload","nama_file","where id_persyaratan='".$data->id_persyaratan."' 
			and id_upload='".$data->id."' and id_admin='".$idu."' ");
			if($file)
			{	$sts++;
				  $format=substr($file,-3);
				if(strtoupper($format)!="PDF")
				{
					$gambar= "<center> <a 	href='".base_url()."file_upload/peserta/".sprintf("%06s",$idu)."/".$file."' target='new'><img class='img-responsive thumbnail'   style='height:180px;width:255px' 
					src='".base_url()."file_upload/peserta/".sprintf("%06s",$idu)."/".$file."'></a></center>";
				}else{
					$gambar="<center><embed src='".base_url()."file_upload/peserta/".sprintf("%06s",$idu)."/".$file."'  style='height:196px;width:255px' > </embed></center>";
				}
			
			$bg="bg-green"; 
			}else{
				$gambar="";$bg="bg-red"; 
			}
				
				if($sts_verifikasi==0){
            	$tom=' <div type="file" id="'.$nama.'">Upload</div>';
				}else{
				    $tom='';
				}
				
				
	      
	             $type=str_replace("JPG","jpg,jpeg",strtoupper($data->type));
	             
	            
	            
	            echo '	 
                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"  >
                    <div class="card" id="card'.$i.'" style="min-height:200px">
                        <div class="headertab'.$i.' header '.$bg.' ">
                         <p style="border-bottom:white solid 1px">   <b> '.$data->nama.'</b></p>
							<span class="pull-right"><i style="font-size:12px;color:white">Format: '.$data->type.'  - max upload : 2Mb </i></span>
                             
                        </div>
                        <div class="body" style="margin-left:-15px">
						<div id="img'.$i.'">'.$gambar.'</div>
						
                          <i style="font-size:12px;color:black"> '.$tom.$required.'</i>
                        </div>
						
						  <script>
							   $("#'.$nama.'").uploadFile({
								url:"'.base_url().'data_profile/upload?idt='.$data->id.'&idp='.$data->id_persyaratan.'",
								multiple:false,
							 
								returnType: "json",
								showDelete: true,
								showDone: false,
								showStatusAfterSuccess: false,
							 	showPreview:false,
								maxFileSize:2000*1000,
								previewHeight: "100px",
								previewWidth: "100px",
								abortStr: "Batalkan",
								allowedTypes: "'.$type.'",
								cancelStr: "Cancel",
								dragdropWidth:250,
								statusBarWidth:250,
								extErrorStr: "Format yang diijinkan: ",
								sizeErrorStr: "Maksimal Size ",
								maxFileCountErrorStr: "Maksimal Upload:",
								fileName:"myfile",
								formData: {idt:`'.$data->id.'`,idp:`'.$data->id_persyaratan.'`},
								 onSuccess: function (files, response, xhr,pd) {
									return submit(`'.$i.'`,`'.$data->id.'`,`'.$data->id_persyaratan.'`);
								 },
								});
							   </script>
							     
						
						
                    </div>
                </div>
          
                  
              ';
							 
							 $i++;
							  
						 }
						 ?>
					  
						 <!--------------->
						   
		              
                        </div>
                    
                </div>
                       				
 
		 
 <script>
 function submit(i,idupload,id_persyaratan)
 {
  
    $.ajax({
	 url:"<?php echo base_url()?>data_profile/reload?idupload="+idupload+"&id_persyaratan="+id_persyaratan,
     success: function(data)
            { 
				 $("#img"+i).html(data);
				berhasil_disimpan();
				$(".headertab"+i).removeClass("bg-red");
				$(".headertab"+i).addClass("bg-green");
				sts();
            }
    });   
	
}
sts();
function sts()
{	 
	var s="<?php echo $sts;?>";
	var i="<?php echo $i;?>";
	if(s==i)
	{
		$("#sts").html("<b>lengkap</b>");
	}else{
		$("#sts").html("<b>Belum lengkap</b>");
	}
}
 
 </script>
 
 