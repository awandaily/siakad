 <div class="row clearfix">

 	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" style="min-height:930px" id="blockarea">
                        
                        <div class="bodyd"   style="min-height:200px;padding:10px">
						<!---------------------->
						
						<div class="col-sm-3">
                                     
                                         
											<?php
											
											$data=$this->mdl->getRepatTahun();
											$array=""; $t=1;
											foreach($data as $val)
											{
											$array[$val->id]="Kelas  ".$t++;
											$thn_ini=$val->id;
											}
											
											$data=$array;
											echo form_dropdown("tahun",$data,$thn_ini,"class='form-control' onchange='gantiBulan()'");
											?>
											
                                        
                                </div>
								<div class="col-sm-3" id="bulan">
                                     
                                             <?php
											  $tahun_1=$this->m_reff->goField("tr_tahun_ajaran","nama","where id='".$thn_ini."'");
											  $awal_bulan=$this->m_reff->goField("tr_tahun_ajaran","tgl_pindah","where id='".$thn_ini."'");
											  $bln_ini=date("Y-m");
												 $awal_bulan=substr($awal_bulan,5,2);
												 $bln=number_format($awal_bulan,0);
												 $tahun_awal=substr($tahun_1,0,4);
												 $ym=$tahun_awal."-".$awal_bulan;
												  $bulanu[""]= "==== Pilih Bulan ====";
													 for($i=0;$i<=(11);$i++)
													 {
														 $kode=$this->tanggal->tambahBln($ym,$i);
														 $bulanu[$kode]= $this->tanggal->bulan(substr($kode,5,2)). " - ".substr($kode,0,4);
														 if($bln==13)
														 {
															$bln=1;  
														 } 
															$bln++;  
														 }
														 $data=$bulanu;
														 echo form_dropdown("bulan",$data,$bln_ini,"class='form-control' onchange='reload()'");
												 ?>
                                        
                                </div>
								
								
								 
								<div class="col-sm-3"></div>
								<div class="col-sm-3">
                                     
                                <button onclick="rekap()" type="button" class="btn btn-block bg-indigo waves-effect">
                                    <i class="material-icons">assignment</i>
                                    <span>Rekap Absensi</span>
                                </button>
                                    
                             
                                    
                                </div>
							  <div class="clearfix"> </div>
						 <p>
							  <div id="isi"></div>
                          </p>
                     		<!---------------------->
						 
                           </div>
						</div>
         </div>
	
 </div>
						
						
						
						
<script>
 
var link="<?php echo base_url()?>";
reload();
function reload()
{
	
	loading("blockarea");
	 var bulan=$("[name='bulan']").val();
	var tahun=$("[name='tahun']").val();
    $.ajax({
	 url:link+"abs/getDataAbsen",
     data:"bulan="+bulan+"&tahun="+tahun,
	 method:"POST",
     success: function(data)
            {
				 $("#isi").html(data);		
				 unblock("blockarea"); 
					
            }
    });   
}

function gantiBulan(bulan,tahun)
{
	var bulan=$("[name='bulan']").val();
	var tahun=$("[name='tahun']").val();
	$.ajax({
	 url:link+"abs/getDataBulan",
     data:"bulan="+bulan+"&tahun="+tahun,
	 method:"POST",
     success: function(data)
            {
				 $("#bulan").html(data);		
	        }
    });   
	 
}
</script>						
						
			    
<script>
 
  function rekap()
  {	var tahun=$("[name='tahun']").val();
	$("#modalGrafik").modal("show");  
	$("#thn").html(tahun);  
	$("#isiGrafik").html("<img src='<?php echo base_url()?>plug/img/load.gif'/> Mohon Tunggu...");	
    $.ajax({
	 url:link+"abs/getGrafik",
     data:"tahun="+tahun,
	 method:"POST",
     success: function(data)
            {
				 $("#isiGrafik").html(data);		
		    }
    });   
  }
 
</script>			



 

<!-- Modal -->
<div class="modal fade" id="modalGrafik" 
       aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" id="myModalLabel">
                  Rekapitaluasi Absensi   <span id="xxx"></span>
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body" id="isiGrafik">
                 
            </div>
            
            <!-- Modal Footer -->
            
        </div>
    </div>
</div>								
 