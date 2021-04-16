
	<?php 
	 $sms=$this->m_reff->semester();
	$tahun=$this->m_reff->tahun();
	 $guru=$this->input->post("id");
	 
	 
	$data=$this->db->query("select * from tm_mapel_ajar where 
	id_guru='".$guru."'	and id_semester='".$sms."' and id_tahun='".$tahun."'   order by id_kelas asc   ")->result();
	$no=1;
	if(!$data)
	{
		echo "<center><b>Tidak ada data</b></center>";  return false;
	}?>
	
	
	<table class="entry" width="100%">
  <thead class="sadow bg-indigo">
                                        <tr>
                                            <th>NO</th>
                                            <th>KELAS - MAPEL</th>
                                            <th>JML JAM / MINGGU</th>
                                                   
                                        </tr>
                                    </thead>
	<?php
	foreach($data as $val){
		echo "<tr>
		<td>".$no++."</td>
	 
		<td>".$this->m_reff->goField("v_kelas","nama","where id='".$val->id_kelas."' ")." - ".$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."' ")."</td>
		<td>".$val->jml_jam."</td>
		 
		</tr>";
	}
	?>								
</table>