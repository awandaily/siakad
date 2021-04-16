 
<?php

	
	$tgl = $this->tanggal->eng_($_POST['tgl'], "-");

	$get = $this->mdl->jadwal_mapel($tgl)->result();

	$mapel = "";
	foreach ($get as $v) {

		$nsiswa = $this->mdl->kehadiran_permapel($v->id, $tgl)->num_rows();
		$siswa = $this->mdl->kehadiran_permapel($v->id, $tgl)->result();


		if ($nsiswa != 0) {
			
			

			$dt = "";
			$n = 1;
			foreach ($siswa as $vs) {
				$dt .= "
					<tr>
						<td>".$n."</td>
						<td>
							<a href='javascript:vid(0)' onclick='detail(`".$vs->id."`)' >
								".$this->m_reff->goField("data_siswa","nama","where id='".$vs->id."'")."
								<br>
								<span class='col-pink'>".$this->m_reff->goField("v_kelas","nama","where id='".$vs->id_kelas."'")."</span>
							</a>
						</td>
						<td>".$this->mdl->cekStatusHadirAbsenMapel($vs->id, $v->id)."</td>
					</tr>
				";

				$n++;
			}

		}
		else{
			$dt = "<tr><td colspan='3' align='center'><i>hadir semua.</i></td></tr>";
		}





		$mapel .= "

			<div class='card'>
			    <div  >
			        
			        <span class='col-pink' style='margin-left:5px'>	Mapel : ".$this->m_reff->goField("tr_mapel", "nama", " WHERE id='".$v->id_mapel."' ")." </span> |
			         <span class='col-brown'>	Jam ke : ".substr($v->jam, 1, -1)."</span> | 
			         <span class='col-indigo'>	Guru : ".$this->m_reff->goField("data_pegawai", "nama", " WHERE id='".$v->id_guru."' ")."</span>
			        
			    </div>
			    <div class='body entry'>
			    	<div class='table-responsive'>
			    		<table>
			    			<thead>
			    				<th width='10%'>NO</th>
			    				<th>NAMA & KELAS</th>
			    				<th width='10%'>KEHADIRAN</th>
			    			</thead>
			    			<tbody>
			    				".$dt."
			    			</tbody>
			    		</table>
			    	</div>
			    </div>
			</div>
		";

	}


	echo $mapel;
?>





<style>
label {
  display: block;
  padding: 1px;
  position: relative;
 font-weight:normal;
}
label input {
  display: none;
}
label span {
  border: 1px solid #ccc; 
  width: 25px; height: 25px;
  position: absolute;
  overflow: hidden;
  <?php
  if($this->m_reff->mobile())
  {?>
  line-height: 2;
  <?php }else{?>
  line-height: 1.7;
  <?php } ?>
  text-align: center;
  border-radius: 100%;
  font-size: 10pt;
  left: 0; 
  top: 40%;
  color:black;
  
   font-weight:bold;
}
input:checked + span { /*Checked Controller*/
  background: #009688;
  border-color: black;
  color:white;
   font-weight:bold;
}
 
</style>

<style>
.asiss{
	border-bottom:black solid 1px;padding:5px;padding-left:13px;
	cursor:pointer;
}
 
</style>
<center><b>  Absen harian  : <?php echo $this->tanggal->hariLengkap($tgl,"/");?></b></center>
 <div class="body table-responsive" id="loading">
<table class="entry table-border table-striped table-hover " id="view" width="100%">
 <tr>
 
 <th  class='bg-green'>NO</th>
 <th class='bg-green'>NAMA</th>
 <?php
  $datasts=$this->db->get_where("tr_sts_kehadiran")->result();
 $tgl=$this->input->post("tgl");
 foreach($datasts as $sts)
 {?>
 <th width="20px" class='bg-green'><?php echo $sts->alias;?></th>
 <?php } ?>
 </tr>



<?php   
                                $semester=$this->m_reff->semester();
                             	$tahun_real=$this->m_reff->tahun_asli();
	                        	$tahun_kini=$this->m_reff->tahun();
	                        	if($tahun_real==$tahun_kini){
                             		$id_kelas=$this->m_reff->goField("tm_kelas","id","where id_wali='".$this->mdl->idu()."'");
	                        	}else{
	                        	    
	                                   $getIdSiswa=$this->m_reff->goField("tm_catatan_walikelas","id_siswa","where _cid='".$this->mdl->idu()."' and id_tahun='".$tahun_kini."' order by RAND()   limit 1");
	                         	    $id_kelas=$this->m_reff->getHisKelas($getIdSiswa);    
	                        	} ?>





