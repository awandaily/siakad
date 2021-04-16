 
 <div class="row clearfix" id="area_loding">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="body" id="area_formbayar">
                         
					<table class='entry table-hover' width="100%">	
					<thead class="bg-teal">					
					<tr>
					<td class='col-white'>NO</td><td class='col-white'>NAMA SISWA</td><td class='col-white'>HAPUS</td>
					</tr>
					</thead>
					<?php
					$db=$this->db->query("select * from keu_tr_biaya_pokok where id='".$id."'")->row();
					$data=substr($db->siswa,1);
					$data=substr($data,0,-1);
					$data=explode(",",$data);$no=1;
					foreach($data as $val)
					{	
					$nama=$this->m_reff->goField("data_siswa","nama","where id='".$val."'");
					$nama=str_replace("'","",$nama);
					$cek=$this->db->query("select * from keu_tagihan_pokok where id_tagihan='".$id."' and id_siswa='".$val."' and bayar>0 and sts='1' ")->num_rows();
					if(!$cek){
					$thapus="<button class='waves-effect btn bg-pink' onclick='hapusTagihan(`".$nama."`,`".$val."`,`".$id."`)'>hapus</button>";
					}else{
					$thapus="<i>-</i>";
					}
						
					 	$nis=$this->m_reff->goField("data_siswa","nis","where id='".$val."'");
						echo "<tr id='table".$val."'>
						<td>".$no++."</td>
						<td>".$nama."<br> <i>NIS: <span class='col-blue'>".$nis."</span></i></td>
						<td>".$thapus."</td>
						</tr>";
					}
					
					?>
					</table>	 
							
							
					</div>	
       			</div>	
 </div>	

			
		 