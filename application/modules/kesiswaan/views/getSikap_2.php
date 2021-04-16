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
 <div class="pull-right col-md-2 col-xs-12">
							<button class="btn bg-teal btn-block" onclick="importNilai()">Import Nilai</button>
							</div>
                               <table id='tables' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								 
								<tr><th class='bg-teal sadow' rowspan="2" width='15px'>&nbsp;NO</th>
									<th class='bg-teal sadow' rowspan="2" >NAMA SISWA</th>
								 
									<th   class='sadow bg-teal' align="center" colspan="<?php echo $jmlkikd;?>"><center>PENILAIAN</center></th>
									<th class='sadow bg-pink' rowspan="2">NILAI SIKAP</th>
								 
								</tr>
								<tr  class='sadow bg-teal'>			
									
									
									 <?php
									
									 foreach($datax->result() as $data)
									 {
										 echo "<th class='thead' > ".$data->nama."</th>";
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
									 
									 
									 foreach($datax->result() as $data)
									 {
										 
										 
											  $class="font-bold";
										 
										 echo "<td class='".$class."'> 
										 <input 
										 data-toggle='tooltip' type='text' 
										 data-original-title='".strtolower($data->nama)."'
										 data-placement='top' 
										 ".$disabled." value='".$this->mdl->getNilaiSikap($val->id,$idmapel,$data->id,$sms)."' style='max-width:80px'
										id='nilai".$val->id.$data->id."' onchange='setNilai(`".$val->id."`,`".$idmapel."`,`".$data->id."`)'> </td>";
									 
									 }
										 
																			 
										 echo "<td class='font-bold'> <span id='ratasikap".$val->id."'> ".$this->mdl->getNilaiRataSikap($val->id,$idmapel,$sms)." </span></td>"; 
									  
									 	  
								echo " </tr>";
								}
								
								?>
								 
								
							</table>
							</div>		
							
<script>	 
  $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
	
function setNilai(idsiswa,idmapel,sts)
{	var nilai=$("#nilai"+idsiswa+sts).val();
	 $.post("<?php echo site_url("kesiswaan/insertNilaiSikap"); ?>",{idsiswa:idsiswa,idmapel:idmapel,sts:sts,nilai:nilai},function(){
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
		$("#ratasikap"+idsiswa).html(hasil);
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
		<form id="formSubmitDown" action="javascript:submitForm('formSubmitDown')" method="post" url="<?php echo base_url()?>kesiswaan/importNilaiSikap"  >
                
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
	   <a class="sound" download href="<?php echo base_url()?>kesiswaan/getFormalSikap/?id=<?php echo $idkelas;?>"  >Download Format  Upload</a> </center>		
				  	
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
	