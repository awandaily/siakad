
	
<?php 
 	$tgl  = $_POST["tgl"];
	$hari = date("N", strtotime($tgl));
     
?>
	<center>	
		<b>JAM KE <?php  echo $jamkenow=$jam=$_POST["jam"]?></b> 
	</center>
		<div class="entry">
	    <div class="table-responsive">
		<table class='table-hover'>
		<thead>
		<th>NO</th>
		<th>PENGAJAR <?php echo $hari ?></th>
		<th>KELAS</th>
		<th>MAPEL</th>
		<th width='200px'>STATUS</th>
		</thead>
		<?php
		$no=1;
		$this->db->where("sts_kelas",1);
		$data=$this->db->get("v_kelas")->result();
		foreach($data as $val)
		{
		    $get=$this->mdl->getkbmnow($val->id,$jam, $hari);
            $idkelas=isset($val->id)?($val->id):"";
			$idguru=isset($get->id_guru)?($get->id_guru):"";
			$idmapel=isset($get->id_mapel)?($get->id_mapel):"";
			$idJadwal=isset($get->id)?($get->id):"";

			$cek=$this->mdl->cekKehadiranGuru_new($idkelas,$idmapel,$idguru, $tgl);
			$cekoff=$this->mdl->cekDiliburkan_new($idkelas,$idmapel,$idguru, $tgl);
			$cekizinharian=$this->mdl->cekIzinHarian($idguru, $tgl);
			if($cek){ 
						 
						$jam_blok=$cek->jam_blok;
					 
						if(strpos($jam_blok,",".$jamkenow.",")===false)
						{
						     if($cek->sumber==1){
						        $masukket="MASUK";$warnamasuk="badge bg-teal sadow";$alasanizin="";
						    }elseif($cek->sumber==2){
						        $masukket="KIRIM TUGAS";$warnamasuk="badge bg-indigo sadow";$alasanizin="";
						    }else{
						        $masukket="IZIN";$warnamasuk="badge bg-deep-orange sadow";
						        $alasanizin=$cek->izin;
						    }
						    if($alasanizin=="PKL")
						    {
						    $hadir="<span class='badge bg-lime col-black '><font color='black '> SEDANG PKL</font> </span>";    
						    }else{
							$hadir="<span class='$warnamasuk'>".$masukket." ".$alasanizin." </span>";
						    }
						 
						}else{
						    $cek_alasan=$this->db->get_where("tm_alasan_invalid","id_guru='".$idguru."' and id_jadwal='".$idJadwal."' and jam='".$jamkenow."' and tgl='".$tgl."' ")->row();
						    if(isset($cek_alasan->alasan))
						    {
						        $hadir="<span class='badge bg-red'> DIBLOK : ".$cek_alasan->alasan." </span>";
						    }
						    
						    if(isset($cek->sumber)==4)
						    {
						         $hadir="<span class='badge bg-red'> TIDAK MASUK </span>";
						    }else{
						        $hadir="<span class='badge bg-pink'> TELAT MASUK </span>";
						    }
							
							 
						} 
					}else{
					    	$hadir="<span class='badge bg-brown sadow'>BELUM MULAI</span>";
						
							if($cekoff)
                			{
                				$hadir="<span class='badge bg-black'>Dinonaktifkan : $cekoff->ket </span>";
                			}
                			
                			if($cekizinharian)
                			{
                			    $cekinval=$this->mdl->cekInval($idmapel,$idguru, $tgl,$jam);
                			    if($cekinval)
                			    {
                			        $guru=$this->m_reff->goField("data_pegawai","nama","where id='".$cekinval->id_guru."' ");
                			       	$hadir="<span class='badge bg-yellow'><font color='black'>Inval oleh $guru </font> </span>";   
                			    }else{
                			    	$hadir="<span class='badge bg-yellow'><font color='black'>IZIN : $cekizinharian->ket</font> </span>";  
                			    }
                			} 
						
			  }
			
		
			
			 
			
			$pe=$this->m_reff->goField("v_pegawai","nama_lengkap","where id='".$idguru."' ");
			$mapel=$this->m_reff->goField("tr_mapel","nama","where id='".$idmapel."' ");
			if(!$mapel)
			{
			    $mapel="<i class='col-pink'>belum di isi jadwal</i>";    
			}
			
				if(!$pe)
			{
			    $pe="<i class='col-pink'>belum di isi jadwal</i>";    
			}else{
			    $pe="<span class='col-indigo cursor'  href='#' onclick='return detail(`".$idguru."`,`$pe`)'> ".$pe."</span> ";
			}
			
			$hp=$this->m_reff->goField("data_pegawai","hp","where id='".$idguru."'");
			
			echo "<tr>
			<td>".$no++."</td>
			<td>".$pe." </td>
			<td>".$val->nama."</td>
			<td>".$mapel."</td>
			<td>".$hadir."</td>
			
			</tr>";
		};?>
		
		</table>
		</div>
		</div>
						 