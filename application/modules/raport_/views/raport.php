
<?php 
$idsiswa=$this->input->get("id");
 
$data=$this->db->query("select * from v_siswa where id='".$idsiswa."'")->row();
$agama=$data->id_agama;
$sms=$this->input->get("id_semester");
$tahun=$this->input->get("id_tahun");
$id_kelas=$this->input->get("id_kelas");
 $this->session->set_userdata("sms_id",$sms);
 $this->session->set_userdata("tahun_id",$tahun);
$semes=$this->db->query("select * from tr_semester where id='".$sms."'")->row();
$tingkat=$this->input->get("id_tk");
					
					 if($agama>1)
					 {
						 $filterasi=" AND mapel_global='1' ";
					 }else{
						  $filterasi="";
					 }
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' 
					 and k_mapel='A' and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					".$filterasi." group by id_mapel,id_guru")->result();
					 $no=1;
					 $nilaiSeluruh=0;$jumlahMapel=0;
					 $nilaiSeluruhKeterampilan=0;
					  $nilaiSeluruhSikap=0; 
					 foreach($getMapel as $gm)
					 {	
					   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);  
                       $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru); 
					   $jumlahMapel++; 
					    $nilaiSeluruh=$NRP+$nilaiSeluruh;
					    $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					 
					  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					
					}  
					
					 
					 $getMapelAgama=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' 
					 and k_mapel='A' and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 AND mapel_global='2'   group by id_mapel,id_guru")->num_rows();
					
					if($agama>1 && $getMapelAgama>0)
					{ 
				      $NRP=$this->mdl->getNpNonMuslim($idsiswa); 
                      $NRK=$this->mdl->getNkNonMuslim($idsiswa); 
                      $jumlahMapel++; 
						$nilaiSeluruh=$NRP+$nilaiSeluruh;
						$nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					 
						$nilaiSikap=$this->mdl->getNsNonMuslim($idsiswa);
						$nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					  
					}
					 
					
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='B'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='B'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' group by id_mapel,id_guru")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  
					 
					 
					 
					 
                    
                    
					 
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C1'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C1'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' group by id_mapel,id_guru")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  
					 
					 
					 
					 
					
					
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C2'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C2'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."' 
					 group by id_mapel,id_guru")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  
					 
					 
					 
					
					
					
					
					
					 
					 
					 
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C3'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0;
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' and k_mapel='C3'
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND  id_mapel_induk='".$gm->id_mapel."'")->result();
						  foreach($getSubMapel as $gesub)
						  {

							  $j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP; 
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK; 
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp; 
						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);   
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
					   $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					   $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap; 
					 }  
 
					 if($j>0)
						  { 
							   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							   $t_NRP=($N_RP+$NRP)/($j+1);
							 
							   $fix=$t_NRP; 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  } 
					   $jumlahMapel++;
					   $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  
					 
					 
					 
					 
					 
					 
					 if($agama>1)
					 {
						 $filterasi=" AND mapel_global='1' ";
					 }else{
						  $filterasi="";
					 }
					 
					 $getMapel=$this->db->query("select * from v_jadwal where 
					 id_kelas='".$id_kelas."' and k_mapel='Muatan Lokal' ".$filterasi."
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL)
					 group by id_mapel,id_guru")->result();
					 $no=1;
					 foreach($getMapel as $gm)
					 {
							$NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);  
                            $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);  
                
							$jumlahMapel++;
							$nilaiSeluruh=$NRP+$nilaiSeluruh;
							$nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
						   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
						  $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } 
					
                
//$NR=$this->mdl->getNilaiAkhir($idsiswa,$sms); //nilai rata-rata
//$eskul=$this->mdl->getNilaiEskul($idsiswa,$sms);
//$NilaiMinKehadiran=$this->mdl->NilaiMinKehadiran($idsiswa,$sms); 
$getNilaiRataSikap=$nilaiSeluruhSikap; 
$nilaiKeterampilan=$nilaiSeluruhKeterampilan;
$nilaiPengetahuan=$nilaiSeluruh; 
$total=($getNilaiRataSikap+$nilaiKeterampilan+$nilaiPengetahuan)/3; 
//$NR=(($nilaiSeluruhKeterampilan/$jumlahMapel)+$eskul)-$NilaiMinKehadiran; 
$NR=$total/$jumlahMapel;
//$NR=($NR+$eskul)-$NilaiMinKehadiran;
$NR=number_format($NR,2);
if($NR>=86){
$predikat="A";	 $desc_sikap="Siswa sangat aktif dan baik selama mengikuti pembelajaran";
}elseif($NR>=71){
$predikat="B";	$desc_sikap="Siswa aktif dan baik selama mengikuti pembelajaran";
}
elseif($NR>=56){
$predikat="C";	$desc_sikap="Siswa cukup aktif selama mengikuti pembelajaran";
}else{
$predikat="D"; $desc_sikap="Siswa kurang aktif";
}
?>		

 




<style type="text/css">
 
