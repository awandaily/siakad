  <?php
  	$idmapel=$this->input->post("idMapel");
	$idkelas=$this->input->post("idKelas");
	$idjadwal=$this->input->post("idJadwal");
		$data_jam=$jam=$this->input->post("jam");
		$jam_blok=$this->input->post("jam_blok");	
	 
     $data_jam=$this->input->post("idKelas");
     
     $idguru=$this->mdl->idu();
     
 $visizin=$this->db->query("select * from tm_absen_guru where id_guru='".$this->mdl->idu()."' and substr(tgl,1,10)='".date('Y-m-d')."' and sumber='3' limit 1")->row();
   $izin=isset($visizin->izin)?($visizin->izin):"";
 
  ?>
  <div id="area_modal_artikel">
<form action="javascript:submitFormNoResset('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>kbm/insert_izin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="f[id_jadwal]" value="<?php echo $idjadwal;?>">
    <center class='col-teal'><h3>IZIN MENGAJAR</h3>
   <textarea id="izin" name="f[izin]" class="form-control" required placeholder="Tulis keterangan mengapa anda izin..." style="min-height:120px"><?php echo $izin;?></textarea>
 
   
    
   <div class="clearfix"></div>
   <br>
    <?php
                                $mobil=$this->m_reff->mobile();
                                if($mobil){
                                    echo '	 <button class="btn bg-teal btn-block" onclick="submitFormNoResset(`modal_artikel`)"><i class="material-icons">save</i> SIMPAN</button>';
                                }else{
                                     echo '	 <center><button class="btn bg-teal " onclick="submitFormNoResset(`modal_artikel`)"><i class="material-icons">save</i> SIMPAN</button></center>';
                                }
                                ?>
   </center>
   
    </div>
    
    <script>
    $("#izin").focus();
        function reload_table()
        {
          ////////////////1getSumber(3);   
        }
    </script>