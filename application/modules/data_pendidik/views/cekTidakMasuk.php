
	<?php 
	 $sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
	 $guru=$this->input->post("id");
	 
	 
	$data=$this->db->query("select * from tm_absen_guru where 
	id_guru='".$guru."'	and id_semester='".$sms."' and id_tahun='".$tahun."'   AND   jml_jam_blok!=0   order by id desc  ")->result();
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
                                            <th>JAM KE </th>
                                                   
                                        </tr>
                                    </thead>
	<?php
	foreach($data as $val){
		$jam=substr($val->jam_blok,1);
		$jam=substr($jam,0,-1);
		echo "<tr>
		<td>".$no++."</td>
		<td>".$this->tanggal->hariLengkap(SUBSTR($val->tgl,0,10),"/")."</td>
	 
		<td>".$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."' ")."</td>
		<td>".$jam."</td>
		 
		</tr>";
	}
	?>								
</table>