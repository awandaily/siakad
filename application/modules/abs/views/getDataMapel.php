<?php
 
								$namaHari=$this->tanggal->namaHari($tgl);
							    $kohar=$this->tanggal->kodeHari($namaHari);
								
								$profile=$this->mdl->profile();
								$idkelas=$profile->id_kelas;
								
								if($tgl<=$this->m_reff->tgl_pergantian())
								{
								echo " <center ><b> Maaf, Riwayat Belajar Tidak Dapat Di Akses.<br> Riwayat Belajar Hanya Tersedia Untuk Tahun Ajaran Saat Ini.</b><hr></center> ";
									exit;
								}
								
							    $no=1; $dataMapel=$this->mdl->dataMapel($kohar,$idkelas); $stop="";
							    if(!count($dataMapel))
							   {
								   echo "<tr><td colspan='5' class='col-teal'><center><b>Data tidak tersedia...</b></center></td></tr>";
							   exit;
							   }
?>
<table class="entry" width="100%">
							  <tr>
							  <th>#</th><th>MATA PELAJARAN </th><th>STATUS</th> <th>PENGAJAR</th> 
							  </tr>
							   <?php
							   
							   foreach($dataMapel as $data)
							   {
							    	
								 $id_kelas=$data->id_kelas;
								 
								 $kelas=$this->m_reff->goField("v_kelas","nama","where id='".$data->id_kelas."'");
								 $guru=$this->m_reff->goField("data_pegawai","nama","where id='".$data->id_guru."'");
								  
								 $sts=$this->mdl->stsAbsenMapel($noid,$tgl,$data->jam_masuk,$data->jam_keluar,$id_kelas,$data->id_mapel);
								// $jml_siswa=$this->mdl->jmlSiswaHadir($tgl,$data->jam_masuk,$data->jam_keluar,$id_kelas,$data->id_mapel);
								 $persentase=$this->mdl->persentaseAbsenMapel($tgl,$data->jam_masuk,$data->jam_keluar,$id_kelas,$data->id_mapel);
								 if(isset($sts))
								 {
									 $sts="<span  data-original-title='jam absen'  data-toggle='tooltip' data-placement='bottom' >
									 Masuk (".substr($sts->tgl,11,8).") </span>";
								 }else{
									 $sts="<i class='col-red'>Tidak masuk</i>";
								 }
								 
								 echo "<tr ><td>".$no++."</td>
												 <td>".$this->m_reff->goField("tr_mapel","nama","where id='".$data->id_mapel."'")."</td>
												 
												 <td>".$sts."</td>
												 <td>".$guru."</td>
												 
												 ";
												 
												 
							   }
							   
							  
							   ?>
							  </table>
 <script>
 
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
	
	function getSiswaxx(tgl,masuk,keluar,kelas,mapel)
  {
	$("#modalSiswa").modal("show");  
	$("#isiSiswa").html("<img src='<?php echo base_url()?>plug/img/load.gif'/> Mohon Tunggu...");	
    $.ajax({
	 url:link+"absensi/getDataMapel",
     data:"noid="+noid+"&tgl="+tgl+"&kohar="+kohar,
	 method:"POST",
     success: function(data)
            {
				 $("#isiSiswa").html(data);		
				 
            }
    });   
  }
</script>


<!-- Modal -->
<div class="modal fade" id="modalSiswa" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                 Data Kehadiran Siswa
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body" id="isiSiswa">
                 
            </div>
            
            <!-- Modal Footer -->
            
        </div>
    </div>
</div>					