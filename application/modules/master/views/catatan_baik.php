 <div class="col-md-4">
 <select id="type_penilaian" class="form-control">
 <option value="">=== Pilih Penilaian===</option>
 <option value='1'>Baik</option>
 <option value='2'>Buruk</option>
 </select>
 </div>
 <div class="col-md-4">
 <select id="id_kpenilaian" multiple="multiple" class="form-control" data-live-search="true">
 <option value="">=== Kategory Penilaian===</option>
 
   <optgroup label="Penilaian Baik">
		   <?php
		$dt=$this->db->get("tr_kpenilaian where type='1' ")->result();
		foreach($dt as $val)
		{
			echo "<option value='".$val->id."'>".$val->nama."</option>";
		}
		?>
   </optgroup>
   <optgroup label="Penilaian Buruk">
		   <?php
		$dt=$this->db->get("tr_kpenilaian where type='2' ")->result();
		foreach($dt as $vals)
		{
			echo "<option value='".$vals->id."'>".$vals->nama."</option>";
		}
		?>
   </optgroup>

 </select>
 </div>
 <div class="col-md-4">
 <select id="id_tk" class="form-control">
 <option value="">=== Pilih TIngkat===</option>
<?php
$dt=$this->db->query("SELECT distinct(id_tk) as id_tk,tingkat FROM v_penilaian where id_siswa='".$id_siswa."' ")->result();
foreach($dt as $valx)
{
	echo "<option value='".$valx->id_tk."'>".$valx->tingkat."</option>";
}
?>
 
 </select>
 </div>
 <div class="row clearfix"></div>
 <hr>
            <div class="col-md-12" id="catatan_lod">
                    
                                <table width="100%" style="font-size:11px" id="table_catatan" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>KATEGORY</th>
                                            <th>KET</th>
											 <th>POINT</th>
                                            <th>TINGKAT</th>
                                        </tr>
                                    </thead>
                                      
                                </table>
                  
            </div>
          
		
		<script type="text/javascript">
	 
   var  table_catatan = $('#table_catatan').DataTable({ 
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
		 [[5 , 10,20,30,40,50,60,100], 
		 [5 , 10,20,30,40,50,60,100]], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 1,2,3,4,5,6]
                },text:' Excell',
							
                    },
					
					{
					extend: 'pdf',
                        exportOptions: {
                     columns:[ 1,2,3,4,5,6]
                },text:'  Pdf',
							
                    },
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('master/catatan_penilaian');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.type_penilaian= $('#type_penilaian').val();
						  data.id_tk = $('#id_tk').val();
						  data.id_kpenilaian = $('#id_kpenilaian').val();
						  data.id_siswa =<?php echo $id_siswa?>;
						   
						 
		 },
		   beforeSend: function() {
               loading("catatan_lod");
            },
			complete: function() {
              unblock('catatan_lod');
            },
			
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
    
 
	 
		var x=0; 
	   $(document).on('change', '#type_penilaian,#id_tk,#id_kpenilaian', function (event, messages) {			   
        
			 table_catatan.ajax.reload(null,false);	
		 
		});
		
 

 	 
 
</script>


<script>
	$('select').selectpicker();
</script>
	
 
 