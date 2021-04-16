
	<?php 
	 $sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
	 $siswa=$this->input->post("id");
	 $kriteria=$this->input->post("kriteria");
	 if(!$kriteria)
	 {
	     $query="(SELECT MAX(id) AS id  FROM  tm_absen_siswa WHERE 
                (
                absen1 LIKE '%,$siswa,%' OR 
                absen2 LIKE '%,$siswa,%' OR 
                absen3 LIKE '%,$siswa,%' OR 
                absen4 LIKE '%,$siswa,%' OR 
                absen5 LIKE '%,$siswa,%' OR 
                absen6 LIKE '%,$siswa,%' 
                ) and id_semester='".$sms."' and id_tahun='".$tahun."' 
                 GROUP BY DATE(tgl))";
                 
	 $data= $this->db->query("select * from tm_absen_siswa where
                 (absen2 LIKE '%,".$siswa.",%' OR 
                 absen3 LIKE '%,".$siswa.",%' OR
                 absen4 LIKE '%,".$siswa.",%' OR 
                 absen5 LIKE '%,".$siswa.",%' OR 
                 absen6 LIKE '%,".$siswa.",%'
                 )
                 and 
                 id_semester='".$sms."' and id_tahun='".$tahun."' and id in($query) group by DATE(tgl) ")->result();
	 }else{
	
	
		$data=$this->db->query("
	SELECT * FROM tm_absen_siswa WHERE absen$kriteria LIKE '%,$siswa,%' AND id_semester='$sms' AND id_tahun='$tahun' 
AND id IN(

SELECT MAX(id) AS id FROM tm_absen_siswa WHERE ( 
absen1 LIKE '%,$siswa,%' OR 
absen2 LIKE '%,$siswa,%' OR 
absen3 LIKE '%,$siswa,%' OR 
absen4 LIKE '%,$siswa,%' OR 
absen5 LIKE '%,$siswa,%' OR 
absen6 LIKE '%,$siswa,%'
 ) 
AND id_semester='$sms' AND id_tahun='$tahun' GROUP BY DATE(tgl)

) GROUP BY DATE(tgl) 
	
	")->result();
	
	
	if($kriteria==2){
	    $sts="SAKIT";
	}elseif($kriteria==3){
	    $sts="IZIN";
	}elseif($kriteria==4){
	    $sts="ALFA";
	}elseif($kriteria==5){
	    $sts="DISPEN";
	}elseif($kriteria==6){
	    $sts="BOLOS";
	}
	
	
	 }
	 

	$no=1;
	if(!$data)
	{
		echo "<center><b>Tidak ada data</b></center>";  return false;
	}?>
	
	
	<table class="entry" width="100%">
  <thead class="sadow bg-indigo">
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            
                                            <th>KETERANGAN</th>
                                            
                                        </tr>
                                    </thead>
	<?php
	foreach($data as $val){
	    
	    if(!isset($sts)){
	        $sts=$this->mdl->getKetAbsen($val->id);
	    }
	    
	    
		echo "<tr>
		<td>".$no++."</td>
		<td>".$this->tanggal->hariLengkap(SUBSTR($val->tgl,0,10),"/")."</td>
	 
		<td>".$sts."</td>
		 
		</tr>";
	}
	?>								
</table>