
	<?php 
	 $sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
	 $siswa=$this->input->post("id");
	 $kriteria=$this->input->post("kriteria");
	 if(!$kriteria)
	 {
		 $kriteria="(absen1 like '%,".$siswa.",%' or absen2 like '%,".$siswa.",%'  or absen3 like '%,".$siswa.",%'  or absen4 like '%,".$siswa.",%' or absen5 like '%,".$siswa.",%' or absen6 like '%,".$siswa.",%' )";
	 }else{
		 $kriteria="(absen".$kriteria." like '%,".$siswa.",%' )";
	 }
	 
	$data=$this->db->query("select * from tm_absen_siswa where 
	$kriteria	and id_semester='".$sms."' and id_tahun='".$tahun."' order by tgl DESC   ")->result();
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
                                            
                                            <th>MAPEL</th>
                                            
                                        </tr>
                                    </thead>
	<?php
	foreach($data as $val){
		echo "<tr>
		<td>".$no++."</td>
		<td>".$this->tanggal->ind(SUBSTR($val->tgl,0,10),"/")."</td>
	 
		<td>".$this->m_reff->goField("v_jadwal","mapel","where id='".$val->id_jadwal."' ")."</td>
		 
		</tr>";
	}
	?>								
</table>