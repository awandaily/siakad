
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
			
$kelas_lengkap=$this->m_reff->goField("v_kelas","kelas_lengkap","where id='$id_kelas' ");
$kelas_lengkap=ucwords(strtolower($kelas_lengkap));
$kelas_lengkap=str_replace("Nautika Kapal Niaga A","Nautika Kapal Niaga",$kelas_lengkap);
$kelas_lengkap=str_replace("Nautika Kapal Niaga B","Nautika Kapal Niaga",$kelas_lengkap);
$kelas_lengkap=str_replace("Xii","XII",$kelas_lengkap);
$kelas_lengkap=str_replace("Xi","XI",$kelas_lengkap);

$predikat="D"; $desc_sikap="Siswa kurang aktif";
?>		

 




<style type="text/css">
		body{
			font-size: 13pt;
		}
		 .strike{
		      text-decoration: line-through;
		 }
		table tr td
		{
		    padding: 0;
		    font-size: 13pt;
		    background: #FFFFFF;
			font-family:times;
		  
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
 
                .tborder{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width: 100mm;font-size:13pt;}
                .tborder2{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width:200mm;font-family:Times;}
               .tborder td,.tborder  th{word-wrap:break-word;word-break: break-all;border: 1px solid #000;padding:2px;font-size:13pt;text-align:center}

               .tborder0{
               		border-collapse: collapse;
               		 border: 1px solid;
               		 word-wrap:break-word; word-break: break-all;
               		 table-layout: fixed;
               }
			   
			   
                .thadir{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width: 100mm;}
               .thadir td,.thadir  th{word-wrap:break-word;word-break: break-all; padding:2px;font-size:13pt;text-align:center}
			   .cover{
			   height:30cm;
			   }
			   .label{
			   font-size:21px;font-weight:bold;
			   border:black solid 1px;
			   padding:10px;
			   }
			   #font-times tr td{
			       font-family:Times;
			       font-size: 13pt;
			   }
			   .size{
			       size:13pt;
			       font-size:13pt;
			   }

</style>
<page orientation="portrait" format="210x320">   
  <br><br>  
    <br><br> <br><br>
      <br><br> <br><br>
<p align="center" class="tborder2" >
<b><h3><strong>RAPORT PESERTA DIDIK<br> 
SEKOLAH MENENGAH KEJURUAN<br>(SMK)</strong>
</h3></b> 
<br>
 
</p>		
<br>
<p align="center">
   <!-- <img src="<?php echo base_url()?>/file_upload/img/<?php echo $this->m_reff->tm_pengaturan(10)?>" style="width:100px">-->
   <img src="<?php echo base_url()?>/plug/img/tutwuri.png" style="width:140px">
</p>


<br><br>
<br><br>
<table style="table-layout:fixed;width: 100%;margin-top:20px"  >
<tr>
<td style="table-layout:fixed;width: 100%;" align="center">
<span>Nama Peserta Didik : </span><br>

 
</td>
</tr>
 
</table>
 <table style="width: 80%;border: solid 1px black" align="center">
        <tr>
            <td style="width: 80%; text-align: center;font-weight:bold;padding:10px"><?php echo strtoupper($data->nama);?></td>
           
        </tr>
    </table>
<br><br><br>
<table style="table-layout:fixed;width: 100%;"  >
<tr>
<td style="table-layout:fixed;width: 100%;" align="center">
<span> NISN :  </span><br>

 
</td>
</tr>
 
</table>
 <table style="width: 80%;border: solid 1px black" align="center">
       <tr>
            <td style="width: 80%; text-align: center;font-weight:bold;padding:10px"><?php echo strtoupper($data->nisn);?></td>
           
        </tr>
    </table>
 
 
	<br>	<br>	<br>
	 
	 
 <p align="center" class="tborder2" >
<b><h3>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN<br>
REPUBLIK INDONESIA
</h3></b> 
<br>
 
</p>	
 
 </page>
 
  <!--=====================================================================================================================================================!-->
 


 <page orientation="portrait" format="210x320">   

<p align="center" class="tborder2" >
<b><h3><strong>RAPORT PESERTA DIDIK<br> 
SEKOLAH MENENGAH KEJURUAN<br>(SMK)</strong>
</h3></b> 
<br>
 
</p>		
<br>
<br>
<br>
<br>
<br>
<br>
<br>
 
 
<table  id="font-times" style="table-layout:fixed;width: 100%;margin-left:90px; "   >
<tr  >
<td style="table-layout:fixed;width:200px;"  >
<span  >Nama Sekolah    </span>
</td>
<td style="table-layout:fixed;width: 30px;  ">:</td>
<td   style="table-layout:fixed;width: 300px;border-bottom:black solid 1px   ">  <?php echo $this->m_reff->tm_pengaturan(7);?> </td>
</tr>
<tr>
    <td colspan="3">&nbsp;</td>
</tr>
<tr>
<td style="table-layout:fixed;width: 200px;"  >
<span>NPSN    </span>
</td>
<td style="table-layout:fixed;width: 30px;">:</td>
<td   style="table-layout:fixed;width: 300px;border-bottom:black solid 1px;"> <?php echo $this->m_reff->tm_pengaturan(20);?> </td>
</tr>
<tr>
    <td colspan="3">&nbsp;</td>
</tr>
<tr>
<td style="table-layout:fixed;width: 200px;"  >
<span>NIS/NNS/NDS   </span>
</td>
<td style="table-layout:fixed;width: 50px;">:</td>
<td style="table-layout:fixed;width: 300px;border-bottom:black solid 1px"> <?php echo $this->m_reff->tm_pengaturan(21);?> </td>
</tr>
<tr>
    <td colspan="3">&nbsp;</td>
</tr>
<tr>
<td valign="top" rowspan="3" style="table-layout:fixed;width: 200px;"  >
<span>Alamat Sekolah  </span>
</td>
<td  valign="top" rowspan="3" style="table-layout:fixed;width: 50px;">:</td>
<td style="table-layout:fixed;width: 300px;border-bottom:black solid 1px"> <?php echo $this->m_reff->tm_pengaturan(22);?> </td>
</tr>
<tr>
<td style="table-layout:fixed;width: 300px;border-bottom:black solid 1px"><br> <?php echo $this->m_reff->tm_pengaturan(23);?> </td>
</tr>
<tr>
<td style="table-layout:fixed;width: 300px;border-bottom:black solid 1px"><br> <?php echo $this->m_reff->tm_pengaturan(24);?> </td>
</tr>
<tr>
    <td colspan="3">&nbsp;</td>
</tr>

 <tr>
<td style="table-layout:fixed;width: 200px;" >
<span>Kelurahan  </span>
</td>
<td style="table-layout:fixed;width: 50px;">:</td>
<td style="table-layout:fixed;width: 300px;border-bottom:black solid 1px"> <?php echo $this->m_reff->tm_pengaturan(25);?> </td>
</tr>
<tr>
    <td colspan="3">&nbsp;</td>
</tr>


<tr>
<td style="table-layout:fixed;width: 200px;"  >
<span>Kecamatan  </span>
</td>
<td style="table-layout:fixed;width: 50px;">:</td>
<td style="table-layout:fixed;width: 300px;border-bottom:black solid 1px"> <?php echo $this->m_reff->tm_pengaturan(26);?> </td>
</tr>
<tr>
    <td colspan="3">&nbsp;</td>
</tr>


<tr>
<td style="table-layout:fixed;width: 200px;"  >
<span>Kota/Kabupaten  </span>
</td>
<td style="table-layout:fixed;width: 50px;">:</td>
<td style="table-layout:fixed;width: 300px;border-bottom:black solid 1px"> <?php echo $this->m_reff->tm_pengaturan(27);?> </td>
</tr>
<tr>
    <td colspan="3">&nbsp;</td>
</tr>
<tr>
<td style="table-layout:fixed;width: 200px;" >
<span>Provinsi   </span>
</td>
<td style="table-layout:fixed;width: 50px;">:</td>
<td style="table-layout:fixed;width: 300px;border-bottom:black solid 1px"> <?php echo $this->m_reff->tm_pengaturan(28);?> </td>
</tr>
<tr>
    <td colspan="3">&nbsp;</td>
</tr>
<tr>
<td style="table-layout:fixed;width: 200px;" >
<span>Website  </span>
</td>
<td style="table-layout:fixed;width: 50px;">:</td>
<td style="table-layout:fixed;width: 300px;border-bottom:black solid 1px"> <?php echo $this->m_reff->tm_pengaturan(14);?> </td>
</tr>
<tr>
    <td colspan="3">&nbsp;</td>
</tr>
<tr>
<td style="table-layout:fixed;width: 200px;" >
<span>E-mail  </span>
</td>
<td style="table-layout:fixed;width: 50px;">:</td>
<td style="table-layout:fixed;width: 300px;border-bottom:black solid 1px"> <?php echo $this->m_reff->tm_pengaturan(2);?> </td>
</tr>
</table>
  
 
 	
 
 </page>
 
 <!--===============================================================================================!-->
 
 <page orientation="portrait" format="210x330">   
   
<div align="center" class="tborder2">
<b><h3>KETERANGAN TENTANG PESERTA DIDIK</h3></b> 
<br>
 
</div>		
 
<br>
<br>
 <table id="font-times" style="width: 90%;" align="center">
       <tr>
		   <td style="table-layout:fixed;width: 20px;padding: 5px;">1<?php   $no=2;?>.</td>
		   <td style="table-layout:fixed;width: 260px;padding: 5px;">Nama Peserta Didik</td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td style="padding: 5px;"><?php echo strtoupper($data->nama);?></td>
       </tr> 
	   <tr>
		   <td  style="padding: 5px;"><?php echo $no++;?>.</td>
		   <td  style="padding: 5px;">Nomor Induk/NISN</td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td style="padding: 5px;"><?php echo $data->nis;?> / <?php echo $data->nisn;?></td>
       </tr> 
	   
	   <tr>
		   <td  style="padding: 5px;"><?php echo $no++;?>.</td>
		   <td  style="padding: 5px;">Tempat dan Tanggal Lahir</td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td style="padding: 5px;"><?php echo ucwords(strtolower($data->tempat_lahir));?>, <?php echo  $this->tanggal->indonesiaBulan($this->tanggal->ind($data->tgl_lahir,"/")," ");?> </td>
       </tr>

	 
	    <tr>
		   <td  style="padding: 5px;"><?php echo $no++;?>.</td>
		   <td  style="padding: 5px;">Jenis Kelamin</td>
		   <td style="padding: 5px;"> : &nbsp;</td>
			   <?php
			   if($data->jk=="l")
			   {
			       $jk="Laki-laki";
			   }else{
			       $jk="Perempuan";
			   }?>
		   <td style="padding: 5px;"><?php echo $jk;?>  </td>
       </tr>
	    <tr>
		   <td  style="padding: 5px;"><?php echo $no++;?>.</td>
		   <td  style="padding: 5px;">Agama/Kepercayaan</td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td style="padding: 5px;"><?php echo $this->m_reff->huruf_kecil($data->agama);?>  </td>
       </tr>  
	   <tr>
		   <td  style="padding: 5px;"><?php echo $no++;?>.</td>
		   <td  style="padding: 5px;">Status Dalam Keluarga</td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td style="padding: 5px;"><?php    if($data->hub_keluarga==1){ echo "Anak Kandung"; }else{ echo "Anak Tiri";};?>  </td>
       </tr>  <tr>
		   <td  style="padding: 5px;"><?php echo $no++;?>.</td>
		   <td  style="padding: 5px;">Anak Ke</td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td style="padding: 5px;">   <?php   $data->anak_ke;
			   if($data->anak_ke){
			       echo "Ke- ".$data->anak_ke;
			   }else{
			       echo "-";
			   }
			   ?>  
		   </td>
       </tr> 
       <tr>
		   <td  style="padding: 5px;"><?php echo $no++;?>.</td>
		   <td  style="padding: 5px;">Alamat Peserta Didik</td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td  style="table-layout:fixed;width: 260px;padding: 5px"><?php echo  ucwords(strtolower($data->alamat));?>  </td>
       </tr>
	   
	   
	   <tr>
		   <td  style="padding: 5px;"><?php echo $no++;?>.</td>
		   <td  style="padding: 5px;">Nomor Telpon Rumah </td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td style="padding: 5px;"><?php echo strtoupper($data->hp);?>  </td>
       </tr>   
	   
     	<tr>
		   <td  style="padding: 5px;"><?php echo $no++;?>.</td>
		   <td  style="padding: 5px;">Sekolah Asal</td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td style="padding: 5px;"><?php echo ucwords(strtolower($data->asal_smp));?>  </td>
       </tr>  
       
	 <!--  <tr>
	   <td  > </td>
	   <td  >Alamat Email</td>
	   <td> : &nbsp;</td>
	   <td><?php echo $data->email;?>  </td>
       </tr>  -->
	   <tr>
		   <td  style="padding: 5px;"><?php echo $no++;?>.</td>
		   <td  style="padding: 5px;">Diterima di Sekolah ini </td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td style="padding: 5px;">  </td>
       </tr>    
	   <tr>
		   <td  style="padding: 5px;"> </td>
		   <td  style="padding: 5px;">Di Kelas </td>
		   <td style="padding: 5px;"> : &nbsp;</td>
	   
			   <?php
			   if($data->id_sts_data==1){
			       $kelas_masuk="X (Sepuluh)";
			       $id_tahun_masuk=$data->id_tahun_masuk;
			       $tglditerima=$this->m_reff->goField("tr_tahun_ajaran","tgl_penerimaan","where id='".$id_tahun_masuk."'");
			 
			   }else{
			       
			       if($data->id_tahun_1){
			            $kelas_masuk="X (Sepuluh)";
			       }
			       if($data->id_tahun_2){
			            $kelas_masuk="XI (Sebelas)";
			       }
			       if($data->id_tahun_3){
			            $kelas_masuk="XII (Duabelas)";
			       }
			       
			      $tglditerima=$this->tanggal->indBulan($data->tgl_diterima," ");
			   }
			   ?>
	   
	   
		   <td style="padding: 5px;"> <?php echo $kelas_masuk;?>  </td>
       </tr>    
	   
	   <tr>
		   <td  style="padding: 5px;"> </td>
		   <td  style="padding: 5px;">Pada Tanggal </td>
		   <td style="padding: 5px;"> : &nbsp;</td>
		   <td style="padding: 5px;"> <?php  echo $tglditerima;?> </td>
       </tr>    
       <tr>
	   <td > </td>
	 <!--  <td  >Semester </td>
	   <td> : &nbsp;</td>
	   <td> <?php //echo sprintf("%02s", $data->id_sms_diterima)." (".$this->m_reff->goField("tr_semester","baca","where id='".$data->id_sms_diterima."'").")";?> </td>-->
       </tr>  
	   
	 <!--  <tr>
	   <td  > echo $no++;?></td>
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
       </tr>  -->
	   
		 
	 <!--   <tr>
	   <td  >  php echo $no++;?>.</td>
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
      -->
	   
	    <tr>
	   <td  style="padding: 5px;"> <?php echo $no++;?>.</td>
	   <td  style="padding: 5px;">Nama Orang Tua</td>
	   <td style="padding: 5px;">  </td>
	   <td style="padding: 5px;">   </td>
       </tr>  
	   
	   <tr>
	   <td  style="padding: 5px;">  </td>
	   <td  style="padding: 5px;">a. Ayah</td>
	   <td style="padding: 5px;"> : &nbsp;</td>
	   <td style="padding: 5px;">  <?php echo ucwords(strtolower($data->nama_ayah));?> </td>
       </tr>  
	   
       <tr>
	   <td  style="padding: 5px;">  </td>
	   <td  style="padding: 5px;">b. Ibu</td>
	   <td style="padding: 5px;"> : &nbsp;</td>
	   <td style="padding: 5px;">  <?php echo ucwords(strtolower($data->nama_ibu));?> </td>
       </tr>  
	   <tr>
	   <td  valign="top" style="padding: 5px;"> <?php echo $no++;?>. </td>
	   <td   valign="top" style="padding: 5px;">Alamat Orang Tua</td>
	   <td  valign="top" style="padding: 5px;"> : &nbsp;</td>
	   <td  valign="top" style="table-layout:fixed;width: 260px;padding: ">  <?php echo ucwords(strtolower($data->alamat_ortu));?> </td>
       </tr>  
      
	    <tr>
	   <td  style="padding: 5px;">  </td>
	   <td style="padding: 5px;" >Nomor Telpon Rumah</td>
	   <td style="padding: 5px;"> : &nbsp;</td>
	   <td style="padding: 5px;">   </td>
       </tr>  
	   
	<!--   <tr>
	   <td  > </td>
	   <td  >Alamat Email</td>
	   <td> : &nbsp;</td>
	   <td>   </td>
       </tr> -->
   
	   <tr>
	   <td  style="padding: 5px;"> <?php echo $no++;?>.</td>
	   <td  style="padding: 5px;">Pekerjaaan Orang Tua</td>
	   <td style="padding: 5px;"> : &nbsp;</td>
	   <td style="padding: 5px;">   </td>
       </tr> 
		<tr>
	   <td  style="padding: 5px;">  </td>
	   <td  style="padding: 5px;">a. Ayah</td>
	   <td style="padding: 5px;"> : &nbsp;</td>
	   <td style="padding: 5px;">  <?php 
	   $pekerjaanAyah=$data->id_pekerjaan_ayah;
	   if(strlen($pekerjaanAyah)<3)
	   {
	      $pekerjaanAyah=$this->m_reff->goField("tr_pekerjaan","nama","where id='".$data->id_pekerjaan_ayah."' "); 
	   } 
	   echo  $pekerjaanAyah;?> </td>
       </tr>  
	   
       <tr>
	   <td  style="padding: 5px;">  </td>
	   <td  style="padding: 5px;">a. Ibu</td>
	   <td style="padding: 5px;"> : &nbsp;</td>
	   <td style="padding: 5px;">   <?php 
	   $pekerjaanIbu=$data->id_pekerjaan_ibu;
	   if(strlen($pekerjaanIbu)<3)
	   {
	      $pekerjaanIbu=$this->m_reff->goField("tr_pekerjaan","nama","where id='".$data->id_pekerjaan_ibu."' "); 
	   } 
	   echo $pekerjaanIbu;?> </td>
       </tr>  


		 <tr>
	   <td  style="padding: 5px;"> <?php echo $no++;?>.</td>
	   <td  style="padding: 5px;">Nama Wali Peserta Didik </td>
	   <td style="padding: 5px;"> : &nbsp;</td>
	   <td style="padding: 5px;">  <?php echo strtoupper($data->nama_wali);?> </td>
       </tr>
	   
	   <tr>
	   <td  style="padding: 5px;"> <?php echo $no++;?>.</td>
	   <td  style="padding: 5px;">Alamat Wali Peserta Didik </td>
	   <td style="padding: 5px;"> : &nbsp;</td>
	   <td style="padding: 5px;">  <?php echo ucwords(strtolower($data->alamat_wali));?> </td>
       </tr>

	    <tr>
	   <td  style="padding: 5px;">  </td>
	   <td  style="padding: 5px;">Nomor Telpon Rumah</td>
	   <td style="padding: 5px;">  </td>
	   <td style="padding: 5px;">   </td>
       </tr>  
	   
<!--	   <tr>
	   <td  > </td>
	   <td  >Alamat Email</td>
	   <td> : &nbsp;</td>
	   <td>   </td>
       </tr> -->
	   
	      <tr>
	   <td  style="padding: 5px;"> <?php echo $no++;?>.</td>
	   <td  style="padding: 5px;">Pekerjaan Wali Peserta Didik</td>
	   <td style="padding: 5px;"> : &nbsp;</td>
	   <td style="padding: 5px;">    </td>
       </tr>
	     <tr>
	   <td colspan="4"> <br>  </td>
	     </tr>  
		   <tr>
	   <td colspan="2" valign="top"> 
		<?php
		if(strpos($this->m_reff->poto_siswa($idsiswa),"plug/img")===false){
		    ?>
		<div style="margin-left:50px;border:black solid 1px;width:33mm;height:35mm;text-align:center" align='center' id="poto"> 
	
		<img src="<?php echo $this->m_reff->poto_siswa($idsiswa);?>" 
		style="border:black solid 1px;width:33mm;height:35mm;text-align:center"> 
	
		</div>
			<?php } ?>
	   </td>
	   <td colspan="2" valign="top" style="font-weight:bold">  <b>Subang,    <?php echo $tglditerima?> <br> 
	   Kepala Sekolah,<br>
	   	<?php
	   		if ($tingkat != "1") {
	   			
	   		
	   	?>
	   		<img src="<?php echo base_url();?>file_upload/dok/<?php echo $this->mdl->ttd_kepsek($tahun)?>" style="width:53mm;height:15mm;">
		<?php }
			else{


		?>
		<br>
		<br>
		<br>
		<?php } ?>
		<br>
		
	   
	   	<br>
	   		<u><?php echo $this->mdl->nama_kepsek($tahun)?></u><br>
	   		NIP <?php echo $this->mdl->nip_kepsek($tahun)?> 
	   	</b>
	   </td>
	     </tr>  
		 
    </table>

  
 
 </page>
 
 
 <!--===============================================================================================================================================-->
  <!--===============================================================================================================================================-->
   <!--===============================================================================================================================================-->
    <!--===============================================================================================================================================-->
 

<page   format="210x320" style='font-size:12px' backtop="2mm" backbottom="10mm" backleft="10mm" backright="10mm">

<br>
 
		 <table  id="font-times" style="table-layout:fixed;width: 100%;"  border="0">
		 	<tr> 
		 	 	<td  style='width:200px;padding: 2px;'>Nama Peserta Didik	</td><td>:</td><td  style=''>
		 	 		<?php echo ucwords(strtolower($data->nama))?>
		 	 	</td> 
		 	</tr>
		 <tr> <td  style='padding: 2px;'>NISN/NIS 	</td><td>:</td><td  style='padding: 2px;'><?php echo $data->nisn;?> / <?php echo $data->nis;?></td> </tr>
		  <tr> <td   style='padding: 2px;'>Kelas</td><td>:</td><td   style='padding: 2px;'> <?php echo $kelas_lengkap;?> </td> </tr>
		 <tr> <td   style='padding: 2px;'>Semester</td><td>:</td><td   style='padding: 2px;'><?php echo $this->m_reff->huruf_kecil($this->m_reff->goField("tr_semester","nama","where id='".$this->m_reff->semester()."' ")) ;?></td> </tr>
		 </table>
	 
 
<br>
<br> 
  <b id="font-times"><font face="Times" style="font-size: 13pt;font-family: times;;">A. Nilai Akademik </font></b><br><br> 
  
  
   
 
   
  <table class="tborder0" border="1">
                   
					 <tr >
					  <th   style="font-size: 13pt;font-family: times;text-align: center;padding: 5px">No</th>
					  <th   style="font-size: 13pt;font-family: times;text-align: center;padding: 5px">Mata Pelajaran</th>
					  <th   style="font-size: 13pt;font-family: times;text-align: center;padding: 5px">Pengetahuan</th>
					  <th    style="font-size: 13pt;font-family: times;text-align: center;padding: 5px">Keterampilan</th>
					   <th style="font-size: 13pt;font-family: times;text-align: center;padding: 5px">Nilai<br>Akhir</th>
					   <th style="font-size: 13pt;font-family: times;text-align: center;padding: 5px">Predikat</th>
					  </tr>
					  <?php
					 $cek=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='A' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel")->num_rows();
					 if($cek){
					 ?>
					  <!-----==========================------>
					 <tr>
					 <td colspan="6" align="left" style="padding: 3px;"><b>A. Muatan Nasional</b></td>
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
					".$filterasi." group by id_mapel")->result();
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
                        <td align="center"  style="padding: 3px;"><?php echo $no++;?></td>
                        <td align="left" style="padding: 3px;width: 255px;word-wrap: break-word" valign="middle"> <?php echo $gm->mapel;?></td> 
                        <td  style="" align="center"><?php echo number_format($fix,0);?></td> <!-- nilai pengetahuan-->
                         
                         <td  style="" align="center"> <?php echo number_format($fixNRK,0);?></td>
                         <td style="text-align: center;"><?php echo number_format($NA=ceil((($fix+$fixNRK))/2),0)?></td>
                        <td style="table-layout:fixed;width: 35px;text-align: center;"> <?php echo $this->mdl->predikat(1,$NA);?> </td>
                       
					 
                      
                    </tr>
					 <?php 
					}
					  $jumlahMapel++;
					    $dataMapelID.="'".$gm->id_mapel."',";
					   
					 $nilaiSeluruh=$NRP+$nilaiSeluruh;
					 $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					 
				 $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					
					} ?>
					<!-----==========================------>
					<?php
					 	 $getMapelAgama=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."' 
					 and k_mapel='A' and id_tahun='".$tahun."' and id_semester='".$sms."' AND (id_mapel_induk='' or id_mapel_induk IS NULL) 
					 AND mapel_global='2'   group by id_mapel")->num_rows();
					 
					if($agama>1 && $getMapelAgama>0)
					{?>
				 <tr>
                        <td ><?php echo $no++;?></td>
                        <td align="left" style="padding: 3px;width: 255px;word-wrap: break-word"> Pendidikan Agama dan Budi Pekerti</td>
                       
                        <td style="text-align: center;"><?php echo number_format($NRP=$this->mdl->getNpNonMuslim($idsiswa),0);?></td>
                        <td style="text-align: center;"> <?php echo number_format($NRK=$this->mdl->getNkNonMuslim($idsiswa),0);?></td>
                        <td style="text-align: center;"><?php echo number_format($NA=ceil((($NRP+$NRK))/2),0)?></td>
                        <td style="text-align: center;"><?php echo $this->mdl->predikat(1,$NA); ?></td>
                         
					 
				</tr>		
				<?php
					}
					?>
				
                      <?php 
						 $jumlahMapel++;
					    $dataMapelID.="'".$gm->id_mapel."',";
					   
					 $nilaiSeluruh=$NRP+$nilaiSeluruh;
					 $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					 
					$nilaiSikap=0;//$this->mdl->getNsNonMuslim($idsiswa);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
						
					}
					
					
					?>
					
					<!-----==========================------>
					 <?php
					 $cek=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='B' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel")->num_rows();
					 if($cek){
					 ?>
					 <tr>
					 <td colspan="6" align="left" style="padding: 3px;"><b> B. Muatan Kewilayahan</b></td>
					 </tr>
                   <?php
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='B' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel")->result();
					 $no=1;$t_NRP=0; 
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='B' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND id_mapel_induk='".$gm->id_mapel."' group by id_mapel")->result();
						  foreach($getSubMapel as $gesub)
						  {

							$j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP;
							  
							  
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK;
							  
							  $N_sikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp;



						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
                        
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru); 
                        
 
  
					  $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
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
							 $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
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
                        <td align="center" style="padding: 3px;"><?php echo $no++;?></td>
                        <td align="left" style="padding: 3px;width: 255px;word-wrap: break-word"> <?php echo $gm->mapel;?></td>
                      
                        <td style="" align="center"><?php echo number_format($fix,0);?></td> 
                        <td style="" align="center">  <?php echo number_format($fixNRK,0);?></td>
                        <td style="text-align: center;" align="center"><?php echo number_format($NA=ceil((($fix+$fixNRK))/2),0)?></td>
                         <td style="text-align: center;" align="center"><?php echo $this->mdl->predikat(1,$NA); ?></td>
						 
                      
                    </tr>
					 <?php 
					}
					  $dataMapelID.="'".$gm->id_mapel."',";
					  $jumlahMapel++;
					  $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } ?>
                      
                      <?php 
					 }
					 ?>
                    
					<!-----==========================------>
					 <tr>
					 <td colspan="6" align="left" style="padding: 3px;"><b> C. Muatan Peminatan Kejuruan</b></td>
					 </tr>
					 <?php
					 $cek=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C1' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel")->num_rows();
					 if($cek){
					 ?>
					 
					 <tr>
					 <td colspan="6" align="left" style="padding: 3px;"><b> C1. Dasar Bidang Keahlian</b></td>
					 </tr>
                     <?php
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C1' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel")->result();
					 $no=1;$t_NRP=0; 
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C1' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND id_mapel_induk='".$gm->id_mapel."' group by id_mapel")->result();
						  foreach($getSubMapel as $gesub)
						  {

							$j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP;
							  
							  
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK;
							  
							  $N_sikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp;



						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
                        
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru); 
                        
 
  
					  $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
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
							 $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
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
                        <td align="center"><?php echo $no++;?></td>
                        <td align="left" style="padding: 3px;width: 255px;word-wrap: break-word"> <?php echo $gm->mapel;?></td>
                        
                        <td style="" align="center"><?php echo number_format($fix,0);?></td>
                         
                        <td style="" align="center">  <?php echo number_format($fixNRK,0);?></td>
                       <td style="text-align: center;" align="center"><?php echo number_format($NA=ceil((($fix+$fixNRK))/2),0)?></td>
                        
                       <td style="text-align: center;" align="center"><?php echo $this->mdl->predikat(2,$NA);?></td>
                    </tr>
                    <?php
					} ?>
					
					
					
					
					
					 <?php 
					}
					  $dataMapelID.="'".$gm->id_mapel."',";
					  $jumlahMapel++;
					  $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } ?>
                      
					
					<!-----==========================------>
					 <?php
					 $cek=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C2' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel")->num_rows();
					 if($cek){
					 ?>
					 
					 <tr >
					 	<td colspan="6" style="padding: 3px;" align="left"><b> C2. Dasar Program Keahlian</b></td>
					 </tr>
                   <?php
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C2' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel")->result();
					 $no=1;$t_NRP=0; 
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C2' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND id_mapel_induk='".$gm->id_mapel."' group by id_mapel")->result();
						  foreach($getSubMapel as $gesub)
						  {

							$j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP;
							  
							  
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK;
							  
							  $N_sikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp;



						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
                        
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru); 
                        
 
  
					  $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  


					 if($j>0)
						  {
							  
							 
							  $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $t_NRP=($N_RP+$NRP)/($j+1);
							
							 $fix=$t_NRP;

							 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
							  
							  
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
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
                        <td style="" align="center"><?php echo $no++;?></td>
                        <td align="left" style="padding: 3px;width: 255px;word-wrap: break-word"> <?php echo $gm->mapel;?></td>
                         <td style="" align="center"><?php echo number_format($fix,0);?></td>
                           <td style="" align="center">  <?php echo number_format($fixNRK,0);?></td>
                         <td style="text-align: center;" align="center"><?php echo number_format($NA=ceil((($fix+$fixNRK))/2),0)?></td> 
                       <td style="text-align: center;" align="center"><?php echo $this->mdl->predikat(2,$NA);?></td>
                      
                    </tr>
                    <?php 
					} 
					?>
					 <?php 
					}
					  $dataMapelID.="'".$gm->id_mapel."',";
					  $jumlahMapel++;
					  $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   	  $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } ?>
                       <?php
					 $cek=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C3' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel")->num_rows();
					 if($cek){
					 ?>
					 	 <tr>
					 <td colspan="6" align="left" style="padding: 3px;"><b> C3. Paket Keahlian</b></td>
					 </tr>
                    <?php
					 
					 $getMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C3' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND (id_mapel_induk='' or id_mapel_induk IS NULL) group by id_mapel")->result();
					 $no=1;$t_NRP=0; 
					 foreach($getMapel as $gm)
					 {
						  $N_RP=0;$j=0;$N_RK=0;$N_skp=0;
						  $getSubMapel=$this->db->query("select * from v_jadwal where id_kelas='".$id_kelas."'
					 and k_mapel='C3' and id_tahun='".$tahun."' and id_semester='".$sms."' 
					 AND id_mapel_induk='".$gm->id_mapel."' group by id_mapel")->result();
						  foreach($getSubMapel as $gesub)
						  {

							$j++;$jumlahMapel++;
							  $valNRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RP=$valNRP+$N_RP;
							  
							  
							  $valNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_RK=$valNRK+$N_RK;
							  
							  $N_sikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
							  $N_skp=$N_sikap+$N_skp;



						    $NRPDUP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);  
                        
							$NRKDUP=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru); 
                        
 
  
					  $nilaiSeluruh=$NRPDUP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRKDUP+$nilaiSeluruhKeterampilan;
					   
					   $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gesub->id_mapel,$sms,$gesub->id_guru);
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 }  


					 if($j>0)
						  {
							  
							 
							  $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
							   $NRP=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $t_NRP=($N_RP+$NRP)/($j+1);
							
							 $fix=$t_NRP;

							 
							 $NRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $fixNRK=($N_RK+$NRK)/($j+1);
							  
							  
						  }else{
						     $NRP=$fix=$this->mdl->getNilaiRataPengetahuan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $NRK=$fixNRK=$this->mdl->getNilaiRataKeterampilan($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							 $nilaiSikap=0;//$this->mdl->getNilaiRataSikap($idsiswa,$gm->id_mapel,$sms,$gm->id_guru);
							  
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
                        <td align="center"><?php echo $no++;?></td>
                        <td align="left" style="padding: 3px;width: 255px;word-wrap: break-word"> <?php echo $gm->mapel;?></td> 
                        <td align="center"><?php echo number_format($fix,0);?></td> 
                        <td align="center">  <?php echo number_format($fixNRK,0);?></td>
                          <td style="text-align: center;" align="center"><?php echo number_format($NA=ceil((($fix+$fixNRK))/2),0)?></td> 
                       <td style="text-align: center;" align="center"><?php echo $this->mdl->predikat(2,$NA);?></td>
                        
                      
                    </tr>
                    <?php
					}
					?>
					 <?php 
					}
					  $dataMapelID.="'".$gm->id_mapel."',";			 
					  $jumlahMapel++;
					  $nilaiSeluruh=$NRP+$nilaiSeluruh;
					   $nilaiSeluruhKeterampilan=$NRK+$nilaiSeluruhKeterampilan;
					   
					   
					 $nilaiSeluruhSikap=$nilaiSikap+$nilaiSeluruhSikap;
					 
					 } ?>
                     
					 
					 
					  
					 <!-----==========================------><!-----==========================------>
					 <!-----==========================------><!-----==========================------>
				     <!-----==========================------><!-----==========================------>
				      <!-----==========================------><!-----==========================------>
					 <!-----==========================------><!-----==========================------>
				     <!-----==========================------><!-----==========================------>
				     
				     </table>
				     <br>
				     <br>
