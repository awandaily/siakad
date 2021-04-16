<?php
$id_siswa=$this->input->get_post("id_siswa");
$tbl="";$no=1;$total="";
$data=$this->db->query("select * from keu_tm_bayar where id_siswa='".$id_siswa."' order by tgl_bayar asc")->result();
foreach($data as $val)
{
 $total+=$val->nominal_bayar;
$tbl.="<tr>
<td>".$no++."</td>
<td>".$val->id_tagihan."</td>
<td>".$this->m_reff->goField("keu_tagihan_pokok","nama_tagihan","where id_tagihan='".$val->id_tagihan."' ")."</td>
 
<td><input onchange='setTmBayar(`".$val->id."`,`".$val->id_siswa."`,this.value)' type='text' value='".$val->nominal_bayar."' id='".$val->id."' style='width:100px'></td>
<td><input class='maskTgl' onchange='setTglTmBayar(`".$val->id."`,`".$val->id_siswa."`,this.value)' type='text' value='".$this->tanggal->ind($val->tgl_bayar,"-")."' id='".$val->id."' style='width:80px'></td> 
<td><button class='col-red' onclick='hapus_bayar(`".$val->id."`,`".$val->id_siswa."`,`$val->tgl_bayar`)'>HAPUS</a></td>
</tr>";
}
?>


<table class='entry'>
    <tr class='bg-teal col-white font-bold'>
        <td>NO</td>
        <td>KODE</td>
        <td>NAMA TAGIHAN</td>
        
        <td>JUMLAH TAGIHAN</td>
        <td>TGL BAYAR</td>
         <td>HAPUS</td>
    </tr>
    <?php
    echo $tbl;
    ?>
    <tr class='bg-grey'><td colspan='3'>TOTAL</td><td colspan='3'><?php echo number_format($total,0,",",".");?></td></tr>
</table>
<script>
    $(".maskTgl").inputmask("99-99-9999");  
</script>