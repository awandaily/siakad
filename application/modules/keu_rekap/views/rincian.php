<?php 
$id_siswa=$this->input->get("id");


$db=$this->db->query("SELECT * FROM keu_tagihan_pokok where id_siswa='".$id_siswa."' GROUP BY id_tagihan");		



 $nama= strtolower($this->m_reff->goField("data_siswa","nama","where id='".$id_siswa."'"));
 $nis= strtolower($this->m_reff->goField("data_siswa","nis","where id='".$id_siswa."'"));
 $alumni= strtolower($this->m_reff->goField("data_siswa","id_tahun_keluar","where id='".$id_siswa."'"));
 $nama=ucwords($nama);
 $kelas=strtolower($this->m_reff->goField("v_siswa","nama_kelas","where id='".$id_siswa."'"));
 $kelas=ucwords($kelas);
?>

<style type="text/css">
.table{
margin-top:10px;
width:100%;

}
.table tr td
{
    padding: 2;
  
    background: #FFFFFF;
	font-family:arial;
	border-bottom:black solid 0.2px;
	font-size:11px;
	font-weight:bold;
  
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
               .tborder td,.tborder  th{word-wrap:break-word;word-break: break-all;border: 1px solid #000;padding:2px;font-size:10px;text-align:center}
			   
			   
                .thadir{border-collapse: collapse; word-wrap:break-word; word-break: break-all;table-layout: fixed;width: 100mm;font-size:11px;}
               .thadir td,.thadir  th{word-wrap:break-word;word-break: break-all; padding:2px;font-size:10px;text-align:center}
			   
			   
	.kop{
width:100%;
padding-bottom:10px;
	}	
	
#table{
width:100%;
font-size:11px;
 
}	
#table tr td{
border-bottom:black solid  0.2px ;
}
.bendahara{
margin-left:600px;
}
.garis{
	padding-bottom:10px;
border-bottom:black dashed 0.5px;
}
           </style>
<page style='font-size:11px'>
<div   >
<img src='<?php echo base_url()?>file_upload/img/<?php echo $this->m_reff->tm_pengaturan(12);?>' class='kop'> 
 
 <table      border="0"  cellspacing="0" class='table'>

 <tr>
 <td align="left" style="table-layout:fixed;width: 50%;"> NAMA </td>
 <td style="table-layout:fixed;width: 50%;"> : <?php echo $nama;?>  / NIS.<?php echo $nis;?>  </td>
 </tr>
<?php
if($alumni){?>
 <tr>
 <td align="left"  > TAHUN KELUAR/LULUS </td>
 <td> :   <?php echo $this->m_reff->goField("tr_tahun_ajaran","nama","where id='".$alumni."'");?></td>
 </tr>
<?php }else{?>
 <tr>
 <td align="left"  > KELAS </td>
 <td> :   <?php echo $kelas;?></td>
 </tr>
<?php } ?>


 <tr>
 <td align="left" > TOTAL TUNGGAKAN </td>
 <td>: <i> Rp  <?php echo number_format($this->mdl->stsTagihan(0,$id_siswa),0,",",".");?></i></td>
 </tr> 
</table>



<p align="center"><b>RINCIAN TAGIHAN</b></p>
 <table  id="table" border="0"  cellspacing="0"  >
 <tr>
 <td align="left" style="table-layout:fixed;width:20px;"><b>No</b></td>
 <td align="left" style="table-layout:fixed;width: 30%;"><b>Biaya</b></td>
 <td align="left" style="table-layout:fixed;width: 25%;"><b>Jumlah Tagihan</b></td>
 <td align="left" style="table-layout:fixed;width: 20%;"><b>Telah Dibayar</b></td>
 <td align="left" style="table-layout:fixed;width: 21%;"><b>Sisa Tagihan</b></td>
 </tr>
 <?php
 $data=$db->result();$n=1;
 foreach($data as $val)
 {
	 echo "<tr>
	 <td>".$n++."</td>
	 <td>".$this->mdl->namaBiaya($val->id_tagihan)."</td>
	 <td>Rp &nbsp;&nbsp;&nbsp;".number_format($this->mdl->jumlahTagihan($val->id_tagihan,$id_siswa),0,",",".")."</td>
	 <td>Rp &nbsp;&nbsp;&nbsp;".number_format($this->mdl->telahBayar($val->id_tagihan,$id_siswa),0,",",".")."</td>
	 <td>Rp &nbsp;&nbsp;&nbsp;".number_format($this->mdl->stsTagihan($val->id_tagihan,$id_siswa),0,",",".")."</td>
	  
	 </tr>";
 }
 ?>
 <tr>
 <td colspan="2" align="center"><b>TOTAL</b></td>
 <td><b>Rp &nbsp;&nbsp;&nbsp;<?php echo number_format($this->mdl->jumlahTagihan(0,$id_siswa),0,",",".");?></b></td>
 <td><b>Rp &nbsp;&nbsp;&nbsp;<?php echo number_format($this->mdl->telahBayar(0,$id_siswa),0,",",".");?></b></td>
 <td><b>Rp &nbsp;&nbsp;&nbsp;<?php echo number_format($this->mdl->stsTagihan(0,$id_siswa),0,",",".");?></b></td>
 
 </tr>
 </table><br>
 <p align='right'>
 Tgl Cetak : <?php echo $this->tanggal->hariLengkap(date('Y-m-d'),"/")." ".date("H:i:s");?> WIB
 </p>
 </div>
			 
</page>
 
