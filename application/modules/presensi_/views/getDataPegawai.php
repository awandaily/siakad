<?php
$periode=$this->input->get_post("periode");
$tgl1o=$this->tanggal->range_1($periode);
$tgl1=$this->tanggal->ind($tgl1o,"/");
$tgl2o=$this->tanggal->range_2($periode);
$tgl2=$this->tanggal->ind($tgl2o,"/");
$jml=$this->tanggal->selisih($tgl1o,$tgl2o)+1;

		$sts=$this->input->post("sts");
		$gender=$this->input->post("gender");
		$jabatan=$this->input->post("jabatan");
?>
<a target="_blank" class="btn bg-teal pull-right waves-effect"  href="<?php echo base_url()?>presensi/down_guru?periode=<?php echo $periode?>&sts=<?php echo $sts?>&gender=<?php echo $gender?>&jabatan=<?php echo $jabatan?>">DOWNLOAD</a>
<div class="clearfix row"></div>
<div class="table-responsive">
                             <table id='tabel' class="tabel black table-bordered table-striped table-hover dataTable no-footer DTFC_Cloned">
							  <thead class="bg-teal col-black">
								<tr> 
									<th class='bg-teal sadow' rowspan="2" style='max-widtd:3px'>NO</th> 
									<th class='bg-teal sadowbg-teal sadowbg-teal sadow' rowspan="2" valign="midle"  >NAMA</th>
									<th class='bg-teal sadowbg-teal sadow' rowspan="2"  >STATUS</th>  
									
									 <th class='bg-teal sadow'   colspan="<?php echo $jml;?>"  align="center" >PERIODE <?php echo $tgl1. " - ". $tgl2?></th>
									 	 	<th class='bg-teal sadowbg-teal sadow' rowspan="2"  >MASUK</th>  
										<th class='bg-teal sadowbg-teal sadow' rowspan="2"  >TIDAK MASUK</th> 
									 </tr>
							  
							 	<tr> 
										<?php
										for($i=0;$i<$jml;$i++){
										    echo '<th align="center" class="bg-teal sadow">'.substr($this->tanggal->tambah_tgl($tgl1o,$i),8,2).'</th> ';
										}
										?>  
									
								</tr>
							  </thead>
							</table>
							</div>	
							
							
							
	 
	<script type="text/javascript">
	 
   var  dataTable = $('#tabel').DataTable({ 
        scrollY:        "400px",
        scrollX:        true,
        scrollCollapse: true,
		 fixedColumns:   true,
		  fixedColumns:   {
            leftColumns: 3
        },
		"paging": true,
        "processing": false, //Feature control tde processing indicator.
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
						  "lengtdMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": true,
		 "lengtdMenu":
		 [[10 , 30,50,100,200,300,400,500], 
		 [10 , 30,50,100,200,300,400,500]], 
	 
	 
        // Load data for tde table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('presensi/data_pendidik');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.id_kelas = $('#id_kelas').val();
						  data.id_mapel = $('#id_mapel').val();
						  data.sts = $('#sts').val();
						  data.gender = $('#gender').val();
						  
						  data.jabatan = $('#jabatan').val();
						  data.tgl1 = "<?php echo $tgl1o;?>";
						   data.tgl2 = "<?php echo $tgl2o;?>";
						    data.jml = "<?php echo $jml;?>";
						  data.pangkat = $('#pangkat').val();
						 
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
          "targets": [ 0], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
    
  
		
function tinjau(id)
{			var url="<?php echo base_url();?>kesiswaan/tinjau";
			$.post(url,{id:id},function(data){
				   $("#judul_tinjau").html("TINJAU DATA CBT");
				   $("#isi").html(data);
				   $("#modal_tinjau").modal();
			  });
}

 

  						
											
  function hapus(id,judul=null){
		   alertify.confirm("<center>Menghapus akan membersihkan data terkait guru:<br> <span class='font-bold'>`"+judul+"`</span> <br>Yakin Hapus ? </center>",function(){
		   $.post("<?php echo site_url("presensi/hapus_pendidik"); ?>",{id:id},function(){
				notif("Data berhasil dihapus !!");			  
			  reload_table();
		      })
		   })
	  };

  
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
} 
</script>