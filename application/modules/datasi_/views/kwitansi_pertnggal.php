<?php 
$id_siswa=$this->input->get("id_siswa");
$tgl=$this->input->get("tgl");

$db=$this->db->query("select * from keu_tm_bayar where tgl_bayar='".$tgl."' and id_siswa='".$id_siswa."'  order by id_tagihan asc");
if(!$db->row()){ echo "Tidak ada data" ;return false; }
$uang=$this->db->query("select sum(nominal_bayar) as bayar from keu_tm_bayar where tgl_bayar='".$tgl."' and id_siswa='".$id_siswa."' ")->row();
$uang=$uang->bayar;
 $nama= strtolower($this->m_reff->goField("data_siswa","nama","where id='".$id_siswa."'"));
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
<div   class='garis'>
<img src='<?php echo base_url()?>file_upload/img/<?php echo $this->m_reff->tm_pengaturan(12);?>'  class='kop'> 
 
 <table      border="0"  cellspacing="0" class='table'>
 <tr>
 <td align="left" style="table-layout:fixed;width: 50%;"> Kode Transaksi </td>
 <td align="left" style="table-layout:fixed;width: 50%;"> : <i><?php echo $db->row()->code;?></i></td>
 </tr>
 <tr>
 <td align="left" style="table-layout:fixed;width: 50%;"> Sudah terima dari </td>
 <td> : <?php echo $nama;?>  </td>
 </tr> <tr>
 <td align="left" style="table-layout:fixed;width: 50%;"> Kelas </td>
 <td> :   <?php echo $kelas;?></td>
 </tr>
 <tr>
 <td align="left" style="table-layout:fixed;width: 50%;"> Banyaknya uang </td>
 <td>: <i> Rp <?php echo number_format($uang,0,",",".")." <br>( ".ucwords($this->umum->terbilang($uang))." Rupiah ) "?> </i></td>
 </tr> 
</table>



<p align="center"><b>RINCIAN PEMBAYARAN</b></p>
 <table  id="table" border="0"  cellspacing="0"  >
 <tr>
 <td align="left" style="table-layout:fixed;width:20px;"><b>No</b></td>
 <td align="left" style="table-layout:fixed;width: 15%;"><b>Tanggal bayar</b></td>
 <td align="left" style="table-layout:fixed;width: 25%;"><b>Biaya</b></td>
 <td align="left" style="table-layout:fixed;width: 20%;"><b>Jumlah Pembayaran</b></td>
 <td align="left" style="table-layout:fixed;width: 30%;"><b>Periode Pembayaran</b></td>
 </tr>
 <?php
 $data=$db->result();$n=1;
 foreach($data as $val)
 {
	 echo "<tr>
	 <td>".$n++."</td>
	 <td >".$this->tanggal->hariLengkap($val->tgl_bayar,"/")."</td>
	 <td >".$this->mdl->namaBiaya($val->id_tagihan)."</td>
	 <td>Rp ".number_format($val->nominal_bayar,0,",",".")."</td>
	 <td style='table-layout:fixed;width:235px;'>".$this->mdl->periode_desc($val->id_tagihan,$val->periode_spp)."</td>
	 </tr>";
 }
 ?>
 </table>
 <p>
 <div align="center" class="bendahara">
 <b>Subang, <?php echo $this->tanggal->ind(date('Y-m-d'),"/");?></b><br>
 <b> BENDAHARA</b><br>
 <br>
 <br>
 <br>
 <br>

<b>( <?php echo $this->m_reff->goField("admin","owner","where id_admin='".$this->mdl->idu()."'");?> ) </b><br>
 </div>
 
 </p>
 </div>
			 
</page>
 
