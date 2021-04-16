<?php
	$sl = "
		tr_mitra_quota.*,
		tr_tahun_ajaran.id AS thn_id,
		tr_tahun_ajaran.nama AS tahun,
		tr_semester.id AS sms_id,
		tr_semester.romawi AS semester
	";
	$tahunmin=$this->m_reff->tahun();
	$this->db->select($sl);
	$this->db->from("tr_mitra_quota");
	$this->db->join("tr_semester", "tr_mitra_quota.id_semester = tr_semester.id");
	$this->db->join("tr_tahun_ajaran", "tr_mitra_quota.id_tahun = tr_tahun_ajaran.id");
	$this->db->where("tr_mitra_quota.id_mitra",$id);
	$this->db->where("tr_mitra_quota.id_tahun",$tahunmin);
	$data=$this->db->get();
 	if(!$data->num_rows()){ echo "<i>File MOU belum ditambahkan.</i>"; return "";}


?>
<div class="table-responsived">
    <table class="entry table-hover  " width="100%">
        <tr>
           <!--  <th>No</th>--->
            <th width='200px'>Tahun / Semester</th>
            <!-- <th>Kode</th>-->
             <th>Quota</th>
             <th>Lama PKL</th>
             <th>Pemberangkatan</th>
             <th>Pembimbing</th>
            <th>No MOU</th>
            <th>Judul MOU</th>
            <th>Tgl Awal MOU</th>
            <th>Tgl Akhir MOU</th>
             <!--  <th>Ket</th> -->
            <th></th>
        </tr>

        <?php

    		 $n=1;
    		 foreach($data->result() as $val)
    		 {

    			$down=base_url().$val->mou;

                $this->db->order_by("nama", "asc");
                $qp = $this->db->get("data_pegawai")->result();

                $sel_pegawai = "<option value=''>== PILIH ==</option>";
                foreach ($qp as $p) {

                    if ($p->id == $val->id_pembimbing) {
                        $sel_pegawai .= "<option value='".$p->id."' selected>".$p->nama."</option>";
                    }
                    else{
                        $sel_pegawai .= "<option value='".$p->id."'>".$p->nama."</option>";
                    }

                    
                }
    	?>
                <tr>
                 <!--   <td>
                        <?php echo $n++;?>
                    </td>--->
                    <td>
                        <?php echo $val->tahun?> 
                    </td>
                    <!--  <td>
                         <?php echo $val->id?> 
                    </td>-->
                    <td>
                       <input type="text" size="4" name="q<?php echo $val->id;?>" value="<?php echo $val->quota?>" onchange="setQ(`<?php echo $val->id?>`)">
                    </td>
                    <td>
                       <input type="text" size="4" name="l<?php echo $val->id;?>" value="<?php echo $val->lama_pkl?>" onchange="setL(`<?php echo $val->id?>`)">
                    </td>
                    <td>
                       <input type="text" size="12"  name="t<?php echo $val->id;?>" value="<?php echo date("d/m/Y", strtotime($val->tgl_berangkat))?>" onchange="setT(`<?php echo $val->id?>`)">
                    </td>
                    <td>
                       <select class="form-control show-tick sel_pegawai" data-live-search="true" onchange="setP(`<?php echo $val->id?>`)" name="p<?php echo $val->id;?>">
                            <?php echo $sel_pegawai ?>
                        </select>
                    </td>
                    <td>
                       <input type="text" size="10" name="no<?php echo $val->id;?>" onchange="setno(`<?php echo $val->id?>`)" value="<?php echo $val->no_mou?>">
                    </td>
                     <td>
                       <input type="text" size="10" name="judul<?php echo $val->id;?>" onchange="setj(`<?php echo $val->id?>`)" value="<?php echo $val->judul_mou?>">
                    </td>
                    <td>
                       <input type="text" size="10" name="awal<?php echo $val->id;?>" onchange="setaw(`<?php echo $val->id?>`)" value="<?php echo $this->tanggal->ind($val->tgl_awal_mou,"/")?>">
                    </td>
                    <td>
                       <input type="text" size="10" name="akhir<?php echo $val->id;?>" onchange="setak(`<?php echo $val->id?>`)" value="<?php echo $this->tanggal->ind($val->tgl_akhir_mou,"/")?>">
                    </td>
                 <!--   <td>
                        <textarea  name="ket<?php echo $val->id?>"  onchange="setKet(`<?php echo $val->id?>`)"><?php echo $val->ket?></textarea>
                    </td>--->
                    <td align="center">
                    <?php
                    if($val->mou){?><a title="Download data" class="btn bg-blue-grey waves-effect" href="<?php echo $down;?>" download="<?php echo $down;?>">
                            Download
                        </a>
                        <?php } ?>
                    	<button title="Hapus data" type="button" onclick="hapusBahan(`<?php echo $val->id;?>`,`<?php echo $down;?>`,`<?php echo $val->id_mitra;?>`, ` yakin`)" class="btn bg-blue-grey waves-effect  ">
                            Hapus
                        </button>
                    </td>
                </tr>
        <?php } ?>
    </table>
