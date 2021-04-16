 <?php 
$mapelajar=$this->input->get_post("kelas");
$datamapelajar=$this->db->get_where("v_mapel_ajar",array("id"=>$mapelajar))->row();
$idkelas=isset($datamapelajar->id_kelas)?($datamapelajar->id_kelas):"";
$idmapel=isset($datamapelajar->id_mapel)?($datamapelajar->id_mapel):"";
if(!$idkelas){ echo "<i>Silahkan Pilih Kelas.</i>";return false; }
  $datax=$this->db->get("tr_sikap");
  $jmlkikd=$datax->num_rows();
  $sms=$this->m_reff->semester();
  $smester=$this->m_reff->semester();
  $disabled="";
  if($sms!=$smester)
  {
	  $disabled="disabled";
  }
 
 ?>
 <div class="table-responsive">
     <div class="col-md-10">
          <?php
     {
     	$tahun_real=$this->m_reff->tahun_asli();
	         $tahun_kini=$this->m_reff->tahun();
	    	if($tahun_real==$tahun_kini){
                echo '	<button class="btn bg-teal pull-left" onclick="isiOtomatis(`'.$idkelas.'`,`'.$idmapel.'`,`A`)">Isi Otomatis dengan nilai (Sangat baik) </button>';
                  echo '	<button class="btn bg-green pull-left " onclick="isiOtomatis(`'.$idkelas.'`,`'.$idmapel.'`,`B`)">Isi Otomatis dengan nilai (Baik)</button>';
                    echo '	<button class="btn bg-orange pull-left" onclick="isiOtomatis(`'.$idkelas.'`,`'.$idmapel.'`,`C`)">Isi Otomatis dengan nilai (Cukup)</button>'; 
	           	}
     }?>
     </div>
 <div class="pull-right col-md-2 col-xs-12">
     
							<button class="btn bg-teal btn-block" onclick="importNilai()">Import Nilai</button>
							</div>
                               <table id='tables' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								 
								<tr>
									<th class='bg-teal sadow' width='15px'>&nbsp;NO</th>
									<th class='bg-teal sadow' >NAMA SISWA</th>								 
									<th class='sadow bg-pink' width="150">NILAI SIKAP</th>
								 
								</tr>
								<tr  class='sadow bg-teal'>			
									
									
									 <?php
									
									 foreach($datax->result() as $data)
									 {
										 //echo "<th class='thead' > ".$data->nama."</th>";
									 }
									 ?>
								   	  
									
								</tr>
								<?php
								$no=1;
								$datakelas=$this->mdl->dataSiswa($idkelas); 
								foreach($datakelas as $val)
								{
									echo "<tr>
									<td>".$no++."</td>
									<td>".$val->nama."</td>";

									/*
										 <input 
												 data-toggle='tooltip' type='text' 
												 data-original-title='Nilai'
												 data-placement='top' 
												 ".$disabled." 
												 value='".$this->mdl->getNilaiSikap2($val->id,$idmapel,$data->id,$sms)."' 
												 style=''
												 id='nilai' 
												 onchange='setNilai(`".$val->id."`,`".$idmapel."`)'>
									*/
									 
									$class="font-bold";

									$dtnilai = $this->mdl->getNilaiSikap2($val->id,$idmapel,$sms);

									switch ($dtnilai) {
										case 'A':
											$sla = "selected";
											$slb = "";
											$slc = "";
											$sld = "";
											$sle = "";
										break;
										case 'B':
											$sla = "";
											$slb = "selected";
											$slc = "";
											$sld = "";
											$sle = "";
										break;
										case 'C':
											$sla = "";
											$slb = "";
											$slc = "selected";
											$sld = "";
											$sle = "";
										break;

										
										default:
											$sla = "";
											$slb = "";
											$slc = "";
											$sld = "";
											$sle = "";
										break;
									}
										 
									 echo "
									 		<td class='".$class."'>
												<select class='form-control' id='nilai_".$no."' ".$disabled." onchange='setNilai(`".$val->id."`,`".$idmapel."`, `".$no."`)'>
													<option value=''>-- Pilih Nilai --</option>
													<option value='A' ".$sla.">Sangat Baik</option>
													<option value='B' ".$slb.">Baik</option>
													<option value='C' ".$slc.">Cukup</option>
												</select>
											</td>
									";
										 
									 	  
								echo " </tr>";
								}
								
								?>
								 
								
							</table>
							</div>		
							
<script>	 
  $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
	
function setNilai(idsiswa,idmapel,no)
{	var nilai=$("#nilai_"+no).val();
	

	$.post("<?php echo site_url("kesiswaan/insertNilaiSikap2"); ?>",{idsiswa:idsiswa,idmapel:idmapel,nilai:nilai},function(){
	 	/*
		var nilai1=$("#nilai"+idsiswa+"1").val();
		var nilai2=$("#nilai"+idsiswa+"2").val();
		var nilai3=$("#nilai"+idsiswa+"3").val();
		var nilai4=$("#nilai"+idsiswa+"4").val();
		var nilai5=$("#nilai"+idsiswa+"5").val();
		
		nilai1=Number(nilai1);
		nilai2=Number(nilai2);
		nilai3=Number(nilai3);
		nilai4=Number(nilai4);
		nilai5=Number(nilai5);
		var hasil= (nilai1+nilai2+nilai3+nilai4+nilai5)/5;
		$("#ratasikap"+idsiswa).html(hasil);*/
	 });
}
</script>	 

<script>
function importNilai()
{
	$("#mdl_formSubmitDown").modal("show");
}

function reload_table()
{
	getNilai();
}
</script>


		  <!-- Modal -->
<div class="modal fade" id="mdl_formSubmitDown" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="area_formSubmitDown">
        <div class="modal-content ">
		<form id="formSubmitDown" action="javascript:submitForm('formSubmitDown')" method="post" url="<?php echo base_url()?>kesiswaan/importNilaiSikap2"  >
                
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title col-teal" id="judul_mdl">
                   IMPORT DATA NILAI
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="col-md-12 body">    
       <center>	
	   <a class="sound" download href="<?php echo base_url()?>kesiswaan/getFormalSikap2/?id=<?php echo $idkelas;?>"  >Download Format  Upload</a> </center>		
				  	
				<div class="row">
				
                                        <div class="form-line"><span id="ket_file">  </span>
					                      <input type="file" accept="xlsx" class="form-control" name="file"  required/>
                                        </div>
                                    </div> 
					 <input type="hidden" name="id_kelas" value="<?php echo $idkelas;?>">
					 <input type="hidden" name="id_mapel" value="<?php echo $idmapel;?>">
                  
            </div>
            </div>
            <div class="row clearfix"></div>
            <div class="modal-footer">
			  
              <button onclick="submitForm('formSubmitDown')"  class="pull-right waves-effect btn bg-teal"><i class="material-icons">cloud_upload</i> UPLOAD</button>
                         
                        </div>
            </form>
        
		</div>
    </div>
</div>
	
<script>
     function isiOtomatis(id_kelas,idmapel,nilai)
{
      
		   $.post("<?php echo site_url("kesiswaan/isi_sikap"); ?>",{id_kelas:id_kelas,idmapel:idmapel,nilai:nilai},function(){
			reload_table();
		      })
}
</script>	
	