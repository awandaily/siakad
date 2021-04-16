<?php
$id=$this->uri->segment(3);
$this->db->where("kode",$this->mdl->kode());
$this->db->where("id_eskul",$this->mdl->ids());
$this->db->where("id_group",$id);
$this->db->where("id_tahun",$this->m_reff->tahun());
$this->db->where("id_semester",$this->m_reff->semester());
$data=$this->db->get("eskul_anggota")->row();
 $data=isset($data->j_siswa)?($data->j_siswa):"";
//if(!$data){ echo "Anda belum menambahkan anggota."; return false;}
$data=json_decode($data,TRUE);
 if(!$data){ echo "Data siswa belum ditambahkan"; return false;}
array_multisort(array_column($data,"nama"), SORT_ASC, $data);

  $this->mdl->hadiroh($id);
/*$cek=$this->db->query("select * from eskul_absen where kode='".$this->mdl->kode()."' and tgl='".date('Y-m-d')."' and id_group!='".$id."' ")->num_rows();
if($cek)
{
	echo '<div class="row clearfix">
       <div class="col-md-12">   
		   <div class="card body">
		   ANDA TELAH
</div></div></div>		   ';
		   
}
*/
?>
<div class="row clearfix">
       <div class='col-md-12'>   
		   <div class=' card body'>   
			   <table class="table table-striped table-bordered">
			   <thead class="bg-teal">
			   <tr>
			   <th>ABSEN</th>
			   <th>NAMA ANGGOTA</th>
			   </tr>
			   </thead>
			   <?php
			   $no=1;
			  
			   foreach($data as $key=>$val)
			   {	$id_siswa=$val['id'];
				   $cek=$this->mdl->cekAbsen($id,$val['id']);
				   if($cek){
					   $absen="<button id='opsi".$id_siswa."' class='osiap btn btn-block bg-teal waves-effect' onclick='alfa(`".$id."`,`".$id_siswa."`)' >HADIR</button>";
				   }else{
						$absen="<button id='opsi".$id_siswa."'  class='osiap btn btn-block btn-default waves-effect'  onclick='hadirkan(`".$id."`,`".$id_siswa."`)'>TIDAK HADIR</button>";
				   }
				   echo "<tr>
				   <td>".$absen."</td>
				   <td>".$val['nama']."</td>
				   </tr>";
			   }
			 
			   ?>
			   </table>
		   </div>                  
  </div>					
</div>					
						
						
<script>	
 				
function alfa(idg,ids)
{
	 $.post("<?php echo site_url("eskul_absensi/alfain"); ?>",{idg:idg,ids:ids},function(data){
		$("#opsi"+ids).removeClass("bg-teal");		 
		$("#opsi"+ids).addClass("btn-default");		 
		$("#opsi"+ids).text("TIDAK HADIR");		 
		$("#opsi"+ids).attr("onclick","hadirkan(`"+idg+"`,`"+ids+"`)");		 
	});
}

function hadirkan(idg,ids)
{
	 $.post("<?php echo site_url("eskul_absensi/hadirkan"); ?>",{idg:idg,ids:ids},function(data){
		$("#opsi"+ids).removeClass("btn-default");		 
		$("#opsi"+ids).addClass("bg-teal");		 
			$("#opsi"+ids).text("HADIR");	
		$("#opsi"+ids).attr("onclick","alfa(`"+idg+"`,`"+ids+"`)");		 		 
	});
}
 
</script>						
 