</div>
<script>
    $(".sel_pegawai").selectpicker();
    function setQ(id)
    {   loading("mdl_mou");
        var val=$("[name='q"+id+"']").val();
        $.post("<?php echo site_url("humas/setKuota"); ?>",{id:id,val:val},function(data){
		 	  notif("Tersimpan!");
		 	  unblock("mdl_mou");
			}); 
    }
    function setno(id)
    {   loading("mdl_mou");
        var val=$("[name='no"+id+"']").val();
        $.post("<?php echo site_url("humas/setno"); ?>",{id:id,val:val},function(data){
              notif("Tersimpan!");
              unblock("mdl_mou");
            }); 
    }
    function setj(id)
    {   loading("mdl_mou");
        var val=$("[name='judul"+id+"']").val();
        $.post("<?php echo site_url("humas/setjudul"); ?>",{id:id,val:val},function(data){
              notif("Tersimpan!");
              unblock("mdl_mou");
            }); 
    }

    function setaw(id)
    {   loading("mdl_mou");
        var val=$("[name='awal"+id+"']").val();
        $.post("<?php echo site_url("humas/setawal"); ?>",{id:id,val:val},function(data){
              notif("Tersimpan!");
              unblock("mdl_mou");
            }); 
    }

    function setak(id)
    {   loading("mdl_mou");
        var val=$("[name='akhir"+id+"']").val();
        $.post("<?php echo site_url("humas/setakhir"); ?>",{id:id,val:val},function(data){
              notif("Tersimpan!");
              unblock("mdl_mou");
            }); 
    }

    function setT(id)
    {   loading("mdl_mou");
        var val=$("[name='t"+id+"']").val();
        $.post("<?php echo site_url("humas/setTgl"); ?>",{id:id,val:val},function(data){
              notif("Tersimpan!");
              unblock("mdl_mou");
            }); 
    }
    function setL(id)
    {   loading("mdl_mou");
        var val=$("[name='l"+id+"']").val();
        $.post("<?php echo site_url("humas/setLama"); ?>",{id:id,val:val},function(data){
              notif("Tersimpan!");
              unblock("mdl_mou");
            }); 
    }
       function setKet(id)
    {   loading("mdl_mou");
        var val=$("[name='ket"+id+"']").val();
        $.post("<?php echo site_url("humas/setKet"); ?>",{id:id,val:val},function(data){
		 	  notif("Tersimpan!");
		 	  unblock("mdl_mou");
			}); 
    }
    
     function setM(id)
    {   loading("mdl_mou");
        var val=$("[name='m"+id+"']").val();
        $.post("<?php echo site_url("humas/setMou"); ?>",{id:id,val:val},function(data){
		 	  notif("Tersimpan!");
		 	  unblock("mdl_mou");
			}); 
    }
</script>