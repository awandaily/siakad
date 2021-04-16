<div id="divarea">  <?php

 $data=$this->db->query("select * from tr_semester where sts=1")->row();
			$smsini=isset($data->id)?($data->id):"";
			 $sms=$this->m_reff->semester();
			 if($smsini!=$sms){
			 	echo "<div class='card'><br><center><i>Anda sedang melihat history semester sebelumnya<br> Untuk melakukan KBM Silahkan pilih semester saat ini</i></center></div>";
				return false;
			 }



 $data=$this->db->query("select * from tm_penjadwalan where id_guru='".$this->mdl->idu()."' 
 and id_semester='".$this->m_reff->semester()."' and id_tahun='".$this->m_reff->tahun()."' 
 and id_hari='".date('N')."'
 order by jam asc ");
 

 if(date("N")=="6" or date("N")==7){
      echo '  <center><b>SELAMAT BERAKHIR PEKAN</b></center><br>';
 }else{
      if($data->num_rows()){
      echo '  <center><b>JADWAL HARI INI</b></center><br>';
      }else{
           echo '  <center><b>TIDAK ADA JADWAL MENGAJAR UNTUK HARI INI</b></center><br>';
      }
 }
  $jam_aktif=$this->m_reff->jam_aktif();
foreach($data->result() as $data)
 {
     $idjur=$this->m_reff->goField("tm_kelas","id_jurusan","where id='".$data->id_kelas."'");
     $kbmjur=$this->m_reff->goField("tr_jurusan","kbm","where id='".$idjur."'");
     
     $kelas=$this->m_reff->goField("v_kelas","nama","where id='".$data->id_kelas."'");
     $mapel=$this->m_reff->goField("tr_mapel","nama","where id='".$data->id_mapel."'");
     $idkelas=$data->id_kelas;
     $idMapel=$data->id_mapel;
     $idjadwal=$data->id;
     $jam=$data->jam;
     
     $vis=$this->db->query("select * from tm_absen_guru where id_jadwal='".$idjadwal."' and id_mapel='".$idMapel."' and id_guru='".$this->mdl->idu()."' and substr(tgl,1,10)='".date('Y-m-d')."' limit 1")->row();
     if(isset($vis)){
         $warna="col-yellow";
     }else{
         $warna="";
     }
     
     if(strpos($jam,",".$jam_aktif.",")===false and $kbmjur=="true"){
         $klikkbm='onclick="nehi()"'; $w='bg-brown'; $kelas=$kelas."<i class='pull-right' style='font-size:12px;color:yellow;margin-top:5px'> (realtime)</i>";
     }else{
         $w="bg-teal";
            $klikkbm='onclick="ngisi(`'.$idkelas.'`,`'.$jam.'`,`'.$idMapel.'`,`'.$idjadwal.'`)"';
             $kelas=$kelas;
     }
     
     ?>
 
 
 <div class="info-box-3 <?php echo $w;?>  "  <?php echo $klikkbm;?>>
                      <div class="icon">
                            <i class="material-icons <?php echo $warna; ?> ">favorite</i>
                        </div>
                        <div class="content">
                            
                            <div class="text"><?php echo $mapel; ?></div>
                        
                            <div class="number count-to" style='font-size:18px'><?php echo $kelas; ?></div>
                        </div>
    </div> 
    
    <?php } ?>
    
    
    
    <script>
    function nehi()
    {
         alertify.confirm("Maaf! Pengisian agenda KBM pada Kelas ini harus realtime sesuai jam mengajar",function(){
             
         });
    }
         function ngisi(idkelas,jam,idMapel,idJadwal)
       { 
            
            
          //      loadkonten();
		   $.post("<?php echo base_url()?>kbm/addSumberNotRealtime",{idMapel:idMapel,idJadwal:idJadwal,idKelas:idkelas,jam:jam},function(data){ 
		        
		           $("#divarea").html(data);
		      
		//	  unloadkonten();
			    
		      })
		  
		
       }
       
       
    </script>
    
    </div>