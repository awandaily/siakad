<?php
$id=$this->input->get_post("id");
$data=$this->db->query("select * from v_mitra_pkl where id_pembimbing='".$this->m_reff->idu()."' ")->row();
$isi="";

if($data->tgl_berangkat){
    if($data->sts_berangkat){
        $tgl=$this->tanggal->hariLengkap($data->sts_berangkat,"/");
        $pelaksanaan="<a class='col-deep-orange' href='javascript:showImg(`".base_url()."/file_upload/pkl/".$data->foto_berangkat."`,`Keberangkatan`,`$tgl`,`".$data->id."`,`otw`)'>✔".$tgl."</a>";
    }else{
        $pelaksanaan="<button onclick='setOtw(`".$data->id."`,`KEBERANGKATAN`,`otw`)' >Belum</button>";
    }
    $isi.="<tr>
    <td>Pemberangkatan</td>
    <td>".$this->tanggal->hariLengkap($data->tgl_berangkat,"/")."</td>
    <td>".$pelaksanaan."</td>
    </tr>";
}



if($data->monitoring1){
    if($data->sts_m1){
             $tgl=$this->tanggal->hariLengkap($data->sts_m1,"/");
             $pelaksanaan="<a class='col-deep-orange' href='javascript:showImg(`".base_url()."/file_upload/pkl/".$data->foto_m1."`,`Monitoring 1`,`$tgl`,`".$data->id."`,`m1`)'>✔".$tgl."</a>";
   
    }else{
        $pelaksanaan="<button onclick='setOtw(`".$data->id."`,`Monitoring 1`,`m1`)'>Belum</button>";
    }
    $isi.="<tr>
    <td>Monitoring1</td>
    <td>".$this->tanggal->hariLengkap($data->monitoring1,"/")."</td>
    <td>".$pelaksanaan."</td>
    </tr>";
}



if($data->monitoring2){
    if($data->sts_m2){
        $tgl=$this->tanggal->hariLengkap($data->sts_m2,"/");
             $pelaksanaan="<a class='col-deep-orange' href='javascript:showImg(`".base_url()."/file_upload/pkl/".$data->foto_m2."`,`Monitoring 2`,`$tgl`,`".$data->id."`,`m2`)'>✔".$tgl."</a>";
   
    }else{
        $pelaksanaan="<button  onclick='setOtw(`".$data->id."`,`Monitoring 2`,`m2`)'>Belum</button>";
    }
    $isi.="<tr>
    <td>Monitoring2</td>
    <td>".$this->tanggal->hariLengkap($data->monitoring2,"/")."</td>
    <td>".$pelaksanaan."</td>
    </tr>";
}



if($data->monitoring3){
    if($data->sts_m3){
         $tgl=$this->tanggal->hariLengkap($data->sts_m3,"/");
             $pelaksanaan="<a class='col-deep-orange' href='javascript:showImg(`".base_url()."/file_upload/pkl/".$data->foto_m3."`,`Monitoring 3`,`$tgl`,`".$data->id."`,`m3`)'>✔".$tgl."</a>";
   
    }else{
        $pelaksanaan="<button  onclick='setOtw(`".$data->id."`,`Monitoring 3`,`m3`)'>Belum</button>";
    }
    $isi.="<tr>
    <td>Monitoring3</td>
    <td>".$this->tanggal->hariLengkap($data->monitoring3,"/")."</td>
    <td>".$pelaksanaan."</td>
    </tr>";
}


if($data->monitoring4){
    if($data->sts_m4){
         $tgl=$this->tanggal->hariLengkap($data->sts_m4,"/");
             $pelaksanaan="<a class='col-deep-orange' href='javascript:showImg(`".base_url()."/file_upload/pkl/".$data->foto_m4."`,`Monitoring 4`,`$tgl`,`".$data->id."`,`m4`)'>✔".$tgl."</a>";
   
    }else{
        $pelaksanaan="<button  onclick='setOtw(`".$data->id."`,`Monitoring 4`,`m4`)'>Belum</button>";
    }
    $isi.="<tr>
    <td>Monitoring4</td>
    <td>".$this->tanggal->hariLengkap($data->monitoring4,"/")."</td>
    <td>".$pelaksanaan."</td>
    </tr>";
}


if($data->monitoring5){
    if($data->sts_m5){
        $tgl=$this->tanggal->hariLengkap($data->sts_m5,"/");
             $pelaksanaan="<a class='col-deep-orange' href='javascript:showImg(`".base_url()."/file_upload/pkl/".$data->foto_m5."`,`Monitoring 5`,`$tgl`,`".$data->id."`,`m5`)'>✔".$tgl."</a>";
   
    }else{
        $pelaksanaan="<button  onclick='setOtw(`".$data->id."`,`Monitoring 5`,`m5`)'>Belum</button>";
    }
    $isi.="<tr>
    <td>Monitoring5</td>
    <td>".$this->tanggal->hariLengkap($data->monitoring5,"/")."</td>
    <td>".$pelaksanaan."</td>
    </tr>";
}


if($data->monitoring6){
    if($data->sts_m6){
       $tgl=$this->tanggal->hariLengkap($data->sts_m6,"/");
             $pelaksanaan="<a class='col-deep-orange' href='javascript:showImg(`".base_url()."/file_upload/pkl/".$data->foto_m6."`,`Monitoring 6`,`$tgl`,`".$data->id."`,`m6`)'>✔".$tgl."</a>";
   
    }else{
        $pelaksanaan="<button  onclick='setOtw(`".$data->id."`,`Monitoring 6`,`m6`)'>Belum</button>";
    }
    $isi.="<tr>
    <td>Monitoring6</td>
    <td>".$this->tanggal->hariLengkap($data->monitoring6,"/")."</td>
    <td>".$pelaksanaan."</td>
    </tr>";
}


if($data->tgl_pulang){
    if($data->sts_pulang){
         $tgl=$this->tanggal->hariLengkap($data->sts_pulang,"/");
         $pelaksanaan="<a class='col-deep-orange' href='javascript:showImg(`".base_url()."/file_upload/pkl/".$data->foto_pulang."`,`Kepulangan`,`$tgl`,`".$data->id."`,`plg`)'>✔".$tgl."</a>";
   
    }else{
        $pelaksanaan="<button  onclick='setOtw(`".$data->id."`,`Kepulangan`,`plg`)'>Belum</button>";
    }
    $isi.="<tr>
    <td>Kepulangan</td>
    <td>".$this->tanggal->hariLengkap($data->tgl_pulang,"/")."</td>
    <td>".$pelaksanaan."</td>
    </tr>";
}



?>


<table class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'> 
									<th class='thead'  width='15px'>JADWAL</th>
								    <th class='thead'  width='15px'> DITETAPKAN </th>
								     <th class='thead'  width='15px'> PELAKSANAAN </th>
								</thead>
								<?php echo $isi;?>
							</table>