<style>
	.kop{
width:100%;
padding-bottom:10px;
	}	
	.be{
margin-left:450px;
}
</style>
<?php
$id=$this->input->get("id");
    $dp=$this->m_reff->dataProfileSiswa($id); 
    
    $tahun=$dp->id_tahun_3;
    $idkelas=$dp->id_kelas;
$pub=$this->m_reff->pengaturan(18);
$id_tk=$this->m_reff->goField("tm_kelas","id_tk","where id='".$idkelas."'");
//$id_jurusan=$this->m_reff->goField("tr_jurusan","nama","where id='".$id_jurusan."'");
$kompetensi=$this->m_reff->goField("v_kelas","alias","where id='".$idkelas."'");
  $Program=$this->m_reff->goField("v_kelas","program","where id='".$idkelas."'");
if($id_tk==3 and $pub==1 ){
   
                       if($dp->sts_un==1){?>
                     <!---  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--->
                       
                       
                       <img src="<?php echo base_url()?>file_upload/img/<?php echo $this->m_reff->pengaturan(11)?>" class="kop">
                        <p align="center">
                      <b> SURAT KETERANGAN  </b><br>
Nomor: <?php echo $this->mdl->no_surat($id,$tahun)?><br><br>
 </p>
   
 
<p align="justify"  >
    
    &nbsp;&nbsp;&nbsp;&nbsp;Mempertimbangkan  Peraturan Menteri Pendidikan Nasional Nomor 23 Tahun 2006 Tentang Standar Kompetensi Kelulusan (SKL),
    Peraturan Menteri Pendidikan dan Kebudayaan Nomor 54 Tahun 2013 Tentang Standar kompetensi Lulusan Pendidikan Dasar dan Menengah.
    
<br>
    
    &nbsp;&nbsp;&nbsp;&nbsp;Berdasarkan hasil rapat Dewan Guru <?php echo $this->m_reff->tm_pengaturan(7);?>
    pada tanggal 09 Mei 2019, Kepala <?php echo $this->m_reff->tm_pengaturan(7);?> Kabupaten Subang, dengan ini menerangkan bahwa :
    
</p>
<p align="left">
 
<table>
    <tr>
        <td>Nama</td><td> : <?php echo $dp->nama;?></td>
    </tr>
     <tr>
        <td>TTL</td><td> : <?php echo $dp->tempat_lahir;?>, <?php echo $this->tanggal->ind($dp->tgl_lahir,"/");?></td>
    </tr>
     <tr>
        <td>NIS</td><td>  : <?php echo $dp->nis;?></td>
    </tr>
      
 <tr>
        <td>No.Pes Ujian Nasional</td><td>  : <?php echo $dp->no_un;?></td>
    </tr>
<tr>
        <td  >Program Keahlian </td><td> :  <?php echo $Program;?></td>
    </tr>
</table>

</p>

<p align="justify">
    Dinyatakan<b><i><u> LULUS UJIAN AKHIR NASIONAL</u></i></b> tahun 2019 pada SMK Negeri 1 Pusakanagara. 
  <br>
   Ijazah sedang dalam proses, diperkirakan akan keluar pada pertengahan bulan Agustus 2019.
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian surat keterangan ini dibuat dengan sesungguhnya untuk dipergunakan sebagaimana mestinya.</p><br>

 <div align="center" class="be">
<?php echo $this->mdl->tgl_surat($tahun)?> <br>
Kepala sekolah,<br>
 
 
			     <img src="<?php echo base_url();?>file_upload/dok/<?php echo $this->mdl->ttd_kepsek($tahun)?>" 
		style="width:53mm;height:15mm;font-size:11px;text-align:center;margin-left:-20px;margin-top:10px"> 
	  
			  

<b><u><?php echo $this->mdl->nama_kepsek($tahun)?></u></b><br>
<b>Pembina Tk. I IV/b</b><br>
NIP. 19640620 198803 1 007
</div>


                        
                       
                       
                       
                       
    <!---  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--->
                                            
                       <?php }elseif($dp->sts_un==2){
                             echo "<h4>MOHON MAAF ANDA DINYATAKAN TIDAK LULUS</h4>";
                       }else{
                            echo $dp->ket_un;
                       }
                      
}else{
    echo "Data tidak tersedia";
}
?>