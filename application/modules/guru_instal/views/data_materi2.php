 <?php
 $this->db->where("id_mapel",$id);
  $this->db->where("id_guru",$this->mdl->idu());
							 $data=$this->db->get("tm_bahan_ajar");
							 if(!$data->num_rows()){ echo "<i>File materi belum ditambahkan.</i>"; return "";}
							 ?>
							 <table  class="table table-hover table-bordered table-responsive">
							 <tr>
							 <th>No</th> 
							 <th>Nama File</th>
							 <th>File</th>
							 <th></th>
							 </tr>
							 
							 <?php
							 
							 $n=1;
							 foreach($data->result() as $val)
							 {
								 if($val->sumber==1)
								 {
									 $down=$val->file;
									$d=' <a href="'.$down.'" target="_blank" class="col-pink">Akses</a>';
								 }else{
									 $down=base_url().$val->file;
										$d=' <a href="'.$down.'" download class="col-blue">Download</a>';
								 }
							 ?>
							 <tr>
							 <td><?php echo $n++;?></td>
							 <td><?php echo $nama=$val->nama;?></td>
							 <td><?php echo $d;?></td>
							 <td>   <button title="Hapus data" type="button" onclick="hapusBahan(`<?php echo $val->id;?>`,`<?php echo $nama;?>`,`<?php echo $val->sumber;?>`,`<?php echo $val->id_mapel;?>`,`<?php echo $val->code;?>`)" 
		   class="btn bg-blue-grey waves-effect  ">
		 Hapus</button></td>
							 </tr>
							 <?php } ?>
							 </table>