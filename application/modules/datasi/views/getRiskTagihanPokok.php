<?php
$id_siswa=$this->input->get_post("id_siswa");
$tbl="";$no=1;$total="";
$data=$this->db->query("select * from keu_tagihan_pokok where id_siswa='".$id_siswa."' order by tgl_bayar desc")->result();
foreach($data as $val)
{
     $total+=$val->bayar;
$tbl.="<tr>
<td>".$no++."</td>
<td>".$val->id_tagihan."</td>
<td>".$val->satuan."</td>
<td>".$val->tagihan."</td>
<td><input onchange='setTagihanPokok(`".$val->id."`,`".$val->id_siswa."`,this.value)' type='text' value='".$val->bayar."' id='".$val->id."' style='width:100px'></td>
<td><input class='maskTgl' onchange='setTglTagihanPokok(`".$val->id."`,`".$val->id_siswa."`,this.value)' type='text' value='".$this->tanggal->ind($val->tgl_bayar,"-")."' id='".$val->id."' style='width:100px'></td> 
</tr>";
}
?>


<table class='entry'>
    <tr class='bg-teal col-white'>
        <td>NO</td>
        <td>KODE</td>
        <td>NAMA TAGIHAN</td>
        
        <td>JUMLAH TAGIHAN</td>
        <td>JUMLAH BAYAR</td>
         <td>TGL TERAKHIR BAYAR</td>
    </tr>
    <?php
    echo $tbl;
    ?>
    <tr class='bg-grey'><td colspan='4'>TOTAL</td><td colspan='3'><?php echo number_format($total,0,",",".");?></td></tr>
</table>
<script>
    $(".maskTgl").inputmask("99-99-9999");  
</script>