  <?php
  $tahun_1=$this->m_reff->goField("tr_tahun_ajaran","nama","where id='".$tahun."'");
  $awal_bulan=$this->m_reff->goField("tr_tahun_ajaran","tgl_pindah","where id='".$tahun."'");
  $bln_ini=date("Y-m");
	 $awal_bulan=substr($awal_bulan,5,2);
	 $bln=number_format($awal_bulan,0);
	 $tahun_awal=substr($tahun_1,0,4);
	 $ym=$tahun_awal."-".$awal_bulan;
	  $bulanu[""]= "==== Pilih Bulan ====";
		 for($i=0;$i<=(11);$i++)
		 {
			 $kode=$this->tanggal->tambahBln($ym,$i);
			 $bulanu[$kode]= $this->tanggal->bulan(substr($kode,5,2)). " - ".substr($kode,0,4);
			 if($bln==13)
			 {
				$bln=1;  
			 } 
				$bln++;  
			 }
			 $data=$bulanu;
			 echo form_dropdown("bulan",$data,"","class='form-control' onchange='reload()'");
	 ?>