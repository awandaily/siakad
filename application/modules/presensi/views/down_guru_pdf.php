
<style type="text/css">
	.tb {
	  border-collapse: collapse;
	}

		.tb tr td {
		  border: 1px solid black;
		  padding: 5px;
		  text-align: center;
		}
</style>

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
?>
<?php
	foreach($data as $dataDB){
		$masuk 		= 0;
		$alfa		= 0; 
		$kolom		= 0;
		$hasilDB	= "";
		$efektif 	= 0;
		//$jamMasuk 	= 0;
		//$jamTelat 	= "";
		$telat 		= 0;

		
		$row = "";
		for($i=0;$i<$jml;$i++){
			$n=$n=$this->tanggal->tambah_tgl($tgl1o,$i);
			$tgl=$this->tanggal->tambah_tgl($tgl1o,$i);
			$hasil=$this->mdl->cekAbsenFinger($dataDB->nip,$tgl);	
			$nip=$dataDB->nip;
			$row .= "<tr>";
			$hasilDB = "<td>".date("d/m/Y", strtotime($n))."</td>";

			if($hasil==1){//ada
			 	$datang=$this->mdl->absenDatang($tgl,$nip);
			 	$pulang=$this->mdl->absenPulang($tgl,$nip);
			  	$sts=$this->mdl->status_absen($tgl,$nip);
			  	if($sts!="0"){
			        $masuk++;
			        $jamMasuk=$this->mdl->selisih($pulang,$datang);
			         if($sts=="t" or $sts=="tp"){
			             $jamTelat=$this->mdl->selisih($datang,$jamSetingMasuk);
			             $telat++;
			         }
			         else{
			         	$jamTelat = "";
			         }         
			               
			    }
			    else{
	                 //$alfa++;
			    	 $telat++;
	                 $jamTelat = "";
	                 $jamMasuk = "";
	            }
			    $hasilDB.='<td style="">'.$datang.'</td>
			             <td style="">'.$pulang.' </td>
			             <td>'.$this->mdl->hitungJam($jamTelat).'</td>
			             <td>'.$this->mdl->hitungJam($jamMasuk).'</td>
			             ';
			    $kolom=2+$kolom;
			 	$efektif++;

			 }
			 elseif($hasil==2){//tidak
			   //  $hasil='<td  style="background-color:#F08080">&#10006;</td>';
			 	//$jamTelat=$this->mdl->selisih($this->mdl->absenPulang($tgl,$nip),$this->mdl->absenDatang($tgl,$nip));

			 	$this->db->where("id_tahun", $tahun);
			 	$this->db->where("id_semester", $semester);
			 	$this->db->where("id_guru", $dataDB->id);
			 	$this->db->where("id_hari", date("N", strtotime($n)));
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

			    $hasilDB.='
			    		 <td style="">'.$tidak_absen.'</td>
			             <td style="">'.$tidak_absen2.' </td>
			             <td></td>
			             <td></td>
			             ';
			    
			    $kolom=2+$kolom;
			    
			 }
			 elseif($hasil==3){//libur masuk
			    $hasilDB.='<td style="">Libur</td><td style="background-color:#FAFAD2">Libur</td>
			    			<td></td>
			    			<td></td>
			    ';  
			    $kolom=2+$kolom;
			 }
			 elseif($hasil==6){//   
			   $hasilDB.='<td style="" colspan="2">Sabtu</td>
			   			 <td></td>
			   			 <td></td>
			   ';  
			   $kolom=1+$kolom;
			 }
			 elseif($hasil==7){//   
		       $hasilDB.='<td style="" colspan="2">Minggu</td>
		       				<td></td>
		       				<td></td>
		       ';
			    $kolom=1+$kolom;
			 }
			 else{//libur off
			  // $hasilDB='<i class="material-icons col-pink">event</i>';
			    $hasilDB.='<td style="" colspan="2">Libur</td>
			    			<td></td>
			    			<td></td>
			    ';  
			    $kolom=2+$kolom;
			 }
		 
			 $row.=$hasilDB;
			 $row.="</tr>";	 
		}

		

		echo "
			<page orientation='portrait' >
			<table style='border:1px solid;border-style: thin;table-layout: fixed;padding: 10px;'>
				<tr>
					<td width='50'>NAMA</td>
					<td>:</td>
					<td width='245'>".$dataDB->nama_lengkap."</td>
					<td>EFEKTIF</td>
					<td>:</td>
					<td width='270'>".$efektif." Hari</td>
				</tr>
				<tr>
					<td>NIP</td>
					<td>:</td>
					<td>".$dataDB->nip."</td>
					<td>MASUK</td>
					<td>:</td>
					<td>".$masuk." Hari</td>
				</tr>
				<tr>
					<td>STATUS</td>
					<td>:</td>
					<td>".$this->m_reff->goField("tr_sts_pegawai","nama","where id='".$dataDB->sts_kepegawaian."'")."</td>
					<td>TELAT</td>
					<td>:</td>
					<td>".$telat." Hari</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>TIDAK MASUK</td>
					<td>:</td>
					<td>".$alfa." Hari</td>
				</tr>
			</table>
			<table border='0' class='tb'>
				<tr>
					<td width='150'>Tanggal</td>
					<td width='100'>Masuk</td>
					<td width='100'>Pulang</td>
					<td width='130'>Telat</td>
					<td width='121'>Waktu Kerja</td>
				</tr>
				".$row."
			</table>
		</page>
		";
	}
?>