table tr td
{
    padding: 0;
    font-size: 12pt;
    background: #FFFFFF;
	font-family:arial;
  
}
.batasAwal{
margin-left:15px;
}
.b{
font-weight:bold;
}
.desc{
	border:solid 1px #AADDAA;
	width:90%;
}
 
                .tborder{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width: 300mm;font-size:11px;}
                .tborder2{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width:200mm}
               .tborder td,.tborder  th{word-wrap:break-word;word-break: break-all;border: 1px solid #000;padding:2px;font-size:10px;text-align:center}
			   
			   
                .thadir{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width: 100mm;font-size:11px;}
               .thadir td,.thadir  th{word-wrap:break-word;word-break: break-all; padding:2px;font-size:10px;text-align:center}
			   .cover{
			   height:30cm;
			   }
			   .label{
			   font-size:21px;font-weight:bold;
			   border:black solid 1px;
			   padding:10px;
			   }
           </style>
<page orientation="portrait" format="210x330">   
  
<div align="center" class="tborder2">
<b><h3>LAPORAN<br>HASIL PENCAPAIAN KOMPETENSI PESERTA DIDIK<br>
SEKOLAH MENENGAH KEJURUAN<br>(SMK)
</h3></b> 
<br>
 
</div>		





<table style="table-layout:fixed;width: 100%;margin-top:720px"  >
<tr>
<td style="table-layout:fixed;width: 100%;" align="center">
<span>Nama Peserta Didik : </span><br>

 
</td>
</tr>
 
</table>
 <table style="width: 80%;border: solid 1px black" align="center">
        <tr>
            <td style="width: 80%; text-align: center;font-weight:bold;padding:5px"><?php echo strtoupper($data->nama);?></td>
           
        </tr>
    </table>

<table style="table-layout:fixed;width: 100%;"  >
<tr>
<td style="table-layout:fixed;width: 100%;" align="center">
<span> NISN :  </span><br>

 
</td>
</tr>
 
</table>
 <table style="width: 80%;border: solid 1px black" align="center">
       <tr>
            <td style="width: 80%; text-align: center;font-weight:bold;padding:5px"><?php echo strtoupper($data->nisn);?></td>
           
        </tr>
    </table>
<table style="table-layout:fixed;width: 100%;"  >
<tr>
<td style="table-layout:fixed;width: 100%;" align="center">
<span> Nomor Induk :   </span><br>

 
</td>
</tr>
 
</table>
 <table style="width: 80%;border: solid 1px black" align="center">
       <tr>
            <td style="width: 80%; text-align: center;font-weight:bold;padding:5px"><?php echo strtoupper($data->nis);?></td>
           
        </tr>
    </table>
	<br>
	 
	 
 <div align="center" class="tborder2" >
<b><h3>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN<br>
REPUBLIK INDONESIA
</h3></b> 
<br>
 
</div>	
 
 </page>
 
 <page orientation="portrait" format="210x330">   
  
<div align="center" class="tborder2">
<b><h3>KETERANGAN TENTANG PESERTA DIDIK</h3></b> 
<br>
 
</div>		

 <table style="width: 90%;" align="center">
       <tr>
	   <td style="table-layout:fixed;width: 20px;">1<?php   $no=2;?>.</td>
	   <td style="table-layout:fixed;width: 260px;">Nama Peserta Didik</td>
	   <td> : &nbsp;</td>
	   <td><?php echo strtoupper($data->nama);?></td>
       </tr> 
	   <tr>
	   <td  ><?php echo $no++;?>.</td>
	   <td  >Nomor Induk Siswa Nasional</td>
	   <td> : &nbsp;</td>
	   <td><?php echo strtoupper($data->nisn);?></td>
       </tr> 
	   
	   <tr>
	   <td  ><?php echo $no++;?>.</td>
	   <td  >Tempat dan Tanggal Lahir</td>
	   <td> : &nbsp;</td>
	   <td><?php echo strtoupper($data->tempat_lahir);?>,<?php echo  $this->tanggal->ind($data->tgl_lahir,"-");?> </td>
       </tr>

	 
	    <tr>
	   <td  ><?php echo $no++;?>.</td>
	   <td  >Jenis Kelamin</td>
	   <td> : &nbsp;</td>
	   <td><?php echo strtoupper($data->jk);?>  </td>
       </tr>
	    <tr>
	   <td  ><?php echo $no++;?>.</td>
	   <td  >Agama</td>
	   <td> : &nbsp;</td>
	   <td><?php echo strtoupper($data->agama);?>  </td>
       </tr>  
	   <tr>
	   <td  ><?php echo $no++;?>.</td>
	   <td  >Status Dalam Keluarga</td>
	   <td> : &nbsp;</td>
	   <td><?php    if($data->hub_keluarga==1){ echo "Anak Kandung"; }else{ echo "Anak Tiri";};?>  </td>
       </tr>  <tr>
	   <td  ><?php echo $no++;?>.</td>
	   <td  >Anak Ke</td>
	   <td> : &nbsp;</td>
	   <td>   <?php   $data->anak_ke;
	   if($data->anak_ke){
	       echo "Ke- ".$data->anak_ke;
	   }else{
	       echo "-";
	   }
	   ?>  </td>
       </tr> <tr>
	   <td  ><?php echo $no++;?>.</td>
	   <td  >Alamat Peserta Didik</td>
	   <td> : &nbsp;</td>
	   <td  style="table-layout:fixed;width: 260px;"><?php   $data->alamat;?>  </td>
       </tr>
	   
	    <tr>
	   <td colspan="4"> <br><br><br> </td>
	   
       </tr>  
	   
	   <tr>
	   <td  ><?php echo $no++;?>.</td>
	   <td  >Nomor Telpon Rumah </td>
	   <td> : &nbsp;</td>
	   <td><?php echo strtoupper($data->hp);?>  </td>
       </tr>   
	   
	   <tr>
	   <td  > </td>
	   <td  >Alamat Email</td>
	   <td> : &nbsp;</td>
	   <td><?php echo $data->email;?>  </td>
       </tr>  
	   <tr>
	   <td  ><?php echo $no++;?>.</td>
	   <td  >Diterima di Sekolah ini </td>
	   <td> : &nbsp;</td>
	   <td>  </td>
       </tr>    
	   <tr>
	   <td  > </td>
	   <td  >Di Kelas </td>
	   <td> : &nbsp;</td>
	   <td> <?php // echo strtoupper($data->tingkat)." (".$this->m_reff->goField("tr_tingkat","alias","where id='". $data->id_tk."'").") ".$data->id_tk;?>   </td>
       </tr>    
	   
	   <tr>
	   <td  > </td>
	   <td  >Pada Tanggal </td>
	   <td> : &nbsp;</td>
	   <td> <?php // echo $this->tanggal->indBulan($data->tgl_diterima," ");?> </td>
       </tr>    <tr>
	   <td  > </td>
	   <td  >Semester </td>
	   <td> : &nbsp;</td>
	   <td> <?php //echo sprintf("%02s", $data->id_sms_diterima)." (".$this->m_reff->goField("tr_semester","baca","where id='".$data->id_sms_diterima."'").")";?> </td>
       </tr>  
	   
	   <tr>
	   <td  ><?php echo $no++;?></td>
	   <td  >Sekolah Asal </td>
	   <td>   &nbsp;</td>
	   <td>   </td>
       </tr>    <tr>
	   <td  > </td>
	   <td  >Nama Sekolah </td>
	   <td> : &nbsp;</td>
	   <td>  <?php echo $data->asal_smp;?> </td>
       </tr>   <tr>
	   <td  > </td>
	   <td  >Alamat Sekolah </td>
	   <td> : &nbsp;</td>
	   <td>  <?php echo $data->alamat_smp;?> </td>
       </tr>  
	   
	     <tr>
	   <td colspan="4"> <br><br><br> </td>
	     </tr>  
		 
	    <tr>
	   <td  > <?php echo $no++;?></td>
	   <td  >Ijazah SMP/MTs/Paket B</td>
	   <td>  </td>
	   <td>   </td>
       </tr>  
	   
	   <tr>
	   <td  >  </td>
	   <td  >Tahun</td>
	   <td> : &nbsp;</td>
	   <td>  <?php echo $data->tahun_lulus_smp;?> </td>
       </tr>  
	   
       <tr>
	   <td  >  </td>
	   <td  >Nomor</td>
	   <td> : &nbsp;</td>
	   <td>  <?php echo $data->no_ijazah_smp;?> </td>
       </tr>  
     
	   
	    <tr>
	   <td  > <?php echo $no++;?></td>
	   <td  >Nama Orang Tua</td>
	   <td>  </td>
	   <td>   </td>
       </tr>  
	   
	   <tr>
	   <td  >  </td>
	   <td  >Ayah</td>
	   <td> : &nbsp;</td>
	   <td>  <?php echo strtoupper($data->nama_ayah);?> </td>
       </tr>  
	   
       <tr>
	   <td  >  </td>
	   <td  >Ibu</td>
	   <td> : &nbsp;</td>
	   <td>  <?php echo strtoupper($data->nama_ibu);?> </td>
       </tr>  
	   <tr>
	   <td  valign="top" > <?php echo $no++;?> </td>
	   <td   valign="top" >Alamat Orang Tua</td>
	   <td  valign="top"> : &nbsp;</td>
	   <td  valign="top" style="table-layout:fixed;width: 260px;">  <?php echo strtoupper($data->alamat_ortu);?> </td>
       </tr>  
      
     
	   
	     <tr>
	   <td colspan="4"> <br><br><br> </td>
	     </tr>  
		 
	    <tr>
	   <td  >  </td>
	   <td  >Nomor Telpon Rumah</td>
	   <td>  </td>
	   <td>   </td>
       </tr>  
	   
	   <tr>
	   <td  > </td>
	   <td  >Alamat Email</td>
	   <td> : &nbsp;</td>
	   <td>   </td>
       </tr> 
   
	   <tr>
	   <td  > <?php echo $no++;?></td>
	   <td  >Pekerjaaan Orang Tua</td>
	   <td> : &nbsp;</td>
	   <td>   </td>
       </tr> 
		<tr>
	   <td  >  </td>
	   <td  >Ayah</td>
	   <td> : &nbsp;</td>
	   <td>  <?php echo $this->m_reff->goField("tr_pekerjaan","nama","where id='".$data->id_pekerjaan_ayah."' ");?> </td>
       </tr>  
	   
       <tr>
	   <td  >  </td>
	   <td  >Ibu</td>
	   <td> : &nbsp;</td>
	   <td>   <?php echo $this->m_reff->goField("tr_pekerjaan","nama","where id='".$data->id_pekerjaan_ibu."' ");?>  </td>
       </tr>  


		 <tr>
	   <td  > <?php echo $no++;?></td>
	   <td  >Nama Wali Peserta Didik </td>
	   <td> : &nbsp;</td>
	   <td>  <?php echo strtoupper($data->nama_wali);?> </td>
       </tr>
	   
	   <tr>
	   <td  > <?php echo $no++;?></td>
	   <td  >Alamat Wali Peserta Didik </td>
	   <td> : &nbsp;</td>
	   <td>  <?php echo strtoupper($data->alamat_wali);?> </td>
       </tr>
	   
	   
	     <tr>
	   <td colspan="4"> <br><br>  </td>
	     </tr>  
		 
	    <tr>
	   <td  >  </td>
	   <td  >Nomor Telpon Rumah</td>
	   <td>  </td>
	   <td>   </td>
       </tr>  
	   
	   <tr>
	   <td  > </td>
	   <td  >Alamat Email</td>
	   <td> : &nbsp;</td>
	   <td>   </td>
       </tr> 
	   
	      <tr>
	   <td  > <?php echo $no++;?></td>
	   <td  >Pekerjaan Wali Peserta Didik</td>
	   <td> : &nbsp;</td>
	   <td>    </td>
       </tr>
	     <tr>
	   <td colspan="4"> <br><br><br> </td>
	     </tr>  
		   <tr>
	   <td colspan="2" valign="top"> 
		<div style="border:black solid 1px;width:33mm;height:35mm;font-size:11px;text-align:center" align='center' id="poto"> 
		<img src="<?php echo $this->m_reff->poto_siswa($idsiswa);?>" 
		style="border:black solid 1px;width:33mm;height:35mm;font-size:11px;text-align:center"> 
		</div>
	   </td>
	   <td colspan="2" valign="top" style="font-size:11px;font-weight:bold">  <b>Subang,    <?php echo $this->mdl->titiMangsaRapot($sms);?> <br> 
	   Kepala Sekolah,<br>
	   <img src="<?php echo base_url();?>file_upload/dok/<?php echo $this->mdl->ttd_kepsek($tahun)?>" 
		style="border:black dashed 1px;width:53mm;height:15mm;font-size:11px;text-align:center;margin-left:-30px"> 
	   
	   <br><?php echo $this->mdl->nama_kepsek($tahun)?> </b></td>
	     </tr>  
		 
    </table>

 
  
 
 </page>
 
 
 
<page orientation="landscape" format="210x310" style='font-size:11px'>









<br>




 <table   style="table-layout:fixed;width: 85%;"  border="0">
 <tr>
 <td align="left" style="table-layout:fixed;width: 50%;">
		 
		 <table class="batasAwal" style="font-weight:bold;font-size:13px"  >
		 <tr> <td>Nama Sekolah</td><td>:</td><td><?php echo $this->m_reff->goField("tm_pengaturan","val","where id='7'");?></td> </tr>
		 <tr> <td>Alamat</td><td>:</td><td><?php echo $this->m_reff->goField("tm_pengaturan","val","where id='13'");?></td> </tr>
		 <tr> <td>Nama Peserta Didik	</td><td>:</td><td><?php echo $data->nama;?></td> </tr>
		 <tr> <td>Nomor Induk Siswa Nasional(NISN) 	</td><td>:</td><td><?php echo $data->nisn;?></td> </tr>
		 </table>
	 
</td>
<td  align="left" style="table-layout:fixed;width: 50%;" >

		 
		 <table align="right" style=" font-weight:bold">
		 <tr> <td>Kelas</td><td>:</td><td> <?php echo $this->m_reff->goField("tr_tingkat","nama","where id='".$tingkat."'");?> ( <?php echo $this->m_reff->goField("tr_tingkat","alias","where id='".$tingkat."'");?> ) </td> </tr>
		 <tr> <td>Semester</td><td>:</td><td><?php echo $semes->romawi." ( ".$semes->baca." )";?></td> </tr>
		 <tr> <td>Tahun Pelajaran	</td><td>:</td><td> <?php echo  $this->m_reff->tahun_ajaran();?></td> </tr>
		 </table>
	 
</td>
</tr>
</table>
 <br>
 <p class="batasAwal"><b>CAPAIAN HASIL BELAJAR : </b></p>
  <b>A. SIKAP</b> 
 
  
  
  <!------------------------------------------------------>
  
  
  	 
			  
			  
  

  
  
  <!------------------------------------------------------>
   <p>
    
 <div  style="border: solid 1px black;width: 296mm">&nbsp; Deskripsi:<br><p align="center">  
<?php echo $desc_sikap; ?>
 </p><br></div>
 </p>
  <b>B. PENGETAHUAN DAN KETERAMPILAN</b> 
  
  
   
 
   
  <table class="tborder"     cellspacing="0"  >
                    <tbody> 
					 <tr>
					  <th rowspan="2" align="center"  >NO</th>
					  <th rowspan="2"  >NAMA PELAJARAN</th>
					  <th colspan="4"  >PENGETAHUAN</th>
					  <th colspan="4">KETERAMPILAN</th>
					  </tr>
					  <tr>
					  <th>KKM</th>
					  <th >ANGKA</th>
					  <th >PREDIKAT</th>
					  <th>DESKRIPSI</th>
					  
					  <th >KKM</th>
					  <th >ANGKA</th>
					  <th >PREDIKAT</th>
					  <th  >DESKRIPSI</th>
					  </tr>
					  <!-----==========================------>
					 <tr>
					 <td colspan="10" align="left"><b> KELOMPOK A (Wajib)</b></td>
					 </tr>
					 <?php
					 $dataMapelID="";
					 if($agama>1)
					 {
						 $filterasi=" AND mapel_global='1' ";
					 }else{
						  $filterasi="";
					 }
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' 
					 and k_mapel='A' and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					".$filterasi." group by id_mapel,id_guru")->result();
					 $no=1;
					 $nilaiSeluruh=0;$jumlahMapel=0;
					 $nilaiSeluruhKeterampilan=0;
					  $nilaiSeluruhSikap=0; 
					 foreach($getMapel as $gm)
					 {	
					 
					 
					 
					 $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					  $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					 
					if(strpos($dataMapelID,"'".$gm->id_mapel."'")===false)
					{
						$nilaiRataPDuplicat=$this->mdl->getNilaiRataPengetahuanDuplicate($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);						
					$nilaiRataKDuplicat=$this->mdl->getNilaiRataKeterampilanDuplicate($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);						
					
					if($nilaiRataPDuplicat>0)
					{
						$fix=($nilaiRataPDuplicat+$fix)/2;
					}
					if($nilaiRataKDuplicat>0)
					{
						$fixNRK=($nilaiRataKDuplicat+$fixNRK)/2;
					}
					 ?>
                    <tr>
                        <td ><?php echo $no++;?></td>
                        <td align="left" style="table-layout:fixed;width: 233px;"> <?php echo $gm->mapel;?></td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKb($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td ><?php echo number_format($fix,2);?></td>
                        <td ><?php echo $predikat_nrp=$this->mdl->predikat($NRP);?></td>
                        <td   style="table-layout:fixed;width: 270px;text-align:justify" valign="middle" align="left">
						<p style="text-align:justify;padding:5px;margin-top:-6px"><?php  echo $this->mdl->desc_nrp($predikat_nrp);?></p> </td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKbk($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td > <?php echo number_format($fixNRK,2);?></td>
                        <td ><?php echo $predikat_nrk=$this->mdl->predikat($NRK);?></td>
                        <td   style="table-layout:fixed;width: 270px;" valign="middle" align="justify">
						<p style='padding:5px;margin-top:-5px'> <?php  echo $this->mdl->desc_nrk($predikat_nrk);?> </p>
						</td>
                      
                    </tr>
					 <?php 
					}
					  $jumlahMapel++;
					    $dataMapelID.="'".$gm->id_mapel."',";
					   
					 $nilaiSeluruh=$NRP+$nilaiSeluruh;
					 $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					 
				 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					
					} ?>
					<!-----==========================------>
					<?php
					 
					if($agama>1 && $getMapelAgama>0)
					{?>
				 <tr>
                        <td ><?php echo $no++;?></td>
                        <td align="left" style="table-layout:fixed;width: 233px;"> PENDIDIKAN AGAMA DAN BUDI PEKERTI</td>
                        <td style="table-layout:fixed;width: 35px;">
						<?php echo $this->mdl->getKKMNonMuslim($idsiswa);?></td>
                        <td ><?php echo $NRP=$this->mdl->getNpNonMuslim($idsiswa);?></td>
                        <td ><?php echo $predikat_nrp=$this->mdl->predikat($NRP);?></td>
                        <td   style="table-layout:fixed;width: 270px;text-align:justify" valign="middle" align="left">
						<p style="text-align:justify;padding:5px;margin-top:-6px"><?php  echo $this->mdl->desc_nrpNonmuslim($predikat_nrp);?></p> </td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->getKKMNonMuslim($idsiswa);?></td>
                        <td > <?php echo $NRK=$this->mdl->getNkNonMuslim($idsiswa);?></td>
                        <td ><?php echo $predikat_nrk=$this->mdl->predikat($NRK);?></td>
                        <td   style="table-layout:fixed;width: 270px;" valign="middle" align="justify">
						<p style='padding:5px;margin-top:-5px'> <?php  echo $this->mdl->desc_nrkNonmuslim($predikat_nrk);?> </p>
						</td>
				</tr>		
                      <?php 
						 $jumlahMapel++;
					    $dataMapelID.="'".$gm->id_mapel."',";
					   
					 $nilaiSeluruh=$NRP+$nilaiSeluruh;
					 $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					 
					$nilaiSikap=$this->mdl->getNsNonMuslim($idsiswa);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
						
					}
					
					
					?>
					
					<!-----==========================------>
					
					 <tr>
					 <td colspan="10" align="left"><b> KELOMPOK B (Wajib)</b></td>
					 </tr>
                   <?php
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='B' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0; 
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='B' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND id_mapel_induk='".$gm->id_mapel."' group by id_mapel,id_guru")->result();
						  foreach($getSubMapel as $gesub)
						  {

							$j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP;
							  
							  
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK;
							  
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp;



						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
                        
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru); 
                        
 
  
					  $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  


					 if($j>0)
						  {
							  
							 
							  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $t_NRP=($N_RP+$NRP)/($j+1);
							
							 $fix=$t_NRP;

							 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
							  
							  
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
						  }
					 
						if(strpos($dataMapelID,"'".$gm->id_mapel."'")===false)
					{
					 	$nilaiRataPDuplicat=$this->mdl->getNilaiRataPengetahuanDuplicate($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);						
					$nilaiRataKDuplicat=$this->mdl->getNilaiRataKeterampilanDuplicate($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);						
					
					if($nilaiRataPDuplicat>0)
					{
						$fix=($nilaiRataPDuplicat+$fix)/2;
					}
					if($nilaiRataKDuplicat>0)
					{
						$fixNRK=($nilaiRataKDuplicat+$fixNRK)/2;
					}			 
					 ?>
                    <tr>
                        <td ><?php echo $no++;?></td>
                        <td align="left" style="table-layout:fixed;width: 233px;"> <?php echo $gm->mapel;?></td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKb($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td ><?php echo number_format($fix,2);?></td>
                        <td ><?php echo $predikat_nrp=$this->mdl->predikat($fix);?></td>
                          <td   style="table-layout:fixed;width: 270px;text-align:justify" valign="middle" align="left">
						  <p style="text-align:justify;padding:5px;margin-top:-6px"><?php  echo $this->mdl->desc_nrp($predikat_nrp);?></p> </td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKbk($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td >  <?php echo number_format($fixNRK,2);?></td>
                        <td ><?php echo $predikat_nrk=$this->mdl->predikat($fixNRK);?></td>
                        <td   style="table-layout:fixed;width: 260px;" valign="middle" align="justify">
						<p style='padding:5px;margin-top:-5px'> <?php  echo $this->mdl->desc_nrk($predikat_nrk);?> </p>
						</td>
                      
                    </tr>
					 <?php 
					}
					  $dataMapelID.="'".$gm->id_mapel."',";
					  $jumlahMapel++;
					  $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } ?>
                      
                    
					<!-----==========================------>
					 <tr>
					 <td colspan="10" align="left"><b> C1. DASAR BIDANG KEAHLIAN</b></td>
					 </tr>
                     <?php
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C1' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0; 
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C1' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND id_mapel_induk='".$gm->id_mapel."' group by id_mapel,id_guru")->result();
						  foreach($getSubMapel as $gesub)
						  {

							$j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP;
							  
							  
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK;
							  
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp;



						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
                        
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru); 
                        
 
  
					  $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  


					 if($j>0)
						  {
							  
							 
							  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $t_NRP=($N_RP+$NRP)/($j+1);
							
							 $fix=$t_NRP;

							 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
							  
							  
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
						  }
					 
						if(strpos($dataMapelID,"'".$gm->id_mapel."'")===false)
					{
					 			$nilaiRataPDuplicat=$this->mdl->getNilaiRataPengetahuanDuplicate($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);						
					$nilaiRataKDuplicat=$this->mdl->getNilaiRataKeterampilanDuplicate($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);						
					
					if($nilaiRataPDuplicat>0)
					{
						$fix=($nilaiRataPDuplicat+$fix)/2;
					}
					if($nilaiRataKDuplicat>0)
					{
						$fixNRK=($nilaiRataKDuplicat+$fixNRK)/2;
					}	 
					 ?>
                    <tr>
                        <td ><?php echo $no++;?></td>
                        <td align="left" style="table-layout:fixed;width: 233px;"> <?php echo $gm->mapel;?></td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKb($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td ><?php echo number_format($fix,2);?></td>
                        <td ><?php echo $predikat_nrp=$this->mdl->predikat($fix);?></td>
                          <td   style="table-layout:fixed;width: 270px;text-align:justify" valign="middle" align="left">
						  <p style="text-align:justify;padding:5px;margin-top:-6px"><?php  echo $this->mdl->desc_nrp($predikat_nrp);?></p> </td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKbk($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td >  <?php echo number_format($fixNRK,2);?></td>
                        <td ><?php echo $predikat_nrk=$this->mdl->predikat($fixNRK);?></td>
                        <td   style="table-layout:fixed;width: 260px;" valign="middle" align="justify">
						<p style='padding:5px;margin-top:-5px'> <?php  echo $this->mdl->desc_nrk($predikat_nrk);?> </p>
						</td>
                      
                    </tr>
					 <?php 
					}
					  $dataMapelID.="'".$gm->id_mapel."',";
					  $jumlahMapel++;
					  $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } ?>
                      
					
					<!-----==========================------>
					 <tr>
					 <td colspan="10" align="left"><b> C2. DASAR KOMPETENSI KEAHLIAN</b></td>
					 </tr>
                   <?php
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C2' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0; 
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C2' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND id_mapel_induk='".$gm->id_mapel."' group by id_mapel,id_guru")->result();
						  foreach($getSubMapel as $gesub)
						  {

							$j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP;
							  
							  
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK;
							  
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp;



						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
                        
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru); 
                        
 
  
					  $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  


					 if($j>0)
						  {
							  
							 
							  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $t_NRP=($N_RP+$NRP)/($j+1);
							
							 $fix=$t_NRP;

							 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
							  
							  
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
						  }
					 
						if(strpos($dataMapelID,"'".$gm->id_mapel."'")===false)
					{
					 				$nilaiRataPDuplicat=$this->mdl->getNilaiRataPengetahuanDuplicate($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);						
					$nilaiRataKDuplicat=$this->mdl->getNilaiRataKeterampilanDuplicate($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);						
					
					if($nilaiRataPDuplicat>0)
					{
						$fix=($nilaiRataPDuplicat+$fix)/2;
					}
					if($nilaiRataKDuplicat>0)
					{
						$fixNRK=($nilaiRataKDuplicat+$fixNRK)/2;
					} 
					 ?>
                    <tr>
                        <td ><?php echo $no++;?></td>
                        <td align="left" style="table-layout:fixed;width: 233px;"> <?php echo $gm->mapel;?></td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKb($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td ><?php echo number_format($fix,2);?></td>
                        <td ><?php echo $predikat_nrp=$this->mdl->predikat($fix);?></td>
                          <td   style="table-layout:fixed;width: 270px;text-align:justify" valign="middle" align="left">
						  <p style="text-align:justify;padding:5px;margin-top:-6px"><?php  echo $this->mdl->desc_nrp($predikat_nrp);?></p> </td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKbk($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td >  <?php echo number_format($fixNRK,2);?></td>
                        <td ><?php echo $predikat_nrk=$this->mdl->predikat($fixNRK);?></td>
                        <td   style="table-layout:fixed;width: 260px;" valign="middle" align="justify">
						<p style='padding:5px;margin-top:-5px'> <?php  echo $this->mdl->desc_nrk($predikat_nrk);?> </p>
						</td>
                      
                    </tr>
					 <?php 
					}
					  $dataMapelID.="'".$gm->id_mapel."',";
					  $jumlahMapel++;
					  $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } ?>
                      
					 
					  
					<!-----==========================------><!-----==========================------>
					 <tr>
					 <td colspan="10" align="left"><b> C3. PAKET KEAHLIAN</b></td>
					 </tr>
                    <?php
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C3' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel,id_guru")->result();
					 $no=1;$t_NRP=0; 
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C3' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND id_mapel_induk='".$gm->id_mapel."' group by id_mapel,id_guru")->result();
						  foreach($getSubMapel as $gesub)
						  {

							$j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP;
							  
							  
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK;
							  
							  $N_sikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp;



						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
                        
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru); 
                        
 
  
					  $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  


					 if($j>0)
						  {
							  
							 
							  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $t_NRP=($N_RP+$NRP)/($j+1);
							
							 $fix=$t_NRP;

							 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
							  
							  
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
						  }
					 
					 
					if(strpos($dataMapelID,"'".$gm->id_mapel."'")===false)
					{
					$nilaiRataPDuplicat=$this->mdl->getNilaiRataPengetahuanDuplicate($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);						
					$nilaiRataKDuplicat=$this->mdl->getNilaiRataKeterampilanDuplicate($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);						
					
					if($nilaiRataPDuplicat>0)
					{
						$fix=($nilaiRataPDuplicat+$fix)/2;
					}
					if($nilaiRataKDuplicat>0)
					{
						$fixNRK=($nilaiRataKDuplicat+$fixNRK)/2;
					}
					
					?>
					 
                    <tr>
                        <td ><?php echo $no++;?></td>
                        <td align="left" style="table-layout:fixed;width: 233px;"> <?php echo $gm->mapel;?></td>
                        <td style="table-layout:fixed;width: 35px;">
						<?php echo $this->mdl->rataKb($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td ><?php echo number_format($fix,2);?></td>
                        <td ><?php echo $predikat_nrp=$this->mdl->predikat($fix);?></td>
                          <td   style="table-layout:fixed;width: 270px;text-align:justify" valign="middle" align="left">
						  <p style="text-align:justify;padding:5px;margin-top:-6px"><?php  echo $this->mdl->desc_nrp($predikat_nrp);?></p> </td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKbk($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td >  <?php echo number_format($fixNRK,2);?></td>
                        <td ><?php echo $predikat_nrk=$this->mdl->predikat($fixNRK);?></td>
                        <td   style="table-layout:fixed;width: 260px;" valign="middle" align="justify">
						<p style='padding:5px;margin-top:-5px'> <?php  echo $this->mdl->desc_nrk($predikat_nrk);?> </p>
						</td>
                      
                    </tr>
					 <?php 
					}
					  $dataMapelID.="'".$gm->id_mapel."',";			 
					  $jumlahMapel++;
					  $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } ?>
                     
					 
					 
					 
					 
					 
					 
					 
					 
					 <tr>
					 <td colspan="10" align="left"><b> MUATAN LOKAL  </b></td>
					 </tr>
                    <?php
					 if($agama>1)
					 {
						 $filterasi=" AND mapel_global='1' ";
					 }else{
						  $filterasi="";
					 }
					 
					 $getMapel=$this->db->query("select * from v_jadwal where 
					 id_kelas='".$id_kelas."' and k_mapel='Muatan Lokal' ".$filterasi."
					 and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL)
					  group by id_mapel,id_guru")->result();
					 $no=1;
					 
					 foreach($getMapel as $gm)
					 {     $mapelval="'$gm->id_mapel'";
						 if(strpos($dataMapelID,$mapelval)===false)
					{
						
					 ?>
                    <tr>
                        <td ><?php echo $no++;?></td>
                        <td align="left" style="table-layout:fixed;width: 233px;"> <?php echo $gm->mapel;?></td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKb($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td  ><?php echo $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);?></td>
                        <td ><?php echo $predikat_nrp=$this->mdl->predikat($NRP);?></td>
                          <td   style="table-layout:fixed;width: 270px;text-align:justify" valign="middle" align="left">
						  <p style="text-align:justify;padding:5px;margin-top:-6px"><?php  echo $this->mdl->desc_nrp($predikat_nrp);?></p> </td>
                        <td style="table-layout:fixed;width: 35px;"><?php echo $this->mdl->rataKbk($gm->id_mapel,$id_kelas,$gm->id_guru,$gm->id_tahun,$sms);?></td>
                        <td > <?php echo $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);?></td>
                        <td ><?php echo $predikat_nrk=$this->mdl->predikat($NRK);?></td>
                        <td   style="table-layout:fixed;width: 270px;" valign="middle" align="justify">
						<p style='padding:5px;margin-top:-5px'> <?php  echo $this->mdl->desc_nrk($predikat_nrk);?> </p>
						</td>
                      
                    </tr>
					 <?php 
					}
					  $dataMapelID.="'".$gm->id_mapel."',";
					  $jumlahMapel++;
					  $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } ?>
					
                     
                </tbody></table>
				
				<!-----==========================------>
				<br>
			 <b>D. PERAKTIK KERJA LAPANGAN</b> 	
			 <table class="tborder"    style="table-layout:fixed;width: 296mm;"  cellspacing="0">
			 <tr>
			 <td style="table-layout:fixed;width: 4%;" valign="top" align="center">NO</td> 
			 <td style="table-layout:fixed;width: 25%">MITRA DU/DI</td> 
			 <td style="table-layout:fixed;width: 25%;">LOKASI</td> 
			 <td style="table-layout:fixed;width: 10%">LAMA</td> 
			 <td style="table-layout:fixed;width: 36%;">KETERANGAN</td>
			 </tr>
			 <?php
			 $pkl=$this->db->query("select * from tm_pkl where id_siswa='".$idsiswa."' ")->result();
			 $no=1;
			 foreach($pkl as $pkl)
			 {
			 $id_mitra=isset($pkl->id_mitra)?($pkl->id_mitra):"";
			 $lama=isset($pkl->lama)?($pkl->lama):"";
			 $ket=isset($pkl->ket)?($pkl->ket):"";
			 $mitra=$this->m_reff->goField("tr_mitra","nama","where id='".$id_mitra."' ");
			 $lokasi=$this->m_reff->goField("tr_mitra","lokasi","where id='".$id_mitra."' ");
			 ?>
			 <tr>
			 <td><?php echo $no++;?></td><td><?php echo $mitra;?></td><td><?php echo $lokasi;?></td><td><?php echo $lama;?> Jam</td><td><?php echo $ket;?></td>
			 </tr>
			 <?php  } ?>
			   <tr>
			 <td><?php echo $no++;?></td>
			 <td></td>
			 <td></td>
			 <td></td>
			 <td></td>
	 
			 </tr>
			</table>
			<!-----==========================------>
			
			<!-----==========================------>
				<br>
			 <b>E. EKSTAKURIKULER</b> 	
			 <table class="tborder"  style="table-layout:fixed;width: 296mm;"  cellspacing="0">
			 <tr>
			 <td style="table-layout:fixed;width: 4%;" valign="top" align="center">NO</td> 
			 <td style="table-layout:fixed;width: 48%;">KEGIATAN EKSTAKURIKULER</td> 
			<td style="table-layout:fixed;width: 48%;">KETERANGAN</td>
			 </tr>
			 <?php
			 $dataEk=$this->db->query("select * from tm_ekstrakurikuler where id_siswa='".$idsiswa."' 
			 and id_tahun='".$tahun."' and id_semester='".$sms."' ")->result();
			 $no=1;
			 foreach($dataEk as $valEk)
			 {?>
			 <tr>
			 <td><?php echo $no++;?></td>
			 <td align="left"><?php echo $this->m_reff->goField("tr_ektrakurikuler","nama","where id='".$valEk->id_ektra."'")?></td>
			 <td align="left"><?php echo $valEk->ket; ?></td> 
			 </tr>
			 <?php } ?>
			 
			 <?php
			 if($no==1){ ?>
			  <tr>
			 <td><?php echo $no++;?></td>
			 <td></td>
			 <td></td>
			 </tr>
			 <?php } ?>
			</table>
			<!-----==========================------>
			<!-----==========================------>
				<br>
			 <b>F. PRESTASI</b> 	
			 <table class="tborder" style="table-layout:fixed;width: 296mm;"   cellspacing="0">
			 <tr>
			 <td style="table-layout:fixed;width: 20px;" valign="top" align="center">NO</td> 
			 <td style="table-layout:fixed;width: 48%;">PRESTASI</td> 
			<td style="table-layout:fixed;width: 49%;">KETERANGAN</td>
			 </tr>
			 <?php
			 $valPre=$this->db->query("select * from tm_prestasi where id_siswa='".$idsiswa."' 
			 and id_tahun='".$tahun."' and id_semester='".$sms."' ")->result();
			 $no=1;
			 foreach($valPre as $valPre)
			 {?>
			 <tr>
			 <td><?php echo $no++;?></td>
			 <td align="left"><?php echo $valPre->nama;?></td>
			 <td align="left"><?php echo $valPre->ket; ?></td> 
			 </tr>
			 <?php } ?>
			 <tr>
			 <td><?php echo $no++;?></td>
			 <td></td>
			 <td></td>
			 </tr>
			</table>
			<!-----==========================------>
			<!-----==========================------>
				<br>
			 <b>G. KETIDAK HADIRAN</b> 	
			 <table >
			 <tr>
			 <td style="table-layout:fixed;width: 50%;" >
			 <!-------------------------->
			 <?php 
			 $kh=$this->db->query("SELECT * from tm_kh where  id_siswa='".$idsiswa."' 
			 and id_tahun='".$tahun."' and id_semester='".$sms."' ")->row();
			 ?>
			 <div style="border: solid 1px black; width:500px;margin-left:30px">
				 <table  class="thadir" align="center">
				 <tr>
				 <td>SAKIT</td><td>: </td><td><?php echo isset($kh->sakit)?($kh->sakit):0;?></td>
				 </tr><tr>
				 <td>IZIN</td><td>: </td><td><?php echo isset($kh->izin)?($kh->izin):0;?></td>
				 </tr><tr>
				 <td>TANPA KETERANGAN</td><td>: </td><td><?php echo isset($kh->alfa)?($kh->alfa):0;?></td>
				 </tr>
				 </table>
			</div>
			<!-------------------------->	 
			 </td>
			 
			 
			 <td style="table-layout:fixed;width: 50%;">
			  
			  
			 <?php
//$NR=$this->mdl->getNilaiAkhir($idsiswa,$sms); //nilai rata-rata
//$eskul=$this->mdl->getNilaiEskul($idsiswa,$sms);
//$NilaiMinKehadiran=$this->mdl->NilaiMinKehadiran($idsiswa,$sms);


	  


$getNilaiRataSikap=$nilaiSeluruhSikap;

$nilaiKeterampilan=$nilaiSeluruhKeterampilan;
$nilaiPengetahuan=$nilaiSeluruh;
 
$total=($getNilaiRataSikap+$nilaiKeterampilan+$nilaiPengetahuan)/3;

//$NR=(($nilaiSeluruhKeterampilan/$jumlahMapel)+$eskul)-$NilaiMinKehadiran;

$NR=$total/$jumlahMapel;
//$NR=($NR+$eskul)-$NilaiMinKehadiran;
$NR=number_format($NR,2);
if($NR>=86){
$predikat="A";	 $desc_sikap="Siswa sangat aktif dan baik selama mengikuti pembelajaran";
}elseif($NR>=71){
$predikat="B";	$desc_sikap="Siswa aktif dan baik selama mengikuti pembelajaran";
}
elseif($NR>=56){
$predikat="C";	$desc_sikap="Siswa cukup aktif selama mengikuti pembelajaran";
}else{
$predikat="D"; $desc_sikap="Siswa kurang aktif";
}
?>			 
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  <table  class="thadir" align="center">
				 <tr>
				 <td>Nilai Rata-Rata</td><td>: </td><td><?php echo $NR;?></td>
				 </tr><tr>
				 <td>Predikat</td><td>: </td><td><?php echo $predikat;?></td>
				 </tr> 
				 </table>
			 
			 
			 </td>
			 
			 </tr>
			 </table>
			 
			 <br>
			 <b>H. CATATAN WALI KELAS</b> 
  <p>
 <div  style="border: solid 1px black;width: 296mm"> <p align="center">  <?php echo $this->m_reff->goField("tm_catatan_walikelas","ket","where  id_siswa='".$idsiswa."' 
			 and id_tahun='".$tahun."' and id_semester='".$sms."'");?> </p><br></div>
 </p>
  <br>
			 <b>I. TANGGAP ORANG TUA/WALI</b> 
  <p>
 <div  style="border: solid 1px black;width: 296mm"> <p align="center">  &nbsp; </p><br></div>
 </p>

 			  <?php
 $idtk=$this->input->get('id_tk');
 $idtknew=$idtk+1;
 if($this->input->get("id_semester")==2 and $this->input->get('id_tk')!=3 and !$this->input->get('gagal')){
     echo "<div style='line-height:14px;margin-top:392px;position:absolute;z-index:99'> <b>Keputusan:</b><br>
Berdasarkan hasil yang dicapai pada semester 1 & 2 peserta didik ditetapkan:<br>
Naik Ke Kelas ".$this->m_reff->goField('tr_tingkat','nama','where id="'.$idtknew.'" ')." (".$this->m_reff->goField('tr_tingkat','alias','where id="'.$idtknew.'" ').") / Tinggal dikelas ..................
</div> 
";
 }?>
 
 
  <table  style="table-layout:fixed;width: 100%;margin-top:430px;position:absolute;">
			 <tr>
			 <td style="table-layout:fixed;width: 50%;" align="center">
			 <!-------------------------->
			 <p align="center" style="z-index:-9" >
			 <b> Mengetahui<br>
			  Orang Tua,</b>
			  <br>
			  <br>
			  <br>
			  <br>
			  <br>
			  ......................................
			  </p>
			<!-------------------------->	 
			 </td>
			 
			 
			 <td style="table-layout:fixed;width: 50%;">
			 `
			 <!-------------------------->
			 <p align="center"  >
			 <b> Subang,    <?php echo $this->mdl->titiMangsaRapot($sms);?> <br>
			  Wali Kelas,</b>
			  <br>
			  <br>
			  <br>
			  <br>
			  <br>
			  <B><?php echo $this->m_reff->nama_wali_kelas($idsiswa);?></B><br>
			 
			  </p>
			<!-------------------------->	
			 
			 
			 </td>
			 
			 </tr>
			 <tr>
			 <td colspan="2" valign="top">
			 
			 <!-------------------------->
			 <p align="center"  >
			 <b> Mengetahui <br>
			  Kepala Sekolah,</b>
			  <br>
			     <img src="<?php echo base_url();?>file_upload/dok/<?php echo $this->mdl->ttd_kepsek($tahun)?>" 
		style="border:black dashed 1px;width:53mm;height:15mm;font-size:11px;text-align:center;margin-left:-20px;margin-top:10px"> 
	  
			  <br>
			  
			  <b><?php echo $this->mdl->nama_kepsek($tahun)?></b>
			  </p>
			<!-------------------------->	
			 
			 
			 </td>
			  </tr>
			 </table>

</page>
 

 
 
 
 
 