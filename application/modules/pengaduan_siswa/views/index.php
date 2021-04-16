<?php 

$token=date("His");?>  
<div class="row clearfix">
    <!-- Task Info -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">

                <h2 class="sound">DATA PENGADUAN SISWA</h2>

            </div>
            <div class="body">
                <div class="row clearfix">

                    <div class="col-sm-3 col-black">
                        <select class="form-control show-tick" id="id_guru<?php echo $token;?>" data-live-search="true">
                            <option value="">=== PILIH TUJUAN PENGADUAN ===</option>

                            <?php 
								   	echo "
								   		<optgroup label='SEKOLAH'>
								   			<option value='sekolah'>SEKOLAH</option>
								   		</optgroup>
								   	";

								   	echo "<optgroup label='GURU'>";
	                            		$this->db->order_by("nama", "ASC");
	                            		$qguru = $this->db->get("data_pegawai")->result();
									   	foreach($qguru as $val){
											echo "<option value='".$val->nip."'>".$val->nama."</option>";
									   	}
									echo "</optgroup>";
							?>

                        </select>
                    </div>
                    <!--
                    <div class="col-sm-3">
                        <input type="text" class='form-control' id="searching" placeholder="pencarian.." onchange='reload_table()'>
                    </div>-->

                </div>

                <div class="cardd" id="area_lod">
                    <div cass="body">
                        <div class="table-responsive">
                            <table id='tabel' class="tabel black table-bordered table-hover dataTable " style="color:black;font-size:12px;width:100%">
                                <thead class='sadow bg-teal'>
                                    <th class='thead'>
                                        <center></center>
                                    </th>

                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <!-- #END# Task Info -->
				
 
 
	 
	<script type="text/javascript">
	$("#id_guru<?php echo $token;?>").change(function(){
	 	dataTable.ajax.reload(null,false);
	});
	$("#id_sts<?php echo $token;?>").change(function(){
	 	dataTable.ajax.reload(null,false);
	});
	$("#id_jabatan<?php echo $token;?>").change(function(){
	 	dataTable.ajax.reload(null,false);
	});


   var  dataTable = $('#tabel').DataTable({ 
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
		 "searching": false,
		 scrollX:         "100%",
		deferRender:    true,
		scroller:       true,
		 "lengthMenu":
		 [[10 , 30,50,100,200,300,400,500,1000,2000], 
		 [10 , 30,50,100,200,300,400,500,1000,2000]], 
	   dom: 'Blfrtip',
	   scrollY: 370,
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			  
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pengaduan_siswa/data');?>",
            "type": "POST",
			"data": function ( data ) {
						
				  data.id_guru = $('#id_guru<?php echo $token;?>').val();						 
						 
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
          "targets": [ 0,-1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
     	  
	 
		var x=0; 
	   $(document).on('change', '#groupf<?php echo $token;?>,#id_tahun_masukf<?php echo $token;?>,#id_kelasf<?php echo $token;?>,#genderf<?php echo $token;?>,#aktifasif<?php echo $token;?>,#id_status_ibuf<?php echo $token;?>,#id_status_ayahf<?php echo $token;?>,#id_penghasilanf<?php echo $token;?>,#id_pekerjaan_ibuf<?php echo $token;?>,#id_pekerjaan_ayahf<?php echo $token;?>', function (event, messages) {			   
        
			 dataTable.ajax.reload(null,false);	
		 
		});
		
function tinjau(id)
{			var url="<?php echo base_url();?>eskul_anggota/tinjau";
			$.post(url,{id:id},function(data){
				   $("#judul_tinjau").html("TINJAU DATA CBT");
				   $("#isi").html(data);
				   $("#modal_tinjau").modal();
			  });
}
 

 

 
function pilih2(id)
{ 
var id_group=$("[name='pilih"+id+"']").val();
	 				   $.post("<?php echo site_url("eskul_anggota/pilih2"); ?>",{id:id,id_group:id_group},function(data){
				 
				$("#opsi"+id).addClass("col-pink");
				$("#opsi"+id).attr("onclick","unpilih2(`"+id+"`)");
			//	$("#opsispan"+id).text("Terpilih");
	});
} 
function unpilih(id)
{ 
				   $.post("<?php echo site_url("eskul_anggota/unpilih"); ?>",{id:id},function(data){
				$("#opsi"+id).removeClass("col-pink");
				 
				$("#opsi"+id).attr("onclick","pilih(`"+id+"`)");
			//	$("#opsispan"+id).text("Terpilih");
	});
}	

function pilih(id,pertama)
{ 
   $.post("<?php echo site_url("eskul_anggota/pilih"); ?>",{id:id,pertama:pertama},function(data){
				$("#opsi"+id).removeClass("btn-default");
				$("#opsi"+id).addClass("bg-pink");
				$("#opsi"+id).attr("onclick","unpilih(`"+id+"`,`"+pertama+"`)");
			//	$("#opsispan"+id).text("Terpilih");
	});
}							

 
function unpilih(id,pertama)
{ 
   $.post("<?php echo site_url("eskul_anggota/unpilih"); ?>",{id:id,pertama:pertama},function(data){
				$("#opsi"+id).removeClass("bg-pink");
				$("#opsi"+id).addClass("btn-default");
				$("#opsi"+id).attr("onclick","pilih(`"+id+"`,`"+pertama+"`)");
			//	$("#opsispan"+id).text("Terpilih");
	});
}							
											
  
function reload_table()
{
	 dataTable.ajax.reload(null,false);	
}
function filter()
{
				 
				  $("#mdl_filter").modal();
				  
}
</script>
	
  
                                   
	 
 
	 

 
	
	 
	 
<script>
	$('.select').selectpicker();
	$(".tmt").inputmask("99/99/9999");  
	$(".thn").inputmask("9999/9999");  
</script>
	
 
	
 
	
	
	 