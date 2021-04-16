

<?php
$no=1;
 $nis=$this->input->get_post("nis");
 $nis=trim($nis);
    $get=$this->db->query("select * from data_siswa where nis='".$nis."' ")->row();
    if(!isset($get))
    {
        echo "<center><b>Data SISWA tidak ditemukan<b></center><br>";
        return false;
    }
    $kelas=$this->m_reff->goField("v_kelas","nama","where id='".$get->id_kelas."'");
    
    
    $val=$this->db->query("select * from v_risk where id_siswa='".$get->id."' ")->row();
     if(!isset($val))
    {
        echo "<center><b>Siswa belum pernah melakukan pembayaran sama sekali<b></center><br>";
        return false;
    }
    
 echo "<table class='entry' width='100%'>
<tr class='bg-teal'>
<td>NO</td>
<td>NIS</td>
<td>NAMA</td>
<td>KELAS</td>
<td>AKUMULASI</td>
<td>RINCIAN</td>
</tr><tr>
 <td>".$no++."</td>
  <td>".$get->nis."</td>
  <td>".$get->nama."</td>
  <td>".$kelas."</td>
  <td> <button onclick='tagihan_pokok(".$val->id_siswa.",`".$get->nama."`)'>".$val->nominal_pokok."</button></td>
  <td>  <button onclick='tagihan_bayar(".$val->id_siswa.",`".$get->nama."`)'>".$val->nominal_bayar." </button></td>
 </tr>";   
 
 

?>
</table>
