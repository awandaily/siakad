 <?php  
                               $semester=$this->m_reff->semester();
                             	$tahun_real=$this->m_reff->tahun_asli();
	                        	$tahun_kini=$this->m_reff->tahun();
                            	if($tahun_real==$tahun_kini){
                            $id_kelas=$this->m_reff->goField("tm_kelas","id","where id_wali='".$this->mdl->idu()."'");
	                        	}else{ 
	                        	
	                        	   $getIdSiswa=$this->m_reff->goField("tm_catatan_walikelas","id_siswa","where _cid='".$this->mdl->idu()."' and id_tahun='".$tahun_kini."' order by RAND()  limit 1");
	                         	   $id_kelas=$this->m_reff->getHisKelas($getIdSiswa);   
	                        	} 
                             ?>
                             
                             
 <?php 
 //$id_kelas=$this->input->get_post("kelas");
 // $sms=$this->input->get_post("sms");
  $sms=$this->m_reff->semester();
  $tahun=$this->m_reff->tahun();  
  $mapel=$this->db->query("select * from v_mapel_ajar where id_kelas='".$id_kelas."'
  and id_semester='".$sms."' and id_tahun='".$tahun."' group by id_mapel ");
  if(!$mapel->num_rows())
  {
	  echo "<b>Tidak ada data</b>"; return false;
  }
	  
 ?>
 <div class="table-responsive" id="area_lod">
 
 <div class="pull-left col-md-10 col-sx-12">
 <b>KELAS : </b><?php echo $mapel->row()->kelas;?><br>
 <b>SEMESTER : </b><?php echo $sms;?> (<?php echo $this->m_reff->alias_semester($sms);?>)<br>
 <b>TAHUN PELAJARAN : </b><?php echo $this->m_reff->tahun_ajaran($this->m_reff->tahun());?>
 </div>
 <div class="col-md-12 col-sx-12" align='right'>
	
 
                                   <a target="_blank" href="<?php echo base_url()?>raport/download_legger?kelas=<?php echo $id_kelas?>"   
								   class="waves-effect btn bg-teal btn-block">
								   <i class="material-icons">format_indent_increase</i>
								   DOWNLOAD LEGGER</a>
                       <!--            <a target="_blank" href="<?php echo base_url()?>raport/download_legger?kelas=<?php echo $id_kelas?>"   class="waves-effect btn bg-teal btn-block">Download Excel</a>
-->
                                 
	 
	 
	 </div>
</span>                        


 <table id='table' class="tabel black table-bordered table-striped table-hover dataTable" style="font-size:12px;width:100%">
 <thead>
								 
								<tr><th class='bg-teal sadow' rowspan="3" width='15px'>&nbsp;NO</th>
								<th class='bg-teal sadow' rowspan="3" > NISN</th>
								<th class='bg-teal sadow' rowspan="3" >NAMA PESERTA DIDIK</th>
								<th class='bg-teal sadow' rowspan="3" >JK</th>
								<th class='sadow  bg-green' align="center" colspan="<?php echo ($mapel->num_rows()*3);?>"><center>MATA PELAJARAN</center></th>
								<th class='bg-teal   sadow' rowspan="4"  data-placement='top' 
								data-original-title='(nilai Pengetahuan 60%+(PAS+PTS 40%) + Nilai Keterampilan)/2) ' data-toggle='tooltip'><center> RATA- RATA </center></th>
								<th class='bg-pink sadow' rowspan="4" > NILAI AKHIR </th>
								<th class='bg-teal sadow' rowspan="4" >NILAI EKSKUL</th>
								<th class='bg-teal sadow'   colspan="3"><center>KEHADIRAN</center></th>
								<th class='bg-green sadow' rowspan="4"  >TOTAL</th>
								 
								</tr>
								
								<tr>
								<?php $urut=1; $urutan=""; $spk="";
								foreach($mapel->result() as $val)
								{
									$guru=$this->m_reff->goField("data_pegawai","nama","where id='".$val->id_guru."'");
									echo "<td colspan='3' class='bg-green sadow font-bold' data-placement='top' data-original-title='".$guru."' data-toggle='tooltip'><center>".$val->mapel."</center></td>";
									$urutan.="<td colspan='3' class='bg-teal'> <center>".$urut++."</center></td>";
									$spk.="<td class='sadow font-bold bg-green'>S</td><td class='sadow font-bold bg-green'>P</td><td class='sadow font-bold bg-green'>K</td>";
								}
								$dbhadir=$this->db->get_where("tr_sts_kehadiran",array("sts_tampil"=>1))->result();
								echo " ";
								foreach($dbhadir as $var)
								{
									echo '<td rowspan="3" class="sadow font-bold bg-green">'.$var->alias.'</td>';
								}
								echo "</tr>";
								echo "<tr>";
								echo $urutan;
								echo "</tr>";
								echo '<tr>	 <td colspan="4" class="sadow font-bold bg-green"><center>ASPEK YANG DINILAI</center></td>  ';
								 
								echo $spk;
								?>	 
								</tr>
								 </thead>
								 
								
								
								
								<tbody>
                            </tbody>
							</table>
							</div>		
							
	<script type="text/javascript">
	 
   var  dataTable = $('#table').DataTable({ 
	 //	scrollX: 103,
	// 	"fixedHeader": true,
	 scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
		 fixedColumns:   true,
		  fixedColumns:   {
            leftColumns: 3
        },
		"paging": true,
        "processing": false, //Feature control the processing indicator.
		"language": {
					 "sSearch": "Pencarian",
					 "processing": ' <span class="sr-only dataTables_processing">Loading...</span> <br><b style="color:black;background:white">Proses menampilkan data<br> Mohon Menunggu..</b>',
						  "oPaginate": {
							"sFirst": "Hal Pertama",
							"sLast": "Hal Terakhir",
							 "sNext": "Selanjutnya",
							 "sPrevious": "Sebelumnya"
							 },
						"sInfo": "Total :  _TOTAL_ , Halaman (_START_ - _END_)",
						 "sInfoEmpty": "Tidak ada data yang di tampilkan",
						   "sZeroRecords": "Data tidak tersedia",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": true,
		 "lengthMenu":
		 [[5 , 10,15,20,25,30,35,100], 
		 [5 , 10,15,20,25,30,35,100]], 
		 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
		/*	 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]
                },text:'Export Excell',
							
                    },
					
					{
					extend: 'pdf',
                        exportOptions: {
                     columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:'  Pdf',
							
                    },{
					extend: 'print',
                        exportOptions: {
                    columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:'  Print',
							
                    },
					{extend: 'colvis',
                        exportOptions: {
                  columns:[ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
                },text:' Kolom',
							
                    },*/
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('raport/getDataNilai');?>",
            "type": "POST",
			"data": function ( data ) {
						
						   data.id_kelas ="<?php echo $id_kelas;?>";
						 // data.id_mapel_ajar =" ";
						 // data.id_mapel =" >";
						 
						 
		 },
		   beforeSend: function() {
               loading("area_lod");
            },
			complete: function() {
              unblock('area_lod');
            },
			
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3,-4 ], //last column
          "orderable": false, //set not orderable
        },
		/* {
                "targets": [  2,3,4,5,6,7,8,9,10,11,12,13,14,15,16  ],
                "visible": false
            }*/
        ],
	
      });
    
 
	   
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
}
 </script>		
<script>
 $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
</script>

  