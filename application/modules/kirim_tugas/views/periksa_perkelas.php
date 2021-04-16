<?php
$idkelas=$this->input->post("idkelas");
$idtugas=$this->input->post("idtugas");
?>

<div id="lodnilai">
<!---<a href='<?php echo base_url()?>' class='pull-right'><b>DOWNLOAD FILE TUGAS (.ZIP)</b></a>--->
 
<table class="entry" width="100%">
    <tr>
        <th>NO</th>
        <th>NAMA</th>
       
        <th>NILAI</th>
    </tr>
<?php
$mobile=$this->m_reff->mobile();
$this->db->order_by("nama","ASC");
$this->db->where("aktifasi",1);
$this->db->where("id_kelas",$idkelas);
$dt=$this->db->get("data_siswa")->result();
$no=1;
foreach($dt as $dt)
{    $nama=$dt->nama;
    $ds=$this->mdl->cekTugasSiswa($idtugas,$dt->id);
    if(isset($ds->file)?($ds->file):"" or isset($ds->ket)?($ds->ket):"")
    {
     //   if($mobile){
      //      $nama=substr($nama,0,15);
     //   $nama="<a download href='".base_url()."file_upload/tugas/$idtugas/$ds->file?download=true' download><i class='material-icons'>attachment</i> <span style='margin-top:5px;position:absolute'> ".$nama."</span></a>";
     
     //   }else{
     //     $nama="<a target='_blank' href='".base_url()."file_upload/tugas/$idtugas/$ds->file'  ><i class='material-icons'>attachment</i> <span style='margin-top:5px;position:absolute'> ".$nama."</span></a>";
       
    //    }
        
        $class="cursor col-teal ";
        
    $nama="<span onclick='showing(`$dt->id`,`$idtugas`,`$dt->nama`)' class='$class'><i style='position:absolute;margin-left:-4px' class='material-icons'>file_download</i><span style='margin-left:20px'> $dt->nama</span></span>";    
      
    }else{
       $nama=$dt->nama;
      
    }
   if(isset($ds->nilai))
   {
       $nilai=$ds->nilai; 
   }else{
        $nilai="";
   }
    
    
    echo "<tr>
    <td>".$no++."</td>
    <td>".$nama."</td>
  
    <td> <input type='number' id='nilai".$no."' class='inputnilaisin' style='max-width:80px' onchange='setNilai(`".$dt->id."`,`nilai".$no."`)' value='".$nilai."'> </td>
    </tr>";
}
?>
</table>
<br>
<?php
$idmapel=$this->m_reff->goField("data_tugas","id_mapel","where id='".$idtugas."'");
$mapel=$this->m_reff->goField("tr_mapel","nama","where id='".$idmapel."'");
$kelas=$this->m_reff->goField("v_kelas","nama","where id='".$idkelas."'");
$ketTugas=$this->m_reff->goField("data_tugas","judul","where id='".$idtugas."'");
  $stssin=$this->m_reff->goField("data_tugas","kelas_sin","where id='".$idtugas."'");
   $kelascek=",".$idkelas.",";
if(strpos($stssin,$kelascek)!==false){
    echo "<script>$('#sin').hide(); $('.inputnilaisin').attr('disabled', true);</script>";
    $buton=  '<button data-dismiss="modal" class="btn bg-blue-grey btn-block"> 
TUTUP </button>';
}else{
      $buton= '';
   
}

