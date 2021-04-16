
<?php

$jamSetingMasuk=$this->m_reff->pengaturan(4);  
$periode=$this->input->get_post("periode");
$tgl1o=$this->tanggal->range_1($periode);
$tgl1=$this->tanggal->ind($tgl1o,"/");
$tgl2o=$this->tanggal->range_2($periode);
$tgl2=$this->tanggal->ind($tgl2o,"/");
$jml=$this->tanggal->selisih($tgl1o,$tgl2o)+1;

	$tahun 		= $this->m_reff->tahun();
	$semester 	= $this->m_reff->semester();


$query=$this->mdl->_get_data_pendidik();
$data=$this->db->query($query)->result();
$isi="";$no=1;$row="";
$ca = "";
foreach($data as $dataDB){ 
    	$row.="<tr>";
		$row.="<td>".$no++."</td>"; 
		$row.= "<td>".$dataDB->nama_lengkap." </td>";
		$row.="<td>".$this->m_reff->goField("tr_sts_pegawai","nama","where id='".$dataDB->sts_kepegawaian."'")."</td>";
		$masuk=0;$alfa=0; $kolom=0;$hasilDB="";$efektif=0;$jamMasuk=0;$jamTelat=0;$telat=0;
   		for($i=0;$i<$jml;$i++){
			$tgl=$this->tanggal->tambah_tgl($tgl1o,$i);
			$hasil=$this->mdl->cekAbsenFinger($dataDB->nip,$tgl);	
			$nip=$dataDB->nip;
			if($hasil==1){//ada
			 	$datang=$this->mdl->absenDatang($tgl,$nip);
			 	$pulang=$this->mdl->absenPulang($tgl,$nip);
			  	$sts=$this->mdl->status_absen($tgl,$nip);
			  	if($sts!="0"){
			        $masuk++;
			        $jamMasuk+=$this->mdl->selisih($pulang,$datang);
			         if($sts=="t" or $sts=="tp"){
			             $jamTelat+=$this->mdl->selisih($datang,$jamSetingMasuk);
			             $telat++;
			             
			         }
			         else{
			         	
			         }         
			        $ca = "#7CFC00";       
			    }
			    else{
	                 //$alfa++;
			    	$telat++;
	                 $ca= "yellow"; 
	            }
			    $hasilDB='<td style="background-color:'.$ca.'"> <font color="'.$ca.'">`</font>'.$datang.'</td>
			             <td style="background-color:'.$ca.'"><font color="#7CFC00">`</font>'.$pulang.' </td>';
			    $kolom=2+$kolom;
			 	$efektif++;

			 }
			 elseif($hasil==2){//tidak
			   //  $hasil='<td  style="background-color:#F08080">&#10006;</td>';


			 	$this->db->where("id_tahun", $tahun);
			 	$this->db->where("id_semester", $semester);
			 	$this->db->where("id_guru", $dataDB->id);
			 	$this->db->where("id_hari", date("N", strtotime($tgl)));
			 	$cek_hari = $this->db->get("v_jadwal")->num_rows();

			 	if ($cek_hari == 0) {
			 		$tidak_absen = "Tidak ada Jadwal";
			 		$tidak_absen2 = "Tidak ada Jadwal";
			 		
			 	}
			 	else{
			 		$tidak_absen = $this->mdl->absenDatang($tgl,$nip);
			 		$tidak_absen2 = $this->mdl->absenPulang($tgl,$nip);
			 		$efektif++;
			 		$alfa++;
			 	}


			    $hasilDB='<td style="background-color:#F08080"> <font color="#F08080">`</font>'.$tidak_absen.' </td>
			             <td style="background-color:#F08080"><font color="#F08080">`</font>'.$tidak_absen2.' </td>';
			    //$alfa++;
			    $kolom=2+$kolom;
			    //$efektif++;
			 }
			 elseif($hasil==3){//libur masuk
			    $hasilDB='<td colspan="1" style="background-color:#FAFAD2">Libur</td><td colspan="1" style="background-color:#FAFAD2">Libur</td>';  
			    $kolom=2+$kolom;
			 }
			 elseif($hasil==6){//   
			   $hasilDB='<td colspan="1" style="background-color:white">S  </td>';  
			   $kolom=1+$kolom;
			 }
			 elseif($hasil==7){//   
		       $hasilDB='<td  coslpan="1"  style="background-color:white">M</td>';
			    $kolom=1+$kolom;
			 }
			 else{//libur off
			  // $hasilDB='<i class="material-icons col-pink">event</i>';
			    $hasilDB='<td colspan="1" style="background-color:#FAFAD2">Libur</td><td colspan="1" style="background-color:#FAFAD2">Libur</td>';  
			    $kolom=2+$kolom;
			 }
		 
			 $row.=$hasilDB;	 
		}
		$row.="<td style='background-color:#F0F8FF;color:black;font-weight:bold'>".$efektif."</td>";
	    $row.="<td style='background-color:#F0F8FF;color:black;font-weight:bold'>".$masuk."</td>";
		$row.="<td style='background-color:#F0F8FF;color:black;font-weight:bold'>".$alfa."</td>";
		$row.="<td style='background-color:#F0F8FF;color:black;font-weight:bold'><font color='#F0F8FF'>`</font>".$this->mdl->hitungJam($jamMasuk)."</td>";
		$row.="<td style='background-color:#F0F8FF;color:black;font-weight:bold'><font color='#F0F8FF'>`</font>".$telat."</td>";
		$row.="<td style='background-color:#F0F8FF;color:black;font-weight:bold'><font color='#F0F8FF'>`</font>".$this->mdl->hitungJam($jamTelat)."</td>";
		$row.="</tr>";
}
$isi=$row;

 

?>
 
 
 
 
  
 
 
 
                             <table  border="1">
							  <thead  style='background-color:#009688;color:white;font-weight:bold'>
								<tr> 
									<th  style='background-color:#009688;color:white;font-weight:bold' rowspan="3" style='max-widtd:3px'>NO</th> 
									<th  style='background-color:#009688;color:white;font-weight:bold' rowspan="3" valign="midle"  >NAMA</th>
									<th  style='background-color:#009688;color:white;font-weight:bold' rowspan="3"  >STATUS</th>  
									
									 <th  style='background-color:#009688;color:white;font-weight:bold'   colspan="<?php echo $kolom;?>"  align="center" >PERIODE <?php echo $tgl1. " - ". $tgl2?></th>
								    	<th  style='background-color:#009688;color:white;font-weight:bold' rowspan="3"  >EFEKTIF (hari)</th> 
									 	<th  style='background-color:#009688;color:white;font-weight:bold' rowspan="3"  >MASUK  (hari)</th>  
										<th  style='background-color:#009688;color:white;font-weight:bold' rowspan="3"  >TIDAK MASUK  (hari)</th> 
										<th  style='background-color:#009688;color:white;font-weight:bold' rowspan="3"  >TOTAL JAM MASUK  </th> 
											<th  style='background-color:#009688;color:white;font-weight:bold' rowspan="3"  > TELAT (Hari)  </th> 
											<th  style='background-color:#009688;color:white;font-weight:bold' rowspan="3"  >TELAT (jam)  </th> 
									 </tr>
							  
							 	<tr> 
										<?php
										for($i=0;$i<$jml;$i++){
										    $n=$n=$this->tanggal->tambah_tgl($tgl1o,$i);
										     $hari=$this->tanggal->namaHari($n);
										     if($hari=="Sabtu" or $hari=="Minggu")
										     {
										        $kol="";  $row="rowspan='2'";
										     }else{
										         $kol="colspan='2'";   $row="";
										     }
										    echo '<th '.$kol.' '.$row.' align="center"  style="background-color:#009688;color:white;font-weight:bold">'.substr($n,8,2).'</th> ';
									
										}
										?>  
									
								</tr>
								<tr>
								    	<?php
										for($i=0;$i<$jml;$i++){
										    $n=$n=$this->tanggal->tambah_tgl($tgl1o,$i);
										    $hari=$this->tanggal->namaHari($n);
										    if($hari=="Sabtu" or $hari=="Minggu")
										     {
										     //      echo '<th '.$kol.' align="center"  style="background-color:#009688;color:white;font-weight:bold">'.substr($n,8,2).'</th> ';
										     }else{
										        echo '<th align="center"  style="background-color:#009688;color:white;font-weight:bold">DATANG</th> ';
										     echo '<th align="center"  style="background-color:#009688;color:white;font-weight:bold">PULANG</th> ';
										     }
										     
										   
									
										}
										?>  
								</tr>
							  </thead>
							  <?php
							echo  $isi;
							  ?>
							</table>
						 
		<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=data-absen-pegawai.xls");
?>
					
						 