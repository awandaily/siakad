 <?php
	$mapelajar = $this->input->get_post("kelas");
	$datamapelajar = $this->db->get_where("v_mapel_ajar", array("id" => $mapelajar))->row();
	$idkelas = $datamapelajar->id_kelas;
	$idmapel = $datamapelajar->id_mapel;
	$datax = $this->db->query("select * from tm_kikd where id_tahun='" . $this->m_reff->tahun() . "'
		 and id_semester='" . $this->m_reff->semester() . "' and id_mapel_ajar='" . $mapelajar . "' 
		 ORDER BY CAST(SUBSTR(kd3_no,3,3) AS SIGNED INTEGER) ASC");
	$jmlkikd = $datax->num_rows();
	$sms = $this->m_reff->semester();
	/* if($sms==2) //jika genap
  {
	  $nama_ujian="UAS";
	  $id_kate=3;
  }elseif($sms==1){
	   $nama_ujian="UTS";
	  $id_kate=2;
  }*/
	?>
 <div id="area_lod">
 	<table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">

 		<thead>
 			<tr>
 				<th class='bg-grey sadow' rowspan="2" width='15px'>&nbsp;NO</th>
 				<th class='bg-grey sadow' rowspan="2">NAMA SISWA</th>
 				<th class='bg-grey sadow' rowspan="2"> NIS</th>
 				<th class='sadow bg-teal' align="center" colspan="<?php echo $jmlkikd + 1; ?>">
 					<center>PENGETAHUAN (KD)</center>
 				</th>
 				<th class='sadow bg-primary' align="center" colspan="<?php echo $jmlkikd + 1; ?>">
 					<center>KETERAMPILAN (KI)</center>
 				</th>

 				<th rowspan="2" class='sadow bg-pink' align="center">
 					<center>UTS</center>
 				</th>
 				<th rowspan="2" class='sadow bg-pink' align="center">
 					<center>UAS</center>
 				</th>
 				<th colspan="3" class='sadow bg-green' align="center">
 					<center>NILAI BAHAN DIRAPORT</center>
 				</th>

 			</tr>

 			<tr>

 				<?php

					foreach ($datax->result() as $data) {
						echo "<th class='thead bg-teal' > " . $data->kd3_no . "</th>";
					}
					?>


 				<th class='thead bg-teal'>RATA<sup>2</sup> </th>
 				<?php

					foreach ($datax->result() as $data) {
						echo "<th class='bg-primary' > " . $data->kd4_no . "</th>";
					} ?>

 				<th class='bg-primary'>RATA<sup>2</sup> </th>
 				<th class='bg-primary'>S </th>
 				<th class='bg-primary'>P</th>
 				<th class='bg-primary' data-placement='top' data-original-title='Diambil dari nilai tertinggi' data-toggle='tooltip'>K </th>
 			</tr>

 		</thead>
 		<tbody>
 		</tbody>
 	</table>
 </div>

 <?php
	$ro = 10;
	$ro = $ro + ($jmlkikd * 2);
	$rowrow = "";
	for ($i = 0; $i < $ro; $i++) {
		$rowrow .= $i . ",";
	}
	// $rowrow;
	$rowrow = substr($rowrow, 0, -1);
	?>

 <script type="text/javascript">
 	var dataTable = $('#table').DataTable({
 		//	scrollX: 103,
 		// 	"fixedHeader": true,
 		scrollY: "300px",
 		scrollX: true,
 		scrollCollapse: true,
 		fixedColumns: true,
 		fixedColumns: {
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
 		"lengthMenu": [
 			[5, 10, 15, 20, 25, 30, 35, 100],
 			[5, 10, 15, 20, 25, 30, 35, 100]
 		],

 		dom: 'Blfrtip',
 		buttons: [
 			// 'copy', 'csv', 'excel', 'pdf', 'print'

 			{
 				extend: 'excel',
 				exportOptions: {
 					columns: [<?php echo $rowrow; ?>]
 				},
 				text: 'Export Excell',

 			},

 			/*		{
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
 			"url": "<?php echo site_url('kesiswaan/getDataNilai'); ?>",
 			"type": "POST",
 			"data": function(data) {

 				data.id_kelas = "<?php echo $idkelas; ?>";
 				data.id_mapel_ajar = "<?php echo $mapelajar; ?>";
 				data.id_mapel = "<?php echo $idmapel; ?>";


 			},
 			beforeSend: function() {
 				loading("area_lod");
 			},
 			complete: function() {
 				unblock('area_lod');
 			},

 		},

 		//Set column definition initialisation properties.
 		"columnDefs": [{
 				"targets": [0, -1, -2, -3, -4,-5], //last column
 				"orderable": false, //set not orderable
 			},
 			/* {
                "targets": [  2,3,4,5,6,7,8,9,10,11,12,13,14,15,16  ],
                "visible": false
            }*/
 		],

 	});



 	function reload_table() {
 		dataTable.ajax.reload(null, false);
 	}


 	//Tooltip
 	$('[data-toggle="tooltip"]').tooltip({
 		container: 'body'
 	});
 </script>