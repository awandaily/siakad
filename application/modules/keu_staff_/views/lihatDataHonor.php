 
 <div class="row clearfix" id="area_loding">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="body" id="area_formbayar">
                         
					<table class='entry   table-hover' width="100%">	
					<thead class="bg-teal">					
					<tr>
					<td class='col-white'>NO</td><td class='col-white'>NAMA PENERIMA</td><td class='col-white'>STATUS</td><td class='col-white'>HAPUS</td>
					</tr>
					</thead>
					<?php
					$data=$this->db->query("select * from keu_honor where keu_honor.code='".$id."'")->result();$no=1;
					foreach($data as $val)
					{	
					
					$nama=$this->m_reff->goField("data_pegawai","nama","where id='".$val->id_guru."'");
					$nama=str_replace("'","",$nama);
				 
					if($val->byr==0)
					{
						$sts="<button class=' btn btn-mini bg-grey' onclick='set(`".$val->id."`,`1`,`".$nama."`,`".$id."`)'>Belum diambil</button>";
						$thapus="<button class='waves-effect btn bg-pink' onclick='hapusHonor(`".$nama."`,`".$val->id_guru."`,`".$no."`,`".$id."`)'>hapus</button>";
					
					}elseif($val->byr==1)
					{
						$sts="<span class='col-red'>Masuk Gaji ".$val->nama_periode."</span>";
						$thapus="-";
					}else{
						$sts="<button class='btn waves-effect bg-white col-indigo' onclick='set(`".$val->id."`,`0`,`".$nama."`,`".$id."`)'>Diambil ".$this->tanggal->ind($val->tgl_diambil,"-")."</button>";
						$thapus="-";
					}
					
					  
						echo "<tr id='table".$no."'>
						<td>".$no++."</td>
						<td>".$nama." </td>
						<td>".$sts." </td>
						<td>".$thapus."</td>
						</tr>";
					}
					
					?>
					</table>	 
							
							
					</div>	
       			</div>	
 </div>	

			
		 