echo  $buton;
?>


  
<div id="sin">
<br>

	<form  action="javascript:submitForm('modal_sinkron')" id="modal_sinkron" url="<?php echo base_url()?>kirim_tugas/sinkron_nilai"  method="post" enctype="multipart/form-data">
	    <input type="hidden" name="idtugas" value="<?php echo $idtugas?>">
	      <input type="hidden" name="idkelas" value="<?php echo $idkelas?>">
	         <input type="hidden" name="idmapel" value="<?php echo $idmapel?>">
      <table class="entry bg-white" width="100%">
          <tr>
              <td class="bg-orange col-black"><center><b>SINKRONKAN NILAI TUGAS KE NILAI KD (PENGETAHUAN)</b> </center></td>
          </tr>
                       	      <tr>
                       	          <td><?php echo $mapel;?></td>
                       	      </tr>
                       	      <tr>
                       	          <td><?php echo $kelas;?></td>
                       	      </tr>
                       	      <tr>
                       	          <td>
                       	              Nama Nilai : <input type="text" name="nama_nilai" class="form-control" required value="<?php echo $ketTugas; ?>">
                       	          </td>
                       	          </tr>
                       	    <td>
                       	              
                       	              <?php
                       	              	$sms=$this->m_reff->semester();
		$tahun=$this->m_reff->tahun();
	$mapel=$idmapel;
	$kelas=$idkelas;
		$mapel_ajar=$this->m_reff->goField("tm_mapel_ajar","id","where id_mapel='".$mapel."' 
		and id_kelas='".$kelas."' and id_guru='".$this->mdl->idu()."' and id_semester='".$sms."' and id_tahun='".$tahun."' ");
	$data='	  <select class="form-control show-tick" id="mapel" required name="id_kikd"  >
                  <option value="">==== Pilih KI ====</option>';
				$dbmepel=$this->db->query("SELECT * from tm_kikd where id_mapel_ajar='".$mapel_ajar."' 
				and id_guru='".$this->mdl->idu()."' and id_semester='".$sms."' and id_tahun='".$tahun."'
				  ORDER BY CAST(SUBSTR(kd3_no,3,3) AS SIGNED INTEGER),id ASC  ")->result();
				foreach($dbmepel as $val){
				$data.="<option value='".$val->id."'>".$val->kd3_no." - ".$val->kd3_desc." </option>";
				};										 
     $data.=' </select>';
	 echo $data;
                       	              ?>
                       	              
                       	              
                       	          </td>
                       	          
                       	          </tr>
                       	          <tr>
                       	              <td>
                       	                  <button class="btn btn-block bg-blue-grey" onclick="submitForm('modal_sinkron')">SINKRON SEKARANG</button>
                       	              </td>
                       	          </tr>
                       	  </table>
    </form>
    
    
</div>

</div>
<script>
 
    function setNilai(ids,idn)
 {  loading("lodnilai");
              var idn=$("#"+idn).val();
              var idtugas="<?php echo $idtugas;?>";
			  $.post("<?php echo site_url("kirim_tugas/setNilai"); ?>",{idsiswa:ids,nilai:idn,idtugas:idtugas},function(data){
			 unblock("lodnilai");
		      }); 
 }
 
  
function reload_table()
{
     $('#sin').hide(); 
     $('.inputnilaisin').attr('disabled', true); 
}

function showing1(idsiswa,idtugas,nama)
{
     $.post("<?php echo site_url("kirim_tugas/getTugas"); ?>",{idtugas:idtugas,idsiswa:idsiswa},function(data){
	        var data=data.split("::");
	      
		 	//    $(".titit").html(nama);
			 //   $("#mdl_modal_show").modal();
		//	    $("#ketugas").html(data[1]);
			    if(data[0]){
			         var file='<ol class="breadcrumb breadcrumb-col-teal"><li> <i class="material-icons">attachment</i><a download="" href="<?php echo base_url();?>file_upload/tugas/'+idtugas+'/'+data[0]+'?download=true" class="col-pink"> Download Lampiran tugas    </a></li></ol>';
			    }else{
			      var file='';
			    }
			    if(!data[1]){
			        var isip="<i>Tidak diisi...</i>";
			    }else{
			        var isip=data[1];
			    }
			    var isi="<div style='padding:20px'><b>Keterangan/Penjelasan:</b><br>"+isip+"</div><br>"+file;
			      $(".ajs-content").html(isi);
			      $(".col-pink").removeClass("ajs-header");
			    
			}); 
}


function showing(idsiswa,idtugas,nama)
{
    
    var pre = document.createElement('p');
//custom style.
pre.style.maxHeight = "600px";
pre.style.margin = "0";
pre.style.padding = "24px";
pre.style.whiteSpace = "pre-wrap";
pre.style.textAlign = "justify";
 
//show as confirm
alertify.confirm(nama,pre, function(){
        alertify.success('Accepted');
    },function(){
       
    }).set('basic', true); 

 showing1(idsiswa,idtugas,nama);
}
</script>



 
 
 
 
 
 
 
 
 
 
 
 
 

 <div class="modal fade" id="mdl_modal_show" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
	<form  action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url()?>tugas/insert"  method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal titit" ></h4>
							 
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_tugas" >
                             
                       	  	
                       	  <b>Keterangan</b>
                         <p class='col-black' id="ketugas"  ></p> 
					  <div id="fileTugas"></div> 
							 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                               <!--         <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                -->         <button  id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_edit')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
   </div><!-- /.modal-dialog --> 

	
 
						