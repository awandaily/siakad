<?php 

	 $sms=$this->m_reff->semester();

	$tahun=$this->m_reff->tahun();

	 $guru=$this->input->post("id");

	$data=$this->db->query("select * from tm_mapel_ajar where 

	id_guru='".$guru."'	and id_semester='".$sms."' and id_tahun='".$tahun."'   order by id_kelas asc   ")->result();

	$no=1;

	if(!$data)

	{

		echo "<center><b>Tidak ada data</b></center>";  return false;

	}?>

    <table class="entry" width="100%">
        <thead class="sadow bg-indigo">
            <tr>
                <th>NO</th>
                <th>KELAS - MAPEL</th>
                <th>JML JAM / MINGGU</th>
                <th>JML KIKD</th>
                <th>JML PERTEMUAN</th>
            </tr>

        </thead>

    <?php

			foreach($data as $val){

				$this->db->where("id_guru", $guru);
				$this->db->where("id_tahun", $tahun);
				$this->db->where("id_semester", $sms);
				$this->db->where("id_mapel_ajar", $val->id);
				$jml_kikd = $this->db->get("tm_kikd")->num_rows();

				$this->db->where("id_guru", $guru);
				$this->db->where("id_tahun", $tahun);
				$this->db->where("id_semester", $sms);
				$this->db->where("id_mapel", $val->id_mapel);
				$this->db->where("id_kelas", $val->id_kelas);
				$this->db->where_in("sumber", array("1", "2", "3"));
				$jml_pertemuan = $this->db->get("tm_absen_guru")->num_rows();		

				echo "
				<tr>
					<td>".$no++."</td>
					<td>".$this->m_reff->goField("v_kelas","nama","where id='".$val->id_kelas."' ")." - ".$this->m_reff->goField("tr_mapel","nama","where id='".$val->id_mapel."' ")."</td>
					<td><center>".$val->jml_jam."</center></td>
					<td><center><a href='#' data-toggle='modal' data-target='#md-kikd' onclick='get_kikd(`".$guru."`, `".$tahun."`, `".$sms."`, `".$val->id."`)' >".$jml_kikd."</a></center></td>
					<td><center><a href='#' data-toggle='modal' data-target='#md-pertemuan' onclick='get_pertemuan(`".$guru."`, `".$tahun."`, `".$sms."`, `".$val->id_mapel."`, `".$val->id_kelas."`)'>".$jml_pertemuan."</a></center></td>

				</tr>";

			}

	?>

    </table>
	



	<script type="text/javascript">
		$('#md-kikd').on('shown.bs.modal', function() {
		    //$("#mdl_modal").modal("toggle");
		});
		function toTglnTime(v){
	        //1996-12-02 00:00:00
	        //0123456789012345678
	        var tgl = v.substr(8,2);
	        var bln = v.substr(5,2);
	        var thn = v.substr(0,4);

	        var time = v.substr(10);

	        var value = tgl+"/"+bln+"/"+thn+" "+time;

	        return value;
	    }
		function get_kikd(id_guru, thn, sms, id){
			
			$.ajax({
				url:"<?php echo base_url(); ?>/data_pendidik/get_kikd",
				type:"POST",
				dataType:"json",
				cache:false,
				data:{id_guru, thn, sms, id},
				beforeSend:function(){
					$("#dt-kikd").html("<tr><td colspan='8' align='center'>Loading...</td></tr>");
				},
				success:function(data){

					var len = data.length;
					var dt 	= "";
					if (len!=0) {
						$("#lkelas").html("("+data[0].kelas+" - "+data[0].mapel+")");
						for(var i = 0;i < len;i++){
							dt+="<tr>";
								dt+="<td>"+(i+1)+"</td>";
								dt+="<td>"+data[i].kd3_no+"</td>";
								dt+="<td>"+data[i].kd3_kb+"</td>";
								dt+="<td>"+data[i].kd3_desc+"</td>";
								dt+="<td>"+data[i].kd4_no+"</td>";
								dt+="<td>"+data[i].kd4_kb+"</td>";
								dt+="<td>"+data[i].kd4_desc+"</td>";
							dt+="</tr>";
						}
					}
					else{
						dt+="<tr><td colspan='8' align='center'>Tidak ada data.</td></tr>";
					}

					$("#dt-kikd").html(dt);

				},
				complete:function(){

				}
			});
		}
		function get_pertemuan(id_guru, thn, sms, id_mapel, id_kelas){
			
			$.ajax({
				url:"<?php echo base_url(); ?>/data_pendidik/get_pertemuan",
				type:"POST",
				dataType:"json",
				cache:false,
				data:{id_guru, thn, sms, id_kelas, id_mapel},
				beforeSend:function(){
					$("#dt-pertemuan").html("<tr><td colspan='4' align='center'>Loading...</td></tr>");
				},
				success:function(data){

					var len = data.length;
					var dt 	= "";
					if (len!=0) {
						$("#lkelas").html("("+data[0].kelas+" - "+data[0].mapel+")");
						for(var i = 0;i < len;i++){

							if (data[i].sumber == "3") {
								var kd = "<label class='label bg-orange'>IZIN</label>";
								var ket = data[i].izin;
							}
							else{
								var kd = data[i].kode_kd;
								var ket = data[i].cpembelajaran;
							}

							dt+="<tr>";
								dt+="<td>"+(i+1)+"</td>";
								dt+="<td>"+toTglnTime(data[i].tgl)+"</td>";
								dt+="<td align='center'>"+kd+"</td>";
								dt+="<td>"+ket+"</td>";
							dt+="</tr>";
						}
					}
					else{
						dt+="<tr><td colspan='4' align='center'>Tidak ada data.</td></tr>";
					}

					$("#dt-pertemuan").html(dt);

				},
				complete:function(){

				}
			});
		}
		function md_close(id){
			$("#"+id).modal("toggle");
		}
	</script>