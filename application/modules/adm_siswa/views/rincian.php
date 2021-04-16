<?php 
$id_siswa=$this->m_reff->id_siswa_ortu(); 
$now=date("Y-m-d");
$db=$this->db->query("SELECT * FROM keu_tagihan_pokok where id_siswa='".$id_siswa."' and tgl_tagihan<='".$now."' and (tagihan>bayar or bayar is null) ");		



 $nama= strtolower($this->m_reff->goField("data_siswa","nama","where id='".$id_siswa."'"));
 $nis= strtolower($this->m_reff->goField("data_siswa","nis","where id='".$id_siswa."'"));
 $alumni= strtolower($this->m_reff->goField("data_siswa","id_tahun_keluar","where id='".$id_siswa."'"));
 $nama=ucwords($nama);
 $kelas=strtolower($this->m_reff->goField("v_siswa","nama_kelas","where id='".$id_siswa."'"));
 $kelas=ucwords($kelas);
?>

 
 
 
 
 
 <div class="row clearfix"  >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" >
   <div class="body" id="area_formbayar">

<p align="center"><b>RINCIAN TAGIHAN</b></p>
<div class="table-responsive">
<div class="table-responsive">
 <table class='entry' id="table" border="0"  cellspacing="0" width="100%" >
 <tr class='bg-teal'>
 <td align="center"><b>No</b></td>
 <td align="center"  ><b>Biaya</b></td>
 <td align="center"  style="table-layout:fixed;min-width:140px;" ><b>Jumlah Tagihan</b></td>
 <td align="center" style="table-layout:fixed;min-width:140px;" ><b>Telah Dibayar</b></td>
 <td align="center" style="table-layout:fixed;min-width:140px;" ><b>Sisa Tagihan</b></td>
 </tr>
 <?php
 $data=$db->result();$n=1;$telahBayar=0;$jumlahTagihan=0;$stsTagihan=0;
 foreach($data as $val)
 {
	 if($val->jenis_tagihan==2)
	 {
		 $nama=$val->satuan;
	 }else{
		$nama=$this->m_reff->namaBiaya($val->id_tagihan);
	 }
	 $sisa=$val->tagihan-$val->bayar;
	 $telahBayar+=$val->bayar;
	 $jumlahTagihan+=$val->tagihan;
	 $stsTagihan+=$sisa;
	 echo "<tr>
	 <td>".$n++."</td>
	 <td>".$nama."</td>
	 <td>Rp ".number_format($val->tagihan,0,",",".")."</td>
	 <td>Rp ".number_format($val->bayar,0,",",".")."</td>
	 <td>Rp ".number_format($sisa,0,",",".")."</td>
	  
	 </tr>";
 }
 ?>
 <tr>
 <td colspan="2" align="center"><b>TOTAL</b></td>
 <td><b>Rp <?php echo number_format($jumlahTagihan,0,",",".");?></b></td>
 <td><b>Rp <?php echo number_format($telahBayar,0,",",".");?></b></td>
 <td><b>Rp <?php echo number_format($this->mdl->stsTagihan(0,$id_siswa),0,",",".");?></b></td>
 
 </tr>
 </table> 
 
 </div>
 </div>
 </div>
 </div>
 
			 
 
 
