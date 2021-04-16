 <div class="row clearfix">
 
 	<?php
	$id_guru=$this->mdl->idu();
	$id_tahun=$this->m_reff->tahun();
	$id_semester=$this->m_reff->semester();
for($i=1;$i<=6;$i++)
{?>

	  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="bodyd" style="min-height:200px;padding:10px">
						<!---------------------->
						  <span style="font-size:18px"><?php echo $this->m_reff->goField("tr_hari","nama","where id='".$i."'");?></span>
                              <table class="entry" width="100%">
							  <tr>
							  <th>JAM KE</th><th>MATA PELAJARAN </th><th>KELAS</th>
							  </tr>
							  <?php
							  $db=$this->db->query("select * from v_jadwal where id_guru='".$id_guru."' 
							  and id_tahun='".$id_tahun."' and id_semester='".$id_semester."' and id_hari='".$i."'
							 order by  CAST(jam_Awal AS SIGNED INTEGER) ASC ")->result();
							  foreach($db as $val)
							  {
							  echo "<tr>
							  <td>".$val->jam_range."</td>
							  <td>".$val->mapel."</td>
							  <td>".$this->m_reff->goField("v_kelas","nama","where id='".$val->id_kelas."'")."</td>
							  </tr>";
							  }
							  ?>
							  </table>
                      
						<!---------------------->
						 
                           </div>
						</div>
         </div>
<?php  } ?>	


	
 </div>
						
						
						
						
						
						
						
 