<b style="font-family: Times;font-size: 14pt">B. Catatan Akademik</b><br><br> 
 <style>
    .mide{
        table-layout:fixed;border: solid 0.5px black;width: 160mm;font-family: Times;font-size: 14pt;height: 20mm;
        padding-left:14px;padding-right:14px;
    }
</style>
<table>
    <tr >
        <td valign="middle" class='mide'>
            <?php $datacat=$this->db->query("select * from tm_catatan_walikelas where id_semester='".$sms."' and id_tahun='".$tahun."' and id_siswa='".$data->id."'")->row();
 echo isset($datacat->ket)?($datacat->ket):"";?> 
        </td>
    </tr>
</table>		     
				     
				     
				     
				     
				     
	</page>			     
 
<page   format="210x320" style='font-size:11px'>
 

<br>

<br>


 
		 
		 <table  id="font-times" style="table-layout:fixed;width: 100%;"  border="0">
		 	 <tr> <td  style='width:200px;padding: 2px;'>Nama Peserta Didik	</td><td>:</td><td  style=''>
		 	 	<?php echo ucwords(strtolower($data->nama))?>
		 	 </td> </tr>
		 <tr> <td  style='padding: 2px;'>NISN/NIS 	</td><td>:</td><td  style='padding: 2px;'><?php echo $data->nisn;?> / <?php echo $data->nis;?></td> </tr>
		  <tr> <td   style='padding: 2px;'>Kelas</td><td>:</td><td   style='padding: 2px;'> <?php echo $kelas_lengkap;?> </td> </tr>
		 <tr> <td   style='padding: 2px;'>Semester</td><td>:</td><td   style='padding: 2px;'><?php echo $this->m_reff->huruf_kecil($this->m_reff->goField("tr_semester","nama","where id='".$this->m_reff->semester()."' ")) ;?></td> </tr>
		 </table>
	 
 
 <br>
 <br>
 <br>
 <br>


 
  <b ><font face="Times" style="font-size: 13pt;font-family: Times">C. Praktek Kerja Lapangan</font></b> <br><br> 
  
				<!-----==========================------>
				<br>
			 <table class="tborder"    style="width: 170mm;"  cellspacing="0" border="1">
			 <tr>
				 <td style="table-layout:fixed;padding: 5px;" valign="top" align="center">No</td> 
				 <td style="table-layout:fixed;padding: 5px;width: 140px;">Mitra DU/DI</td> 
				 <td style="table-layout:fixed;width: 205px;">Lokasi</td> 
				 <td style="table-layout:fixed;">Lamanya</td> 
				 <td style="table-layout:fixed;width: 209px;">Keterangan</td>
			 </tr>
			 <?php
			 	$qpkl = $this->db->query("select * from v_pkl where id_siswa='".$idsiswa."' ");
			 	$pkl=$qpkl->result();
			 	$npkl = $qpkl->num_rows();
			 	$no=1;
			 	foreach($pkl as $pkl)
			 	{
				// $id_mitra=isset($pkl->id_mitra)?($pkl->id_mitra):"";
				 $lama=isset($pkl->lama)?($pkl->lama." Bulan"):"";
				 $ket=isset($pkl->ket)?($pkl->ket):"";
				 $mitra=$pkl->nama_mitra;//$this->m_reff->goField("tr_mitra","nama","where id='".$id_mitra."' ");
				 $lokasi=$pkl->lokasi_mitra;//$this->m_reff->goField("tr_mitra","lokasi","where id='".$id_mitra."' ");
				 $lokasi=str_replace(",",", ",$lokasi);
				 if(strlen($mitra)>5){
				     $no++;
				 }
			?>
					 <tr>
					 	<td><?php echo $no;?></td>
					 	<td style="padding: 3px;width: 140px;word-wrap: break-word" align="left" valign="middle"><?php echo $mitra;?></td>
					 	<td style="padding: 3px;width: 205px;word-wrap: break-word;text-align: left"><?php echo $lokasi;?></td>
					 	<td valign="middle"><?php echo $lama;?> </td>
					 	<td style="padding: 3px;width: 205px;word-wrap: break-word"><?php echo $ket;?></td>
					 </tr>
			<?php  }
			 
				if($no==1){
				     
				 	$qpkl = $this->db->query("select * from tm_pkl_veto where id_siswa='".$idsiswa."' ");
				 	$pkl=$qpkl->result();
				 	$npkl = $qpkl->num_rows();
				 	$no=1;
					foreach($pkl as $pkl)
					{
						// $id_mitra=isset($pkl->id_mitra)?($pkl->id_mitra):"";
						 $lama=isset($pkl->lama)?($pkl->lama." Bulan"):"";
						 $ket=isset($pkl->ket)?($pkl->ket):"";
						 $mitra=$pkl->mitra;//$this->m_reff->goField("tr_mitra","nama","where id='".$id_mitra."' ");
						 $lokasi=$pkl->lokasi;//$this->m_reff->goField("tr_mitra","lokasi","where id='".$id_mitra."' ");
						 $lokasi=str_replace(",",", ",$lokasi);
					 ?>
						 <tr>
						 	<td><?php echo $no++;?></td>
						 	<td style="padding: 3px;width: 100px;word-wrap: break-word;text-align: left"><?php echo ucwords(strtoupper($mitra));?></td>
						 	<td style="padding: 3px;width: 205px;word-wrap: break-word;text-align: left;paading:10px"><?php echo $lokasi;?></td>
						 	<td><?php echo $lama;?>  </td>
						 	<td style="padding: 3px;width: 205px;word-wrap: break-word"><?php echo $ket;?></td>
						 </tr>
					 <?php  
					}				     
				}

			?>

			<?php
				if ($npkl == 0) {
					$empty_row_pkl = "
						<tr>
							<td>".$no++."</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					";
				}
				else{
					$empty_row_pkl = "";
				}

				echo $empty_row_pkl;
			?>


				



			</table>
			<!-----==========================------>
			
			<!-----==========================------>
			<br>
			<br>
			<br>
			 <b style="font-size: 13pt;font-family: Times">D. Ekstrakulikuler</b> 	
			 <table class="tborder"  style="table-layout:fixed;width: 100%;width: 170mm;"  cellspacing="0">
			 <tr>
			 	<td style="table-layout:fixed;padding: 5px;" valign="top" align="center">No</td> 
			 	<td style="table-layout:fixed;padding: 5px;width: 200px">Kegiatan Ekstrakulikuler</td> 
			 	<td style="table-layout:fixed;padding: 5px;width: 100px">Nilai</td> 
				<td style="table-layout:fixed;padding: 5px;width: 300px">Keterangan</td>
			 </tr>
			 <?php
			 $dataEk=$this->db->query("select * from tm_ekstrakurikuler where id_siswa='".$idsiswa."' 
			 and id_tahun='".$tahun."' and id_semester='".$sms."' group by id_semester,id_tahun,id_siswa,id_ektra order by id asc")->result();
			 $no=1;
			 foreach($dataEk as $valEk)
			 {?>
			 <tr>
			 <td><?php echo $no++;?></td>
			  <td align="left" style="table-layout:fixed;padding: 5px;word-wrap: break-word;"><?php echo  $this->m_reff->goField("tr_ektrakurikuler","nama","where id='".$valEk->id_ektra."'")?></td>
			 <?php  
			 	switch ($valEk->nilai) {
					case 'A':
						$label_nilai = "SANGAT BAIK";	
					break;
					case 'B':
						$label_nilai = "BAIK";	
					break;
					case 'C':
						$label_nilai = "CUKUP";	
					break;
					case 'D':
						$label_nilai = "KURANG";	
					break;

					
					default:
						$label_nilai = "Unknown";
					break;
				}
			 ?>	
			 <td align="center" style="table-layout:fixed;padding: 5px;"><?php echo $label_nilai	 ?></td> 
			 <td align="left" style="table-layout:fixed;padding: 5px;word-wrap: break-word;"><?php echo $valEk->ket; ?></td> 
			 </tr>
			 <?php } ?>
			 
			 <?php
			 if($no==1){ ?>
			  <tr>
			 <td><?php echo $no++;?></td>
			 <td></td>
			 <td></td>
			  <td></td>
			 </tr>
			 <?php } ?>
			</table>
			<!-----==========================------>
			<!-----==========================------>
			 
			 
			 
			<!-----==========================------>
				<br>
				<br>
				<br>
			 <b style="font-size: 13pt;font-family: Times">E. Ketidakhadiran</b> <br><br> 	
			  
			 <?php 
			 $abjad="F";
			 $kh=$this->db->query("SELECT * from tm_kh where  id_siswa='".$idsiswa."' 
			 and id_tahun='".$tahun."' and id_semester='".$sms."' ")->row();
			 ?>
		 
			<table class="tborder"  style="table-layout:fixed;width: 50%;"  cellspacing="0">
				 <tr>
				 <td align="left" style="padding: 5px;">&nbsp;&nbsp;&nbsp;Sakit&nbsp;&nbsp;&nbsp;</td>
				 <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td  align="left" style="table-layout:fixed;width: 200px;">&nbsp;&nbsp;&nbsp;<?php echo isset($kh->sakit)?($kh->sakit):"-";?> hari</td>
				 </tr><tr>
				 <td  align="left" style="padding: 5px;">&nbsp;&nbsp;&nbsp;Izin&nbsp;&nbsp;&nbsp;</td>
				 <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td  align="left">&nbsp;&nbsp;&nbsp;<?php echo isset($kh->izin)?($kh->izin):"-";?> hari</td>
				 </tr><tr>
				 <td style="padding: 5px;">&nbsp;&nbsp;&nbsp;Tanpa Keterangan&nbsp;&nbsp;&nbsp;</td>
				 <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td  align="left">&nbsp;&nbsp;&nbsp;<?php echo isset($kh->alfa)?($kh->alfa):"-";?> hari</td>
				 </tr>
				 </table>
				 <br>
				 <br>
				 <br>
	
				 
 	   
 
 			  <?php
 $idtk=$this->input->get('id_tk');
 $idtknew=$idtk+1;
 if($this->input->get("id_semester")==2 and $this->input->get('id_tk')!=3 and !$this->input->get('gagal')  ){?>
 
 
 	<b style="font-size: 13pt;font-family: Times"><?php echo $abjad++;?>. kenaikan Kelas</b><br> 
   <div  style="border: solid 0.5px black;width: 95%;padding:10px">
   
 Naik / <span class='strike'> Tidak Naik </span>  Ke Kelas 
 <?php echo $this->m_reff->goField('tr_tingkat','nama','where id="'.$idtknew.'" ')." - ". ucwords(strtolower($this->m_reff->goField("tr_jurusan","nama","where id='".$data->id_jurusan."'"))); ?>
 <br>
 </div>	
  
 <?php }?>
 
 
  <table  style="table-layout:fixed;width: 100%;">
			 <tr>
			 <td style="table-layout:fixed;width: 50%;" align="center">
			 <!-------------------------->
			 <p align="center" style="z-index:-9" >
			 <b> Mengetahui<br>
			  Orang Tua/Wali,</b>
			  <br>
			  <br>
			  <br>
			  <br>
			  <br>
			  ____________________
			  </p>
			<!-------------------------->	 
			 </td>
			 
			 
			 <td style="table-layout:fixed;width: 50%;">
			 
			 <!-------------------------->
			 <p align="center"  >
			 <b> Subang,    <?php echo $this->mdl->titiMangsaRapot($sms);?> <br>
			  Wali Kelas,</b>
			  <br>
			  <br>
			  <br>
			  <br>
			  <br>
			  <B><u><?php echo $this->mdl->nama_wali_kelas($idsiswa,$tingkat);?></u></B><br>

			  <?php
			  	
			  	if ($this->mdl->nip_wali_kelas($idsiswa,$tingkat)!="-") {
			  		$nip_w = $this->mdl->nip_wali_kelas($idsiswa,$tingkat);
			  	}
			  	else{
			  		$nip_w = "-<font style='color:white'>19600713 198403 1 0</font>";
			  	}
			  ?>

			  <span style="">NIP. <?php echo $nip_w ?></span>
			 
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
			  	
			<?php
	   		if ($tingkat != "1") {
	   			
		   		
		   	?>
		   		<img src="<?php echo base_url();?>file_upload/dok/<?php echo $this->mdl->ttd_kepsek($tahun)?>" style="width:53mm;height:15mm;">
			<?php }
				else{


			?>
			<br>
			<br>
			<br>
			<?php } ?> 
			 	<br>
			 	<br>
			  
			  <b><u><?php echo $this->mdl->nama_kepsek($tahun)?></u></b><br>
			   NIP. <?php echo $this->mdl->nip_kepsek($tahun);?>
			  </p>
			<!-------------------------->	
			 
			 
			 </td>
			  </tr>
			 </table>

</page>
 

 
 
 
<page   format="210x320" style='font-size:11px' backtop="7mm" backbottom="7mm" backleft="12mm" backright="10mm">
 
 <br>
  <b id="font-times"><font face="Times" style="font-size: 13pt;font-family: Times"><?php echo $abjad++;?>. Deskripsi Perkembangan Karakter</font></b> 
  	<style>
				    .pades{
				        padding-left:15px;
				         padding-right:15px;
				    }
				</style>
				<!-----==========================------>
				<?php
				 $desc=$this->db->query("select * from tm_desc_karakter where id_tahun='".$tahun."' and id_semester='".$sms."' and id_siswa='".$data->id."'  ")->row();
		        $desc1=isset($desc->desc1)?($desc->desc1):"";
		        $desc2=isset($desc->desc2)?($desc->desc2):"";
		        $desc3=isset($desc->desc3)?($desc->desc3):"";
		        $desc4=isset($desc->desc4)?($desc->desc4):"";
		        $desc5=isset($desc->desc5)?($desc->desc5):"";
		        ?>
				<br>
				<br>
			 <table class="tborder"  style="table-layout:fixed;"  cellspacing="0">
				 <tr>
				 	<td style="padding: 5px"><b>Karakter yang dibangun</b></td> 
				 	<td style='width:420px;padding: 5px'><b>Deskripsi</b></td> 
				 </tr>
			 
				 <tr>
					 <td  style="padding: 5px">&nbsp;&nbsp;Integritas</td> 
					 <td  class="pades"style='width:420px;table-layout:fixed;word-wrap: break-word;text-align: left;'> <?php echo trim($desc1); ?> </td>
		 		 </tr>
		 		 
		 		 <tr>
					 <td  style="padding: 5px">&nbsp;&nbsp;Religius</td> 
					 <td  class="pades" style='width:420px;table-layout:fixed;word-wrap: break-word;text-align: left;'> <?php echo trim($desc2); ?> </td>
		 		 </tr>
		 		 
		 		 <tr>
					<td  style="padding: 5px">&nbsp;&nbsp;Nasionalis</td> 
				 	<td class="pades" style='width:420px;table-layout:fixed;word-wrap: break-word;text-align: left;'> <?php echo trim($desc3); ?>  </td>
		 		 </tr>
		 		 
		 		  <tr>
				 	<td  style="padding: 5px">&nbsp;&nbsp;Mandiri</td> 
				 	<td class="pades" style='width:420px;table-layout:fixed;word-wrap: break-word;text-align: left;'> <?php echo trim($desc4); ?>  </td>
		 		 </tr>
		 		 
		 		  <tr>
				 	<td  style="padding: 5px"	>&nbsp;&nbsp;Gotong-royong</td> 
				 	<td class="pades" style='width:420px;table-layout:fixed;word-wrap: break-word;text-align: left;'> <?php echo trim($desc5); ?>  </td>
		 		 </tr>
			</table>
			<!-----==========================------>
			
			 <br>
			 <br>
			 <br>
<b style="font-size: 13pt;font-family: Times"><?php echo $abjad++;?>. Catatan Perkembangan Karakter</b><br> <br>
  <table>
    <tr >
        <td valign="middle" class='mide'>
           <?php $datacat=$this->db->query("select * from tm_catatan_karakter where id_semester='".$sms."' and id_tahun='".$tahun."' and id_siswa='".$data->id."'")->row();
 echo isset($datacat->ket)?($datacat->ket):"-";?> 
        </td>
    </tr>
</table>			     
<br>
<br>			    
<br>
<br>	
<br>
<br>
				
  <table  style="table-layout:fixed;width: 100%;">
			 <tr>
			 <td style="table-layout:fixed;width: 50%;" align="center">
			 <!-------------------------->
			 <p align="center" style="z-index:-9" >
			 <b> Mengetahui<br>
			  Orang Tua/Wali,</b>
			  <br>
			  <br>
			  <br>
			  <br>
			  <br>
			  ____________________ 
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
			  <B><u><?php echo $this->mdl->nama_wali_kelas($idsiswa,$tingkat);?></u></B><br>
			  NIP. <?php echo $nip_w?>
			 
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
			  	
			    <?php
	   				if ($tingkat != "1") {
	   			
	   		
			   	?>
			   		<img src="<?php echo base_url();?>file_upload/dok/<?php echo $this->mdl->ttd_kepsek($tahun)?>" style="width:53mm;height:15mm;">
				<?php }
					else{


				?>
				<br>
				<br>
				<br>
				<?php } ?> 
	  
			  <br>
			  <br>
			  
			  
			  <b><u><?php echo $this->mdl->nama_kepsek($tahun)?></u></b><br>
			   NIP. <?php echo $this->mdl->nip_kepsek($tahun);?>
			  </p>
			<!-------------------------->	
			 
			 
			 </td>
			  </tr>
			 </table>    
				    
</page>
 
 