<?php
$token=date("His");
 $no=1;
$this->db->order_by("nama","asc");
$this->db->where_in("id_sts_data","1,4");
$this->db->where("id_kelas",$id_kelas);
$siswa=$this->db->get("data_siswa")->result();
$no=1;
foreach($siswa as $val)
{	$ids=$val->id;
	$nama=$this->m_reff->goField("data_siswa","nama","where id='".$val->id."'");
	$nama=strtolower($nama);
	$nama=ucwords($nama);
?>
<tr>
 
<td>
 <?php echo $no++;?>  
 </td><td>
 <?php echo $nama;?>  
 </td>
 <?php

 foreach($datasts as $sts)
 {
	 
	$stscek=$this->mdl->cekStsHadirSiswa($val->id,substr($tgl,0,10));
	 if($sts->id==$stscek)
	 {
		$absen="checked";
	 }else{
		 $absen="";
	 }
	 
	 if($sts->id==1){
		 $namaabsen="Masuk";$abjad="M";
	 }elseif($sts->id==2){
		 $namaabsen="Sakit";$abjad="S";
	 }elseif($sts->id==3){
		 $namaabsen="Izin";$abjad="I";
	 }elseif($sts->id==4){
		 $namaabsen="Alfa";$abjad="A";
	 }elseif($sts->id==5){
		 $namaabsen="Dispen";$abjad="D";
	 }elseif($sts->id==6){
		 $namaabsen="Bolos";$abjad="B";
	 }
	 
	 
	 
	?> 
	  <td align="center" data-toggle='tooltipxx' 
		  data-original-title='<?php echo $namaabsen;?>'
			  data-placement='top'> 
			 	<label class="cursor">
		<input onclick='simpanAbsensidonkah()' type="radio" value="<?php echo $sts->id;?>"  <?php echo $absen?> class="filled-in chk-col-pink absen<?php echo $token;?>"    
		  idsiswa="<?php echo $val->id;?>" chek="<?php echo $stscek?>" absen="<?php echo $sts->id;?>"  id="<?php echo $ids; ?>id<?php echo $sts->id; ?>" 
		  name="f[id<?php echo $ids; ?>]"  />
		  <span for="<?php echo $ids; ?>id<?php echo $sts->id; ?>"><?php echo $abjad;?></span> 
		  </label>
		<label for="<?php echo $ids; ?>id<?php echo $sts->id; ?>">&nbsp;</label> 
 </td>  
 
 
  
 <?php }
 ?>
 
  </tr>
<?php } ?>


 </table>
 
 
 
 
 
 
     <script> 
	function simpanAbsensidonkah(){
	    loading("loading");
			   var idabsen=$(this).attr("absen");
			   var idsiswa=$(this).attr("idsiswa");
			   var idjadwal="";
			   var idmapel="";
			   var tgl="<?php echo $tgl?>";
					var hadir="";
					var sakit="";
					var izin="";
					var alfa="";
					var bolos="";
					var dispen="";
					
			   
				$('input:radio').each(function() {
				if($(this).is(':checked')) {
					var idabsen=$(this).attr("absen");
					var idsiswa=$(this).attr("idsiswa");
					
				
					if(idabsen==1)
					{
						  hadir=","+idsiswa+hadir;
					}
					if(idabsen==2)
					{
						  sakit=","+idsiswa+sakit;
					}	
					if(idabsen==3)
					{
						  izin=","+idsiswa+izin;
					}	
					if(idabsen==4)
					{
						  alfa=","+idsiswa+alfa;
					}
					if(idabsen==5)
					{
						  bolos=","+idsiswa+bolos;
					}
					if(idabsen==6)
					{
						  dispen=","+idsiswa+dispen;
					}					
					  
			  }else{
			  }				  
			  
			});
			 
		  $.post("<?php echo site_url("walikelas/siswaMasuk"); ?>",{tgl:tgl,dispen:dispen,hadir:hadir,sakit:sakit,izin:izin,alfa:alfa,bolos:bolos,idabsen:idabsen,idsiswa:idsiswa},function(data){
		 unblock("loading");
		      }); 
  };
  

  
 </script>  
     <br>