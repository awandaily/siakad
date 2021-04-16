<?php

 $tgl=$this->input->get_post("tgl");

 $hariLengkap=$this->tanggal->hariLengkap($tgl,"/");

 $pisah=explode(",",$hariLengkap);

 $kodeHari=$this->tanggal->kodeHari($pisah[0]);

$i=$ha=$kodeHari;

if($i==1)

{

	$sts=1;

}else{

	$sts=0;

}

$jam=date("H:i:s");



$id_guru=$this->mdl->idu();

$id_tahun=$this->m_reff->tahun();

$id_semester=$this->m_reff->semester();

?>



	                   

                        <div class="bodyd" style="padding:10px;margin-top:-30px">

						<!---------------------->
							<div class="table-responsive">
						  <span style="font-size:15px" class="col-black pull-right"><?php //echo //$this->m_reff->goField("tr_hari","nama","where id='".$i."'");?>

						  <?php echo $hariLengkap;?>

						  </span>
						  	
                              <table class="entry2" width="100%">

							  <tr  style='font-size:12px'>

							  <th>JAM KE </th><th>STATUS </th><th>MAPEL/KELAS</th>

							  </tr>

							  <?php

							  $urut=$val="";

							  $db=$this->db->query("select * from tr_jam_ajar where sts='".$sts."' order by jam_mulai asc ")->result();

							  foreach($db as $val)

							  {

								  

									  $cls="  col-black";

								  

								  	 $urut=$val->urut;

								  if(!$urut)

								  {

									   



								  }else{ 

											$base=$this->db->query("select * from v_jadwal where id_guru='".$id_guru."' 

											and id_tahun='".$id_tahun."' and id_semester='".$id_semester."' and id_hari='".$i."'

											and jam like '%,".$urut.",%' ")->row();

									  $mapel=isset($base->mapel)?($base->mapel):"";

									  $nama_kelas=isset($base->nama_kelas)?($base->nama_kelas):"";

									  if($mapel)

									  {

										  $absen=$this->mdl->statusAbsensi($urut,$kodeHari,$base->id,$tgl);

										   if(strpos($absen,"INVAL")!==false){

											   $mapelajar="";

										   }else{

											   $mapelajar=$mapel;

										   }

											   

									  echo "<tr class='".$cls." '>

									  <td>".$urut."</td>

									  <td>".$absen."</td>

									  <td><span class='col-teal'>".$mapelajar."</span><br>

									  ".$nama_kelas."</td>									 

									  </tr>";

									  }else{

										   echo "<tr class='  ".$cls." font-bold' >

										  <td>".$urut."</td>

										  <td colspan='3'>".$this->mdl->statusAbsensiInval($urut,$tgl,$kodeHari)."</td>						 

										  </tr>";

									  }

								  }

							  }

							  ?>

							  </table>
							</div>
                      

						<!---------------------->

						 

                           </div>

	 	 