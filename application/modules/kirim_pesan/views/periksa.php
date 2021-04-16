
<?php
$kelas=$this->input->post("kelas");
$idtugas=$this->input->post("id");
$dt=$this->m_reff->clearkomaray($kelas);
 $stssin=$this->m_reff->goField("data_tugas","kelas_sin","where id='".$idtugas."'");
foreach($dt as $dt)
{   
     $kelas=$this->m_reff->goField('v_kelas','nama','where id='.$dt.' ');
    
     $kelascek=",".$dt.",";
    if(strpos($stssin,$kelascek)===false){
   
    
    echo '<button class="btn bg-blue-grey btn-block col-white" onclick="periksa_perkelas(`'.$dt.'`,`'.$kelas.'`,`'.$idtugas.'`)">
    
    '.$kelas.' </button><br>';
   
   
}else{
    
      
    echo '<button class="btn bg-green btn-block col-white" onclick="periksa_perkelas(`'.$dt.'`,`'.$kelas.'`,`'.$idtugas.'`)">
    
    '.$kelas.' </button><br>';
    
    
    
   
}

  
}
?>

 