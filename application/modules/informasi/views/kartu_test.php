 <style type="text/css">
<!--
table
{
    padding: 0;
    font-size: 12pt;
    background: #FFFFFF;
  
}
 
-->
</style>
<page width="10mm">
<table style=" border: 1px solid #555555;">
<tr>
<td>
<table border="1"  >
 <tr><td colspan="2" align="left">
	<img class="img" src="<?php echo base_url()?>plug/img/logonew.png" style="height: 50px; border: solid 2px blue;" alt="logo">
		 
  </td></tr>
	<tr>
		<td align="center" rowspan="3"   >
		 <br> 
			<img   src="<?php echo $poto;?>" style="width: 100px;height:120px;border: 19px solid #555555;" alt="logo">
			<br>  	 
	 <barcode dimension="1D" type="EAN13" value="<?php echo $reg;?>"  
	 style="bottom:0px;max-width:15mm; height:7mm; color: black;font-size:1px"  ></barcode><br>
	<span align="center"> <b> No.Test:  <?php echo $reg;?> </b>  </span>
                 
                   
                
		</td>
</tr>
    
    
<tr>
    <td>
                <table   >
                 
                   <tr>  <td>Nama </td> <td>:</td>  <td> <?php echo $nama;?> </td></tr>
				   <tr>  <td>Gender </td> <td>:</td>  <td> <?php echo $gender;?> </td></tr>
                   <tr>  <td>T.T.L </td> <td>:</td>  <td> <?php echo $tempat_lahir;?>, <?php echo $tgl_lahir;?> </td></tr>
                   <tr>  <td>Alamat </td> <td>:</td>  <td> <?php echo $alamat;?> </td></tr>
                   
                    <tr>  <td>Peminatan </td> <td>:</td>  <td> <?php echo $peminatan;?> </td></tr>
                   <tr>  <td>Posisi </td> <td>:</td>  <td> <?php echo $posisi;?> </td></tr>
                     
                </table>
    </td>
</tr>

<tr>
    <td>
                <table>    
                   <tr>  <td valign="top"> Lokasi Test </td> <td valign="top">:</td>  <td> <?php echo $lokasi_test;?></td></tr>
                   <tr>  <td valign="top">Tanggal Test </td> <td valign="top">:</td>  <td valign="top"> <?php echo $tgl_test;?> </td></tr>
                   <tr>  <td valign="top">Waktu Test </td> <td valign="top">:</td>  <td valign="top"> <?php echo $jam_test;?></td></tr>                 
                </table>
				
				 
    
    </td>
    
       
    
</tr>

 
</table>
</td>
</tr>
</table>
   </page>
 
